<?php
$contact = $email = "";
$contact_err = $email_err = $login_err =  "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST['contact']))
    {
        $contact_err = "Vous devez entrer un message.";
    }
    else
    {

        $contact = $_POST['contact'];
    }
    if(empty(trim($_POST['email'])))
    {
        $email_err = "Vous devez entrer votre email.";
    }
    elseif(filter_var("some@address.com", FILTER_VALIDATE_EMAIL))
    {
        $email = $_POST['email'];
        $email = $_SESSION['email'];

    }
    else 
    {
        $email_err = "Email invalide.";
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
    <div class="wrapper">
        <h2>Contact</h2>
        <p>Please fill in your credentials to cintact.</p>
<?php
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }  
 if(isset($_SESSION['email']))
{
  
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }  
    ?>
            <form action="index.php?action=sendContact&amp;" method="post">
            <div class="form-group">
                <label>Your text</label>
                <input type="text" name="contact" class="form-control <?php echo (!empty($contact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact; ?>">
                <span class="invalid-feedback"><?php echo $contact_err; ?></span>
            </div>    
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</body>
</html> 
       <?php 
      
        
}
else { 
    if(!empty($login_err)){
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }  
?>
    <form action="index.php?action=sendContact&amp;" method="post">
    <div class="form-group">
        <label>email</label>
        <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
        <span class="invalid-feedback"><?php echo $email_err; ?></span>
    </div>
    <div class="form-group">
        <label>Your text</label>
        <input type="text" name="contact" class="form-control <?php echo (!empty($contact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact; ?>">
        <span class="invalid-feedback"><?php echo $contact_err; ?></span>
    </div>     

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Login">
    </div>
</form>
</div>
</body>
</html>
<?php
}
