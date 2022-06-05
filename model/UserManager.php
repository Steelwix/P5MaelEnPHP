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

    public function getUser($idUser)
    {

        $req = $this->db->prepare("SELECT * FROM users WHERE id = ? ");
        $req->execute(array($idUser));
        $user = $req->fetch();
        return $user;
    }
    public function createUser($username, $email, $password, $datetime)
    {

        $newUser = $this->db->query("INSERT INTO users(id, created_at, isAdmin, username, email, password) VALUES(NULL, '".$datetime."', 0, '".addslashes($username)."', '".$email."', '".addslashes($password)."')");
        return $newUser;
    }
    public function deleteUser($idUser)
    {
        $req = $this->db->prepare("DELETE FROM users WHERE id = ? ");
        $req->execute(array($idUser)); 
    }
    public function userNewSettings($username, $email, $password, $idUser)
    {
        $req = $this->db->prepare("UPDATE users SET  username = :username, email = :email, password = :password WHERE id = :id ");
        $req->execute(array(':username' => $username, ':email' => $email, ':password' => $password, ':id' => $idUser));
        return $req;
    }
    public function userNewSettingsAdmin($username, $email, $password, $isAdmin, $idUser)
    {
        $req = $this->db->prepare("UPDATE users SET  username = :username, email = :email, password = :password, isAdmin = :isAdmin WHERE id = :id ");
        $req->execute(array(':username' => $username, ':email' => $email, ':password' => $password, ':isAdmin' => $isAdmin, ':id' => $idUser));
        return $req;
    }
}
