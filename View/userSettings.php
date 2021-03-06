<?php

$pagetitle;
ob_start();


?>
<section class="container">
    <div class="row">
        <div class="col-12">

            <div class="wrapper">
                <h2>Editer le profil de l'utilisateur <?= $user['username'] ?></h2>
                <p>Modifiez les paramètres de l'utilisateur.</p>
                <?php if (!empty($login_ok)) {
                ?><div class="alert alert-danger"><?= htmlspecialchars($login_ok) ?> </div>
                <?php
                }    ?>
                <form action="index.php?action=<?= $adaptedAction ?>&amp;id=<?= $gGet['id'] ?>" method="post">
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
                    <?php if ($gSession['isAdmin'] == 1) {

                    ?>
                        <div class="form-group">
                            <label>Rôle:</label>
                            <select name="isAdmin">
                                <?php if ($isAdmin == 1) { ?>
                                    <option value="1"">Administrateur</option>
                    <option value=" 0">Utilisateur</option>
                                <?php } else { ?> <option value="0"">Utilisateur</option>
                        <option value=" 1">Administrateur</option>
                                <?php } ?>


                            </select>
                        </div>
                    <?php   } else {
                    ?>
                        <div class="form-group">
                            <label>Rôle:</label>
                            <select name="isAdmin">
                                <option value=" 0">Utilisateur</option>

                            <?php
                        } ?>
                            </select>
                        </div>
                        <div class="form-group"><br>
                            <input type="submit" class="btn btn-primary" value="<?= $buttonValue ?>">
                            <input type="reset" class="btn btn-secondary ml-2" value="Réinitialiser">
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>