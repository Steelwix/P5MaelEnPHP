<?php
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
require_once 'model/UserManager.php';
require_once 'vendor/autoload.php';
require_once 'src/Globals/Globals.php';
require_once 'src/Globals/Session.php';
require_once 'controller/adminfrontend.php';
require_once 'controller/mailcontroller.php';

use OpenClassrooms\Blog\Globals\Globals;
use OpenClassrooms\Blog\Session\Session;
use OpenClassrooms\Blog\Session\MakeSession;

function requestMain($location)
{
    header($location);
}

function requestTemplate($content, $pagetitle)
{
    require 'View/template.php';
}

function navbar()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    require 'View/navbar.php';
}

function footer()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    require 'View/footer.php';
}

function listPosts()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts()->fetchAll();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    foreach ($posts as $post) {
        $post['title'] = htmlspecialchars($post['title']);
        $post['hat'] = htmlspecialchars($post['hat']);
        $post['content'] = htmlspecialchars($post['content']);
        $post['creation_date_fr'] = htmlspecialchars($post['creation_date_fr']);
        $post['username'] = htmlspecialchars($post['username']);
        $post['idPost'] = htmlspecialchars($post['idPost']);
    }

    require 'View/ListPostView.php';
    requestTemplate($content, $pagetitle);
}

function post()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $globals = new Globals;
    $gGet = $globals->getGET();
    $gPost = $globals->getPOST();
    $gServer = $globals->getSERVER();
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $post = $postManager->getPost($gGet['idPost']);
    $comments = $commentManager->getComments($gGet['idPost']);
    $ncomment = $ncomment_err = "";
    if ($gServer["REQUEST_METHOD"] == "POST") {

        if (($gPost['comment']) == "") {
            $ncomment_err = 'Vous devez écrire un commentaire';
        }

        $gPost['comment'] = $ncomment;
    }
    require 'View/postView.php';
    requestTemplate($content, $pagetitle);
}


function addComment($comment, $isValid, $idUser, $idPost)
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $datetime = (new DateTime('now'))->format('Y-m-d H:i:s');
    $newComment = $commentManager->postComment($datetime, $comment, $isValid, $idUser, $idPost);
    if ($newComment === false) {
        throw new Exception('Impossible d\'ajouter le commentaire ! error HK3 ');
    }
    $location = "Location: index.php?action=post&idPost=" . $idPost;
    requestMain($location);
}
function loginSystem()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $makeSessionManager = new MakeSession;
    $globals = new Globals;
    $gServer = $globals->getSERVER();
    $gPost = $globals->getPOST();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    if (isset($gSession['loggedin']) && $gSession['loggedin'] === true) {
        $location = "Location: index.php";
        requestMain($location);
    }
    $username = $password = "";
    $username_err = $password_err = $login_err = "";
    if ($gServer["REQUEST_METHOD"] == "POST") {
        if (empty(trim($gPost['username']))) {
            $username_err = "Vous devez entrer votre pseudo.";
        }
        $username = trim($gPost['username']);
        if (empty(trim($gPost['password']))) {
            $password_err = "Vous devez entrer votre mot de passe.";
        }
        $password = trim($gPost['password']);

        while ($donnees = $users->fetch()) {
            if ($username == $donnees['username'] and $password == $donnees['password']) {
                $theSession['username'] = $donnees['username'];
                $theSession['id'] = $donnees['id'];
                $theSession['loggedin'] = true;
                $theSession['isAdmin'] = $donnees['isAdmin'];
                $TheSession['email'] = $donnees['email'];
                $makeSessionManager->setSession($theSession['username'], $theSession['id'], $theSession['loggedin'], $theSession['isAdmin'], $TheSession['email']);
                $location = "Location: index.php";
                requestMain($location);
            }
            $login_err = "Les informations ne correspondent pas.";
        }
    }
    require 'View/login.php';
    requestTemplate($content, $pagetitle);
}
function registerSystem()
{
    $globals = new Globals;
    $gServer = $globals->getSERVER();
    $gPost = $globals->getPOST();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    $username = $password = $email = $confirm_password = $username_err = $password_err = $login_err = $email_err = $confirm_password_err = "";
    if ($gServer["REQUEST_METHOD"] == "POST") {
        if (empty(trim($gPost['username'])) or empty(trim($gPost['username']))) {
            $username_err = "Indiquez un pseudo";
            $login_err = "Veuillez corriger les erreurs";
        }
        if (filter_var($gPost['email'], FILTER_VALIDATE_EMAIL)) {
        } else {
            $email_err = "Respectez le format des emails";
            $login_err = "Veuillez corriger les erreurs";
        }
        if ($gPost['password'] == "") {
            $password_err = "Veuillez définir un mot de passe";
        }
        if (($gPost['password'] !== $gPost['confirm_password']) == true) {
            $password_err = "Mots de passe non identiques.";
            $login_err = "Veuillez corriger les erreurs";
        } elseif (isset($gPost['username']) &&  isset($gPost['email']) && isset($gPost['password'])) {
            while ($donnees = $users->fetch()) {
                if ($gPost['username'] === $donnees['username']) {

                    $username_err = "Pseudo déjà utilisé";
                }
                if ($gPost['email'] === $donnees['email']) {

                    $email_err = "email déjà utilisé";
                }
                $gPost['username'] = $username;
                $gPost['email'] = $email;
                $gPost['password'] = $password;
            }
        }
    }
    require 'View/register.php';
    requestTemplate($content, $pagetitle);
}
function createUser($username, $email, $password)
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $datetime = (new DateTime('now'))->format('Y-m-d H:i:s');
    $newUser = $userManager->createUser($username, $email, $password, $datetime);
    if ($newUser === false) {
        throw new Exception('Impossible d\'ajouter l\'utilisateur ! error Z1 ');
    } else {
        $location = "Location: index.php?action=login";
        requestMain($location);
    }
}

