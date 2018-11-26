<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'GETDESTINATIONPHOTOS') {

    $DESTINATIONSPHOTOS = DestinationPhotos::getDestinationPhotosById($_POST['id']);

    $arr = array();

    foreach ($DESTINATIONSPHOTOS as $destinationphoto) {
        array_push($arr, "upload/destination-photos/" . $destinationphoto['image_name']);
    }
    header('Content-type: application/json');
    echo json_encode($arr);
}

