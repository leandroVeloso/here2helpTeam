<?php  // Includes pdo file
    include_once('pdo.inc');
    redirectUser(verifyUserType(VOLUNTEER),"index.php");
    include_once('PHP_Process_Files/processViewQuotes.php');
    include_once('PHP_Process_Files/processRequestDetails.php');
    include_once('PHP_Process_Files/processSelectAvailableRequests.php');
    verifyIfUserIsSignedIn();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.inc'; ?>
    <link href="css/bootstrap-datepicker3.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.css">
  </head>

  <body id="page-top" class="index">
    <?php include 'navigation.inc' ; // Includes logo and menu ?>

    <section id="workOnRequest">

      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            </br></br>
            <h2>Request Details</h2>
            <hr class="star-primary">            
        </div>
      </div>


      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <?php
                if($request['statusID'] == OPEN)
                    echo "<img class='img-responsive' src='img/status_img/waiting_volunteer_open.png' alt='' style='width: 100%; height: 100%'>";
                if($request['statusID'] == CLOSED)
                    echo "<img class='img-responsive' src='img/status_img/booked_closed.png' alt='' style='width: 100%; height: 100%'>";
                if($request['statusID'] == WAITING_APROVAL)
                    echo "<img class='img-responsive' src='img/status_img/waiting_approval.png' alt='' style='width: 100%; height: 100%'>";
                if($request['statusID'] == IN_PROGRESS)
                    echo "<img class='img-responsive' src='img/status_img/waiting_quotes_inprogress.png' alt='' style='width: 100%; height: 100%'>";
                if($request['statusID'] == CANCELLED)
                    echo "<img class='img-responsive' src='img/status_img/cancelled.png' alt='' style='width: 100%; height: 100%'>";
                if($request['statusID'] == WAITING_BOOKING)
                    echo "<img class='img-responsive' src='img/status_img/waiting_booking_conf.png' alt='' style='width: 100%; height: 100%'>";
            ?>
          </div>
     </div>


      <div class="container">
        <div class="row">
          <div class="col-lg-4 text-center">
            <h3>Client</h3>
          </div>
        </div>
      </div>

      <!-- Create table to view client's details -->
      <div class="row">
        <div class="col-lg-6 col-lg-offset-3">

          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <tr>
              <th class="col-md-3">ID</th>
              <td class="col-md-8"><?php echo $request['clientID']; ?></td>
            </tr>
            <tr>
              <th>Name</th>
              <td><?php echo $request['firstName']; ?> <?php echo $request['lastName']; ?></td>
            </tr>
          </table>
        </div>
      </div>

        <div class="container">
          <div class="row">
            <div class="col-lg-4 text-center">
              <h3>Request</h3>
            </div>
          </div>
        </div>

      <!-- Create table to view request's details -->
      <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
              <tr>
                <th class="col-md-3">ID</th>
                <td class="col-md-8"><?php echo $request['requestID']; ?></td>
              </tr>
              <tr>
                <th>Request</th>
                <td><?php echo $request['requestName']; ?></td>
              </tr>
              <tr>
                <th>Date Range</th>
                <td><?php echo date('d  M  Y', strtotime($request['startDate'])); ?> - <?php echo date('d  M  Y', strtotime($request['endDate']));?></td>
              </tr>
              <tr>
                <th>Time Range</th>
                <td><?php echo date('g:i a', strtotime($request['startTime'])); ?> - <?php echo date('g:i a', strtotime($request['endTime'])); ?></td>
              </tr>
              <tr>
                <th>Price Range</th>
                <td>$<?php echo $request['minPrice']; ?> - $<?php echo $request['maxPrice']; ?></td>
              </tr>
              <tr>
                <th class="col-md-3">Description</th>
                <td class="col-md-8"><?php echo $request['comment']; ?></td>
              </tr>
              <tr>
                <th>Priority</th>
                <td><?php echo $request['priority']; ?></td>
              </tr>
              <tr>
                <th class="col-md-3">Location</th>
                <td class="col-md-8"><?php echo $request['unitNumber']; ?> <?php echo $request['street']; ?>, <?php echo $request['suburb']; ?>, <?php echo $request['state']; ?> <?php echo $request['postcode']; ?></td>
              </tr>
              <tr>
                <th>Status</th>
                <td><?php echo $request['status']; ?></td>
              </tr>
              <tr>
                <th>Creation Date</th>
                <td><?php echo date('d-M-Y H:i:s', strtotime($request['creationDate'])); ?></td>
              </tr>
              <tr>
                <th>Last Modified</th>
                <td><?php echo date('d-M-Y H:i:s', strtotime($request['lastModified'])); ?></td>
              </tr>
            </table>
          </div>
        </div>
        <?php
          if(isset($quotes) && $quotes != null){ 
          
        ?>
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <hr>
              <h3>QUOTES</h3>

              <hr>

              <?php 
              // Print quotes information
                foreach ($quotes as $aQuote) {
                  if(($request['statusID'] == WAITING_BOOKING && $aQuote['approved'] == 1) || $request['statusID'] == WAITING_APROVAL || ($request['statusID'] == CLOSED && $aQuote['approved'] == 1)){
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
                  <?php if($aQuote['approved'] == 1){ ?>
                      <tr><th>User Booking Comment:</th>
                    <td><?php echo $aQuote['clientComment']; ?></td></tr>
                      <?php } 
                      if($aQuote['approved'] == 1 && $request['statusID'] == CLOSED){ ?>
                                      <tr><th>Volunteer Booking Comment:</th>
                                    <td><?php echo $aQuote['volunteerComment']; ?></td></tr>
                                      <?php } ?>
                  <tr>
                    <form action="PHP_Process_Files/processQuote.php" method="POST">
                      <input type="hidden" name="action" id="action" value="Remove">
                      <input type="hidden" name="quoteID" id="quoteID" value="<?php echo $aQuote['quoteID']; ?>">
                      <input type="hidden" name="requestID" id="requestID" value="<?php echo $_GET['request']; ?>">
                      <?php if($request['statusID'] == IN_PROGRESS){ ?>
                      <td colspan="2"><button type="submit" class="btn btn-danger">Remove Quote</button></td>
                      <?php } ?>
                    </form>
                  </tr>
                </table>
              </div>
            </div>
            <hr>
         <?php }}echo "</div></div>";} ?>
            </div>
          </div>
        </div>
        <div class="row">
                  <div class="col-lg-6 col-lg-offset-3">
        <?php if($request['statusID'] == IN_PROGRESS){ ?>
        <div class="container">
        <div class="row">
          <div class="col-lg-4 text-center">
            <h5>Add Quote</h5>
          </div>
        </div>
      </div>
            <div class="row">
              <div class="col-lg-6 col-lg-offset-2">
                  <form action="PHP_Process_Files/processQuote.php" onsubmit="return validateRequestDetails()" method="POST">
                      <div class="row control-group">
                          <div class="form-group col-xs-12 label-form-group controls">
                              <label>Description</label>
                                    <textarea class="form-control" id="description" rows="4" placeholder="Describe details of the quote" name="description" required data-validation-required-message="Please enter a description for your quote"></textarea>
                              <p class="help-block text-danger"></p>
                          </div>
                      </div>
                <div class="row control-group">
                    <div class="form-group col-xs-6 label-form-group controls">
                        <label>Minimum Quote Price</label>
                        <input type="number" min="0" step="0.01" maxlength="10" onkeypress="return isNumber(event)" class="form-control" placeholder="Minimum Quote Price" id="minPrice" name="minPrice" required data-validation-required-message="Please enter minimum quote price">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <!-- Creates field for user to enter maximum amount they will pay for service -->
                <div class="row control-group">
                    <div class="form-group col-xs-6 label-form-group controls">
                        <label>Maximum Quote Price</label>
                        <input type="number" min="0" step="0.01" maxlength="10" onkeypress="return isNumber(event)" class="form-control" placeholder="Maximum Quote Price" id="maxPrice" name="maxPrice" required data-validation-required-message="Please enter maximum quote price">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <!-- Creates field for user to enter range of dates they would like the service provider to perform the service.-->
                <div class="row control-group">
                    <div class="control col-xs-12">
                        <label>Date</label>
                        <br>
                        Specify the <b>days</b> the service provider can work on the request.
                    </div>
                    <div class="control col-xs-6">
                        <div class="input-group">
                            <input id="startDate" type="text" placeholder="Start Date" required value="" style="background-color:White;" name="startDate" class="date-picker form-control" />
                            <label for="startDate" class="input-group-addon btn">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </label>
                        </div>

                        <!-- Creates field for user to enter range of times they would like the service provider to perform the service.-->
                        <div class="input-group">
                            <input id="endDate" type="text" placeholder="End Date" required value="" style="background-color:White;" name="endDate" class="date-picker form-control" />
                            <label for="endDate" class="input-group-addon btn">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </label>
                        </div>
                    </div>
                    <div class="control col-xs-12">
                        <label>Time</label>
                        <br>
                        Specify the <b>times</b> the service provider can work on the request.
                    </div>
                    <div class="control col-xs-6">
                        <div class="input-group">
                            <input type="text" step='1' readonly min="00:00" max="24:00" value=""  name="startTime" id="startTime" class="form-control clockpicker" style="background-color:White;" required placeholder="Start Time">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                        <div class="input-group">
                            <input type="text" step='1' readonly min="00:00" max="24:00" value=""  name="endTime" id="endTime" class="form-control clockpicker" style="background-color:White;" required placeholder="End Time ">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                </div><br>
              </div>
              </div>
              </div>
              <br>
            <div class="container">
          <div class="row">
            <div class="col-lg-6 text-center">
              <input type="hidden" name="action" id="action" value="Add">
              <input type="hidden" name="requestID" id="requestID" value="<?php echo $_GET['request']; ?>">
              <button type="submit" class="btn btn-success btn-lg" id="addQuote" name="addQuote" value="<?php echo $_GET['request']; ?>">Add Quote</button>
            </form>
            </div>
          </div>
          <hr><br>
          <?php if(isset($quotes) && $quotes != null){?>
          <div class="row">
            <div class="col-lg-12 text-center">
              <form action="PHP_Process_Files/processWorkOnRequest.php" onsubmit="return validateRequestDetails()" method="POST">
              <input type="hidden" name="action" id="action" value="RequestApproval">
              <input type="hidden" name="requestID" id="requestID" value="<?php echo $_GET['request']; ?>">
              <button type="submit" class="btn btn-info btn-lg" >Send Quotes to Approval</button>
            </form>
            </div>
          </div>
          <?php } ?>
        </div>
        <?php
          }
              if($request['statusID'] == WAITING_BOOKING){
            ?>
              <div class="row">
                  <div class="col-lg-8 col-lg-offset-2">
                  <form action="PHP_Process_Files/processWorkOnRequest.php" method="POST">
                    <div class="row control-group">
                      <div class="form-group col-xs-12 label-form-group controls">
                          <label>Booking Information</label>
                          <input type="hidden" name="action" id="action" value="FinishBooking">
                          <input type="hidden" name="requestID" id="requestID" value="<?php echo $_GET['request']; ?>">
                          <textarea class="form-control" id="comment" <?php if($request['status'] == "Closed") echo "readonly"; ?> rows="4" placeholder="Describe details of the final booking information" name="requestDescription" required></textarea>
                          <p class="help-block text-danger"></p>
                      </div>
                    </div>
                  </div>
              </div>
        <!-- Start button assigns volunteer to request-->
        <div class="row">
          <div class="col-lg-12 col-lg-offset-3">
            <div style="display:inline-block;">
                  <button type="submit" class="btn btn-success btn-lg" id="startBtn" name="requestID" value="<?php echo $_GET['request']; ?>">Send Final Booking Information</button>
              </form>
            </div>
          </div>
        </div>
        <?php
          }
          ?>

          </div>
        </div>

      </section>

      <?php
        // Includes logo and menu
        include 'footer.inc';
        // Includes Javascript files
        include 'javascripts.inc';
      ?>
      <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/bootstrap-clockpicker.js"></script>
        <script>
            $('#startDate').datepicker({});
            $('#endDate').datepicker({});
            $('.clockpicker').clockpicker({
                placement: 'top',
                align: 'left',
                donetext: 'Done'
            });
        </script>
  </body>
</html>
