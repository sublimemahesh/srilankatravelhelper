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
        <title>Cities || Tour Sri Lanka</title>
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
        <link rel="stylesheet" href="css/colors/main.css" id="colors">




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
                background: #37b721 none repeat scroll 0 0;
                bottom: 10px;
                color: #ffffff;
                font-size: 20px;
                font-weight: 600;
                height: 40px;
                left:10px;
                line-height: 43px;
                position: absolute;
                text-align: center;
                transition: all 0.3s ease-in-out 0s;
                width: 100px;
                z-index: 99;
                border-radius: 21px;
            }
            .single-package-carasoul .package-details {
                background: #ffffff;
                border-radius: 0 0 4px 4px;
            }
            .single-package-carasoul .package-details .package-places {
                padding: 25px;
            }
            .single-package-carasoul .package-details .package-places h4 {
                padding-bottom: 7px;
                color: #454545;
                font-size: 19px;
                font-weight: 600;
            }
            .single-package-carasoul .package-details .package-places > span {
                color: #727272;
                font-size: 15px;
                font-weight: 500;
            }
            .single-package-carasoul .package-details .package-places > span i {
                margin-right: 10px;
            }
            .single-package-carasoul .package-details .package-places .details {
                margin-top: 18px;
            }
            .single-package-carasoul .package-details .package-places .details p {
                font-weight: 400;
                font-size: 15px;
                color: #727272;
                line-height: 25px;
                margin: 0;
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
                color: #ffef3b;
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
                padding: 27px 0;
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
            .single-package-carasoul:hover .package-location span {
                background: #000000;
            }
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
            /*            #pagination{
                            background-color: #37b721 !important;
                            border-color: #37b721 !important;
                        }*/
        </style>
    </head>
</head>
<body>
    <div id="wrapper">
        <?php include './header.php'; ?>
        <div class="container-fluid about-bg ">
            <div class="container">
                <div class="rl-banner" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="3500">
                    <h2 class="tp">Cities</h2>
                    <ul>
                        <li><a href="./">Home</a></li>
                        <li><span class="active">Cities</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <section class="blog-contents-version-one padding-bottom-5 padding-top-70 popular-packages">
            <div class="container">
                <div class="row">
                    <?php
                    $LOCATION = Location::all();
                    foreach ($LOCATION as $key => $city) {
                        ?>
                        <div class="col-md-3 col-sm-4 col-xs-12 hidden-sm" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="300">
                            <div class="single-package-carasoul">
                                <div class="package-location">
                                    <img src="upload/location/<?php echo $city['image_name']; ?>" alt="">
                                </div>
                                <div class="package-details">
                                    <div class="package-places">
                                        <a href="destinations-by-city.php?city=<?php echo $city['id']; ?>">
                                            <h4  title="<?php echo $city['name']; ?>">
                                                <?php
                                                if (strlen($city['name']) > 18) {
                                                    echo substr($city['name'], 0, 18) . '...';
                                                } else {
                                                    echo $city['name'];
                                                }
                                                ?>

                                            </h4>
                                        </a>
                                        <div class="details">
                                            <p><?php echo substr($city['short_description'], 0, 115) . '...'; ?></p>
                                        </div>
                                    </div>

                                    <div class="package-ratings-review cities-view-btn">
                                        <a href="destinations-by-city.php?city=<?php echo $city['id']; ?>" class="btn btn-success"> <span>View</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-4 col-xs-12 hidden-xs hidden-md hidden-lg">
                            <div class="single-package-carasoul">
                                <div class="package-location">
                                    <img src="upload/location/<?php echo $city['image_name']; ?>" alt="">
                                </div>
                                <div class="package-details">
                                    <div class="package-places">
                                        <a href="destinations-by-city.php?city=<?php echo $city['id']; ?>">
                                            <h4  title="<?php echo $city['name']; ?>">
                                                <?php
                                                if (strlen($city['name']) > 14) {
                                                    echo substr($city['name'], 0, 14) . '...';
                                                } else {
                                                    echo $city['name'];
                                                }
                                                ?>

                                            </h4>
                                        </a>
                                        <div class="details">
                                            <p><?php
                                                if (strlen($city['short_description']) > 85) {
                                                    echo substr($city['short_description'], 0, 85) . '...';
                                                } else {
                                                    echo $city['short_description'];
                                                }
                                                ?>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="package-ratings-review cities-view-btn">
                                        <a href="destinations-by-city.php?city=<?php echo $city['id']; ?>" class="btn btn-success"> <span>View</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Pagination -->
                        <div class="pagination-container margin-top-20 margin-bottom-40">
                            <?php // TourPackages::showPaginationOfTour($id, $setLimit, $page);   ?>
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
</body>
</html>

