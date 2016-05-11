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
$flag="profunda"; 

cartalaboral($flag,null,null);

//dentro de esta condicion se llama la conexion a la base de datos de profunda 

}
if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;

//dentro de esta condicion se llama la conexion a la base de datos de confidencial 'vip' 


$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();

$empresa_real = $row58['EMPRESA'];
$nit_real = $row58['NIT'];

$flag='VIP';

cartalaboral($flag, $empresa_real, $nit_real);

}
if(isset($rowa['NOM_ADMIN'])){
$conn = $config;

//dentro de esta condicion se llama la conexion a la base de datos de telmovil o telori o 'marisol' 


$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";



$rsemp = $conn->Execute($query_emp);
$row59 = $rsemp->fetchrow();

$empresa_real = $row59['EMPRESA'];
$nit_real = $row59['NIT'];

$flag='Marisol';

cartalaboral($flag, $empresa_real, $nit_real);
}

function cartalaboral($flag, $empresa_real, $nit_real){ 

global $conn;

	if($_POST["cedula"]){
		
		$sql="select COD_EPL from empleados_basic where cedula='".$_POST["cedula"]."' and estado='I' and cod_epl like '%R%'";		
		$res=$conn->Execute($sql);
		$row23 = $res->fetchrow();	
		$codigo=$row23["COD_EPL"];
		
		if(isset($codigo)){		
			echo '1';
		}
		
		$sql2="select COD_EPL from empleados_basic where cedula='".$_POST["cedula"]."' and estado='A' and cod_epl like '%R%'";		
		$res2=$conn->Execute($sql2);
		$row2 = $res2->fetchrow();	
		$codigo2=$row2["COD_EPL"];
		
		if(isset($codigo2)){		
			echo '2';
		}	
	}
}	
?>
