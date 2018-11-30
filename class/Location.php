<?php

/**
 * Description of Location
 *
 * @author U s E r ¨
 */
class Location {

    public $id;
    public $name;
    public $placeid;
    public $shortdescription;
    public $description;
    public $imagename;
    public $nearbycities;
    public $sort;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`name`,`place_id`,`short_description`,`description`,`image_name`,`near_by_cities`,`sort` FROM `location` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->placeid = $result['place_id'];
            $this->shortdescription = $result['short_description'];
            $this->description = $result['description'];
            $this->imagename = $result['image_name'];
            $this->nearbycities = $result['near_by_cities'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `location` (`name`,`place_id`,`sort`) VALUES  ('"
                . $this->name . "','"
                . $this->placeid . "','"
                . $this->sort . "')";

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

        $query = "SELECT * FROM `location` ORDER BY sort ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getLocationsExceptThisLocation($id) {

        $query = "SELECT * FROM `location` WHERE `id` <> ". $id ." ORDER BY sort ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `location` SET "
                . "`name` ='" . $this->name . "', "
                . "`place_id` ='" . $this->placeid . "', "
                . "`short_description` ='" . $this->shortdescription . "', "
                . "`description` ='" . $this->description . "', "
                . "`image_name` ='" . $this->imagename . "', "
                . "`near_by_cities` ='" . $this->nearbycities . "', "
                . "`sort` ='" . $this->sort . "' "
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

        $query = 'DELETE FROM `location` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getLocationByPlaceID($placeid) {
        $query = "SELECT * FROM `location` WHERE `place_id` LIKE '" . $placeid ."'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        
        return $result;
    }

    public function arrange($key, $img) {
        $query = "UPDATE `location` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
