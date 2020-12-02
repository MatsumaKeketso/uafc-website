<?php
// basic email infor to send
$email_to = 'keketsomatsuma88@gmail.com';
$subject = 'subject';
$message = 'message';

// email headers
$header = "From: keketso@mlab.co.za"

// send email to radio
if (mail($email_to, $subject, $message, $header))
    echo 'success';
else 
    echo 'not sent'

?>