<?php
    include_once('pdo.inc'); // Includes pdo file
    redirectUser((verifyUserType(VOLUNTEER) || verifyUserType(ADMIN)),"index.php");
    include_once('PHP_Process_Files/processSelectAvailableRequests.php');
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
        <section id="availableRequests">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        </br></br>
                        <h2>New Requests</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <br>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Available Requests
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
                                                    <th class="col-md-2">Zone</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($availableRequests as $request){
                                                       echo '<tr class="odd gradeX"><td>'.$request['requestID'].'</td><td><a href="startRequest.php?request='.$request['requestID'].'">'.$request['requestName'].'</td><td>'.$request['priorityID'].'</td><td>'.date("d/m/Y", strtotime($request['startDate'])).'</td><td>'.$request['zone'].'</td><td>';
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
        <div id="modalFail-content" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-content">
            <div class="modal-dialog">
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
        <div id="modalDeleteRequestSuccess-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Your request was successfully deleted!</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="modalCreateRequestSuccess-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Your request was successfully created!</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- DataTables JavaScript -->
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                    responsive: true
            });
        });
        </script>
    </body>

</html>
