<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}

/* set page numbers */
if (isset($_GET["page"])) {
    $page = (int) $_GET["page"];
} else {
    $page = 1;
}
$setLimit = 10;
$pageLimit = ($page * $setLimit) - $setLimit;

$keyword = '';
$location = '';
if (isset($_GET['search'])) {
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
    }
    if (isset($_GET['location'])) {
        $location = $_GET['location'];
    }
    $DESTINATIONS = Destination::searchDestinations($keyword, $location, $pageLimit, $setLimit);
} else {
    $DESTINATIONS = Destination::getAllDestinations($pageLimit, $setLimit);
}
?>  
<!DOCTYPE html>
<html>

    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title>Destinations || Tour Sri Lanka</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
           ================================================== -->
        <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="css/component.css" rel="stylesheet" type="text/css"/>
        <link href="css/default.css" rel="stylesheet" type="text/css"/>
        <link href="lib/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/aos.css" rel="stylesheet" type="text/css"/>

        <style>
            .like-icon {
                padding: 8px 12px;
            }
        </style>
    </head>



    <body>
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container-fluid about-bg " >
                <div class="container" >
                    <div class="rl-banner" data-aos="fade-up" data-aos-duration="3500" >
                        <h2 class="tp">Destination</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Destinations</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="destinations-search main-search-inner" >
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-md-offset-3 col-sm-5 col-sm-offset-6 seabox" data-aos="fade-down" data-aos-duration="3500">
                            <form id="blog-search" action="all-destinations.php" method="get">
                                <div class=" main-search-input">

                                    <div class="main-search-input-item">
                                        <input type="text" placeholder="Keyword" name="keyword" id="keyword" value="" autocomplete="off">
                                    </div>

                                    <div class="main-search-input-item location">
                                        <div id="autocomplete-container">
                                            <input type="text" id="autocomplete" onFocus="geolocate()" placeholder="Location" autocomplete="off">
                                            <input type="hidden" name="location" id="location"  value=""/>
                                        </div>
                                        <a href="#" class="hidden-xs"><i class="fa fa-map-marker"></i></a>
                                    </div>
                                    <button class="button" name="search">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container padding-top-25  padding-bottom-45 destination-types-list">
                <div class="row">
                    <!-- Sidebar
                  ================================================== -->
                    <div class="col-lg-3 col-md-4 col-sm-5">
                        <div class="boxed-widget opening-hours margin-top-25" data-aos="fade-right" data-aos-duration="3500" data-aos-delay="300">

                            <h3><i class="fa fa-map-marker"></i>Destination Types</h3>
                            <ul>
                                <?php
                                $DESTINATIONTYPES = DestinationType::all();
                                foreach ($DESTINATIONTYPES as $key => $type) {
                                    $count = Destination::countTotalDestinationsOfType($type['id']);
                                    ?>
                                    <a href="destination-type-view-page.php?id=<?php echo $type["id"]; ?>" >
                                        <div class="dest-type col-md-12" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="300">
                                            <h4  title="<?php echo $type['name']; ?>">

                                                <?php
                                                if (strlen($type['name']) > 18) {
                                                    echo substr($type['name'], 0, 18) . '...';
                                                } else {
                                                    echo $type['name'];
                                                }
                                                ?>

                                            </h4>



                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <img src="upload/destination-type/<?php echo $type["image_name"]; ?>" alt="">
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <div class="col-sm-12">
                                                    <?php
                                                    $REVIEWS = Reviews::getTotalReviewsOfDestinationType($type['id']);

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
                                                    Destinations - <?php
                                                    if ($count['count'] < 10) {
                                                        echo '0' . $count['count'];
                                                    } else {
                                                        echo $count['count'];
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                }
                                ?>

                            </ul>
                        </div>

                    </div>
                    <!-- Sidebar / End -->
                    <div class="col-lg-9 col-md-8 col-sm-7 padding-right-30">
                        <!-- Sorting / Layout Switcher -->
                        <div class="row margin-bottom-25">
                        </div>
                        <div class="row">
                            <?php
                            foreach ($DESTINATIONS as $key => $destination) {
                                ?>
                                <!-- Listing Item -->
                                <div class="col-lg-12 col-md-12" data-aos="fade-right" data-aos-duration="3500" data-aos-delay="300">
                                    <div class="listing-item-container list-layout">
                                        <a href="destination-type-one-item-view-page.php?id=<?php echo $destination['id']; ?>" class="listing-item">

                                            <!-- Image -->
                                            <div class="listing-item-image">
                                                <img src="upload/destination/<?php echo $destination['image_name']; ?>" alt="">

                                            </div>

                                            <!-- Content -->
                                            <div class="listing-item-content">


                                                <div class="listing-item-inner">
                                                    <h3>
                                                        <?php echo $destination['name']; ?>

                                                    </h3>
                                                    <span class="para"><?php echo $destination['short_description']; ?></span>
                                                    <div class="star-rating">
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
                                                        <div class="rating-counter">(<?php echo $sum; ?> reviews)</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="listing-item-btn">
                                                <span class="like-icon add-to-cart" id="add-to-cart" destination-id="<?php echo $destination['id']; ?>" back="cart" title="Add to Cart"><i class="fa fa-cart-plus"></i></span>
                                                <span class="tag"style="background: #0dce38!important" >View </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- Listing Item / End -->
                                <?php
                            }
                            ?>
                        </div>
                        <!-- Pagination -->
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Pagination -->
                                <?php
                                if (isset($_GET['search'])) {
                                    ?>
                                    <div class="pagination-container margin-top-20 margin-bottom-40">
                                        <?php Destination::showPaginationOfSearchedDestinations($keyword, $location, $setLimit, $page); ?>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="pagination-container margin-top-20 margin-bottom-40">
                                        <?php Destination::showPaginationOfAllDestinations($setLimit, $page); ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- Pagination / End -->
                    </div>
                </div>
            </div>
            <?php include './footer.php'; ?>
        </div>
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
        <script src="desti/toucheffects.js" type="text/javascript"></script>
        <script src="css/modernizr.custom.js" type="text/javascript"></script>
        <script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="scripts/add-to-cart.js" type="text/javascript"></script>
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