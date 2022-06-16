<?php

$pagetitle = htmlspecialchars('Paramètres d\'utilisateur');
ob_start();


?>

<div class="container">
    <div class="row">
        <div class="col-12 text-center"><br>
            <h1>Bonjour <b><?= htmlspecialchars($gSession["username"]); ?></b>.</h1>
            <p><br>

                <a href="index.php?action=editUser&amp;id=<?= $gSession['id'] ?>" class="btn btn-primary">Editer le profil</a>
                <a href="index.php?action=inspectUserSelf&amp;id=<?= $gSession['id'] ?>" class="btn btn-danger">Effacer le profil</a>

                <a href="logout.php" class="btn btn-secondary">Sign Out of Your Account</a>
                <a href="index.php" class="btn btn-primary">Go to home</a>
            </p>
            <br>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>