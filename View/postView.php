
<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

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

<h2>Commentaires</h2>
<form action="index.php?action=addComment&amp;idPost=<?= $_GET['idPost'] ?>" method="post">
    <div>
        <label for="comment">Ton commentaire :</label><br />
        <textarea type ="text" id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

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
