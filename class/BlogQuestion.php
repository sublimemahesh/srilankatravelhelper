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

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`subject`,`question`,`position`,`position_id`,`askedAt` FROM `blog_question` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->subject = $result['subject'];
            $this->question = $result['question'];
            $this->position = $result['position'];
            $this->position_id = $result['position_id'];
            $this->askedAt = $result['askedAt'];

            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $askedAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `blog_question` (`subject`,`question`,`position`,`position_id`,`askedAt`) VALUES  ('"
                . $this->subject . "', '"
                . $this->question . "', '"
                . $this->position . "', '"
                . $this->position_id . "', '"
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

    public function all() {

        $query = "SELECT * FROM `blog_question` ORDER BY askedAt DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getUnansweredQuestions() {

        $query = "SELECT * FROM `blog_question` WHERE `id` not in (SELECT distinct(`question`) AS `answered_question` FROM `blog_answer`) ORDER BY `askedAt` DESC";
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
                . "`position` ='" . $this->position . "', "
                . "`position_id` ='" . $this->position_id . "', "
                . "`askedAt` ='" . $this->askedAt . "' "
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

}
