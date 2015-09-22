<?php   
    // Includes pdo file 
    include_once('pdo.inc');
    verifyIfUserIsSignedIn();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head.inc' // Includes head content;  ?>
    </head>
    <body id="page-top" class="index">
        <?php include 'navigation.inc' // Includes logo and menu; ?>
        <section id="manageAccount">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        </br></br>
                        <h2>Update My Account</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                    <form action="PHP_Process_Files/processEditAccount.php" method="POST">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls">
                                <label>First name</label>
                                <input type="text" maxlength="50" value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['firstName']; ?>" class="form-control" placeholder="First name" id="fname" name="fname" required data-validation-required-message="Please enter your first name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls">
                                <label>Last name</label>
                                <input type="text" maxlength="50" value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['lastName']; ?>" class="form-control" placeholder="Last name" id="lname" name="lname" required data-validation-required-message="Please enter your last name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-4 label-form-group controls">
                                <label>Unit number</label>
                                <input type="text" maxlength="10" onkeypress="return isNumber(event)" value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['unitNumber']; ?>" class="form-control" placeholder="Unit Number" id="unumber" name="unumber" required data-validation-required-message="Please enter your unit number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls">
                                <label>Street</label>
                                <input type="text" maxlength="50" value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['street']; ?>" class="form-control" placeholder="Street" id="street" name="street" required data-validation-required-message="Please enter your street name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls">
                                <label>Suburb</label>
                                <input type="text" maxlength="50" value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['suburb']; ?>" class="form-control" placeholder="Suburb" id="suburb" name="suburb" required data-validation-required-message="Please enter your suburb.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-4 label-form-group controls">
                                <label>State</label>
                                <select class="form-control" id="state" name="state" required>
                                    <option <?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']['state'] == "Queensland")echo "selected"; ?> value="Queensland">Queensland</option>
                                    <option <?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']['state'] == "New South Wales")echo "selected"; ?> value="New South Wales">New South Wales</option>
                                    <option <?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']['state'] == "South Australia")echo "selected"; ?> value="South Australia">South Australia</option>
                                    <option <?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']['state'] == "Tasmania")echo "selected"; ?> value="Tasmania">Tasmania</option>
                                    <option <?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']['state'] == "Victoria")echo "selected"; ?> value="Victoria">Victoria </option>
                                    <option <?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']['state'] == "Western Australia")echo "selected"; ?> value="Western Australia">Western Australia</option>
                                </select>
                                      <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-4 label-form-group controls">
                                <label>Postcode</label>
                                <input type="text" maxlength="4" onkeypress="return isNumber(event)" value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['postcode']; ?>" class="form-control" placeholder="Postcode" id="postcode"name="postcode" required data-validation-required-message="Please enter your post code.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls">
                                <label>Phone Number</label>
                                <input type="number" maxlength="11" value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['phoneNo']; ?>" class="form-control" placeholder="Phone Number" id="pnumber" name="pnumber" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 label-form-group controls" id ="emaildiv">
                                <label>Email</label>
                                <input type="email" maxlength="100" readonly="readonly" value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['email']; ?>" class="form-control" placeholder="Email" onblur="changeEmailStyle()" id="email" name="email" required data-validation-required-message="Please enter your Email.">
                                <p class="help-block text-danger" id= "errorSpan"></p>
                            </div>
                        </div>                    
                        <br>
                        <button type="submit" value="Update" class="btn btn-info btn-lg" id="edit">Save</button>
                        <a href="viewAccount.php">
                            <button type="button" value="cancel" class="btn btn-warning btn-lg" id="delete">Cancel</button>
                        </a>
                    </form>
                    </div>
                </div>
            </div>
        </section>
        <?php  // Includes logo and menu
            include 'footer.inc';
            // Includes Javascript files
            include 'javascripts.inc';
        ?>
        <div id="modalEmail-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Email is already in use, please choose another!</h4>
                    </div>
                    <div class="modal-footer"> 
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="modalEditAccountSuccess-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Account's details successfully updated.</h4>
                    </div>
                    <div class="modal-footer"> 
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="modalEditAccountFail-content" class="modal fade" tabindex="-1" role="dialog">
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
    </body>
</html>
