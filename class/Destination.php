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
    public $city;
    public $image_name;
    public $spend_time;
    public $desLocation;
    public $viewer;
    public $short_description;
    public $description;
    public $sort;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`type`,`name`,`city`,`image_name`,`spend_time`,`location`,`views`,`short_description`,`description`,`sort` FROM `destination` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->type = $result['type'];
            $this->name = $result['name'];
            $this->city = $result['city'];
            $this->image_name = $result['image_name'];
            $this->spend_time = $result['spend_time'];
            $this->desLocation = $result['location'];
            $this->viewer = $result['views'];
            $this->short_description = $result['short_description'];
            $this->description = $result['description'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `destination` (`type`,`name`,`city`,`image_name`,`spend_time`,`location`,`short_description`,`description`,`sort`) VALUES  ('"
                . $this->type . "', '"
                . $this->name . "', '"
                . $this->city . "', '"
                . $this->image_name . "', '"
                . $this->spend_time . "', '"
                . $this->desLocation . "', '"
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

    public function getAllDestinations($pageLimit, $setLimit) {

        $query = "SELECT * FROM `destination` ORDER BY sort ASC LIMIT " . $pageLimit . " , " . $setLimit . "";
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
                . "`city` ='" . $this->city . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`spend_time` ='" . $this->spend_time . "', "
                . "`location` ='" . $this->desLocation . "', "
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

        $query = 'DELETE FROM `destination` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function arrange($key, $img) {
        $query = "UPDATE `destination` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public function getDestinationByDestinationType($id) {

        $query = "SELECT * FROM `destination` WHERE `id` = '" . $id . "' ORDER BY `sort` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

//    public function getDestinationsByCityID($city) {
//
//        $query = "SELECT * FROM `destination` WHERE `city` = '" . $city . "' ORDER BY `sort` ASC";
//
//        $db = new Database();
//
//        $result = $db->readQuery($query);
//        $array_res = array();
//
//        while ($row = mysql_fetch_array($result)) {
//            array_push($array_res, $row);
//        }
//
//        return $array_res;
//    }

     public function getDestinationsByCityID($city,$keyword,$type ) {

         $w = array();
        $where = '';
  
        if (!empty($keyword)) {
            $w[] = "`name` LIKE '%" . $keyword . "%'";
        }
        if (!empty($city)) {
            $w[] = "`city` = '" . $city . "'";
        }
         if (!empty($type)) {
            $w[] = "`type` LIKE '" . $type . "'";
        }
        if (count($w)) {
            $where = 'WHERE ' . implode(' AND ', $w);
        }

        $query = "SELECT * FROM `destination` " . $where . " ORDER BY `sort` ASC" ;

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    
    
    public function getDestinationByIdForPagination($id, $pageLimit, $setLimit) {
        $query = "SELECT * FROM `destination` WHERE `type`= $id LIMIT " . $pageLimit . " , " . $setLimit . "";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getDestinationById($id) {

        $query = "SELECT * FROM `destination` WHERE `type`= $id ORDER BY `views` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function countTotalDestinationsOfType($id) {

        $query = "SELECT count(id) AS `count` FROM `destination` WHERE `type`= $id ORDER BY `sort` ASC";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function showPaginationOfDestination($id, $per_page, $page) {

        $page_url = "?";
        $query = "SELECT COUNT(*) as totalCount FROM `destination` WHERE `type`= '" . $id . "' ORDER BY `sort` ASC";


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
                        $setPaginate .= "<li><a href='{$page_url}page=$counter&id=$id'>$counter</a></li>";
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&id=$id'>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>...</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1&id=$id'>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&id=$id'>$setLastpage</a></li>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $setPaginate .= "<li><a href='{$page_url}page=1&&id=$id'>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2&id=$id'>2</a></li>";
                    $setPaginate .= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&&id=$id'>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>..</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1&&id=$id'>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&&id=$id'>$setLastpage</a></li>";
                }
                else {
                    $setPaginate .= "<li><a href='{$page_url}page=1&id=$id'>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2&id=$id'>2</a></li>";
                    $setPaginate .= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&id=$id'>$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate .= "<li><a href='{$page_url}page=$next&id=$id'>Next</a></li>";
                $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&id=$id'>Last</a></li>";
            } else {
                $setPaginate .= "<li><a class='current_page'>Next</a></li>";
                $setPaginate .= "<li><a class='current_page'>Last</a></li>";
            }

            $setPaginate .= "</ul>\n";
        }

        echo $setPaginate;
    }

    public function showPaginationOfAllDestinations($per_page, $page) {

        $page_url = "?";
        $query = "SELECT COUNT(*) as totalCount FROM `destination` ORDER BY `sort` ASC";


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

    public function searchDestinations($keyword, $location, $type, $pageLimit, $setLimit) {

        $w = array();
        $where = '';

        if (!empty($keyword)) {
            $w[] = "`name` LIKE '%" . $keyword . "%'";
        }
        if (!empty($location)) {
            $w[] = "`city` = '" . $location . "'";
        }
         if (!empty($type)) {
            $w[] = "`type` LIKE '" . $type . "'";
        }
        if (count($w)) {
            $where = 'WHERE ' . implode(' AND ', $w);
        }

        $query = "SELECT * FROM `destination` " . $where . " ORDER BY `sort` ASC LIMIT " . $pageLimit . " , " . $setLimit . "";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function showPaginationOfSearchedDestinations($keyword, $location, $type, $per_page, $page) {
        
        $page_url = "?";

        $w = array();
        $where = '';

        if (!empty($keyword)) {
            $w[] = "`name` LIKE '%" . $keyword . "%'";
        }
        if (!empty($location)) {
            $w[] = "`city` LIKE '" . $location . "'";
        }
//          if (!empty($type)) {
//            $w[] = "`type` = '" . $type . "'";
//          
//        }
        if (count($w)) {
            $where = 'WHERE ' . implode(' OR ', $w);
        }

        $query = "SELECT count(*) AS totalCount FROM `destination` " . $where . " ORDER BY `sort` ASC";
     
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
                        $setPaginate .= "<li><a href='{$page_url}page=$counter&keyword=$keyword&location=$location&type=$type&search='>$counter</a></li>";
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&keyword=$keyword&location=$location&type=$type&search='>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>...</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1&keyword=$keyword&location=$location&type=$type&search='>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&keyword=$keyword&location=$location&type=$type&search='>$setLastpage</a></li>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $setPaginate .= "<li><a href='{$page_url}page=1&keyword=$keyword&location=$location&type=$type&search='>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2&keyword=$keyword&location=$location&type=$type&search='>2</a></li>";
                    $setPaginate .= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&keyword=$keyword&location=$location&type=$type&search='>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>..</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1&keyword=$keyword&location=$location&type=$type&search='>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&keyword=$keyword&location=$location&type=$type&search='>$setLastpage</a></li>";
                }
                else {
                    $setPaginate .= "<li><a href='{$page_url}page=1&keyword=$keyword&location=$location&type=$type&search='>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2&keyword=$keyword&location=$location&type=$type&search='>2</a></li>";
                    $setPaginate .= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&keyword=$keyword&location=$location&type=$type&search='>$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate .= "<li><a href='{$page_url}page=$next&keyword=$keyword&location=$location&type=$type&search='>Next</a></li>";
                $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&keyword=$keyword&location=$location&type=$type&search='>Last</a></li>";
            } else {
                $setPaginate .= "<li><a class='current_page'>Next</a></li>";
                $setPaginate .= "<li><a class='current_page'>Last</a></li>";
            }

            $setPaginate .= "</ul>\n";
        }

        echo $setPaginate;
    }

    public function updateViewByid($id, $view) {

        $query = "UPDATE  `destination` SET "
                . "`views` ='" . $view . "' "
                . "WHERE `id` = '" . $id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
    }

    public function getDestinationViewById($id) {

        $query = "SELECT `id`,`views` FROM `destination` WHERE `id`= $id ";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

}
