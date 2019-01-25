<?php
include_once(dirname(__FILE__) . '/../class/include.php');

//$VISITOR = new Visitor($_SESSION['id']);

$driverid = '';
if (isset($_GET['id'])) {
    $driverid = $_GET['id'];
}
if (!isset($_SESSION)) {
    session_start();
}
unset($_SESSION["back_url"]);
if (!Visitor::authenticate()) {
    if ($_GET['back'] === 'visitormessage') {
        $_SESSION["back_url"] = 'http://www.toursrilanka.travel/visitor/visitor-message.php?id=' . $driverid;
//        $_SESSION["back_url"] = 'http://localhost/srilankatravelhelper/visitor/visitor-message.php?id=' . $driverid;
    }
    redirect('index.php?message=24');
} else {
    $visitorid = $_SESSION['id'];
}

$VISITOR = new Visitor($visitorid);
$DRI = new Drivers($driverid);
$DISTINCTDRIVERS = DriverAndVisitorMessages::getDistinctDriversByVisitorId($visitorid);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Chat with Driver || Visitor DashBoard</title>
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
                                        if (empty($VISITOR->profile_picture)) {
                                            ?> 
                                            <img id="profile-img" src="../upload/driver/driver.png" class="online" alt="" />
                                            <?php
                                        } else {

                                            if ($VISITOR->facebookID && substr($VISITOR->profile_picture, 0, 5) === "https") {
                                                ?>
                                                <img id="profile-img" src="<?php echo $VISITOR->profile_picture; ?>" class="online" alt="" />
                                                <?php
                                            } else {
                                                ?>
                                                <img id="profile-img" src="../upload/visitor/<?php echo $VISITOR->profile_picture; ?>" class="online" alt="" />
                                                <?php
                                            }
                                        }
                                        ?>
                                        <p><?php echo $VISITOR->name; ?></p>
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
                                            <input name="twitter" type="text" value="<?php echo $VISITOR->email; ?>" />
                                            <label for="twitter"><i class="fa fa-phone fa-fw" aria-hidden="true"></i></label>
                                            <input name="twitter" type="text" value="<?php echo $VISITOR->contact_number; ?>" />
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
                                        foreach ($DISTINCTDRIVERS as $distinctdriver) {
                                            $max = DriverAndVisitorMessages::getMaxIDOfDistinctDriver($distinctdriver['driver'], $visitorid);
                                            array_push($maxids, $max['max']);
//                                        return $maxids;
                                        }
                                        rsort($maxids);
                                        foreach ($maxids as $key => $maxid) {
                                            $MESSAGE = new DriverAndVisitorMessages($maxid);
                                            $DRIVER = new Drivers($MESSAGE->driver);
                                            ?>
                                            <a href="visitor-message.php?id=<?php echo $MESSAGE->driver; ?>">
                                                <li class="contact <?php
                                                if ($MESSAGE->driver == $driverid) {
                                                    echo 'active';
                                                }
                                                ?>">
                                                    <div class="wrap">
        <!--//                                                    <span class="contact-status online"></span>-->
                                                        <?php
                                                        if (empty($DRIVER->profile_picture)) {
                                                            ?> 
                                                            <img src="../upload/driver/driver.png" alt = "" />
                                                            <?php
                                                        } else {

                                                            if ($DRIVER->facebookID && substr($DRIVER->profile_picture, 0, 5) === "https") {
                                                                ?>
                                                                <img src="<?php echo $DRIVER->profile_picture; ?>" alt = "" />
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src = "../upload/driver/<?php echo $DRIVER->profile_picture; ?>" alt = ""/>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <div class = "meta">
                                                            <p class = "name"><?php echo $DRIVER->name; ?></p>
                                                            <p class="preview">
                                                                <?php
                                                                if ($MESSAGE->sender == 'visitor') {
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
                                <!--                            <div id="bottom-bar">
                                                                <button id="addcontact">
                                                                    <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>
                                                                    <span>Add contact</span>
                                                                </button>
                                                                <button id="settings">
                                                                    <i class="fa fa-cog fa-fw" aria-hidden="true"></i> 
                                                                    <span>Settings</span>
                                                                </button>
                                                            </div>-->
                            </div>
                            <div class="content1">
                                <?php
                                if (isset($_GET['id'])) {
                                    ?>
                                    <div class="contact-profile">
                                        <?php
                                        if (empty($DRI->profile_picture)) {
                                            ?> 
                                            <img src="../upload/driver/driver.png" alt = "" />
                                            <?php
                                        } else {

                                            if ($DRI->facebookID && substr($DRI->profile_picture, 0, 5) === "https") {
                                                ?>
                                                <img src="<?php echo $DRI->profile_picture; ?>" alt = "" />
                                                <?php
                                            } else {
                                                ?>
                                                <img src = "../upload/driver/<?php echo $DRI->profile_picture; ?>" alt = ""/>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <p><?php echo $DRI->name; ?></p>
                                        <div class="social-media">

                                        </div>
                                    </div>
                                    <div class="messages">
                                        <ul>
                                            <?php
                                            $MESSAGES = DriverAndVisitorMessages::getMessagesByVisitorAndDriverASC($visitorid, $driverid);

                                            foreach ($MESSAGES as $msg) {
                                                if ($msg['sender'] == 'visitor') {
                                                    ?>
                                                    <li class="sent">
                                                        <?php
                                                        if (empty($VISITOR->profile_picture)) {
                                                            ?> 
                                                            <img src="../upload/driver/driver.png" alt="" />
                                                            <?php
                                                        } else {

                                                            if ($VISITOR->facebookID && substr($VISITOR->profile_picture, 0, 5) === "https") {
                                                                ?>
                                                                <img src="<?php echo $VISITOR->profile_picture; ?>" alt="" />
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="../upload/visitor/<?php echo $VISITOR->profile_picture; ?>" alt="" />
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
                                                } else if ($msg['sender'] == 'driver') {
                                                    ?>
                                                    <li class="replies">
                                                        <?php
                                                        if (empty($DRI->profile_picture)) {
                                                            ?> 
                                                            <img src="../upload/driver/driver.png" alt = "" />
                                                            <?php
                                                        } else {

                                                            if ($DRI->facebookID && substr($DRI->profile_picture, 0, 5) === "https") {
                                                                ?>
                                                                <img src="<?php echo $DRI->profile_picture; ?>" alt = "" />
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src = "../upload/driver/<?php echo $DRI->profile_picture; ?>" alt = ""/>
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
                                        <form id="send-message" method="post" enctype="multipart/form-data" action="post-and-get/visitor-messages.php">

                                            <input type="text" name="message" id="message" placeholder="Write your message..." autocomplete="off"/>

                                            <input type="hidden" name="driver" value="<?php echo $driverid; ?>">
                                            <input type="hidden" name="visitor" id="visitor" value="<?php echo $_SESSION['id']; ?>">
                                            <input type="hidden" name="sender" value="visitor">
                                            <button type="submit" name="visitor-message" id="visitor-message" class="btn btn-info btn-position-rel">
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
                    var contentheight = $(window).height() + 100;
                    var navigationheight = $(window).height() + 25;

                    $('.content').css('height', contentheight);
                    $('.navigation').css('height', navigationheight);
                }
            });
        </script>
    </body>
</html>