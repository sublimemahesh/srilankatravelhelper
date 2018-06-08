<!DOCTYPE html>

<html>
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
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/set1.css" rel="stylesheet" type="text/css"/>
<!--        <style>
            .tour{
                border: 1px solid  #f5eded;

                cursor: pointer;
            }


            .hover03 figure:hover img {

            }
            .tour-title{
                font-size: 16px;
                color:#42e683;
                font-weight: bold;
                text-align: center;

            }

            .tour-item a:hover{
                text-decoration: none;
            }
            .tour-item a:active{
                text-decoration: none;
            }
            .tour-description{
                text-align:center ;
                margin: 1% 1% 1% 1%;
                color :#000000;
                font-size: 12px;

            }


        </style>-->
        <style>
            /*===================================================== 20.home version 2 tour-package section css goes here =======================================================*/
 .tour-package-bg {
     background: transparent url("../images/bgimage/package.jpg") repeat scroll 0 0;
     background-repeat: no-repeat;
     background-size: cover;
     background-position: center center;
     position: relative;
     z-index: 1;
     overflow: hidden;
}
 .tour-package-bg:before {
     position: absolute;
     content: "";
     left: 0;
     width: 100%;
     height: 100%;
     top: 0;
     background: rgba(0, 0, 0, 0.5);
     z-index: -1;
}
 .tour-package-bg:hover .owl-nav div.owl-prev {
     opacity: 1;
     left: -70px;
}
 .tour-package-bg:hover .owl-nav div.owl-next {
     opacity: 1;
     right: -70px;
}
 .popular-packages-carasoul.owl-carousel.owl-loaded.owl-drag {
     clear: both;
}
 .single-package-carasoul {
     overflow: hidden;
     position: relative;
     margin-bottom: 30px;
}
 .single-package-carasoul .package-location {
     position: relative;
}
 .single-package-carasoul .package-location span {
     background: #37b721 none repeat scroll 0 0;
     bottom: 0;
     color: #ffffff;
     font-size: 20px;
     font-weight: 600;
     height: 40px;
     left: 0;
     line-height: 43px;
     position: absolute;
     text-align: center;
     transition: all 0.3s ease-in-out 0s;
     width: 100px;
     z-index: 99;
}
 .single-package-carasoul .package-details {
     background: #ffffff;
     border-radius: 0 0 4px 4px;
}
 .single-package-carasoul .package-details .package-places {
     padding: 25px;
}
 .single-package-carasoul .package-details .package-places h4 {
     padding-bottom: 7px;
     color: #454545;
     font-size: 19px;
     font-weight: 600;
}
 .single-package-carasoul .package-details .package-places > span {
     color: #727272;
     font-size: 15px;
     font-weight: 500;
}
 .single-package-carasoul .package-details .package-places > span i {
     margin-right: 10px;
}
 .single-package-carasoul .package-details .package-places .details {
     margin-top: 18px;
}
 .single-package-carasoul .package-details .package-places .details p {
     font-weight: 400;
     font-size: 15px;
     color: #727272;
     line-height: 25px;
     margin: 0;
}
 .single-package-carasoul .package-details .package-places .details p span {
     font-size: 15px;
     font-weight: 600;
     color: #454545;
}
 .single-package-carasoul .package-details .package-ratings-review {
     border-top: 1px solid #37b721;
     padding: 14px 0;
     position: relative;
}
 .single-package-carasoul .package-details .package-ratings-review .two-column {
     padding: 0 25px;
}
 .single-package-carasoul .package-details .package-ratings-review .two-column li {
     display: inline-block;
}
 .single-package-carasoul .package-details .package-ratings-review .two-column li:last-child {
     float: right;
}
 .single-package-carasoul .package-details .package-ratings-review .two-column li i {
     color: #ffef3b;
     font-size: 21px;
}
 .single-package-carasoul .package-details .package-ratings-review .two-column li p {
     font-weight: 400;
     font-size: 15px;
     color: #727272;
}
 .single-package-carasoul .package-long-btn {
     background: #37b721 none repeat scroll 0 0;
     display: block;
     width: 100%;
     text-align: center;
     padding: 15px 0;
     position: absolute;
     bottom: -63px;
     opacity: 0;
     visibility: hidden;
     transition: all ease-in-out 0.3s;
     right: 0;
     font-size: 17px;
     font-weight: 500;
}
 .single-package-carasoul .package-long-btn a {
     color: #ffffff;
     text-transform: uppercase;
}
 .single-package-carasoul:hover .package-long-btn {
     opacity: 1;
     visibility: visible;
     bottom: -1px;
}
 .single-package-carasoul:hover .package-location span {
     background: #f17b37;
}
 .owl-nav div {
     background: #37b721 none repeat scroll 0 0;
     color: #ffffff;
     font-size: 20px;
     height: 50px;
     left: -200px;
     line-height: 50px;
     position: absolute;
     text-align: center;
     top: 50%;
     transform: translateY(-50%);
     width: 50px;
     opacity: 0;
     transition: all 0.3s ease-out;
     border-radius: 5px;
}
 .owl-nav div:hover {
     background: #f17b37;
}
 .owl-nav div.owl-next {
     left: auto;
     right: -200px;
}
        </style>
    </head>
