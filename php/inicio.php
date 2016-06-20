<?php 
require_once 'class_inicio.php';
include_once('querysimulador.php');
@session_start();
$jefemues = $_SESSION['jef'];
$ididen = $_SESSION['cod'];
if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}
//------------------------------antidoto
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');
$codiepl = $_SESSION['ced'];

   //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
}
// Variables que vuelven
 
@$salario = $_POST["salario"];
@$ingresosala = $_POST["ingresosala"];
@$auxilio = $_POST["auxilio"];
@$prima = $_POST["prima"];
@$auxiliotrans = $_POST["auxiliotrans"];
@$bigpass = $_POST["bigpass"];
@$bigpassrete = $_POST["bigpassrete"];
@$vivienda = $_POST["vivienda"];
@$prepag = $_POST["prepag"];
@$dependien = $_POST["dependien"];
@$pensionvol = $_POST["pensionvol"];
@$aporterent = $_POST["aporterent"];
@$otrasdeduc = $_POST["otrasdeduc"];
@$radio = $_POST["radio"];
	
?>
<html>
<head>
<style>
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
	color: #678197;
	border-bottom: 1px solid #e5eff8;
	border-left: 1px solid #e5eff8;
	padding:.em 1em;
	font: 12px Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
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
	.titulosa{
		background-color: #DCDCDC;
	}
	.titulosb{
		background-color: #EFEFEF;
	}
</style>
    
<style type="text/css">
    @import "../css/datatable/demo_table.css";
    @import "../css/datatable/demo_page.css";
</style>
<style type="text/css">
@import url("../css/plantilla_user.css");
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
    </style>

<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />


 <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>


    
     <!-- PAGINACION-->
	 <link rel="stylesheet" href="../js/__jquery.tablesorter/themes/blue/style.css" type="text/css"/>
	   <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.js" type="text/javascript"></script>
          <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.min.js" type="text/javascript"></script>
           <script src="../js/__jquery.tablesorter/jquery-latest.js" type="text/javascript"></script>
          <script src="../js/__jquery.tablesorter/jquery.tablesorter.js" type="text/javascript"></script>
          <!-- FIN PAGINACION-->
          
			<script src="../js/jquery.min.js" type="text/javascript"></script>
          	<script src="../js/jquery.timer.js" type="text/javascript"></script>
			<script src="../js/jquery.easing.1.3.js" type="text/javascript"></script>
            <script src="../js/jquery.dwdinanews.0.1.js" type="text/javascript"></script>
            <script src="../js/jquery.validate.js"></script>
            
	
<script>

