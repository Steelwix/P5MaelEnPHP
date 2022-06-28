<?php

namespace OpenClassrooms\Blog\Model;

use Manager;



class UserManager extends Manager
{
    public function getUsers()
    {
        $req = $this->dataBase->query('SELECT * FROM users');
        return $req;
    }

    public function getUser($idUser)
    {

        $req = $this->dataBase->prepare("SELECT * FROM users WHERE id = ? ");
        $req->execute(array($idUser));
        $user = $req->fetch();
        return $user;
    }
    public function createUser($username, $email, $password, $datetime)
    {

        $newUser = $this->dataBase->prepare("INSERT INTO users(id,isAdmin, created_at, username, email, password) 
        VALUES(NULL, 0, :datetime,  :username, :email, :password)");
        $newUser->execute(array(':datetime' => $datetime, ':username' => $username, ':email' => $email, ':password' => $password));
        return $newUser;
    }
    public function deleteUser($idUser)
    {
        $req = $this->dataBase->prepare("DELETE FROM users WHERE id = ? ");
        $req->execute(array($idUser));
    }
    public function userNewSettings($username, $email, $password, $idUser)
    {
        $req = $this->dataBase->prepare("UPDATE users SET  username = :username, email = :email, password = :password WHERE id = :id ");
        $req->execute(array(':username' => $username, ':email' => $email, ':password' => $password, ':id' => $idUser));
        return $req;
    }
    public function userNewSettingsAdmin($username, $email, $password, $isAdmin, $idUser)
    {
        $req = $this->dataBase->prepare("UPDATE users SET  username = :username, email = :email, password = :password, isAdmin = :isAdmin WHERE id = :id ");
        $req->execute(array(':username' => $username, ':email' => $email, ':password' => $password, ':isAdmin' => $isAdmin, ':id' => $idUser));
        return $req;
    }
}
