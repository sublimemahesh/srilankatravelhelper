﻿<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$DESTINATION_PHOTOS = new DestinationPhotos(NULL);
$destinations = NULL;
$destinations = $DESTINATION_PHOTOS->all();

?>
﻿<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Manage Tour Package - www.srilankatourism.travel</title>
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

        <!-- JQuery DataTable Css -->
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
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
                <!-- Manage Tour Package -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Manage Destination
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href="manage-destination-photos.php">
                                            <i class="material-icons">add</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <!--                                <div class="table-responsive">-->
                                <div>
                                    <div class="row clearfix">
                                        <?php
                                        foreach ($destinations as $key => $destination) {
                                            $DESTINATION_PHOTOS = new DestinationPhotos($destination['destination']);
                                            if (count($destination) > 0) {
                                                ?>
                                                <div class="col-md-3"  id="div<?php echo $destination['id']; ?>">
                                                    <div class="photo-img-container">
                                                        <img src="../upload/destination-photos/<?php echo $destination['image_name']; ?>" class="img-responsive ">
                                                    </div>
                                                    <div class="img-caption">
<!--                                                        <p class="maxlinetitle">Name : <?php echo $destination['name']; ?></p>  
                                                        <p class="maxlinetitle">Type : <?php echo $DESTINATION_PHOTOS->name; ?></p>  -->
                                                        <div class="d">
                                                            <a href="#"  class="delete-destination-photos" data-id="<?php echo $destination['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn"></button></a>
                                                            <a href="edit-destination.php?id=<?php echo $destination['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a>
                                                            <a href="view-tour-sub-section.php?id=<?php echo $destination['id']; ?>">  <button class="glyphicon glyphicon-random arrange-btn"></button></a>
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
                </div>
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

        <!-- Jquery DataTable Plugin Js -->
        <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <!-- Custom Js -->
        <script src="js/admin.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>

        <!-- Demo Js -->
        <script src="js/demo.js"></script>
        <script src="delete/js/destination-photos.js" type="text/javascript"></script>
    </body>

</html> 