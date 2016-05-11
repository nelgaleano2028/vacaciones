<?php @session_start();
        require_once "functions.class.php";
        require_once "class_empleado.php";
	$ctl = new Catalogos();
        $empleado= new empleado();
        $empleado->set_codigo(@$_SESSION["cod"]);
        $lista=$empleado->mostrar_formal_espe($_GET["tit"],$_GET["est"]);?>
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
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
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
			
		$(".radio").click(function(event){
                 if($(this).is(":checked")) {
	
	 	if($(this).val() == "si"){
			$("#fechafin").attr('disabled','disabled');		
		}else{
			
			$("#fechafin").removeAttr('disabled');

		}
	 }
   });
		 $("#Enviarform_actu").click(function(event){
			 $.ajax({
				 type: 'POST', 
                                 url: "ajax_formal.php",
                                 data: $('#formform_actu').serialize(),
				 success: function(data) {
					alert(data);
					}
				});
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
<form id="formform_actu" name="formform_actu" method="post">
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="7">
    <tr>
        <td colspan="2">Nuevo Registro de educacion formal:</td>
        </tr>
      <tr>
        <td bgcolor="#EAEAEA">Estudios:
          <label for="estudios"><?php echo $lista[0]["nombre"];?></label><br>
		  <input type="hidden" name="estudios" value="<?php echo $_GET["est"];?>"/>
	  
          </td>
        <td bgcolor="#EAEAEA">
        </td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Titulo: <?php echo $lista[0]["desc_ttp"];?><br>
		<input type="hidden" name="titulo" value="<?php echo $_GET["tit"];?>"/>
	
          </td>
        <td bgcolor="#EAEAEA">Fecha Inicio:<br>
          <input type="text" name="fechaini" class="calendar_option" id="fechaini"  value="<?php echo $lista[0]["inicial"];?>"/></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Estudia Actualmente? Si 
          <input type="radio" class="radio" name="radio" id="si" value="si" />
          <label for="si"></label>
          No
          <input name="radio" type="radio" class="radio" id="no" value="no" checked="checked" />
          <label for="no"></label></td>
        <td bgcolor="#EAEAEA"><label for="tipovinculo"></label>
          Fecha Fin: <br>
          <input type="text" name="fechafin" class="calendar_option" id="fechafin" value="<?php echo $lista[0]["final"];?>"/></td>
      </tr>
        <tr>
        <td bgcolor="#EAEAEA">Ciudad: <?php echo $lista[0]["ciudad"];?><br>
        
	<select name="ciudad" id="ciudad"></select></td>
        <td bgcolor="#EAEAEA">País: <?php echo $lista[0]["nom_pai"];?><br>
	<select name="pais" id="pais" ></select>
          </td>
      </tr>
      <tr>
        <td colspan="2"  bgcolor="#EAEAEA">Entidad: <?php echo $lista[0]["nom_enti"];?><br>
	<select name="entidad" id="entidad" ></select>
         </td>
      </tr>
       <tr>
        <td  bgcolor="#EAEAEA">Tiempo Unidad: <?php echo $lista[0]["nom_uni"];?><br>
          <select name="tiempouni" id="tiempouni"></select></td>
	<td bgcolor="#EAEAEA">Tiempo :<br> <input type="text" name="tiempo" id="tiempo" value="<?php echo $lista[0]["tiempo"];?>" /></td>
      </tr>
    
      <tr>
        <td colspan="2" align="center" bgcolor="#EAEAEA"><div class="demo"><input name="Enviarform_actu" type="button" id="Enviarform_actu" value="Enviar"/></div></td>
      </tr>
    
    </table></td>
  </tr>
</table>
        </form>