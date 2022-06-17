<?php


namespace OpenClassrooms\Blog\Session;

class Session
{
    private $vars;


    public function __construct()
    {
        $this->vars = $_SESSION;
    }
    public function getSESSION($key = null)
    {
        if (null !== $key) {
            return $this->vars[$key] ?? null;
        }
        return $this->vars;
    }
}


class MakeSession
{

    public function setSession($username, $idUser, $logged, $isAdmin, $email)
    {
        //$session = new Session;
        //$zSession = $session->getSESSION();
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $idUser;
        $_SESSION['loggedin'] = $logged;
        $_SESSION['isAdmin'] = $isAdmin;
        $_SESSION['email'] = $email;
    }
}
