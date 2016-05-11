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
$evento=$_POST["evento"];
$curso=$_POST["curso"];
$area=$_POST["area"];
$modalidad=$_POST["modalidad"];
$tiempo=$_POST["tiempo"];
$unidad=$_POST["unidadtiemp"];
$entidad=$_POST["entidades"];
$pais=$_POST["paises"];
$ciudad=$_POST["ciudades"];



if($_POST["accion"]== "cancelar"){
    $respuesta=$empleado->eliminar_no_formal($_POST["evento"],$_POST["curso"],$_POST["modalidad"],$_POST["area"],$_POST["empleado"]);
}else{
/*--------------------------------------------------------*/

$validar=$empleado->validar_edu_no_formal($evento,$curso,$modalidad,$area);//valido si ya se realizo una solicitud

if($validar > 0){//si existe una solicitud entonces modifique (actualizar)
    $respuesta=$empleado->editar_no_formal($evento,$curso,$area,$modalidad,$fechaini,$fechafin,$tiempo,$unidad,$entidad,$ciudad,$pais);
    $empleado->eliminar_no_formal($_POST["evento"],$_POST["curso"],$_POST["modalidad"],$_POST["area"],$_POST["empleado"]);
}else{//inserte la nueva solicitud

 $respuesta =$empleado->insertar_no_formal($evento,$curso,$area,$modalidad,$fechaini,$fechafin,$tiempo,$unidad,$entidad,$ciudad,$pais);
$empleado->eliminar_no_formal($_POST["evento"],$_POST["curso"],$_POST["modalidad"],$_POST["area"],$_POST["empleado"]);

}
}
if($respuesta == true){
    
    $imprimir="Se realizaron cambios satisfactoriamente.";
    
}else{
    $imprimir="Error al realizar los cambios.";
    
}

echo $imprimir;




?>