	<?php
        @session_start();
        require_once "functions.class.php";
        require_once "class_empleado.php";
	$ctl = new Catalogos();
        $empleado= new empleado();
        $empleado->set_codigo(@$_SESSION["cod"]);
        $lista=$empleado->mostrar_familiar_espe(@$_GET["ced"]);
        ?>
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
		
		llenar_combo("parentesco","9","ajax_catalogos.php");
		llenar_combo("estcivil","8","ajax_catalogos.php");
		llenar_combo("nived","7","ajax_catalogos.php");
		llenar_combo("lugarnaci","10","ajax_catalogos.php");
		
		
		$( "input:submit, a, button", ".demo" ).button();
		$( "a", ".demo" ).click(function() { return false; });
	});
	
	  $(document).ready(function(){
		 $("#Enviar3").click(function(event){
			 $.ajax({
				 type: 'POST', 
                                 url: "ajax_familiar.php",
                                 data: $('#form3').serialize(),
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
<form id="form3" name="form3" method="post" >
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="7">
      <tr>
        <td colspan="2">Nuevo Familiar: </td>
        </tr>
      <tr>
        <td bgcolor="#EAEAEA">Nro Documento :
          <label for="nudocumento"></label><br>
          <input type="text" name="nudocumento" id="nudocumento" onkeydown="return validarnum(event);"  value="<?php echo $lista[0]["cedula"]; ?>"/></td>
        <td bgcolor="#EAEAEA">Nombre : <br>
          <input type="text" name="nombre" id="nombre" value="<?php echo $lista[0]["nombre"]; ?>"/></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Tipo de Documento : <?php echo $lista[0]["tipo_doc"]; ?><br>
          <select name="tidocumento" id="tidocumento">
		<option value="CC">CC</option>
		<option value="TI">TI</option>
		<option value="CE">CE</option>
		<option value="NU">NU</option>
		<option value="RC">RC</option>
		<option value="PA">PA</option>
		
	  </select></td>
        <td bgcolor="#EAEAEA">Apellidos :<br>
          <input type="text" name="apellidos" id="apellidos" value="<?php echo $lista[0]["apellido"]; ?>"/></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Parentesco: <?php echo $lista[0]["parentesco"]; ?><br>
	<select name="parentesco" id="parentesco" >
            <option value="0" selected="selected">pRUEBA</option>
            
        </select>
          </td>
        <td bgcolor="#EAEAEA">Sexo : <?php  if($lista[0]["sexo"] == "M"){ echo "Masculino";}elseif($lista[0]["sexo"] == "F"){ echo "Femenino";} ?><br>
          <select name="sexo" id="sexo">
		
		<option value="">Seleccione</option>
		<option value="F">Femenino</option>
		<option value="M">Masculino</option>
	  </select>
  	
	</td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Lugar de Nacimiento : <?php echo $lista[0]["ciudad"]; ?><br>
	<select name="lugarnaci" id="lugarnaci"></select>
          </td>
        <td bgcolor="#EAEAEA">Fecha de Nacimiento :<br>
          <input type="text" name="fechanaci" class="calendar_option" id="fechanaci" value="<?php echo $lista[0]["fecha_naci"]; ?>"/></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Estado Civil : <?php echo $lista[0]["estado"]; ?><br>
	<select name="estcivil" id="estcivil"></select>
          </td>
        <td bgcolor="#EAEAEA">Ocupación :<br>
          <input type="text" name="ocupacion" id="ocupacion" value="<?php echo $lista[0]["ocupacion"];?>"/></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Nivel Educativo : <?php echo $lista[0]["nom_nie"]; ?><br>
	<select name="nived" id="nived" ></select>
          </td>
        <td bgcolor="#EAEAEA">Tipo de Vinculo : <?php if($lista[0]["tipo_vinculo"] == "B"){echo "Beneficiario";}elseif($lista[0]["tipo_vinculo"] == "D"){echo "Dependiente";}elseif($lista[0]["tipo_vinculo"] == "Ambos"){echo "Ambos";} ?><br>
          <select name="tipovinculo" id="tipovinculo">
            <option value="#" selected="selected">Seleccione</option>
            <option value="D">Dependiente</option>
            <option value="B">Beneficiario</option>
            <option value="X">Ambos</option>
          </select></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Beneficiario Auxilio : <?php if($lista[0]["tipo_fam"]== "S"){ echo "Si";}elseif($lista[0]["tipo_fam"]== "N"){echo "No";}?><br>
          
	 <select name="benauxilio" id="benauxilio">
		<option value="">Seleccione</option>
		<option value="S">Si</option>
	        <option value="N">No</option>
	  </select>
	
	</td>
        <td bgcolor="#EAEAEA">Discapacitado : <?php if($lista[0]["discapacitado"]== "S"){ echo "Si";}elseif($lista[0]["discapacitado"]){echo "No";} ?><br>
          <select name="discapacitado" id="discapacitado">
		<option value="">Seleccione</option>
		<option value="S">Si</option>
	        <option value="N">No</option>
	  </select>
	</td>
      </tr>
      <tr>
	 <td bgcolor="#EAEAEA">Estudia Actualmente? : <?php  if($lista[0]["estudia"]== "S"){echo "Si";}elseif($lista[0]["estudia"]== "N"){ echo "No";} ?><br>
	 
	 Si
         
         <?php if($lista[0]["estudia"] == "N"){
                   
                   $checkn='checked="checked"';
            }elseif($lista[0]["estudia"] == "S"){
                $checks='checked="checked"';
            }
            ?>
          <input type="radio" name="radio" id="si" value="S"  <?php echo $checks; ?>/>
          <label for="si"></label>
          No
          <input name="radio" type="radio" id="no" value="N" <?php echo $checkn; ?>/>
          <label for="no"></label></td>
	 <td bgcolor="#EAEAEA"></td>
      </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#EAEAEA"><div class="demo"><input name="Enviar3" type="button" id="Enviar3" value="Enviar"/></div></td>
      </tr>
      
    </table></td>
  </tr>
</table>
        </form>