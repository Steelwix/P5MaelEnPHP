<?php $pagetitle = htmlspecialchars($users['username']);
?>

<?php ob_start(); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
    <table class="table">
  <thead>
    <tr><br><br>
      <th scope="col">Pseudo</th>
      <th scope="col">Email</th>
      <th scope="col">Création du compte</th>

    </tr>
  </thead>
  <?php
    if ($users['isAdmin']==1){
        $users['isAdmin'] = "administrateur";
    } 
    else { $users['isAdmin'] = "utilisateur";
    }?>
  <tbody>
    <tr>
      <td><?= htmlspecialchars($users['username']) ?></td>
      <td><?= htmlspecialchars($users['email']) ?></td>
      <td><?= htmlspecialchars($users['created_at']) ?></td>

      
    </td>
    </tr>
  </tbody>
</table>
<br><br>
<p>Voulez vous vraiment effacer votre compte? <strong>Ceci est une action irréversible.</strong></p>
<a href="index.php?action=wipeUser&amp;id=<?= $users['id']?>" class="btn btn-danger">Oui, Supprimer le compte</a>

</div>
<div class="col-12">
<br>
<h2>Vos commentaires</h2>
<br>
<?php
while ($ucom = $userComs->fetch())
{
?>
    <p><small>le <?=htmlspecialchars($ucom['comDate']) ?> Sur le post <?= htmlspecialchars($ucom['title']) ?></small></p>
    <strong><p><?= nl2br(htmlspecialchars($ucom['comment'])) ?></p></strong>
    

<?php
}
?>
<br></div>
    </div></div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
