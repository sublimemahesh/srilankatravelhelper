<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$DESTINATION = new Destination($id);
$DESTINATION_PHOTOS_OBJ = new DestinationPhotos(NULL);
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Add New Destination Photos - srilankatravelhelper</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <!-- Bootstrap Core Css -->
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Waves Effect Css -->
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <!-- Animation Css -->
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <!-- Sweet Alert Css -->
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <!-- Custom Css -->
        <link href="css/style.css" rel="stylesheet">
        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?> 
        <section class="content">
            <div class="container-fluid"> 
                <?php
                $vali = new Validator();

                $vali->show_message();
                ?>
                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Add New Destination Photos</h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="view-destination.php?id=<?php echo $DESTINATION->type; ?>">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal"  method="post" action="post-and-get/destination-photos.php" enctype="multipart/form-data"> 
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="caption">Caption</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="caption" class="form-control" placeholder="Enter Tour Type" autocomplete="off" name="caption" required="TRUE">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="picture_name">Picture</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="file" id="picture_name" class="form-control" name="picture_name"  required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5"> 
                                            <input type="hidden" name="destination"  value="<?php echo $id; ?>"/>
                                            <input type="submit" name="add-tour-type" class="btn btn-primary m-t-15 waves-effect" value="Add destination photo"/>
                                        </div>
                                    </div>
                                    <hr/>
                                </form>
                                <div class="row clearfix">
                                    <?php
                                    $DESTINATION_PHOTOS = $DESTINATION_PHOTOS_OBJ->getDestinationPhotosById($id);
                                 
                                    foreach ($DESTINATION_PHOTOS as $key => $destination_photos) {

                                        if (count($destination_photos) > 0) {
                                            ?>
                                            <div class="col-md-3"  id="div<?php echo $destination_photos['id']; ?>">
                                                <div class="photo-img-container">
                                                    <img src="../upload/destination-photos/thumb/<?php echo $destination_photos['image_name']; ?>" class="img-responsive ">
                                                </div>
                                                <div class="img-caption">
                                                    <div class="d">
                                                      
                                                        <a href="#"  class="delete-destination-photos" data-id="<?php echo $destination_photos['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn delete-destination-photos"></button></a>
                                                        <a href="edit-destination-photos.php?id=<?php echo $destination_photos['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a>
                                                        <a href="arrange-destination-photos.php?id=<?php echo $id; ?>">  <button class="glyphicon glyphicon-random arrange-btn"></button></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            ?> 
                                            <b style="padding-left: 15px;">No packages in the database.</b> 
                                            <?php
                                        }
                                    }
                                    ?> 

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- #END# Vertical Layout -->


            </div>
        </section>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core Js -->
        <script src="plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Select Plugin Js -->
        <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

        <!-- Slimscroll Plugin Js -->
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="plugins/node-waves/waves.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <!-- Custom Js -->
        <script src="js/admin.js"></script>

        <!-- Demo Js -->
        <script src="js/demo.js"></script>
        <script src="delete/js/destination-photos.js" type="text/javascript"></script>
    </body>

</html>