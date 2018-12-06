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
    public $cityname;
    public $contact_number;
    public $nic_number;
    public $driving_licence_number;
    public $dob;
    public $profile_picture;
    public $short_description;
    public $description;
    public $username;
    public $password;
    public $facebookID;
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
                    . "`city_name`,"
                    . "`contact_number`,"
                    . "`nic_number`,"
                    . "`driving_licence_number`,"
                    . "`dob`,"
                    . "`profile_picture`,"
                    . "`short_description`,"
                    . "`description`,"
                    . "`username`,"
                    . "`password`,"
                    . "`facebookID`,"
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
            $this->cityname = $result['city_name'];
            $this->contact_number = $result['contact_number'];
            $this->nic_number = $result['nic_number'];
            $this->driving_licence_number = $result['driving_licence_number'];
            $this->dob = $result['dob'];
            $this->profile_picture = $result['profile_picture'];
            $this->short_description = $result['short_description'];
            $this->description = $result['description'];
            $this->username = $result['username'];
            $this->password = $result['password'];
            $this->facebookID = $result['facebookID'];
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
                . "`city_name` ='" . $this->cityname . "', "
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

    public function getDriverByCityNameAndReviews($city, $name) {

        $w = array();
        $where = '';

        if (!empty($city)) {
            $w[] = "a.city = '" . $city . "'";
        }
        if (!empty($name)) {
            $w[] = "a.name like '%" . $name . "%'";
        }
        if (count($w)) {
            $where = 'WHERE ' . implode(' AND ', $w);
        }

//        $query = "SELECT * FROM `driver` $where  ORDER BY `id` ASC";
//        $query = "SELECT * FROM `driver` WHERE `id` IN (SELECT `driver` FROM `reviews` WHERE `driver` IN (SELECT `id` FROM `driver` $where) GROUP BY `driver` ORDER BY sum(reviews))";
        $query = "SELECT driver FROM (SELECT `driver`, `name` ,`city`, sum(reviews) FROM `driver` inner join `reviews` on driver.id = reviews.driver GROUP BY `driver` ORDER BY sum(reviews) DESC ) a $where";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();
        $arr = array();

        while ($row = mysql_fetch_array($result)) {
            $res = new Drivers($row['driver']);
            $reviews = Reviews::getTotalReviewsOfDriver($row['driver']);
            $arr['driverdetails'] = $res;
            $arr['reviews'] = $reviews;

            array_push($array_res, $arr);
        }
        return $array_res;
    }

    public function getDriverByCityAndName($city, $name) {

        $w = array();
        $where = '';

        if (!empty($city)) {
            $w[] = "`city` = '" . $city . "'";
        }
        if (!empty($name)) {
            $w[] = "`name` like '%" . $name . "%'";
        }
        if (count($w)) {
            $where = 'AND ' .implode(' AND ', $w);
        }

        $query = "SELECT * FROM `driver` WHERE `id` NOT IN (SELECT distinct(`driver`) FROM `reviews`) $where";
        
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function isFbIdIsEx($driverID) {

        $query = "SELECT * FROM `driver` WHERE `facebookID` = '" . $driverID . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }

    public function createByFB($name, $email, $picture, $driverID, $password) {
        date_default_timezone_set('Asia/Colombo');

        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `driver` (`createdAt`,`name`,`email`,`profile_picture`,`facebookID`,`password`) VALUES  ('" . $createdAt . "','" . $name . "', '" . $email . "', '" . $picture . "', '" . $driverID . "', '" . $password . "')";

        $db = new Database();

        $result = $db->readQuery($query);

        $last_id = mysql_insert_id();

        if ($result) {

            $this->loginByFB($driverID, $password);

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function loginByFB($driverID, $password) {

        $query = "SELECT * FROM `driver` WHERE `facebookID`= '" . $driverID . "' AND `password`= '" . $password . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        if (!$result) {
            return FALSE;
        } else {
            $this->id = $result['id'];
            $driver = $this->__construct($this->id);

            if (!isset($_SESSION)) {
                session_start();
                session_unset($_SESSION);
            }
            $authtocken = $this->setAuthToken($driver->id);
            $_SESSION["login"] = TRUE;
            $_SESSION["id"] = $driver->id;
            $_SESSION["authToken"] = $authtocken;
            return TRUE;
        }
    }

    public function getDriversForPagination($pageLimit, $setLimit) {
        $query = "SELECT * FROM `driver` LIMIT " . $pageLimit . " , " . $setLimit . "";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getDriversID() {
        $query = "SELECT `id` FROM `driver`";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row['id']);
        }
        return $array_res;
    }

    public function showPaginationOfDrivers($per_page, $page) {

        $page_url = "?";
        $query = "SELECT COUNT(*) as totalCount FROM `driver` ORDER BY `id` ASC";


        $rec = mysql_fetch_array(mysql_query($query));

        $total = $rec['totalCount'];

        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;
        $setLastpage = ceil($total / $per_page);
        $lpm1 = $setLastpage - 1;

        $setPaginate = "";
        if ($setLastpage > 1) {
            $setPaginate .= "<ul class='setPaginate'>";
            $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $setLastpage; $counter++) {
                    if ($counter == $page)
                        $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                    else
                        $setPaginate .= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>...</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $setPaginate .= "<li><a href='{$page_url}page=1'>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2'>2</a></li>";
                    $setPaginate .= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>..</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";
                }
                else {
                    $setPaginate .= "<li><a href='{$page_url}page=1'>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2'>2</a></li>";
                    $setPaginate .= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate .= "<li><a href='{$page_url}page=$next'>Next</a></li>";
                $setPaginate .= "<li><a href='{$page_url}page=$setLastpage'>Last</a></li>";
            } else {
                $setPaginate .= "<li><a class='current_page'>Next</a></li>";
                $setPaginate .= "<li><a class='current_page'>Last</a></li>";
            }

            $setPaginate .= "</ul>\n";
        }

        echo $setPaginate;
    }

}
