<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$VISITOR = new Visitor($_SESSION["id"]);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile || Visitor DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive_visitor.css" rel="stylesheet" type="text/css"/>
        <link href="css/header.css" rel="stylesheet" type="text/css"/>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="../css/colors/main.css" rel="stylesheet" type="text/css"/>
        <link href="../css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        
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
                                    if (empty($VISITOR->profile_picture)) {
                                        ?>
                                        <img src="../upload/visitor/visitor.png" alt="Profile Picture"/>
                                        <?php
                                    } else {
                                        if ($VISITOR->facebookID && substr($VISITOR->profile_picture, 0, 5) === "https") {
                                            ?>
                                            <img src="<?php echo $VISITOR->profile_picture; ?>"  alt="Profile Picture"/>
                                            <?php
                                        } else {
                                            ?>
                                            <img src="../upload/visitor/<?php echo $VISITOR->profile_picture; ?>"  alt="Profile Picture"/>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>


                                <ul class="list-group">

                                    <li class="list-group-item">Name : <?php echo $VISITOR->name; ?></li>
                                    <li class="list-group-item">Email :<?php echo $VISITOR->email; ?></li>
                                    <li class="list-group-item">Address :<?php echo $VISITOR->address; ?></li>
                                    <li class="list-group-item">Contact Number :<?php echo $VISITOR->contact_number; ?></li>
                                </ul> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <ul class="list-group prof-details">
                            <a href="profile.php"><li class="list-group-item active"><div class="pro-icon"><i class="fa fa-user"></i></div><div class="pro-nav">My Profile</div></li></a>
                            <a href="edit-visitor.php"><li class="list-group-item"><div class="pro-icon"><i class="fa fa-pencil"></i></div><div class="pro-nav">Edit Profile</div></li></a>
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
        <script src="js/add-visitor.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
        <script>
            $(window).load(function () {
                var width = $(window).width();

                if (width > 576) {
                    var contentheight = $(window).height();
                    var navigationheight = $(window).height();

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
