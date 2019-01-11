<?php
include_once(dirname(__FILE__) . '/../class/include.php');
$id = '';
$loop = '';
if (isset($_GET['destination'])) {
    $id = $_GET['destination'];
    $loop = 1;
    $Destination = new Destination($id);
}
if (isset($_GET['l'])) {
    $loop = $_GET['l'];
}

if (!isset($_SESSION)) {
    session_start();
}
if (!Visitor::authenticate()) {
    if ($_GET['back'] === 'destinationreview') {
        $_SESSION["back_url"] = 'http://toursrilanka.travel/visitor/manage-destination-reviews.php?destination=' . $id;
//        $_SESSION["back_url"] = 'http://localhost/visitor/manage-destination-reviews.php?destination=' . $id;
    }
    redirect('index.php?message=24');
}

$VISITOR = new Visitor($_SESSION['id']);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Manage Destination Reviews || Visitor DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
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
                    left: -35px;
                    margin-top: 2px;
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
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Add Reviews for Destination
                            </div>
                            <div class="panel-body">
                                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for destination.." title="Type in a name">
                                <div class="searchbutton3"><img src="images/searchicon.png" alt=""/></div>
                                <input type="hidden" id="destinationid" name="id" value="<?php
                                if (isset($_GET['destination'])) {
                                    echo $Destination->id;
                                };
                                ?>" />
                                <ul id="myUL" class="hidden">
                                    <?php
                                    foreach (Destination::all() as $destination) {
                                        ?>
                                        <li class="destination" destinationid="<?php echo $destination['id']; ?>"><a href="#"><?php echo $destination['name']; ?></a></li>
                                        <?php
                                    }
                                    ?>

                                </ul>

                                <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 destination-profile">
                                    <?php
                                    if ($id) {
                                        ?>
                                        <div class="listing-item">
                                            <img src="../upload/destination/thumb1/<?php echo $Destination->image_name; ?>" alt="">
                                        </div>
                                        <div class="tour-name text-left">
                                            <?php echo $Destination->name; ?>
                                        </div>
                                        <div class="row">
                                            <div class="star-rating-fa text-right col-md-5">
                                                <?php
                                                $REVIEWS = Reviews::getTotalReviewsOfDestination($Destination->id);

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
                                                <?php echo $Destination->short_description; ?>
                                            </p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2"></div>

                                <div class="col-md-12 col-sm-12 col-xs-12 review-add-section">
                                    <h2>Add Review for <span id="destination-name"><?php
                                            if (isset($_GET['destination'])) {
                                                echo $Destination->name;
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
                <input type="hidden" id="get_destination" value="<?php echo $id; ?>" />
                <input type="hidden" id="loop" value="<?php echo $loop; ?>" />
            </div>
            <?php
            include './footer.php';
            ?>
        </div>

        <script src="js/jquery_2.2.4.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/reviews.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
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

                                    $('#myInput').click(function () {
                                        $('.destination-profile').addClass('hidden');
                                        $('.review-add-section').addClass('hidden');
                                    });

                                    $(window).load(function () {
                                        var width = $(window).width();

                                        if (width > 576) {
                                            var contentheight = $(window).height() + 500;
                                            var navigationheight = $(window).height() + 425;

                                            $('.content').css('height', contentheight);
                                            $('.navigation').css('height', navigationheight);
                                        } else {
                                            var contentheight = $(window).height() + 700;
                                            $('.content').css('height', contentheight);
                                        }
                                    });


        </script>
        <script>
            $(document).ready(function () {
                $('.review-add-section').addClass('hidden');
                $('#myInput').click(function () {

                    var loop = $('#loop').val();

                    if (loop == 1) {
//                        window.location.replace('http://localhost/srilankatravelhelper/visitor/manage-destination-reviews.php?l=0');
                        window.location.replace('http://travelhelper.galle.website/visitor/manage-destination-reviews.php?l=0');
                    } else {
                        return true;
                    }

                });
            });
        </script>
        <script src="js/add-destination-review.js" type="text/javascript"></script>
    </body>
</html>
