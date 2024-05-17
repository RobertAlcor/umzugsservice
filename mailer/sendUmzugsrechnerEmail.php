<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

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

// Annahme, dass $_POST die Formulardaten enthält.
$details = [
  'Anrede' => $_POST['gender'] ?? 'nicht angegeben',
  'Vorname' => $_POST['first_name'] ?? 'nicht angegeben',
  'Nachname' => $_POST['last_name'] ?? 'nicht angegeben',
  'Telefon' => $_POST['phone'] ?? 'nicht angegeben',
  'E-Mail' => $_POST['email'] ?? 'nicht angegeben',
  'Umzug von' => [
      'Straße und Hausnummer' => $_POST['from_street'] ?? 'nicht angegeben',
      'Stiege, Stock, Tür' => $_POST['from_building'] ?? 'nicht angegeben',
      'Entfernung zur Parkmöglichkeit' => $_POST['from_distance'] ?? 'nicht angegeben',
      'Aufzug vorhanden' => isset($_POST['from_elevator']) ? 'Ja' : 'Nein',
      'Halteverbot gewünscht' => isset($_POST['from_nostopping']) ? 'Ja' : 'Nein',
      'Wohnungsgröße' => $_POST['from_area'] ?? 'nicht angegeben'
  ],
  // Weiteres nach diesem Schema...
];

// Erstellen des E-Mail-Textes
$body = "<h1>Details Ihrer Umzugsanfrage</h1>";
foreach ($details as $key => $value) {
  if (is_array($value)) {
      $body .= "<h2>$key</h2>";
      foreach ($value as $subKey => $subValue) {
          $body .= "<p><strong>$subKey:</strong> $subValue</p>";
      }
  } else {
      $body .= "<p><strong>$key:</strong> $value</p>";
  }
}

$config['body'] = $body;

// Rest des Codes zur E-Mail-Versendung...



// Specific configuration for Umzugsrechner
$config = [
    'host' => 'SMTP.easyname.com',
    'username' => 'your_username',
    'password' => 'your_password',
    'from_email' => 'office@dieumzugsexperten.at',
    'from_name' => 'dieUmzugsExperten Webseite',
    'addresses' => [
        ['email' => $_POST['email'], 'name' => $_POST['first_name'] . ' ' . $_POST['last_name']]
    ],
    'reply_to' => ['email' => 'noreply@dieumzugsexperten.at', 'name' => 'NoReply'],
    'subject' => 'Bestätigung Ihrer Umzugsanfrage',
    'body' => 'Vielen Dank für Ihre Anfrage über unseren Umzugsrechner. Wir werden Ihre Anfrage schnellstmöglich bearbeiten und uns bei Ihnen melden.'
];

$result = sendEmail($config);
if (!$result['success']) {
    error_log('Mail konnte nicht gesendet werden: ' . $result['message']);
}

?>
