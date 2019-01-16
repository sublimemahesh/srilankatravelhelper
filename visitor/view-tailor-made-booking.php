<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$VISITOR = new Visitor($_SESSION['id']);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$BOOKING = new TailorMadeTours($id);
$VISITOR = new Visitor($BOOKING->visitor);
$places = unserialize($BOOKING->places);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Tailor Made Booking || Visitor DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
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
                                View Tailor Made Booking (#<?php echo $BOOKING->id; ?>)
                            </div>
                            <div class ="col-md-8 col-md-offset-2 viewbookingtabpane">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable viewbookingtable ">
                                    <thead>
                                        <tr>
                                            <th>Booked At</th>
                                            <td>  <?php echo $BOOKING->date_time_booked; ?> </td>
                                        </tr>
                                        <tr>
                                            <th>  Visitor </th>
                                            <td> <?php echo $VISITOR->name; ?> </td>
                                        </tr>
                                        <tr>
                                            <th>Destinations</th>
                                            <td> <?php
                                                foreach ($places as $place) {
                                                    $DESTINATION = new Destination($place);
                                                    ?>
                                                    <div class="col-md-12">
                                                        <a href="../destination-type-one-item-view-page.php?id=<?php echo $place; ?>" target="_blank" ><?php echo $DESTINATION->name; ?></a>
                                                    </div> 
                                                    
                                           
                                                    <?php
                                                }
                                                ?> </td>
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td> <?php echo $BOOKING->start_date; ?></td>
                                        </tr>
                                        <tr>
                                            <th>End Date</th>
                                            <td> <?php echo $BOOKING->end_date; ?> </td>
                                        </tr>
                                        <tr>
                                            <th>No of Adults</th>
                                            <td> <?php echo $BOOKING->no_of_adults; ?> </td>
                                        </tr>
                                        <tr>
                                            <th>No of Children</th>
                                            <td> <?php echo $BOOKING->no_of_children; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td> <?php echo 'USD ' . $BOOKING->price; ?> </td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td> <?php echo ucwords($BOOKING->status); ?> </td>
                                        </tr>
                                        <tr>
                                            <th>Message</th>
                                            <td> <?php echo $BOOKING->message; ?> </td>
                                        </tr>
                                    </thead>
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