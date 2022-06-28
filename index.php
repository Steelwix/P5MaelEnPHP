<?php

session_start();
require_once 'src/autoload.php';



use OpenClassrooms\Blog\Globals\Globals;
use OpenClassrooms\Blog\Session\Session;

$globals = new Globals;
$gGet = $globals->getGET();
$gPost = $globals->getPOST();
$gServer = $globals->getSERVER();
$session = new Session;
$gSession = $session->getSESSION();
try {
    if (isset($gGet['action'])) {
        if ($gGet['action'] == 'listPosts') {
            listPosts();
        }
        if ($gGet['action'] == 'login') {
            loginSystem();
        }
        if ($gGet['action'] == 'register') {
            registerSystem();
        }
        if ($gGet['action'] == 'signin') {
            if ($gPost['username'] == "" or $gPost['email'] == "" or $gPost['password'] == "" or ($gPost['password'] !== $gPost['confirm_password']) == true) {
                registerSystem();
            } else {
                createUser($gPost['username'], $gPost['email'], $gPost['password']);
            }
        }
        if ($gGet['action'] == 'logout') {
            logOutSystem();
        }

        if ($gGet['action'] == 'post') {
            if (isset($gGet['idPost'])) {
                post();
            } elseif (isset($idPost)) {
                post();
            }
        }
        if ($gGet['action'] == 'addComment') {
            if ($gPost['comment'] == "") {
                post();
            } elseif ($gSession['isAdmin'] == 1) {
                $gPost['isValid'] = 1;
            } else {
                $gPost['isValid'] = 0;
            }
            addComment($gPost['comment'], $gPost['isValid'], $gSession['id'], $gGet['idPost']);
        }

        if ($gGet['action'] == 'editUser') {
            if ($gSession['id'] == $gGet['id']) {
                editUserAdmin($gGet['id']);
            } else {
                NotFound();
            }
        }
        if ($gGet['action'] == 'userUpdate') {
            if ($gPost['username'] == "" or $gPost['email'] == "" or $gPost['password'] == "" or ($gPost['password'] !== $gPost['confirm_password']) == true) {
                editUserAdmin($gGet['id']);
            } else {

                userUpdate($gPost['username'], $gPost['email'], $gPost['password'], $gGet['id']);
            }
        }
        if ($gGet['action'] == 'overallSetting') {
            welcome();
        }
        if ($gGet['action'] == 'inspectUserSelf') {
            if ($gSession['id'] == $gGet['id']) {
                inspectUser($gGet['id']);
            } else {
                NotFound();
            }
        }
        if ($gGet['action'] == 'wipeUserSelf') {
            wipeUserSelf($gGet['id']);
        }
        if ($gGet['action'] == 'contact') {
            contactForm();
        }
        if ($gGet['action'] == 'sendMessage') {
            if (isset($gSession['email'])) {
                $gPost['email'] = $gSession['email'];
            }
            if ($gPost['message'] == "" or $gPost['email'] == "") {
                contactForm();
            } else {
                sendMailContact($gPost['email'], $gPost['message']);
            }
        }
        //ADMIN----------------------------------------------------

        if ($gGet['action'] == 'admincell') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                adminSystem();
            } else {
                NotFound();
            }
        }

        if ($gGet['action'] == 'deletePost') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                deletePost();
            } else {
                NotFound();
            }
        }
        if ($gGet['action'] == 'wipePost') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                wipePost($gGet['idPost']);
            } else {
                NotFound();
            }
        }
        if ($gGet['action'] == 'deleteComment') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                deleteComment($gGet['idComment']);
            } else {
                NotFound();
            }
        }
        if ($gGet['action'] == 'commentIsValid') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                commentIsValid($gGet['idComment']);
            } else {
                NotFound();
            }
        }
        if ($gGet['action'] == 'wipeUser') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                wipeUser($gGet['id']);
            } else {
                NotFound();
            }
        }
        if ($gGet['action'] == 'createPost') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                createPost();
            } else {
                NotFound();
            }
        }
        if ($gGet['action'] == 'newPost') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                if ($gPost['title'] == "" or $gPost['hat'] == "" or $gPost['content'] == "") {
                    createPost();
                } else {
                    newPost($gPost['title'], $gPost['hat'], $gPost['content'], $gSession['id']);
                }
            } else {
                NotFound();
            }
        }
        if ($gGet['action'] == 'modifyPost') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                modifyPost();
            } else {
                NotFound();
            }
        }

        if ($gGet['action'] == 'postEdit') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                if ($gPost['title'] == "" or $gPost['hat'] == "" or $gPost['content'] == "") {
                    modifyPost();
                } else {

                    postEdit($gPost['title'], $gPost['hat'], $gPost['content'], $gSession['id'], $gGet['idPost']);
                }
            } else {
                NotFound();
            }
        }
        if ($gGet['action'] == 'editUserAdmin') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                editUserAdmin($gGet['id']);
            } else {
                NotFound();
            }
        }
        if ($gGet['action'] == 'userUpdateAdmin') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                if ($gPost['username'] == "" or $gPost['email'] == "" or $gPost['password'] == "" or $gPost['isAdmin'] == "" or ($gPost['password'] !== $gPost['confirm_password']) == true) {
                    editUserAdmin($gGet['id']);
                } else {
                    userUpdateAdmin($gPost['username'], $gPost['email'], $gPost['password'], $gPost['isAdmin'], $gGet['id']);
                }
            } else {
                NotFound();
            }
        }
        if ($gGet['action'] == 'inspectUser') {
            if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
                inspectUser($gGet['id']);
            } else {
                NotFound();
            }
        }
    } else {
        listPosts();
    }
} catch (Exception $e) {
    'Erreur : ' . $e->getMessage();
}
