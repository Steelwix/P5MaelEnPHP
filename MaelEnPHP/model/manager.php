<?php
class Manager
{
    protected function dbConnect()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=maelenphp;charset=utf8", 'maelenphp', 'hkzkwx02'); 
    }
}