<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'cancel') {

    $BOOKING = new TailorMadeTours($_POST['id']);

    $result = $BOOKING->cancelBooking();
  
    $result = DriverBooking::DeleteByBookingId($result->id);
    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}