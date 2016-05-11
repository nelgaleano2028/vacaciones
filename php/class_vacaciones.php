<?php
session_start();

include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

$nomadmin = $_SESSION['nom'];

set_time_limit (86400);

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
$empresamail='FUNDACION';
}
if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;
$empresamail='CONFIDENCIAL';
}
if(isset($rowa['NOM_ADMIN'])){
$conn = $config;
$empresamail='TELMOVIL';
}
if(isset($rowt['NOM_ADMIN'])){
$conn = $configt;
$empresamail='TGT';
}

class vacaciones{
    
    private $codigo_jefe=null;
    private $lista=null;
    
    private $concepto=null;
    private $cod_epl=null;
    private $inicial=null;
    private $finall=null;
    private $area=null;
    private $dias=null;
    private $cod_ausencia=null;
    private $consecutivo=null;
    private $observacion=null;
    private $encargado=null;
    
    
    
    public function set_concepto($concepto){
     $this->concepto=$concepto;
    }
     public function set_encargado($encargado){
     $this->encargado=$encargado;
    }
    public function set_observacion($observacion){
        $this->observacion=$observacion;
    }
    public function set_cod_epl($cod_epl){
     $this->cod_epl=$cod_epl;
    }
    public function set_inicial($inicial){
     $this->inicial=$inicial;
    }
    public function set_final($final){
     $this->finall=$final;
    }
    public function set_area($area){
     $this->area=$area;
    }
    public function set_dias($dias){
     $this->dias=$dias;
    }
     public function set_cod_ausencia($cod_ausencia){
     $this->cod_ausencia=$cod_ausencia;
    }
    public function set_consecutivo($consecutivo){
        $this->consecutivo=$consecutivo;
    }
    
    private function get_concepto(){
     return $this->concepto;
    }
    private function get_encargado(){
     return $this->encargado;
    }
    private function get_observacion(){
        return $this->observacion;
    }
     private function get_consecutivo(){
     return $this->consecutivo;
    }
    private function get_cod_epl(){
     return $this->cod_epl;
    }
    private function get_inicial(){
     return $this->inicial;
    }
    private function get_final(){
     return $this->finall;
    }
    private function get_area(){
     return $this->area;
    }
    private function get_dias(){
     return $this->dias;
    }
     private function get_cod_ausencia(){
     return $this->cod_ausencia;
    }
        /*@method vacaciones_email
         *Retorna los datos del empleado para enviarle un email
         *de aceptacon o de rechazo.
        */
    public function vacaciones_email(){
            global $conn;
            try{
                $array= array();
                $sql="--SQL PARA RESPONDER SOLICITUD VIA EMAIL--
                     select au.cod_epl AS COD_EPL, epl.nom_epl as NOM_EPL,epl.ape_epl AS APE_EPL, epl.cedula as CEDULA,
                     au.fec_ini AS FEC_INI,au.fec_fin AS FEC_FIN,
                     au.dias AS DIAS,au.observacion AS OBSERVACIONES,au.cnsctvo as CONSECUTIVO
                     from empleados_basic epl, ausencias_tmp au  
                     where epl.cod_epl=au.cod_epl and au.COD_EPL = '".$this->cod_epl."' and au.cnsctvo='".$this->consecutivo."'";
                $rs=$conn->Execute($sql);
                while($fila=$rs->FetchRow()){
                    $array[]=array("codigo"=>$fila["COD_EPL"],
                                   "cedula"=>$fila["CEDULA"],
                                   "nombre"=>$fila["NOM_EPL"],
                                   "apellido"=>$fila["APE_EPL"],
                                   "inicial"=>$fila["FEC_INI"],
                                   "final"=>$fila["FEC_FIN"],
                                   "dias"=>$fila["DIAS"],
                                   "observacion"=>$fila["OBSERVACIONES"],
                                   "consecutivo"=>$fila["CONSECUTIVO"]);
                    
                }
            }catch(exception $e){
                
                echo "Error: ".$e;
            }
            return $array;
        }
        
