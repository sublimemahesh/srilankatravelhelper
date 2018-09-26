<?php
include_once(dirname(__FILE__) . '/../class/include.php');

$id = '';
$loop = '';
if (isset($_GET['tour'])) {
    $id = $_GET['tour'];
    $loop = 1;
    $Tour = new TourPackages($id);
}
if (isset($_GET['l'])) {
    $loop = $_GET['l'];
}

if (!isset($_SESSION)) {
    session_start();
}
if (!Visitor::authenticate()) {
    if ($_GET['back'] === 'tourreview') {
//        $_SESSION["back_url"] = 'http://travelhelper.galle.website/visitor/manage-tour-package-reviews.php?tour=' . $id;
        $_SESSION["back_url"] = 'http://localhost/visitor/manage-tour-package-reviews.php?tour=' . $id;
    }
    redirect('index.php?message=24');
}

$VISITOR = new Visitor($_SESSION['id']);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage Tour Package Reviews || Visitor DashBoard</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive_visitor.css" rel="stylesheet" type="text/css"/>
        <style>
            .star-rating-fa {
                left: 345px;
            }
            @media (max-width: 576px) {

                .star-rating-fa {
                    left: 0px;
                    margin-top: 6px;
                    text-align: left;
                }
            }
            @media(min-width:577px) and (max-width:990px) {
                .star-rating-fa {
                    left: -5px;
                }
            }
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
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Add Reviews for Tour Packages
                            </div>
                            <div class="panel-body">
                                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for tour packages.." title="Type in a name">
                                <div class="searchbutton2"><img src="images/searchicon.png" alt=""/></div>
                                <input type="hidden" id="tourid" name="id" value="<?php
                                if (isset($_GET['tour'])) {
                                    echo $Tour->id;
                                };
                                ?>" />
                                <ul id="myUL" class="hidden">
                                    <?php
                                    foreach (TourPackages::all() as $tour) {
                                        ?>
                                        <li class="tour" tourid="<?php echo $tour['id']; ?>"><a href="#"><?php echo $tour['name']; ?></a></li>
                                        <?php
                                    }
                                    ?>

                                </ul>

                                <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 tour-profile">
                                    <?php
                                    if ($id) {
                                        ?>
                                        <div class="listing-item">
                                            <img src="../upload/tour-package/thumb/<?php echo $Tour->image_name; ?>" alt="">
                                        </div>
                                        <div class="tour-name text-left">
                                            <?php echo $Tour->name; ?>
                                        </div>
                                        <div class="row">
                                            <div class="star-rating-fa text-right col-md-5">
                                                <?php
                                                $REVIEWS = Reviews::getTotalReviewsOfTour($Tour->id);

                                                $divider = $REVIEWS['count'];
                                                $sum = $REVIEWS['sum'];

                                                if ($divider == 0) {
                                                    for ($j = 1; $j <= 5; $j++) {
                                                        ?>
                                                        <i class="fa fa-star-o"></i>
                                                        <?php
                                                    }
                                                    $sum = 0;
                                                } else {
                                                    $stars = $sum / $divider;

                                                    for ($i = 1; $i <= $stars; $i++) {
                                                        ?>
                                                        <i class="fa fa-star"></i>
                                                        <?php
                                                    }
                                                    for ($j = $i; $j <= 5; $j++) {
                                                        ?>
                                                        <i class="fa fa-star-o"></i>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <div class="rating-counter">(<?php echo $sum; ?> reviews)</div><br>
                                            </div>
                                            <div class="col-md-7"></div>
                                        </div>
                                        <div style="margin-top: 0px;padding-bottom: 7px; text-align: center;">
                                            <p class="text-center " id="">
                                                <?php echo $Tour->short_description; ?>
                                            </p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2"></div>

                                <div class="col-md-12 col-sm-12 col-xs-12 review-add-section">
                                    <h2>Add Review for <span id="tour-name"><?php
                                            if (isset($_GET['tour'])) {
                                                echo $Tour->name;
                                            };
                                            ?></span></h2>
                                    <div class="review col-md-2 col-sm-12 col-xs-12 col-md-offset-5">
                                        <span class="visitor-review">0</span> / 5
                                    </div>
                                    <div class="col-md-5"></div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 review-black-star">

                                    </div>
                                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 review-msg">
                                        <textarea name="message" id="message" class="form-control"></textarea>
                                    </div>
                                    <input type="hidden" id="visitorid" value="<?php echo $VISITOR->id; ?>" />
                                    <input type="hidden" id="reviewid" value="" />
                                    <div class="row col-md-12 col-sm-12 col-xs-12 text-center">
                                        <button class="btn btn-green" id="add-review" review="">Send Review</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="get_tour" value="<?php echo $id; ?>" />
                <input type="hidden" id="loop" value="<?php echo $loop; ?>" />
            </div>
            <?php
            include './footer.php';
            ?>
        </div>

        <script src="js/jquery_2.2.4.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/reviews.js" type="text/javascript"></script>

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
                                        $('#add-review').attr('review', star_number);


                                        $('.review-black-star').empty();
                                        $('.review-black-star').append(html1);
                                    }

//                                    $('#myInput').click(function () {
//                                        $('.tour-profile').addClass('hidden');
//                                        $('.review-add-section').addClass('hidden');
//                                    });

                                    $(window).load(function () {
                                        var width = $(window).width();

                                        if (width > 576) {
                                            var contentheight = $(window).height() + 300;
                                            var navigationheight = $(window).height() + 225;

                                            $('.content').css('height', contentheight);
                                            $('.navigation').css('height', navigationheight);
                                        } else {
                                            var contentheight = $(window).height() + 500;
                                            $('.content').css('height', contentheight);
                                        }
                                    });


        </script>
        <script>
            $(document).ready(function () {
                $('#myInput').click(function () {

                    var loop = $('#loop').val();

                    if (loop == 1) {
                        window.location.replace('http://localhost/srilankatravelhelper/visitor/manage-tour-package-reviews.php?l=0');
                    } else {
                        return true;
                    }

                });
            });
        </script>
        <script src="js/add-tour-review.js" type="text/javascript"></script>
    </body>
</html>
