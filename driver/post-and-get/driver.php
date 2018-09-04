<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['signin'])) {

    $DRIVER = new Drivers(NULL);

    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));



    if ($DRIVER->login($username, $password)) {
        header('Location: ../profile.php?message=5');
        exit();
    } else {
        header('Location: ../index.php?message=23');
        exit();
    }
}

if (isset($_POST['update'])) {

    $DRIVER = new Drivers($_POST['id']);
//    $language = implode(",", $_POST['langOpt']);

    $DRIVER->name = mysql_real_escape_string($_POST['name']);
    $DRIVER->email = mysql_real_escape_string($_POST['email']);
    $DRIVER->address = filter_input(INPUT_POST, 'address');
    $DRIVER->contact_number = filter_input(INPUT_POST, 'contact_number');
    $DRIVER->nic_number = filter_input(INPUT_POST, 'nic_number');
    $DRIVER->driving_licence_number = filter_input(INPUT_POST, 'driving_licence_number');
    $DRIVER->dob = filter_input(INPUT_POST, 'dob');


    $dir_dest = '../../upload/drivers/';

    $handle = new Upload($_FILES['image']);
    
    if ($_POST ["oldImageName"]) {
        $img = $_POST ["oldImageName"];
    } else {
        $img = Helper::randamId();
    }



    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        if ($_POST ["oldImageName"]) {
            $handle->file_new_name_ext = FALSE;
        } else {
            $handle->file_new_name_ext = 'jpg';
        }

        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $img;
        $handle->image_watermark = '../../images/watermark/watermark.png';
        $handle->image_x = 300;
        $handle->image_y = 300;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }
    
    $DRIVER->profile_picture = $img;
    


    $VALID = new Validator();

    $VALID->check($DRIVER, [
        'name' => ['required' => TRUE],
        'email' => ['required' => TRUE],
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
