
<section class="slider-area-2   ">
    <div class="rev_slider_wrapper">
        <div id="rev_slider_2" class="rev_slider" style="display:none">
            <!-- BEGIN SLIDES LIST -->
            <ul>
                <?php
                $SLIDER = Slider::all();
                foreach ($SLIDER as $key => $slider) {
                    ?>
                    <li data-transition="random-premium" data-title="Slide Title" data-param1="Additional Text" data-thumb="images/index.jpg">
                        <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
                        <img src="upload/slider/<?php echo $slider['image_name']; ?>"  alt=""  data-bgposition="center center" data-kenburns="on" data-duration="10000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 -500" data-offsetend="0 500" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                        <div class="tp-caption sfr font-extra-bold tp-resizeme letter-space-4 title-line-4 hidden-sm hidden-xs" data-x="['left', 'left', 'left', 'left']" data-hoffset="0" data-y="center" data-voffset="-120" data-frames='[{"delay":0,"speed":3500,"frame":"0","from":"x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[-100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]' style="z-index: 6; color:#fff; font-family:'Poppins', sans-serif; white-space: nowrap; font-weight:600;">
                            <h2 style="font-size:50px;color: #fff; text-transform: uppercase; font-weight: 600; font-family: 'Oswald', sans-serif"><?php echo $slider['title']; ?></h2>

                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption sfr font-extra-bold tp-resizeme letter-space-4 title-line-42 hidden-sm hidden-xs" data-x="left" data-hoffset="0" data-y="center" data-voffset="-70" data-frames='[{"delay":1000,"speed":3500,"frame":"0","from":"x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[-100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]' style="z-index: 6; font-size:25px; color:#fff; text-transform:capitalize; font-family:'Poppins', sans-serif; white-space: nowrap; font-weight:400;margin-top: 50px;">
                            <h3 style="font-size:25px;color: #fff;"><?php echo $slider['description']; ?></h3>
                        </div>
                

                    </li>
                    <?php
                }
                ?>
            </ul><!-- END SLIDES LIST -->

        </div><!-- END SLIDER CONTAINER -->

    </div><!-- END SLIDER CONTAINER WRAPPER -->

</section>


