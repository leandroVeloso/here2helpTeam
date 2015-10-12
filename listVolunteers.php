<?php
    include_once('pdo.inc'); // Includes pdo file
    redirectUser(verifyUserType(ADMIN),"index.php");
    include_once('PHP_Process_Files/processSelectVolunteers.php');
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
                  Requests for Volunteer Accounts
              </div>
                <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="dataTable_wrapper">

                  <!-- Create table to view list requests for volunteer accounts -->
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                      <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-2">First Name</th>
                        <th class="col-md-2">Last Name</th>
                        <th class="col-md-3">Email</th>
                        <th class="col-md-2">Phone Number</th>
                        <th class="col-md-2">Suburb</th>
                        <th class="col-md-2">Last Modified</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                        foreach($newVolunteers as $newVolunteer){
                            echo '<tr class="odd gradeX">
                            <td>'.$newVolunteer['userID'].'</td>
                            <td><a href="viewVolunteer.php?userID='.$newVolunteer['userID'].'">'.$newVolunteer['firstName'].'</a></td>
                            <td>'.$newVolunteer['lastName'].'</td>
                            <td>'.$newVolunteer['email'].'</td>
                            <td>'.$newVolunteer['phoneNo'].'</td>
                            <td>'.$newVolunteer['suburb'].'</td>
                            <td>'.date("d/m/Y", strtotime($newVolunteer['lastModified'])).'</td>
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


        <div class="row">
          <div class="col-lg-12">
            <br>
            <div class="panel panel-default">
              <div class="panel-heading">
                  Volunteer Accounts
              </div>
                <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="dataTable_wrapper">

                  <!-- Create table to view list of ALL volunteers -->
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                      <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-2">First Name</th>
                        <th class="col-md-2">Last Name</th>
                        <th class="col-md-3">Email</th>
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
                            <td><a href="viewVolunteer.php?userID='.$volunteer['userID'].'">'.$volunteer['firstName'].'</a></td>
                            <td>'.$volunteer['lastName'].'</td>
                            <td>'.$volunteer['email'].'</td>
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

        <div id="modalError-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Something went wrong! Please try again.</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="modalApproveVolunteerSuccess-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Success! Volunteer account successfully created.</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="modalDenyVolunteerSuccess-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Success! User was denied volunteer status.</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="modalDeleteVolunteerSuccess-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Success! Volunteer account was deleted.</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
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
