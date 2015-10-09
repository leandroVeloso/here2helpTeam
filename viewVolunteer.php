<?php  // Includes pdo file
    include_once('pdo.inc');
    include_once('PHP_Process_Files/processViewVolunteer.php');
    include_once('PHP_Process_Files/processSelectVolunteers.php');
    verifyIfUserIsSignedIn();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.inc'; ?>
  </head>

  <body id="page-top" class="index">
    <?php include 'navigation.inc' ; // Includes logo and menu ?>

    <section id="viewVolunteer">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            </br></br>
            <h2>Volunteer's Details</h2>
            <hr class="star-primary">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6 col-lg-offset-3">

          <!-- Create table to view volunteer's details -->
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <tr>
              <th class="col-md-3">ID</th>
              <td class="col-md-8"><?php echo $volunteer['userID']; ?></td>
            </tr>
            <tr>
              <th>First Name</th>
              <td><?php echo $volunteer['firstName']; ?></td>
            </tr>
            <tr>
              <th>Last Name</th>
              <td><?php echo $volunteer['lastName']; ?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><?php echo $volunteer['email']; ?></td>
            </tr>
            <tr>
              <th>Phone Number</th>
              <td><?php echo $volunteer['phoneNo']; ?></td>
            </tr>
            <tr>
              <th>Unit Number</th>
              <td><?php echo $volunteer['unitNumber']; ?></td>
            </tr>
            <tr>
              <th>Street</th>
              <td><?php echo $volunteer['street']; ?></td>
            </tr>
            <tr>
              <th>Suburb</th>
              <td><?php echo $volunteer['suburb']; ?></td>
            </tr>
            <tr>
              <th>State</th>
              <td><?php echo $volunteer['state']; ?></td>
            </tr>
            <tr>
              <th>Postcode</th>
              <td><?php echo $volunteer['postcode']; ?></td>
            </tr>
            <tr>
              <th>Last Modified</th>
              <td><?php echo $volunteer['lastModified']; ?></td>
            </tr>
          </table>

          <!-- If someone is requesting a volunteer account it will display approve/deny buttons, if they are a volunteer displays delete button-->
          <?php if ($volunteer['typeID'] == 4): ?>
            <div style="display:inline-block;">
              <form action = "PHP_Process_Files/processApproveVolunteer.php" method="GET">
                  <button type="submit" class="btn btn-success btn-lg" id="approveBtn" name="userID" value="<?php echo $_GET['userID']; ?>">Approve</button>
              </form>
            </div>
            <div style="display:inline-block;">
              <form action = "PHP_Process_Files/processDenyVolunteer.php" method="GET">
                  <button type="submit" class="btn btn-danger btn-lg" id="denyBtn" name="userID" value="<?php echo $_GET['userID']; ?>">Deny</button>
              </form>
            </div>
          <?php else: ?>
            <div style="display:inline-block;">
                  <form action = "PHP_Process_Files/processDeleteVolunteer.php" method="GET">
                  <button type="submit" class="btn btn-danger btn-lg" id="deleteBtn" name="userID" value="<?php echo $_GET['userID']; ?>">Delete</button>
                  </form>
            </div>
          <?php endif; ?>

          <!-- Cancel button returns user to List of Volunteers-->
          <div style="display:inline-block;">
            <a href='listVolunteers.php'>
                <button type="button" class="btn btn-warning btn-lg" id="cancelBtn">Cancel</button>
            </a>
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
