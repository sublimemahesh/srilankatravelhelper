<?php
include_once '../class/include.php';
$destinations = '';
$count1 = 0;
$count = '';
if (isset($_SESSION['destination_cart'])) {
    $destinations = $_SESSION['destination_cart'];
    $count1 = count($destinations);
}

if ($count1 == 0) {
    $count = '&nbsp;&nbsp;' . $count1;
} else if ($count1 == 1) {
    $count = '&nbsp;0' . $count1;
} else if ($count1 < 9) {
    $count = '0' . $count1;
} else {
    $count = $count1;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Visitor DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/header.css" rel="stylesheet" type="text/css"/>
        <style>
            input[type="button"].signup-btn  {
                background: red;
                width: 117px;
                height: 45px;
                color: #fff;
                border: 0px
                    
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <header id="">
                <!-- Header -->
                <div id="header">
                    <div class="container">
                        <!-- Left Side Content -->
                        <div class="left-side">
                            <!-- Logo -->
                            <div id="logo">
                                <a href="../"><img src="../images/logo/logo.png" alt=""></a>
                            </div>
                            <!-- Mobile Navigation -->
                            <div class="mmenu-trigger">
                                <button class="hamburger hamburger--collapse" type="button">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                            <!-- Main Navigation -->
                            <nav id="navigation" class="style-1">
                                <ul id="responsive">
                                    <li><a class="current" href="../">Home</a></li>
                                    <li><a href="../destination-type.php">Destinations</a></li>
                                    <li><a href="../all-cities.php">Cities</a></li>
                                    <li><a href="../tour-packages-type.php">Packages</a></li>
                                    <li><a href="../drivers-page.php">Drivers</a></li>
                                    <li><a href="../blog.php">Blog</a></li>
                                    <li><a href="../offers.php">Offer</a></li>
                                    <li><a href="#"><i class="glyphicon glyphicon-user"></i> My Profile</a>
                                        <ul>
                                            <li><a href="profile.php">Login Now</a></li>
                                            <li><a href="profile.php">Join Now</a></li>
                                            <li><a href="../driver/profile.php">Driver Login</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                            <div class="clearfix"></div>
                            <!-- Main Navigation / End -->

                        </div>
                        <!-- Left Side Content / End -->
                        <!-- Right Side Content / End -->
                        <div class="right-side">
                            <div class="header-widget widget-btn-left">

                                <a href="plan-trip.php" class="button border with-icon button-left"><span class="header-icon header-icon1"><i class="glyphicon glyphicon-map-marker"></i></span> Plan Your Trip</a>

                            </div>
                            <div class="header-widget widget-btn-right">
                                <a href="my-cart.php" class="button border with-icon button-right"><span class="header-icon header-icon2"><i class="glyphicon glyphicon-shopping-cart"></i></span> <span class="cart-item-count"><?php
                                        if ($count == 1) {
                                            echo '1 item';
                                        } else {
                                            echo $count . ' items';
                                        };
                                        ?>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <!-- Right Side Content / End -->
                        <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

                            <div class="small-dialog-header">
                                <h3>Sign In</h3>
                            </div>

                            <!--Tabs -->
                            <div class="sign-in-form style-1">

                                <ul class="tabs-nav">
                                    <li class=""><a href="#tab1">Log In</a></li>
                                    <li><a href="#tab2">Register</a></li>
                                </ul>

                                <div class="tabs-container alt">

                                    <!-- Login -->
                                    <div class="tab-content" id="tab1" style="display: none;">
                                        <form method="post" class="login">

                                            <p class="form-row form-row-wide">
                                                <label for="username">Username:
                                                    <i class="im im-icon-Male"></i>
                                                    <input type="text" class="input-text" name="username" id="username" value="" />
                                                </label>
                                            </p>

                                            <p class="form-row form-row-wide">
                                                <label for="password">Password:
                                                    <i class="im im-icon-Lock-2"></i>
                                                    <input class="input-text" type="password" name="password" id="password"/>
                                                </label>
                                                <span class="lost_password">
                                                    <a href="#" >Lost Your Password?</a>
                                                </span>
                                            </p>

                                            <div class="form-row">
                                                <input type="submit" class="button border margin-top-5" name="login" value="Login" />
                                                <div class="checkboxes margin-top-10">
                                                    <input id="remember-me" type="checkbox" name="check">
                                                    <label for="remember-me">Remember Me</label>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                    <!-- Register -->
                                    <div class="tab-content" id="tab2" style="display: none;">

                                        <form method="post" class="register">

                                            <p class="form-row form-row-wide">
                                                <label for="username2">Username:
                                                    <i class="im im-icon-Male"></i>
                                                    <input type="text" class="input-text" name="username" id="username2" value="" />
                                                </label>
                                            </p>

                                            <p class="form-row form-row-wide">
                                                <label for="email2">Email Address:
                                                    <i class="im im-icon-Mail"></i>
                                                    <input type="text" class="input-text" name="email" id="email2" value="" />
                                                </label>
                                            </p>

                                            <p class="form-row form-row-wide">
                                                <label for="password1">Password:
                                                    <i class="im im-icon-Lock-2"></i>
                                                    <input class="input-text" type="password" name="password1" id="password1"/>
                                                </label>
                                            </p>

                                            <p class="form-row form-row-wide">
                                                <label for="password2">Repeat Password:
                                                    <i class="im im-icon-Lock-2"></i>
                                                    <input class="input-text" type="password" name="password2" id="password2"/>
                                                </label>
                                            </p>

                                            <input type="submit" class="button border fw margin-top-10" name="register" value="Register" />

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Sign In Popup / End -->


                    </div>
                </div>
                <!-- Header / End -->

            </header>
            <div class="content">
                <div class="parallax">

                    <div class="box col-md-8 col-md-offset-2 col-xs-12">
                        <div class="description-box col-md-6 col-xs-12">
                            <div class="logo">
                                <img src="../images/logo/log-1.png" alt=""/>
                            </div>
                            <div class="description">
                                <p>Lorem ipsum dolor</p>
                                <p>sit amet, consectetuer adipiscing elit.</p>
                                <p>Aenean commodo ligula eget dolor.</p>
                                <p>Aenean massa.</p>
                            </div>
                            <div class="icon-box">
                                <h3 class="topic">SIGN UP WITH</h3>

                                <a href="#"><i class="fa fa-facebook icons"></i></a>
                                <a href="#"><i class="fa fa-twitter icons"></i></a>
                                <a href="#"><i class="fa fa-google-plus icons"></i></a>

                            </div>
                            <div class="login-link">
                                <h2>Already have an account?</h2>
                                <a href="./"><h1 id="sign-in">Sign In</h1></a>
                            </div>
                            <div class="login-link1 hidden">
                                <!--                                <h2>Already have an account?</h2>-->
                                <a href="#"><h1 id="sign-up">Create an Account</h1></a>
                            </div>

                        </div>
                        <div class="login-box login-box2 col-md-6 col-xs-12">

                            <form id="send-email-form" class="" action="post-and-get/reset-password.php" method="POST">

                                <?php
                                if (isset($_GET['message'])) {
                                    $message = new Message($_GET['message']);
                                    ?>
                                    <input type="hidden" id="msg" value="<?php echo $message->description; ?>" />
                                    <div class="error-msg2 hidden">
                                        <div class="pull-left" id="message"><?php echo $message->description; ?></div>
                                        <!--<div class="alert alert-<?php echo $message->status; ?>"><?php echo $message->description; ?></div>-->

                                    </div>
                                    <div class="error-msg hidden">
                                        <div class="pull-left" id="message"><?php echo $message->description; ?></div>
                                        <!--<div class="alert alert-<?php echo $message->status; ?>"><?php echo $message->description; ?></div>-->

                                    </div>
                                    <?php
                                }
                                ?>

                                <br /> 
                                <h3>FORGOTTEN PASSWORD?</h3>
                                <h2>Enter your e-mail address below to reset your password?</h2>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                                <input type="submit" name="sendemail" id="sendemail"  class="signup-btn" value="SEND EMAIL" />
                            </form>

                        </div>

                    </div>
                </div>

            </div>
            <div class="footer">
                <div class="logo">
                    <a href="../"><img src="../images/logo/log-1.png" alt=""/></a>
                </div>
                <div class="text-lines">
                    <p>Copyright © 2018 | <a href="https://www.sublime.lk/">Sublime Holdings</a> | All rights reserved.</p>
                    <p> Terms| Privacy| Contact Us </p>
                </div>

            </div>
        </div>

        <script src="js/jquery_2.2.4.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../scripts/customjs.js" type="text/javascript"></script>
        <script src="../scripts/mmenu.min.js" type="text/javascript"></script>
        <script src="../scripts/chosen.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../scripts/mmenu.min.js"></script>
        <script type="text/javascript" src="../scripts/chosen.min.js"></script>
        <script type="text/javascript" src="../scripts/slick.min.js"></script>
        <script type="text/javascript" src="../scripts/rangeslider.min.js"></script>
        <script type="text/javascript" src="../scripts/magnific-popup.min.js"></script>
        <script type="text/javascript" src="../scripts/tooltips.min.js"></script>
        <script>
            $(document).ready(function () {
                var message = $('#msg').val();

                if (message.length > 35) {
                    $('.error-msg2').removeClass('hidden');
                } else {
                    $('.error-msg').removeClass('hidden');
                }
            });

            $(window).load(function () {
                var width = $(window).width();

                if (width > 576) {
                    var contentheight = $(window).height() - 200;

                    $('.content').css('height', contentheight);
                } else {
                    var contentheight = $(window).height() - 218;
                    $('.content').css('height', contentheight);
                }
            });
        </script>

    </body>
</html>