<?php
@session_start();


if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
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

$codiepl = $_SESSION['cod'];

//configuracion para seleccionar destino de cartas
$sql =  "select fec_ant_emp_gru AS VALOR from empleados_gral WHERE COD_EPL = '$codiepl'";
$rs = $conn->Execute($sql);
$rowsq = $rs->fetchrow();

if(isset($rowsq['VALOR']) && isset($rowt['CONTEO'])){
	$pagina = 'certificadolaboralext2.php';
}else{
	$pagina = 'certificadolaboralext.php';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<SCRIPT language="JavaScript" type="text/javascript">

function contador (campo, cuentacampo, limite) {
if (campo.value.length > limite) campo.value = campo.value.substring(0, limite);
else cuentacampo.value = limite - campo.value.length;
}
</script>
	<style type="text/css">
@import url("../css/plantilla_user.css");
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
          <link rel="stylesheet" type="text/css" href="../css/estilo_gral.css" />
	  <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
          
          <script src="../js/jquery-1.7.1.min.js"></script>
          <script type='text/javascript' src='../js/jquery-ui-1.8.17.custom.min.js'></script>
          <script type='text/javascript' src='../js/funciones.js'></script>
	
	
</head>

<body>
	
<form action="<?php echo $pagina; ?>" method="post" Target="blank">

<br />
<br />
<br />
<fieldset style="width: 460px; margin:0 auto 0 auto; border-radius: 5px;"><legend><h2 >Que deseas incluir en el certificado laboral</h2></legend>

<p><input type="radio" value="opcion3" name="certificado"/>Certificado normal con salario</p>
<p><input type="radio" value="opcion2" name="certificado"/>Certificado normal sin salario</p>


<p>A quien va dirigido: <input type="text" name="destino" onKeyDown="contador(this.form.destino,this.form.remLen,50);" onKeyUp="this.value=this.value.toUpperCase(); contador(this.form.destino,this.form.remLen,50);"></br>
                 <p align= 'center'> Solo escribe 
                  <input readonly maxlength="3" size="3" name="remLen" value="50" type="text" /> caracteres</p></p>
<center>
<INPUT id="boton" class="boton" TYPE="submit" NAME="ok" VALUE="Generar">
</center>

</form>
</fieldset>
<table width="100%" height="165" border="0">
<tr>
<td height="50">
</td>
</tr>
<tr>
          <td class="piepag">Cualquier inconveniente que tengas, crea tu tiquete a la Mesa Centro de Servicios Compartidos haciendo <a href="http://clienteinterno:9000/MesasAyuda/Categorias/113/Subcategorias/729/Productos/5116/Problemas" style="color: #770003">clic aquí</a> y adjunta el pantallazo con el error.</td>
        </tr>
</table>
</body>
</html>

</body>
</html>
