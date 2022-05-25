<?php
// Include config file
require_once('model/UserManager.php');


// Define variables and initialize with empty values
$username = $password = $email = $confirm_password = "";
$username_err = $password_err = $login_err = $email_err = $confirm_password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty(trim($_POST['username'])) OR empty(trim($_POST['email']))){
    $username_err = "Please fill all blanks";
} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
} elseif (isset($_POST['username']) &&  isset($_POST['email']) && isset($_POST['password'])) {
    while($donnees = $users->fetch())
    {
        if($_POST['username'] == $donnees['username'])
        { 
            $username_err = "Pseudo déjà utilisé";
        } elseif($_POST['email']== $donnees['email']) {
            $email_err = "email déjà utilisé";
         }else{

           $username = $_POST['username'];
           $email = $_POST['email'];
           $password = $_POST['password'];
        }
    }
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
<?php
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <form action="index.php?action=signin&amp;" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>