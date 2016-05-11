<?php
@session_start();
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

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
$valordb = '1';
}
if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;
$valordb = '2';
}
if(isset($rowa['NOM_ADMIN'])){
$conn = $config;
$valordb = '3';
}
if(isset($rowt['NOM_ADMIN'])){
$conn = $configt;
$valordb = '4';
}

if(!isset($_SESSION['privi'])){
  
  header("location: index.php");

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
		<link rel="stylesheet" href="../development-bundle/themes/base/jquery.ui.all.css">
	<script src="../development-bundle/jquery-1.6.2.js"></script>
	<script src="../development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../development-bundle/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../css/demo.css">
	<link rel="stylesheet" href="../development-bundle/demos/demos.css">
	<script>
	function validar(){

if(document.formulario.from.value=="" || document.formulario.to.value==""){
	
	alert("Existen Campos Vacios");
	return false;

}else{
	confirmado = confirm("Desea generar el informe de este periodo?"); 
	if (confirmado) {
// si pulsamos en aceptar
	return true;
	}else {
// si pulsamos en cancelar
return false;
alert('Verifica de nuevo tus datos'); 
}  
}
}
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
	</script>
</head>
<body>
	<h3>Seleccione rango de fechas</h3>
	<hr>
<form name="formulario" action="recibe_reportemail.php" method="post" onSubmit="return validar();">
</br>
<div class="demo">

<label for="from">Desde</label>
<input type="text" id="from" name="from"/>
<label for="to">Hasta</label>
<input type="text" id="to" name="to"/>

</div>
</br>

  <input type="hidden" name="valordb" value="<?php echo $valordb;?>">
  <div>
   <input type="submit" value="Generar" />
  </div>
</form>
</body>
</html>