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
        $_SESSION['username'] = htmlspecialchars($username);
        $_SESSION['id'] = htmlspecialchars($idUser);
        $_SESSION['loggedin'] = htmlspecialchars($logged);
        $_SESSION['isAdmin'] = htmlspecialchars($isAdmin);
        $_SESSION['email'] = htmlspecialchars($email);
    }
}
