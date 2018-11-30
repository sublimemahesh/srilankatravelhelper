<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$DRIVER = new Drivers($_SESSION['id']);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$OFFER = new offer($id);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Offer || Driver DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="css/header.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="wrapper">
            <?php
            include './header.php';
            ?>
            <div class="content">
                <?php
                include './navigation.php';
                ?>
                <div class="col-md-9 col-sm-9">
                    <div class="top-bott20 m-l-25 m-r-15">
                        <?php
                        if (isset($_GET['message'])) {

                            $MESSAGE = New Message($_GET['message']);
                            ?>
                            <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                                <?php echo $MESSAGE->description; ?>
                            </div>
                            <?php
                        }

                        $vali = new Validator();

                        $vali->show_message();
                        ?>
                    </div>
                    <div class="col-md-12 col-sm-12">

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                View Offer (#<?php echo $OFFER->id; ?>)
                            </div>
                            <div class="panel-body">
                                <div class="col-md-8 col-md-offset-2 view-booking-details">
                                    <div class="row">
                                        <div class="col-md-3 title">Title</div>
                                        <div class="col-md-9"><?php echo $OFFER->title; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 title">Start date</div>
                                        <div class="col-md-9"><?php echo $OFFER->startdate; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 title" >End Date</div>
                                        <div class="col-md-9"><?php echo $OFFER->enddate; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 title">Discount</div>
                                        <div class="col-md-9"><?php echo $OFFER->discount; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 title">Price</div>
                                        <div class="col-md-9"><?php echo $OFFER->price; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 title">Description</div>
                                        <div class="col-md-12"><?php echo $OFFER->description; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 title">Image</div>
                                        <div class="col-md-9">
                                            <img src="../upload/offer/<?php echo $OFFER->image_name; ?>" alt="" class="img-thumbnail"/>
                                        </div> 
                                    </div>
                                    
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <?php
            include './footer.php';
            ?>
        </div>

        <script src="js/jquery_2.2.4.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/cancel-booking.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
        <script>
            $(window).load(function () {
                var width = $(window).width();

                if (width > 576) {
                    var contentheight = $(window).height();
                    var navigationheight = $(window).height();

                    $('.content').css('height', contentheight);
                    $('.navigation').css('height', navigationheight);
                } else {
                    var contentheight = $(window).height() + 300;
                    $('.content').css('height', contentheight);
                }
            });
        </script>
    </body>
</html>