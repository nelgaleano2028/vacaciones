<?php
@session_start();
set_time_limit (86400);
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=ReporteMail.xls");
header("Pragma: no-cache");
header("Expires: 0");

$nomadmin = $_SESSION['nom'];

//validacion bd f
$consultaf = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN 

WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN 

WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN 

WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN 

WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['NOM_ADMIN'])){
$conn = $configf;
}
if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;
}
if(isset($rowa['NOM_ADMIN'])){
$conn = $config;
}
if(isset($rowt['NOM_ADMIN'])){
$conn = $configt;
}


if(!isset($_SESSION['privi'])){
  
  header("location: index.php");
}

$from = $_POST["from"];
$to = $_POST["to"];

	$query = "select CEDULA AS CEDULA, NOMBRES||' '||APELLIDOS AS NOMBRES, FECHA_REG AS FECHA_REG, NOVEDAD AS NOVEDAD, COMENTARIO AS COMENTARIO, EMPRESA AS EMPRESA 
from t_admail where FECHA_REG between to_date('".$from."','DD-MM-YY')  and to_date('".$to."','DD-MM-YY')";
$res = $conn->Execute($query); 

	echo '<table width="50%" border="1" cellpadding="10" cellspacing="0" bordercolor="#666666" id="Exportar_a_Excel" style="border-collapse:collapse;">
		<tr>
		<td>CEDULA</td>
		<td>NOMBRES Y APELLIDOS</td>
		<td>FECHA REGISTRO</td>
		<td>MODULO</td>
		<td>EMAIL</td>
		<td>EMPRESA</td>
		</tr>
		</table>';
	
	while($row = $res->FetchRow()){
		echo '<table width="50%" border="1" cellpadding="10" cellspacing="0" bordercolor="#666666" id="Exportar_a_Excel" style="border-collapse:collapse;">
		<tr>
		<td>'.$row['CEDULA'].'</td>
		<td>'.$row['NOMBRES'].'</td>
		<td>'.$row['FECHA_REG'].'</td>
		<td>'.$row['NOVEDAD'].'</td>
		<td>'.$row['COMENTARIO'].'</td>
		<td>'.$row['EMPRESA'].'</td>
		</tr>
		</table>';

	}
?>