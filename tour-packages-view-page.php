 
<!DOCTYPE html>
<head>
    <!-- Basic Page Needs
       ================================================== -->
    <title>Sri Lanka Travel Helper</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
       ================================================== -->
    <link rel="stylesheet" href="css/style.css">
    <link href="css/custom.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/colors/main.css" id="colors">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>    
    <link href="css/set1.css" rel="stylesheet" type="text/css"/>
    <link href="lib/owl/assets/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
    <link href="lib/owl/assets/owl.theme.default.min.css" rel="stylesheet" type="text/css"/>

</head>
<body>
    <div id="wrapper">
        <?php include './header.php'; ?>
        <div class="container-fluid about-bg ">
            <div class="container">
                <div class="rl-banner">
                    <h2 class="tp">Tour Packages</h2>
                    <ul>
                        <li><a href="./">Home</a></li>
                        <li><span class="active">Tour Packages</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <section>
            <div class="container padding-bottom-45 padding-top-45">
                <div class="row">
                    <div class="col-md-6" >
                        <h3 class="headline">Tour Package Name</h3>
                        <hr>
                        <p>Start journey to reach Nuwara Eliya, while on that journey visit while on that stop at Devon water fall ,
                            situated 6 km west of Thalawakele. The falls is named after a pioneer English coffee planter called Devon, 
                            whose plantation is situated nearby the falls. The Waterfall is 97 meters high and ranked 19th highest in the Island.
                            After seen this water fall we reach one more Water Fall called St Clairs are situated 3 kilometers west of the town 
                            of Thalawakele. 
                            Overnight at Nuwara Eliya.</p>   
                    </div>
                    <div class="col-md-6">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="images/tour/1.jpg" alt="Los Angeles" style="width:100%;">
                                </div>
                                <div class="item">
                                    <img src="images/tour/3.jpg" alt="Chicago" style="width:100%;">
                                </div>
                                <div class="item">
                                    <img src="images/tour/4.jpg" alt="New york" style="width:100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container padding-bottom-35 ">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="headline">More Tour Package</h3>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        <div class="col-md-12"> 
                            <img src="images/1.png" alt=""/>
                        </div>
                        <div  class="col-md-12"> 
                            <img src="images/2.png" alt=""/>
                        </div>
                        <div class="col-md-12"> 
                            <img src="images/4.png" alt=""/>
                        </div>
                        <div class="col-md-12"> 
                            <img src="images/3.png" alt=""/>
                        </div>
                        <div class="col-md-12"> 
                            <img src="images/1.png" alt=""/>
                        </div>
                        <div class="col-md-12" > 
                            <img src="images/1.png" alt=""/>
                        </div>
                        <div class="col-md-12"> 
                            <img src="images/1.png" alt=""/>
                        </div>
                        <div class="col-md-12"> 
                            <img src="images/1.png" alt=""/>
                        </div>
                        <div class="col-md-12" > 
                            <img src="images/1.png" alt=""/>
                        </div>
                        <div class="col-md-12"> 
                            <img src="images/1.png" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include './footer.php'; ?>
</div>

 <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
    <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
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
<script src="scripts/bootstrap.min.js" type="text/javascript"></script>
<script src="lib/owl/owl.carousel.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 5
                },
                1000: {
                    items: 5
                },
                1200: {
                    items: 5
                }
            },
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            animateOut: true,

        });
    });
</script>
</body>
</html>