</head>
<body>
    <div id="wrapper">
        <?php include './header.php'; ?>
        <div class="container-fluid about-bg ">
            <div class="container">
                <div class="rl-banner">
                    <h2 class="tp">Tour Packages</h2>
                    <ul>
                        <li><a href="./">Home</a></li>
                        <li><span class="active">Tour Packages</span></li>
                        <li><span class="active">Tour Packages Name</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--        <div class="container padding-bottom-45 padding-top-45">
                    <div class="row">
                        <div class="col-md-3 padding-bottom-10 tour-item">
                            <a href="tour-packages-view-page.php"> 
                                <div class="tour">
                                    <img src="images/tour/4.jpg" alt=""/>
                                    <div class="tour-content">
                                        <h3 class="tour-title " >Galle Fort</h3>
                                        <p class="tour-description ">Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat erosfeugiat eros.....</p>
                                        <span class="blog-item-tag" style="background: #0dce38!important">View</span>
                                        <ul id="blog-post-tags">
                                            <li><div id="star-rating-fa" class=" text-right"> 
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <div id="rating-counter-tour">(160 reviews)</div><br/>
                                                </div></li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 padding-bottom-10 tour-item">
                            <a href="tour-packages-view-page.php"> 
                                <div class="tour">
                                    <img src="images/tour/4.jpg" alt=""/>
                                    <div class="tour-content">
                                        <h3 class="tour-title " >Galle Fort</h3>
                                        <p class="tour-description ">Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat erosfeugiat eros.....</p>
                                        <span class="blog-item-tag" style="background: #0dce38!important">View</span>
                                        <ul id="blog-post-tags">
                                            <li><div id="star-rating-fa" class=" text-right"> 
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <div id="rating-counter-tour">(160 reviews)</div><br/>
                                                </div></li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 padding-bottom-10 tour-item">
                            <a href="tour-packages-view-page.php"> 
                                <div class="tour">
                                    <img src="images/tour/4.jpg" alt=""/>
                                    <div class="tour-content">
                                        <h3 class="tour-title " >Galle Fort</h3>
                                        <p class="tour-description ">Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat erosfeugiat eros.....</p>
                                        <span class="blog-item-tag" style="background: #0dce38!important">View</span>
                                        <ul id="blog-post-tags">
                                            <li><div id="star-rating-fa" class=" text-right"> 
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <div id="rating-counter-tour">(160 reviews)</div><br/>
                                                </div></li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 padding-bottom-10 tour-item">
                            <a href="tour-packages-view-page.php"> 
                                <div class="tour">
                                    <img src="images/tour/4.jpg" alt=""/>
                                    <div class="tour-content">
                                        <h3 class="tour-title " >Galle Fort</h3>
                                        <p class="tour-description ">Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat erosfeugiat eros.....</p>
                                        <span class="blog-item-tag" style="background: #0dce38!important">View</span>
                                        <ul id="blog-post-tags">
                                            <li><div id="star-rating-fa" class=" text-right"> 
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <div id="rating-counter-tour">(160 reviews)</div><br/>
                                                </div></li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>-->
