<?php

include_once(dirname(__FILE__) . '/Setting.php');
include_once(dirname(__FILE__) . '/Helper.php');
include_once(dirname(__FILE__) . '/Upload.php');
include_once(dirname(__FILE__) . '/Banner.php');
include_once(dirname(__FILE__) . '/Validator.php');
include_once(dirname(__FILE__) . '/Database.php');
include_once(dirname(__FILE__) . '/User.php');
include_once(dirname(__FILE__) . '/Message.php');
include_once(dirname(__FILE__) . '/TourPackages.php');
include_once(dirname(__FILE__) . '/TourType.php');
include_once(dirname(__FILE__) . '/TourPhotos.php');
include_once(dirname(__FILE__) . '/TourDate.php');
include_once(dirname(__FILE__) . '/TourDatePhoto.php');
include_once(dirname(__FILE__) . '/Comments.php');
include_once(dirname(__FILE__) . '/Slider.php');
include_once(dirname(__FILE__) . '/Page.php');
include_once(dirname(__FILE__) . '/Banner.php');
include_once(dirname(__FILE__) . '/DestinationType.php');
include_once(dirname(__FILE__) . '/Destination.php');
include_once(dirname(__FILE__) . '/DestinationPhotos.php');
include_once(dirname(__FILE__) . '/Drivers.php');
include_once(dirname(__FILE__) . '/DriverPhotos.php');
include_once(dirname(__FILE__) . '/Visitor.php');
include_once(dirname(__FILE__) . '/Reviews.php');
include_once(dirname(__FILE__) . '/City.php');
include_once(dirname(__FILE__) . '/Booking.php');

function dd($data) {
    var_dump($data);
    exit();
}
function redirect($url) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';

    echo $string;
    exit();
}
