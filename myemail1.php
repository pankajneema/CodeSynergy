<?php

// Replace this with your own email address
$to = 'pankaj200321@gmail.com';
$name = 'pankaj_test';  // Replace with sender's name
$email = 'neemapankaj123@gmail.com'; // Replace with sender's email address
$subject = 'testinggg';   // Replace with email subject
$contact_message = 'Testing mail send';  // Replace with email message

if ($subject == '') {
    $subject = "Contact Form Submission";
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
    exit;
}

// Set Message
$message = "";
$message .= "Email from: " . $name . "<br />";
$message .= "Email address: " . $email . "<br />";
$message .= "Message: <br />";
$message .= nl2br($contact_message);
$message .= "<br /> ----- <br /> This email was sent from your site  contact form. <br />";

// Set From: header
$from = '"' . $name . '" <' . $email . '>';

// Email Headers
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $email . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
ini_set("sendmail_from", $to); // for windows server

// Send mail
$mail = mail($to, $subject, $message, $headers);

// Check for errors
if ($mail) {
    echo "OK";
} else {
    echo "Something went wrong. Please try again.";
    $error = error_get_last();
    if ($error) {
        echo "Error: " . $error['message'];
    }
}
?>

