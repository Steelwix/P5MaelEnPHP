<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');


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


function addComment($comment, $id, $idPost)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $datetime = (new DateTime('now'))->format('Y-m-d H:i:s');
    $newComment = $commentManager->postComment($datetime, $comment, $id, $idPost);

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
    require('View/register.php');
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
}
function createUser($username, $email, $password)
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $newUser = $userManager->createUser($username, $email, $password);
    if($newUser === false) {
        throw new Exception('Impossible d\'ajouter l\'utilisateur ! error Z1 ');
    }
    else {
        echo "Votre compte est enregistré";
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
/*$_SESSION['current_user'] = getUser($username, $password);
if ($_SESSION['current_user']['is_admin']){
    // je suis admin
}

if ($_SESSION['current_user']){
    //connecte
}

$_SESSION['current_user'] = null;
unset($_SESSION['current_user']);*/
