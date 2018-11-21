<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');


if ($_POST['option'] == 'GETTOURTYPES') {
    $TOUR = new TourPackages($_POST['id']);
    $TYPES = unserialize($TOUR->type);

    header('Content-Type: application/json');

    echo json_encode($TYPES);
    exit();
}