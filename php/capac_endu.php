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
	<title>Combo Aninado</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>	
	<link type="text/css" href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" />	
	<script type="text/javascript" charset="utf-8">
	  $(document).ready(function() {
	  // Parametros para el combo
	   $("#ano").change(function () {
	      $("#ano option:selected").each(function () {
	        elegido=$(this).val();
	        $.post("combo_mes.php", { elegido: elegido }, function(data){
	        $("#mes").html(data);
	      });     
	     });
	   });    
	});
	
	function validar(){

if(document.formulario.ano.value=="" || document.formulario.mes.value==""){
	
	alert("Existen Campos Vacios");
	return false;

}else{
	confirmado = confirm("Desea generar el informe de este periodo? solo tardara algunos minutos."); 
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
$(document).ready(function() {
	$(".botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});
});
</script>	
</head>
<body>
	<h3>Seleccione el periodo</h3>
	<hr>
<form class="form-horizontal" name="formulario" action="recibe_endeu.php" method="post" onSubmit="return validar();">
  <div class="control-group">
    <label class="control-label" for="ano">A&ntilde;o</label>
    <div class="controls">
        <select class="span3"  name="ano" id="ano" required>
          <option value="0">Seleccione...</option>
							<option value="01"><?php echo $anopas = date("Y")-1;?></option>
							<option value="02"><?php echo $anopas = date("Y");?></option>
          </select>
   </div>
  </div>  
  <div class="control-group">
    <label class="control-label" for="mes">Mes</label>
    <div class="controls">
        <select class="span3"  name="mes" id="mes" required>
        </select>
   </div>
  </div> 
  <input type="hidden" name="valordb" value="<?php echo $valordb;?>">
  <div>
   <input type="submit" value="Generar" />
  </div>
</form>
</body>
</html>