<?php 
class EntidadBase{
    private $table;
    private $db;
    private $conectar;

    public function __construct($table, $adapter) {
        $this->table=(string) $table;
		$this->conectar = null;
		$this->db = $adapter;
    }
    
    public function getConetar(){
        return $this->conectar;
    }
    
    public function db(){
        return $this->db;
    }

    public function set($key, $v) {
        $this->{$key} = $v;
    }

    public function get($key) {
        return $this->{$key};
    }
    
    public function getAll(){
		$resultSet = [];
		#echo "SELECT * FROM `{$this->table}` ";
        $query = $this->db->query("SELECT * FROM $this->table ");
		if($query !== false){
			while ($row = $query->fetch_object()) {
				$classCall = get_called_class();
				$model = new $classCall();
				$model->setAll($row);
				$resultSet[] = $model;
			}
		}
        
        return $resultSet;
    }
    
    public function getAllBy($column,$value){
		$resultSet = [];
		#echo "SELECT * FROM `{$this->table}` ";
        $query = $this->db->query("SELECT * FROM `{$this->table}` WHERE `{$column}`='{$value}'");
		if($query !== false){
			while ($row = $query->fetch_object()) {
				$classCall = get_called_class();
				$model = new $classCall();
				$model->setAll($row);
				$resultSet[] = $model;
			}
		}
        
        return $resultSet;
    }
	
    public function countAllBy($column,$value){
		$resultSet = 0;
		#echo "SELECT * FROM `{$this->table}` ";
        $query = $this->db->query("SELECT count(*) as `total` FROM `{$this->table}` WHERE `{$column}`='{$value}'");
		if($query !== false){
			while ($row = $query->fetch_object()) {
				$resultSet = $row->total;
			}
		}
        return $resultSet;
    }
	
	public function setAll($data){
		foreach($data as $k => $v){
			$this->set($k, $v);
		}
	}
    
    public function getById($id){
        $query=$this->db->query("SELECT * FROM `{$this->table}` WHERE `id`={$id}");
		if($row = $query->fetch_object()) {
			   $resultSet=$row;
			}
        return $resultSet;
    }
    
    public function getBySQL($sql){
		$resultSet = null;
        $query=$this->db->query($sql);
        while($row = $query->fetch_object()) {
		   $resultSet=$row;
        }        
        return $resultSet;
    }
	
    public function getBy($column,$value){
		$resultSet = null;
        $query=$this->db->query("SELECT * FROM `{$this->table}` WHERE `{$column}`='{$value}'");
        while($row = $query->fetch_object()) {
           #$resultSet[]=$row;
		   $resultSet=$row;
        }        
        return $resultSet;
    }
	
    public function getByLike($column,$value){
		$resultSet = null;
        $query=$this->db->query("SELECT * FROM `{$this->table}` WHERE `{$column}` LIKE '%{$value}%' ");
        while($row = $query->fetch_object()) {
           #$resultSet[]=$row;
		   $resultSet=$row;
        }        
        return $resultSet;
    }
    
    public function deleteById($id){
        $query=$this->db->query("DELETE FROM `{$this->table}` WHERE `id`={$id}"); 
        return $query;
    }
    
    public function deleteBy($column,$value){
        $query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'"); 
        return $query;
    }
    

    /*
     * Aqui podemos montarnos un monton de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */
    
}
?>
