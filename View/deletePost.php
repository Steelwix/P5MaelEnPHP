
<?php $pagetitle = htmlspecialchars($post['title']);
?>

<?php ob_start(); ?>
<br>
<div class="container">
<div class ="row">
<div class="col-12 posttitle">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= htmlspecialchars($post['creation_date_fr']) ?></em>
        <em>par <?= htmlspecialchars($post['username']) ?></em>
    </h3>
</div>
<div class="col-12 postdata">
    <p>
        <?= nl2br(htmlspecialchars($post['content']))?> 
    </p>
</div>
<div class="col-12">
<p>Voulez vous vraiment effacer ce post? <strong>Ceci est une action irréversible.</strong></p>
<a href="index.php?action=wipePost&amp;idPost=<?= $post['idPost']?>" class="btn btn-danger">Oui, Supprimer ce post</a>
</div>
<div class="col-12"><br>
<h2>Commentaires du post</h2>
<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['username']) ?></strong> le <small> <?=htmlspecialchars($comment['comDate']) ?> </small>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>

<?php
}
?></div></div></div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
