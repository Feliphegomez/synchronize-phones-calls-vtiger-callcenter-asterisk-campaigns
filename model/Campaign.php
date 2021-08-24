<?php
class Campaign extends EntidadBase{
    public $id                 = 0;
    public $name               = "";
    public $datetime_init      = "";
    public $datetime_end       = "";
    public $daytime_init       = "";
    public $daytime_end        = "";
    public $retries            = 1;
    public $trunk              = NULL;
    public $context            = "";
    public $queue              = "";
    public $max_canales        = 0;
    public $num_completadas    = NULL;
    public $promedio           = NULL;
    public $desviacion         = NULL;
    public $script             = "";
    public $estatus            = "I";
    public $id_url             = NULL;
    public $form_id            = NULL;
    public $phone_book         = 0;
    
    public function __construct() {
		global $FG;
        $table="campaign";
        parent::__construct($table, $FG['adapter_c']);
    }
	
	public function setAll($data){
		parent::setAll($data);
		if($this->isValid()){
			$calls = new Calls();
			$phone_book = $calls->countAllBy('id_campaign', $this->get('id'));
			$this->set('phone_book', $phone_book);
			
			// call_attribute
			// call
		}
	}
	
	public function getPhoneBook(){
		$resultSet = [];
		$query = $this->db()->query("SELECT 
			`C`.*
			, GROUP_CONCAT(`CA`.`columna`) AS `columnas`
			, GROUP_CONCAT(`CA`.`value`) AS `values`
		FROM 
			`calls` `C`
		LEFT JOIN 
			`call_attribute` `CA`
		ON `CA`.`id_call`=`C`.`id`
		WHERE 
			`C`.`id_campaign`={$this->id}
		GROUP BY
			`CA`.`id_call`");
		if($query !== false){
			while ($row = $query->fetch_object()) {
				$row->columnas = explode(',', $row->columnas);
				$row->values = explode(',', $row->values);
				$resultSet[] = $row;
			}
		}
		return $resultSet;
	}
	
    public function getById($id){
		$item = parent::getById($id);
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

    public function changeEstatus($estatus){
		$query = "UPDATE `campaign` SET `estatus`='{$estatus}' WHERE `id`={$this->id};";
        $save = $this->db()->query($query);
		if($save == true){
			$this->set('estatus', $estatus);
		}
	}

    public function create(){
        $query = "INSERT INTO `campaign` 
		(`name`, `datetime_init`, `datetime_end`, `daytime_init`, `daytime_end`, `retries`, `trunk`, `context`, `queue`, `max_canales`, `id_url`, `estatus`, `script`)
		VALUES("
			. "'{$this->name}', "
			. "'{$this->datetime_init}', "
			. "'{$this->datetime_end}', "
			. "'{$this->daytime_init}', "
			. "'{$this->daytime_end}', "
			. "'{$this->retries}', "
			. "'{$this->trunk}', "
			. "'{$this->context}', "
			. "'{$this->queue}', "
			. "'{$this->max_canales}', "
			. "'{$this->id_url}', "
			. "'{$this->estatus}', "
			. "'{$this->script}'"
		. ");";
		
        $save = $this->db()->query($query);
		if($save == true){
			$this->set('id', $this->db()->insert_id);
			$query = "INSERT INTO `campaign_form` (`id_campaign`, `id_form`) VALUES ('{$this->id}', '{$this->form_id}');";
			$save = $this->db()->query($query);
		}
        //$this->db()->error;
        return $save;
    }
	
    public function save(){
		
        $query = "UPDATE `campaign` 
		SET 
			`name`='{$this->name}'
			, `datetime_init`='{$this->datetime_init}'
			, `datetime_end`='{$this->datetime_end}'
			, `daytime_init`='{$this->daytime_init}'
			, `daytime_end`='{$this->daytime_end}'
			, `retries`='{$this->retries}'
			, `trunk`='{$this->trunk}'
			, `context`='{$this->context}'
			, `queue`='{$this->queue}'
			, `max_canales`='{$this->max_canales}'
			, `id_url`='{$this->id_url}'
			, `estatus`='{$this->estatus}'
			, `script`='{$this->script}'
		WHERE `id` = {$this->id};";
		
        $save = $this->db()->query($query);
		if($save == true){
			$this->getById($this->id);
		}
        //$this->db()->error;
        return $save;
    }

}
?>