<?php
//Configuración global
require_once 'config/global.php';
global $FG;

require_once 'core/Conectar.php';
require_once 'core/vConectar.php';
require_once 'core/aConectar.php';
require_once 'core/Helper.php';
require_once 'core/EntidadBase.php';
require_once 'core/ModeloBase.php';

$FG['conectar_c'] = new Conectar();
$FG['adapter_c'] = $FG['conectar_c']->conexion();

$FG['conectar_v'] = new vConectar();
$FG['adapter_v'] = $FG['conectar_v']->conexion();

$FG['conectar_a'] = new aConectar();
$FG['adapter_a'] = $FG['conectar_a']->conexion();


//Base para los controladores
require_once 'core/ControladorBase.php';
//Funciones para el controlador frontal
require_once 'core/ControladorFrontal.func.php';

//Cargamos controladores y acciones
if(isset($_GET["controller"])){
    $controllerObj=cargarControlador($_GET["controller"]);
    lanzarAccion($controllerObj);
}else{
    $controllerObj=cargarControlador(CONTROLADOR_DEFECTO);
    lanzarAccion($controllerObj);
}
?>
