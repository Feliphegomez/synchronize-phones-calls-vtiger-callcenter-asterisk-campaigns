<?php
class vConectar{
    private $driver;
    private $host, $user, $pass, $database, $charset;
  
    public function __construct() {
        $db_cfg = require 'config/database.php';
        $this->driver   = $db_cfg["driverv"];
        $this->host     = $db_cfg["hostv"];
        $this->user     = $db_cfg["userv"];
        $this->pass     = $db_cfg["passv"];
        $this->database = $db_cfg["databasev"];
        $this->charset  = $db_cfg["charsetv"];
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
