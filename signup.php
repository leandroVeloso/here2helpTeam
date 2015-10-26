<?php
    include_once('pdo.inc'); // Includes pdo file
    redirectUser(!(verifyUserType(VOLUNTEER) || verifyUserType(APPLICANT) || verifyUserType(CUSTOMER) || verifyUserType(ADMIN)),"index.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head.inc'; // Includes head content?>
    </head>
    <body id="page-top" class="index">
        <?php include 'navigation.inc'; // Includes logo and menu ?>
        <!-- Signup Section -->
        <section id="signup">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        </br></br>
                        <h2>Sign up</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <form action="PHP_Process_Files/processSignup.php" onsubmit="return setHIddenAttributes()" method="POST" name="signup" id="signup">
                            <div class="row control-group">
                                <div class="form-group col-xs-12 label-form-group controls">
                                    <label>First name</label>
                                    <input type="text" maxlength="50" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['fname']; ?>" class="form-control" placeholder="First name" id="fname" name="fname" required data-validation-required-message="Please enter your first name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 label-form-group controls">
                                    <label>Last name</label>
                                    <input type="text" maxlength="50" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['lname']; ?>" class="form-control" placeholder="Last name" id="lname" name="lname" required data-validation-required-message="Please enter your last name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-4 label-form-group controls">
                                    <label>Unit number</label>
                                    <input type="number" min="0" step="1" maxlength="10" onkeypress="return isNumber(event)" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['unumber']; ?>" class="form-control" placeholder="Unit Number" id="unumber" name="unumber" required data-validation-required-message="Please enter your unit number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 label-form-group controls">
                                    <label>Street</label>
                                    <input type="text" maxlength="50" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['street']; ?>" class="form-control" placeholder="Street" id="street" name="street" required data-validation-required-message="Please enter your street name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 label-form-group controls">
                                    <label>Suburb</label>
                                    <input type="text" maxlength="50" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['suburb']; ?>" class="form-control" placeholder="Suburb" id="suburb" name="suburb" required data-validation-required-message="Please enter your suburb.">
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
                                            <option value="Western Australia">Western Australia</option>
                                      </select>
                                      <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-4 label-form-group controls">
                                    <label>Postcode</label>
                                    <input type="number" min="0" step="1" maxlength="4" onkeypress="return isNumber(event)" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['postcode']; ?>" class="form-control" placeholder="Postcode" id="postcode"name="postcode" required data-validation-required-message="Please enter your post code.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 label-form-group controls">
                                    <label>Phone Number</label>
                                    <input type="number" min="0" step="1" maxlength="11" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['pnumber']; ?>" class="form-control" placeholder="Phone Number" id="pnumber" name="pnumber" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 label-form-group controls" id ="emaildiv">
                                    <label>Email</label>
                                    <input type="email" maxlength="100" value="<?php if(isset($_SESSION['errors']) && $_SESSION['errors']) echo $_SESSION['userInputs']['email']; ?>" class="form-control" placeholder="Email" onblur="changeEmailStyle()" id="email" name="email" required data-validation-required-message="Please enter your Email.">
                                    <p class="help-block text-danger" id= "errorSpan"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-8 label-form-group controls" id ="divpass">
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password" id="password" maxlength="10" name="password" onblur="checkPassword()"onblur="checkPassword()" required data-validation-required-message="Please enter your password.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-8 label-form-group controls" id ="divconpass">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm Password" onblur="checkPassword()" maxlength="10" id="conpassword" name="conpassword" required data-validation-required-message="Please re-enter your password.">
                                    <p class="help-block text-danger" id= "passwordError"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-8 label-form-group controls" id ="divconpass">
                                     <label>Are you a volunteer?</label>
                                     <input type="checkbox" name="volunteer" id="volunteer" value="checked">
                                    <p class="help-block text-danger" id= "passwordError"></p>
                                </div>
                            </div>
                            <input type="hidden" name="typeID" id="typeID" value="1">
                            <input type="hidden" name="zone" id="zone" value="">
                            <br>
                            <button type="submit" value=" submit" class="btn btn-success btn-lg" id="submit"> Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div id="modalEmail-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Email is already in use. Please choose another.</h4>
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
                        <h4 class="modal-title">Something went wrong. Please try again.</h4>
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
        <script>
            document.getElementById('volunteer').onchange = function() {
                document.getElementById("typeID").value = this.checked ? 4 : 1;
            };
        </script>
    </body>

</html>
<?php
    if(isset($_SESSION['errors']) && $_SESSION['errors']){
        $_SESSION['errors'] = false;
        unset($_SESSION['errors']);
        unset($_SESSION['userInputs']);
    }
?>
