<?php

/**
 * Description of TourPackage
 *
 * @author official
 */
class Driver {

    public $id;
    public $name;
    public $image_name;
    public $banner_image;
    public $short_description;
    public $description;
    public $sort;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`name`,`short_description`,`description`,`banner_image`,`image_name`,`sort` FROM `driver` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));
     
            $this->id = $result['id'];
//            $this->type = $result['type'];
            $this->name = $result['name'];

            $this->short_description = $result['short_description'];
            $this->description = $result['description'];
            $this->banner_image = $result['banner_image'];
            
            $this->image_name = $result['image_name'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `driver` (`name`,`short_description`,`description`,`banner_image`,`image_name`,`sort`) VALUES  ('"
//                . $this->type . "', '"
                . $this->name . "', '"
                . $this->short_description . "', '"
                . $this->description . "', '"
                . $this->banner_image . "', '"
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

        $query = "SELECT * FROM `driver` ORDER BY sort ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `driver` SET "
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
        unlink(Helper::getSitePath() . "upload/driver/" . $this->image_name);

        $query = 'DELETE FROM `driver` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

//    public function deletePhotos() {
//
////        $TOUR_SUB_PHOTO = new TourSubSectionPhoto(NULL);
//        $TOUR_SUB_PHOTO = new DriverTypePhotos(NULL);
//
//        $allPhotos = $TOUR_SUB_PHOTO->getDriverTypePhotosById($this->id);
//
//        foreach ($allPhotos as $photo) {
//
//            $IMG = $TOUR_SUB_PHOTO->image_name = $photo["image_name"];
//            unlink(Helper::getSitePath() . "upload/driver-photos/" . $IMG);
////            unlink(Helper::getSitePath() . "upload/driver-photos/" . $IMG);
//
//            $TOUR_SUB_PHOTO->id = $photo["id"];
//            $TOUR_SUB_PHOTO->delete();
//        }
//    }



    public function arrange($key, $img) {
        $query = "UPDATE `driver` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public function getDriverByDriverType($id) {

        $query = "SELECT * FROM `driver` WHERE `id` = '" . $id . "' ORDER BY `sort` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getDriverById($id) {

        $query = "SELECT * FROM `driver` WHERE `type`= $id ORDER BY `sort` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

}
