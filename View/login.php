<?php
// Initialize the session

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: View/welcome.php");
    exit;
}
 

$username = $password = "";
$username_err = $password_err = $login_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty(trim($_POST['username']))){
    $username_err = "Vous devez entrer un pseudo.";
} else {
    $username = trim($_POST['username']);  
}
if(empty(trim($_POST['password']))){
    $username_err = "Vous devez entrer un mot de passe.";
} else {
    $username = trim($_POST['password']);
}
while($donnees = $users->fetch())
{
    if($_POST['username'] == $donnees['username'] AND $_POST['password']== $donnees['password'])
    { echo "connexion validée";
        $_SESSION['username'] = $donnees['username'];
        $_SESSION["loggedin"] = true;
        header("location: View/welcome.php");
    } else { 
        $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
        $_POST['username'],
        $_POST['password']);
    }
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="index.php?action=login&amp;" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="index.php?action=register&amp;">Sign up now</a>
        </form>
    </div>
</body>
</html>