<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] == 'GETNAME') {
    
    if (!empty($_POST["keyword"])) {
        $QUESTION = new BlogQuestion(NULL);

        $result = $QUESTION->searchSubject($_POST["keyword"]);

        header('Content-Type: application/json');

        echo json_encode($result);
        exit();
    }
}