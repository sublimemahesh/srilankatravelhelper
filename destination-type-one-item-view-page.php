<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$id = $_GET["id"];
$DESTINATION = new Destination($id);
$DESTINATION_TYPE = new DestinationType($DESTINATION->type);

$REVIEWS = Reviews::getTotalReviewsOfDestination($id);

$divider1 = $REVIEWS['count'];
$sum1 = $REVIEWS['sum'];
if ($divider1 == 0) {
    $stars1 = 0;
    $sum1 = 0;
} else {
    $stars1 = $sum1 / $divider1;
}



$album = '';
if (isset($_GET['album'])) {
    $album = 'TRUE';
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
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/galleria.classic.min.css" rel="stylesheet" type="text/css"/>
        <!--reviws fonts-->
        <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet"> 
        <link href="lib/sliderPro/slider-pro.css" rel="stylesheet" type="text/css"/>
        <link href="css/destination-slider.css" rel="stylesheet" type="text/css"/>
        <link href="lib/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <style>
            /* This rule is read by Galleria to define the gallery height: */
            #galleria{height:480px}
            /*reviews*/
            .img-section img{
                margin-top:30px;
                border:6px solid #fff;
            }

            .reviws-section{
                /*                border: 1px solid #000;*/
                background:#F7F7F0;
                border-radius:3%;
                padding:0;
                margin-bottom: 20px;
                width: 100%;

            }
            .reviews-title{
                margin-top:10px;
                font-family: 'Courgette', cursive;
                margin-left: 10px;
            }
            .reviews-description{
                font-family: 'Courgette', cursive;

            }
            .package-ratings-review{
                padding-top: 10px;
                padding-bottom: 10px;
            }
            .package-ratings-review li{
                list-style-type: none;
                /*                border-left:1px solid #000;*/
            }
            .count-reviews{
                margin-top: 12px;
                font-size:19px;
            }
            .star-section{
                border-left:2px solid #e3d9d9;
                height:170px; 

            }
            .reviews-item1 li{
                color:#f5cf00;

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
            .rating-block{
                background-color:#F7F7F0;
                border:1px solid #F7F7F0;
                padding: 10% 12% 11% 12%;
                border-radius:3%;
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
            .read-more-reviews{
                color: #0dce38;
                text-decoration: none;
            }
            .read-more-reviews:hover{
                color: #0dce38;
                text-decoration: none;
            }
            .more-reviews-item1 li{
                color:#f5cf00;
                list-style-type: none;
                margin-bottom: 10px;
                font-size: 11px !important;

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
            @media(max-width:996px) {
                .btn-sm {
                    padding: 2px 6px;
                }
                .rating-block {
                    padding: 10% 3% 11% 9%;
                    height: 165px;
                }
            }

            /*jssor slider loading skin spin css*/
            .jssorl-009-spin img {
                animation-name: jssorl-009-spin;
                animation-duration: 1.6s;
                animation-iteration-count: infinite;
                animation-timing-function: linear;
            }

            @keyframes jssorl-009-spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }

        </style>
    </head>
    <body>

        <div id="wrapper" class="">
            <div class="view-destination <?php
            if ($album === 'TRUE') {
                echo 'hidden';
            }
            ?>" >
                     <?php include './header.php'; ?>
                <div class="container-fluid about-bg ">
                    <div class="container">
                        <div class="rl-banner">
                            <h2 class="tp">Destination</h2>
                            <ul>
                                <li><a href="./">Home</a></li>
                                <li><span class="active">Destination</span></li>
                                <li><span class="active"><?php echo $DESTINATION_TYPE->name; ?></span></li>
                                <li><span class="active"><?php echo $DESTINATION->name; ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>



                <div class="container padding-bottom-45 padding-top-45">
                    <div class="row">

                        <div class="col-md-9 col-sm-8">
                            <div class=" content">
                                <div class="col-md-12">
                                    <?php
                                    $DESTINATION_PHOTOS = DestinationPhotos::getDestinationByDestinationPhotos($id);
                                    $count = DestinationPhotos::countDestinationPhotosByDestination($id);
                                    foreach ($DESTINATION_PHOTOS as $key => $destination_photos) {
                                        if ($key === 0) {
                                            ?>
                                            <div class="large_photo_wrapper taller_box">
                                                <a href="?id=<?php echo $id; ?>&album=true">
                                                    <img src="upload/destination-photos/<?php echo $destination_photos['image_name']; ?>" alt="" class=""/>

                                                </a>
                                                <a href="?id=<?php echo $id; ?>&album=true">
                                                    <div class="caption" >
                                                        <span><i class="fa fa-camera" ></i>All photos (<?php echo $count['count']; ?>)</span>
                                                    </div>
                                                </a>
                                                <a href="?id=<?php echo $id; ?>&album=true">
                                                    <div class="full-view hidden" >
                                                        <span><i class="fa fa-expand" ></i>Full View</span>
                                                    </div>
                                                </a>

                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <div class="mini_mosaic_wrapper taller_box hidden-sm">
                                        <?php
                                        $countofmoreimgs = $count['count'] - 4;
                                        foreach ($DESTINATION_PHOTOS as $key => $destination_photos) {
                                            if ($key <> 0 && $key < 4) {
                                                ?>
                                                <div class="mini-img">
                                                    <a href="?id=<?php echo $id; ?>&album=true">
                                                        <img src="upload/destination-photos/thumb1/<?php echo $destination_photos['image_name']; ?>" alt=""/>
                                                    </a>
                                                    <a href="?id=<?php echo $id; ?>&album=true">
                                                        <div class="viewmoreimgs" >
                                                            <?php
                                                            if ($countofmoreimgs == 0) {
                                                                echo '';
                                                            } elseif ($countofmoreimgs == 1) {
                                                                ?>
                                                                <span>+ 1 photo</span>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <span>+ <?php echo $countofmoreimgs; ?> photos</span>
                                                                <?php
                                                            }
                                                            ?>

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
                            <div class="padding-top-10" >

                                <hr  >
                                <h3 class="headline"><?php echo $DESTINATION->name; ?></h3>
                                <hr  >
                                <p class="para">
                                    <?php echo $DESTINATION->description; ?>
                                </p> 

                            </div>
                            <div class="review-button">
                                <a href="#" ><button id="add-to-cart" destination-id="<?php echo $id; ?>" back="cart" class="button border with-icon submit add-to-cart">Add to Cart</button></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4" >
                            <div>
                                <h3 class="headline text-center" >More Destination</h3>
                            </div> 
                            <div class="row margin-left-4 ">

                                <?php
                                $DESTINATIONS = Destination::getDestinationById($DESTINATION->type);
                                foreach ($DESTINATIONS as $key => $destination) {
                                    if ($key < 7) {
                                        ?>

                                        <div  class="col-md-12 col-xs-12 more-items" >
                                            <a href="destination-type-one-item-view-page.php?id=<?php echo $destination['id']; ?>">
                                                <h5  class="headline" style="font-family: 'Courgette', cursive;"><?php echo $destination['name']; ?></h5>
                                                <div class="col-md-5 col-xs-5 more-items-image">
                                                    <img  src="upload/destination/thumb/<?php echo $destination['image_name']; ?>"  class="img-circle" alt=""/>
                                                    <div class="more-reviews-item1">
                                                        <li>
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
                                                        </li>
                                                        </li>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-xs-7">
                                                    <p  style="font-family: 'Courgette', cursive;" ><?php echo substr($destination['short_description'], 0, 65) . '...'; ?></p>
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
                <div class="container padding-bottom-35">
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <h3 class="headline ">Reviews(<?php echo $sum1; ?>)</h3>
                            <hr>
                            <div class="col-md-4 col-sm-3 rating-breakdown">
                                <div class="row">
                                    <div class="col-md-12  rating-block">
                                        <h2 class="bold padding-bottom-7"><?php echo $sum1; ?> <small>/ <?php echo 5 * $divider1; ?></small></h2>
                                        <?php
                                        for ($i = 1; $i <= $stars1; $i++) {
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
                                <div class="row">
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-9">
                                <div class="reviws-section">
                                    <div class="review-carousel testimonials">
                                        <?php
                                        foreach (Reviews::getReviewsByDestination($DESTINATION->id) as $review) {
                                            $VISITOR = new Visitor($review['visitor']);
                                            ?>
                                            <div class="col-md-12">

                                                <div class="col-md-2 col-sm-2 img-section">
                                                    <img src="upload/visitor/<?php echo $VISITOR->profile_picture; ?>" class="img-circle"  alt=""/>
                                                </div>  
                                                <div class="col-md-7 col-sm-7">
                                                    <h4 class=" reviews-title"><?php echo $VISITOR->name; ?></h4>
                                                    <p><?php echo $review['message']; ?></p>

                                                </div> 
                                                <div class="col-md-3 col-sm-3star-section">
                                                    <div class="package-ratings-review">
                                                        <ul class="two-column">
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
                                                                <div class="like-icon-section">
                                                                    <div class="col-md-4 like-icon-section-pd">
                                                                        <span class="like-icon"></span>
                                                                    </div>
                                                                    <div class="col-md-4 like-icon-section-pd">
                                                                        <span class="like-icon"></span>
                                                                    </div>
                                                                    <div class="col-md-4 like-icon-section-pd">
                                                                        <span class="like-icon "></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div> 
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="review-button">
                                    <a href="view-all-reviews.php?destination=<?php echo $id; ?>"<button id="view-all-reviews" class="button border with-icon submit">View All Reviews</button></a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <?php include './footer.php'; ?>
            </div>

            <div class="view-album <?php
            if ($album === '') {
                echo 'hidden';
            }
            ?>">
                <div class="slider-top col-md-12">
                    <a href="?id=<?php echo $id; ?>"><i class="fa fa-remove"></i></a>
                </div>
                <div id="example3" class="slider-pro col-md-9">

                    <div class="sp-slides">
                        <?php
                        $destinationid = $_GET['id'];
                        $DESTINATION_PHOTOS = DestinationPhotos::getDestinationByDestinationPhotos($destinationid);
//                        dd($DESTINATION_PHOTOS);
                        foreach ($DESTINATION_PHOTOS as $key => $destination_photos) {
                            ?>
                            <div class="sp-slide">
                                <img class="sp-image" src="../src/css/images/blank.gif" 
                                     data-src="upload/destination-photos/<?php echo $destination_photos['image_name']; ?>"
                                     data-small="upload/destination-photos/<?php echo $destination_photos['image_name']; ?>"
                                     data-medium="upload/destination-photos/<?php echo $destination_photos['image_name']; ?>"
                                     data-large="upload/destination-photos/<?php echo $destination_photos['image_name']; ?>"
                                     data-retina="upload/destination-photos/<?php echo $destination_photos['image_name']; ?>"/>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="sp-thumbnails">
                        <?php
                        foreach ($DESTINATION_PHOTOS as $key => $destination_photos) {
                            ?>
                            <img class="sp-thumbnail" src="upload/destination-photos/thumb/<?php echo $destination_photos['image_name']; ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="des-slider-topic col-md-3">
                    <div class="col-md-4 col-xs-4 col-sm-4">
                        <img src="upload/destination/<?php echo $DESTINATION->image_name; ?>" class="img-circle img-responsive" alt=""/>
                    </div>
                    <div class="col-md-8 col-xs-8 col-sm-8">
                        <h5 class="main-title">Destinations</h5>
                        <h5 class="sub-title"><b>Type</b> - <?php echo $DESTINATION_TYPE->name; ?></h5>
                        <h5 class="sub-title"><b>Title</b> - <?php echo $DESTINATION->name; ?></h5>
                    </div>
                </div>



            </div>
        </div>
        <script src="scripts/jquery_2.2.4.js" type="text/javascript"></script>
        <script src="scripts/galleria_1.5.3.min.js" type="text/javascript"></script>
        <script src="scripts/galleria_1.5.3_galleria.classic.min.js" type="text/javascript"></script>


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
        <script src="scripts/add-to-cart.js" type="text/javascript"></script>
        <script src="lib/sliderPro/jquery.sliderPro.js" type="text/javascript"></script>
        <script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {



                $('#example3').sliderPro({
                    width: 960,
                    height: 640,
                    fade: true,
                    arrows: true,
                    buttons: false,
                    fullScreen: true,
                    shuffle: false,
                    smallSize: 500,
                    mediumSize: 1000,
                    largeSize: 3000,
                    thumbnailArrows: true,
                    autoplay: false
                });
                var width = $(document).width();

                if (width > 996) {

                    setTimeout(function () {
                        $('.sp-thumbnails-container').addClass("hidden");
                        $('.sp-thumbnails-container').css("width", "100%");


                    }, 500);
                }
                $('.large_photo_wrapper').on('mouseover', function () {
                    $('.full-view').removeClass("hidden");
                });
                $('.large_photo_wrapper').on('mouseout', function () {
                    $('.full-view').addClass("hidden");
                });


            });

            $(document).ready(function () {
                var width = $(document).width();

                if (width > 996) {
                    $('.slider-pro').on('mouseover', '.sp-slides-container', function () {
                        $('.sp-thumbnails-container').removeClass("hidden");
                    });
                    $('.slider-pro').on('mouseout', '.sp-slides-container', function () {
                        $('.sp-thumbnails-container').addClass("hidden");
                    });
                    $('.sp-thumbnails-container').on('mouseover', function () {
                        $('.sp-thumbnails-container').removeClass("hidden");
                    });
                } else {
                    $('.sp-thumbnails-container').removeClass("hidden");
                }
            });
        </script>

    </body>
</html>