/*JS para banner de noticias*/
	$(document).ready(function(){
	$("#otrasnovedades").dwdinanews({
		retardo: 8000,
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
    
     <style type="text/css">
	body {
	font-family: tahoma, verdana, arial, sans-serif;
	font-size: 10px;
	}	
	#otrasnovedades{
	border: 8px solid #ccc;
	width: 98%;
	height: 102px;
	overflow: hidden;
	font-size: 1.3em;
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
		padding: 6px;
		height: 90px;
		overflow: hidden;
		line-height: 10px;
	}
	#otrasnovedades li a{
		font-weight: bold;
		font-size: 1.2em;
	}
		.divflota2 {
	left: 0px;
	top: 345px;
	position: absolute;
	font-size: 12px;
	}
		.divflota3 {
	left: 580px;
	top: 330px;
	position: absolute;
	font-size: 12px;
	}
	            .error-message, label.error {
                color: #ff0000;
                margin:0;
                display: inline;
                font-size: 1em !important;
                font-weight:lighter;
            }
	 .cierre {
	font-size: 12px;
	font:Arial, Helvetica, sans-serif;
}
     .bold {
	font-weight: bold;
}
     </style>

</head>
<body>

<?php
$qry561 = "SELECT DISTINCT TIPO_DOC as TIPODOC FROM EMPLEADOS_BASIC WHERE CEDULA ='$codiepl'";
$rs56 = $conn->Execute($qry561);
$row561 = $rs56->fetchrow();
$tipouno = $row561["TIPODOC"]; 
if($tipouno=='E'){
$tipodos = 'C.E.';
}
if($tipouno=='P'){
$tipodos = 'Pasaporte.';
}
if($tipouno=='C'){
$tipodos = 'C.C.';
}
if($tipouno=='T'){
$tipodos = 'T.I.';
}
?>
<?php
$query170 ="select C.NOM_CIU as CIUDAD, D.NOM_DEP as REGIONAL from empleados_basic e, empleados_gral m, ciudades c, departamentos d 
	where e.cod_epl = m.cod_epl and M.COD_CIU = C.COD_CIU and D.COD_DEP = E.COD_DEP and e.estado ='A' and e.cod_epl = '$ididen'";
	$rs170 = $conn->Execute($query170);
	$row170= $rs170->fetchrow();
	$ciudad=$row170["CIUDAD"];
	$regional=$row170["REGIONAL"];
?>	
<div align="center">
<p style="font-size:18px">Bienvenido al portal de Nómina <?PHP echo mb_convert_case(@$_SESSION['nombre'], MB_CASE_TITLE, "UTF-8");?> <?php echo mb_convert_case(@$_SESSION['ape'], MB_CASE_TITLE, "UTF-8");?></p>

<p style="font-size:11px"><?PHP echo 'Cargo: '.mb_convert_case(@$_SESSION['crg'], MB_CASE_TITLE, "UTF-8");?></p>
<p style="font-size:11px"><?PHP echo 'Documento de identidad: '.@$tipodos.' '.@$_SESSION['ced'];?></p>
<p style="font-size:11px"><?PHP echo @$_SESSION['cor'];?></p>
<p style="font-size:11px"><?PHP echo 'Jefe: '.mb_convert_case(@$jefemues, MB_CASE_TITLE, "UTF-8").' '.mb_convert_case($_SESSION['apejef'], MB_CASE_TITLE, "UTF-8");?></p>
<p style="font-size:11px"><?PHP echo'Ciudad: '.@$ciudad;?></p>
<p style="font-size:11px"><?PHP echo 'Regional: '.@$regional;?></p>
</div>
<p>
<div id="otrasnovedades">
  <ul><?php $sql = "SELECT TITULO, CONTENIDO, FECHA, ESTADO FROM ( SELECT * FROM FEEDNEWS ORDER BY ID DESC ) WHERE ROWNUM <= 3";
$rs = $conn->Execute($sql);
while($row = $rs->fetchrow()){
	echo '<li><p style=" font-weight:bold">'.$row['TITULO'].'</p>'.$row['CONTENIDO'].'<p style="font-size:9px;">'.$row['FECHA'].'</p></li>';
};
?>
		</ul>
</div>
</p>
<p>
<div id="informacionove">
  <ul class="cierre">Cierre de Novedades de Nómina: <span class="bold"><?PHP echo @$fecha;?></span>, Importante: Las novedades que se tramiten por fuera de los límites establecidos en el <a href="crono.php" style="color: #770003">cronograma cierre novedades de nómina</a>, serán registradas para el pago de la nómina del mes siguiente.
</ul>
</div>
</p>
<!--<div class="divflota3">
<img src="../imagenes/FONDOA.jpg" width="616" height="1104">
</div>   -->
<div class="divflota3">
<form id="form1" name="form1" method="post" action="#">
<table width="600" border="0" class="inicio">
<P class="titulos" align="center" style=" color: #666; font-weight:bold; font-size:15px; font-family:Arial, Helvetica, sans-serif">SIMULADOR SALARIAL</P>

<P>Esta herramienta te permite simular tus deducciones legales (aportes salud, aporte pensión, solidaridad, máximo ahorro de pensiones voluntarias y/o AFC y retefuente) si reportas tus <a href="http://intranettelefonica/clienteInterno/Paginas/Retencionenlafuente.aspx"> deducibles de retención de la fuente</a> anualmente puedes optimizar tu retención en la fuente de acuerdo con la ley laboral, diligenciando los datos a continuación:</P>
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
      <td width="100%">(Incluye Salario Básico, Salario Integral Base, Factor Prestacional, Retroactivo Salario Básico, Retroactivo Salario Integral, Vacaciones Disfrutadas)</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" style="text-align:right" disabled="disabled" id="textfield" value="<?php echo '$ '. number_format($valora); ?>" /></td>
      <td><input name="salario" type="text" id="salario" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($salario)){ echo @$salario;}?>" onKeyPress="return soloLetras(event)"/></td>
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

<table width="600" border="0" class="inicio">
<caption class="titulos">
Otros ingresos Salariales
</caption>
  <tbody>
<tr>
      <td width="100%">(Incluye Horas Extras, Recargos, Comisiones, Incapacidad > 3 días, Incapacidad < 3 días, Auxilio Incapacidades, Licencia Maternidad y paternidad, Monto único salarial)</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($valorb); ?>" /></td>
      <td><input name="ingresosala" type="text" id="ingresosala" style="text-align:right" placeholder="Escriba aqui" value="<?php if(isset($ingresosala)){ echo @$ingresosala;}?>" onKeyPress="return soloLetras(event)"/></td>
    </tr>
  </tbody>
</table>

<!--tabla Demas ingresos-->

<table width="600" border="0" class="inicio">
<caption class="titulos">
Demás ingresos
</caption>
  <tbody>
<tr>
      <td width="100%">(Incluye Auxilio Rodamiento, Movilidad, etc)</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($valorc); ?>" /></td>
      <td><input name="auxilio" type="text" id="auxilio" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($auxilio)){ echo @$auxilio;}?>" onKeyPress="return soloLetras(event)"/></td>
    </tr>
