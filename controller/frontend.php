<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function secureText($text)
{
   $text = htmlspecialchars($text);
   return ($text);
}
function listPosts()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts()->fetchAll();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    Foreach($posts as $post){
   $post['title'] = htmlspecialchars ($post['title']);
   $post['hat'] = htmlspecialchars ($post['hat']);
   $post['content'] = htmlspecialchars ($post['content']);
   $post['creation_date_fr'] = htmlspecialchars ($post['creation_date_fr']);
   $post['username'] = htmlspecialchars ($post['username']);
   $post['idPost'] = htmlspecialchars ($post['idPost']);
}
    require('View/ListPostView.php');
    
}

function post()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $post = $postManager->getPost($_GET['idPost']);
    $comments = $commentManager->getComments($_GET['idPost']); /*undefined index*/
    $ncomment = $ncomment_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        if(($_POST['comment'])==""){
            $ncomment_err = 'Vous devez écrire un commentaire';
        }
        else{
            $_POST['comment']=$ncomment;
        }    
    }

    require('View/postView.php');
    
}


function addComment($comment, $isValid, $id, $idPost)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $datetime = (new DateTime('now'))->format('Y-m-d H:i:s');
    $newComment = $commentManager->postComment($datetime, $comment, $isValid, $id, $idPost);

    if ($newComment === false) {
        throw new Exception('Impossible d\'ajouter le commentaire ! error HK3 ');

    }
    else {
        
        header("Location: index.php?action=post&idPost=" .$idPost);
    }
}
function loginSystem()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
        header("location: index.php");
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
        $password_err = "Vous devez entrer un mot de passe.";
    } else {
        $password = trim($_POST['password']);
    }
    while($donnees = $users->fetch())
    {
        if($_POST['username'] == $donnees['username'] AND $_POST['password']== $donnees['password'])
        { echo "connexion validée";
            $_SESSION['username'] = $donnees['username'];
            $_SESSION['id'] = $donnees['id'];
            $_SESSION['loggedin'] = true;
            $_SESSION['isAdmin'] = $donnees['isAdmin'];
            $_SESSION['email'] = $donnees['email'];
            header("location: index.php");
        } else { 
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
            $_POST['username'],
            $_POST['password']);
        }
    }
    }
    require('View/login.php');
}
function registerSystem()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    $username = $password = $email = $confirm_password = "";
$username_err = $password_err = $login_err = $email_err = $confirm_password_err = "";
unset( $_SESSION['validRegister']);
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty(trim($_POST['username'])) OR empty(trim($_POST['email']))){
    $email = "Please fill all blanks";
}if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
} 
if(($_POST['password'] !== $_POST['confirm_password'])== true) {
    $password_err = "Mots de passe non identiques.";
}
elseif (isset($_POST['username']) &&  isset($_POST['email']) && isset($_POST['password'])) {
    while($donnees = $users->fetch())
    {
        if($_POST['username'] === $donnees['username'])
        { 

            $username_err = "Pseudo déjà utilisé";
        } elseif($_POST['email']=== $donnees['email']) {

            $email_err = "email déjà utilisé";
           
         }else{
            $_SESSION['validRegister']='yes';
           $username = $_POST['username'];
           $email = $_POST['email'];
           $password = $_POST['password'];
           
        }
    }
    }
}
    require('View/register.php');

}
function createUser($username, $email, $password)
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $datetime = (new DateTime('now'))->format('Y-m-d H:i:s');
    $newUser = $userManager->createUser($username, $email, $password, $datetime);
    if($newUser === false) {
        throw new Exception('Impossible d\'ajouter l\'utilisateur ! error Z1 ');
    }
    else {
        header("Location: index.php?action=login");
    }
    
}
function sendMailCreateUser($username, $email, $password)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 1;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'exagon3d@gmail.com';                     //SMTP username
        $mail->Password   = 'xhxmhadfvotkedbc';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('exagon3d@gmail.com', 'MAELENPHP');
        //$mail->addAddress('maelmhun@gmail.com', 'Mael');     //Add a recipient
        $mail->addAddress($email, $username);               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
       // $mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Bonjour '.$username.', bienvenue sur Mael En PHP ';
        $mail->Body    = "Voici vos informations, ne les partagez pas. \r\n Votre email = '$email'\r\n Votre username = '$username'\r\n Votre mot de passe = '$password'" ;
        $mail->AltBody = "Voici vos informations, ne les partagez pas. \r\n Votre email = '$email'\r\n Votre username = '$username'\r\n Votre mot de passe = '$password'" ;
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    } 
}

