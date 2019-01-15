<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'GETNEARBYCITIES') {
    $LOCATION = new Location($_POST['id']);

    $nearbycities = unserialize($LOCATION->nearbycities);
    
    header('Content-Type: application/json');

    echo json_encode($nearbycities);
    exit();
}
