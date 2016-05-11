<?php
include_once("class_admin.php");

$usaurio=$_POST["usuario"];
$pass=$_POST["pass"];
$cod_epl=$_POST["cod_epl"];


$administrador=new perfil_admin();

$administrador->set_usuario($usaurio);
$administrador->set_pass($pass);
$administrador->set_cod_epl($cod_epl);
$validar=$administrador->new_admin();
echo $validar;
?>