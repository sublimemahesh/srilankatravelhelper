<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');



//if (isset($_GET['id'])) {
//    $id = $_GET['id'];
//}


$DESTINATION = new Destination(NULL);
//$DESTINATIONS = $DESTINATION->getDestinationById($id);


//$DESTINATION_TYPE = new DestinationType(NULL);
//$types = $DESTINATION_TYPE->all();
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Add New Destination - srilankatravelhelper</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <link href="plugins/node-waves/waves.css" rel="stylesheet" />

        <link href="plugins/animate-css/animate.css" rel="stylesheet" />

        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

        <link href="css/style.css" rel="stylesheet">

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
                                <h2>Add New Destination</h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-destination.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                      
                            <div class="body">
                                <div class="row clearfix">
                                    <?php
                                    foreach ($DESTINATIONS as $key => $destination) {

                                        if (count($destination) > 0) {
                                            ?>
                                            <div class="col-md-3"  id="div<?php echo $destination['id']; ?>">
                                                <div class="photo-img-container">
                                                    <img src="../upload/destination/thumb/<?php echo $destination['image_name']; ?>" class="img-responsive ">
                                                </div>
                                                <div class="img-caption">
                                                    <p class="maxlinetitle">Name : <?php echo $destination['name']; ?></p>  
                                                                <p class="maxlinetitle">Type : <?php echo $DESTINATION_TYPE->name; ?></p>  
                                                    <div class="d">
                                                        <a href="#"  class="delete-destination" data-id="<?php echo $destination['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn"></button></a>
                                                        <a href="edit-destination.php?id=<?php echo $destination['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a>
                                                        <a href="arrange-destination.php?id=<?php echo $destination['id']; ?>">  <button class="glyphicon glyphicon-random arrange-btn"></button></a>
                                                        <a href="create-destination-photos.php?id=<?php echo $destination['id']; ?>"> <button class="glyphicon glyphicon-picture arrange-btn"></button> </a>
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
        </section>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core Js -->
        <script src="plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Select Plugin Js -->
        <!--<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>-->
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <!-- Slimscroll Plugin Js -->
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="plugins/node-waves/waves.js"></script>

        <!-- Custom Js -->
        <script src="js/admin.js"></script>

        <!-- Demo Js -->
        <script src="js/demo.js"></script>
        <script src="delete/js/destination.js" type="text/javascript"></script>
        <script src="tinymce/js/tinymce/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: "#description",
                // ===========================================
                // INCLUDE THE PLUGIN
                // ===========================================

                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                // ===========================================
                // PUT PLUGIN'S BUTTON on the toolbar
                // ===========================================

                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
                // ===========================================
                // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
                // ===========================================

                relative_urls: false

            });


        </script>
    </body>

</html>