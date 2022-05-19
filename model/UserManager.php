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

    public function getUser($id)
    {

        $req = $this->db->prepare("SELECT * FROM users WHERE id = ? ");
        $req->execute(array($id));
        $user = $req->fetch();
        return $user;
    }
    public function createUser($username, $email, $password, $datetime)
    {

        $newUser = $this->db->query("INSERT INTO users(id, created_at, isAdmin, username, email, password) VALUES(NULL, '".$datetime."', 0, '".$username."', '".$email."', '".$password."')");
        return $newUser;
    }
    public function deleteUser($id)
    {
        $req = $this->db->prepare("DELETE FROM users WHERE id = ? ");
        $req->execute(array($id)); 
    }
    public function userNewSettings($username, $email, $password, $id)
    {
        $req = $this->db->prepare("UPDATE users SET  username = '$username', email = '$email', password = '$password' WHERE id = '$id' ");
        $req->execute(array($id));
        return $req;
    }
    public function userNewSettingsAdmin($username, $email, $password, $isAdmin, $id)
    {
        $req = $this->db->prepare("UPDATE users SET  username = '$username', email = '$email', password = '$password', isAdmin = '$isAdmin' WHERE id = '$id' ");
        $req->execute(array($id));
        return $req;
    }
}
