<?php  // Includes pdo file
    include_once('pdo.inc');
    verifyIfUserIsSignedIn();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.inc'; ?>
  </head>

  <body id="page-top" class="index">
    <?php include 'navigation.inc' ; // Includes logo and menu ?>




      <!-- Pop up: Help Request has been added to volunteers account. -->
      <div id="modalStartRequestSuccess-content" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Success! Help Request has been added to your account.</h4>
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
