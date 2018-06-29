<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $DRIVER = new Driver(NULL);
    $VALID = new Validator();

    $DRIVER->name = $_POST['name'];
    $DRIVER->short_description = $_POST['short_description'];
    $DRIVER->description = $_POST['description'];

    $driver_dir_dest = '../../upload/driver/';
    $driver_dir_dest_thumb = '../../upload/driver/thumb/';

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
        $handle->image_x = 640;
        $handle->image_y = 620;

        $handle->Process($driver_dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }


        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $img;
        $handle->image_x = 340;
        $handle->image_y = 320;

        $handle->Process($driver_dir_dest_thumb);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $banner_dir_dest = '../../upload/banner-image/';
    $banner_dir_dest_thumb = '../../upload/banner-image/thumb/';

    $handle1 = new Upload($_FILES['banner_image']);

    $imgName1 = null;
    $img = Helper::randamId();

    if ($handle1->uploaded) {
        $handle1->image_resize = true;
        $handle1->file_new_name_body = TRUE;
        $handle1->file_overwrite = TRUE;
        $handle1->file_new_name_ext = 'jpg';
        $handle1->image_ratio_crop = 'C';
        $handle1->file_new_name_body = $img;
        $handle1->image_x = 640;
        $handle1->image_y = 620;

        $handle1->Process($banner_dir_dest);

        if ($handle1->processed) {
            $info = getimagesize($handle1->file_dst_pathname);
            $imgName1 = $handle1->file_dst_name;
        }


        $handle1->image_resize = true;
        $handle1->file_new_name_body = TRUE;
        $handle1->file_overwrite = TRUE;
        $handle1->file_new_name_ext = 'jpg';
        $handle1->image_ratio_crop = 'C';
        $handle1->file_new_name_body = $img;
        $handle1->image_x = 350;
        $handle1->image_y = 150;

        $handle1->Process($banner_dir_dest_thumb);

        if ($handle1->processed) {
            $info = getimagesize($handle1->file_dst_pathname);
            $imgName1 = $handle1->file_dst_name;
        }
    }


    $DRIVER->image_name = $imgName;
    $DRIVER->banner_image = $imgName1;

    $VALID->check($DRIVER, [
        'name' => ['required' => TRUE],
        'description' => ['required' => TRUE],
        'short_description' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $DRIVER->create();

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
    $driver_dir_dest = '../../upload/driver/';
    $driver_dir_dest_thumb = '../../upload/driver/thumb/';

    $handle = new Upload($_FILES['image_name']);
    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageName"];
        $handle->image_x = 640;
        $handle->image_y = 620;

        $handle->Process($driver_dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
        if ($handle->uploaded) {
            $handle->image_resize = true;
            $handle->file_new_name_body = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = FALSE;
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $_POST ["oldImageName"];
            $handle->image_x = 340;
            $handle->image_y = 320;


            $handle->Process($driver_dir_dest_thumb);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
        }
    }

    $banner_dir_dest = '../../upload/banner-image/';
    $banner_dir_dest_thumb = '../../upload/banner-image/thumb/';

    $handle1 = new Upload($_FILES['banner_image']);
    $imgName1 = null;

    if ($handle1->uploaded) {
        $handle1->image_resize = true;
        $handle1->file_new_name_body = TRUE;
        $handle1->file_overwrite = TRUE;
        $handle1->file_new_name_ext = FALSE;
        $handle1->image_ratio_crop = 'C';
        $handle1->file_new_name_body = $_POST ["oldImageName"];
        $handle1->image_x = 640;
        $handle1->image_y = 620;

        $handle1->Process($banner_dir_dest);

        if ($handle1->processed) {
            $info = getimagesize($handle1->file_dst_pathname);
            $imgName1 = $handle1->file_dst_name;
        }
        if ($handle1->uploaded) {
            $handle1->image_resize = true;
            $handle1->file_new_name_body = TRUE;
            $handle1->file_overwrite = TRUE;
            $handle1->file_new_name_ext = FALSE;
            $handle1->image_ratio_crop = 'C';
            $handle1->file_new_name_body = $_POST ["oldImageName"];
            $handle1->image_x = 350;
            $handle1->image_y = 150;


            $handle1->Process($banner_dir_dest_thumb);

            if ($handle1->processed) {
                $info = getimagesize($handle1->file_dst_pathname);
                $imgName1 = $handle1->file_dst_name;
            }
        }
    }

    $DRIVER = new Driver($_POST['id']);
    $DRIVER->image_name = $_POST['oldImageName'];
    $DRIVER->banner_image = $_POST['oldImageName'];
//    $DRIVER->type = $_POST['type'];
    $DRIVER->name = $_POST['name'];
    $DRIVER->short_description = $_POST['short_description'];
    $DRIVER->description = $_POST['description'];

    $VALID = new Validator();

    $VALID->check($DRIVER, [
        'name' => ['required' => TRUE],
        'description' => ['required' => TRUE],
        'short_description' => ['required' => TRUE],
//        'type' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $DRIVER->update();

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

        $DRIVER = Driver::arrange($key, $driver);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}