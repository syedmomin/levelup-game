<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


$mail = new PHPMailer();
// $mail->IsSMTP();
$mail->CharSet="UTF-8";
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.hostinger.com';
$mail->Port = 465;
$mail->Username = 'admin@infotechabout.com';
$mail->Password = 'Admin123456#$';
$mail->SMTPAuth = true;

$mail->From = 'admin@infotechabout.com';
$mail->FromName = 'Level UP Game';
$mail->AddAddress('syedmomin168@gmail.com');
$mail->AddReplyTo('admin@infotechabout.com', 'technology');

$mail->IsHTML(true);
$mail->Subject    = "Dataminds Technology";

$mail->Body    = "<b>Hi Tasfia</b>email.";

if(!$mail->Send())
{
  echo "Mailer Error: " . $mail->ErrorInfo;
}
?>