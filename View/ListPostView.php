<?php $pagetitle = 'MaelEnPHP - Le blog des dev PHP juniors - Accueil'; ?>

<?php ob_start(); ?>
<h1>Maël En PHP</h1>

<p>Derniers articles du blog :</p>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <strong><?= htmlspecialchars($data['title']) ?></strong>
            le <?= $data['creation_date_fr'] ?>
            Rédigé par <?= $data['username'] ?>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($data['hat'])) ?>
            <br />
            <em><a href="index.php?action=post&amp;idPost=<?= $data['idPost'] ?>">Lire ce post et voir les commentaires</a></em>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>