<?php
session_start();

include_once("class_empleado.php");

$empleado = new empleado();

$empleado->set_codigo(@$_POST["empleado"]);//set de codigo del empleado se lo paso a la clase

/*Objetos que me capturan los datos a insertar o modificar*/


$cedula=$_POST["nudocumento"];
$nombre=$_POST["nombre"];
$radio=$_POST["radio"];
$tipo=$_POST["tidocumento"];
$apellido=$_POST["apellidos"];
$parentesco=$_POST["parentesco"];
$sexo=$_POST["sexo"];
$lugarnaci=$_POST["lugarnaci"];

$fechanaci=date("d/m/Y", strtotime($_POST["fechanaci"]));
$estcivil=$_POST["estcivil"];
$ocupacion=$_POST["ocupacion"];
$nived=$_POST["nived"];
$tipovinculo=$_POST["tipovinculo"];
$benauxilio=$_POST["benauxilio"];
$discapacitado=$_POST["discapacitado"];


/*--------------------------------------------------------*/

if($_POST["accion"] == "cancelar"){
    $respuesta = $empleado->eliminar_familiar($cedula,$_POST["empleado"]);
}else{

$validar=$empleado->validar_familiar($cedula);//valido si ya se realizo una solicitud

if($validar > 0){//si existe una solicitud entonces modifique (actualizar)
    $respuesta=$empleado->editar_familiar($cedula,$nombre,$apellido,$tipo,$parentesco,$sexo,$estcivil,$fechanaci,$ocupacion,$radio,$lugarnaci,$nived,$tipovinculo,$discapacitado,$benauxilio);
    $empleado->eliminar_familiar($cedula,$_POST["empleado"]);
}else{//inserte la nueva solicitud

$respuesta = $empleado->insertar_familiar($cedula,$nombre,$apellido,$tipo,$parentesco,$sexo,$estcivil,$fechanaci,$ocupacion,$radio,$lugarnaci,$nived,$tipovinculo,$discapacitado,$benauxilio);
$empleado->eliminar_familiar($cedula,$_POST["empleado"]);
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