<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');

if (isset($_POST['edit-destination-views'])) {

    $dir_dest = '../../upload/destination-type/';

    $handle = new Upload($_FILES['picture_name']);

    $imgName = null;

    $DESTINATION_VIEWS = new Destination($_POST['id']);
    $DESTINATION_VIEWS->id = $_POST['id'];
    $DESTINATION_VIEWS->viewer = $_POST['views'];
      

    $VALID = new Validator();
    $VALID->check($DESTINATION_VIEWS, [
     'viewer' => ['required' => TRUE]
        
//        'sort' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $DESTINATION_VIEWS->updateViews();

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

