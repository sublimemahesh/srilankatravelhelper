<?php
include_once(dirname(__FILE__) . '/class/include.php');
?>
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
        <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <!--    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="css/set1.css" rel="stylesheet" type="text/css"/>
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
            <section class="fullwidth   padding-top-45 padding-bottom-45" data-background-color="#fff">
                <div class="container">
                    <div class="row">
                        <?php
                        $TOUR_TYPES = TourType::all();
                        foreach ($TOUR_TYPES as $tour_type) {
                            ?>
                            <div class="col-md-4">
                                <a href="tour-packages-type-view-page.php?id=<?php echo $tour_type['id']; ?>" class="blog-compact-item-container">
                                    <div class="blog-compact-item">
                                        <img src="upload/tour-type/<?php echo $tour_type['image_name']; ?>" alt="">
                                        <span class="blog-item-tag" style="background: #0dce38!important">View</span>
                                        <div class="blog-compact-item-content">
                                            <ul class="blog-post-tags">
                                                <li><div class="star-rating-fa text-right"> 
                                                        <?php
                                                        $REVIEWS = Reviews::getTotalReviewsOfTourType($tour_type['id']);

                                                        $divider = $REVIEWS['count'];
                                                        $sum = $REVIEWS['sum'];

                                                        if ($divider == 0) {
                                                            for ($j = 1; $j <= 5; $j++) {
                                                                ?>
                                                                <i class="fa fa-star-o"></i>
                                                                <?php
                                                            }
                                                            $sum = 0;
                                                        } else {
                                                            $stars = $sum / $divider;

                                                            for ($i = 1; $i <= $stars; $i++) {
                                                                ?>
                                                                <i class="fa fa-star"></i>
                                                                <?php
                                                            }
                                                            for ($j = $i; $j <= 5; $j++) {
                                                                ?>
                                                                <i class="fa fa-star-o"></i>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <div class="rating-counter-tour">(<?php echo $sum; ?> reviews)</div><br/>
                                                    </div></li>
                                            </ul>
                                            <h3><?php echo $tour_type['name']; ?></h3>
                                            <p><?php echo substr($tour_type['short_description'], 0, 155) . '...'; ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                        ?> 
                    </div>
                </div>
            </section>
<?php include './footer.php'; ?>
        </div>
        <script>
            // For Demo purposes only (show hover effect on mobile devices)
            [].slice.call(document.querySelectorAll('.content a')).forEach(function (el) {
                el.onclick = function () {
                    return false;
                }
            });
        </script>


        <!-- Scripts
         ================================================== -->
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
