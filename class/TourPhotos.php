<?php

class TourPhotos {

    public $id;
    public $tour_package;
    public $caption;
    public $image_name;
    public $sort;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`tour_packages`,`image_name`,`caption`,`sort` FROM `tour_photos` WHERE `id`=". $id."";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->tour_package = $result['tour_package'];
            $this->image_name = $result['image_name'];
            $this->caption = $result['caption'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `tour_photos` (`tour_package`,`image_name`,`caption`,`sort`) VALUES  ('"
                . $this->tour_package . "', '"
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

        $query = "SELECT * FROM `tour_photos` ORDER BY sort ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `tour_photos` SET "
                   . "`image_name` ='" . $this->image_name . "', "
                . "`caption` ='" . $this->caption . "', "             
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

       unlink(Helper::getSitePath() . "upload/tour_photos/" . $this->image_name);

      $query = 'DELETE FROM `tour_photos` WHERE id="' . $this->id . '"';

        $db = new Database();

      return $db->readQuery($query);
   }

    public function getTourPhotosByTourPackages($id)  {

        $query = "SELECT * FROM `tour_photos` WHERE `tour_package` = '" . $id . "' ORDER BY `sort` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        
        
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function arrange($key, $tour_package) {
        $query = "UPDATE `tour_photos` SET `sort` = '" . $key . "'  WHERE id = '" . $tour_package . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }
  public function getTourPhotosById($id) {

        $query = "SELECT * FROM `tour_photos` WHERE `tour_package`= '" . $id . "' ORDER BY `sort` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
}
