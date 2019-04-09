<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$id = $_GET["id"];

$DESTINATION_TYPE = new DestinationType($id);

/* set page numbers */
if (isset($_GET["page"])) {
    $page = (int) $_GET["page"];
} else {
    $page = 1;
}
$setLimit = 10;

$pageLimit = ($page * $setLimit) - $setLimit;

///count views
$desview = DestinationType::getDestinationTypeViewById($id);
$view = (int) $desview['views'];
if ($view == 0) {
    $view = 1;
} else {
    $view = $view + 1;
}
//echo "Total page views = " . $view;
$updateview = DestinationType::updateViewByid($id, $view);
?>  
<!DOCTYPE html>
<html>

    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title><?php echo $DESTINATION_TYPE->name; ?> || Destinations || Tour Sri Lanka</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
           ================================================== -->
        <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="css/component.css" rel="stylesheet" type="text/css"/>
        <link href="css/default.css" rel="stylesheet" type="text/css"/>
        <!--<link href="lib/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" />
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/aos.css" rel="stylesheet" type="text/css"/>
        <style>
            .like-icon {
                padding: 8px 12px;
            }
            .title-top{
                margin-top: 25px;
            }
            .boxed-widget {
                padding: 5px 10px 5px 25px;
            }
        </style>
    </head>



    <body>
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container-fluid about-bg ">
                <div class="container">
                    <div class="rl-banner" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="3500">
                        <h2 class="tp"><?php echo $DESTINATION_TYPE->name; ?></h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><a href="destination-type.php">Destination</a></li>
                            <li><span class="active"><?php echo $DESTINATION_TYPE->name; ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container padding-top-45  padding-bottom-5">
                <div class="row">
                    <div class="col-lg-9 col-md-8 padding-right-30" >
                        <!-- Sorting / Layout Switcher -->
                        <div class="row margin-bottom-25">
                        </div>
                        <div class="row">
                            <?php
                            $DESTINATIONS = Destination::getDestinationByIdForPagination($id, $pageLimit, $setLimit);

                            foreach ($DESTINATIONS as $key => $destination) {
                                ?>
                                <!-- Listing Item -->
                                <div class="col-lg-12 col-md-12 col-sm-6" data-aos="fade-down" data-aos-duration="3500">
                                    <div class="listing-item-container list-layout">
                                        <a href="destination-type-one-item-view-page.php?id=<?php echo $destination['id']; ?>" class="listing-item">

                                            <!-- Image -->
                                            <div class="listing-item-image">
                                                <img src="upload/destination/<?php echo $destination['image_name']; ?>" alt="">

                                            </div>

                                            <!-- Content -->
                                            <div class="listing-item-content">


                                                <div class="listing-item-inner">
                                                    <h3 title="<?php echo $destination['name']; ?>"><?php echo $destination['name']; ?></h3>
                                                    <span class="para"><?php echo $destination['short_description']; ?></span>
                                                    <div class="star-rating">
                                                        <?php
                                                        $REVIEWS = Reviews::getTotalReviewsOfDestination($destination['id']);

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
                                                        <div class="rating-counter">(<?php echo $divider; ?> reviews)</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="listing-item-btn">
                                                <span class="like-icon add-to-cart" id="add-to-cart" destination-id="<?php echo $destination['id']; ?>" back="cart" title="Add to Cart"><i class="fa fa-cart-plus"></i></span>
                                                <span class="tag"style="background: #0dce38!important" >View </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- Listing Item / End -->
                                <?php
                            }
                            ?>
                        </div>
                        <!-- Pagination -->
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Pagination -->
                                <div class="pagination-container margin-top-20 margin-bottom-40">
                                    <?php Destination::showPaginationOfDestination($id, $setLimit, $page); ?>
                                </div>
                            </div>
                        </div>
                        <!-- Pagination / End -->

                    </div>
                    <!-- Sidebar
                  ================================================== -->
                    <div class="col-md-3 col-sm-4 moredesti more-destination-type" >
                        <div data-aos="fade-down" data-aos-duration="3500" data-aos-delay="400">
                            <h3 class="headline text-center" >More Categories</h3>
                        </div> 
                       <div class="row">
                    <?php
                    $DESTINATION_TYPES = DestinationType::all();
                    foreach ($DESTINATION_TYPES as $destination_type) {
                        ?>
                        <div class="col-md-8 col-sm-6" data-aos="fade-down" data-aos-duration="3500" data-aos-delay="300" >
                            <a href="destination-type-view-page.php?id=<?php echo $destination_type['id']; ?>" class="listing-item-container">
                                <div class="listing-item destinationType">
                                    <img src="upload/destination-type/<?php echo $destination_type['image_name']; ?>" alt="">
                                    <div class="listing-item-content">
                                     
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

                                            <!--<div class="rating-counter">(<?php echo $divider; ?> reviews)</div>-->
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                    </div>
                    <!-- Sidebar / End -->




                </div>
            </div>
            <?php include './footer.php'; ?>
        </div>
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
        <script src="desti/toucheffects.js" type="text/javascript"></script>
        <script src="css/modernizr.custom.js" type="text/javascript"></script>
        <!--<script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
        <script src="scripts/add-to-cart.js" type="text/javascript"></script>
        <script src="scripts/aos.js" type="text/javascript"></script>
        <script>
            AOS.init();
        </script>

    </body>
</html>