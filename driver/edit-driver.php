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
$CITY = new City($DRIVER->city);


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit <?php
            if (isset($_GET['id'])) {
                echo 'Driver';
            } else {
                echo 'Profile';
            };
            ?>  || Driver DashBoard</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
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
                <div class="col-md-9 col-sm-9">
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
                                        if ($DRIVER->profile_picture) {
                                            ?>
                                            <img src="../upload/driver/<?php echo $DRIVER->profile_picture; ?> " alt=""/>
                                            <?php
                                        } else {
                                            ?>
                                            <img src="../upload/driver/driver.png" alt=""/>
                                            <?php
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
                                        <input type="text" name="city" id="city" onkeyup="myFunction()" class="form-control" placeholder="Enter City" value="<?php echo $CITY->name; ?>" />
                                        <input type="hidden" id="cityid" name="cityid" value="<?php echo $DRIVER->city; ?>" />
                                        <ul id="myUL" class="hidden">
                                            <?php
                                            foreach (City::all() as $city) {
                                                ?>
                                                <li class="cityli" cityid="<?php echo $city['id']; ?>"><a href="#"><?php echo $city['name']; ?></a></li>
                                                <?php
                                            }
                                            ?>

                                        </ul>
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
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/sign-up.js" type="text/javascript"></script>
        <script src="js/add-driver.js" type="text/javascript"></script>
        <script src="plugins/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
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

            function myFunction() {

                $('#myUL').removeClass('hidden');

                var input, filter, ul, li, a, i;
                input = document.getElementById("city");
                filter = input.value.toUpperCase();
                ul = document.getElementById("myUL");
                li = ul.getElementsByTagName("li");
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("a")[0];
                    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }
            $('.cityli').click(function () {
                var name = $(this).text();
                var id = $(this).attr('cityid');
                $('#city').val(name);
                $('#cityid').val(id);
                $('#myUL').addClass('hidden');

            });
        </script>
    </body>
</html>
