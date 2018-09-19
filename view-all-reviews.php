<?php
include_once(dirname(__FILE__) . '/class/include.php');

$driver = '';
if (isset($_GET["driver"])) {
    $driver = $_GET["driver"];
}

$DRIVER = new Drivers($driver);


$DRIVER_PHOTOS = DriverPhotos::getDriverPhotosByDriver($driver);

$REVIEWS = Reviews::getTotalReviewsOfDriver($driver);

$divider = $REVIEWS['count'];
$sum = $REVIEWS['sum'];

$stars = $sum / $divider;
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
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/galleria.classic.min.css" rel="stylesheet" type="text/css"/>
        <!--reviws fonts-->
        <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet"> 
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
            .img-section img{
                margin-top:30px;
                border:6px solid #fff;
            }

            .reviws-section{
                /*                border: 1px solid #000;*/
                background:#F7F7F0;
                border-radius:3%;
                padding: 1% 1% 1% 1%;
                margin-bottom: 20px;
                width: 100%;
                height: 187px;

            }
            .reviews-title{
                margin-top:10px;
                font-family: 'Courgette', cursive;
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
                padding:7% 12% 7% 12%;
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
        </style>
    <body>
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container-fluid about-bg ">
                <div class="container">
                    <div class="rl-banner">
                        <h2 class="tp">ALL REVIEWS</h2>
                        <ul>
                            <?php
                            if ($driver) {
                                ?>
                                <li><a href="./">Home</a></li>
                                <li><span class="active">Drivers</span></li>
                                <li><span class="active"><?php echo $DRIVER->name; ?></span></li>
                                <?php
                            }
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="container padding-bottom-45 padding-top-45">
                <div class="row">
                    <div class="col-md-3" >


                        <div class="driver-profile-section" >

                            <div class="listing-item">
                                <?php
                                foreach (DriverPhotos::getDriverPhotosByDriver($DRIVER->id) as $key => $photo) {
                                    if ($key == 0) {
                                        ?>
                                        <img src="upload/drivers/driver-photos/thumb/<?php echo $photo['image_name']; ?>" alt="">
                                        <?php
                                    }
                                }
                                ?> 
                            </div>
                            <div class="img-pad "> 
                                <img src="upload/drivers/<?php echo $DRIVER->profile_picture; ?>" class="img-circle driver-list"/>
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
                            <div class="fa-item" style="padding: 3% 10% 3% 10%;background: #F7F7F0;">
                                <div class="row text-center">
                                    <a href="visitor/manage-reviews.php?driver=<?php echo $driver; ?>&back=driverreview" target="new" ><button id="view-all-reviews" class="button border with-icon submit">Add Your Review</button></a>
                                </div>
                            </div>

                        </div>
                        <div class="padding-top-20"></div>
                        <div class="">
                            <img src="images/side-banner/side-banner.jpg" alt=""/>
                        </div>

                    </div>
                    <div class="col-md-9">
                        <div class=" content">

                            <div class="">
                                <?php
                                foreach (Reviews::getReviewsByDriver($DRIVER->id) as $review) {
                                    $VISITOR = new Visitor($review['visitor']);
                                    ?>
                                    <div class="reviws-section">
                                        <div class="col-md-12">

                                            <div class="col-md-2 img-section">
                                                <img src="upload/visitor/<?php echo $VISITOR->profile_picture; ?>" class="img-circle"  alt=""/>
                                            </div>  
                                            <div class="col-md-7">
                                                <h4 class=" reviews-title"><?php echo $VISITOR->name; ?></h4>


                                            </div> 
                                            <div class="col-md-3 star-section">
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
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php include './footer.php'; ?>
        </div>

       <!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.js"></script>-->
        <script src="scripts/jquery_2.2.4.js" type="text/javascript"></script>
        <!-- load Galleria -->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/galleria/1.5.3/galleria.min.js"></script>-->
        <script src="scripts/galleria_1.5.3.min.js" type="text/javascript"></script>
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/galleria/1.5.3/themes/classic/galleria.classic.min.js"></script>-->
        <script src="scripts/galleria_1.5.3_galleria.classic.min.js" type="text/javascript"></script>

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



    </body>
</html>
