<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$id = $_GET["id"];
$DRIVER = new Drivers($id);

$DRIVER_PHOTOS = DriverPhotos::getDriverPhotosByDriver($id);

$REVIEWS = Reviews::getTotalReviewsOfDriver($DRIVER->id);

$divider = $REVIEWS['count'];
$sum = $REVIEWS['sum'];

$stars = $sum / $divider;
?> 
<!DOCTYPE html>

<html>
    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title><?php echo $DRIVER->name; ?> || Drivers || Tour Sri Lanka</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
           ================================================== -->
        <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/galleria.classic.min.css" rel="stylesheet" type="text/css"/>
        <!--reviws fonts-->
        <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet"> 
        <link href="css/reviews.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/aos.css" rel="stylesheet" type="text/css"/>

        <style>


            /* This rule is read by Galleria to define the gallery height: */
            #galleria{height:480px}
            /*driver*/
            .driver-profile-section{
                background-color:#fff;
                border:1px solid #F7F7F0;
                /*                padding:7% 12% 7% 12%;*/
                border-radius:3%;
                /*                padding-bottom: 10px;*/
            }
            .profile-description{
                margin: 1% 1% 1% 3%;
                text-align: center;

            }
            .driver-rating{
                background-color:#F7F7F0;
                padding-bottom: 10px;
                padding-top: 10px;
                /*                border:1px solid #000; */
            }
            .profile-driver-name{
                color:#000;
            }
            .star-rating-driver{
                margin-top: 15px;
                z-index: 9;
                position: relative;
                color: #f5cf00;
                padding-right: 84px;
            }
            .contact-details-driver{
                margin: 1% 1% 1% 3%;
                list-style-type: none;
                background-color:#F7F7F0;

            }
            .item-fa1{
                color:#547cdb;

            }
            .item-fa2{
                color:#0dce38;

            }
            .item-fa3{
                color:#0089ec;

            }
            .item-fa4{
                color:#0089ec;

            }
            .item-fa1,.item-fa2,.item-fa3,.item-fa4{
                font-size: 32px;  
            }
            /*reviews*/
            /*reviews*/

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
            .rating-breakdown{

                border-radius:3%;
                /*                padding: 1% 1% 1% 1%;*/

            }
            .more-reviews-item1 li{
                color:#f5cf00;
                list-style-type: none;
                margin-bottom: 10px;
                font-size: 11px !important;

            }
            .review-carousel .slick-slide {
                width: 700px;
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
            }
        </style>
    <body>
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container-fluid about-bg" >
                <div class="container">
                    <div class="rl-banner"  data-aos="fade-down" data-aos-duration="3500">
                        <h2 class="tp"><?php echo $DRIVER->name; ?></h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Drivers</span></li>
                            <li><span class="active"><?php echo $DRIVER->name; ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container padding-bottom-45 padding-top-70">
                <div class="row">
                    <div class="col-md-3 col-sm-4" data-aos="fade-right" data-aos-duration="3500" data-aos-delay="300">


                        <div class="driver-profile-section" >

                            <div class="listing-item">
                                <?php
                                foreach (DriverPhotos::getDriverPhotosByDriver($DRIVER->id) as $key => $photo) {
                                    if ($key == 0) {
                                        ?>
                                        <img src="upload/driver/driver-photos/thumb/<?php echo $photo['image_name']; ?>" alt="">
                                        <?php
                                    }
                                }
                                ?> 
                            </div>
                            <div class="img-pad "> 
                                <?php
                                if (empty($DRIVER->profile_picture)) {
                                    ?>
                                    <img src="upload/driver/driver.png" alt="Profile Picture" class="img-circle driver-list"/>
                                    <?php
                                } else {
                                    if ($DRIVER->facebookID && substr($DRIVER->profile_picture, 0, 5) === "https") {
                                        ?>
                                        <img src="<?php echo $DRIVER->profile_picture; ?>"  alt="Profile Picture" class="img-circle driver-list"/>
                                        <?php
                                    } else {
                                        ?>
                                        <img src="upload/driver/<?php echo $DRIVER->profile_picture; ?>" alt="Profile Picture" class="img-circle driver-list"/>
                                        <?php
                                    }
                                }
                                ?>
                            </div> 
                            <div class="profile-description ">
                                <h3><?php echo $DRIVER->name; ?></h3>
                            </div>
                            <div class="driver-rating">
                                <div class="star-rating-driver text-right"> 
                                    <?php
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
                                </div>
                                <div id="rating-counter">(<?php echo $sum; ?> reviews)
                                </div>
                            </div>
                            <div class="profile-description ">
                                <p><?php echo substr($DRIVER->short_description, 0, 155) . '...'; ?></p>
                            </div>
                            <div class="fa-item" style="padding: 3% 20% 3% 10%;background: #F7F7F0;">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <span><i class="fa fa-facebook-square item-fa1"></i></span>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <span><i class="fa fa-whatsapp item-fa2"></i></span>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <span><i class="fa fa-twitter-square item-fa3"></i></span>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <span><i class="fa fa-skype item-fa4"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="padding-top-20"></div>
                        <div class="relexholding">
                            <img src="images/side-banner/side-banner.jpg" alt=""/>
                        </div>

                    </div>
                    <div class="col-md-9 col-sm-8" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="600">
                        <div class=" content">
                            <div id="galleria">
                                <?php
                                foreach ($DRIVER_PHOTOS as $key => $driver_photos) {
                                    ?>
                                    <a href="upload/driver/driver-photos/<?php echo $driver_photos['image_name']; ?>">
                                        <img 
                                            src="upload/driver/driver-photos/<?php echo $driver_photos['image_name']; ?>"
                                            data-big="upload/driver/driver-photos/<?php echo $driver_photos['image_name']; ?>"
                                            data-title="Biandintz eta zaldiak"
                                            data-description="Horses on Bianditz mountain, in Navarre, Spain."
                                            >
                                    </a>

                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="padding-top-10" >
                            <hr  >
                            <h3 class="headline"><?php echo $DRIVER->name; ?></h3>
                            <hr  >
                            <p><?php echo $DRIVER->description; ?></p>
                        </div>
                        <div class="review-button">
                            <a href="visitor/visitor-message.php?id=<?php echo $id; ?>&back=visitormessage" target="new"><button id="view-all-reviews" class="btncolor9 button border with-icon submit">Message Now</button></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container padding-bottom-35" data-aos="fade-down" data-aos-duration="3500" data-aos-delay="100">
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h3 class="headline ">Reviews (<?php echo $sum; ?>)</h3>
                        <hr>
                        <div class="col-md-4 col-sm-5 rating-breakdown">
                            <div class="col-md-12 rating-block">

                                <h2 class="bold padding-bottom-7"><?php echo $sum; ?> <small>/ <?php echo 5 * $divider; ?></small></h2>
                                <?php
                                for ($i = 1; $i <= $stars; $i++) {
                                    ?>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
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
                        <div class="col-md-8 col-sm-7 reviewrating ">
                            <div class="reviws-section">
                                <div class="review-carousel testimonials">
                                    <?php
                                    foreach (Reviews::getReviewsByDriver($DRIVER->id) as $review) {
                                        $VISITOR = new Visitor($review['visitor']);
                                        ?>
                                        <div class="col-md-12">

                                            <div class="col-md-3 col-sm-4 img-section reviewspts">
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
                                            <div class="col-md-9 col-sm-8">
                                                <h4 class=" reviews-title"><?php echo $VISITOR->name; ?></h4>
                                                <p><?php echo $review['message']; ?></p>

                                            </div> 

                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>


                            <?php if (count(Reviews::getReviewsByDriver($DRIVER->id)) > 0) {
                                ?>
                                <div class="review-button">
                                    <div class ="col-md-6 col-xs-12 col-sm-6">
                                        <a href="view-all-reviews.php?driver=<?php echo $id; ?>" ><button id="view-all-reviews" class="btncolor10 button border with-icon submit">View All Reviews</button></a>
                                    </div>

                                    <div class ="col-md-6 col-xs-12 col-sm-6 addreviewbtn">
                                        <a href="visitor/manage-reviews.php?driver=<?php echo $id; ?>" ><button id="view-all-reviews" class="btncolor11 button border with-icon submit">Add Reviews</button></a>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="review-button">
                                    <a href="visitor/manage-reviews.php?driver=<?php echo $id; ?>" ><button id="view-all-reviews" class="btncolor13 button border with-icon submit">Add Reviews</button></a>
                                </div>
                                <?php
                            }
                            ?>


                        </div>
                    </div>
                </div>

            </div>
            <section class="fullwidth  padding-top-45 padding-bottom-70" >
                <div class="container" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="100">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="headline  margin-bottom-45">
                                <hr>
                                More Drivers
                                <hr>
                            </h3>
                        </div>

                        <div class="col-md-12">
                            <div class="simple-fw-slick-carousel dots-nav">
                                <?php
                                $DRIVERS = Drivers::all();
                                foreach ($DRIVERS as $key => $driver) {
                                    if ($key < 5) {
                                        ?>
                                        <div  class="col-md-3 col-xs-12 more-items " style="margin-right:10px;">
                                            <a href="drivers-view-page.php?id=<?php echo $driver['id']; ?>">
                                                <h5  class="headline" style="font-family: 'Courgette', cursive;"><?php echo $driver['name']; ?></h5>
                                                <div class="col-md-5 col-xs-5 more-items-image">
                                                    <img  src="upload/driver/<?php echo $driver['profile_picture']; ?>"  class="img-circle" alt=""/>
                                                    <div class="more-reviews-item1">
                                                        <li>
                                                            <?php
                                                            $REVIEWS = Reviews::getTotalReviewsOfDriver($driver['id']);

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
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-xs-7">
                                                    <p  style="font-family: 'Courgette', cursive;" ><?php echo substr($driver['short_description'], 0, 65) . '...'; ?></p>
                                                </div>


                                            </a>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <?php include './footer.php'; ?>
        </div>

       <!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.js"></script>-->
        <script src="scripts/jquery_2.2.4.js" type="text/javascript"></script>
        <!-- load Galleria -->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/galleria/1.5.3/galleria.min.js"></script>-->
        <script src="scripts/galleria_1.5.3.min.js" type="text/javascript"></script>
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/galleria/1.5.3/themes/classic/galleria.classic.min.js"></script>-->
        <script src="scripts/galleria_1.5.3_galleria.classic.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                Galleria.run('#galleria');

            });

        </script>
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


    </body>
</html>
