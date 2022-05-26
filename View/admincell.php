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

<div class="container">
    <div class="row">
        <br><div class="col-12 posttitle">
        <p>Contenu :<strong><?= ($com['comment']) ?></strong>
    <em>le <?= $com['comDate'] ?></em>
    <em>Ecrit par l'utilisateur<strong>  <?= $com['username'] ?></em></strong>
    <em>Sous le post  <?= $com['title'] ?></em><br>
    </div></div></div>
    <div class="container">
    <div class="row">
        <div class="col-12"><br>
    <em><a href="index.php?action=deleteComment&amp;idComment=<?= $com['idComment'] ?>"class="btn btn-danger">Effacer ce commentaire</a></em>
    <?php if($com['isValid'] == 0) 
 {
        ?>
            <em><a href="index.php?action=commentIsValid&amp;idComment=<?= $com['idComment'] ?>"class="btn btn-success">Valider ce commentaire</a></em> 
        <?php
    }} ?>
        </div></div></div>
        <div class="container">
    <div class="row">
        <div class="col-12  text-center">
<h2>Edition des utilisateurs</h2>
</div>
    </div> 
    </div>
<?php
while ($com = $users->fetch()){
    if ($com['isAdmin']==1){
        $com['isAdmin'] = "admin";
    } 
    else { $com['isAdmin'] = "n'est pas admin";
    }?>
<div class="container">
    <div class="row">
        <br><div class="col-12 posttitle">
    <p>Pseudo :<?= ($com['username']) ?>
    <em>email <?= $com['email'] ?></em>
    <em>mot de passe <?= $com['password'] ?></em>
    <em>Compte créé le  <?= $com['created_at'] ?></em>
    <em>est  <?= $com['isAdmin'] ?></em><br>
</div>
        <div class="col-12">
<br>
    <em><a href="index.php?action=inspectUser&amp;id=<?= $com['id'] ?>" class="btn btn-danger">Supprimer cet utilisateur</a></em>
    <em><a href="index.php?action=editUserAdmin&amp;id=<?= $com['id'] ?>" class="btn btn-primary">Editer cet utilisateur</a><br><br></em>
        </div></div></div>
    <?php } 
    

$content = ob_get_clean();

?>
</div>
    </div> 
    </div>


<?php require('template.php'); ?>