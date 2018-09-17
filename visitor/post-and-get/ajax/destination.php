<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');


if ($_POST['option'] === 'GETDESTINATIONDETAILS') {
    
    $DESTINATION = new Destination($_POST['id']);
    

    header('Content-type: application/json');
    echo json_encode($DESTINATION);
}


