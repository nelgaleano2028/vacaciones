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
$flag = 1;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
$flag = 2;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
$flag = 2;
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
$flag = 2;
}
//------------------------------FIN antidoto

class comprobante{
    
    private $lista;
    private $ano=0;
   
    private $liq_ini;
    private $per_ini;
    private $tip_pag;
    private $cod_emp;
    private $codigo;
    
   
    
    
    /*
     *@method neto_pagar genera el neto a pagar del empleado
     *@param $type indicamos que dato queremos mostrar
     *si es 1 mostramos total_devengos
     *si es 2 mostramos total_deducciones
     *si es 3 ostramos neto_apagar
     *
    */
    
        function neto_pagar($type){
	
	global $conn;
	
	$sql="select sum(tot_dev) as TOT_DEV,sum(tot_ded) AS TOT_DED, (sum(tot_dev) - sum(tot_ded))as TOTAL
from totales_pago t, empleados_basic e
where t.ano_ini='$this->ano' and t.liq_ini in ('2','3','5','6','7','8','9','11','14')
and t.per_fin = $this->per_ini
and t.tip_pag = e.tip_pago
and t.cod_epl = e.cod_epl
and t.cod_epl='".$this->codigo."'";
	     
	      $array=null;
	
	$rs=$conn->Execute($sql);
	if($rs){
	$fila=@$rs->FetchRow();
	
	switch($type){
	  case 1:
	  $array=$fila["TOT_DEV"];
	  break;
	  case 2:
	  $array=$fila["TOT_DED"];
	  break;
	 case 3:
	  $array=$fila["TOTAL"];
	  break;
	}
	
	}else{
	    
	    $array=null;
	}
	return $array;
	     
	     
    }
    



    
     /*@method consulta_de_empl me trae los empleados que cumpla con el filtro
     *que realiza la encargada/o de la nomina 
     */
    function consulta_de_empl(){
	
	
	
	 $sql="select a.cod_epl AS COD_EPL,a.cedula AS CEDULA,a.nom_epl AS NOM_EPL,a.ape_epl AS APE_EPL,c.nom_car AS NOM_CAR,b.nom_CC2 AS NOM_CC2
from empleados_basic a,CENTROCOSTO2 b,cargos c
where a.cod_CC2 = b.cod_CC2
and a.cod_car=c.cod_car
and a.cod_epl
in (select distinct cod_epl from totales_pago
where ano_ini='$this->ano' and liq_ini in ('2','3','5','6','7','8','9','11','14')
and per_fin = '$this->per_ini'
and tip_pag in (2,3)
) and a.estado='A' order by nom_epl";
	     
	     try{
		
		global $conn;//llamo la variable global para realiza un conexion a la nd
	        $array=array();//Creo un objeto el cual me captura los resultados de la sentencia
		
		$rs=$conn->Execute($sql);//ejecuto la sentencia sql
	
	        if($rs){//valido si $rs contiene datos 
	    
	        while($fila=@$rs->FetchRow()){
	    
	        $array[]=array("codigo"=>$fila["COD_EPL"],
			   "nombre"=>$fila["NOM_EPL"],
			   "apellido"=>$fila["APE_EPL"],
			   "cargo"=>$fila["NOM_CAR"],
			   "area"=>$fila["NOM_CC2"],
			   "cedula"=>$fila["CEDULA"]);
	    
	       }
	       }else{
		$array=null;
		
	       }
	     }catch(exception $e){
		
		echo "Error: ".$e;
	     }

	return $array;
	
    }
    
    public function set_ano($ano){
	
	$this->ano=$ano;
    }
    public function set_liq_ini($liq_ini){
	
	$this->liq_ini=$liq_ini;
    }
    public function set_per_ini($per_ini){
	$this->per_ini=$per_ini;
    }
    public function set_tip_pag($tip_pag){
	$this->tip_pag=$tip_pag;
    }
    public function set_cod_emp($cod_emp){
	$this->cod_emp=$cod_emp;
    }
    public function set_codigo($codigo){
	$this->codigo=$codigo;
    }

    
    
	
	
