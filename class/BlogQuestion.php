<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlogQuestion
 *
 * @author WJKN
 */
class BlogQuestion {

    public $id;
    public $subject;
    public $question;
    public $position;
    public $position_id;
    public $askedAt;
    public $location;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`subject`,`question`,`position`,`position_id`,`askedAt`,`location` FROM `blog_question` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->subject = $result['subject'];
            $this->question = $result['question'];
            $this->position = $result['position'];
            $this->position_id = $result['position_id'];
            $this->askedAt = $result['askedAt'];
            $this->location = $result['location'];

            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $askedAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `blog_question` (`subject`,`question`,`position`,`position_id`,`location`,`askedAt`) VALUES  ('"
                . $this->subject . "', '"
                . $this->question . "', '"
                . $this->position . "', '"
                . $this->position_id . "', '"
                . $this->location . "', '"
                . $askedAt . "')";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function all($pageLimit, $setLimit) {

        $query = "SELECT * FROM `blog_question` ORDER BY askedAt DESC LIMIT " . $pageLimit . " , " . $setLimit . "";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getUnansweredQuestions($pageLimit, $setLimit) {

        $query = "SELECT * FROM `blog_question` WHERE `id` not in (SELECT distinct(`question`) AS `answered_question` FROM `blog_answer`) ORDER BY `askedAt` DESC LIMIT " . $pageLimit . " , " . $setLimit . "";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getQuestionesByPosition($position, $position_id) {

        $query = "SELECT * FROM `blog_question` WHERE `position` LIKE '" . $position . "' AND `position_id` = " . $position_id . " ORDER BY `askedAt` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `blog_question` SET "
                . "`subject` ='" . $this->subject . "', "
                . "`question` ='" . $this->question . "', "
                . "`location` ='" . $this->location . "' "
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

        $query = 'DELETE FROM `blog_question` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getQuestionsCount() {

        $query = "SELECT count(id) AS 'count' FROM `blog_question`";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function getUnansweredQuestionsCount() {

        $query = "SELECT count(`id`) AS `count` FROM `blog_question` WHERE `id` not in (SELECT distinct(`question`) AS `answered_question` FROM `blog_answer`)";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function searchAll($keyword, $location, $pageLimit, $setLimit) {

        $w = array();
        $where = '';

        if (!empty($keyword)) {
            $w[] = "`subject` LIKE '%" . $keyword . "%' OR `question` LIKE '%" . $keyword . "%'";
        }
        if (!empty($location)) {
            $w[] = "`location` LIKE '%" . $location . "%'";
        }
        if (count($w)) {
            $where = 'WHERE ' . implode(' OR ', $w);
        }

        $query = "SELECT * FROM `blog_question` " . $where . " ORDER BY `askedAt` DESC LIMIT " . $pageLimit . " , " . $setLimit . "";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function searchUnansweredQuestions($keyword, $location, $pageLimit, $setLimit) {

        $w = array();
        $where = '';

        if (!empty($keyword)) {
            $w[] = "`subject` LIKE '%" . $keyword . "%' OR `question` LIKE '%" . $keyword . "%'";
        }
        if (!empty($location)) {
            $w[] = "`location` LIKE '%" . $location . "%'";
        }
        if (count($w)) {
            $where = 'AND ' . implode(' OR ', $w);
        }


        $query = "SELECT * FROM `blog_question` WHERE `id` not in (SELECT distinct(`question`) AS `answered_question` FROM `blog_answer`) " . $where . " ORDER BY `askedAt` DESC LIMIT " . $pageLimit . " , " . $setLimit . "";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getsearchAllCount($keyword, $location) {

        $w = array();
        $where = '';

        if (!empty($keyword)) {
            $w[] = "`subject` LIKE '%" . $keyword . "%' OR `question` LIKE '%" . $keyword . "%'";
        }
        if (!empty($location)) {
            $w[] = "`location` LIKE '%" . $location . "%'";
        }
        if (count($w)) {
            $where = 'WHERE ' . implode(' OR ', $w);
        }

        $query = "SELECT count(id) AS 'count' FROM `blog_question` " . $where . " ORDER BY `askedAt` DESC";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function getSearchUnansweredQuestionsCount($keyword, $location) {

        $w = array();
        $where = '';

        if (!empty($keyword)) {
            $w[] = "`subject` LIKE '%" . $keyword . "%' OR `question` LIKE '%" . $keyword . "%'";
        }
        if (!empty($location)) {
            $w[] = "`location` LIKE '%" . $location . "%'";
        }
        if (count($w)) {
            $where = 'AND ' . implode(' OR ', $w);
        }


        $query = "SELECT count(id) AS 'count' FROM `blog_question` WHERE `id` not in (SELECT distinct(`question`) AS `answered_question` FROM `blog_answer`) " . $where . " ORDER BY `askedAt` DESC";
        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function showPaginationOfBlogQuestions($per_page, $page) {

        $page_url = "?";
        $query = "SELECT COUNT(*) as totalCount FROM `blog_question` ORDER BY `askedAt` DESC";


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

    public function showPaginationOfBlogUnAnsweredQuestions($per_page, $page) {

        $page_url = "?";
        $query = "SELECT COUNT(*) as totalCount FROM `blog_question` WHERE `id` not in (SELECT distinct(`question`) AS `answered_question` FROM `blog_answer`) ORDER BY `askedAt` DESC";


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

    public function showPaginationOfSearchedBlogQuestions($keyword, $location, $per_page, $page) {

        $page_url = "?";

        $w = array();
        $where = '';

        if (!empty($keyword)) {
            $w[] = "`subject` LIKE '%" . $keyword . "%' OR `question` LIKE '%" . $keyword . "%'";
        }
        if (!empty($location)) {
            $w[] = "`location` LIKE '%" . $location . "%'";
        }
        if (count($w)) {
            $where = 'WHERE ' . implode(' OR ', $w);
        }

        $query = "SELECT count(*) AS totalCount FROM `blog_question` " . $where . " ORDER BY `askedAt` DESC";

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
                        $setPaginate .= "<li><a href='{$page_url}page=$counter&keyword=$keyword&location=$location&search='>$counter</a></li>";
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&keyword=$keyword&location=$location&search='>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>...</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1&keyword=$keyword&location=$location&search='>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&keyword=$keyword&location=$location&search='>$setLastpage</a></li>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $setPaginate .= "<li><a href='{$page_url}page=1&keyword=$keyword&location=$location&search='>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2&keyword=$keyword&location=$location&search='>2</a></li>";
                    $setPaginate .= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&keyword=$keyword&location=$location&search='>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>..</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1&keyword=$keyword&location=$location&search='>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&keyword=$keyword&location=$location&search='>$setLastpage</a></li>";
                }
                else {
                    $setPaginate .= "<li><a href='{$page_url}page=1&keyword=$keyword&location=$location&search='>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2&keyword=$keyword&location=$location&search='>2</a></li>";
                    $setPaginate .= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&keyword=$keyword&location=$location&search='>$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate .= "<li><a href='{$page_url}page=$next&keyword=$keyword&location=$location&search='>Next</a></li>";
                $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&keyword=$keyword&location=$location&search='>Last</a></li>";
            } else {
                $setPaginate .= "<li><a class='current_page'>Next</a></li>";
                $setPaginate .= "<li><a class='current_page'>Last</a></li>";
            }

            $setPaginate .= "</ul>\n";
        }

        echo $setPaginate;
    }

    public function showPaginationOfSearchedBlogUnAnsweredQuestions($keyword, $location, $per_page, $page) {

        $page_url = "?";

        $w = array();
        $where = '';

        if (!empty($keyword)) {
            $w[] = "`subject` LIKE '%" . $keyword . "%' OR `question` LIKE '%" . $keyword . "%'";
        }
        if (!empty($location)) {
            $w[] = "`location` LIKE '%" . $location . "%'";
        }
        if (count($w)) {
            $where = 'AND ' . implode(' OR ', $w);
        }


        $query = "SELECT count(*) AS totalCount FROM `blog_question` WHERE `id` not in (SELECT distinct(`question`) AS `answered_question` FROM `blog_answer`) " . $where . " ORDER BY `askedAt` DESC";


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
                        $setPaginate .= "<li><a href='{$page_url}page=$counter&keyword=$keyword&location=$location&search='>$counter</a></li>";
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&keyword=$keyword&location=$location&search='>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>...</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1&keyword=$keyword&location=$location&search='>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&keyword=$keyword&location=$location&search='>$setLastpage</a></li>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $setPaginate .= "<li><a href='{$page_url}page=1&keyword=$keyword&location=$location&search='>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2&keyword=$keyword&location=$location&search='>2</a></li>";
                    $setPaginate .= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&keyword=$keyword&location=$location&search='>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>..</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1&keyword=$keyword&location=$location&search='>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&keyword=$keyword&location=$location&search='>$setLastpage</a></li>";
                }
                else {
                    $setPaginate .= "<li><a href='{$page_url}page=1&keyword=$keyword&location=$location&search='>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2&keyword=$keyword&location=$location&search='>2</a></li>";
                    $setPaginate .= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&keyword=$keyword&location=$location&search='>$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate .= "<li><a href='{$page_url}page=$next&keyword=$keyword&location=$location&search='>Next</a></li>";
                $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&keyword=$keyword&location=$location&search='>Last</a></li>";
            } else {
                $setPaginate .= "<li><a class='current_page'>Next</a></li>";
                $setPaginate .= "<li><a class='current_page'>Last</a></li>";
            }

            $setPaginate .= "</ul>\n";
        }

        echo $setPaginate;
    }

}
