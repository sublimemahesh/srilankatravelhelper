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

if ($_POST['option'] === 'GETNEARBYLOCATIONS') {

    $LOCATION = Location::getLocationByPlaceID($_POST['city']);
    $nearbycities = unserialize($LOCATION['near_by_cities']);
    
    $alllocations = array();
    $locations = array();
    if ($nearbycities) {
        
        foreach ($nearbycities as $city) {
            
            $LOC = new Location($city);
            $location_details = LocationDetails::getLocationDetailsByRelatedLocationAndLocaion($LOCATION['id'], $LOC->id);
            $locations['location'] = $LOC;
            $locations['details'] = $location_details;
                        
                array_push($alllocations, $locations);
//                array_push($alllocations, $LOC);
        }
        $result = $alllocations;

       
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
//if ($_POST['option'] === 'GETNEARBYDESTINATIONS') {
//
//    $LOCATION = Location::getLocationByPlaceID($_POST['city']);
//    $nearbycities = unserialize($LOCATION['near_by_cities']);
//    $allcities = array();
//    if ($nearbycities) {
//        foreach ($nearbycities as $city) {
//            $locations = new Location($city);
//            array_push($allcities, $locations);
//        }
//        $result = $allcities;
//    } else {
//        $result = 'FALSE';
//    }
//
//
//    header('Content-type: application/json');
//    echo json_encode($result);
//}

if ($_POST['option'] === 'GETLOCATIONDETAILS') {
    
    $LOCATION = Location::getLocationByPlaceID($_POST['relatedlocation']);

    $location_details = LocationDetails::getLocationDetailsByRelatedLocationAndLocaion($LOCATION->id, $_POST['location']);


    header('Content-type: application/json');
    echo json_encode($location_details);
}

