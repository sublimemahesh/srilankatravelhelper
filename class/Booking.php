<?php
/**
 * Description of Booking
 *
 * @author WJKN
 */
class Booking {
    public $id;
    public $date_time_booked;
    public $tour_package;
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

            $query = "SELECT `id`,`date_time_booked`,`tour_package`,`visitor`,`no_of_adults`,`no_of_children`,`driver`,`start_date`,`end_date`,`message`,`price`,`status` FROM `booking` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->date_time_booked = $result['date_time_booked'];
            $this->tour_package = $result['tour_package'];
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

        $query = "INSERT INTO `booking` (`date_time_booked`,`tour_package`,`visitor`,`no_of_adults`,`no_of_children`,`driver`,`start_date`,`end_date`,`message`,`price`,`status`) VALUES  ('"
                . $createdAt . "', '"
                . $this->tour_package . "', '"
                . $this->visitor . "', '"
                . $this->no_of_adults . "', '"
                . $this->no_of_children . "', '"
                . $this->driver . "', '"
                . $this->start_date . "', '"
                . $this->end_date . "', '"
                . $this->message . "', '"
                . $this->price . "', '"
                . $status . "')";

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

        $query = "SELECT * FROM `booking` ORDER BY date_time_booked ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `booking` SET "
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

        $query = "UPDATE  `booking` SET "
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

        $query = 'DELETE FROM `booking` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getActiveBookingsByDriver($driver) {

        $query = "SELECT * FROM `booking` WHERE `driver`= $driver AND `status` like 'active' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getCanceledBookingsByDriver($driver) {

        $query = "SELECT * FROM `booking` WHERE `driver`= $driver AND `status` = 'canceled' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getActiveBookingsByVisitor($visitor) {

        $query = "SELECT * FROM `booking` WHERE `visitor`= $visitor AND `status` like 'active' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getCanceledBookingsByVisitor($visitor) {

        $query = "SELECT * FROM `booking` WHERE `visitor`= $visitor AND `status` = 'canceled' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getActiveBookings() {

        $query = "SELECT * FROM `booking` WHERE `status` like 'active' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getCanceledBookings() {

        $query = "SELECT * FROM `booking` WHERE `status` = 'canceled' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function cancelBooking() {

        $query = "UPDATE  `booking` SET "
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
    
