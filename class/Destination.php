<?php

/**
 * Description of TourPackage
 *
 * @author official
 */
class Destination {

    public $id;
    public $type;
    public $name;
    public $image_name;
    public $short_description;
    public $description;
    public $sort;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`type`,`name`,`image_name`,`short_description`,`description`,`sort` FROM `destination` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->type = $result['type'];
            $this->name = $result['name'];
            $this->image_name = $result['image_name'];
            $this->short_description = $result['short_description'];
            $this->description = $result['description'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `destination` (`type`,`name`,`image_name`,`short_description`,`description`,`sort`) VALUES  ('"
                . $this->type . "', '"
                . $this->name . "', '"
                . $this->image_name . "', '"
                . $this->short_description . "', '"
                . $this->description . "', '"
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

        $query = "SELECT * FROM `destination` ORDER BY sort ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `destination` SET "
                . "`type` ='" . $this->type . "', "
                . "`name` ='" . $this->name . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`short_description` ='" . $this->short_description . "', "
                . "`description` ='" . $this->description . "', "
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
//        $this->deletePhotos();
        unlink(Helper::getSitePath() . "upload/destination/" . $this->image_name);

        $query = 'DELETE FROM `tour_package` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

//    public function deletePhotos() {
//
//        $TOUR_SUB_PHOTO = new TourSubSectionPhoto(NULL);
//
//        $allPhotos = $TOUR_SUB_PHOTO->getTourSubSectionPhotosById($this->id);
//
//        foreach ($allPhotos as $photo) {
//
//            $IMG = $TOUR_SUB_PHOTO->image_name = $photo["image_name"];
//            unlink(Helper::getSitePath() . "upload/tour-package/sub-section/gallery/" . $IMG);
//            unlink(Helper::getSitePath() . "upload/tour-package/sub-section/gallery/thumb/" . $IMG);
//
//            $TOUR_SUB_PHOTO->id = $photo["id"];
//            $TOUR_SUB_PHOTO->delete();
//        }
//    }



    public function arrange($key, $img) {
        $query = "UPDATE `destination` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public function getTourPackagesByTourType($type) {

        $query = "SELECT * FROM `tour_package` WHERE `tour_type`= $type";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

}
