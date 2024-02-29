<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("PHPMailer/Exception.php");
require("PHPMailer/PHPMailer.php");
require("PHPMailer/SMTP.php");


function Elz_Mail($to, $to_name, $subject, $body) {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->Host = "ssl://smtp.gmail.com";
    $mail->Port = "465"; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
    $mail->SMTPAuth = true;

    $mail->Username = "info@skyebook.asia";
    $mail->Password = "@Bobys123@";
    
    $mail->From = "info@skyebook.asia";
    $mail->FromName = "SkyEbook";
    $mail->AddAddress($to);
    $mail->AddReplyTo("info@skyebook.asia", "SkyEbook");
    
    $mail->Subject = $subject;
    $mail->Body = "$body";
    $mail->WordWrap = 50;
    $mail->isHtml(true);
    
    if(!$mail->Send()) {
        return 'Mailer error: ' . $mail->ErrorInfo;
    } else {
        return true;
    }
}

?>