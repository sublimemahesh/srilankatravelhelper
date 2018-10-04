<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'ADDQUESTION') {

    $QUESTIONS = new BlogQuestion(NULL);

    $QUESTIONS->subject = $_POST['subject'];
    $QUESTIONS->question = $_POST['question'];
    $QUESTIONS->visitor = $_POST['visitor'];

    $result = $QUESTIONS->create();

    if ($result) {
        $res = 'TRUE';
    } else {
        $res = 'FALSE';
    }

    header('Content-type: application/json');
    echo json_encode($res);
}