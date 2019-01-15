<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$id = $_GET["id"];

$TOUR_TYPE = new TourType($id);

/* set page numbers */
if (isset($_GET["page"])) {
    $page = (int) $_GET["page"];
} else {
    $page = 1;
}
$setLimit = 10;
$pageLimit = ($page * $setLimit) - $setLimit;
?> 
<!DOCTYPE html>

<html>
    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title><?php echo $TOUR_TYPE->name; ?> || Tour Packages || Tour Sri Lanka</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
           ================================================== -->
        <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/set1.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/aos.css" rel="stylesheet" type="text/css"/>
        

        <style>
            .tour-package-bg {
                background: transparent url("../images/bgimage/package.jpg") repeat scroll 0 0;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center center;
                position: relative;
                z-index: 1;
                overflow: hidden;
            }
            .tour-package-bg:before {
                position: absolute;
                content: "";
                left: 0;
                width: 100%;
                height: 100%;
                top: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: -1;
            }
            .tour-package-bg:hover .owl-nav div.owl-prev {
                opacity: 1;
                left: -70px;
            }
            .tour-package-bg:hover .owl-nav div.owl-next {
                opacity: 1;
                right: -70px;
            }
            .popular-packages-carasoul.owl-carousel.owl-loaded.owl-drag {
                clear: both;
            }
            .single-package-carasoul {
                overflow: hidden;
                position: relative;
                margin-bottom: 30px;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
            }
            .single-package-carasoul .package-location {
                position: relative;
            }
            .single-package-carasoul .package-location span {
                background: #37b721b3 none repeat scroll 0 0;
                bottom: 10px;
                color: #ffffff;
                font-size: 13px;
                font-weight: 600;
                height: 34px;
                right: 25px;
                line-height: 33px;
                position: absolute;
                text-align: center;
                transition: all 0.3s ease-in-out 0s;
                width: 100px;
                z-index: 99;
                border-radius: 24px;
                border: 1px solid #fff9;
                text-transform: uppercase;
                letter-spacing: 3px;
            }
            .single-package-carasoul .package-location span:hover {
                background: #fffc none repeat scroll 0 0;
                bottom: 10px;
                color: #0dce38;
                border: 1px solid #0dce38;
            }
            .single-package-carasoul .package-details {
                background: #ffffff;
                border-radius: 0 0 4px 4px;
            }
            .single-package-carasoul .package-details .package-places {
                padding: 10px 25px;
            }
            .single-package-carasoul .package-details .package-places h4 {
                padding-bottom: 0px;
                color: #454545;
                font-size: 19px;
                font-weight: 600;
            }
            .single-package-carasoul .package-details .package-places > span {
                color: #727272;
                font-size: 14px;
                font-weight: 500;
            }
            .single-package-carasoul .package-details .package-places > span i {
                margin-right: 10px;
                font-size: 14px;
            }
            .single-package-carasoul .package-details .package-places .details {
                margin-top: 5px;
            }
            .single-package-carasoul .package-details .package-places .details p {
                font-weight: 400;
                font-size: 14px;
                color: #727272;
                line-height: 25px;
                margin: 0;
                text-align: justify;
            }
            .single-package-carasoul .package-details .package-places .details p span {
                font-size: 15px;
                font-weight: 600;
                color: #454545;
            }
            .single-package-carasoul .package-details .package-ratings-review {
                border-top: 1px solid #37b721;
                padding: 10px 0;
                position: relative;
            }
            .single-package-carasoul .package-details .package-ratings-review .two-column {
                padding: 0 25px;
            }
            .single-package-carasoul .package-details .package-ratings-review .two-column li {
                display: inline-block;
            }
            .single-package-carasoul .package-details .package-ratings-review .two-column li:last-child {
                float: right;
            }
            .single-package-carasoul .package-details .package-ratings-review .two-column li i {
                color: #efdb00;
                font-size: 21px;
            }
            .single-package-carasoul .package-details .package-ratings-review .two-column li p {
                font-weight: 400;
                font-size: 15px;
                color: #727272;
            }
            .single-package-carasoul .package-long-btn {
                background: #5ef94680 none repeat scroll 0 0;
                display: block;
                width: 100%;
                text-align: center;
                padding: 22px 0;
                position: absolute;
                bottom: -63px;
                opacity: 0;
                visibility: hidden;
                transition: all ease-in-out 0.3s;
                right: 0;
                font-size: 17px;
                font-weight: 500;
            }
            .single-package-carasoul .package-long-btn  {
                color: #ffffff;
                text-transform: uppercase;
            }
            .single-package-carasoul:hover .package-long-btn {
                opacity: 1;
                visibility: visible;
                bottom: -1px;
            }
            /*            .single-package-carasoul:hover .package-location span {
                            background: #000000;
                        }*/
            .owl-nav div {
                background: #37b721 none repeat scroll 0 0;
                color: #ffffff;
                font-size: 20px;
                height: 50px;
                left: -200px;
                line-height: 50px;
                position: absolute;
                text-align: center;
                top: 50%;
                transform: translateY(-50%);
                width: 50px;
                opacity: 0;
                transition: all 0.3s ease-out;
                border-radius: 5px;
            }
            .owl-nav div:hover {
                background: #f17b37;
            }
            .owl-nav div.owl-next {
                left: auto;
                right: -200px;
            }
            .package-places h4 {
                margin-bottom: 4px;
            }
        </style>
    </head>
