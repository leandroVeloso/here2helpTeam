<?php   include_once('pdo.inc'); // Includes pdo file 
    redirectUser(verifyUserType(APPLICANT),"index.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php   include 'head.inc'; // Includes head content ?>
    </head>
    <body id="page-top" class="index">
        <?php include 'navigation.inc'; // Includes logo and menu ?>
        <!-- Present application Status Section -->
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        </br></br>
                        <h2>Volunteer Application Status</h2>
                        <hr class="star-primary">
                    </div>
                </div>
            </div>
        </section>
        <?php  // Includes logo and menu
                include 'footer.inc';
                // Includes Javascript files
                include 'javascripts.inc';
        ?>
        <script src="js/contact_me.js"></script>
    </body>
</html>
