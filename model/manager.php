<?php

class Manager
{
    
    public function dbConnect()
    {
        try{
            $postselect = "SELECT * FROM post";
            $db = new PDO('mysql:host=localhost;dbname=maelenphp', 'maelenphp', 'hkzkwx02');
            $dpost = $db->query($postselect);
            if($dpost === false){
             die("Error");
            }
            
           }catch (PDOException $e){
             echo $e->getMessage();
           }
    }
    
}