<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlogComment
 *
 * @author User
 */
class BlogComment {

    public $id;
    public $answer;
    public $comment;
    public $position;
    public $position_id;
    public $commentedAt;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`answer`,`comment`,`position`,`position_id`,`commentedAt` FROM `blog_comment` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->answer = $result['answer'];
            $this->comment = $result['comment'];
            $this->position = $result['position'];
            $this->position_id = $result['position_id'];
            $this->commentedAt = $result['commentedAt'];

            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $commentedAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `blog_comment` (`answer`,`comment`,`position`,`position_id`,`commentedAt`) VALUES  ('"
                . $this->answer . "','"
                . $this->comment . "','"
                . $this->position . "', '"
                . $this->position_id . "', '"
                . $commentedAt . "')";

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

        $query = "SELECT * FROM `blog_comment` ORDER BY commentedAt ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `blog_comment` SET "
                . "`answer` ='" . $this->answer . "', "
                . "`comment` ='" . $this->comment . "', "
                . "`position` ='" . $this->position . "', "
                . "`position_id` ='" . $this->position_id . "', "
                . "`commentedAt` ='" . $this->commentedAt . "' "
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

        $this->deleteDatesPhotos();

        $query = 'DELETE FROM `blog_comment` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getCommentsByAnswer($answer) {

        $query = "SELECT * FROM `blog_comment` WHERE `answer`= $answer ORDER BY `commentedAt` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getCommentCountByAnswers($answer) {

        $query = "SELECT count(id) AS 'count' FROM `blog_comment` WHERE `answer`= $answer ORDER BY `commentedAt` ASC";
//        dd($query);
        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

}
