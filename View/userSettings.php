<?php

$pagetitle = htmlspecialchars('Paramètres d\'utilisateur'); 
ob_start(); 


?>
 
<div class="container">
    <div class="row">
        <div class="col-12">
    <div class="wrapper">
        <h2><?= $user['username']?>,</h2>
        <p>Editez votre profil ci dessous</p>
<?php  if(!empty($login_ok)){
            ?><div class="alert alert-danger"><?= htmlspecialchars($com_info) ?> </div>
            <?php
        }    ?>    
        <form action="index.php?action=userUpdate&amp;id=<?= $gGet['id'] ?>" method="post">
            <div class="form-group">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control <?= (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($username) ?>">
                <span class="invalid-feedback"><?= $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?= (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($email) ?>">
                <span class="invalid-feedback"><?= $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control <?= (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($password) ?>">
                <span class="invalid-feedback"><?= $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirmez le mot de passe</label>
                <input type="password" name="confirm_password" class="form-control <?= (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($confirm_password) ?>">
                <span class="invalid-feedback"><?= $confirm_password_err; ?></span>
                
            </div>
<br>

            <div class="form-group"><br>
                <input type="submit" class="btn btn-primary" value="Valider">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div> </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>