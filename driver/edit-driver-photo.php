<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$DRIVER = new Drivers($_SESSION['id']);
$id = '';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}
$DRIVERPHOTO = new DriverPhotos($id);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Driver Photo || Driver DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
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
                                Edit Driver Photo
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
                                    <div class="row form-data">
                                        <label>Caption</label>
                                        <input type="text" name="caption" id="caption" class="form-control" placeholder="Enter Caption" value="<?php echo $DRIVERPHOTO->caption;  ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Image</label>
                                        <input type="file" name="image" id="image" />
                                        <img src="../upload/driver/driver-photos/thumb1/<?php echo $DRIVERPHOTO->image_name; ?>" class="img-responsive img-thumbnail">
                                    </div>
                                    <div class="row form-data">
                                        <input type="hidden" name="id" value="<?php echo $DRIVERPHOTO->id; ?>" />
                                        <input type="hidden" name="oldImageName" value="<?php echo $DRIVERPHOTO->image_name; ?>" />
                                        <input type="submit" name="edit-photo" id="update" class="btn btn-green" value="Save Changes" />
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
