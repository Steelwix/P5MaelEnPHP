<?php $title = htmlspecialchars($users['username']);
?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>

<div class="news">
    <h3>
        <?= htmlspecialchars($users['username']) ?>
        <?= htmlspecialchars($users['email']) ?>
        <em>mdp <?= $users['password'] ?></em>
        <em>création <?= $users['created_at'] ?></em>
        <em>admin? <?= $users['isAdmin'] ?></em>
    </h3>
    
</div>
<p>Voulez vous vraiment effacer ce post? <strong>Ceci est une action irréversible.</strong></p>
<a href="index.php?action=wipeUser&amp;id=<?= $users['id']?>">Oui, Supprimer ce post</a>

<h2>Commentaires de l'utilisateur</h2>

<?php
while ($ucom = $userComs->fetch())
{
?>
    <p><?= nl2br(htmlspecialchars($ucom['comment'])) ?></p>
<?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
