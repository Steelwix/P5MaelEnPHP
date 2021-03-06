<?php $pagetitle;
?>

<?php ob_start(); ?>
<br>
<section class="container">
    <div class="row">
        <div class="col-12 posttitle">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= htmlspecialchars($post['creation_date_fr']) ?></em>
                <em>par <?= htmlspecialchars($post['username']) ?></em>
            </h3>
        </div>
        <div class="col-12 postdata">
            <p>
                <?= htmlspecialchars($post['content']) ?>
            </p>
        </div>
        <div class="col-12">
            <p>Voulez vous vraiment effacer ce post? <strong>Ceci est une action irréversible.</strong></p>
            <a href="index.php?action=wipePost&amp;idPost=<?= $post['idPost'] ?>" class="btn btn-danger">Oui, Supprimer ce post</a>
        </div>
        <div class="col-12"><br>
            <h2>Commentaires du post</h2>
            <?php
            foreach ($comments as $comment) {
            ?>
                <p><strong><?= $comment['username'] ?></strong> le <small> <?= $comment['comDate'] ?> </small>
                <p><?= $comment['comment'] ?></p>

            <?php
            }
            ?>
        </div>
    </div>
</section>
<?php $content = ob_get_clean(); ?>