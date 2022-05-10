<?php

class Manager
{
    protected $db;
    public function __construct()
    {


            try {
              $this->db = new PDO('mysql:host=localhost;dbname=maelenphp', 'maelenphp', 'hkzkwx02'); }
            catch(PDOException $e) {
              echo 'La base de donnée est indisponible';
            }
             

    }
    
}