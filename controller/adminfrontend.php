<?php

use OpenClassrooms\Blog\Globals\Globals;
use OpenClassrooms\Blog\Session\Session;
use PHPMailer\PHPMailer\Exception;

function adminSystem()
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers()->fetchAll();
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts()->fetchAll();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $comments = $commentManager->getAllCom()->fetchAll();
    foreach ($posts as $post) {
        $post['title'] = htmlspecialchars($post['title']);
        $post['hat'] = htmlspecialchars($post['hat']);
        $post['content'] = htmlspecialchars($post['content']);
        $post['creation_date_fr'] = htmlspecialchars($post['creation_date_fr']);
        $post['username'] = htmlspecialchars($post['username']);
    }
    foreach ($comments as $comment) {
        $comment['comment'] = htmlspecialchars($comment['comment']);
        $comment['comDate'] = htmlspecialchars($comment['comDate']);
        $comment['username'] = htmlspecialchars($comment['username']);
        $comment['title'] = htmlspecialchars($comment['title']);
    }
    foreach ($users as $user) {

        $user['username'] = htmlspecialchars($user['username']);
        $user['email'] = htmlspecialchars($user['email']);
        $user['created_at'] = htmlspecialchars($user['created_at']);
    }
    $pagetitle = htmlspecialchars('Administration - Mael En PHP');
    require 'View/admincell.php';
    requestTemplate($content, $pagetitle);
}
function deletePost()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $globals = new Globals;
    $gGet = $globals->getGET();
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $post = $postManager->getPost($gGet['idPost']);
    $comments = $commentManager->getComments($gGet['idPost'])->fetchAll();
    foreach ($comments as $comment) {
        $comment['comment'] = htmlspecialchars($comment['comment']);
        $comment['comDate'] = htmlspecialchars($comment['comDate']);
        $comment['username'] = htmlspecialchars($comment['username']);
    }
    $pagetitle = htmlspecialchars($post['title']);
    require 'View/deletePost.php';
    requestTemplate($content, $pagetitle);
}
function wipePost($idPost)
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $postManager->deletePost($idPost);
    $location = "Location: index.php?action=admincell";
    requestMain($location);
}
function deleteComment($idComment)
{

    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager->deleteComment($idComment);
    $location = "Location: index.php?action=admincell";
    requestMain($location);
}
function commentIsValid($idComment)
{

    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentManager->commentIsValid($idComment);
    $location = "Location: index.php?action=admincell";
    requestMain($location);
}
function wipeUser()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $globals = new Globals;
    $gGet = $globals->getGET();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $userManager->deleteUser($gGet['id']);

    $location = "Location: index.php?action=admincell";
    requestMain($location);
}
function createPost()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $globals = new Globals;
    $gServer = $globals->getSERVER();
    $title = $hat = $content = $author = $title_err = $hat_err = $content_err = "";

    if ($gServer["REQUEST_METHOD"] == "POST") {
        if (empty($gPost['title'])) {
            $title_err = 'Entrez un titre';
        } else {
            $title = $gPost['title'];
        }
        if (empty($gPost['hat'])) {
            $hat_err = 'Ecrivez un chapo';
        } else {
            $hat = $gPost['hat'];
        }
        if (empty($gPost['content'])) {
            $content_err = 'Rédigez le contenu du post';
        } else {
            $content = $gPost['content'];
        }
    }
    $pagetitle = htmlspecialchars('Créer un post');
    require 'View/createPost.php';
    requestTemplate($content, $pagetitle);
}
function newPost($title, $hat, $content, $author)
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $datetime = (new DateTime('now'))->format('Y-m-d H:i:s');
    $newPost = $postManager->newPost($datetime, $title, $hat, $content, $author);
    if ($newPost === false) {
        throw new Exception('Impossible de créer un post ! error HK43 ');
    } else {
        $location = "Location: index.php?action=listPosts";
        requestMain($location);
    }
}
function modifyPost()
{
    $globals = new Globals;
    $gGet = $globals->getGET();
    $gPost  = $globals->getPOST();
    $gServer = $globals->getSERVER();
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $post = $postManager->getPost($gGet['idPost']);
    $title_err = $hat_err = $content_err = "";
    $title = $post['title'];
    $hat = $post['hat'];
    $content = $post['content'];

    if ($gServer["REQUEST_METHOD"] == "POST") {
        if ($gPost['title'] == "") {
            $title_err = 'Le post doit avoir un titre';
        }
        $title = $gPost['title'];
        if ($gPost['hat']  == "") {
            $hat_err = 'Le post doit avoir un petit texte d\'accroche';
        }
        $hat = $gPost['hat'];
        if ($gPost['content']  == "") {
            $content_err = 'Le post doit posseder un contenu';
        }
        $content = $gPost['content'];
    }
    $pagetitle = htmlspecialchars($post['title']);
    require 'View/modifypost.php';
    requestTemplate($content, $pagetitle);
}
function postEdit($title, $hat, $content, $author, $idPost)
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $datetime = (new DateTime('now'))->format('Y-m-d H:i:s');
    $editPost = $postManager->editPost($datetime, $title, $hat, $content, $author, $idPost);
    if ($editPost === false) {
        throw new Exception('Impossible de créer un post ! error T99');
    } else {
        $location = "Location: index.php?action=admincell";
        requestMain($location);
    }
}
function userUpdateAdmin($username, $email, $password, $isAdmin, $idUser)
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $editUser = $userManager->userNewSettingsAdmin($username, $email, $password, $isAdmin, $idUser);
    if ($editUser === false) {
        throw new Exception('Impossible de modifier le profil ! error L1');
    } else {
        $location = "Location: index.php";
        requestMain($location);
    }
}
function welcome()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $pagetitle = $gSession["username"];
    require 'View/welcome.php';
    requestTemplate($content, $pagetitle);
    if (!isset($gSession['loggedin']) || $gSession['loggedin'] !== true) {
        $location = "Location: index.php";
        requestMain($location);
    }
}
function NotFound()
{
    $pagetitle = htmlspecialchars('Page inexistante');
    require 'View/error.php';
}
