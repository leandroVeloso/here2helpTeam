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
    



    <?php 
            // Includes logo and menu
            include 'footer.inc';
            // Includes Javascript files
            include 'javascripts.inc';
    ?>

     <div id="modal-content" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">You have successfully signed in!</h4>
                  </div>
                <div class="modal-footer"> 
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
