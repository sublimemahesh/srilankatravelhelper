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
        <title>Driver DashBoard</title>
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
                                            <li><a href="../visitor/profile.php">Login Now</a></li>
                                            <li><a href="../visitor/profile.php">Join Now</a></li>
                                            <li><a href="profile.php">Driver Login</a></li>
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

                                <a href="../plan-trip.php" class="button border with-icon button-left"><span class="header-icon header-icon1"><i class="glyphicon glyphicon-map-marker"></i></span> Plan Your Trip</a>

                            </div>
                            <div class="header-widget widget-btn-right">
                                <a href="../my-cart.php" class="button border with-icon button-right"><span class="header-icon header-icon2"><i class="glyphicon glyphicon-shopping-cart"></i></span> <span class="cart-item-count"><?php
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

                                <fb:login-button 
                                    scope="public_profile,email"
                                    onlogin="checkLoginState();">
                                </fb:login-button>
<!--                                <a href="#"><i class="fa fa-twitter icons"></i></a>
                                <a href="#"><i class="fa fa-google-plus icons"></i></a>-->

                            </div>
                            <div class="login-link">
                                <h2>Already have an account?</h2>
                                <a href="#"><h1 id="sign-in">Sign In</h1></a>
                            </div>
                            <div class="login-link1 hidden">
                                <!--                                <h2>Already have an account?</h2>-->
                                <a href="#"><h1 id="sign-up">Create an Account</h1></a>
                            </div>

                        </div>
                        <div class="login-box col-md-6 col-xs-12">

                            <form id="signup-form" class="">
                                <?php
                                if (isset($_GET['message'])) {
                                    $message = new Message($_GET['message']);
                                    ?>
                                    <input type="hidden" id="msg" value="<?php echo $message->description; ?>" msgid = "<?php echo $_GET['message']; ?>" />
                                    <div class="error-msg1 hidden">
                                        <div class="pull-left" id="message"><?php echo $message->description; ?></div>
                                    </div>
                                    <div class="error-msg hidden">
                                        <div class="pull-left" id="message"><?php echo $message->description; ?></div>
                                    </div>
                                    <?php
                                }
                                ?>

                                <br /> 


                                <h3>NEW CUSTOMER?</h3>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" />
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                                <input type="text" name="username" id="username" class="form-control" placeholder="User Name" />
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                                <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password" />
                                <input type="button" name="signup" id="signup"  class="signup-btn" value="SIGN UP" />
                                <input type="hidden" name="save" value="save"/>
                            </form>
                            <form id="signin-form" class="hidden" method="post" action="post-and-get/driver.php">
                                <?php
                                if (isset($_GET['message'])) {
                                    $message = new Message($_GET['message']);
                                    ?>
                                    <input type="hidden" id="msg" value="<?php echo $message->description; ?>" msgid = "<?php echo $_GET['message']; ?>" />
                                    <div class="error-msg1 hidden">
                                        <div class="pull-left" id="message"><?php echo $message->description; ?></div>
                                    </div>
                                    <div class="error-msg hidden">
                                        <div class="pull-left" id="message"><?php echo $message->description; ?></div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <br />

                                <h3>ALREADY A MEMBER?</h3>
                                <input type="text" name="username" id="username" class="form-control" placeholder="User Name" />
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                                <input type="submit" id="signin" name="signin" class="signup-btn" value="SIGN IN" />
                                <h4><a href="forgot-password.php">Forgotten Password?</a></h4>
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
        <script src="js/sign-up.js" type="text/javascript"></script>
        <script src="js/add-driver.js" type="text/javascript"></script>
        <script src="js/fb-login-scripts.js" type="text/javascript"></script>
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
                var msgid = $('#msg').attr('msgid');

                if (message.length > 35) {
                    $('.error-msg1').removeClass('hidden');
                    $('.login-box').addClass('login-box4');

                } else {
                    $('.error-msg').removeClass('hidden');
                    $('.login-box').addClass('login-box4');
                }

                if (msgid == 15) {
                    $('#signin-form').removeClass('hidden');
                    $('#signup-form').addClass('hidden');
                    $('.login-box').addClass('login-box5');
                    $('.login-box').removeClass('login-box4');
                    $('.login-link1').removeClass('hidden');
                    $('.login-link').addClass('hidden');

                    $('#sign-up').click(function () {
                        $('.login-box').addClass('login-box4');
                        $('.login-box').removeClass('login-box5');
                    });
                }
            });

        </script>
        <script>
            $(window).load(function () {
                var width = $(window).width();

                if (width > 900) {

                    var contentheight = $(window).height() - 200;

                    $('.content').css('height', contentheight);
                } else if (width > 760) {

                    var contentheight = $(window).height() - 200;

                    $('.content').css('height', contentheight);
                } else if (width > 576) {
                    var contentheight = $(window).height() - 200;

                    $('.content').css('height', contentheight);
                } else {
                    var contentheight = $(window).height() - 218;
                    $('.content').css('height', contentheight);
                }
            });
        </script>
        <script>
            window.fbAsyncInit = function () {
                FB.init({
                    appId: '323453645115752',
                    cookie: true,
                    xfbml: true,
                    version: 'v3.2'
                });
                FB.AppEvents.logPageView();
            };
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            function checkLoginState() {


                var userID;
                var accessToken;
                var expiresIn;
                var signedRequest;
                var status;
                var name;
                var email;
                var picture;

                FB.login(function (response) {
                    if (response.authResponse) {
                        accessToken = response.authResponse.accessToken;
                        expiresIn = response.authResponse.expiresIn;
                        signedRequest = response.authResponse.signedRequest;
                        status = response.status;
                        FB.api('/me?fields=id,name,email,permissions,picture', function (response) {
                            userID = response.id;
                            name = response.name;
                            email = response.email;
                            picture = "https://graph.facebook.com/v2.12/" + userID + "/picture?height=250&width=250&access_token" + accessToken;

                            $.ajax({
                                url: "post-and-get/ajax/fb-login.php",
                                type: "POST",
                                data: {
                                    userID: userID,
                                    name: name,
                                    email: email,
                                    picture: picture,
                                    accessToken: accessToken,
                                    expiresIn: expiresIn,
                                    signedRequest: signedRequest,
                                    status: status,
                                    driverLogin: '1'
                                },
                                dataType: "JSON",
                                success: function (result) {

                                    if (result.message === 'success-log') {

                                        if (result.back === '') {
                                            window.location.replace("profile.php?message=5");
                                        } else {
                                            window.location = result.back;
                                        }

                                    } else if (result.message === 'success-cre') {
                                        if (result.back === '') {
                                            window.location.replace('profile.php?message=22');
                                        } else {
                                            window.location = result.back;
                                        }

                                    }
                                }
                            });


                        });
                    } else {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                }, {scope: 'public_profile,email'});
            }
        </script>
    </body>
</html>