    public function get_ano(){
	return $this->ano;
    }
    public function get_liq_ini(){
	return $this->liq_ini;
    }
    public function get_per_ini(){
	return $this->per_ini;
    }
    public function get_tip_pag(){
	return $this->tip_pag;
    }
    public function get_cod_emp(){
	return $this->cod_emp;
    }
    public function get_codigo(){
	return $this->codigo;
    }
  
     public function return_sql($codigo,$ano,$liqui,$per,$tip){
	 
  if($flag == 2){
    
    $sql="
	SELECT h.cod_epl AS COD_EPL,h.ape_epl AS APE_EPL,h.nom_epl AS NOM_EPL,h.cedula AS CEDULA,h.nom_ban AS NOM_BAN,
case when t.cod_ban=13 then substr (t.cod_suc, 1, 3)||t.num_cta else t.num_cta end AS NUM_CTA,h.nom_sucur AS NOM_SUCUR,h.consigna AS CONSIGNA,
h.numerocomp AS NUMEROCOMP,h.n_dia_ini AS N_DIA_INI,h.n_dia_fin AS N_DIA_FIN,h.n_mes AS N_MES,h.codcon1 AS CODCON1,h.nomcon1 AS NOMCON1,h.can1 AS CAN1,
h.val1 AS VAL1,h.codcon2 AS CODCON2,h.nomcon2 AS NOMCON2,h.can2 AS CAN2,h.val2 AS VAL2,
h.codemp AS CODEMP,h.coddep AS CODDEP,h.codcc2 AS CODCC2,h.nomcc2 AS NOMCC2,h.nomcar AS NOMCAR,h.salbas AS SALBAS,
h.direpl AS DIREPL,h.ubiepl AS UBIEPL,h.pagina AS PAGINA,h.nomcc AS NOMCC,h.campo1 AS CAMPO1,
h.cnsctvo AS CNSCTVO,h.ciu_tra AS CIU_TRA,h.nom_ciu_tra AS NOM_CIU_TRA,h.codcc AS CODCC,h.nomcc AS NOMCC,
h.codcar AS CODCAR,h.campo5 AS CAMPO5, (case when T.TIP_CTA = 2 then 'AHORROS' else 'CORRIENTE' END )AS TIPO_CUENTA,
h.campo5 AS SALDO
FROM det_compro h, TOTALES_PAGO T, cuotas c, 
(select x.cod_epl, x.numerocomp, min(x.cnsctvo) consecutivo
from det_compro x
where x.cod_epl = '".$codigo."'
and   x.numerocomp in (select num_com from totales_pago 
                   where ano_ini = '".$ano."'
                   and liq_ini in ('2','3','5','6','7','8','9','11','14') 
                   and per_fin = '".$per."'
                   and x.cod_epl=totales_pago.cod_epl   
                   and x.cod_epl ='".$codigo."')
group by cod_epl, numerocomp)b
WHERE   
h.cod_epl = b.cod_epl
and h.numerocomp = b.numerocomp
and h.cod_epl = t.cod_epl
and h.numerocomp = t.num_com
and h.cnsctvo <= b.consecutivo+50
and h.cod_epl = c.cod_epl(+)
and h.codcon2 = c.cod_con(+)
and (h.codcon1 is not null or h.codcon2 is not null)
GROUP BY h.cod_epl, h.ape_epl,h.nom_epl,h.cedula,h.nom_ban,
t.cod_ban, t.cod_suc, t.num_cta,h.nom_sucur,h.consigna,h.numerocomp,
h.n_dia_ini,h.n_dia_fin,h.n_mes,h.codcon1,h.nomcon1,h.can1,
h.val1,h.codcon2,h.nomcon2,h.can2,h.val2,
h.codemp,h.coddep,h.codcc2,h.nomcc2,h.nomcar,h.salbas,
h.direpl,h.ubiepl,h.pagina,h.nomcc,h.campo1,
h.cnsctvo,h.ciu_tra ,h.nom_ciu_tra,h.codcc,h.nomcc,
h.codcar,h.campo5 , T.TIP_CTA
order by cnsctvo
";
}else{	
    $sql="
SELECT h.cod_epl AS COD_EPL,h.ape_epl AS APE_EPL,h.nom_epl AS NOM_EPL,h.cedula AS CEDULA,h.nom_ban AS NOM_BAN,
t.num_cta AS NUM_CTA,h.nom_sucur AS NOM_SUCUR,h.consigna AS CONSIGNA,
h.numerocomp AS NUMEROCOMP,h.n_dia_ini AS N_DIA_INI,h.n_dia_fin AS N_DIA_FIN,h.n_mes AS N_MES,h.codcon1 AS CODCON1,h.nomcon1 AS NOMCON1,h.can1 AS CAN1,
h.val1 AS VAL1,h.codcon2 AS CODCON2,h.nomcon2 AS NOMCON2,h.can2 AS CAN2,h.val2 AS VAL2,
h.codemp AS CODEMP,h.coddep AS CODDEP,h.codcc2 AS CODCC2,h.nomcc2 AS NOMCC2,h.nomcar AS NOMCAR,h.salbas AS SALBAS,
h.direpl AS DIREPL,h.ubiepl AS UBIEPL,h.pagina AS PAGINA,h.nomcc AS NOMCC,h.campo1 AS CAMPO1,
h.cnsctvo AS CNSCTVO,h.ciu_tra AS CIU_TRA,h.nom_ciu_tra AS NOM_CIU_TRA,h.codcc AS CODCC,h.nomcc AS NOMCC,
h.codcar AS CODCAR,h.campo5 AS CAMPO5, (case when T.TIP_CTA = 2 then 'AHORROS' else 'CORRIENTE' END )AS TIPO_CUENTA,
h.campo5 AS SALDO
FROM det_compro h, TOTALES_PAGO T, cuotas c, 
(select x.cod_epl, x.numerocomp, min(x.cnsctvo) consecutivo
from det_compro x
where x.cod_epl = '".$codigo."'
and   x.numerocomp in (select num_com from totales_pago 
                   where ano_ini = '".$ano."'
                   and liq_ini in ('2','3','5','6','7','8','9','11','14') 
                   and per_fin = '".$per."'
                   and x.cod_epl=totales_pago.cod_epl   
                   and x.cod_epl ='".$codigo."')
group by cod_epl, numerocomp)b
WHERE   
h.cod_epl = b.cod_epl
and h.numerocomp = b.numerocomp
and h.cod_epl = t.cod_epl
and h.numerocomp = t.num_com
and h.cnsctvo <= b.consecutivo+50
and h.cod_epl = c.cod_epl(+)
and h.codcon2 = c.cod_con(+)
and (h.codcon1 is not null or h.codcon2 is not null)
GROUP BY h.cod_epl, h.ape_epl,h.nom_epl,h.cedula,h.nom_ban,
t.cod_ban, t.cod_suc, t.num_cta,h.nom_sucur,h.consigna,h.numerocomp,
h.n_dia_ini,h.n_dia_fin,h.n_mes,h.codcon1,h.nomcon1,h.can1,
h.val1,h.codcon2,h.nomcon2,h.can2,h.val2,
h.codemp,h.coddep,h.codcc2,h.nomcc2,h.nomcar,h.salbas,
h.direpl,h.ubiepl,h.pagina,h.nomcc,h.campo1,
h.cnsctvo,h.ciu_tra ,h.nom_ciu_tra,h.codcc,h.nomcc,
h.codcar,h.campo5 , T.TIP_CTA
order by cnsctvo
";
}
 return $sql;
 
 
   }
    function comprobante(){
        
        
          global $conn, $is_connect;
        

 
 

			 
		 $res=$conn->Execute($this->return_sql($this->codigo,$this->ano, $this->liq_ini,$this->per_ini,$this->tip_pag));
		 if($res){
			 $this->lista = array();
			while($row = @$res->FetchRow()){

				$this->lista[] = array("cod_epl"=>$row["COD_EPL"],
							"ape_epl"=>utf8_encode($row["APE_EPL"]),
							"nom_epl"=>utf8_encode($row["NOM_EPL"]),
														"saldo"=>$row["SALDO"],
                                                        "cedula"=>$row["CEDULA"],
                                                        "nom_ban"=>utf8_encode($row["NOM_BAN"]),
                                                        "num_cta"=>$row["NUM_CTA"],
                                                        "nom_sucur"=>utf8_encode($row["NOM_SUCUR"]),
                                                        "consigna"=>$row["CONSIGNA"],
                                                        "numerocomp"=>$row["NUMEROCOMP"],
                                                        "n_dia_ini"=>$row["N_DIA_INI"],
                                                         "n_dia_fin"=>$row["N_DIA_FIN"],
                                                        "n_mes"=>$row["N_MES"],
                                                        "codcon1"=>$row["CODCON1"],
                                                        "nomcon1"=>utf8_encode($row["NOMCON1"]),
                                                         "can1"=>$row["CAN1"],
                                                        "val1"=>$row["VAL1"],
                                                        "codcon2"=>$row["CODCON2"],
                                                        "nomcon2"=>$row["NOMCON2"],
                                                        "can2"=>$row["CAN2"],                                                        
                                                        "val2"=>$row["VAL2"],
                                                        "codemp"=>$row["CODEMP"],
                                                        "coddep"=>$row["CODDEP"],                                                        
                                                        "codcc2"=>$row["CODCC2"],                                                        
                                                        "nomcc2"=>$row["NOMCC2"],                                                        
                                                        "nomcar"=>$row["NOMCAR"],                                                        
                                                        "salbas"=>$row["SALBAS"],                                                        
                                                        "direpl"=>$row["DIREPL"],                                                        
                                                        "ubiepl"=>$row["UBIEPL"],
                                                        "pagina"=>$row["PAGINA"],
                                                        "nomcc"=>$row["NOMCC"],                                                        
                                                        "campo1"=>$row["CAMPO1"],                                                        
                                                        "nomcc"=>$row["NOMCC"],                                                        
                                                        "cnsctvo"=>$row["CNSCTVO"],                                                        
                                                        "ciu_tra"=>$row["CIU_TRA"],
                                                        "nom_ciu_tra"=>$row["NOM_CIU_TRA"],                                                        
                                                        "codcc"=>$row["CODCC"],
                                                        "nomcc"=>$row["NOMCC"],
                                                        "codcar"=>$row["CODCAR"],
                                                        "campo5"=>$row["CAMPO5"]);				
			}			
		 }
		else {
			$this->lista = NULL;
		}
		//$res->Close();
    }
	
