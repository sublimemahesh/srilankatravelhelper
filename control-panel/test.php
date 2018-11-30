<!DOCTYPE html>
<!--<html>
  <head>
    <title>Place Autocomplete Address Form</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <style>
      #locationField, #controls {
        position: relative;
        width: 480px;
      }
      #autocomplete {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 99%;
      }
      .label {
        text-align: right;
        font-weight: bold;
        width: 100px;
        color: #303030;
      }
      #address {
        border: 1px solid #000090;
        background-color: #f0f0ff;
        width: 480px;
        padding-right: 2px;
      }
      #address td {
        font-size: 10pt;
      }
      .field {
        width: 99%;
      }
      .slimField {
        width: 80px;
      }
      .wideField {
        width: 200px;
      }
      #locationField {
        height: 20px;
        margin-bottom: 2px;
      }
    </style>
  </head>

  <body>
    <div id="locationField">
      <input id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()" type="text"></input>
    </div>

    <table id="address">
      <tr>
        <td class="label">Street address</td>
        <td class="slimField"><input class="field" id="street_number"
              disabled="true"></input></td>
        <td class="wideField" colspan="2"><input class="field" id="route"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">City</td>
         Note: Selection of address components in this example is typical.
             You may need to adjust it for the locations relevant to your app. See
             https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
        
        <td class="wideField" colspan="3"><input class="field" id="locality"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">State</td>
        <td class="slimField"><input class="field"
              id="administrative_area_level_1" disabled="true"></input></td>
        <td class="label">Zip code</td>
        <td class="wideField"><input class="field" id="postal_code"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">Country</td>
        <td class="wideField" colspan="3"><input class="field"
              id="country" disabled="true"></input></td>
      </tr>
    </table>

    <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

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

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
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


<script>
function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                        lat: 41.9030632,
                        lng: 12.466275999999993
                },
                zoom: 13
        });

        var input = document.getElementById('pac-input');

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
                map: map
        });
        marker.addListener('click', function() {
                infowindow.open(map, marker);
        });

        autocomplete.addListener('place_changed', function() {
                infowindow.close();
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                        return;
                }

                if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                }

                // Set the position of the marker using the place ID and location.
                marker.setPlace({
                        placeId: place.place_id,
                        location: place.geometry.location
                });
                marker.setVisible(true);

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
                        'Place ID: ' + place.place_id + '<br>' +
                        place.formatted_address);
                infowindow.open(map, marker);

                var service = new google.maps.places.PlacesService(map);
                
                var details_container = document.getElementById('details');
                
                service.getDetails({
                        placeId: place.place_id
                }, function(place, status) {
                        details_container.innerHTML = '<p><strong>Status:</strong> <code>' + status + '</code></p>' +
                                '<p><strong>Place ID:</strong> <code>' + place.place_id + '</code></p>' +
                                '<p><strong>Location:</strong> <code>' + place.geometry.location.lat() + ', ' + place.geometry.location.lng() + '</code></p>' +

                                '<p><strong>Formatted address:</strong> <code>' + place.formatted_address + '</code></p>' +
                                '<p><strong>GMap Url:</strong> <code>' + place.url + '</code></p>' +
                                '<p><strong>Place details:</strong></p>' +
                                '<pre>' + JSON.stringify(place, null, " ") + '</pre>';

                });

        }); // end autocomplete addListener
}
                </script>-->


