<?php
    include_once('pdo.inc'); // Includes pdo file
    redirectUser((verifyUserType(VOLUNTEER)||verifyUserType(ADMIN)),"index.php");
    include_once('PHP_Process_Files/processListServiceProvide.php');
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
        <section id="serviceList">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        </br></br>
                        <h2>Service provider list</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <br>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Service provider list
                            </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-1">Service Provider ID</th>
                                                    <th class="col-md-6">Name</th>
                                                    <th class="col-md-2">Service type</th>
                                                    <th class="col-md-7">Address</th>
                                                    <th class="col-md-7">Website</th>
                                                    <th class="col-md-7">Phone</th>
                                                    <th class="col-md-7">Rating</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($serviceList as $service){
                                                       echo '<tr class="odd gradeX"><td>'.$service['serviceProviderID'].'</td><td>'.$service['name'].'</td><td>'.$service['serviceID'].'</td><td>'.$service['addressID'].'</td><td>'.$service['website'].'</td><td>'.$service['phoneNo'].'</td><td>'.$service['avgRating'].'</td></tr>';
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