</head>
<body>
    <div id="wrapper">
        <?php include './header.php'; ?>
        <div class="container-fluid about-bg ">
            <div class="container">
                <div class="rl-banner" data-aos-easing="linear" data-aos-duration="3500">
                    <h2 class="tp">Tour Packages</h2>
                    <ul>
                        <li><a href="./">Home</a></li>
                        <li><span class="active">Tour Packages</span></li>
                        <li><span class="active"><?php echo $TOUR_TYPE->name; ?></span></li>
                    </ul>
                </div>
            </div>
        </div>

        <section class="blog-contents-version-one padding-bottom-5 padding-top-70 popular-packages">
            <div class="container">
                <div class="row">
                    <?php
                    $TOUR_PACKAGES = TourPackages::getTourPackagesByIdForPagination($id, $pageLimit, $setLimit);
                    foreach ($TOUR_PACKAGES as $key => $tour_package) {
                        ?>
                        <div class="col-md-4 col-sm-6 col-xs-12" data-aos="fade-right" data-aos-duration="3500" data-aos-delay="300">
                            <a href="tour-packages-type-one-item-view-page.php?id=<?php echo $tour_package['id']; ?>&type=<?php echo $id; ?>">
                                <div class="single-package-carasoul">
                                    <div class="package-location">
                                        <img src="upload/tour-package/<?php echo $tour_package['image_name']; ?>" alt="">
                                        <a href="tour-packages-type-one-item-view-page.php?id=<?php echo $tour_package['id']; ?>&type=<?php echo $id; ?>"> <span>View</span></a>
                                    </div>
                                    <div class="package-details">
                                        <div class="package-places">
                                            <h4 title="<?php echo $tour_package['name']; ?>" ><a href="tour-packages-type-one-item-view-page.php?id=<?php echo $tour_package['id']; ?>&type=<?php echo $id; ?>">

                                                    <?php
                                                    if (strlen($tour_package['name']) > 30) {
                                                        echo substr($tour_package['name'], 0, 30) . '...';
                                                    } else {
                                                        echo $tour_package['name'];
                                                    }
                                                    ?>

                                                </a></h4>
                                            <span> <i class="fa fa-dollar"></i><?php echo $tour_package['price']; ?></span>
                                            <div class="details">
                                                <p><?php echo substr($tour_package['description'], 0, 100) . '...'; ?></p>
                                            </div>
                                        </div>
                                        <div class="package-ratings-review">
                                            <ul class="two-column">
                                                <li>
                                                    <?php
                                                    $REVIEWS = Reviews::getTotalReviewsOfTour($tour_package['id']);

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
                                                </li>
                                                <li>
                                                    <p>(<?php echo $sum; ?> Reviews)</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="package-long-btn hvr-shutter-out-horizontal">
                                        <a href="#"></a>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Pagination -->
                        <div class="pagination-container margin-top-20 margin-bottom-40">
                            <?php TourPackages::showPaginationOfTour($id, $setLimit, $page); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- single popular destination  end-->

        <?php include './footer.php'; ?>
    </div>

    <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
    <script src="scripts/jquery-2.2.0.min.js" type="text/javascript"></script>
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
    <script>
</body>
</html>

