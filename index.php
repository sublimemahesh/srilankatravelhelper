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
        <title>toursrilanka.travel | Tour Sri Lanka</title>
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
        <link href="css/plugins/harabara/font.css" rel="stylesheet" type="text/css"/>
        <link href="css/aos.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>
        <!-- Wrapper -->
        <div id="wrapper">

            <!-- Header Container
            ================================================== -->
            <?php include './header.php'; ?>

            <?php include './slider.php'; ?>
            <div class="main-search-inner  ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="blog-search" action="all-destinations.php" method="get">
                                <div class=" main-search-input">
                                    <div class="main-search-input-item location">
                                        <div id="autocomplete-container">
                                            <input type="text" id="autocomplete" onFocus="geolocate()" placeholder="Location" autocomplete="off">
                                            <input type="hidden" name="location" id="location"  value=""/>
                                        </div>
                                        <a href="#" class="hidden-xs"><i class="fa fa-map-marker"></i></a>
                                    </div>
                                    <div class="main-search-input-item">
                                        <!--<select class="chosen-select" name="type" >-->
<!--                                                          <select class="dropDes" name="type" >-->
                                        <select class="dropDes" name="type" >
                                            <option value=""> All Categories </option>
                                            <?php
                                            foreach (DestinationType::all() as $des) {
                                                ?>
                                                <option value="<?php echo $des['id']; ?>">
                                                    <?php echo $des['name']; ?></option>

                                            <?php }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="main-search-input-item">
                                        <input type="text" placeholder="Keyword" name="keyword" id="keyword" value="" autocomplete="off">
                                    </div>
                                    <button id="search-mobile" class="button" name="search">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Container / End -->
            <!-- Banner
                   ================================================== -->
            <!-- Info Section -->
            <div class="container margin-top-20 ">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3 class="headline centered margin-top-45 margin-bottom-45">
                            Plan The Vacation of Your Dreams
                        </h3>
                    </div>
                </div>
                <div class="row icons-container padding-bottom-30 popguide">
                    <div class="col-md-4 col-sm-4" data-aos="fade-right" data-aos-duration="3500" >
                        <div class="work-process">
                            <div class="process-img">
                                <img src="images/icons/tour-1.png" class="img-responsive" alt="">
                                <span class="process-num">01</span>
                            </div>
                            <h4>Select Your Location</h4>
                            <p>Choose places where you want to get an unforgettable experience that you dream of.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="300">
                        <div class="work-process">
                            <div class="process-img">
                                <img src="images/icons/tour-2.png" class="img-responsive" alt="">
                                <span class="process-num">02</span>
                            </div>
                            <h4>Select Your Driver</h4>
                            <p>Choose a person who can give more professional service with trustworthy and will guide you to reach the maximum thrilling experience.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4" data-aos="fade-left" data-aos-duration="3500" data-aos-delay="600">
                        <div class="work-process ">
                            <div class="process-img">
                                <img src="images/icons/tour-3.png" class="img-responsive" alt="">
                                <span class="process-num">03</span>
                            </div>
                            <h4>Enjoy Your Vacation</h4>
                            <p>Enjoy your vacation with us and get unforgettable memories to your life.</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Info Section / End -->
            <!-- Content
            ================================================== -->
            <div class="container ">
                <div class="row">
                    <div class="col-md-12 ">
                        <h3 class="headline centered margin-top-45 margin-bottom-45 ">
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
                                <div class="category-box-container" data-aos="fade-down" data-aos-duration="3500" data-aos-delay="400">
                                    <a href="destination-type-view-page.php?id=<?php echo $destination_type['id']; ?>" class="category-box" data-background-image="upload/destination-type/<?php echo $destination_type['image_name']; ?>">
                                        <div class="category-box-content">
                                            <h3><?php echo $destination_type['name']; ?></h3>
                                            <span>67 views</span>
                                        </div>
                                        <span class="category-box-btn"> Browse</span>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- Categories Carousel / End -->
            <!-- Parallax -->
            <div class="parallax"
                 data-background="images/banner/banner-travel.jpg"
                 data-color="#36383e"
                 data-color-opacity="0.6"
                 data-img-width="800"
                 data-img-height="505">

                <!-- Infobox -->
                <div class="text-content text-content1 white-font padding-top-70 padding-bottom-65 " >
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 col-sm-12 welcometext " data-aos="fade-up" data-aos-duration="3500" data-aos-easing="ease-in-sine">
                                <h2>Explore Sri Lanaka</h2>
                                <p style="font-size: 14 px; font-weight: 200;line-height: 29px!important">Sri Lanka is an island with scenic beauty and ancient ruins, religious shrines (the Cultural Triangle), national parks and wildlife sanctuaries, charming traditional buildings, a pastoral way of life contrasting with the hubbub of the towns and cities, brilliant beaches and a salubrious climate.</p>
                                <a href="#" class="btncolor1 button margin-top-25 mt-xs-8 mb-xs-8 mt-sm-8 mb-sm-15 ">Plan Your Trip</a>
                            </div>
                            <div class="col-lg-7 col-sm-12 youmargin" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="300">
                                <iframe width="677" height="377" src="https://www.youtube.com/embed/s8VNJ88AFWw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Infobox / End -->
            </div>
            <!-- Parallax / End -->
            <!-- Recent Blog Posts -->
            <section class="fullwidth  padding-top-70 padding-bottom-60 " data-background-color="#fff" >
                <div class="container">

                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="headline centered margin-bottom-45">
                                Best Ready-made Tour Packages
                            </h3>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="3500">
                        <!-- Blog Post Item -->
                        <div class="col-md-12 ">
                            <div class="ready-made-slick-carousel dots-nav">
                                <?php
                                $TOUR_TYPES = TourType::all();
                                foreach ($TOUR_TYPES as $key => $tour_type) {
                                    if ($key < 8) {
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
                                                                    <div class="rating-counter-tour">(<?php
                                                                        if ($divider == 0) {
                                                                            echo 'No';
                                                                        } else {
                                                                            echo $divider;
                                                                        }
                                                                        $divider;
                                                                        ?> reviews)</div><br/>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <h3><?php echo $tour_type['name']; ?></h3>
                                                        <p><?php echo substr($tour_type['short_description'], 0, 170) . '...'; ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Blog post Item / End -->
                        <!--                        <div class="col-md-12 centered-content">
                                                    <a href="#" class="button border margin-top-10 btncolor2">View More</a>
                                                </div>-->
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
                <section class="fullwidth  padding-bottom-50"  >

                    <!-- Info Section -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 margin-top-70" data-aos="fade-down" data-aos-duration="3500" data-aos-delay="600">
                                <h3 class="headline testimonial-h3 centered text-content white-font" style="padding:0px 0px!important;">
                                    Testimonials
                                    <span class="testimonial-p margin-top-25">We collect reviews from our users so you can get an honest opinion of what an experience with our website are really like!</span>
                                </h3>
                            </div>
                        </div>

                    </div>
                    <!-- Info Section / End -->
                    <!-- Categories Carousel -->
                    <div class="fullwidth-carousel-container ">
                        <div class="testimonial-carousel testimonials" data-aos="fade-up" data-aos-duration="3500">

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
            <!-- Fullwidth Section -->
            <section class="fullwidth  padding-top-70 padding-bottom-35" data-background-color="#f8f8f8" >
                <div class="container">
                    <div class="row" >
                        <div class="col-md-12">
                            <h3 class="headline centered margin-bottom-45">
                                Top Rated Drivers
                            </h3>
                        </div>
                        <div class="col-md-12 indexdri">
                            <div class="simple-slick-carousel dots-nav">
                                <?php
                                $SORTOFDRIVERS = Reviews::getDriversSortByReviews();
                                foreach ($SORTOFDRIVERS as $key => $sortdriver) {
                                    if ($key < 7) {
                                        if ($sortdriver != 0) {
                                            $DRIVER = new Drivers($sortdriver);
                                            ?>
                                            <div class="carousel-item" data-aos="fade-left" data-aos-duration="3500">

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
                                                        <div class="rating-counter">(<?php
                                                            if ($divider == 0) {
                                                                echo 'No';
                                                            } else {
                                                                echo $divider;
                                                            }
                                                            ?> reviews)</div><br/>
                                                    </div>

                                                    <div class="indexdri"style="margin-top: 15px;padding-bottom: 7px;">
                                                        <p class="text-center" id="">
                                                            <?php echo substr($DRIVER->short_description, 0, 140) . '...'; ?>
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>

                                            <?php
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
        <script src="scripts/aos.js" type="text/javascript"></script>
        <script>
                                                AOS.init();
        </script>
        <script>
            //Google Location Autocomplete
            var placeSearch, autocomplete;

            function initAutocomplete() {
                // Create the autocomplete object, restricting the search to geographical
                // location types.
                var options = {
                    types: ['(cities)'],
                    componentRestrictions: {country: "lk"}
                };
                var input = document.getElementById('autocomplete');

                autocomplete = new google.maps.places.Autocomplete(input, options);

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                autocomplete.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();
                $('#location').val(place.place_id);
//                $('#longitude').val(place.geometry.location.lng());
//                $('#latitude').val(place.geometry.location.lat());
                for (var component in componentForm) {
                    document.getElementById(component).value = '';
                    document.getElementById(component).disabled = false;
                }

                // Get each component of the address from the place details
                // and fill the corresponding field on the form.
            }

            // Bias the autocomplete object to the user's geographical location,
            // as supplied by the browser's 'navigator.geolocation' object.
            function geolocate() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        var circle = new google.maps.Circle({
                            center: geolocation,
                            radius: position.coords.accuracy
                        });
                        autocomplete.setBounds(circle.getBounds());
                    });
                }
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhjErF0IZ1O5pUQsSag23YgmvAo4OLngM&libraries=places&callback=initAutocomplete"
        async defer></script>
    </body>
</html>