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

    }

    public function getUser($username)
    {

        $req = $this->db->prepare("SELECT username FROM users WHERE username ='$username' ");
        $user = $req->fetch();
        return $user;
    }
    public function createUser($username, $email, $password)
    {

        $newUser = $this->db->query("INSERT INTO users(id, created_at, isAdmin, username, email, password) VALUES(NULL, NULL, 0, '".$username."', '".$email."', '".$password."')");
        return $newUser;
    }
}
