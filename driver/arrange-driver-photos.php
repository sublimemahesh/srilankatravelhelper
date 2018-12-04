<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$DRIVER = new Drivers($_SESSION['id']);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$DRIVERPHOTOS = DriverPhotos::getDriverPhotosByDriver($DRIVER->id);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Arrange Driver Photos || Driver DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>

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
                                Arrange Driver Photos
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-photos.php">
                                            <i class="fa fa-list"></i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="post-and-get/driver-photos.php" enctype="multipart/form-data">
                                    <div class="row">
                                        <ul id="sortable">
                                            <?php
                                            if (count($DRIVERPHOTOS) > 0) {
                                                foreach ($DRIVERPHOTOS as $key => $img) {
                                                    ?>
                                                    <div class="col-md-3 col-sm-4" style="list-style: none;">
                                                        <li class="ui-state-default">
                                                            <span class="number-class">(<?php echo $key + 1; ?>)</span>
                                                            <img class="img-responsive" src="../upload/driver/driver-photos/thumb1/<?php echo $img["image_name"]; ?>" alt=""/>
                                                            <input type="hidden" name="sort[]"  value="<?php echo $img["id"]; ?>" class="sort-input"/>

                                                        </li>
                                                    </div>

                                                    <?php
                                                }
                                            } else {
                                                ?> 
                                                <b>No images in the database.</b> 
                                            <?php } ?> 

                                        </ul>
                                    </div>

                                    <div class="row form-data text-center">
                                        <input type="submit" name="save-data" id="update" class="btn btn-green" value="Save Changes" />
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
        <script src="js/sign-up.js" type="text/javascript"></script>
        <script src="js/add-driver.js" type="text/javascript"></script>
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
                    $('.content').css('height', contentheight);
                }
            });
        </script>
        <script>
            $(function () {
                $("#sortable").sortable();
                $("#sortable").disableSelection();
            });
        </script>
    </body>
</html>
