<?php
date_default_timezone_set('Etc/UTC');
require_once('libs\PHPMailer\PHPMailerAutoload.php');

if(!empty($_POST['Mail']))
{

//Create a new PHPMailer instance
    $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
    $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
    $mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
//Set the hostname of the mail server
    $mail->Host = "smtp.gmail.com";
    $mail->CharSet = 'UTF-8';
   // $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->SMTPSecure = 'tls';
$mail->Debugoutput = 'html';

//Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 587;
//Whether to use SMTP authentication
    $mail->SMTPAuth = true;
//Username to use for SMTP authentication
    $mail->Username = "erik.arustamyan2000@gmail.com";
//Password to use for SMTP authentication
    $mail->Password = "I_ReSpawn";

//Set who the message is to be sent from
    $mail->setFrom($_POST['Mail'], $_POST['Firstname'] . ' ' . $_POST['Lastname']);
//Set an alternative reply-to address
    $mail->addReplyTo($_POST['Mail'], $_POST['Firstname'] . ' ' . $_POST['Lastname']);
//Set who the message is to be sent to
    $mail->addAddress('erik.arustamyan2000@gmail.com', 'John Doe');

    $mail->Subject = 'Заказ на сайт: Цена - ' . $_POST['Price'];
    $mail->msgHTML($_POST['About']);
    $mail->ErrorInfo = 0;
//Set the subject line
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//Replace the plain text body with one created manually
//Attach an image file

//send the message, check for errors
$mail->SMTPDebug = false;
$mail->do_debug = 0;
    if (!$mail->send()) {
        ob_end_clean();
        require 'Sent.html';

    } else {
        ob_end_clean();
        exit(require 'Sent.html');
    }


}
else{
    require 'Error.html';
}