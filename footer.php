<?php
$destinations = '';
$count1 = 0;
$count = '';
if (isset($_SESSION['destination_cart'])) {
    $destinationscart = $_SESSION['destination_cart'];
    $count1 = count($destinationscart);
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

foreach ($destinationscart as $des) {
    $destians = new Destination($des);
//    $spentime .= "'" . $destians->spend_time. "',";
    $spendtime += $destians->spend_time;
}
?>




<div id="guideline" class="dark" >
    <!-- Main -->
    <div class="container">
        <div class="row">
            <h3 class="headline centered margin-top-10 margin-bottom-10">
                How It Work - Tour Sri Lanka 
            </h3>
            <div class="row icons-container padding-bottom-30 popguide">
                <div class="col-md-4 col-sm-4" data-aos="fade-right" data-aos-duration="3500" >
                    <div class="work-process">
                        <div class="guide-img">
                            <img src="images/icons/added-cart.png" class="img-responsive" alt="">
                        </div>
                        <h4> You Select<?php
                            if ($count == 1) {
                                echo ' 1 ';
                            } else {
                                echo $count . ' ';
                            }
                            ?>Locations</h4>
                        <p></p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="300">

                    <div class="work-process">
                        <div class="guide-img">
                            <img src="images/icons/spend-time.png" class="img-responsive" alt="">
                        </div>
                        <h4>You Spend <?php echo $spendtime / 60 ?> Hours </h4>
                        <p></p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4" data-aos="fade-left" data-aos-duration="3500" data-aos-delay="600">
                    <?php if ($spendtime == 0) {
                        ?>   
                        <div class="work-process ">
                            <div class="guide-img">
                                <img src="images/icons/plan.png" class="img-responsive" alt="">
                            </div>
                            <div class="col-md-12">
                                <a href="plan-trip.php" ><button id="send-destinations" class="button border with-icon submit add-to-cart btncolor14 btn-res-top">Plan Your Trip</button></a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="work-process ">
                            <div class="guide-img">
                                <img src="images/icons/booknow.png" class="img-responsive" alt="">
                            </div>
                            <div class="col-md-12">
                                <a href="booking.php?tailormade"><button id="send-destinations" class="button border with-icon submit add-to-cart btncolor14 btn-res-top">Book Now</button></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer
================================================== -->
<div id="footer" class="dark" >
    <!-- Main -->
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-3 footerdes" data-aos="fade-up" data-aos-duration="3500">
                <img class="footer-logo" src="images/logo/tour-logo-1.png" alt="">
                <br><br>
                <div class="hidden-sm">
                    <p>Tour Sri Lanka is an ideal platform by serving the professional travel and tour packages. We arrange and organize your travel desire with beyond expectation. Everything has been arranged upon on your requirements and also you can plan a trip on your desire. Tour Sri Lanka is a place where can reach what you have dreamed.</p>
                </div>
                <div class="hidden-lg hidden-md hidden-xs">
                    <p>Tour Sri Lanka is an ideal platform by serving the professional travel and tour packages. We arrange and organize your travel desire with beyond expectation.</p>
                </div>


            </div>

            <div class="col-md-4 col-sm-5" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="300">
                <h4>Helpful Links</h4>
                <ul class="footer-links">
                    <li><a href="./">Home</a></li>
                    <li><a href="destination-type.php">Destinations</a></li>
                    <li><a href="tour-packages-type.php">Packages</a></li>
                    <li><a href="drivers-page.php">Drivers</a></li>
                    <li><a href="about.php">About Us</a>

                </ul>

                <ul class="footer-links">
                    <li><a href="contact.php">Contact Us</a>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="visitor/profile.php">Sign In</a></li>
                    <li><a href="plan-trip.php">Plan Your Trip</a></li>
                    <li><a href="my-cart.php">My Cart</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>		

            <div class="col-md-3  col-sm-4" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="600">
                <h4>Contact Us</h4>
                <div class="text-widget1">
                </div>
                <div class="text-widget1">
                    Phone: <span> <a href="tel:+94 71 666 7557" style="text-decoration: none;color:#888;"> +94 71 666 7557 </a></span><br>
                </div>
                <div class="text-widge1t">
                    E-Mail:<span> <a href="mailto:info@toursrilanka.travel" style="text-decoration: none;color:#888;"> info@toursrilanka.travel</a></span><br>
                </div>

                <ul class="social-icons margin-top-20">
                    <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
                    <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                    <li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li>
                </ul>

            </div>

        </div>

        <!-- Copyright -->
        <div class="row">
            <div class="col-md-12 footerlast">
                <div class="copyrights">© 2019 Tour Sri Lanka. All Rights Reserved.</div>
            </div>
        </div>

    </div>

</div>
<!-- Footer / End -->