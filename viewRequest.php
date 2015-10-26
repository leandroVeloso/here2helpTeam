<?php
    // Includes pdo file
    include_once('pdo.inc');
    redirectUser((verifyUserType(VOLUNTEER) || verifyUserType(CUSTOMER) || verifyUserType(ADMIN)),"index.php");
    include_once('PHP_Process_Files/processViewQuotes.php');
    include_once('PHP_Process_Files/processViewRequest.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head.inc'; // Includes head content ?>
    </head>
    <body id="page-top" class="index">
        <?php include 'navigation.inc'; // Includes logo and menu?>
        <section id="createRequest">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        </br></br>
                        <h2>View Help Request <?php echo $myRequest['requestID'];?></h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <?php
                            if($myRequest['statusID'] == OPEN)
                                echo "<img class='img-responsive' src='img/status_img/waiting_volunteer_open.png' alt='' style='width: 100%; height: 100%'>";
                            if($myRequest['statusID'] == CLOSED)
                                echo "<img class='img-responsive' src='img/status_img/booked_closed.png' alt='' style='width: 100%; height: 100%'>";
                            if($myRequest['statusID'] == WAITING_APROVAL)
                                echo "<img class='img-responsive' src='img/status_img/waiting_approval.png' alt='' style='width: 100%; height: 100%'>";
                            if($myRequest['statusID'] == IN_PROGRESS)
                                echo "<img class='img-responsive' src='img/status_img/waiting_quotes_inprogress.png' alt='' style='width: 100%; height: 100%'>";
                            if($myRequest['statusID'] == CANCELLED)
                                echo "<img class='img-responsive' src='img/status_img/cancelled.png' alt='' style='width: 100%; height: 100%'>";
                            if($myRequest['statusID'] == WAITING_BOOKING)
                                echo "<img class='img-responsive' src='img/status_img/waiting_booking_conf.png' alt='' style='width: 100%; height: 100%'>";
                        ?>
                    
                        <div class="container">
                        <div class="row">
                            <div class="col-lg-8 text-center">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <tr>
                                    <th class="col-md-3">ID</th>
                                    <td class="col-md-8"><?php echo $myRequest['requestID']; ?></td>
                                  </tr>
                                  <tr>
                                    <th>Request</th>
                                    <td><?php echo $myRequest['requestName']; ?></td>
                                  </tr>
                                  <tr>
                                    <th>Date Range</th>
                                    <td><?php echo date('d  M  Y', strtotime($myRequest['startDate'])); ?> - <?php echo date('d  M  Y', strtotime($myRequest['endDate']));?></td>
                                  </tr>
                                  <tr>
                                    <th>Time Range</th>
                                    <td><?php echo date('g:i a', strtotime($myRequest['startTime'])); ?> - <?php echo date('g:i a', strtotime($myRequest['endTime'])); ?></td>
                                  </tr>
                                  <tr>
                                    <th>Price Range</th>
                                    <td>$<?php echo $myRequest['minPrice']; ?> - $<?php echo $myRequest['maxPrice']; ?></td>
                                  </tr>
                                  <tr>
                                    <th class="col-md-3">Description</th>
                                    <td class="col-md-8"><?php echo $myRequest['comment']; ?></td>
                                  </tr>
                                  <tr>
                                    <th>Priority</th>
                                    <td><?php echo $myRequest['priority']; ?></td>
                                  </tr>
                                  <tr>
                                    <th class="col-md-3">Location</th>
                                    <td class="col-md-8"><?php echo $myRequest['unitNumber']; ?> <?php echo $myRequest['street']; ?>, <?php echo $myRequest['suburb']; ?>, <?php echo $myRequest['state']; ?> <?php echo $myRequest['postcode']; ?></td>
                                  </tr>
                                  <tr>
                                    <th>Status</th>
                                    <td><?php echo $myRequest['status']; ?></td>
                                  </tr>
                                  <tr>
                                    <th>Creation Date</th>
                                    <td><?php echo date('d-M-Y H:i:s', strtotime($myRequest['creationDate'])); ?></td>
                                  </tr>
                                  <tr>
                                    <th>Last Modified</th>
                                    <td><?php echo date('d-M-Y H:i:s', strtotime($myRequest['lastModified'])); ?></td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                        </div>
                        
                        <br><br>
                        <?php
                            if($myRequest['statusID'] == OPEN){
                        ?>
                        <div>
                            <form action="editRequest.php" method="GET">
                                <button type="submit" value="<?php echo $myRequest['requestID'];?>" name="request" id="request" class="btn btn-info btn-lg" id="createBtn">Edit </button>
                                <button type="button" value="Create Help Request" class="btn btn-danger btn-lg" id="createBtn" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                            </form>
                        </div>
                        <?php } ?>
                    </div></div>
                        <?php
                          if(isset($quotes) && $quotes != null && $myRequest['statusID'] != OPEN && $myRequest['statusID'] != IN_PROGRESS){ 
                        ?>
                        <div class="container">
                          <div class="row">
                            <div class="col-lg-12 text-center">
                              <hr>
                              <h3>QUOTES</h3>

                              <hr>
                              <?php if($myRequest['statusID'] == WAITING_APROVAL){ ?>
                            <form action="PHP_Process_Files/processApproveRequest.php" method="POST">

                              <?php } 
                              // Print quotes information
                                foreach ($quotes as $aQuote) {
                                    if(($myRequest['statusID'] == WAITING_BOOKING && $aQuote['approved'] == 1) || ($myRequest['statusID'] == WAITING_APROVAL) ||($myRequest['statusID'] == CLOSED && $aQuote['approved'] == 1)){
                                ?>
                                  <div class="row">
                                  <div class="col-lg-6 col-lg-offset-3">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <?php $serviceProviderID;
                                    if($aQuote['approved'] == 1){ 
                                      $serviceProviderID= $aQuote['serviceProviderID'] ?>
                                  <tr><td colspan="2">APPROVED QUOTE</button></td></tr>
                                  <?php } ?>
                                  <tr>
                                    <th class="col-md-3">ID</th>
                                    <td class="col-md-8"><?php echo $aQuote['quoteID']; ?></td>
                                  </tr>
                                  <tr>
                                    <th class="col-md-3">Service Provider</th>
                                    <td class="col-md-8"><?php echo $aQuote['name']; ?></td>
                                  </tr>
                                  <tr>
                                    <th>Date Range</th>
                                    <td><?php echo date('d  M  Y', strtotime($aQuote['startDateTime'])); ?> - <?php echo date('d  M  Y', strtotime($aQuote['endDateTime']));?></td>
                                  </tr>
                                  <tr>
                                    <th>Time Range</th>
                                    <td><?php echo date('g:i a', strtotime($aQuote['startTime'])); ?> - <?php echo date('g:i a', strtotime($aQuote['endTime'])); ?></td>
                                  </tr>
                                  <tr>
                                    <th>Price Range</th>
                                    <td>$<?php echo $aQuote['minPrice']; ?> - $<?php echo $aQuote['maxPrice']; ?></td>
                                  </tr>
                                  <tr>
                                    <th class="col-md-3">Description</th>
                                    <td class="col-md-8"><?php echo $aQuote['description']; ?></td>
                                  </tr>
                                  <tr>
                                    <th>Creation Date</th>
                                    <td><?php echo date('d-M-Y H:i:s', strtotime($aQuote['creationDate'])); ?></td>
                                  </tr>
                                  <tr>
                                    <th>Last Modified</th>
                                    <td><?php echo date('d-M-Y H:i:s', strtotime($aQuote['lastModified'])); ?></td>
                                  </tr>
                                  
                                    <?php if($myRequest['statusID'] == WAITING_APROVAL){ ?>
                                    <tr>
                                      <td colspan="2">
                                        <label><input type="radio" name="approvedQuote" required value="<?php echo $aQuote['quoteID']; ?>"> Approve this quote</label>
                                      </td>
                                  </tr>
                                    <?php } ?>

                                    <?php if($aQuote['approved'] == 1){ ?>
                                      <tr><th>User Booking Comment:</th>
                                    <td><?php echo $aQuote['clientComment']; ?></td></tr>
                                      <?php } 

                                       if($aQuote['approved'] == 1 && $myRequest['statusID'] == CLOSED){ ?>
                                      <tr><th>Volunteer Booking Comment:</th>
                                    <td><?php echo $aQuote['volunteerComment']; ?></td></tr>
                                      <?php } ?>


                                </table>
                              </div>
                            </div>
                            <hr>
                         <?php }} if($myRequest['statusID'] == WAITING_APROVAL){  ?>
                         <div class="row">
                                  <div class="col-lg-6 col-lg-offset-3">
                            <td colspan="2">
                                <label><input type="radio" name="approvedQuote" required value="nonce">None. (Ask for new quotes)</label>
                              </td><br>
                                      <label>Quote Comment</label>
                                            <textarea class="form-control" id="comment" rows="4" placeholder="Write a comment for the selected quote" name="comment"></textarea>
                                      <p class="help-block text-danger"></p>
                              <input type="hidden" name="requestID" id="requestID" value="<?php echo $myRequest['requestID']; ?>">
                              <button type="submit" class="btn btn-success btn-lg" id="approveBtn" name="approveBtn" >Send Quote Approval</button>
                            </div>
                        </div>
                         <?php }if($myRequest['statusID'] == CLOSED){?>
                                <form action="PHP_Process_Files/processInsertFeedbacks.php" method="POST">
                                    <div class="row">
                                      <div class="col-lg-6 col-lg-offset-3">
                                        <h3>FEEDBACK</h3>
                                            <div class="row control-group">
                                                <label>Servive Provider</label><br>
                                                <label><input type="radio" class="radio" name="serviceProviderFeedback" value="1" required>1</label>
                                                <label><input type="radio" class="radio" name="serviceProviderFeedback" value="2" required>2</label>
                                                <label><input type="radio" class="radio" name="serviceProviderFeedback" value="3" required>3</label>
                                                <label><input type="radio" class="radio" name="serviceProviderFeedback" value="4" required>4</label>
                                                <label><input type="radio" class="radio" name="serviceProviderFeedback" value="5" required>5</label>
                                            </div>
                                            <hr>
                                            <div class="row control-group">
                                                <label>Volunteer</label><br>
                                                <label><input type="radio" class="radio" name="volunteerFeedback" value="1" required>1</label>
                                                <label><input type="radio" class="radio" name="volunteerFeedback" value="2" required>2</label>
                                                <label><input type="radio" class="radio" name="volunteerFeedback" value="3" required>3</label>
                                                <label><input type="radio" class="radio" name="volunteerFeedback" value="4" required>4</label>
                                                <label><input type="radio" class="radio" name="volunteerFeedback" value="5" required>5</label>
                                            </div
                                            <br>                                          
                                            <input type="hidden" name="requestID" id="requestID" value="<?php echo $myRequest['requestID']; ?>">
                                            <input type="hidden" name="volunteerID" id="volunteerID" value="<?php echo $myRequest['volunteerID']; ?>">
                                            <input type="hidden" name="serviceProviderID" id="serviceProviderID" value="<?php echo $serviceProviderID; ?>">
                                            <button type="submit" class="btn btn-info btn-lg" id="approveBtn" name="approveBtn" >Send FeedBacks</button>
                                        </div>
                                    </div>
                                
                         <?php }}?>

                    </div>
                </div>
            </div>
        </section>
        <div id="confirmDeleteModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ATTENTION!</h4>
                    </div>
                    <div class="modal-body">
                        <p>You're about to delete your request and all information associated with it.</p>
                        <p>Are you sure you want do delete it?</p>
                        <br>
                        <p>You won't be able to recover it later.</p>
                    </div>
                    <div class="modal-footer">
                        <form action="PHP_Process_Files/processDeleteRequest.php" method="POST">
                            <input type="hidden" name="locationID" value="<?php echo $myRequest['locationID'];?>"/>
                            <button type="submit" class="btn btn-danger" name="requestID" id="requestID" value="<?php echo $myRequest['requestID'];?>">YES, I WANT TO DELETE REQUEST <?php echo $myRequest['requestID'];?></button>
                            <button type="button" class="btn btn-success" data-dismiss="modal">NO</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
            // Includes logo and menu
            include 'footer.inc';
            // Includes Javascript files
            include 'javascripts.inc';
        ?>
		 <div id="modalEditRequestSuccess-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Request's details successfully updated!</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
