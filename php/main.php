<?php
session_start();

if (empty($_SESSION['cod'])){

  header("location: index.php");
}

if (isset($_SESSION['cod'])){
		@$_SESSION['cod'];//esta
		@$_SESSION['cor'];//      
        @$_SESSION['nom'];//esta
		@$_SESSION['ape'];//
		@$_SESSION['jef'];//esta
		@$_SESSION['crg'];//
	
}elseIF($_SESSION['ouf']=='valor'){
header ("Location:outside.php?ou=1");

}elseIF($_SESSION['out']=='sinvalor'){
header ("Location:outside.php");
}

include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

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


if(isset($rowf['CONTEO'])){
	$conn = $configf;
}
if(isset($rowc['CONTEO'])){
	$conn = $configc;
}
if(isset($rowa['CONTEO'])){
	$conn = $config;
}
if(isset($rowt['CONTEO'])){
	$conn = $configt;
}
//------------------------------FIN antidoto

$ididen = $_SESSION['cod'];

//-- VALIDACION TIPO EMPLEADOS

@$valor = $_GET["valor"];

$query156 = "select count(*) AS VALOR from epl_grupos where cod_gru in(3,5) and cod_epl = '$ididen'";
$rs156 = $conn->Execute($query156);
	$row156 = $rs156->fetchrow();
	 $conti = $row156["VALOR"]; 
	 
	 //-- VALIDACION JEFES
	 
	 $incapadidadesf = "SELECT CEDULA AS CEDULA FROM JEFES WHERE NRO_CEDULA = '$codiepl'";
		$rs = $conn->Execute($incapadidadesf);
		$rowcon = $rs->fetchrow();
		@$contrasena_jefe = $rowcon['CEDULA'];
		
			 //-- VALIDACION HORAS EXTRAS
	 
	 $horasext = "select count(*) AS VALOR from epl_grupos where cod_gru in(SELECT VAR_CARAC FROM PARAMETROS_NUE WHERE NOM_VAR ='t_gru_he') 
and cod_epl = '$ididen'";
		$rs = $conn->Execute($horasext);
		$rowho = $rs->fetchrow();
		@$rowhoras = $rowho['VALOR'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"> 
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>.:Auto Gestion Nomina:.</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<script src="../js/jquery-1.7.1.min.js"></script>
<!--[if lt IE 10]>
<script type="text/javascript" src="../PIE/PIE.js"></script>
<![endif]-->

<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
<![endif]-->

<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->


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
	color: #FFF;
}
a:linkba {
	text-decoration: none;
	color: #333
}
a:visited {
	text-decoration: none;
	color: #FFF;
}
a:hover {
	text-decoration: none;
	color: #FFF;
}
a:active {
	text-decoration: none;
	color: #FFF;
}
a {
	font-weight: bold;
}


</style>


</head>
<body class="barramenu content_1 content">
  <table width="100%" border="0" height="auto">
    <tr>
      <td height="auto" valign="top"><table width="100%" border="0" height="auto">
        <tr>
<?php if( $conti<=0){
         echo '  <td width="100%" height="145" colspan="10" class="monitores">';
}else{
	 echo '  <td width="100%" height="145" colspan="7" class="monitores">';
} ?>
		  <strong><?PHP echo @$_SESSION['nom'];?> ||</strong>
    <a href="cerrar.php" class="linkba" style="color: black;">Cerrar sesi&oacute;n</a></td>
        </tr>
         <tr>
        <td width="14%" height="48" class="comprobantes"><a href="equipodenomina.php" target="mainFrame">Equipo de Nomina</a></td>
          <td width="9%" height="48" class="hv"><a href="inicio.php" target="mainFrame">Inicio</a></td>		  
          <td width="14%" height="48" class="hv"><a href="configcertificado.php" target="mainFrame">Certificado Laboral</a></td>
          <td width="14%" height="48" class="comprobantes"><a href="pagos.php" target="mainFrame">Comprobantes de Pago</a></td>
        <td width="14%" height="48" class="certificados"><a href="certificado.php" target="mainFrame">Certificado de Ingresos y Retenciones</a></td>
	   <?php if( $conti<=0){
		echo ' <td width="14%" height="28" class="vacaciones"><a href="prevacaciones.php" target="mainFrame">Vacaciones</a></td>';} ?>
		<?php if(isset($contrasena_jefe) || $rowhoras>0){
		echo ' <td width="14%" height="28" class="vacaciones"><a href="prehorasext.php?valor='.$rowhoras.'" target="mainFrame">Trabajo por Turnos</a></td>';} ?>
		<?php if (isset ($contrasena_jefe)){
		echo ' <td width="14%" height="28" class="vacaciones"><a href="preincapacidades.php" target="mainFrame">Incapacidades</a></td>';} ?>
	  <td width="14%" height="48" class="certificados"><a href="actu_lab.php" target="mainFrame">Actualidad Laboral</a></td>
	  	  <td width="14%" height="48" class="certificados"><a href="crono.php" target="mainFrame">Cronograma Cierre de Nomina</a></td>
      </tr>
        <tr>
           <?php if( $conti<=0){
		echo '<td id="content" height="450" colspan="10">';}else{
			echo '<td id="content" height="450" colspan="7">';} ?>
        <div class="overview"><iframe src="<?php if($valor == 1){echo "vacaciones.php";}else{echo "inicio.php";} ?>"  name="mainFrame" width="100%" height="450px"  scrolling="auto" frameborder="0" id="mainFrame"></iframe></div> </td>
        </tr>
                
      </table></td>
    </tr>
  </table>
</body>
</html>