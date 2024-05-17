<?php

require_once('verify-recaptcha.php');
require_once('email-configuration.php');

$domain = $_SERVER['SERVER_NAME'];
#form data needed wit input name
#change tranlated name  to language of your prefer, to used when delivering the email
# for required change to false if the field is not required
# for filtered email change the error message
// your can remove or add 

$required_error_message = 'Bitte füllen Sie alle Pflichtfelder aus.'; # change to your translated language
$recaptcha_error_message = 'Die reCAPTCHA-Überprüfung ist fehlgeschlagen. Bitte versuche es erneut.'; #change to your translated language
$verify_recaptcha = true;  #change  to false if don't want google recaptcha varification
$success_page = '/danke.php'; # redirect after message sent
$website_name = 'WebDesign Alcor';  #change the name if needed
$recepient_emails = ['anfrage@webdesign-alcor.at']; //recepient emails. The email to receive the message.  at least one required

$cc_emails = []; # carbon copy emails. must be erray. optional
$bcc_emails = []; # blincd carbon copy emails. must be array. optional
$reply_to_email = 'anfrage@webdesign-alcor.at';  # reply email. optional
$reply_to_name = 'WebDesign Alcor';  # name of  reply.  optional


$subject = 'Contact Form'; #'change subject';

$form_inputs = [
    'name' => [
        'required' => true,
        'include_in_email' => true,
        'translated_name' => 'Name',
    ],
    'company' => [
        'required' => false,
        'include_in_email' => true,
        'translated_name' => 'Company',
    ],
    'email' => [
        'required' => true,
        'include_in_email' => true,
        'translated_name' => 'email',
        'filter_email' => 'Enter valid email'
    ],
    'phone' => [
        'required' => false,
        'include_in_email' => true,
        'translated_name' => 'Phone',
    ],
    'agreement' => [
        'required' => true,
        'include_in_email' => false,
        'translated_name' => 'agreement',
    ],
    'message' => [
        'required' => true,
        'include_in_email' => true,
        'translated_name' => 'Message',
    ],


];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = '';
    $required_errors = 0;

    if ($verify_recaptcha) {
        $resp = verifyRecaptcha($_POST['google_token']);
        if (!$resp) {
            $errors .= $recaptcha_error_message . '<br>';
        }
    }

    foreach ($form_inputs  as  $key => $v) {
        // Check if a specific form field is set and not empty
        if ($v['required']) {
            if (!isset($_POST[$key]) || empty($_POST[$key])) {
                $required_errors++;
            }
        }
        //check if email  valid
        if (isset($key['filter_email'])) {
            if (isset($_POST[$key])) {
                if (!filter_var($_POST[$key], FILTER_VALIDATE_EMAIL)) {
                    $errors .= $key['filter_email'] . '<br>';
                }
            }
        }
    }
    if ($required_errors > 0) {

        //change this to your translated language
        $errors .= $required_error_message . '<br>';
    }


    if ($errors) {
        $response = ['errors' => $errors];
        header("Content-Type: application/json");
        echo json_encode($response);
        return exit();
    } else {
        $form_data = [];
        foreach ($form_inputs  as  $key => $v) {
            if (isset($_POST[$key])) {
                $input = $_POST[$key];

                if (is_array($input)) {
                    $input = implode(', ', $input);
                }
                $cleanedData = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
                $output = nl2br($cleanedData);
                if ($v['include_in_email']) {
                    $form_data[$key] = [
                        'translated_name' => $v['translated_name'],
                        'value' => $output
                    ];
                }
            }
        }


        $message_body = "<table width='90%' cellpadding='5' cellspacing='2'>";
        foreach ($form_data as $k => $v) {

            $message_body .= "<tr><th style='text-align:left;vertical-align:top'>
                                        " . $v['translated_name'] . ":
                                    </th>
                                    <td style='text-align:left;vertical-align:top'>
                                        " . $v['value'] . "
                                    </td>
                                </tr>";
        }
        $message_body .= "</table>";


        $send_email = sendEmail(
            recepient_emails: $recepient_emails,
            cc_emails: $cc_emails,
            bcc_emails: $bcc_emails,
            reply_to_email: $reply_to_email,
            reply_to_name: $reply_to_name,
            subject: $subject,
            message_body: $message_body
        );

        if ($send_email) {
            $json = ['success_page' => $success_page];
            header("Content-Type: application/json");
            echo json_encode($json);
            return exit();
        } else {
            $response = [
                'errors' => "Nachricht konnte nicht versendet werden. Ihre Nachricht konnte nicht versendet werden.
        Bitte versuchen Sie es wieder zu einem späteren Zeitpunkt.",

            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return exit();
        }
    }
} else {
    echo  'wrong method';
}
