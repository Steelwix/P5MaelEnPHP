<?php $pagetitle;
?>

<?php ob_start(); ?>
<section class="container">
  <div class="row justify-content-center">
    <div class="col-12">
      <table class="table">
        <thead>
          <tr><br><br>
            <th scope="col">Pseudo</th>
            <th scope="col">Email</th>
            <th scope="col">Création du compte</th>
            <th scope="col">Droits</th>

          </tr>
        </thead>
        <?php
        if ($user['isAdmin'] == 1) {
          $user['isAdmin'] = "administrateur";
        } else {
          $user['isAdmin'] = "utilisateur";
        }
        $user['isAdmin'] = htmlspecialchars($user['isAdmin']); ?>
        <tbody>
          <tr>
            <td><?= $user['username'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['created_at'] ?></td>
            <td><?= $user['isAdmin'] ?></td>


            </td>
          </tr>
        </tbody>
      </table>
      <br><br>
      <p>Voulez vous vraiment effacer cet utilisateur? <strong>Ceci est une action irréversible.</strong></p>
      <a href="index.php?action=wipeUser&amp;id=<?= $user['id'] ?>" class="btn btn-danger">Oui, Supprimer cet utilisateur</a>

    </div>
    <div class="col-12">
      <br>
      <h2>Commentaires de l'utilisateur</h2>
      <br>
      <?php
      foreach ($userComs as $userCom) {
      ?>
        <p><small>le <?= $userCom['comDate'] ?> Sur le post <?= $userCom['title'] ?></small></p>
        <strong>
          <p><?= $userCom['comment'] ?></p>
        </strong>


      <?php
      }
      ?>
      <br>
    </div>
  </div>
</section>
<?php $content = ob_get_clean(); ?>