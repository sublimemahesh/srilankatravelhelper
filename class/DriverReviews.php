<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DriverReviews
 *
 * @author WJKN
 */
class DriverReviews {

    public $id;
    public $driver;
    public $visitor;
    public $reviews;
    public $reviewedAt;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`driver`,`visitor`,`reviews`,`reviewedAt` FROM `driver_reviews` WHERE `id`=" . $id . "";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->driver = $result['driver'];
            $this->visitor = $result['visitor'];
            $this->reviews = $result['reviews'];
            $this->reviewedAt = $result['reviewedAt'];

            return $this;
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');
        $reviewedAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `driver_reviews` (`driver`,`visitor`,`reviews`,`reviewedAt`) VALUES  ('"
                . $this->driver . "', '"
                . $this->visitor . "', '"
                . $this->reviews . "', '"
                . $reviewedAt . "')";

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

        $query = "SELECT * FROM `driver_reviews` ORDER BY `id` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        date_default_timezone_set('Asia/Colombo');
        $reviewedAt = date('Y-m-d H:i:s');
        
        $query = "UPDATE  `driver_reviews` SET "
                . "`visitor` ='" . $this->visitor . "', "
                . "`reviews` ='" . $this->reviews . "', "
                . "`reviewedAt` ='" . $reviewedAt . "' "
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

        $query = 'DELETE FROM `driver_reviews` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getReviewsByDriver($driver) {

        $query = "SELECT * FROM `driver_reviews` WHERE `driver` = '" . $driver . "' ORDER BY `reviewedAt` ASC";

        $db = new Database();

        $result = $db->readQuery($query);


        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function checkReviews($driver, $visitor) {

        $query = "SELECT * FROM `driver_reviews` WHERE `driver` = '" . $driver . "' AND `visitor` = '" . $visitor . "' ORDER BY `reviewedAt` ASC";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
    
    public function getTotalReviewsOfDriver($driver) {

        $query = "SELECT count(id) AS `count`, sum(reviews) AS `sum` FROM `driver_reviews` WHERE `driver` = '" . $driver . "' ORDER BY `reviewedAt` ASC";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

}
