<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 use PHPMailer\PHPMailer\SMTP;

 require __DIR__ ."/vendor/autoload.php";
 $mail = new PHPMailer(true);
 $mail->isSMTP();
 $mail->SMTPAuth = true;

 $mail->Host = "smtp.gmail.com";
 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
 $mail->Port = 587;
 $mail->Username = "petsmyourhome@gmail.com"; 
 $mail->Password = "jalzdszswwmjvnbh";
 
 $mail->isHTML(true);
 return $mail;