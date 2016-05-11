<?php
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');
@session_start();

$codiepl = $_SESSION['ced'];

   //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowt['CONTEO'])){
$conn = $configt;
$empresamail='TGT';
}
if(isset($rowf['CONTEO'])){
$conn = $configf;
$empresamail='FUNDACION';
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
$empresamail='CONFIDENCIAL';
}
if(isset($rowa['CONTEO'])){
$conn = $config;
$empresamail='TELMOVIL';
}

//------------------------------FIN antidoto			
			
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$_SESSION['ced']."','".$_SESSION['nombre']."','".$_SESSION['ape']."',SYSDATE,'Novedades','novedades.nominacolombia@telefonica.com','".$empresamail."')";
$conn->Execute($sqlmail);

 header("location: http://talentsw.com/contactenos/contactenos-v4.php");


 ?> 
 

		