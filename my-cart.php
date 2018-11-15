<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}

$destinations = '';
$count = '';
if (isset($_SESSION['destination_cart'])) {
    $destinations = $_SESSION['destination_cart'];
    $count = count($destinations);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title>Sri Lanka Travel Helper</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
           ================================================== -->
        <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="lib/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <style>
            .review-button {
                margin-bottom: 70px;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container-fluid about-bg ">
                <div class="container">
                    <div class="rl-banner">
                        <h2 class="tp">My Cart</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">My Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container margin-top-70">
                <div class="row">
                    <ul class="list-group">
                        <?php
                        if ($count > 1) {
                            foreach ($destinations as $key => $destination) {
                                $DESTINATION = new Destination($destination);
                                ?>
                                <li class="list-group-item" id="li-<?php echo $key; ?>"><i class="fa fa-minus-circle remove-from-cart" title="remove" destination-id="<?php echo $destination; ?>" array-key="<?php echo $key; ?>"></i><?php echo $DESTINATION->name; ?></li>
                                <?php
                            }
                        } else {
                            ?>
                            <li class="list-group-item"><h3>No any selected destinations in your cart</h3></li>
                            <?php
                        }
                        ?>

                    </ul> 
                </div>
                <div class="review-button">
                    <a href="booking.php?tailormade" ><button id="send-destinations" class="button border with-icon submit add-to-cart">Book Now</button></a>
                </div>
            </div>
            <?php include './footer.php'; ?>
        </div>
    </body>


    <!-- Scripts
     ================================================== -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
    <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="scripts/mmenu.min.js"></script>
    <script type="text/javascript" src="scripts/chosen.min.js"></script>
    <script type="text/javascript" src="scripts/slick.min.js"></script>
    <script type="text/javascript" src="scripts/rangeslider.min.js"></script>
    <script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
    <script type="text/javascript" src="scripts/waypoints.min.js"></script>
    <script type="text/javascript" src="scripts/counterup.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
    <script type="text/javascript" src="scripts/tooltips.min.js"></script>
    <script type="text/javascript" src="scripts/custom.js"></script>
    <script src="scripts/remove-from-cart.js" type="text/javascript"></script>
    <script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>
</html>

