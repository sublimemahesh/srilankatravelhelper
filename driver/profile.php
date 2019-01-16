<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$DRIVER = new Drivers($_SESSION['id']);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Profile || Driver DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
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
                    <div class="col-md-9 ">
                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                My Profile
                            </div>
                            <div class="panel-body">

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


                                <ul class="list-group">

                                    <li class="list-group-item"><b>Name :</b> <?php echo $DRIVER->name; ?></li>
                                    <li class="list-group-item"><b>Email :</b><?php echo $DRIVER->email; ?></li>
                                    <li class="list-group-item"><b>Address :</b><?php echo $DRIVER->address; ?></li>
                                    <li class="list-group-item"><b>City :</b><span class="cityname"></span></li>
                                    <li class="list-group-item"><b>Contact Number :</b><?php echo $DRIVER->contact_number; ?></li>
                                    <li class="list-group-item"><b>NIC Number :</b><?php echo $DRIVER->nic_number; ?></li>
                                    <li class="list-group-item"><b>Driving Licence Number :</b><?php echo $DRIVER->driving_licence_number; ?></li>
                                    <li class="list-group-item"><b>Date of Birth :</b><?php echo $DRIVER->dob; ?></li>
                                    <li class="list-group-item"><b>Short Description :</b><br /><?php echo $DRIVER->short_description; ?></li>
                                    <li class="list-group-item"><b>Description :</b><br /><?php echo $DRIVER->description; ?></li>
                                    <input type="hidden" id="city" name="city" value="<?php echo $DRIVER->city; ?>" />
                                    <div id="map"></div>
                                </ul> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <ul class="list-group prof-details">
                            <a href="profile.php"><li class="list-group-item active"><div class="pro-icon"><i class="fa fa-user"></i></div><div class="pro-nav">My Profile</div></li></a>
                            <a href="edit-driver.php"><li class="list-group-item"><div class="pro-icon"><i class="fa fa-pencil"></i></div><div class="pro-nav">Edit Profile</div></li></a>
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
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/sign-up.js" type="text/javascript"></script>
        <script src="js/add-driver.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
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
                            $('.cityname').text(place.name);
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
            $(window).load(function () {
                var width = $(window).width();

                if (width > 576) {
                    var contentheight = $(window).height();
                    var navigationheight = $(window).height() - 75;

                    $('.content').css('height', contentheight);
                    $('.navigation').css('height', navigationheight);
                }
            });
        </script>
    </body>
</html>
