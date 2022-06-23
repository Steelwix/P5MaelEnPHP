<?php

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use OpenClassrooms\Blog\Globals\Globals;
use OpenClassrooms\Blog\Session\Session;

function registerSystem()
{
    $globals = new Globals;
    $gServer = $globals->getSERVER();
    $gPost = $globals->getPOST();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    $username = $password = $email = $confirm_password = $username_err = $password_err = $login_err = $email_err = $confirm_password_err = "";
    $adaptedAction = 'register';
    $buttonValue = 'Vérifier';
    if ($gServer["REQUEST_METHOD"] == "POST") {
        if (empty(trim($gPost['username'])) or empty(trim($gPost['username']))) {
            $username_err = "Indiquez un pseudo";
            $login_err = "Veuillez corriger les erreurs";
            $adaptedAction = 'register';
            $buttonValue = 'Vérifier';
            $valueError = true;
        }
        if (filter_var($gPost['email'], FILTER_VALIDATE_EMAIL)) {
        } else {
            $email_err = "Respectez le format des emails";
            $login_err = "Veuillez corriger les erreurs";
            $adaptedAction = 'register';
            $buttonValue = 'Vérifier';
            $valueError = true;
        }
        if ($gPost['password'] == "") {
            $password_err = "Veuillez définir un mot de passe";
            $adaptedAction = 'register';
            $buttonValue = 'Vérifier';
            $valueError = true;
        }
        if (($gPost['password'] !== $gPost['confirm_password']) == true or $gPost['confirm_password'] == "") {
            $password_err = "Mots de passe non identiques.";
            $confirm_password_err = "Mots de passe non identiques.";
            $login_err = "Veuillez corriger les erreurs";
            $adaptedAction = 'register';
            $buttonValue = 'Vérifier';
        }
        while ($donnees = $users->fetch()) {
            if ($gPost['username'] === $donnees['username']) {
                $login_err = "Un utilisateur utilise déjà ces informations";
                $username_err = "Un utilisateur utilise déjà ce pseudo";
                $valueError = true;
            }
            if ($gPost['email'] === $donnees['email']) {
                $login_err = "Un utilisateur utilise déjà ces informations";
                $username_err = "Un utilisateur utilise déjà ce pseudo";
                $valueError = true;
            }
        }
        if (!isset($valueError)) {
            $adaptedAction = 'signin';
            $buttonValue = 'Valider';
        }
        $username = $gPost['username'];
        $email = $gPost['email'];
        $password = $gPost['password'];
        $confirm_password = $gPost['confirm_password'];
    }
    $pagetitle = htmlspecialchars('Inscription - Mael En PHP');
    require 'View/register.php';
    requestTemplate($content, $pagetitle);
}
function createUser($username, $email, $password)
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $datetime = (new DateTime('now'))->format('Y-m-d H:i:s');
    $newUser = $userManager->createUser($username, $email, $password, $datetime);
    if ($newUser === false) {
        throw new Exception('Impossible d\'ajouter l\'utilisateur ! error Z1 ');
    } else {
        sendMailCreateUser($username, $email, $password);
    }
}
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
function contactForm()
{
    $pagetitle = htmlspecialchars('Contact');
    $session = new Session;
    $gSession = $session->getSESSION();
    $globals = new Globals;
    $gServer = $globals->getSERVER();
    $email = $message = $email_err = $message_err = "";

    if (isset($gSession['email'])) {
        $gPost['email'] = $gSession['email'];
    }
    if ($gServer["REQUEST_METHOD"] == "POST") {

        if (empty(trim($gPost['email']))) {
            $email_err = 'Vous devez indiquer votre email';
        } else {
            $email = $gPost['email'];
        }


        if (empty($gPost['message'])) {
            $message_err = "Vous devez entrer un message.";
        } else {
            $message = $gPost['message'];
        }
    }
    require 'View/contact.php';
    requestTemplate($content, $pagetitle);
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
