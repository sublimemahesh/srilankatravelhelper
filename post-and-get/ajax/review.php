<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'GETTOTALREVIEWS') {

    $REVIEW = Reviews::getTotalReviewsOfDriver($_POST['id']);

    if ($REVIEW['count'] == 0) {
        $result = 0;
    } else {
        $result = $REVIEW;
    }

    header('Content-type: application/json');
    echo json_encode($result);
}

