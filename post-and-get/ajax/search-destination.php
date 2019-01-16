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
//if ($_POST['option'] === 'GETNEARBYDESTINATIONS') {
//
//    $LOCATION = Location::getLocationByPlaceID($_POST['city']);
//    $nearbycities = unserialize($LOCATION['near_by_cities']);
//    $alldestinations = array();
//    if ($nearbycities) {
//        foreach ($nearbycities as $city) {
//            $LOC = new Location($city);
//
//            $destinations = Destination::getDestinationsByCityID($LOC->placeid);
//
//            foreach ($destinations as $destination) {
//                array_push($alldestinations, $destination);
//            }
//        }
//        $result = $alldestinations;
//       
//    } else {
//        $result = 'FALSE';
//    }
//
//    header('Content-type: application/json');
//    echo json_encode($result);
//}
if ($_POST['option'] === 'GETNEARBYDESTINATIONS') {

    $LOCATION = Location::getLocationByPlaceID($_POST['city']);
    $nearbycities = unserialize($LOCATION['near_by_cities']);
    $allcities = array();
    if ($nearbycities) {
        foreach ($nearbycities as $city) {
            $locations = new Location($city);
            array_push($allcities, $locations);
        }
        $result = $allcities;
    } else {
        $result = 'FALSE';
    }


    header('Content-type: application/json');
    echo json_encode($result);
}

if ($_POST['option'] === 'GETLOCATIONDETAILS') {

    $location_details = LocationDetails::getLocationDetailsByRelatedLocationAndLocaion($_POST['relatedlocation'], $_POST['location']);


    header('Content-type: application/json');
    echo json_encode($location_details);
}

