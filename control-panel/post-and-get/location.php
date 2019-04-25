<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['update'])) {
    $dir_dest = '../../upload/location/';

    $handle = new Upload($_FILES['picture_name']);
    $imgName = null;

    $LOCATION = new Location($_POST['id']);

    if ($_POST ["oldImageName"]) {
        $img = $_POST ["oldImageName"];
        if ($handle->uploaded) {
            $handle->image_resize = true;
            $handle->file_new_name_body = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = FALSE;
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $_POST ["oldImageName"];
            $handle->image_x = 500;
            $handle->image_y = 500;

            $handle->Process($dir_dest);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
            $LOCATION->imagename = $_POST ["oldImageName"];
        }
    } else {
        $img = Helper::randamId();

        if ($handle->uploaded) {
            $handle->image_resize = true;
            $handle->file_new_name_body = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = 'jpg';
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $img;
            $handle->image_x = 500;
            $handle->image_y = 500;

            $handle->Process($dir_dest);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
            $LOCATION->imagename = $imgName;
        }
    }

    $LOCATION->name = $_POST['name'];
    $LOCATION->placeid = $_POST['placeid'];
    $LOCATION->shortdescription = $_POST['short_description'];
    $LOCATION->views = $_POST['views'];
    $LOCATION->description = $_POST['description'];
    $LOCATION->nearbycities = serialize($_POST['nearbycities']);

    $VALID = new Validator();

    $VALID->check($LOCATION, [
        'name' => ['required' => TRUE],
        'placeid' => ['required' => TRUE],
        'description' => ['required' => TRUE],
        'shortdescription' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $LOCATION->update();

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

    foreach ($_POST['sort'] as $key => $location) {
        $key = $key + 1;

        $LOCATION = Location::arrange($key, $location);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}