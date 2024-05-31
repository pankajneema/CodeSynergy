<?php

#gamil where you want to recive mail 
$to = 'pankaj200321@gmail.com';
$mailersend_api_token = 'mlsn.9cb07ac92c343359c5e50dbde15075163a9a1b574b1cee90e77aff2281f65dd6'; // Replace with your MailerSend API token

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

if ($_POST) {

    $name = trim(stripslashes($_POST['name']));
    $email = trim(stripslashes($_POST['email']));
    $subject = trim(stripslashes($_POST['subject']));
    $contact_message = trim(stripslashes($_POST['message']));

    if ($subject == '') {
        $subject = "Contact Form Submission";
    }

    // Set Message
    $text_message = "Email from: " . $name . "\nEmail address: " . $email . "\Email Subject: " . $subject . "\nMessage: \n" . $contact_message;
    $html_message = "Email from: " . $name . "<br />Email address: " . $email . "<br />Message:  " . nl2br($contact_message);
    $html_message .= "<br /> ---  --- <br />";

    // Prepare data for MailerSend API
    $postData = [
        'from' => ['email' => 'MS_MQJxca@trial-zr6ke4nj7jmgon12.mlsender.net'], 
        'to' => [['email' => $to]],
        'subject' => "Incoming From PortFolio - ".$subject,
        'text' => $text_message,
        'html' => $html_message,
    ];

    $ch = curl_init('https://api.mailersend.com/v1/email');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'X-Requested-With: XMLHttpRequest',
        'Authorization: Bearer ' . $mailersend_api_token,
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 202) {
        echo 'OK';
    } else {
        echo 'Something went wrong. Please try again. Response: ' . $response;
    }
}
?>
