<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Drivers
 *
 * @author U s E r ¨
 */
class Drivers {

    public $id;
    public $createdAt;
    public $name;
    public $email;
    public $address;
    public $city;
    public $contact_number;
    public $nic_number;
    public $driving_licence_number;
    public $dob;
    public $profile_picture;
    public $short_description;
    public $description;
    public $username;
    public $password;
    public $resetCode;
    public $authToken;
    public $isActive;

    public function __construct($id) {
        if ($id) {
            $query = "SELECT "
                    . "`id`,"
                    . "`createdAt`,"
                    . "`name`,"
                    . "`email`,"
                    . "`address`,"
                    . "`city`,"
                    . "`contact_number`,"
                    . "`nic_number`,"
                    . "`driving_licence_number`,"
                    . "`dob`,"
                    . "`profile_picture`,"
                    . "`short_description`,"
                    . "`description`,"
                    . "`username`,"
                    . "`password`,"
                    . "`resetCode`,"
                    . "`authToken`,"
                    . "`isActive`"
                    . " FROM `driver` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->createdAt = $result['createdAt'];
            $this->name = $result['name'];
            $this->email = $result['email'];
            $this->address = $result['address'];
            $this->city = $result['city'];
            $this->contact_number = $result['contact_number'];
            $this->nic_number = $result['nic_number'];
            $this->driving_licence_number = $result['driving_licence_number'];
            $this->dob = $result['dob'];
            $this->profile_picture = $result['profile_picture'];
            $this->short_description = $result['short_description'];
            $this->description = $result['description'];
            $this->username = $result['username'];
            $this->password = $result['password'];
            $this->resetCode = $result['resetCode'];
            $this->authToken = $result['authToken'];
            $this->isActive = $result['isActive'];

            return $this;
        }
    }

    public function create() {
        
        date_default_timezone_set('Asia/Colombo');

        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `driver` (`createdAt`,`name`,`email`,`username`,`password`) VALUES  ('"
                . $createdAt . "', '"
                . $this->name . "', '"
                . $this->email . "', '"
                . $this->username . "', '"
                . $this->password . "')";

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

        $query = "SELECT * FROM `driver` ORDER BY id ASC";
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
                . "`name` ='" . $this->name . "', "
                . "`email` ='" . $this->email . "', "
                . "`address` ='" . $this->address . "', "
                . "`city` ='" . $this->city . "', "
                . "`contact_number` ='" . $this->contact_number . "', "
                . "`nic_number` ='" . $this->nic_number . "', "
                . "`driving_licence_number` ='" . $this->driving_licence_number . "', "
                . "`dob` ='" . $this->dob . "', "
                . "`profile_picture` ='" . $this->profile_picture . "', "
                . "`short_description` ='" . $this->short_description . "', "
                . "`description` ='" . $this->description . "' "
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
        unlink(Helper::getSitePath() . "upload/drivers/" . $this->profile_picture);

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
//            $IMG = $TOUR_SUB_PHOTO->name = $photo["name"];
//            unlink(Helper::getSitePath() . "upload/drivers-photos/" . $IMG);
////            unlink(Helper::getSitePath() . "upload/drivers-photos/" . $IMG);
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

        $query = "SELECT * FROM `driver` WHERE `id` = '" . $id . "' ORDER BY `id` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getDriverById($id) {

        $query = "SELECT * FROM `driver` WHERE `type`= $id ORDER BY `id` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function checkEmail($email) {

        $query = "SELECT `email` FROM `driver` WHERE `email`= '" . $email . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return $result;
        }
    }
    
    public function checkUserName($username) {

        $query = "SELECT `email`,`username` FROM `driver` WHERE `username`= '" . $username . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return $result;
        }
    }
    
    public function login($username, $password) {

        $query = "SELECT `id`,`name`,`email`,`profile_picture` FROM `driver` WHERE `username`= '" . $username . "' AND `password`= '" . $password . "'";
        
        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            $this->id = $result['id'];
            $this->setAuthToken($result['id']);
            $driver = $this->__construct($this->id);

            $this->setUserSession($driver);

            return $driver;
        }
    }
    
    private function setAuthToken($id) {

        $authToken = md5(uniqid(rand(), true));

        $query = "UPDATE `driver` SET `authToken` ='" . $authToken . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {

            return $authToken;
        } else {
            return FALSE;
        }
    }
    
    private function setUserSession($driver) {

        if (!isset($_SESSION)) {
            session_start();
            session_unset($_SESSION);
        }

        $_SESSION["login"] = TRUE;
        $_SESSION["id"] = $driver->id;
        $_SESSION["name"] = $driver->name;
        $_SESSION["email"] = $driver->email;
        $_SESSION["profile_picture"] = $driver->profile_picture;
        $_SESSION["authToken"] = $driver->authToken;
        $_SESSION["position"] = "driver";
    }
    
    public function GenarateCode($email) {

        $rand = rand(10000, 99999);

        $query = "UPDATE  `driver` SET "
                . "`resetCode` ='" . $rand . "' "
                . "WHERE `email` = '" . $email . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function SelectForgetDriver($email) {

        if ($email) {

            $query = "SELECT `email`,`resetCode` FROM `driver` WHERE `email`= '" . $email . "'";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->email = $result['email'];
            $this->resetCode = $result['resetCode'];

            return $result;
        }
    }
    
    public function SelectResetCode($code) {

        $query = "SELECT `id` FROM `driver` WHERE `resetCode`= '" . $code . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            return TRUE;
        }
    }
    
    public function updatePassword($password, $code) {

        $enPass = md5($password);

        $query = "UPDATE  `driver` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `resetCode` = '" . $code . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function authenticate() {

        if (!isset($_SESSION)) {
            session_start();
        }

        $id = NULL;
        $authToken = NULL;

        if (isset($_SESSION["id"])) {
            $id = $_SESSION["id"];
        }

        if (isset($_SESSION["authToken"])) {
            $authToken = $_SESSION["authToken"];
        }

        $query = "SELECT `id` FROM `driver` WHERE `id`= '" . $id . "' AND `authToken`= '" . $authToken . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function logOut() {

        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION["id"]);
        unset($_SESSION["name"]);
        unset($_SESSION["email"]);
        unset($_SESSION["profile_picture"]);
        unset($_SESSION["authToken"]);
        unset($_SESSION["position"]);
        unset($_SESSION["login"]);
        

        return TRUE;
    }
    
    public function checkOldPass($id, $password) {

        $enPass = md5($password);

        $query = "SELECT `id` FROM `driver` WHERE `id`= '" . $id . "' AND `password`= '" . $enPass . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function changePassword($id, $password) {

        $enPass = md5($password);

        $query = "UPDATE  `driver` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `id` = '" . $id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function getDriverByCity($city) {

        $query = "SELECT * FROM `driver` WHERE `city` = '" . $city . "' ORDER BY `id` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
}
