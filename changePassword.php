<?php   
    // Includes pdo file 
    include_once('pdo.inc');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
            // Includes head content
            include 'head.inc';
    ?>
</head>

<body id="page-top" class="index">

    <?php 
            // Includes logo and menu
            include 'navigation.inc';
    ?>
    
    <section id="changePassword">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    </br>
                    </br>

                    <h2>Change password</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                <form action="PHP_Process_Files/processChangePassword.php" method="POST">
                     <div class="row control-group">
                            <div class="form-group col-xs-8 label-form-group controls" id ="divpass">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" id="password" name="password" onblur="checkPassword()"onblur="checkPassword()" required data-validation-required-message="Please enter your password.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-8 label-form-group controls" id ="divconpass">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm Password" onblur="checkPassword()" id="conpassword" name="conpassword" required data-validation-required-message="Please re-enter your password.">
                                <p class="help-block text-danger" id= "passwordError"></p>
                            </div>
                        </div>
                    
                    <br>
                    <button type="submit" value="Change Password" class="btn btn-success btn-lg" id="edit">Change Password</button>
                    <a href="account.php">
                        <button type="button" value="cancel" class="btn btn-warning btn-lg" id="delete">Cancel</button>
                    </a>
                </form>
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

    <div id="modalPassError-content" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Something went wrong! Please, try again.</h4>
                        </div>
                        <div class="modal-footer"> 
                            <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modalPassSuccess-content" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Your password was changed successfully!</h4>
                        </div>
                        <div class="modal-footer"> 
                            <a href="#" class="btn btn-primary" data-dismiss="modal" >Close</a>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>
