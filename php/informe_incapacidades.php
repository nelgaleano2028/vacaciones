<?php
@session_start();

//------------------------------antidoto
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

$codigo=$_SESSION['cod'];
$codiepl = $_SESSION['ced'];

   //validacion bd f
$consultaf = "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
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


if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}


//-----------------------------CANTIDAD DE EMPLEADOS

	$qry1="select COUNT(*) AS CONTEO  from empleados_gral b, empleados_basic a WHERE a.estado = 'A' and b.cod_epl = a.cod_epl and COD_JEFE = '$codigo'";
	  
	$rh1 = $conn->Execute($qry1); 

	$row1 = $rh1->FetchRow();

	$cantidademp=$row1["CONTEO"];

//-----------------------------CANTIDAD DE EMPLEADOS INCAPACITADOS

	$qry2="SELECT COUNT(*) AS CONTEO FROM ausencias a, empleados_gral b
WHERE
a.cod_epl = b.cod_epl and b.cod_jefe = '$codigo' and
a.cod_aus='2' and a.cod_aus='3' and a.estado in ('P','C')
and (to_date(sysdate) between a.fec_ini and a.fec_fin or
to_date(sysdate) between a.fec_ini and a.fec_fin)";
	  
	$rh2 = $conn->Execute($qry2); 

	$row2 = $rh2->FetchRow();

	$cantidadinca=$row2["CONTEO"];
	
//-----------------------------DIAS DE INCAPACIDAD REPORTADOS EN EL MES 

	$qry3="select  SUM(dias) AS CONTEO  from  incapacidades_tmp a, empleados_gral b
where 
a.cod_epl = b.cod_epl and
b.cod_jefe = '$codigo' and
to_char(a.fec_solicitud,'MM') = TO_CHAR(SYSDATE,'MM')";
	  
	$rh3 = $conn->Execute($qry3); 

	$row3 = $rh3->FetchRow();

	$cantidadmes=$row3["CONTEO"];
	
//-----------------------------DIAS DE INCAPACIDAD TOMADOS EN EL MES 

	$qry4="select  SUM(dias) AS CONTEO  from  incapacidades_tmp a, empleados_gral b
where 
a.cod_epl = b.cod_epl and
b.cod_jefe = '$codigo' and
to_char(a.fec_ini,'MM') = TO_CHAR(SYSDATE,'MM')";
	  
	$rh4 = $conn->Execute($qry4); 

	$row4 = $rh4->FetchRow();

	$cantidadmesven=$row4["CONTEO"];
	
//-----------------------------INCAPACIDADES PENDIENTE POR RADICAR POR EL COLABORADOR 

	$qry5="select c.cedula AS CEDULA, c.nom_epl AS NOMBRE, c.ape_epl AS APELLIDO, a.dias AS DIAS, a.fec_ini AS FECHAINI, a.fec_fin AS FECHAFIN, a.fec_solicitud AS FECHASOL from incapacidades_tmp a, empleados_gral b, empleados_basic c
where a.cod_epl = b.cod_epl
and a.estado = 'P'
and a.cod_epl = c.cod_epl
and b.cod_jefe = '$codigo'";
	  
	$rh5 = $conn->Execute($qry5); 
	
//-----------------------------INCAPACIDADES REPORTADAS  A LA FECHA

	$qry6="select COUNT(*) AS CONTEO from incapacidades_tmp a, empleados_gral b where a.cod_epl=b.cod_epl and cod_jefe = '$codigo' ";
	  
	$rh6 = $conn->Execute($qry6); 

	$row6 = $rh6->FetchRow();

	$cantidadrepor=$row6["CONTEO"];
	
//-----------------------------INCAPACIDADES CERRADAS

	$qry7="select COUNT(*) AS CONTEO from incapacidades_tmp a, empleados_gral b where a.cod_epl=b.cod_epl and cod_jefe = '$codigo' and a.estado in('T','V','R')";
	  
	$rh7 = $conn->Execute($qry7); 

	$row7 = $rh7->FetchRow();

	$cantidadcerradas=$row7["CONTEO"];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="X-UA-Compatible" content="IE=9" />

