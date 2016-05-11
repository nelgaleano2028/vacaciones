<?php 
session_start();

include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

$nomadmin = $_SESSION['nom'];

//validacion bd f
$consultaf = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['NOM_ADMIN'])){
$conn = $configf;
}
if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;
}
if(isset($rowa['NOM_ADMIN'])){
$conn = $config;
}
if(isset($rowt['NOM_ADMIN'])){
$conn = $configt;
}

//--Cliks

$query100 = "SELECT TABLA AS TABLA, SUM(CLICK) AS CLICK
FROM CLICKS GROUP BY TABLA";
$rs100 = $conn->Execute($query100);
	while($row100 = $rs100->fetchrow()){

	  @$tablaa.='<tr>
        <td>'.$row100["TABLA"].'</td>
        <td>'.$row100["CLICK"].'</td>
      </tr>';	  
	}
?>

<html>
<head>
<style>
.inicio {
	border-top: 1px solid #e5eff8;
	border-right: 1px solid #e5eff8;
	font-family: Arial, Helvetica, sans-serif;
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
    </head>

<table width="25%" align="center" class="tablesorter inicio" id="afiliciones">
        		<thead class="odd">
                <tr>
    	<td colspan="2" class="titulos" align="center">Clicks Recibidos</td>
    </tr>
                	<tr>
                    	<td class="titulos" scope="col">Tabla consultada</td>
                      <td class="titulos" scope="col">Clicks</td>
                  </tr>
                </thead>
           		<tbody>
                <?php echo @$tablaa;?>
               </tbody>
    </table>
    
</html>