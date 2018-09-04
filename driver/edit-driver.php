<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');

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
                <div class="col-md-9">
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
                    <div class="col-md-9">
                        
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
                                            <img src="../upload/drivers/<?php echo $DRIVER->profile_picture; ?> " alt=""/>
                                            <?php
                                        } else {
                                            ?>
                                            <img src="../upload/drivers/driver.png" alt=""/>
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
                                        <input type="hidden" name="id" value="<?php echo $DRIVER->id; ?>" />
                                        <input type="hidden" name="oldImageName" value="<?php echo $DRIVER->profile_picture; ?>" />
                                        <input type="submit" name="update" id="update" class="btn btn-lg btn-green" value="Save Data" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
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
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/sign-up.js" type="text/javascript"></script>
        <script src="js/add-driver.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                var message = $('#msg').val();
                var msgid = $('#msg').attr('msgid');

                if (message.length > 35) {
                    $('.error-msg1').removeClass('hidden');
                    $('.login-box').addClass('login-box4');

                } else {
                    $('.error-msg').removeClass('hidden');
                    $('.login-box').addClass('login-box4');
                }

                if (msgid == 15) {
                    $('#signin-form').removeClass('hidden');
                    $('#signup-form').addClass('hidden');
                    $('.login-box').addClass('login-box5');
                    $('.login-box').removeClass('login-box4');
                    $('.login-link1').removeClass('hidden');
                    $('.login-link').addClass('hidden');

                    $('#sign-up').click(function () {
                        $('.login-box').addClass('login-box4');
                        $('.login-box').removeClass('login-box5');
                    });
                }
            });

            $(window).load(function () {
                var contentheight = $(window).height();
                var navigationheight = $(window).height() - 75;

                $('.content').css('height', contentheight);
                $('.navigation').css('height', navigationheight);
            });
        </script>
    </body>
</html>
