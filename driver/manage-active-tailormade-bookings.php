<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$DRIVER = new Drivers($_SESSION['id']);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Manage Tailor-made Bookings || Driver DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="plugins/datatables-responsive/dataTables.responsive.css" rel="stylesheet" type="text/css"/>
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
                                Manage Tailor Made Bookings
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Booking ID</th>
                                            <th>Booked At</th>                               
                                            <th>Visitor</th>
                                            <th>Price</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Booking ID</th>
                                            <th>Booked At</th>                               
                                            <th>Visitor</th>
                                            <th>Price</th>
                                            <th>Option</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <?php
                                        $PRICE = new DriverBooking($DRIVER->id);
                                        $i = 0;
                                        foreach (DriverBooking::getActiveBookingsByDriver($DRIVER->id) as $key => $booking) {
                                            $TBooking = new TailorMadeTours($DRIVER->id);
                                            $VISITOR = new Visitor($TBooking->visitor);
                                            $drBooking = new DriverBooking($booking['id']);

                                            $i++;
                                            ?>
                                            <tr id="row_<?php echo $drBooking->booking_id; ?>">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $booking['booking_id']; ?></td> 
                                                <td><?php echo $booking['date_time_booked']; ?></td> 

                                                <td><?php echo $VISITOR->name; ?></td> 
                                                <td><?php echo 'USD ' . $drBooking->price; ?></td> 
                                                <td> 
                                                    <a href="view-tailor-made-booking.php?id=<?php echo $drBooking->booking_id; ?>" class="op-link btn btn-sm btn-info" title="View Booking"><i class="glyphicon glyphicon-eye-open"></i></a> |  
                                                    <a href="#" class="cancel-tailor-made-booking btn btn-sm btn-danger" data-id="<?php echo $drBooking->booking_id; ?>"  title="Cancel Tailor-made Booking">
                                                        <i class="waves-effect glyphicon glyphicon-remove-circle" data-type="cancel"></i>
                                                    </a> |
                                                    <a href="set-price-for-tailor-made-booking.php?id=<?php echo $drBooking->id; ?>" class="op-link btn btn-sm btn-warning" title="Set Price"><i class="glyphicon glyphicon-usd"></i></a>

                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>   
                                    </tbody>
                                </table>
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
        <script src="js/cancel-tailor-made-booking.js" type="text/javascript"></script>
        <script src="plugins/jquery-datatable/jquery.dataTables.js" type="text/javascript"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="js/jquery-datatable.js" type="text/javascript"></script>
        <script src="plugins/datatables-responsive/dataTables.responsive.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
        <script>
            $(window).load(function () {
                var width = $(window).width();

                if (width > 576) {
                    var contentheight = $(window).height();
                    var navigationheight = $(window).height() - 75;

                    $('.content').css('height', contentheight);
                    $('.navigation').css('height', navigationheight);
                } else {
                    var contentheight = $(window).height();
//                    $('.content').css('height', contentheight);
                }
            });
            $(document).ready(function () {
                var width = $(window).width();

                if (width < 576) {
                    setTimeout(function () {
                        $('.table').css('width', '228px');
                    }, 1000);
                }
            });
        </script>
<!--        <script>
            $(document).ready(function () {
                $('#datatable').DataTable({
                    responsive: true,
                    "lengthMenu": [[100, 250, 500, 1000, -1], [100, 250, 500, 1000, "All"]],
                    "order": [[ 2, "desc" ]]
                });
            });
            
        </script>-->
    </body>
</html>