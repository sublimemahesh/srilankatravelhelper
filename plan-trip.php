<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}

$destinations = '';
$count = '';
$location = '';
$string = '';

if (isset($_SESSION['destination_cart'])) {
    $destinations = $_SESSION['destination_cart'];
    $count = count($destinations);
}

if (isset($_SESSION[''])) {
    $destinations = $_SESSION[''];
    $count = count($destinations);
}

foreach ($destinations as $des) {
    $destian = new Destination($des);
    $string .= "'" . $destian->desLocation . "',";
}

$dest_str = substr($string, 0, strlen($string) - 1);

$spentime = '';
foreach ($destinations as $des) {
    $destians = new Destination($des);
//    $spentime .= "'" . $destians->spend_time. "',";
    $spentime += $destians->spend_time;
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
        <!--<link href="lib/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" />
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/plan-trip.css" rel="stylesheet" type="text/css"/>
        <link href="css/aos.css" rel="stylesheet" type="text/css"/>


        <style>
            .review-button {
                margin-bottom: 70px;
            }
            .btn-success {
                background-color: #0dce38;
            }
            .btn-success:hover {
                background-color: #fff;
            }
            .time-box{
                box-shadow: rgba(0, 0, 0, 0.3) 5px 5px 5px;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container-fluid about-bg ">
                <div class="container">
                    <div class="rl-banner"  data-aos="fade-down" data-aos-easing="linear" data-aos-duration="3500">
                        <h2 class="tp">Plan Your Trip</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Plan Your Trip</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container margin-top-70 margin-bottom-55">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row location-search-title" data-aos="fade-right" data-aos-duration="3500" data-aos-delay="300">
                        </div>
                        <div id="plan-trip-input" class="main-search-input margin-bottom-80" data-aos="fade-left" data-aos-duration="3500" data-aos-delay="600">
                            <div class="main-search-input-item location">
                                <div id="autocomplete-container">
                                    <input  name="autocomplete" id="autocomplete" type="text" placeholder="Select a city">
                                    <input type="hidden" name="city" id="city"  value=""/>
                                    <input type="hidden" name="cityname" id="cityname"  value=""/>
                                </div>
                                <a href="#"><i class="fa fa-map-marker"></i></a>
                            </div>
                            <div class="main-search-input-item">
                                    <!--<select class="chosen-select" name="type" >-->
<!--                                                          <select class="dropDes" name="type" >-->
                                <select class="dropDes plandes" id="type" name="type" >
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
                            <button class="button" id="location-search-btn" >Search</button>
                        </div>

                    </div>



                    <div class="col-sm-8">
                        <!--<div class="row default-destination " id="search-content">-->
                             <div class="row default-destination " id="search-content">
                            <?php
                            foreach (Destination::getAllViews() as $key => $dess) {
                                if ($key < 20) {
                                    ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12 search-destination-item">
                                        <div class="listing-item col-md-5 col-sm-5 col-xs-5">
                                            <img src="upload/destination/<?php echo $dess['image_name']; ?>" alt="">
                                        </div>
                                        <div class="search-item-details col-md-7 col-sm-7 col-xs-7">

                                            <div class="driver-name text-left" title="<?php  echo $dess['name'];?>"> <?php  echo substr($dess['name'], 0, 20) . '...';?>  </div>

                                            <div class="driver-name text-left" title="<?php echo $dess['name']; ?>"> 
                                                <?php
                                                if (strlen($dess['name']) > 20) {
                                                    echo substr($dess['name'], 0, 20) . '...';
                                                } else {
                                                    echo $dess['name'];
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
                                                <div class="rating-counter">(<?php  if ($divider==0) {
                                                        echo 'No';
                                                    } else {
                                                        echo $divider; 
                                                    }  ?> reviews)</div><br>
                                            </div>


                                            <div style="margin-top: 0px;padding-bottom: 7px;">
                                                <p class="text-center " id="">


                                                    <?php echo substr($dess['short_description'], 0, 55) . '...'; ?>
                                                </p></div>
                                            <div class="button-section">
                                                <a href="destination-type-one-item-view-page.php?id=<?php echo $dess['id']; ?>" target="_blank">
                                                    <button class="btn btn-view"><i class="glyphicon glyphicon-link"></i></button>
                                                </a>
                                                <button class="btn btn-cart add-to-cart1" id="add-to-cart-<?php echo $dess['id']; ?>" destination-id="<?php echo $dess['id']; ?>" back="cart" location="<?php echo $dess['location']; ?>" spend_time="<?php echo $dess['spend_time']; ?>"  title="Add to Cart">
                                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>    
                        </div>
                        <div class="row" id="search-content">
                            
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <input type="hidden" class="dest" value="<?php echo $dest_str; ?>"/>
                        <input type="hidden" class="lonti" value="<?php echo $count ?>"/>



                        <div class="panel panel-default estimatetime">
                            <div class="panel-body time-box">
                                <div class="col-md-6 col-xs-8 col-sm-4">
                                    <label for="comment" class="estimateTime">Total Estimate Time  </label>
                                </div>   
                                <div class="col-md-6 col-xs-4 col-sm-4 spendt" >
                                    <input type="hidden" class="spendtime" value="<?php echo round($spentime / 60, 2) ?>"/>
                                    <input type="text" class="spendtime" disabled value="<?php echo round($spentime / 60, 2) ?> h" >
                                </div>  
                            </div>
                        </div>
                        <div id="map-canvas" class="desMap"></div>
                    </div>
                </div>
                <div class="row col-md-12 hidden" id="search-content1">
                    <h1>Other Nearby Destinations in <span id="city-name"></span> City</h1>
                    <hr />
                </div>

                <div class="row col-md-12 " id="search-content2">
                    <h1>Most Popular Cities In Sri Lanka</h1>
                    <hr />
                </div>

                <div class="col-md-12 nearbydestinations-carousel testimonials">
                    <?php
                    foreach (Location::getAllViews() as $key => $loc) {
                        if ($key < 10) {
                            ?>
                            <div id="nearbycities" >
                                <div class="city-body">
                                    <div class="package-location">
                                        <img src="upload/location/<?php echo $loc['image_name']; ?>" alt="">
                                    </div>
                                    <div class="package-details"><div class="package-places">
                                            <a href="destinations-by-city.php?city=<?php echo $loc['id']; ?>"><h4><?php echo $loc['name']; ?></h4></a>
                                            <div class="location-details">
                                                <span title="Bus"><i class="fa fa-bus" title="Bus"></i></span><br>
                                                <span title="Train"><i class="fa fa-train" title="Train"></i></span><br>
                                                <span title="Taxi"><i class="fa fa-car" title="Taxi"></i></span><br></div>
                                            <div class="details">
                                                <p>  <?php echo substr($loc['short_description'], 0, 95) . '...'; ?></p>
                                            </div>
                                        </div>
                                        <div class="package-ratings-review cities-view-btn">
                                            <a href="destinations-by-city.php?city=<?php echo $loc['id']; ?>" class="btn btn-success"> <span>View</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
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
<script src="scripts/add-to-cart_2.js" type="text/javascript"></script>
<script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script src="scripts/search-destination.js" type="text/javascript"></script>
<script src="scripts/near-by-destinations.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<script src="scripts/aos.js" type="text/javascript"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136795201-1"></script>
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

<!--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhjErF0IZ1O5pUQsSag23YgmvAo4OLngM&libraries=places&callback=initAutocomplete"
    async defer></script>-->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhjErF0IZ1O5pUQsSag23YgmvAo4OLngM&sensor=true&libraries=places&callback=initAutocomplete"></script>

<script>

    var map;
    var geocoder;
    var marker;
    var people = new Array();
    var latlng;
    var infowindow;

    $(document).ready(function () {
        ViewCustInGoogleMap();

        setTimeout(function () {

            $('#search-content').on('click', '.add-to-cart', function () {

                ViewCustInGoogleMap();
            });
        }, 3000);
    });

    function ViewCustInGoogleMap() {

        var mapOptions = {
            center: new google.maps.LatLng(8.231062, 80.217732),
            zoom: 7,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

        // Get data from database. It should be like below format or you can alter it.
//            alert($('.dest').val());

//            var convertedArray = stringToConvert.split();
//            console.log(convertedArray);

        var desti = $('.dest').val();

        desti = desti.replace(/'/g, '"');

//            desti = JSON.parse(desti);
        var destinations = JSON.parse("[" + desti + "]");
        var arr = '';
        $.each(destinations, function (key, destination) {
            arr += '{ "LatitudeLongitude": "' + destination + '" },';

        });

        de = arr.substring(0, arr.length - 1);

        var data = '[' + de + ']';
        people = JSON.parse(data);
        for (var i = 0; i < people.length; i++) {
            setMarker(people[i]);
        }

    }

    function setMarker(people) {
        geocoder = new google.maps.Geocoder();
        infowindow = new google.maps.InfoWindow();

        if ((people["LatitudeLongitude"] == null) || (people["LatitudeLongitude"] == 'null') || (people["LatitudeLongitude"] == '')) {
            geocoder.geocode({'address': people["Address"]}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                    marker = new google.maps.Marker({
                        position: latlng,
                        map: map,
                        draggable: false,
                        html: people["DisplayText"],
                        icon: "images/marker/" + people["MarkerId"] + ".png"
                    });
                    //marker.setPosition(latlng);
                    //map.setCenter(latlng);
                    google.maps.event.addListener(marker, 'click', function (event) {
                        infowindow.setContent(this.html);
                        infowindow.setPosition(event.latLng);
                        infowindow.open(map, this);
                    });
                } else {
//                        alert(people["DisplayText"] + " -- " + people["Address"] + ". This address couldn't be found");
                }
            });
        } else {
            var latlngStr = people["LatitudeLongitude"].split(",");
            var lat = parseFloat(latlngStr[0]);
            var lng = parseFloat(latlngStr[1]);
            latlng = new google.maps.LatLng(lat, lng);
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                draggable: false, // cant drag it
                html: people["DisplayText"]    // Content display on marker click
                        //icon: "images/marker.png"       // Give ur own image
            });
            //marker.setPosition(latlng);
            //map.setCenter(latlng);
            google.maps.event.addListener(marker, 'mouseover', function (event) {
                infowindow.setContent(this.html);
                infowindow.setPosition(event.latLng);
//                    infowindow.open(map, this);
            });
        }
    }
</script>

</html>