<tr>
      <td width="100%">Prima Legal</td>
      <td><input name="textfield3" type="text" disabled="disabled" id="textfield3" style="text-align:right" value="<?php echo '$ '. number_format($valord); ?>" /></td>
      <td><input name="prima" type="text" id="prima" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($prima)){ echo @$prima;}?>" onKeyPress="return soloLetras(event)"/></td>
      </tr>
<tr>
  <td width="100%">Auxilio Legal de Transporte</td>
  <td><input name="textfield5" type="text" disabled="disabled" id="textfield5" style="text-align:right" value="<?php echo '$ '. number_format($valore); ?>" /></td>
  <td><input name="auxiliotrans" type="text" id="auxiliotrans" style="text-align:right" placeholder="Escriba aqui" value="<?php if(isset($auxiliotrans)){ echo @$auxiliotrans;}?>" onKeyPress="return soloLetras(event)"/></td>
</tr>
<tr>
  <td width="100%">Big Pass, pago pensiones y otros</td>
  <td><input name="textfield6" type="text" disabled="disabled" id="textfield6" style="text-align:right" value="<?php echo '$ '. number_format($valorf); ?>" /></td>
  <td><input name="bigpass" type="text" id="bigpass" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($bigpass)){ echo @$bigpass;}?>" onKeyPress="return soloLetras(event)"/></td>
</tr>
<tr>
  <td>Big Pass y plan acciones</td>
  <td><input name="textfield9" type="text" disabled="disabled" id="textfield9" style="text-align:right" value="<?php echo '$ '. number_format($valorg); ?>" /></td>
  <td><input name="bigpassrete" type="text" id="bigpassrete" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($bigpassrete)){ echo @$bigpassrete;}?>" onKeyPress="return soloLetras(event)"/></td>
</tr>
  </tbody>
</table>

<!--tabla Certificados Beneficio Tributario Aplicados-->

<table width="600" border="0" class="inicio">
<caption class="titulos">
Certificados Beneficio Tributario Aplicados
</caption>
  <tbody>
