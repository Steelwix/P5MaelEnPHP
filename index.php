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
if(isset($_GET['action']))
{
    $getAction = $_GET['action'];
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
    if (isset($getAction)) {
        if ($getAction == 'listPosts') {
            listPosts();
        }
        if ($getAction == 'login'){
            loginSystem();
        }
        if ($getAction == 'register'){
            registerSystem();}
        if($getAction == 'signin'){
            if($postUsername=="" OR $postEmail=="" OR $postPassword=="" OR ($postPassword!==$postConfirmPassword)==true OR  !isset($sessionValidRegister)){
                registerSystem();
            }
            else {
                createUser($postUsername, $postEmail, $postPassword);
                sendMailCreateUser($postUsername, $postEmail, $postPassword);
                header("location: index.php?action=login");

            }
            
        }
        if ($getAction == 'logout'){
            logOutSystem();
        }

        if ($getAction == 'post') {
            if (isset($getIdPost)) {
                post();
            }
            elseif (isset($idPost)) {
                post();
            }
        }
        if ($getAction == 'addComment') {
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
        
        if($getAction == 'editUser') {
            editUser($getId);
        }
        if($getAction == 'userUpdate'){
            if($postUsername== "" OR $postEmail== "" OR $postPassword== "")
            {
                editUser($getId);
            }
            else {

                userUpdate($postUsername, $postEmail, $postPassword, $getId);
            }}
        if($getAction == 'welcome'){
            welcome();
         }
         if($getAction == 'inspectUserSelf') {
            inspectUserSelf($getId);
        }
        if($getAction == 'wipeUserSelf') {
            wipeUserSelf($getId);
        }
        if($getAction == 'contact') {
            contactForm();
        }
        if($getAction == 'sendMessage') {
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
        if($getAction == 'admincell')
        { 
            adminSystem();
        }
        if($getAction == 'deletePost')
            {

                if (isset($getIdPost))
                {
                    
                    deletePost();      
                }             
            }

        if($getAction == 'wipePost') {
            wipePost($getIdPost);
        }
        if($getAction == 'deleteComment') {
            deleteComment($getIdComment);
        }
        if($getAction == 'commentIsValid') {
            commentIsValid($getIdComment);
        }
        if($getAction == 'inspectUser') {
            inspectUser($getId);
        }
        if($getAction == 'wipeUser') {
            wipeUser($getId);
        }
        if($getAction == 'createPost') {
            createPost();
        }
        if($getAction == 'newPost') {
            if($postTitle=="" OR $postHat=="" OR $postContent=="")
            {createPost();}
            else {
                
                newPost($postTitle, $postHat, $postContent, $sessionId);
            }
        }
        if($getAction == 'modifyPost') {
            modifyPost();
        }
        
        if($getAction == 'postEdit') {
            if($postTitle=="" OR $postHat=="" OR $postContent=="" OR !isset($sessionId) OR !isset($getIdPost))
            {
                modifyPost();
            }
            else { 

                postEdit($postTitle, $postHat, $postContent, $sessionId, $getIdPost);
            }
        }
        if($getAction == 'editUserAdmin') {
            editUserAdmin($getId);
        }
        if($getAction == 'userUpdateAdmin'){
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
