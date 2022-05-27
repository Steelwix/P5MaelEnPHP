<?php $pagetitle = 'Mon blog'; ?>

<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
          <br>
<h1>Maël En PHP, la partie administrateur</h1>
<h2>Edition des posts</h2><br>
<em><a href="index.php?action=createPost" class="btn btn-success">Créer un post</a></em>
</div>
    </div>
</div>
<br><div class="container">
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
while ($data = $posts->fetch())
{ 
    ?> <tbody>
    <tr>
      <td><?= ($data['title']) ?></td>
      <td><?= ($data['hat']) ?></td>
      <td><?= ($data['creation_date_fr']) ?></td>
      <td><?= ($data['username']) ?></td>
      <td><a href="index.php?action=modifyPost&amp;idPost=<?= $data['idPost'] ?>" class="btn btn-primary">Modifier</a>
      <a href="index.php?action=deletePost&amp;idPost=<?= $data['idPost'] ?>" class="btn btn-danger">Effacer</a>
      
    </td>
<?php
} ?>
    </tr>
  </tbody>
</table>
</div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
<h2>Edition des commentaires</h2>
</div>
    </div> 
    </div>
    <div class="container">
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
while ($com = $comments->fetch()){ ?>
 <tbody>
    <tr>
      <td><?= ($com['comment']) ?></td>
      <td><?= ($com['comDate']) ?></td>
      <td><?= ($com['username']) ?></td>
      <td><?= ($com['title']) ?></td>
      <td> 
      <?php if($com['isValid'] == 0) 
 {
       ?>   
        <a href="index.php?action=commentIsValid&amp;idComment=<?= $com['idComment'] ?>"class="btn btn-success">Valider</a> 
        <?php
    }
    else {

    } ?>
    <a href="index.php?action=deleteComment&amp;idComment=<?= $com['idComment'] ?>"class="btn btn-danger">Effacer</a></td>
    <?php } ?>
    </tr>
  </tbody>
</table>
</div>
    </div> 
    </div>

 
        <div class="container">
    <div class="row">
        <div class="col-12">
<h2>Edition des utilisateurs</h2>
</div>
    </div> 
    </div>
    <div class="container">
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
while ($com = $users->fetch()){
    if ($com['isAdmin']==1){
        $com['isAdmin'] = "administrateur";
    } 
    else { $com['isAdmin'] = "utilisateur";
    }?>
  <tbody>
    <tr>
      <td><?= ($com['username']) ?></td>
      <td><?= ($com['email']) ?></td>
      <td><?= ($com['created_at']) ?></td>
      <td><?= ($com['isAdmin']) ?></td>
      <td><a href="index.php?action=editUserAdmin&amp;id=<?= $com['id'] ?>" class="btn btn-primary">Editer</a>
      <a href="index.php?action=inspectUser&amp;id=<?= $com['id'] ?>" class="btn btn-danger">Effacer</a>
      
    </td>
    <?php } ?>
    </tr>
  </tbody>
</table>
</div>
    </div> 
    </div>


   

    
<?php
$content = ob_get_clean();

?>



<?php require('template.php'); ?>