function logOutSystem()
{
    require('View/logout.php');
}
function adminSystem()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $comments = $commentManager->getAllCom(); 
    require('View/admincell.php');
    
}
function deletePost()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $post = $postManager->getPost($_GET['idPost']);
    $comments = $commentManager->getComments($_GET['idPost']);
    $title = secureText($post['title']);
    require('View/deletePost.php');
}
function wipePost($idPost)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $postManager->deletePost($idPost);
    header("Location: index.php?action=admincell");
    
}
function deleteComment($idComment)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager->deleteComment($idComment);
    header("Location: index.php?action=admincell");
}
function commentIsValid($idComment)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager->commentIsValid($idComment);
    header("Location: index.php?action=admincell");
}
function inspectUser()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUser($_GET['id']);
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $userComs = $commentManager->getUserComments($_GET['id']);

    require('View/deleteUser.php');
}
function inspectUserSelf()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUser($_GET['id']);
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $userComs = $commentManager->getUserComments($_GET['id']);

    require('View/deleteUserSelf.php');
}
function wipeUser()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $userManager->deleteUser($_GET['id']);

    header("Location: index.php?action=admincell");
}
function wipeUserSelf()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $userManager->deleteUser($_GET['id']);
    header("Location: index.php?action=logout");
}
function createPost()
{

    $title = $hat = $content = $author = "";
    $title_err = $hat_err = $content_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST['title'])){
        $title_err = 'Please fill all blanks';
    }
    else {
        $title = $_POST['title'];
    }
    if(empty($_POST['hat'])){
        $hat_err = 'Please fill all blanks';
    }
    else {
        $hat = $_POST['hat'];
    }
    if(empty($_POST['content'])){
        $content_err = 'Please fill all blanks';
    }
    else {
        $content = $_POST['content'];
    }
}
require('View/createPost.php');
}
function newPost($title, $hat, $content, $author)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $datetime = (new DateTime('now'))->format('Y-m-d H:i:s');
    $newPost = $postManager->newPost($datetime, $title, $hat, $content, $author);
    if($newPost === false) {
        throw new Exception('Impossible de créer un post ! error HK43 ');
    }
    else {
        header("Location: index.php?action=listPosts");
    }
}
function modifyPost()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $post = $postManager->getPost($_GET['idPost']);
    $title_err = $hat_err = $content_err = "";
