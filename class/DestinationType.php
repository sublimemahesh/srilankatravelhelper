<?php

/**
 * Description of TourTypes
 *
 * @author U s E r ¨
 */
class DestinationType {

    public $id;
    public $name;
    public $image_name;
    public $views;
    public $sort;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`name`,`views`,`image_name`,`sort` FROM `destination_type` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->image_name = $result['image_name'];
            $this->views = $result['views'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `destination_type` (`name`,`image_name`,`sort`) VALUES  ('"
                . $this->name . "', '"
                . $this->image_name . "', '"
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

        $query = "SELECT * FROM `destination_type` ORDER BY sort ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `destination_type` SET "
                . "`name` ='" . $this->name . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`views` ='" . $this->views . "', "
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

        unlink(Helper::getSitePath() . "upload/destination-type/" . $this->image_name);

        $query = 'DELETE FROM `destination_type` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function GetDestinationTypeById($id) {

        $query = "SELECT * FROM `destination_type` WHERE `id` = '" . $id . "'";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function arrange($key, $img) {
        $query = "UPDATE `destination_type` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public function getDestinationTypeViewById($id) {
        $query = "SELECT `id`,`views` FROM `destination_type` WHERE `id`= $id ";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function updateViewByid($id, $view) {

        $query = "UPDATE  `destination_type` SET "
                . "`views` ='" . $view . "' "
                . "WHERE `id` = '" . $id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
    }

}
