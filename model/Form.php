<?php
class Form extends EntidadBase{
    public $id;
    public $name;
    public $datetime_init;
    public $datetime_end;
    public $daytime_init;
    public $daytime_end;
    public $retries;
    public $trunk;
    public $context;
    public $queue;
    public $max_canales;
    public $num_completadas;
    public $promedio;
    public $desviacion;
    public $script;
    public $estatus;
    public $id_url;
    
    public function __construct() {
		global $FG;
        $table="form";
        parent::__construct($table, $FG['adapter_c']);
    }
	
	public function setAll($data){
		parent::setAll($data);
		if($this->isValid()){
		}
	}
	
	public function isValid(){
		return (int) $this->id > 0;
	}

    public function save(){
        $query="INSERT INTO usuarios (id,nombre,apellido,email,password)
                VALUES(NULL,
                       '".$this->nombre."',
                       '".$this->apellido."',
                       '".$this->email."',
                       '".$this->password."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }

}
?>