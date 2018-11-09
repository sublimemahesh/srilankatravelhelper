<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if (isset($_POST['visitorLogin'])) {

    $back = "";
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['back_url'])) {
        $back = $_SESSION['back_url'];
    }


    $response = array();

    $visitorID = $_POST["userID"];
    $name = $_POST["name"];
    $picture = $_POST["picture"];
    $password = substr(explode(".", $_POST["signedRequest"])[1], -7);
    $email = '';
    if (isset($_POST["email"])) {
        $email = $_POST["email"];
    }

    $VISITOR = New Visitor(NULL);

    $isFbIdIsEx = $VISITOR->isFbIdIsEx($visitorID);

    if ($isFbIdIsEx == false) {

        $res = $VISITOR->createByFB($name, $email, $picture, $visitorID, $password);

        if ($res === false) {
            $response['message'] = 'error-log';
            header('Content-Type: application/json; charset=UTF8');
            echo json_encode($response);
            exit();
        } else {
            if ($back <> '') {
                $response['message'] = 'success-cre';
                $response['back'] = $back;
                unset($_SESSION["back_url"]);
            } else {
                $response['message'] = 'success-cre';
                $response['back'] = '';
            }
            header('Content-Type: application/json; charset=UTF8');
            echo json_encode($response);
            exit();
        }
    } else {

        $res = $VISITOR->loginByFB($visitorID, $password);
        if ($res === false) {
            $response['message'] = 'error-log';
            header('Content-Type: application/json; charset=UTF8');
            echo json_encode($response);
            exit();
        } else {
            if ($back <> '') {
                $response['message'] = 'success-log';
                $response['back'] = $back;
                unset($_SESSION["back_url"]);
            } else {
                $response['message'] = 'success-log';
                $response['back'] = '';
            }
            header('Content-Type: application/json; charset=UTF8');
            echo json_encode($response);
            exit();
        }
    }
}