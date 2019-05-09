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
    public $tour_booking_id;
    public $tour_package_id;
    public $driver_id;
    public $visitor_id;
    public $price;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `date_time_booked`, `booking_id`, `tour_booking_id`, `tour_package_id`, `driver_id`, `visitor_id` ,`price` FROM `driver_booking` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->date_time_booked = $result['date_time_booked'];
            $this->booking_id = $result['booking_id'];
            $this->tour_booking_id = $result['tour_booking_id'];
            $this->tour_package_id = $result['tour_package_id'];
            $this->driver_id = $result['driver_id'];
            $this->visitor_id = $result['visitor_id'];
            $this->price = $result['price'];

            return $this;
        }
    }

    public function create($driver_id, $booking_id, $visitor) {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `driver_booking`(`date_time_booked`,`booking_id`, `driver_id`, `visitor_id`, `price`) VALUES  ('"
                . $createdAt . "', '"
                . $booking_id . "', '"
                . $driver_id . "', '"
                . $visitor . "', '"
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
                . "WHERE `booking_id` = '" . $this->tour_booking_id . "' AND `driver_id` = '" . $this->driver_id . "' ";
       
        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function getActiveBookingsByVisitor($visitor) {

        $query = "SELECT * FROM `driver_booking` WHERE `visitor_id`= $visitor AND `tour_booking_id`=0 ORDER BY `date_time_booked` DESC";


        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getActiveBookingsByBookingId($id) {

        $query = "SELECT * FROM `driver_booking` WHERE `booking_id`= $id  ";


        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function DeleteByBookingId($booking) {

        $query = "DELETE FROM `driver_booking` WHERE `booking_id`= $booking";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getBookingByDriver($driver) {

        $query = "SELECT * FROM `driver_booking` WHERE `driver_id`= $driver ";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function getDetailsByBookingId($driver, $bookingid) {

        $query = "SELECT * FROM `driver_booking` WHERE `driver_id`= $driver AND `booking_id`= $bookingid ";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function createTourBooking($driver_id, $tour_booking_id, $visitor, $tour_package_id) {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `driver_booking`(`date_time_booked`,`tour_booking_id`, `tour_package_id`, `driver_id`, `visitor_id`, `price`) VALUES  ('"
                . $createdAt . "', '"
                . $tour_booking_id . "', '"
                . $tour_package_id . "', '"
                . $driver_id . "', '"
                . $visitor . "', '"
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

    public function getActiveBookingsByTourBookingId($visitor) {

        $query = "SELECT * FROM `driver_booking` WHERE `visitor_id`= $visitor AND `booking_id`='0' ORDER BY `date_time_booked` DESC";


        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function geTourBookingDetailsbyId($visitor) {

        $query = "SELECT * FROM `driver_booking` WHERE `visitor_id`= $visitor ";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function getActiveTourBookingsByDriver($driver) {

        $query = "SELECT * FROM `driver_booking` WHERE `driver_id`= $driver AND `booking_id`='0' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function setPackagePrice($driverid, $booking_id) {

        $query = "UPDATE  `driver_booking` SET "
                . "`price` ='" . $this->price . "' "
                . "WHERE `tour_booking_id` = '" . $booking_id . "' AND `driver_id` = '" . $driverid . "' ";
        
        $db = new Database();
 
        $result = $db->readQuery($query);
        
        if ($result) {
            return $booking_id;
        } else {
            return FALSE;
        }
       
    }

    public function getTourBookingPriceById($driverid, $tourid) {
     
        $query = "SELECT * FROM `driver_booking` WHERE `driver_id`= $driverid AND `tour_booking_id`= $tourid ";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

}
