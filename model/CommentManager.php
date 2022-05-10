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

    public function postComment($idPost, $comment, $username)
    {
        $comments = $this->db->query('INSERT INTO comment(idComment, comment, comDate, id, idPost) VALUES(NULL, ?, NOW, NULL, NULL)');
        $affectedLines = $comments->execute(array($idPost, $comment, $username));

        return $affectedLines;
    }
}
