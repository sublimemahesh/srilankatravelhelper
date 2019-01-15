<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$id = '';
$position = '';
$positionid = '';
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
}
if (isset($_SESSION['position'])) {
    $position = $_SESSION['position'];
}
if (isset($_SESSION['id'])) {
    $positionid = $_SESSION['id'];
}

$COUNT = BlogQuestion::getQuestionsCount();
$UNANSWEREDQUCOUNT = BlogQuestion::getUnansweredQuestionsCount();
?>
<html>
    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title>Ask A Question || Tour Sri Lanka</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
           ================================================== -->
        <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/blog.css" rel="stylesheet" type="text/css"/>
        <link href="lib/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/read-more-less.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/aos.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <!-- Wrapper -->
        <div id="wrapper">
            <!-- Header Container
                   ================================================== -->
            <?php include './header.php'; ?>
            <div class="container1 about-bg ">
                <div class="container">
                    <div class="rl-banner" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="3500">
                        <h2 class="tp">Ask A Question</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Blog</span></li>
                            <li><span class="active">Ask A Question</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container  padding-top-45 padding-bottom-50">

                <div class="col-md-12">
                    <div class="blog col-md-12 col-xs-12" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="300">

                        <div class="qu-form" id="qu-form">
                            <h3>Ask A Question</h3>
                            <div class="panel panel-default">

                                <input type="text" class="form-control" id="subject" name="subject" autocomplete="off" placeholder="Enter Subject" value="" attempt="">
                                
                                <input type="hidden" name="qu-id" value="" id="qu-id"  />
                                <div id="suggesstion-place">
                                    <div id="subject-list-append" class="subject-list"></div>
                                </div>



                                <input type="text" class="form-control" name="autocomplete" id="autocomplete"  onFocus="geolocate()" required="" placeholder="Enter Related Location" autocomplete="off"/>
                                <textarea class="form-control" name="question" id="qu" required placeholder="Enter Question"></textarea>
                                <input type="hidden" name="city" id="city" value=""/>
                                <input type="hidden" name="position" id="position" value="<?php echo $position; ?>"/>
                                <input type="hidden" name="positionid" id="positionid" value="<?php echo $positionid; ?>"/>
                                <input type="submit" class="btn btn-heading" name="btn-submit" id="btn-submit" value="POST"/>

                            </div>

                        </div>

                    </div>
                    <div class="col-md-3">

                    </div>
                </div>

            </div>

            <div class="modal fade" id="login" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Please Login First To Continue</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-6"><a href="#" class="signin active" id="nav-signin">Sign In</a></div>
                            <div class="col-md-6"><a href="#" class="signup" id="nav-signup">Sign Up</a></div>

                            <div id="tab-signin">
                                <select id="ps">
                                    <option value="">Select Your Position</option>
                                    <option value="visitor">Visitor</option>
                                    <option value="driver">Driver</option>
                                </select>
                                <input type="text" name="username" id="un" class="form-control" placeholder="User Name" value=""  autocomplete="off"/>
                                <input type="password" name="password" id="pw" class="form-control" placeholder="Password" value="" autocomplete="off"/>
                            </div>
                            <div id="tab-signup" class="hidden">
                                <select id="pos">
                                    <option value="">Select Your Position</option>
                                    <option value="visitor">Visitor</option>
                                    <option value="driver">Driver</option>
                                </select>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" autocomplete="off" />
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" autocomplete="off" />
                                <input type="text" name="username" id="un1" class="form-control" placeholder="User Name" autocomplete="off" />
                                <input type="password" name="password" id="pw1" class="form-control" placeholder="Password" autocomplete="off" />
                                <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" id="signin" name="signin" class="signup-btn" value="SIGN IN" />
                            <input type="submit" id="signup" name="signup" class="signup-btn hidden" value="SIGN UP" />
                        </div>
                    </div>

                </div>
            </div> 
            <?php

            function getAskedTime($datetime) {


                date_default_timezone_set('Asia/Colombo');
                $today = new DateTime(date("Y-m-d"));
                $todaytime = new DateTime(date("H:i:s"));

                $arr = explode(' ', $datetime);
                $date1 = new DateTime(date($arr[0]));
                $time1 = new DateTime(date($arr[1]));

                $date = $today->diff($date1);
                $datediff = $date->format('%a');

                if ($datediff == 0) {

                    $time = $todaytime->diff($time1);
                    $timediff = $time->format('%h:%i:%s');
                    $arr1 = explode(':', $timediff);
                    if ($arr1[0] == 0) {
                        $diff = $arr1[1] . ' min ago';
                    } else {
                        if ($arr1[0] == 1) {
                            $diff = $arr1[0] . ' hour ago';
                        } else {
                            $diff = $arr1[0] . ' hours ago';
                        }
                    }
                } elseif ($datediff == 1 && $time1 > $todaytime) {

                    $t = $todaytime->diff($time1);
                    $timediff1 = $t->format('%h:%i:%s');
                    $time3 = new DateTime('24:00:00');
                    $time = $time3->diff($timediff1);
                    $timediff = $time->format('%h:%i:%s');
                    $arr1 = explode(':', $timediff);
                    $diff = $arr1[0] . ' hours ago';
                } elseif ($datediff == 1 && $time1 < $todaytime) {
                    $diff = $datediff . ' day ago';
                } elseif ($datediff > 30) {
                    $month = round($datediff / 30);

                    if ($month >= 12) {

                        $year = round($month / 12);
                        if ($year == 1) {
                            $diff = $year . ' year ago';
                        } else {
                            $diff = $year . ' years ago';
                        }
                    } elseif ($month == 1) {
                        $diff = $month . ' month ago';
                    } else {
                        $diff = $month . ' months ago';
                    }
                }
                return $diff;
            }
            ?>

            <?php include './footer.php'; ?>
            <!-- Back To Top Button -->
            <div id="backtotop"><a href="#"></a></div>
        </div>
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
        <script src="scripts/add-question.js" type="text/javascript"></script>
        <script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="scripts/signin.js" type="text/javascript"></script>
        <script src="scripts/signup.js" type="text/javascript"></script>
        <script src="lib/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script src="scripts/blog.js" type="text/javascript"></script>
        <script src="scripts/read-more-less.js" type="text/javascript"></script>
        <script src="scripts/add-new-question.js" type="text/javascript"></script>
         <script src="scripts/aos.js" type="text/javascript"></script>
        <script>
            AOS.init();
        </script>
        
        <script>
                                    tinymce.init({
                                        selector: "#qu",
                                        // ===========================================
                                        // INCLUDE THE PLUGIN
                                        // ===========================================

                                        plugins: [
                                            "advlist autolink lists link image charmap print preview anchor",
                                            "searchreplace visualblocks code fullscreen",
                                            "insertdatetime media table contextmenu paste"
                                        ],
                                        // ===========================================
                                        // PUT PLUGIN'S BUTTON on the toolbar
                                        // ===========================================

                                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
                                        // ===========================================
                                        // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
                                        // ===========================================

                                        relative_urls: false

                                    });


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
                $('#city').val(place.name);
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
