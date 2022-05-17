<?php

namespace OpenClassrooms\Blog\Model;
use Manager;

require_once("model/Manager.php");



class PostManager extends Manager
{
    public function getPosts()
    {   
        $req = $this->db->query('SELECT post.idPost, post.title, post.hat, post.content, post.id, users.username, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post INNER JOIN users ON post.id = users.id');
            return $req;
    }

    public function getPost($idPost)
    {
        $req = $this->db->prepare('SELECT idPost, title, hat, content,id, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post WHERE idPost = ?');
        $req->execute(array($idPost));
        $post = $req->fetch();
        return $post;
    }
    public function deletePost($idPost)
    {
        $req = $this->db->prepare("DELETE FROM post WHERE idPost = ? ");
        $req->execute(array($idPost));
    }
}   
