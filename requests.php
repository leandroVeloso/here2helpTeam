<?php   
    // Includes pdo file 
<<<<<<< HEAD
    include_once($_SERVER['DOCUMENT_ROOT'] .'Inc_files/pdo.inc');
=======
    include_once('pdo.inc');
>>>>>>> 386015224b93546ddc67dea88990955c718f15d5
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
            // Includes head content
<<<<<<< HEAD
            include $_SERVER['DOCUMENT_ROOT'] .'Inc_files/head.inc';
=======
            include 'head.inc';
>>>>>>> 386015224b93546ddc67dea88990955c718f15d5
    ?>
</head>

<body id="page-top" class="index">

    <?php 
            // Includes logo and menu
<<<<<<< HEAD
            include $_SERVER['DOCUMENT_ROOT'] .'Inc_files/navigation.inc';
=======
            include 'navigation.inc';
>>>>>>> 386015224b93546ddc67dea88990955c718f15d5
    ?>
    



    <?php 
            // Includes logo and menu
<<<<<<< HEAD
            include $_SERVER['DOCUMENT_ROOT'] .'Inc_files/footer.inc';
            // Includes Javascript files
            include $_SERVER['DOCUMENT_ROOT'] .'Inc_files/javascripts.inc';
=======
            include 'footer.inc';
            // Includes Javascript files
            include 'javascripts.inc';
>>>>>>> 386015224b93546ddc67dea88990955c718f15d5
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
