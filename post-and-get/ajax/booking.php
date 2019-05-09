<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'ADDDETAILS') {

    $BOOKING = new Booking(NULL);

    $BOOKING->visitor = $_POST['visitor'];
    $BOOKING->tour_package = $_POST['tour'];
//    $BOOKING->driver = $_POST['driver'];
    $BOOKING->no_of_adults = $_POST['noofadults'];
    $BOOKING->no_of_children = $_POST['noofchildren'];
    $BOOKING->start_date = $_POST['startdate'];
    $BOOKING->end_date = $_POST['enddate'];
    $BOOKING->message = $_POST['message'];
    $BOOKING->price = $_POST['price'];



    $result = $BOOKING->create();


    $visitor = $_POST['visitor'];
    $tourpackId = $_POST['tour'];
    $DBOOKING = new DriverBooking(NULL);
    $DBOOKING->tour_booking_id = $result->id;
    $tour_booking_id = $result->id;
    $drivers = $_POST['driver'];

    $explode = explode(',', $drivers);

    $count = 0;
    foreach ($explode as $driver_id) {
        $cont++;
        if ($cont == 4) {
            
        } else {
            $result1 = $DBOOKING->createTourBooking($driver_id, $tour_booking_id, $visitor,$tourpackId);

//            $senddriveremail = $TAILORMADETOURS->sendBookingConfirmationEmailToDriver($booking_id, $driver_id, $visitor);
            $senddriveremail = $BOOKING->sendBookingConfirmationEmailToDriver($driver_id, $booking_id, $visitor);
        }
    }



    if ($result) {
        $sendvisitoremail = $BOOKING->sendBookingConfirmationEmailToVisitor($result->id);
//        $senddriveremail = $BOOKING->sendBookingConfirmationEmailToDriver($result->id);
//        $sendadminemail = $BOOKING->sendBookingConfirmationEmailToAdmin($result->id);
//        if ($sendvisitoremail && $senddriveremail && $sendadminemail) {
        if ($sendvisitoremail) {
            $res = 'TRUE';
        } else {
            $res = 'FALSE';
        }
    }



    header('Content-type: application/json');
    echo json_encode($res);
}