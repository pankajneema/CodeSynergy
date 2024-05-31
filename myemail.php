<?php

// Replace this with your own email address
$to = 'pankaj200321@gmail.com';

#function url(){
#    return sprintf(
#        "%s://%s",
#        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
#        $_SERVER['SERVER_NAME']
#    );
#}

   
    $name = 'pankaj_test';  #trim(htmlspecialchars($_POST['name']));
    $email = 'neemapankaj123@gmail.com'; #trim(htmlspecialchars($_POST['email']));
    $subject = 'testinggg';   #trim(htmlspecialchars($_POST['subject']));
    $contact_message = 'Testing mail send';  #trim(htmlspecialchars($_POST['message']));

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
    $from = $name . " <" . $email . ">";

    // Email Headers
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: ". $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    ini_set("sendmail_from", $to); // for windows server
    $mail = mail($to, $subject, $message, $headers);
    echo "--------";
    if ($mail) { 
        echo "OK"; 
    } else { 
        echo "Something went wrong. Please try again."; 
    }

?>

