<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$DRIVER = new Drivers($_SESSION['id']);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$BOOKING = new TailorMadeTours($id);
$VISITOR = new Visitor($BOOKING->visitor);
$places = unserialize($BOOKING->places);
foreach ($places as $place) {
    $DESTINATION = new Destination($place);
    $spentime += $DESTINATION->spend_time;
    $string .= "'" . $DESTINATION->desLocation . "',";
    $dest_str = substr($string, 0, strlen($string) - 1);
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>View Tailor Made Booking || Driver DashBoard</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style-all.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
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
                    <div class="col-md-12 col-sm-12">

                        <div class="panel panel-green profile-panel">
                            <div class="panel-heading ">
                                View Tailor Made Booking (#<?php echo $BOOKING->id; ?>)
                            </div>
                            <div class="panel-body">
                                <div class ="col-lg-7 col-md-7">
                                    <table class="table table-bordered table-striped table-hover viewbookingtable">
                                        <tr>
                                            <th width="260">Booked At</th>
                                            <td><?php echo $BOOKING->date_time_booked; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Visitor</th>
                                            <td><?php echo $VISITOR->name; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Destinations</th>
                                            <td><?php
                                                foreach ($places as $place) {
                                                    $DESTINATION = new Destination($place);
                                                    ?>
                                                    <div class="col-md-9"><a href="../destination-type-one-item-view-page.php?id=<?php echo $place; ?>" target="_blank" ><?php echo $DESTINATION->name; ?></a></div> 
                                                    <div class="col-md-3 title"></div>
                                                    <?php
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td><?php echo $BOOKING->start_date; ?></td>
                                        </tr>
                                        <tr>
                                            <th>End Date</th>
                                            <td><?php echo $BOOKING->end_date; ?></td>
                                        </tr>
                                        <tr>
                                            <th>No of Adults</th>
                                            <td><?php echo $BOOKING->no_of_adults; ?></td>
                                        </tr>
                                        <tr>
                                            <th>No of Children</th>
                                            <td><?php echo $BOOKING->no_of_children; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td><?php echo 'USD ' . $BOOKING->price; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td><?php echo ucwords($BOOKING->status); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Message</th>
                                            <td><?php echo $BOOKING->message; ?></td>
                                        </tr>
                                    </table>

                                    <div class="btn btn-list col-md-12 <?php
                                    if ($BOOKING->status === 'canceled') {
                                        echo 'hidden';
                                    }
                                    ?>">
                                        <a href="manage-active-tailormade-bookings.php" class="btn btn-info">Back</a> 
                                        <a href="#" class="btn btn-danger cancel-tailor-made-booking " data-id="<?php echo $BOOKING->id; ?>">Cancel Booking</a> 
                                        <a href="set-price-for-tailor-made-booking.php?id=<?php echo $BOOKING->id; ?>" class="btn btn-warning">Set Price</a> 
                                    </div>
                                    <div class="btn btn-list col-md-12 <?php
                                    if ($BOOKING->status === 'active') {
                                        echo 'hidden';
                                    }
                                    ?>">
                                        <a href="manage-canceled-tailormade-bookings.php" class="btn btn-info">Back</a> 
                                    </div>
                                </div>

                         <div class ="col-lg-5 col-md-5  ">
                                    <input type="hidden" class="dest" value="<?php echo $dest_str; ?>"/>
                                    <input type="hidden" class="lonti" value="<?php echo $count ?>"/>



                                    <div class="panel panel-default estimatetime">
                                        <div class="panel-body">
                                            <h4> Estimate Time</h4>
                                            <hr> 
                                            <div class="col-md-6 col-xs-8 col-sm-4">
                                                <label for="comment" class="estimateTime">Total Estimate Time  </label>
                                            </div>   
                                            <div class="col-md-4 col-xs-4 col-sm-4 spendt" >
                                                <input type="hidden" class="spendtime" value="<?php echo round($spentime / 60, 2); ?>"/>
                                                <input type="text" class="spendtime"  disabled value="<?php echo round($spentime / 60, 2) ?> h" >
                                            </div>  
                                        </div>
                                    </div>
                                    <div id="map-canvas" class="desMap"></div>
                                </div>

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
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/cancel-tailor-made-booking.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhjErF0IZ1O5pUQsSag23YgmvAo4OLngM&sensor=true" type="text/javascript"></script>
        <script>

            $(window).load(function () {
                var width = $(window).width();
                if (width > 576) {
                    var contentheight = $(window).height();
                    var navigationheight = $(window).height() - 75;
                    $('.content').css('height', contentheight);
                    $('.navigation').css('height', navigationheight);
                } else {
                    var contentheight = $(window).height() + 300;
                    $('.content').css('height', contentheight);
                }
            });
        </script>

      <script>
        var map;
        var geocoder;
        var marker;
        var people = new Array();
        var latlng;
        var infowindow;

        $(document).ready(function () {
            ViewCustInGoogleMap();
        });

        function ViewCustInGoogleMap() {

            var mapOptions = {
                center: new google.maps.LatLng(8.231062, 80.217732),
                zoom: 7,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

            // Get data from database. It should be like below format or you can alter it.
//            alert($('.dest').val());

//            var convertedArray = stringToConvert.split();
//            console.log(convertedArray);

            var desti = $('.dest').val();

            desti = desti.replace(/'/g, '"');

//            desti = JSON.parse(desti);
            var destinations = JSON.parse("[" + desti + "]");
            var arr = '';
            $.each(destinations, function (key, destination) {
                arr += '{ "LatitudeLongitude": "' + destination + '" },';

            });

            de = arr.substring(0, arr.length - 1);

            var data = '[' + de + ']';
            people = JSON.parse(data);
            for (var i = 0; i < people.length; i++) {
                setMarker(people[i]);
            }

        }

        function setMarker(people) {
            geocoder = new google.maps.Geocoder();
            infowindow = new google.maps.InfoWindow();
            if ((people["LatitudeLongitude"] == null) || (people["LatitudeLongitude"] == 'null') || (people["LatitudeLongitude"] == '')) {
                geocoder.geocode({'address': people["Address"]}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                        marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            draggable: false,
                            html: people["DisplayText"],
                            icon: "images/marker/" + people["MarkerId"] + ".png"
                        });
                        //marker.setPosition(latlng);
                        //map.setCenter(latlng);
                        google.maps.event.addListener(marker, 'click', function (event) {
                            infowindow.setContent(this.html);
                            infowindow.setPosition(event.latLng);
                            infowindow.open(map, this);
                        });
                    } else {
//                        alert(people["DisplayText"] + " -- " + people["Address"] + ". This address couldn't be found");
                    }
                });
            } else {
                var latlngStr = people["LatitudeLongitude"].split(",");
                var lat = parseFloat(latlngStr[0]);
                var lng = parseFloat(latlngStr[1]);
                latlng = new google.maps.LatLng(lat, lng);
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    draggable: false, // cant drag it
                    html: people["DisplayText"]    // Content display on marker click
                            //icon: "images/marker.png"       // Give ur own image
                });
                //marker.setPosition(latlng);
                //map.setCenter(latlng);
                google.maps.event.addListener(marker, 'mouseover', function (event) {
                    infowindow.setContent(this.html);
                    infowindow.setPosition(event.latLng);
//                    infowindow.open(map, this);
                });
            }
        }
    </script>
    </body>
</html>