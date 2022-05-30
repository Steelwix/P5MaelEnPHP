<?php
// Include config file
$pagetitle = htmlspecialchars('Se connecter'); 
ob_start(); 

// Define variables and initialize with empty values

?>
 

    <div class="wrapper">
        <h2>Editer le profil de l'utilisateur <?= $user['username']?></h2>
        <p>Please fill this form to create an account.</p>
<?php  if(!empty($login_ok)){
            echo '<div class="alert alert-danger">' . $login_ok . '</div>';
        }    ?>    
        <form action="index.php?action=userUpdateAdmin&amp;id=<?= $_GET['id'] ?>" method="post">
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
                <label>New Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm new Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <!--<label>IsAdmin?</label>
                <input type="text" name="isAdmin" class="form-control <?php echo (!empty($isAdmin_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $isAdmin; ?>">
                <span class="invalid-feedback"><?php echo $isAdmin_err; ?></span>
            </div>-->
            <div class="form-group">
                <label>Rôle:</label>
                <select name="isAdmin">
                    <option value="0"">Utilisateur</option>
                    <option value="1">Admin</option>
                </select>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Valider">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>