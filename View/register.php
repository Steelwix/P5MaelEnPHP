
<?php
 $pagetitle = htmlspecialchars('Inscription - Mael En PHP'); 
ob_start(); 

?>
 
 <div class="container formpage">
     <div class="row">
    <div class="col-6">
        <h2>S'inscrire</h2>
        <p>Remplissez les champs ci dessous pour vous inscrire, un mail de confirmation vous sera envoyé</p>
<?php
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . htmlspecialchars($login_err) . '</div>';
        }        
        ?>
        <form action="index.php?action=signin&amp;" method="post">
            <div class="form-group">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control <?= (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?= $username; ?>">
                <span class="invalid-feedback"><?= $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?= (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?= $email; ?>">
                <span class="invalid-feedback"><?= $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control <?= (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?= $password; ?>">
                <span class="invalid-feedback"><?= $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirmez le mot de passe</label>
                <input type="password" name="confirm_password" class="form-control <?= (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?= $confirm_password; ?>">
                <span class="invalid-feedback"><?= $confirm_password_err; ?></span>
            </div><br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Confirmer">
                <input type="reset" class="btn btn-secondary ml-2" value="Réinitialiser">
            </div><br>
            <p>Déjà un compte? <a href="login.php"  class="btn btn-success">Connectez vous</a></p>
        </form>
    </div> </div></div>  

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>