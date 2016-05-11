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
$rowt= $rs->fetchrow();

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
/*
En esta clase se encuentran todas las sentencias sql para mostrarlas en la hoja de vida del empleado
*/
class class_hoja{
	
	
	private $cod_empleado;
	
	private $lista=array();
	private $lista1=array();
	private $lista2=array();
	private $lista3=array();
	private $lista4=array();
	private $lista5=array();
	private $lista6=array();
	private $lista7=array();
	private $lista8=array();
	private $lista9=array();
	private $lista10=array();
	private $lista11=array();
	private $lista12=array();
	private $lista13=array();
	private $lista15=array();
	private $lista16;
	private $lista17=array();
	private $lista18=array();
	
	
	public function __construct($cod_empleado){
		$this->cod_empleado=$cod_empleado;
	}
	
	
	 public function set_num_comp($num_com){
       
       $this->num_com=$num_com;
   }
   
	public function get_num_comp(){
       
       return $this->num_com;
   }
	
	
	
	//Comprobantes de Pagp
	public function ultimos_comprobantes(){
     
     try{
              //variable global de conexion y del ADODB
          global $conn,$odbc;

         if($odbc=="odbc_mssql"){
         
         //Sentencia sql 5 ultimos comprobantes
         $sql="select top(5) convert(int,num_com)as num_com,
              b.nom_liq,convert(int,per_ini)as per_ini,
              convert(int,ano_ini)as ano_ini ,
              convert(varchar,c.fec_fin,103)as FECHA,a.tip_pag AS TIP_PAG,a.liq_ini AS LIQ_INI
              from totales_pago a,liquidacion b, periodos c
              where b.cod_liq=a.liq_ini  and a.tip_pag=c.tip_per
              and a.per_ini=c.cod_per and a.ano_ini=c.ano and a.cod_epl='".$this->cod_empleado."'
              ORDER BY ano_ini desc, per_ini desc";

               }elseif($odbc=="oci8"){

               $sql="select *
               from (
                      select a.num_com AS NUM_COM, b.nom_liq AS NOM_LIQ,
                      a.per_fin as PER_INI,a.ano_ini as ANO_INI,
                      TO_CHAR(c.fec_fin,'DD-MM-YYYY ')as FECHA,a.tip_pag AS TIP_PAG,a.liq_ini AS LIQ_INI
					  from totales_pago a , liquidacion b , periodos c
					  where b.cod_liq=a.liq_ini  and a.tip_pag=c.tip_per
                       and a.per_ini=c.cod_per and a.ano_ini=c.ano and		  
					   a.cod_epl='".$this->cod_empleado."'
			           ORDER BY a.ano_ini desc,c.fec_fin desc
			        )
                      where  rownum <=5 ";

                }
         
                 
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
         //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista1[]=array("numero"=>$fila["NUM_COM"],
                                      "liquidacion"=>utf8_encode($fila["NOM_LIQ"]),
                                      "periodo"=>$fila["PER_INI"],
                                      "ano"=>$fila["ANO_INI"],
                                      "fecha"=>$fila["FECHA"],
                                      "tipo"=>$fila["TIP_PAG"],
                                      "cod_liq"=>$fila["LIQ_INI"]
                                      );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista1=NULL;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista1;
     
    }
	
	
		
