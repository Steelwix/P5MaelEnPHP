<?php $pagetitle;

ob_start(); ?>
<section class="container">
  <div class="row">
    <div class="col-12">
      <br>
      <h1>Maël En PHP, la partie administrateur</h1>
      <h2>Edition des posts</h2><br>
      <em><a href="index.php?action=createPost" class="btn btn-success">Créer un post</a></em>
    </div>
  </div>
</section>
<br>
<section class="container">
  <div class="row justify-content-center">
    <div class="col-12">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Titre</th>
            <th scope="col">Chapo</th>
            <th scope="col">Date de publication</th>
            <th scope="col">Auteur</th>
            <th scope="col">Options</th>
          </tr>
        </thead>
        <?php
        foreach ($posts as $post) {
        ?> <tbody>
            <tr>
              <td><?= $post['title'] ?></td>
              <td><?= $post['hat'] ?></td>
              <td><?= $post['creation_date_fr'] ?></td>
              <td><?= $post['username'] ?></td>
              <td><a href="index.php?action=modifyPost&amp;idPost=<?= $post['idPost'] ?>" class="btn btn-primary">Modifier</a><br><br>
                <a href="index.php?action=deletePost&amp;idPost=<?= $post['idPost'] ?>" class="btn btn-danger">Effacer</a>
              </td>
            <?php
          } ?>
            </tr>
          </tbody>
      </table>
    </div>
  </div>
</section>

<section class="container">
  <div class="row">
    <div class="col-12">
      <h2>Edition des commentaires</h2>
    </div>
  </div>
</section>
<section class="container">
  <div class="row justify-content-center">
    <div class="col-12">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Contenu</th>
            <th scope="col">Date du commentaire</th>
            <th scope="col">Ecrit par</th>
            <th scope="col">Sur le post</th>
            <th scope="col">Options</th>
          </tr>
        </thead>
        <?php
        foreach ($comments as $comment) { ?>
          <tbody>
            <tr>
              <td><?= $comment['comment'] ?></td>
              <td><?= $comment['comDate'] ?></td>
              <td><?= $comment['username'] ?></td>
              <td><?= $comment['title'] ?></td>
              <td>
                <?php if ($comment['isValid'] == 0) {
                ?>
                  <a href="index.php?action=commentIsValid&amp;idComment=<?= $comment['idComment'] ?>" class="btn btn-success">Valider</a>
                <?php
                } else {
                } ?>
                <a href="index.php?action=deleteComment&amp;idComment=<?= $comment['idComment'] ?>" class="btn btn-danger">Effacer</a>
              </td>
            <?php } ?>
            </tr>
          </tbody>
      </table>
    </div>
  </div>
</section>


<section class="container">
  <div class="row">
    <div class="col-12">
      <h2>Edition des utilisateurs</h2>
    </div>
  </div>
</section>
<section class="container">
  <div class="row justify-content-center">
    <div class="col-12">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Pseudo</th>
            <th scope="col">Email</th>
            <th scope="col">Création du compte</th>
            <th scope="col">Droits</th>
            <th scope="col">Options</th>
          </tr>
        </thead>
        <?php
        foreach ($users as $user) { ?>
          <tbody>
            <tr>
              <td><?= $user['username'] ?></td>
              <td><?= $user['email'] ?></td>
              <td><?= $user['created_at'] ?></td>
              <?php
              if ($user['isAdmin'] == 1) {
                $user['isAdmin'] = "administrateur";
              } else {
                $user['isAdmin'] = "utilisateur";
              }
              $user['isAdmin'] = htmlspecialchars($user['isAdmin']); ?>
              <td><?= $user['isAdmin'] ?></td>
              <td><a href="index.php?action=editUserAdmin&amp;id=<?= $user['id'] ?>" class="btn btn-primary">Editer</a>
                <a href="index.php?action=inspectUser&amp;id=<?= $user['id'] ?>" class="btn btn-danger">Effacer</a>

              </td>
            <?php } ?>
            </tr>
          </tbody>
      </table>
    </div>
  </div>
</section>





<?php
$content = ob_get_clean(); ?>