<?php

session_start();
require('controller/frontend.php');
require_once 'vendor/autoload.php';
//GET
if(isset($_GET['idPost']))
{
    $getIdPost = $_GET['idPost'];
}
if(isset($_GET['id']))
{
    $getId = $_GET['id'];
}
if(isset($_GET['idComment']))
{
    $getIdComment = $_GET['idComment'];
}
//POST
if(isset($_POST['username']))
{
    $postUsername = $_POST['username'];
}
if(isset($_POST['email']))
{
    $postEmail = $_POST['email'];
}
if(isset($_POST['password']))
{
    $postPassword = $_POST['password'];
}
if(isset($_POST['title']))
{
    $postTitle = $_POST['title'];
}
if(isset($_POST['hat']))
{
    $postHat = $_POST['hat'];
}
if(isset($_POST['content']))
{
    $postContent = $_POST['content'];
}
if(isset($_POST['comment']))
{
    $postComment = $_POST['comment'];
}
if(isset($_POST['confirm_password']))
{
    $postConfirmPassword = $_POST['confirm_password'];
}
if(isset($_POST['isValid']))
{
    $postIsValid = $_POST['isValid'];
}
if(isset($_POST['message']))
{
    $postMessage = $_POST['message'];
}
if(isset($_POST['isAdmin']))
{
    $postIsAdmin = $_POST['isAdmin'];
}
//SESSION
if(isset($_SESSION['id']))
{
    $sessionId = $_SESSION['id'];
}
if(isset($_SESSION['email']))
{
    $sessionEmail = $_SESSION['email'];
}
if(isset($_SESSION['isAdmin']))
{
    $sessionIsAdmin = $_SESSION['isAdmin'];
}
if(isset($_SESSION['validRegister']))
{
    $sessionValidRegister = $_SESSION['validRegister'];
}
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
            if($postUsername=="" OR $postEmail=="" OR $postPassword=="" OR ($postPassword!==$postConfirmPassword)==true OR  !isset($sessionValidRegister)){
                registerSystem();
            }
            else {
                createUser($postUsername, $postEmail, $postPassword);
                sendMailCreateUser($postUsername, $postEmail, $postPassword);
                header("location: index.php?action=login");

            }
            
        }
        if ($_GET['action'] == 'logout'){
            logOutSystem();
        }

        if ($_GET['action'] == 'post') {
            if (isset($getIdPost)) {
                post();
            }
            elseif (isset($idPost)) {
                post();
            }
        }
        if ($_GET['action'] == 'addComment') {
                if ($postComment=="") {
                    post();
                }
                elseif($sessionIsAdmin==1) {
                    $postIsValid=1;      
                }
                else {
                    $postIsValid=0;      
                }
                addComment($postComment, $postIsValid, $sessionId, $getIdPost);
                
            }
        
        if($_GET['action'] == 'editUser') {
            editUser($getId);
        }
        if($_GET['action'] == 'userUpdate'){
            if($postUsername== "" OR $postEmail== "" OR $postPassword== "")
            {
                editUser($getId);
            }
            else {

                userUpdate($postUsername, $postEmail, $postPassword, $getId);
            }}
        if($_GET['action'] == 'welcome'){
            welcome();
         }
         if($_GET['action'] == 'inspectUserSelf') {
            inspectUserSelf($getId);
        }
        if($_GET['action'] == 'wipeUserSelf') {
            wipeUserSelf($getId);
        }
        if($_GET['action'] == 'contact') {
            contactForm();
        }
        if($_GET['action'] == 'sendMessage') {
            if(isset($sessionEmail)){
                $postEmail = $sessionEmail;
            }
            if($postMessage=="" OR $postEmail=="")
            {
                contactForm();
            }
            else {
                sendMailContact($postEmail, $postMessage);
            }
        }
         //ADMIN----------------------------------------------------
        if(isset($sessionIsAdmin) AND $sessionIsAdmin==1){
        if($_GET['action'] == 'admincell')
        { 
            adminSystem();
        }
        if($_GET['action'] == 'deletePost')
            {

                if (isset($getIdPost))
                {
                    
                    deletePost();      
                }             
            }

        if($_GET['action'] == 'wipePost') {
            wipePost($getIdPost);
        }
        if($_GET['action'] == 'deleteComment') {
            deleteComment($getIdComment);
        }
        if($_GET['action'] == 'commentIsValid') {
            commentIsValid($getIdComment);
        }
        if($_GET['action'] == 'inspectUser') {
            inspectUser($getId);
        }
        if($_GET['action'] == 'wipeUser') {
            wipeUser($getId);
        }
        if($_GET['action'] == 'createPost') {
            createPost();
        }
        if($_GET['action'] == 'newPost') {
            if($postTitle=="" OR $postHat=="" OR $postContent=="")
            {createPost();}
            else {
                
                newPost($postTitle, $postHat, $postContent, $sessionId);
            }
        }
        if($_GET['action'] == 'modifyPost') {
            modifyPost();
        }
        
        if($_GET['action'] == 'postEdit') {
            if($postTitle=="" OR $postHat=="" OR $postContent=="" OR !isset($sessionId) OR !isset($getIdPost))
            {
                modifyPost();
            }
            else { 

                postEdit($postTitle, $postHat, $postContent, $sessionId, $getIdPost);
            }
        }
        if($_GET['action'] == 'editUserAdmin') {
            editUserAdmin($getId);
        }
        if($_GET['action'] == 'userUpdateAdmin'){
            if($postUsername== "" OR $postEmail== "" OR $postPassword== "" OR $postIsAdmin== "")
            {
                editUserAdmin($getId);
            }
            else {

                userUpdateAdmin($postUsername, $postEmail, $postPassword, $postIsAdmin, $getId);
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
