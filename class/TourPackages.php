<?php

/**
 * Description of TourPackage
 *
 * @author official
 */
class TourPackages {

    public $id;
    public $type;
    public $name;
    public $price;
    public $image_name;
    public $short_description;
    public $description;
    public $sort;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`type`,`name`,`price`,`short_description`,`description`,`image_name`,`sort` FROM `tour_packages` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->type = $result['type'];
            $this->name = $result['name'];
            $this->price = $result['price'];
            $this->short_description = $result['short_description'];
            $this->description = $result['description'];
            $this->image_name = $result['image_name'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `tour_packages` (`type`,`name`,`price`,`short_description`,`description`,`image_name`,`sort`) VALUES  ('"
                . $this->type . "', '"
                . $this->name . "', '"
                . $this->price . "', '"
                . $this->short_description . "', '"
                . $this->description . "', '"
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

        $query = "SELECT * FROM `tour_packages` ORDER BY sort ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `tour_packages` SET "
                . "`type` ='" . $this->type . "', "
                . "`name` ='" . $this->name . "', "
                . "`price` ='" . $this->price . "', "
                . "`short_description` ='" . $this->short_description . "', "
                . "`description` ='" . $this->description . "', "
                . "`image_name` ='" . $this->image_name . "', "
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
//
        $this->deletePhotos();
        unlink(Helper::getSitePath() . "upload/tour_packages/" . $this->image_name);

        $query = 'DELETE FROM `tour_packages` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function deletePhotos() {

//        $TOUR_SUB_PHOTO = new TourSubSectionPhoto(NULL);
        $TOUR_SUB_PHOTO = new TourDate(NULL);

        $allPhotos = $TOUR_SUB_PHOTO->getTourDatesById($this->id);

        foreach ($allPhotos as $photo) {

            $IMG = $TOUR_SUB_PHOTO->image_name = $photo["image_name"];
            unlink(Helper::getSitePath() . "upload/tour-packages/date/" . $IMG);
//            unlink(Helper::getSitePath() . "upload/destination-photos/" . $IMG);

            $TOUR_SUB_PHOTO->id = $photo["id"];
            $TOUR_SUB_PHOTO->delete();
        }
    }



    public function arrange($key, $img) {
        $query = "UPDATE `tour_packages` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

//    public function getDestinationByDestinationType($id) {
//
//        $query = "SELECT * FROM `destination` WHERE `id` = '" . $id . "' ORDER BY `sort` ASC";
//
//        $db = new Database();
//
//        $result = $db->readQuery($query);
//        $array_res = array();
//
//        while ($row = mysql_fetch_array($result)) {
//            array_push($array_res, $row);
//        }
//        return $array_res;
//    }
    public function getTourPackagesById($id) {

        $query = "SELECT * FROM `tour_packages` WHERE `type`= $id ORDER BY `sort` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

}
