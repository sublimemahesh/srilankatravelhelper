<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$BOOKING = new Booking($id);
$VISITOR = new Visitor($BOOKING->visitor);
$DRIVER = new Drivers($BOOKING->driver);
$TOUR = new TourPackages($BOOKING->tour_package);
?> 
﻿<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>View Bookings - Tours Sri Lanka</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
        <style>
            .card {
                height: 730px;
            }
        </style>
    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>
        <section class="content">
            <div class="container-fluid"> 
                <!-- Manage Brand -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    View Booking(#<?php echo $BOOKING->id; ?>)
                                </h2>

                            </div>
                            <div class="body">
                                <!--                                <div class="table-responsive">-->
                                <div>
                                    <div class="col-md-8 col-md-offset-2 view-booking-details">
                                        <div class="row">
                                            <div class="col-md-3 title">Booked At</div>
                                            <div class="col-md-9"><?php echo $BOOKING->date_time_booked; ?></div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 title">Visitor</div>
                                            <div class="col-md-9"><?php echo $VISITOR->name; ?></div> 
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
                                        <div class="btn1 col-md-12 <?php
                                        if ($BOOKING->status === 'canceled') {
                                            echo 'hidden';
                                        }
                                        ?>">
                                            <a href="manage-active-bookings.php" class="btn btn-info">Back</a> 
                                            <a href="#" class="btn btn-danger cancel-booking " data-id="<?php echo $BOOKING->id; ?>">Cancel Booking</a> 
                                        </div>
                                        <div class="btn1 col-md-12 <?php
                                        if ($BOOKING->status === 'active') {
                                            echo 'hidden';
                                        }
                                        ?>">
                                            <a href="manage-canceled-bookings.php" class="btn btn-info">Back</a> 
                                        </div>

                                    </div>
                                </div>
                                <!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Manage brand -->

            </div>
        </section>

        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>
        <script src="js/demo.js"></script>
        <script src="js/cancel-booking.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <script src="js/pages/ui/dialogs.js"></script>
        <script src="js/demo.js"></script>
    </body>

</html> 