	//Prestamos
	public function prestamos(){
		
		global $conn,$odbc;
		
		        if($odbc=="odbc_mssql"){
		        $sql="select num_cuo as NUM_CUO,convert(varchar,fec_rad,110)as FEC_RAD,vlr_tot as VLR_TOT,sdo_con as SDO_CON,est_cuo as EST_CUO
			      from cuotas  where cod_epl='".$this->cod_empleado."' and est_cuo='P'";
		         
                        }elseif($odbc=="oci8"){
			$sql="select num_cuo as NUM_CUO,TO_CHAR(fec_rad,'DD-MON-YYYY ')as FEC_RAD,vlr_tot as VLR_TOT,sdo_con as SDO_CON,est_cuo as EST_CUO
			  from cuotas  where cod_epl='".$this->cod_empleado."' and est_cuo='P'";
			}
			  
			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista2[] =  array("numero"=>$row["NUM_CUO"],
											"fecha_rad"=>$row["FEC_RAD"],
											"valor"=>$row["VLR_TOT"],
                                        	"saldo"=>$row["SDO_CON"],
                                        	"estado"=>$row["EST_CUO"]);				
				}
			
					
		 	
			}else {
				$this->lista2 = NULL;
			}
			
			return $this->lista2;	
	}
	
	
	
	
	//Embargos
	public function embargos(){
		
		global $conn,$odbc;
		
		        if($odbc=="odbc_mssql"){
		
		$sql="select num_emb as NUM_EMB,convert(varchar,fec_ini_emb,110)as FEC_FIN_EMB,valor as VALOR,saldo as SALDO from 
			  embargos where cod_epl='".$this->cod_empleado."'";
			}elseif($odbc=="oci8"){
		$sql="select num_emb as NUM_EMB, TO_CHAR(fec_fin_emb,'DD-MON-YYYY ')as FEC_FIN_EMB,valor as VALOR,saldo as SALDO
		          from embargos where cod_epl='".$this->cod_empleado."'";
			}  
			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista3[] =  array("numero"=>$row["NUM_EMB"],
								 "fecha_fin"=>$row["FEC_FIN_EMB"],
								 "valor"=>$row["VALOR"],
								 "saldo"=>$row["SALDO"]);				
			}
			
					
		 	
			}else {
				$this->lista3 = NULL;
			}	
		
     		return $this->lista3;	
	}
	
	
	
	
	//Historico de Liquidaciones
	public function historia_liq(){
		
		global $conn,$odbc;
		
		        if($odbc=="odbc_mssql"){
		
		        $sql="select valor as VALOR,cantidad as CANTIDAD,sal_bas as SAL_BAS, convert(varchar,fec_proceso,110)as FEC_PROCESO from historia_liq where cod_epl='".$this->cod_empleado."'";
			}elseif($odbc=="oci8"){
			$sql="select valor as VALOR,cantidad as CANTIDAD,sal_bas as SAL_BAS,TO_CHAR(fec_proceso,'DD-MON-YYYY ')as FEC_PROCESO from historia_liq where cod_epl='".$this->cod_empleado."'";  
			} 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista4[] =  array("fecha_pro"=>$row["FEC_PROCESO"],
											"valor"=>$row["VALOR"],
											"cantidad"=>$row["CANTIDAD"],
                                        						"sueldo"=>$row["SAL_BAS"]);				
				}
			
					
		 	
			}else {
				$this->lista4 = NULL;
			}	
			
			return $this->lista4;	
	}
	

	
	
	public function formas_pago(){
		
		global $conn;
		
		$sql="select a.por_efe as POR_EFE,a.por_che AS POR_CHE,a.por_cons AS POR_CONS,
		        b.num_cta AS NUM_CTA,c.nom_ban AS NOM_BAN
				from formas_pago a,epl_consigna b,bancos c 
				where a.cod_epl=b.cod_epl 
				and b.cod_ban=c.cod_ban 
				and a.cod_epl='".$this->cod_empleado."'
				and b.estado='A'";
			  
			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista5[] =  array("efectivo"=>$row["POR_EFE"],
											"cheque"=>$row["POR_CHE"],
											"consignar"=>$row["POR_CONS"],
											"cuenta"=>$row["NUM_CTA"],
                                        	"banco"=>$row["NOM_BAN"]);				
				}
			
					
		 	
			}else {
				$this->lista5 = NULL;
			}	
		
			return $this->lista5;	
	}
	
	
	
	
	
	public function certificado(){
		
		global $conn,$odbc;
		
		        if($odbc=="odbc_mssql"){
		
		$sql="select cod_epl as COD_EPL,valor as VALOR,meses as MESES,vlr_men as VLR_MEN, convert(varchar,fecha,110)as FECHA from certificados where cod_epl='".$this->cod_empleado."'";
			}elseif($odbc=="oci8"){
		$sql="select cod_epl as COD_EPL,valor as VALOR,meses as MESES,vlr_men as VLR_MEN, TO_CHAR(fecha,'DD-MON-YYYY ')as FECHA from certificados where cod_epl='".$this->cod_empleado."'";	  
			}
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista6[] =  array("valor"=>$row["VALOR"],
											"meses"=>$row["MESES"],
											"valor_men"=>$row["VLR_MEN"],
											"fecha"=>$row["FECHA"]);				
				}
			
					
		 	
			}else {
				$this->lista6 = NULL;
			}	
		
			return $this->lista6;	
	}
	
	
	
	
	
	public function aumentos(){
		
		global $conn;
		
		//52822413
		$sql="select valor_ant AS VALOR_ANT,valor_act as VALOR_ACT,dias_ret AS DIAS_RET,porcentaje AS PORCENTAJE, valor AS VALOR from aumentos where cod_epl='".$this->cod_empleado."'";
			  
			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista7[] =  array("anterior"=>$row["VALOR_ANT"],
											"actual"=>$row["VALOR_ACT"],
											"dias"=>$row["DIAS_RET"],
											"porcentaje"=>$row["PORCENTAJE"],
											"valor"=>$row["VALOR"]);				
				}
			
					
		 	
			}else {
				$this->lista7 = NULL;
			}	
		
			return $this->lista7;	
	}
	
	
	
	
	
	public function cesantias(){
		
		global $conn,$odbc;
		
		        if($odbc=="odbc_mssql"){
		
		
		$sql="SELECT c.valor as VALOR,c.interes AS INTERES, c.tip_pag AS TIP_PAG, f.nombre AS NOMBRE, 
			  convert(varchar(20),c.fecha,103) as FECHA, convert(varchar(20),c.fec_pag_ant,103) as FEC_PAG_ANT, 
			  convert(varchar(20),c.fec_pag_int,103) as  FEC_PAG_INT
			  FROM cesantias c LEFT JOIN fondos f ON f.cod_fon=c.cod_fon 
			  where cod_epl='".$this->cod_empleado."'";
			}elseif($odbc=="oci8"){ 
		$sql="SELECT c.valor as VALOR,c.interes AS INTERES, c.tip_pag AS TIP_PAG, f.nombre AS NOMBRE, 
			  TO_CHAR(c.fecha,'DD-MM-YYYY') as FECHA, TO_CHAR(c.fec_pag_ant,'DD-MM-YYYY') as FEC_PAG_ANT, 
			  TO_CHAR(c.fec_pag_int,'DD-MM-YYYY') as  FEC_PAG_INT
			  FROM cesantias c LEFT JOIN fondos f ON f.cod_fon=c.cod_fon 
			  where cod_epl='".$this->cod_empleado."'";
			}			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista8[] =  array("fecha"=>$row["FECHA"],
											"nombre"=>$row["NOMBRE"],
											"valor"=>$row["VALOR"],
											"tip_pag"=>$row["TIP_PAG"],
											"interes"=>$row["INTERES"],
											"fecha_pago"=>$row["FEC_PAG_ANT"],
											"fecha_pago_interes"=>$row["FEC_PAG_INT"]);				
				}
			
					
		 	
			}else {
				$this->lista8 = NULL;
			}	
		
			return $this->lista8;	
	}
	
	
	
	
	
	public function familiares(){
		
		global $conn,$odbc;
		
		        if($odbc=="odbc_mssql"){
		
		$sql="select cedula as CEDULA,nom_par as NOM_PAR,ape_par as APE_PAR,tip_ocup as TIP_OCUP, convert(varchar,fec_nac,110)as FEC_NAC from  parientes where cod_epl='".$this->cod_empleado."'";
			}elseif($odbc=="oci8"){
		$sql="select cedula as CEDULA,nom_par as NOM_PAR,ape_par as APE_PAR,tip_ocup as TIP_OCUP, TO_CHAR(fec_nac,'DD-MON-YYYY ')as FEC_NAC from  parientes where cod_epl='".$this->cod_empleado."'";				 
			}	
		$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista9[] =  array("cedula"=>$row["CEDULA"],
											"nombre"=>$row["NOM_PAR"],
											"apellido"=>$row["APE_PAR"],
											"ocupacion"=>$row["TIP_OCUP"],
											"fecha_nac"=>$row["FEC_NAC"]);				
				}
			
					
		 	
			}else {
				$this->lista9 = NULL;
			}	
		
			return $this->lista9;	
	}
	
	
	
	
	public function vacaciones(){
		
		global $conn;
		
		
		$sql=" select dias_tomados as DIAS_TOMADOS, valor as VALOR,ano AS ANO,fec_cau_ini as FEC_CAU_INI, fec_cau_fin as FEC_CAU_FIN from acumu_vacaciones where cod_epl='".$this->cod_empleado."' order by ano desc";
						 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista10[] =  array("dias"=>$row["DIAS_TOMADOS"],
											"valor"=>$row["VALOR"],
											"ano"=>$row["ANO"],
											"inicial"=>$row["FEC_CAU_INI"],
											"final"=>$row["FEC_CAU_FIN"]);				
				}
			
					
		 	
			}else {
				$this->lista10 = NULL;
			}	
	
			return $this->lista10;	
	}
	
	
	
	
