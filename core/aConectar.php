<?php
class aConectar{
    private $driver;
    private $host, $user, $pass, $database, $charset;
  
    public function __construct() {
        $db_cfg = require 'config/database.php';
        $this->driver   = $db_cfg["drivera"];
        $this->host     = $db_cfg["hosta"];
        $this->user     = $db_cfg["usera"];
        $this->pass     = $db_cfg["passa"];
        $this->database = $db_cfg["databasea"];
        $this->charset  = $db_cfg["charseta"];
    }
    
    public function conexion(){
        if($this->driver=="mysql" || $this->driver==null){
            $con = new mysqli($this->host, $this->user, $this->pass, $this->database);
            $con->query("SET NAMES '".$this->charset."'");
        }
        
        return $con;
    }
    
    public function startFluent(){
        require_once "FluentPDO/FluentPDO.php";
        
        if($this->driver=="mysql" || $this->driver==null){
            $pdo = new PDO($this->driver.":dbname=".$this->database, $this->user, $this->pass);
            $fpdo = new FluentPDO($pdo);
        }
        
        return $fpdo;
    }
}
?>
