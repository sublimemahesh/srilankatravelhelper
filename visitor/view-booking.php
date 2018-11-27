<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$VISITOR = new Visitor($_SESSION['id']);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$BOOKING = new Booking($id);
$DRIVER = new Drivers($BOOKING->driver);
$TOUR = new TourPackages($BOOKING->tour_package);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Booking || Visitor DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive_visitor.css" rel="stylesheet" type="text/css"/>
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
                                View Booking (#<?php echo $BOOKING->id; ?>)
                            </div>
                            <div class="panel-body">
                                <div class="col-md-8 col-md-offset-2 view-booking-details">
                                    <div class="row">
                                        <div class="col-md-3 title">Booked At</div>
                                        <div class="col-md-9"><?php echo $BOOKING->date_time_booked; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 title">Driver</div>
                                        <div class="col-md-9"><?php echo $DRIVER->name; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 title" >Tour Package</div>
                                        <div class="col-md-9"><?php echo $TOUR->name; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 title">Start Date</div>
                                        <div class="col-md-9"><?php echo $BOOKING->start_date; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 title">End Date</div>
                                        <div class="col-md-9"><?php echo $BOOKING->end_date; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 title">No of Adults</div>
                                        <div class="col-md-9"><?php echo $BOOKING->no_of_adults; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 title">No of Children</div>
                                        <div class="col-md-9"><?php echo $BOOKING->no_of_children; ?></div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 title">Status</div>
                                        <div class="col-md-9"><?php echo ucwords($BOOKING->status); ?></div> 
                                    </div>
                                    <div class="row msg">
                                        <div class="col-md-3 title">Message</div>
                                        <div class="col-md-9"><?php echo $BOOKING->message; ?></div> 
                                    </div>
                                    <div class="btn col-md-12 <?php
                                    if ($BOOKING->status === 'canceled') {
                                        echo 'hidden';
                                    }
                                    ?>">
                                        <a href="manage-active-bookings.php" class="btn btn-info">Back</a> 
                                        <a href="#" class="btn btn-danger cancel-booking " data-id="<?php echo $BOOKING->id; ?>">Cancel Booking</a> 
                                    </div>
                                    <div class="btn col-md-12 <?php
                                    if ($BOOKING->status === 'active') {
                                        echo 'hidden';
                                    }
                                    ?>">
                                        <a href="manage-canceled-bookings.php" class="btn btn-info">Back</a> 
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