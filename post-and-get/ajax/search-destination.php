<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'SEARCH') {

    $DESTINATIONS = Destination::getDestinationsByCityID($_POST['city']);

    if ($DESTINATIONS) {
        $result = $DESTINATIONS;
    } else {
        $result = 'FALSE';
    }
    header('Content-type: application/json');
    echo json_encode($result);
}
if ($_POST['option'] === 'GETNEARBYDESTINATIONS') {

    $LOCATION = Location::getLocationByPlaceID($_POST['city']);
    $nearbycities = unserialize($LOCATION['near_by_cities']);
    $alldestinations = array();
    if ($nearbycities) {
        foreach ($nearbycities as $city) {
            $LOC = new Location($city);

            $destinations = Destination::getDestinationsByCityID($LOC->placeid);

            foreach ($destinations as $destination) {
                array_push($alldestinations, $destination);
            }
        }
        $result = $alldestinations;
       
    } else {
        $result = 'FALSE';
    }

    header('Content-type: application/json');
    echo json_encode($result);
}

