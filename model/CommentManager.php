<?php


namespace OpenClassrooms\Blog\Model;

use Manager;

class CommentManager extends Manager
{
    public function getComments($idPost)
    {
        $req = $this->dataBase->prepare('SELECT comment.idComment, comment.comment, comment.comDate, comment.isValid, comment.idPost, users.username
        FROM comment INNER JOIN users ON comment.id = users.id WHERE idPost = ? AND isValid = 1');
        $req->execute(array($idPost));
        $comments = $req;
        return $comments;
    }
    public function postComment($datetime, $comment, $isValid, $idUser, $idPost)
    {
        $newComment = $this->dataBase->prepare("INSERT INTO comment(idComment, comDate, comment, isvalid, id, idPost) 
        VALUES (NULL, :datetime, :comment, :isValid, :id, :idPost)");
        $newComment->execute(array(':datetime' => $datetime, ':comment' => $comment, ':isValid' => $isValid, ':id' => $idUser, ':idPost' => $idPost));
        return $newComment;
    }
    public function getAllCom()
    {
        $req = $this->dataBase->query('SELECT comment.idComment, comment.comment, comment.comDate, comment.idPost, comment.id, comment.isValid, users.username, post.title 
        FROM comment INNER JOIN users ON comment.id = users.id INNER JOIN post ON comment.idPost = post.idPost');
        return $req;
    }
    public function deleteComment($idComment)
    {
        $req = $this->dataBase->prepare("DELETE FROM comment WHERE idComment = ? ");
        $req->execute(array($idComment));
    }
    public function getUserComments($idUser)
    {
        $req = $this->dataBase->prepare('SELECT comment.comment, comment.comDate, comment.id, comment.isValid, post.title 
        FROM comment INNER JOIN post ON comment.idPost = post.idPost WHERE comment.id = ?');
        $req->execute(array($idUser));
        $usercom = $req;
        return $usercom;
    }
    public function commentIsValid($idComment)
    {
        $req = $this->dataBase->prepare("UPDATE comment SET isValid = 1 WHERE idComment = ? ");
        $req->execute(array($idComment));
        return $req;
    }
}
