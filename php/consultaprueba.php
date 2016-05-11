<?php
include_once('../lib/adodb/adodb.inc.php');
include_once('../lib/configdb.php');
include_once('querysimulador.php');

$salario = $_POST["salario"];
$ingresosala = $_POST["ingresosala"];
$auxilio = $_POST["auxilio"];
$prima = $_POST["prima"];
$auxiliotrans = $_POST["auxiliotrans"];
$bigpass = $_POST["bigpass"];
$bigpassrete = $_POST["bigpassrete"];
$vivienda = $_POST["vivienda"];
$prepag = $_POST["prepag"];
$dependien = $_POST["dependien"];
$pensionvol = $_POST["pensionvol"];
$aporterent = $_POST["aporterent"];
$otrasdeduc = $_POST["otrasdeduc"];
$radio = $_POST["radio"];
?>
			<script src="../js/jquery.min.js" type="text/javascript"></script>
          	<script src="../js/jquery.timer.js" type="text/javascript"></script>
			<script src="../js/jquery.easing.1.3.js" type="text/javascript"></script>
            <script src="../js/jquery.dwdinanews.0.1.js" type="text/javascript"></script>
            <script src="../js/jquery.validate.js"></script>

<script>

/*JS para banner de noticias*/
	$(document).ready(function(){
	$("#otrasnovedades").dwdinanews({
		retardo: 5000,
		tiempoAnimacion: 3000,
		funcionAnimacion: 'easeInOutElastic'
	});
})
	</script>
    <script>
         $(document).ready(function() {
              $("#form1").validate({
                rules: {
                  salario : "required",
				  ingresosala : "required",
				  auxilio : "required",
				  prima : "required",
				  auxiliotrans : "required",
				  bigpass : "required",
				  bigpassrete : "required",
				  vivienda : "required",
				  prepag : "required",
				  dependien : "required",
				  pensionvol : "required",
				  aporterent : "required",
				  otrasdeduc : "required",
                },
                messages: {
                  salario : "Falta por llenar",
				  ingresosala : "Falta por llenar",
				  auxilio : "Falta por llenar",
				  prima : "Falta por llenar",
				  auxiliotrans : "Falta por llenar",
				  bigpass : "Falta por llenar",
				  bigpassrete : "Falta por llenar",
				  vivienda : "Falta por llenar",
				  prepag : "Falta por llenar",
				  dependien : "Falta por llenar",
				  pensionvol : "Falta por llenar",
				  aporterent : "Falta por llenar",
				  otrasdeduc : "Falta por llenar",
                }
              });
            });

        //Función que permite solo Números
function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}
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
	body {
	font-family: tahoma, verdana, arial, sans-serif;
	font-size: 10px;
	}	
	#otrasnovedades{
	border: 1px solid #ccc;
	width: 98%;
	height: 120px;
	overflow: hidden;
	font-size: 1.4em;
	color: #666;
	}
	#otrasnovedades ul{
		margin: 0;
		padding: 0;
		position: relative;
		top: 0;
		left: 0;
	}
	#otrasnovedades li{
		margin: 0;
		padding: 10px;
		height: 90px;
		overflow: hidden;
		line-height: 14px;
	}
	#otrasnovedades li a{
		font-weight: bold;
		font-size: 1.2em;
	}
	
.inicio {
	
	border-top:1px solid #e5eff8;
	border-right:1px solid #e5eff8;
	}
.inicio caption {
	color: #666;
	font-style:oblique
	font-size:.94em;
		letter-spacing:.1em;
		margin:1em 0 0 0;
		padding:0;
		caption-side:top;
		text-align:center;
	}	
.inicio td {
	color:#678197;
	border-bottom:1px solid #e5eff8;
	border-left:1px solid #e5eff8;
	padding:.em 1em;
	font:12px Arial, Helvetica, sans-serif;
	}				
.inicio th {
	font-weight:normal;
	/*color: #678197;*/
	color: blue;
	text-align:left;
	border-bottom: 1px solid #e5eff8;
	border-left:1px solid #e5eff8;
	padding:.3em 1em;
	
	}							
.inicio thead th {
	background:#333;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
	color:#333
	}	
