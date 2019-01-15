<?php

/**
 * Description of LocationDetails
 *
 * @author hp
 */
class LocationDetails {

    public $id;
    public $related_location;
    public $location;
    public $bus_distance;
    public $train_distance;
    public $taxi_distance;
    public $bus_hour;
    public $train_hour;
    public $taxi_hour;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `related_location`, `location`, `bus_distance`, `train_distance`, `taxi_distance`, `bus_hour`, `train_hour`, `taxi_hour` FROM `location_details` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->related_location = $result['related_location'];
            $this->location = $result['location'];
            $this->bus_distance = $result['bus_distance'];
            $this->train_distance = $result['train_distance'];
            $this->taxi_distance = $result['taxi_distance'];
            $this->bus_hour = $result['bus_hour'];
            $this->train_hour = $result['train_hour'];
            $this->taxi_hour = $result['taxi_hour'];
            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `location_details`(`related_location`, `location`, `bus_distance`, `train_distance`, `taxi_distance`, `bus_hour`, `train_hour`, `taxi_hour`)VALUES  ('"
                . $this->related_location . "', '"
                . $this->location . "', '"
                . $this->bus_distance . "', '"
                . $this->train_distance . "', '"
                . $this->taxi_distance . "', '"
                . $this->bus_hour . "', '"
                . $this->train_hour . "', '"
                . $this->taxi_hour . "')";

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

        $query = "SELECT * FROM `location_details` ORDER BY sort ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `location_details` SET "
                . "`related_location` ='" . $this->related_location . "', "
                . "`location` ='" . $this->location . "', "
                . "`distance` ='" . $this->bus_distance . "', "
                . "`distance` ='" . $this->train_distance . "', "
                . "`distance` ='" . $this->bus_hour . "', "
                . "`distance` ='" . $this->train_hour . "', "
                . "`distance` ='" . $this->taxi_hour . "' "
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

        $query = 'DELETE FROM `location_details` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getLocationDetailsByRelatedLocationAndLocaion($related_location, $location) {

        $query = "SELECT * FROM `location_details` WHERE `related_location` = '" . $related_location . "' AND `location` = '" . $location . "' ORDER BY `id` ASC";

        $db = new Database();

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function getLocationsByRelatedLocation($related_location) {

        $query = "SELECT * FROM `location_details` WHERE `related_location` = '" . $related_location . "' ORDER BY `id` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

}
