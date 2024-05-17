<?php


function verifyRecaptcha($recaptcha)
{

    //change the site key;
    $recaptchaSecretKey = '6Ld6V_QlAAAAABgMUaH5_2UDDDvvuXwpXLylGzWB';
    $recaptchaResponse = $recaptcha;

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecretKey}&response={$recaptchaResponse}");
    $responseData = json_decode($response);

    if ($responseData->success) {
        return true;
    } else {
        return false;
    }
}
