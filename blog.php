<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$id = '';
$position = '';
$positionid = '';
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
}
if (isset($_SESSION['position'])) {
    $position = $_SESSION['position'];
}
if (isset($_SESSION['id'])) {
    $positionid = $_SESSION['id'];
}

$COUNT = BlogQuestion::getQuestionsCount();
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
                            <li><span class="active">Blog</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container  padding-top-45">

                <div class="col-md-12">
                    <div class="blog col-md-9 col-xs-12">
                        <div class="blog-top-heading">
                            <div class="row">
                                <div class="topic">
                                    <h3>All Questions</h3>
                                </div>
                                <div class="ask-btn">
                                    <a href="#qu-form" class="btn btn-heading" id="ask-btn">Ask Question</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="topic">
                                    <h4><?php echo $COUNT['count']; ?> Questions</h4>
                                </div>
                                <div class="nav">
                                    <a href="#" class="btn btn-default active" id="ask-btn">Newest</a>
                                    <a href="#" class="btn btn-default" id="ask-btn">Unanswered</a>
                                </div>

                            </div>
                            <div class="row">
                                <hr class="main-divider" />
                            </div>
                        </div>

                        <?php
                        foreach (BlogQuestion::all() as $question) {
                            if ($question['position'] === 'visitor') {
                                $POSITION = new Visitor($question['position_id']);
                            } elseif ($question['position'] === 'driver') {
                                $POSITION = new Drivers($question['position_id']);
                            }

                            $COUNTANSWERS = BlogAnswer::getAnswerCountByQuestion($question['id']);
                            ?>
                            <div class="">
                                <div class="question col-md-12 col-xs-12">
                                    <div class="answers-count col-md-1 col-xs-3">
                                        <h2><?php echo $COUNTANSWERS['count']; ?></h2>
                                        <h6><?php
                                            if ($COUNTANSWERS['count'] == 1) {
                                                echo 'Answer';
                                            } else {
                                                echo 'Answers';
                                            };
                                            ?></h6>
                                    </div>
                                    <div class="description col-md-9 col-xs-9">
                                        <span class="qu-subject"><a href="view-question.php?id=<?php echo $question['id']; ?>"><?php echo $question['subject']; ?></a></span><br />
                                        <span class="qu-description"><?php
                                            if (strlen($question['question']) > 225) {
                                                echo substr($question['question'], 0, 225) . '...';
                                            } else {
                                                echo $question['question'];
                                            }
                                            ?></span>
                                    </div>
                                    <div class="asked-by col-md-2 col-xs-12">
                                        <div class="col-md-12 time-ago">
                                            asked 25min ago
                                        </div>
                                        <div class="col-md-12">
                                            <img src="upload/<?php echo $question['position']; ?>/<?php echo $POSITION->profile_picture; ?>" alt=""/>
                                        </div>
                                        <div class="col-md-12">
                                            <?php echo $question['position']; ?><br />
                                            <?php echo $POSITION->name; ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="hr col-md-12 col-xs-12">
                                    <hr class="main-divider" />
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="qu-form" id="qu-form">
                            <h3>Ask A Question</h3>
                            <div class="panel panel-default">

                                <input type="text" class="form-control" name="subject" id="subject" required="" placeholder="Enter Subject"/>
                                <textarea class="form-control" name="question" id="qu" required placeholder="Enter Question"></textarea>
                                <input type="hidden" name="position" id="position" value="<?php echo $position; ?>"/>
                                <input type="hidden" name="positionid" id="positionid" value="<?php echo $positionid; ?>"/>
                                <input type="submit" class="btn btn-heading" name="btn-submit" id="btn-submit" value="POST"/>

                            </div>

                        </div>

                    </div>
                    <div class="col-md-3">

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
                                <input type="text" name="username" id="un" class="form-control" placeholder="User Name" value="" />
                                <input type="password" name="password" id="pw" class="form-control" placeholder="Password" value=""/>
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
                            <input type="submit" id="signin" name="signin" class="signup-btn" value="SIGN IN" />
                            <input type="submit" id="signup" name="signup" class="signup-btn hidden" value="SIGN UP" />
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
        <script src="scripts/add-question.js" type="text/javascript"></script>
        <script src="lib/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="scripts/signin.js" type="text/javascript"></script>
        <script src="scripts/signup.js" type="text/javascript"></script>
        <script src="lib/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script>
            tinymce.init({
                selector: "#qu",
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
    </body>
</html>
