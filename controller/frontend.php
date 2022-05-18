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
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    require('View/register.php');

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
function deleteComment($idComment)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager->deleteComment($idComment);
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
function wipeUser()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $userManager->deleteUser($_GET['id']);

    header("Location: index.php?action=admincell");
}
function createPost()
{
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
/*$_SESSION['current_user'] = getUser($username, $password);
if ($_SESSION['current_user']['is_admin']){
    // je suis admin
}

if ($_SESSION['current_user']){
    //connecte
}

$_SESSION['current_user'] = null;
unset($_SESSION['current_user']);*/
