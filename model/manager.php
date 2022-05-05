<?php

class Manager
{
    
    protected function dbConnect()
    {


            try {
              $db = new PDO('mysql:host=localhost;dbname=maelenphp', 'maelenphp', 'hkzkwx02');
            return $db; }
            catch(PDOException $e) {
              echo 'La base de donnée est indisponible';
            }
             

    }
    
}