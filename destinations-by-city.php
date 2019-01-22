<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$city = '';
if (isset($_GET['city'])) {
    $city = $_GET['city'];
}

$LOCATION = new Location($city);
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
        <link href="lib/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/plan-trip.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/aos.css" rel="stylesheet" type="text/css"/>

        <style>
            .review-button {
                margin-bottom: 70px;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container-fluid about-bg ">
                <div class="container">
                    <div class="rl-banner" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="3500">
                        <h2 class="tp">Destinations By City</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Destinations By City</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container margin-top-70 margin-bottom-55" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="300">
                <div class="row col-md-10 col-md-offset-1">
                    <div class="city-item">
                        <div class="col-md-12 col-sm-12 col-xs-12 search-destination-inner">
                            <div class="listing-item col-md-3 col-sm-3 col-xs-12">
                                <img src="upload/location/<?php echo $LOCATION->imagename; ?>" alt=""/>
                            </div>
                            <div class="search-item-details col-md-9 col-sm-9 col-xs-12">
                                <div class="driver-name text-left"> 
                                    <?php echo $LOCATION->name; ?>
                                </div>
                                <div style="margin-top: 0px;padding-bottom: 7px;">
                                    <p class="text-center " id="">

                                        <?php
                                        if (strlen($LOCATION->description) > 650) {
                                            echo substr($LOCATION->description, 0, 650) . '...';
                                        } else {
                                            echo $LOCATION->description;
                                        }
                                        ?>


                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="row col-md-12" id="search-content">
                    <h1>Destinations in <?php echo $LOCATION->name; ?> City</h1>
                    <hr />
                    <?php
                    foreach (Destination::getDestinationsByCityID($LOCATION->placeid) as $destination) {
                        ?>

                        <div class="search-cities col-md-4 col-sm-6 col-xs-12 search-destination-item" data-aos="fade-up" data-aos-duration="3500">
                            <div class="col-md-12 col-sm-12 col-xs-12 search-destination-inner">
                                <div class="listing-item col-md-5 col-sm-5 col-xs-5">
                                    <img src="upload/destination/<?php echo $destination['image_name']; ?>" alt=""/>
                                </div>
                                <div class="search-item-details col-md-7 col-sm-7 col-xs-7">
                                    <div class="driver-name text-left" title="<?php echo $destination['name']; ?>"> 

                                        <?php
                                        if (strlen($destination['name']) > 14) {
                                            echo substr($destination['name'], 0, 14) . '...';
                                        } else {
                                            echo $destination['name'];
                                        }
                                        ?>

                                    </div>
                                    <div class="star-rating-fa">
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
                                        <div class="rating-counter">(<?php echo $sum; ?> reviews)</div><br>
                                    </div>
                                    <div style="margin-top: 0px;padding-bottom: 7px;">
                                        <p class="text-center " id="">
                                            <?php echo substr($destination['short_description'], 0, 55) . '...'; ?>
                                        </p>
                                    </div>
                                    <div class="button-section">
                                        <a href="destination-type-one-item-view-page.php?id=<?php echo $destination['id']; ?>" target="_blank"><button class="btn btn-view"><i class="glyphicon glyphicon-link" ></i></button></a>
                                        <button class="btn btn-cart add-to-cart" id="add-to-cart-<?php echo $destination['id']; ?>" destination-id="<?php echo $destination['id']; ?>" back="cart" title="Add to Cart"><i class="glyphicon glyphicon-shopping-cart" ></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>


                </div>
                <div class="row col-md-12" id="search-content">
                    <h1>Next To Go</h1>
                    <hr />

                    <div class="nearbycities-carousel testimonials simple-slick-carousel-dest dots-nav">
                        <?php
                        $nearbycities = unserialize($LOCATION->nearbycities);
                        if ($nearbycities) {
                            foreach (Location::getLocationsExceptThisLocation($LOCATION->id) as $key => $city) {
                                $count = 1;
                                if (in_array($city['id'], $nearbycities)) {
                                    if ($count < 5) {
                                        $location_details = LocationDetails::getLocationDetailsByRelatedLocationAndLocaion($LOCATION->id, $city['id']);
                                        ?>
                                        <div class="col-md-3 col-sm-6 col-xs-12 carousel-item"  data-aos="fade-right" data-aos-duration="3500">

                                            <div class="city-body">
                                                <div class="package-location">
                                                    <img src="upload/location/<?php echo $city['image_name']; ?>" alt="">

                                                </div>
                                                <div class="package-details">
                                                    <div class="package-places">
                                                        <a href="destinations-by-city.php?city=<?php echo $city['id']; ?>">
                                                            <h4><?php echo $city['name']; ?></h4>
                                                        </a>
                                                        <?php
                                                        if ($location_details) {
                                                            ?>
                                                            <div class="location-details">
                                                                <span title="Bus"><i class="fa fa-bus" title="Bus"></i> <?php echo $location_details['bus_hour'] . 'h (' . $location_details['bus_distance'] . 'km)'; ?></span><br />
                                                                <span title="Train"><i class="fa fa-train" title="Train"></i> <?php echo $location_details['train_hour'] . 'h (' . $location_details['train_distance'] . 'km)'; ?></span><br />
                                                                <span title="Taxi"><i class="fa fa-car" title="Taxi"></i> <?php echo $location_details['taxi_hour'] . 'h (' . $location_details['taxi_distance'] . 'km)'; ?></span>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="location-details">
                                                                <span title="Bus"><i class="fa fa-bus" title="Bus"></i> - </span><br />
                                                                <span title="Train"><i class="fa fa-train" title="Train"></i> - </span><br />
                                                                <span title="Taxi"><i class="fa fa-car" title="Taxi"></i> - </span>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>

                                                        <div class="details">
                                                            <p><?php echo substr($city['short_description'], 0, 100) . '...'; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="package-ratings-review cities-view-btn">
                                                        <a href="destinations-by-city.php?city=<?php echo $city['id']; ?>" class="btn btn-success edit-view"> <span>View</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $count++;
                                    }
                                }
                            }
                        } else {
                            echo 'No any nearby cities in the database';
                        }
                        ?>
                    </div>

                </div>

            </div>
            <?php include './footer.php'; ?>
        </div>
    </body>
    <!-- Scripts
     ================================================== -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
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
    <script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="scripts/search-destination.js" type="text/javascript"></script>
    <script src="scripts/aos.js" type="text/javascript"></script>
    <script>
        AOS.init();
    </script>
    <script>
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
            $('#city').val(place.place_id);
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
</html>