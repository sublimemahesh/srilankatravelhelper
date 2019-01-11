<?php
include_once(dirname(__FILE__) . '/../class/include.php');
//include_once(dirname(__FILE__) . '/auth.php');
//$DRIVER = new Drivers($_SESSION['id']);

$visitorid = '';
if (isset($_GET['id'])) {
    $visitorid = $_GET['id'];
}
if (!isset($_SESSION)) {
    session_start();
}
if (!Drivers::authenticate()) {
    if ($_GET['back'] === 'drivermessage') {
        $_SESSION["back_url"] = 'http://toursrilanka.travel/driver/driver-message.php?id=' . $visitorid;
//        $_SESSION["back_url"] = 'http://localhost/srilankatravelhelper/driver/driver-message.php?id=' . $visitorid;
    }
    redirect('index.php?message=24');
} else {
    $driverid = $_SESSION['id'];
}

$DRIVER = new Drivers($driverid);
$VISITOR = new Visitor($visitorid);
$DISTINCTVISITORS = DriverAndVisitorMessages::getDistinctVisitorsByDriverId($driverid);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Chat with Visitors || Driver DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive_visitor.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="css/driver-visitor-messages.css" rel="stylesheet" type="text/css"/>
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
                        <div id="frame">
                            <div id="sidepanel">
                                <div id="profile">
                                    <div class="wrap">
                                        <?php
                                        if (empty($DRIVER->profile_picture)) {
                                            ?> 
                                            <img id="profile-img" src="../upload/driver/driver.png" class="online" alt="" />
                                            <?php
                                        } else {

                                            if ($DRIVER->facebookID && substr($DRIVER->profile_picture, 0, 5) === "https") {
                                                ?>
                                                <img id="profile-img" src="<?php echo $DRIVER->profile_picture; ?>" class="online" alt="" />
                                                <?php
                                            } else {
                                                ?>
                                                <img id="profile-img" src="../upload/driver/<?php echo $DRIVER->profile_picture; ?>" class="online" alt="" />
                                                <?php
                                            }
                                        }
                                        ?>

                                        <p><?php echo $DRIVER->name; ?></p>
                                        <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
                                        <div id="status-options">
                                            <ul>
                                                <li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
                                                <li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
                                                <li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
                                                <li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
                                            </ul>
                                        </div>
                                        <div id="expanded">
                                            <label for="twitter"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i></label>
                                            <input name="twitter" type="text" value="<?php echo $DRIVER->email; ?>" />
                                            <label for="twitter"><i class="fa fa-phone fa-fw" aria-hidden="true"></i></label>
                                            <input name="twitter" type="text" value="<?php echo $DRIVER->contact_number; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <!--                            <div id="search">
                                                                <label for="">
                                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                                </label>
                                                                <input type="text" placeholder="Search contacts..." />
                                                            </div>-->
                                <div id="contacts">
                                    <ul>
                                        <?php
                                        $maxids = array();
                                        foreach ($DISTINCTVISITORS as $distinctvisitor) {
                                            $max = DriverAndVisitorMessages::getMaxIDOfDistinctVisitor($distinctvisitor['visitor'], $driverid);
                                            array_push($maxids, $max['max']);
//                                        return $maxids;
                                        }
                                        rsort($maxids);
                                        foreach ($maxids as $key => $maxid) {
                                            $MESSAGE = new DriverAndVisitorMessages($maxid);
                                            $VISI = new Visitor($MESSAGE->visitor);
                                            ?>
                                            <a href="driver-message.php?id=<?php echo $MESSAGE->visitor; ?>">
                                                <li class="contact <?php
                                        if ($MESSAGE->visitor == $visitorid) {
                                            echo 'active';
                                        }
                                            ?>">
                                                    <div class="wrap">
                                                        <?php
                                                        if (empty($VISI->profile_picture)) {
                                                            ?> 
                                                            <img src="../upload/driver/driver.png" alt = "" />
                                                            <?php
                                                        } else {

                                                            if ($VISI->facebookID && substr($VISI->profile_picture, 0, 5) === "https") {
                                                                ?>
                                                                <img src="<?php echo $VISI->profile_picture; ?>" alt = "" />
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src = "../upload/visitor/<?php echo $VISI->profile_picture; ?>" alt = ""/>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <div class = "meta">
                                                            <p class = "name"><?php echo $VISI->name; ?></p>
                                                            <p class="preview">
                                                                <?php
                                                                if ($MESSAGE->sender == 'driver') {
                                                                    ?>
                                                                    <span>You: </span>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php
                                                                if (strlen($MESSAGE->messages) > 30) {
                                                                    echo substr($MESSAGE->messages, 0, 30) . '...';
                                                                } else {
                                                                    echo $MESSAGE->messages;
                                                                };
                                                                ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </a>
                                            <?php
                                        }
                                        ?>


                                    </ul>
                                </div>
                            </div>
                            <div class="content1">
                                <?php
                                if (isset($_GET['id'])) {
                                    ?>
                                    <div class="contact-profile">
                                        <?php
                                        if (empty($VISITOR->profile_picture)) {
                                            ?> 
                                            <img src="../upload/driver/driver.png" alt = "" />
                                            <?php
                                        } else {

                                            if ($VISITOR->facebookID && substr($VISITOR->profile_picture, 0, 5) === "https") {
                                                ?>
                                                <img src="<?php echo $VISITOR->profile_picture; ?>" alt = "" />
                                                <?php
                                            } else {
                                                ?>
                                                <img src = "../upload/visitor/<?php echo $VISITOR->profile_picture; ?>" alt = ""/>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <p><?php echo $VISITOR->name; ?></p>
                                        <div class="social-media">

                                        </div>
                                    </div>
                                    <div class="messages">
                                        <ul>
                                            <?php
                                            $MESSAGES = DriverAndVisitorMessages::getMessagesByVisitorAndDriverASC($visitorid, $driverid);

                                            foreach ($MESSAGES as $msg) {
                                                if ($msg['sender'] == 'driver') {
                                                    ?>
                                                    <li class="sent">
                                                        <?php
                                                        if (empty($DRIVER->profile_picture)) {
                                                            ?> 
                                                            <img src="../upload/driver/driver.png" alt="" />
                                                            <?php
                                                        } else {

                                                            if ($DRIVER->facebookID && substr($DRIVER->profile_picture, 0, 5) === "https") {
                                                                ?>
                                                                <img src="<?php echo $DRIVER->profile_picture; ?>" alt="" />
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="../upload/driver/<?php echo $DRIVER->profile_picture; ?>" alt="" />
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <p><?php echo $msg['messages']; ?>
                                                            <br />
                                                            <span class="sent">
                                                                <?php
                                                                $time = substr($msg['date_and_time'], 11, 19);
                                                                $vartime = change_time($time);
                                                                if (substr($msg['date_and_time'], 0, 4) < date('Y')) {
                                                                    $date = strtotime(substr($msg['date_and_time'], 0, 10));
                                                                    $vardate = date('F d, Y', $date);
                                                                    echo $vardate . ' AT ' . $vartime;
                                                                } else if (substr($msg['date_and_time'], 0, 10) === date('Y-m-d', strtotime("-1 days"))) {
                                                                    $date = strtotime(substr($msg['date_and_time'], 0, 10));
                                                                    $vardate = date('D', $date);
                                                                    echo $vardate . ' AT ' . $vartime;
                                                                } else if (substr($msg['date_and_time'], 0, 10) === date('Y-m-d')) {
                                                                    echo $vartime;
                                                                } else {
                                                                    $date = strtotime(substr($msg['date_and_time'], 0, 10));
                                                                    $vardate = date('F d', $date);
                                                                    echo $vardate . ' AT ' . $vartime;
                                                                }
                                                                ?>
                                                            </span>
                                                        </p>
                                                    </li>
                                                    <?php
                                                } else if ($msg['sender'] == 'visitor') {
                                                    $viewmessage = DriverAndVisitorMessages::updateViewingStatus($msg['id']);
                                                    ?>
                                                    <li class="replies">
                                                        <?php
                                                        if (empty($VISITOR->profile_picture)) {
                                                            ?> 
                                                            <img src="../upload/driver/driver.png" alt = "" />
                                                            <?php
                                                        } else {

                                                            if ($VISITOR->facebookID && substr($VISITOR->profile_picture, 0, 5) === "https") {
                                                                ?>
                                                                <img src="<?php echo $VISITOR->profile_picture; ?>" alt = "" />
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src = "../upload/visitor/<?php echo $VISITOR->profile_picture; ?>" alt = ""/>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <p><?php echo $msg['messages']; ?>
                                                            <br />
                                                            <span class="reply">
                                                                <?php
                                                                $time = substr($msg['date_and_time'], 11, 19);
                                                                $vartime = change_time($time);
                                                                if (substr($msg['date_and_time'], 0, 4) < date('Y')) {
                                                                    $date = strtotime(substr($msg['date_and_time'], 0, 10));
                                                                    $vardate = date('F d, Y', $date);
                                                                    echo $vardate . ' AT ' . $vartime;
                                                                } else if (substr($msg['date_and_time'], 0, 10) === date('Y-m-d', strtotime("-1 days"))) {
                                                                    $date = strtotime(substr($msg['date_and_time'], 0, 10));
                                                                    $vardate = date('D', $date);
                                                                    echo $vardate . ' AT ' . $vartime;
                                                                } else if (substr($msg['date_and_time'], 0, 10) === date('Y-m-d')) {
                                                                    echo $vartime;
                                                                } else {
                                                                    $date = strtotime(substr($msg['date_and_time'], 0, 10));
                                                                    $vardate = date('F d', $date);
                                                                    echo $vardate . ' AT ' . $vartime;
                                                                }
                                                                ?>
                                                            </span>
                                                        </p>

                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </ul>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="contact-profile">

                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="message-input">
                                    <div class="wrap">
                                        <form id="send-message" method="post" enctype="multipart/form-data" action="post-and-get/driver-messages.php">

                                            <input type="text" name="message" id="message" placeholder="Write your message..." autocomplete="off"/>

                                            <input type="hidden" name="driver" value="<?php echo $_SESSION['id']; ?>">
                                            <input type="hidden" name="visitor" id="visitor" value="<?php echo $visitorid; ?>">
                                            <input type="hidden" name="sender" value="driver">
                                            <input type="hidden" id="isVerifiedContactNumber" value="<?php echo $isPhoneVerified; ?>" contactnumber="<?php echo $DRIVER->contact_number; ?>">
                                            <button type="submit" name="driver-message" id="driver-message" class="btn btn-info btn-position-rel">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
            <?php

            function change_time($input_time) {

                $hours = substr($input_time, 0, 2);
                $mins = substr($input_time, 3, 2);

                if (($hours >= 12) && ($hours <= 24)) {
                    if (($hours == 24)) {
                        $new_hour = "00";
                        $part = "AM";
                    } else if ($hours == 12) {
                        $new_hour = $hours;
                        $part = "PM";
                    } else {
                        $new_hour = $hours - 12;
                        $part = "PM";
                    }
                } else {
                    $new_hour = $hours;
                    $part = "AM";
                }
                return $new_hour . ":" . $mins . " " . $part;
            }
            ?>
            <?php
            include './footer.php';
            ?>
        </div>

        <script src="js/jquery_2.2.4.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
        <script src="js/driver-visitor-messages.js" type="text/javascript"></script>
        <script src="js/visitor-message.js" type="text/javascript"></script>
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