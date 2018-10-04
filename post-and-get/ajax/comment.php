<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'ADDCOMMENT') {

    $COMMENT = new BlogComment(NULL);

    
    $COMMENT->answer = $_POST['answer'];
    $COMMENT->comment = $_POST['comment'];
    $COMMENT->position = $_POST['position'];
    $COMMENT->position_id = $_POST['positionid'];

    $result = $COMMENT->create();

    if ($result) {
        $res = 'TRUE';
    } else {
        $res = 'FALSE';
    }

    header('Content-type: application/json');
    echo json_encode($res);
}