   function get_lista(){
	   
	   return $this->lista;
   }
   
   function datos($type){
   
    global $conn, $is_connect;
    $array=null;
    
    $rs=$conn->Execute($this->return_sql($this->codigo,$this->ano, $this->liq_ini,$this->per_ini,$this->tip_pag));
    if($rs){
    $fila=@$rs->FetchRow();
    
    switch($type){
	case 1:
	    $array=$fila["COD_EPL"];
	    break;
	case 2:
	    $array=$fila["NOM_EPL"];
	    break;
	case 3:
	    $array=$fila["APE_EPL"];
	    break;
	case 4:
	    $array=$fila["CEDULA"];
	    break;
	case 5:
	    $array=$fila["NOM_EMP"];
	    break;
	case 6:
	    $array=$fila["SALBAS"];
	    break;
	case 7:
	    $array=$fila["NOMCAR"];
	    break;
	case 8:
	    $array=$fila["CAMPO1"];
	    break;
	case 9:
	    $array=$fila["CONSIGNA"];
	    break;
	case 10:
	    $array=$fila["NOM_BAN"];
	    break;
	case 11:
	    $array=$fila["NUM_CTA"];
	    break;
	case 12:
	    $array=$fila["NUMEROCOMP"];
	    break;

    }
    
    }else{
	
	$array=null;
    }
    return $array;
   }
   
