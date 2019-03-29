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
;
///count views
$desview = Destination::getDestinationViewById($id);
$view = (int) $desview['views'];
if ($view == 0) {
    $view = 1;
} else {
    $view = $view + 1;
}
//echo "Total page views = " . $view;
$updateview = Destination::updateViewByid($id, $view);

//map Destination location
$destinations = '';
$string = '';
//foreach ($destinations as $des) {
$destian = new Destination($id);
$string .= "'" . $destian->desLocation . "',";

//}

$dest_str = substr($string, 0, strlen($string) - 1);
//dd($dest_str);
?> 
<!DOCTYPE html>

<html>
    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title><?php echo $DESTINATION->name; ?> || <?php echo $DESTINATION_TYPE->name; ?> || Destinations || Tour Sri Lanka</title>
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
        <!--<link href="lib/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" />
        <link rel="stylesheet" href="css/images-grid.css">
        <link href="css/reviews.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/aos.css" rel="stylesheet" type="text/css"/>
        <style>
            /* This rule is read by Galleria to define the gallery height: */
            /*reviews*/


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
            #header {
                z-index: 0;
            }
            @media(width:576px) {
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
                    padding: 1% 1% 1% 1%;
                    height: 100px;
                }
                .padding-bottom-45 {
                    padding-bottom: 0px !important;
                }
                .destinationimg {
                    margin-bottom: 0px;
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
                        <div class="rl-banner" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="3500">
                            <h2 class="tp"><?php echo $DESTINATION->name; ?></h2>
                            <ul>
                                <li><a href="./">Home</a></li>
                                <li><a href="destination-type.php">Destination</a></li>
                                <li><span class="active"><?php echo $DESTINATION_TYPE->name; ?></span></li>
                                <li><span class="active"><?php echo $DESTINATION->name; ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>



                <div class="container padding-bottom-45 padding-top-70">
                    <div class="row">

                        <div class="col-md-9 col-sm-8" data-aos="fade-right" data-aos-duration="3500" >
                            <div class=" content">
                                <div class="col-md-12 destinationimg">
                                    <div id="gallery1"></div>
                                </div>
                            </div>
                            <div class="padding-top-10" >

                                <hr  >
                                <h3 class="headline"><?php echo $DESTINATION->name; ?></h3>
                                <div>
                                    <p class="para">
                                        <?php echo $DESTINATION->description; ?>
                                    </p> 

                                </div>

                                <div>
                                    <div class="review-button padding-bottom-45">
                                        <a href="#" ><button id="add-to-cart" destination-id="<?php echo $id; ?>" back="cart" class=" btncolor7 button border with-icon submit add-to-cart">Add to Cart</button></a>
                                    </div>
                                </div>


                                <div class="">
                                    <div class="" data-aos="fade-up" data-aos-duration="3500">
                                        <hr>
                                        <h3 class="headline ">Reviews(<?php echo $sum1; ?>)</h3>
                                        <hr>
                                        <div class="col-md-4 col-sm-3 rating-breakdown">
                                            <div class="row">
                                                <div class="col-md-12  rating-block">
                                                    <h2 class="bold padding-bottom-7 ratingblock"><?php echo $sum1; ?> <small>/ <?php echo 5 * $divider1; ?></small></h2>
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
                                                    if (count(Reviews::getReviewsByDestination($DESTINATION->id)) > 0) {
                                                        foreach (Reviews::getReviewsByDestination($DESTINATION->id) as $review) {

                                                            $VISITOR = new Visitor($review['visitor']);
                                                            ?>
                                                            <div class="col-md-12">

                                                                <div class="col-md-3 col-sm-3 img-section reviewspts">
                                                                    <div class="reviewimg">
                                                                        <?php
                                                                        if (empty($VISITOR->profile_picture)) {
                                                                            ?>
                                                                            <img src="upload/driver/driver.png" alt="Profile Picture" class="img-circle"/>
                                                                            <?php
                                                                        } else {
                                                                            if ($VISITOR->facebookID && substr($VISITOR->profile_picture, 0, 5) === "https") {
                                                                                ?>
                                                                                <img src="<?php echo $VISITOR->profile_picture; ?>"  alt="Profile Picture" class="img-circle"/>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <img src="upload/visitor/<?php echo $VISITOR->profile_picture; ?>" alt="Profile Picture" class="img-circle"/>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
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
                                                                            <p class="count-reviews" style="color:#000 !important;"><?php echo $review['reviews']; ?> Reviews </p>
                                                                        </li>
                                                                    </div>
                                                                </div>  
                                                                <div class="col-md-9 col-sm-9">
                                                                    <h4 class=" reviews-title"><?php echo $VISITOR->name; ?></h4>
                                                                    <p><?php echo $review['message']; ?></p>
                                                                </div> 
                                                            </div>


                                                            <?php
                                                        }
                                                        ?>
                                                    <?php } else { ?>
                                                        <li class="list-group-item"><h5>No any reviews in here</h5></li>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php
                                            if (count(Reviews::getReviewsByDestination($DESTINATION->id)) > 0) {
                                                ?>
                                                <div class="review-button">
                                                    <div class="col-md-6 col-sm-6">
                                                        <a href="view-all-reviews.php?destination=<?php echo $id; ?>"><button id="view-all-reviews" class="button border with-icon submit btncolor17">View All Reviews</button></a>
                                                        <input type="hidden" id="dest-id" value="<?php echo $id; ?>" />
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 addreviewbtn">
                                                        <a href="visitor/manage-destination-reviews.php?destination=<?php echo $id; ?>"><button id="view-all-reviews" class="button border with-icon submit btncolor7">Add Reviews</button></a>
                                                        <input type="hidden" id="dest-id" value="<?php echo $id; ?>" />
                                                    </div>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="review-button btncolor8">
                                                    <a href="visitor/manage-destination-reviews.php?destination=<?php echo $id; ?>"><button id="view-all-reviews" class="button border with-icon submit btncolor7">Add Reviews</button></a>
                                                    <input type="hidden" id="dest-id" value="<?php echo $id; ?>" />
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-4 moredesti" >
                            <div>
                                <div id="map-canvas" class="onedesMap"></div>
                                <input type="hidden" class="dest" value="<?php echo $dest_str; ?>"/>
                            </div>

                            <div data-aos="fade-down" data-aos-duration="3500" data-aos-delay="400">
                                <h3 class="headline text-center" >More Destinations</h3>
                            </div> 
                            <div class="row margin-left-4 moredest otherdestinaionmar">

                                <?php
                                $DESTINATIONS = Destination::getDestinationById($DESTINATION->type);
                                foreach ($DESTINATIONS as $key => $destination) {
                                    if ($key < 5) {
                                        ?>

                                        <div  class="col-md-12 col-xs-12 more-items hidden-sm otherdestinaion" data-aos="fade-right" data-aos-duration="3500" data-aos-delay="600">
                                            <a href="destination-type-one-item-view-page.php?id=<?php echo $destination['id']; ?>">
                                                <h5  title="<?php echo $destination['name']; ?>" class="headline" style="font-family: 'Courgette', cursive;"><?php echo $destination['name']; ?></h5>
                                                <div class="col-md-5 col-xs-4 more-items-image" >
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
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-xs-8">
                                                    <p  style="font-family: 'Courgette', cursive;" ><?php echo substr($destination['short_description'], 0, 65) . '...'; ?></p>
                                                </div>


                                            </a>
                                        </div>

                                        <!--mobile respo-->
                                        <div  class="col-md-12 col-xs-12 more-items hidden-md hidden-lg hidden-xs" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="600" >
                                            <a href="destination-type-one-item-view-page.php?id=<?php echo $destination['id']; ?>">
                                                <h5  class="headline" style="font-family: 'Courgette', cursive;"><?php echo $destination['name']; ?></h5>
                                                <div class="col-md-5 col-xs-5 more-items-image destinationpadding ">
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
                                                <div class="col-md-7 col-xs-7 destiondes">
                                                    <p  style="font-family: 'Courgette', cursive;" ><?php echo substr($destination['short_description'], 0, 45) . '...'; ?></p>
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
                <div class="container padding-bottom-70">
                    <div class="row">

                    </div>

                </div>
                <?php include './footer.php'; ?>
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
        <!--<script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
        <script src="scripts/images-grid.js"></script>
        <script src="scripts/destination-slider.js" type="text/javascript"></script>
        <script src="scripts/aos.js" type="text/javascript"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhjErF0IZ1O5pUQsSag23YgmvAo4OLngM&sensor=true" type="text/javascript"></script>
        <script>
            AOS.init();
        </script>
        <script>
            var map;
            var geocoder;
            var marker;
            var people = new Array();
            var latlng;
            var infowindow;

            $(document).ready(function () {
                ViewCustInGoogleMap();
            });

            function ViewCustInGoogleMap() {

                var mapOptions = {
                    center: new google.maps.LatLng(7.931062, 80.817732),
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

        <script>
//            $(document).ready(function () {
//                $('.gallery1').click(function () {
//                    $('.cloned').css('z-index', '0')
//                });
//            });
        </script>
    </body>
</html>
