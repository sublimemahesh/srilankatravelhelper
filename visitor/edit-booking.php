<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$VISITOR = new Visitor($_SESSION['id']);
$BOOKING = new Booking($id);
$TOUR = new TourPackages($BOOKING->tour_package);
$DRIVER = new Drivers($BOOKING->driver);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Booking  || Visitor DashBoard</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive_visitor.css" rel="stylesheet" type="text/css"/>
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
                    <div class="col-md-12">

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Edit Booking (#<?php echo $BOOKING->id; ?>)
                            </div>
                            <div class="panel-body">
                                <form method="post" action="post-and-get/booking.php"  enctype="multipart/form-data">

                                    <div class="row form-data">
                                        <label>Tour Package</label>
                                        <input type="text" name="tour_package" id="tour_package" class="form-control" placeholder="Enter Name" value="<?php echo $TOUR->name; ?>" disabled />
                                    </div>
                                    <div class="row form-data">
                                        <label>Driver</label>
                                        <input type="text" name="driver" id="driver" class="form-control" placeholder="Enter Driver" value="<?php echo $DRIVER->name; ?>" disabled="" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Start Date</label>
                                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Enter Start Date" value="<?php echo $BOOKING->start_date; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>End Date</label>
                                        <input type="text" name="end_date" id="end_date" class="form-control" placeholder="Enter End Date" value="<?php echo $BOOKING->end_date; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>No of Adults</label>
                                        <input type="number" name="no_of_adults" id="no_of_adults" class="form-control" placeholder="Enter No of Adults" value="<?php echo $BOOKING->no_of_adults; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>No of Children</label>
                                        <input type="number" name="no_of_children" id="no_of_children" class="form-control" placeholder="Enter No of Children" value="<?php echo $BOOKING->no_of_children; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Message</label>
                                        <textarea name="message" id="message" class="form-control"><?php echo $BOOKING->message; ?></textarea>
                                    </div>
                                    <div class="row form-data">
                                        <input type="hidden" name="id" value="<?php echo $BOOKING->id; ?>" />
                                        <input type="submit" name="update" id="update" class="btn btn-lg btn-green" value="Save Data" />
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
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
        <script>
            $(function () {
                $("#start_date").datepicker({dateFormat: "yy-mm-dd"}).val()
                $("#end_date").datepicker({dateFormat: "yy-mm-dd"}).val()
            });
        </script>
        <script>
            $(window).load(function () {
                var width = $(window).width();

                if (width > 576) {
                    var contentheight = $(window).height();
                    var navigationheight = $(window).height();

                    $('.content').css('height', contentheight);
                    $('.navigation').css('height', navigationheight);
                } else {
                    var contentheight = $(window).height();
                    $('.content').css('height', contentheight);
                }
            });
        </script>
    </body>
</html>
