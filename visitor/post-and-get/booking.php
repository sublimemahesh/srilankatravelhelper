<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');

if (isset($_POST['update'])) {
    $BOOKING = new Booking($_POST['id']);

    $BOOKING->no_of_adults = $_POST['no_of_adults'];
    $BOOKING->no_of_children = $_POST['no_of_children'];
    $BOOKING->start_date = $_POST['start_date'];
    $BOOKING->end_date = $_POST['end_date'];
    $BOOKING->message = $_POST['message'];
    
    
    $VALID = new Validator();
    $VALID->check($BOOKING, [
        'no_of_adults' => ['required' => TRUE],
        'no_of_children' => ['required' => TRUE],
        'start_date' => ['required' => TRUE],
        'end_date' => ['required' => TRUE],
        'message' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $BOOKING->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}