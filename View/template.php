

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $pagetitle ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="public/style.css">  

    </head>
        <?php require ('View/navbar.php'); ?>
    <body>
    <div class="card text-white bg-dark mb-3" style="max-width: 20rem;">
  <div class="card-header"><?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){    
    echo 'Bonjour ', ($_SESSION['username']);
     ?></div>
  <div class="card-body">
    <h4 class="card-title"> <?php
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION['isAdmin'] == 1)
    {echo '<p> Vous êtes un admin'; ?>
        <em><a href="index.php?action=admincell&amp;">Acceder à la partie admin</a></em> <?php }
    else {}
        ?> </h4>
    <p class="card-text">    
    <a href="index.php?action=logout&amp;">Se déconnecter </a><br>
    <a href="index.php?action=welcome&amp;id=<?= $_SESSION['id'] ?>">Paramètres du compte </a>
  </div>






  <div class="card-header"> <?php }
else { ?>
      <?php echo 'Vous êtes hors ligne'; ?></div>
  <div class="card-body">
    <p class="card-text">
    <em><a href="index.php?action=login&amp;">Se connecter</a></em> </p>
    <?php } ?>
  </div>
</div>
</div>

 

        <?= $content ?>
        <?php require('View/footer.php'); ?>
    </body>
</html>
