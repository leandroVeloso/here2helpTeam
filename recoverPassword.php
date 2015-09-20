<?php
    include_once('pdo.inc'); // Includes pdo file
    verifyIfUserIsSignedIn();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head.inc';  // Includes head content ?>
    </head>
    <body id="page-top" class="index">
        <?php include 'navigation.inc'; // Includes logo and menu?>
        <!-- Recover Password Section -->
        <section id="signin">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        </br></br>
                        <h2>Recover Password</h2>
                        <h5>Please confirm the following information in order to recover your password:</h5>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <form action="PHP_Process_Files/processRecoverPassword.php" method="POST">
                            <div class="row control-group">
                                <p class="help-block text-danger" id="errorSpan"></p>
                                <div class="form-group col-xs-8 label-form-group controls" id="fnamediv">
                                    <label>First name</label>
                                    <input type="text" class="form-control" onblur="changeFirstNameStyle()" placeholder="First name" id="fname" name="fname" required data-validation-required-message="Please enter your first name.">
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-8 label-form-group controls" id="lnamediv">
                                    <label>Last name</label>
                                    <input type="text" class="form-control" onblur="changeLastNameStyle()" placeholder="Last name" id="lname" name="lname" required data-validation-required-message="Please enter your last name.">
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-8 label-form-group controls" id="emaildiv" >
                                    <label>Email</label>
                                    <input type="email" class="form-control" onblur="changeEmailStyle()" placeholder="Email" id="email"name="email" required data-validation-required-message="Please enter your email.">
                                </div>
                            </div>
                            <br>
                            <button type="submit" value=" Submit" class="btn btn-success btn-lg" id="submit"> Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div id="modalRecoverWarning-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Information doesn't match. Please try again.</h4>
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
