<?php include_once('pdo.inc'); // Includes pdo file?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head.inc'; // Includes head content ?>
    </head>

    <body id="page-top" class="index">
        <?php include 'navigation.inc'; // Includes logo and menu?>

        <!-- Signin Section -->
        <section id="signin">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        </br></br>
                        <h2>Sign in</h2>
                        <hr class="star-primary">
                    </div>
                </div>

              <!-- Email -->
              <div class="row">
                  <div class="col-lg-8 col-lg-offset-2">
                      <form action="PHP_Process_Files/processSignin.php" method="POST">
                          <div class="row control-group">
                              <p class="help-block text-danger" id= "errorSpan"></p>
                              <div class="form-group col-xs-8 floating-label-form-group controls" id="emaildiv" >
                                  <label>Email</label>
                                  <input type="email" class="form-control" onblur="changeEmailStyle()" maxlength="200" placeholder="Email" id="email"name="email" required data-validation-required-message="Please enter your email.">
                                  <p class="help-block text-danger"></p>
                              </div>
                          </div>

                            <!-- Password -->
                            <div class="row control-group">
                                <div class="form-group col-xs-8 floating-label-form-group controls" id="passworddiv" >
                                    <label>Password</label>
                                    <input type="password" class="form-control" onblur="changePasswordStyle()" maxlength="10" placeholder="Password" id="password"name="password" required data-validation-required-message="Please enter your password.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>

                            <!-- Recover Password Link -->
                            <div class="row control-group">
                                <label><a href="recoverPassword.php">I forgot my Password</a></label>
                            </div>

                            <br>

                            <!-- Submit and Sign up buttons -->
                            <button type="submit" value=" Submit" class="btn btn-success btn-lg" id="submit"> Submit</button>
                            <a href="signup.php">
                                <button type="button" value=" Signup" class="btn btn-warning btn-lg" id="signup"> Sign up</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Account successfully created popup -->
        <div id="modalSignUp-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Your account was successfully created!<br> Please sign in to access it.</h4>
                      </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recovered Password popup -->
        <div id="modalRecoverSuccess-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Your password was successfully changed. <br>It was sent to your registered email.</h4>
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
