<?php
$destinations = '';
$count1 = 0;
$count = '';
if (isset($_SESSION['destination_cart'])) {
    $destinations = $_SESSION['destination_cart'];
    $count1 = count($destinations);
}

if ($count1 == 0) {
    $count = '&nbsp;&nbsp;' . $count1;
} else if ($count1 == 1) {
    $count = '&nbsp;0' . $count1;
} else if ($count1 < 9) {
    $count = '0' . $count1;
} else {
    $count = $count1;
}

?>

<header id="header-container">
    <!-- Header -->
    <div id="header">
        <!--<div class="container">-->
        <div class="container">
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="../"><img src="../images/logo/logo.png" alt=""></a>
                </div>
                <!-- Mobile Navigation -->
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
                <!-- Main Navigation -->
                <nav id="navigation" class="style-1">
                    <ul id="responsive">
                        <li><a class="current" href="./">Home</a></li>
                        <li><a href="../destination-type.php">Destinations</a></li>
                        <li><a href="../tour-packages-type.php">Packages</a></li>
                        <li><a href="../drivers-page.php">Drivers</a></li>
                        <li><a href="../blog.php">Blog</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-user"></i> My Profile</a>
                            <ul>
                                <li><a href="profile.php">My Profile</a></li>
                                <li><a href="post-and-get/logout.php" class="index-top-menu">Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->

            </div>
            <!-- Left Side Content / End -->
            <!-- Right Side Content / End -->
            <div class="right-side">
                <div class="header-widget widget-btn-left">

                    <a href="../plan-trip.php" class="button border with-icon button-left"><span class="header-icon header-icon1"><i class="glyphicon glyphicon-map-marker"></i></span> Plan Your Trip</a>

                </div>
                <div class="header-widget widget-btn-right">
                    <a href="../my-cart.php" class="button border with-icon button-right"><span class="header-icon header-icon2"><i class="glyphicon glyphicon-shopping-cart"></i></span> <span class="cart-item-count"><?php
                            if ($count == 1) {
                                echo '1 item';
                            } else {
                                echo $count . ' items';
                            };
                            ?>
                        </span>
                    </a>
                </div>
            </div>
            


        <!--</div>-->
    </div>
    </div>
    <!-- Header / End -->

</header>
<div class="clearfix"></div>
