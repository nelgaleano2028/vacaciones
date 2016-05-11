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
	<link rel="stylesheet" href="../css/validacion.css" media="screen" />
<!--boton-->
	<script>
	$(function() {
		
		llenar_combo("parentesco","9","ajax_catalogos.php");
		llenar_combo("estcivil","8","ajax_catalogos.php");
		llenar_combo("nived","7","ajax_catalogos.php");
		llenar_combo("lugarnaci","10","ajax_catalogos.php");
		
		
		$( "input:submit, a, button", ".demo" ).button();
		$( "a", ".demo" ).click(function() { return false; });
	});
	
 $(document).ready(function(){
		 $("#Enviar2").click(function(event){
			
			if($("#nudocumento").val() == "" ||
			   $("#nombre").val() == "" ||
			   $("#apellidos").val() == "" ||
			   $("#parentesco").val() == "-1" ||
			   $("#sexo").val() == "" ||
			   $("#lugarnaci").val() == "-1" ||
			   $("#fechanaci").val() == "" ||
			   $("#estcivil").val() == "-1" ||
			   $("#nived").val() == "-1" ||
			   $("#tipovinculo").val() == "" ||
			   $("#benauxilio").val() == "" ||
			   $("#discapacitado").val() == "") {
				

                                $("#validacion").css({'background' : '#FFEBE8', 'border' : '1px solid #DD3C10','line-height' : '15px','margin':'10px 0 0 0','text-align':'center','overflow':'hidden'});
				
				
				 $("#validacion").html("<p>Debes completar todos los campos.</p>");
			}else{
			 $.ajax({
				 type: 'POST', 
                                 url: "ajax_familiar.php",
                                 data: $('#form2').serialize(),
				 success: function(data) {
					alert(data);
					$("#validacion").removeAttr("style")
					$("#validacion").html(" ");
					}
				});
			}
			return false;
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
<form id="form2" name="form2" method="post" >
	
<div id="validacion"></div>	
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="7">
      <tr>
        <td colspan="2">Nuevo Familiar: </td>
        </tr>
      <tr>
        <td bgcolor="#EAEAEA">Nro Documento
          <label for="nudocumento"></label>
          <input type="text" name="nudocumento" id="nudocumento" onkeydown="return validarnum(event);" /></td>
        <td bgcolor="#EAEAEA">Nombre
          <input type="text" name="nombre" id="nombre" /></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Tipo de Documento 
          <select name="tidocumento" id="tidocumento">
		<option value="CC">CC</option>
		<option value="TI">TI</option>
		<option value="CE">CE</option>
		<option value="NU">NU</option>
		<option value="RC">RC</option>
		<option value="PA">PA</option>
		
	  </select></td>
        <td bgcolor="#EAEAEA">Apellidos
          <input type="text" name="apellidos" id="apellidos" /></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Parentesco
	<select name="parentesco" id="parentesco" ></select>
          </td>
        <td bgcolor="#EAEAEA">Sexo 
          <select name="sexo" id="sexo">
		
		<option value="">Seleccione</option>
		<option value="F">Femenino</option>
		<option value="M">Masculino</option>
	  </select>
  	
	</td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Lugar de Nacimiento
	<select name="lugarnaci" id="lugarnaci"></select>
          </td>
        <td bgcolor="#EAEAEA">Fecha de Nacimiento 
          <input type="text" name="fechanaci" class="calendar_option" id="fechanaci" /></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Estado Civil
	<select name="estcivil" id="estcivil"></select>
          </td>
        <td bgcolor="#EAEAEA">Ocupación
          <input type="text" name="ocupacion" id="ocupacion" /></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Nivel Educativo
	<select name="nived" id="nived" ></select>
          </td>
        <td bgcolor="#EAEAEA">Tipo de Vinculo
          <select name="tipovinculo" id="tipovinculo">
            <option value="" selected="selected">Seleccione</option>
            <option value="D">Dependiente</option>
            <option value="B">Beneficiario</option>
            <option value="X">Ambos</option>
          </select></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Beneficiario Auxilio
          
	 <select name="benauxilio" id="benauxilio">
		<option value="">Seleccione</option>
		<option value="S">Si</option>
	        <option value="N">No</option>
	  </select>
	
	</td>
        <td bgcolor="#EAEAEA">Discapacitado
          <select name="discapacitado" id="discapacitado">
		<option value="">Seleccione</option>
		<option value="S">Si</option>
	        <option value="N">No</option>
	  </select>
	</td>
      </tr>
      <tr>
	 <td bgcolor="#EAEAEA">Estudia Actualmente? Si 
          <input type="radio" name="radio" id="si" value="S" />
          <label for="si"></label>
          No
          <input name="radio" type="radio" id="no" value="N" checked="checked" />
          <label for="no"></label></td>
	 <td bgcolor="#EAEAEA"></td>
      </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#EAEAEA"><div class="demo"><input name="Enviar2" class="boton" type="button" class="boton" id="Enviar2" value="Enviar"/></div></td>
      </tr>
      <tr>
        
        </tr>
    </table></td>
  </tr>
</table>
        </form>