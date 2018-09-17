<?php
include_once '../class/include.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Driver DashBoard</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <div class="container">
                    <div class="logo-header">
                        <a href="../"><img src="../images/logo/log-1.png" alt=""/></a>
                    </div>
                </div>

            </div>
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
                        <div class="login-box login-box3 col-md-6 col-xs-12">

                            <form id="send-email-form" class="" action="post-and-get/change-password.php" method="POST">

                                <?php
                                if (isset($_GET['message'])) {
                                    $message = new Message($_GET['message']);
                                    ?>
                                    <input type="hidden" id="msg" value="<?php echo $message->description; ?>" />
                                    <div class="error-msg1 hidden">
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
                                <h3>PASSWORD RESET</h3>
                                <h2>Please check your email</h2>
                                <input type="text" name="code" id="code" class="form-control" placeholder=" Password reset code" />
                                <input type="password" name="password" id="password" class="form-control" placeholder="New password" />
                                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirm password" />
                                <input type="submit" name="PasswordReset" id="PasswordReset"  class="signup-btn signup-btn1" value="RESET PASSWORD" />
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
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/sign-up.js" type="text/javascript"></script>
        <script src="js/add-driver.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                var message = $('#msg').val();

                if (message.length > 35) {
                    $('.error-msg1').removeClass('hidden');
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