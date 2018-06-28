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
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
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
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container margin-top-70">
                <div class="row">
                      <?php
                $DESTINATION_TYPES = DestinationType::all();
                foreach ($DESTINATION_TYPES as $destination_type) {
                  
                        ?>
                    <div class="col-md-4">
                        <a href="destination-type-view-page.php?id=<?php echo $destination_type['id'];?>" class="listing-item-container">
                            <div class="listing-item">
                                <img src="upload/destination-type/<?php echo $destination_type['image_name'];?>" alt="">
                                <div class="listing-item-content">
                                    <span class="tag" style="background: #0dce38!important">View</span>
                                    <h3><?php echo $destination_type['name'];?></h3>
<!--                                    <span><?php echo $destination_type['description'];?></span>-->
                                    <div class="star-rating" data-rating="5.0" style="padding: 15px 0px !important;">
                                        <div class="rating-counter">(31 reviews)</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                          <?php
                    
                }
                ?>
                </div>
            </div>
            <?php include './footer.php'; ?>
        </div>
    </body>


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

</html>

