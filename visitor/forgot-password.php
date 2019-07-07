<?php
include_once '../class/include.php';
$destinations = '';
$count1 = 0;
$count = '';
if (!isset($_SESSION)) {
    session_start();
}
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
            input[type="submit"].signup-btn {
                border-radius: 0px;
                background-color: #dc1a00;
                width: 137px;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <header id="">
                <!-- Header -->
                <?php include './index-header.php'; ?>
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
                                  <p> Tour Sri Lanka is a</p>
                                <p>  place where can reach what </p>
                                <p>you have dreamed.</p>
                                <p> We arrange and organize your </p>
                                <p>travel desire with beyond expectation.</p>
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
                                    <div class="error-msg3 hidden">
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

                if (message.length >65) {
                    $('.error-msg3').removeClass('hidden');
                }  else {
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