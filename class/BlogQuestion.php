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
    public $visitor;
    public $askedAt;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`subject`,`question`,`visitor`,`askedAt` FROM `blog_question` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->subject = $result['subject'];
            $this->question = $result['question'];
            $this->visitor = $result['visitor'];
            $this->askedAt = $result['askedAt'];

            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $askedAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `blog_question` (`subject`,`question`,`visitor`,`askedAt`) VALUES  ('"
                . $this->subject . "', '"
                . $this->question . "', '"
                . $this->visitor . "', '"
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

        $query = "SELECT * FROM `blog_question` ORDER BY askedAt ASC";
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
                . "`visitor` ='" . $this->visitor . "', "
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
//        dd($query);
        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

}
