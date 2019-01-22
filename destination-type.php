<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title>Destinations || Tour Sri Lanka</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
           ================================================== -->
        <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/aos.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container-fluid about-bg" >
                <div class="container">
                    <div class="rl-banner" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="3500" >
                        <h2 class="tp">Destination</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Destination</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container margin-top-70" >
                <div class="row">
                    <?php
                    $DESTINATION_TYPES = DestinationType::all();
                    foreach ($DESTINATION_TYPES as $destination_type) {
                        ?>
                        <div class="col-md-4 col-sm-6" data-aos="fade-down" data-aos-duration="3500" data-aos-delay="300" >
                            <a href="destination-type-view-page.php?id=<?php echo $destination_type['id']; ?>" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="upload/destination-type/<?php echo $destination_type['image_name']; ?>" alt="">
                                    <div class="listing-item-content">
                                        <span class="tag" style="background: #0dce38!important">View</span>
                                        <h3><?php echo $destination_type['name']; ?></h3>
    <!--                                    <span><?php echo $destination_type['description']; ?></span>-->
                                        <div class="star-rating" style="padding: 15px 0px !important;">
                                            <?php
                                            $REVIEWS = Reviews::getTotalReviewsOfDestinationType($destination_type['id']);

                                            $divider = $REVIEWS['count'];
                                            $sum = $REVIEWS['sum'];

                                            if ($divider == 0) {
                                                for ($j = 1; $j <= 5; $j++) {
                                                    ?>
                                                    <i class="fa fa-star-o"></i>
                                                    <?php
                                                }
                                                $sum = 0;
                                            } else {
                                                $stars = $sum / $divider;

                                                for ($i = 1; $i <= $stars; $i++) {
                                                    ?>
                                                    <i class="fa fa-star"></i>
                                                    <?php
                                                }
                                                for ($j = $i; $j <= 5; $j++) {
                                                    ?>
                                                    <i class="fa fa-star-o"></i>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            <div class="rating-counter">(<?php echo $sum; ?> reviews)</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="row margin-bottom-40">
                    
                    <div class="view-all-destination-button ">
                        <div class="edit-button">
                        <a href="all-destinations.php" ><button id="view-all-reviews" class="btncolor3 button border with-icon submit">All Destinations</button></a>
                        </div>
                    </div>
                       
                </div>

            </div>
            <?php include './footer.php'; ?>
        </div>
    </body>


    <!-- Scripts
     ================================================== -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
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
    <script src="scripts/aos.js" type="text/javascript"></script>
    <script>
        AOS.init();
    </script>

</html>