<?php  // Includes pdo file
    include_once('pdo.inc');
    redirectUser(verifyUserType(VOLUNTEER),"index.php");
    include_once('PHP_Process_Files/processRequestDetails.php');
    include_once('PHP_Process_Files/processSelectAvailableRequests.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.inc'; ?>
  </head>

  <body id="page-top" class="index">
    <?php include 'navigation.inc' ; // Includes logo and menu ?>

    <section id="startRequest">

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

        <!-- Start button assigns volunteer to request-->
        <div class="row">
          <div class="col-lg-6 col-lg-offset-3">
            <div style="display:inline-block;">
              <form action = "PHP_Process_Files/processStartRequest.php" method="GET">
                  <button type="submit" class="btn btn-success btn-lg" id="startBtn" name="requestID" value="<?php echo $_GET['request']; ?>">Start</button>
              </form>
            </div>

            <!-- Cancel button returns user to List of unassigned requests-->
            <div style="display:inline-block;">
              <a href='listUnassignedRequests.php'>
                  <button type="button" class="btn btn-warning btn-lg" id="cancelBtn">Cancel</button>
              </a>
            </div>
          </div>
        </div>
      </div>
      </section>

      <?php
        // Includes logo and menu
        include 'footer.inc';
        // Includes Javascript files
        include 'javascripts.inc';
      ?>
  </body>
</html>
