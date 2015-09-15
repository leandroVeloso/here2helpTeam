<?php   
    // Includes pdo file 
    include_once($_SERVER['DOCUMENT_ROOT'] .'Inc_files/pdo.inc');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
            // Includes head content
            include $_SERVER['DOCUMENT_ROOT'] .'Inc_files/head.inc';
    ?>
</head>

<body id="page-top" class="index">

    <?php 
            // Includes logo and menu
            include $_SERVER['DOCUMENT_ROOT'] .'Inc_files/navigation.inc';
    ?>
    
    <!-- Signup Section -->
    <section id="signup">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    </br>
                    </br>

                    <h2>Sign up</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form action="PHP_Process_Files/processSignup.php" method="POST">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls">
                                <label>First name</label>
                                <input type="text" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['fname']; ?>" class="form-control" placeholder="First name" id="fname" name="fname" required data-validation-required-message="Please enter your first name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls">
                                <label>Last name</label>
                                <input type="text" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['lname']; ?>" class="form-control" placeholder="Last name" id="lname" name="lname" required data-validation-required-message="Please enter your last name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-4 label-form-group controls">
                                <label>Unit number</label>
                                <input type="text"  onkeypress="return isNumber(event)" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['unumber']; ?>" class="form-control" placeholder="Unit Number" id="unumber" name="unumber" required data-validation-required-message="Please enter your unit number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls">
                                <label>Street</label>
                                <input type="text" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['street']; ?>" class="form-control" placeholder="Street" id="street" name="street" required data-validation-required-message="Please enter your street name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls">
                                <label>Suburb</label>
                                <input type="text" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['suburb']; ?>" class="form-control" placeholder="Suburb" id="suburb" name="suburb" required data-validation-required-message="Please enter your suburb.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-4 label-form-group controls">
                                <label>State</label>
                                  <select class="form-control" id="state" name="state" required>
                                    <option selected value="Queensland">Queensland</option>
                                    <option value="New South Wales">New South Wales</option>
                                    <option value="South Australia">South Australia</option>
                                    <option value="Tasmania">Tasmania</option>
                                    <option value="Victoria">Victoria </option>
                                    <option value="TWestern Australia">TWestern Australia</option>
                                  </select>
                                  <p class="help-block text-danger"></p>
                            </div>

                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-4 label-form-group controls">
                                <label>Postcode</label>
                                <input type="text" onkeypress="return isNumber(event)" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['postcode']; ?>" class="form-control" placeholder="Postcode" id="postcode"name="postcode" required data-validation-required-message="Please enter your post code.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls">
                                <label>Phone Number</label>
                                <input type="number" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['pnumber']; ?>" class="form-control" placeholder="Phone Number" id="pnumber" name="pnumber" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls" id ="emaildiv">
                                <label>Email</label>
                                <input type="email" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['email']; ?>" class="form-control" placeholder="Email" onblur="changeEmailStyle()" id="email" name="email" required data-validation-required-message="Please enter your Email.">
                                <p class="help-block text-danger" id= "emailError"></p>
                            </div>
                        </div>
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
                            <button type="submit" value=" Submit" class="btn btn-success btn-lg" id="submit"> Submit</button>

                    </form>
                </div>
            </div>

            <div id="modal-content" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">E-mail is already in use. Please try another!</h4>
                        </div>
                        <div class="modal-footer"> 
                            <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modalSignIn-content" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Something went wrong! Please, try again!</h4>
                        </div>
                        <div class="modal-footer"> 
                            <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>

    </section>

    <?php 
            // Includes logo and menu
            include $_SERVER['DOCUMENT_ROOT'] .'Inc_files/footer.inc';
            // Includes Javascript files
            include $_SERVER['DOCUMENT_ROOT'] .'Inc_files/javascripts.inc';
    ?>

</body>

</html>
<?php
    if(isset($_SESSION['errors']) && $_SESSION['errors']){
        $_SESSION['errors'] = false;
        unset($_SESSION['errors']);
        unset($_SESSION['userInputs']);
    }
?>