.inicio tfoot th {
	text-align:center;
	background:#f4f9fe;
	}	
	.titulos{
		background-color:#DCDCDC;
	}
	.divflota {
	left: 30px;
	top: 10px;
	position: absolute;
	font-size: 12px;
	}
</style>
<!DOCTYPE html>
<html>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>
  <p>
<div align="center">
<form id="form1" name="form1" method="post" action="#">
<table width="600" border="1" class="inicio">
<caption class="titulos">
Salarios
</caption>
  <tbody>
  <tr>
      <td width="100%">&nbsp;</td>
      <td align="center" class="titulos">Último pago de Nómina</td>
      <td align="center" class="titulos">Simulación</td>
    </tr>
<tr>
      <td width="100%">(Incluye Salario Básico, Salario Integral Base, Factor Prestacional, Retroactivo Salario Básico, Retroactivo Salario Integral, Vacaciones Disfrutadas</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" style="text-align:right" disabled="disabled" id="textfield" value="<?php echo '$ '. number_format($valora); ?>" /></td>
      <td><input name="salario" type="text" id="salario" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($salario)){ echo @$salario;}?>" onkeypress="return soloLetras(event)"/></td>
    </tr>
<tr>
  <td colspan="2">&nbsp;</td>
  <td><p>Seleccione: </p>
    <p>Salario Basico
      <input name="radio" type="radio" id="radio" value="1" <?php if($radio == '1' or $radio != '2'){ echo 'checked="checked"'; }?>/>
      <label for="radio"></label>
      Salario Integral
      <input type="radio" name="radio" id="radio2" value="2" <?php if($radio == '2'){ echo 'checked="checked"'; }?>/>
    </p></td>
  </tr>
  </tbody>
</table>

<!--tabla Otros ingresos Salariales-->

<table width="600" border="1" class="inicio">
<caption class="titulos">
Otros ingresos Salariales
</caption>
  <tbody>
<tr>
      <td width="100%">(Incluye Horas Extras, Recargos, Comisiones, Incapacidad > 3 días, Incapacidad < 3 días, Auxilio Incapacidades, Licencia Maternidad y paternidad, Bono Lump Sum)</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($valorb); ?>" /></td>
      <td><input name="ingresosala" type="text" id="ingresosala" style="text-align:right" placeholder="Escriba aqui" value="<?php if(isset($ingresosala)){ echo @$ingresosala;}?>" onkeypress="return soloLetras(event)"/></td>
    </tr>
  </tbody>
</table>

<!--tabla Demas ingresos-->

<table width="600" border="1" class="inicio">
<caption class="titulos">
Demás ingresos
</caption>
  <tbody>
<tr>
      <td width="100%">(Incluye Auxilio Rodamiento, Movilidad, etc)</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($valorc); ?>" /></td>
      <td><input name="auxilio" type="text" id="auxilio" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($auxilio)){ echo @$auxilio;}?>" onkeypress="return soloLetras(event)"/></td>
    </tr>
<tr>
      <td width="100%">Prima Legal</td>
      <td><input name="textfield3" type="text" disabled="disabled" id="textfield3" style="text-align:right" value="<?php echo '$ '. number_format($valord); ?>" /></td>
      <td><input name="prima" type="text" id="prima" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($prima)){ echo @$prima;}?>" onkeypress="return soloLetras(event)"/></td>
      </tr>
<tr>
  <td width="100%">Auxilio Legal de Transporte</td>
  <td><input name="textfield5" type="text" disabled="disabled" id="textfield5" style="text-align:right" value="<?php echo '$ '. number_format($valore); ?>" /></td>
  <td><input name="auxiliotrans" type="text" id="auxiliotrans" style="text-align:right" placeholder="Escriba aqui" value="<?php if(isset($auxiliotrans)){ echo @$auxiliotrans;}?>" onkeypress="return soloLetras(event)"/></td>
</tr>
<tr>
  <td width="100%">Big Pass</td>
  <td><input name="textfield6" type="text" disabled="disabled" id="textfield6" style="text-align:right" value="<?php echo '$ '. number_format($valorf); ?>" /></td>
  <td><input name="bigpass" type="text" id="bigpass" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($bigpass)){ echo @$bigpass;}?>" onkeypress="return soloLetras(event)"/></td>