   function area(){
    
    $sql="select a.cod_epl AS COD_EPL, a.estado AS ESTADO, a.cod_dep AS COD_DEP, b.nom_CC2 AS NOM_CC2
         from empleados_basic a,CENTROCOSTO2 b
         where a.cod_CC2 = b.cod_CC2
         and a.cod_epl='".$this->codigo."' --Area empleado--";
	 
	 
	     global $conn, $is_connect;
    $array=null;
    
    $rs=$conn->Execute($sql);
    if($rs){
    $fila=@$rs->FetchRow();
    
      $array=$fila["NOM_CC2"];
    
    }else{
	
	$array=null;
    }
    return $array;
         
	 
   }
   function empresa($type){
    
    if($this->ano <= "2011"){
		   $sql="
				SELECT emp.nom_emp AS NOM_EMP,emp.email AS EMAIL
				FROM empresas emp
				WHERE emp.cod_emp='1'
				";
	}else{
		$sql="SELECT emp.nom_emp AS NOM_EMP,emp.email AS EMAIL
				FROM empresas emp
				WHERE emp.cod_emp='2'";
	}
 

  global $conn, $is_connect;
    $array=null;
    
    $rs=$conn->Execute($sql);
    if($rs){
    $fila=@$rs->FetchRow();
    
    switch($type){
      case 1:
      $array=$fila["NOM_EMP"];
      break;
      case 2:
      $array=$fila["EMAIL"];
      break;
    }
    
    }else{
	
	$array=null;
    }
    return $array;
   }
   
   
       function email_empleado($cedula){
	
	$sql="select email AS EMAIL from empleados_gral g, empleados_basic b 
             where g.cod_epl=b.cod_epl and b.cod_epl='".$cedula."'";
    
         global $conn, $is_connect;
	 $array=null;
	
	$rs=$conn->Execute($sql);
	if($rs){
	$fila=@$rs->FetchRow();
	
	
	  $array=$fila["EMAIL"];
	
	
	}else{
	    
	    $array=null;
	}
	return $array;
	
    }
    
