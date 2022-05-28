<?php

session_start();
require('controller/frontend.php');
require_once 'vendor/autoload.php';

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        if ($_GET['action'] == 'login'){
            loginSystem();
        }
        if ($_GET['action'] == 'register'){
            registerSystem();}
        if($_GET['action'] == 'signin'){
            if($_POST['username']=="" OR $_POST['email']=="" OR $_POST['password']=="" OR ($_POST['password']!==$_POST['confirm_password'])==true){
                registerSystem();
            }
            else {
                createUser($_POST['username'], $_POST['email'], $_POST['password']);
                sendMailCreateUser($_POST['username'], $_POST['email'], $_POST['password']);
                header("location: index.php?action=login");

            }
            
        }
        if ($_GET['action'] == 'logout'){
            logOutSystem();
        }

        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['idPost'])) {
                post();

            }
            elseif (isset($idPost)) {
                post();
            }
        }
        if ($_GET['action'] == 'addComment') {
            if (isset($_POST['comment']) && $_SESSION['username']) {
                if (empty($_POST['comment'])) {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
                elseif($_SESSION['isAdmin']==1) {
                    $_POST['isValid']=1;
                    addComment($_POST['comment'], $_POST['isValid'], $_SESSION['id'], $_GET['idPost']);
                }
                else {
                    $_POST['isValid']=0;
                    addComment($_POST['comment'], $_POST['isValid'], $_SESSION['id'], $_GET['idPost']);
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé BE26D');
            }
        }
        if($_GET['action'] == 'editUser') {
            editUser($_GET['id']);
        }
        if($_GET['action'] == 'userUpdate'){
            if($_POST['username']== "" OR $_POST['email']== "" OR $_POST['password']== "")
            {
                editUser($_GET['id']);
            }
            else {

                userUpdate($_POST['username'], $_POST['email'], $_POST['password'], $_GET['id']);
            }}
        if($_GET['action'] == 'welcome'){
            welcome();
         }
         if($_GET['action'] == 'inspectUserSelf') {
            inspectUserSelf($_GET['id']);
        }
        if($_GET['action'] == 'wipeUserSelf') {
            wipeUserSelf($_GET['id']);
        }
        if($_GET['action'] == 'contact') {
            contactForm();
        }
        if($_GET['action'] == 'sendMessage') {
            if(isset($_SESSION['email'])){
                $_POST['email'] = $_SESSION['email'];
            }
            if($_POST['message']=="" OR $_POST['email']=="")
            {
                contactForm();
            }
            else {
                sendMailContact($_POST['email'], $_POST['message']);
            }
        }
         //ADMIN----------------------------------------------------
        if(isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']==1){
        if($_GET['action'] == 'admincell')
        { 
            adminSystem();
        }
        if($_GET['action'] == 'deletePost')
            {
                if (isset($_GET['idPost']))
                {
                    deletePost();      
                }             
            }

        if($_GET['action'] == 'wipePost') {
            wipePost($_GET['idPost']);
        }
        if($_GET['action'] == 'deleteComment') {
            deleteComment($_GET['idComment']);
        }
        if($_GET['action'] == 'commentIsValid') {
            commentIsValid($_GET['idComment']);
        }
        if($_GET['action'] == 'inspectUser') {
            inspectUser($_GET['id']);
        }
        if($_GET['action'] == 'wipeUser') {
            wipeUser($_GET['id']);
        }
        if($_GET['action'] == 'createPost') {
            createPost();
        }
        if($_GET['action'] == 'newPost') {
            if($_POST['title']=="" OR $_POST['hat']=="" OR $_POST['content']=="")
            {createPost();}
            else {
                
                newPost($_POST['title'], $_POST['hat'], $_POST['content'], $_SESSION['id']);
            }
        }
        if($_GET['action'] == 'modifyPost') {
            modifyPost();
        }
        
        if($_GET['action'] == 'postEdit') {
            if($_POST['title']=="" OR $_POST['hat']=="" OR $_POST['content']=="" OR !isset($_SESSION['id']) OR !isset($_GET['idPost']))
            {
                modifyPost();
            }
            else { 

                postEdit($_POST['title'], $_POST['hat'], $_POST['content'], $_SESSION['id'], $_GET['idPost']);
            }
        }
        if($_GET['action'] == 'editUserAdmin') {
            editUserAdmin($_GET['id']);
        }
        if($_GET['action'] == 'userUpdateAdmin'){
            if($_POST['username']== "" OR $_POST['email']== "" OR $_POST['password']== "" OR $_POST['isAdmin']== "")
            {
                editUserAdmin($_GET['id']);
            }
            else {

                userUpdateAdmin($_POST['username'], $_POST['email'], $_POST['password'], $_POST['isAdmin'], $_GET['id']);
            }
        }

        
    }
    else {

    }

}else {
    listPosts();
}}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
