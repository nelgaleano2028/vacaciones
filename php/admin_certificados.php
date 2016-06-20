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
$flag = '1';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
<head>

<!--FUNCION SOLO NUMEROS-->
        <script type="text/javascript">
		function validarnum(e) {
		tecla = (document.all) ? e.keyCode : e.which;
		if (tecla==8 || e.keyCode==9) return true;
		patron = /\d/;
		te = String.fromCharCode(tecla);
		return patron.test(te);
		}
		</script>
		<SCRIPT language="JavaScript" type="text/javascript">
function contador (campo, cuentacampo, limite) {
if (campo.value.length > limite) campo.value = campo.value.substring(0, limite);
else cuentacampo.value = limite - campo.value.length;
}
</script>


<script type="text/javascript">

function preguntaR() {	// MENSAJE PARA PERSONAL CON MAS DE UN REINTEGRO.
var cedula2 = $("#cedula2").val();
	$.ajax({
		url: "admin_generacion_retirados_copia.php",
		type : "POST",
		cache:false,
		data : "cedula2="+cedula2,
		success: function(data){
			if(data=='1'){
				alert("Tenga en cuenta que esta persona tiene más de un registro en la BD como empleado retirado");
			}
		}				  
	});
}
function pregunta() {	// MENSAJE PARA PERSONAL CON MAS DE UN REINTEGRO.
var cedula = $("#cedula").val();
	$.ajax({
		url: "admin_generacion_copia.php",
		type : "POST",
		cache:false,
		data : "cedula="+cedula,
		success: function(data){
			if(data=='1'){
				alert("Tenga en cuenta que esta persona tiene mas de un registro en la BD como empleado retirado");
			}	
		}				  
	});
}
</script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
          <link rel="stylesheet" type="text/css" href="../css/estilo_gral.css" />
	  <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
          <script src="../js/jquery-1.7.1.min.js"></script>
          <script type='text/javascript' src='../js/jquery-ui-1.8.17.custom.min.js'></script>
          <script type='text/javascript' src='../js/funciones.js'></script>
	  
	  
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
<script type="text/javascript">
            			
$(function() {
    if (window.PIE) {
        $('.rounded').each(function() {
            PIE.attach(this);
        });
    }
});
</script>

</head>

<body>

<table border="0" width="100%">
	<tr>
		<td align="center">
			<span style="font-size:18px; font-weight:bold;">ACTIVOS</span>
		</td>
	</tr>		
<table>

<br />
<br />
<?php
//configuracion para seleccionar destino de cartas

