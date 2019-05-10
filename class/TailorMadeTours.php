<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TailorMadeTours
 *
 * @author U s E r ¨
 */
class TailorMadeTours {

    public $id;
    public $date_time_booked;
    public $places;
    public $visitor;
    public $driver;
    public $no_of_adults;
    public $no_of_children;
    public $start_date;
    public $end_date;
    public $message;
    public $price;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`date_time_booked`,`places`,`visitor`,`no_of_adults`,`no_of_children`,`driver`,`start_date`,`end_date`,`message`,`price`,`status` FROM `tailormade_tours` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->date_time_booked = $result['date_time_booked'];
            $this->places = $result['places'];
            $this->visitor = $result['visitor'];
            $this->no_of_adults = $result['no_of_adults'];
            $this->no_of_children = $result['no_of_children'];
            $this->driver = $result['driver'];
            $this->start_date = $result['start_date'];
            $this->end_date = $result['end_date'];
            $this->message = $result['message'];
            $this->price = $result['price'];
            $this->status = $result['status'];

            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $status = 'active';

//        $query = "INSERT INTO `tailormade_tours` (`date_time_booked`,`places`,`visitor`,`no_of_adults`,`no_of_children`,`driver`,`start_date`,`end_date`,`message`,`status`) VALUES  ('"
        $query = "INSERT INTO `tailormade_tours` (`date_time_booked`,`places`,`visitor`,`no_of_adults`,`no_of_children`,`start_date`,`end_date`,`message`,`status`) VALUES  ('"
                . $createdAt . "', '"
                . $this->places . "', '"
                . $this->visitor . "', '"
                . $this->no_of_adults . "', '"
                . $this->no_of_children . "', '"
//                . $this->driver . "', '"
                . $this->start_date . "', '"
                . $this->end_date . "', '"
                . $this->message . "', '"
                . $status . "')";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
        dd($result);
    }

    public function all() {

        $query = "SELECT * FROM `tailormade_tours` ORDER BY date_time_booked ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `tailormade_tours` SET "
                . "`no_of_adults` ='" . $this->no_of_adults . "', "
                . "`no_of_children` ='" . $this->no_of_children . "', "
                . "`start_date` ='" . $this->start_date . "', "
                . "`end_date` ='" . $this->end_date . "', "
                . "`message` ='" . $this->message . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function setPrice() {

        $query = "UPDATE  `tailormade_tours` SET "
                . "`price` ='" . $this->price . "' "
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

        $query = 'DELETE FROM `tailormade_tours` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getActiveBookingsByDriver($driver) {

//        $query = "SELECT * FROM `tailormade_tours` WHERE `driver`= $driver AND `status` like 'active' ORDER BY `date_time_booked` DESC";
        $query = " SELECT * FROM `tailormade_tours` WHERE `driver` In(SELECT `driver_id` FROM `driver_booking` where `driver_id`=$driver ORDER BY `date_time_booked` DESC)";
        $db = new Database();
        dd($query);
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getCanceledBookingsByDriver($driver) {

        $query = "SELECT * FROM `tailormade_tours` WHERE `driver`= $driver AND `status` = 'canceled' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getConfirmedBookingsByDriver($driver) {

        $query = "SELECT * FROM `tailormade_tours` WHERE `driver`= $driver AND `status` = 'confirmed' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getActiveBookingsByVisitor($visitor) {

        $query = "SELECT * FROM `tailormade_tours` WHERE `visitor`= $visitor AND `status` like 'active' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getCanceledBookingsByVisitor($visitor) {

        $query = "SELECT * FROM `tailormade_tours` WHERE `visitor`= $visitor AND `status` = 'canceled' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getConfimedBookingsByVisitor($visitor) {

        $query = "SELECT * FROM `tailormade_tours` WHERE `visitor`= $visitor AND `status` = 'confirmed' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getActiveBookings() {

        $query = "SELECT * FROM `tailormade_tours` WHERE `status` like 'active' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getCanceledBookings() {

        $query = "SELECT * FROM `tailormade_tours` WHERE `status` = 'canceled' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function cancelBooking() {

        $query = "UPDATE  `tailormade_tours` SET "
                . "`status` ='canceled' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function confirmBooking($driverid, $price, $booking) {
    
        $query = "UPDATE  `tailormade_tours` SET "
                . "`driver` ='" . $driverid . "', "
                . "`price` ='" . $price . "', "
                . "`status` ='confirmed' "
                . "WHERE `id` = '" . $this->id . "'";
               
        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public static function sendBookingConfirmationEmailToVisitor($tailormade_tour_id) {

        //----------------------Company Information---------------------

        $from = 'info@toursrilanka.travel';
        $reply = 'info@toursrilanka.travel';

        $subject = "Tailor-Made New Booking Request | Tour Sri Lanka | " . $tailormade_tour_id . "";
        $site = 'toursrilanka.travel';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $TAILORMADETOURS = new TailorMadeTours($tailormade_tour_id);

        $DRIVER = new Drivers($TAILORMADETOURS->driver);
        $VISITOR = new Visitor($TAILORMADETOURS->visitor);


        $visitor_email = $VISITOR->email;


        if ($TAILORMADETOURS->message) {
            $specialrequest = ' <tr>
                                    <td colspan="2"><strong><u>Special Request</u></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">' . $TAILORMADETOURS->message . '</td>
                                </tr>';
        }

        $destination_list = '';
        $places = unserialize($TAILORMADETOURS->places);

        foreach ($places as $place) {
            $DESTINATION = new Destination($place);
            $destination_list .= '<li>' . $DESTINATION->name . '</li>';
        }


        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>' . "Tour Sri Lanka - Tailor-Made Tour Booking Confirmation" . '</title>
                            <style type="text/css">
                                table {
                                    border: 1px solid #d0d0d0;
                                }
                                th {
                                    border-bottom: 1px solid #d0d0d0;
                                    padding: 15px 10px 10px 25px;
                                    text-align: left;
                                    margin: 0px;
                                }
                                td {
                                    padding: 10px 10px 5px 10px;
                                    text-align: left;
                                    margin: 0px;
                                }
                                ul {
                                    list-style-type: square;
                                    margin: 0px 20px 30px 200px;
                                }
                                li {
                                    padding: 5px;
                                }
                                img {
                                    width: 120px;
                                    margin: 0px auto;
                                }
                                .bdr {
                                    border-left: 1px solid #d0d0d0;
                                }
                                .bdr-top {
                                    border-top: 1px solid #d0d0d0;
                                }
                                .bb {
                                    font-weight: bold;
                                }
                                .right {
                                    text-align: right;
                                }
                                .table {
                                    margin-left:150px;
                                }
                                .topic {
                                    font-size:22px;
                                    text-align:center;
                                    color:#00a1ad;
                                }
                                .sal {
                                    margin-left:100px;
                                }
                                .desc {
                                    margin-left:150px;
                                    text-align:justify;
                                    margin-right:100px;
                                }
                                .bor {
                                    border:1px solid #000;
                                }
                                .booking-details {
                                    margin-left:150px;
                                    border: none !important;
                                    margin-right:100px;
                                }
                                .footer{
                                    width:100%;
                                    margin-top: 20px;
                                    background-color:#00a1ad;
                                    color: #fff;
                                    padding-top:20px;
                                    padding-bottom:30px;
                                }
                                .footer-tr {
                                    font-size: 15px;
                                    line-height: 2px;
                                }
                                .footer-td1 {
                                    width: 150px;
                                }
                                .footer-td2 {
                                    width: 35%;
                                }
                                .header{
                                    width:100%;
                                    margin-top: 20px;
                                    background-color: #1eed3de6;
                                    color: #fff;
                                    padding-top:20px;
                                    padding-bottom:30px;
                                }
                                  .header-td1 {
                                    width: 150px;
                                }
                                @media (max-width: 480px) {
                                    ul { font-size: 14px; }
                                    td { font-size: 12px; }
                                    .table {margin-left:0px;}
                                    .desc {margin-left:20px; text-align:justify; margin-right:10px;}
                                    .sal {margin-left:10px;}
                                    .booking-details {margin-left:10px; border: none !important; margin-right:10px;}
                                    ul {list-style-type: square; margin: 0px 20px 30px 10px;}
                                    .footer-tr {font-size: 15px; line-height: 15px;}
                                    .footer-td1 { width: 0px;}
                                    .footer-td2 {width: 50%;}
                                    .table-td1 {width: 20%;}
                                }
                                
                            </style>
                        </head>
                        <body class="bor">
                        <table class="header">
                                <tr>
                                    <td class="header-td1"></td>
                                    <td colspan="2" style="font-size: 15px;"><strong>Tour Sri Lanka</strong></td>
                                </tr>
                                
                                
                                
                            </table>


                            <div style="width: 100%; text-align: center; font-size: 20px; margin: 10px 0px 30px 0px;">
                                <!--            <b style="font-size: 25px; text-decoration: underline;">Coral Sands Hotel</b><br/>-->
                                   <img src="https://' . $site . '/images/logo/logo.png" alt="Tour Sri Lanka"/><br/>
                            </div>
                            <h2 class="topic">Tailor-Made New Booking Request  | Tour Sri Lanka | #' . $tailormade_tour_id . '</h2>
                            <h4 class="sal"><strong>Dear ' . $VISITOR->name . '</strong></h4>
                            <div class="desc">
                                <p>Thank you for making an online booking with Tour Sri Lanka. Your booking id is :  #' . $tailormade_tour_id . '. Your booking is subject to the terms & conditions listed on the website. </p>
                                
                            </div>
                            
                            <table class="booking-details">
                                <tr>
                                   <td><strong>Booking Id.</strong></td>
                                  <td><strong>:  #' . $tailormade_tour_id . '</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Booking Date</strong></td>
                                    <td><strong>: ' . $TAILORMADETOURS->date_time_booked . '</strong></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong><u>Visitor Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Visitor name</td>
                                    <td>: ' . $VISITOR->name . '</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>: country</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: ' . $VISITOR->email . '</td>
                                </tr>
                                <tr>
                                    <td>Mobile Number</td>
                                    <td>: ' . $VISITOR->contact_number . '</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong><u>Tailor-made Tour Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Selected Destinations</td>
                                    <td><ul>' . $destination_list . '</ul></td>
                                </tr>
                                <tr>
                                    <td>Start Date</td>
                                    <td>: ' . $TAILORMADETOURS->start_date . '</td>
                                </tr>
                                <tr>
                                    <td>End Date</td>
                                    <td>: ' . $TAILORMADETOURS->end_date . '</td>
                                </tr><tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong><u>Driver Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Driver name</td>
                                    <td>: ' . $DRIVER->name . '</td>
                                </tr>
                               
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                

                            </table>
                            
                            <br>
                            <table class="booking-details">
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                ' . $specialrequest . '
                                <tr>
                                    <td colspan="2"><strong><u>Cancellation Policy</u></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <ul>
                                            <li>If cancelled 7 days prior to arrival date : 0% of the booking value will be charged as a Cancellation Fee.</li>
                                            <li>If cancelled within 1 to 6 days of the arrival date: 100 % of the booking value will be charged as Cancellation Fee.</li>
                                            <li>No Show : 100% of the booking value will be charged as a Cancellation Fee.</li>
                                            <li>Booking cancellations should be notified via email to info@toursrilanka.travel</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                            
                            <table class="footer">
                                <tr>
                                    <td class="footer-td1"></td>
                                    <td colspan="2" style="font-size: 15px;"><strong>Thank You !</strong></td>
                                </tr>
                                <tr class="footer-tr">
                                    <td></td>
                                    <td class="footer-td2">Tour Sri Lanka</td>
                                    <td>Phone: +94 91 227 7513</td>
                                </tr>
                                <tr class="footer-tr">
                                    <td></td>
                                    <td><a href="" style="text-decoration:none;color: #fff;">No.326, Galle Rd, Hikkaduwa, Sri Lanka</a></td>
                                    <td>Email: info@toursrilanka.travel</td>
                                </tr>
                                
                            </table>
                            </body>
                        </html>';

        if (mail($visitor_email, $subject, $html, $headers)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function sendBookingConfirmationEmailToDriver($tailormade_tour_id, $driver_id, $visitor) {

        //----------------------Company Information---------------------

        $from = 'info@toursrilanka.travel';
        $reply = 'info@toursrilanka.travel';

        $subject = "Tailor-Made Tour New Price Offer | Tour Sri Lanka | " . $tailormade_tour_id . "";
        $site = 'toursrilanka.travel';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $TAILORMADETOURS = new TailorMadeTours($tailormade_tour_id);

        $DRIVER = new Drivers($driver_id);

        $VISITOR = new Visitor($visitor);


        $driver_email = $DRIVER->email;


        if ($TAILORMADETOURS->message) {
            $specialrequest = ' <tr>
                                    <td colspan="2"><strong><u>Special Request</u></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">' . $TAILORMADETOURS->message . '</td>
                                </tr>';
        }
        $destination_list = '';
        $places = unserialize($TAILORMADETOURS->places);

        foreach ($places as $place) {
            $DESTINATION = new Destination($place);
            $destination_list .= '<li>' . $DESTINATION->name . '</li>';
        }

        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>' . "Tailor-Made Tour New Price Offer | Tour Sri Lanka " . '</title>
                            <style type="text/css">
                                table {
                                    border: 1px solid #d0d0d0;
                                }
                                th {
                                    border-bottom: 1px solid #d0d0d0;
                                    padding: 15px 10px 10px 25px;
                                    text-align: left;
                                    margin: 0px;
                                }
                                td {
                                    padding: 10px 10px 5px 10px;
                                    text-align: left;
                                    margin: 0px;
                                }
                                ul {
                                    list-style-type: square;
                                    margin: 0px 20px 30px 200px;
                                }
                                li {
                                    padding: 5px;
                                }
                                img {
                                    width: 120px;
                                    margin: 0px auto;
                                }
                                .bdr {
                                    border-left: 1px solid #d0d0d0;
                                }
                                .bdr-top {
                                    border-top: 1px solid #d0d0d0;
                                }
                                .bb {
                                    font-weight: bold;
                                }
                                .right {
                                    text-align: right;
                                }
                                .table {
                                    margin-left:150px;
                                }
                                .topic {
                                    font-size:22px;
                                    text-align:center;
                                    color:#00a1ad;
                                }
                                .sal {
                                    margin-left:100px;
                                }
                                .desc {
                                    margin-left:150px;
                                    text-align:justify;
                                    margin-right:100px;
                                }
                                .bor {
                                    border:1px solid #000;
                                }
                                .booking-details {
                                    margin-left:150px;
                                    border: none !important;
                                    margin-right:100px;
                                }
                                .footer{
                                    width:100%;
                                    margin-top: 20px;
                                    background-color:#00a1ad;
                                    color: #fff;
                                    padding-top:20px;
                                    padding-bottom:30px;
                                }
                                .footer-tr {
                                    font-size: 15px;
                                    line-height: 2px;
                                }
                                .footer-td1 {
                                    width: 150px;
                                }
                                .footer-td2 {
                                    width: 35%;
                                }
                                @media (max-width: 480px) {
                                    ul { font-size: 14px; }
                                    td { font-size: 12px; }
                                    .table {margin-left:0px;}
                                    .desc {margin-left:20px; text-align:justify; margin-right:10px;}
                                    .sal {margin-left:10px;}
                                    .booking-details {margin-left:10px; border: none !important; margin-right:10px;}
                                    ul {list-style-type: square; margin: 0px 20px 30px 10px;}
                                    .footer-tr {font-size: 15px; line-height: 15px;}
                                    .footer-td1 { width: 0px;}
                                    .footer-td2 {width: 50%;}
                                    .table-td1 {width: 20%;}
                                }
                                a.button {
                                    background-color: #66676b;
                                    top: 0;
                                    padding: 9px 20px;
                                    color: #fff;
                                    position: relative;
                                    font-size: 15px;
                                    font-weight: 600;
                                    display: inline-block;
                                    transition: all .2s ease-in-out;
                                    cursor: pointer;
                                    margin-right: 6px;
                                    overflow: hidden;
                                    border: 0;
                                    border-radius: 50px;
                                }
                                a.button{
                                background-color: #0dce38;
                                color: #fff;
                                }
                                
                            </style>
                        </head>
                        <body class="bor">
                            <div style="width: 100%; text-align: center; font-size: 20px; margin: 10px 0px 30px 0px;">
                                <!--            <b style="font-size: 25px; text-decoration: underline;">Coral Sands Hotel</b><br/>-->
                                <img src="http://' . $site . '/images/logo/logo.png" alt="toursrilanka"/><br/>
                                <span><a href="" style="text-decoration:none;color: #000;">Contact</a></span><br/>
                                <span>Email: info@toursrilanka.travel</span><br/>
                                <span>Phone: +94 91 227 7513 / +94 91 227 7436</span>
                            </div>
                            <h2 class="topic">Tailor-Made Tour New Price Offer | Tour Sri Lanka | #' . $tailormade_tour_id . '</h2>
                            <h4 class="sal"><strong>Dear ' . $DRIVER->name . '</strong></h4>
                            
                            
                            <table class="booking-details">
                                <tr>
                                    <td><strong>Booking Id.</strong></td>
                                    <td><strong>:  #' . $tailormade_tour_id . '</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Booking date & Time</strong></td>
                                    <td><strong>: ' . $TAILORMADETOURS->date_time_booked . '</strong></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong><u>Visitor Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Visitor name</td>
                                    <td>: ' . $VISITOR->name . '</td>
                                </tr>
                                     <tr>
                                    <td>Email</td>
                                    <td>: ' . $VISITOR->email . '</td>
                                </tr>
                                     <tr>
                                    <td>Contact Number</td>
                                    <td>: ' . $VISITOR->contact_number . '</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>: country</td>
                                </tr>
                              
                              
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong><u>Tailor-made Tour Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Selected Destinations</td>
                                    <td>: <ul>' . $destination_list . '</ul></td>
                                </tr>
                                <tr>
                                    <td>Start Date</td>
                                    <td>: ' . $TAILORMADETOURS->start_date . '</td>
                                </tr>
                                <tr>
                                    <td>End Date</td>
                                    <td>: ' . $TAILORMADETOURS->end_date . '</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                

                            </table>
                            
                            <br>
                            <table class="booking-details">
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                ' . $specialrequest . '
                                <tr>
                                    <td colspan="2"><strong><u> Click here Set Your Price For Booking </u></strong></td>
                                </tr>
                                <tr>
                                    <a href="https://www.toursrilanka.travel/driver/manage-active-tailormade-bookings.php" class="btncolor1 button margin-top-25 mt-xs-8 mb-xs-8 mt-sm-8 mb-sm-15 ">Set Your Price</a>
                                </tr>
                            </table>
                            
                            <table class="footer">
                                <tr>
                                    <td class="footer-td1"></td>
                                    <td colspan="2" style="font-size: 15px;"><strong>Thank You !</strong></td>
                                </tr>
                                <tr class="footer-tr">
                                    <td></td>
                                    <td class="footer-td2">Tour Sri Lanka</td>
                                    <td>Phone: +94 91 227 7513</td>
                                </tr>
                                <tr class="footer-tr">
                                    <td></td>
                                    <td><a href="" style="text-decoration:none;color: #fff;">No.326, Galle Rd, Hikkaduwa, Sri Lanka</a></td>
                                    <td>Email: info@toursrilanka.travel</td>
                                </tr>
                                
                            </table>
                            </body>
                        </html>';


        if (mail($driver_email, $subject, $html, $headers)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function sendBookingConfirmationEmailToAdmin($tailormade_tour_id) {

        //----------------------Company Information---------------------

        $from = 'info@toursrilanka.travel';
        $reply = 'info@toursrilanka.travel';

        $subject = "Tailor-Made Tour Booking Confirmation | Tour Sri Lanka | " . $tailormade_tour_id . "";
        $site = 'toursrilanka.travel';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $TAILORMADETOURS = new TailorMadeTours($tailormade_tour_id);

        $DRIVER = new Drivers($TAILORMADETOURS->driver);
        $VISITOR = new Visitor($TAILORMADETOURS->visitor);
        $USER = new User(1);

        $visitor_email = $VISITOR->email;
        $admin_email = $USER->email;

        if ($TAILORMADETOURS->message) {
            $specialrequest = ' <tr>
                                    <td colspan="2"><strong><u>Special Request</u></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">' . $TAILORMADETOURS->message . '</td>
                                </tr>';
        }
        $destination_list = '';
        $places = unserialize($TAILORMADETOURS->places);

        foreach ($places as $place) {
            $DESTINATION = new Destination($place);
            $destination_list .= '<li>' . $DESTINATION->name . '</li>';
        }

        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>' . "Tour Sri Lanka - Tailor-Made Tour Booking Confirmation" . '</title>
                            <style type="text/css">
                                table {
                                    border: 1px solid #d0d0d0;
                                }
                                th {
                                    border-bottom: 1px solid #d0d0d0;
                                    padding: 15px 10px 10px 25px;
                                    text-align: left;
                                    margin: 0px;
                                }
                                td {
                                    padding: 10px 10px 5px 10px;
                                    text-align: left;
                                    margin: 0px;
                                }
                                ul {
                                    list-style-type: square;
                                    margin: 0px 20px 30px 200px;
                                }
                                li {
                                    padding: 5px;
                                }
                                img {
                                    width: 120px;
                                    margin: 0px auto;
                                }
                                .bdr {
                                    border-left: 1px solid #d0d0d0;
                                }
                                .bdr-top {
                                    border-top: 1px solid #d0d0d0;
                                }
                                .bb {
                                    font-weight: bold;
                                }
                                .right {
                                    text-align: right;
                                }
                                .table {
                                    margin-left:150px;
                                }
                                .topic {
                                    font-size:22px;
                                    text-align:center;
                                    color:#00a1ad;
                                }
                                .sal {
                                    margin-left:100px;
                                }
                                .desc {
                                    margin-left:150px;
                                    text-align:justify;
                                    margin-right:100px;
                                }
                                .bor {
                                    border:1px solid #000;
                                }
                                .booking-details {
                                    margin-left:150px;
                                    border: none !important;
                                    margin-right:100px;
                                }
                                .footer{
                                    width:100%;
                                    margin-top: 20px;
                                    background-color:#00a1ad;
                                    color: #fff;
                                    padding-top:20px;
                                    padding-bottom:30px;
                                }
                                .footer-tr {
                                    font-size: 15px;
                                    line-height: 2px;
                                }
                                .footer-td1 {
                                    width: 150px;
                                }
                                .footer-td2 {
                                    width: 35%;
                                }
                                @media (max-width: 480px) {
                                    ul { font-size: 14px; }
                                    td { font-size: 12px; }
                                    .table {margin-left:0px;}
                                    .desc {margin-left:20px; text-align:justify; margin-right:10px;}
                                    .sal {margin-left:10px;}
                                    .booking-details {margin-left:10px; border: none !important; margin-right:10px;}
                                    ul {list-style-type: square; margin: 0px 20px 30px 10px;}
                                    .footer-tr {font-size: 15px; line-height: 15px;}
                                    .footer-td1 { width: 0px;}
                                    .footer-td2 {width: 50%;}
                                    .table-td1 {width: 20%;}
                                }
                                
                            </style>
                        </head>
                        <body class="bor">
                            <div style="width: 100%; text-align: center; font-size: 20px; margin: 10px 0px 30px 0px;">
                                <!--            <b style="font-size: 25px; text-decoration: underline;">Coral Sands Hotel</b><br/>-->
                                <img src="https://' . $site . '/images/logo/logo.png" alt="toursrilanka"/><br/>
                                <span><a href="" style="text-decoration:none;color: #000;">Contact</a></span><br/>
                                <span>Email: info@toursrilanka.travel</span><br/>
                                <span>Phone: +94 91 227 7513 / +94 91 227 7436</span>
                            </div>
                            <h2 class="topic">Tailor-Made Tour Booking Confirmation | Tour Sri Lanka | #' . $tailormade_tour_id . '</h2>
                            <h4 class="sal"><strong>Dear ' . $VISITOR->name . '</strong></h4>
                            
                            <table class="booking-details">
                                <tr>
                                    <td><strong>Booking Id.</strong></td>
                                    <td><strong>:  #' . $tailormade_tour_id . '</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Booking Date</strong></td>
                                    <td><strong>: ' . $TAILORMADETOURS->date_time_booked . '</strong></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong><u>Visitor Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Visitor Id</td>
                                    <td>: ' . $VISITOR->id . '</td>
                                </tr>
                                <tr>
                                    <td>Visitor name</td>
                                    <td>: ' . $VISITOR->name . '</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>: country</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: ' . $VISITOR->email . '</td>
                                </tr>
                                <tr>
                                    <td>Mobile Number</td>
                                    <td>: ' . $VISITOR->contact_number . '</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong><u>Tailor-made Tour Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Tour Package Id</td>
                                    <td>: ' . $tailormade_tour_id . '</td>
                                </tr>
                                <tr>
                                    <td valign="top">Selected Destinations</td>
                                    <td>: <ul>' . $destination_list . '</ul></td>
                                </tr>
                                <tr>
                                    <td>Start Date</td>
                                    <td>: ' . $TAILORMADETOURS->start_date . '</td>
                                </tr>
                                <tr>
                                    <td>End Date</td>
                                    <td>: ' . $TAILORMADETOURS->end_date . '</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong><u>Driver Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Drive Id</td>
                                    <td>: ' . $DRIVER->id . '</td>
                                </tr>
                                <tr>
                                    <td>Drive name</td>
                                    <td>: ' . $DRIVER->name . '</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: ' . $DRIVER->email . '</td>
                                </tr>
                                <tr>
                                    <td>Mobile Number</td>
                                    <td>: ' . $DRIVER->contact_number . '</td>
                                </tr>
                                <tr>
                                    <td>Driving Licence Number</td>
                                    <td>: ' . $DRIVER->driving_licence_number . '</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                

                            </table>
                            
                            <br>
                            <table class="booking-details">
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                ' . $specialrequest . '
                                <tr>
                                    <td colspan="2"><strong><u>Cancellation Policy</u></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <ul>
                                            <li>If cancelled 7 days prior to arrival date : 0% of the booking value will be charged as a Cancellation Fee.</li>
                                            <li>If cancelled within 1 to 6 days of the arrival date: 100 % of the booking value will be charged as Cancellation Fee.</li>
                                            <li>No Show : 100% of the booking value will be charged as a Cancellation Fee.</li>
                                            <li>Booking cancellations should be notified via email to info@toursrilanka.travel</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                            
                            <table class="footer">
                                <tr>
                                    <td class="footer-td1"></td>
                                    <td colspan="2" style="font-size: 15px;"><strong>Thank You !</strong></td>
                                </tr>
                                <tr class="footer-tr">
                                    <td></td>
                                    <td class="footer-td2">Tour Sri Lanka</td>
                                    <td>Phone: +94 91 227 7513</td>
                                </tr>
                                <tr class="footer-tr">
                                    <td></td>
                                    <td><a href="" style="text-decoration:none;color: #fff;">No.326, Galle Rd, Hikkaduwa, Sri Lanka</a></td>
                                    <td>Email: info@toursrilanka.travel</td>
                                </tr>
                                
                            </table>
                            </body>
                        </html>';

        if (mail($admin_email, $subject, $html, $headers)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function sendSetPriceEmailToVisitor($tailormade_tour_id, $driverid, $price) {
        
        //----------------------Company Information---------------------

        $from = 'info@toursrilanka.travel';
        $reply = 'info@toursrilanka.travel';

        $subject = "Tailor Made New Price Offer  | Tour Sri Lanka | " . $tailormade_tour_id . "";
        $site = 'toursrilanka.travel';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $TAILORMADETOURS = new TailorMadeTours($tailormade_tour_id);
        $DRIVERBOOKING = new DriverBooking();
        $DRIVER = new Drivers($driverid);
        $VISITOR = new Visitor($TAILORMADETOURS->visitor);


        $visitor_email = $VISITOR->email;
       

        $destination_list = '';
        $places = unserialize($TAILORMADETOURS->places);

        foreach ($places as $place) {
            $DESTINATION = new Destination($place);
            $destination_list .= '<li>' . $DESTINATION->name . '</li>';
        }


        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>' . "Tour Sri Lanka - Tailor Made Tour Booking" . '</title>
                            <style type="text/css">
                                table {
                                    border: 1px solid #d0d0d0;
                                }
                                th {
                                    border-bottom: 1px solid #d0d0d0;
                                    padding: 15px 10px 10px 25px;
                                    text-align: left;
                                    margin: 0px;
                                }
                                td {
                                    padding: 10px 10px 5px 10px;
                                    text-align: left;
                                    margin: 0px;
                                }
                                ul {
                                    list-style-type: square;
                                    margin: 0px 20px 30px 200px;
                                }
                                li {
                                    padding: 5px;
                                }
                                img {
                                    width: 120px;
                                    margin: 0px auto;
                                }
                                .bdr {
                                    border-left: 1px solid #d0d0d0;
                                }
                                .bdr-top {
                                    border-top: 1px solid #d0d0d0;
                                }
                                .bb {
                                    font-weight: bold;
                                }
                                .right {
                                    text-align: right;
                                }
                                .table {
                                    margin-left:150px;
                                }
                                .topic {
                                    font-size:22px;
                                    text-align:center;
                                    color:#00a1ad;
                                }
                                .sal {
                                    margin-left:100px;
                                }
                                .desc {
                                    margin-left:150px;
                                    text-align:justify;
                                    margin-right:100px;
                                }
                                .bor {
                                    border:1px solid #000;
                                }
                                .booking-details {
                                    margin-left:150px;
                                    border: none !important;
                                    margin-right:100px;
                                }
                                .footer{
                                    width:100%;
                                    margin-top: 20px;
                                    background-color:#00a1ad;
                                    color: #fff;
                                    padding-top:20px;
                                    padding-bottom:30px;
                                }
                                .footer-tr {
                                    font-size: 15px;
                                    line-height: 2px;
                                }
                                .footer-td1 {
                                    width: 150px;
                                }
                                .footer-td2 {
                                    width: 35%;
                                }
                                @media (max-width: 480px) {
                                    ul { font-size: 14px; }
                                    td { font-size: 12px; }
                                    .table {margin-left:0px;}
                                    .desc {margin-left:20px; text-align:justify; margin-right:10px;}
                                    .sal {margin-left:10px;}
                                    .booking-details {margin-left:10px; border: none !important; margin-right:10px;}
                                    ul {list-style-type: square; margin: 0px 20px 30px 10px;}
                                    .footer-tr {font-size: 15px; line-height: 15px;}
                                    .footer-td1 { width: 0px;}
                                    .footer-td2 {width: 50%;}
                                    .table-td1 {width: 20%;}
                                }
                                a.button {
                                    background-color: #66676b;
                                    top: 0;
                                    padding: 9px 20px;
                                    color: #fff;
                                    position: relative;
                                    font-size: 15px;
                                    font-weight: 600;
                                    display: inline-block;
                                    transition: all .2s ease-in-out;
                                    cursor: pointer;
                                    margin-right: 6px;
                                    overflow: hidden;
                                    border: 0;
                                    border-radius: 50px;
                                }
                                a.button{
                                background-color: #0dce38;
                                color: #fff;
                                }
                                
                            </style>
                        </head>
                        <body class="bor">
                            <div style="width: 100%; text-align: center; font-size: 20px; margin: 10px 0px 30px 0px;">
                                <!--            <b style="font-size: 25px; text-decoration: underline;">Coral Sands Hotel</b><br/>-->
                                <img src=" https://' . $site . '/images/logo/logo.png" alt="Tour Sri Lanka"/><br/>

                            </div>
                            <h2 class="topic">Tailor Made New Price Offer | Tour Sri Lanka | #' . $tailormade_tour_id . '</h2>
                            <h4 class="sal"><strong>Dear ' . $VISITOR->name . '</strong></h4>
                            <div class="desc">
                                <h4>' . $DRIVER->name . ' has offer $ ' . $price . ' for your booking (#' . $TAILORMADETOURS->id . ').</h4>
                            </div>
                            
                            <table class="booking-details">
                                <tr>
                                    <td><strong>Booking Id.</strong></td>
                                    <td><strong>:  #' . $tailormade_tour_id . '</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Booking Date</strong></td>
                                    <td><strong>: ' . $TAILORMADETOURS->date_time_booked . '</strong></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2"><strong><u>Tailor made Tour Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Selected Destinations</td>
                                    <td><ul>' . $destination_list . '</ul></td>
                                </tr>
                                <tr>
                                    <td>Start Date</td>
                                    <td>: ' . $TAILORMADETOURS->start_date . '</td>
                                </tr>
                                <tr>
                                    <td>End Date</td>
                                    <td>: ' . $TAILORMADETOURS->end_date . '</td>
                                </tr><tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong><u>Driver Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Driver name</td>
                                    <td>: ' . $DRIVER->name . '</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: ' . $DRIVER->email . '</td>
                                </tr>
                                <tr>
                                    <td>Mobile Number</td>
                                    <td>: ' . $DRIVER->contact_number . '</td>
                                </tr>
                                <tr>
                                    <td>Driving Licence Number</td>
                                    <td>: ' . $DRIVER->driving_licence_number . '</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                

                            </table>
                            
                            <br>
                            <table class="booking-details">
                                <tr>
                                    <td colspan="2"><strong><u> Click here Confirm Your booking </u></strong></td>
                                </tr>
                                <tr>
                                    <a href="https://www.toursrilanka.travel/visitor/manage-active-tailormade-bookings.php" class="btncolor1 button margin-top-25 mt-xs-8 mb-xs-8 mt-sm-8 mb-sm-15 ">Confirm Your Booking</a>
                                </tr>
                            </table>
                            
                            <table class="footer">
                                <tr>
                                    <td class="footer-td1"></td>
                                    <td colspan="2" style="font-size: 15px;"><strong>Thank You !</strong></td>
                                </tr>
                                <tr class="footer-tr">
                                    <td></td>
                                    <td class="footer-td2">Tour Sri Lanka</td>
                                    <td>Phone: +94 91 227 7513</td>
                                </tr>
                                <tr class="footer-tr">
                                    <td></td>
                                    <td><a href="" style="text-decoration:none;color: #fff;">No.326, Galle Rd, Hikkaduwa, Sri Lanka</a></td>
                                    <td>Email: info@toursrilanka.travel</td>
                                </tr>
                                
                            </table>
                            </body>
                        </html>';

        if (mail($visitor_email, $subject, $html, $headers)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function sendSetPriceMessageToVisitor($tailormade_tour_id,$driverid, $price) {

        $TAILORMADETOURS = new TailorMadeTours($tailormade_tour_id);
        $MESSAGE = new DriverAndVisitorMessages(NULL);
        $DRIVER = new Drivers($driverid);

        $MESSAGE->driver = $TAILORMADETOURS->driver;
        $MESSAGE->visitor = $TAILORMADETOURS->visitor;
        $MESSAGE->messages = $DRIVER->name . ' has offer $ ' . $price . ' for you booking (#' . $TAILORMADETOURS->id . ')';
        $MESSAGE->sender = 'driver';
        $result = $MESSAGE->create();

        return $result;
    }

    public static function sendBookingConfirmedEmailToDriver($tailormade_tour_id) {

        //----------------------Company Information---------------------

        $from = 'info@toursrilanka.travel';
        $reply = 'info@toursrilanka.travel';

        $subject = "Tailor-Made Tour Booking Driver Confirmation | Tour Sri Lanka | " . $tailormade_tour_id . "";
        $site = 'toursrilanka.travel';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $TAILORMADETOURS = new TailorMadeTours($tailormade_tour_id);

        $DRIVER = new Drivers($TAILORMADETOURS->driver);
        $VISITOR = new Visitor($TAILORMADETOURS->visitor);


        $driver_email = $DRIVER->email;

        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>' . "Tour Sri Lanka - Tailor-Made Tour Booking Confirmation" . '</title>
                            <style type="text/css">
                                table {
                                    border: 1px solid #d0d0d0;
                                }
                                th {
                                    border-bottom: 1px solid #d0d0d0;
                                    padding: 15px 10px 10px 25px;
                                    text-align: left;
                                    margin: 0px;
                                }
                                td {
                                    padding: 10px 10px 5px 10px;
                                    text-align: left;
                                    margin: 0px;
                                }
                                ul {
                                    list-style-type: square;
                                    margin: 0px 20px 30px 200px;
                                }
                                li {
                                    padding: 5px;
                                }
                                img {
                                    width: 120px;
                                    margin: 0px auto;
                                }
                                .bdr {
                                    border-left: 1px solid #d0d0d0;
                                }
                                .bdr-top {
                                    border-top: 1px solid #d0d0d0;
                                }
                                .bb {
                                    font-weight: bold;
                                }
                                .right {
                                    text-align: right;
                                }
                                .table {
                                    margin-left:150px;
                                }
                                .topic {
                                    font-size:22px;
                                    text-align:center;
                                    color:#00a1ad;
                                }
                                .sal {
                                    margin-left:100px;
                                }
                                .desc {
                                    margin-left:150px;
                                    text-align:justify;
                                    margin-right:100px;
                                }
                                .bor {
                                    border:1px solid #000;
                                }
                                .booking-details {
                                    margin-left:150px;
                                    border: none !important;
                                    margin-right:100px;
                                }
                                .footer{
                                    width:100%;
                                    margin-top: 20px;
                                    background-color:#00a1ad;
                                    color: #fff;
                                    padding-top:20px;
                                    padding-bottom:30px;
                                }
                                .footer-tr {
                                    font-size: 15px;
                                    line-height: 2px;
                                }
                                .footer-td1 {
                                    width: 150px;
                                }
                                .footer-td2 {
                                    width: 35%;
                                }
                                @media (max-width: 480px) {
                                    ul { font-size: 14px; }
                                    td { font-size: 12px; }
                                    .table {margin-left:0px;}
                                    .desc {margin-left:20px; text-align:justify; margin-right:10px;}
                                    .sal {margin-left:10px;}
                                    .booking-details {margin-left:10px; border: none !important; margin-right:10px;}
                                    ul {list-style-type: square; margin: 0px 20px 30px 10px;}
                                    .footer-tr {font-size: 15px; line-height: 15px;}
                                    .footer-td1 { width: 0px;}
                                    .footer-td2 {width: 50%;}
                                    .table-td1 {width: 20%;}
                                }
                                a.button {
                                    background-color: #66676b;
                                    top: 0;
                                    padding: 9px 20px;
                                    color: #fff;
                                    position: relative;
                                    font-size: 15px;
                                    font-weight: 600;
                                    display: inline-block;
                                    transition: all .2s ease-in-out;
                                    cursor: pointer;
                                    margin-right: 6px;
                                    overflow: hidden;
                                    border: 0;
                                    border-radius: 50px;
                                }
                                a.button{
                                background-color: #0dce38;
                                color: #fff;
                                }
                                
                            </style>
                        </head>
                        <body class="bor">
                            <div style="width: 100%; text-align: center; font-size: 20px; margin: 10px 0px 30px 0px;">
                                <!--            <b style="font-size: 25px; text-decoration: underline;">Coral Sands Hotel</b><br/>-->
                                <img src="http://' . $site . '/images/logo/logo.png" alt="toursrilanka"/><br/>
                                <span><a href="" style="text-decoration:none;color: #000;">Contact</a></span><br/>
                                <span>Email: info@toursrilanka.travel</span><br/>
                                <span>Phone: +94 91 227 7513 / +94 91 227 7436</span>
                            </div>
                            <h2 class="topic">Tailor-Made Tour Booking Confirmation | Tour Sri Lanka | #' . $tailormade_tour_id . '</h2>
                            <h4 class="sal"><strong>Dear ' . $DRIVER->name . ', </strong></h4>
                            
                            
                            <table class="booking-details">
                                <tr>
                                    <td><strong>Your Booking Id #' . $tailormade_tour_id . ' Has Been Confirmed By ' . $VISITOR->name . ' </strong></td>
                                  
                                </tr>
                                                               
                            </table>
                            
                            <br>
                            <table class="booking-details">
                                <tr>
                                    <td colspan="2"><strong><u> Click here View More Details </u></strong></td>
                                </tr>
                                <tr>
                                    <a href="https://www.toursrilanka.travel/driver/manage-active-tailormade-bookings.php" class="btncolor1 button margin-top-25 mt-xs-8 mb-xs-8 mt-sm-8 mb-sm-15 ">View More Details</a>
                                </tr>
                            </table>
                            
                            <table class="footer">
                                <tr>
                                    <td class="footer-td1"></td>
                                    <td colspan="2" style="font-size: 15px;"><strong>Thank You !</strong></td>
                                </tr>
                                <tr class="footer-tr">
                                    <td></td>
                                    <td class="footer-td2">Tour Sri Lanka</td>
                                    <td>Phone: +94 91 227 7513</td>
                                </tr>
                                <tr class="footer-tr">
                                    <td></td>
                                    <td><a href="" style="text-decoration:none;color: #fff;">No.326, Galle Rd, Hikkaduwa, Sri Lanka</a></td>
                                    <td>Email: info@toursrilanka.travel</td>
                                </tr>
                                
                            </table>
                            </body>
                        </html>';

        if (mail($driver_email, $subject, $html, $headers)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
