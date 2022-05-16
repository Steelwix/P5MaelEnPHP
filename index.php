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
                throw new Exception('Tous les champs ne sont pas remplis !');
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
}else {
    listPosts();
}}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
