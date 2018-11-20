<?php
include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'SEARCH') {
    
    $DESTINATIONS = Destination::getDestinationsByCityID($_POST['city']);

    if($DESTINATIONS) {
        $result = $DESTINATIONS;
    } else {
        $result = 'FALSE';
    }
    header('Content-type: application/json');
    echo json_encode($result);
}

