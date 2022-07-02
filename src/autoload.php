<?php

//Composer
require_once 'vendor/autoload.php';
//Controllers
require 'controller/frontend.php';
require_once 'controller/adminfrontend.php';
require_once 'controller/mailcontroller.php';
//Models
require_once "model/Manager.php";
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
require_once 'model/UserManager.php';
//Mailing system
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
//Searching for superglobals substitutes
spl_autoload_register(function ($className) {
    $className = str_replace("\\", "/", $className);

    require_once 'src/Globals/Globals.php';
    require_once 'src/Globals/Session.php';
});
