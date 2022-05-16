<?php


namespace OpenClassrooms\Blog\Model;

use Manager;

require_once("model/manager.php");

class CommentManager extends Manager
{
    public function getComments($idPost)
    {
        $req = $this->db->prepare('SELECT comment.idComment, comment.comment, comment.comDate, comment.idPost, users.username FROM comment INNER JOIN users ON comment.id = users.id WHERE idPost = ?');
        $req->execute(array($idPost));
        $comments = $req;
        return $comments;
    }

    public function postComment($datetime, $comment, $id, $idPost)
    {
        $newComment = $this->db->query("INSERT INTO comment(idComment, comDate, comment, id, idPost) VALUES (NULL, '".$datetime."', '".$comment."', '".$id."', '".$idPost."')");

        return $newComment;
    }
    public function getAllCom()
    {
        $req = $this->db->query('SELECT comment.idComment, comment.comment, comment.comDate, comment.idPost, comment.id, users.username, post.title FROM comment INNER JOIN users ON comment.id = users.id INNER JOIN post ON comment.idPost = post.idPost');
            return $req;
    }
    public function deleteComment($idComment)
    {
        $req = $this->db->prepare("DELETE FROM comment WHERE idComment = ? ");
        $req->execute(array($idComment));
    }
}   
