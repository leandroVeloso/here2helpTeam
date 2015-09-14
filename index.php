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
    

    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="img/logo.png" alt="" style="width: 25%; height: 25%">
                    <div class="intro-text">
                        <span class="name">here2help - help desk</span>
                        <hr class="star-light">
                        <span class="skills">here2help is a Brisbane based, volunteer run help desk. We work hard to assist those in our community who struggle to negotiate with service providers such as plumbers, electricians, car repairs, air conditioning, building work etc. If you struggle to communicate in English or work odd hours we can contact service providers on your behalf, negotiate the best price and book services.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="modalSignOut-content" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">You have successfully signed out!</h4>
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
