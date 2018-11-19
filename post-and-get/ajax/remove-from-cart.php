<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'remove') {
    if (!isset($_SESSION)) {
        session_start();
    }

    $key = $_POST['key'];
//unset($_SESSION["destination_cart"]);
    $cart = array();
        $cart = $_SESSION['destination_cart'];
        unset($cart[$key]);
        $_SESSION['destination_cart'] = $cart;
        
        $result = count($cart);
    
//    foreach($_SESSION['destination_cart'] as $a) {
//        echo $a;
//    }
    

    header('Content-type: application/json');
    echo json_encode($result);
}

