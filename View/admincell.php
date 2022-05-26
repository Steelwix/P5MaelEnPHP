<?php $pagetitle = 'Mon blog'; ?>

<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
<h1>Maël En PHP, la partie administrateur</h1>
<h2>Edition des posts</h2><br>
<em><a href="index.php?action=createPost" class="btn btn-success">Créer un post</a></em>
</div>
    </div>
</div>
<br>
<?php
while ($data = $posts->fetch())
{ 
    ?><div class="container">
    <div class="row">
    <div class="col-12 posttitle text-center">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
            <em>S'appelant  <?= $data['username']; ?></em>
        </h3>
        </div>
        <div class="col-12 postdata">
        <p>
            <?= htmlspecialchars($data['hat']) ?>
            <?php htmlspecialchars($data['content']); ?>
</div>
            <br />
            <br>

<div class="col-12 text-center">
    <em><a href="index.php?action=deletePost&amp;idPost=<?= $data['idPost'] ?>" class="btn btn-danger">Effacer ce post</a></em>
    <em><a href="index.php?action=modifyPost&amp;idPost=<?= $data['idPost'] ?>" class="btn btn-primary">Modifier ce post</a></em>
        </p>
    </div>
      </div></div>
    
<?php
} ?>
<div class="container">
    <div class="row">
        <div class="col-12  text-center">
<h2>Edition des commentaires</h2>
</div>
    </div> 
    </div>
    <?php
while ($com = $comments->fetch()){ ?>
<br>
<div class="container">
    <div class="row">
        <div class="col-11 postdata">
        <p>Contenu :<strong><?= ($com['comment']) ?></strong>
    <em>le <?= $com['comDate'] ?></em>
    <em>Ecrit par l'utilisateur<strong>  <?= $com['username'] ?></em></strong>
    <em>Sous le post  <?= $com['title'] ?></em>
    </div>
    <?php if($com['isValid'] == 0) 
 {
        ?>    
            <div class="col-1 postdata">
               
        <a href="index.php?action=deleteComment&amp;idComment=<?= $com['idComment'] ?>"class="btn btn-danger">Effacer ce commentaire</a>   
            <a href="index.php?action=commentIsValid&amp;idComment=<?= $com['idComment'] ?>"class="btn btn-success">Valider ce commentaire</a></div>
        <?php
    }
    else {
       ?> <div class="col-1 postdata">
        <a href="index.php?action=deleteComment&amp;idComment=<?= $com['idComment'] ?>"class="btn btn-danger">Effacer ce commentaire</a></div> 
           <?php
    }} ?>
</div></div>
        <div class="container">
    <div class="row">
        <div class="col-12  text-center">
<h2>Edition des utilisateurs</h2>
</div>
    </div> 
    </div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
        <div class="container">
    <div class="row">
        <div class="col-3 posttitle"><b>Pseudo</b></div>
        <div class="col-3 posttitle"><b>email</b></div>
        <div class="col-3 posttitle"><b>création</b></div>
        <div class="col-3 posttitle"><b>droits</b></div>
       
    </div>
<?php
while ($com = $users->fetch()){
    if ($com['isAdmin']==1){
        $com['isAdmin'] = "administrateur";
    } 
    else { $com['isAdmin'] = "utilisateur";
    }?>

    <div class="row">
        <div class="col-3 postdata text-left"><?= ($com['username']) ?></div>
        <div class="col-3 postdata text-left"><?= $com['email'] ?></div>
        <div class="col-3 postdata text-left"><?= $com['created_at'] ?></div>
        <div class="col-3 postdata text-left"><?= $com['isAdmin'] ?></div>
         <div class="col-1">
    <em><a href="index.php?action=inspectUser&amp;id=<?= $com['id'] ?>" class="btn btn-danger">Supprimer</a></em></div>
    <div class="col-1">
    <em><a href="index.php?action=editUserAdmin&amp;id=<?= $com['id'] ?>" class="btn btn-primary">Editer</a></em>


        </div></div></div>

    <?php } ?>

    
<?php
$content = ob_get_clean();

?>



<?php require('template.php'); ?>