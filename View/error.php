<?php $pagetitle = htmlspecialchars('Page inexistante');

ob_start(); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <br>
            <strong>ERROR 404, LA PAGE N'EXISTE PAS</strong>

            <em><a href="index.php" class="btn btn-success">Retourner vers l'accueil</a></em>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>