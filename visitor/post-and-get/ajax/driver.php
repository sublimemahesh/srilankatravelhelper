<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');


if ($_POST['option'] === 'GETDRIVERDETAILS') {
    
    $DRIVER = new Drivers($_POST['id']);


    header('Content-type: application/json');
    echo json_encode($DRIVER);
}
if ($_POST['option'] === 'GETDRIVERPHOTOS') {
    
    $photos = DriverPhotos::getDriverPhotosByDriver($_POST['id']);

    foreach ($photos as $key=>$photo) {
        if($key == 0) {
            $img = $photo['image_name'];
        }
        
    }
    
    

    header('Content-type: application/json');
    echo json_encode($img);
}


