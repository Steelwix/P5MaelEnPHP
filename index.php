<?php 
session_start();
require('controller/frontend.php');

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
            elseif($_GET['action'] == 'signin'){
            if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
               createUser($_POST['username'], $_POST['email'], $_POST['password']); 
            }
            else {
                throw new Exception('Tous les champs ne sont pas complets !');
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
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_POST['comment']) && $_SESSION['username']) {
                if (!empty($_POST['comment'])) {
                    addComment($_POST['comment'], $_SESSION['id'], $_GET['idPost']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé BE26D');
            }
        }
        if($_GET['action'] == 'admincell')
        { 
            if($_SESSION['isAdmin']==1)
            {
                adminSystem();
            }
            else {
                throw new Exception('Accès non autorisé');
            }
            
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
        if($_GET['action'] == 'inspectUser') {
            inspectUser($_GET['id']);
        }
        if($_GET['action'] == 'inspectUserSelf') {
            inspectUserSelf($_GET['id']);
        }
        if($_GET['action'] == 'wipeUser') {
            wipeUser($_GET['id']);
        }
        if($_GET['action'] == 'wipeUserSelf') {
            wipeUserSelf($_GET['id']);
        }
        if($_GET['action'] == 'createPost') {
            createPost();
        }
        if($_GET['action'] == 'newPost') {
            if(isset($_POST['title']) && isset($_POST['hat']) && isset($_POST['content']) && isset($_SESSION['id']))
            {newPost($_POST['title'], $_POST['hat'], $_POST['content'], $_SESSION['id']);}
            else {
                throw new Exception("Error newPost Index, values not set");
            }
        }
        if($_GET['action'] == 'modifyPost') {
            modifyPost();
        }
        if($_GET['action'] == 'postEdit') {
            if(isset($_POST['title']) && isset($_POST['hat']) && isset($_POST['content']) && isset($_GET['idPost']))
            {
                postEdit($_POST['title'], $_POST['hat'], $_POST['content'], $_SESSION['id'], $_GET['idPost']);
            }
            else { 
                throw new Exception('Aucun identifiant de billet envoyé XAX');
            }
        }
        if($_GET['action'] == 'contact') {
            contactForm();
        }
        if($_GET['action'] == 'sendMessage') {
            if(!empty($_POST['message']) && (!empty($_POST['email'])))
            {
                sendMessage($_POST['message'], $_POST['email']);

            }
            else {
                throw new Exception('Aucun message envoyé ZY7Z2');
            }
        }
        if($_GET['action'] == 'editUser') {
            editUser($_GET['id']);
        }
        if($_GET['action'] == 'editUserAdmin') {
            editUserAdmin($_GET['id']);
        }
        if($_GET['action'] == 'userUpdate'){
            userUpdate($_POST['username'], $_POST['email'], $_POST['password'], $_GET['id']);
        }
        if($_GET['action'] == 'userUpdateAdmin'){
            userUpdateAdmin($_POST['username'], $_POST['email'], $_POST['password'], $_POST['isAdmin'], $_GET['id']);
        }
        if($_GET['action'] == 'welcome'){
           welcome();
        }
}else {
    listPosts();
}}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
