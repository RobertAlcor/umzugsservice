<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendEmail(array $recepient_emails = [], array $cc_emails = [], array $bcc_emails = [], $reply_to_email = '', $reply_to_name = '', $subject, $message_body)
{
    //Create an instance; passing `true` enables exceptions
    try {
        $mail = new PHPMailer(true);

        //Server settings
        $sent_from_email = 'office@dieumzugsexperten.at'; #change from email
        $sent_from_name = 'dieUmzugsExperten Webseite';  #change the name if needed


        $mail->SMTPDebug = 0;;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'SMTP.easyname.com';  #enter host name                   //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '230952mail6';  #add smtp username     //change SMTP username
        $mail->Password   = '0.v7p82lzyi9';  # enter password      //change SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->setLanguage('de', 'language');
        $mail->CharSet = 'utf-8';
        //sent from
        $mail->setFrom($sent_from_email, $sent_from_name);
        $mail->addAddress($_POST['email'], $_POST['first_name'] . ' ' . $_POST['last_name']);


        //recepient
        foreach ($recepient_emails as $email) {
            $mail->addAddress($email);
        }

        //carbon copy
        foreach ($cc_emails as $email) {
            $mail->addCC($email);
        }

        //blind copy
        foreach ($bcc_emails as $email) {
            $mail->addBCC($email);
        }
        //reply to
        if ($reply_to_email) {
            $mail->addReplyTo($reply_to_email, $reply_to_name);
        }



        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message_body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
