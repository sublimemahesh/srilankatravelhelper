﻿<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$DRIVER = new Driver($id);

$DRIVER_TYPE = new DestinationType(NULL);
$types = $DRIVER_TYPE->all();
?> 

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Manage Driver - Tour Sri Lanka</title>
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
                                <h2>
                                    Manage Destination
                                </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-driver.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal" method="post" action="post-and-get/driver.php" enctype="multipart/form-data"> 
<!--                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="tourtype">Driver</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group place-select">
                                                <div class="form-line">
                                                    <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="type" name="type" required="TRUE">
                                                        <option value=""> -- Please Select -- </option>
                                                        <?php foreach ($types as $type) {
                                                            
                                                            ?>
                                                            <option value="<?php echo $type['id']; ?>" <?php
                                                            if ($DRIVER->type === $type['id']) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                        <?php echo $type['name']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Title</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="name" class="form-control"  value="<?php echo $DRIVER->name; ?>"  name="name"  required="TRUE">

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="picture_name">Profile</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">                                                                        
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="image" class="form-control" value="<?php echo $DRIVER->image_name; ?>"  name="image_name">
                                                    <img src="../upload/driver/thumb/<?php echo $DRIVER->image_name; ?>" id="picture_name" class="view-edit-img img img-responsive img-thumbnail" name="image_name" alt="old image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="picture_name">Cover Photo</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">                                                                        
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="image" class="form-control" value="<?php echo $DRIVER->banner_image; ?>"  name="banner_image">
                                                    <img src="../upload/banner-image/thumb/<?php echo $DRIVER->banner_image; ?>" id="picture_name" class="view-edit-img img img-responsive img-thumbnail" name="banner_image" alt="old image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="description">Short Description</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <input type="text" class="form-control" placeholder="Please enter short description" autocomplete="off" name="short_description" value="<?php echo $DRIVER->short_description; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="description">Description</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea id="description" name="description" class="form-control" rows="5"><?php echo $DRIVER->description ?></textarea> 
                                                    <input type="hidden" value="1" name="active" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-8 col-md-offset-2">
                                        <input type="hidden" id="oldImageName" value="<?php echo $DRIVER->image_name; ?>" name="oldImageName"/>
                                        <input type="hidden" id="id" value="<?php echo $DRIVER->id; ?>" name="id"/>
<!--                                            <input type="hidden" id="authToken" value="<?php echo $_SESSION["authToken"]; ?>" name="authToken"/>-->
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect center-block" name="update" value="update">Save Changes</button>
                                    </div>
                                    <div class="row clearfix">  </div>
                                    <hr/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Vertical Layout -->
            </div>
        </section>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script> 
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script>
        <script src="js/add-new-ad.js" type="text/javascript"></script>
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