<?php

/**
 * Description of Offer
 *
 * @author U s E r ¨
 */
class Offer {

    public $id;
    public $title;
    public $startdate;
    public $enddate;
    public $discount;
    public $price;
    public $image_name;
    public $description;
    public $driver;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`title`,`start_date`,`end_date`,`discount`,`price`,`image_name`,`description`,`driver` FROM `offer` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->title = $result['title'];
            $this->startdate = $result['start_date'];
            $this->enddate = $result['end_date'];
            $this->discount = $result['discount'];
            $this->price = $result['price'];
            $this->image_name = $result['image_name'];
            $this->description = $result['description'];
            $this->driver = $result['driver'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `offer` (`title`,`start_date`,`end_date`,`discount`,`price`,`image_name`,`description`,`driver`) VALUES  ('"
                . $this->title . "', '"
                . $this->startdate . "', '"
                . $this->enddate . "', '"
                . $this->discount . "', '"
                . $this->price . "', '"
                . $this->image_name . "', '"
                . $this->description . "', '"
                . $this->driver . "')";

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

        $query = "SELECT * FROM `offer`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `offer` SET "
                . "`title` ='" . $this->title . "', "
                . "`start_date` ='" . $this->startdate . "', "
                . "`end_date` ='" . $this->enddate . "', "
                . "`discount` ='" . $this->discount . "', "
                . "`price` ='" . $this->price . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`description` ='" . $this->description . "', "
                . "`driver` ='" . $this->driver . "' "
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

        $query = 'DELETE FROM `offer` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getOffersByDriverID($id) {

        $query = "SELECT * FROM `offer` WHERE `driver` = '" . $id . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
