<?php
include_once(dirname(__FILE__) . '/class/include.php');
$id = $_GET["id"];

$DESTINATION = new Destination($id);
$DESTINATION_TYPE = new DestinationType($id);
?>  
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
    <link href="css/component.css" rel="stylesheet" type="text/css"/>
    <link href="css/default.css" rel="stylesheet" type="text/css"/>

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
                        <li><span class="active"><?php echo $DESTINATION_TYPE->name; ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container padding-top-45  padding-bottom-45">
            <div class="row">
                <!-- Sidebar
              ================================================== -->
                <div class="col-lg-3 col-md-4">
                    <div class="boxed-widget opening-hours margin-top-35">

                        <h3><i class="fa fa-map-marker"></i><?php echo $DESTINATION_TYPE->name ?></h3>
                        <ul>
                            <?php
                            $DESTINATIONS = Destination::getDestinationById($id);
                            foreach ($DESTINATIONS as $key => $destination) {
                                ?>
                                <li><a href="destination-type-one-item-view-page.php?id=<?php echo $destination["id"]; ?>"><i class="fa fa-check"></i><?php echo $destination["name"]; ?></a></li>
                                <?php
                            }
                            ?>

                        </ul>
                    </div>

                </div>
                <!-- Sidebar / End -->
                <div class="col-lg-9 col-md-8 padding-right-30">
                    <!-- Sorting / Layout Switcher -->
                    <div class="row margin-bottom-25">
                    </div>
                    <div class="row">
<?php
$DESTINATIONS = Destination::getDestinationById($id);
foreach ($DESTINATIONS as $key => $destination) {
    ?>
                            <!-- Listing Item -->
                            <div class="col-lg-12 col-md-12">
                                <div class="listing-item-container list-layout">
                                    <a href="destination-type-one-item-view-page.php?id=<?php echo $destination['id']; ?>" class="listing-item">

                                        <!-- Image -->
                                        <div class="listing-item-image">
                                            <img src="upload/destination/<?php echo $destination['image_name']; ?>" alt="">
                                            <span class="tag"style="background: #0dce38!important" >View </span>
                                        </div>

                                        <!-- Content -->
                                        <div class="listing-item-content">


                                            <div class="listing-item-inner">
                                                <h3><?php echo $destination['name']; ?></h3>
                                                <span class="para"><?php echo $destination['short_description']; ?></span>
                                                <div class="star-rating">
                                                    <?php
                                                    $REVIEWS = Reviews::getTotalReviewsOfDestination($destination['id']);

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
                                                    <div class="rating-counter">(<?php echo $sum; ?> reviews)</div>
                                                </div>
                                            </div>

                                            <span class="like-icon"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- Listing Item / End -->
    <?php
}
?>
                    </div>
                    <!-- Pagination -->
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Pagination -->
                            <div class="pagination-container margin-top-20 margin-bottom-40">
                                <nav class="pagination">
                                    <ul>
                                        <li><a href="#" class="current-page">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination / End -->

                </div>



            </div>
        </div>
<?php include './footer.php'; ?>
    </div>
</body>
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
<script src="desti/toucheffects.js" type="text/javascript"></script>
<script src="css/modernizr.custom.js" type="text/javascript"></script>

</html>
