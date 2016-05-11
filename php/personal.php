<?php @session_start(); ?> 
<?php
include_once('../lib/connection.php');
include_once('../lib/configdb.php');

 $id=$_SESSION['cod'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title></title>
    <link rel="stylesheet" href="../development-bundle/themes/ui-lightness/jquery.ui.all.css">
    <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
	<script src="../js/jquery.js"></script>
	<script src="../development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../development-bundle/ui/jquery.ui.button.js"></script>
	<script src="../development-bundle/ui/jquery.ui.position.js"></script>
	<script type='text/javascript' src='../js/jquery.autocomplete.js'></script>
    <script src="../development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script src="../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../js/tcal.js"></script> 
	<link rel="stylesheet" href="../development-bundle/demos/demos.css">
        <link rel="stylesheet" type="text/css" href="../css/jquery.autocomplete.css" />
    <style>
	.ui-button { margin-left: -1px; }
	.ui-button-icon-only .ui-button-text { padding: 0.35em; } 
	.ui-autocomplete-input { margin: 0; padding: 0.48em 0 0.47em 0.45em; }
	</style>
        <script type="text/javascript">
$().ready(function() {
	$("#ciudad").autocomplete("c_get_course_list.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
</script>
        <script type="text/javascript">
$().ready(function() {
	$("#ciudadre").autocomplete("c_get_course_list.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
</script>
	<script>
	$(function() {
		$( "input:submit, a, button", ".demo" ).button();
		$( "a", ".demo" ).click(function() { return false; });
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker2" ).datepicker();
	});
	</script>
        <script>
	$(function() {
		$( "#datepicker3" ).datepicker();
	});
	</script>
    <script>
         $(document).ready(function() {
              $("#personal").validate({
                rules: {
                  fechauno : "required",
				  hijos : {required: true,number: true},
				  ciudad : "required",
				  ciudadre : "required",
				  direccion : "required",
				  genero : "required",
				  telefono : {required: true,number: true},
				  celular : {required: true,number: true},
				  email : {required: true,email: true},
				  estudios : "required",
				  civil : "required",
				  sanguineo : "required"
                },
                messages: {
                  fechauno : "Fecha Validada",
				  hijos : "Solo Numeros",
				  ciudad : "Falta por llenar",
				  ciudadre : "Falta por llenar",
				  direccion : "Falta por llenar",
				  genero : "Falta por llenar",
				  telefono : "Solo Numeros",
				  celular : "Solo Numeros",
                  email : "Email no Valido",
				  estudios : "Falta por llenar",
				  civil : "Falta por llenar",
				  sanguineo : "Falta por llenar"
                }
              });
            });
        </script>
        	<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>
                <style>
            .error-message, label.error {
                color: #ff0000;
                margin:0;
                display: inline;
                font-size: 1em !important;
                font-weight:lighter;
            }
                </style>
<style type="text/css">
<!--
body {
	margin-left: 20px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo4 {font-size: 1.5em}
.Estilo6 {font-size: 1em}
.Estilo7 {color: #FF0000}
-->
</style></head>
<body>
<?php
global $conn;

$sql = "SELECT A.COD_EPL as ESTADO_CIVIL, A.FEC_NAC AS FEC_NAC,B.NOM_CIU AS CIUNAC, F.NOM_CIU AS CIUVIVE, A.DIR_EPL2 AS DIR_EPL2, A.TEL_2 AS TEL_2,
A.CELULAR AS CELULAR, A.SEXO AS SEXO, A.EMAIL AS EMAIL,D.NOM_NIE AS NOM_NIE, A.NUM_HJO AS NUM_HJO, E.EST_CIV AS EST_CIV, A.LIB_MIL AS LIB_MIL,
CLASE_LIB AS CLASE_LIB, A.GRU_SAN AS GRU_SAN, A.CIU_NAC AS CIU_NAC, A.COD_CIU AS COD_CIU, A.COD_NIE AS COD_NIE, A.COD_CIV AS COD_CIV
FROM EMPLEADOS_GRAL A , CIUDADES B ,CIUDADES F , NIVEL_ED D , ESTADO_CIVIL E
WHERE A.COD_EPL = '$id'
AND A.COD_CIU = B.COD_CIU
AND A.COD_CIV = E.COD_CIV
AND A.COD_CIU = F.COD_CIU
AND A.COD_NIE = D.COD_NIE";

$rs = $conn->Execute($sql);
while($fila = $rs->FetchRow()){
            
	    $fecha = $fila["FEC_NAC"];
	    $ciudad = $fila["CIUNAC"];
	    $nomciudad = $fila["CIUNAC"];
	    $codciu = $fila["COD_CIU"];
	    $codvive = $fila["CIUVIVE"];   
	    $direccion = $fila["DIR_EPL2"];
	    $barrio = $fila["COD_BAR"];
	    $nombarrio = $fila["NOM_BAR"];
	    $telefono = $fila["TEL_2"];
	    $celular = $fila["CELULAR"];
	    $genero = $fila["SEXO"];
	    if($fila["SEXO"] == 'F'){
		  $nomgenero = 'Femenino';
		}else{
		   $nomgenero = 'Masculino';
		}
		    
		$email = $fila["EMAIL"];
		$codnie = $fila["COD_NIE"];
		$nomnie = $fila["NOM_NIE"];
	        $hijo = $fila["NUM_HJO"];
		$civ = $fila["COD_CIV"];
		$nomciv = $fila["EST_CIV"];
		$militar = $fila["LIB_MIL"];
		$claselib = $fila["CLASE_LIB"];
		$sanguineo = $fila["GRU_SAN"];
}

?>
<form name="personal" id="personal" method="post" action="insertar_personal.php">
  <table width="800" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><table width="1000" border="1" cellspacing="0" cellpadding="0">
      <tr>
          <td colspan="3"><span class="Estilo4">Información Personal</span></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          </tr>
        <tr>
          <td width="361"><div class="demo">
            <p><span class="ui-widget Estilo6"><span class="Estilo7">*</span> Fecha de Nacimiento :</span>  
              <input name="fechauno" type="text" class="tcal" value="<?php echo $fecha;?>" size="7" />
              <span class="Estilo7">Ej: 2011/11/02</span></p>

</div></td>
          <td><div class="demo1">
            <div class="ui-widget">
              <label> <span class="Estilo7">*</span> Grupo Sanguineo: </label>
              <select name="sanguineo">
                <option value="<?php echo @$sanguineo ?>" selected><?php echo @$sanguineo; ?></option>
                <option value="O-">O-</option>
                <option value="O+">O+</option>
                <option value="A-">A-</option>
                <option value="A+">A+</option>
                <option value="B-">B-</option>
                <option value="B+">B+</option>
                <option value="AB-">AB-</option>
                <option value="AB+">AB+</option>
              </select>
            </div>
          </div></td>
          <td><div class="demo1">
            <div class="ui-widget">
              <label><span class="Estilo7">*</span> Género : </label>
              <select name="genero">
                <option value="<?php echo @$genero ?>" selected><?php echo @$nomgenero; ?></option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
              </select>
            </div>
          </div></td>
        </tr>
        <tr>
          <td>
          &nbsp;
          </td>
          </tr>
        <tr>
          <td><div id="content">

		<p>
			<span class="Estilo7">*</span>Ciudad
			<label>:</label>
			<input type="text" name="ciudad" id="ciudad" value="<?php echo @$nomciudad; ?>" onkeyup = "this.value=this.value.toUpperCase()" />
		</p>

</div></td>
          <td width="326"><div id="content">

		<p>
			<span class="Estilo7">*</span>Ciudad Residencia
			<label>:</label>
			<input type="text" name="ciudadre" id="ciudadre" value="<?php echo @$codvive; ?>" onkeyup = "this.value=this.value.toUpperCase()" />
			<!--input type="button" value="Get Value" /--></p>

</div></td>
          <td width="305"> <span class="Estilo7">*</span> Direccion :  
              <input name="direccion" type="text" id="direccion" value="<?php echo @$direccion; ?>">

</div></td>
        </tr>
  
          <td colspan="3">&nbsp;</td>
   
        <tr>
          <td><span class="Estilo7">*</span> No. de Hijos:
            <input name="hijos" type="text" id="hijos" value="<?php echo @$hijo; ?>"></td>
          <td> <span class="Estilo7">*</span> Teléfono :
            <input name="telefono" type="text" id="telefono" value="<?php echo @$telefono; ?>"></td>
          <td><span class="Estilo7">*</span> Celular :
            <input name="celular" type="text" id="celular" maxlength="10" value="<?php echo @$celular; ?>"></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td><span class="Estilo7">*</span> E-Mail :
            <input name="email" type="text" id="email" onkeyup = "this.value=this.value.toUpperCase()" value="<?php echo @$email; ?>"></td>
          <td><span class="ui-widget">
            <label><span class="Estilo7">*</span> Nivel de Estudios: </label>
            <select name="estudios">
              <option value="<?php echo @$codnie ?>" selected><?php echo @$nomnie; ?></option>
		<?php
		$qry1 = "SELECT COD_NIE , NOM_NIE
		FROM NIVEL_ED";

		$rs1 = $conn->Execute($qry1); 
		while($row1 = $rs1->fetchrow()){
			echo '<option value="'.$row1["COD_NIE"].'">'.$row1["NOM_NIE"].'</option>';
		}		
		?>
            </select>
          </span></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td>
          <div class="demo1">
	<div class="ui-widget">
	<label><span class="Estilo7">*</span> Estado Civil: </label>
	<select name="civil">
		<option value="<?php echo @$civ; ?>" selected><?php echo @$nomciv; ?></option>
<?php
		$qry1 = "SELECT COD_CIV , EST_CIV
		FROM ESTADO_CIVIL";

		$rs1 = $conn->Execute($qry1); 
		while($row1 = $rs1->fetchrow()){
			echo '<option value="'.$row1["COD_CIV"].'">'.$row1["EST_CIV"].'</option>';
		}		
		?>
		</select>
		</div></div>          </td>
          <td>Libreta Militar:
            <input name="libreta" type="text" id="libreta" value="<?php echo @$militar; ?>"></td>
          <td>Clase:
            <input name="clase" type="text" id="clase" size="2" onkeyup = "this.value=this.value.toUpperCase()" value="<?php echo @$claselib; ?>"></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td>Certificado Judicial:            
            <input name="certificado" type="text" onkeyup = "this.value=this.value.toUpperCase()" id="certificado"></td>
          <td colspan="2"><div class="demo">
            <p><span class="ui-widget Estilo6">Vence :</span>
              <input name="fechatres" type="text" id="datepicker3">
              <span class="Estilo7">Ej: 2011/11/02 </span></p>

</div></td>
          </tr>
        <tr>
          <td colspan="3" class="Estilo7">NOTA: Los campos marcados con asterisco (*) son obligatorios</td>
        </tr>
        
        <tr>
          <td colspan="3">
          <div class="demo"><br><br><br>
          <input type="submit" value="Actualizar Datos"/>
          </div>          </td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>