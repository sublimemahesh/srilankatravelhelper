<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}

$destinations = '';
$countdestinations = '';
if (isset($_SESSION['destination_cart'])) {
    $destinations = $_SESSION['destination_cart'];
    $countdestinations = count($destinations);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title>Cart || Tour Sri Lanka</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
           ================================================== -->
        <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="lib/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/plan-trip.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/aos.css" rel="stylesheet" type="text/css"/>
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
                    <div class="rl-banner" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="3500">
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
                    <ul class="list-group padding-bottom-60" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="100">
                        <?php
                        if ($countdestinations > 0) {
                            foreach ($destinations as $key => $destination) {
                                $DESTINATION = new Destination($destination);

                                $REVIEWS = Reviews::getTotalReviewsOfDestination($DESTINATION->id);

                                $divider1 = $REVIEWS['count'];
                                $sum1 = $REVIEWS['sum'];
                                if ($divider1 == 0) {
                                    $stars1 = 0;
                                    $sum1 = 0;
                                } else {
                                    $stars1 = $sum1 / $divider1;
                                }
                                ?>
                                                                                                <!--<li class="list-group-item" id="li-<?php echo $key; ?>"><i class="fa fa-minus-circle remove-from-cart" title="remove" destination-id="<?php echo $destination; ?>" array-key="<?php echo $key; ?>"></i><?php echo $DESTINATION->name; ?></li>-->




                                <div class="col-md-4 col-sm-6 col-xs-12 search-destination-item" id="div-<?php echo $key; ?>">
                                    <div class="col-md-12 col-sm-12 col-xs-12 search-destination-inner">
                                        <div class="listing-item col-md-5 col-sm-5 col-xs-5">
                                            <img src="upload/destination/<?php echo $DESTINATION->image_name; ?>" alt=""/>
                                        </div>
                                        <div class="search-item-details col-md-7 col-sm-7 col-xs-7">
                                            <div class="driver-name text-left">
                                                <?php
                                                if (strlen($DESTINATION->name) > 18) {
                                                    echo substr($DESTINATION->name, 0, 18) . '...';
                                                } else {
                                                    echo $DESTINATION->name;
                                                }
                                                ?>
                                            </div>
                                            <div class="star-rating-fa">
                                                <?php
                                                for ($i = 1; $i <= $stars1; $i++) {
                                                    echo '<i class="fa fa-star"></i>';
                                                }
                                                for ($j = $i; $j <= 5; $j++) {
                                                    echo '<i class="fa fa-star-o"></i>';
                                                }
                                                ?>
                                                <div class="rating-counter">(<?php echo $sum1; ?> reviews)</div><br>
                                            </div>
                                            <div style="margin-top: 0px;padding-bottom: 7px;">
                                                <p class="text-center " id="">
                                                    <?php echo substr($DESTINATION->short_description, 0, 55) . '...'; ?>
                                                </p>
                                            </div>
                                            <div class="button-section">
                                                <a href="destination-type-one-item-view-page.php?id=<?php echo $DESTINATION->id; ?>" target="_blank"><button class="btn btn-view"><i class="glyphicon glyphicon-link" ></i></button></a>
                                                <button class="btn btn-cart  remove-from-cart" id="li-<?php echo $key; ?>" destination-id="<?php echo $DESTINATION->id; ?>" array-key="<?php echo $key; ?>" back="cart" title="Remove from Cart"><i class="glyphicon glyphicon-remove-sign" ></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <?php
                            }
                        } else {
                            ?>
                            <li class="list-group-item " data-aos="fade-up" data-aos-duration="3500" data-aos-delay="600">
                                <h3>No any selected destinations in your cart</h3>
                            </li>
                            <?php
                        }
                        ?>

                    </ul> 
                </div>
                <div class="review-button <?php
                if (count($_SESSION['destination_cart']) <= 0) {
                    echo 'hidden';
                }
                ?>">
                    <a href="booking.php?tailormade" ><button id="send-destinations" class="button border with-icon submit add-to-cart btncolor14">Book Now</button></a>
                </div>
            </div>
            <?php include './footer.php'; ?>
        </div>
    </body>


    <!-- Scripts
     ================================================== -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
    <script src="css/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
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
    <script src="scripts/aos.js" type="text/javascript"></script>
    <script>
        AOS.init();
    </script>

</html>

