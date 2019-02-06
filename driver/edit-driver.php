<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $DRIVER = new Drivers($id);
} else {
    $DRIVER = new Drivers($_SESSION['id']);
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Edit <?php
            if (isset($_GET['id'])) {
                echo 'Driver';
            } else {
                echo 'Profile';
            };
            ?>  || Driver DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
                    <div class="col-md-9 col-sm-9">

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Edit <?php
                                if (isset($_GET['id'])) {
                                    echo 'Driver';
                                } else {
                                    echo 'Profile';
                                };
                                ?>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="post-and-get/driver.php"  enctype="multipart/form-data">
                                    <div class="prof-img">
                                        <?php
                                        if (empty($DRIVER->profile_picture)) {
                                            ?>
                                            <img src="../upload/driver/driver.png" alt="Profile Picture"/>
                                            <?php
                                        } else {
                                            if ($DRIVER->facebookID && substr($DRIVER->profile_picture, 0, 5) === "https") {
                                                ?>
                                                <img src="<?php echo $DRIVER->profile_picture; ?>"  alt="Profile Picture"/>
                                                <?php
                                            } else {
                                                ?>
                                                <img src="../upload/driver/<?php echo $DRIVER->profile_picture; ?>"  alt="Profile Picture"/>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <input type="file" name="image" id="image" />


                                    <div class="row form-data">
                                        <label>Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="<?php echo $DRIVER->name; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" value="<?php echo $DRIVER->email; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Address</label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" value="<?php echo $DRIVER->address; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>City</label>
                                        <input type="text" id="autocomplete" class="form-control" placeholder="Enter city" onFocus="geolocate()" name="autocomplete" required="TRUE">
                                        <input type="hidden" name="cityid" id="city"  value="<?php echo $DRIVER->city; ?>"/>
                                        <input type="hidden" name="cityname" id="cityname"  value="<?php echo $DRIVER->cityname; ?>"/>
<!--                                        <input type="text" name="cityid" id="cityid" onkeyup="myFunction()" class="form-control" placeholder="Enter City" value="<?php echo $CITY->name; ?>" />
                            <input type="hidden" id="cityid" name="cityid" value="<?php echo $DRIVER->city; ?>" />-->

                                    </div>
                                    <div class="row form-data">
                                        <label>Contact Number</label>
                                        <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Enter Contact Number" value="<?php echo $DRIVER->contact_number; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>NIC Number</label>
                                        <input type="text" name="nic_number" id="nic_number" class="form-control" placeholder="Enter NIC Number" value="<?php echo $DRIVER->nic_number; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Driving Licence Number</label>
                                        <input type="text" name="driving_licence_number" id="driving_licence_number" class="form-control" placeholder="Enter Driving Licence Number" value="<?php echo $DRIVER->driving_licence_number; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Date of Birth</label>
                                        <input type="text" name="dob" id="dob" class="form-control" placeholder="Enter Date of Birth" value="<?php echo $DRIVER->dob; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Short Description</label>
                                        <input type="text" name="short_description" id="short_description" class="form-control" placeholder="Enter Short Description" value="<?php echo $DRIVER->short_description; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="5"><?php echo $DRIVER->description ?></textarea>
                                    </div>
                                    <div class="row form-data">
                                        <input type="hidden" name="id" value="<?php echo $DRIVER->id; ?>" />
                                        <input type="hidden" name="oldImageName" value="<?php echo $DRIVER->profile_picture; ?>" />
                                        <input type="submit" name="update" id="update" class="btn btn-lg btn-green" value="Save Data" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="map"></div>
                    <div class="col-md-3 col-sm-3">
                        <ul class="list-group prof-details">
                            <a href="profile.php"><li class="list-group-item"><div class="pro-icon"><i class="fa fa-user"></i></div><div class="pro-nav">My Profile</div></li></a>
                            <a href="edit-driver.php"><li class="list-group-item active"><div class="pro-icon"><i class="fa fa-pencil"></i></div><div class="pro-nav">Edit Profile</div></li></a>
                            <a href="change-password.php"><li class="list-group-item"><div class="pro-icon"><i class="fa fa-key"></i></div><div class="pro-nav">Change Password</div></li></a>
                            <a href="post-and-get/logout.php"><li class="list-group-item"><div class="pro-icon"><i class="fa fa-lock"></i></div><div class="pro-nav">Sign Out</div></li></a>
                        </ul> 
                    </div>

                </div>

            </div>
            <?php
            include './footer.php';
            ?>
        </div>

        <script src="js/jquery_2.2.4.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/sign-up.js" type="text/javascript"></script>
        <script src="js/add-driver.js" type="text/javascript"></script>
        <script src="plugins/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
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
                var options = {
                    types: ['(cities)'],
                    componentRestrictions: {country: "lk"}
                };
                var input = document.getElementById('autocomplete');

                autocomplete = new google.maps.places.Autocomplete(input, options);

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

        <script>
            $(function () {
                $("#dob").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-m-d'
                });
            });
            $(window).load(function () {
                var width = $(window).width();

                if (width > 576) {
                    var contentheight = $(window).height();
                    var navigationheight = $(window).height() - 75;

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
