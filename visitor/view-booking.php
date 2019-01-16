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
                            <div class ="col-md-8 col-md-offset-2 viewbookingtabpane">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable viewbookingtable ">

                                    <tr>
                                        <td>  Booked At </td>
                                        <td>  <?php echo $BOOKING->date_time_booked; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>  Driver </td>
                                        <td> <?php echo $DRIVER->name; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>  Tour Package </td>
                                        <td> <?php echo $TOUR->name; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>  Start Date </td>
                                        <td>  <?php echo $BOOKING->start_date; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>  End Date </td>
                                        <td>  <?php echo $BOOKING->end_date; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>  No of Adults </td>
                                        <td>  <?php echo $BOOKING->no_of_adults; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>  No of Children </td>
                                        <td> <?php echo $BOOKING->no_of_children; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>  Price </td>
                                        <td>  <?php echo 'USD ' . $BOOKING->price; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>  Status </td>
                                        <td>  <?php echo ucwords($BOOKING->status); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>  Message </td>
                                        <td>  <?php echo $BOOKING->message; ?> </td>
                                    </tr>
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
        <script src="js/cancel-booking.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
        <script>
            $(window).load(function () {
                var width = $(window).width();

                if (width > 576) {
                    var contentheight = $(window).height() + 100;
                    var navigationheight = $(window).height() + 25;

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