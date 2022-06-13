<?php


namespace OpenClassrooms\Blog\Session;

class Session
{
    private $vars;


    public function __construct()
    {
        $this->vars = &$_SESSION;
    }
    public function getSESSION($key = null)
    {
        if (null !== $key) {
            return $this->vars[$key] ?? null;
        }
        return $this->vars;
    }
}
