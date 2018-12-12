<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}

$destinations = '';
$count = '';
if (isset($_SESSION['destination_cart'])) {
    $destinations = $_SESSION['destination_cart'];
    $count = count($destinations);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title>Plan Your Trip || Tour Sri Lanka</title>
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
                    <div class="rl-banner">
                        <h2 class="tp">Plan Your Trip</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Plan Your Trip</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container margin-top-70 margin-bottom-55">
                <div class="row col-md-6 col-md-offset-3">
                    <div class="row location-search-title">
                        Enter city to find destinations
                    </div>
                    <div class="main-search-input">
                        <div class="main-search-input-item location">
                            <div id="autocomplete-container">
                                <input  name="autocomplete" id="autocomplete" type="text" placeholder="Select a city">
                                <input type="hidden" name="city" id="city"  value=""/>
                                <input type="hidden" name="cityname" id="cityname"  value=""/>
                            </div>
                            <a href="#"><i class="fa fa-map-marker"></i></a>
                        </div>
                        <button class="button" id="location-search-btn" >Search</button>
                    </div>
                </div>

                <div class="row" id="search-content">
                </div>
                <div class="row col-md-12 hidden" id="search-content1">
                    <h1>Other Nearby Destinations in <span id="city-name"></span> City</h1>
                    <hr />
                    <div class="nearbydestinations-carousel testimonials">
                        <div id="nearbycities" ></div>

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
    <script src="scripts/near-by-destinations.js" type="text/javascript"></script>
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
            $('#cityname').val(place.name);
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