<?php
include_once(dirname(__FILE__) . '/class/include.php');
$id = '';
$position = '';
$positionid = '';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_SESSION['position'])) {
    $position = $_SESSION['position'];
}
if (isset($_SESSION['id'])) {
    $positionid = $_SESSION['id'];
}

$Question = new BlogQuestion($id);
if ($Question->position === 'visitor') {
    $POSITION = new Visitor($Question->position_id);
} elseif ($Question->position === 'driver') {
    $POSITION = new Drivers($Question->position_id);
}
$COUNTANSWERS = BlogAnswer::getAnswerCountByQuestion($Question->id);

$askedAt = getAskedTime($Question->askedAt);
?>
<html>
    <head>
        <!-- Basic Page Needs
           ================================================== -->
        <title>Sri Lanka Travel Helper</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
           ================================================== -->
        <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="css/blog.css" rel="stylesheet" type="text/css"/>
        <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="lib/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>
        <!-- Wrapper -->
        <div id="wrapper">
            <!-- Header Container
                   ================================================== -->
            <?php include './header.php'; ?>
            <div class="container1 about-bg ">
                <div class="container">
                    <div class="rl-banner">
                        <h2 class="tp">Blog</h2>
                        <ul>
                            <li><a href="./">Home</a></li>
                            <li><a href="blog.php"><span class="">Blog</span></a></li>
                            <li><span class="active">View Question</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container  padding-top-45">

                <div class="">
                    <div class="blog col-md-12">
                        <div class="blog-top-heading">
                            <div class="row">
                                <div class="topic">
                                    <h3><?php echo $Question->subject; ?></h3>
                                </div>
                                <div class="ask-btn">
                                    <a href="ask-a-question.php" class="btn btn-heading" id="ask-btn">Ask Question</a>
                                </div>
                            </div>
                            <div class="row">
                                <hr class="main-divider" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="view-qu asked-by col-md-2 col-xs-12">
                                <i class="glyphicon glyphicon-map-marker"></i> <span class="qu-i"><?php echo $Question->city; ?></span><br />

                                <i class="glyphicon glyphicon-calendar"></i> <span class="qu-i"><?php echo substr($Question->askedAt, 0, 10); ?></span>

                                <div class="col-md-12 time-ago">
                                    asked <?php echo $askedAt; ?>
                                </div>
                                <div class="col-md-12 blog-profile">
                                    <div class="col-md-4">
                                        <?php
                                        if (empty($POSITION->profile_picture)) {
                                            ?>
                                            <img src="upload/driver/driver.png" alt="Profile Picture"/>
                                            <?php
                                        } else {
                                            if ($POSITION->facebookID && substr($POSITION->profile_picture, 0, 5) === "https") {
                                                ?>
                                                <img src="<?php echo $POSITION->profile_picture; ?>"  alt="Profile Picture"/>
                                                <?php
                                            } else {
                                                ?>
                                                <img src="upload/<?php echo $Question->position; ?>/<?php echo $POSITION->profile_picture; ?>" alt="Profile Picture" />
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-8 asked-by-blog">
                                        <span class="qu-name"><?php echo $POSITION->name; ?></span><br />
                                        <?php echo $Question->position; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="question col-md-10 col-xs-10">
                                <?php echo $Question->question; ?>
                            </div>

                        </div>
                        <?php
                        if ($COUNTANSWERS > 0) {
                            ?>
                            <div class="">
                                <div class="answer-topic col-md-12">
                                    <h4><?php echo $COUNTANSWERS['count']; ?> <?php
                                        if ($COUNTANSWERS['count'] == 1) {
                                            echo 'Answer';
                                        } else {
                                            echo 'Answers';
                                        };
                                        ?></h4>
                                </div>
                                <div class="hr col-md-12">
                                    <hr class="main-divider" />
                                </div>
                            </div>
                            <?php
                            foreach (BlogAnswer::getAnswersByQuestions($Question->id) as $key => $answer) {

                                if ($answer['position'] === 'visitor') {
                                    $POSITION = new Visitor($answer['position_id']);
                                } elseif ($answer['position'] === 'driver') {
                                    $POSITION = new Drivers($answer['position_id']);
                                } elseif ($answer['position'] === 'admin') {
                                    $POSITION = new User($answer['position_id']);
                                }
                                $answeredAt = getAskedTime($answer['answeredAt']);
                                $commentCount = BlogComment::getCommentCountByAnswers($answer['id']);
//                            dd($commentCount['count']);
                                if ($commentCount['count'] > 0) {
                                    ?>
                                    <div class="">
                                        <div class="answer col-md-12">
                                            <div class="view-qu asked-by col-md-2 hidden-xs">
                                                <div class="col-md-12">
                                                    <!--<img src="upload/<?php echo $answer['position']; ?>/<?php echo $POSITION->profile_picture; ?>" alt=""/>-->
                                                    <?php
                                                    if (empty($POSITION->profile_picture)) {
                                                        ?>
                                                        <img src="upload/driver/driver.png" alt="Profile Picture"/>
                                                        <?php
                                                    } else {
                                                        if ($POSITION->facebookID && substr($POSITION->profile_picture, 0, 5) === "https") {
                                                            ?>
                                                            <img src="<?php echo $POSITION->profile_picture; ?>"  alt="Profile Picture"/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="upload/<?php echo $answer['position']; ?>/<?php echo $POSITION->profile_picture; ?>" alt="Profile Picture" />
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                                <div class="col-md-12 time-ago">
                                                    <div class="time-ago">
                                                        answered <?php echo $answeredAt; ?>
                                                    </div>
                                                    <?php
                                                    if ($answer['position'] === 'admin') {
                                                        echo 'Travel Helper Team';
                                                    } else {
                                                        echo $POSITION->name . '<br />';
                                                        echo $answer['position'];
                                                    };
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="question col-md-10">
                                                <p><?php echo $answer['answer']; ?></p>
                                            </div>
                                            <div class="view-qu asked-by col-md-2 col-xs-7 col-xs-offset-5 hidden-lg hidden-md- hidden-sm">
                                                <div class="col-md-12">
                                                    <?php
                                                    if (empty($POSITION->profile_picture)) {
                                                        ?>
                                                        <img src="upload/driver/driver.png" alt="Profile Picture"/>
                                                        <?php
                                                    } else {
                                                        if ($POSITION->facebookID && substr($POSITION->profile_picture, 0, 5) === "https") {
                                                            ?>
                                                            <img src="<?php echo $POSITION->profile_picture; ?>"  alt="Profile Picture"/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="upload/<?php echo $answer['position']; ?>/<?php echo $POSITION->profile_picture; ?>" alt="Profile Picture" />
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                                <div class="col-md-12 time-ago">
                                                    <div class="time-ago">
                                                        answered <?php echo $answeredAt; ?>
                                                    </div>
                                                    <?php
                                                    if ($answer['position'] === 'admin') {
                                                        echo 'Travel Helper Team';
                                                    } else {
                                                        echo $POSITION->name . '<br />';
                                                        echo $answer['position'];
                                                    };
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="hr col-md-11 col-md-offset-1 col-xs-12">
                                                <hr class="main-divider" />
                                            </div>
                                            <?php
                                            foreach (BlogComment::getCommentsByAnswer($answer['id']) as $comment) {
                                                if ($comment['position'] === 'visitor') {
                                                    $POSITION1 = new Visitor($comment['position_id']);
                                                } elseif ($comment['position'] === 'driver') {
                                                    $POSITION1 = new Drivers($comment['position_id']);
                                                }
                                                $commentedAt = getAskedTime($comment['commentedAt']);
                                                ?>
                                                <div class="">
                                                    <div class="comment col-md-10 col-md-offset-2">
                                                        <div class="comment-p col-md-9">
                                                            <p><?php echo $comment['comment']; ?></p>
                                                        </div>
                                                        <div class="col-md-3 col-md-offset-0 col-xs-7 col-xs-offset-5">
                                                            <div class="view-qu asked-by">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    if (empty($POSITION->profile_picture)) {
                                                                        ?>
                                                                        <img src="upload/driver/driver.png" alt="Profile Picture"/>
                                                                        <?php
                                                                    } else {
                                                                        if ($POSITION->facebookID && substr($POSITION->profile_picture, 0, 5) === "https") {
                                                                            ?>
                                                                            <img src="<?php echo $POSITION->profile_picture; ?>"  alt="Profile Picture"/>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <img src="upload/<?php echo $comment['position']; ?>/<?php echo $POSITION->profile_picture; ?>" alt="Profile Picture" />
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-12 time-ago">
                                                                    <div class="time-ago">
                                                                        commented <?php echo $commentedAt; ?>
                                                                    </div>
                                                                    <?php
                                                                    echo $POSITION1->name . '<br />';
                                                                    echo $comment['position'];
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hr col-md-12 col-xs-12">
                                                            <hr class="main-divider" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="comment-btn col-md-2">
                                                <a href="#"  class="add-comment" answer="<?php echo $answer['id']; ?>">Add a comment</a>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="hr col-md-12">
                                        <hr class="main-divider" />
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="">
                                        <div class="answer col-md-12">

                                            <div class="view-qu asked-by col-md-2 hidden-xs">

                                                <div class="col-md-12">
                                                    <?php
                                                    if (empty($POSITION->profile_picture)) {
                                                        ?>
                                                        <img src="upload/driver/driver.png" alt="Profile Picture"/>
                                                        <?php
                                                    } else {
                                                        if ($POSITION->facebookID && substr($POSITION->profile_picture, 0, 5) === "https") {
                                                            ?>
                                                            <img src="<?php echo $POSITION->profile_picture; ?>"  alt="Profile Picture"/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="upload/<?php echo $answer['position']; ?>/<?php echo $POSITION->profile_picture; ?>" alt="Profile Picture" />
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                                <div class="col-md-12 time-ago">
                                                    <div class="time-ago">
                                                        answered 25min ago
                                                    </div>
                                                    <?php
                                                    echo $POSITION->name . '<br />';
                                                    echo $answer['position'];
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="question col-md-10">
                                                <p><?php echo $answer['answer']; ?></p>
                                            </div>
                                            <div class="view-qu asked-by col-md-2 col-xs-7 col-xs-offset-5 hidden-lg hidden-md- hidden-sm">
                                                <div class="col-md-12">
                                                    <?php
                                                    if (empty($POSITION->profile_picture)) {
                                                        ?>
                                                        <img src="upload/driver/driver.png" alt="Profile Picture"/>
                                                        <?php
                                                    } else {
                                                        if ($POSITION->facebookID && substr($POSITION->profile_picture, 0, 5) === "https") {
                                                            ?>
                                                            <img src="<?php echo $POSITION->profile_picture; ?>"  alt="Profile Picture"/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="upload/<?php echo $answer['position']; ?>/<?php echo $POSITION->profile_picture; ?>" alt="Profile Picture" />
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                                <div class="col-md-12 time-ago">
                                                    <div class="time-ago">
                                                        answered <?php echo $answeredAt; ?>
                                                    </div>
                                                    <?php
                                                    echo $POSITION->name . '<br />';
                                                    echo $answer['position'];
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="comment-btn col-md-2">
                                                <a href="#"  class="add-comment" answer="<?php echo $answer['id']; ?>">Add a comment</a>
                                            </div>
                                            <div class="hr col-md-12">
                                                <hr class="main-divider" />
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                        <div class="answer-form">
                            <h3>Your Answer</h3>
                            <div class="panel panel-default">
                                <textarea class="form-control" name="answer" id="ans" required placeholder="Enter Your Answer"></textarea>
                                <input type="hidden" name="position" id="position" value="<?php echo $position; ?>" autocomplete="off"/>
                                <input type="hidden" name="positionid" id="positionid" value="<?php echo $positionid; ?>" autocomplete="off"/>
                                <input type="hidden" name="question" id="question" value="<?php echo $id; ?>" autocomplete="off"/>
                                <input type="submit" class="btn btn-heading add-answer" name="btn-submit" id="btn-submit" value="POST"/>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Your Comment</h4>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" name="comment" id="comment" required placeholder="Enter Your Comment"></textarea>
                            <input type="hidden" name="position" id="position" value="<?php echo $position; ?>"/>
                            <input type="hidden" name="positionid" id="positionid" value="<?php echo $positionid; ?>"/>
                            <input type="hidden" name="answer" id="modalanswer" value=""/>

                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-heading" name="btn-submit" id="comment-btn-submit" value="POST"/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal fade" id="login" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Please Login First To Continue</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-6"><a href="#" class="signin active" id="nav-signin">Sign In</a></div>
                            <div class="col-md-6"><a href="#" class="signup" id="nav-signup">Sign Up</a></div>

                            <div id="tab-signin">
                                <select id="ps">
                                    <option value="">Select Your Position</option>
                                    <option value="visitor">Visitor</option>
                                    <option value="driver">Driver</option>
                                </select>
                                <input type="text" name="username" id="un" class="form-control" placeholder="User Name" value="" autocomplete="off" />
                                <input type="password" name="password" id="pw" class="form-control" placeholder="Password" value="" autocomplete="off"/>
                            </div>
                            <div id="tab-signup" class="hidden">
                                <select id="pos">
                                    <option value="">Select Your Position</option>
                                    <option value="visitor">Visitor</option>
                                    <option value="driver">Driver</option>
                                </select>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" />
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                                <input type="text" name="username" id="un1" class="form-control" placeholder="User Name" />
                                <input type="password" name="password" id="pw1" class="form-control" placeholder="Password" />
                                <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password" />
                            </div>



                        </div>
                        <div class="modal-footer">
                            <input type="submit" id="signin-with-position" name="signin" class="signup-btn" value="SIGN IN" />
                            <input type="submit" id="signin-in-comment" name="signin" class="signup-btn hidden" value="SIGN IN" />
                            <input type="submit" id="signup-answer" name="signup" class="signup-btn hidden" value="SIGN UP" />
                            <input type="submit" id="signup-comment" name="signup" class="signup-btn hidden" value="SIGN UP" />
                        </div>
                    </div>

                </div>
            </div>
            <?php

            function getAskedTime($datetime) {

                date_default_timezone_set('Asia/Colombo');
                $today = new DateTime(date("Y-m-d"));
                $todaytime = new DateTime(date("H:i:s"));

                $arr = explode(' ', $datetime);
                $date1 = new DateTime(date($arr[0]));
                $time1 = new DateTime(date($arr[1]));

                $date = $today->diff($date1);
                $datediff = $date->format('%a');

                if ($datediff == 0) {

                    $time = $todaytime->diff($time1);
                    $timediff = $time->format('%h:%i:%s');
                    $arr1 = explode(':', $timediff);
                    if ($arr1[0] == 0) {
                        $diff = $arr1[1] . ' min ago';
                    } elseif ($arr1[0] == 1) {

                        $diff = $arr1[0] . ' hour ago';
                    } else {
                        $diff = $arr1[0] . ' hours ago';
                    }
                } elseif ($datediff == 1 && $time1 > $todaytime) {
                    $t = $todaytime->diff($time1);
                    $timediff1 = $t->format('%h:%i:%s');
                    $time3 = new DateTime('24:00:00');
                    $time = $time3->diff($timediff1);
                    $timediff = $time->format('%h:%i:%s');
                    $arr1 = explode(':', $timediff);
                    $diff = $arr1[0] . ' hours ago';
                } elseif ($datediff == 1 && $time1 < $todaytime) {
                    $diff = $datediff . ' day ago';
                } elseif ($datediff > 30) {
                    $month = round($datediff / 30);

                    if ($month >= 12) {

                        $year = round($month / 12);
                        if ($year == 1) {
                            $diff = $year . ' year ago';
                        } else {
                            $diff = $year . ' years ago';
                        }
                    } elseif ($month == 1) {
                        $diff = $month . ' month ago';
                    } else {
                        $diff = $month . ' months ago';
                    }
                } else {
                    $diff = $datediff . ' days ago';
                }

                return $diff;
            }
            ?>
            <?php include './footer.php'; ?>
            <!-- Back To Top Button -->
            <div id="backtotop"><a href="#"></a></div>
        </div>
        <!-- Scripts
         ================================================== -->
        <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script>
        <script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
        <script src="css/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="scripts/mmenu.min.js"></script>
        <script type="text/javascript" src="scripts/chosen.min.js"></script>
        <script type="text/javascript" src="scripts/slick.min.js"></script>
        <script type="text/javascript" src="scripts/rangeslider.min.js"></script>
        <script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
        <script type="text/javascript" src="scripts/waypoints.min.js"></script>
        <script type="text/javascript" src="scripts/counterup.min.js"></script>
        <script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
        <script type="text/javascript" src="scripts/tooltips.min.js"></script>
        <script type="text/javascript" src="scripts/custom.js"></script>
        <script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="scripts/add-answer.js" type="text/javascript"></script>
        <script src="lib/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script src="scripts/add-comment.js" type="text/javascript"></script>
        <script src="scripts/signin.js" type="text/javascript"></script>
        <script src="scripts/signup.js" type="text/javascript"></script>
        <script>
            tinymce.init({
                selector: "#ans",
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
            $(document).ready(function () {
                $('.add-comment').click(function () {
                    $("#myModal").modal('show');

                    var answer = $(this).attr('answer');
                    $('#modalanswer').val(answer);
                    $('#signin-with-position').addClass('hidden');
                    $('#signin-in-comment').removeClass('hidden');

                    $('#nav-signup').click(function () {
                        $('#tab-signin').addClass('hidden');
                        $('#tab-signup').removeClass('hidden');
                        $('#nav-signin').removeClass('active');
                        $('#nav-signup').addClass('active');
                        $('#signin-in-comment').addClass('hidden');
                        $('#signup-comment').removeClass('hidden');
                    });
                    $('#nav-signin').click(function () {
                        $('#tab-signin').removeClass('hidden');
                        $('#tab-signup').addClass('hidden');
                        $('#nav-signin').addClass('active');
                        $('#nav-signup').removeClass('active');
                        $('#signin-in-comment').removeClass('hidden');
                        $('#signup-comment').addClass('hidden');
                    });
                });
                $('.add-answer').click(function () {

                    $('#signin-with-position').removeClass('hidden');
                    $('#signin-in-comment').addClass('hidden');

                    $('#nav-signup').click(function () {
                        $('#tab-signin').addClass('hidden');
                        $('#tab-signup').removeClass('hidden');
                        $('#nav-signin').removeClass('active');
                        $('#nav-signup').addClass('active');
                        $('#signin-with-position').addClass('hidden');
                        $('#signup-answer').removeClass('hidden');
                    });
                    $('#nav-signin').click(function () {
                        $('#tab-signin').removeClass('hidden');
                        $('#tab-signup').addClass('hidden');
                        $('#nav-signin').addClass('active');
                        $('#nav-signup').removeClass('active');
                        $('#signin-with-position').removeClass('hidden');
                        $('#signup-answer').addClass('hidden');
                    });
                });


            });
        </script>
    </body>
</html>
