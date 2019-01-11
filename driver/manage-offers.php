<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$DRIVER = new Drivers($_SESSION['id']);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Manage Offers || Driver DashBoard</title>
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
                    <div class="col-md-12 col-sm-12">

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Add New Offer
                            </div>
                            <div class="panel-body">
                                <form method="post" action="post-and-get/offer.php" enctype="multipart/form-data">
                                    <div class="row form-data">
                                        <label>Title</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Start Date</label>
                                        <input type="text" name="start_date" id="startdate" class="form-control" placeholder="Enter Start Date" value="" />
                                    </div>
                                    <div class="row form-data">
                                        <label>End Date</label>
                                        <input type="text" name="end_date" id="enddate" class="form-control" placeholder="Enter End Date" value="" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Discount</label>
                                        <input type="text" name="discount" id="discount" class="form-control" placeholder="Enter Discount" value="" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Price</label>
                                        <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price" value="" />
                                    </div>

                                    <div class="row form-data">
                                        <label>Image</label>
                                        <input type="file" name="image" id="image" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Description</label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                    </div>

                                    <div class="row form-data">
                                        <input type="hidden" name="driver" value="<?php echo $DRIVER->id; ?>" />
                                        <input type="submit" name="create-offer" id="create-offer" class="btn btn-green" value="Save Offer" />
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Manage Offers
                            </div>
                            <div class="panel-body">

                                <?php
                                foreach (Offer::getOffersByDriverID($DRIVER->id) as $offer) {
                                    ?>
                                    <div class="col-md-3 col-sm-4" id="div<?php echo $offer['id']; ?>">
                                        <div class="photo-img-container">
                                            <img src="../upload/offer/<?php echo $offer['image_name']; ?>" class="img-responsive ">
                                        </div>
                                        <div class="img-caption">
                                            <p class="maxlinetitle"><?php echo $offer['title']; ?></p>
                                            <div class="d">
                                                <a href="#" class="delete-offer" data-id="<?php echo $offer['id']; ?>"> <button class="fa fa-trash delete-btn"></button></a>
                                                <a href="edit-offer.php?id=<?php echo $offer['id']; ?>"> <button class="fa fa-pencil edit-btn"></button></a>
                                                <a href="view-offer.php?id=<?php echo $offer['id']; ?>"> <button class="fa fa-eye edit-btn"></button></a>

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
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
        <script src="delete/js/offer.js" type="text/javascript"></script>
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
                    var navigationheight = $(window).height() + 78;
//                    $('.navigation').css('height', navigationheight);
                }
            });
        </script>
    </body>
</html>