
<?php $pagetitle = htmlspecialchars('Contact'); 
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

 ob_start(); ?>
<?php
$emailok = $messageok = "";
$email = $message = "";
$email_err = $message_err = "";
if(isset($_SESSION['email']))
{
    $_POST['email'] = $_SESSION['email'];
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST['email']))){
        $email_err = 'Vous devez indiquer votre email';
    }
    else{
        $email = $_POST['email'];
    }

    
    if(empty($_POST['message'])){
        $message_err = "Vous devez entrer un message.";
    } else {
        $message = $_POST['message'];

//Create an instance; passing `true` enables exceptions
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
    $mail->Subject = 'MAELENPHP CONTACT REQUEST FROM '.$email.' ';
    $mail->Body    = 'Message recu venant de '.$email.' : '.$message.' ';
    $mail->AltBody = 'Message recu venant de '.$email.' : '.$message.' ';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
} 


        
    }

}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
<?php if(isset($_SESSION['email']))
{ ?>
       <div class="wrapper">
    <h2>Contact</h2>
    <p>Please fill this form to create an account.</p>
    <form action="index.php?action=contact" method="post">
        <div class="form-group">
            <label>Votre message</label>
            <input type="text" name="message" class="form-control <?php echo (!empty($message_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $message; ?>">
            <span class="invalid-feedback"><?php echo $message_err; ?></span>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
    </form>
</div> 
<?php
}
else { ?>
    <div class="wrapper">
    <h2>Contact</h2>
    <p>Please fill this form to create an account.</p>
    <form action="index.php?action=contact" method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group">
            <label>Votre message</label>
            <input type="text" name="message" class="form-control <?php echo (!empty($message_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $message; ?>">
            <span class="invalid-feedback"><?php echo $message_err; ?></span>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
    </form>
</div> 
<?php
}
   ?>
</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