<style>
body{
	font-size: 12px;
	font-family:Arial, Helvetica, sans-serif;
	 }

	table#padre{ width:60%;}
	
	table{ width:60%; }

   	#testTable { 
           
            margin-left: auto;
            
            margin-right: auto;
          }
          
         #tablePagination { 
            
	   background-color: #DCDCDC;             
            padding: 0px 5px;
            padding-top: 2px;
            height: 25px;
	    width: 58%;
	    margin: auto;
          }
          
          #tablePagination_paginater { 
            margin-left: auto; 
            margin-right: auto;
          }
          
          #tablePagination img { 
            padding: 0px 2px; 
          }
          
          #tablePagination_perPage { 
            float: left; 
          }
          
          #tablePagination_paginater { 
            float: right; 
         }	
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
<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
<link rel="stylesheet" type="text/css" href="../css/plantilla_user.css" />
<link href="../css/tcal.css" rel="stylesheet" type="text/css" />



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
		$(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafico 1'
            },
            xAxis: {
                categories: [
                   
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Valores'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Q dias productivos deacuerdo a la cantidad de empleados a cargo',
                data: [<?php if (empty($cantidadmesven)){
			echo '0';
			}else{
			echo $cantidadmesven; }?>]
    
            }, {
                name: 'Q dias de incapacidad en el mes',
                data: [23.6]
    
            }]
        });
    });
    

		</script>
        <script type="text/javascript">
		$(function () {
        $('#containerdos').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafico 2'
            },
            xAxis: {
                categories: [
                   
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Valores'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Q incapacidades reportadas a la fecha',
                data: [<?php echo $cantidadrepor; ?>]
    
            }, {
                name: 'Q incapacidades radicadas por los empleados',
                data: [<?php echo $cantidadcerradas; ?>]
    
            }]
        });
    });
    

		</script>
        <script src="libgrap/js/highcharts.js"></script>
<script src="libgrap/js/modules/exporting.js"></script>
</head>

<body>
<center>
<br />
<h2>INFORME INCAPACIDADES</h2></center>
<center><h3>Corte a <?php echo $mes = date('m/Y',strtotime('0 months', strtotime(date('Y-m')))); ?></h3></center>

<table style="min-width: 200px; width:600px; position: absolute; left:5%; top:150px; margin: 0 auto">
	<tr>
<td bgcolor="#CCCCCC" style="font-weight: bold;">
CANT EMPLEADOS A CARGO
</td>
<td bgcolor="#CCCCCC" style="font-weight: bold;">
CANT EMPLEADOS INCAPACITADOS
</td>
<td bgcolor="#CCCCCC" style="font-weight: bold;">
Q DIAS DE INCAPACIDAD REPORTADOS EN EL MES
</td>
<td bgcolor="#CCCCCC" style="font-weight: bold;">
Q DIAS DE INCAPACIDAD EN EL MES
</td>
<td bgcolor="#CCCCCC" style="font-weight: bold;">
Q DIAS PRODUCTIVOS DE ACUERDO A LA CANTIDAD DE EMPLEADOS A CARGO
</td>
	</tr>
	<tr>
<td>
<?php echo $cantidademp; ?>
</td>
<td>
<?php echo $cantidadinca; ?>
</td>
<td>
<?php if (empty($cantidadmes)){
			echo '0';
			}else{
			echo $cantidadmes; }?>
</td>
<td>
<?php if (empty($cantidadmesven)){
			echo '0';
			}else{
			echo $cantidadmesven; }?>
</td>
<td>
dato 1
</td>
	</tr>    
    <tr>
<td>

</td>
<td>
Cantidad de empleados reportados en el  mes anterior.
</td>
<td>
Corresponde a la cantidad de dias que ha reportado el jefe en el mes anterior, sin importar la fecha de inicio o la fecha fin.
</td>
<td>
Corresponde a la cantidad de dias que ha reportado el jefe en el mes anterior, se realizara la sumatoria de aquellos dias de incapacidad que ocurrieron en el mes de reporte.
</td>
<td>
300* cantidad de empleados a cargo.
</td>
	</tr>	
</table>

<table style="min-width: 200px; height: 100px; width:500px; position: absolute; left:59%; top:150px; margin: 0 auto">
	<tr>
<td bgcolor="#CCCCCC" style="font-weight: bold;">
Q INCAPACIDADES REPORTADAS A LA FECHA
</td>
<td bgcolor="#CCCCCC" style="font-weight: bold;">
Q INCAPACIDADES RADICADAS POR LOS EMPLEADOS
</td>

	</tr>
    <tr>
<td>
<?php echo $cantidadrepor; ?>
</td>
<td>
<?php echo $cantidadcerradas; ?>
</td>

	</tr>
	<tr>
<td>
Acumulado de incapacidades reportadas.
</td>
<td>
Cantidad de incapacidades en estado cerrado.
</td>

	</tr>
</table>

<div id="container" style="min-width: 200px; height: 300px; width:450px; position: absolute; left:5%; top:450px; margin: 0 auto"></div>
        
<div id="containerdos" style="min-width: 200px; height: 300px; width:400px; position: absolute; left:65%; top:450px; margin: 0 auto"></div>

<div style="min-width: 200px; height: 450px; width:100%; position: absolute; top:800px; margin: 0 auto">
<iframe src="informe_incapacidades2.php"  name="mainFrame" width="100%" height="450px"  scrolling="auto" frameborder="0" id="mainFrame"></iframe>
</div>
</body>