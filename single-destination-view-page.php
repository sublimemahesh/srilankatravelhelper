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
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors"> 
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container-fluid about-bg ">
                <div class="container">
                    <div class="rl-banner">
                        <h2 class="tp">Destination</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Destination</span></li>
                            <li><span class="active">Destination View</span></li>
                            <li><span class="active">Destination Name</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container padding-top-70 padding-bottom-35 ">
                <div class="row">
                    <div class="col-md-9">
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
                        <div class="padding-top-10" >
                            <hr  >
                            <h3 class="headline">Name of destination</h3>
                            <hr  >
                            <p>Morbi convallis bibendum urna ut viverra. 
                                Maecenas quis consequat libero, a feugiat eros. 
                                Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.
                                Morbi convallis bibendum urna ut viverra. 
                                Maecenas quis consequat libero, a feugiat eros. 
                                Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.</p>
                            <p>Morbi convallis bibendum urna ut viverra. 
                                Maecenas quis consequat libero, a feugiat eros. 
                                Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.</p>
                        </div>
                    </div>
                    <div class="col-md-3" >
                        <div>
                            <h3 class="headline text-center" >More Destination</h3>
                        </div>
                        <!--                    <div class="grid " data-spy="scroll" data-target=".navbar" data-offset="50">
                                                <figure class="effect-layla">
                                                    <img src="images/tour/3.jpg" alt="img06"/>
                                                    <figcaption>
                                                        <h2>Kandy<span>City</span></h2>
                                                    </figcaption>			
                                                </figure>
                                                <figure class="effect-layla">
                                                    <img src="images/tour/4.jpg" alt="img03"/>
                                                    <figcaption>
                                                        <h2>Kandy<span>City</span></h2>
                                                    </figcaption>			
                                                </figure>
                                                <figure class="effect-layla">
                                                    <img src="images/tour/3.jpg" alt="img03"/>
                                                    <figcaption>
                                                        <h2>Kandy<span>City</span></h2>
                                                    </figcaption>			
                                                </figure>
                                            </div> -->

                        <div  class="col-md-12 more-items" >
                            <h5  class="text-center headline">   Morb onvallis . </h5>
                            <img  src="images/reviews-avatar.jpg"  class="img-circle" alt=""/>
                            <p class="text-justify"  >Morbiconvallis convallis bibendum  </p> </div>
                        <div  class="col-md-12 more-items" >
                            <h5  class="text-center headline">   Morb onvallis . </h5>
                            <img  src="images/reviews-avatar.jpg"  class="img-circle" alt=""/>
                            <p class="text-justify"  >Morbiconvallis convallis bibendum  </p> </div>
                        <div  class="col-md-12 more-items" >
                            <h5  class="text-center headline">   Morb onvallis . </h5>
                            <img  src="images/reviews-avatar.jpg"  class="img-circle" alt=""/>
                            <p class="text-justify"  >Morbiconvallis convallis bibendum  </p> </div>
                        <div  class="col-md-12 more-items" >
                            <h5  class="text-center headline">   Morb onvallis . </h5>
                            <img  src="images/reviews-avatar.jpg"  class="img-circle" alt=""/>
                            <p class="text-justify"  >Morbiconvallis convallis bibendum  </p> </div>
                        <div  class="col-md-12 more-items" >
                            <h5  class="text-center headline">   Morb onvallis . </h5>
                            <img  src="images/reviews-avatar.jpg"  class="img-circle" alt=""/>
                            <p class="text-justify"  >Morbiconvallis convallis bibendum  </p> </div>
                    </div>
                </div>
            </div>
            <?php include './footer.php'; ?>
        </div>
<!--        <script>
            // For Demo purposes only (show hover effect on mobile devices)
            [].slice.call(document.querySelectorAll('.content a')).forEach(function (el) {
                el.onclick = function () {
                    return false;
                }
            });
        </script>-->
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
      
    </body>
</html>
