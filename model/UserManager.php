<?php

namespace OpenClassrooms\Blog\Model;
use Manager;
require_once("model/Manager.php");



class UserManager extends Manager
{
    public function getUsers()
    {
        $req = $this->db->query('SELECT * FROM users');
        return $req;
        if ($req === false) {
            var_dump($this->db->errorInfo());
            die('Erreur SQL User');
        }
    }

    public function getUser($userID)
    {
        $req = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute(array($userID));
        $user = $req->fetch();

        return $user;
    }
}
