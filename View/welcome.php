<?php

$pagetitle = htmlspecialchars('Paramètres d\'utilisateur');
ob_start(); 

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header("location: index.php");
}
?>
 
    <div class="container">
        <div class="row">
        <div class="col-12 text-center"><br>
            <h1>Bonjour <b><?= htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
        <p><br>

        <a href="index.php?action=editUser&amp;id=<?= $_SESSION['id'] ?>" class="btn btn-primary">Editer le profil</a>
        <a href="index.php?action=inspectUserSelf&amp;id=<?= $_SESSION['id'] ?>" class="btn btn-danger">Effacer le profil</a>

        <a href="logout.php" class="btn btn-secondary">Sign Out of Your Account</a>
        <a href="index.php" class="btn btn-primary">Go to home</a>
    </p>
<br>
    </div>
        </div></div>
    
<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>