<!--        <div class="container grid">
            <div class="row">
                <div class="col-md-4">
                    <a href="tour-packages-view-page.php"> 
                        <figure class="effect-sarah">
                            <img src="images/tour/1.jpg" alt="img13"/>
                            <figcaption>
                                <h2>Free Sarah</h2>
                                <p>Sarah likes to watch clouds. She's quite depressed.</p>
                                <ul id="blog-post-tags">
                                    <li><div id="star-rating-fa" class=" text-right"> 
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <div id="rating-counter-tour">(160 reviews)</div><br/>
                                        </div></li>
                                </ul>
                                <span id="blog-item-tag" style="background: #0dce38!important">View</span>
                            </figcaption>			
                        </figure>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="tour-packages-view-page.php"> 
                        <figure class="effect-sarah">
                            <img src="images/tour/1.jpg" alt="img13"/>
                            <figcaption>
                                <h2>Free Sarah</h2>
                                <p>Sarah likes to watch clouds. She's quite depressed.</p>
                                <ul id="blog-post-tags">
                                    <li><div id="star-rating-fa" class=" text-right"> 
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <div id="rating-counter-tour">(160 reviews)</div><br/>
                                        </div></li>
                                </ul>
                                <span id="blog-item-tag" style="background: #0dce38!important">View</span>
                            </figcaption>			
                        </figure>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="tour-packages-view-page.php"> 
                        <figure class="effect-sarah">
                            <img src="images/tour/1.jpg" alt="img13"/>
                            <figcaption>
                                <h2>Free Sarah</h2>
                                <p>Sarah likes to watch clouds. She's quite depressed.</p>
                                <ul id="blog-post-tags">
                                    <li><div id="star-rating-fa" class=" text-right"> 
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <div id="rating-counter-tour">(160 reviews)</div><br/>
                                        </div></li>
                                </ul>
                                <span id="blog-item-tag" style="background: #0dce38!important">View</span>
                            </figcaption>			
                        </figure>
                    </a>
                </div>
            </div>
        </div>-->
