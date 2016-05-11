<?php
session_start();

include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

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

				$titulo = $_POST['titulo'];
				$entrante = $_POST['texto']; 		
				$id = $_POST['identificador']; 	
				$estado = '1';	
				
				$sql = "SELECT ID, TITULO, CONTENIDO, FECHA, ESTADO FROM FEEDNEWS ORDER BY ID DESC";
				$rs = $conn->Execute($sql);
				$row = $rs->fetchrow();
				echo $SUMAID = $row["ID"]+1;

if (isset($_POST["actualizar"]))
{
$sql = "UPDATE FEEDNEWS SET CONTENIDO = '$entrante' , TITULO = '$titulo', FECHA=SYSDATE WHERE ID = '$id'";
$conn->Execute($sql);
echo 'actualizado';
//header("Location:adminfeed.php"); // ESTA LINEA ESTABA GENERANDO ERROR
}
if (isset($_POST["guardar"]))
{
	$sql = "INSERT INTO FEEDNEWS (ID, CONTENIDO, TITULO, FECHA, ESTADO) VALUES ('$SUMAID','$entrante','$titulo', SYSDATE, '$estado')";
$conn->Execute($sql);
echo 'guardado';
//header("Location:adminfeed.php"); // ESTA LINEA ESTABA GENERANDO ERROR
};			
?>
<!-- SCRIPT PARA REGRESAR A LA PANTALLA ANTERIOR -->
<script language="javascript"> 
		alert("Se almaceno correctamente.");
		window.location="adminfeed.php"; 
</script>