<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['changepassword'])) {

    $OldPassOk = Visitor::checkOldPass($_POST["id"], $_POST["currentpw"]);
    
    if ($_POST["newpw"] === $_POST["confirmpw"]) {
        if ($OldPassOk) {
            $result = Visitor::changePassword($_POST["id"], $_POST["newpw"]);
            if ($result == 'TRUE') {
                header('location: logout.php');
                exit();
            } else {
                header('location: ../change-password.php?message=14');
                exit();
            }
        } else {
            header('location: ../change-password.php?message=18');
            exit();
        }
    } else {
        header('location: ../change-password.php?message=17');
        exit();
    }
}

if (isset($_POST['PasswordReset'])) {
    $VISITOR = new Visitor(NULL);
    $code = $_POST["code"];
    $password = $_POST["password"];
    $confpassword = $_POST["confirmpassword"];

    if ($password === $confpassword && $password != NULL && $confpassword != NULL) {
        if ($VISITOR->SelectResetCode($code)) {
            $VISITOR->updatePassword($password, $code);
            header('Location: ../index.php?message=15');
        } else {
            header('Location: ../reset-password.php?message=16');
        }
    } else {
        header('Location: ../reset-password.php?message=17');
    }


//    $OldPassOk = Visitor::ChecknewReset($_POST["code"], $_POST["password"]);
//
//    header('Location: ../reset-password.php?message=3');
}

