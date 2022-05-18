<?php


namespace OpenClassrooms\Blog\Model;

use Manager;

require_once("model/manager.php");

class messageManager extends Manager
{
    public function newMessage($email, $message, $datetime)
    {

        $newMess = $this->db->query("INSERT INTO contact(id, email, message, received) VALUES (NULL, '".$email."', '".$message."', '".$datetime."')");
        return $newMess;
    }
}