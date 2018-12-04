<?php

include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['bookoffer']) {

    $OFFERBOOKING = new OfferBooking(NULL);
    $VALID = new Validator();

    $OFFERBOOKING->offer = $_POST['offer'];
    $OFFERBOOKING->visitor = $_POST['visitor'];
    $OFFERBOOKING->date_time_booked = $_POST['date_time_booked'];
    $OFFERBOOKING->message = $_POST['message'];

    $result = $OFFERBOOKING->create();

    if ($result) {
        $sendvisitoremail = $OFFERBOOKING->sendOfferBookingConfirmationEmailToVisitor($result->id);
        $senddriveremail = $OFFERBOOKING->sendOfferBookingConfirmationEmailToDriver($result->id);
        $sendadminemail = $OFFERBOOKING->sendOfferBookingConfirmationEmailToAdmin($result->id);

        if ($sendvisitoremail && $senddriveremail && $sendadminemail) {
            $VALID->addError("Offer Booking was completed successfully. Please check your email", 'success');
            $_SESSION['ERRORS'] = $VALID->errors();
            header('Location: ../offer-booking.php?message=25&offer=' . $OFFER->id);
        } else {
            $VALID->addError("There was an error. Please try again !", 'danger');
            $_SESSION['ERRORS'] = $VALID->errors();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}