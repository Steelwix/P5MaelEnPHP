<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
    <?php require('View/navbar.php');
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo '<p>Bonjour ', $_SESSION["username"]; ?>
    <a href="View/logout.php">Se déconnecter </a>
 <?php }
else {
        echo '<p>Vous êtes hors ligne</p>'; ?>
        <a href="View/login.php">Se connecter </a> 
        <?php
    }?> 
        <?= $content ?>
        <?php require('View/footer.php'); ?>
    </body>
</html>