$title = $post['title'];
$hat = $post['hat'];
$content = $post['content'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST['title'])){
        $title_err = 'Please fill all blanks';
    }
    else {
        $title = $_POST['title'];
    }
    if(empty($_POST['hat'])){
        $hat_err = 'Please fill all blanks';
    }
    else {
        $hat = $_POST['hat'];
    }
    if(empty($_POST['content'])){
        $content_err = 'Please fill all blanks';
    }
    else {
        $content = $_POST['content'];
    }
    if(isset($_POST['title']) && isset($_POST['hat']) && isset($_POST['content']) && isset($_SESSION['id'])){
       
    }
}
   require("View/modifypost.php");
}
function postEdit($title, $hat, $content, $author, $idPost)
{   
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $datetime = (new DateTime('now'))->format('Y-m-d H:i:s');
    $editPost = $postManager->editPost($datetime, $title, $hat, $content, $author, $idPost);
    if($editPost === false) {
        throw new Exception('Impossible de créer un post ! error T99');
        
    }
    else {
        header("Location: index.php?action=admincell");
        
    } 
}
function contactForm()
{
    $emailok = $messageok = "";
    $email = $message = "";
    $email_err = $message_err = "";  
  
if(isset($_SESSION['email']))
{
    $_POST['email'] = $_SESSION['email'];
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST['email']))){
        $email_err = 'Vous devez indiquer votre email';
    }
    else{
        $email = $_POST['email'];
    }

    
    if(empty($_POST['message'])){
        $message_err = "Vous devez entrer un message.";
    } else {
        $message = $_POST['message'];
    
    }

    
}
require('View/contact.php');
}
function sendMailContact($email, $message)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 1;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'exagon3d@gmail.com';                     //SMTP username
        $mail->Password   = 'xhxmhadfvotkedbc';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('exagon3d@gmail.com', 'MAELENPHP');
        //$mail->addAddress('maelmhun@gmail.com', 'Mael');     //Add a recipient
        $mail->addAddress('mhunmael@hotmail.com', 'Mael');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
       // $mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'MAELENPHP CONTACT REQUEST FROM '.$email.' ';
        $mail->Body    = 'Message recu venant de '.$email.' : '.$message.' ';
        $mail->AltBody = 'Message recu venant de '.$email.' : '.$message.' ';
    
        $mail->send();
        echo 'Message has been sent';
        header("Location: index.php");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    } 
    
}
function editUser()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $user = $userManager->getUser($_GET['id']);
    $username = $password = $email = $confirm_password = "";
$username_err = $password_err = $login_err = $email_err = $confirm_password_err = "";
$username = $user['username'];
$email = $user['email'];
$password = $user['password'];
if($_SESSION['id'] != $_GET['id'])
{
    header("Location: index.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty(trim($_POST['username'])) OR empty(trim($_POST['email']))){
    $username_err = "Please fill all blanks";
} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
} elseif (isset($_POST['username']) &&  isset($_POST['email']) && isset($_POST['password'])) {
    while($donnees = $user->fetch())
    {
        if($_POST['username'] == $donnees['username'] AND $_POST['email']== $donnees['email'])
        { 
            throw new Exception('Ces informations appartiennent a un autre utilisateur');
        } else { 
           $username = $_POST['username'];
           $email = $_POST['email'];
           $password = $_POST['password'];

        }
    }
    }
}

    require('View/userSettings.php');
    
}
function editUserAdmin()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $user = $userManager->getUser($_GET['id']);
    $username = $password = $email = $confirm_password = "";
$username_err = $password_err = $login_err = $email_err = $confirm_password_err = "";
$username = $user['username'];
$email = $user['email'];
$password = $confirm_password = $user['password'];
$isAdmin = $user['isAdmin'];
$adaptedAction = "editUserAdmin";
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty(trim($_POST['username'])) OR empty(trim($_POST['email'])))
{
    $username_err = "Please fill all blanks";
} 
if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"])))
{
    $username_err = "Username can only contain letters, numbers, and underscores.";
}


    elseif (isset($_POST['username']) &&  isset($_POST['email']) && isset($_POST['password'])) {

           $username = $_POST['username'];
           $email = $_POST['email'];
           $password = $_POST['password'];
           $isAdmin = $_POST['isAdmin'];
           $login_ok = "Les informations ne sont pas valides";
        }
    else {
        
    }}

    require('View/userSettingsAdmin.php');
    
}
function userUpdate($username, $email, $password, $id) 
{
    
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $editUser = $userManager->userNewSettings($username, $email, $password, $id);
    if($editUser === false) {
        throw new Exception('Impossible de modifier le profil ! error L1');
        
    }
    else {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $_POST['email'];
        header("Location: index.php");
    } 
}
function userUpdateAdmin($username, $email, $password, $isAdmin, $id) 
{
    
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $editUser = $userManager->userNewSettingsAdmin($username, $email, $password, $isAdmin, $id);
    if($editUser === false) {
        throw new Exception('Impossible de modifier le profil ! error L1');
        
    }
    else {
        header("Location: index.php?action=admincell");
    } 
}
function welcome()
{
    require('View/welcome.php');
}