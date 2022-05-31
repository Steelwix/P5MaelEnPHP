<?php

$pagetitle = htmlspecialchars('Paramètres d\'utilisateur'); 
ob_start(); 


?>
 

    <div class="wrapper">
        <h2>Editer le profil de l'utilisateur <?= $user['username']?></h2>
        <p>Modifiez les paramètres de l'utilisateur.</p>
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
<br>
<div class="form-group">
                <label>Rôle:</label>
                <select name="isAdmin">
<?php if($isAdmin==1)
{?>
                    <option value="1"">Administrateur</option>
                    <option value="0">Utilisateur</option>
<?php }
else 
{?>                     <option value="0"">Utilisateur</option>
                        <option value="1">Administrateur</option>
<?php } ?>
           

                </select>
            </div>
            <div class="form-group"><br>
                <input type="submit" class="btn btn-primary" value="Valider">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div> 


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>