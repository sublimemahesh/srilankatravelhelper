<?php
include_once(dirname(__FILE__) . '/class/include.php');

/* set page numbers */
if (isset($_GET["page"])) {
    $page = (int) $_GET["page"];
} else {
    $page = 1;
}
$setLimit = 12;
$pageLimit = ($page * $setLimit) - $setLimit;
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
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="slider css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

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

            <section class="fullwidth  padding-top-45 padding-bottom-45" data-background-color="#f8f8f8">
                <div class="container">
                    <div class="row">
                        <?php
                        $DRIVERS = Drivers::getDriversForPagination($pageLimit, $setLimit);
                        foreach ($DRIVERS as $key => $driver) {
                            ?>
                            <div class="col-md-4">
                                <a href="drivers-view-page.php?id=<?php echo $driver['id']; ?>" class="listing-item-container">

                                    <div class="listing-item">
                                        <?php
                                        foreach (DriverPhotos::getDriverPhotosByDriver($driver['id']) as $key => $photo) {
                                            if ($key == 0) {
                                                ?>
                                                <img src="upload/driver/driver-photos/thumb/<?php echo $photo['image_name']; ?>" alt="">
                                                <?php
                                            }
                                        }
                                        ?> 
                                    </div>

                                    <div class="img-pad"> 
                                        <img src="upload/driver/<?php echo $driver['profile_picture']; ?>" class="img-circle driver-list"/>

                                    </div>
                                    <div class="driver-name text-left"> 
                                        <?php echo $driver['name']; ?>
                                    </div>
                                    <div class="star-rating-fa text-right"> 
                                        <?php
                                        $REVIEWS = Reviews::getTotalReviewsOfDriver($driver['id']);

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
                                        <div class="rating-counter">(<?php echo $sum; ?> reviews)</div><br/>
                                    </div>

                                    <div style="margin-top: 15px;padding-bottom: 7px;">
                                        <p class="text-center " id="">
                                            <?php echo substr($driver['short_description'], 0, 155) . '...'; ?>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                        ?>    


                    </div>
                    <!-- Pagination -->
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <!-- Pagination -->
                            <div class="pagination-container margin-top-20 margin-bottom-40">
                                <?php Drivers::showPaginationOfDrivers($setLimit, $page); ?>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination / End -->
                </div>
            </section>
            <?php include './footer.php'; ?>
        </div>
    </body>
    <!-- Scripts
     ================================================== -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
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


</html>

