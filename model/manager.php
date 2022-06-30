<?php
//Main model class, connect the website to database
class Manager
{
  protected $dataBase;
  public function __construct()
  {


    try {
      $this->dataBase = new PDO('mysql:host=localhost;dbname=maelenphp', 'maelenphp', 'hkzkwx02');
      $this->dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
      $e = "Base de donnée introuvable";
    }
  }
}
