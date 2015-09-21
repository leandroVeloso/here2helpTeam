<?php
    // Includes pdo file
    include_once('pdo.inc');
    include_once('PHP_Process_Files/processSelect.php');
    verifyIfUserIsSignedIn();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head.inc'; // Includes head content ?>
        <link href="css/bootstrap-datepicker3.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.css">
    </head>
    <body id="page-top" class="index">
        <?php include 'navigation.inc'; // Includes logo and menu ?>
        <section id="createRequest">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        </br></br>
                        <h2>Create Help Request</h2>
                        <hr class="star-primary">
                    </div>
                </div>

                <!-- Create Request Section -->
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <form action="PHP_Process_Files/processCreateRequest.php" method="POST">
                            <h4>WHAT</h4>
                            <hr>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 label-form-group controls">
                                    <label>Subject</label>
                                    <input type="text" class="form-control" placeholder="Help Request Subject" id="requestName" name="requestName" required data-validation-required-message="Please enter help request's subject">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>

                            <!-- Creates dropdown with lists of service categories -->
                            <div class="row control-group">
                                <div class="form-group col-xs-8 label-form-group controls">
                                    <label>Service Category</label>
                                    <select class="form-control" id="serviceID" name="serviceID" required>
                                        <?php
                                            foreach($services as $service)
                                               echo "<option value='".$service['serviceID']."'>".$service['service']."</option>";
                                        ?>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>

                              <!-- Creates dropdown with lists of priorities (High, Medium & Low) -->
                            <div class="row control-group">
                                <div class="form-group col-xs-8 label-form-group controls">
                                    <label>Service Priority</label>
                                    <select class="form-control" id="priorityID" name="priorityID" required>
                                        <?php
                                            foreach($priorities as $priority)
                                               echo "<option value='".$priority['priorityID']."'>".$priority['priority']."</option>";
                                        ?>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>

                            <!-- Creates text area for request description -->
                            <div class="row control-group">
                                <div class="form-group col-xs-12 label-form-group controls">
                                    <label>Description</label>
                                    <textarea class="form-control" id="comment" rows="4" placeholder="Describe details of your request" name="requestDescription" required data-validation-required-message="Please enter a description for your request"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>

                            <!-- Creates field for user to enter minimum amount they will pay for service -->
                            <div class="row control-group">
                                <div class="form-group col-xs-4 label-form-group controls">
                                    <label>Minimum Quote Price</label>
                                    <input type="number" min="0" step="0.01" maxlength="10" onkeypress="return isNumber(event)" class="form-control" placeholder="Minimum Quote Price" id="minPrice" name="minPrice" required data-validation-required-message="Please enter minimum quote price">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>

                            <!-- Creates field for user to enter maximum amount they will pay for service -->
                            <div class="row control-group">
                                <div class="form-group col-xs-4 label-form-group controls">
                                    <label>Maximum Quote Price</label>
                                    <input type="number" min="0" step="0.01" maxlength="10" onkeypress="return isNumber(event)" class="form-control" placeholder="Maximum Quote Price" id="maxPrice" name="maxPrice" required data-validation-required-message="Please enter maximum quote price">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>

                            <h4 >WHEN</h4>
                            <hr>

                            <!-- Creates field for user to enter range of dates they would like the service provider to perform the service.-->
                            <div class="row control-group">
                                <div class="control col-xs-12">
                                    <label>Date</label>
                                    <br>
                                    Specify the <b>days</b> you would like the service provider to handle the request.
                                </div>
                                <div class="control col-xs-4">
                                    <div class="input-group">
                                        <input id="startDate" type="text" placeholder="Start Date" required value="" name="startDate" class="date-picker form-control" />
                                        <label for="startDate" class="input-group-addon btn">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </label>
                                    </div>

                                    <!-- Creates field for user to enter range of times they would like the service provider to perform the service.-->
                                    <div class="input-group">
                                        <input id="endDate" type="text" placeholder="End Date" required value="" name="endDate" class="date-picker form-control" />
                                        <label for="endDate" class="input-group-addon btn">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="control col-xs-12">
                                    <label>Time</label>
                                    <br>
                                    Specify the <b>times</b> you would like the service provider to handle the request.
                                </div>
                                <div class="control col-xs-4">
                                    <div class="input-group">
                                        <input type="time" step='1' min="00:00:00" max="24:00:00" value=""  name="startTime" id="startTime" class="form-control clockpicker" required placeholder="Start Time">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                    <div class="input-group">
                                        <input type="time" step='1' min="00:00:00" max="24:00:00" value=""  name="endTime" id="endTime" class="form-control clockpicker" required placeholder="End Time ">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <br><br>
                            <h4 >WHERE</h4>
                            <hr>

                            <!-- Creates checkbox. If ticked users address will be used for request else the user is required to enter request location.-->
                            <div class="checkbox">
                                <label><input type="checkbox" value="yes" name="addressCheckBox" id="addressCheckBox">Use my account address</label>
                            </div>
                            <div id="adressForm">
                                <div class="row control-group">
                                    <div class="form-group col-xs-4 label-form-group controls">
                                        <label>Unit number</label>
                                        <input type="text" maxlength="10" required onkeypress="return isNumber(event)" class="form-control" placeholder="Unit Number" id="unumber" name="unumber" data-validation-required-message="Please enter your unit number.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>

                                <div class="row control-group">
                                    <div class="form-group col-xs-12 label-form-group controls">
                                        <label>Street</label>
                                        <input type="text" class="form-control" required maxlength="50" placeholder="Street" id="street" name="street" data-validation-required-message="Please enter your street name.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>

                                <div class="row control-group">
                                    <div class="form-group col-xs-12 label-form-group controls">
                                        <label>Suburb</label>
                                        <input type="text" class="form-control" required maxlength="50" placeholder="Suburb" id="suburb" name="suburb" data-validation-required-message="Please enter your suburb.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>

                                <div class="row control-group">
                                    <div class="form-group col-xs-4 label-form-group controls">
                                        <label>State</label>
                                          <select class="form-control" required id="state" name="state" >
                                                <option selected value="Queensland">Queensland</option>
                                                <option value="New South Wales">New South Wales</option>
                                                <option value="South Australia">South Australia</option>
                                                <option value="Tasmania">Tasmania</option>
                                                <option value="Victoria">Victoria </option>
                                                <option value="Western Australia">Western Australia</option>
                                                <option value="Northern Territory">Northern Territory</option>
                                                <option value="Australian Capital Territory">Australian Capital Territory</option>
                                          </select>
                                          <p class="help-block text-danger"></p>
                                    </div>
                                </div>

                                <div class="row control-group">
                                    <div class="form-group col-xs-4 label-form-group controls">
                                        <label>Postcode</label>
                                        <input type="text" onkeypress="return isNumber(event)"required  maxlength="4" class="form-control" placeholder="Postcode" id="postcode"name="postcode" data-validation-required-message="Please enter your post code.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <br><br>

                            <!-- Create Help Request button and Cancel button. Cancel will return user to my requests page. -->
                            <div>
                                <button type="submit" value="Create Help Request" class="btn btn-info btn-lg" id="createBtn">Create Help Request</button>
                                <a href="listRequests.php">
                                    <button type="button" value="cancel" class="btn btn-warning btn-lg" id="delete">Cancel</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <div id="modalFail-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Something went wrong! Please try again</h4>
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
        <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/bootstrap-clockpicker.js"></script>
        <script>
            $('#startDate').datepicker({});
            $('#endDate').datepicker({});
            $('.clockpicker').clockpicker({
                placement: 'top',
                align: 'left',
                donetext: 'Done'
            });
            var addressCheck = document.getElementById('adressForm');
            document.getElementById('addressCheckBox').onchange = function() {
                adressForm.style.display = this.checked ? 'none' : 'block';
                document.getElementById("unumber").required = false;
                document.getElementById("street").required = false;
                document.getElementById("suburb").required = false;
                document.getElementById("state").required = false;
                document.getElementById("postcode").required = false;
            };
        </script>
    </body>
</html>
