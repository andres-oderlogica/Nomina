<?php
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
/*$mail->IsSMTP();                           // telling the class to use SMTP
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "smtp.gmail.com"; // set the SMTP server
$mail->Port       = 587;   */
$mail->IsSMTP();   
$mail ->SMTPSecure  =  'ssl' ;                         // telling the class to use SMTP
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "smtp.gmail.com"; // set the SMTP server
$mail->Port       = 465;                     // set the SMTP port
$mail->Username   = "boanergespadres@gmail.com"; // SMTP account username
$mail->Password   = "boanerges.2017";        // SMTP account password
$mail->setFrom('juanandres1210@gmail.com', 'Andres');
$mail->addAddress('juanandres12102018@gmail.com', 'Recibe');
$mail->Subject  = 'First PHPMailer Message';
$mail->Body     = 'Hi! This is my first e-mail sent through PHPMailer.';
if(!$mail->send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}