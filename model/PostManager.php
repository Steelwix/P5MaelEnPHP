<?php

namespace OpenClassrooms\Blog\Model;
use Manager;

require_once("model/Manager.php");



class PostManager extends Manager
{
    public function getPosts()
    {   
        $req = $this->db->query('SELECT post.idPost, post.title, post.hat, post.content, post.id, users.username, DATE_FORMAT(updateDate, \'%d/%m/%Y \') AS creation_date_fr FROM post INNER JOIN users ON post.id = users.id');
            return $req;
    }

    public function getPost($idPost)
    {
        $req = $this->db->prepare('SELECT post.idPost, post.title, post.hat, post.content, post.id, users.username, DATE_FORMAT(updateDate, \'%d/%m/%Y \') AS creation_date_fr FROM post INNER JOIN users ON post.id = users.id WHERE idPost = ?');
        $req->execute(array($idPost));
        $post = $req->fetch();
        return $post;
    }
    public function deletePost($idPost)
    {
        $req = $this->db->prepare("DELETE FROM post WHERE idPost = ? ");
        $req->execute(array($idPost));
    }
    public function newPost($datetime, $title, $hat, $content, $author){
        $nPost = $this->db->query("INSERT INTO post(idPost, updateDate, title, hat, content, id) VALUES(NULL, '".$datetime."', '".addslashes($title)."', '".addslashes($hat)."', '".addslashes($content)."', '".$author."')");
        return $nPost;
    }
    public function editPost($datetime, $title, $hat, $content, $author, $idPost)
    {
        $req = $this->db->prepare("UPDATE post SET  title = '$title', hat = '$hat', content = '$content', updateDate = '$datetime', id = '$author' WHERE idPost = ? ");
        $req->execute(array($idPost));
        return $req;
    }
}   
