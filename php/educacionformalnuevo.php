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
	<script>
	$(function() {
		llenar_combo("estudios","12","ajax_catalogos.php");
		llenar_combo("pais","14","ajax_catalogos.php");
		llenar_combo("titulo","13","ajax_catalogos.php");
		llenar_combo("entidad","15","ajax_catalogos.php");
		llenar_combo("ciudad","10","ajax_catalogos.php");
		llenar_combo("tiempouni","18","ajax_catalogos.php");
		$( "input:submit, a, button", ".demo" ).button();
		$( "a", ".demo" ).click(function() { return false; });
		
		
		
		
		$(document).ready(function(){
			
			$(".radio").click(function(event){ if($(this).is(":checked")){
			      if($(this).val() == "si"){
				      $("#fechafin").attr('disabled','disabled');
			      }else{
				      $("#fechafin").removeAttr('disabled');
			      }
		        }
		        });
			
			
			
		 $("#Enviarform").click(function(event){
			
			if($("#estudios").val() == "-1" ||
			   $("#titulo").val() == "-1" ||
			   $("#fechaini").val() == "" ||
			   $("#ciudad").val() == "-1" ||
			   $("#pais").val() == "-1" ||
			   $("#entidad").val() == "-1" ||
			   $("#tiempouni").val() == "-1" ||
			   $("#tiempo").val() == "") {
				

                                $("#validacion2").css({'background' : '#FFEBE8', 'border' : '1px solid #DD3C10','line-height' : '15px','margin':'10px 0 0 0','text-align':'center','overflow':'hidden'});
				
				
				 $("#validacion2").html("<p>Debes completar todos los campos.</p>");
			}else{
			 $.ajax({
				 type: 'POST', 
                                 url: "ajax_formal.php",
                                 data: $('#formform').serialize(),
				 success: function(data) {
					alert(data);
					$("#validacion2").removeAttr("style")
					$("#validacion2").html(" ");
					}
				});
			}
			})
	        });
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
<form id="formform" name="formform" method="post">
	<div id="validacion2"></div>
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="7">
    <tr>
        <td colspan="2">Nuevo Registro de educacion formal:</td>
        </tr>
      <tr>
        <td bgcolor="#EAEAEA">Estudios
          <label for="estudios"></label>
	  <select name="estudios" id="estudios"></select>
          </td>
        <td bgcolor="#EAEAEA"></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Titulo
	<select name="titulo" id="titulo"></select>
          </td>
        <td bgcolor="#EAEAEA">Fecha Inicio
          <input type="text" name="fechaini" id="fechaini" class="calendar_option"/></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Estudia Actualmente? Si 
          <input type="radio" name="radio" class="radio" id="si" value="si" />
          <label for="si"></label>
          No
          <input name="radio" type="radio" class="radio" id="no" value="no" />
          <label for="no"></label></td>
        <td bgcolor="#EAEAEA"><label for="tipovinculo"></label>
          Fecha Fin
          <input type="text" name="fechafin" id="fechafin" class="calendar_option"/></td>
      </tr>
        <tr>
        <td bgcolor="#EAEAEA">Ciudad
	<select name="ciudad" id="ciudad"></select></td>
        <td bgcolor="#EAEAEA">País
	<select name="pais" id="pais" ></select>
          </td>
      </tr>
      <tr>
        <td colspan="2"  bgcolor="#EAEAEA">Entidad
	<select name="entidad" id="entidad" ></select>
         </td>
      </tr>
       <tr>
        <td  bgcolor="#EAEAEA">Tiempo Unidad
          <select name="tiempouni" id="tiempouni"></select></td>
	<td bgcolor="#EAEAEA">Tiempo : <input type="text" name="tiempo" id="tiempo" /></td>
      </tr>
    
      <tr>
        <td colspan="2" align="center" bgcolor="#EAEAEA"><div class="demo"><input name="Enviarform" class="boton" type="button" id="Enviarform" value="Enviar"/></div></td>
      </tr>
      <tr>
        
        </tr>
    </table></td>
  </tr>
</table>
        </form>