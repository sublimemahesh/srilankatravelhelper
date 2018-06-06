<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');

if (isset($_POST['add-tour-type'])) {
    $DESTINATION_TYPE = new DestinationType(NULL);
    $VALID = new Validator();

    $DESTINATION_TYPE->name = filter_input(INPUT_POST, 'name');

    $dir_dest = '../../upload/destination-type/';

    $handle = new Upload($_FILES['picture_name']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = Helper::randamId();
        $handle->image_x = 330;
        $handle->image_y = 320;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $DESTINATION_TYPE->image_name = $imgName;

    $VALID->check($DESTINATION_TYPE, [
        'name' => ['required' => TRUE],
        'image_name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $DESTINATION_TYPE->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
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

if (isset($_POST['edit-tour-type'])) {

    $dir_dest = '../../upload/destination-type/';

    $handle = new Upload($_FILES['picture_name']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageName"];
        $handle->image_x = 330;
        $handle->image_y = 320;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $DESTINATION_TYPE = new DestinationType($_POST['id']);
    
    

    $DESTINATION_TYPE->id = $_POST['id'];
    $DESTINATION_TYPE->name = $_POST['name'];
    $DESTINATION_TYPE->picture_name = $_POST['oldImageName'];
    $DESTINATION_TYPE->sort = $_POST['sort'];

    $VALID = new Validator();
    $VALID->check($DESTINATION_TYPE, [
        'name' => ['required' => TRUE],
        'image_name' => ['required' => TRUE],
        'sort' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $DESTINATION_TYPE->update();

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

if (isset($_POST['save-data'])) {

    foreach ($_POST['sort'] as $key => $img) {
        $key = $key + 1;

        $TOUR_SUB = DestinationType::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}