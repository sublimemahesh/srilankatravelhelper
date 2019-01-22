<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (isset($_GET['offer'])) {
    $id = $_GET['offer'];
}
if (!isset($_SESSION)) {
    session_start();
}
if (!Visitor::authenticate()) {
    if ($_GET['back'] === 'offerbooking') {
//        $_SESSION["back_url"] = 'http://toursrilanka.travel/offer-booking.php?offer=' . $id;
        $_SESSION["back_url"] = 'http://localhost/srilankatravelhelper/offer-booking.php?offer=' . $id;
    }
    redirect('visitor/index.php?message=24');
}
$visitorid = $_SESSION["id"];

$OFFER = new Offer($id);
$VISITOR = new Visitor($visitorid);
$discount = $OFFER->discount;
$price = $OFFER->price;
$new_price = $price - (($discount / 100) * $price);
$today = date("Y-m-d", time());
date_default_timezone_set('Asia/Colombo');
$now = date('Y-m-d H:i:s');
?> 
<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title>Offer Booking || Tour Sri Lanka</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
           ================================================== -->
        <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/aos.css" rel="stylesheet" type="text/css"/> 
        <style>
            input[type="text"], input[type="email"], input[type="number"] {

                width: 100%;
                height: 36px;
                border-radius: 5px 5px 5px 5px;
                background: white;
                background-color: white;
                padding: 8px 12px;
                font-size: 13px;
                margin-top: 0px;
                border-width: 1px;
                border-style: solid;
                border-color: gray;

            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container-fluid about-bg ">
                <div class="container">
                    <div class="rl-banner" data-aos="fade-down" data-aos-duration="3500">
                        <h2 class="tp">Offer Booking</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Offer Booking</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <section class="blog-contents-version-one padding-bottom-45 padding-top-30 popular-packages">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="body">
                                <div class="offer-booking-box margin-panel"  data-aos="fade-right" data-aos-duration="3500" data-aos-delay="100">
                                    <?php
                                    $vali = new Validator();
                                    $vali->show_message();
                                    ?>
                                    <div class="col-md-12">
                                        <?php
                                        if (isset($_GET['message'])) {
                                            $message = new Message($_GET['message']);
                                            ?>
                                            <div class="alert alert-success"><?php echo $message->description; ?></div>
                                            <?php
                                        }
                                        ?> 
                                    </div>
                                    <form method="post" action="post-and-get/offer-booking.php" enctype="multipart/form-data">
                                        <h4 class="booking-offer-title text-center">Your Details</h4>
                                        <div class="row panel panel-default booking-panel-default">
                                            <div class="col-sm-12 col-md-12">
                                                <!--Full Name-->
                                                <div class="col-md-12">
                                                    <div class="bottom-top">Name</div>
                                                    <div class="formrow">
                                                        <input type="text" readonly="true" name="first_name" id="first_name" class="form-control input-type-bottom" placeholder="Please Enter Your Full Name"  value="<?php echo $VISITOR->name; ?>" required="TRUE">
                                                    </div>
                                                </div>
                                                <!--Email-->
                                                <div class="col-md-6">
                                                    <div class="bottom-top">Email</div>
                                                    <div class="formrow">
                                                        <input type="email" readonly="true" name="email" id="email" class="form-control input-type-bottom" placeholder="-" required="TRUE" value="<?php echo $VISITOR->email; ?>">
                                                        <br>
                                                    </div>
                                                </div>
                                                <!--Contact No-->
                                                <div class="col-md-6">
                                                    <div class="bottom-top">Contact No</div>
                                                    <div class="formrow">
                                                        <input type="text" readonly="true" id="contact_number" name="contact_number" class="form-control input-type-bottom" placeholder="-" value="<?php echo $VISITOR->contact_number; ?>">
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <h4 class="booking-transports-title text-center">Message</h4>
                                        <div class = "row panel panel-default booking-panel-default">
                                            <div class = "col-sm-12 col-md-12">
                                                <div class = "col-md-12">
                                                    <div class = "bottom-top">Message</div>
                                                    <div class = "formrow">
                                                        <textarea class = "form-control input-type-bottom" name="message" rows="5"> </textarea>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "row">
                                            <div class = "text-center">
                                                <div class = "">
                                                    <input type="hidden" id="visitor" value="<?php echo $VISITOR->id; ?>" name="visitor"/>
                                                    <input type="hidden" id="offer" value="<?php echo $OFFER->id; ?>" name="offer"/> 
                                                    <input type="hidden" id="date_time_booked" value="<?php echo $now; ?>" name="date_time_booked"/>

                                                    <input type="submit" id="book" name="bookoffer" value="Book Now" class="btn btn-info btncolor6">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row top-bott20"  data-aos="fade-up" data-aos-duration="3500" data-aos-delay="300">
                                <div class="panel panel-info margin-panel">
                                    <div class="panel-heading">SELECTED OFFER</div>
                                    <div class="panel-body">
                                        <h4 class="booking-transports-title text-center"><?php echo $OFFER->title; ?></h4>
                                        <div class="transport-booking-img">
                                            <img src="upload/offer/<?php echo $OFFER->image_name ?>" class="img img-responsive img-thumbnail" id="profil_pic"/>
                                        </div>
                                        <ul class="list-group visitor-list-color"> 
                                            <li class="list-group-item"><b>Old Price</b> : LKR <?php echo number_format($OFFER->price, 2); ?></li> 
                                            <li class="list-group-item"><b>Discount</b> : <?php echo $OFFER->discount ?> %</li> 
                                            <li class="list-group-item"><b>New Price</b> :LKR <?php echo number_format($new_price, 2); ?></li> 
                                            <li class="list-group-item"><b>Description</b> <?php echo substr($OFFER->description, 0, 750) . '...'; ?></li> 
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- single popular destination  end-->

            <?php include './footer.php'; ?>
        </div>

        <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
        <script src="scripts/jquery-2.2.0.min.js" type="text/javascript"></script>
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
        <script src="scripts/aos.js" type="text/javascript"></script>
        <script>
            AOS.init();
        </script>

    </body>
</html>

