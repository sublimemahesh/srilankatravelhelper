<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');


if ($_POST['option'] === 'ADDREVIEW') {
    
    $REVIEW = new Reviews(NULL);
    
    $REVIEW->driver = $_POST['driver'];
    $REVIEW->visitor = $_POST['visitor'];
    $REVIEW->reviews = $_POST['reviews'];
    $REVIEW->message = $_POST['message'];
    
    $result = $REVIEW->create();


    header('Content-type: application/json');
    echo json_encode($result);
}

if ($_POST['option'] === 'ADDTOURREVIEW') {
    
    $REVIEW = new Reviews(NULL);
    
    $REVIEW->tour = $_POST['tour'];
    $REVIEW->visitor = $_POST['visitor'];
    $REVIEW->reviews = $_POST['reviews'];
    $REVIEW->message = $_POST['message'];
    
    $result = $REVIEW->create();


    header('Content-type: application/json');
    echo json_encode($result);
}

if ($_POST['option'] === 'ADDDESTINATIONREVIEW') {
    
    $REVIEW = new Reviews(NULL);
    
    $REVIEW->destination = $_POST['destination'];
    $REVIEW->visitor = $_POST['visitor'];
    $REVIEW->reviews = $_POST['reviews'];
    $REVIEW->message = $_POST['message'];
    
    $result = $REVIEW->create();


    header('Content-type: application/json');
    echo json_encode($result);
}

if ($_POST['option'] === 'UPDATEREVIEW') {
    
    $REVIEW = new Reviews($_POST['id']);
    
    $REVIEW->driver = $_POST['driver'];
    $REVIEW->visitor = $_POST['visitor'];
    $REVIEW->reviews = $_POST['reviews'];
    $REVIEW->message = $_POST['message'];
    
    $result = $REVIEW->update();


    header('Content-type: application/json');
    echo json_encode($result);
}

if ($_POST['option'] === 'UPDATETOURREVIEW') {
    
    $REVIEW = new Reviews($_POST['id']);
    
    $REVIEW->tour = $_POST['tour'];
    $REVIEW->visitor = $_POST['visitor'];
    $REVIEW->reviews = $_POST['reviews'];
    $REVIEW->message = $_POST['message'];
    
    $result = $REVIEW->update();


    header('Content-type: application/json');
    echo json_encode($result);
}

if ($_POST['option'] === 'UPDATEDESTINATIONREVIEW') {
    
    $REVIEW = new Reviews($_POST['id']);
    
    $REVIEW->destination = $_POST['destination'];
    $REVIEW->visitor = $_POST['visitor'];
    $REVIEW->reviews = $_POST['reviews'];
    $REVIEW->message = $_POST['message'];
    
    $result = $REVIEW->update();


    header('Content-type: application/json');
    echo json_encode($result);
}

if ($_POST['option'] === 'CHECK') {
    
    $REVIEW = Reviews::checkReviews($_POST['driver'], $_POST['visitor']);
    
    header('Content-type: application/json');
    echo json_encode($REVIEW);
}

if ($_POST['option'] === 'CHECKTOUR') {
    
    $REVIEW = Reviews::checkReviewsofTour($_POST['tour'], $_POST['visitor']);
    
    
    header('Content-type: application/json');
    echo json_encode($REVIEW);
}

if ($_POST['option'] === 'CHECKDESTINATION') {
    
    $REVIEW = Reviews::checkReviewsofDestination($_POST['destination'], $_POST['visitor']);
    
    
    header('Content-type: application/json');
    echo json_encode($REVIEW);
}

if ($_POST['option'] === 'GETTOTALREVIEWS') {
    
    $REVIEW = Reviews::getTotalReviewsOfDriver($_POST['id']);
    
    header('Content-type: application/json');
    echo json_encode($REVIEW);
}

if ($_POST['option'] === 'GETTOTALREVIEWSOFTOUR') {
    
    $REVIEW = Reviews::getTotalReviewsOfTour($_POST['id']);
    
    if($REVIEW['count'] == 0) {
        $result = 0;
    } else {
        $result = $REVIEW;
    }
    
    header('Content-type: application/json');
    echo json_encode($result);
}

if ($_POST['option'] === 'GETTOTALREVIEWSOFDESTINATION') {
    
    $REVIEW = Reviews::getTotalReviewsOfDestination($_POST['id']);
    
    if($REVIEW['count'] == 0) {
        $result = 0;
    } else {
        $result = $REVIEW;
    }
    
    header('Content-type: application/json');
    echo json_encode($result);
}