function logOutSystem()
{

    session_destroy();
    $location = "Location: index.php";
    requestMain($location);
}


function inspectUser()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $globals = new Globals;
    $gGet = $globals->getGET();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $users = $userManager->getUser($gGet['id']);
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $userComs = $commentManager->getUserComments($gGet['id']);

    require 'View/deleteUser.php';
    requestTemplate($content, $pagetitle);
}

function wipeUserSelf()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $globals = new Globals;
    $gGet = $globals->getGET();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $userManager->deleteUser($gGet['id']);
    $location = "Location: index.php?action=logout";
    requestMain($location);
}

function contactForm()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $globals = new Globals;
    $gServer = $globals->getSERVER();
    $email = $message = $email_err = $message_err = "";

    if (isset($gSession['email'])) {
        $gPost['email'] = $gSession['email'];
    }
    if ($gServer["REQUEST_METHOD"] == "POST") {

        if (empty(trim($gPost['email']))) {
            $email_err = 'Vous devez indiquer votre email';
        } else {
            $email = $gPost['email'];
        }


        if (empty($gPost['message'])) {
            $message_err = "Vous devez entrer un message.";
        } else {
            $message = $gPost['message'];
        }
    }
    require 'View/contact.php';
    requestTemplate($content, $pagetitle);
}


function editUserAdmin()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $globals = new Globals;
    $gPost = $globals->getPOST();
    $gGet = $globals->getGET();
    $gServer = $globals->getSERVER();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $user = $userManager->getUser($gGet['id']);
    $users = $userManager->getUsers();
    $username_err = $password_err = $login_err = $email_err = $confirm_password_err = "";
    $username = $user['username'];
    $email = $user['email'];
    $password = $confirm_password = $user['password'];
    $isAdmin = $user['isAdmin'];
    $adaptedAction = "editUserAdmin";
    if ($gServer["REQUEST_METHOD"] == "POST") {
        if (empty(trim($gPost['username'])) or empty(trim($gPost['username']))) {
            $username_err = "Indiquez un pseudo";
            $login_ok = "Veuillez corriger les erreurs";
        }
        if (filter_var($gPost['email'], FILTER_VALIDATE_EMAIL)) {
        } else {
            $email_err = "Respectez le format des emails";
            $login_ok = "Veuillez corriger les erreurs";
        }
        if ($gPost['password'] == "") {
            $password_err = "Veuillez définir un mot de passe";
            $login_ok = "Veuillez corriger les erreurs";
        }
        if (($gPost['password'] !== $gPost['confirm_password']) == true) {
            $password_err = "Mots de passe non identiques.";
            $login_ok = "Veuillez corriger les erreurs";
        }
        if (isset($gPost['username']) &&  isset($gPost['email']) && isset($gPost['password'])) {
            while ($donnees = $users->fetch()) {
                if ($gPost['username'] === $donnees['username'] and $gGet['id'] != $donnees['id']) {

                    $username_err = "Pseudo déjà utilisé";
                    $login_ok = "Veuillez corriger les erreurs";
                } elseif ($gPost['email'] === $donnees['email'] and $gGet['id'] != $donnees['id']) {

                    $email_err = "email déjà utilisé";
                    $login_ok = "Veuillez corriger les erreurs";
                } elseif ($gSession['isAdmin'] == 1) {
                    $gPost['username'] = $username;
                    $gPost['email'] = $email;
                    $gPost['password'] = $password;
                    $adaptedAction = "userUpdateAdmin";
                } else {
                    $gPost['username'] = $username;
                    $gPost['email'] = $email;
                    $gPost['password'] = $password;
                    $adaptedAction = "userUpdate";
                }
            }
        }
    }

    require 'View/userSettings.php';
    requestTemplate($content, $pagetitle);
}
function userUpdate($username, $email, $password, $idUser)
{
    $session = new Session;
    $gSession = $session->getSESSION();
    $globals = new Globals;
    $gPost = $globals->getPOST();
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $editUser = $userManager->userNewSettings($username, $email, $password, $idUser);
    if ($editUser === false) {
        throw new Exception('Impossible de modifier le profil ! error L1');
    } else {
        $gSession['username'] = $gPost['username'];
        $gSession['email'] = $gPost['email'];
        $location = "Location: index.php";
        requestMain($location);
    }
}

function welcome()
{
    $session = new Session;
    $gSession = $session->getSESSION();
    require 'View/welcome.php';
    requestTemplate($content, $pagetitle);
    if (!isset($gSession['loggedin']) || $gSession['loggedin'] !== true) {
        $location = "Location: index.php";
        requestMain($location);
    }
}
function NotFound()
{
    require 'View/error.php';
}
