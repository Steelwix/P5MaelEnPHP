<?php

class Manager
{
    protected $db;
    public function __construct()
    {


            try {
              $this->db = new PDO('mysql:host=localhost;dbname=maelenphp', 'maelenphp', 'hkzkwx02');
              $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);}
            catch(PDOException $e) {
              echo 'La base de donnée est indisponible';
            }
             

    }
    
}