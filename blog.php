<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET["page"])) {
    $page = (int) $_GET["page"];
} else {
    $page = 1;
}
$setLimit = 30;
$pageLimit = ($page * $setLimit) - $setLimit;

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

$keyword = '';
$location = '';
$countsrch = '';
if (isset($_GET['search'])) {
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
    }
    if (isset($_GET['location'])) {
        $location = $_GET['location'];
    }

    $allquestions = BlogQuestion::searchAll($keyword, $location, $pageLimit, $setLimit);
    $unansweredquestions = BlogQuestion::searchUnansweredQuestions($keyword, $location, $pageLimit, $setLimit);
    $countsrch = BlogQuestion::getsearchAllCount($keyword, $location);
    $countunansweredsrch = BlogQuestion::getSearchUnansweredQuestionsCount($keyword, $location);
} else {
    $allquestions = BlogQuestion::all($pageLimit, $setLimit);
    $unansweredquestions = BlogQuestion::getUnansweredQuestions($pageLimit, $setLimit);
    $countsrch = BlogQuestion::getQuestionsCount();
    $countunansweredsrch = BlogQuestion::getUnansweredQuestionsCount();
}
?>
<html>
    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title>Blog || Tour Sri Lanka</title>
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
                        <h2 class="tp">Blog</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Blog</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="question-search main-search-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="3500" data-aos-delay="600">
                            <form id="blog-search" action="blog.php" method="get">
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

            <div class="container  padding-top-25 padding-bottom-20  question-list" >

                <div class="col-md-12">
                    <div class="blog col-md-12 col-xs-12">

                        <div class="blog-top-heading">

                            <div class="row">
                                <div class="topic topic-all" id="">
                                    <h3>All Questions</h3>
                                </div>
                                <div class="topic topic-unanswered" id="">
                                    <h3>Unanswered Questions</h3>
                                </div>
                                <div class="ask-btn">
                                    <a href="ask-a-question.php" class="btn btn-heading" id="ask-btn">Ask Question</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="topic topic-all"  id="">
                                    <h4><?php echo $countsrch['count']; ?> Question<?php
                                        if ($countsrch['count'] == 1) {
                                            echo '';
                                        } else {
                                            echo 's';
                                        }
                                        ?></h4>
                                </div>
                                <div class="topic topic-unanswered" id="">
                                    <h4><?php echo $countunansweredsrch['count']; ?> Question<?php
                                        if ($countunansweredsrch['count'] == 1) {
                                            echo '';
                                        } else {
                                            echo 's';
                                        }
                                        ?></h4>
                                </div>
                                <div class="nav">
                                    <a href="#" class="btn btn-default newest-btn" id="ask-btn">Newest</a>
                                    <a href="#" class="btn btn-default unanswered-btn" id="ask-btn">Unanswered</a>
                                </div>

                            </div>
                            <div class="row">
                                <hr class="main-divider" />
                            </div>
                        </div>
                        <div class="" id="all">
                            <?php
                            foreach ($allquestions as $question) {
                                if ($question['position'] === 'visitor') {
                                    $POSITION = new Visitor($question['position_id']);
                                } elseif ($question['position'] === 'driver') {
                                    $POSITION = new Drivers($question['position_id']);
                                }
                                $result = getAskedTime($question['askedAt']);

                                $COUNTANSWERS = BlogAnswer::getAnswerCountByQuestion($question['id']);
                                ?>
                                <div class="">
                                    <div class="question col-md-12 col-xs-12" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="500">
                                        <div class="answers-count <?php
                                        if ($COUNTANSWERS['count'] > 0) {
                                            echo 'active';
                                        } else {
                                            echo '';
                                        };
                                        ?> col-md-1 col-xs-3">
                                            <h2><?php echo $COUNTANSWERS['count']; ?></h2>
                                            <h6><?php
                                                if ($COUNTANSWERS['count'] == 1) {
                                                    echo 'Answer';
                                                } else {
                                                    echo 'Answers';
                                                };
                                                ?></h6>
                                        </div>
                                        <div class="description col-md-9 col-xs-9">
                                            <span class="qu-subject"><a href="view-question.php?id=<?php echo $question['id']; ?>"><?php echo $question['subject']; ?></a></span><br />
                                            <span class="qu-description">
                                                <span class="more">
                                                    <?php echo $question['question']; ?>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="asked-by col-md-2 col-xs-12">
                                            <i class="glyphicon glyphicon-map-marker"></i> <span class="qu-i"><?php echo $question['location']; ?></span><br />

                                            <i class="glyphicon glyphicon-calendar"></i> <span class="qu-i"><?php echo substr($question['askedAt'], 0, 10); ?></span>

                                            <div class="col-md-12 time-ago">
                                                asked <?php echo $result; ?>
                                            </div>
                                            <div class="col-md-12 blog-profile">
                                                <div class="col-md-4">
                                                    <?php
                                                    if (empty($POSITION->profile_picture)) {
                                                        ?>
                                                        <img src="upload/driver/driver.png" alt="Profile Picture"/>
                                                        <?php
                                                    } else {
                                                        if ($POSITION->facebookID && substr($POSITION->profile_picture, 0, 5) === "https") {
                                                            ?>
                                                            <img src="<?php echo $POSITION->profile_picture; ?>"  alt="Profile Picture"/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="upload/<?php echo $question['position']; ?>/<?php echo $POSITION->profile_picture; ?>" alt="Profile Picture" />
                                                            <?php
                                                        }
                                                    }
                                                    ?>
    <!--<img src="upload/<?php echo $question['position']; ?>/<?php echo $POSITION->profile_picture; ?>" alt=""/>-->
                                                </div>
                                                <div class="col-md-8 asked-by-blog">
                                                    <span class="qu-name"><?php echo $POSITION->name; ?></span><br />
                                                    <?php echo $question['position']; ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="hr col-md-12 col-xs-12">
                                        <hr class="main-divider" />
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <!-- Pagination -->
                                    <?php
                                    if (isset($_GET['search'])) {
                                        ?>
                                        <div class="pagination-container margin-top-20 margin-bottom-40">
                                            <?php BlogQuestion::showPaginationOfSearchedBlogQuestions($keyword, $location, $setLimit, $page); ?>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="pagination-container margin-top-20 margin-bottom-40">
                                            <?php BlogQuestion::showPaginationOfBlogQuestions($setLimit, $page); ?>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>


                        <div class="" id="unanswered">
                            <?php
                            foreach ($unansweredquestions as $question) {
                                if ($question['position'] === 'visitor') {
                                    $POSITION = new Visitor($question['position_id']);
                                } elseif ($question['position'] === 'driver') {
                                    $POSITION = new Drivers($question['position_id']);
                                }

                                $COUNTANSWERS = BlogAnswer::getAnswerCountByQuestion($question['id']);

                                $result = getAskedTime($question['askedAt']);
                                ?>
                                <div class="">
                                    <div class="question col-md-12 col-xs-12">
                                        <div class="answers-count col-md-1 col-xs-3">
                                            <h2><?php echo $COUNTANSWERS['count']; ?></h2>
                                            <h6><?php
                                                if ($COUNTANSWERS['count'] == 1) {
                                                    echo 'Answer';
                                                } else {
                                                    echo 'Answers';
                                                };
                                                ?></h6>
                                        </div>
                                        <div class="description col-md-9 col-xs-9">
                                            <span class="qu-subject"><a href="view-question.php?id=<?php echo $question['id']; ?>"><?php echo $question['subject']; ?></a></span><br />
                                            <span class="qu-description">
                                                <span class="more">
                                                    <?php echo $question['question']; ?>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="asked-by col-md-2 col-xs-12">

                                            <div class="col-md-12">
                                                <img src="upload/<?php echo $question['position']; ?>/<?php echo $POSITION->profile_picture; ?>" alt=""/>
                                            </div>
                                            <div class="col-md-12 time-ago">
                                                asked <?php echo $result; ?>
                                            </div>
                                            <div class="col-md-12 asked-by-blog">
                                                <?php echo $POSITION->name; ?><br />
                                                <?php echo $question['position']; ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="hr col-md-12 col-xs-12">
                                        <hr class="main-divider" />
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <!-- Pagination -->
                                    <?php
                                    if (isset($_GET['search'])) {
                                        ?>
                                        <div class="pagination-container margin-top-20 margin-bottom-40">
                                            <?php BlogQuestion::showPaginationOfSearchedBlogUnAnsweredQuestions($keyword, $location, $setLimit, $page); ?>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="pagination-container margin-top-20 margin-bottom-40">
                                            <?php BlogQuestion::showPaginationOfBlogUnAnsweredQuestions($setLimit, $page); ?>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>
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

                $diff = '';
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
                    $timediff1format = new DateTime($timediff1);
                    $time3 = new DateTime('24:00:00');
                    $time = $time3->diff($timediff1format);
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
                } else {
                    $diff = $datediff . ' days ago';
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
        <script src="css/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script><script src="scripts/blog.js" type="text/javascript"></script>
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

        <script src="scripts/read-more-less.js" type="text/javascript"></script>
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
            //Google Location Autocomplete
            var placeSearch, autocomplete;

            function initAutocomplete() {
                // Create the autocomplete object, restricting the search to geographical
                // location types.
                autocomplete = new google.maps.places.Autocomplete(
                        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                        {types: ['geocode']});

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                autocomplete.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();
                $('#location').val(place.name);
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
