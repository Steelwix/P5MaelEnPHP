<?php

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMailCreateUser($username, $email, $password)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 1;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'exagon3d@gmail.com';                     //SMTP username
        $mail->Password   = 'xhxmhadfvotkedbc';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('exagon3d@gmail.com', 'MAELENPHP');
        //$mail->addAddress('maelmhun@gmail.com', 'Mael');     //Add a recipient
        $mail->addAddress($email, $username);               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Bonjour ' . $username . ', bienvenue sur Mael En PHP ';
        $mail->Body    = "Voici vos informations, ne les partagez pas. \r\n Votre email = '$email'\r\n Votre username = '$username'\r\n Votre mot de passe = '$password'";
        $mail->AltBody = "Voici vos informations, ne les partagez pas. \r\n Votre email = '$email'\r\n Votre username = '$username'\r\n Votre mot de passe = '$password'";

        $mail->send();
        $location = "location: index.php?action=login";
        requestMain($location);
    } catch (Exception $e) {
    }
}

function sendMailContact($email, $message)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 1;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'exagon3d@gmail.com';                     //SMTP username
        $mail->Password   = 'xhxmhadfvotkedbc';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('exagon3d@gmail.com', 'MAELENPHP');
        //$mail->addAddress('maelmhun@gmail.com', 'Mael');     //Add a recipient
        $mail->addAddress('mhunmael@hotmail.com', 'Mael');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'MAELENPHP CONTACT REQUEST FROM ' . $email . ' ';
        $mail->Body    = 'Message recu venant de ' . $email . ' : ' . $message . ' ';
        $mail->AltBody = 'Message recu venant de ' . $email . ' : ' . $message . ' ';

        $mail->send();

        $location = "Location: index.php";
        requestMain($location);
    } catch (Exception $e) {
    }
}
