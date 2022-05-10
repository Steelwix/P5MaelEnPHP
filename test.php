<?php
namespace OpenClassrooms\Blog\Model;
require('model/PostManager.php');
require('model/CommentManager.php');
$manager = new PostManager;
$commenter = new CommentManager;
$idPost=2;
print_r($manager->getPosts());
print_r($commenter->getComments($idPost));