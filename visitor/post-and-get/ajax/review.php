<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');


if ($_POST['option'] === 'ADDREVIEW') {
    
    $REVIEW = new DriverReviews(NULL);
    
    $REVIEW->driver = $_POST['driver'];
    $REVIEW->visitor = $_POST['visitor'];
    $REVIEW->reviews = $_POST['reviews'];
    
    $result = $REVIEW->create();


    header('Content-type: application/json');
    echo json_encode($result);
}
if ($_POST['option'] === 'UPDATEREVIEW') {
    
    $REVIEW = new DriverReviews($_POST['id']);
    
    $REVIEW->driver = $_POST['driver'];
    $REVIEW->visitor = $_POST['visitor'];
    $REVIEW->reviews = $_POST['reviews'];
    
    $result = $REVIEW->update();


    header('Content-type: application/json');
    echo json_encode($result);
}

if ($_POST['option'] === 'CHECK') {
    
    $REVIEW = DriverReviews::checkReviews($_POST['driver'], $_POST['visitor']);
    
    header('Content-type: application/json');
    echo json_encode($REVIEW);
}

if ($_POST['option'] === 'GETTOTALREVIEWS') {
    
    $REVIEW = DriverReviews::getTotalReviewsOfDriver($_POST['id']);
    
    header('Content-type: application/json');
    echo json_encode($REVIEW);
}

