<?php
session_start();
include_once('lib/adodb/adodb.inc.php');
include_once('lib/configdb.php'); 

$id=$_SESSION['cod'];

/*********************Recupera Parametros***************************/
//Variables
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']); 
$documento = trim($_POST['documento']);
$ciudadexp = trim($_POST['ciudadexp']);
$sexo = trim($_POST['sexo']);
$peso = trim($_POST['peso']);
$tipodocumento = trim($_POST['tipodocumento']); 
$libmilitar = trim($_POST['libmilitar']);
$clase = trim($_POST['clase']);
$distmilitar = trim($_POST['distmilitar']);
$liconduccion = trim($_POST['liconduccion']);
$categoria = trim($_POST['categoria']); 
$fechven = trim($_POST['fechven']);
$fechnac = trim($_POST['fechnac']);
$ciunac = trim($_POST['ciunac']);
$direccion = trim($_POST['direccion']);
$ciudad = trim($_POST['ciudad']);
$telefono = trim($_POST['telefono']);
$celular = trim($_POST['celular']);
$direccionalt = trim($_POST['direccionalt']);
$telefonoalt = trim($_POST['telefonoalt']); 
$email = trim($_POST['email']);
$profesion = trim($_POST['profesion']);
$experiencia = trim($_POST['experiencia']);
$tarjetaprof = trim($_POST['tarjetaprof']);
$pasadojud = trim($_POST['pasadojud']); 
$estcivil = trim($_POST['estcivil']);
$anteojos = trim($_POST['anteojos']);
$estatura = trim($_POST['estatura']);



$qry2 = "select cod_ciu , nom_ciu
from ciudades where nom_ciu='$ciudada'";

		$rs2 = $conn->Execute($qry2); 
		while($row2 = $rs2->fetchrow()){
			$ciudad=$row2["cod_ciu"];
		}
		
		$qry3 = "select cod_ciu , nom_ciu
from ciudades where nom_ciu='$ciudadrea'";

		$rs3 = $conn->Execute($qry3); 
		while($row3 = $rs3->fetchrow()){
			$ciudadre=$row3["cod_ciu"];
		}



	//Inserta las valoraciones
		 $sql = "UPDATE empleados_gral set fec_nac=(CONVERT(CHAR(19), '$fechauno 00:00:00 a.m.',113)),ciu_nac='$ciudad',cod_ciu='$ciudadre',dir_epl2='{$_POST['direccion']}',tel_2='{$_POST['telefono']}',celular='{$_POST['celular']}',sexo='{$_POST['genero']}',email='{$_POST['email']}',cod_nie='{$_POST['estudios']}', num_hjo='{$_POST['hijos']}',cod_civ='{$_POST['civil']}',lib_mil='{$_POST['libreta']}',clase_lib='{$_POST['clase']}',gru_san='{$_POST['sanguineo']}' where cod_epl='$id'";
					if ($conn->Execute($sql) === false) {
						print 'Error al insertar: '.$conn->ErrorMsg().'<BR>';
					}
					else{
						echo "<script> 
												alert('Actualización guardada exitosamente'); 
												location='personal.php';
										</script>";
					}
/***********************************************************************************************************************************/																		
?>