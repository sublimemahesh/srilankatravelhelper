<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$DRIVER = new Drivers($id);
?> 

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>View Driver - Tours Sri Lanka</title>
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
                                    View Driver
                                </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-drivers.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body"> 
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="name" class="form-control"  value="<?php echo $DRIVER->name; ?>"  name="name"  required="TRUE" readonly="">
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
                                                
                                                <?php
                                                if (empty($DRIVER->profile_picture)) {
                                                    ?>
                                                    <img src="../upload/driver/driver.png" id="picture_name" class="view-edit-img img img-responsive img-thumbnail" name="image_name" alt="old image"/>
                                                    <?php
                                                } else {
                                                    if ($DRIVER->facebookID && substr($DRIVER->profile_picture, 0, 5) === "https") {
                                                        ?>
                                                        <img src="<?php echo $DRIVER->profile_picture; ?>"  id="picture_name" class="view-edit-img img img-responsive img-thumbnail" name="image_name" alt="old image"/>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img src="../upload/driver/<?php echo $DRIVER->profile_picture; ?>"  id="picture_name" class="view-edit-img img img-responsive img-thumbnail" name="image_name" alt="old image"/>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <input type="text" class="form-control" placeholder="Please enter email" autocomplete="off" name="email" value="<?php echo $DRIVER->email; ?>" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="address">Address</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <input type="text" class="form-control" placeholder="Please enter address" autocomplete="off" name="address" value="<?php echo $DRIVER->address; ?>" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="address">City</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <!--<input type="text" class="form-control" placeholder="Please enter city" autocomplete="off" name="address" value="<?php echo $CITY->name; ?>" readonly="">-->
                                                <input type="text" id="autocomplete" class="form-control" placeholder="Enter city" onFocus="geolocate()" name="autocomplete" required="TRUE">
                                                <input type="hidden" name="cityid" id="city"  value="<?php echo $DRIVER->city; ?>"/>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="contact_number">Contact Number</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <input type="text" class="form-control" placeholder="Please enter contact number" autocomplete="off" name="contact_number" value="<?php echo $DRIVER->contact_number; ?>" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="nic">NIC Number</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <input type="text" class="form-control" placeholder="Please enter nic number" autocomplete="off" name="nic" value="<?php echo $DRIVER->nic_number; ?>" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="driving_licence">Driving Licence Number</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <input type="text" class="form-control" placeholder="Please enter driving licence number" autocomplete="off" name="driving_licence" value="<?php echo $DRIVER->driving_licence_number; ?>" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="dob">Date of Birth</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <input type="text" class="form-control" placeholder="Please enter date of birth" autocomplete="off" name="dob" value="<?php echo $DRIVER->dob; ?>" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="short_description">Short Description</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> 
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <input type="text" class="form-control" placeholder="Please enter short description" autocomplete="off" name="short_description" value="<?php echo $DRIVER->short_description; ?>" readonly="">
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
                                                <textarea class="form-control" name="description" id="description" disabled=""><?php echo $DRIVER->description; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-md-offset-2">
                                    <a href="manage-drivers.php" ><button type="button" class="btn btn-primary m-t-15 waves-effect center-block" name="back" value="update">Back</button></a>

                                </div>
                                <div class="row clearfix">  </div>
                                <div id="map"></div>
                                <hr/>

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
        <script>
            //Google Location Autocomplete
            var placeSearch, autocomplete;

            function initAutocomplete() {
                // Create the autocomplete object, restricting the search to geographical
                // location types.
                autocomplete = new google.maps.places.Autocomplete(
                        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                        {types: ['geocode']});

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                autocomplete.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();
                $('#city').val(place.place_id);
                $('#cityname').val(place.name);
//                $('#longitude').val(place.geometry.location.lng());
//                $('#latitude').val(place.geometry.location.lat());
                for (var component in componentForm) {
                    document.getElementById(component).value = '';
                    document.getElementById(component).disabled = false;
                }

                // Get each component of the address from the place details
                // and fill the corresponding field on the form.
            }

            // Bias the autocomplete object to the user's geographical location,
            // as supplied by the browser's 'navigator.geolocation' object.
            function geolocate() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        var circle = new google.maps.Circle({
                            center: geolocation,
                            radius: position.coords.accuracy
                        });
                        autocomplete.setBounds(circle.getBounds());
                    });
                }
            }
        </script>
        <script>
            // Retrieve Details from Place_ID
            function initMap() {
                setTimeout(function () {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: -33.866, lng: 151.196},
                        zoom: 15
                    });

                    var infowindow = new google.maps.InfoWindow();
                    var service = new google.maps.places.PlacesService(map);
                    var place_id = $('#city').val();
                    service.getDetails({
                        placeId: place_id
                    }, function (place, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
//                        alert(place.name);
                            $('#autocomplete').val(place.name);
                        }
                    });
                }, 1000);
            }

            $(document).ready(function () {
                initMap();
            });


        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhjErF0IZ1O5pUQsSag23YgmvAo4OLngM&libraries=places&callback=initAutocomplete"
        async defer></script>

    </body>

</html>