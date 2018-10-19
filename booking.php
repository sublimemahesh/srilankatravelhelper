<?php
include_once(dirname(__FILE__) . '/class/include.php');


if (!isset($_SESSION)) {
    session_start();
}
$tour = '';
if (isset($_GET["tour"])) {
    $tour = $_GET["tour"];
    $TOUR = new TourPackages($tour);
    $REVIEWS = Reviews::getTotalReviewsOfTour($tour);
}


if (!Visitor::authenticate()) {
    if ($_GET['back'] === 'booking') {
        $_SESSION["back_url"] = 'http://travelhelper.galle.website/booking.php?tour=' . $tour;
    }
    redirect('visitor/index.php?message=24');
}

$VISITOR = new Visitor($_SESSION['id']);



$divider = $REVIEWS['count'];
$sum = $REVIEWS['sum'];

$stars = $sum / $divider;
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
        <link href="slider css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
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
            <div class="container about-bg ">
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
                            <div class="driver-profile-section" >

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
                                                <label>Select Location</label>
                                                <input type="text" name="name" id="myInput" onkeyup="myFunction()" placeholder="Search for location.." title="Type in a name" class="form-control" autocomplete="off"/>
                                                <a href="#"><div class="searchbutton"><img src="images/searchicon.png" alt=""/></div></a>
                                                <input type="hidden" id="cityid" name="id" value="" >
                                                <ul id="myUL" class="hidden">
                                                    <?php
                                                    foreach (City::all() as $city) {
                                                        ?>
                                                        <li class="city" cityid="<?php echo $city['id']; ?>"><a href="#"><?php echo $city['name']; ?></a></li>
                                                        <?php
                                                    }
                                                    ?>

                                                </ul>
                                            </div>
                                            <div class="select-driver col-md-12">

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
                                        <h3>Tour Package Booking Details</h3>

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
                                            <input type="hidden" name="visitor" id="visitor" value="<?php echo $_SESSION['id']; ?>" />
                                            <input type="hidden" name="selected-driver" id="selected-driver" value="" />
                                            <button class="btn btn-submit">Book Now <i class="fa fa-angle-double-right"></i></button>
                                        </div>
                                    </div>

                                </div>




                            </div>
                        </div>


                    </div>
                </div>
            </section>
            <?php include './footer.php'; ?>
        </div>
    </body>
    <!-- Scripts
     ================================================== -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
    <!--<script src="scripts/jquery_2.2.4.js" type="text/javascript"></script>-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="scripts/mmenu.min.js"></script>
    <script type="text/javascript" src="scripts/chosen.min.js"></script>
    <script type="text/javascript" src="scripts/slick.min.js"></script>
    <script type="text/javascript" src="scripts/rangeslider.min.js"></script>
    <script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
    <script type="text/javascript" src="scripts/waypoints.min.js"></script>
    <script type="text/javascript" src="scripts/counterup.min.js"></script>
    <script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!--<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>-->
    <script type="text/javascript" src="scripts/tooltips.min.js"></script>
    <script type="text/javascript" src="scripts/custom.js"></script>
    <script src="scripts/search-drivers.js" type="text/javascript"></script>
    <script src="scripts/booking.js" type="text/javascript"></script>

    <script>
                                                    $(function () {
                                                        $("#startdate").datepicker({dateFormat: "yy-mm-dd"}).val()
                                                        $("#enddate").datepicker({dateFormat: "yy-mm-dd"}).val()
                                                    });
    </script>
    <script>

        function myFunction() {

            $('#myUL').removeClass('hidden');

            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
        $('.city').click(function () {
            var name = $(this).text();
            var id = $(this).attr('cityid');
            $('#myInput').val(name);
            $('#cityid').val(id);
            $('#myUL').addClass('hidden');

        });
        function selectItem(id) {
            $('.driver-item').removeClass('selected');
            $('.driver-item-' + id).addClass('selected');

            $('#selected-driver').val(id);
        }
    </script>

</html>

