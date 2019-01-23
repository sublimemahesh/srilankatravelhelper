<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$type = '';
$id = $_GET["id"];
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}
$TOUR = new TourPackages($id);
$TOUR_TYPE = new TourType($type);
$REVIEWS = Reviews::getTotalReviewsOfTour($id);

$divider1 = $REVIEWS['count'];
$sum1 = $REVIEWS['sum'];

if ($divider1 == 0) {
    $sum1 = 0;
    $stars1 = 0;
} else {
    $stars1 = $sum1 / $divider1;
}
?>
<!DOCTYPE html>
<head>
    <!-- Basic Page Needs
       ================================================== -->
    <title><?php echo $TOUR->name; ?> || <?php echo $TOUR_TYPE->name; ?> || Tour Packages || Tour Sri Lanka</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
       ================================================== -->
    <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/custom.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/colors/main.css" id="colors">
    <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet"> 
    <link href="css/lightbox.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/reviews.css" rel="stylesheet" type="text/css"/>
    <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="css/aos.css" rel="stylesheet" type="text/css"/>
    <style>

        /*reviews*/
        .img-section img{
            margin-top:30px;
            border:6px solid #fff;
        }

        span.like-icon {
            /*                bottom: 50%;*/
            top:30%;
            transform: translateY(50%);
            background-color: #eee;
            color: #9d9d9d;
            right: 11px
        }

        span.like-icon.liked,
        span.like-icon:hover {
            background-color: #f3103c;
            color: #fff
        }
        .like-icon-section{
            margin: 1px 1px 1px 1px;
        }
        .like-icon-section-pd{
            padding-right: 2px;
        }
        /*user rating*/

        .btn-grey{
            background-color:#D8D8D8;
            color:#FFF;
        }

        .bold{
            font-weight:700;
        }
        .padding-bottom-7{
            padding-bottom:7px;
        }

        .review-block{
            background-color:#FAFAFA;
            border:1px solid #EFEFEF;
            padding:15px;
            border-radius:3px;
            margin-bottom:15px;
        }
        .review-block-name{
            font-size:12px;
            margin:10px 0;
        }
        .review-block-date{
            font-size:12px;
        }
        .review-block-rate{
            font-size:13px;
            margin-bottom:15px;
        }
        .review-block-title{
            font-size:15px;
            font-weight:700;
            margin-bottom:10px;
        }
        .review-block-description{
            font-size:13px;
        }

        .more-reviews-item1 li{
            color:#f5cf00;
            list-style-type: none;
            margin-bottom: 10px;
            font-size: 10px !important;

        }
        .image-row{
            padding-bottom: 10px;
            padding-top: 10px;
        }
        .item1{
            padding-bottom: 25px;
        }
        a:hover {
            text-decoration: none;
        }
        @media(max-width:576px) {
            .reviws-section {
                height: auto;
                margin-top: 20px;
            }
            .star-section {
                border-top: 2px solid #e3d9d9;
                border-left: 0px;
                height: auto;
            }
            h4.headline {
                font-size: 22px;
                margin: 30px 0 15px;
            }
        }

    </style>
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
                        <li><span class="active"><?php echo $TOUR->name; ?></span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container padding-bottom-45 padding-top-45" >
            <div class="row">
                <div class="col-md-9 col-sm-9" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="300">

                    <div class="item1">
                        <div class="padding-top-10">
                            <?php
                            $TOUR_DATE = TourDate::getTourDatesById($id);
                            foreach ($TOUR_DATE as $key => $tour_date) {
                                ?>
                                <div data-aos="fade-up" data-aos-duration="3500" data-aos-delay="300">
                                    <hr>
                                    <h3 class="headline"><?php echo $tour_date['title']; ?></h3>
                                    <hr>
                                    <p><?php echo $tour_date['description']; ?></p>

                                    <div class="image-row padding-bottom-140 packagepadding">
                                        <?php
                                        $TOUR_DATE_PHOTOS = TourDatePhoto::getTourDatePhotosById($tour_date['id']);
                                        foreach ($TOUR_DATE_PHOTOS as $key => $tour_photos) {
                                            ?>
                                            <div  class="col-md-3 tourpackimg">
                                                <a class="example-image-link" href="upload/tour-package/date/gallery/thumb/<?php echo $tour_photos['image_name']; ?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                                                    <img class="example-image" src="upload/tour-package/date/gallery/thumb/<?php echo $tour_photos['image_name']; ?>" alt="Golden Gate Bridge with San Francisco in distance"></a>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                    <div class="review-button">
                        <a href="booking.php?tour=<?php echo $id; ?>&back=booking" ><button id="view-all-reviews" class="button border with-icon submit btncolor15">Book Now</button></a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3" data-aos="fade-down" data-aos-duration="3500" data-aos-delay="600">
                    <div class="moretourpack">
                        <h4 class="headline headline-more-items text-center " >More Tour Packages</h4>
                    </div>
                    <?php
                    $TOUR_PACKAGES = TourPackages::getTourPackagesById($type);
                    foreach ($TOUR_PACKAGES as $key => $tour_package) {
                        if ($key < 7) {
                            $count = TourDate::countTotalDatesOfPackage($tour_package['id']);

                            $days = $count['count'];
                            $nights = $days - 1;
                            ?>

                            <a href="tour-packages-type-one-item-view-page.php?id=<?php echo $tour_package['id']; ?>&type=<?php echo $id; ?>">
                                <div class="other-tours col-md-12 other-tourspack">
                                    <h4 title="<?php echo $tour_package['name']; ?>">
                                        <?php
                                        if (strlen($tour_package['name']) > 24) {
                                            echo substr($tour_package['name'], 0, 24) . '...';
                                        } else {
                                            echo $tour_package['name'];
                                        }
                                        ?>
                                    </h4>

                                    <div class="col-md-4 col-sm-12 col-xs-4">
                                        <img src="upload/tour-package/thumb1/<?php echo $tour_package["image_name"]; ?>" alt="">
                                    </div>
                                    <div class="col-md-8 col-sm-12 col-xs-8">
                                        <div class="col-sm-12">
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
                                            echo '<br />(' . $sum . ' reviews)';
                                            ?>
                                        </div>
                                        <div class="col-sm-12">
                                            <?php
                                            if ($days == 1) {
                                                echo '01 day';
                                            } else {
                                                if ($days < 10) {
                                                    echo '0' . $days . 'days';
                                                } else {
                                                    echo $days . 'days';
                                                }
                                                if ($nights == 1) {
                                                    echo ' & 01 night';
                                                } else if ($nights < 10) {
                                                    echo ' & 0' . $nights . 'nights';
                                                } else {
                                                    echo ' & ' . $nights . 'nights';
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </a>

                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="container padding-bottom-70">
            <div class="row">
                <div class="col-md-12" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="900">
                    <hr>
                    <h3 class="headline ">Reviews(<?php echo $sum1; ?>)</h3>
                    <hr>
                    <div class="col-md-4 col-sm-4 rating-breakdown">
                        <div class="col-md-12 rating-block ratingblock1">

                            <h2 class="bold padding-bottom-7"><?php echo $sum1; ?> <small>/ <?php echo 5 * $divider1; ?></small></h2>
                            <?php
                            for ($i = 1; $i <= $stars1; $i++) {
                                ?>
                                <button type="button" class="btn btn-warning btn-sm starbtn" aria-label="Left Align">
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                </button>
                                <?php
                            }
                            for ($j = $i; $j <= 5; $j++) {
                                ?>
                                <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                </button>
                                <?php
                            }
                            ?>
                        </div>

                    </div>	
                    <div class="col-md-8 col-sm-8">
                        <div class="reviws-section" style="margin-top: 0px;">
                            <div class="review-carousel testimonials">
                                <?php if (count(Reviews::getReviewsByTour($TOUR->id)) > 0) {
                                    ?>
                                    <?php
                                    foreach (Reviews::getReviewsByTour($TOUR->id) as $review) {
                                        $VISITOR = new Visitor($review['visitor']);
                                        ?>
                                        <div class="col-md-12">

                                            <div class="col-md-3 col-sm-3 img-section reviewspts">
                                                <div class="reviewimg">
                                                    <?php
                                                    if (empty($VISITOR->profile_picture)) {
                                                        ?>
                                                        <img src="upload/driver/driver.png" alt="Profile Picture" class="img-circle"/>
                                                        <?php
                                                    } else {
                                                        if ($VISITOR->facebookID && substr($VISITOR->profile_picture, 0, 5) === "https") {
                                                            ?>
                                                            <img src="<?php echo $VISITOR->profile_picture; ?>"  alt="Profile Picture" class="img-circle"/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="upload/visitor/<?php echo $VISITOR->profile_picture; ?>" alt="Profile Picture" class="img-circle"/>
                                                            <?php
                                                        }
                                                    }
                                                    ?> 
                                                </div>
                                                <div class="reviews-item1 ">
                                                    <li>
                                                        <?php
                                                        $stars = $review['reviews'];
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
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <p class="count-reviews" style="color:#000 !important;"><?php echo $review['reviews']; ?> Reviews</p>
                                                    </li>
                                                </div>
                                            </div>  
                                            <div class="col-md-9 col-sm-9 ">
                                                <h4 class=" reviews-title"><?php echo $VISITOR->name; ?></h4>
                                                <p><?php echo $review['message']; ?></p>
                                            </div> 

                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                } else {
                                    ?>
                                    <li class="list-group-item"><h5>No any reviews in here</h5></li>
                                <?php }
                                ?>
                            </div>
                        </div>
                        <?php if (count(Reviews::getReviewsByTour($TOUR->id)) > 0) {
                            ?>
                            <div class="review-button">
                                <div class ="col-md-6 col-xs-12 col-sm-6">
                                    <a href="view-all-reviews.php?tour=<?php echo $id; ?>" ><button id="view-all-reviews" class="button border with-icon submit btncolor16">View All Reviews</button></a>
                                </div>

                                <div class ="col-md-6 col-xs-12 col-sm-6 addreviewbtn">
                                    <a href="visitor/manage-reviews.php?tour=<?php echo $id; ?>" ><button id="view-all-reviews" class="button border with-icon submit btncolor16">Add Reviews</button></a>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="review-button">
                                <a href="visitor/manage-reviews.php?tour=<?php echo $id; ?>" ><button id="view-all-reviews" class="button border with-icon submit btncolor16">Add Reviews</button></a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                </div>
            </div>

        </div>
        <?php include './footer.php'; ?>
    </div>
    <!--<script src="scripts/jquery_2.2.4.js" type="text/javascript"></script>-->
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
    <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
    <script src="lib/owl/owl.carousel.min.js" type="text/javascript"></script>
    <script src="scripts/lightbox.min.js" type="text/javascript"></script>
    <script src="scripts/aos.js" type="text/javascript"></script>
    <script>
        AOS.init();
    </script>
    <script>
        <script>
<< <<<<< HEAD
    $(function () {
                $('#nav').on('click', '.nav-item', function (event) {
        event.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
        scrollTop: $(hash).offset().top
    }, 1000, function () {
                window.location.hash = hash;
    });
});
    });
    </script>
=======
                $(function () {
                        $('#nav').on('click', '.nav-item', function (event) {
                event.preventDefault();
                var hash = this.hash;
                $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 1000, function () {
                        window.location.hash = hash;
            });
                });
                });
                </script>
>>>>>>> design corrections
                    <script>
$(document).ready(fu                                nction () {
                $('.owl-carousel').ow                        lCarousel({
                                        loop: true,
                                                margin: 10,
                                                nav: false,
                re                                sponsive: {
                                         0: {
                                 item                    s: 1
    },                
    600:                    {
item                    s: 5
    },
                1000:                        {
items: 5                        
        },
                    1200:                            {
items: 5
                              }
                               },
            auto                    play: true,
    autoplayTim                eout: 2000,
autoplayHoverP                ause: true,
animat                            eOut: true,
                                });
            });                    
</script>

                </body>
</html>

