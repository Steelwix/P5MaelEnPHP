<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Maël En PHP, le backstage du blog backend</h1>

<p>Administration :</p>


<em><a href="index.php?action=createPost">Créer un post</a></em>
<?php
while ($data = $posts->fetch())
{ 
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
            <em>S'appelant  <?= $data['username']; ?></em>
        </h3>
        
        <p>
            <?= htmlspecialchars($data['hat']) ?>
            <?php htmlspecialchars($data['content']); ?>
            <br />
            <br>
    <em><a href="index.php?action=deletePost&amp;idPost=<?= $data['idPost'] ?>">Effacer ce post</a></em>
        </p>
    </div>
    
<?php
}
while ($com = $comments->fetch()){ ?>
    <p>Contenu :<?= ($com['comment']) ?>
    <em>le <?= $com['comDate'] ?></em>
    <em>Ecrit par l'utilisateur  <?= $com['username'] ?></em>
    <em>Sous le post  <?= $com['title'] ?></em><br>
    <em><a href="index.php?action=deleteComment&amp;idComment=<?= $com['idComment'] ?>">Effacer ce commentaire</a></em>
    <?php } 

while ($com = $users->fetch()){
    if ($com['isAdmin']==1){
        $com['isAdmin'] = "admin";
    } 
    else { $com['isAdmin'] = "pas admin";
    }?>
    <p>Pseudo :<?= ($com['username']) ?>
    <em>email <?= $com['email'] ?></em>
    <em>mot de passe <?= $com['password'] ?></em>
    <em>Compte créé le  <?= $com['created_at'] ?></em>
    <em>est  <?= $com['isAdmin'] ?></em><br>
    <em><a href="index.php?action=inspectUser&amp;id=<?= $com['id'] ?>">Inspecter cet utilisateur</a></em>
    <?php } 
    

$content = ob_get_clean();

?>



<?php require('template.php'); ?>