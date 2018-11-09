	
<?php
  ini_set('display_errors', 1);

include_once(dirname(__FILE__) . '/../../../class/include.php');

if (isset($_POST['driverLogin'])) {

    $back = "";
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['back_url'])) {
        $back = $_SESSION['back_url'];
    }

    $response = array();

    $driverID = $_POST["userID"];
    $name = $_POST["name"];
    $picture = $_POST["picture"];
    $password = substr(explode(".", $_POST["signedRequest"])[1], -7);
    $email = '';
    if(isset($_POST["email"])) {
        $email = $_POST["email"];
    }

    $DRIVER = New Drivers(NULL);

    $isFbIdIsEx = $DRIVER->isFbIdIsEx($driverID);
    if ($isFbIdIsEx == false) {

        $res = $DRIVER->createByFB($name, $email, $picture, $driverID, $password);

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
        $res = $DRIVER->loginByFB($driverID, $password);
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