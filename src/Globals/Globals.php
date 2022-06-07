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
        $this->SESSION = filter_input_array(INPUT_POST) ?? null;
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
}