<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT idPost, title, hat, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post ORDER BY updateDate DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT idPost, title, hat, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post WHERE idPost = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
}
