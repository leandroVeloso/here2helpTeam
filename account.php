<?php
    // Includes pdo file
    include_once('pdo.inc');
    include_once('PHP_Process_Files/processViewAccount.php');
    verifyIfUserIsSignedIn();
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

    <section id="manageAccount">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    </br>
                    </br>

                    <h2>My Account</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 label-form-group controls">
                            <label>First name</label>
                            <input type="text" disabled value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['firstName']; ?>" class="form-control" placeholder="First name" id="fname" name="fname" required data-validation-required-message="Please enter your first name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 label-form-group controls">
                            <label>Last name</label>
                            <input type="text" disabled value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['lastName']; ?>" class="form-control" placeholder="Last name" id="lname" name="lname" required data-validation-required-message="Please enter your last name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-4 label-form-group controls">
                            <label>Unit number</label>
                            <input type="text" disabled onkeypress="return isNumber(event)" value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['unitNumber']; ?>" class="form-control" placeholder="Unit Number" id="unumber" name="unumber" required data-validation-required-message="Please enter your unit number.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 label-form-group controls">
                            <label>Street</label>
                            <input type="text" disabled value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['street']; ?>" class="form-control" placeholder="Street" id="street" name="street" required data-validation-required-message="Please enter your street name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 label-form-group controls">
                            <label>Suburb</label>
                            <input type="text" disabled value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['suburb']; ?>" class="form-control" placeholder="Suburb" id="suburb" name="suburb" required data-validation-required-message="Please enter your suburb.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-4 label-form-group controls">
                            <label>State</label>
                             <input type="text" disabled value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['state']; ?>" class="form-control" placeholder="Suburb" id="suburb" name="suburb" required data-validation-required-message="Please enter your suburb.">
                            <p class="help-block text-danger"></p>
                        </div>

                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-4 label-form-group controls">
                            <label>Postcode</label>
                            <input type="text" disabled onkeypress="return isNumber(event)" value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['postcode']; ?>" class="form-control" placeholder="Postcode" id="postcode"name="postcode" required data-validation-required-message="Please enter your postcode.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 label-form-group controls">
                            <label>Phone Number</label>
                            <input type="number" disabled value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['phoneNo']; ?>" class="form-control" placeholder="Phone Number" id="pnumber" name="pnumber" required data-validation-required-message="Please enter your phone number.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 label-form-group controls" id ="emaildiv">
                            <label>Email</label>
                            <input type="email" disabled value="<?php if(isset($_SESSION['userAccountInfo']) && $_SESSION['userAccountInfo']) echo $_SESSION['userAccountInfo']['email']; ?>" class="form-control" placeholder="Email" onblur="changeEmailStyle()" id="email" name="email" required data-validation-required-message="Please enter your email.">
                            <p class="help-block text-danger" id= "errorSpan"></p>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div style="display:inline-block;">
                            <a href="editAccount.php">
                                <button type="button" value="Edit" class="btn btn-info btn-lg" id="edit">Edit Account</button>
                            </a>
                        </div>

                        <div style="display:inline-block;" data-toggle="modal" data-target="#confirmDeleteModal">
                            <button type="button" value="Delete" class="btn btn-danger btn-lg" id="delete">Delete Account</button>
                        </div>
                        <a href="changePassword.php">
                            <button type="button" value="ChangePassword" class="btn btn-success btn-lg" id="delete">Change Password</button>
                        </a>

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

    <div id="confirmDeleteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">ATTENTION!</h4>
                </div>
                <div class="modal-body">
                <p>You're about to delete your account and all of your requests.</p>
                <p>Are you sure you want to delete your account?</p>
                <br>
                <p>You won't be able to recover it later.</p>
              </div>
              <div class="modal-footer">
                <form action="PHP_Process_Files/processDeleteAccount.php" method="POST">
                    <button type="submit" class="btn btn-danger" value="yes">YES, I WANT TO DELETE MY ACCOUNT</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">NO</button>
                </form>
              </div>
            </div>
        </div>
    </div>

</body>

</html>
