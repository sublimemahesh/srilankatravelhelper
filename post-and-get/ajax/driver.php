<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if ($_POST['option'] === 'GETDRIVERDETAILS') {
    
    $DRIVER = Drivers::getDriverByCity($_POST['city']);


    header('Content-type: application/json');
    echo json_encode($DRIVER);
}