if(isset($flag)){

?>
<form action="admin_generacion2.php" method="post" target="blank">
<fieldset style="width: 460px; margin:0 auto 0 auto; border-radius: 5px;"><legend><h2 >Que deseas incluir en el certificado laboral</h2></legend>
<br />
<br />

<span style="font-weight:bold">Ingrese Cedula o Código: <input type="text" id="cedula" name="cedula" /></span><br /><br />

<input type="radio" value="opcion3" name="certificado"/>Certificado normal con salario con firma
<br /><br />
<input type="radio" value="opcion4" name="certificado"/>Certificado normal con salario sin firma
<br /><br />
<input type="radio" value="opcion2" name="certificado"/>Certificado normal sin salario con firma
<br /><br />
<input type="radio" value="opcion1" name="certificado"/>Certificado normal sin salario sin firma
<br /><br />
<span style="font-weight:bold">A quien va dirigido:</span> <input type="text" name="destino" onKeyDown="contador(this.form.destino,this.form.remLen,50);" onKeyUp="contador(this.form.destino,this.form.remLen,50); this.value=this.value.toUpperCase();"></br>
                 <p align= 'center'> Solo escribe 
                  <input readonly maxlength="3" size="3" name="remLen" value="50" type="text" /> caracteres</p>
<br /><br />
<center>
<INPUT id="boton" class="boton" TYPE="submit" NAME="ok" onclick="pregunta()" VALUE="Generar">
</center>
</fieldset>
</form>

<br />
<br />
<br />
<br />

<table border="0" width="100%">
	<tr>
		<td align="center">
			<span style="font-size:18px; font-weight:bold;">RETIRADOS</span>
		</td>
	</tr>		
<table>

<br />
<br />



<form action="admin_generacion_retirados2.php" method="post" target="blank">
<fieldset style="width: 460px; margin:0 auto 0 auto; border-radius: 5px;"><legend><h2 >Que deseas incluir en el certificado laboral</h2></legend>
<br />
<br />

<span style="font-weight:bold">Ingrese Cedula o Código: <input type="text" id="cedula2" name="cedula2" /></span><br /><br />

<input type="radio" value="opcion3" name="certificado"/>Certificado normal con salario con firma
<br /><br />
<input type="radio" value="opcion4" name="certificado"/>Certificado normal con salario sin firma
<br /><br />
<input type="radio" value="opcion2" name="certificado"/>Certificado normal sin salario con firma
<br /><br />
<input type="radio" value="opcion1" name="certificado"/>Certificado normal sin salario sin firma
<br /><br />
<span style="font-weight:bold">A quien va dirigido:</span> <input type="text" name="destino" onKeyDown="contador(this.form.destino,this.form.remLen,50);" onKeyUp="this.value=this.value.toUpperCase(); contador(this.form.destino,this.form.remLen,50);"></br>
                 <p align= 'center'> Solo escribe 
                  <input readonly maxlength="3" size="3" name="remLen" value="50" type="text" /> caracteres</p>
<br /><br />
<center>
<INPUT id="boton" class="boton" TYPE="submit" NAME="ok" onclick="preguntaR()" VALUE="Generar">
</center>
</fieldset>
</form>

<?php
}else{
	?>
<form action="admin_generacion.php" method="post" target="blank">
<fieldset style="width: 460px; margin:0 auto 0 auto; border-radius: 5px;"><legend><h2 >Que deseas incluir en el certificado laboral</h2></legend>
<br />
<br />

<span style="font-weight:bold">Ingrese Cedula o Código: <input type="text" id="cedula" name="cedula" /></span><br /><br />

<input type="radio" value="opcion3" name="certificado"/>Certificado normal con salario con firma
<br /><br />
<input type="radio" value="opcion4" name="certificado"/>Certificado normal con salario sin firma
<br /><br />
<input type="radio" value="opcion2" name="certificado"/>Certificado normal sin salario con firma
<br /><br />
<input type="radio" value="opcion1" name="certificado"/>Certificado normal sin salario sin firma
<br /><br />
<span style="font-weight:bold">A quien va dirigido:</span> <input type="text" name="destino" onKeyDown="contador(this.form.destino,this.form.remLen,50);" onKeyUp="contador(this.form.destino,this.form.remLen,50); this.value=this.value.toUpperCase();"></br>
                 <p align= 'center'> Solo escribe 
                  <input readonly maxlength="3" size="3" name="remLen" value="50" type="text" /> caracteres</p>
<br /><br />
<center>
<INPUT id="boton" class="boton" TYPE="submit" NAME="ok" onclick="pregunta()" VALUE="Generar">
</center>
</fieldset>
</form>

<br />
<br />
<br />
<br />

<table border="0" width="100%">
	<tr>
		<td align="center">
			<span style="font-size:18px; font-weight:bold;">RETIRADOS</span>
		</td>
	</tr>		
<table>

<br />
<br />



<form action="admin_generacion_retirados.php" method="post" target="blank">
<fieldset style="width: 460px; margin:0 auto 0 auto; border-radius: 5px;"><legend><h2 >Que deseas incluir en el certificado laboral</h2></legend>
<br />
<br />

<span style="font-weight:bold">Ingrese Cedula o Código: <input type="text" id="cedula2" name="cedula2" /></span><br /><br />

<input type="radio" value="opcion3" name="certificado"/>Certificado normal con salario con firma
<br /><br />
<input type="radio" value="opcion4" name="certificado"/>Certificado normal con salario sin firma
<br /><br />
<input type="radio" value="opcion2" name="certificado"/>Certificado normal sin salario con firma
<br /><br />
<input type="radio" value="opcion1" name="certificado"/>Certificado normal sin salario sin firma
<br /><br />
<span style="font-weight:bold">A quien va dirigido:</span> <input type="text" name="destino" onKeyDown="contador(this.form.destino,this.form.remLen,50);" onKeyUp="this.value=this.value.toUpperCase(); contador(this.form.destino,this.form.remLen,50);"></br>
                 <p align= 'center'> Solo escribe 
                  <input readonly maxlength="3" size="3" name="remLen" value="50" type="text" /> caracteres</p>
<br /><br />
<center>
<INPUT id="boton" class="boton" TYPE="submit" NAME="ok" onclick="preguntaR()" VALUE="Generar">
</center>
</fieldset>
</form>
<?php } ?>
</body>
</html>

