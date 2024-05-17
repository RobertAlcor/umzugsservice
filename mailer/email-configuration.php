<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendEmail($config)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0; // Disable verbose debug output in production
        $mail->isSMTP();
        $mail->Host       = $config['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['username'];
        $mail->Password   = $config['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setLanguage('de', 'language');
        $mail->CharSet = 'UTF-8';

        // Sender and recipient settings
        $mail->setFrom($config['from_email'], $config['from_name']);
        foreach ($config['addresses'] as $address) {
            $mail->addAddress($address['email'], $address['name']);
        }

        if (!empty($config['reply_to'])) {
            $mail->addReplyTo($config['reply_to']['email'], $config['reply_to']['name']);
        }

        // Content
        $mail->isHTML(true);
        $mail->Subject = $config['subject'];
        $mail->Body    = $config['body'];

        $mail->send();
        return ['success' => true];
    } catch (Exception $e) {
        return ['success' => false, 'message' => $mail->ErrorInfo];
    }
}

$config = [
  'host' => 'SMTP.easyname.com',
  'username' => 'your_username',
  'password' => 'your_password',
  'from_email' => 'office@dieumzugsexperten.at',
  'from_name' => 'dieUmzugsExperten Webseite',
  'addresses' => [
      ['email' => 'customer@example.com', 'name' => 'John Doe']
  ],
  'reply_to' => ['email' => 'noreply@dieumzugsexperten.at', 'name' => 'NoReply'],
  'subject' => 'Ihr Umzugsangebot',
  'body' => 'Hier ist Ihr Angebot...'
];

$result = sendEmail($config);
if (!$result['success']) {
  error_log('Mail konnte nicht gesendet werden: ' . $result['message']);
}
