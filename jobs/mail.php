<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use UniLEDApp\Logger;

require_once dirname(__DIR__) . '/vendor/autoload.php';


$mail = new PHPMailer;

$mail->isSMTP();

$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->Host = 'mailtrap.io';
$mail->Port = 2525;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = 'rubens.nogueira@printastico.com.br';
$mail->Password = '';
$mail->setFrom('rubens.nogueira@uniled.co.uk', 'Rubens Nogueira');
$mail->addAddress('rubens.nogueira@printastico.com.br', 'Rubens Nogueira');
$mail->Subject = 'A great deal from a friend!';
$mail->msgHTML(file_get_contents('./jobs/contents.html'), __DIR__);
$mail->AltBody = 'That is a great deal from UniLED, shared by your friend.';
if (!$mail->send()) {
    Logger::log('Mailer Error: '. $mail->ErrorInfo);
} else {
    Logger::log('Message sent!');
}

?>
