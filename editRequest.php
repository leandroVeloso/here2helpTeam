<?php   
    // Includes pdo file 
    include_once('pdo.inc');
    include_once('PHP_Process_Files/processViewRequest.php');
    include_once('PHP_Process_Files/processSelect.php');
    include_once('PHP_Process_Files/processViewAccount.php');
    verifyIfUserIsSignedIn();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.inc';  // Includes head content ?>
        <link href="css/bootstrap-datepicker3.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.css">
    </head>

    <body id="page-top" class="index">
        <?php include 'navigation.inc'; // Includes logo and menu?>
        <section id="createRequest">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        </br></br>
                        <h2>Edit Help Request <?php echo $myRequest['requestID'];?></h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <form action="PHP_Process_Files/processEditRequest.php" method="POST">
                            <h4>WHAT</h4>
                            <hr>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 label-form-group controls">
                                    <label>Subject</label>
                                    <input type="text" class="form-control"  value="<?php echo $myRequest['requestName'];?>" placeholder="Help Request Subject" id="requestName" name="requestName" required data-validation-required-message="Please enter help request's subject">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-8 label-form-group controls">
                                    <label>Service Category</label>
                                    <select class="form-control" id="serviceID"  name="serviceID" required>
                                        <?php
                                           foreach($services as $service){
                                                if($myRequest['serviceID'] == $service['serviceID'])
                                                    $selected = "selected";
                                                else
                                                    $selected = "";
                                               echo "<option value='".$service['serviceID']."'".$selected.">".$service['service']."</option>";
                                            }
                                        ?>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-8 label-form-group controls">
                                    <label>Service Priority</label>
                                    <select class="form-control" id="priorityID"  name="priorityID" required>
                                        <?php                                      
                                            foreach($priorities as $priority){
                                                if($myRequest['priorityID'] == $priority['priorityID'])
                                                    $selected = "selected";
                                                else
                                                        $selected = "";
                                                echo "<option value='".$priority['priorityID']."'".$selected.">".$priority['priority']."</option>";
                                            }
                                        ?>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 label-form-group controls">
                                    <label>Description</label>
                                    <textarea class="form-control" id="comment" rows="4"  placeholder="Describe details of your request" name="requestDescription" required data-validation-required-message="Please enter a description for your request"><?php echo $myRequest['comment'];?></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-4 label-form-group controls">
                                    <label>Minimum Quote Price</label>
                                    <input type="number" min="0" step="0.01" maxlength="10"  onkeypress="return isNumber(event)" value='<?php echo $myRequest['minPrice'];?>' class="form-control" placeholder="Minimum Quote Price" id="minPrice" name="minPrice" required data-validation-required-message="Please enter minimum quote price">
                                    <p id="priceError" class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-4 label-form-group controls">
                                    <label>Maximum Quote Price</label>
                                    <input type="number" min="0" step="0.01" maxlength="10"  onkeypress="return isNumber(event)" value='<?php echo $myRequest['maxPrice'];?>' class="form-control" placeholder="Maximum Quote Price" id="maxPrice" name="maxPrice" required data-validation-required-message="Please enter maximum quote price">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <h4 >WHEN</h4>
                            <hr>
                            <div class="row control-group">
                                <div class="control col-xs-12">
                                    <label>Date</label>
                                    <br>
                                    Define here the date period that the service can be executed
                                </div> 
                                <div class="control col-xs-4">
                                    <div class="input-group">
                                        <input id="startDate" type="text"   placeholder="Start Date" value="<?php echo date("d-m-Y", strtotime($myRequest['startDate']));?>" required  name="startDate" class="date-picker form-control" />
                                        <label  for="startDate" class="input-group-addon btn">
                                            <span id="dateError" class="glyphicon glyphicon-calendar"></span>
                                        </label>
                                    </div>
                                    <div class="input-group">
                                        <input id="endDate" type="text"  placeholder="End Date" required value="<?php echo date("d-m-Y", strtotime($myRequest['endDate']));?>" name="endDate" class="date-picker form-control" />
                                        <label for="endDate" class="input-group-addon btn">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="control col-xs-12">
                                    <label>Time</label>
                                    <br>
                                    Define here the time period that the service can be executed
                                </div> 
                                <div class="control col-xs-4">
                                    <div class="input-group">
                                        <input type="time" step='1' min="00:00:00" max="24:00:00"  value="<?php echo $myRequest['startTime'];?>" name="startTime" id="startTime" class="form-control clockpicker" required placeholder="Start Time">
                                        <span class="input-group-addon">
                                            <span id="timeError" class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                    <div class="input-group">
                                        <input type="time" step='1' min="00:00:00" max="24:00:00"  value="<?php echo $myRequest['endTime'];?>" name="endTime" id="endTime" class="form-control clockpicker" required placeholder="End Time ">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div> 
                            <br><br>
                            <h4 >WHERE</h4>
                            <hr>
                            <div class="checkbox">
                                <label><input type="checkbox" value="yes" name="addressCheckBox" <?php if($myRequest['locationID'] == $myRequest['addressID']) echo "checked ";?> id="addressCheckBox">Use my account address</label>
                            </div>
                            <div id="adressForm" <?php if($myRequest['locationID'] == $myRequest['addressID']) echo 'style="display: none;"';?>>
                                <div class="row control-group">
                                    <div class="form-group col-xs-4 label-form-group controls">
                                        <label>Unit number</label>
                                        <input type="text" maxlength="10" required onkeypress="return isNumber(event)"value='<?php echo $myRequest['unitNumber'];?>'   class="form-control" placeholder="Unit Number" id="unumber" name="unumber" data-validation-required-message="Please enter your unit number.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 label-form-group controls">
                                        <label>Street</label>
                                        <input type="text" class="form-control" required  maxlength="50" placeholder="Street" value='<?php echo $myRequest['street'];?>'   id="street" name="street" data-validation-required-message="Please enter your street name.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 label-form-group controls">
                                        <label>Suburb</label>
                                        <input type="text" class="form-control"  required maxlength="50" placeholder="Suburb" value='<?php echo $myRequest['suburb'];?>'  id="suburb" name="suburb" data-validation-required-message="Please enter your suburb.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row control-group">
                                    <div class="form-group col-xs-4 label-form-group controls">
                                        <label>State</label>
                                          <select class="form-control" id="state" required  name="state" >
                                                <option <?php if(isset($myRequest) && $myRequest['state'] == "Queensland")echo "selected"; ?> value="Queensland">Queensland</option>
                                                <option <?php if(isset($myRequest) && $myRequest['state'] == "New South Wales")echo "selected"; ?> value="New South Wales">New South Wales</option>
                                                <option <?php if(isset($myRequest) && $myRequest['state'] == "South Australia")echo "selected"; ?> value="South Australia">South Australia</option>
                                                <option <?php if(isset($myRequest) && $myRequest['state'] == "Tasmania")echo "selected"; ?> value="Tasmania">Tasmania</option>
                                                <option <?php if(isset($myRequest) && $myRequest['state'] == "Victoria")echo "selected"; ?> value="Victoria">Victoria </option>
                                                <option <?php if(isset($myRequest) && $myRequest['state'] == "Western Australia")echo "selected"; ?> value="Western Australia">Western Australia</option>
                                          </select>
                                          <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="row control-group">
                                    <div class="form-group col-xs-4 label-form-group controls">
                                        <label>Postcode</label>
                                        <input type="text" onkeypress="return isNumber(event)" required  maxlength="4" value='<?php echo $myRequest['postcode'];?>' class="form-control" placeholder="Postcode" id="postcode"name="postcode" data-validation-required-message="Please enter your post code.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div>
                                <button type="submit" class="btn btn-info btn-lg" value="<?php echo $myRequest['requestID'];?>" id="editID" name="editID">Save</button>
                                <a href='requests.php'
                                    <button type="button" class="btn btn-warning btn-lg" id="cancelBtn">Cancel</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div id="modalEditRequestSuccess-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Request's details successfully updated.</h4>
                    </div>
                    <div class="modal-footer"> 
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="modalEditRequestFail-content" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Something went wrong! Please, try again</h4>
                    </div>
                    <div class="modal-footer"> 
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
        <?php // Includes logo and menu
            include 'footer.inc';
            // Includes Javascript files
            include 'javascripts.inc';
        ?>
        <script src="js/bootstrap-datepicker.js"></script>
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
