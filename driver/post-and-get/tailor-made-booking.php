<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');

if (isset($_POST['set-price'])) {

    $TBOOKING = new TailorMadeTours($_POST['id']);
    $VALID = new Validator();

    $TBOOKING->price = $_POST['price'];

    $VALID->check($TBOOKING, [
        'price' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $TBOOKING->setPrice();

        if ($result) {
            $sendvisitoremail = $TBOOKING->sendSetPriceEmailToVisitor($result->id);
            $sendmessage = $TBOOKING->sendSetPriceMessageToVisitor($result->id);

            if ($sendmessage) {
                $VISITOR = new Visitor($sendmessage->visitor);
                $DRIVER = new Drivers($sendmessage->driver);

                $driver_name = $DRIVER->name;
                $driver_image_name = $DRIVER->profile_picture;
                $message = $sendmessage->messages;
                $datetime = $sendmessage->date_and_time;
                $visitor_email = $VISITOR->email;
                $driver_id = $sendmessage->driver;
                $site_link = "http://" . $_SERVER['HTTP_HOST'];
                $website_name = 'www.toursrilanka.travel';
                $comany_name = 'Tour Sri Lanka';
                $comConNumber = '+94 71 890 5282';
                $comEmail = 'noreply@toursrilanka.travel';
                date_default_timezone_set('Asia/Colombo');

                $todayis = date("l, F j, Y, g:i a");

                $subject = $driver_name . ' send a new message to you';
                $from = 'noreply@toursrilanka.travel'; // give from email address


                $headers = "From: " . $from . "\r\n";
                $headers .= "Reply-To: " . $from . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml">
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                <title>Tour Sri Lanka Email Template</title>
                            </head>

                            <body bgcolor="#8d8e90">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
                                    <tr>
                                        <td>
                                            <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #c8d6d8;">
                                                            <tr>
                                                                <td style="border-collapse:collapse" width="100%" height="12">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border-collapse:collapse" valign="middle" align="center">
                                                                    <img alt="Logo" src="' . $site_link . '/../../images/logo/logo.png" style="outline:none;text-decoration:none;border:none" class="CToWUd" height="55px" align="middle">
                                                                </td>
                                                            </tr>           
                                                            <tr>
                                                                <td style="border-collapse:collapse" width="100%" height="12">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-collapse:collapse" width="600" align="center">
                                                        <table style="border-collapse:collapse;border:1px; border-color:#e8ecee; border-radius:0px 0px 16px 16px; width:100%; max-width:600px" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="3" style="border-collapse:collapse" width="100%" height="20"></td>
                                                                </tr> 
                                                                <tr>
                                                                    <td style="border-collapse:collapse" width="48"></td>
                                                                    <td style="border-collapse:collapse" valign="middle">
                                                                        <table style="border-collapse:collapse;border:1px;border-color:#e8ecee;border-radius:0px 0px 16px 16px;width:100%;max-width:632px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="border-collapse:collapse;font-size:24px;font-weight:bold;color:#ff4b04;line-height:28px;padding-left:9px;padding-top:15px;padding-bottom:12px">
                                                                                        You have a new message!
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="border-collapse:collapse;font-size:15px;font-weight:normal;line-height:20px">
                                                                                        <img style="outline:none;text-decoration:none;border:none;width:513px;padding-left:9px;padding-right:9px;display:block;padding-top:10px" src="https://ci3.googleusercontent.com/proxy/-wOUA68Jt1jPBZ8p-sDeiPQEXMZuOhyFUeZ7-a5PgowNs8DlkvRao8ok5xImz9PAhD4JUTv-UqOuFvS8evnV6el1=s0-d-e1-ft#https://a.edim.co/waterboy/subdivider@2x.png" class="CToWUd">
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td style="border-collapse:collapse">
                                                                                        <table style="border-collapse:collapse;border:1px;border-color:#e8ecee;border-radius:0px 0px 16px 16px;width:100%;max-width:632px;background:#ffffff" width="100%" border="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="border-collapse:collapse" width="5"></td>
                                                                                                    <td style="border-collapse:collapse" width="450">

                                                                                                        <table style="border-collapse:collapse;border:1px;border-color:#e8ecee;border-radius:0px 0px 16px 16px;width:100%;max-width:632px; margin-top:10px;" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td style="border-collapse:collapse" width="40" valign="top" align="right">
                                                                                                                        <img style="outline:none;text-decoration:none;border:none;display:block;border-radius:12px" src="' . $site_link . '../upload/driver/' . $driver_image_name . '" class="CToWUd" width="60">
                                                                                                                    </td>
                                                                                                                    <td style="border-collapse:collapse" width="8" valign="top"></td>
                                                                                                                    <td style="border-collapse:collapse;min-width:100%" width="400" valign="top">
                                                                                                                        <div style="line-height:20px;color:#888;text-align:left;font-size:13px!important;color:rgba(0,0,0,0.8)">

                                                                                                                            <span style="font-weight:bold;font-size:15px;opacity:0.8"> ' . $driver_name . ' sent a new message. </span>
                                                                                                                            <br>

                                                                                                                          ' . substr($message, 0, 100) . '...' . '

                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                    <td style="border-collapse:collapse" width="20"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td style="border-collapse:collapse"></td>
                                                                                                </tr> 
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td colspan="4" style="border-collapse:collapse" align="center">      
                                                                                        <table style="border-collapse:collapse;border:1px;border-color:#e8ecee;border-radius:0px 0px 16px 16px;width:100%;max-width:632px;width:300px" width="300" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="border-collapse:collapse" align="center">

                                                                                                        <a href="' . $site_link . '/visitor/visitor-message.php?id=' . $driver_id . '" style="text-decoration:none;color:#24c7ff;text-align:center;font-size:16px;font-family:Helvetica,Arial,sans-serif;color:#ffffff;text-decoration:none;color:#ffffff;text-decoration:none;padding:10px;border-radius:6px;border:1px solid #24c7ff;display:inline-block;width:266px;background-color:#24c7ff; margin-top: 15px;" target="_blank"> 
                                                                                                         Read the message
                                                                                                        </a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td style="border-collapse:collapse" width="46"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3" style="border-collapse:collapse" width="100%" height="48"></td>
                                                                </tr> 
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td width="2%" align="center">&nbsp;</td>
                                                                <td width="29%" align="center">
                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:8px; " >
                                                                        <strong>Phone No : <br/> ' . $comConNumber . ' </strong>
                                                                    </font>
                                                                </td>
                                                                <td width="2%" align="center">
                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:8px; " >
                                                                        <strong>|</strong>
                                                                    </font>
                                                                </td>
                                                                <td width="30%" align="center">
                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:8px; " >
                                                                        <strong>Website : <br/> ' . $website_name . '  </strong>
                                                                    </font>
                                                                </td>
                                                                <td width="2%" align="center">
                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:8px; " >
                                                                        <strong>|</strong>
                                                                    </font>
                                                                </td>
                                                                <td width="25%" align="center">
                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:8px; " >
                                                                        <strong>E-mail :  <br/> ' . $comEmail . '</strong>
                                                                    </font>
                                                                </td> 
                                                            </tr>
                                                        </table>
                                                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="3%" align="center">&nbsp;</td>
                                                                <td width="28%" align="center"><font style="font-family: Verdana, Geneva, sans-serif; color:#1400FF; font-size:9px; " > © ' . date('Y') . ' Copyright ' . $comany_name . '</font> </td>
                                                                <td width="10%" align="center"></td>
                                                                <td width="3%" align="center"></td> 
                                                                <td width="30%" align="right">
                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#1400FF; font-size:9px; " > 
                                                                        <a href="http://www.sublime.lk/">
                                                                            web solution by: Sublime Holdings</a>
                                                                    </font>
                                                                </td>
                                                                <td width="5%">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </body>
                        </html>';

                mail($visitor_email, $subject, $html, $headers);
            }
            if (!isset($_SESSION)) {
                session_start();
            }
            $VALID->addError("Your data was saved successfully", 'success');
            $_SESSION['ERRORS'] = $VALID->errors();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    } else {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['ERRORS'] = $VALID->errors();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
