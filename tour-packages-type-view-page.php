<?php
include_once(dirname(__FILE__) . '/class/include.php');
$id = $_GET["id"];

$TOUR_PACKAGES = new TourPackages($id);
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
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
<!--        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="css/set1.css" rel="stylesheet" type="text/css"/>

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
                <div class="rl-banner">
                    <h2 class="tp">Tour Packages</h2>
                    <ul>
                        <li><a href="./">Home</a></li>
                        <li><span class="active">Tour Packages</span></li>
                        <li><span class="active">Tour Packages Name</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <section class="blog-contents-version-one padding-bottom-45 padding-top-45 popular-packages">
            <div class="container">
                <div class="row">
                      <?php
                                        $TOUR_PACKAGES = TourPackages::getTourPackagesById($id);
                                        foreach ($TOUR_PACKAGES as $key => $tour_package) {
                                          
                                                ?>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <a href="tour-packages-type-one-item-view-page.php?id=<?php echo $tour_package['id'];?>">
                        <div class="single-package-carasoul">
                            <div class="package-location">
                                <img src="upload/tour-package/<?php echo $tour_package['image_name'];?>" alt="">
                                <a href="tour-packages-type-one-item-view-page.php?id=<?php echo $tour_package['id'];?>"> <span>View</span></a>
                            </div>
                            <div class="package-details">
                                <div class="package-places">
                                    <h4><?php echo $tour_package['name'];?></h4>
                                    <span> <i class="fa fa-dollar"></i><?php echo $tour_package['price'];?></span>
                                    <div class="details">
                                        <p><?php echo substr($tour_package['description'],0,93);?></p>
                                    </div>
                                </div>
                                <div class="package-ratings-review">
                                    <ul class="two-column">
                                        <li>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </li>
                                        <li>
                                            <p>(27 Reviews)</p>
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
                    <div class=" col-md-12 padding-left-200 padding-right-45 ">
                        <!-- Pagination -->
                        <div class="pagination-container margin-top-20 margin-bottom-40">
                            <nav class="pagination">
                                <ul>
                                    <li><a href="#" class="current-page">1</a></li>
                                    <li><a href="#" class="current-page">2</a></li>
                                    <li><a href="#" class="current-page">3</a></li>
                                    <li><a href="#" class="current-page">4</a></li>
                                    <li><a href="#" class="current-page">5</a></li>
                                    <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- single popular destination  end-->

        <?php include './footer.php'; ?>
    </div>

    <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
    <script src="scripts/jquery-2.2.0.min.js" type="text/javascript"></script>
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
</body>
</html>

