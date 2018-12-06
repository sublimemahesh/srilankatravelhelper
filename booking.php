<?php
include_once(dirname(__FILE__) . '/class/include.php');

if (!isset($_SESSION)) {
    session_start();
}
$tour = '';
$tailormade = '';
$places = '';
if (isset($_GET["tour"])) {
    $tour = $_GET["tour"];
    $TOUR = new TourPackages($tour);
    $REVIEWS = Reviews::getTotalReviewsOfTour($tour);
    $divider = $REVIEWS['count'];
    $sum = $REVIEWS['sum'];

    $stars = $sum / $divider;
}
if (isset($_GET['tailormade'])) {
    $tailormade = 'hidden';
    $places = serialize($_SESSION["destination_cart"]);
}

if (!Visitor::authenticate()) {
    if ($_GET['back'] === 'booking') {
        $_SESSION["back_url"] = 'http://www.toursrilanka.travel/booking.php?tour=' . $tour;
    } elseif (isset($_GET['tailormade'])) {
//        $_SESSION["back_url"] = 'http://www.toursrilanka.travel/booking.php?tailormade';
        $_SESSION["back_url"] = 'http://localhost/srilankatravelhelper/booking.php?tailormade';
    }
    redirect('visitor/index.php?message=24');
}

$VISITOR = new Visitor($_SESSION['id']);
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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="lib/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <style>
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
                background-color:#fff;
                padding-bottom: 0px;
                padding-top: 0px;
                text-align: center;
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
                text-align: center;
            }
            #rating-counter {
                color: #888;
                padding-left: 0px;
                display: inline-block;
                font-size: 15px;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container-fluid about-bg ">
                <div class="container">
                    <div class="rl-banner">
                        <h2 class="tp">Booking</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Booking</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <section class="fullwidth  padding-top-45 padding-bottom-45" data-background-color="#f8f8f8">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="driver-profile-section <?php echo $tailormade; ?>" >

                                <div class="listing-item">
                                    <img src="upload/tour-package/thumb/<?php echo $TOUR->image_name; ?>" alt="">
                                </div> 
                                <div class="profile-description ">
                                    <h3><?php echo $TOUR->name; ?></h3>
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
                                    <p><?php echo substr($TOUR->short_description, 0, 155) . '...'; ?></p>
                                </div>

                            </div> 
                            <div class="boxed-widget opening-hours <?php
                            if ($tailormade == '') {
                                echo 'hidden';
                            };
                            ?>">

                                <h3>Selected Destinations</h3>
                                <ul>
                                    <?php
                                    foreach ($_SESSION["destination_cart"] as $key => $cartitem) {
                                        $DESTINATION = new Destination($cartitem);
                                        ?>
                                        <li><a href="destination-type-one-item-view-page.php?id=<?php echo $cartitem; ?>"><i class="fa fa-check"></i><?php echo $DESTINATION->name; ?></a></li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12 booking-section">
                                <div class="tab col-md-8 col-md-offset-2">
                                    <div class="col-md-6 col-sm-6 col-xs-6 tab-nav">
                                        <span id="tab-nav-driver">
                                            <a href="#"><img src="images/icons/driver.png" class="driver-color" title="Select Driver" alt=""/></a>
                                            <a href="#"><img src="images/icons/driver-black.png" class="driver-black hidden" title="Select Driver" alt=""/></a>
                                        </span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 tab-nav">
                                        <span id="tab-nav-tour">
                                            <a href="#"><img src="images/icons/clipboard-with-pencil.png" class="book-color hidden" title="Fill Booking Details" alt=""/></a>
                                            <a href="#"><img src="images/icons/clipboard-with-pencil-black.png" class="book-black"  title="Fill Booking Details" alt=""/></a>
                                        </span>
                                    </div>
                                </div>

                                <div class="tab-select-driver col-md-12" id="tab-select-driver">
                                    <div class="row">
                                        <h3>Select Driver</h3>

                                        <div class="location col-md-10 col-xs-12 col-md-offset-1">
                                            <div class="select-location col-md-12">
                                                <label class="col-md-6">Driver Name</label>
                                                <label class="col-md-6">City</label>
                                                <!--<input type="text" name="name" id="myInput" onkeyup="myFunction()" placeholder="Search for location.." title="Type in a name" class="form-control" autocomplete="off"/>-->
                                                <input type="text" id="drivername" class="form-control col-md-6" placeholder="Enter driver name" name="drivername" required="TRUE">
                                                <input type="text" id="autocomplete" class="form-control col-md-6" placeholder="Enter city" onFocus="geolocate()" name="autocomplete" required="TRUE">
                                                <input type="hidden" name="city" id="city"  value=""/>
                                                <input type="hidden" name="cityname" id="cityname"  value=""/>
                                                <div class="row booking-next text-center">
                                                    <button class="btn search-btn" id="">Search</button>
                                                </div>
                                                            <!--<a href="#"><div class="searchbutton"><img src="images/searchicon.png" alt=""/></div></a>-->
                                                            <!--<input type="hidden" id="cityid" name="id" value="" >-->

                                            </div>
                                            <div class="select-driver col-md-12">
                                                <?php
                                                $SORTOFDRIVERS = Reviews::getDriversSortByReviews();
                                                foreach ($SORTOFDRIVERS as $key => $sortdriver) {

                                                    if ($sortdriver != 0) {
                                                        $DRIVER = new Drivers($sortdriver);
                                                        $REVIEWS = Reviews::getTotalReviewsOfDriver($DRIVER->id);

                                                        $divider1 = $REVIEWS['count'];
                                                        $sum1 = $REVIEWS['sum'];
                                                        if ($divider1 == 0) {
                                                            $stars1 = 0;
                                                            $sum1 = 0;
                                                        } else {
                                                            $stars1 = $sum1 / $divider1;
                                                        }
                                                        ?>

                                                        <a href="#">
                                                            <div class="driver-item driver-item-<?php echo $DRIVER->id; ?> col-md-6 col-xs-12" onClick="selectItem(<?php echo $DRIVER->id; ?>)">
                                                                <div class="col-md-4 col-xs-12">
                                                                    <?php
                                                                    if (empty($DRIVER->profile_picture)) {
                                                                        ?>
                                                                        <img src="upload/driver/driver.png" alt="Profile Picture"/>
                                                                        <?php
                                                                    } else {
                                                                        if ($DRIVER->facebookID && substr($DRIVER->profile_picture, 0, 5) === "https") {
                                                                            ?>
                                                                            <img src="<?php echo $DRIVER->profile_picture; ?>"  alt="Profile Picture"/>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <img src="upload/driver/<?php echo $DRIVER->profile_picture; ?>" alt=""/>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-8 col-xs-12">
                                                                    <a href="drivers-view-page.php?id=<?php echo $DRIVER->id; ?>" target="new" >
                                                                        <div class="drivername">
                                                                            <?php echo $DRIVER->name; ?>
                                                                        </div>
                                                                    </a>
                                                                    <div class="star-rate">
                                                                        <?php
                                                                        for ($i = 1; $i <= $stars1; $i++) {
                                                                            echo '<i class="fa fa-star"></i>';
                                                                        }
                                                                        for ($j = $i; $j <= 5; $j++) {
                                                                            echo '<i class="fa fa-star-o"></i>';
                                                                        }
                                                                        ?>
                                                                        <span class="reviews"> (<?php echo $sum1; ?> Reviews)</span>
                                                                    </div>
                                                                    <div class="drivercity">
                                                                        City: <?php echo $DRIVER->cityname; ?>
                                                                    </div>
                                                                    <div class="drivercity">
                                                                        Driving Licence No: <?php echo $DRIVER->driving_licence_number; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>

                                                        <?php
                                                    }
                                                }
                                                $ALLDRIVERS = Drivers::getDriversID();
                                                foreach ($ALLDRIVERS as $key => $driverid) {
                                                    if (!in_array($driverid, $SORTOFDRIVERS)) {
                                                        $DRIVER = new Drivers($driverid);
                                                        $REVIEWS = Reviews::getTotalReviewsOfDriver($DRIVER->id);

                                                        $divider1 = $REVIEWS['count'];
                                                        $sum1 = $REVIEWS['sum'];
                                                        if ($divider1 == 0) {
                                                            $stars1 = 0;
                                                            $sum1 = 0;
                                                        } else {
                                                            $stars1 = $sum1 / $divider1;
                                                        }
                                                        ?>
                                                        <a href="#">
                                                            <div class="driver-item driver-item-<?php echo $DRIVER->id; ?> col-md-6 col-xs-12" onClick="selectItem(<?php echo $DRIVER->id; ?>)">
                                                                <div class="col-md-4 col-xs-12">
                                                                    <?php
                                                                    if (empty($DRIVER->profile_picture)) {
                                                                        ?>
                                                                        <img src="upload/driver/driver.png" alt="Profile Picture"/>
                                                                        <?php
                                                                    } else {
                                                                        if ($DRIVER->facebookID && substr($DRIVER->profile_picture, 0, 5) === "https") {
                                                                            ?>
                                                                            <img src="<?php echo $DRIVER->profile_picture; ?>"  alt="Profile Picture"/>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <img src="upload/driver/<?php echo $DRIVER->profile_picture; ?>" alt=""/>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-8 col-xs-12">
                                                                    <a href="drivers-view-page.php?id=<?php echo $DRIVER->id; ?>" target="new" >
                                                                        <div class="drivername">
                                                                            <?php echo $DRIVER->name; ?>
                                                                        </div>
                                                                    </a>
                                                                    <div class="star-rate">
                                                                        <?php
                                                                        for ($i = 1; $i <= $stars1; $i++) {
                                                                            echo '<i class="fa fa-star"></i>';
                                                                        }
                                                                        for ($j = $i; $j <= 5; $j++) {
                                                                            echo '<i class="fa fa-star-o"></i>';
                                                                        }
                                                                        ?>
                                                                        <span class="reviews"> (<?php echo $sum1; ?> Reviews)</span>
                                                                    </div>
                                                                    <div class="drivercity">
                                                                        City: <span class="cityname" id="cityname-<?php echo $DRIVER->id; ?>" cityid=""></span>
                                                                    </div>
                                                                    <div class="drivercity">
                                                                        Driving Licence No: <?php echo $DRIVER->driving_licence_number; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>

                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row booking-next col-md-10 col-md-offset-1">
                                        <button class="btn next-btn" id="">Next <i class="fa fa-angle-double-right"></i></button>
                                    </div>

                                </div>
                                <div class="tab-tour col-md-12 hidden" id="tab-tour">
                                    <div class="row">
                                        <h3>Your Details</h3>

                                        <div class="your-details col-md-10 col-md-offset-1">
                                            <div class="col-md-12">
                                                <label>Full Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $VISITOR->name; ?>" disabled=""/>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Email</label>
                                                <input type="text" name="email" id="email" class="form-control" value="<?php echo $VISITOR->email; ?>" disabled=""/>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Contact Number</label>
                                                <input type="text" name="contactnumber" id="contactnumber" class="form-control" value="<?php echo $VISITOR->contact_number; ?>" disabled=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h3 class="<?php echo $tailormade; ?>">Tour Package Booking Details</h3>
                                        <h3 class="<?php
                                        if ($tailormade == '') {
                                            echo 'hidden';
                                        };
                                        ?>">Tailor-Made Tour Booking Details</h3>

                                        <div class="your-details col-md-10 col-md-offset-1">
                                            <div class="col-md-6">
                                                <label>No of Adults</label>
                                                <input type="number" name="noofadults" id="noofadults" class="form-control" min="0"/>
                                            </div>
                                            <div class="col-md-6">
                                                <label>No of Children</label>
                                                <input type="number" name="noofchildren" id="noofchildren" class="form-control" min="0"/>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Start Date</label>
                                                <input type="text" name="startdate" id="startdate" class="form-control"/>
                                            </div>
                                            <div class="col-md-6">
                                                <label>End Date</label>
                                                <input type="text" name="enddate" id="enddate" class="form-control"/>
                                            </div>
                                            <div class="col-md-12">
                                                <label>Message</label>
                                                <textarea class="form-control" name="message" id="booking-msg" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="booking-prev col-md-5 col-xs-6 col-md-offset-1">
                                            <button class="btn prev-btn"><i class="fa fa-angle-double-left"></i> Back</button>
                                        </div>
                                        <div class="booking-next col-md-6 col-xs-6">
                                            <input type="hidden" name="tour" id="tour" value="<?php echo $tour; ?>" />
                                            <input type="hidden" name="places" id="places" value="<?php echo $places; ?>" />
                                            <input type="hidden" name="visitor" id="visitor" value="<?php echo $_SESSION['id']; ?>" />
                                            <input type="hidden" name="selected-driver" id="selected-driver" value="" />
                                            <input type="hidden" name="tailormadetour" id="tailormadetour" value="<?php
                                            if ($tailormade == 'hidden') {
                                                echo 'tailormade';
                                            } else {
                                                echo 'tourpackge';
                                            }
                                            ?>" />
                                            <button class="btn btn-submit">Book Now <i class="fa fa-angle-double-right"></i></button>
                                        </div>
                                    </div>

                                </div>




                            </div>
                        </div>


                    </div>
                </div>
            </section>
            <div id="map"></div>
            <?php include './footer.php'; ?>
        </div>

    </body>
    <!-- Scripts
     ================================================== -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
    <script src="css/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="scripts/mmenu.min.js"></script>
    <script type="text/javascript" src="scripts/chosen.min.js"></script>
    <script type="text/javascript" src="scripts/slick.min.js"></script>
    <script type="text/javascript" src="scripts/rangeslider.min.js"></script>
    <script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
    <script type="text/javascript" src="scripts/waypoints.min.js"></script>
    <script type="text/javascript" src="scripts/counterup.min.js"></script>
    <script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="scripts/tooltips.min.js"></script>
    <script type="text/javascript" src="scripts/custom.js"></script>
    <script src="scripts/search-drivers.js" type="text/javascript"></script>
    <script src="scripts/booking.js" type="text/javascript"></script>

    <script>
                                                                $(function () {
                                                                    $("#startdate").datepicker({dateFormat: "yy-mm-dd"}).val()
                                                                    $("#enddate").datepicker({dateFormat: "yy-mm-dd"}).val()
                                                                });
                                                                function selectItem(id) {
                                                                    $('.driver-item').removeClass('selected');
                                                                    $('.driver-item-' + id).addClass('selected');

                                                                    $('#selected-driver').val(id);
                                                                }
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
    <script>
        // Retrieve Details from Place_ID
        function initMap() {
            setTimeout(function () {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -33.866, lng: 151.196},
                    zoom: 15
                });

                var infowindow = new google.maps.InfoWindow();
                var service = new google.maps.places.PlacesService(map);
                var place_id = $('#city').val();
                service.getDetails({
                    placeId: place_id
                }, function (place, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
//                        alert(place.name);
                        $('#autocomplete').val(place.name);
                    }
                });
            }, 1000);
        }

        $(document).ready(function () {
            initMap();
        });


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhjErF0IZ1O5pUQsSag23YgmvAo4OLngM&libraries=places&callback=initAutocomplete"
    async defer></script>

</html>

