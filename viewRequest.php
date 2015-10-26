<?php
    // Includes pdo file
    include_once('pdo.inc');
    redirectUser((verifyUserType(VOLUNTEER) || verifyUserType(CUSTOMER) || verifyUserType(ADMIN)),"index.php");
    include_once('PHP_Process_Files/processViewQuotes.php');
    include_once('PHP_Process_Files/processViewRequest.php');
    include_once('PHP_Process_Files/processCheckForFeedback.php');
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
                        <h4>WHAT</h4>
                        <hr>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls">
                                <label>Subject</label>
                                <input type="text" class="form-control" disabled value="<?php echo $myRequest['requestName'];?>" placeholder="Help Request Subject" id="requestName" name="requestName" required data-validation-required-message="Please enter help request's subject">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-8 label-form-group controls">
                                <label>Service Category</label>
                                <select class="form-control" id="serviceID" disabled name="serviceID" required>
                                    <?php echo "<option value='".$myRequest['serviceID']."'>".$myRequest['service']."</option>";?>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-8 label-form-group controls">
                                <label>Service Priority</label>
                                <select class="form-control" id="priorityID" disabled name="priorityID" required>
                                    <?php echo "<option value='".$myRequest['priorityID']."'>".$myRequest['priority']."</option>"; ?>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls">
                                <label>Description</label>
                                <textarea class="form-control" id="comment" rows="4" disabled placeholder="Describe details of your request" name="requestDescription" required data-validation-required-message="Please enter a description for your request"><?php echo $myRequest['comment'];?></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-4 label-form-group controls">
                                <label>Minimum Quote Price</label>
                                <input type="number" min="0" step="1" maxlength="10" disabled onkeypress="return isNumber(event)" value='<?php echo $myRequest['minPrice'];?>' class="form-control" placeholder="Minimum Quote Price" id="minPrice" name="minPrice" required data-validation-required-message="Please enter minimum quote price">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-4 label-form-group controls">
                                <label>Maximum Quote Price</label>
                                <input type="number" min="0" step="1" maxlength="10" disabled onkeypress="return isNumber(event)" value='<?php echo $myRequest['maxPrice'];?>' class="form-control" placeholder="Maximum Quote Price" id="maxPrice" name="maxPrice" required data-validation-required-message="Please enter maximum quote price">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <h4 >WHEN</h4>
                        <hr>
                        <div class="row control-group">
                            <div class="control col-xs-12">
                                <label>Date</label>
                                <br>
                                Define here the date period that the service can be executed
                            </div>
                            <div class="control col-xs-4">
                                <div class="input-group">
                                    <input id="startDate" type="text" disabled  placeholder="Start Date" value="<?php echo  date("d-m-Y", strtotime($myRequest['startDate']));?>" required  name="startDate" class="date-picker form-control" />
                                    <label for="startDate" class="input-group-addon btn">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </label>
                                </div>
                                <div class="input-group">
                                    <input id="endDate" type="text" disabled placeholder="End Date" required value="<?php echo date("d-m-Y", strtotime($myRequest['endDate']));?>" name="endDate" class="date-picker form-control" />
                                    <label for="endDate" class="input-group-addon btn">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="control col-xs-12">
                                <label>Time</label>
                                <br>
                                Define here the time period that the service can be executed
                            </div>
                            <div class="control col-xs-4">
                                <div class="input-group">
                                    <input type="time" step='1' min="00:00:00" max="24:00:00" disabled value="<?php echo $myRequest['startTime'];?>" name="startTime" id="startTime" class="form-control clockpicker" required placeholder="Start Time">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                                <div class="input-group">
                                    <input type="time" step='1' min="00:00:00" max="24:00:00" disabled value="<?php echo $myRequest['endTime'];?>" name="endTime" id="endTime" class="form-control clockpicker" required placeholder="End Time ">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <h4 >WHERE</h4>
                        <hr>
                        <div id="adressForm">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="yes" onclick="return false" name="addressCheckBox" <?php if($myRequest['locationID'] == $myRequest['addressID']) echo "checked";?> id="addressCheckBox">Use my account address
                                </label>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-4 label-form-group controls">
                                    <label>Unit number</label>
                                    <input type="text" maxlength="10" onkeypress="return isNumber(event)"value='<?php echo $myRequest['unitNumber'];?>'  disabled class="form-control" placeholder="Unit Number" id="unumber" name="unumber" data-validation-required-message="Please enter your unit number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 label-form-group controls">
                                    <label>Street</label>
                                    <input type="text" class="form-control" maxlength="50" placeholder="Street" value='<?php echo $myRequest['street'];?>' disabled  id="street" name="street" data-validation-required-message="Please enter your street name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 label-form-group controls">
                                    <label>Suburb</label>
                                    <input type="text" class="form-control" maxlength="50" placeholder="Suburb" value='<?php echo $myRequest['suburb'];?>' disabled id="suburb" name="suburb" data-validation-required-message="Please enter your suburb.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-4 label-form-group controls">
                                    <label>State</label>
                                    <select class="form-control" id="state" disabled name="state" >
                                        <?php echo "<option value='".$myRequest['state']."'>".$myRequest['state']."</option>"; ?>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-4 label-form-group controls">
                                    <label>Postcode</label>
                                    <input type="text" onkeypress="return isNumber(event)" disabled maxlength="4" value='<?php echo $myRequest['postcode'];?>' class="form-control" placeholder="Postcode" id="postcode"name="postcode" data-validation-required-message="Please enter your post code.">
                                    <p class="help-block text-danger"></p>
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
                                    <?php if($aQuote['approved'] == 1){ ?>
                                  <tr><td colspan="2">APPROVED QUOTE</button></td></tr>
                                  <?php } ?>
                                  <tr>
                                    <th class="col-md-3">ID</th>
                                    <td class="col-md-8"><?php echo $aQuote['quoteID']; ?></td>
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
                         <?php } }?>

                         <?php if($myRequest['statusID'] == CLOSED && $feedback == NULL){ ?>
                            <span class="rating">
                                 <h3>Rate Your Service Provider</h3>
                            </span>
                            <hr>
                            <div class = "serviceRating">
                                <form action="PHP_Process_Files/processRating.php" method="POST" name="rate" id="rate">
                                    <input type="radio" id="rating" name="rating" value="1"/>  
                                    <input type="radio" id="rating" name="rating" value="2"/> 
                                    <input type="radio" id="rating" name="rating" value="3"/> 
                                    <input type="radio" id="rating" name="rating" value="4"/> 
                                    <input type="radio" id="rating" name="rating" value="5"/><br/>
                                    <input type="hidden" id="requestID" name="requestID" value = "<?php echo $myRequest['requestID']; ?>" />
                                    1||2||3||4||5
                                    <p><br /></p>
                                    <button type="submit" value="submit" class="btn btn-success btn-lg" id="rateBtn" name="rateBtn" >Submit Rating</button>

                                </form>
                            </div>
                             <hr>
                        <?php } ?>

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
