<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'ADDTOCART') {
    if (!isset($_SESSION)) {
        session_start();
    }
    $id = $_POST['id'];
//unset($_SESSION["destination_cart"]);
    $cart = array();
    if (isset($_SESSION['destination_cart'])) {
        $cart = $_SESSION['destination_cart'];
        
        if (in_array($id, $cart)) {
            $result = 'FALSE';
        } else {
            array_push($cart, $id);
            $_SESSION['destination_cart'] = $cart;
            $result = count($cart);
        }
        
    } else {
        array_push($cart, $id);
        $_SESSION['destination_cart'] = $cart;
        $result = count($cart);
    }

    
//    foreach($_SESSION['destination_cart'] as $a) {
//        echo $a;
//    }
    

    header('Content-type: application/json');
    echo json_encode($result);
}

