<?php
@session_start();
include_once('../lib/adodb/adodb.inc.php');
include_once('../lib/configdb.php');

//fechas para validacion, cambian formato
$fec_emision_valida = date("Y/m/d",strtotime($_POST["fecha_ini"]));
$hoydos = date("Y/m/d");
//------------------------------fin

$fec_emision = date("m/d/Y",strtotime($_POST["fecha_ini"]));
$codigo=$_SESSION['cod'];

$fecha = explode("/", $fec_emision);
$can_dias = $_POST["dias"];
 @$cod_aus='1';
 @$cod_con='1017';
$fecha_a_evaluarini = $_POST["fecha_ini"];
//$fecha_a_evaluarfin = '15-09-2013';


//Query para verificar que la fecha solicitada no se encuentre registrada
$qry18="select fec_ini AS FECHAINI from ausencias_tmp where fec_ini = to_date('".$fecha_a_evaluarini."','DD-MM-YY') and estado in ('P','C') and cod_epl='".$codigo."'";
$res18= $conn->Execute($qry18);
$row18 = $res18->FetchRow();
$fecharepe = $row18["FECHAINI"];

//VALIDAMOS LA CANTIDAD DE DIAS SOLICITADOS NO EXCEDA EL LIMITE
$qry13="select * from ausencias_tmp where cod_con='".$cod_con."' and cod_aus='".$cod_aus."' and estado = 'P' and cod_epl='".$codigo."'";
$res13= $conn->Execute($qry13); 

if($res13){
	while($row13 = $res13->FetchRow()){

		$sumatotaldiasa += $row13["DIAS"];			
	}
}
$qry14="SELECT X.FEC_PER_INI AS FEC_INI_PERIODO, X.FEC_PER_FIN AS FEC_FIN_PERIODO, CASE WHEN SUM(DIAS_TOMADOS) > 0 THEN 15-SUM(DIAS_TOMADOS) ELSE 
CASE WHEN TO_DATE (X.FEC_PER_FIN, 'YY-MM-DD') -TO_DATE (X.FEC_PER_INI, 'YY-MM-DD')  >= 360 THEN 15
ELSE TRUNC (((TO_DATE (X.FEC_PER_FIN, 'YY-MM-DD') -TO_DATE (X.FEC_PER_INI, 'YY-MM-DD'))*15)/360)  END
END  AS DIAS_PENDIENTE , 'PENDIENTE'                          
FROM  
(SELECT  DISTINCT P.ANO , e.cod_epl, p.tip_per, 
to_date (extract (day from to_date (E.fec_ing, 'YY-MM-DD'))||'-'||
                extract (month from to_date (E.fec_ing, 'YY-MM-DD'))||'-'||p.ano, 'DD-MM-YY') FEC_PER_INI,
 CASE WHEN to_date (extract (day from to_date (fec_ing, 'YY-MM-DD'))||'-'||
                extract (month from to_date (fec_ing, 'YY-MM-DD'))||'-'||(p.ano+1), 'DD-MM-YY')-1 >SYSDATE 
                         THEN TO_DATE (SYSDATE, 'YY-MM-DD')
                ELSE to_date (extract (day from to_date (fec_ing, 'YY-MM-DD'))||'-'||
                extract (month from to_date (fec_ing, 'YY-MM-DD'))||'-'||(p.ano+1), 'DD-MM-YY')-1 END 
                 FEC_PER_FIN
 FROM EMPLEADOS_BASIC E , PERIODOS P
WHERE E.TIP_PAGO = P.TIP_PER
AND P.FEC_INI >= E.FEC_ING
AND P.ANO < EXTRACT (YEAR FROM TO_DATE (SYSDATE, 'YY-MM-DD'))+1
AND E.COD_EPL ='".$codigo."') X, ACUMU_VACACIONES V
WHERE X.COD_EPL= V.COD_EPL(+)
AND  X.FEC_PER_INI=V.FEC_CAU_INI(+)
GROUP BY X.FEC_PER_INI, X.FEC_PER_FIN
HAVING CASE WHEN SUM(DIAS_TOMADOS) > 0 THEN 15-SUM(DIAS_TOMADOS) ELSE 
CASE WHEN TO_DATE (X.FEC_PER_FIN, 'YY-MM-DD') -TO_DATE (X.FEC_PER_INI, 'YY-MM-DD')  >= 360 THEN 15
ELSE ROUND (((TO_DATE (X.FEC_PER_FIN, 'YY-MM-DD') -TO_DATE (X.FEC_PER_INI, 'YY-MM-DD'))*15)/360 ,0) END
END >0
ORDER BY X.FEC_PER_INI";
$res= $conn->Execute($qry14); 

