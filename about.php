<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<head>
    <!-- Basic Page Needs
       ================================================== -->
    <title>About Us || Tour Sri Lanka</title>
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

</head>

<body>
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header Container
               ================================================== -->
        <?php include './header.php'; ?>
        <div class="container-fluid about-bg ">
            <div class="container">
                <div class="rl-banner" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="3500">
                    <h2 class="tp">About Us</h2>
                    <ul>
                        <li><a href="./">Home</a></li>
                        <li><span class="active">About Us</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container  padding-top-70">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="3500">
                    <img src="images/destination/whild-life.jpg" alt=""/>
                </div>
                <div class="col-md-6 padding-top-20" data-aos="fade-down" data-aos-duration="3500">
                    <p>
                        Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. 
                        Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.
                        Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. 
                        Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.
                        Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. 
                        Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.
                        </br>   
                        Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. 
                        Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.
                        Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. 
                        Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.
                    </p> 

                </div>
            </div>
        </div>
        <section class="fullwidth margin-top-0 padding-top-20 padding-bottom-50" data-background-color="#fff" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pricing-container margin-top-30" data-aos="fade-up" data-aos-duration="3500">
                            <div class="plan">
                                <div class="plan-price">
                                    <h3>Vision</h3>

                                    <span class="period">Free of charge one standard listing active for 30 days Free of charge one standard listing active for 30 day  in the search results</span>
                                </div>
                            </div>
                            <div class="plan featured">

                                <div class="plan-price">
                                    <h3>Mission</h3>

                                    <span class="period">One time fee for one listing, highlighted in the search resultsOne time fee for one listing, highlighted in the search results</span>
                                </div>
                            </div>
                            <div class="plan">
                                <div class="plan-price">
                                    <h3>Strenghts</h3>

                                    <span class="period">Monthly subscription for unlimited listings and availability .Monthly subscription for unlimited listings and availability</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
    <script src="scripts/aos.js" type="text/javascript"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
