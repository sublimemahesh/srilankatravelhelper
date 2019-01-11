<?php
include_once(dirname(__FILE__) . '/class/include.php');
?> 
<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title>Offers || Tour Sri Lanka</title>
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
        <div id="wrapper">
            <?php include './header.php'; ?>
            <div class="container-fluid about-bg ">
                <div class="container">
                    <div class="rl-banner" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                        <h2 class="tp">Offers</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><span class="active">Offers</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <section class="blog-contents-version-one padding-bottom-10 padding-top-70 popular-packages">
                <div class="container">
                    <div class="row">
                        <?php
                        foreach (Offer::all() as $key => $offer) {

                            $DRIVER = new Drivers($offer['driver']);

                            $discount = $offer['discount'];
                            $price = $offer['price'];

                            $newprice = $price - ($price * $discount / 100);
                            ?>
                            <div class="offer-item" data-aos="fade-up" data-aos-duration="3000">
                                <div class="ribbon"><span><?php echo $offer['discount']; ?>% off</span></div>
                                <!-- hotel Image-->
                                <div class="offer-image">
                                    <a href="#">
                                        <div class="img"><img src="upload/offer/<?php echo $offer['image_name']; ?>" alt="" class="img-responsive"></div>
                                    </a>
                                </div>
                                <!-- hotel body-->
                                <div class="offer-body hidden-sm hidden-xs ">
                                    <!-- title-->
                                    <h3><?php echo $offer['title']; ?></h3>
                                    <!-- Text Intro-->
                                    <p style="text-align: justify;"><?php echo substr($offer['description'], 0, 750); ?></p>
                                </div>
                                <div class="offer-body hidden-lg hidden-md hidden-xs">
                                    <!-- title-->
                                    <h3><?php echo $offer['title']; ?></h3>
                                    <!-- Text Intro-->
                                    <p style="text-align: justify;"><?php echo substr($offer['description'], 0, 400); ?></p>
                                </div>
                                   <div class="offer-body hidden-lg hidden-md hidden-sm">
                                    <!-- title-->
                                    <h3><?php echo $offer['title']; ?></h3>
                                    <!-- Text Intro-->
                                   
                                </div>

                                <div class="offer-right"> 
                                    <div class="offer-driver-img">
                                        <a target="blank" href="member-view.php?id=" class="link" title="DRIVER : <?php echo $DRIVER->name; ?>">

                                            <?php
                                            if (empty($DRIVER->profile_picture)) {
                                                ?>
                                                <img src="upload/driver/driver.png" alt="Profile Picture" class="img-circle img-responsive vis-member-border offer-member-img"/>
                                                <?php
                                            } else {
                                                if ($DRIVER->facebookID && substr($DRIVER->profile_picture, 0, 5) === "https") {
                                                    ?>
                                                    <img src="<?php echo $DRIVER->profile_picture; ?>"  alt="Profile Picture" class="img-circle img-responsive vis-member-border offer-member-img"/>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="upload/driver/<?php echo $DRIVER->profile_picture; ?>" alt="Profile Picture" class="img-circle img-responsive vis-member-border offer-member-img"/>
                                                    <?php
                                                }
                                            }
                                            ?>


                                        </a>
                                    </div>
                                    <div class="offer-person"><span class="color-blue">LKR <?php echo number_format($newprice, 2); ?></span><strike class="old-discount-price">LKR <?php echo number_format($offer['price'], 2); ?></strike> </div>
                                    <a class="thm-btn" href="offer-booking.php?offer=<?php echo $offer['id']; ?>">Get your offer</a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Pagination -->
                            <div class="pagination-container margin-top-20 margin-bottom-40">
                                <?php // TourPackages::showPaginationOfTour($id, $setLimit, $page);  ?>
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

