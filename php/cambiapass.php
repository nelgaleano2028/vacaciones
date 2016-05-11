<?php
session_start();
include_once('../lib/adodb/adodb.inc.php');
include_once('../lib/configdb.php');

$codigo = @$_SESSION["cor"];
$privilgio = @$_SESSION["pri"];

@$passn = $_POST["passn"];
@$pass = $_POST["pass"];
@$actual = $_POST["passv"];

$query = "SELECT B.cedula as CEDULA , A.email as EMAIL FROM EMPLEADOS_GRAL A, EMPLEADOS_BASIC B WHERE A.COD_EPL = B.COD_EPL AND B.CEDULA ='$actual'";
$rs = $conn->Execute($query);
$row = $rs->fetchrow();

$password_actual = $row['CEDULA'];
$usuario_actual = $row['EMAIL'];


$query1 = "SELECT pass as PASS, usuario as USUARIO FROM T_NUEVO_PASS WHERE usuario ='$codigo'";
$rs1 = $conn->Execute($query1);
$row1 = $rs1->fetchrow();

$password_nuevo = $row1['PASS'];
$usuario_nuevo = $row1['USUARIO'];

if(empty($actual)){
header("Location:nuevopass.php?456789=71");

}elseif(empty($password_nuevo) && isset($password_actual)){

$query = "INSERT INTO T_NUEVO_PASS (pass, usuario, pri) VALUES ('$pass','$codigo','$privilgio')";
$rs = $conn->Execute($query);
header("Location:nuevopass.php?293875=76");

}elseif (isset($password_nuevo) && $password_nuevo==$actual){

$query = "UPDATE T_NUEVO_PASS SET pass='$pass' WHERE usuario='$codigo'";
$rs = $conn->Execute($query);

header("Location:nuevopass.php?293875=76");

}else{
header("Location:nuevopass.php?456789=71");

}

?>