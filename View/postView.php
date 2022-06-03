
<?php $pagetitle = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-12 text-center">
<p><a href="index.php" class="btn btn-primary"> << Retour à la liste des posts</a></p>
        </div></div><br>
    <div class="row">
    <div class="col-12 posttitle text-center">
        <h3>
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <small><em>le <?= htmlspecialchars($post['creation_date_fr']) ?></em>
        <em>par  <?= htmlspecialchars($post['username']) ?></em></small>
    </h3>
</div>
<div class="col-12 postdata">
    <p>
        <?= htmlspecialchars($post['content'])?> 
    </p>
</div>
    </div>

    <div class="row">
        <div class="col-6">
    
<h2>Commentaires</h2>
<?php 
        if(!empty($com_info)){
            echo '<div class="alert alert-danger">' . htmlspecialchars($com_info) . '</div>';
        }        
        ?>
<form action="index.php?action=addComment&amp;idPost=<?= $_GET['idPost'] ?>" method="post">
<div class="form-group">
<textarea type="text" name="comment" class="form-control <?= (!empty($ncomment_err)) ? 'is-invalid' : ''; ?>" value="<?= $ncomment; ?>"></textarea>
   <span class="invalid-feedback"><?= $ncomment_err; ?></span></div>
   <br>
<div class="form-group">
   <input type="submit" class="btn btn-primary" value="Publier">
</div>
</form><br>
 

       
<?php
while ($comment = $comments->fetch())
{
?>


    <p><strong><?= htmlspecialchars($comment['username']) ?></strong> le <small> <?=htmlspecialchars($comment['comDate']) ?> </small>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <br><br>
<?php
}
?>
</div></div></div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
