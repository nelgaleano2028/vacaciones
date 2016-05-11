<?php
@session_start();

//------------------------------antidoto
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');


$codiepl = $_SESSION['ced'];

   //validacion bd f
$consultaf = "select CEDULA AS CEDULA from empleados_basic where CEDULA = '$codiepl'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select CEDULA AS CEDULA from empleados_basic where CEDULA = '$codiepl'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select CEDULA AS CEDULA from empleados_basic where CEDULA = '$codiepl'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select CEDULA AS CEDULA from empleados_basic where CEDULA = '$codiepl'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CEDULA'])){
$conn = $configf;
$flag = '1';
}
if(isset($rowc['CEDULA'])){
$conn = $configc;
$flag = '2';
}
if(isset($rowa['CEDULA'])){
$conn = $config;
$flag = '3';
}
if(isset($rowt['CEDULA'])){
$conn = $configt;
$flag = '4';
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
	font-weight: bold;
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
    .a {
	font-style: italic;
}
    </style>
<body>
<table width="100%" border="0" >
  <tr>
    <td><p>Consideraciones a tener en cuenta:</p>
      <p>&nbsp;</p>
      <ul type="disc">
        <li><em>Importante validar los dias pendientes por disfrutar de tus colaboradores</em>.</li>
        <li><strong><em>Verifica la programacion de tu equipo de trabajo antes de la aprobacion</em></strong>.  </li>
        <li><strong><em>Si consideras que un colaborador debe cambiar las fechas de programacion, puedes marcarla como rechazada</em></strong>. </li>
        <li class="a">Importante, Una vez aprobadas las vacaciones, la herramienta no permite cambios en la programacion.</li>
      </ul>
      <p>&nbsp;</p>
      
      <ul type="disc">
        <br />
        <p class="contenido" style=" alignment-adjust:central; margin-top:0px;">
        <span class="contenido" style=" alignment-adjust:central; margin-top:0px;"><a href="prueba.php?us=q1e5d69e&pa=g86r5h5f&flag=<?php echo $flag;?>" target="_blank"><img src="../imagenes/boton_administrador.png" width="137" height="37" /></a></span></p>
        <p class="contenido" style=" alignment-adjust:central; margin-top:0px;">&nbsp;</p>
    </ul></td>
  </tr>
</table>

<table width="100%"  border="0">
<tr>
          <td class="piepag">&nbsp;</td>
  </tr>
</table>
</body>

</html>