
<?php $pagetitle = htmlspecialchars('Contact'); 
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
    <form action="index.php?action=sendMessage" method="post">
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
    <form action="index.php?action=sendMessage" method="post">
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
