<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'SIGNIN') {
    
    if ($_POST['position'] === 'visitor') {
        $POSITION = new Visitor(NULL);
    } elseif ($_POST['position'] === 'driver') {
        $POSITION = new Drivers(NULL);
    }

    $username = $_POST['username'];
    $password = md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

    $result = $POSITION->login($username, $password);
   
    $arr = array();
    if ($result) {
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


    header('Content-type: application/json');
    echo json_encode($arr);
}
if ($_POST['option'] === 'SIGNINWITHPOSITION') {

    if ($_POST['position'] === 'visitor') {
        $POSITION = new Visitor(NULL);
    } elseif ($_POST['position'] === 'driver') {
        $POSITION = new Drivers(NULL);
    }

    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

    $result = $POSITION->login($username, $password);


    $arr = array();
    if ($result) {
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


    header('Content-type: application/json');
    echo json_encode($arr);
}
if ($_POST['option'] === 'SIGNININCOMMENT') {

    if ($_POST['position'] === 'visitor') {
        $POSITION = new Visitor(NULL);
    } elseif ($_POST['position'] === 'driver') {
        $POSITION = new Drivers(NULL);
    }

    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

    $result = $POSITION->login($username, $password);


    $arr = array();
    if ($result) {
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


    header('Content-type: application/json');
    echo json_encode($arr);
}