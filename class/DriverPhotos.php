<?php

class DriverPhotos {

    public $id;
    public $driver;
    public $caption;
    public $image_name;
    public $sort;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`driver`,`image_name`,`caption`,`sort` FROM `driver_photos` WHERE `id`=" . $id . "";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->driver = $result['driver'];
            $this->image_name = $result['image_name'];
            $this->caption = $result['caption'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `driver_photos` (`driver`,`image_name`,`caption`,`sort`) VALUES  ('"
                . $this->driver . "', '"
                . $this->image_name . "', '"
                . $this->caption . "', '"
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

        $query = "SELECT * FROM `driver_photos` ORDER BY sort ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `driver_photos` SET "
                . "`image_name` ='" . $this->image_name . "', "
                . "`caption` ='" . $this->caption . "' "
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

        $query = 'DELETE FROM `driver_photos` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getDriverPhotosByDriver($id) {

        $query = "SELECT * FROM `driver_photos` WHERE `driver` = '" . $id . "' ORDER BY `sort` ASC";

        $db = new Database();

        $result = $db->readQuery($query);


        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function arrange($key, $driver) {
        $query = "UPDATE `driver_photos` SET `sort` = '" . $key . "'  WHERE id = '" . $driver . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public function getDriverPhotosById($id) {

        $query = "SELECT * FROM `driver_photos` WHERE `driver`= '" . $id . "' ORDER BY `sort` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

}
