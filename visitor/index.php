<?php
include_once '../class/include.php';
if (!isset($_SESSION)) {
    session_start();
}
$back_url = '';
if (isset($_SESSION["back_url"])) {
    $back_url = $_SESSION["back_url"];
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Visitor DashBoard</title>
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
                            <form id="signin-form" class="hidden" method="post" action="post-and-get/visitor.php">
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
                                <input type="hidden" class="form-control"  name="back_url" value="<?php echo $back_url; ?>">
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
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/sign-up.js" type="text/javascript"></script>
        <script src="js/add-visitor.js" type="text/javascript"></script>
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

            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });
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
                                    visitorLogin: '1'
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
