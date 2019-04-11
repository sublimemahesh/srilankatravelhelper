<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$VISITOR = new Visitor($_SESSION['id']);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Manage Tailor Made Bookings || Visitor DashBoard</title>
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
                <div class="col-md-9 col-sm-8">
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

                        <div class="panel panel-green profile-panel taiermadepanal">
                            <div class="panel-heading ">
                                Manage Tailor Made Bookings
                            </div>
                            <div class="panel-body">
                                <div class="col-xs-12 col-md-4 col-md-offset-2 text-center">
                                    <div class="manage-box box-green">
                                        <div class="manage-circle box-green">
                                            <i class="glyphicon glyphicon-check"></i>
                                        </div>
                                        <h3><a href="manage-active-tailormade-bookings.php" target="new">Pending Bookings</a></h3>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 text-center">
                                    <div class="manage-box box-red">
                                        <div class="manage-circle box-red">
                                            <i class="glyphicon glyphicon-unchecked"></i>
                                        </div>
                                        <h3><a href="manage-canceled-tailormade-bookings.php" target="new">Canceled Bookings</a></h3>
                                    </div>
                                </div>
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
        <script src="js/custom.js" type="text/javascript"></script>

        <script>
            $(window).load(function () {
                var width = $(window).width();

                if (width > 576) {
                   var contentheight = $(window).height() + 100;
                    var navigationheight = $(window).height() + 25;

                    $('.content').css('height', contentheight);
                    $('.navigation').css('height', navigationheight);
                } 
            });
        </script>
    </body>
</html>