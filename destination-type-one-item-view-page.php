<?php
include_once(dirname(__FILE__) . '/class/include.php');
$id = $_GET["id"];

$DESTINATION_PHOTOS = new DestinationPhotos($id);
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
<!--        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="css/galleria.classic.min.css" rel="stylesheet" type="text/css"/>
        <!--reviws fonts-->
        <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet"> 
        <style>


            /* This rule is read by Galleria to define the gallery height: */
            #galleria{height:480px}

            /*reviews*/
            .img-section img{
                margin-top:30px;
                border:6px solid #fff;
            }

            .reviws-section{
                /*                border: 1px solid #000;*/
                background:#F7F7F0;
                border-radius:3%;
                padding: 1% 1% 1% 1%;
                margin-bottom: 20px;
                width: 100%;

            }
            .reviews-title{
                margin-top:10px;
                font-family: 'Courgette', cursive;
                margin-left: 10px;
            }
            .reviews-description{
                font-family: 'Courgette', cursive;

            }
            .package-ratings-review{
                padding-top: 10px;
                padding-bottom: 10px;
            }
            .package-ratings-review li{
                list-style-type: none;
                /*                border-left:1px solid #000;*/
            }
            .count-reviews{
                margin-top: 12px;
                font-size:19px;
            }
            .star-section{
                border-left:2px solid #e3d9d9;
                height:170px; 

            }
            .reviews-item1 li{
                color:#f5cf00;

            }

            span.like-icon {
                /*                bottom: 50%;*/
                top:30%;
                transform: translateY(50%);
                background-color: #eee;
                color: #9d9d9d;
                right: 11px
            }

            span.like-icon.liked,
            span.like-icon:hover {
                background-color: #f3103c;
                color: #fff
            }
            .like-icon-section{
                margin: 1px 1px 1px 1px;
            }
            .like-icon-section-pd{
                padding-right: 2px;
            }
            /*user rating*/

            .btn-grey{
                background-color:#D8D8D8;
                color:#FFF;
            }
            .rating-block{
                background-color:#F7F7F0;
                border:1px solid #F7F7F0;
                padding:7% 12% 7% 12%;
                border-radius:3%;
            }
            .bold{
                font-weight:700;
            }
            .padding-bottom-7{
                padding-bottom:7px;
            }

            .review-block{
                background-color:#FAFAFA;
                border:1px solid #EFEFEF;
                padding:15px;
                border-radius:3px;
                margin-bottom:15px;
            }
            .review-block-name{
                font-size:12px;
                margin:10px 0;
            }
            .review-block-date{
                font-size:12px;
            }
            .review-block-rate{
                font-size:13px;
                margin-bottom:15px;
            }
            .review-block-title{
                font-size:15px;
                font-weight:700;
                margin-bottom:10px;
            }
            .review-block-description{
                font-size:13px;
            }
            .rating-breakdown{

                border-radius:3%;
                /*                padding: 1% 1% 1% 1%;*/

            }
            .read-more-reviews{
                color: #0dce38;
                text-decoration: none;
            }
            .read-more-reviews:hover{
                color: #0dce38;
                text-decoration: none;
            }
            .more-reviews-item1 li{
                color:#f5cf00;
                list-style-type: none;
                margin-bottom: 10px;
                font-size: 8px;

            }

        </style>
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



            <div class="container padding-bottom-45 padding-top-45">
                <div class="row">
                   
                    <div class="col-md-9">
                                         <?php
                    $DESTINATIONS = Destination::getDestinationByDestinationType($id);
                    foreach ($DESTINATIONS as $key => $destination) {
                        ?>
                     <div class=" content">
                            <div id="galleria">
                                 <?php
                                        $DESTINATION_PHOTOS = DestinationPhotos::getDestinationByDestinationPhotos($id);
                                        foreach ($DESTINATION_PHOTOS as $key => $destination_photos) {
                                          
                                                ?>
                                <a href="upload/destination-photos/<?php  echo $destination_photos['image_name']; ?>">
                                    <img 
                                        src="upload/destination-photos/<?php  echo $destination_photos['image_name']; ?>",
                                        data-big="images/tour/3.jpg"
                                        data-title="Biandintz eta zaldiak"
                                        data-description="Horses on Bianditz mountain, in Navarre, Spain."
                                        >
                                </a>
                                <?php 
                                        }
                                ?>
                              

                            </div>
                        </div>
                        <div class="padding-top-10" >
                  
                            <hr  >
                            <h3 class="headline"><?php echo $destination['name'];?></h3>
                            <hr  >
                            <p>
                                <?php echo $destination['description'];?>
                                
                            </p> 
                    
                        </div>
                                  <?php 
                    }
                    
                    ?>
                    </div>
                    <div class="col-md-3" >
                        <div>
                            <h3 class="headline text-center" >More Destination</h3>
                        </div> 
                           <?php
                                    $DESTINATIONS = Destination::all();
                                    foreach ($DESTINATIONS as $key => $destination) {
                                        if ($key < 7) {
                                            ?>
                        <div  class="col-md-12 col-xs-12 more-items" >
                            <a href="destination-type-one-item-view-page.php?id=<?php echo $destination['id'];?>">
                            <h5  class="text-center headline"><?php echo $destination['name'];?></h5>
                            <div class="col-md-5 col-xs-5 more-items-image">
                                <img  src="upload/destination/thumb/<?php echo $destination['image_name'];?>"  class="img-circle" alt=""/>
                                
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <p   ><?php echo substr($destination['short_description'], 0, 12) . '...';?></p>
                                  <div class="more-reviews-item1">
                                    <li>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </li>
                                </div>
                            </div>
                            </a>
                        </div>
                
                      <?php 
                                    }}
                                    
                      ?>
                     
                    </div>
                  
                </div>
            </div>
            <div class="container padding-bottom-35">
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h3 class="headline ">Reviews(3,090)</h3>
                        <hr>
                        <div class="col-md-4 rating-breakdown">
                            <div class="row">
                                <div class="col-md-12  rating-block">
                                    <h2 class="bold padding-bottom-7">4.3 <small>/ 5</small></h2>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 " style="background:#9d9d9d;margin-top: 20px;padding: 7% 12% 7% 12%;background-color: #F7F7F0;
                                     border: 1px solid #F7F7F0;border-radius: 3%; ">

                                    <div class="pull-left" >
                                        <div class="pull-left" style="width:35px; line-height:1;">
                                            <div style="height:9px; margin:5px 0;">5 <span class="fa fa-star"></span></div>
                                        </div>
                                        <div class="pull-left" style="width:180px;">
                                            <div class="progress" style="height:9px; margin:8px 0;">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 1000%">
                                                    <span class="sr-only">80% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pull-right" style="margin-left:10px;">1</div>
                                    </div>
                                    <div class="pull-left">
                                        <div class="pull-left" style="width:35px; line-height:1;">
                                            <div style="height:9px; margin:5px 0;">4 <span class="fa fa-star"></span></div>
                                        </div>
                                        <div class="pull-left" style="width:180px;">
                                            <div class="progress" style="height:9px; margin:8px 0;">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: 80%">
                                                    <span class="sr-only">80% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pull-right" style="margin-left:10px;">1</div>
                                    </div>
                                    <div class="pull-left">
                                        <div class="pull-left" style="width:35px; line-height:1;">
                                            <div style="height:9px; margin:5px 0;">3 <span class="fa fa-star"></span></div>
                                        </div>
                                        <div class="pull-left" style="width:180px;">
                                            <div class="progress" style="height:9px; margin:8px 0;">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: 60%">
                                                    <span class="sr-only">80% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pull-right" style="margin-left:10px;">0</div>
                                    </div>
                                    <div class="pull-left">
                                        <div class="pull-left" style="width:35px; line-height:1;">
                                            <div style="height:9px; margin:5px 0;">2 <span class="fa fa-star"></span></div>
                                        </div>
                                        <div class="pull-left" style="width:180px;">
                                            <div class="progress" style="height:9px; margin:8px 0;">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: 40%">
                                                    <span class="sr-only">80% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pull-right" style="margin-left:10px;">0</div>
                                    </div>
                                    <div class="pull-left">
                                        <div class="pull-left" style="width:35px; line-height:1;">
                                            <div style="height:9px; margin:5px 0;">1 <span class="fa fa-star"></span></div>
                                        </div>
                                        <div class="pull-left" style="width:180px;">
                                            <div class="progress" style="height:9px; margin:8px 0;">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: 20%">
                                                    <span class="sr-only">80% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pull-right" style="margin-left:10px;">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 ">
                            <div class="reviws-section">
                                <div class="row">
                                    <div class="col-md-2 img-section">
                                        <img src="images/reviews-avatar.jpg" class="img-circle"  alt=""/>
                                        <h4 class="center reviews-title">Name</h4>
                                    </div>  
                                    <div class="col-md-7">
                                        <h4 class=" reviews-title">Title</h4>
                                        <p class="reviews-description">Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros.
                                            Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.
                                            <a class="read-more-reviews"  data-toggle="collapse" href="#item1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Read more...
                                            </a></p>
                                        <p class="collapse reviews-description" id="item1" >Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros.
                                            Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.
                                        </p>
                                    </div> 
                                    <div class="col-md-3 star-section">
                                        <div class="package-ratings-review">

                                            <ul class="two-column">
                                                <div class="reviews-item1 ">
                                                    <li>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </li>
                                                    <li>
                                                        <p class="count-reviews" style="color:#000 !important;">27 Reviews</p>
                                                    </li>
                                                    <div class="like-icon-section">
                                                        <div class="col-md-4 like-icon-section-pd">
                                                            <span class="like-icon"></span>
                                                        </div>
                                                        <div class="col-md-4 like-icon-section-pd">
                                                            <span class="like-icon"></span>
                                                        </div>
                                                        <div class="col-md-4 like-icon-section-pd">
                                                            <span class="like-icon "></span>
                                                        </div>
                                                    </div>


                                                </div>
                                            </ul>

                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div >

                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <?php include './footer.php'; ?>
        </div>
    <!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.js"></script>-->
        <script src="scripts/jquery_2.2.4.js" type="text/javascript"></script>
        <!-- load Galleria -->
    <!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/galleria/1.5.3/galleria.min.js"></script>-->
        <script src="scripts/galleria_1.5.3.min.js" type="text/javascript"></script>
    <!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/galleria/1.5.3/themes/classic/galleria.classic.min.js"></script>-->
        <script src="scripts/galleria_1.5.3_galleria.classic.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                Galleria.run('#galleria');

            });
        </script>

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
