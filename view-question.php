<?php
include_once(dirname(__FILE__) . '/class/include.php');
$id = '';
$position = '';
$positionid = '';

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
$VISITOR = new Visitor($Question->visitor);
$COUNTANSWERS = BlogAnswer::getAnswerCountByQuestion($Question->id);
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
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/style.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/colors/main.css" id="colors">
        <link href="css/blog.css" rel="stylesheet" type="text/css"/>
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

                <div class="col-md-12">
                    <div class="blog col-md-12">
                        <div class="blog-top-heading">
                            <div class="row">
                                <div class="topic">
                                    <h3><?php echo $Question->subject; ?></h3>
                                </div>
                                <div class="ask-btn">
                                    <a href="blog.php" class="btn btn-heading" id="ask-btn">Ask Question</a>
                                </div>
                            </div>
                            <div class="row">
                                <hr class="main-divider" />
                            </div>
                        </div>

                        <div class="">
                            <div class="question col-md-12">
                                <?php echo $Question->question; ?>
                            </div>

                            <div class="view-qu asked-by col-md-4 col-md-offset-8">
                                <div class="col-md-4">
                                    <img src="upload/visitor/<?php echo $VISITOR->profile_picture; ?>" alt=""/>
                                </div>
                                <div class="col-md-8 time-ago">
                                    <div class="time-ago">
                                        asked 25min ago
                                    </div>
                                    <?php echo $VISITOR->name; ?>
                                </div>
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

                                $commentCount = BlogComment::getCommentCountByAnswers($answer['id']);
//                            dd($commentCount['count']);
                                if ($commentCount['count'] > 0) {
                                    ?>
                                    <div class="">
                                        <div class="answer col-md-12">
                                            <p><?php echo $answer['answer']; ?></p>
                                            <div class="view-qu asked-by col-md-4 col-md-offset-8">

                                                <?php
                                                if ($answer['position'] === 'admin') {
                                                    ?>
                                                    <div class="col-md-4 company-logo">
                                                        <img src="images/logo/log-1.png" alt=""/>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="col-md-4">
                                                        <img src="upload/<?php echo $answer['position']; ?>/<?php echo $POSITION->profile_picture; ?>" alt=""/>
                                                    </div>
                                                    <?php
                                                }
                                                ?>


                                                <div class="col-md-8 time-ago">
                                                    <div class="time-ago">
                                                        answered 25min ago
                                                    </div>
                                                    <?php
                                                    if ($answer['position'] === 'admin') {
                                                        echo 'Travel Helper Team';
                                                    } else {
                                                        echo $answer['position'] . '<br />';
                                                        echo $POSITION->name;
                                                    };
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="hr col-md-11 col-md-offset-1">
                                                <hr class="main-divider" />
                                            </div>
                                            <?php
                                            foreach (BlogComment::getCommentsByAnswer($answer['id']) as $comment) {
                                                if ($comment['position'] === 'visitor') {
                                                    $POSITION1 = new Visitor($comment['position_id']);
                                                } elseif ($comment['position'] === 'driver') {
                                                    $POSITION1 = new Drivers($comment['position_id']);
                                                } elseif ($comment['position'] === 'admin') {
                                                    $POSITION1 = new User($comment['position_id']);
                                                }
                                                ?>
                                                <div class="comment col-md-11 col-md-offset-1">
                                                    <p><?php echo $comment['comment']; ?> <span class="comment-by">- <?php
                                                            if ($answer['position'] === 'admin') {
                                                                echo 'Travel Helper Team';
                                                            } else {
                                                                echo $POSITION->name;
                                                            };
                                                            ?> </span> <span class="commented-at">25min ago</span> </p> 

                                                    <div class="hr col-md-12">
                                                        <hr class="main-divider" />
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
                                            <p><?php echo $answer['answer']; ?></p>
                                            <div class="comment-btn col-md-2">
                                                <a href="#"  class="add-comment" answer="<?php echo $answer['id']; ?>">Add a comment</a>
                                            </div>
                                            <div class="view-qu asked-by col-md-4 col-md-offset-6">
                                                <?php
                                                if ($answer['position'] === 'admin') {
                                                    ?>
                                                    <div class="col-md-4 company-logo">
                                                        <img src="images/logo/log-1.png" alt=""/>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="col-md-4">
                                                        <img src="upload/<?php echo $answer['position']; ?>/<?php echo $POSITION->profile_picture; ?>" alt=""/>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="col-md-8 time-ago">
                                                    <div class="time-ago">
                                                        answered 25min ago
                                                    </div>
                                                    <?php
                                                    if ($answer['position'] === 'admin') {
                                                        echo 'Travel Helper Team';
                                                    } else {
                                                        echo $answer['position'] . '<br />';
                                                        echo $POSITION->name;
                                                    };
                                                    ?>
                                                </div>
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



                        <!--                        <div class="hr col-md-12">
                                                    <hr class="main-divider" />
                                                </div>-->
                        <div class="answer-form">
                            <h3>Your Answer</h3>
                            <div class="panel panel-default">
                                <textarea class="form-control" name="answer" id="ans" required placeholder="Enter Your Answer"></textarea>
                                <input type="hidden" name="position" id="position" value="<?php echo $position; ?>"/>
                                <input type="hidden" name="positionid" id="positionid" value="<?php echo $positionid; ?>"/>
                                <input type="hidden" name="question" id="question" value="<?php echo $id; ?>"/>
                                <input type="submit" class="btn btn-heading" name="btn-submit" id="btn-submit" value="POST"/>

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
                            <select id="ps">
                                <option value="">Select Your Position</option>
                                <option value="admin">Admin</option>
                                <option value="visitor">Visitor</option>
                                <option value="driver">Driver</option>
                            </select>
                            <input type="text" name="username" id="un" class="form-control" placeholder="User Name" value="" />
                            <input type="password" name="password" id="pw" class="form-control" placeholder="Password" value=""/>
                            <input type="submit" id="signin-with-position" name="signin" class="signup-btn" value="SIGN IN" />
                            <input type="submit" id="signin-in-comment" name="signin" class="signup-btn hidden" value="SIGN IN" />

                        </div>
                        <div class="modal-footer">
                            <!--<input type="submit" class="btn btn-heading" name="btn-submit" id="comment-btn-submit" value="POST"/>-->
                        </div>
                    </div>

                </div>
            </div>
            <?php include './footer.php'; ?>
            <!-- Back To Top Button -->
            <div id="backtotop"><a href="#"></a></div>
        </div>
        <!-- Scripts
         ================================================== -->
        <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script>
        <script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
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
        <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
        <script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="scripts/add-answer.js" type="text/javascript"></script>
        <script src="lib/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script src="scripts/add-comment.js" type="text/javascript"></script>
        <script src="scripts/signin.js" type="text/javascript"></script>
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
                });


            });
        </script>
    </body>
</html>
