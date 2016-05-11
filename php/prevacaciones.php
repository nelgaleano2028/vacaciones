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
if(isset($rowt['CEDULA'])){
$conn = $configt;
$contrasena_jefe = $rowt['CEDULA'];
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
    <td><p>Recuerda en esta herramienta únicamente debes  registrar los días de vacaciones hábiles que vas a disfrutar. <br />
Ten en cuenta lo siguiente al momento de  solicitar tus vacaciones:</p>
      <ul type="disc">
        <li><strong><em>Programación de Vacaciones</em></strong> Para realizar la programación de tus vacaciones debes reunirte con tu jefe y definir los días que disfrutarás, esta programación debe ser registrada antes del inicio de tus vacaciones, teniendo en cuenta las <a href="crono.php"><em>fechas de cronograma       cierres novedades de nómina</em></a>. Únicamente debes registrar los días de vacaciones hábiles que vas a disfrutar.</li>
        <li><strong><em>Las vacaciones se pagan de       acuerdo al mes de disfrute, no se adelanta pago del mes siguiente, </em></strong>Ejemplo: Si tu periodo de vacaciones va del 15-06-2013 al 15-07-2013 y tu solicitud fue registrada antes del cierre de nómina de Junio, en ese mes recibirás el pago de tu salario del 01-06-2013 al 14-06-2013 y los días de vacaciones del 15-06-2013 al 30-06-2013; el resto de tus vacaciones (01-07-2013 al 15-07-2013) serán pagadas en el mes de Julio, más los días laborales que restan del mes de Julio (16-07-2013 al 30-07-2013).  </li>
        <li><strong><em>Responsabilidades de quien       sale a vacaciones: </em></strong>Todo empleado que salga a vacaciones debe delegar sus responsabilidades e informar al área sobre quién quedará encargado de sus temas (nombres y apellidos, y teléfono de contacto) mediante correo electrónico y con la opción del Outlook para <strong><em>fuera de la oficina</em></strong>&rdquo;. </li>
        <br />
                <p class="contenido" style=" alignment-adjust:central; margin-top:0px;"><a href="vacaciones.php"><img src="../imagenes/boton_continuara.png" width="137" height="37" /></a>   <?php  
				


if (isset ($contrasena_jefe)){ echo '<span class="contenido" style=" alignment-adjust:central; margin-top:0px;"><a href="preconsidera.php"><img src="../imagenes/boton_administrador.png" width="137" height="37" /></a></span>'; }?></p>
        <p class="contenido" style=" alignment-adjust:central; margin-top:0px;"><strong>Beneficios Uno para tus vacaciones</strong></p>
        <li><span lang="es" xml:lang="es"> </span><em><strong>Beneficio UNO 15 = 17: </strong></em><span lang="es" xml:lang="es">Consiste   en recibir 2 días adicionales por programar y disfrutar mínimo un   periodo completo de vacaciones (15 días). Programa tu beneficio</span><em><strong> </strong></em><a href="http://intranettelefonica/momentost/ProgramaUNO/Paginas/15=17.aspx" target="_blank">aquí</a> y <a href="http://intranettelefonica/momentost/ProgramaUNO/Paginas/default.aspx" target="_blank">prográmalo</a></li>
        <li><em><strong>Beneficio UNO 8 es mejor: </strong></em><span lang="es" xml:lang="es">Consiste en recibir 1 día adicional por programar 7 días de vacaciones. Programa tu beneficio </span>&nbsp;<a href="http://intranettelefonica/momentost/ProgramaUNO/Paginas/Ochosonmejor.aspx" target="_blank">aquí</a> y <a href="http://intranettelefonica/momentost/ProgramaUNO/Paginas/default.aspx" target="_blank">prográmalo</a></li>
    </ul></td>
    <td colspan="2"><span class="contenido"><img src="../imagenes/Consejos para ahorrar dinero durante tus vacaciones 1.jpg" alt="" width="580" height="334" /></span></td>
  </tr>
</table>

<table width="100%"  border="0">
<tr>
          <td class="piepag">Cualquier inconveniente que tengas, crea tu tiquete a la Mesa Centro de Servicios Compartidos haciendo <a href="http://clienteinterno:9000/MesasAyuda/Categorias/113/Subcategorias/729/Productos/5122/Problemas/26165" style="color: #770003">clic aquí</a> y adjunta el pantallazo con el error.</td>
  </tr>
</table>
</body>

</html>
