<?php
@session_start();

//------------------------------antidoto
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');


$codiepl = $_SESSION['ced'];

   //validacion bd f
$consultaf = "SELECT CEDULA AS CEDULA FROM JEFES WHERE NRO_CEDULA = '$codiepl'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "SELECT CEDULA AS CEDULA FROM JEFES WHERE NRO_CEDULA = '$codiepl'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "SELECT CEDULA AS CEDULA FROM JEFES WHERE NRO_CEDULA = '$codiepl'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "SELECT CEDULA AS CEDULA FROM JEFES WHERE NRO_CEDULA = '$codiepl'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();


if(isset($rowt['CEDULA'])){
$conn = $configt;
$contrasena_jefe = $rowt['CEDULA'];
}
if(isset($rowf['CEDULA'])){
$conn = $configf;
$contrasena_jefe = $rowf['CEDULA'];
}
if(isset($rowc['CEDULA'])){
$conn = $configc;
$contrasena_jefe = $rowc['CEDULA'];
}
if(isset($rowa['CEDULA'])){
$conn = $config;
$contrasena_jefe = $rowa['CEDULA'];
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
    <td><p>Recuerda en esta herramienta únicamente debes  registrar los días correspondientes a incapacidades, Licencias de Maternidad y Licencias de Paterninadad, de los colaboradores a tu cargo.<br /></p>
      <p>Colombia Telecomunicaciones reconoce inicialmente el 100% del valor de incapacidad, es compromiso de todos recuperar el 66.67% a cargo de la EPS, a la cual se encuentra afiliado el colaborador.<br /></p>
        <br />
                <p class="contenido" style=" alignment-adjust:central; margin-top:0px;"><a href="incapacidades.php"><img src="../imagenes/boton_JEFE1.png" width="137" height="37" /></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="informe_incapacidades.php"><img src="../imagenes/boton_JEFE2.png" width="137" height="37" /></a>&nbsp;&nbsp;&nbsp;&nbsp;   </td>
    <td colspan="2"><span class="contenido"><img src="../imagenes/incapacidad-pago.jpg" alt="" width="580" height="334" /></span></td>
  </tr>
</table>

<table width="100%"  border="0">
<tr>
          <td class="piepag">Cualquier inconveniente que tengas, crea tu tiquete a la Mesa Centro de Servicios Compartidos haciendo <a href="http://clienteinterno:9000/MesasAyuda/Categorias/113/Subcategorias/729/Productos/5119/Problemas" style="color: #770003">clic aquí</a> y adjunta el pantallazo con el error.</td>
  </tr>
</table>
</body>

</html>
