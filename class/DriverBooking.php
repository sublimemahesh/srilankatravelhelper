<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TailorMadeTours
 *
 * @author U s E r ¨
 */
class DriverBooking {

    public $id;
    public $booking_id;
    public $driver_id;
    public $price;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `booking_id`, `driver_id`, `price` FROM `driver_booking` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->booking_id = $result['booking_id'];
            $this->driver_id = $result['driver_id'];
            $this->price = $result['price'];

            return $this;
        }
    }

    public function create($driver_id,$booking_id) {
    
        $query = "INSERT INTO `driver_booking`(`booking_id`, `driver_id`, `price`) VALUES  ('"
                . $booking_id . "', '"
                . $driver_id . "', '"
                . 0 . "')";
 
       
        $db = new Database();
    
        $result = $db->readQuery($query);
 
        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

}
