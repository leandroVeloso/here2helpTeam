<?php
    if(isset($_SESSION['signin']) && $_SESSION['signin']){
?>
<?php include 'PHP_Process_Files/navigationNotifications.inc'; ?>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">here2help</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li>
                            <a href="viewAccount.php">My Account</a>
                        </li>

                        <?php
                            if($_SESSION['typeID'] == 1){
                        ?>
                            
                            <!-- Customer -->
                            <li>
                                <a href="listRequests.php">My Requests</a>
                            </li>
                            <li>
                                <a href="contact.php">Contact</a>
                            </li>
                        <?php
                            }
                        ?>

                         <?php
                            if($_SESSION['typeID'] == 2){
                        ?>
                            <!-- Volunteer -->
                            <li>
                                <a href="listUnassignedRequests.php"> New Requests (<?php echo $numRequests[0]; ?>) </a>
                            </li>
                            <li>
                                <a href="currentVolunteerJobs.php">My Jobs (<?php echo $numJobs[0]; ?>) </a>
                            </li>
                        <?php
                            }
                        ?>

                        <?php
                            if($_SESSION['typeID'] == 4){
                        ?>
                            <!-- Applicant -->
                            <li>
                                <a href="applicationStatus.php">Application Status</a>
                            </li>

                        <?php
                            }
                        ?>

                        <?php
                            if($_SESSION['typeID'] == 5){
                        ?>
                            <!-- Admin -->
                            <li>
                                <a href="viewVolunteer.php">Current Volunteers</a>
                            </li>
                            <li>
                                <a href="listVolunteers.php">Applications</a>
                            </li>

                        <?php
                            }
                        ?>

                        <li>
                            <a href="signout.php">Sign Out</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav>
<?php
    }else{
?>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">here2help</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li>
                            <a href="contact.php">Contact</a>
                        </li>
                        <li>
                            <a href="signin.php">Sign in</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav>
<?php
    }
?>