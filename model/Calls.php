<?php
class Calls extends EntidadBase{
    public $id                    = 0;
    public $id_campaign           = 0;
    public $phone                 = "";
    public $status                = null;
    public $uniqueid              = null;
    public $fecha_llamada         = null;
    public $start_time            = null;
    public $end_time              = null;
    public $retries               = 0;
    public $duration              = null;
    public $id_agent              = null;
    public $transfer              = null;
    public $datetime_entry_queue  = null;
    public $duration_wait         = null;
    public $dnc                   = 0;
    public $date_init             = null;
    public $date_end              = null;
    public $time_init             = null;
    public $time_end              = null;
    public $agent                 = null;
    public $failure_cause         = null;
    public $failure_cause_txt     = null;
    public $datetime_originate    = null;
    public $trunk                 = null;
    public $scheduled             = 0;
    
    public function __construct() {
		global $FG;
        $table="calls";
        parent::__construct($table, $FG['adapter_c']);
    }
	
	public function setAll($data){
		parent::setAll($data);
		if($this->isValid()){
			
		}
	}
	
    public function getById($id){
		$item = parent::getById($id);
		if($item !== false && $item !== null){
			$this->setAll($item);
		}
	}
	
    public function getBy($column,$value){
		$item = parent::getBy($column, $value);
		if($item !== false && $item !== null){
			$this->setAll($item);
		}
	}
	
    public function getByLike($column,$value){
		$item = parent::getByLike($column, $value);
		if($item !== false && $item !== null){
			$this->setAll($item);
		}
	}
	
	public function isValid(){
		return (int) $this->id > 0;
	}

    public function save(){
		$item = parent::getBySQL("SELECT * FROM `calls` WHERE `id_campaign` = '{$this->id_campaign}' AND `phone` = '{$this->phone}'");
		if($item !== false && $item !== null){
			$this->setAll($item);
		} else {
			$query = "INSERT INTO `calls` (`id_campaign`, `phone`)
			SELECT * FROM (SELECT '{$this->id_campaign}' as `id_campaign`, '{$this->phone}' as `phone`) AS tmp
			WHERE NOT EXISTS (
				SELECT 1 FROM `calls` WHERE `id_campaign` = '{$this->id_campaign}' AND `phone` = '{$this->phone}'
			) LIMIT 1;";
			$save = $this->db()->query($query);
			if($save == true){
				$this->getById($this->db()->insert_id);
			}
		}
		return $this->isValid();
    }

    public function insertAttr($column,$value,$column_number){
		
		$query = "INSERT INTO `call_attribute` (`id_call`, `columna`, `value`, `column_number`)
		SELECT * FROM (SELECT '{$this->id}' as `id_call`, '{$column}' as `columna`, '{$value}' as `value`, '{$column_number}' as `column_number`) AS tmp
		WHERE NOT EXISTS (
			SELECT 1 FROM `call_attribute` WHERE `id_call`='{$this->id}' AND `columna`='{$column}' AND `value`='{$value}'
		) LIMIT 1;";
        $save = $this->db()->query($query);
		if($save == true){
			// $this->db()->insert_id
		}
        return $save;
    }

}
?>