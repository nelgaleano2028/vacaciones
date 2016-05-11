<?php
session_start();
set_time_limit (86400);

header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=ficheroExcel.xls");
header("Pragma: no-cache");
header("Expires: 0");

$valordb = $_POST["valordb"];

if($valordb=='1'){
	require_once('../lib/oci8/oci8dbf.php');
$conn = $configf;
//echo '1';
}
if($valordb=='2'){
	require_once('../lib/oci8/oci8dbc.php');
$conn = $configc;
//echo '2';
}
if($valordb=='3'){	
	require_once('../lib/oci8/oci8db.php');
$conn = $config;
//echo '3';
}
if($valordb=='4'){
	require_once('../lib/oci8/oci8dbt.php');
$conn = $configt;
//echo '4';
}

if(!isset($_SESSION['privi'])){
  
  header("location: index.php");

}

if($_POST["ano"]=='01'){

$ano = date("Y")-1;;	
	
}elseif($_POST["ano"]=='02'){
	
	$ano = date("Y");
	
}
$mes = $_POST["mes"];

$DF_ANO = $ano;			
$DF_COD_PER = $mes;			


$stid = oci_parse($conn, 'begin CAP_ENDEUDAR( :DF_ANO, :DF_COD_PER, :RETORNO );end;');

 // Bind the input parameter

oci_bind_by_name($stid,':DF_ANO',$DF_ANO);
oci_bind_by_name($stid,':DF_COD_PER',$DF_COD_PER);

// Bind the output parameter
oci_bind_by_name($stid,':RETORNO',$RETORNO,1);

oci_execute($stid);

if(oci_execute($stid)){
	//echo '1';
	
	$query= oci_parse($conn, "select b.CEDULA AS CEDULA, B.NOM_EPL as NOMBRE, B.APE_EPL AS APELLIDO, a.VALOREND AS VALOR, a.MES AS MES, a.ANO AS ANO from cap_endeudamiento a, empleados_basic b where mes='$mes' and ano='$ano' and a.cod_epl = b.cod_epl");
	oci_execute($query);
	echo '<table width="50%" border="1" cellpadding="10" cellspacing="0" bordercolor="#666666" id="Exportar_a_Excel" style="border-collapse:collapse;">
		<tr>
		<td>CEDULA</td>
		<td>NOMBRE Y APELLIDO</td>
		<td>VALOR ENDEUDAMIENTO</td>
		<td>MES</td>
		<td>ANO</td>
		</tr>
		</table>';
	
	while (oci_fetch($query)){
		echo '<table width="50%" border="1" cellpadding="10" cellspacing="0" bordercolor="#666666" id="Exportar_a_Excel" style="border-collapse:collapse;">
		<tr>
		<td>'.oci_result($query, 'CEDULA').'</td>
		<td>'.oci_result($query, 'NOMBRE').' '.oci_result($query, 'APELLIDO').'</td>
		<td>'.oci_result($query, 'VALOR').'</td>
		<td>'.oci_result($query, 'MES').'</td>
		<td>'.oci_result($query, 'ANO').'</td>
		</tr>
		</table>';

	}
	//header('Location: capac_endu.php?ok=1');
		}else{
		//echo '0';
		header('Location: capac_endu.php?ok=0');
		}

?>