</tr>
<tr>
  <td>Big Pass con Retención</td>
  <td><input name="textfield9" type="text" disabled="disabled" id="textfield9" style="text-align:right" value="<?php echo '$ '. number_format($valorg); ?>" /></td>
  <td><input name="bigpassrete" type="text" id="bigpassrete" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($bigpassrete)){ echo @$bigpassrete;}?>" onkeypress="return soloLetras(event)"/></td>
</tr>
  </tbody>
</table>

<!--tabla Certificados Beneficio Tributario Aplicados-->

<table width="600" border="1" class="inicio">
<caption class="titulos">
Certificados Beneficio Tributario Aplicados
</caption>
  <tbody>
<tr>
      <td width="100%">Vivienda</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($valorh); ?>" /></td>
      <td><input name="vivienda" type="text" id="vivienda" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($vivienda)){ echo @$vivienda;}?>" onkeypress="return soloLetras(event)"/></td>
    </tr>
<tr>
      <td width="100%">Prepagada / Salud</td>
      <td><input name="textfield3" type="text" disabled="disabled" id="textfield3" style="text-align:right" value="<?php echo '$ '. number_format($valori); ?>" /></td>
      <td><input name="prepag" type="text" id="prepag" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($prepag)){ echo @$prepag;}?>" onkeypress="return soloLetras(event)"/></td>
      </tr>
<tr>
  <td width="100%">Dependientes</td>
  <td><input name="textfield5" type="text" disabled="disabled" id="textfield5" style="text-align:right" value="<?php echo '$ '. number_format($valorj); ?>" /></td>
  <td><input name="dependien" type="text" id="dependien" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($dependien)){ echo @$dependien;}?>" onkeypress="return soloLetras(event)"/></td>
</tr>
<tr>
  <td width="100%">Salud obligatoria (año anterior)</td>
  <td><input name="textfield6" type="text" disabled="disabled" id="textfield6" style="text-align:right" value="<?php echo '$ '. number_format($valork); ?>" /></td>
  <td><input name="textfield7" type="text" disabled="disabled" id="textfield7" style="text-align:right" value="<?php echo '$ '. number_format($valork); ?>" /></td>
</tr>
  </tbody>
</table>

<!--tabla Aportes Voluntarios-->

<table width="600" border="1" class="inicio">
<caption class="titulos">
Aportes Voluntarios
</caption>
  <tbody>
<tr>
      <td width="100%">Máximo Aporte Voluntario/AFC con Beneficio</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($valorm); ?>" /></td>
      <td><input name="textfield12" type="text" disabled="disabled" id="textfield12" style="text-align:right" value="<?php echo '$ '. number_format($valorma); ?>" /></td>
    </tr>
<tr>
      <td width="100%">Pensión Voluntaria</td>
      <td><input name="textfield3" type="text" disabled="disabled" id="textfield3" style="text-align:right" value="<?php echo '$ '. number_format($valorn); ?>" /></td>
      <td><input name="pensionvol" type="text" id="pensionvol" style="text-align:right" placeholder="Escriba aqui" value="<?php if(isset($pensionvol)){ echo @$pensionvol;}?>" onkeypress="return soloLetras(event)"/></td>
      </tr>
<tr>
  <td width="100%">Aporte AFC, Renta Pensión, Seguro de Vida con Beneficio</td>
  <td><input name="textfield5" type="text" disabled="disabled" id="textfield5" style="text-align:right" value="<?php echo '$ '. number_format($valorl); ?>" /></td>
  <td><input name="aporterent" type="text" id="aporterent" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($aporterent)){ echo @$aporterent;}?>" onkeypress="return soloLetras(event)"/></td>
</tr>
  </tbody>
</table>

<!--tabla Deducciones de Ley-->

<table width="600" border="1" class="inicio">
<caption class="titulos">
Deducciones de Ley
</caption>
  <tbody>
