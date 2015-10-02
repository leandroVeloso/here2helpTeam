<?php
    include_once('pdo.inc'); // Includes pdo file
    include_once('PHP_Process_Files/processSelectVolunteers.php');
    verifyIfUserIsSignedIn();
?>

<!DOCTYPE html>
<html lang="en">

  <head>
      <?php include 'head.inc'; // Includes head content ?>
      <!-- DataTables CSS -->
      <link href="css/dataTables.bootstrap.css" rel="stylesheet">
      <!-- DataTables Responsive CSS -->
      <link href="css/dataTables.responsive.css" rel="stylesheet">
  </head>

  <body id="page-top" class="index">
    <?php include 'navigation.inc';  // Includes logo and menu ?>
    <section id="volunteerRequests">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
              </br></br>
              <h2>Volunteer Accounts</h2>
              <hr class="star-primary">
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <br>
            <div class="panel panel-default">
              <div class="panel-heading">
                  All Volunteer Accounts
              </div>
                <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="dataTable_wrapper">
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                      <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-2">First Name</th>
                        <th class="col-md-2">Last Name</th>
                        <th class="col-md-2">Phone Number</th>
                        <th class="col-md-2">Suburb</th>
                        <th class="col-md-2">Last Modified</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                        foreach($volunteers as $volunteer){
                           echo '<tr class="odd gradeX">
                           <td>'.$volunteer['userID'].'</td>
                           <td>'.$volunteer['firstName'].'</td>
                           <td>'.$volunteer['lastName'].'</td>
                           <td>'.$volunteer['phoneNo'].'</td>
                           <td>'.$volunteer['suburb'].'</td>
                           <td>'.date("d/m/Y", strtotime($volunteer['lastModified'])).'</td>
                           </tr>';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php  // Includes logo and menu
        include 'footer.inc';
        // Includes Javascript files
        include 'javascripts.inc';
    ?>







  </body>

</html>
