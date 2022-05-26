<?php
// Initialize the session
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
        <div class="col-12 text-center"><h1>Bonjour, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
        <p><br>

        <a href="index.php?action=editUser&amp;id=<?= $_SESSION['id'] ?>" class="btn btn-primary">Editer le profil</a>
        <a href="index.php?action=inspectUserSelf&amp;id=<?= $_SESSION['id'] ?>" class="btn btn-danger">Effacer le profil</a>

        <a href="logout.php" class="btn btn-secondary">Sign Out of Your Account</a>
        <a href="index.php" class="btn btn-primary">Go to home</a>
    </p>

    </div>
        </div></div>
    

</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>