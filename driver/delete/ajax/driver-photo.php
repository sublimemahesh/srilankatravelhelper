<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $DRIVERPHOTO = new DriverPhotos($_POST['id']);

    unlink('../../../upload/drivers/driver-photos/' . $DRIVERPHOTO->image_name);
    unlink('../../../upload/drivers/driver-photos/thumb/' . $DRIVERPHOTO->image_name);
    unlink('../../../upload/drivers/driver-photos/thumb1/' . $DRIVERPHOTO->image_name);

    $result = $DRIVERPHOTO->delete();


    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}