<tr>
      <td width="100%">Intereses de Vivienda</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($valorh); ?>" /></td>
      <td><input name="vivienda" type="text" id="vivienda" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($vivienda)){ echo @$vivienda;}?>" onKeyPress="return soloLetras(event)"/></td>
    </tr>
<tr>
      <td width="100%">Salud Prepagada</td>
      <td><input name="textfield3" type="text" disabled="disabled" id="textfield3" style="text-align:right" value="<?php echo '$ '. number_format($valori); ?>" /></td>
      <td><input name="prepag" type="text" id="prepag" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($prepag)){ echo @$prepag;}?>" onKeyPress="return soloLetras(event)"/></td>
      </tr>
<tr>
  <td width="100%">Dependientes</td>
  <td><input name="textfield5" type="text" disabled="disabled" id="textfield5" style="text-align:right" value="<?php echo '$ '. number_format($valorj); ?>" /></td>
  <td><input name="dependien" type="text" id="dependien" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($dependien)){ echo @$dependien;}?>" onKeyPress="return soloLetras(event)"/></td>
</tr>
<tr>
  <td width="100%">Salud obligatoria (año anterior)</td>
  <td><input name="textfield6" type="text" disabled="disabled" id="textfield6" style="text-align:right" value="<?php echo '$ '. number_format($valork); ?>" /></td>
  <td><input name="textfield7" type="text" disabled="disabled" id="textfield7" style="text-align:right" value="<?php echo '$ '. number_format($valork); ?>" /></td>
</tr>
  </tbody>
</table>

<!--tabla Aportes Voluntarios-->

<table width="600" border="0" class="inicio">
<caption class="titulos">
Aportes Voluntarios
</caption>
  <tbody>
<tr>
      <td width="100%" bgcolor="#CDFDC6">Máximo Aporte Voluntario/AFC con Beneficio</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($valorm); ?>" /></td>
      <td><input name="textfield12" type="text" disabled="disabled" id="textfield12" style="text-align:right" value="<?php echo '$ '. number_format($valorma); ?>" /></td>
    </tr>
<tr>
      <td width="100%">Pensión Voluntaria</td>
      <td><input name="textfield3" type="text" disabled="disabled" id="textfield3" style="text-align:right" value="<?php echo '$ '. number_format($valorn); ?>" /></td>
      <td><input name="pensionvol" type="text" id="pensionvol" style="text-align:right" placeholder="Escriba aqui" value="<?php if(isset($pensionvol)){ echo @$pensionvol;}?>" onKeyPress="return soloLetras(event)"/></td>
      </tr>
<tr>
  <td width="100%">Aporte AFC, Renta Pensión, Seguro de Vida con Beneficio</td>
  <td><input name="textfield5" type="text" disabled="disabled" id="textfield5" style="text-align:right" value="<?php echo '$ '. number_format($valorl); ?>" /></td>
  <td><input name="aporterent" type="text" id="aporterent" placeholder="Escriba aqui" style="text-align:right" value="<?php if(isset($aporterent)){ echo @$aporterent;}?>" onKeyPress="return soloLetras(event)"/></td>

</tr>
  </tbody>
</table>

<!--tabla Deducciones de Ley-->

<table width="600" border="0" class="inicio">
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

<table width="600" border="0" class="inicio">
<caption class="titulos">
Otras Deducciones
</caption>
  <tbody>
<tr>
      <td width="100%">(Incluye Fecel, Libranzas, Gimnasio, Equipo Celular, Servicios Fija, Plan Exequial, etc.)</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($valort); ?>" /></td>
      <td><input name="otrasdeduc" type="text" id="otrasdeduc" style="text-align:right" placeholder="Escriba aqui" value="<?php if(isset($otrasdeduc)){ echo @$otrasdeduc;}?>" onKeyPress="return soloLetras(event)"/></td>
    </tr>
  </tbody>
</table>

<!--tabla Neto a Recibir en la cuenta de nómina-->
</br>
<table width="600" border="0" class="inicio">
  <tbody>
