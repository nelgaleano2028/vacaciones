<?php
@session_start();
include_once('../lib/adodb/adodb.inc.php');
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
//------------------------------FIN antidoto

//fechas para validacion, cambian formato
$fec_emision_valida = date("Y/m/d",strtotime($_POST["fecha_ini"]));
$hoydos = date("Y/m/d");
//------------------------------fin

$fec_emision = date("m/d/Y",strtotime($_POST["fecha_ini"]));
$codigo= $_POST["cod_epl"];

$fecha = explode("/", $fec_emision);
$can_dias = $_POST["dias"]-1;
@$nom_aus=$_POST["nom_aus"];
@$cod_aus=$_POST["cod_aus"];
@$cod_con=$_POST["cod_con"];
$fecha_a_evaluarini = $_POST["fecha_ini"];


if ($fec_emision_valida <= $hoydos){

if($nom_aus=='Licencia de Paternidad'){

	if(($can_dias+1)>8){
		
	echo  '10';
	
	die();
	}
	
$can_dias = $_POST["dias"];

	$fec_emision = date("m/d/Y",strtotime($_POST["fecha_ini"]));

$fecha = explode("/", $fec_emision);

$fecha_c=$fecha[1].'-'.$fecha[0].'-'.$fecha[2];

$sq="select * from feriados where FEC_FER=to_date('".$fecha_c."','DD-MM-YY')";

$rs1 = $conn->Execute($sq);

$rows1 = $rs1->fetchrow();

$fecha_validar = $rows1['FEC_FER'];

$fec_emisionfds= $_POST["fecha_ini"];

$fds = strtotime($fec_emisionfds);

if( date('l',$fds) == 'Saturday' || date('l',$fds) == 'Sunday' )
{
    $fdsok = '2';
}


if($fecha_validar || $fdsok){
	
	echo "1";

	
}  else{

	$contador=0;
	
	if($can_dias==1){
		
		echo $fecha_c;
		
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


				
				if(date('l',$dias) == 'Saturday' || date('l',$dias) == 'Sunday' || $festivo==1 ){

                                         $acu_vaca= $dias + 24*60*60;


					$acu_vaca=date("d-m-Y",$acu_vaca);


					 $can_dias++;

					
				
				}
			}

		}	
		echo $acu_vaca;
		
		}

}
die();
		
}

//Query para verificar que la fecha solicitada no se encuentre registrada dentro  del rango con un solo dia
$qry19="SELECT COD_AUS AS COD FROM incapacidades_tmp
WHERE
estado in ('P','C') and cod_epl='".$codigo."'
and (to_date('$fecha_a_evaluarini','DD-MM-YY') between fec_ini and fec_fin or
to_date('$fecha_a_evaluarini','DD-MM-YY') between fec_ini and fec_fin)";

$res19= $conn->Execute($qry19);
$row19 = $res19->FetchRow();
$fecharegisuno = $row19["COD"];

//Query para verificar que la fecha solicitada no se encuentre registrada inicialemnete
$qry18="select fec_ini AS FECHAINI from incapacidades_tmp where  estado in ('P','C') and cod_epl='".$codigo."' and fec_ini = to_date('".$fecha_a_evaluarini."','DD-MM-YY') ";


$res18= $conn->Execute($qry18);
$row18 = $res18->FetchRow();
$fecharepe = $row18["FECHAINI"];


if(isset($fecharegisuno)){
	echo '4';
}else

	if(isset($fecharepe)){
		echo '4';
	}else{


$fecha_c=$fecha[1].'-'.$fecha[0].'-'.$fecha[2];

echo $fecha_final= date("d-m-Y", strtotime("$fec_emision + $can_dias days"));}
}else{
echo '2';	
}
?>