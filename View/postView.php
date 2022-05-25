
<?php $pagetitle = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-12 text-center">
<p><a href="index.php">Retour à la liste des posts</a></p>
        </div></div></div>
<div class="container">
    <div class="row">
    <div class="col-12 posttitle text-center">
        <h3>
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
        <em>auteur <?= $post['username'] ?></em>
    </h3>
</div>
<div class="col-12 postdata">
    <p>
        <?= nl2br(htmlspecialchars($post['content']))?> 
    </p>
</div>
    </div>

    <div class="row">
        <div class="col-12">
    

<h2>Commentaires</h2>
<form action="index.php?action=addComment&amp;idPost=<?= $_GET['idPost'] ?>" method="post">
    <div>
        <p><label for="comment">Ton commentaire :</label><br /></p>
        <textarea type ="text" id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
        <br><br>
    </div>
</form>
</div></div>   
         
<?php
while ($comment = $comments->fetch())
{
?>
 
 <div class="row">
 <div class="col-12"> 
    <p><strong><?= htmlspecialchars($comment['username']) ?></strong> le <?=htmlspecialchars($comment['comDate']) ?>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <br><br>
<?php
}
?>
<?php $content = ob_get_clean(); ?>
</div></div></div>
<?php require('template.php'); ?>
