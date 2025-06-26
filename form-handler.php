<?php
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$email_from = 'lucywatson1409@gmail.com';
$email_subject = 'New Form Submission';
$email_body = "User Name: $name.\n".
              "User Email: $visitor_email\n".
              "Subject: $subject\n".
              "User Message: $message\n";

$to = 'sinhamahi1092005@gmail.com';
$header = "From: $email_from\r\n";
$header .= "Reply-To: $visitor_email\r\n";

mail($to, $email_subject, $email_body, $header);

// Optional: Redirect after submission
header("Location: contact.html");
exit();
?>
