<?php
/**
 * Description of Booking
 *
 * @author WJKN
 */
class Booking {
    public $id;
    public $date_time_booked;
    public $tour_package;
    public $visitor;
    public $driver;
    public $no_of_adults;
    public $no_of_children;
    public $start_date;
    public $end_date;
    public $message;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`date_time_booked`,`tour_package`,`visitor`,`no_of_adults`,`no_of_children`,`driver`,`start_date`,`end_date`,`message`,`status` FROM `booking` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->date_time_booked = $result['date_time_booked'];
            $this->tour_package = $result['tour_package'];
            $this->visitor = $result['visitor'];
            $this->no_of_adults = $result['no_of_adults'];
            $this->no_of_children = $result['no_of_children'];
            $this->driver = $result['driver'];
            $this->start_date = $result['start_date'];
            $this->end_date = $result['end_date'];
            $this->message = $result['message'];
            $this->status = $result['status'];

            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');
        
        $status = 'active';

        $query = "INSERT INTO `booking` (`date_time_booked`,`tour_package`,`visitor`,`no_of_adults`,`no_of_children`,`driver`,`start_date`,`end_date`,`message`,`status`) VALUES  ('"
                . $createdAt . "', '"
                . $this->tour_package . "', '"
                . $this->visitor . "', '"
                . $this->no_of_adults . "', '"
                . $this->no_of_children . "', '"
                . $this->driver . "', '"
                . $this->start_date . "', '"
                . $this->end_date . "', '"
                . $this->message . "', '"
                . $status . "')";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `booking` ORDER BY date_time_booked ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `booking` SET "
                . "`date_time_booked` ='" . $this->date_time_booked . "', "
                . "`tour_package` ='" . $this->tour_package . "', "
                . "`visitor` ='" . $this->visitor . "', "
                . "`no_of_adults` ='" . $this->no_of_adults . "', "
                . "`no_of_children` ='" . $this->no_of_children . "', "
                . "`driver` ='" . $this->driver . "', "
                . "`start_date` ='" . $this->start_date . "', "
                . "`end_date` ='" . $this->end_date . "', "
                . "`message` ='" . $this->message . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete() {

        $query = 'DELETE FROM `booking` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getActiveBookingsByDriver($driver) {

        $query = "SELECT * FROM `booking` WHERE `driver`= $driver AND `status` like 'active' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getCanceledBookingsByDriver($driver) {

        $query = "SELECT * FROM `booking` WHERE `driver`= $driver AND `status` = 'canceled' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getBookingsByVisitor($visitor) {

        $query = "SELECT * FROM `booking` WHERE `visitor`= $visitor ORDER BY `date_time_booked` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function cancelBooking() {

        $query = "UPDATE  `booking` SET "
                . "`status` ='canceled' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
}
