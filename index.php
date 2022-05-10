<?php
session_start();
require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        // localhost/?page=connect
        /*if ($_GET['page'] == 'connect') {
            connect();
        }*/
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['idPost']) && $_GET['idPost'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé error AD5');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['idComment']) && $_GET['idComment'] > 0) {
                if (!empty($_POST['firstName']) && !empty($_POST['comment'])) {
                    addComment($_GET['idComment'], $_POST['firstName'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé BE26D');
            }
        }
    }
    else {
        listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
