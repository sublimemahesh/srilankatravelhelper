<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');

if (isset($_POST['add-tour-type'])) {
    $DRIVER_PHOTOS = new DriverPhotos(NULL);
    $VALID = new Validator();
    $DRIVER_PHOTOS->driver = $_POST['driver'];
    $DRIVER_PHOTOS->caption = $_POST['caption'];

    $dir_dest = '../../upload/driver-photos/';

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

    $DRIVER_PHOTOS->image_name = $imgName;

    $VALID->check($DRIVER_PHOTOS, [
        'caption' => ['required' => TRUE],
        'image_name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $DRIVER_PHOTOS->create();

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

    $dir_dest = '../../upload/driver-photos/';

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

    $DRIVER_PHOTOS = new DriverPhotos($_POST['id']);



    $DRIVER_PHOTOS->id = $_POST['id'];
    $DRIVER_PHOTOS->caption = $_POST['caption'];
    $DRIVER_PHOTOS->picture_name = $_POST['oldImageName'];
    $DRIVER_PHOTOS->sort = $_POST['sort'];

    $VALID = new Validator();
    $VALID->check($DRIVER_PHOTOS, [
//        'caption' => ['required' => TRUE],
        'image_name' => ['required' => TRUE],
//        'sort' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $DRIVER_PHOTOS->update();

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

    foreach ($_POST['sort'] as $key => $driver) {
        $key = $key + 1;

      $DRIVER_PHOTOS = DriverPhotos::arrange($key, $driver);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}