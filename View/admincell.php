<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Maël En PHP</h1>

<p>Administration :</p>

<?php

while ($data = $posts->fetch())
{ 
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
            <em>Post numéro <?= $data['idPost'] ?></em>
            <em>Ecrit par l'utilisateur  <?= $data['id'] ?></em>
            <em>S'appelant  <?= $data['username']; ?></em>
        </h3>
        
        <p>
            <?= htmlspecialchars($data['hat']) ?>
            <?php htmlspecialchars($data['content']); ?>
            <br />
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>