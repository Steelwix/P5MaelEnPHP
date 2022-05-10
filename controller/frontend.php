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
    $comments = $commentManager->getComments($_GET['comment']); /*undefined index*/

    require('View/postView.php');
}


function addComment($postId, $firstName, $comment)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $firstName, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
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
