
<!DOCTYPE html>
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Sri Lanka Travel Helper</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/style.css">
    <link href="css/custom.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/colors/main.css" id="colors">
<!--    <link href="assets/css/base.css" rel="stylesheet" type="text/css"/>-->

</head>

<body>
    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header Container
        ================================================== -->
        <?php include './header.php'; ?>
        <!-- Header Container / End -->
        <!-- Banner
               ================================================== -->
        <div class="main-search-container dark-overlay">
            <div class="main-search-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Let Make Meomorable Holiday</h2>
                            <h4>Expolore top-rated attractions, activities, events and more</h4>

                            <div class="main-search-input">

                                <div class="main-search-input-item">
                                    <input type="text" placeholder="What are you looking for?" value=""/>
                                </div>

                                <div class="main-search-input-item location">
                                    <div id="autocomplete-container">
                                        <input id="autocomplete-input" type="text" placeholder="Location">
                                    </div>
                                    <a href="#"><i class="fa fa-map-marker"></i></a>
                                </div>

                                <div class="main-search-input-item">
                                    <select data-placeholder="All Categories" class="chosen-select" >
                                        <option>All Categories</option>	
                                        <option>Wild</option>
                                        <option>Pristine</option>
                                        <option>Scenic</option>
                                        <option>Heritage</option>
                                        <option>Festive</option>
                                    </select>
                                </div>

                                <button class="button" onclick="window.location.href = '#'">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Video -->
            <div class="video-container">
                <video poster="images/main-search-video-poster.jpg" loop autoplay muted>
                    <source src="images/main-search-video.mp4" type="video/mp4">
                </video>
            </div>
        </div>
        <!-- Info Section -->
        <div class="container ">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="headline centered margin-top-45">
                        Plan The Vacation of Your Dreams 
                    </h2>
                </div>
            </div>
            <div class="row icons-container padding-bottom-20">
                <!-- Stage -->
                <div class="col-md-4">
                    <div class="icon-box-2 with-line">
                        <i class="im im-icon-Map2"></i>
                        <h3>Find Interesting Place</h3>
                        <p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
                    </div>
                </div>
                <!-- Stage -->
                <div class="col-md-4">
                    <div class="icon-box-2 with-line">
                        <i class="im im-icon-Mail-withAtSign"></i>
                        <h3>24/7/365 Help</h3>
                        <p>Maecenas pulvinar, risus in facilisis dignissim, quam nisi hendrerit nulla, id vestibulum metus nullam viverra porta purus.</p>
                    </div>
                </div>

                <!-- Stage -->
                <div class="col-md-4">
                    <div class="icon-box-2">
                        <i class="im im-icon-Checked-User"></i>
                        <h3>Make a Reservation</h3>
                        <p>Faucibus ante, in porttitor tellus blandit et. Phasellus tincidunt metus lectus sollicitudin feugiat pharetra consectetur.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Info Section / End -->
        <!-- Content
        ================================================== -->
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="headline centered margin-top-45 margin-bottom-45">
                        Popular Destinations of Sri Lanka
                    </h3>
                </div>
            </div>
        </div>
        <!-- Categories Carousel -->
        <div class="fullwidth-carousel-container margin-bottom-50 ">
            <div class="fullwidth-slick-carousel category-carousel">
                <!-- Item -->
                <div class="fw-carousel-item">
                    <div class="category-box-container half">
                        <a href="#" class="category-box" data-background-image="images/destination/Whale-watching.jpg">
                            <div class="category-box-content">
                                <h3>Whale Watching</h3>
                                <span>64 views</span>
                            </div>
                            <span class="category-box-btn">Browse</span>
                        </a>
                    </div>
                    <div class="category-box-container half">
                        <a href="#" class="category-box" data-background-image="images/destination/river.jpg">
                            <div class="category-box-content">
                                <h3>River Safari</h3>
                                <span>14 views</span>
                            </div>
                            <span class="category-box-btn">Browse</span>
                        </a>
                    </div>
                </div>
                <div class="fw-carousel-item">
                    <div class="category-box-container">
                        <a href="#" class="category-box" data-background-image="images/destination/cycling1.jpg">
                            <div class="category-box-content">
                                <h3>Cycling</h3>
                                <span>67 views</span>
                            </div>
                            <span class="category-box-btn">Browse</span>
                        </a>
                    </div>
                </div>
                <div class="fw-carousel-item">
                    <div class="category-box-container">
                        <a href="#" class="category-box" data-background-image="images/destination/whild-life.jpg">
                            <div class="category-box-content">
                                <h3>Whildlife Safari </h3>
                                <span>27 views</span>
                            </div>
                            <span class="category-box-btn">Browse</span>
                        </a>
                    </div>
                </div>

                <!-- Item -->
                <div class="fw-carousel-item">
                    <div class="category-box-container">
                        <a href="#" class="category-box" data-background-image="images/destination/6.jpg">
                            <div class="category-box-content">
                                <h3>Surfings</h3>
                                <span>22 views</span>
                            </div>
                            <span class="category-box-btn">Browse</span>
                        </a>
                    </div>
                </div>
                <div class="fw-carousel-item">
                    <div class="category-box-container">
                        <a href="#" class="category-box" data-background-image="images/destination/diving.jpg">
                            <div class="category-box-content">
                                <h3>
                                    Diving & Snorkeling </h3>
                                <span>130 views</span>
                            </div>
                            <span class="category-box-btn">Browse</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <!-- Categories Carousel / End -->
        <!-- Parallax -->
        <div class="parallax"
             data-background="images/banner/Travel1.jpg"
             data-color="#36383e"
             data-color-opacity="0.6"
             data-img-width="800"
             data-img-height="505">

            <!-- Infobox -->
            <div class="text-content white-font">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-sm-8">
                            <h2>Explore Sri Lanaka</h2>
                            <h4 style="font-size: 24px;
                                font-weight: 300;
                                color: #fff;
                                padding-top: 0px;
                                line-height: 32px">Determine Your Destination</h4>
                            <p style="font-size: 18px; font-weight: 200;line-height: 29px!important">We’re full-service, local agents who know how to find people and home each together. We use online tools with an unmatched search capability to make you smarter and faster.</p>
                            <a href="#" class="button margin-top-25">Plan Your Trip</a>
                        </div>
                        <div class="col-lg-7 col-sm-8">
                            <iframe width="677" height="377" src="https://www.youtube.com/embed/s8VNJ88AFWw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> 
                        </div>

                    </div>
                </div>
            </div>
            <!-- Infobox / End -->
        </div>
        <!-- Parallax / End -->
        <!-- Recent Blog Posts -->
        <section class="fullwidth  padding-top-45 padding-bottom-50" data-background-color="#fff">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="headline centered margin-bottom-45">
                            Best Tailor Made Tour Packages
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <!-- Blog Post Item -->
                    <div class="col-md-4">
                        <a href="#" class="blog-compact-item-container">
                            <div class="blog-compact-item">
                                <img src="images/tour/Best-of-Sri-Lanka-Galle-Galle-Fort-1.jpg" alt="">
                                <span class="blog-item-tag" style="background: #0dce38!important">View</span>
                                <div class="blog-compact-item-content">
                                    <ul class="blog-post-tags">
                                        <li><div class="star-rating-fa text-right"> 
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <div class="rating-counter-tour">(160 reviews)</div><br/>
                                            </div></li>
                                    </ul>
                                    <h3>Galle City</h3>
                                    <p>Sed sed tristique nibh iam porta volutpat finibus. Donec in aliquet urneget mattis lorem. Pellentesque pellentesque.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Blog post Item / End -->
                    <!-- Blog Post Item -->
                    <div class="col-md-4">
                        <a href="#" class="blog-compact-item-container">
                            <div class="blog-compact-item">
                                <img src="images/tour/3.jpg" alt="">
                                <span class="blog-item-tag" style="background: #0dce38!important">View</span>
                                <div class="blog-compact-item-content">
                                    <ul class="blog-post-tags">
                                        <li><div class="star-rating-fa text-right"> 
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <div class="rating-counter-tour">(30 reviews)</div><br/>
                                            </div></li>
                                    </ul>
                                    <h3>Kandy City</h3>
                                    <p>Sed sed tristique nibh iam porta volutpat finibus. Donec in aliquet urneget mattis lorem. Pellentesque pellentesque.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Blog post Item / End -->
                    <!-- Blog Post Item -->
                    <div class="col-md-4">
                        <a href="#" class="blog-compact-item-container">
                            <div class="blog-compact-item">
                                <img src="images/tour/4.jpg" alt="">
                                <span class="blog-item-tag" style="background: #0dce38!important">View</span>
                                <div class="blog-compact-item-content">
                                    <ul class="blog-post-tags">
                                        <li><div class="star-rating-fa text-right"> 
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <div class="rating-counter-tour">(25 reviews)</div><br/>
                                            </div></li>
                                    </ul>
                                    <h3>Sigiriya Rock Fortress</h3>
                                    <p>Sed sed tristique nibh iam porta volutpat finibus. Donec in aliquet urneget mattis lorem. Pellentesque pellentesque.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Blog post Item / End -->
                    <div class="col-md-12 centered-content">
                        <a href="#" class="button border margin-top-10">View More</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Recent Blog Posts / End -->
        <div class="parallax"
             data-background="images/banner/banner-3.jpg"
             data-color="#36383e"
             data-color-opacity="0.6"
             data-img-width="800"
             data-img-height="505" id="driver">
            <section class="fullwidth  padding-bottom-30" >

                <!-- Info Section -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 margin-top-70">
                            <h3 class="headline centered text-content white-font" style="padding:0px 0px!important;">
                                Testimonials
                                <span class="margin-top-25">We collect reviews from our users so you can get an honest opinion of what an experience with our website are really like!</span>
                            </h3>
                        </div>
                    </div>

                </div>
                <!-- Info Section / End -->
                <!-- Categories Carousel -->
                <div class="fullwidth-carousel-container ">
                    <div class="testimonial-carousel testimonials">

                        <!-- Item -->
                        <div class="fw-carousel-review">
                            <div class="testimonial-box">
                                <div class="testimonial">Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation is on the runway heading towards a streamlined cloud solution user generated content.</div>
                            </div>
                            <div class="testimonial-author">
                                <img src="images/happy-client-01.jpg" alt="">
                                <h4>Jennie Smith <span>Canada</span></h4>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="fw-carousel-review">
                            <div class="testimonial-box">
                                <div class="testimonial">Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop.</div>
                            </div>
                            <div class="testimonial-author">
                                <img src="images/happy-client-02.jpg" alt="">
                                <h4>Tom Baker <span>China</span></h4>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="fw-carousel-review">
                            <div class="testimonial-box">
                                <div class="testimonial">Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view.</div>
                            </div>
                            <div class="testimonial-author">
                                <img src="images/happy-client-03.jpg" alt="">
                                <h4>Jack Paden <span>America</span></h4>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Categories Carousel / End -->
            </section>
        </div>
        <!-- Flip banner -->
        <a href="#" class="flip-banner parallax " data-background="images/banner/banner-3.jpg" data-color="#0dce38" data-color-opacity="0.85" data-img-width="2500" data-img-height="1666">
            <div class="flip-banner-content">
                <h2 class="flip-visible">Expolore top-rated attractions nearby</h2>
                <h2 class="flip-hidden">View More<i class="sl sl-icon-arrow-right"></i></h2>
            </div>
        </a>
        <!-- Flip banner / End -->
        <!-- Fullwidth Section -->
        <section class="fullwidth  padding-top-45 padding-bottom-45" data-background-color="#f8f8f8">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="headline centered margin-bottom-45">
                            Top Rated Drivers
                        </h3>
                    </div>
                    <div class="col-md-12">
                        <div class="simple-slick-carousel dots-nav">

                            <!-- Listing Item -->
                            <div class="carousel-item">
                                <a href="#" class="listing-item-container">

                                    <div class="listing-item">
                                        <img src="images/drivers/banner/driver-banner-1.jpg" alt=""> 
                                    </div>

                                    <div class="img-pad"> 
                                        <img src="images/user-avatar.jpg" class="img-circle driver-list"/>
                                        <!--                                        
                                                                                <div class="star-rating " data-rating="4.5"> 
                                                                                    <div class="rating-counter">(12 reviews)</div><br/>
                                        
                                                                                </div>-->

                                    </div>
                                    <div class="driver-name text-left"> 
                                        Driver Name
                                    </div>
                                    <div class="star-rating-fa text-right"> 
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <div class="rating-counter">(12 reviews)</div><br/>
                                    </div>

                                    <div style="margin-top: 15px;padding-bottom: 7px;">
                                        <p class="text-center " id="">
                                            Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. 
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="#" class="listing-item-container">

                                    <div class="listing-item">
                                        <img src="images/drivers/banner/driver-banner-2.jpg" alt=""> 
                                    </div>

                                    <div class="img-pad"> 
                                        <img src="images/user-avatar.jpg" class="img-circle driver-list"/>
                                        <!--                                        
                                                                                <div class="star-rating " data-rating="4.5"> 
                                                                                    <div class="rating-counter">(12 reviews)</div><br/>
                                        
                                                                                </div>-->

                                    </div>
                                    <div class="driver-name text-left"> 
                                        Driver Name
                                    </div>
                                    <div class="star-rating-fa text-right"> 
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <div class="rating-counter">(12 reviews)</div><br/>
                                    </div>

                                    <div style="margin-top: 15px;padding-bottom: 7px;">
                                        <p class="text-center " id="">
                                            Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. 
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="#" class="listing-item-container">

                                    <div class="listing-item">
                                        <img src="images/drivers/banner/driver-banner-3.jpg" alt=""> 
                                    </div>

                                    <div class="img-pad"> 
                                        <img src="images/user-avatar.jpg" class="img-circle driver-list"/>
                                        <!--                                        
                                                                                <div class="star-rating " data-rating="4.5"> 
                                                                                    <div class="rating-counter">(12 reviews)</div><br/>
                                        
                                                                                </div>-->

                                    </div>
                                    <div class="driver-name text-left"> 
                                        Driver Name
                                    </div>
                                    <div class="star-rating-fa text-right"> 
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <div class="rating-counter">(12 reviews)</div><br/>
                                    </div>
                                    <div style="margin-top: 15px;padding-bottom: 7px;">
                                        <p class="text-center " id="">
                                            Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. 
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="#" class="listing-item-container">

                                    <div class="listing-item">
                                        <img src="images/drivers/banner/driver-banner-4.jpg" alt=""> 
                                    </div>

                                    <div class="img-pad"> 
                                        <img src="images/user-avatar.jpg" class="img-circle driver-list"/>
                                        <!--                                        
                                                                                <div class="star-rating " data-rating="4.5"> 
                                                                                    <div class="rating-counter">(12 reviews)</div><br/>
                                        
                                                                                </div>-->

                                    </div>
                                    <div class="driver-name text-left"> 
                                        Driver Name
                                    </div>
                                    <div class="star-rating-fa text-right"> 
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <div class="rating-counter">(12 reviews)</div><br/>
                                    </div>

                                    <div style="margin-top: 15px;padding-bottom: 7px;">
                                        <p class="text-center " id="">
                                            Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. 
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include './footer.php'; ?>
        <!-- Back To Top Button -->
        <div id="backtotop"><a href="#"></a></div>
    </div>
    <!-- Wrapper / End -->
    <!-- Scripts
       ================================================== -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
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

</body>
</html>
