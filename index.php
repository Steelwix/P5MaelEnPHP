<?php

session_start();
require 'controller/frontend.php';
require_once 'vendor/autoload.php';
require_once 'src/Globals/Globals.php';
require_once 'src/Globals/Session.php';

use OpenClassrooms\Blog\Globals\Globals;
use OpenClassrooms\Blog\Session\Session;

$globals = new Globals;
$gGet = $globals->getGET();
$gPost = $globals->getPOST();
$gServer = $globals->getSERVER();
$globals = new Session;
$gSession = $globals->getSESSION();

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
            if ($gPost['username'] == "" or $gPost['email'] == "" or $gpost['password'] == "" or ($gpost['password'] !== $gpost['confirmPassword']) == true) {
                registerSystem();
            } else {
                createUser($gPost['username'], $gPost['email'], $gpost['password']);
                sendMailCreateUser($gPost['username'], $gPost['email'], $gpost['password']);
                header("location: index.php?action=login");
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
            editUser($gGet['id']);
        }
        if ($gGet['action'] == 'userUpdate') {
            if ($gPost['username'] == "" or $gPost['email'] == "" or $gpost['password'] == "") {
                editUser($gGet['id']);
            } else {

                userUpdate($gPost['username'], $gPost['email'], $gpost['password'], $gGet['id']);
            }
        }
        if ($gGet['action'] == 'welcome') {
            welcome();
        }
        if ($gGet['action'] == 'inspectUserSelf') {
            inspectUserSelf($gGet['id']);
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
        if (isset($gSession['isAdmin']) and $gSession['isAdmin'] == 1) {
            if ($gGet['action'] == 'admincell') {
                adminSystem();
            }
            if ($gGet['action'] == 'deletePost') {

                if (isset($gGet['idPost'])) {

                    deletePost();
                }
            }

            if ($gGet['action'] == 'wipePost') {
                wipePost($gGet['idPost']);
            }
            if ($gGet['action'] == 'deleteComment') {
                deleteComment($gGet['idComment']);
            }
            if ($gGet['action'] == 'commentIsValid') {
                commentIsValid($gGet['idComment']);
            }
            if ($gGet['action'] == 'inspectUser') {
                inspectUser($gGet['id']);
            }
            if ($gGet['action'] == 'wipeUser') {
                wipeUser($gGet['id']);
            }
            if ($gGet['action'] == 'createPost') {
                createPost();
            }
            if ($gGet['action'] == 'newPost') {
                if ($gPost['title'] == "" or $gPost['hat'] == "" or $gPost['content'] == "") {
                    createPost();
                } else {

                    newPost($gPost['title'], $gPost['hat'], $gPost['content'], $gSession['id']);
                }
            }
            if ($gGet['action'] == 'modifyPost') {
                modifyPost();
            }

            if ($gGet['action'] == 'postEdit') {
                if ($gPost['title'] == "" or $gPost['hat'] == "" or $gPost['content'] == "" or !isset($gSession['id']) or !isset($gGet['idPost'])) {
                    modifyPost();
                } else {

                    postEdit($gPost['title'], $gPost['hat'], $gPost['content'], $gSession['id'], $gGet['idPost']);
                }
            }
            if ($gGet['action'] == 'editUserAdmin') {
                editUserAdmin($gGet['id']);
            }
            if ($gGet['action'] == 'userUpdateAdmin') {
                if ($gPost['username'] == "" or $gPost['email'] == "" or $gpost['password'] == "" or $gPost['isAdmin'] == "") {
                    editUserAdmin($gGet['id']);
                } else {

                    userUpdateAdmin($gPost['username'], $gPost['email'], $gpost['password'], $gPost['isAdmin'], $gGet['id']);
                }
            }
        } else {
            NotFound();
        }
    } else {
        listPosts();
    }
} catch (Exception $e) {
    'Erreur : ' . $e->getMessage();
}
