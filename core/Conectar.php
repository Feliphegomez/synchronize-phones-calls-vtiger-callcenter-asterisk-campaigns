<?php
class Conectar{
    private $driver;
    private $host, $user, $pass, $database, $charset;
  
    public function __construct() {
        $db_cfg = require 'config/database.php';
        $this->driver   = $db_cfg["driverc"];
        $this->host     = $db_cfg["hostc"];
        $this->user     = $db_cfg["userc"];
        $this->pass     = $db_cfg["passc"];
        $this->database = $db_cfg["databasec"];
        $this->charset  = $db_cfg["charsetc"];
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
