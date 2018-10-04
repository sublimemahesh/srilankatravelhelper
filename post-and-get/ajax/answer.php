<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'ADDANSWER') {

    $ANSWER = new BlogAnswer(NULL);

    $ANSWER->question = $_POST['question'];
    $ANSWER->answer = $_POST['answer'];
    $ANSWER->position = $_POST['position'];
    $ANSWER->position_id = $_POST['positionid'];

    $result = $ANSWER->create();

    if ($result) {
        $res = 'TRUE';
    } else {
        $res = 'FALSE';
    }

    header('Content-type: application/json');
    echo json_encode($res);
}