<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$VISITOR = new visitor($_SESSION['id']);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Password || Visitor DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive_visitor.css" rel="stylesheet" type="text/css"/>
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


                <div class="col-md-9 col-sm-3">
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
                                Change Password
                            </div>
                            <div class="panel-body">
                                <form method="post" action="post-and-get/change-password.php">
                                    <div class="row form-data">
                                        <label>Current Password</label>
                                        <input type="password" name="currentpw" class="form-control" placeholder="Current Password"  value="" required="TRUE">
                                    </div>
                                    <div class="row form-data">
                                        <label>New Password</label>
                                        <input type="password" name="newpw" class="form-control" placeholder="New Password"  value="" required="TRUE">
                                    </div>
                                    <div class="row form-data">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirmpw" class="form-control" placeholder="Confirm Password"  value="" required="TRUE">
                                    </div>
                                    <div class="row form-data">
                                        <input type="hidden" name="id" value="<?php echo $VISITOR->id; ?>" />
                                        <input type="submit" name="changepassword" id="changepassword" class="btn btn-lg btn-green" value="Change Password" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <ul class="list-group prof-details">
                            <a href="profile.php"><li class="list-group-item"><div class="pro-icon"><i class="fa fa-user"></i></div><div class="pro-nav">My Profile</div></li></a>
                            <a href="edit-visitor.php"><li class="list-group-item"><div class="pro-icon"><i class="fa fa-pencil"></i></div><div class="pro-nav">Edit Profile</div></li></a>
                            <a href="change-password.php"><li class="list-group-item active"><div class="pro-icon"><i class="fa fa-key"></i></div><div class="pro-nav">Change Password</div></li></a>
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
        <script src="js/custom.js" type="text/javascript"></script>
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
                    var contentheight = $(window).height() + 100;
                    var navigationheight = $(window).height() + 25;

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
