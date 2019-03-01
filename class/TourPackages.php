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
    
    public function getPackagesByType($type) {

        $query = "SELECT * FROM `tour_packages` WHERE `type` = $type ORDER BY sort ASC";
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
        unlink(Helper::getSitePath() . "upload/tour-package/" . $this->image_name);

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
            unlink(Helper::getSitePath() . "upload/tour-package/date/" . $IMG);
            unlink(Helper::getSitePath() . "upload/tour-package/thumb/" . $IMG);

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

    public function getTourPackagesById($id) {
        
        $allpackages = TourPackages::all();
        $array_res = array();
        foreach ($allpackages as $package) {
            $type = unserialize($package['type']);

            if (in_array($id, $type)) {
                array_push($array_res, $package);
            }
        }
        return $array_res;
    }

    public function getTourPackagesByIdForPagination($id, $pageLimit, $setLimit) {
//        $query = "SELECT * FROM `tour_packages` WHERE `type`= $id LIMIT " . $pageLimit . " , " . $setLimit . "";

        $allpackages = TourPackages::all();
        $array_res = array();
        foreach ($allpackages as $package) {
            $type = unserialize($package['type']);
            
            if (in_array($id, $type)) {
                array_push($array_res, $package);
            }
        }
        return $array_res;
    }

    public function showPaginationOfTour($id, $per_page, $page) {

        $page_url = "?";
        $query = "SELECT COUNT(*) as totalCount FROM `tour_packages` WHERE `type`= '" . $id . "' ORDER BY `sort` ASC";


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

}