<!--<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <title>Creating a Store Locator on Google Maps</title>
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 100%;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
    </head>
    <body style="margin:0px; padding:0px;" onload="initMap()">
        <div>
            <label for="raddressInput">Search location:</label>
            <input type="text" id="addressInput" size="15"/>
            <label for="radiusSelect">Radius:</label>
            <select id="radiusSelect" label="Radius">
                <option value="50" selected>50 kms</option>
                <option value="30">30 kms</option>
                <option value="20">20 kms</option>
                <option value="10">10 kms</option>
            </select>

            <input type="button" id="searchButton" value="Search"/>
        </div>
        <div><select id="locationSelect" style="width: 10%; visibility: hidden"></select></div>
        <div id="map" style="width: 100%; height: 90%"></div>
        <script>
            var map;
            var markers = [];
            var infoWindow;
            var locationSelect;

            function initMap() {
                var sydney = {lat: -33.863276, lng: 151.107977};
                map = new google.maps.Map(document.getElementById('map'), {
                    center: sydney,
                    zoom: 11,
                    mapTypeId: 'roadmap',
                    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
                });
                infoWindow = new google.maps.InfoWindow();

                searchButton = document.getElementById("searchButton").onclick = searchLocations;

                locationSelect = document.getElementById("locationSelect");
                locationSelect.onchange = function () {
                    var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
                    if (markerNum != "none") {
                        google.maps.event.trigger(markers[markerNum], 'click');
                    }
                };
            }

            function searchLocations() {
                var address = document.getElementById("addressInput").value;

                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({address: address}, function (results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {
                        searchLocationsNear(results[0].geometry.location);
                    } else {
                        alert(address + ' not found');
                    }
                });
            }
            alert(status);
            function clearLocations() {
                infoWindow.close();
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                }
                markers.length = 0;

                locationSelect.innerHTML = "";
                var option = document.createElement("option");
                option.value = "none";
                option.innerHTML = "See all results:";
                locationSelect.appendChild(option);
            }

            function searchLocationsNear(center) {
                clearLocations();

                var radius = document.getElementById('radiusSelect').value;
                alert(center.lat());

                var searchUrl = 'storelocator.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius;
                downloadUrl(searchUrl, function (data) {
                    var xml = parseXml(data);
                    var markerNodes = xml.documentElement.getElementsByTagName("marker");
                    var bounds = new google.maps.LatLngBounds();
                    for (var i = 0; i < markerNodes.length; i++) {
                        var id = markerNodes[i].getAttribute("id");
                        var name = markerNodes[i].getAttribute("name");
                        var address = markerNodes[i].getAttribute("address");
                        var distance = parseFloat(markerNodes[i].getAttribute("distance"));
                        var latlng = new google.maps.LatLng(
                                parseFloat(markerNodes[i].getAttribute("lat")),
                                parseFloat(markerNodes[i].getAttribute("lng")));

                        createOption(name, distance, i);
                        createMarker(latlng, name, address);
                        bounds.extend(latlng);
                    }
                    map.fitBounds(bounds);
                    locationSelect.style.visibility = "visible";
                    locationSelect.onchange = function () {
                        var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
                        google.maps.event.trigger(markers[markerNum], 'click');
                    };
                });
            }

            function createMarker(latlng, name, address) {
                var html = "<b>" + name + "</b> <br/>" + address;
                var marker = new google.maps.Marker({
                    map: map,
                    position: latlng
                });
                google.maps.event.addListener(marker, 'click', function () {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                });
                markers.push(marker);
            }

            function createOption(name, distance, num) {
                var option = document.createElement("option");
                option.value = num;
                option.innerHTML = name;
                locationSelect.appendChild(option);
            }

            function downloadUrl(url, callback) {
                var request = window.ActiveXObject ?
                        new ActiveXObject('Microsoft.XMLHTTP') :
                        new XMLHttpRequest;

                request.onreadystatechange = function () {
                    if (request.readyState == 4) {
                        request.onreadystatechange = doNothing;
                        callback(request.responseText, request.status);
                    }
                };

                request.open('GET', url, true);
                request.send(null);
            }

            function parseXml(str) {
                if (window.ActiveXObject) {
                    var doc = new ActiveXObject('Microsoft.XMLDOM');
                    doc.loadXML(str);
                    return doc;
                } else if (window.DOMParser) {
                    return (new DOMParser).parseFromString(str, 'text/xml');
                }
            }

            function doNothing() {}
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhjErF0IZ1O5pUQsSag23YgmvAo4OLngM&callback=initMap">
        </script>
    </body>
</html>-->
<!--        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhjErF0IZ1O5pUQsSag23YgmvAo4OLngM&callback=initMap&radius=50000">
        </script>-->


<!DOCTYPE html>
<html>
<head>
<title>map test</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style type="text/css">

/* map needs width and height to appear */
#map{
	width: 900px;
	max-width: 100%;
	height: 500px;
}

</style>

</head>
<body>

<!-- this div will hold your map -->
<div id="map"></div>

<!-- this div will hold your store info -->
<div id="info_div"></div>

<script>
function initMap() {
	var myMapCenter = {lat: 40.785091, lng: -73.968285};

	// Create a map object and specify the DOM element for display.
	var map = new google.maps.Map(document.getElementById('map'), {
		center: myMapCenter,
		zoom: 14
	});


	function markStore(storeInfo){

		// Create a marker and set its position.
		var marker = new google.maps.Marker({
			map: map,
			position: storeInfo.location,
			title: storeInfo.name
		});

		// show store info when marker is clicked
		marker.addListener('click', function(){
			showStoreInfo(storeInfo);
		});
	}

	// show store info in text box
	function showStoreInfo(storeInfo){
		var info_div = document.getElementById('info_div');
		info_div.innerHTML = 'Store name: '
			+ storeInfo.name
			+ '<br>Hours: ' + storeInfo.hours;
	}

	var stores = [
		{
			name: 'Store 1',
			location: {lat: 40.785091, lng: -73.968285},
			hours: '8AM to 10PM'
		},
		{
			name: 'Store 2',
			location: {lat: 40.790091, lng: -73.968285},
			hours: '9AM to 9PM'
		}
	];

	stores.forEach(function(store){
		markStore(store);
	});

}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhjErF0IZ1O5pUQsSag23YgmvAo4OLngM&callback=initMap" async defer></script>
</body>
</html>