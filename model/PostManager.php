<?php

namespace OpenClassrooms\Blog\Model;
use Manager;
require_once("model/Manager.php");



class PostManager extends Manager
{
    public function getPosts()
    {   
        $req = $this->db->query('SELECT idPost, title, hat, content, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post', \PDO::FETCH_ASSOC);
        return $req;
    }

    public function getPost($idPost)
    {
        $req = $this->db->prepare('SELECT idPost, title, hat, content, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post WHERE idPost = ?');
        $req->execute(array($idPost));
        $post = $req->fetch();

        return $post;
    }
}
