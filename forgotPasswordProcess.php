<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $user_rs =  Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {

        $user_data = $user_rs->fetch_assoc();

        $otp = rand(100000, 9999999);

        Database::iud("UPDATE `user` SET `verification_code`='" . $otp . "' WHERE `email`='" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'digishop.lk@gmail.com';
        $mail->Password = 'ugmfngtnskcecsxl';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('digishop.lk@gmail.com', 'Password Reset Verification');
        $mail->addReplyTo('digishop.lk@gmail.com', 'Password Reset Verification');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Verify Your Account';
        $bodyContent = '<div style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">

    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#33B7FF" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; height: 15vh;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td bgcolor="#33B7FF" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <h1 style="font-size: 24px; font-weight: bold; margin: 2;">DigiShop Forgot Password Verification Code</h1> <img src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/2966/gif-resetpass.gif" width="auto" height="120" style="display: block; border: 0px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 10px 30px; color: #666666; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="text-align: left; padding-left: 5px;">Hello ' . $user_data["fname"] . " " . $user_data["lname"] . ", " . '</p>
                            <hr/>
                            <p style="margin: 0; text-align: left; padding-left: 15px; padding-top: 10px;">Your Verification code is :</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#ffffff" align="center" style="padding-left: 30px; padding-right: 30px; padding-bottom: 30px;">
                                        <table cellspacing="0" cellpadding="0" style="border: none;">
                                            <td align=" center ">
                                                <div style="background-color: #33B7FF; padding: 15px 25px; border: 3px solid #00A5FF; display: inline-block; border-radius: 10px; ">
                                                <a href="#" style="font-size: 20px; color: #ffffff; letter-spacing: 1px;"">' . $otp . '</a>
                                                </div>
                                            </td>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#ffffff" align="center" style="padding: 0px 30px 30px 30px; color: #666666; font-size: 18px; font-weight: 400; line-height: 25px;">
                                        <p style="margin: 0; padding-left: 15px; padding-bottom: 10px; text-align: left;">Use this verification code to <b>Reset Your Password.</b></p>
                                        <hr/>
                                        <p style="margin: 0; padding-left: 5px; padding-bottom: 10px; text-align: left;">You do not need to reset your password; ignore this message.</p>
                                        <a href="http://localhost/digishop/home.php" style="color: #9f9999; text-decoration: none; text-align: center;">&lArr; Back to Site</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px; height: 20vh;"></td>
        </tr>
    </table>

</div>';
        $mail->Body    = $bodyContent;


        if (!$mail->send()) {
            echo '  Verification code sending failed !!!';
        } else {
            echo '  Success.';
        }
    } else {

        echo ("  Invalid Email Address !!!");
    }
}
