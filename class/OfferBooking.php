<?php

/**
 * Description of OfferBooking
 *
 * @author WJKN
 */
class OfferBooking {

    public $id;
    public $offer;
    public $visitor;
    public $date_time_booked;
    public $message;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`offer`,`visitor`,`date_time_booked`,`message` FROM `offer_booking` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->offer = $result['offer'];
            $this->visitor = $result['visitor'];
            $this->date_time_booked = $result['date_time_booked'];
            $this->message = $result['message'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `offer_booking` (`offer`,`visitor`,`date_time_booked`,`message`) VALUES  ('"
                . $this->offer . "','"
                . $this->visitor . "','"
                . $this->date_time_booked . "','"
                . $this->message . "')";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `offer_booking` ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `offer_booking` SET "
                . "`offer` ='" . $this->offer . "', "
                . "`visitor` ='" . $this->visitor . "', "
                . "`date_time_booked` ='" . $this->date_time_booked . "', "
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

    public function delete() {

        $query = 'DELETE FROM `offer_booking` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public static function sendOfferBookingConfirmationEmailToVisitor($bookingid) {

        //----------------------Company Information---------------------

        $from = 'info@toursrilanka.travel';
        $reply = 'info@toursrilanka.travel';

        $subject = "Offer Booking Confirmation | Tour Sri Lanka | " . $bookingid . "";
        $site = 'toursrilanka.travel';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $OFFERBOOKING = new OfferBooking($bookingid);

        $OFFER = new Offer($OFFERBOOKING->offer);
        $DRIVER = new Drivers($OFFER->driver);
        $VISITOR = new Visitor($OFFERBOOKING->visitor);


        $visitor_email = $VISITOR->email;


        if ($OFFERBOOKING->message) {
            $specialrequest = ' <tr>
                                    <td colspan="2"><strong><u>Special request</u></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">' . $OFFERBOOKING->message . '</td>
                                </tr>';
        }

        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>' . "Tour Sri Lanka - Offer Booking Confirmation" . '</title>
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
                                <img src="http://' . $site . '/images/logo/logo.png" alt="travelhelper"/><br/>
                                <span><a href="" style="text-decoration:none;color: #000;">Address</a></span><br/>
                                <span>Email: mail@toursrilanka.lk</span><br/>
                                <span>Phone: +94 91 227 7513 / +94 91 227 7436</span>
                            </div>
                            <h2 class="topic">Offer Booking Confirmation | Tour Sri Lanka | #' . $bookingid . '</h2>
                            <h4 class="sal"><strong>Dear ' . $VISITOR->name . '</strong></h4>
                            <div class="desc">
                                <p>Thank you for making an online offer booking with Tour Sri Lanka. Your booking id is :  #' . $bookingid . '. Your booking is subject to the terms & conditions listed on the website. </p>
                                
                            </div>
                            
                            <table class="booking-details">
                                <tr>
                                    <td><strong>Offer Booking Id.</strong></td>
                                    <td><strong>:  #' . $bookingid . '</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Reservation Date</strong></td>
                                    <td><strong>: ' . $OFFERBOOKING->date_time_booked . '</strong></td>
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
                                    <td colspan="2"><strong><u>Offer Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Offer</td>
                                    <td>: ' . $OFFER->title . '</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>: LKR ' . $OFFER->price . '</td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td>: ' . $OFFER->discount . '%</td>
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
                                    <td></td>
                                    <td></td>
                                </tr>
                                ' . $specialrequest . '
                                
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
                                    <td>Email: mail@toursrilanka.lk</td>
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

    public static function sendOfferBookingConfirmationEmailToDriver($bookingid) {

        //----------------------Company Information---------------------

        $from = 'info@toursrilanka.travel';
        $reply = 'info@toursrilanka.travel';

        $subject = "Offer Booking Confirmation | Tour Sri Lanka | " . $bookingid . "";
        $site = 'toursrilanka.travel';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $OFFERBOOKING = new OfferBooking($bookingid);

        $OFFER = new Offer($OFFERBOOKING->offer);
        $DRIVER = new Drivers($OFFER->driver);
        $VISITOR = new Visitor($OFFERBOOKING->visitor);

        $driver_email = $DRIVER->email;


        if ($OFFERBOOKING->message) {
            $specialrequest = ' <tr>
                                    <td colspan="2"><strong><u>Special request</u></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">' . $OFFERBOOKING->message . '</td>
                                </tr>';
        }

        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>' . "Tour Sri Lanka - Offer Booking Confirmation" . '</title>
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
                                <img src="http://' . $site . '/images/logo/logo.png" alt="travelhelper"/><br/>
                                <span><a href="" style="text-decoration:none;color: #000;">Address</a></span><br/>
                                <span>Email: mail@toursrilanka.lk</span><br/>
                                <span>Phone: +94 91 227 7513 / +94 91 227 7436</span>
                            </div>
                            <h2 class="topic">Offer Booking Confirmation | Tour Sri Lanka | #' . $bookingid . '</h2>
                            <h4 class="sal"><strong>Dear ' . $DRIVER->name . '</strong></h4>
                            
                            
                            <table class="booking-details">
                                <tr>
                                    <td><strong>Offer Booking Id.</strong></td>
                                    <td><strong>:  #' . $bookingid . '</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Reservation Date</strong></td>
                                    <td><strong>: ' . $OFFERBOOKING->date_time_booked . '</strong></td>
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
                                    <td colspan="2"><strong><u>Offer Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Offer</td>
                                    <td>: ' . $OFFER->title . '</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>: LKR ' . $OFFER->price . '</td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td>: ' . $OFFER->discount . '%</td>
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
                                    <td>Email: mail@toursrilanka.lk</td>
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

    public static function sendOfferBookingConfirmationEmailToAdmin($bookingid) {

        //----------------------Company Information---------------------

        $from = 'info@toursrilanka.travel';
        $reply = 'info@toursrilanka.travel';

        $subject = "Offer Booking Confirmation | Tour Sri Lanka | " . $bookingid . "";
        $site = 'toursrilanka.travel';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $OFFERBOOKING = new OfferBooking($bookingid);

        $OFFER = new Offer($OFFERBOOKING->offer);
        $DRIVER = new Drivers($OFFER->driver);
        $VISITOR = new Visitor($OFFERBOOKING->visitor);

        $visitor_email = $VISITOR->email;


        if ($OFFERBOOKING->message) {
            $specialrequest = ' <tr>
                                    <td colspan="2"><strong><u>Special request</u></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">' . $OFFERBOOKING->message . '</td>
                                </tr>';
        }

        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>' . "Tour Sri Lanka - Offer Booking Confirmation" . '</title>
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
                                <img src="http://' . $site . '/images/logo/logo.png" alt="travelhelper"/><br/>
                                <span><a href="" style="text-decoration:none;color: #000;">Address</a></span><br/>
                                <span>Email: mail@toursrilanka.lk</span><br/>
                                <span>Phone: +94 91 227 7513 / +94 91 227 7436</span>
                            </div>
                            <h2 class="topic">Offer Booking Confirmation | Tour Sri Lanka | #' . $bookingid . '</h2>
                            <h4 class="sal"><strong>Dear ' . $VISITOR->name . '</strong></h4>
                            
                            <table class="booking-details">
                                <tr>
                                    <td><strong>Offer Booking Id.</strong></td>
                                    <td><strong>:  #' . $bookingid . '</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Reservation Date</strong></td>
                                    <td><strong>: ' . $OFFERBOOKING->date_time_booked . '</strong></td>
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
                                    <td colspan="2"><strong><u>Offer Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Offer Id</td>
                                    <td>: ' . $OFFER->id . '</td>
                                </tr>
                                <tr>
                                    <td>Offer</td>
                                    <td>: ' . $OFFER->title . '</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>: LKR ' . $OFFER->price . '</td>
                                </tr>
                                
                                <tr>
                                    <td>Discount</td>
                                    <td>: ' . $OFFER->discount . '%</td>
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
                                    <td>Email: mail@toursrilanka.lk</td>
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

}
