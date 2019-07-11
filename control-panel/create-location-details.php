<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$LOCATION = new Location($id);
$locations = $LOCATION->getLocationsExceptThisLocation($id);
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Add Location Details - Tour Sri Lanka</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <!-- JQuery DataTable Css -->
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
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
                            <form class="form-horizontal"  method="post" action="post-and-get/location-details.php" enctype="multipart/form-data"> 
                                <div class="header">
                                    <h2>Add Location Details</h2>

                                    <ul class="header-dropdown">
                                        <li class="">
                                            <a href="manage-locations.php">
                                                <i class="material-icons">list</i> 
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label label1 ">
                                            <label for="name">
                                                <h4><?php echo $LOCATION->name; ?></h4>
                                            </label>
                                            <label for="name">to</label>
                                        </div>


                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7 form-line">
                                            <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="type" name="type" required="TRUE">

                                                <option value=""> -- Please Select -- </option>
                                                <?php foreach ($locations as $location) {
                                                    ?>
                                                    <option value="<?php echo $location['id']; ?>" <?php
                                                    if ($LOCATION->name === $location['id']) {
                                                        echo 'selected';
                                                    }
                                                    ?>>
                                                                <?php echo $location['name']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <div class="panel panel-default loc-panel">
                                            <div class="panel-body locationData text-left">
                                                <h4>Bus</h4>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-xs-6 form-control-label-2">
                                                    <label for="name">Distance (km)</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="bus_distance" class="form-control" placeholder="Distance" autocomplete="off" name="bus_distance" required="TRUE"> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 

                                            <div class="row clearfix">
                                                <div class="col-xs-6 form-control-label-2">
                                                    <label for="name">Travel Hours (h)</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="bus_hour" class="form-control" placeholder="Hours" autocomplete="off" name="bus_hour" required="TRUE">
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div> 
                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <div class="panel panel-default loc-panel">
                                            <div class="panel-body locationData text-left">
                                                <h4>Train</h4>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-xs-6 form-control-label-2">
                                                    <label for="name">Distance (km)</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="train_distance" class="form-control" placeholder="Distance" autocomplete="off" name="train_distance" required="TRUE">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 form-control-label-2">
                                                    <label for="name">Travel Hours (h)</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="train_hour" class="form-control" placeholder="Hours" autocomplete="off" name="train_hour" required="TRUE">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <div class="panel panel-default loc-panel">
                                            <div class="panel-body locationData text-left">
                                                <h4>Taxi</h4>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-xs-6 form-control-label-2">
                                                    <label for="name">Distance (km)</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="taxi_distance" class="form-control" placeholder="Distance" autocomplete="off" name="taxi_distance" required="TRUE">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 form-control-label-2">
                                                    <label for="name">Travel Hours (h)</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="taxi_hour" class="form-control" placeholder="Hours" autocomplete="off" name="taxi_hour" required="TRUE">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5"> 
                                            <!--<input type="hidden" name="id"  value="<?php echo $id; ?>"/>-->
                                            <input type="hidden" name="loc" id="loc" value="<?php echo $LOCATION->id; ?>"/>                        
                                            <input type="submit" name="create" class="btn btn-primary m-t-15 waves-effect" value="Add Location Details"/>
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <section class="content content1">
            <div class="container-fluid">
                <?php
                $vali = new Validator();

                $vali->show_message();
                ?>
                <!-- Manage tour -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Manage Location Details
                                </h2>
                            </div>
                            <div class="body">
                                <!-- <div class="table-responsive">-->
                                <div>
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>location</th>
                                                <th>Bus Distance</th>
                                                <th>Train Distance</th>
                                                <th>Taxi Distance</th>
                                                <th>Bus Hour</th>
                                                <th>Train Hour</th>
                                                <th>Taxi Hour</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (LocationDetails::getLocationsByRelatedLocation($id) as $key => $details) {
                                                $LOC = new Location($details['location']);
                                                $key++;
                                                ?>
                                                <tr id="row_<?php echo $details['id']; ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo $LOC->name; ?></td>
                                                    <td class="text-right"><?php echo $details['bus_distance'] . 'km'; ?></td>
                                                    <td class="text-right"><?php echo $details['train_distance'] . 'km'; ?></td>
                                                    <td class="text-right"><?php echo $details['taxi_distance'] . 'km'; ?></td>
                                                    <td class="text-right"><?php echo $details['bus_hour'] . 'h'; ?></td>
                                                    <td class="text-right"><?php echo $details['train_hour'] . 'h'; ?></td>
                                                    <td class="text-right"><?php echo $details['taxi_hour'] . 'h'; ?></td>
                                                    <td class="text-center"> 
                                                        <a href="edit-location-details.php?id=<?php echo $details['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a>
                                                        |
                                                        <a href="#" >
                                                            <button class="glyphicon glyphicon-trash delete-btn delete-location-details" data-id="<?php echo $details['id']; ?>"></button>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>location</th>
                                                <th>Bus Distance</th>
                                                <th>Train Distance</th>
                                                <th>Taxi Distance</th>
                                                <th>Bus Hour</th>
                                                <th>Train Hour</th>
                                                <th>Taxi Hour</th>
                                                <th>Options</th>
                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Manage District -->
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
        <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>
        <!-- Custom Js -->
        <script src="js/admin.js"></script>
        <!-- Demo Js -->
        <script src="js/demo.js"></script>
        <script src="delete/js/location-details.js" type="text/javascript"></script>
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