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
$position = '';
if (isset($_SESSION['position'])) {
    $position = $_SESSION['position'];
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
                    <a href="./"><img src="images/logo/logo.png" alt=""></a>
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
                <div class="nav-top hidden-lg hidden-md hidden-sm" >
                    <div class="header-cart-small  widget-btn-left widget-btn-left-correction plan-trip ">
                        <a class=" button-left" href="plan-trip.php">
                            <button class="button border with-icon submit btncolor16">Plan Your Trip</button>
                        </a>
                    </div>
                    <div class="  header-cart-small widget-btn-right widget-btn-right-correction">
                        <a class="button-right " href="my-cart.php">
                            <span class="icon  lnr-cart">
                                <img src="images/icons/shopping-cart(2).png" alt=""/>
                            </span>
                            <div class="f-title"><span class="cart-number cart-item-count"><?php
                                    if ($count == 1) {
                                        echo '1 ';
                                    } else {
                                        echo $count . ' ';
                                    }
                                    ?>
                                </span>
                            </div>
                            <span class="title" ></span>
                        </a>
                    </div>


                </div>
                <div class="nav-top hidden-xs">

                    <div class="col-md-5"></div>
                    <div class="col-md-7">
                        <div class="col-md-4">
                            <div class="header-cart  plan-your-trip" >
                                <a href="plan-trip.php">
                                    <span class="icon lnr-cart">
                                        <img src="images/icons/placeholder.png" alt=""/>
                                    </span>
                                    <div class="f-title"></div>
                                    <span class="title title-border">Plan Your Trip</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class=" header-cart shopping-cart" >
                                <a href="my-cart.php">
                                    <span class="icon  lnr-cart"> 
                                        <img src="images/icons/shopping-cart(2).png" alt=""/>
                                    </span>
                                    <div class="f-title"><span class="cart-number cart-item-count"><?php
                                            if ($count == 1) {
                                                echo '1 ';
                                            } else {
                                                echo $count . ' ';
                                            };
                                            ?>
                                        </span>
                                    </div>
                                    <span class="title title-border">My Cart </span>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="header-cart user-pro">
                                <nav id="navigation1" class="style-1 hidden-xs">
                                    <ul id="responsive">
                                        <?php
                                        if (isset($_SESSION['id']) && $position === 'visitor') {
                                            $VIS = new Visitor($_SESSION['id']);
                                            if ($VIS->facebookID) {
                                                ?>
                                                <li>
                                                    <a class="user-item" href="#">  <span class="icon lnr lnr-cart">
                                                            <img src="<?php echo $VIS->profile_picture; ?>" alt=""/>
                                                        </span>

                                                        <span class="title">My Profile </span></a>

                                                    <?php
                                                } else {
                                                    ?>
                                                <li>
                                                    <a class="user-item" href="#">  <span class="icon lnr lnr-cart">
                                                            <img  src="upload/visitor/<?php echo $VIS->profile_picture; ?>" alt=""/>
                                                        </span>

                                                        <span class="title">My Profile </span></a>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                            <li><a class="user-item" href="#">  <span class="icon lnr lnr-cart">
                                                        <img id="nav-img" src="images/icons/profile.png" alt=""/>
                                                    </span>

                                                    <span class="title">My Profile </span></a>
                                                <?php
                                            }
                                            ?>
                                            <ul>   <?php
                                                if (isset($_SESSION['id']) && $position === 'visitor') {
                                                    ?>
                                                    <li><a href="visitor/post-and-get/logout.php">Sign Out</a></li>

                                                <?php } elseif (isset($_SESSION['id']) && $position === 'driver') { ?>

                                                    <li><a href="driver/post-and-get/logout.php">Sign Out</a></li>
                                                <?php } else { ?>
                                                    <li><a href="visitor/profile.php">Join Now</a></li>
                                                <?php } ?>   

                                                <li><a href="driver/profile.php">Driver Sign In</a></li>
                                            </ul>
                                        </li> 
                                    </ul>
                                </nav>

                            </div>
                        </div>
                    </div>




                </div>
                <div class="nav-bottom">
                    <!-- Main Navigation -->
                    <nav id="navigation" class="style-1">
                        <ul id="responsive">
                            <li><a href="./">Home</a></li>
                            <li><a href="destination-type.php">Destinations</a></li>
                            <li><a href="all-cities.php">Cities</a></li>
                            <li><a href="tour-packages-type.php">Packages</a></li>
                            <li><a href="drivers-page.php">Drivers</a></li>
                            <li><a href="blog.php">Blog</a></li>
                            <li><a href="offers.php">Offer</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                            <?php
                            if (isset($_SESSION['id']) && $position === 'visitor') {

                                $VIS = new Visitor($_SESSION['id']);
                                if (isset($VIS->facebookID)) {
                                    ?>
                                    <li class="header-pro-pic hidden-lg hidden-md"><a href="#"><img src="<?php echo $VIS->profile_picture; ?>" alt=""/> My Profile</a>
                                        <?php
                                    } else {
                                        ?>
                                    <li class = "header-pro-pic hidden-lg hidden-md"><a href = "#"><img src = "upload/visitor/<?php echo $VIS->profile_picture; ?>" alt = ""/> My Profile</a>
                                        <?php
                                    }
                                } else {
                                    ?>
                                <li class="header-pro-pic hidden-lg hidden-md"><a href="#"><i class="glyphicon glyphicon-user"></i> My Profile</a>
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

                    <div class="tabs-container alt" data-aos="fade-up" data-aos-duration="3000" >

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
                        <div class="tab-content" data-aos="fade-up" data-aos-duration="3000"  id="tab2" style="display: none;" >

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
