<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<head>
    <!-- Basic Page Needs
       ================================================== -->
    <title>Contact Us || Tour Sri Lanka</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
       ================================================== -->
    <link href="images/logo/favicon.png" rel="icon" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/custom.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/colors/main.css" id="colors">
    <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="contact-form/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/aos.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header Container
               ================================================== -->
        <?php include './header.php'; ?>
        <div class="container-fluid about-bg ">
            <div class="container">
                <div class="rl-banner" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="3500">
                    <h2 class="tp">Contact</h2>
                    <ul>
                        <li><a href="./">Home</a></li>
                        <li><span class="active">Contact</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container padding-bottom-65 padding-top-70">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="600">
                    <h4 class="headline margin-bottom-30">Find Us There</h4>
                    <div class="sidebar-textbox">
                        <p>Collaboratively administrate channels whereas virtual. Objectively seize scalable metrics whereas proactive e-services.</p>
                        <ul class="contact-details">
                            <li><i class="im im-icon-Phone-2"></i> <strong>Phone:</strong> <span>+94 71 666 7557 </span></li>
                            <li><i class="im im-icon-Fax"></i> <strong>Fax:</strong> <span>+94 91 666 7557</span></li>
                            <li><i class="im im-icon-Globe"></i> <strong>Web:</strong> <span><a href="#">www.toursrilanka.travel</a></span></li>
                            <li><i class="im im-icon-Envelope"></i> <strong>E-Mail:</strong> <span><a href="#">info@toursrilanka.travel</a></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8" data-aos="fade-up" data-aos-duration="3500" data-aos-delay="800">
                    <section id="contact">
                        <h4 class="headline margin-bottom-35">Contact Form</h4>
                        <div id="contact-message"></div> 
                        <!--                        <form method="post" action="http://www.vasterad.com/themes/listeo_updated/contact.php" name="contactform" id="contactform" autocomplete="on">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div>
                                                                <input name="name" type="text" id="name" placeholder="Your Name" required="required" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div>
                                                                <input name="email" type="email" id="email" placeholder="Email Address" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input name="subject" type="text" id="subject" placeholder="Subject" required="required" />
                                                    </div>
                                                    <div>
                                                        <textarea name="comments" cols="40" rows="3" id="comments" placeholder="Message" spellcheck="true" required="required"></textarea>
                                                    </div>
                                                    <input type="submit" class="button border with-icon submit" id="submit" value="Submit Message" />
                                                </form>-->
                        <div class="contact-form">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <input type="text" name="txtFullName" id="txtFullName" class="form-control input-validater" placeholder="Your Name">
                                    <span id="spanFullName" ></span>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <input type="text" name="txtEmail" id="txtEmail" class="form-control input-validater"  placeholder="E-mail">
                                    <span id="spanEmail" ></span>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <input type="text" name="txtCountry"  id="txtCountry" class="form-control input-validater"  placeholder="Your Country">
                                    <span id="spanCountry" ></span>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <input type="text" name="txtPhone" id="txtPhone" class="form-control input-validater" placeholder="Contact number">
                                </div>

                                <div class="col-sm-12 col-xs-12">
                                    <input type="text" name="txtSubject"  id="txtSubject" class="form-control input-validater" placeholder="subject">
                                    <span id="spanSubject" ></span>

                                    <textarea name="txtMessage"  id="txtMessage" rows="6" class="form-control" placeholder="write message here"></textarea>
                                    <span id="spanMessage" ></span>

                                    <div class="row form-group">
                                        <div class="col-sm-6 col-xs-12">
                                            <br>
                                            <label for="comment">Security Code:</label>
                                            <span id="star">*</span> 
                                            <input type="text" name="captchacode" id="captchacode" class="form-control input-validater" placeholder="Enter the security code >> ">
                                            <span id="capspan" ></span> 
                                        </div>   
                                        <div class="col-sm-6 col-xs-12 capmargin "> 
                                            <?php include("./contact-form/captchacode-widget.php"); ?> 
                                        </div>  

                                        <div class="col-xs-12 col-sm-6 ">
                                            <div class="col-sm-4">
                                                <div class="div-check" >
                                                    <img src="contact-form/img/checking.gif" id="checking"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 text-right">

                                            </div> 
                                        </div>
                                    </div> 
                                    <div class="btncolor5">
                                    <button type="submit" id="btnSubmit" class="button border with-icon submit">SEND YOUR MESSAGE</button>
                                    <div id="dismessage" align="center"></div>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </section>
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
    <script src="contact-form/scripts.js" type="text/javascript"></script>
    <script src="scripts/aos.js" type="text/javascript"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
