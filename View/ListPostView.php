<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Maël En PHP</h1>

<p>Derniers articles du blog :</p>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
            <em>Post numéro <?= $data['idPost'] ?></em>
            <em>Rédigé par <?= $data['username'] ?></em>
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