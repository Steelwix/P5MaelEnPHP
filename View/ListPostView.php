<?php $pagetitle = 'MaelEnPHP - Le blog des dev PHP juniors - Accueil'; ?>

<?php ob_start(); ?>
<br><br>
<section class="container">
    <div class="row">
        <div class="col-lg-8 postdata">
            <h3>Maël Mhun, développeur et prometteur</h3>
            <p> "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                mollit anim id est laborum."</p></br>

        </div>
        <div class="col-lg-4 ">
            <img src="public/images/portrait.jpg" class="mx-auto d-table img-fluid" width="auto" alt="Site logo">
        </div>

        <div class="col-lg-12">
            <br><br>
            <a href="public/images/CVoct.pdf" download="maelmhunCV" class="btn btn-primary">Voir mon CV</a>
        </div>
    </div>
</section>

<br><br>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-12 text-center">
            <h1>Maël En PHP</h1>

            <p>Derniers articles du blog :</p>
        </div>
    </div>
</div>
<?php
foreach ($posts as $post) {
?>
    <div class="container">
        <div class="row">
            <div class="col-12 posttitle text-center">
                <h3>
                    <strong><?= $post['title'] ?></strong>
                    <small><i> <?= $post['creation_date_fr'] ?>
                            par <?= $post['username'] ?></small></i>
                </h3>
            </div>
            <div class="col-12 postdata">
                <p><br>
                    <?= $post['hat'] ?>
                    <br>
                    <br>
                    <em><a href="index.php?action=post&amp;idPost=<?= $post['idPost'] ?> " class="btn btn-primary">Lire ce post</a></em>
                </p>
            </div>
        </div>
    </div>
<?php
}
?>

<?php $content = ob_get_clean(); ?>
<?= require 'View/template.php'; ?>