<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $VISITOR = new Visitor(NULL);
    $VALID = new Validator();

    $VISITOR->name = $_POST['name'];
    $VISITOR->email = $_POST['email'];
    $VISITOR->address = $_POST['address'];
    $VISITOR->contact_number = $_POST['contact_number'];

    $visitor_dir_dest = '../../upload/visitor/';

    $handle = new Upload($_FILES['image_name']);

    $imgName = null;
    $img = Helper::randamId();

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $img;
        $handle->image_x = 300;
        $handle->image_y = 300;

        $handle->Process($visitor_dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }


    $VISITOR->profile_picture = $imgName;

    $VALID->check($VISITOR, [
        'name' => ['required' => TRUE],
        'email' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'contact_number' => ['required' => TRUE],
        'profile_picture' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $VISITOR->create();

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

if (isset($_POST['update'])) {
    $visitor_dir_dest = '../../upload/visitor/';

    $handle = new Upload($_FILES['image_name']);
    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageName"];
        $handle->image_x = 300;
        $handle->image_y = 300;

        $handle->Process($visitor_dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $VISITOR = new Visitor($_POST['id']);
    $VISITOR->name = $_POST['name'];
    $VISITOR->email = $_POST['email'];
    $VISITOR->address = $_POST['address'];
    $VISITOR->contact_number = $_POST['contact_number'];
    $VISITOR->profile_picture = $_POST ["oldImageName"];

    $VALID = new Validator();

    $VALID->check($VISITOR, [
        'name' => ['required' => TRUE],
        'email' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'contact_number' => ['required' => TRUE],
        'profile_picture' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $VISITOR->update();

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