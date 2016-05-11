		<?php require_once "functions.class.php";
                      require_once "class_empleado.php";
	$ctl = new Catalogos();
        
        $empleado= new empleado();
        $empleado->set_codigo(@$_SESSION["cod"]);
        $lista=$empleado->mostrar_no_formal_espe($_GET["tca"],$_GET["prc"],$_GET["mdc"],$_GET["area"]);?>
	<link rel="stylesheet" href="../css/jquery.ui.all.css">
	<link type="text/css" href="../js/chosen/chosen.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
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
		
		
		$("#Enviarnoactu").click(function(event){
			 $.ajax({
				 type: 'POST', 
                                 url: "ajax_no_formal.php",
                                 data: $('#formnoactuli').serialize(),
				 success: function(data) {
					alert(data);
					}
				});
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
<form id="formnoactuli" name="formnoactuli" method="post">
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="7">
    <tr>
        <td colspan="2">Nuevo Registro de educacion no formal:</td>
        </tr>
      <tr>
        <td bgcolor="#EAEAEA">Evento : <?php echo $lista[0]["desc_tca"];?><br>
          <label for="evento"></label>
          
		  <input type="hidden" name="evento" value="<?php echo $_GET["tca"];?>"/>
		  </td>
	<td bgcolor="#EAEAEA">
	</td>
      </tr>
      <tr>
	    <td colspan="2" bgcolor="#EAEAEA">Curso : <?php echo $lista[0]["desc_prc"];?><br>
		<input type="hidden" name="curso" value="<?php echo $_GET["prc"];?>"/>
          </td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Area : <?php echo $lista[0]["desc_area"];?><br>
		<input type="hidden" name="area" value="<?php echo $_GET["area"];?>"/>
          </td>
        <td bgcolor="#EAEAEA">Modalidad : <?php echo $lista[0]["desc_mdc"];?><br>
		<input type="hidden" name="modalidad" value="<?php echo $_GET["mdc"];?>"/>
          </td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Fecha Inicio 
          <input type="text" name="fechaini" id="fechaini" class="calendar_option" value="<?php echo $lista[0]["inicial"];?>"/></td>
        <td bgcolor="#EAEAEA"><label for="tipovinculo"></label>
          Fecha Fin
          <input type="text" name="fechafin" id="fechafin" class="calendar_option" value="<?php echo $lista[0]["final"];?>"/></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Tiempo
          <input type="text" name="tiempo" id="tiempo" onkeydown="return validarnum(event)" value="<?php echo $lista[0]["tiempo"];?>"/></td>
        <td bgcolor="#EAEAEA">Unidad de Tiempo : <?php echo $lista[0]["nom_uni"];?><br>
          <select name="unidadtiemp" id="unidadtiemp"></select></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#EAEAEA">Entidad : <?php echo $lista[0]["entidad"];?><br>
          <select name="entidades"  id="entidades"></select></td>
        
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">País : <?php echo $lista[0]["nom_pai"];?><br>
          <select name="paises" id="paises"></select></td>
        <td bgcolor="#EAEAEA">Ciudad : <?php echo $lista[0]["nom_ciu"];?><br>
          <select name="ciudades" id="ciudades" ></select></td>
      </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#EAEAEA"><div class="demo"><input name="Enviarnoactu" type="button" id="Enviarnoactu" value="Enviar"/></div></td>
      </tr>
   
    </table></td>
  </tr>
</table>
        </form>