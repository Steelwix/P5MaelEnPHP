
<?php $title = htmlspecialchars($post['title']);
?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
        <em>auteur <?= $post['id'] ?></em>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($post['content']))?> 
    </p>
</div>
<p>Voulez vous vraiment effacer ce post? <strong>Ceci est une action irréversible.</strong></p>
<a href="index.php?action=wipePost&amp;idPost=<?= $post['idPost']?>">Oui, Supprimer ce post</a>

<h2>Commentaires</h2>

<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['username']) ?></strong>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
