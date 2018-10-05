<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'ADDQUESTION') {

    $QUESTIONS = new BlogQuestion(NULL);

    $QUESTIONS->subject = $_POST['subject'];
    $QUESTIONS->question = $_POST['question'];
    $QUESTIONS->position = $_POST['position'];
    $QUESTIONS->position_id = $_POST['positionid'];

    $result = $QUESTIONS->create();

    if ($result) {
        $res = 'TRUE';
    } else {
        $res = 'FALSE';
    }

    header('Content-type: application/json');
    echo json_encode($res);
}