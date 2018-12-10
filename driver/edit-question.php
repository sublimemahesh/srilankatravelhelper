<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$DRIVER = new Drivers($_SESSION['id']);
$QUESTION = new BlogQuestion($id);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Question  || Driver DashBoard</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive_visitor.css" rel="stylesheet" type="text/css"/>
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
                <div class="col-md-9 col-sm-9">
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
                    <div class="col-md-12">

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                Edit Question (#<?php echo $QUESTION->id; ?>)
                            </div>
                            <div class="panel-body">
                                <form method="post" action="post-and-get/question.php"  enctype="multipart/form-data">


                                    <div class="row form-data">
                                        <label>Subject</label>
                                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject" value="<?php echo $QUESTION->subject; ?>" />
                                    </div>
                                    <div class="row form-data">
                                        <label>Location</label>
                                        <input type="text" id="autocomplete" class="form-control" placeholder="Enter related location" onFocus="geolocate()" name="autocomplete" required="TRUE" value="<?php echo $QUESTION->location; ?>">
                                        <input type="hidden" name="location" id="location"  value="<?php echo $QUESTION->location; ?>"/>
                                    </div>
                                    <div class="row form-data">
                                        <label>Question</label>
                                        <textarea name="question" id="question" class="form-control"><?php echo $QUESTION->question; ?></textarea>
                                    </div>
                                    <div class="row form-data">
                                        <input type="hidden" name="id" value="<?php echo $QUESTION->id; ?>" />
                                        <input type="submit" name="update" id="update" class="btn btn-lg btn-green" value="Save Data" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <?php
            include './footer.php';
            ?>
        </div>

        <script src="js/jquery_2.2.4.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
        <script src="plugins/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script>
                                            tinymce.init({
                                                selector: "#question",
                                                // ===========================================
                                                // INCLUDE THE PLUGIN
                                                // ===========================================

                                                plugins: [
                                                    "advlist autolink lists link image charmap print preview anchor",
                                                    "searchreplace visualblocks code fullscreen",
                                                    "insertdatetime media table contextmenu paste"
                                                ],
                                                // ===========================================
                                                // PUT PLUGIN'S BUTTON on the toolbar
                                                // ===========================================

                                                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
                                                // ===========================================
                                                // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
                                                // ===========================================

                                                relative_urls: false

                                            });

        </script>
        <script>
            $(function () {
                $("#start_date").datepicker({dateFormat: "yy-mm-dd"}).val()
                $("#end_date").datepicker({dateFormat: "yy-mm-dd"}).val()
            });
        </script>
        <script>
            $(window).load(function () {
                var width = $(window).width();

                if (width > 576) {
                    var contentheight = $(window).height() - 75;
                    var navigationheight = $(window).height();

                    $('.content').css('height', contentheight);
                    $('.navigation').css('height', navigationheight);
                } else {
                    var contentheight = $(window).height();
                    $('.content').css('height', contentheight);
                }
            });
        </script>
        <script>
            //Google Location Autocomplete
            var placeSearch, autocomplete;

            function initAutocomplete() {
                // Create the autocomplete object, restricting the search to geographical
                // location types.
                autocomplete = new google.maps.places.Autocomplete(
                        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                        {types: ['geocode']});

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                autocomplete.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();
                $('#location').val(place.name);
//                $('#longitude').val(place.geometry.location.lng());
//                $('#latitude').val(place.geometry.location.lat());
                for (var component in componentForm) {
                    document.getElementById(component).value = '';
                    document.getElementById(component).disabled = false;
                }

                // Get each component of the address from the place details
                // and fill the corresponding field on the form.
            }

            // Bias the autocomplete object to the user's geographical location,
            // as supplied by the browser's 'navigator.geolocation' object.
            function geolocate() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        var circle = new google.maps.Circle({
                            center: geolocation,
                            radius: position.coords.accuracy
                        });
                        autocomplete.setBounds(circle.getBounds());
                    });
                }
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhjErF0IZ1O5pUQsSag23YgmvAo4OLngM&libraries=places&callback=initAutocomplete"
        async defer></script>
    </body>
</html>
