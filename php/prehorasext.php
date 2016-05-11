<?php
@session_start();

//------------------------------antidoto
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

$rowhoras = $_GET['valor'];
$codiepl = $_SESSION['ced'];

   //validacion bd f
$consultaf = "SELECT CEDULA AS CEDULA, NIVEL AS NIVEL FROM JEFES WHERE NRO_CEDULA = '$codiepl'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "SELECT CEDULA AS CEDULA, NIVEL AS NIVEL FROM JEFES WHERE NRO_CEDULA = '$codiepl'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "SELECT CEDULA AS CEDULA, NIVEL AS NIVEL FROM JEFES WHERE NRO_CEDULA = '$codiepl'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "SELECT CEDULA AS CEDULA, NIVEL AS NIVEL FROM JEFES WHERE NRO_CEDULA = '$codiepl'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CEDULA'])){
$conn = $configf;
$contrasena_jefe = $rowf['CEDULA'];
$nivelgerente = $rowf['NIVEL'];
}
if(isset($rowc['CEDULA'])){
$conn = $configc;
$contrasena_jefe = $rowc['CEDULA'];
$nivelgerente = $rowc['NIVEL'];
}
if(isset($rowt['CEDULA'])){
$conn = $configt;
$contrasena_jefe = $rowt['CEDULA'];
$nivelgerente = $rowt['NIVEL'];
}
if(isset($rowa['CEDULA'])){
$conn = $config;
$contrasena_jefe = $rowa['CEDULA'];
$nivelgerente = $rowa['NIVEL'];
}

//------------------------------FIN antidoto

		


if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}

$codigo=$_SESSION['cod'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
.contenido {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.contenido {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
body,td,th {
	color: #666;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.contenido span strong em {
	font-size: 12px;
}
</style>
	<style type="text/css">
@import url("../css/plantilla_user.css");
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
    a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
    </style>
<body>
<table width="1280" border="0" >
  <tr>
    <td><p><strong>Trabajo por turnos:</strong></p><p>
    Este módulo permitirá optimizar el proceso de registro y transcripción de los reportes mensuales.  Es importante que el líder revise el registro y garantice la información suministrada.</p>
      <p>
	Se define Turnos de Trabajo cuando la naturaleza de la labor no exija actividad continua y se lleve a cabo por turnos de trabajadores, la duración de la jornada puede ampliarse en más de 8 horas diarias o en más de 48 horas semanales, siempre que el promedio de la horas de trabajo calculado para un periodo que no exceda de tres semanas, no pase de 8 horas diarias o de 48 a la semana. Esta ampliación no constituye trabajo suplementario o de horas extras.
	  </p>
<p>
Si quieres consultar la política de la compañía respecto al tema, ingresa <a href="http://intranettelefonica/Procesos/Documents/Politicas%20Corporativas/Politicas%20Empleados/GRH-RP-010000%20Gestion%20del%20Recurso%20Humano/GRH-POL-010004%20Politicas%20Turnos%20de%20Trabajo.pdf" target="_blank">aquí</a></p>
<p>
	  </p>
        <br />
    <?php  
if($rowhoras>0){ echo '<p class="contenido" style=" alignment-adjust:central; margin-top:0px;"><a href="horasext.php"><img src="../imagenes/boton_continuarahora.png" width="137" height="37" /></a>'; }?>
   <?php  
if (isset($contrasena_jefe)){ echo '<span class="contenido" style=" alignment-adjust:central; margin-top:0px;"><a href="preconsiderahoras.php"><img src="../imagenes/boton_administradorhora.png" width="137" height="37" /></a></span>'; }?>
   <?php  
if (isset($contrasena_jefe) && $nivelgerente=='2'){ echo '<span class="contenido" style=" alignment-adjust:central; margin-top:0px;"><a href="main_gerente_he.php" target="_blank"><img src="../imagenes/boton_gerente.png" width="137" height="37" /></a></span>'; }?></p>
        </td>
    <td colspan="2"><span class="contenido"><img src="../imagenes/todoesganancia3.jpg" alt="" width="530" height="284" /></span></td>
  </tr>
</table>
</br>
</br>
<table width="100%"  border="0">
<tr>
          <td class="piepag">Cualquier inconveniente que tengas, crea tu tiquete a la Mesa Centro de Servicios Compartidos haciendo <a href="http://clienteinterno:9000/MesasAyuda/Categorias/113/Subcategorias/729/Productos/5119/Problemas" style="color: #770003">clic aquí</a> y adjunta el pantallazo con el error.</td>
  </tr>
</table>
</body>

</html>
