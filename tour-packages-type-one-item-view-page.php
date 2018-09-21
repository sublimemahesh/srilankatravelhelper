<?php
include_once(dirname(__FILE__) . '/class/include.php');
$id = $_GET["id"];
$TOUR = new TourPackages($id);
$TOUR_TYPE = new TourType($TOUR->type);
$REVIEWS = Reviews::getTotalReviewsOfTour($id);

$divider1 = $REVIEWS['count'];
$sum1 = $REVIEWS['sum'];

$stars1 = $sum1 / $divider1;
?>
<!DOCTYPE html>
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
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet"> 
    <link href="css/lightbox.min.css" rel="stylesheet" type="text/css"/>
    <style>

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
            height:100%; 
            min-height: 170px;
            position: relative;

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
            padding-bottom: 100px;
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
                        <li><span class="active"><?php echo $TOUR_TYPE->name; ?></span></li>
                        <li><span class="active"><?php echo $TOUR->name; ?></span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container padding-bottom-45 padding-top-45">
            <div class="row">
                <div class="col-md-9">

                    <div class="item1">
                        <div class="padding-top-10">
                            <?php
                            $TOUR_DATE = TourDate::getTourDatesById($id);
                            foreach ($TOUR_DATE as $key => $tour_date) {
                                ?>
                                <hr  >
                                <h3 class="headline"><?php echo $tour_date['title']; ?></h3>
                                <hr >
                                <p><?php echo $tour_date['description']; ?></p>

                                <div class="image-row padding-bottom-100">
                                    <?php
                                    $TOUR_DATE_PHOTOS = TourDatePhoto::getTourDatePhotosById($tour_date['id']);
                                    foreach ($TOUR_DATE_PHOTOS as $key => $tour_photos) {
                                        ?>
                                        <div  class="col-md-3">
                                            <a class="example-image-link" href="upload/tour-package/date/gallery/<?php echo $tour_photos['image_name']; ?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="example-image" src="upload/tour-package/date/gallery/<?php echo $tour_photos['image_name']; ?>" alt="Golden Gate Bridge with San Francisco in distance"></a>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        
                    </div>
                    <div class="review-button">
                            <a href="booking.php?tour=<?php echo $id; ?>&back=booking" ><button id="view-all-reviews" class="button border with-icon submit">Book Now</button></a>
                        </div>
                </div>
                <div class="col-md-3" >
                    <div>
                        <h4 class="headline headline-more-items text-center " >More Tour Packages</h4>
                    </div>
                    <?php
                    $TOUR_PACKAGES = TourPackages::all();
                    foreach ($TOUR_PACKAGES as $key => $tour_package) {
                        if ($key < 7) {
                            ?>
                            <div  class="col-md-12 col-xs-12 more-items" >
                                <a href="tour-packages-type-one-item-view-page.php?id=<?php echo $tour_package['id']; ?>">
                                    <h5  class="headline" style="font-family: 'Courgette', cursive;"><?php echo $tour_package['name']; ?></h5>
                                    <div class="col-md-5 col-xs-5 more-items-image">
                                        <img  src="upload/tour-package/<?php echo $tour_package['image_name']; ?>"  class="img-circle" alt=""/>
                                        <div class="more-reviews-item1">
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
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <p  style="font-family: 'Courgette', cursive;" ><?php echo substr($tour_package['short_description'], 0, 65) . '...'; ?></p>
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

        <div class="container padding-bottom-35">
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    <h3 class="headline ">Reviews(<?php echo $sum1; ?>)</h3>
                    <hr>
                    <div class="col-md-4 rating-breakdown">
                        <div class="col-md-12 rating-block">

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
                        <!--                        <div class="col-md-12" style="background:#9d9d9d;margin-top: 20px;padding: 7% 12% 7% 12%;background-color: #F7F7F0;
                                                     border: 1px solid #F7F7F0;border-radius: 3%; ">
                        
                                                    <div class="pull-left" >
                                                        <div class="pull-left" style="width:35px; line-height:1;">
                                                            <div style="height:9px; margin:5px 0;">5 <span class="fa fa-star"></span></div>
                                                        </div>
                                                        <div class="pull-left" style="width:180px;">
                                                            <div class="progress" style="height:9px; margin:8px 0;">
                                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 1000%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pull-right" style="margin-left:10px;">1</div>
                                                    </div>
                                                    <div class="pull-left">
                                                        <div class="pull-left" style="width:35px; line-height:1;">
                                                            <div style="height:9px; margin:5px 0;">4 <span class="fa fa-star"></span></div>
                                                        </div>
                                                        <div class="pull-left" style="width:180px;">
                                                            <div class="progress" style="height:9px; margin:8px 0;">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: 80%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pull-right" style="margin-left:10px;">1</div>
                                                    </div>
                                                    <div class="pull-left">
                                                        <div class="pull-left" style="width:35px; line-height:1;">
                                                            <div style="height:9px; margin:5px 0;">3 <span class="fa fa-star"></span></div>
                                                        </div>
                                                        <div class="pull-left" style="width:180px;">
                                                            <div class="progress" style="height:9px; margin:8px 0;">
                                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: 60%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pull-right" style="margin-left:10px;">0</div>
                                                    </div>
                                                    <div class="pull-left">
                                                        <div class="pull-left" style="width:35px; line-height:1;">
                                                            <div style="height:9px; margin:5px 0;">2 <span class="fa fa-star"></span></div>
                                                        </div>
                                                        <div class="pull-left" style="width:180px;">
                                                            <div class="progress" style="height:9px; margin:8px 0;">
                                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: 40%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pull-right" style="margin-left:10px;">0</div>
                                                    </div>
                                                    <div class="pull-left">
                                                        <div class="pull-left" style="width:35px; line-height:1;">
                                                            <div style="height:9px; margin:5px 0;">1 <span class="fa fa-star"></span></div>
                                                        </div>
                                                        <div class="pull-left" style="width:180px;">
                                                            <div class="progress" style="height:9px; margin:8px 0;">
                                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: 20%">
                                                                    <span class="sr-only">80% Complete (danger)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pull-right" style="margin-left:10px;">0</div>
                                                    </div>
                                                </div>	-->
                    </div>	
                    <div class="col-md-8 ">
                        <div class="reviws-section">
                            <div class="review-carousel testimonials">
                                <?php
                                foreach (Reviews::getReviewsByTour($TOUR->id) as $review) {
                                    $VISITOR = new Visitor($review['visitor']);
                                    ?>
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
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                        <div class="review-button">
                            <a href="view-all-reviews.php?tour=<?php echo $id; ?>" ><button id="view-all-reviews" class="button border with-icon submit">View All Reviews</button></a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <?php include './footer.php'; ?>
    </div>
    <script src="scripts/jquery_2.2.4.js" type="text/javascript"></script>
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
    <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
    <script src="lib/owl/owl.carousel.min.js" type="text/javascript"></script>
    <script src="scripts/lightbox.min.js" type="text/javascript"></script>
    <script>
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
    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 5
                    },
                    1000: {
                        items: 5
                    },
                    1200: {
                        items: 5
                    }
                },
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                animateOut: true,
            });
        });
    </script>

</body>
</html>

