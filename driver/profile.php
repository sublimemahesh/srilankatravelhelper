<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$DRIVER = new Drivers($_SESSION['id']);
$CITY = new City($DRIVER->city);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile || Driver DashBoard</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
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
                                My Profile
                            </div>
                            <div class="panel-body">

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


                                <ul class="list-group">

                                    <li class="list-group-item"><b>Name :</b> <?php echo $DRIVER->name; ?></li>
                                    <li class="list-group-item"><b>Email :</b><?php echo $DRIVER->email; ?></li>
                                    <li class="list-group-item"><b>Address :</b><?php echo $DRIVER->address; ?></li>
                                    <li class="list-group-item"><b>City :</b><?php echo $CITY->name; ?></li>
                                    <li class="list-group-item"><b>Contact Number :</b><?php echo $DRIVER->contact_number; ?></li>
                                    <li class="list-group-item"><b>NIC Number :</b><?php echo $DRIVER->nic_number; ?></li>
                                    <li class="list-group-item"><b>Driving Licence Number :</b><?php echo $DRIVER->driving_licence_number; ?></li>
                                    <li class="list-group-item"><b>Date of Birth :</b><?php echo $DRIVER->dob; ?></li>
                                    <li class="list-group-item"><b>Short Description :</b><br /><?php echo $DRIVER->short_description; ?></li>
                                    <li class="list-group-item"><b>Description :</b><br /><?php echo $DRIVER->description; ?></li>
                                </ul> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
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