    /*funcion para saber la fecha que se genero el comprobante*/

function fecha_comprobante(){
	
    global $conn,$odbc;

if($odbc=="odbc_mssql"){
	$sql="select top(1) (convert(varchar,b.fec_ini,103)+' - '+ convert(varchar,b.fec_fin,103)) as FECHA 
          from totales_pago a 
          inner join periodos b on a.tip_pag=b.tip_per
          where b.ano='$this->ano'
              and b.cod_per='$this->per_ini'  
              and b.tip_per='$this->tip_pag' 
              and a.cod_epl = '$this->codigo'";

}elseif($odbc=="oci8"){
    
    $sql="
       select (TO_CHAR(b.fec_ini,'DD-MM-YYYY') ||' - '|| TO_CHAR(b.fec_fin,'DD-MM-YYYY')) as FECHA
from totales_pago a, empleados_basic e, periodos b
where a.cod_epl ='$this->codigo' and
a.cod_epl = e.cod_epl and
e.tip_pago = b.tip_per and
a.ano_ini = b.ano and
a.per_ini = b.cod_per and
b.ano = '$this->ano' and
b.cod_per = '$this->per_ini'";

    
}
	      
	      $array=null;
	      $rs=$conn->Execute($sql);
	      if($rs){
	$fila=@$rs->FetchRow();
	
	
	  $array=$fila["FECHA"];
	
	
	}else{
	    
	    $array=null;
	}
	return $array;
    }
    
    
    





        
    
    
    
}


?>