<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlogAnswer
 *
 * @author WJKN
 */
class BlogAnswer {

    public $id;
    public $question;
    public $answer;
    public $position;
    public $position_id;
    public $answeredAt;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`question`,`answer`,`position`,`position_id`,`answeredAt` FROM `blog_answer` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->question = $result['question'];
            $this->answer = $result['answer'];
            $this->position = $result['position'];
            $this->position_id = $result['position_id'];
            $this->answeredAt = $result['answeredAt'];

            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $answeredAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `blog_answer` (`question`,`answer`,`position`,`position_id`,`answeredAt`) VALUES  ('"
                . $this->question . "','"
                . $this->answer . "','"
                . $this->position . "', '"
                . $this->position_id . "', '"
                . $answeredAt . "')";

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

        $query = "SELECT * FROM `blog_answer` ORDER BY answeredAt DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `blog_answer` SET "
                . "`question` ='" . $this->question . "', "
                . "`answer` ='" . $this->answer . "', "
                . "`position` ='" . $this->position . "', "
                . "`position_id` ='" . $this->position_id . "', "
                . "`answeredAt` ='" . $this->answeredAt . "' "
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

        $query = 'DELETE FROM `blog_answer` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getAnswersByQuestions($question) {

        $query = "SELECT * FROM `blog_answer` WHERE `question`= $question ORDER BY `answeredAt` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getAnswerCountByQuestion($question) {

        $query = "SELECT count(id) AS 'count' FROM `blog_answer` WHERE `question`= $question";
//        dd($query);
        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }


}
