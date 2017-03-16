<?php

require_once('../crm/protected/components/phpMailer/class.phpmailer.php');

$mail             = new PHPMailer();

$body             = "TEST EMAIL";

$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = false;                  // enable SMTP authentication
//$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "104.131.164.199";      // sets GMAIL as the SMTP server
$mail->Port       = 25;                   // set the SMTP port for the GMAIL server
$mail->Username   = "";  // GMAIL username
$mail->Password   = "";            // GMAIL password

/*
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "kjones@sunbeltnetwork.com";  // GMAIL username
$mail->Password   = "@1Martini";            // GMAIL password
*/


$mail->SetFrom('kjones@sunbeltnetwork.com', 'First Last');


$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "srulishaffren@gmail.com";
$mail->AddAddress($address, "Marc Gottlieb");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
    
echo "<pre>";
print_r($mail);
echo "</pre>";
