<?php
session_start();

include_once("class_empleado.php");

$empleado = new empleado();

$empleado->set_codigo(@$_POST["empleado"]);//set de codigo del empleado se lo paso a la clase

/*Objetos que me capturan los datos a insertar o modificar*/

if($_POST["fechaini"] == ""){
    $fechaini=null;
}else{
    $fechaini=date("d/m/Y", strtotime($_POST["fechaini"]));
}


if($_POST["fechafin"]== ""){
    $fechafin=null;
}else{
    $fechafin=date("d/m/Y", strtotime($_POST["fechafin"]));
}
$estudios=$_POST["estudios"];
$profesion=$_POST["profesion"];
$titulo=$_POST["titulo"];
$radio=$_POST["radio"];
$ciudad=$_POST["ciudad"];
$pais=$_POST["pais"];
$entidad=$_POST["entidad"];
$tiempouni=$_POST["tiempouni"];
$tiempo=$_POST["tiempo"];




/*--------------------------------------------------------*/


if($_POST["accion"]== "cancelar"){
    $respuesta=$empleado->eliminar_formal($titulo,$estudios,$_POST["empleado"]);
}else{

$validar=$empleado->validar_formal($estudios,$titulo);//valido si ya se realizo una solicitud

if($validar > 0){//si existe una solicitud entonces modifique (actualizar)
    $respuesta=$empleado->editar_formal($estudios,$titulo,$fechaini,$fechafin,$tiempouni,$tiempo,$entidad,$ciudad,$pais);
    $empleado->eliminar_formal($titulo,$estudios,$_POST["empleado"]);
}else{//inserte la nueva solicitud

$respuesta = $empleado->insertar_formal($estudios,$titulo,$fechaini,$fechafin,$tiempouni,$tiempo,$tiempouni,$entidad,$ciudad,$pais);
$empleado->eliminar_formal($titulo,$estudios,$_POST["empleado"]);
}
}
if($respuesta == true){
    $imprimir="Se realizaron cambios satisfactoriamente.";
    
    $email;
}else{
    $imprimir="Error al realizar los cambios.";
    
}

echo $imprimir;




?>