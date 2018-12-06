<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if ($_POST['option'] === 'GETDRIVERDETAILS') {
    
    $arr = array();
    $DRIVERSWITHREVIEWS = Drivers::getDriverByCityNameAndReviews($_POST['city'], $_POST['name']);
    $DRIVERSWITHOUTREVIEWS = Drivers::getDriverByCityAndName($_POST['city'], $_POST['name']);

    $arr['driverswithreviews'] = $DRIVERSWITHREVIEWS;
    $arr['driverswithoutreviews'] = $DRIVERSWITHOUTREVIEWS;
   

    header('Content-type: application/json');
    echo json_encode($arr);
}

