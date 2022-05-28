<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');
require_once('model/messageManager.php');
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function listPosts()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    require('View/ListPostView.php');
    
}

function post()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $post = $postManager->getPost($_GET['idPost']);
    $comments = $commentManager->getComments($_GET['idPost']); /*undefined index*/

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
    require('View/login.php');
}
function registerSystem()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
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
        $mail->Subject = 'Bonjour '.$username.', votre compte est créé ';
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
    $comments = $commentManager->getAllCom(); /*undefined index*/
    require('View/admincell.php');
    
}
function deletePost()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $post = $postManager->getPost($_GET['idPost']);
    $comments = $commentManager->getComments($_GET['idPost']); /*undefined index*/

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
    require('View/userSettings.php');
    
}
function editUserAdmin()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $user = $userManager->getUser($_GET['id']);
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
        header("Location: index.php");
    } 
}
function welcome()
{
    require('View/welcome.php');
}
/*$_SESSION['current_user'] = getUser($username, $password);
if ($_SESSION['current_user']['is_admin']){
    // je suis admin
}

if ($_SESSION['current_user']){
    //connecte
}

$_SESSION['current_user'] = null;
unset($_SESSION['current_user']);*/