<tr>
      <td width="100%">Salud</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($valoro); ?>" /></td>
      <td><input name="textfield12" type="text" disabled="disabled" id="textfield12" style="text-align:right" value="<?php echo '$ '. number_format($valoroa); ?>" /></td>
    </tr>
<tr>
      <td width="100%">Pension</td>
      <td><input name="textfield3" type="text" disabled="disabled" id="textfield3" style="text-align:right" value="<?php echo '$ '. number_format($valorp); ?>" /></td>
      <td><input name="textfield13" type="text" disabled="disabled" id="textfield13" style="text-align:right" value="<?php echo '$ '. number_format($valorpa); ?>" /></td>
      </tr>
<tr>
  <td width="100%">Solidaridad</td>
  <td><input name="textfield5" type="text" disabled="disabled" id="textfield5" style="text-align:right" value="<?php echo '$ '. number_format($valorq); ?>" /></td>
  <td><input name="textfield14" type="text" disabled="disabled" id="textfield14" style="text-align:right" value="<?php echo '$ '. number_format($valorqa); ?>" /></td>
</tr>
<tr>
  <td>Retención Salario Procedimiento 1 / 2</td>
  <td><input name="textfield18" type="text" disabled="disabled" id="textfield18" style="text-align:right" value="<?php echo '$ '. number_format($valorr); ?>" /></td>
  <td><input name="textfield15" type="text" disabled="disabled" id="textfield15" style="text-align:right" value="<?php echo '$ '. number_format($valorra); ?>" /></td>
</tr>
<tr>
  <td>Retención Salario Pagos Minimos</td>
  <td><input name="textfield17" type="text" disabled="disabled" id="textfield17" style="text-align:right" value="<?php echo '$ '. number_format($valors); ?>" /></td>
  <td><input name="textfield16" type="text" disabled="disabled" id="textfield16" style="text-align:right" value="<?php echo '$ '. number_format($valorsa); ?>" /></td>
</tr>
  </tbody>
</table>

<!--tabla Deducciones de Ley-->

<table width="600" border="1" class="inicio">
<caption class="titulos">
Otras Deducciones
</caption>
  <tbody>
<tr>
      <td width="100%">(Incluye Fecel, Libranzas, Gimnasio, Celular, Servicios Fija)</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($valort); ?>" /></td>
      <td><input name="otrasdeduc" type="text" id="otrasdeduc" style="text-align:right" placeholder="Escriba aqui" value="<?php if(isset($otrasdeduc)){ echo @$otrasdeduc;}?>" onkeypress="return soloLetras(event)"/></td>
    </tr>
  </tbody>
</table>

<!--tabla Neto a Recibir en la cuenta de nómina-->
</br>
<table width="600" border="1" class="inicio">
  <tbody>
<tr>
      <td width="100%">Neto a Recibir en la cuenta de nómina</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($netoa); ?>" /></td>
      <td><input name="textfield19" type="text" disabled="disabled" id="textfield19" style="text-align:right" value="<?php echo '$ '. number_format($netob); ?>" /></td>
    </tr>
  </tbody>
</table>
<div align='center'>
<input name="enviar" type="submit" id="enviar" value="Consultar" />
</div>
</form>
</div>

</p>

<div class="divflota">
  <table width="300" border="1" class="inicio">
    <caption class="titulos">
      Datos informativos
    </caption>
    <tbody>
      <tr>
        <td width="50%">Declarante de Renta</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold"><?php echo @$declarenta; ?></td>
      </tr>
      <tr>
        <td>Procedimiento de Retención en la Fuente</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold"><?php echo @$procedireten; ?></td>
      </tr>
      <tr>
        <td>Tipo de Salario</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold"><?php echo @$tiposalario; ?></td>
      </tr>
      <tr>
        <td>Porcentaje de Retención</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold"><?php echo @$porcenrete; ?></td>
      </tr>
      <tr>
        <td>Fecha ingreso</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold"><?php echo @$fechaingres; ?></td>
      </tr>
      <tr>
        <td>Fecha Vencimiento</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold"><?php echo @$fechavencimi; ?></td>
      </tr>
      <tr>
        <td>Tipo Contrato</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold"><?php echo @$tipocontrato; ?></td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>