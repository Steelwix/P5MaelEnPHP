<?php

//main controller 
//call superglobals substitutes for functions


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
    $session = new Session;
    $gSession = $session->getSESSION();
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
    }
    $pagetitle = htmlspecialchars('MaelEnPHP - Le blog des dev PHP juniors - Accueil');
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
    $comments = $commentManager->getComments($gGet['idPost'])->fetchAll();
    foreach ($comments as $comment) {
        $comment['comment'] = htmlspecialchars($comment['comment']);
        $comment['comDate'] = htmlspecialchars($comment['comDate']);
        $comment['username'] = htmlspecialchars($comment['username']);
    }
    $ncomment = $ncomment_err = "";
    if ($gServer["REQUEST_METHOD"] == "POST") {

        if (($gPost['comment']) == "") {
            $ncomment_err = 'Vous devez écrire un commentaire';
        }

        $gPost['comment'] = $ncomment;
    }
    $pagetitle = htmlspecialchars($post['title']);
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
    $pagetitle = htmlspecialchars('Se connecter - Mael En PHP');
    require 'View/login.php';
    requestTemplate($content, $pagetitle);
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
    $user = $userManager->getUser($gGet['id']);
    $user['username'] = htmlspecialchars($user['username']);
    $user['email'] = htmlspecialchars($user['email']);
    $user['created_at'] = htmlspecialchars($user['created_at']);

    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $userComs = $commentManager->getUserComments($gGet['id'])->fetchAll();
    foreach ($userComs as $userCom) {
        $userCom['comment'] = htmlspecialchars($userCom['comment']);
        $userCom['comDate'] = htmlspecialchars($userCom['comDate']);
        $userCom['title'] = htmlspecialchars($userCom['title']);
    }
    $pagetitle = htmlspecialchars($user['username']);
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
    if (!isset($username)) {
        $username = $user['username'];
    } else {
    }
    $email = $user['email'];
    $password = $confirm_password = $user['password'];
    if (isset($isAdmin)) {
    } else {
        $isAdmin = $user['isAdmin'];
    }
    $adaptedAction = 0;
    $validForm = 1;
    if ($gSession['isAdmin'] == 1 and (($adaptedAction !== 'userUpdateAdmin') or ($adaptedAction !== 'userUpdate'))) {
        $adaptedAction = 'editUserAdmin';
    } else {
        $adaptedAction = 'editUser';
    }
    $buttonValue = 'Vérifier';
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
                    if (($gSession['isAdmin'] == 1)) {
                        $adaptedAction = 'editUserAdmin';
                    } else {
                        $adaptedAction = 'editUser';
                    }
                    $validForm = 0;
                    $buttonValue = 'Vérifier';
                    $username_err = "Pseudo déjà utilisé";
                    $login_ok = "Veuillez corriger les erreurs";
                }
                if ($gPost['email'] === $donnees['email'] and $gGet['id'] != $donnees['id']) {

                    $email_err = "email déjà utilisé";
                    $login_ok = "Veuillez corriger les erreurs";
                    $validForm = 0;
                    $buttonValue = 'Vérifier';
                    if (($gSession['isAdmin'] == 1)) {
                        $adaptedAction = 'editUserAdmin';
                    } else {
                        $adaptedAction = 'editUser';
                    }
                }
                if ($validForm == 1) {
                    $username = $gPost['username'];
                    $email = $gPost['email'];
                    $password = $gPost['password'];
                    $buttonValue = 'Valider';
                    $validUsername = 0;
                    if (($gSession['isAdmin'] == 1)) {
                        $adaptedAction = 'userUpdateAdmin';
                        $isAdmin = $gPost['isAdmin'];
                    } else {
                        $adaptedAction = 'userUpdate';
                    }
                }
            }
        }
    }
    $pagetitle = htmlspecialchars('Paramètres d\'utilisateur');
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
