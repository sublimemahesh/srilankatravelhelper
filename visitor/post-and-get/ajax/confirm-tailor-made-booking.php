<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'confirm') {

    $driverbooking = $_POST['id'];
    $bookingid = $_POST['bookingid'];
    $BOOKING = new TailorMadeTours($_POST['bookingid']);
    $driver = DriverBooking::getBookingByDriver($driverbooking);
    $price = DriverBooking::getDetailsByBookingId($driverbooking, $bookingid);
  
//    $dr = $driver->getActiveBookingsByDriver($driverbooking);

    $offrtprice = $price['price'];
    $driverid = $driver['driver_id'];
    $booking = $driver['booking_id'];

    $result = $BOOKING->confirmBooking($driverid, $offrtprice, $booking);
    
//   
//    dd($result);
    if ($result) {
   
        $sendvisitoremail = $BOOKING->sendBookingConfirmedEmailToDriver($result->id);
     
        $result = DriverBooking::DeleteByBookingId($result->id);

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}