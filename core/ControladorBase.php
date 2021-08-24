<?php
class ControladorBase{

    public function __construct() {
		global $FG;
        $this->conectar_c = $FG['conectar_c'];
        $this->adapter_c  = $FG['adapter_c'];
        $this->conectar_v = $FG['conectar_v'];
        $this->adapter_v  = $FG['adapter_v'];
        $this->conectar_a = $FG['conectar_a'];
        $this->adapter_a  = $FG['adapter_a'];
		
        //Incluir todos los modelos
        foreach(glob("model/*.php") as $file){
            require_once $file;
        }
    }
    
    //Plugins y funcionalidades
    
    public function view($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc} = $valor; 
        }
        $helper = new Helper();
        require_once 'view/'.$vista.'View.php';
    }
    
    public function redirect($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        header("Location:index.php?controller=".$controlador."&action=".$accion);
    }
    
    //Métodos para los controladores

}
?>
