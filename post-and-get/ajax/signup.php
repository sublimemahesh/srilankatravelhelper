<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'CHECKEMAIL') {

    if ($_POST['position'] === 'visitor') {
        $POSITION = Visitor::checkEmail($_POST['email']);
    } elseif ($_POST['position'] === 'driver') {
        $POSITION = Drivers::checkEmail($_POST['email']);
    }
    $response = '';

    if ($POSITION) {
        $response = 'registered';
    } else {
        $response = 'notregistered';
    }


    header('Content-type: application/json');
    echo json_encode($response);
}

if ($_POST['option'] === 'CHECKUSERNAME') {

    if ($_POST['position'] === 'visitor') {
        $POSITION = Visitor::checkUserName($_POST['username']);
    } elseif ($_POST['position'] === 'driver') {
        $POSITION = Drivers::checkUserName($_POST['username']);
    }
    $response = '';

    if ($POSITION) {
        $response = 'error';
    } else {
        $response = 'noerror';
    }


    header('Content-type: application/json');
    echo json_encode($response);
}

if ($_POST['option'] === 'SIGNUP') {

    if ($_POST['position'] === 'visitor') {
        $POSITION = new Visitor(NULL);
    } elseif ($_POST['position'] === 'driver') {
        $POSITION = new Drivers(NULL);
    }

    $POSITION->name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $POSITION->email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $POSITION->username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $POSITION->password = md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

    $result = $POSITION->create();

    $arr = array();
    if ($result) {
        $res = $POSITION->login($POSITION->username, $POSITION->password);
        if ($res) {
            if ($_POST['position'] === 'driver') {
                $arr['status'] = 'success';
                $arr['position'] = $_POST['position'];
                $arr['positionid'] = $result->id;
            } else {
                $arr['status'] = 'success';
                $arr['position'] = $_POST['position'];
                $arr['positionid'] = $result['id'];
            }
        } else {
            $arr['status'] = 'error';
        }
    } else {
        $arr['status'] = 'error';
    }


    header('Content-type: application/json');
    echo json_encode($arr);
}