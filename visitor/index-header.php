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
        <div class="container">
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="./"><img src="../images/logo/logo.png" alt=""></a>
                </div>
                <!-- Mobile Navigation -->
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>


            </div>
            <!-- Left Side Content / End -->
            <!-- Right Side Content / End -->
            <div class="right-side">
                <div class="nav-top hidden-lg hidden-md hidden-sm">
                    <div class="header-widget widget-btn-left">
                        <a href="plan-trip.php" class="button border with-icon button-left"><span class="header-icon header-icon1"><i class="glyphicon glyphicon-map-marker"></i></span> Plan Your Trip</a>
                    </div>
                    <div class="header-widget widget-btn-right">
                        <a href="my-cart.php" class="button border with-icon button-right"><span class="header-icon header-icon2"><i class="glyphicon glyphicon-shopping-cart"></i></span> <span class="cart-item-count"><?php
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
                <div class="nav-top hidden-xs">
                    <nav id="navigation1" class="style-1 hidden-xs">
                        <ul id="responsive">
                            <?php
                            if (isset($_SESSION['id'])) {
                                ?>
                                <li><a href="#"><img src="upload/visitor/-418140250_190785000656_1543990783_n.jpg" alt=""/> My Profile</a>
                                    <?php
                                } else {
                                    ?>
                                <li><a href="#"><i class="glyphicon glyphicon-user"></i> My Profile</a>
                                    <?php
                                }
                                ?>
                                <ul>
                                    <li><a href="profile.php">Login Now</a></li>
                                    <li><a href="profile.php">Join Now</a></li>
                                    <li><a href="../visitor/profile.php">Driver Login</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <div class="header-widget widget-btn-right">
                        <a href="my-cart.php" class="button border with-icon button-right"><span class="header-icon header-icon2"><i class="glyphicon glyphicon-shopping-cart"></i></span><span class="cart-item-count"><?php
                                if ($count == 1) {
                                    echo '1 item';
                                } else {
                                    echo $count . ' items';
                                };
                                ?>
                            </span>
                        </a>
                    </div>
                    <div class="header-widget widget-btn-left">
                        <a href="plan-trip.php" class="button border with-icon button-left"><span class="header-icon header-icon1"><i class="glyphicon glyphicon-map-marker"></i></span><span> Plan Your Trip</span></a>
                    </div>

                </div>
                <div class="nav-bottom">
                    <!-- Main Navigation -->
                    <nav id="navigation" class="style-1">
                        <ul id="responsive">
                            <li><a class="current" href="./">Home</a></li>
                            <li><a href="../destination-type.php">Destinations</a></li>
                            <li><a href="../all-cities.php">Cities</a></li>
                            <li><a href="../tour-packages-type.php">Packages</a></li>
                            <li><a href="../drivers-page.php">Drivers</a></li>
                            <li><a href="../blog.php">Blog</a></li>
                            <li><a href="../offers.php">Offer</a></li>
                            <?php
                            if (isset($_SESSION['id'])) {
                                ?>
                                <li class="header-pro-pic hidden-lg hidden-md hidden-sm"><a href="#"><img src="upload/visitor/-418140250_190785000656_1543990783_n.jpg" alt=""/> My Profile</a>
                                    <?php
                                } else {
                                    ?>
                                <li class="header-pro-pic hidden-lg hidden-md hidden-sm"><a href="#"><i class="glyphicon glyphicon-user"></i> My Profile</a>
                                    <?php
                                }
                                ?>
                                <ul>
                                    <li><a href="visitor/profile.php">Login Now</a></li>
                                    <li><a href="visitor/profile.php">Join Now</a></li>
                                    <li><a href="driver/profile.php">Driver Login</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <div class="clearfix"></div>
                    <!-- Main Navigation / End -->
                </div>

            </div>
            <!-- Right Side Content / End -->
            <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

                <div class="small-dialog-header">
                    <h3>Sign In</h3>
                </div>

                <!--Tabs -->
                <div class="sign-in-form style-1">

                    <ul class="tabs-nav">
                        <li class=""><a href="#tab1">Log In</a></li>
                        <li><a href="#tab2">Register</a></li>
                    </ul>

                    <div class="tabs-container alt">

                        <!-- Login -->
                        <div class="tab-content" id="tab1" style="display: none;">
                            <form method="post" class="login">

                                <p class="form-row form-row-wide">
                                    <label for="username">Username:
                                        <i class="im im-icon-Male"></i>
                                        <input type="text" class="input-text" name="username" id="username" value="" />
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="password">Password:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password" id="password"/>
                                    </label>
                                    <span class="lost_password">
                                        <a href="#" >Lost Your Password?</a>
                                    </span>
                                </p>

                                <div class="form-row">
                                    <input type="submit" class="button border margin-top-5" name="login" value="Login" />
                                    <div class="checkboxes margin-top-10">
                                        <input id="remember-me" type="checkbox" name="check">
                                        <label for="remember-me">Remember Me</label>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <!-- Register -->
                        <div class="tab-content" id="tab2" style="display: none;">

                            <form method="post" class="register">

                                <p class="form-row form-row-wide">
                                    <label for="username2">Username:
                                        <i class="im im-icon-Male"></i>
                                        <input type="text" class="input-text" name="username" id="username2" value="" />
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="email2">Email Address:
                                        <i class="im im-icon-Mail"></i>
                                        <input type="text" class="input-text" name="email" id="email2" value="" />
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="password1">Password:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password1" id="password1"/>
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="password2">Repeat Password:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password2" id="password2"/>
                                    </label>
                                </p>

                                <input type="submit" class="button border fw margin-top-10" name="register" value="Register" />

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Sign In Popup / End -->


        </div>
    </div>
    <!-- Header / End -->

</header>
<div class="clearfix"></div>
