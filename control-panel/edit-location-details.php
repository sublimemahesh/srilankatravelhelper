<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$LOCATIONDETAILS = new LocationDetails($id);
$RELATEDLOCATION = new Location($LOCATIONDETAILS->related_location);
$LOCATION = new Location($LOCATIONDETAILS->location);

?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit Location Details - Tour Sri Lanka</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <!-- JQuery DataTable Css -->
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
                                    <h2>Edit Location Details</h2>

                                    <ul class="header-dropdown">
                                        <li class="">
                                            <a href="create-location-details.php?id=<?php echo $LOCATIONDETAILS->related_location; ?>">
                                                <i class="material-icons">list</i> 
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-xs-12 label1 ">
                                            <label for="name">
                                                
                                                <h4><?php echo $RELATEDLOCATION->name . ' to ' . $LOCATION->name; ?></h4>
                                            </label>
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
                                                            <input type="text" id="bus_distance" class="form-control" placeholder="Distance" autocomplete="off" name="bus_distance" required="TRUE" value="<?php echo $LOCATIONDETAILS->bus_distance; ?>"> 
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
                                                            <input type="text" id="bus_hour" class="form-control" placeholder="Hours" autocomplete="off" name="bus_hour" required="TRUE"  value="<?php echo $LOCATIONDETAILS->bus_hour; ?>">
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
                                                            <input type="text" id="train_distance" class="form-control" placeholder="Distance" autocomplete="off" name="train_distance" required="TRUE"  value="<?php echo $LOCATIONDETAILS->train_distance; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 form-control-label-2">
                                                    <label for="name">Travel Hours (h)</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="train_hour" class="form-control" placeholder="Hours" autocomplete="off" name="train_hour" required="TRUE"  value="<?php echo $LOCATIONDETAILS->train_hour; ?>">
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
                                                            <input type="text" id="taxi_distance" class="form-control" placeholder="Distance" autocomplete="off" name="taxi_distance" required="TRUE" value="<?php echo $LOCATIONDETAILS->taxi_distance; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 form-control-label-2">
                                                    <label for="name">Travel Hours (h)</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="taxi_hour" class="form-control" placeholder="Hours" autocomplete="off" name="taxi_hour" required="TRUE" value="<?php echo $LOCATIONDETAILS->taxi_hour; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5"> 
                                            <input type="hidden" name="id"  value="<?php echo $id; ?>"/>                       
                                            <input type="submit" name="edit" class="btn btn-primary m-t-15 waves-effect" value="Edit Location Details"/>
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
        <script src="delete/js/tour-package.js" type="text/javascript"></script>
    </body>
</html>