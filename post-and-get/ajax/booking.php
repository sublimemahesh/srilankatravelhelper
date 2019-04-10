<?php
include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'ADDDETAILS') {
    
    $BOOKING = new Booking(NULL);
    
    $BOOKING->visitor = $_POST['visitor'];
    $BOOKING->tour_package = $_POST['tour'];
    $BOOKING->driver = $_POST['driver'];
    $BOOKING->no_of_adults = $_POST['noofadults'];
    $BOOKING->no_of_children = $_POST['noofchildren'];
    $BOOKING->start_date = $_POST['startdate'];
    $BOOKING->end_date = $_POST['enddate'];
    $BOOKING->message = $_POST['message'];
    $BOOKING->price = $_POST['price'];

    
    $result = $BOOKING->create();
    
    if($result) {
        $sendvisitoremail = $BOOKING->sendBookingConfirmationEmailToVisitor($result->id);
        $senddriveremail = $BOOKING->sendBookingConfirmationEmailToDriver($result->id);
        $sendadminemail = $BOOKING->sendBookingConfirmationEmailToAdmin($result->id);
        

        if($sendvisitoremail && $senddriveremail && $sendadminemail) {
            $res = 'TRUE';
        } else {
            $res = 'FALSE';
        }
    }
    


    header('Content-type: application/json');
    echo json_encode($res);
}