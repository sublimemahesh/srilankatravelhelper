<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $TOUR_PACKAGE = new TourPackages(NULL);
    $VALID = new Validator();
    $TOUR_PACKAGE->type = serialize($_POST['type']);
    $TOUR_PACKAGE->name = $_POST['name'];
    $TOUR_PACKAGE->price = $_POST['price'];
    $TOUR_PACKAGE->short_description = $_POST['short_description'];
    $TOUR_PACKAGE->description = $_POST['description'];

    $dir_dest = '../../upload/tour-package/';
    $dir_dest_thumb = '../../upload/tour-package/thumb/';
    $dir_dest_thumb1 = '../../upload/tour-package/thumb1/';

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
        $handle->image_x = 900;
        $handle->image_y = 500;

        $handle->Process($dir_dest);

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
        $handle->image_x = 570;
        $handle->image_y = 310;

        $handle->Process($dir_dest_thumb);

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
        $handle->image_x = 300;
        $handle->image_y = 300;

        $handle->Process($dir_dest_thumb1);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $TOUR_PACKAGE->image_name = $imgName;

    $VALID->check($TOUR_PACKAGE, [
        'name' => ['required' => TRUE],
        'price' => ['required' => TRUE],
        'description' => ['required' => TRUE],
        'short_description' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $TOUR_PACKAGE->create();

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
    $dir_dest = '../../upload/tour-package/';
    $dir_dest_thumb = '../../upload/tour-spackage/thumb/';
    $dir_dest_thumb1 = '../../upload/tour-spackage/thumb1/';

    $handle = new Upload($_FILES['picture_name']);
    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageName"];
        $handle->image_x = 900;
        $handle->image_y = 500;

        $handle->Process($dir_dest);

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
            $handle->image_x = 570;
            $handle->image_y = 310;


            $handle->Process($dir_dest_thumb);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
        }
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageName"];
        $handle->image_x = 300;
        $handle->image_y = 300;


        $handle->Process($dir_dest_thumb1);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $TOUR_PACKAGE = new TourPackages($_POST['id']);
    $TOUR_PACKAGE->image_name = $_POST['oldImageName'];
    $TOUR_PACKAGE->type = serialize($_POST['type']);
    $TOUR_PACKAGE->name = $_POST['name'];
    $TOUR_PACKAGE->name = $_POST['price'];
    $TOUR_PACKAGE->short_description = $_POST['short_description'];
    $TOUR_PACKAGE->description = $_POST['description'];

    $VALID = new Validator();

    $VALID->check($TOUR_PACKAGE, [
        'name' => ['required' => TRUE],
        'price' => ['required' => TRUE],
        'description' => ['required' => TRUE],
        'short_description' => ['required' => TRUE],
        'type' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $TOUR_PACKAGE->update();

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

    foreach ($_POST['sort'] as $key => $tour_package) {
        $key = $key + 1;

        $TOUR_PACKAGE = TourPackages::arrange($key, $tour_package);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}