    public static function sendBookingConfirmationEmailToVisitor($bookingid) {

        //----------------------Company Information---------------------

        $from = 'info@galle.website';
        $reply = 'info@galle.website';

        $subject = "Booking Confirmation | Tour Sri Lanka | " . $bookingid . "";
        $site = 'travelhelper.galle.website';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $BOOKING = new Booking($bookingid);
        
        $DRIVER = new Drivers($BOOKING->driver);
        $VISITOR = new Visitor($BOOKING->visitor);
        $TOUR = new TourPackages($BOOKING->tour_package);
        
        $visitor_email = $VISITOR->email;


        if ($BOOKING->message) {
            $specialrequest = ' <tr>
                                    <td colspan="2"><strong><u>Special request</u></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">' . $BOOKING->message . '</td>
                                </tr>';
        }

        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>' . "Tour Sri Lanka - Booking Confirmation" . '</title>
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
                                <img src="http://' . $site . '../images/logo/logo.png" alt="Tour Sri lanka"/><br/>
                              
                            </div>
                            <h2 class="topic">Booking Confirmation | Tour Sri Lanka | #' . $bookingid . '</h2>
                            <h4 class="sal"><strong>Dear ' . $VISITOR->name . '</strong></h4>
                            <div class="desc">
                                <p>Thank you for making an online booking with Tour Sri Lanka. Your booking id is :  #' . $bookingid . '. Your booking is subject to the terms & conditions listed on the website. </p>
                                
                            </div>
                            
                            <table class="booking-details">
                                <tr>
                                    <td><strong>Booking Id.</strong></td>
                                    <td><strong>:  #' . $bookingid . '</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Reservation Date</strong></td>
                                    <td><strong>: ' . $BOOKING->date_time_booked . '</strong></td>
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
                                    <td colspan="2"><strong><u>Tour Package Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Tour Package</td>
                                    <td>: ' . $TOUR->name . '</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>: LKR ' . $TOUR->price . '</td>
                                </tr>
                                <tr>
                                    <td>No of Days</td>
                                    <td>: 7</td>
                                </tr>
                                <tr>
                                    <td>No of Night</td>
                                    <td>: 6</td>
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
                                <tr>
                                    <td colspan="2"><strong><u>Cancellation Policy</u></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <ul>
                                            <li>If cancelled 7 days prior to arrival date : 0% of the booking value will be charged as a Cancellation Fee.</li>
                                            <li>If cancelled within 1 to 6 days of the arrival date: 100 % of the booking value will be charged as Cancellation Fee.</li>
                                            <li>No Show : 100% of the booking value will be charged as a Cancellation Fee.</li>
                                            <li>Booking cancellations should be notified via email to mail@travelhelper.lk</li>
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
                                    <td>Email: mail@travelhelper.lk</td>
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
    
    public static function sendBookingConfirmationEmailToDriver($bookingid,$driver_id, $visitor) {

        //----------------------Company Information---------------------

        $from = 'info@galle.website';
        $reply = 'info@galle.website';

        $subject = "Booking Confirmation To Driver | Tour Sri Lanka | " . $bookingid . "";
        $site = 'travelhelper.galle.website';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $BOOKING = new Booking($bookingid);
        
        $DRIVER = new Drivers($driver_id);
        $VISITOR = new Visitor($visitor);
        $TOUR = new TourPackages($BOOKING->tour_package);
        
        $driver_email = $DRIVER->email;


        if ($BOOKING->message) {
            $specialrequest = ' <tr>
                                    <td colspan="2"><strong><u>Special request</u></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">' . $BOOKING->message . '</td>
                                </tr>';
        }

        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>' . "Tour Sri Lanka - Booking Confirmation" . '</title>
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
                                <span>Email: mail@travelhelper.lk</span><br/>
                                <span>Phone: +94 91 227 7513 / +94 91 227 7436</span>
                            </div>
                            <h2 class="topic">Booking Confirmation | Tour Sri Lanka | #' . $bookingid . '</h2>
                            <h4 class="sal"><strong>Dear ' . $DRIVER->name . '</strong></h4>
                            
                            
                            <table class="booking-details">
                                <tr>
                                    <td><strong>Booking Id.</strong></td>
                                    <td><strong>:  #' . $bookingid . '</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Reservation Date</strong></td>
                                    <td><strong>: ' . $BOOKING->date_time_booked . '</strong></td>
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
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong><u>Tour Package Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Tour Package</td>
                                    <td>: ' . $TOUR->name . '</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>: LKR ' . $TOUR->price . '</td>
                                </tr>
                                <tr>
                                    <td>No of Days</td>
                                    <td>: 7</td>
                                </tr>
                                <tr>
                                    <td>No of Night</td>
                                    <td>: 6</td>
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
                                            <li>Booking cancellations should be notified via email to mail@travelhelper.lk</li>
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
                                    <td>Email: mail@travelhelper.lk</td>
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
    
    public static function sendBookingConfirmationEmailToAdmin($bookingid) {

        //----------------------Company Information---------------------

        $from = 'info@galle.website';
        $reply = 'info@galle.website';

        $subject = "Booking Confirmation | Tour Sri Lanka | " . $bookingid . "";
        $site = 'travelhelper.galle.website';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $BOOKING = new Booking($bookingid);
        
        $DRIVER = new Drivers($BOOKING->driver);
        $VISITOR = new Visitor($BOOKING->visitor);
        $TOUR = new TourPackages($BOOKING->tour_package);
        
        $visitor_email = $VISITOR->email;


        if ($BOOKING->message) {
            $specialrequest = ' <tr>
                                    <td colspan="2"><strong><u>Special request</u></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">' . $BOOKING->message . '</td>
                                </tr>';
        }

        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>' . "Tour Sri Lanka - Booking Confirmation" . '</title>
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
                                <span>Email: mail@travelhelper.lk</span><br/>
                                <span>Phone: +94 91 227 7513 / +94 91 227 7436</span>
                            </div>
                            <h2 class="topic">Booking Confirmation | Tour Sri Lanka | #' . $bookingid . '</h2>
                            <h4 class="sal"><strong>Dear ' . $VISITOR->name . '</strong></h4>
                            
                            <table class="booking-details">
                                <tr>
                                    <td><strong>Booking Id.</strong></td>
                                    <td><strong>:  #' . $bookingid . '</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Reservation Date</strong></td>
                                    <td><strong>: ' . $BOOKING->date_time_booked . '</strong></td>
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
                                    <td colspan="2"><strong><u>Tour Package Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Tour Package Id</td>
                                    <td>: ' . $TOUR->id . '</td>
                                </tr>
                                <tr>
                                    <td>Tour Package</td>
                                    <td>: ' . $TOUR->name . '</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>: LKR ' . $TOUR->price . '</td>
                                </tr>
                                <tr>
                                    <td>No of Days</td>
                                    <td>: 7</td>
                                </tr>
                                <tr>
                                    <td>No of Night</td>
                                    <td>: 6</td>
                                </tr><tr>
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
                                            <li>Booking cancellations should be notified via email to mail@travelhelper.lk</li>
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
                                    <td>Email: mail@travelhelper.lk</td>
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
    
    public static function sendSetPriceEmailToVisitor($bookingid,$driverid,$tourid,$visitorid,$price) {
      
        //----------------------Company Information---------------------

        $from = 'info@toursrilanka.travel';
        $reply = 'info@toursrilanka.travel';

        $subject = "Tour Booking | New price offer | Tour Sri Lanka | " . $bookingid . "";
        $site = 'toursrilanka.travel';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $BOOKING = new Booking($bookingid);
    
        $DRIVER = new Drivers($driverid);
        $VISITOR = new Visitor($visitorid);
        $TOUR = new TourPackages($tourid);


        $visitor_email = $VISITOR->email;


        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>' . "Tour Sri Lanka - Tour Booking" . '</title>
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
                                <img src="http://' . $site . '/images/logo/logo.png" alt="toursrilanka"/><br/>
                                <span><a href="" style="text-decoration:none;color: #000;">Address</a></span><br/>
                                <span>Email: info@toursrilanka.travel</span><br/>
                                <span>Phone: +94 91 227 7513 / +94 91 227 7436</span>
                            </div>
                            <h2 class="topic">Tour Booking | Tour Sri Lanka | #' . $bookingid . '</h2>
                            <h4 class="sal"><strong>Dear ' . $VISITOR->name . '</strong></h4>
                            <div class="desc">
                                <p>' . $DRIVER->name . ' has offer USD ' . $price . ' for you booking (#' . $BOOKING->id . ').</p>
                                
                            </div>
                            
                            <table class="booking-details">
                                <tr>
                                    <td><strong>Booking Id.</strong></td>
                                    <td><strong>:  #' . $bookingid . '</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Reservation Date</strong></td>
                                    <td><strong>: ' . $BOOKING->date_time_booked . '</strong></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2"><strong><u>Booking Details</u></strong></td>
                                </tr>
                                <tr>
                                    <td>Tour Package</td>
                                    <td>: ' . $TOUR->name . '</td>
                                </tr>
                                <tr>
                                    <td>Start Date</td>
                                    <td>: ' . $BOOKING->start_date . '</td>
                                </tr>
                                <tr>
                                    <td>End Date</td>
                                    <td>: ' . $BOOKING->end_date . '</td>
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
    
    public static function sendSetPriceMessageToVisitor($bookingid) {

        $BOOKING = new Booking($bookingid);
        $MESSAGE = new DriverAndVisitorMessages(NULL);
        $DRIVER = new Drivers($BOOKING->driver);
        
        $MESSAGE->driver = $BOOKING->driver;
        $MESSAGE->visitor = $BOOKING->visitor;
        $MESSAGE->messages = $DRIVER->name.' has offer USD ' . $BOOKING->price . ' for you booking (#' . $BOOKING->id . ')';
        $MESSAGE->sender = 'driver';
        $result = $MESSAGE->create();

        return $result;

    }
     public function confirmPackageBooking($driverid, $price, $booking) {
     
        $query = "UPDATE  `booking` SET "
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
     public static function sendTourBookingConfirmedEmailToDriver($tailormade_tour_id) {

        //----------------------Company Information---------------------

        $from = 'info@toursrilanka.travel';
        $reply = 'info@toursrilanka.travel';

        $subject = "Tour Booking Driver Confirmation | Tour Sri Lanka | " . $tailormade_tour_id . "";
        $site = 'toursrilanka.travel';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $TAILORMADETOURS = new Booking($tailormade_tour_id);

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
                            <h2 class="topic">Tour Booking Confirmation | Tour Sri Lanka | #' . $tailormade_tour_id . '</h2>
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
     public function getConfimedBookingsByVisitor($visitor) {

        $query = "SELECT * FROM `booking` WHERE `visitor`= $visitor AND `status` = 'confirmed' ORDER BY `date_time_booked` DESC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
}