<section class="blog-contents-version-one padding-bottom-45 padding-top-45 popular-packages">
	<div class="container">
		<div class="row">
			<!-- single package -->
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-package-carasoul">
					<div class="package-location">
                                            <img src="images/tour/3.jpg" alt="">
						<span>$150</span>
					</div>
					<div class="package-details">
						<div class="package-places">
							<h4>Dubai – All Stunning Places</h4>
							<span> <i class="fa fa-clock-o"></i> 4Days, 5Nights Stay</span>
							<div class="details">
								<p><span>Included</span>: Flight Facility, 5 Star Hotel, Sightseeing, Transfers, Meals.</p>
							</div>
						</div>
						<div class="package-ratings-review">
							<ul class="two-column">
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
								<li>
									<p>(27 Reviews)</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="package-long-btn hvr-shutter-out-horizontal">
						<a href="#">Book Now</a>
					</div>
				</div>
			</div><!--End single package -->

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-package-carasoul">
					<div class="package-location">
						<img src="images/tour/3.jpg" alt="">
						<span>$150</span>
					</div>
					<div class="package-details">
						<div class="package-places">
							<h4>Paris – All Stunning Places</h4>
							<span> <i class="fa fa-clock-o"></i> 4Days, 5Nights Stay</span>
							<div class="details">
								<p><span>Included</span>: Flight Facility, 5 Star Hotel, Sightseeing, Transfers, Meals.</p>
							</div>
						</div>
						<div class="package-ratings-review">
							<ul class="two-column">
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
								<li>
									<p>(27 Reviews)</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="package-long-btn hvr-shutter-out-horizontal">
						<a href="#">Book Now</a>
					</div>
				</div>
			</div><!--End single package -->

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-package-carasoul">
					<div class="package-location">
						<img src="images/tour/3.jpg" alt="">
						<span>$150</span>
					</div>
					<div class="package-details">
						<div class="package-places">
							<h4>Italy – All Stunning Places</h4>
							<span> <i class="fa fa-clock-o"></i> 4Days, 5Nights Stay</span>
							<div class="details">
								<p><span>Included</span>: Flight Facility, 5 Star Hotel, Sightseeing, Transfers, Meals.</p>
							</div>
						</div>
						<div class="package-ratings-review">
							<ul class="two-column">
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
								<li>
									<p>(27 Reviews)</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="package-long-btn hvr-shutter-out-horizontal">
						<a href="#">Book Now</a>
					</div>
				</div>
			</div><!--End single package -->

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-package-carasoul">
					<div class="package-location">
						<img src="images/tour/3.jpg" alt="">
						<span>$150</span>
					</div>
					<div class="package-details">
						<div class="package-places">
							<h4>Thailand – All Stunning Places</h4>
							<span> <i class="fa fa-clock-o"></i> 4Days, 5Nights Stay</span>
							<div class="details">
								<p><span>Included</span>: Flight Facility, 5 Star Hotel, Sightseeing, Transfers, Meals.</p>
							</div>
						</div>
						<div class="package-ratings-review">
							<ul class="two-column">
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
								<li>
									<p>(27 Reviews)</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="package-long-btn hvr-shutter-out-horizontal">
						<a href="#">Book Now</a>
					</div>
				</div>
			</div><!--End single package -->

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-package-carasoul">
					<div class="package-location">
						<img src="images/tour/3.jpg" alt="">
						<span>$150</span>
					</div>
					<div class="package-details">
						<div class="package-places">
							<h4>England – All Stunning Places</h4>
							<span> <i class="fa fa-clock-o"></i> 4Days, 5Nights Stay</span>
							<div class="details">
								<p><span>Included</span>: Flight Facility, 5 Star Hotel, Sightseeing, Transfers, Meals.</p>
							</div>
						</div>
						<div class="package-ratings-review">
							<ul class="two-column">
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
								<li>
									<p>(27 Reviews)</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="package-long-btn hvr-shutter-out-horizontal">
						<a href="#">Book Now</a>
					</div>
				</div>
			</div><!--End single package -->

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-package-carasoul">
					<div class="package-location">
						<img src="images/tour/3.jpg" alt="">
						<span>$150</span>
					</div>
					<div class="package-details">
						<div class="package-places">
							<h4>India – All Stunning Places</h4>
							<span> <i class="fa fa-clock-o"></i> 4Days, 5Nights Stay</span>
							<div class="details">
								<p><span>Included</span>: Flight Facility, 5 Star Hotel, Sightseeing, Transfers, Meals.</p>
							</div>
						</div>
						<div class="package-ratings-review">
							<ul class="two-column">
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
								<li>
									<p>(27 Reviews)</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="package-long-btn hvr-shutter-out-horizontal">
						<a href="#">Book Now</a>
					</div>
				</div>
			</div><!--End single package -->

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-package-carasoul">
					<div class="package-location">
						<img src="images/tour/3.jpg" alt="">
						<span>$150</span>
					</div>
					<div class="package-details">
						<div class="package-places">
							<h4>England – All Stunning Places</h4>
							<span> <i class="fa fa-clock-o"></i> 4Days, 5Nights Stay</span>
							<div class="details">
								<p><span>Included</span>: Flight Facility, 5 Star Hotel, Sightseeing, Transfers, Meals.</p>
							</div>
						</div>
						<div class="package-ratings-review">
							<ul class="two-column">
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
								<li>
									<p>(27 Reviews)</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="package-long-btn hvr-shutter-out-horizontal">
						<a href="#">Book Now</a>
					</div>
				</div>
			</div><!--End single package -->

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-package-carasoul">
					<div class="package-location">
						<img src="images/tour/3.jpg" alt="">
						<span>$150</span>
					</div>
					<div class="package-details">
						<div class="package-places">
							<h4>Paris – All Stunning Places</h4>
							<span> <i class="fa fa-clock-o"></i> 4Days, 5Nights Stay</span>
							<div class="details">
								<p><span>Included</span>: Flight Facility, 5 Star Hotel, Sightseeing, Transfers, Meals.</p>
							</div>
						</div>
						<div class="package-ratings-review">
							<ul class="two-column">
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
								<li>
									<p>(27 Reviews)</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="package-long-btn hvr-shutter-out-horizontal">
						<a href="#">Book Now</a>
					</div>
				</div>
			</div><!--End single package -->

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-package-carasoul">
					<div class="package-location">
						<img src="images/tour/3.jpg" alt="">
						<span>$150</span>
					</div>
					<div class="package-details">
						<div class="package-places">
							<h4>India – All Stunning Places</h4>
							<span> <i class="fa fa-clock-o"></i> 4Days, 5Nights Stay</span>
							<div class="details">
								<p><span>Included</span>: Flight Facility, 5 Star Hotel, Sightseeing, Transfers, Meals.</p>
							</div>
						</div>
						<div class="package-ratings-review">
							<ul class="two-column">
								<li>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
								<li>
									<p>(27 Reviews)</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="package-long-btn hvr-shutter-out-horizontal">
						<a href="#">Book Now</a>
					</div>
				</div>
			</div><!--End single package -->
		</div>

		<div class="row">
			<!-- pagination start here -->
			<div class="col-sm-12 text-center">
				<ul class="pagination">
					<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a>
					</li>
					<li><a href="#">2</a>
					</li>
					<li><a href="#">3</a>
					</li>
				</ul>
			</div><!-- pagination end here -->
		</div>
	</div>
</section><!-- single popular destination  end-->

        <?php include './footer.php'; ?>
    </div>

    <script data-cfasync="false" src="../../cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
    <script src="scripts/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
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

