<?php
session_start();

include_once("class_empleado.php");

$empleado = new empleado();

$empleado->set_codigo(@$_SESSION["cod"]);//set de codigo del empleado se lo paso a la clase

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

$validar=$empleado->validar_formal_tmp($estudios,$titulo);//valido si ya se realizo una solicitud

if($validar > 0){//si existe una solicitud entonces modifique (actualizar)
    $respuesta=$empleado->editar_formal_tmp($estudios,$titulo,$fechaini,$fechafin,$tiempo,$tiempouni,$entidad,$ciudad,$pais);
    
}else{//inserte la nueva solicitud

$respuesta = $empleado->insertar_formal_tmp($estudios,$titulo,$fechaini,$fechafin,$tiempo,$tiempouni,$entidad,$ciudad,$pais);
}
if($respuesta == true){
    $imprimir="La solicitud se ha enviado satisfactoriamente.";
    
    $email;
}else{
    $imprimir="Error al enviar la solicitud.";
    
}

echo $imprimir;




?>