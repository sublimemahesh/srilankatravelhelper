<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');


if ($_POST['option'] === 'GETTOURDETAILS') {
    
    $TOUR = new TourPackages($_POST['id']);
    

    header('Content-type: application/json');
    echo json_encode($TOUR);
}


