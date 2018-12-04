<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$DRIVER = new Drivers($_SESSION['id']);
$OFFER = new Offer($id);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Offer || Driver DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
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
                    <div class="col-md-12 col-sm-12">

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Edit Offer
                            </div>
                            <div class="panel-body">
                                <form method="post" action="post-and-get/offer.php" enctype="multipart/form-data">
                                    <div class="row form-data">
                                        <label>Title</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo $OFFER->title; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Start Date</label>
                                        <input type="text" name="start_date" id="startdate" class="form-control" placeholder="Enter Start Date" value="<?php echo $OFFER->startdate; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>End Date</label>
                                        <input type="text" name="end_date" id="enddate" class="form-control" placeholder="Enter End Date" value="<?php echo $OFFER->enddate; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Discount</label>
                                        <input type="text" name="discount" id="discount" class="form-control" placeholder="Enter Discount" value="<?php echo $OFFER->discount; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Price</label>
                                        <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price" value="<?php echo $OFFER->price; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Image</label>
                                        <input type="file" name="image" id="image" />
                                        <div class="col-md-4">
                                            <img src="../upload/offer/<?php echo $OFFER->image_name; ?>" alt="" class="img-thumbnail"/>
                                        </div>
                                    </div>
                                    <div class="row form-data">
                                        <label>Description</label>
                                        <textarea name="description" id="description" class="form-control"><?php echo $OFFER->description; ?></textarea>
                                    </div>

                                    <div class="row form-data">
                                        <input type="hidden" name="driver" value="<?php echo $OFFER->driver; ?>" />
                                        <input type="hidden" name="oldImageName" value="<?php echo $OFFER->image_name; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $OFFER->id; ?>" />
                                        <input type="submit" name="edit-offer" id="edit-offer" class="btn btn-green" value="Save Changes" />
                                    </div>
                                </form>
                            </div>
                        </div>
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
        <script src="delete/js/driver-photo.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
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
                $("#startdate").datepicker({dateFormat: "yy-mm-dd"}).val()
                $("#enddate").datepicker({dateFormat: "yy-mm-dd"}).val()
            });
        </script>
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
//                    $('.content').css('height', contentheight);
                }
            });
        </script>
    </body>
</html>