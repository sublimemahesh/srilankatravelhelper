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
class Reviews {

    public $id;
    public $driver;
    public $tour;
    public $destination;
    public $visitor;
    public $reviews;
    public $reviewedAt;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`driver`, `tour`, `destination`, `visitor`,`reviews`,`reviewedAt` FROM `reviews` WHERE `id`=" . $id . "";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->driver = $result['driver'];
            $this->tour = $result['tour'];
            $this->destination = $result['destination'];
            $this->visitor = $result['visitor'];
            $this->reviews = $result['reviews'];
            $this->reviewedAt = $result['reviewedAt'];

            return $this;
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');
        $reviewedAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `reviews` (`driver`,`tour`,`destination`,`visitor`,`reviews`,`reviewedAt`) VALUES  ('"
                . $this->driver . "', '"
                . $this->tour . "', '"
                . $this->destination . "', '"
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

        $query = "SELECT * FROM `reviews` ORDER BY `id` ASC";
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
        
        $query = "UPDATE  `reviews` SET "
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

        $query = 'DELETE FROM `reviews` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getReviewsByDriver($driver) {

        $query = "SELECT * FROM `reviews` WHERE `driver` = '" . $driver . "' ORDER BY `reviewedAt` ASC";

        $db = new Database();

        $result = $db->readQuery($query);


        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getReviewsByTour($tour) {

        $query = "SELECT * FROM `reviews` WHERE `tour` = '" . $tour . "' ORDER BY `reviewedAt` ASC";

        $db = new Database();

        $result = $db->readQuery($query);


        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getReviewsByDestination($destination) {

        $query = "SELECT * FROM `reviews` WHERE `destination` = '" . $destination . "' ORDER BY `reviewedAt` ASC";

        $db = new Database();

        $result = $db->readQuery($query);


        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function checkReviews($driver, $visitor) {

        $query = "SELECT * FROM `reviews` WHERE `driver` = '" . $driver . "' AND `visitor` = '" . $visitor . "' ORDER BY `reviewedAt` ASC";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
    
    public function checkReviewsofTour($tour, $visitor) {

        $query = "SELECT * FROM `reviews` WHERE `tour` = '" . $tour . "' AND `visitor` = '" . $visitor . "' ORDER BY `reviewedAt` ASC";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
    
    public function checkReviewsofDestination($destination, $visitor) {

        $query = "SELECT * FROM `reviews` WHERE `destination` = '" . $destination . "' AND `visitor` = '" . $visitor . "' ORDER BY `reviewedAt` ASC";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
    
    public function getTotalReviewsOfDriver($driver) {

        $query = "SELECT count(id) AS `count`, sum(reviews) AS `sum` FROM `reviews` WHERE `driver` = '" . $driver . "' ORDER BY `reviewedAt` ASC";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
    
    public function getTotalReviewsOfTour($tour) {

        $query = "SELECT count(id) AS `count`, sum(reviews) AS `sum` FROM `reviews` WHERE `tour` = '" . $tour . "' ORDER BY `reviewedAt` ASC";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        
        return $result;
    }
    
    public function getTotalReviewsOfDestination($destination) {

        $query = "SELECT count(id) AS `count`, sum(reviews) AS `sum` FROM `reviews` WHERE `destination` = '" . $destination . "' ORDER BY `reviewedAt` ASC";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
    
    public function getTotalReviewsOfTourType($type) {

        $query = "SELECT count(id) AS `count`, sum(reviews) AS `sum` FROM `reviews` WHERE `tour` in(SELECT `id` from `tour_packages` WHERE `type` = '". $type ."')";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        
        return $result;
    }
    
    public function getTotalReviewsOfDestinationType($type) {

        $query = "SELECT count(id) AS `count`, sum(reviews) AS `sum` FROM `reviews` WHERE `destination` in(SELECT `id` from `destination` WHERE `type` = '". $type ."')";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

}
