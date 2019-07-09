<!DOCTYPE html>
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
                                    margin: 0px 20px 30px 0px;
                                }
                                li {
                                    padding: 5px;
                                }
                                img {
                                    width: auto;
                                    margin: 0px 120px;
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
                                    color:#fff;
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
                                    background-color:#3a9b00;
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
                                text-decoration: none;
                                }
                                
                            </style>
                        </head>
                        <body class="bor">
                            <div class="top" style="background: #3a9b00; padding: 10px 0;">
                                <div style="width: 100%; text-align: center; font-size: 20px; margin: 0px 0px -22px 0px;">
                                    <img src="http://' . $site . '/images/logo/logo-white.png" alt="Tour Sri lanka"/><br/>
                                </div>
                                <h2 class="topic">Tailor-Made Tour Booking Confirmation | Tour Sri Lanka | #' . $tailormade_tour_id . '</h2>
                            </div>
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
                                    <td><a href="https://www.toursrilanka.travel/driver/manage-active-tailormade-bookings.php" class="btncolor1 button margin-top-25 mt-xs-8 mb-xs-8 mt-sm-8 mb-sm-15 ">View More Details</a></td>
                                </tr>
                            </table>
                            
                            <table class="footer">
                                <tr>
                                    <td class="footer-td1"></td>
                                    <td colspan="2" style="font-size: 15px;"><strong>Thank You !</strong></td>
                                </tr>
                                <tr class="footer-tr">
                                    <td></td>
                                    <td class="footer-td2">Phone: +94 71 666 7557</td>
                                    <td>Fax: +94 91 666 7557 </td>
                                </tr>
                                <tr class="footer-tr">
                                    <td></td>
                                    <td><a href="" style="text-decoration:none;color: #fff;">Web: www.toursrilanka.travel</a></td>
                                    <td>Email: info@toursrilanka.travel</td>
                                </tr>

                            </table>
                            </body>
                        </html>