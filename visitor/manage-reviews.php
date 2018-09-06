<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');

$VISITOR = new Visitor($_SESSION['id']);
//$DRIVERPHOTOS = DriverPhotos::getDriverPhotosByDriver($DRIVER->id);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage Reviews || Visitor DashBoard</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <style>

            
        </style>
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
                    <div class="col-md-12">

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Add Reviews
                            </div>
                            <div class="panel-body">
                                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for driver.." title="Type in a name">
                                <div class="searchbutton"><img src="images/searchicon.png" alt=""/></div>
                                <input type="hidden" id="driverid" name="id" value="" />
                                <ul id="myUL" class="hidden">
                                    <?php
                                    foreach (Drivers::all() as $driver) {
                                        ?>
                                        <li class="driver" driverid="<?php echo $driver['id']; ?>"><a href="#"><?php echo $driver['name']; ?></a></li>
                                        <?php
                                    }
                                    ?>

                                </ul>

                                <div class="col-md-8 col-md-offset-2 driver-profile">

                                </div>
                                <div class="col-md-2"></div>

                                <div class="col-md-12 review-add-section hidden">
                                    <h2>Add Review for <span id="driver-name"></span></h2>
                                    <div class="review col-md-2 col-md-offset-5">
                                        <span class="visitor-review">0</span> / 5
                                    </div>
                                    <div class="col-md-5"></div>
                                    <div class="col-md-12 review-black-star">

                                    </div>
                                    <input type="hidden" id="visitorid" value="<?php echo $VISITOR->id; ?>" />
                                    <input type="hidden" id="reviewid" value="" />
                                    <div class="row col-md-12 text-center">
                                        <button class="btn btn-green" id="add-review" review="">Send Review</button>
                                    </div>
                                </div>
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
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/sign-up.js" type="text/javascript"></script>
        <script src="js/add-driver.js" type="text/javascript"></script>
        <script src="delete/js/driver-photo.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/reviews.js" type="text/javascript"></script>

        <script>
                                    $(document).ready(function () {
                                        var contentheight = $(window).height() + 175;
                                        var navigationheight = $(window).height() + 100;

                                        $('.content').css('height', contentheight);
                                        $('.navigation').css('height', navigationheight);
                                    });
        </script>

        <script>
            function myFunction() {

                $('#myUL').removeClass('hidden');

                var input, filter, ul, li, a, i;
                input = document.getElementById("myInput");
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
            function reviews(s) {

                var html1 = '';
                var j, k;
                var star_number = s;

                for (j = 1; j <= star_number; j++) {

                    html1 += '<div class="star" number="' + j + '" onClick="reviews(' + j + ')" ><a><img class="star1" src="images/yellow.png" alt=""/></a></div>';
                }

                for (k = j; k <= 5; k++) {
                    html1 += '<div class="star" number="' + k + '"  onClick="reviews(' + k + ')"><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                }

                
                $('.visitor-review').text(star_number);
                $('#add-review').attr('review',star_number);


                $('.review-black-star').empty();
                $('.review-black-star').append(html1);
            }
        </script>
        <script src="js/add-review.js" type="text/javascript"></script>
    </body>
</html>
