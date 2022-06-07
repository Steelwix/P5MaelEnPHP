<?php


namespace OpenClassrooms\Blog\Globals;

class Globals{
    private $GET;
    private $POST;
    private $SESSION;

    public function __construct()
    {
        $this->GET = filter_input_array(INPUT_GET) ?? null;
        $this->POST = filter_input_array(INPUT_POST) ?? null;
        $this->SESSION = $_SESSION;
        $this->SERVER = filter_input_array(INPUT_SERVER) ?? null;
    }
    public function getGET($key = null)
    {
        if(null !== $key){
            return $this->GET[$key] ?? null;
        }
        return $this->GET;
    }
    public function getPOST($key = null)
    {
        if(null !== $key){
            return $this->POST[$key] ?? null;
        }
        return $this->POST;
    }
    public function getSESSION($key = null)
    {
        if(null !== $key){
            return $this->SESSION[$key] ?? null;
        }
        return $this->SESSION;
    }
    public function getSERVER($key = null)
    {
        if(null !== $key){
            return $this->SERVER[$key] ?? null;
        }
        return $this->SERVER;
    }
}