<?php
include_once(dirname(__FILE__) . '/../../class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
if ($_POST['option'] === 'ADDDETAILS') {
    
    $TAILORMADETOURS = new TailorMadeTours(NULL);
    
    $TAILORMADETOURS->visitor = $_POST['visitor'];
    $TAILORMADETOURS->places = $_POST['places'];
    $TAILORMADETOURS->driver = $_POST['driver'];
    $TAILORMADETOURS->no_of_adults = $_POST['noofadults'];
    $TAILORMADETOURS->no_of_children = $_POST['noofchildren'];
    $TAILORMADETOURS->start_date = $_POST['startdate'];
    $TAILORMADETOURS->end_date = $_POST['enddate'];
    $TAILORMADETOURS->message = $_POST['message'];
    
    $result = $TAILORMADETOURS->create();
    
    if($result) {
        $sendvisitoremail = $TAILORMADETOURS->sendBookingConfirmationEmailToVisitor($result->id);
        $senddriveremail = $TAILORMADETOURS->sendBookingConfirmationEmailToDriver($result->id);
        $sendadminemail = $TAILORMADETOURS->sendBookingConfirmationEmailToAdmin($result->id);
        
        unset($_SESSION["destination_cart"]);
        if($sendvisitoremail && $senddriveremail && $sendadminemail) {
            $res = 'TRUE';
        } else {
            $res = 'FALSE';
        }
    }
    


    header('Content-type: application/json');
    echo json_encode($res);
}