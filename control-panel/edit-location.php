<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$LOCATION = new Location($id);

?> 

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit Location - Tour Sri Lanka</title>
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
                                    Edit Location
                                </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-locations.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal" method="post" action="post-and-get/location.php" enctype="multipart/form-data"> 
                                    
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Name</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="name" class="form-control"  value="<?php echo $LOCATION->name; ?>"  name="name"  required="TRUE" readonly="readonly">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="placeid">Place ID</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                   <input type="text" id="placeid" class="form-control"  value="<?php echo $LOCATION->placeid; ?>"  name="placeid"  required="TRUE" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="picture_name">Image</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">                                                                        
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="image" class="form-control" value="<?php echo $LOCATION->imagename; ?>"  name="picture_name">
                                                    <img src="../upload/location/<?php echo $LOCATION->imagename; ?>" id="picture_name" class="view-edit-img img img-responsive img-thumbnail" name="picture_name" alt="old image">
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
                                                    <input type="text" class="form-control" placeholder="Please enter short description" autocomplete="off" name="short_description" value="<?php echo $LOCATION->shortdescription; ?>">
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
                                                    <textarea id="description" name="description" class="form-control" rows="5"><?php echo $LOCATION->description ?></textarea> 
                                                    <input type="hidden" value="1" name="active" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="description">Add Near By Cities</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <?php
                                                foreach (Location::getLocationsExceptThisLocation($LOCATION->id) as $location) {
                                                    ?>
                                                    <div class="form-group">
                                                        <ul>
                                                            <li>
                                                                <label class="container1 label-align"><?php echo $location['name']; ?>
                                                                    <input class="" type="checkbox" name="nearbycities[]" value="<?php echo $location['id']; ?>" id="location-<?php echo $location['id']; ?>" />
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="map"></div>
                                    <div class="col-md-8 col-md-offset-2">
                                        <input type="hidden" id="oldImageName" value="<?php echo $LOCATION->imagename; ?>" name="oldImageName"/>
                                        <input type="hidden" id="id" value="<?php echo $LOCATION->id; ?>" name="id"/>
                                        <button type="submit" id="submit" class="btn btn-primary m-t-15 waves-effect center-block" name="update" value="update">Save Changes</button>
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
        <script src="js/near-by-cities.js" type="text/javascript"></script>
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