<?php
// Include config file
require_once('model/UserManager.php');
$pagetitle = 'Editer le profil';
// Define variables and initialize with empty values
$username = $password = $email = $confirm_password = "";
$username_err = $password_err = $login_err = $email_err = $confirm_password_err = "";
$username = $user['username'];
$email = $user['email'];
$password = $user['password'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty(trim($_POST['username'])) OR empty(trim($_POST['email']))){
    $username_err = "Please fill all blanks";
} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
} elseif (isset($_POST['username']) &&  isset($_POST['email']) && isset($_POST['password'])) {
    while($donnees = $users->fetch())
    {
        if($_POST['username'] == $donnees['username'] AND $_POST['email']== $donnees['email'])
        { 
            throw new Exception('Votre compte existe surement déjà !');
        } else { 
           $username = $_POST['username'];
           $email = $_POST['email'];
           $password = $_POST['password'];

        }
    }
    }
}
?>
 

<body>
    <div class="container">
        <div class="row">
    <div class="col-12 wrapper">
        <h2>Editer le profil</h2>
        <p>Modifier vos informations dans les champs ci dessous.</p>
        <form action="index.php?action=userUpdate&amp;id=<?= $_GET['id'] ?>" method="post">
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
    </div>
    </div>
</body>
</html>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>