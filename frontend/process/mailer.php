<?php

require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Enabling exceptions
$mail= new PHPMailer(true);

// $mail->SMTPDebug= SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth=true;

// configuring smtp server
$mail->Host="smtp.gmail.com";
$mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port=587;
$mail->Username="davkharbayr05@gmail.com";
$mail->Password="tdsnajokvczcuywx";

$mail->isHTML(true);

return $mail;