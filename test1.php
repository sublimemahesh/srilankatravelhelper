<!DOCTYPE html>
<html>
    <head>
        <title>map test atti</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--<style type="text/css">

/* map needs width and height to appear */
#map{
        width: 900px;
        max-width: 100%;
        height: 500px;
}

</style>-->

    </head>
    <body>
        <div id="map-canvas" style="width: 800px; height: 500px;"></div>


        <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBhjErF0IZ1O5pUQsSag23YgmvAo4OLngM&sensor=true" type="text/javascript"></script>

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
                    center: new google.maps.LatLng(7.231062, 80.217732), // Coimbatore = (11.0168445, 76.9558321)
                    zoom: 7,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

                // Get data from database. It should be like below format or you can alter it.

                var data = '[{ "DisplayText": "location-1","LatitudeLongitude": "7.231062, 80.217732" },{ "DisplayText": "location-2","LatitudeLongitude": "7.833941, 80.574718"},{ "DisplayText": "location-3","LatitudeLongitude": "7.360663, 81.640682"}]';

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
                            alert(people["DisplayText"] + " -- " + people["Address"] + ". This address couldn't be found");
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
                        infowindow.open(map, this);
                    });
                }
            }
        </script>

    </body>

</html>