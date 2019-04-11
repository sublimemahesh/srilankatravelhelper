<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'confirm') {

    $BOOKING = new TailorMadeTours($_POST['id']);

    $result = $BOOKING->confirmBooking();

    if ($result) {
          $sendvisitoremail = $BOOKING->sendBookingConfirmedEmailToDriver($result->id);

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}