    public function observacion_rechazo(){
        global $conn;
        $sql="select au.observacion AS OBSERVACION,au.cnsctvo as CONSECUTIVO, au.COD_EPL
                     from  ausencias_tmp au
                     where au.cnsctvo='".$this->consecutivo."' and au.COD_EPL = '".$this->cod_epl."'";
                     $rs=$conn->Execute($sql);
                     if($rs){
                     $fila=$rs->FetchRow();
                     $lista=$fila["OBSERVACION"];
                     }else{
                          //de lo contrario $this->lista[]==null
                          $lista=null;
                          throw new Exception("No se encontraron datos");
                     }
                     return $lista;
    }
      public function email_empleado(){
          try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql de email del
         
            $sql="select email as EMAIL  from empleados_gral where cod_epl='".$this->cod_epl."'";
         
          $lista=null;
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             $fila=@$rs->FetchRow();
             
             $lista=$fila["EMAIL"];
                 
           
            }else{
                //de lo contrario $this->lista[]==null
              $lista=null;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $lista;
    } 
     
    public function aceptar_vacaciones(){
        
            try{
            global $conn,$odbc;
            $conse="select count(*)+1 as CONSECUTIVO from ausencias_tmp";
            $ver=$conn->Execute($conse);
             $fila=@$ver->FetchRow();
             $consecutivo=$fila["CONSECUTIVO"];
            //if($fila["nom_admin"] != $this->usuario){
            if($odbc == "oci8"){
            $sql="insert into ausencias_tmp (cod_con,cod_epl, fec_ini, fec_fin, estado, dias,cod_aus, fec_ini_r, fec_fin_r,cnsctvo)
                  values('".$this->concepto."','".$this->cod_epl."', TO_DATE ('$this->inicial', 'DD-MM-YY'), TO_DATE ('$this->finall', 'DD-MM-YY'), 'C', ".$this->dias.",(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus'), TO_DATE ('$this->inicial', 'DD-MM-YY'),  TO_DATE ('$this->finall', 'DD-MM-YY'),$consecutivo)";
            }elseif($odbc == "odbc_mssql"){
                $sql="insert into ausencias_tmp (cod_con,cod_epl, fec_ini, fec_fin, estado, dias,cod_aus, fec_ini_r, fec_fin_r,cnsctvo)
                  value('".$this->concepto."','".$this->cod_epl."', convert(datetime,'$this->inicial',126), convert(datetime,'$this->finall',126), 'C', '".$this->dias."' ,(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus'), convert(datetime,'$this->inicial', 126),  convert(datetime,'$this->finall', 126), '$consecutivo')";
            }
            $rs=$conn->Execute($sql);
            $this->cambia_estado_conf();
            if($rs){
                $res = true;
            }
            else{
                $res = false;
            }
            //}else{
            //    $res="El usuario ya existe.";
            //}
        }catch(exception $e){
            
            echo "Error: ".$e;
        }
        return $res;
    }
    private function cambia_estado_conf(){
                try{
            global $conn;
          
            $sql="update ausencias_tmp set estado='C', cod_encardo='".$this->encargado."' where cod_epl='".$this->cod_epl."' and cnsctvo='".$this->consecutivo."'";
            $rs=$conn->Execute($sql);
            if($rs){
                $res = true;
            }
            else{
                $res = false;
            }
            //}else{
            //    $res="El usuario ya existe.";
            //}
        }catch(exception $e){
            
            echo "Error: ".$e;
        }
        return $res;
    
    }
       public function cambia_estado_cance(){
                try{
            global $conn;
          
            $sql="update ausencias_tmp set estado='R', observacion='".$this->observacion."', cod_encardo='".$this->encargado."', RESPUESTA_POR = 'Jefe' where cnsctvo='".$this->consecutivo."' and cod_epl='".$this->cod_epl."'";
            $rs=$conn->Execute($sql);
            if($rs){
                $res = true;
            }
            else{
                $res = false;
            }
            //}else{
            //    $res="El usuario ya existe.";
            //}
        }catch(exception $e){
            
            echo "Error: ".$e;
        }
        return $res;
    
    }
    public function solicitud_epl_gral(){
        
              try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
            $sql="select emp.cod_epl as COD_EPL,
au.CNSCTVO as CONSECUTIVO,
au.fec_solicitud AS FECHASOL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,au.estado as ESTADO,au.fec_ini as FEC_INI,au.fec_fin AS FEC_FIN,dias AS DIAS, emp.estado AS EMPESTADO
            
            from empleados_basic emp, cargos car, centrocosto2 cen ,ausencias_tmp au
            
            where
            
            au.cod_epl=emp.cod_epl and
            emp.cod_car=car.cod_car
            and emp.cod_cc2=cen.cod_cc2
           
           --- and au.estado IN('T','P','C')
            and au.cod_aus=(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus')
            and  au.cod_con=(select descripcion from parametros_nue where nom_var='param_vacas_cod_con')
            order by fec_ini desc";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "inicial"=>$fila["FEC_INI"],
                                      "final"=>$fila["FEC_FIN"],
                                      "dias"=>$fila["DIAS"],
									  "solicitud"=>$fila["FECHASOL"],
									  "CONSECUTIVO"=>$fila["CONSECUTIVO"],
                                      "estado"=>$fila["ESTADO"],
									   "empestado"=>$fila["EMPESTADO"]
                                      
                                      
                                      );
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
    
        public function solicitud_epl_gral_rechazada(){
        
              try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
            $sql="select emp.cod_epl as COD_EPL,
au.FEC_SOLICITUD as FECHASOL,
au.CNSCTVO as CONSECUTIVO,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,au.estado as ESTADO,au.fec_ini as FEC_INI,au.fec_fin AS FEC_FIN,dias AS DIAS
            
            from empleados_basic emp, cargos car, centrocosto2 cen ,ausencias_tmp au
            
            where
            
            au.cod_epl=emp.cod_epl and
            emp.cod_car=car.cod_car
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
            and au.estado IN('R')
            and au.cod_aus=(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus')
            and  au.cod_con=(select descripcion from parametros_nue where nom_var='param_vacas_cod_con')
            order by fec_ini desc
";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "inicial"=>$fila["FEC_INI"],
                                      "final"=>$fila["FEC_FIN"],
                                      "dias"=>$fila["DIAS"],
                                      "estado"=>$fila["ESTADO"],
                                      "encargado"=>$fila["ENCARGADO"],
									  "fechasol"=>$fila["FECHASOL"],
									  "consecutivo"=>$fila["CONSECUTIVO"],
                                      "nombre_encargado"=>$fila["NOM_EPL2"]."  ".$fila["APE_EPL2"]

                                      
                                      
                                      );
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
    
    
  
     public function solicitud_vigente_epl_gral(){
            try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
            $sql="
select e.cod_epl AS COD_EPL , e.cedula AS CEDULA, e.nom_epl AS NOM_EPL, e.ape_epl AS APE_EPL,cc.nom_cc2 AS AREA,
 c.nom_car AS NOM_CAR,
a.fec_ini AS FEC_INI, a.fec_fin AS FEC_FIN, a.dias AS DIAS, a.fec_solicitud AS FECSP, A.CNSCTVO AS CNSC
from ausencias_tmp a, empleados_basic e, cargos c, periodos p, centrocosto2 cc
where a.cod_epl = e.cod_epl and
e.cod_car = c.cod_car and 
e.cod_cc2 = cc.cod_cc2
and a.estado ='C'
and e.tip_pago = p.tip_per
and (a.fec_ini >= p.fec_ini or
a.fec_fin >= p.fec_ini)
and p.ano = extract (year from sysdate)
and p.cod_per = extract (month from sysdate)";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "inicial"=>$fila["FEC_INI"],
                                      "final"=>$fila["FEC_FIN"],
                                      "dias"=>$fila["DIAS"],
									  "consecutivo"=>$fila["CNSC"],
									  "fecsol"=>$fila["FECSP"]
                                      
                                      
                                      );
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
     public function solicitud_pendientes_epl_gral(){
                try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
            $sql="select emp.cod_epl as COD_EPL,
			au.fec_solicitud AS SOLICITUD,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,au.fec_ini as FEC_INI,au.fec_fin as FEC_FIN,au.dias as DIAS,
            au.cod_con AS COD_CON,au.cod_aus as COD_AUS,cen.cod_cc2 as COD_CC2,au.cnsctvo as CNSCTVO
            
            from empleados_basic emp, cargos car, centrocosto2 cen ,ausencias_tmp au
            
            where
            
            au.cod_epl=emp.cod_epl and
            emp.cod_car=car.cod_car
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
            and au.estado ='P' and au.cod_aus=(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus')
              and au.cod_con=(select descripcion from parametros_nue where nom_var='param_vacas_cod_con') order by fec_ini desc";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "inicial"=>$fila["FEC_INI"],
                                      "final"=>$fila["FEC_FIN"],
                                      "dias"=>$fila["DIAS"],
                                      "concepto"=>$fila["COD_CON"],
                                      "ausencia"=>$fila["COD_AUS"],
                                      "cod_area"=>$fila["COD_CC2"],
									   "solicitud"=>$fila["SOLICITUD"],
                                      "consecutivo"=>$fila["CNSCTVO"]
                                      
                                      
                                      
                                      
                                      );
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
	
	 public function solicitud_pendientes_epl_gral_edith(){
                try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
            $sql="select emp.cod_epl as COD_EPL,
			au.fec_solicitud AS SOLICITUD,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,au.fec_ini as FEC_INI,au.fec_fin as FEC_FIN,au.dias as DIAS,
            au.cod_con AS COD_CON,au.cod_aus as COD_AUS,cen.cod_cc2 as COD_CC2,au.cnsctvo as CNSCTVO, au.estado as ESTADO
            
            from empleados_basic emp, cargos car, centrocosto2 cen ,ausencias_tmp au
            
            where
            
            au.cod_epl=emp.cod_epl and
            emp.cod_car=car.cod_car
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
            and au.estado in('P','C') and au.cod_aus=(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus')
              and au.cod_con=(select descripcion from parametros_nue where nom_var='param_vacas_cod_con') order by fec_ini desc";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "estado"=>$fila["ESTADO"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "inicial"=>$fila["FEC_INI"],
                                      "final"=>$fila["FEC_FIN"],
                                      "dias"=>$fila["DIAS"],
                                      "concepto"=>$fila["COD_CON"],
                                      "ausencia"=>$fila["COD_AUS"],
                                      "cod_area"=>$fila["COD_CC2"],
									   "solicitud"=>$fila["SOLICITUD"],
                                      "consecutivo"=>$fila["CNSCTVO"]
                                      
                                      
                                      
                                      
                                      );
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
    
    //vacaciones por area
       public function solicitud_epl_jefe(){
        
              try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql de solicitud de vacaciones de empleado por jefe
         
            $sql="select emp.cod_epl as COD_EPL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,au.estado as ESTADO,au.fec_ini as FEC_INI,au.fec_fin AS FEC_FIN,dias AS DIAS
            
            from empleados_basic emp, cargos car, centrocosto2 cen ,ausencias_tmp au,empleados_gral gral
            
            where
            
            au.cod_epl=emp.cod_epl and
            emp.cod_car=car.cod_car and
            emp.cod_epl=gral.cod_epl and 
            gral.cod_jefe='".$this->encargado."'
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
            and au.estado IN('T','P','C') 
            and au.cod_aus=(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus')
            and  au.cod_con=(select descripcion from parametros_nue where nom_var='param_vacas_cod_con') order by fec_ini desc";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "inicial"=>$fila["FEC_INI"],
                                      "final"=>$fila["FEC_FIN"],
                                      "dias"=>$fila["DIAS"],
                                      "estado"=>$fila["ESTADO"]
                                      
                                      
                                      );
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
      //solicitud de vacaciones rechazadas por jefe
    
        public function solicitud_epl_jefe_rechazada(){
        
              try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         //pendiente
            $sql="select emp.cod_epl as COD_EPL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,au.estado as ESTADO,au.fec_ini as FEC_INI,
            au.fec_fin AS FEC_FIN,dias AS DIAS,au.cod_encardo as ENCARGADO,emp2.nom_epl as NOM_EPL2, emp2.ape_epl as APE_EPL2
            
            from empleados_basic emp, cargos car, centrocosto2 cen ,ausencias_tmp au,empleados_basic emp2, empleados_gral gral
            
            where
            
            au.cod_epl=emp.cod_epl and
            emp.cod_car=car.cod_car
			and gral.cod_epl=emp.cod_epl
			and gral.cod_jefe='".$this->encargado."'
            and emp.cod_cc2=cen.cod_cc2
			and emp2.cod_epl in(select cod_epl from empleados_basic where cod_epl=au.cod_encardo)
            and emp.estado = 'A'
            and au.estado ='R' and au.cod_aus=(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus')
            and  au.cod_con=(select descripcion from parametros_nue where nom_var='param_vacas_cod_con') order by fec_ini desc
";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "inicial"=>$fila["FEC_INI"],
                                      "final"=>$fila["FEC_FIN"],
                                      "dias"=>$fila["DIAS"],
                                      "estado"=>$fila["ESTADO"],
                                      "encargado"=>$fila["ENCARGADO"],
                                      "nombre_encargado"=>$fila["NOM_EPL2"]."  ".$fila["APE_EPL2"]

                                      
                                      
                                      );
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
    
        public function solicitud_pendientes_epl_jefe(){
                try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
            $sql="select emp.cod_epl as COD_EPL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,au.fec_ini as FEC_INI,au.fec_fin as FEC_FIN,au.dias as DIAS,
            au.cod_con AS COD_CON,au.cod_aus as COD_AUS,cen.cod_cc2 as COD_CC2,au.cnsctvo as CNSCTVO
            
            from empleados_basic emp, cargos car, centrocosto2 cen ,ausencias_tmp au, empleados_gral gral
            
            where
            
            au.cod_epl=emp.cod_epl and
            emp.cod_car=car.cod_car
			and emp.cod_epl=gral.cod_epl
			and gral.cod_jefe='".$this->encargado."'
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
            and au.estado ='P' and au.cod_aus=(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus')
              and au.cod_con=(select descripcion from parametros_nue where nom_var='param_vacas_cod_con') order by fec_ini desc";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "inicial"=>$fila["FEC_INI"],
                                      "final"=>$fila["FEC_FIN"],
                                      "dias"=>$fila["DIAS"],
                                      "concepto"=>$fila["COD_CON"],
                                      "ausencia"=>$fila["COD_AUS"],
                                      "cod_area"=>$fila["COD_CC2"],
                                      "consecutivo"=>$fila["CNSCTVO"]
                                      
                                      
                                      
                                      
                                      );
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
    
        public function solicitud_vigente_epl_jefe(){
            try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
            $sql="select emp.cod_epl as COD_EPL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,au.fec_ini as FEC_INI,au.fec_fin AS FEC_FIN,dias AS DIAS
            
            from empleados_basic emp, cargos car, centrocosto2 cen ,ausencias_tmp au, empleados_gral gral
            
            where
            
            au.cod_epl=emp.cod_epl and
            emp.cod_car=car.cod_car
			and emp.cod_epl=gral.cod_epl 
			and gral.cod_jefe = '".$this->encargado."'
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
            and au.estado ='V' and au.cod_aus=(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus')
            and  au.cod_con=(select descripcion from parametros_nue where nom_var='param_vacas_cod_con') order by fec_ini desc";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "inicial"=>$fila["FEC_INI"],
                                      "final"=>$fila["FEC_FIN"],
                                      "dias"=>$fila["DIAS"]
                                      
                                      
                                      );
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
    
     /*
         *@method mensaje_solicitud plantilla de correo de vacaciones
         *@param $contenido es el cuerpo del mensaje.
         *@param $portal direccion url de la pagina de la empresa.
         *@param $youtube url del canal de youtube de la empresa.
         *@param $twitter url de la pagina de la empresa.
         *@param $titulo titulo del mensaje.
         *@param $imagen imagen del encabezado esta imagen no puede llamar local debe llamarce de una url de internet.
         *
        */
        public function mensaje_solicitud($contenido,$portal,$youtube,$facebook,$twitter,$titulo,$imagen=' http://sia1.subirimagenes.net/img/2013/07/26/13072605244398437.png'){
            
          $html='
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html class=" js no-flexbox rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms no-csstransforms3d csstransitions fontface generatedcontent">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
                <!--[if gte mso 9]>
                <style _tmplitem="116" >
                  .article-content ol, .article-content ul {
                   margin: 0 0 0 24px;
                   padding: 0;
                   list-style-position: inside;
                   }
                </style>
                <![endif]-->
           
           </head>
           <body>
           <table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table">
                   <tbody>
                           <tr>
                                   <td align="center" bgcolor="#ececec">
                                   <table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">
                                   <tbody>
                                                           <tr>
                                                                   <td class="w640" width="640" height="20"></td>
                                                           </tr>
                                   <tr>
                                                   <td class="w640" width="640">
                                           <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">
                                                           <tbody><tr>
                   <td class="w15" width="15"></td>
                   <td class="w325" width="350" valign="middle" align="left">
                       <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                           <tbody><tr><td class="w325" width="350" height="8"></td></tr>
                       </tbody></table>
                       <div style=" font-size: 12px; color: #D9FFFD;">';
                       if($youtube != null){
                       $html.='<a style="font-weight: bold; color: #D9FFFD; text-decoration: none;  font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" href="http://'.$portal.'" target="_blank">Portal</a><span class="hide">';
                       }
                       if($youtube != null){
                        $html.=' &nbsp;|&nbsp; <a style="font-weight: bold; color: #D9FFFD; text-decoration: none;  font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" href="http://'.$youtube.'" lang="es-ES" target="_blank">Youtube</a>';
                       }
                       if($facebook != null){
                        $html.=' &nbsp;|&nbsp; <a style="font-weight: bold; color: #D9FFFD; text-decoration: none;  font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" href="http://'.$facebook.'" target="_blank">Facebook</a></span><span class="hide">';
                       }
                       if($twitter != null){
                        $html.=' &nbsp;|&nbsp; <a style="font-weight: bold; color: #D9FFFD; text-decoration: none;  font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" href="http://'.$twitter.'" target="_blank">Twitter</a>';
                       }
                       $html.='
                       </span></div>
                       <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                           <tbody><tr><td class="w325" width="350" height="8"></td></tr>
                       </tbody></table>
                   </td>
                   <td class="w30" width="30"></td>
                   <td class="w255" width="255" valign="middle" align="right">
                       <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                           <tbody><tr><td class="w255" width="255" height="8"></td></tr>
                       </tbody></table>
                       <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                           <tbody><tr><td class="w255" width="255" height="8"></td></tr>
                       </tbody></table>
                   </td>
                   <td class="w15" width="15"></td>
               </tr>
           </tbody></table>
                                   
                               </td>
                           </tr>
                           <tr>
                           <td id="header" class="w640" width="640" align="center" bgcolor="#425470">
               
               <div align="center" style="text-align: center">
                   <span style="position:relative; display:block"><span class="cs-fl-wrap" data-fillerimage="https://img.createsend1.com/static/filler/638x382_fill.gif" data-width="638" data-displayfiller="true" data-model="{&quot;label&quot;:null,&quot;type&quot;:&quot;im&quot;}" data-filename="Default"><img src="http://sia1.subirimagenes.net/img/2013/07/26/13072605244398437.png" width="638" height="134"border="0" align="top" style="display: inline"></span></span>    </div>
               
               
           </td>
                           </tr>
                           
                           <tr><td class="w640" width="640" height="30" bgcolor="#ffffff"></td></tr>
                           <tr id="gallery-content-row"><td class="w640" width="640" bgcolor="#ffffff">
               <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                   <tbody><tr>
                       <td class="w30" width="30"></td>
                       <td class="w580" width="580">
                           <span class="cs-rp-wrap" data-model="{&quot;Text only&quot;:{&quot;label&quot;:&quot;Text only&quot;,&quot;template&quot;:&quot;&lt;span class=\&quot;cs-it-wrap\&quot; data-layout=\&quot;Text only\&quot;&gt;&lt;span class=\&quot;cs-button-block\&quot;&gt;\r\n  &lt;span class=\&quot;cs-edit-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-delete-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-move-content-handle\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-add-new-dropdown\&quot;&gt;&lt;/span&gt;\r\n  \r\n&lt;/span&gt;\r\n                        &lt;table class=\&quot;w580\&quot; width=\&quot;580\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                            &lt;tbody&gt;&lt;tr&gt;\r\n                                &lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot;&gt;\r\n                                    &lt;p align=\&quot;left\&quot; class=\&quot;article-title\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Add a title&lt;/span&gt;&lt;/p&gt;\r\n                                    &lt;div align=\&quot;left\&quot; class=\&quot;article-content\&quot;&gt;\r\n                                        &lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;\r\n                                    &lt;/div&gt;\r\n                                &lt;/td&gt;\r\n                            &lt;/tr&gt;\r\n                            &lt;tr&gt;&lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                        &lt;/tbody&gt;&lt;/table&gt;\r\n                    &lt;/span&gt;&quot;,&quot;inTOC&quot;:false,&quot;regions&quot;:[{&quot;label&quot;:&quot;Title&quot;,&quot;type&quot;:&quot;sl&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false}]},&quot;Full width image&quot;:{&quot;label&quot;:&quot;Full width image&quot;,&quot;template&quot;:&quot;&lt;span class=\&quot;cs-it-wrap\&quot; data-layout=\&quot;Full width image\&quot;&gt;&lt;span class=\&quot;cs-button-block\&quot;&gt;\r\n  &lt;span class=\&quot;cs-edit-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-delete-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-move-content-handle\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-add-new-dropdown\&quot;&gt;&lt;/span&gt;\r\n  \r\n&lt;/span&gt;\r\n                        &lt;table class=\&quot;w580\&quot; width=\&quot;580\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                            &lt;tbody&gt;&lt;tr&gt;\r\n                                &lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w580\&quot; width=\&quot;580\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/580x348_fill.gif\&quot; data-width=\&quot;580\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w580\&quot; width=\&quot;580\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/580x348_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w580\&quot; width=\&quot;580\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                            &lt;/tr&gt;\r\n                        &lt;/tbody&gt;&lt;/table&gt;\r\n                    &lt;/span&gt;&quot;,&quot;inTOC&quot;:false,&quot;regions&quot;:[{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false}]},&quot;Row of two images&quot;:{&quot;label&quot;:&quot;Row of two images&quot;,&quot;template&quot;:&quot;&lt;span class=\&quot;cs-it-wrap\&quot; data-layout=\&quot;Row of two images\&quot;&gt;&lt;span class=\&quot;cs-button-block\&quot;&gt;\r\n  &lt;span class=\&quot;cs-edit-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-delete-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-move-content-handle\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-add-new-dropdown\&quot;&gt;&lt;/span&gt;\r\n  \r\n&lt;/span&gt;\r\n                        &lt;table class=\&quot;w580\&quot; width=\&quot;580\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                            &lt;tbody&gt;&lt;tr&gt;\r\n                                &lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w280\&quot; width=\&quot;280\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/280x168_fill.gif\&quot; data-width=\&quot;280\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w280\&quot; width=\&quot;280\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/280x168_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                                &lt;td width=\&quot;20\&quot;&gt;&lt;/td&gt;\r\n                                &lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w280\&quot; width=\&quot;280\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/280x168_fill.gif\&quot; data-width=\&quot;280\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w280\&quot; width=\&quot;280\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/280x168_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w280\&quot; width=\&quot;280\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                            &lt;/tr&gt;\r\n                        &lt;/tbody&gt;&lt;/table&gt;\r\n                    &lt;/span&gt;&quot;,&quot;inTOC&quot;:false,&quot;regions&quot;:[{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false}]},&quot;Row of three images&quot;:{&quot;label&quot;:&quot;Row of three images&quot;,&quot;template&quot;:&quot;&lt;span class=\&quot;cs-it-wrap\&quot; data-layout=\&quot;Row of three images\&quot;&gt;&lt;span class=\&quot;cs-button-block\&quot;&gt;\r\n  &lt;span class=\&quot;cs-edit-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-delete-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-move-content-handle\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-add-new-dropdown\&quot;&gt;&lt;/span&gt;\r\n  \r\n&lt;/span&gt;\r\n                        &lt;table class=\&quot;w580\&quot; width=\&quot;580\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                            &lt;tbody&gt;&lt;tr&gt;\r\n                                &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w180\&quot; width=\&quot;180\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/180x108_fill.gif\&quot; data-width=\&quot;180\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w180\&quot; width=\&quot;180\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/180x108_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                                &lt;td width=\&quot;20\&quot;&gt;&lt;/td&gt;\r\n                                &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w180\&quot; width=\&quot;180\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/180x108_fill.gif\&quot; data-width=\&quot;180\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w180\&quot; width=\&quot;180\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/180x108_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                                &lt;td width=\&quot;20\&quot;&gt;&lt;/td&gt;\r\n                                &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w180\&quot; width=\&quot;180\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/180x108_fill.gif\&quot; data-width=\&quot;180\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w180\&quot; width=\&quot;180\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/180x108_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w180\&quot; width=\&quot;180\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                            &lt;/tr&gt;\r\n                        &lt;/tbody&gt;&lt;/table&gt;\r\n                    &lt;/span&gt;&quot;,&quot;inTOC&quot;:false,&quot;regions&quot;:[{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false}]},&quot;Row of four images&quot;:{&quot;label&quot;:&quot;Row of four images&quot;,&quot;template&quot;:&quot;&lt;span class=\&quot;cs-it-wrap\&quot; data-layout=\&quot;Row of four images\&quot;&gt;&lt;span class=\&quot;cs-button-block\&quot;&gt;\r\n  &lt;span class=\&quot;cs-edit-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-delete-content-button\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-move-content-handle\&quot;&gt;&lt;/span&gt;\r\n  &lt;span class=\&quot;cs-add-new-dropdown\&quot;&gt;&lt;/span&gt;\r\n  \r\n&lt;/span&gt;\r\n                        &lt;table class=\&quot;w580\&quot; width=\&quot;580\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                            &lt;tbody&gt;&lt;tr&gt;\r\n                                &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w130\&quot; width=\&quot;130\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; data-width=\&quot;130\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w130\&quot; width=\&quot;130\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                                &lt;td width=\&quot;20\&quot;&gt;&lt;/td&gt;\r\n                                &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w130\&quot; width=\&quot;130\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; data-width=\&quot;130\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w130\&quot; width=\&quot;130\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                                &lt;td width=\&quot;20\&quot;&gt;&lt;/td&gt;\r\n                                &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w130\&quot; width=\&quot;130\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; data-width=\&quot;130\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w130\&quot; width=\&quot;130\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                                &lt;td width=\&quot;20\&quot;&gt;&lt;/td&gt;\r\n                                &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; valign=\&quot;top\&quot;&gt;\r\n                                    &lt;table class=\&quot;w130\&quot; width=\&quot;130\&quot; cellpadding=\&quot;0\&quot; cellspacing=\&quot;0\&quot; border=\&quot;0\&quot;&gt;\r\n                                        &lt;tbody&gt;&lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot; data-fillerimage=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; data-width=\&quot;130\&quot;&gt;&lt;img editable=\&quot;true\&quot; label=\&quot;Image\&quot; class=\&quot;w130\&quot; width=\&quot;130\&quot; border=\&quot;0\&quot; src=\&quot;https://img.createsend1.com/static/filler/130x78_fill.gif\&quot; /&gt;&lt;/span&gt;&lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                        &lt;tr&gt;\r\n                                            &lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot;&gt;\r\n                                                &lt;div align=\&quot;center\&quot; class=\&quot;article-content\&quot;&gt;&lt;span class=\&quot;cs-el-wrap\&quot;&gt;Enter your description&lt;/span&gt;&lt;/div&gt;\r\n                                            &lt;/td&gt;\r\n                                        &lt;/tr&gt;\r\n                                        &lt;tr&gt;&lt;td class=\&quot;w130\&quot; width=\&quot;130\&quot; height=\&quot;10\&quot;&gt;&lt;/td&gt;&lt;/tr&gt;\r\n                                    &lt;/tbody&gt;&lt;/table&gt;\r\n                                &lt;/td&gt;\r\n                            &lt;/tr&gt;\r\n                        &lt;/tbody&gt;&lt;/table&gt;\r\n                    &lt;/span&gt;&quot;,&quot;inTOC&quot;:false,&quot;regions&quot;:[{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Image&quot;,&quot;type&quot;:&quot;im&quot;,&quot;tocTitle&quot;:false},{&quot;label&quot;:&quot;Description&quot;,&quot;type&quot;:&quot;ml&quot;,&quot;tocTitle&quot;:false}]}}"><span class="cs-it-wrap" data-layout="Text only">
                         <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                                       <tbody><tr>
                                           <td class="w580" width="580">
                                               <p align="left" class="article-title"><span style="font-size: 18px; line-height: 24px; color: #C25130; font-weight: bold; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;">'.$titulo.'</span></p>
                                               <div align="left" class="article-content">
                                                   <span style="font-size: 14px; line-height: 18px; color: #444; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;">'.$contenido.'</span>
                                               </div>
                                           </td>
                                       </tr>
                                       <tr><td class="w580" width="580" height="10"></td></tr>
                                   </tbody></table>
                               </span></span>
                       </td>
                       <td class="w30" width="30"></td>
                   </tr>
               </tbody></table>
           </td></tr>
                           <tr><td class="w640" width="640" height="15" bgcolor="#ffffff"></td></tr>
                           
                           <tr>
                           <td class="w640" width="640">
                   </td>
                   </tr>
           </tbody></table><img src="o.gif" style="height:1px !important; width:1px !important; border: 0 !important; margin: 0 !important; padding: 0 !important" width="1" height="1" border="0">
           </body>
           </html>';
     
            
            return $html;		
        }
   
}

?>