<tr>
      <td width="100%">Neto a Recibir en la cuenta de nómina</td>
      <td><label for="textfield"></label>
        <input name="textfield" type="text" disabled="disabled" id="textfield" style="text-align:right" value="<?php echo '$ '. number_format($netoa); ?>" /></td>
      <td><input name="textfield19" type="text" disabled="disabled" id="textfield19" style="text-align:right" value="<?php echo '$ '. number_format($netob); ?>" /></td>
    </tr>
  </tbody>
</table>
<div align='Right'>
<input name="enviar" type="submit" id="enviar" value="Simular" />
</div>
</form>
</div>
<div class="divflota2">
<div id="content">
<table class="inicio" width="514px">
	<tr>
    	<td><table width="514" border="0" align="right" class="inicio">
    <tr>
                    	<td colspan="2" class="titulos" align="center">DATOS INFORMATIVOS</td>
            </tr>
    <tbody>
	<?php if( @$empleadovalida=='ok'){
		echo '
    <tr>
        <td width="50%" bgcolor="#CDFDC6">Dias de Vacaciones disponibles </br>(no están incluidos los días programados, que no estén liquidadas en la nómina)</td>
        <td colspan="2" bgcolor="#CDFDC6" align="center" style="font-weight:bold">'.$sumatotaldias.'</td>
      </tr>
      <tr>
        <td width="50%">Declarante de Renta</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold">'.@$declarenta.'</td>
      </tr>
      <tr>
        <td>Procedimiento de Retención en la Fuente</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold">'.@$procedireten.'</td>
      </tr>
      <tr>
        <td>Tipo de Salario</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold">'.@$tiposalario.'</td>
      </tr>
      <tr>
        <td>Porcentaje de Retención</td>
        <td colspan="2" align="center" bgcolor="#CBDEF3" style="font-weight:bold">'.@$porcenrete.'</td>
      </tr>
	  ';}?>
      <tr>
        <td>Tipo Contrato</td>
        <td colspan="2" align="center" bgcolor="#CBDEF3" style="font-weight:bold"><?php echo @$tipocontrato; ?></td>
      </tr>
      <tr>
        <td>Fecha ingreso</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold"><?php echo date("d-m-Y",strtotime(@$fechaingres)); ?></td>
      </tr>
      <tr>
        <td>Fecha Vencimiento</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold"><?php echo @$fechavencimi; ?></td>
      </tr>
	  <tr>
        <td>Cuota máxima disponible de descuento</td>
        <td colspan="2" bgcolor="#CBDEF3" align="center" style="font-weight:bold"><?php if(isset($VALOREND)){ echo number_format($VALOREND); }else{ echo '0';}?></td>
      </tr>
    </tbody>
  </table></td>
    </tr>
    <tr>
    	<td><table id="afiliciones" class="tablesorter inicio" width="100%">
        		<thead class="odd">
                <tr>
    	<td colspan="3" class="titulos" align="center">AFILIACIONES - SEGURIDAD SOCIAL</td>
    </tr>
                	<tr>
                    	<td scope="col" class="titulos">CONCEPTO</td>
                        <td scope="col" class="titulos">ENTIDAD</td>
                        <td scope="col" class="titulos">FECHA DE VINCULACION</td>
                     </tr>
                </thead>
           		<tbody>
                <?php if ($tiposalario == 'BÁSICO'){ echo @$tablaa, @$tablaW;
				}else{
				echo @$tablaz, @$tablaW;
				}
				?>
               </tbody>
            </table></td>
    </tr>
    <?php if( @$empleadovalida=='ok'){
		echo '
    <tr>
   	  <td><table id="aportes" class="tablesorter inicio" width="100%" border="1">
        		<thead>
                 <tr>
                   <td colspan="3" align="center" class="titulos"><span class="titulosa">DEDUCIBLES DE RETENCIÓN EN LA FUENTE</span></td>
                 </tr>
                 <tr>
                   <td colspan="3" align="center" class="titulos"><table id="aportes2" class="tablesorter inicio" width="100%">
                     <thead>
                       <tr>
                         <td colspan="3" align="center" class="titulos">PENSIONES VOLUNTARIAS Y AFC (Cuenta de ahorro para vivienda)</td>
                       </tr>
                       <tr>
                         <td class="titulos">CONCEPTO</td>
                         <td class="titulos">ENTIDAD</td>
                         <td class="titulos">APORTE ACTUAL</td>
                       </tr>
                     </thead>
                     <tbody>
                       '.@$tablab.'
                     </tbody>
                   </table></td>
                 </tr>
                 <tr>
                   <td colspan="3" align="center" class="titulos"><table id="deducibles2" class="tablesorter inicio" width="100%">
                     <thead class="odd">
                       <tr>
                         <td colspan="3" class="titulos" align="center">CERTIFICADOS DE BENEFICIO</td>
                       </tr>
                       <tr>
                         <td class="titulos">TIPO</td>
                         <td class="titulos">VALOR MENSUAL</td>
                         <td class="titulos">FECHA DE VENCIMIENTO</td>
                       </tr>
                     </thead>
                     <tbody>
                       <tr>
                         <td class="titulosb">Intereses de Vivienda</td>
                         <td class="titulosb">$ '.number_format($valorh).'</td>
                         <td class="titulosb">'.@$fechah.'</td>
                       </tr>
                       <tr>
                         <td class="titulosb">Salud Prepagada</td>
                         <td class="titulosb">$ '.number_format($valori).'</td>
                         <td class="titulosb">'.@$fechai.'</td>
                       </tr>
                       <tr>
                         <td class="titulosb">Dependientes</td>
                         <td class="titulosb">$ '.number_format($valorj).'</td>
                         <td class="titulosb">'.@$fechaj.'</td>
                       </tr>
                       <tr>
                         <td class="titulosb">Salud Obligatoria</td>
                         <td class="titulosb">$ '.number_format($valork).'</td>
                         <td class="titulosb">'.@$fechak.'</td>
                       </tr>
                     </tbody>
                   </table></td>
                 </tr>
               	</thead>
            </table></td>
    </tr>'; }?>
    <tr>
    	<td class="tit">&nbsp;</td>
    </tr>
    <tr>
    	<td class="tit"><table id="deducibles" class="tablesorter inicio" width="100%">
        		<thead class="odd">
                <tr>
    	<td colspan="3" class="titulos" align="center">CUENTA BANCARIA</td>
    </tr>
                	<tr>
                    	<td class="titulos">ENTIDAD BANCARIA</td>
                        <td class="titulos">NUMERO DE CUENTA</td>
                        <td class="titulos">TIPO DE CUENTA</td>
                  </tr>
                </thead>
           		<tbody>
                	<?php echo @$tablad;?>
               </tbody>
            </table></td>
    </tr>
     <?php  if( @$empleadovalida=='ok'){
	 $lnk = 'envioprogramado.php';
		echo '
    <tr>
    	<td class="tit">&nbsp;</td>
    </tr>
    
    <tr>
    	<td class="titulos" align="center">REPORTE DE NOVEDADES</td>
    </tr>
    <tr>
    	<td style="color: #000; font-size: 11px; text-align: justify;">FORMATOS PARA REPORTAR NOVEDADES: Si deseas reportar alguna novedad para nómina, puedes realizarlo a continuación:</td>
    </tr>
   
    <tr>
    	<td><table id="deducibles" class="tablesorter inicio" width="100%">
        		<thead class="odd">
                	<tr>
                    	<td colspan="2" class="titulos" align="center">NOVEDADES</td>
                     </tr>
                </thead>
           		<tbody>
                	<tr>
                   	  <td>Pensión Voluntaria y AFC</td>
				
                      <td><a href="envioprogramado.php">Registra tu novedad aquí
</a></td>
                  </tr>
                     <tr>
                    	<td>Cambio de cuenta de nómina</td>
                        <td><a href="envioprogramado.php">Registra tu novedad aquí
</a></td>
                     </tr>
                     <tr>
                    	<td>Declarante renta y presentación documentos deducciones retención</td>
                        <td><a href="envioprogramado.php">Registra tu novedad aquí
</a></td>
                     </tr>
                     
                     <tr>
                    	<td>Reporte Paz y Salvos Libranzas</td>
                        <td><a href="envioprogramado.php">Registra tu novedad aquí</a></td>
                     </tr>
               </tbody>
            </table></td>
    </tr>
 '; }?>
    
    <tr>
    	<td></td>
    </tr>
    <tr>
    	<td class="tit">&nbsp;</td>
    </tr>
	<tr>
    	<td><table id="deducibles" class="tablesorter inicio" width="100%">
        		<thead class="odd">
                	<tr>
                    	<td colspan="2" class="titulos" align="center">ZONA DE AYUDA (Haga click para mayor información en los siguientes enlaces)</td>
                     </tr>
                </thead>
           		<tbody>
                	<tr>
                   	  <td width="50%"><a href="http://intranettelefonica/clienteInterno/Paginas/PensionesVoluntarias%20-%20copia.aspx">Pensiones Voluntarias</a></td>
                      <td width="50%"><a href="http://intranettelefonica/clienteInterno/Paginas/CajadeCompensacionFyM.aspx">Caja de compensación y Subsidio Familiar</a></td>
                  </tr>
                     <tr>
                    	<td><a href="http://intranettelefonica/clienteInterno/Paginas/cuentaafc.aspx">Cuentas AFC</a></td>                        
						<td><a href="http://intranettelefonica/clienteInterno/Paginas/cesantias.aspx">Retiro de Cesantías</a></td>
                     </tr>
                     <tr>
                    	<td><a href="http://intranettelefonica/clienteInterno/Paginas/Bancosf.aspx">Bancos</a></td>
                        <td><a href="http://intranettelefonica/clienteInterno/Paginas/incapacidadesmovil.aspx">Incapacidades</a></td>
                     </tr>
                     <tr>
                    	<td><a href="http://intranettelefonica/clienteInterno/Paginas/Retencionenlafuente.aspx">Deducibles de retención en la fuente</a></td>
                        <td><a href="http://intranettelefonica/momentost/ProgramaUNO/Paginas/SegurodeVida.aspx">Seguro de Vida</a></td>
                     </tr>
                     <tr>
                    	<td><a href="http://intranettelefonica/clienteInterno/Paginas/horasextrasmovil.aspx">Horas extras</a></td>
                        <td><a href="http://intranettelefonica/clienteInterno/Paginas/CompradeAccionesTelefonica.aspx">Plan Global de Acciones</a></td>
                     </tr>
                     <tr>
                       <td><a href="http://intranettelefonica/clienteInterno/Paginas/EPSmovil.aspx">EPS Entidad Promotora de Salud</a></td>
                       <td><a href="http://intranettelefonica/clienteInterno/Paginas/Libranzasf.aspx">Libranzas</a></td>
                     </tr>
                     <tr>
                       <td><a href="http://intranettelefonica/clienteInterno/Paginas/Pensiones.aspx">Pensiones</a></td>
                       
                     </tr>
                     <tr>
                       <td><a href="http://intranettelefonica/clienteInterno/Paginas/arp.aspx">ARL</a></td>
                       <td>&nbsp;</td>
                     </tr>
               </tbody>
            </table></td>
    </tr>
    
</table>
</div>
</div>
 <table width="100%" height="1250" border="0">
<tr>
<td height="1250">
</td>
</tr>
<tr>
          <td class="piepag">Cualquier inconveniente que tengas, crea tu tiquete a la Mesa Centro de Servicios Compartidos haciendo <a href="http://clienteinterno:9000/MesasAyuda/Categorias/113/Subcategorias/729" style="color: #770003">clic aquí</a> y adjunta el pantallazo con el error.</td>
   </tr>
</table>
</body>
</html>
