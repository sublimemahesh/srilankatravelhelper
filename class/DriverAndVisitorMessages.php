<?php

/**
 * Description of DriverAndVisitorMessages
 *
 * @author K Nisansala
 */
class DriverAndVisitorMessages {

    public $id;
    public $date_and_time;
    public $driver;
    public $visitor;
    public $messages;
    public $sender;
    public $is_viewed;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`date_and_time`,`driver`,`visitor`,`messages`,`sender`,`is_viewed` FROM `driver_visitor_messages` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->date_and_time = $result['date_and_time'];
            $this->driver = $result['driver'];
            $this->visitor = $result['visitor'];
            $this->messages = $result['messages'];
            $this->sender = $result['sender'];
            $this->is_viewed = $result['is_viewed'];

            return $this;
        }
    }

    public function create() {
        
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `driver_visitor_messages` (`date_and_time`,`driver`,`visitor`,`messages`,`sender`) VALUES  ('"
                . $createdAt . "','"
                . $this->driver . "', '"
                . $this->visitor . "', '"
                . $this->messages . "', '"
                . $this->sender . "')";

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

        $query = "SELECT * FROM `driver_visitor_messages` ORDER BY `date_and_time` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `driver_visitor_messages` SET "
                . "`date_and_time` ='" . $this->date_and_time . "', "
                . "`driver` ='" . $this->driver . "', "
                . "`visitor` ='" . $this->visitor . "', "
                . "`messages` ='" . $this->messages . "' "
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

        $query = 'DELETE FROM `driver_visitor_messages` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getMessagesByDriverId($driver) {

        $query = "SELECT * FROM `driver_visitor_messages` WHERE `driver`= $driver ORDER BY date_and_time DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getDistinctVisitorsByDriverId($driver) {
        $query = "SELECT distinct(visitor) FROM `driver_visitor_messages` WHERE `driver`= $driver ";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getDistinctVisitorsOfUnReadMessagesByDriverId($driver) {
        $query = "SELECT distinct(visitor) FROM `driver_visitor_messages` WHERE `driver`= $driver AND `sender` LIKE 'visitor' AND `is_viewed` = 0;";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getMaxIDOfDistinctDriver($driver, $visitor) {

        $query = "SELECT max(id) AS `max` FROM `driver_visitor_messages` WHERE `driver`= $driver and `visitor` = $visitor";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function getMaxIDOfDistinctVisitor($visitor, $driver) {

        $query = "SELECT max(id) AS `max` FROM `driver_visitor_messages` WHERE `visitor`= $visitor and `driver`= $driver";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }
    
    public function getUnReadMaxIDOfDistinctVisitor($visitor, $driver) {

        $query = "SELECT max(id) AS `max` FROM `driver_visitor_messages` WHERE `visitor`= $visitor AND `driver`= $driver AND `is_viewed` = 0";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function getLatestMessageByVisitorAndDriver($visitor, $driver) {

        $query = "SELECT * FROM `driver_visitor_messages` WHERE `visitor`= $visitor AND `driver`= $driver ORDER BY date_and_time DESC LIMIT 1";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function getMessagesByVisitorAndDriverASC($visitor, $driver) {

        $query = "SELECT * FROM `driver_visitor_messages` WHERE `visitor`= $visitor AND `driver`= $driver ORDER BY date_and_time ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function arrange($key, $img) {
        $query = "UPDATE `driver_visitor_messages` SET `messages` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public static function getDistinctDriversByVisitorId($visitor) {
        $query = "SELECT distinct(driver) FROM `driver_visitor_messages` WHERE `visitor`= $visitor";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function updateViewingStatus($id) {

        $query = "UPDATE  `driver_visitor_messages` SET "
                . "`is_viewed` = 1 "
                . "WHERE `id` = '" . $id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getCountOfUnReadMessagesByDriver($driver) {

        $query = "SELECT count(`id`) AS `count` FROM `driver_visitor_messages` WHERE `driver`= $driver AND `sender` LIKE 'visitor' AND `is_viewed`=0";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result['count'];
    }
    
    public function getCountUnreadMessagesByVisitor($visitor, $driver) {

        $query = "SELECT count(`id`) AS `count` FROM `driver_visitor_messages` WHERE `visitor` = $visitor AND `driver`= $driver AND `is_viewed`=0";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result['count'];
    }

    public function getUnReadMessagesByDriver($driver) {

        $query = "SELECT * FROM `driver_visitor_messages` WHERE `driver`= $driver AND `sender` LIKE 'visitor' AND `is_viewed`=0";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

}
