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
    public $date_time_booked;
    public $booking_id;
    public $driver_id;
    public $price;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `date_time_booked`, `booking_id`, `driver_id`, `price` FROM `driver_booking` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->date_time_booked = $result['date_time_booked'];
            $this->booking_id = $result['booking_id'];
            $this->driver_id = $result['driver_id'];
            $this->price = $result['price'];

            return $this;
        }
    }

    public function create($driver_id, $booking_id) {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `driver_booking`(`date_time_booked`,`booking_id`, `driver_id`, `price`) VALUES  ('"
                . $createdAt . "', '"
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

    public function getActiveBookingsByDriver($driver) {

        $query = "SELECT * FROM `driver_booking` WHERE `driver_id`= $driver  ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function setPrice() {

        $query = "UPDATE  `driver_booking` SET "
                . "`price` ='" . $this->price . "' "
                . "WHERE `booking_id` = '" . $this->booking_id . "' AND `driver_id` = '" . $this->driver_id . "' ";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

}
