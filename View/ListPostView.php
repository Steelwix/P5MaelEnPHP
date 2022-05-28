<?php $pagetitle = 'MaelEnPHP - Le blog des dev PHP juniors - Accueil'; ?>

<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-12 text-center">
<h1>Maël En PHP</h1>

<p>Derniers articles du blog :</p>
        </div></div></div>
<?php
while ($data = $posts->fetch())
{
?>
<div class="container">
    <div class="row">
    <div class="col-12 posttitle text-center">
        <h3>
            <strong><?= htmlspecialchars($data['title']) ?></strong>
            <small><i> <?= $data['creation_date_fr'] ?>
            par <?= $data['username'] ?></small></i>
        </h3>
        </div>
        <div class="col-6 postdata">
        <p>
            <?= nl2br(htmlspecialchars($data['hat'])) ?>
            <br />
</div>
<div class="col-6 postdata">
            <em><a href="index.php?action=post&amp;idPost=<?= $data['idPost'] ?> "class="btn btn-primary">Lire ce post et voir les commentaires</a></em>
        </p>
</div>
    </div>
</div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>