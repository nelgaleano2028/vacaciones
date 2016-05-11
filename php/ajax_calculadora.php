<?php
	$sueldo=$_POST["txtValueSalaryCol"];
	$otros_ingresos=$_POST["txtValueUntaxedCol"];
	
	
	$minimo=589500;
	$subsidio_salud=(4/100);
	$fondo_solidaridad=($sueldo*4);
	
	$subsidio_trans=$minimo * 2;
	$transporte_pensiones= ($sueldo * $subsidio_salud);
	$total_ingresos=($otros_ingresos + $sueldo);
	$retencion=0;
	
	
		
	if($sueldo >= $fondo_solidaridad){
		$solidarida=$sueldo * 0.01;
		
	}else{
		$solidarida=0;
	}
	
	if($_POST["txtValueOtherCol"] ==null){
		$aporte_pensiones_voluntarias=0;
	}else{
		$aporte_pensiones_voluntarias=$_POST["txtValueOtherCol"];
	}
	
	if($_POST["txtValueOtherProvisionsCol"] == null){
		$salud_rete=0;
	}else{
		$salud_rete=$_POST["txtValueOtherProvisionsCol"];
	}
	if($sueldo <=  $subsidio_trans){
		$transporte=70500;
	}else{
		$transporte=0;
	}
	
	
	$aporte_fvp=($total_ingresos * 0.3)-($transporte_pensiones - $solidarida);
	$compensacion_neta=0;
	
	/*($total_ingreso + $transporte_pensiones - $transporte_pensiones - $transporte_pensiones - $solidarida - $aporte_fvp - $salud_rete - $retencion);*/
	
	
	$array=array("user" => array("transporte" => "$".$transporte,
								 "salud"=>"$".$transporte_pensiones,
								 "total_ingresos"=>"$".$total_ingresos,
								 "solidaridad"=>"$".$solidarida,
								 "aporte_fvp"=>"$".$aporte_fvp,
								 "aporte_pensiones_v"=>"$".$aporte_pensiones_voluntarias,
								 "salud_rete"=>"$".$salud_rete,
								 "compensacion_neta"=>"$".$compensacion_neta));
	
	echo json_encode($array);
?>