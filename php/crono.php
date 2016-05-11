<?php 
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');
@session_start();

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
//------------------------------FIN antidoto

//--AFILIACIONES - SEGURIDAD SOCIAL

$query100 = "select to_char(to_date(to_char(cod_per),'mm'),'Month','NLS_DATE_LANGUAGE = SPANISH') MES,
to_char(fec_cie,'Day', 'NLS_DATE_LANGUAGE = SPANISH') DIA,
EXTRACT (DAY FROM FEC_CIE) CIERRE,
to_char(fec_pag,'Day', 'NLS_DATE_LANGUAGE = SPANISH') DIACIERRA,
EXTRACT (DAY FROM FEC_PAG) PAGO
from CIERRE_NOVPAG
WHERE ANO = EXTRACT (YEAR FROM SYSDATE)
ORDER BY COD_PER ASC";
$rs100 = $conn->Execute($query100);
	while($row100 = $rs100->fetchrow()){

	  @$tablaa.='<tr>
        <td>'.$row100["MES"].'</td>
        <td>'.$row100["DIA"].'</td>
        <td>'.$row100["CIERRE"].'</td>
		<td>'.$row100["DIACIERRA"].'</td>
		<td>'.$row100["PAGO"].'</td>
		
      </tr>';	  
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		  </head>
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
		background-color: #CCC;
	}
	.titulosb{
		background-color: #CDCDCD;
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
  <style type="text/css">
.contenido {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.contenido {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
body,td,th {
	color: #666;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.contenido span strong em {
	font-size: 12px;
}
</style>
<body>
</BR>
</BR>
<p align="center"><strong>
El Centro de Servicios Compartidos  te informa que la fecha de cierre de novedades para los colaboradores directos de Telefónica, para el año <?php echo date ("Y");?></strong>
</p>
<table width="50%" align="center" class="tablesorter inicio" id="afiliciones">
        		<thead class="odd">
                <tr>
    	<td colspan="5" class="titulos" align="center">CRONOGRAMA CIERRE NOVEDADES DE N&Oacute;MINA</td>
    </tr>
                	<tr>
                    	<td scope="col" class="titulos">MES</td>
                      <td scope="col" class="titulos">D&IacuteA</td>
                      <td scope="col" class="titulos">CIERRE</td>
                        <td scope="col" class="titulos">D&IacuteA</td>
                        <td scope="col" class="titulos">PAGO</td>
                  </tr>
                </thead>
           		<tbody>
                <?php echo @$tablaa;?>
               </tbody>
    </table>
	
    </body>
</html>