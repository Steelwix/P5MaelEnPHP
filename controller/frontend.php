<?php
// Chargement des classes
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
require_once 'model/UserManager.php';
require_once 'vendor/autoload.php';
require_once 'src/Globals/Globals.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use OpenClassrooms\Blog\Globals\Globals;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//$globals=new Globals;
//$gGet = $globals->getGET();
//$gPost = $globals->getPOST();
//$gSession = $globals->getSESSION();
function secureText($text)
{
   $text = htmlspecialchars($text);
   return ($text);
}
function callPage($link)
{
    require $link;
}
function listPosts()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts()->fetchAll();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    Foreach($posts as $post){
   $post['title'] = htmlspecialchars($post['title']);
   $post['hat'] = htmlspecialchars($post['hat']);
   $post['content'] = htmlspecialchars($post['content']);
   $post['creation_date_fr'] = htmlspecialchars($post['creation_date_fr']);
   $post['username'] = htmlspecialchars($post['username']);
   $post['idPost'] = htmlspecialchars($post['idPost']);
}

    require 'View/ListPostView.php';
    
    
}

function post()
{

    $globals=new Globals;
    $gGet = $globals->getGET();
    $gPost = $globals->getPOST();
    $gServer = $globals->getSERVER();
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $post = $postManager->getPost($gGet['idPost']);
    $comments = $commentManager->getComments($gGet['idPost']); 
    $ncomment = $ncomment_err = "";

    if($gServer["REQUEST_METHOD"] == "POST"){
 
        if(($gPost['comment'])==""){
            $ncomment_err = 'Vous devez écrire un commentaire';
        }

            $gPost['comment']=$ncomment;
        }    
    

    require 'View/postView.php';
    
}


function addComment($comment, $isValid, $idUser, $idPost)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $datetime = (new DateTime('now'))->format('Y-m-d H:i:s');
    $newComment = $commentManager->postComment($datetime, $comment, $isValid, $idUser, $idPost);

    if ($newComment === false) {
        throw new Exception('Impossible d\'ajouter le commentaire ! error HK3 ');

    }
    else {
        
        header("Location: index.php?action=post&idPost=" .$idPost);
    }
}
function loginSystem()
{
    $globals=new Globals;

    $gServer = $globals->getSERVER();
    $gPost = $globals->getPOST();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
        header("location: index.php");
    }
     
    
    $username = $password = "";
    $username_err = $password_err = $login_err = "";
    if($gServer["REQUEST_METHOD"] == "POST"){
    if(empty(trim($gPost['username']))){
        $username_err = "Vous devez entrer un pseudo.";
    } else {
        $username = trim($gPost['username']);  
    }
    if(empty(trim($gPost['password']))){
        $password_err = "Vous devez entrer un mot de passe.";
    } else {
        $password = trim($gPost['password']);
    }
    while($donnees = $users->fetch())
    {
        if($gPost['username'] == $donnees['username'] AND $gPost['password']== $donnees['password'])
        { 
            $_SESSION['username'] = $donnees['username'];
            $_SESSION['id'] = $donnees['id'];
            $_SESSION['loggedin'] = true;
            $_SESSION['isAdmin'] = $donnees['isAdmin'];
            $_SESSION['email'] = $donnees['email'];
            header("location: index.php");
        } else { 
            $login_err = "Les informations ne correspondent pas.";
        }
    }
    }
    require 'View/login.php';
}
function registerSystem()
{

    $globals=new Globals;
    $gServer = $globals->getSERVER();
    $gPost = $globals->getPOST();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    $username = $password = $email = $confirm_password = "";
$username_err = $password_err = $login_err = $email_err = $confirm_password_err = "";
unset( $_SESSION['validRegister']);
if($gServer["REQUEST_METHOD"] == "POST"){
if(empty(trim($gPost['username'])) OR empty(trim($gPost['username']))){
    $email = "Please fill all blanks";
    $login_err = "Veuillez corriger les erreurs";
}if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($gPost["email"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
    $login_err = "Veuillez corriger les erreurs";
} 
if(($gPost['password'] !== $gPost['confirm_password'])== true) {
    $password_err = "Mots de passe non identiques.";
    $login_err = "Veuillez corriger les erreurs";
}
elseif (isset($gPost['username']) &&  isset($gPost['email']) && isset($gPost['password'])) {
    while($donnees = $users->fetch())
    {
        if($gPost['username'] === $donnees['username'])
        { 

            $username_err = "Pseudo déjà utilisé";
        }
        if($gPost['email']=== $donnees['email']) {

            $email_err = "email déjà utilisé";
           
         }
           $username = $gPost['username'];
           $email = $gPost['email'];
           $password = $gPost['password'];
           
        }
    }
    }

    require 'View/register.php';

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
        
    } catch (Exception $e) {
        
    } 
}

