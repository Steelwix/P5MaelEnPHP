<?php


namespace OpenClassrooms\Blog\Model;

use Manager;

require_once("model/manager.php");

class CommentManager extends Manager
{
    public function getComments($idPost)
    {
        $req = $this->db->prepare('SELECT comment.idComment, comment.comment, comment.comDate, comment.isValid, comment.idPost, users.username FROM comment INNER JOIN users ON comment.id = users.id WHERE idPost = ? AND isValid = 1');
        $req->execute(array($idPost));
        $comments = $req;
        return $comments;
    }
    public function postComment($datetime, $comment, $isValid, $id, $idPost)
    {
        $newComment = $this->db->prepare("INSERT INTO comment(idComment, comDate, comment, isvalid, id, idPost) VALUES (NULL, '".$datetime."', '".addslashes($comment)."', '".$isValid."', '".$id."', '".$idPost."')");
        $newComment -> execute();
        return $newComment;
    }
    public function getAllCom()
    {
        $req = $this->db->query('SELECT comment.idComment, comment.comment, comment.comDate, comment.idPost, comment.id, comment.isValid, users.username, post.title FROM comment INNER JOIN users ON comment.id = users.id INNER JOIN post ON comment.idPost = post.idPost');
            return $req;
    }
    public function deleteComment($idComment)
    {
        $req = $this->db->prepare("DELETE FROM comment WHERE idComment = ? ");
        $req->execute(array($idComment));
    }
    public function getUserComments($id)
    {
        $req = $this->db->prepare('SELECT comment.comment, comment.comDate, comment.id, comment.isValid, post.title FROM comment INNER JOIN post ON comment.idPost = post.idPost WHERE comment.id = ?');
        $req->execute(array($id));
        $usercom = $req;
        return $usercom;
    }
    public function commentIsValid($idComment)
    {
        $req = $this->db->prepare("UPDATE comment SET isValid = 1 WHERE idComment = ? ");
        $req->execute(array($idComment));
        return $req;
    }
}   
