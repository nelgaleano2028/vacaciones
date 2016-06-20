<?php
session_start();

include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');
require_once('../html2pdf/html2pdf.class.php');

$nomadmin = $_SESSION['nom'];

//validacion bd f
$consultaf = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['NOM_ADMIN'])){ 
$conn = $configf;  
//dentro de esta condicion se llama la conexion a la base de datos de profunda 
}

if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;
//dentro de esta condicion se llama la conexion a la base de datos de confidencial 'vip' 
}

if(isset($rowa['NOM_ADMIN'])){
$conn = $config;
//dentro de esta condicion se llama la conexion a la base de datos de telmovil o telori o 'marisol' 
}

if(isset($rowt['NOM_ADMIN'])){
$conn = $configt;
//dentro de esta condicion se llama la conexion a la base de datos de TGT 
}

global $conn;	
	
		$sql="Select COD_EPL, ESTADO from empleados_basic where cedula='".$_POST["cedula"]."' and cod_epl like '%R%' and INI_CTO=(select max(INI_CTO) 
			from empleados_basic where cedula='".$_POST["cedula"]."')";		
		$res=$conn->Execute($sql);
		$row23 = $res->fetchrow();	
		$codigo=$row23["COD_EPL"];
		
		if($row23["ESTADO"]=='A'){		
			echo '1';
		}
?>