if($res){
	while($row14 = $res->FetchRow()){

		$sumatotaldiasb += $row14["DIAS_PENDIENTE"];			
	}
}

$sumadedias = $can_dias + $sumatotaldiasa;

if(isset($fecharepe)){
echo '4';
}else

{


$fecha_c=$fecha[1].'-'.$fecha[0].'-'.$fecha[2];

$sq="select * from feriados where FEC_FER=to_date('".$fecha_c."','DD-MM-YY')";

$rs1 = $conn->Execute($sq);

$rows1 = $rs1->fetchrow();

$fecha_validar = $rows1['FEC_FER'];


//$fec_emisionfds= '27-07-2013';
$fec_emisionfds= $_POST["fecha_ini"];

$fds = strtotime($fec_emisionfds);

if( date('l',$fds) == 'Saturday' || date('l',$fds) == 'Sunday' )
{
    $fdsok = '2';
}

if ($fec_emision_valida > $hoydos){

if($fecha_validar || $fdsok){
	
	echo "1";

	
}  else{

	$contador=0;
	
	if($can_dias==1){
		
		echo $fecha_c;
		//echo "hola1";
	}else{
		
		$can_dias=$can_dias-1;
		
		$startDate = strtotime($fecha_c);

		$fecha_festivo=date("d-m-Y",  $startDate);
			
                $bandera=0;

		
		while($can_dias>0){
			
			$can_dias--;

			
     if( $bandera ==0 ){
			//consulto en la base de datos si hay festivos
			$query3 = "SELECT * FROM FERIADOS WHERE FEC_FER = TO_DATE('$fecha_festivo','DD-MM-YYYY')";
			$rs3 = $conn->Execute($query3);
			$rs3->fetchrow();

	  		if($rs3->RecordCount()!= 0){
		
	      			$festivos=1;

         		 }else{
		
               			$festivos=0;
          		}
			
			
			
			if(date('l',$startDate) == 'Saturday' || date('l',$startDate) == 'Sunday' || $festivos==1 ){

				 $startDate= $startDate + 24*60*60;
				 
				 $fecha_festivo=date("d-m-Y",  $startDate);
				
				$can_dias++;
		         
					
			}else{
				
				 $startDate= $startDate + 24*60*60;
				 
				 $fecha_festivo=date("d-m-Y",  $startDate);
				 
				 $acu_vaca=date("d-m-Y",  $startDate);
	
			}
              
    }


			if($can_dias==0){



                                       
                                        
				 $bandera=1;


			        $query4 = "SELECT * FROM FERIADOS WHERE FEC_FER = TO_DATE('$acu_vaca','DD-MM-YYYY')";
				$rs4 = $conn->Execute($query4);
				$rs4->fetchrow();

	  			if($rs4->RecordCount()!= 0){
		
	      				$festivo=1;

         		 	}else{
		
               				$festivo=0;
          			}
                                  
                                   
                                $dias=strtotime($acu_vaca);
//echo $dias;die("");

				
				if(date('l',$dias) == 'Saturday' || date('l',$dias) == 'Sunday' || $festivo==1 ){

                                         $acu_vaca= $dias + 24*60*60;


					$acu_vaca=date("d-m-Y",$acu_vaca);


					 $can_dias++;

					
				
				}
			}

		}	
		
		$qry1="SELECT COD_CON AS COD FROM ausencias_tmp 
WHERE 
cod_con='".$cod_con."' and cod_aus='".$cod_aus."' and estado in ('P','C') and cod_epl='".$codigo."'
and (fec_ini between to_date('$fecha_a_evaluarini','DD-MM-YY') and to_date('$acu_vaca','DD-MM-YY') or
     fec_fin  between to_date('$fecha_a_evaluarini','DD-MM-YY') and to_date('$acu_vaca','DD-MM-YY'))";
$res= $conn->Execute($qry1); 
$rownice = $res->FetchRow();

if (isset($rownice["COD"])){
echo '4';	
}else{
		
		echo $acu_vaca;
}
		//echo "hola2";
		
	}

}
}else{
echo '2';	
}
}

?>