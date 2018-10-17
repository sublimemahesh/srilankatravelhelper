<?php
include_once(dirname(__FILE__) . '/class/include.php');


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">

                    <h3 id="hidden-elements">Hidden elements</h3>
                    <p>Facebook style, only show a few images but have a large gallery</p>
                    <div class="row justify-content-center" data-code="example-9">
                        <a href="https://unsplash.it/1200/768.jpg?image=263" data-toggle="lightbox" data-gallery="hidden-images" class="col-4">
                            <img src="https://unsplash.it/600.jpg?image=263" class="img-fluid">
                        </a>
                        <a href="https://unsplash.it/1200/768.jpg?image=264" data-toggle="lightbox" data-gallery="hidden-images" class="col-4">
                            <img src="https://unsplash.it/600.jpg?image=264" class="img-fluid">
                        </a>
                        <a href="https://unsplash.it/1200/768.jpg?image=265" data-toggle="lightbox" data-gallery="hidden-images" class="col-4">
                            <img src="https://unsplash.it/600.jpg?image=265" class="img-fluid">
                        </a>
                        <!-- elements not showing, use data-remote -->
                        <div data-toggle="lightbox" data-gallery="hidden-images" data-remote="https://unsplash.it/1200/768.jpg?image=264" data-title="Hidden item 1"></div>
                        <div data-toggle="lightbox" data-gallery="hidden-images" data-remote="https://unsplash.it/1200/768.jpg?image=265" data-title="Hidden item 3"></div>
                        <div data-toggle="lightbox" data-gallery="hidden-images" data-remote="https://unsplash.it/1200/768.jpg?image=266" data-title="Hidden item 4"></div>
                        <div data-toggle="lightbox" data-gallery="hidden-images" data-remote="https://unsplash.it/1200/768.jpg?image=267" data-title="Hidden item 5"></div>
                    </div>
                    <p class="footer"><span>Built by me, <a href="https://ashleyd.ws">ashleydw</a></span></p>
                </div>
            </div>
        </div>
    </body>
</html>