function logOutSystem()
{
    require 'View/logout.php';
}
function adminSystem()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $comments = $commentManager->getAllCom(); 
    require 'View/admincell.php';
    
}
function deletePost()
{
    $globals=new Globals;
    $gGet = $globals->getGET();
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $post = $postManager->getPost($gGet['idPost']);
    $comments = $commentManager->getComments($gGet['idPost']);
    $title = secureText($post['title']);
    require 'View/deletePost.php';
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
    $globals=new Globals;
    $gGet = $globals->getGET();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUser($gGet['id']);
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $userComs = $commentManager->getUserComments($gGet['id']);

    require 'View/deleteUser.php';
}
function inspectUserSelf()
{
    $globals=new Globals;
    $gGet = $globals->getGET();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUser($gGet['id']);
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $userComs = $commentManager->getUserComments($gGet['id']);

    require 'View/deleteUserSelf.php';
}
function wipeUser()
{
    $globals=new Globals;
    $gGet = $globals->getGET();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $userManager->deleteUser($gGet['id']);

    header("Location: index.php?action=admincell");
}
function wipeUserSelf()
{
    $globals=new Globals;
    $gGet = $globals->getGET();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $userManager->deleteUser($gGet['id']);
    header("Location: index.php?action=logout");
}
function createPost()
{
    $globals=new Globals;
    $gServer = $globals->getSERVER();
    $title = $hat = $content = $author = "";
    $title_err = $hat_err = $content_err = "";

if($gServer["REQUEST_METHOD"] == "POST"){
    if(empty($gPost['title'])){
        $title_err = 'Please fill all blanks';
    }
    else {
        $title = $gPost['title'];
    }
    if(empty($gPost['hat'])){
        $hat_err = 'Please fill all blanks';
    }
    else {
        $hat = $gPost['hat'];
    }
    if(empty($gPost['content'])){
        $content_err = 'Please fill all blanks';
    }
    else {
        $content = $gPost['content'];
    }
}
require 'View/createPost.php';
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
    $globals=new Globals;
    $gGet = $globals->getGET();
    $gServer = $globals->getSERVER();
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $post = $postManager->getPost($gGet['idPost']);
    $title_err = $hat_err = $content_err = "";
$title = $post['title'];
$hat = $post['hat'];
$content = $post['content'];

if($gServer["REQUEST_METHOD"] == "POST"){
    if(empty($gPost['title'])){
        $title_err = 'Please fill all blanks';
    }
    else {
        $title = $gPost['title'];
    }
    if(empty($gPost['hat'])){
        $hat_err = 'Please fill all blanks';
    }
    else {
        $hat = $gPost['hat'];
    }
    if(empty($gPost['content'])){
        $content_err = 'Please fill all blanks';
    }
    else {
        $content = $gPost['content'];
    }
    if(isset($gPost['title']) && isset($gPost['hat']) && isset($gPost['content']) && isset($_SESSION['id'])){
       
    }
}
   require 'View/modifypost.php';
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
    $globals=new Globals;
    $gServer = $globals->getSERVER();
    $email = $message = "";
    $email_err = $message_err = "";  
  
if(isset($_SESSION['email']))
{
    $gPost['email'] = $_SESSION['email'];
}
if($gServer["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($gPost['email']))){
        $email_err = 'Vous devez indiquer votre email';
    }
    else{
        $email = $gPost['email'];
    }

    
    if(empty($gPost['message'])){
        $message_err = "Vous devez entrer un message.";
    } else {
        $message = $gPost['message'];
    
    }

    
}
require 'View/contact.php';
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
        
        header("Location: index.php");
    } catch (Exception $e) {
        
    } 
    
}
function editUser()
{
    $globals=new Globals;
    $gGet = $globals->getGET();
    $gPost = $globals->getPOST();
    $gServer = $globals->getSERVER();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $user = $userManager->getUser($gGet['id']);
    $username = $password = $email = $confirm_password = "";
$username_err = $password_err = $login_err = $email_err = $confirm_password_err = "";
$username = $user['username'];
$email = $user['email'];
$password = $user['password'];
if($_SESSION['id'] != $gGet['id'])
{
    header("Location: index.php");
}
if($gServer["REQUEST_METHOD"] == "POST"){
if(empty(trim($gPost['username'])) OR empty(trim($gPost['email']))){
    $username_err = "Please fill all blanks";
} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($gPost["username"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
} elseif (isset($gPost['username']) &&  isset($gPost['email']) && isset($gPost['password'])) {
    while($donnees = $user->fetch())
    {
        if($gPost['username'] == $donnees['username'] AND $gPost['email']== $donnees['email'])
        { 
            throw new Exception('Ces informations appartiennent a un autre utilisateur');
        } else { 
           $username = $gPost['username'];
           $email = $gPost['email'];
           $password = $gPost['password'];

        }
    }
    }
}

    require 'View/userSettings.php';
    
}
function editUserAdmin()
{
    $globals=new Globals;
    $gPost = $globals->getPOST();
    $gGet = $globals->getGET();
    $gServer = $globals->getSERVER();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $user = $userManager->getUser($gGet['id']);
    $username = $password = $email = $confirm_password = "";
$username_err = $password_err = $login_err = $email_err = $confirm_password_err = "";
$username = $user['username'];
$email = $user['email'];
$password = $confirm_password = $user['password'];
$isAdmin = $user['isAdmin'];
$adaptedAction = "editUserAdmin";
if($gServer["REQUEST_METHOD"] == "POST"){
if(empty(trim($gPost['username'])) OR empty(trim($gPost['email'])))
{
    $username_err = "Please fill all blanks";
} 
if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($gPost["username"])))
{
    $username_err = "Username can only contain letters, numbers, and underscores.";
}


    elseif (isset($gPost['username']) &&  isset($gPost['email']) && isset($gPost['password'])) {

           $username = $gPost['username'];
           $email = $gPost['email'];
           $password = $gPost['password'];
           $isAdmin = $gPost['isAdmin'];
           $login_ok = "Les informations ne sont pas valides";
        }
    else {
        
    }}

    require 'View/userSettingsAdmin.php';
    
}
function userUpdate($username, $email, $password, $idUser) 
{
    $globals=new Globals;
    $gPost = $globals->getPOST();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $editUser = $userManager->userNewSettings($username, $email, $password, $idUser);
    if($editUser === false) {
        throw new Exception('Impossible de modifier le profil ! error L1');
        
    }
    else {
        $_SESSION['username'] = $gPost['username'];
        $_SESSION['email'] = $gPost['email'];
        header("Location: index.php");
    } 
}
function userUpdateAdmin($username, $email, $password, $isAdmin, $idUser) 
{
    
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $editUser = $userManager->userNewSettingsAdmin($username, $email, $password, $isAdmin, $idUser);
    if($editUser === false) {
        throw new Exception('Impossible de modifier le profil ! error L1');
        
    }
    else {
        header("Location: index.php?action=admincell");
    } 
}
function welcome()
{
    require 'View/welcome.php';
}