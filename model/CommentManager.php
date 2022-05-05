<?php


namespace OpenClassrooms\Blog\Model;

use Manager;

require_once("model/manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT * FROM comment ORDER BY comDate DESC');
        $comments->execute(array($postId));
        return $comments;
    }

    public function postComment($postId, $comment, $firstName)
    {
        $db = $this->dbConnect();
        $comments = $db->query('INSERT INTO comment(idUser, comment, comDate) VALUES(NULL, ?, NOW)');
        $affectedLines = $comments->execute(array($postId, $comment, $firstName));

        return $affectedLines;
    }
}
