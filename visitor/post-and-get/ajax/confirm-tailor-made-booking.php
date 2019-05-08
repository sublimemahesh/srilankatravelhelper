<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'confirm') {
    $driverbooking = $_POST['id'];
    $BOOKING = new TailorMadeTours($_POST['bookingid']);
    $driver = DriverBooking::getBookingByDriver($driverbooking);
//    $dr = $driver->getActiveBookingsByDriver($driverbooking);


    $driverid = $driver['driver_id'];
    $price = $driver['price'];
    $booking = $driver['booking_id'];

    $result = $BOOKING->confirmBooking($driverid, $price, $booking);
//   
//    dd($result);
    if ($result) {
        $sendvisitoremail = $BOOKING->sendBookingConfirmedEmailToDriver($result->id);
    $result = DriverBooking::DeleteByBookingId($booking);
 
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}