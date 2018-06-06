<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
       
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
<!--         <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
<!--        <link href="assets/css/base.css" rel="stylesheet" type="text/css"/>-->
        <style>
            .item-image-wrapper {border: 1px solid #696969; overflow: hidden;margin-bottom: 30px;box-shadow: 3px 3px 5px 6px #ccc;}
            .single-items {position: relative;}
            .iteminfo {position: relative;}
            .iteminfo h2 {color: #0dce38;font-size: 24px; font-weight: 700;}
            .item-overlay {background:  #0dce3899 ;top: 0; display: none;height: 0;position: absolute;-webkit-transition: height 500ms ease 0s;transition: height 500ms ease 0s;width: 100%;display: block;}
            .overlay-content { bottom: 0;  position: absolute; bottom: 0; text-align: center; width: 100%;}
            .item-overlay h2 {color: #fff;font-size: 24px; font-weight: 700;}
            .item-overlay p {font-size: 16px;font-weight: 400; color: #fff;}

            .item-overlay, .add-to-cart {background: #fff; border: 0 none; border-radius: 0; color: #0dce38;font-size: 15px;margin-bottom: 25px;}
            .choose { border-top: 1px solid #F7F7F0;}
            .choose ul li a {color: #B3AFA8;font-size: 13px;padding-left: 0;padding-right: 0;}
            .single-items:hover .item-overlay {display: block;  height: 100%;  background: #0dce3899;}
            .overlay-content {bottom: 0;position: absolute; bottom: 0; text-align: center; width: 100%;}
            .iteminfo img {    width: 100%;}
        </style>
    </head>
    <body>
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container about-bg ">
                <div class="container">
                    <div class="rl-banner">
                        <h2 class="tp">Drivers</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Drivers</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container padding-top-45 padding-bottom-15 hidden-sm hidden-xs">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="item-image-wrapper">
                            <div class="single-items">
                                <div class="iteminfo text-center">
                                    <img src="images/user-avatar.jpg"  alt="">
                                    <h2>Tom Jasan</h2>
                                    <p>Easy Polo Black Edition </p>
                                    <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                </div>
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h2>Tom Jasan</h2>
                                        <p>Easy Polo Black Edition </p>
                                        <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="item-image-wrapper">
                            <div class="single-items">
                                <div class="iteminfo text-center">
                                    <img src="images/user-avatar.jpg"  alt="">
                                    <h2>Tom Jasan</h2>
                                    <p>Easy Polo Black Edition </p>
                                    <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                </div>
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h2>Tom Jasan</h2>
                                        <p>Easy Polo Black Edition </p>
                                        <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="item-image-wrapper">
                            <div class="single-items">
                                <div class="iteminfo text-center">
                                    <img src="images/user-avatar.jpg"  alt="">
                                    <h2>Tom Jasan</h2>
                                    <p>Easy Polo Black Edition </p>
                                    <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                </div>
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h2>Tom Jasan</h2>
                                        <p>Easy Polo Black Edition </p>
                                        <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="item-image-wrapper">
                            <div class="single-items">
                                <div class="iteminfo text-center">
                                    <img src="images/user-avatar.jpg"  alt="">
                                    <h2>Tom Jasan</h2>
                                    <p>Easy Polo Black Edition </p>
                                    <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                </div>
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h2>Tom Jasan</h2>
                                        <p>Easy Polo Black Edition </p>
                                        <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="item-image-wrapper">
                            <div class="single-items">
                                <div class="iteminfo text-center">
                                    <img src="images/user-avatar.jpg"  alt="">
                                    <h2>Tom Jasan</h2>
                                    <p>Easy Polo Black Edition </p>
                                    <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                </div>
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h2>Tom Jasan</h2>
                                        <p>Easy Polo Black Edition </p>
                                        <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="item-image-wrapper">
                            <div class="single-items">
                                <div class="iteminfo text-center">
                                    <img src="images/user-avatar.jpg"  alt="">
                                    <h2>Tom Jasan</h2>
                                    <p>Easy Polo Black Edition </p>
                                    <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                </div>
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h2>Tom Jasan</h2>
                                        <p>Easy Polo Black Edition </p>
                                        <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--responsive-->
            <div class="container padding-top-35 visible-sm visible-xs">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="item-image-wrapper">
                            <div class="single-items">
                                <div class="iteminfo text-center">
                                    <img src="images/user-avatar.jpg"  alt="">
                                    <h2>Tom Jasan</h2>
                                    <p>Easy Polo Black Edition </p>
                                    <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="item-image-wrapper">
                            <div class="single-items">
                                <div class="iteminfo text-center">
                                    <img src="images/user-avatar.jpg"  alt="">
                                    <h2>Tom Jasan</h2>
                                    <p>Easy Polo Black Edition </p>
                                    <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="item-image-wrapper">
                            <div class="single-items">
                                <div class="iteminfo text-center">
                                    <img src="images/user-avatar.jpg"  alt="">
                                    <h2>Tom Jasan</h2>
                                    <p>Easy Polo Black Edition </p>
                                    <a href="drivers-view-page.php" class="button border with-icon add-to-cart"><i class="fa fa-plus-square"></i>View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include './footer.php'; ?>
        </div>
    </body>
    <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="scripts/mmenu.min.js"></script>
    <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="scripts/chosen.min.js"></script>
    <script type="text/javascript" src="scripts/slick.min.js"></script>
    <script type="text/javascript" src="scripts/rangeslider.min.js"></script>
    <script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
    <script type="text/javascript" src="scripts/waypoints.min.js"></script>
    <script type="text/javascript" src="scripts/counterup.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
    <script type="text/javascript" src="scripts/tooltips.min.js"></script>
    <script type="text/javascript" src="scripts/custom.js"></script>

</html>

