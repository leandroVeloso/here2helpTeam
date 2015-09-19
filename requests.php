<?php   
    // Includes pdo file
    include_once('pdo.inc');
    include_once('PHP_Process_Files/processSelectRequests.php');
    verifyIfUserIsSignedIn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
            // Includes head content
            include 'head.inc';
    ?>
    <!-- DataTables CSS -->
    <link href="css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="css/dataTables.responsive.css" rel="stylesheet">
</head>

<body id="page-top" class="index">

    <?php 
            // Includes logo and menu
            include 'navigation.inc';
    ?>

    <section id="myRequests">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    </br>
                    </br>

                    <h2>My Requests</h2>
                    <hr class="star-primary">
                </div>
            </div>

            <div class="col-lg-12">
                <a href="createRequest.php">
                    <button type="button" value="New Help Request" class="btn btn-info btn-lg" id="newHelpRe uest">New Help Request</button>
                </a>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            My HelpDesk Requests
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">ID</th>
                                            <th class="col-md-4">Subject</th>
                                            <th class="col-md-2">Status</th>
                                            <th class="col-md-2">Priority</th>
                                            <th class="col-md-2">Last Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($myRequest as $request){
                                               echo '<tr class="odd gradeX"><td>'.$request['requestID'].'</td><td><a href="viewRequest.php?request='.$request['requestID'].'">'.$request['requestName'].'</a></td><td>'.$request['status'].'</td><td>'.$request['priority'].'</td><td>'.date("Y-m-d h:i:sa", strtotime($request['creationDate'])).'</td></tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
    <div id="modalFail-content" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Something went wrong! Please, try again</h4>
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
                    <h4 class="modal-title">Your request was successfully deleted</h4>
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
                    <h4 class="modal-title">Your request was successfully created</h4>
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
