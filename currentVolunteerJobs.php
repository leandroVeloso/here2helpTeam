<?php  // Includes pdo file
    include_once('pdo.inc');
    include_once('PHP_Process_Files/processVolunteerJobRequests.php');
    verifyIfUserIsSignedIn();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.inc'; ?>
  </head>

  <body id="page-top" class="index">
    <?php include 'navigation.inc' ; // Includes logo and menu ?>
     <section id="myJobRequests">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        </br></br>
                        <h2>My Jobs</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <br>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Job Requests In Progress
                            </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-1">ID</th>
                                                    <th class="col-md-4">Subject</th>
                                                    <th class="col-md-2">Priority</th>
                                                    <th class="col-md-2">Date Created</th>
                                                    <th class="col-md-2">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($availableRequests as $request){
                                                       echo '<tr class="odd gradeX"><td>'.$request['requestID'].'</td><td><a href="workOnRequest.php?request='.$request['requestID'].'">'.$request['requestName'].'</td><td>'.$request['priority'].'</td><td>'.date("d/m/Y", strtotime($request['creationDate'])).'</td><td>'.$request['status'].'</td></tr>';
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



      <!-- Pop up: Help Request has been added to volunteers account. -->
      <div id="modalStartRequestSuccess-content" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Success! Help Request has been added to your account.</h4>
                  </div>
                  <div class="modal-footer">
                      <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
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
  </body>
</html>
