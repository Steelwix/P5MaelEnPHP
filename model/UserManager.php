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
    public function createUser()
    {
        $req = $this->db->query("INSERT INTO users (username, password)
        VALUES ('".$_POST["username"]."','".$_POST["password"]."')");
    }
}
