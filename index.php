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
        <title>Tour Sri Lanka</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- CSS
        ================================================== -->
        <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!--font-awesome css-->
        <link href="slider css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Revolution Slider -->
        <link href="slider-css/revolution_layers.css" rel="stylesheet" type="text/css"/>
        <link href="slider-css/revolution_navigation.css" rel="stylesheet" type="text/css"/>
        <link href="slider-css/revolution_settings.css" rel="stylesheet" type="text/css"/>
        <!-- custome css -->
        <link href="slider css/style.css" rel="stylesheet" type="text/css"/>
         <!-- responsive css -->
         <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <!-- Wrapper -->
        <div id="wrapper">

            <!-- Header Container
            ================================================== -->
            <?php include './header.php'; ?>
            <?php include './slider.php'; ?>

            <!-- Header Container / End -->
            <!-- Banner
                   ================================================== -->
            <!-- Info Section -->
            <div class="container margin-top-20 ">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="headline centered margin-top-45">
                            Plan The Vacation of Your Dreams
                        </h2>
                    </div>
                </div>
                <div class="row icons-container padding-bottom-30">
                    <!-- Stage -->
                    <!--                <div class="col-md-4">
                                        <div class="icon-box-2 with-line">
                                            <i class="im im-icon-Map2"></i>
                                            <h3>Find Interesting Place</h3>
                                            <p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
                                        </div>
                                    </div>
                                     Stage
                                    <div class="col-md-4">
                                        <div class="icon-box-2 with-line">
                                            <i class="im im-icon-Mail-withAtSign"></i>
                                            <h3>24/7/365 Help</h3>
                                            <p>Maecenas pulvinar, risus in facilisis dignissim, quam nisi hendrerit nulla, id vestibulum metus nullam viverra porta purus.</p>
                                        </div>
                                    </div>
                   
                                     Stage
                                    <div class="col-md-4">
                                        <div class="icon-box-2">
                                            <i class="im im-icon-Checked-User"></i>
                                            <h3>Make a Reservation</h3>
                                            <p>Faucibus ante, in porttitor tellus blandit et. Phasellus tincidunt metus lectus sollicitudin feugiat pharetra consectetur.</p>
                                        </div>
                                    </div>-->
                    <div class="col-md-4 col-sm-4">
                        <div class="work-process">
                            <div class="process-img">
                                <img src="images/icons/tour-1.png" class="img-responsive" alt="">
                                <span class="process-num">01</span>
                            </div>
                            <h4>Choose a Destination &amp; Guide</h4>
                            <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="work-process">
                            <div class="process-img">
                                <img src="images/icons/tour-2.png" class="img-responsive" alt="">
                                <span class="process-num">02</span>
                            </div>
                            <h4>Choose your guide &amp; Customize</h4>
                            <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="work-process">
                            <div class="process-img">
                                <img src="images/icons/tour-3.png" class="img-responsive" alt="">
                                <span class="process-num">03</span>
                            </div>
                            <h4>Book Your Guide Online</h4>
                            <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers.</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Info Section / End -->
            <!-- Content
            ================================================== -->
            <div class="container ">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="headline centered margin-top-45 margin-bottom-45">
                            Popular Destinations of Sri Lanka
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Categories Carousel -->
            <div class="fullwidth-carousel-container margin-bottom-50 ">
                <div class="fullwidth-slick-carousel category-carousel">
                    <?php
                    $DESTINATION_TYPES = DestinationType::all();
                    foreach ($DESTINATION_TYPES as $key => $destination_type) {
                        if ($key < 6) {
                            ?>

                            <div class="fw-carousel-item">
                                <div class="category-box-container">
                                    <a href="destination-type-view-page.php?id=<?php echo $destination_type['id']; ?>" class="category-box" data-background-image="upload/destination-type/<?php echo $destination_type['image_name']; ?>">
                                        <div class="category-box-content">
                                            <h3><?php echo $destination_type['name']; ?></h3>
                                            <span>67 views</span>
                                        </div>
                                        <span class="category-box-btn"> Browse</span>
                                    </a>
                                </div>
                            </div>
            <!--                    <img src="upload/destination-type/-109984423_191093156483_1530173407_n.jpg">-->
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- Categories Carousel / End -->
            <!-- Parallax -->
            <div class="parallax"
                 data-background="images/banner/Travel1.jpg"
                 data-color="#36383e"
                 data-color-opacity="0.6"
                 data-img-width="800"
                 data-img-height="505">

                <!-- Infobox -->
                <div class="text-content text-content1 white-font padding-top-70 padding-bottom-65 ">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 col-sm-8">
                                <h2>Explore Sri Lanaka</h2>
                                <h4 style="font-size: 24px;
                                    font-weight: 300;
                                    color: #fff;
                                    padding-top: 0px;
                                    line-height: 32px">Determine Your Destination</h4>
                                <p style="font-size: 18px; font-weight: 200;line-height: 29px!important">We’re full-service, local agents who know how to find people and home each together. We use online tools with an unmatched search capability to make you smarter and faster.</p>
                                <a href="#" class="button margin-top-25">Plan Your Trip</a>
                            </div>
                            <div class="col-lg-7 col-sm-8">
                                <iframe width="677" height="377" src="https://www.youtube.com/embed/s8VNJ88AFWw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Infobox / End -->
            </div>
            <!-- Parallax / End -->
            <!-- Recent Blog Posts -->
            <section class="fullwidth  padding-top-70 padding-bottom-60 " data-background-color="#fff">
                <div class="container">

                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="headline centered margin-bottom-45">
                                Best Tailor Made Tour Packages
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Blog Post Item -->
                        <?php
                        $TOUR_TYPES = TourType::all();
                        foreach ($TOUR_TYPES as $key => $tour_type) {
                            if ($key < 3) {
                                ?>
                                <div class="col-md-4">
                                    <a href="tour-packages-type.php?=<?php echo $tour_type['id']; ?>" class="blog-compact-item-container">
                                        <div class="blog-compact-item">
                                            <img src="upload/tour-type/<?php echo $tour_type['image_name']; ?>" alt="">
                                            <span class="blog-item-tag" style="background: #0dce38!important">View</span>
                                            <div class="blog-compact-item-content">
                                                <ul class="blog-post-tags">
                                                    <li><div class="star-rating-fa text-right">
                                                            <?php
                                                            $REVIEWS = Reviews::getTotalReviewsOfTourType($tour_type['id']);

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
                                                            <div class="rating-counter-tour">(<?php echo $sum; ?> reviews)</div><br/>
                                                        </div></li>
                                                </ul>
                                                <h3><?php echo $tour_type['name']; ?></h3>
                                                <p><?php echo substr($tour_type['short_description'], 0, 150) . '...'; ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                        }
                        ?>

                        <!-- Blog post Item / End -->
                        <div class="col-md-12 centered-content">
                            <a href="#" class="button border margin-top-10">View More</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Recent Blog Posts / End -->
            <div class="parallax"
                 data-background="images/banner/banner-3.jpg"
                 data-color="#36383e"
                 data-color-opacity="0.6"
                 data-img-width="800"
                 data-img-height="505" id="driver">
                <section class="fullwidth  padding-bottom-50" >

                    <!-- Info Section -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 margin-top-70">
                                <h3 class="headline centered text-content white-font" style="padding:0px 0px!important;">
                                    Testimonials
                                    <span class="margin-top-25">We collect reviews from our users so you can get an honest opinion of what an experience with our website are really like!</span>
                                </h3>
                            </div>
                        </div>

                    </div>
                    <!-- Info Section / End -->
                    <!-- Categories Carousel -->
                    <div class="fullwidth-carousel-container ">
                        <div class="testimonial-carousel testimonials">

                            <?php
                            $COMMENTS = Comments::all();
                            foreach ($COMMENTS as $key => $comment) {
                                ?>
                                <div class="fw-carousel-review">
                                    <div class="testimonial-box">
                                        <div class="testimonial"><?php echo $comment["comment"] ?></div>
                                    </div>
                                    <div class="testimonial-author">
                                        <img src="upload/comments/<?php echo $comment["image_name"] ?>" alt="">
                                        <h4><?php echo $comment["name"] ?><span><?php echo $comment["title"] ?></span></h4>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>

                    <!-- Categories Carousel / End -->
                </section>
            </div>
            <!-- Flip banner -->
            <a href="#" class="flip-banner parallax " data-background="images/banner/banner-3.jpg" data-color="#0dce38" data-color-opacity="0.85" data-img-width="2500" data-img-height="1666">
                <div class="flip-banner-content">
                    <h2 class="flip-visible">Expolore top-rated attractions nearby</h2>
                    <h2 class="flip-hidden">View More<i class="sl sl-icon-arrow-right"></i></h2>
                </div>
            </a>
            <!-- Flip banner / End -->
            <!-- Fullwidth Section -->
            <section class="fullwidth  padding-top-70 padding-bottom-60" data-background-color="#f8f8f8">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="headline centered margin-bottom-45">
                                Top Rated Drivers
                            </h3>
                        </div>
                        <div class="col-md-12">
                            <div class="simple-slick-carousel dots-nav">
                                <?php
                                $DRIVERS = Drivers::all();
                                foreach ($DRIVERS as $key => $driver) {
                                    if ($key < 6) {
                                        ?>
                                        <?php
                                        $SORTOFDRIVERS = Reviews::getDriversSortByReviews();
                                        foreach ($SORTOFDRIVERS as $key => $sortdriver) {

                                            if ($sortdriver != 0) {
                                                $DRIVER = new Drivers($sortdriver);
                                                ?>
                                                <div class="carousel-item">

                                                    <a href="drivers-view-page.php?id=<?php echo $DRIVER->id; ?>" class="listing-item-container">

                                                        <div class="listing-item">
                                                            <?php
                                                            $count = DriverPhotos::countDriverPhotosByDriver($DRIVER->id);
                                                            if ($count['count'] == 0) {
                                                                ?>
                                                                <img src = "upload/driver/driver-photos/thumb/sample.jpg" alt = "">
                                                                <?php
                                                            } else {
                                                                foreach (DriverPhotos::getDriverPhotosByDriver($DRIVER->id) as $key => $photo) {

                                                                    if ($key == 0) {
                                                                        ?>
                                                                        <img src="upload/driver/driver-photos/thumb/<?php echo $photo['image_name']; ?>" alt="">
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?> 
                                                        </div>

                                                        <div class="img-pad">

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
                                                        <div class="driver-name text-left"> 
                                                            <?php echo $DRIVER->name; ?>
                                                        </div>
                                                        <div class="star-rating-fa text-right"> 
                                                            <?php
                                                            $REVIEWS = Reviews::getTotalReviewsOfDriver($DRIVER->id);

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
                                                            <div class="rating-counter">(<?php echo $sum; ?> reviews)</div><br/>
                                                        </div>

                                                        <div style="margin-top: 15px;padding-bottom: 7px;">
                                                            <p class="text-center " id="">
                                                                <?php echo substr($DRIVER->short_description, 0, 140) . '...'; ?>
                                                            </p>
                                                        </div>
                                                    </a>
                                                </div>

                                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>



                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include './footer.php'; ?>
            <!-- Back To Top Button -->
            <div id="backtotop"><a href="#"></a></div>
        </div>
        <!-- Wrapper / End -->
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


        <!-- jquery latest version -->
        <script src="slider css/jquery-3.2.0.min.js" type="text/javascript"></script>
        <!-- chossen js -->
        <script src="slider-css/chosen.jquery.min.js" type="text/javascript"></script>
        <script src="slider-css/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
        <script src="slider-css/jquery.themepunch.tools.min.js" type="text/javascript"></script>
        <!-- Revolution Extensions -->

        <script src="slider-css/revolution.extension.actions.min.js" type="text/javascript"></script>
        <script src="slider-css/revolution.extension.carousel.min.js" type="text/javascript"></script>
        <script src="slider-css/revolution.extension.kenburn.min.js" type="text/javascript"></script>
        <script src="slider-css/revolution.extension.layeranimation.min.js" type="text/javascript"></script>
        <script src="slider-css/revolution.extension.migration.min.js" type="text/javascript"></script>
        <script src="slider-css/revolution.extension.navigation.min.js" type="text/javascript"></script>
        <script src="slider-css/revolution.extension.parallax.min.js" type="text/javascript"></script>
        <script src="slider-css/revolution.extension.slideanims.min.js" type="text/javascript"></script>
        <script src="slider-css/revolution.extension.video.min.js" type="text/javascript"></script>
        <script src="slider-css/revolution.js" type="text/javascript"></script>

    </body>
</html>