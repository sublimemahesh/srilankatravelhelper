<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $VISITOR = new Visitor($id);
} else {
    $VISITOR = new Visitor($_SESSION['id']);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Profile  || Visitor DashBoard</title>
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
                    <div class="col-md-9">

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Edit <?php
                                if (isset($_GET['id'])) {
                                    echo 'Visitor';
                                } else {
                                    echo 'Profile';
                                };
                                ?>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="post-and-get/visitor.php"  enctype="multipart/form-data">
                                    <div class="prof-img">
                                        <?php
                                        if ($VISITOR->profile_picture) {
                                            ?>
                                            <img src="../upload/visitor/<?php echo $VISITOR->profile_picture; ?> " alt=""/>
                                            <?php
                                        } else {
                                            ?>
                                            <img src="../upload/visitor/visitor.png" alt=""/>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <input type="file" name="image" id="image" />


                                    <div class="row form-data">
                                        <label>Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="<?php echo $VISITOR->name; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" value="<?php echo $VISITOR->email; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Address</label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" value="<?php echo $VISITOR->address; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Contact Number</label>
                                        <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Enter Contact Number" value="<?php echo $VISITOR->contact_number; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <input type="hidden" name="id" value="<?php echo $VISITOR->id; ?>" />
                                        <input type="hidden" name="oldImageName" value="<?php echo $VISITOR->profile_picture; ?>" />
                                        <input type="submit" name="update" id="update" class="btn btn-lg btn-green" value="Save Data" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <ul class="list-group prof-details">
                            <a href="profile.php"><li class="list-group-item"><div class="pro-icon"><i class="fa fa-user"></i></div><div class="pro-nav">My Profile</div></li></a>
                            <a href="edit-visitor.php"><li class="list-group-item active"><div class="pro-icon"><i class="fa fa-pencil"></i></div><div class="pro-nav">Edit Profile</div></li></a>
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
        <script src="js/add-visitor.js" type="text/javascript"></script>

        <script>
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
