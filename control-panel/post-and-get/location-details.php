<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {
    $locationDetails = new LocationDetails(NULL);
    $VALID = new Validator();

    $locationDetails->related_location = $_POST['loc'];
    $locationDetails->location = $_POST['type'];
    $locationDetails->bus_distance = $_POST['bus_distance'];
    $locationDetails->bus_hour = $_POST['bus_hour'];
    $locationDetails->train_distance = $_POST['train_distance'];
    $locationDetails->train_hour = $_POST['train_hour'];
    $locationDetails->taxi_distance = $_POST['taxi_distance'];
    $locationDetails->taxi_hour = $_POST['taxi_hour'];

    $VALID->check($locationDetails, [
        'bus_distance' => ['bus_distance' => TRUE],
        'bus_hour' => ['bus_hour' => TRUE],
    ]);
  

    if ($VALID->passed()) {
        $locationDetails->create();

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