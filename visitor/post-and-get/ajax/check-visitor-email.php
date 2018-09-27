<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');


if ($_POST['save']) {

    header('Content-Type: application/json; charset=UTF8');
    $response = array();

    if (empty($_POST['name'])) {
        $response['status'] = 'error';
        $response['message'] = "1";
        echo json_encode($response);
        exit();
    } else if (empty($_POST['email'])) {
        $response['status'] = 'error';
        $response['message'] = "2";
        echo json_encode($response);
        exit();
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $response['status'] = 'error';
        $response['message'] = "3";
        echo json_encode($response);
        exit();
    } else if (empty($_POST['username'])) {
        $response['status'] = 'error';
        $response['message'] = "4";
        echo json_encode($response);
        exit();
    } else if (empty($_POST['password'])) {
        $response['status'] = 'error';
        $response['message'] = "5";
        echo json_encode($response);
        exit();
    } else if (empty($_POST['cpassword'])) {
        $response['status'] = 'error';
        $response['message'] = "6";
        echo json_encode($response);
        exit();
    } else if ($_POST['password'] !== $_POST['cpassword']) {
        $response['status'] = 'error1';
        $response['message'] = "7";
        echo json_encode($response);
        exit();
    } else {
        $VISITOR = new Visitor(NULL);
        $result = $VISITOR->checkEmail($_POST['email']);
        if ($result) {
            $response['status'] = 'registered';
            $response['message'] = "The email address you entered is already in use.";
            echo json_encode($response);
            exit();
        } else {
            $checkusername = $VISITOR->checkUserName($_POST['username']);

            if ($checkusername) {
                $response['status'] = 'error1';
                $response['message'] = "8";
                echo json_encode($response);
                exit();
            } else {

                $VISITOR = new Visitor(NULL);


                $pw = md5($_POST['password']);
                $email = $_POST['email'];
//            $cemail = $_POST['cnfemail'];

                $VISITOR->name = filter_input(INPUT_POST, 'name');
                $VISITOR->email = $email;
                $VISITOR->username = filter_input(INPUT_POST, 'username');
                $VISITOR->password = $pw;
                $VISITOR->create();

                if ($VISITOR->id) {
                    $VISITOR->login($VISITOR->username, $VISITOR->password);
                    $response['status'] = 'success';
                    echo json_encode($response);
                } else {
                    $response['status'] = 'error';
                    $response['message'] = "Oops. Something went wrong, Please try again.";
                    echo json_encode($response);
                    exit();
                }
            }
        }
    }
}