public function hist_centro_costo(){
        
         try{
global $conn,$odbc;
         
     if($odbc=="odbc_mssql"){
         
         //Sentencia sql del historico de centro de costo
         
	 //SQL SERVER
         $sql="select convert(varchar,fecha,110)as FECHA,
               b.nom_cc as ANTERIOR,c.nom_cc as ACTUAL,
               observacion AS OBSERVACION,usuario AS USUARIO
               from hist_centrocosto a,centrocosto b,centrocosto c 
               where a.ccost_ant=b.cod_cc 
               and a.ccost_act=c.cod_cc
               and cod_epl='".$this->cod_empleado."'";
           }elseif($odbc=="oci8"){//ORACLE
                    $sql="select  TO_CHAR(fecha,'DD-MON-YYYY ')as FECHA,
               b.nom_cc as ANTERIOR,c.nom_cc as ACTUAL,
               observacion AS OBSERVACION,usuario AS USUARIO
               from hist_centrocosto a,centrocosto b,centrocosto c 
                where a.ccost_ant=b.cod_cc 
               and a.ccost_act=c.cod_cc
               and cod_epl='".$this->cod_empleado."'";

                }
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=$rs->FetchRow()){
                 
                 $this->lista11[]=array("anterior"=>utf8_encode($fila["ANTERIOR"]),
                                      "actual"=>utf8_encode($fila["ACTUAL"]),
                                      "observacion"=>utf8_encode($fila["OBSERVACION"]),
                                      "usuario"=>$fila["USUARIO"],
                                      "fecha"=>$fila["FECHA"]
                                      );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista11=NULL;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista11;
        
    }
	
	
	
	public function historico_cargos(){
        
         try{
         
        //variable global de conexion y del ADODB
          global $conn,$odbc;

if($odbc=="odbc_mssql"){
         
         //Sentencia sql del historico de cargos
         
         $sql="select convert(varchar,fecha,110)as FECHA,
              c1.nom_car as ANTERIOR,c2.nom_car as ACTUAL,
              observacion AS OBSERVACION,usuario AS USUARIO
              from historia_cargo h,cargos c1, cargos c2
              where h.cargo_ant = c1.cod_car
	      and h.cargo_act = c2.cod_car
	      and cod_epl='".$this->cod_empleado."'";

	         }elseif($odbc=="oci8"){
                    $sql="select TO_CHAR(fecha,'DD-MON-YYYY ')as FECHA,
              c1.nom_car as ANTERIOR,c2.nom_car as ACTUAL,
              observacion AS OBSERVACION,usuario AS USUARIO
              from historia_cargo h,cargos c1, cargos c2
              where h.cargo_ant = c1.cod_car
          and h.cargo_act = c2.cod_car
          and cod_epl='".$this->cod_empleado."'";
         }
                 
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista12[]=array("anterior"=>$fila["ANTERIOR"],
                                      "actual"=>$fila["ACTUAL"],
                                      "observacion"=>utf8_encode($fila["OBSERVACION"]),
                                      "usuario"=>$fila["USUARIO"],
                                      "fecha"=>$fila["FECHA"]
                                      );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista12=null;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista12;
        
    }
	
	
	
	public function historico_contratos(){
        
         try{
         
                //variable global de conexion y del ADODB
          global $conn,$odbc;

if($odbc=="odbc_mssql"){
         
         //Sentencia sql del historico de contratos
         
         $sql="select convert(varchar,fecha,103)as FECHA,
               con1.nom_cto as ANTERIOR,con2.nom_cto as ACTUAL,observacion AS OBSERVACION,usuario AS USUARIO
               from historia_contrato h,contratos con1,contratos con2
               where 
               h.contr_ant=con1.cod_cto
               and h.contr_act=con2.cod_cto
               and cod_epl='".$this->cod_empleado."'";

                 }elseif($odbc=="oci8"){

                    $sql="select TO_CHAR(fecha,'DD-MON-YYYY ')as FECHA,
               con1.nom_cto as ANTERIOR,con2.nom_cto as ACTUAL,observacion AS OBSERVACION,
               usuario AS USUARIO
               from historia_contrato h,contratos con1,contratos con2
               where 
               h.contr_ant=con1.cod_cto
               and h.contr_act=con2.cod_cto
                and cod_epl='".$this->cod_empleado."'";
          }
                  
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista13[]=array("anterior"=>$fila["ANTERIOR"],
                                      "actual"=>$fila["ACTUAL"],
                                      "observacion"=>utf8_encode($fila["OBSERVACION"]),
                                      "usuario"=>$fila["USUARIO"],
                                      "fecha"=>$fila["FECHA"]
                                      );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista13=NULL;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista13;
    }
	
	 /*
    *@method repor_ultimos_comprobantes Genera los datos
    *de cada comprobante que el usuario selecciona
    */
   public function repor_ultimos_comprobantes($type){
       
       
          try{
            //variable global de conexion y del ADODB
          global $conn,$odbc;

if($odbc=="odbc_mssql"){
        //Sentencia sql 5 ultimos comprobantes
        $sql="select  convert(int,num_com)as NUM_COM,
           convert(int,per_fin)as PER_INI,
              convert(int,ano_ini)as ANO_INI ,a.tip_pag AS TIP_PAG,a.liq_ini AS LIQ_INI
              from totales_pago a
              where a.cod_epl='".$this->cod_empleado."' and a.num_com='$this->num_com'
              ORDER BY ano_ini desc";
         }elseif($odbc=="oci8"){

                 $sql="select a.num_com as NUM_COM,
               a.per_fin as PER_INI,
              ano_ini as ANO_INI ,a.tip_pag AS TIP_PAG,a.liq_ini AS LIQ_INI
              from totales_pago a
              where a.cod_epl='".$this->cod_empleado."' and a.num_com='$this->num_com'
              ORDER BY ano_ini desc";

         }
       
        
        //Ejecutamos la sentencia sql
        $rs=$conn->Execute($sql);
        
        //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
        if($rs){
          $fila=@$rs->FetchRow();
                
                switch($type){
               case "periodo":
                   $this->lista16=@$fila["PER_INI"];
                break;
               case "ano":
                   $this->lista16=@$fila["ANO_INI"];
                break;
               case "liqui":
                   $this->lista16=@$fila["LIQ_INI"];
                break;
               case "tipo":
                   $this->lista16=@$fila["TIP_PAG"];
                break;
               case "num":
                   $this->lista16=@$fila["NUM_COM"];
                break;
      
                }
               
           }else{
               //de lo contrario $this->lista[]==null
             $this->lista16=NULL;
             throw new Exception("No se encontraron datos");
             
           }
        
       }catch(Exception $e){
           
          echo $e->getMessage();
          
       }
    //retornamos los datos
    return $this->lista16;
       
       
   }
   
   
    public function hist_quin_nomina(){

          try{
         
          //variable global de conexion
         global $conn;
        $año=date('Y');
	
	 
         //Sentencia sql de la NOMINA POR QUINCENA
         
         $sql="select tot_dev as TOT_DEV,tot_ded AS TOT_DED, (tot_dev - tot_ded)as TOTAL, per_fin as PER_FIN
	       from totales_pago
	       where ano_ini='".$año."' and liq_ini = (select descripcion from parametros_nue where nom_var='param_quince_liq') 
	       and per_fin in(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24)
	       and tip_pag =(select descripcion from parametros_nue where nom_var='param_quince_tip_pag')
	       
               and cod_epl='".$this->cod_empleado."'";

               //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("devengo"=>$fila["TOT_DEV"],
                               "deducciones"=>$fila["TOT_DED"],
                               "total"=>$fila["TOTAL"],
			       "periodo"=>$fila["PER_FIN"]);
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista=null;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista;
             
}

//Nomina Por Mes
    public function nomina_por_mes(){
        
        
         
          //variable global de conexion
         global $conn;
         $año=date('Y');
         
         $this->lista14=array();
        
            $sql="select tot_dev,tot_ded, (tot_dev - tot_ded)as TOTAL,per_fin as PER_FIN
            from totales_pago
            where ano_ini='".$año."' and liq_ini = (select descripcion from parametros_nue where nom_var='param_mensual_liq')
            and per_ini in(1,2,3,4,5,6,7,8,9,10,11,12) 
            and tip_pag = (select descripcion from parametros_nue where nom_var='param_mens_tipag')
             and cod_epl='".$this->cod_empleado."'
			 order by fecha asc";
    
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista14[]=array("total"=>$fila["TOTAL"],
					"periodos"=>$fila["PER_FIN"]);
                }
            }         
        
     //retornamos los datos
     return $this->lista14;
    
    }
    public function nomina_semanal(){
    	  try{
         
          //variable global de conexion
         global $conn;
        $año=date('Y');
	
	 
         //Sentencia sql de la NOMINA POR SEMANA

        $sql=" select  SUM(tot_dev - tot_ded)as TOTAL, p.mes AS MES
               from totales_pago h left join periodos p
               on h.per_ini = p.cod_per 
               and h.tip_pag = p.tip_per 
               and h.ano_ini = p.ano
               where cod_epl = '".$this->cod_empleado."'
               and h.tip_pag=(select descripcion from parametros_nue where nom_var='param_sema_tip_pag')
               and h.ANO_INI='".$año."'
               and p.mes in(1,2,3,4,5,6,7,8,9,10,11,12)
               GROUP BY p.mes  order by p.mes asc";
         
       

               //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("mes"=>$fila["MES"],
                                      "total"=>$fila["TOTAL"]);
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista=null;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista;
    }

    public function consul_nom_empleado(){
    	 //variable global de conexion
         global $conn;

         $array=null;

         $sql="SELECT ti.tip_per as TIP_PER, ti.nom_tip as NOM_TIP
              FROM TIPOS_PERIODO ti inner join empleados_basic epl on ti.TIP_PER=epl.tip_pago
              where epl.cod_epl='".$this->cod_empleado."'";
        $rs=$conn->Execute($sql);

        if($rs){
        	$fila=@$rs->FetchRow();
		
		$semanal = strpos(strtoupper($fila["NOM_TIP"]), "SEMANAL");
		$quincenal = strpos(strtoupper($fila["NOM_TIP"]), "QUINCENAL");
		$mensual = strpos(strtoupper($fila["NOM_TIP"]), "MENSUAL");
		

        	if($semanal !== false){
        		$array="SEMANAL";
        	}elseif ($quincenal !== false) {
        		$array="QUINCENAL";
        	}elseif ($mensual !== false) {
        		$array="MENSUAL";
        	}
        }

        return $array; 
    }

    public function nomina_empleado(){


         $array=null;

        	if($this->consul_nom_empleado()=="SEMANAL"){
        		$array=$this->nomina_semanal();
        	}elseif ($this->consul_nom_empleado()=="QUINCENAL") {
        		$array=$this->hist_quin_nomina();
        	}elseif ($this->consul_nom_empleado()=="MENSUAL") {
        		$array=$this->nomina_por_mes();
        	}
        

        return $array;     
    }



//Ausencia Por Mes
	public function ausencias_por_mes(){
        
         try{
         
          //variable global de conexion
        global $conn,$odbc;
		
		$anio=date("Y");
		
		        if($odbc=="odbc_mssql"){
	 
         //Sentencia sql del historico de contratos
         
        $sql="select dias as DIAS, convert(varchar,fec_ini,110)as FEC_INI  from ausencias where cod_epl='".$this->cod_empleado."' and fec_ini>'2013-01-01'";
			}elseif($odbc=="oci8"){
	
         
	$sql="select dias as DIAS,TO_CHAR(FEC_INI,'DD-MM-YYYY')as FEC_INI from ausencias where cod_epl='".$this->cod_empleado."' and  fec_ini>TO_DATE('".$anio."-01-01','YYYY-MM-DD') and estado<>'P'";
			}      
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista15[]=array("dias"=>$fila["DIAS"],
                                        "fecha"=>$fila["FEC_INI"]
                                       );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista15=NULL;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista15;
    }
    
    public function meses($mes,$dia){
		
		//var_dump($mes);die("");
		
		global $conn,$odbc;
		
		$anio=date("Y");
		if($odbc=="odbc_mssql"){
		$sql="select convert(varchar(20),a.fec_ini,103) as FEC_INI, convert(varchar(20),a.fec_fin,103) as FEC_FIN, dias as DIAS, cod_epl as COD_EPL,c.nom_con as NOM_CON  from ausencias a, conceptos c
		      where a.cod_epl='".$this->cod_empleado."'
		      and a.fec_ini>='01/$mes/$anio'
		      and a.fec_ini<='$dia/$mes/$anio'
		      and a.cod_con=c.cod_con";
		}elseif($odbc=="oci8"){
		$sql="select TO_CHAR(FEC_INI,'DD-MON-YYYY')as FEC_INI,TO_CHAR(FEC_FIN,'DD-MON-YYYY')as FEC_FIN, dias as DIAS, cod_epl as COD_EPL,c.nom_con as NOM_CON from ausencias a,
                      conceptos c where a.cod_epl='".$this->cod_empleado."' 
		      and FEC_INI>=TO_DATE('$anio-$mes-01','YYYY-MM-DD')
		      and FEC_INI<=TO_DATE('$anio-$mes-$dia','YYYY-MM-DD') and a.cod_con=c.cod_con";	
		}
			//var_dump($mes);die($sql);			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista17[] =  array("codigo"=>$row["COD_EPL"],
											"dias"=>$row["DIAS"],
											"fecha_ini"=>$row["FEC_INI"],
											"fecha_fin"=>$row["FEC_FIN"],
											"tipo_de_ausencia"=>$row["NOM_CON"]);				
				}
			
					
		 	
			}else {
				$this->lista17 = NULL;
			}	
		
			return $this->lista17;	
	}

     
     public function mes($type){
            switch ($type) {
         
                case '1':
                          $mes="Enero";
                          break; 
                case '2':
                          $mes="Febrero";
                          break; 
                case '3':
                          $mes="Marzo";
                          break; 
                case '4':
                          $mes="Abril";
                          break;           
                case '5':
                          $mes="Mayo";
                          break; 
                case '6':
                          $mes="Junio";
                          break; 
                case '7':
                          $mes="Julio";
                          break; 
                case '8':
                          $mes="Agosto";
                          break; 
                case '9':
                          $mes="Septiembre";
                          break;  
                case '10':
                          $mes="Octubre";
                          break; 
                case '11':
                          $mes="Noviembre";
                          break;
                case '12':
                          $mes="Diciembre";
                          break;
            }

           return $mes;
        }


        public function liquidacion_empleado(){
		global $conn;

        	if($this->consul_nom_empleado()=="SEMANAL"){
		 $sql="select descripcion as DESCRIPCION from parametros_nue where nom_var='param_semanal_liq'";
		 $rs=$conn->Execute($sql);
		 $fila=@$rs->FetchRow();
                 $liquidacion=$fila["DESCRIPCION"];
            }elseif ($this->consul_nom_empleado()=="QUINCENAL") {
	         $sql="select descripcion as DESCRIPCION from parametros_nue where nom_var='param_quince_liq'";
		 $rs=$conn->Execute($sql);
		 $fila=@$rs->FetchRow();
                 $liquidacion=$fila["DESCRIPCION"];
            }elseif ($this->consul_nom_empleado()=="MENSUAL") {
	         $sql="select descripcion as DESCRIPCION from parametros_nue where nom_var='param_mensual_liq'";
		 $rs=$conn->Execute($sql);
		 $fila=@$rs->FetchRow();
                 $liquidacion=$fila["DESCRIPCION"];
            }
            return $liquidacion;
        }

        public function seguridad_social(){
        
         try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
	 $sql="select emple.nom_epl,emple.ape_epl,fon.cod_fon as CODIGO,fon.nombre AS NOMBRE,
		      fon_epl.fec_ing AS FECHA_ING,fon_epl.fec_ret AS FECHA_RETI,
		      fon_epl.fec_tras AS FECHA_TRAS
	       from   fondos fon, 
		      epl_fondos fon_epl,
		      empleados_basic emple
	       where  fon_epl.cod_fon=fon.cod_fon
	       and fon_epl.cod_epl=emple.cod_epl
	       and emple.cod_epl='".$this->cod_empleado."' order by fon_epl.fec_ing desc";
         
                  
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista18[]=array("codigo"=>$fila["CODIGO"],
                                      "nombre"=>$fila["NOMBRE"],
                                      "fecha_ing"=>$fila["FECHA_ING"],
                                      "fecha_reti"=>$fila["FECHA_RETI"],
                                      "fecha_tras"=>$fila["FECHA_TRAS"]
                                      );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista18=NULL;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista18;
    }
     
	
}

?>
