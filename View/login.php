<?php
ob_start();
$pagetitle = htmlspecialchars('Se connecter - Mael En PHP');


?>
<div class="container formpage">
    <div class="row">
        <div class="col-6">
            <h2>Se connecter</h2>
            <p>Entrez vos informations pour vous connecter</p>

            <?php
            if (!empty($login_err)) {
            ?> <div class="alert alert-danger"><?= htmlspecialchars($login_err) ?></div>
            <?php
            }
            ?>

            <form action="index.php?action=login&amp;" method="post">
                <div class="form-group">
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="username" class="form-control <?= (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?= $username ?>">
                    <span class="invalid-feedback"><?= $username_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" class="form-control <?= (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?= $password ?>">
                    <span class="invalid-feedback"><?= $password_err; ?></span>
                </div><br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Se connecter">
                </div><br>
                <p>Pas de compte? <a href="index.php?action=register&amp;" class="btn btn-secondary">S'inscrire</a>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>