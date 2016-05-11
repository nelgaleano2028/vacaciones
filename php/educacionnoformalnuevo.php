		<?php require_once "functions.class.php";
	$ctl = new Catalogos();?>
	<link rel="stylesheet" href="../css/jquery.ui.all.css">
	<link type="text/css" href="../js/chosen/chosen.css" rel="stylesheet" />
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script type='text/javascript' src='../js/jquery-ui-1.8.17.custom.min.js'></script>
        <script type='text/javascript' src='../js/funciones.js'></script>
	<script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
	<script src="../js/jquery.ui.core.js"></script>
	<script src="../js/jquery.ui.widget.js"></script>
	<script src="../js/jquery.ui.button.js"></script>
	<link rel="stylesheet" href="../css/demos.css">
<!--boton-->
<!--boton-->
	<script>
	$(function() {
		llenar_combo("estudios","12","ajax_catalogos.php");
		llenar_combo("paises","14","ajax_catalogos.php");
		llenar_combo("titulo","13","ajax_catalogos.php");
		llenar_combo("entidades","15","ajax_catalogos.php");
		llenar_combo("ciudades","10","ajax_catalogos.php");
		llenar_combo("area","16","ajax_catalogos.php");
		llenar_combo("modalidad","17","ajax_catalogos.php");
		llenar_combo("unidadtiemp","18","ajax_catalogos.php");
		llenar_combo("evento","21","ajax_catalogos.php");
		llenar_combo("curso","20","ajax_catalogos.php");
		
		$( "input:submit, a, button", ".demo" ).button();
		$( "a", ".demo" ).click(function() { return false; });
		
		
		$("#Enviarno").click(function(event){
			
			if($("#estudios").val() == "-1" ||
			   $("#evento").val() == "-1" ||
			   $("#curso").val() == "" ||
			   $("#area").val() == "-1" ||
			   $("#modalidad").val() == "-1" ||
			   $("#fechaini").val() == "" ||
			   $("#fechafin").val() == "" ||
			   $("#tiempo").val() == "" ||
			   $("#unidadtiemp").val() == "-1" ||
			   $("#entidades").val() == "-1" ||
			   $("#paises").val() == "-1" ||
			   $("#ciudades").val() == "-1" ) {
				

                                $("#validacion3").css({'background' : '#FFEBE8', 'border' : '1px solid #DD3C10','line-height' : '15px','margin':'10px 0 0 0','text-align':'center','overflow':'hidden'});
				
				
				 $("#validacion3").html("<p>Debes completar todos los campos.</p>");
			}else{
			 $.ajax({
				 type: 'POST', 
                                 url: "ajax_no_formal.php",
                                 data: $('#formno').serialize(),
				 success: function(data) {
					alert(data);
					$("#validacion3").removeAttr("style")
					$("#validacion3").html(" ");
					}
				});
			}
			})
	});
	</script>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
body,td,th {
	font-size: 12px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.left {
	font-style: italic;
}
</style>
<form id="formno" name="formno" method="post">
	<div id="validacion3"></div>
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="7">
    <tr>
        <td colspan="2">Nuevo Registro de educacion no formal:</td>
        </tr>
      <tr>
        <td bgcolor="#EAEAEA">Evento
          <label for="evento"></label>
          <select name="evento" id="evento"></select></td>
	<td bgcolor="#EAEAEA">
	</td>
      </tr>
      <tr>
	<td colspan="2" bgcolor="#EAEAEA">Curso
          <select name="curso" id="curso"></select></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Area 
          <select name="area" id="area"></select></td>
        <td bgcolor="#EAEAEA">Modalidad
          <select name="modalidad" id="modalidad"></select></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Fecha Inicio 
          <input type="text" name="fechaini"  class="calendar_option" /></td>
        <td bgcolor="#EAEAEA"><label for="tipovinculo"></label>
          Fecha Fin
          <input type="text" name="fechafin"  class="calendar_option"/></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Tiempo
          <input type="text" name="tiempo" id="tiempo" onkeydown="return validarnum(event)" /></td>
        <td bgcolor="#EAEAEA">Unidad de Tiempo
          <select name="unidadtiemp" id="unidadtiemp"></select></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#EAEAEA">Entidad
          <select name="entidades"  id="entidades"></select></td>
        
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">País
          <select name="paises" id="paises"></select></td>
        <td bgcolor="#EAEAEA">Ciudad
          <select name="ciudades" id="ciudades" ></select></td>
      </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#EAEAEA"><div class="demo"><input name="Enviar" class="boton" type="button" id="Enviarno" value="Enviar"/></div></td>
      </tr>
      <tr>
        
        </tr>
    </table></td>
  </tr>
</table>
        </form>