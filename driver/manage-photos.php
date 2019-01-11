<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$DRIVER = new Drivers($_SESSION['id']);
$DRIVERPHOTOS = DriverPhotos::getDriverPhotosByDriver($DRIVER->id);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Manage Photos || Driver DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
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

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Add New Photo
                            </div>
                            <div class="panel-body">
                                <form method="post" action="post-and-get/driver-photos.php" enctype="multipart/form-data">
                                    <div class="row form-data">
                                        <label>Caption</label>
                                        <input type="text" name="caption" id="caption" class="form-control" placeholder="Enter Caption" value="" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Image</label>
                                        <input type="file" name="image" id="image" />
                                    </div>
                                    <div class="row form-data">
                                        <input type="hidden" name="driver" value="<?php echo $DRIVER->id; ?>" />
                                        <input type="submit" name="create-photo" id="update" class="btn btn-green" value="Save Photo" />
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Manage Photos
                            </div>
                            <div class="panel-body">

                                <?php
                                foreach ($DRIVERPHOTOS as $photo) {
                                    ?>
                                    <div class="col-md-3 col-sm-4" id="div<?php echo $photo['id']; ?>">
                                        <div class="photo-img-container">
                                            <img src="../upload/driver/driver-photos/thumb1/<?php echo $photo['image_name']; ?>" class="img-responsive ">
                                        </div>
                                        <div class="img-caption">
                                            <p class="maxlinetitle"><?php echo $photo['caption']; ?></p>
                                            <div class="d">
                                                <a href="#" class="delete-driver-photo" data-id="<?php echo $photo['id']; ?>"> <button class="fa fa-trash delete-btn"></button></a>
                                                <a href="edit-driver-photo.php?id=<?php echo $photo['id']; ?>"> <button class="fa fa-pencil edit-btn"></button></a>
                                                <a href="arrange-driver-photos.php?id=<?php echo $DRIVER->id; ?>">  <button class="fa fa-random arrange-btn"></button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
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
        <script src="delete/js/driver-photo.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
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
        </script>
    </body>
</html>