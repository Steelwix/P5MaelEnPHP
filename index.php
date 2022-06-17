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
                sendMailCreateUser($gPost['username'], $gPost['email'], $gPost['password']);
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
            editUserAdmin($gGet['id']);
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

        if ($gGet['action'] == 'admincell') {
            if (isset($gSession['isAdmin']) or $gSession['isAdmin'] == 1) {
                adminSystem();
            }
            NotFound();
        }
        if ($gGet['action'] == 'deletePost') {

            if ((isset($gGet['idPost']) or $gSession['isAdmin'] !== 1)) {

                deletePost();
            } else {
                NotFound();
            }
        }




        if ($gGet['action'] == 'wipePost') {
            if ($gSession['isAdmin'] !== 1) {
                NotFound();
            }
            wipePost($gGet['idPost']);
        }
        if ($gGet['action'] == 'deleteComment') {
            if ($gSession['isAdmin'] !== 1) {
                NotFound();
            }
            deleteComment($gGet['idComment']);
        }
        if ($gGet['action'] == 'commentIsValid') {
            if ($gSession['isAdmin'] !== 1) {
                NotFound();
            }
            commentIsValid($gGet['idComment']);
        }
        if ($gGet['action'] == 'inspectUser') {
            if ($gSession['isAdmin'] !== 1) {
                NotFound();
            }
            inspectUser($gGet['id']);
        }
        if ($gGet['action'] == 'wipeUser') {
            if ($gSession['isAdmin'] !== 1) {
                NotFound();
            }
            wipeUser($gGet['id']);
        }
        if ($gGet['action'] == 'createPost') {
            if ($gSession['isAdmin'] !== 1) {
                NotFound();
            }
            createPost();
        }
        if ($gGet['action'] == 'newPost') {
            if ($gSession['isAdmin'] !== 1) {
                NotFound();
            }
            if ($gPost['title'] == "" or $gPost['hat'] == "" or $gPost['content'] == "") {
                createPost();
            } else {
                newPost($gPost['title'], $gPost['hat'], $gPost['content'], $gSession['id']);
            }
        }
        if ($gGet['action'] == 'modifyPost') {
            if ($gSession['isAdmin'] !== 1) {
                NotFound();
            }
            modifyPost();
        }

        if ($gGet['action'] == 'postEdit') {
            if ($gSession['isAdmin'] !== 1) {
                NotFound();
            }
            if ($gPost['title'] == "" or $gPost['hat'] == "" or $gPost['content'] == "" or !isset($gSession['id']) or !isset($gGet['idPost'])) {
                modifyPost();
            } else {

                postEdit($gPost['title'], $gPost['hat'], $gPost['content'], $gSession['id'], $gGet['idPost']);
            }
        }
        if ($gGet['action'] == 'editUserAdmin') {
            if ($gSession['isAdmin'] !== 1) {
                NotFound();
            }
            editUserAdmin($gGet['id']);
        }
        if ($gGet['action'] == 'userUpdateAdmin') {

            if ($gPost['username'] == "" or $gPost['email'] == "" or $gPost['password'] == "" or $gPost['isAdmin'] == "" or ($gPost['password'] !== $gPost['confirm_password']) == true) {
                editUserAdmin($gGet['id']);
            } else {

                userUpdateAdmin($gPost['username'], $gPost['email'], $gPost['password'], $gPost['isAdmin'], $gGet['id']);
            }
        }
    } else {
        listPosts();
    }
} catch (Exception $e) {
    'Erreur : ' . $e->getMessage();
}
