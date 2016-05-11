<?php
include_once '../lib/connection.php';

class novedades{
    
    private $cod_epl=null;
    private $concepto=null;
    private $valor=null;
    private $tipo_concepto=null;
    private $num_sem=null;
    
    private $estado=null;
    private $fecha=null;
    private $codigo_jefe=null;
    
    
    
    public function set_concepto($concepto){
     $this->concepto=$concepto;
    }
    public function set_cod_epl($cod_epl){
        $this->cod_epl=$cod_epl;
    }
    public function set_valor($valor){
        $this->valor=$valor;
    }
    public function set_tipo_concepto($tipo_concepto){
        $this->tipo_concepto=$tipo_concepto;
    }
    public function set_num_sem($num_sem){
        $this->num_sem=$num_sem;
    }
   
    public function set_estado($estado){
        $this->estado=$estado;
    }
    public function set_fecha($fecha){
        $this->fecha=$fecha;
    }
    public function set_codigo_jefe($codigo_jefe){
        $this->codigo_jefe=$codigo_jefe;
    }
    
    
    private function get_concepto(){
     return $this->concepto;
    }
    private function get_cod_epl(){
     return $this->cod_epl;
    }
    private function get_valor(){
     return $this->valor;
    }
    private function get_tipo_concepto(){
     return $this->tipo_concepto;
    }
    private function get_num_sem(){
     return $this->num_sem;
    }
    private function get_estado(){
     return $this->estado;
    }
    private function get_fecha(){
     return $this->fecha;
    }
    private function get_codigo_jefe(){
     return $this->codigo_jefe;
    }
    

   
    /*@method tipo_conceptos
     *Indica el tipo de concepto de la novedad que el empleado ingreso.
    */
    private function tipo_conceptos(){
        global $conn;
        $sql="Select c.nom_con as NOM_CON, u.nom_uni AS NOM_UNI,c.tip_con AS TIP_CON
                        From conceptos c, conceptos_ayu a, unidades u
                        Where c.cod_con = a.cod_con
                        And a.cod_uni = u.cod_uni
                        And a.tabla='novedades'
                        And c.cod_con = '".$this->concepto."'-- concepto q se digita";
                $rs=$conn->Execute($sql);
                $fila=@$rs->FetchRow();
                $tipo=$fila["TIP_CON"];
                if($rs){
                    $tipo=$fila["TIP_CON"];
                }else{
                    $tipo=null;
                }
                return $tipo;
    }
    /*@method centro_costos
     *Indica el centro de costo del empleado para poder insertar la novedad.
    */
    private function centro_costos(){
        global $conn;
        $sql="select cod_cc2 as COD_CC2
             from empleados_basic
             where cod_epl='".$this->cod_epl."'";
              $rs=$conn->Execute($sql);
                $fila=@$rs->FetchRow();
                
                if($rs){
                    $centro=$fila["COD_CC2"];
                }else{
                    $centro=null;
                }
                return $centro;
    }
    /*@method fecha_novedad
     *Retorna la fecha fin para el pago de la novedad
    */
    private function fecha_novedad(){
        global $conn;
        
        $fecha = date('d/m/Y');  
        
        $sql="SELECT fec_fin as FEC_FIN FROM periodos
             WHERE to_date('".$fecha."','DD-MM-YY') BETWEEN fec_ini AND fec_fin
             and tip_per =(select tip_pago AS TIP_PAGO from empleados_basic where cod_epl='".$this->cod_epl."')";
             $rs=$conn->Execute($sql);
             $fila=@$rs->FetchRow();
              if($rs){
                    $retornar= $fila["FEC_FIN"];
                }else{
                    $retornar=null;
                }
                
             return $retornar;
    }
    /*@method solicitar_novedad
     *El empleado ingresa su novedad
    */
    public function solicitar_novedad(){
        global $conn,$odbc;
            try{
                $array= array();
                $sql="select count(*)+1 as CONSECUTIVO from novedades_tmp";
                $rs=$conn->Execute($sql);
                $fila=@$rs->FetchRow();
                $consecutivo=$fila["CONSECUTIVO"];
                if($odbc == "oci8"){
                $inser_nove_tmp="insert into novedades_tmp
                                 (cod_epl,cod_con,vlr_nov,tip_con,num_sem,cod_cc2,estado,fecha)
                                  values('".$this->cod_epl."','".$this->concepto."','".$this->valor."','".$this->tipo_conceptos()."','".$consecutivo."','".$this->centro_costos()."','P','".$this->fecha_novedad()."')";
                }elseif($odbc == "odbc_mssql"){
                    $inser_nove_tmp="insert into novedades_tmp
                                 (cod_epl,cod_con,vlr_nov,tip_con,num_sem,cod_cc2,estado,fecha)
                                  values('".$this->cod_epl."','".$this->concepto."','".$this->valor."','".$this->tipo_conceptos()."','".$consecutivo."','".$this->centro_costos()."','P','".$this->fecha_novedad()."'))";
                }
                
                $insertar=$conn->Execute($inser_nove_tmp);
                
                if($insertar){
                    
                    $respuesta= true;
                }else{
                    $respuesta= false;
                }
                
            }catch(exception $e){
                
                echo "Error: ".$e;
            }
            return $respuesta;
        
    }
    
    
    /*El jefe Acepta o Cancela la novedad del empleado*/
    public function responder_solicitud_jefe($accion){
        global $conn;
        
        if($accion == "aprobar"){
            $update="update novedades_tmp set estado='A', usuario='".$this->codigo_jefe."' where num_sem='".$this->num_sem."'";
        }else{
            $update="update novedades_tmp set estado='C', usuario='".$this->codigo_jefe."' where num_sem='".$this->num_sem."'";
        }
        
        $rs=$conn->Execute($update);
        
        if($rs){
            $respuesta= true;
        }else{
            $respuesta=false;
        }
        return $respuesta;
        
    }
    
    /*COnsecutivo de la tabla novedades*/
    private function consecutivo_novedades(){
        global $conn;
        $sql="select count(*)+1 as CONSECUTIVO from novedades";
                $rs=$conn->Execute($sql);
                $fila=@$rs->FetchRow();
                $consecutivo=$fila["CONSECUTIVO"];
                
                return $consecutivo;
    }
    
    /*La persona de nomina es quien da el vistazo final y acepta o cancela las novedades*/
    public function responder_solicitud_nomina($accion){
        global $conn,$odbc;
        
        if($accion == "aprobar"){
            
            $sql="Select cod_epl as COD_ELP,cod_con AS COD_CON,
                         vlr_nov AS VLR_NOV,tip_con AS TIP_CON,
                         cod_cc2 AS COD_CC2,num_sem as NUM_SEM,
                         estado AS ESTADO,fecha AS FECHA
                         FROM novedades_tmp
                         where num_sem='".$this->num_sem."'";
        $rs=$conn->Execute($sql);
        $fila=@$rs->FetchRow();
            
            
            $consecutivo=$this->consecutivo_novedades();
              if($odbc == "oci8"){
                $update="insert into novedades(cod_epl,cod_con,vlr_nov,tip_con,num_sem,cod_cc2,fecha)
                                  values('".$fila["COD_ELP"]."','".$fila["COD_CON"]."','".$fila["VLR_NOV"]."','".$fila["TIP_CON"]."','".$consecutivo."','".$fila["COD_CC2"]."','".$fila["FECHA"]."')";
                }elseif($odbc == "odbc_mssql"){
                    $update="insert into novedades
                                 (cod_epl,cod_con,vlr_nov,tip_con,num_sem,cod_cc2,fecha)
                                  values('".$fila["COD_ELP"]."','".$fila["COD_CON"]."','".$fila["VLR_NOV"]."','".$fila["TIP_CON"]."','".$consecutivo."','".$fila["COD_CC2"]."','".$fila["FECHA"]."')";
                }
                
                $resp=$conn->Execute($update);
                
                if($resp){
                    $eliminar="delete  from novedades_tmp where num_sem ='".$fila["NUM_SEM"]."'";
                    $eli=$conn->Execute($eliminar);
                }
        }else{
            $update="update novedades_tmp set estado='C' where num_sem='".$this->num_sem."'";
            $resp=$conn->Execute($update);
        }
        
        
        
        if($resp){
            $respuesta= true;
        }else{
            $respuesta=false;
        }
        return $respuesta;
    }
    /*@method mostrar_novedades_jefe
     *El jefe visualiza la novedades en estado P
     *son la novedades que el empleado inserto
    */
    public function mostrar_novedades_jefe(){
        
        global $conn;
        $sql="--aceptar o cancelar novedad por jefe----
            select emp.cod_epl as COD_EPL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,au.cod_con as COD_CON,con.nom_con as NOM_CON,au.vlr_nov as VLR_NOV,au.fecha as FECHA,au.num_sem as NUM_SEM
            from empleados_basic emp, cargos car, centrocosto2 cen ,novedades_tmp au,empleados_gral gral,conceptos con
            where
            au.cod_epl=emp.cod_epl and
            au.cod_con=con.cod_con and
            emp.cod_car=car.cod_car and
            emp.cod_epl=gral.cod_epl and 
            gral.cod_jefe='".$this->codigo_jefe."' and 
            emp.cod_cc2=cen.cod_cc2
            and au.estado ='P'
            and emp.estado = 'A'";
             $array=array();//Creo un objeto el cual me captura los resultados de la sentencia
             
             $rs=$conn->Execute($sql);
             if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
	    
	        $array[]=array("codigo"=>$fila["COD_EPL"],
			   "nombre"=>$fila["NOM_EPL"],
			   "apellido"=>$fila["APE_EPL"],
			   "cargo"=>$fila["NOM_CAR"],
			   "area"=>$fila["AREA"],
			   "cedula"=>$fila["CEDULA"],
                           "concepto"=>$fila["COD_CON"],
                           "nom_con"=>$fila["NOM_CON"],
                           "valor"=>$fila["VLR_NOV"],
                           "fecha"=>$fila["FECHA"],
                           "consecutivo"=>$fila["NUM_SEM"]);
	       }
	       }else{
		$array=null;
	       }
               
               return $array;
        
    }
    /*@method mostrar_novedades_gral
     *Son las novedades en estado A (aceptadas por el jefe del empleado)
     *y estan a la espera de ser aceptadas o canceladas.
    */
    public function mostrar_novedades_gral(){
        global $conn;
        $sql="select emp.cod_epl as COD_EPL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,au.cod_con as COD_CON,con.nom_con as NOM_CON,au.vlr_nov as VLR_NOV,au.fecha as FECHA,au.num_sem as NUM_SEM
            from empleados_basic emp, cargos car, centrocosto2 cen ,novedades_tmp au,conceptos con
            where
            au.cod_epl=emp.cod_epl and
            au.cod_con=con.cod_con and
            emp.cod_car=car.cod_car and
            emp.cod_cc2=cen.cod_cc2
            and au.estado ='A'
            and emp.estado = 'A'";
            
             $array=array();//Creo un objeto el cual me captura los resultados de la sentencia
             
             $rs=$conn->Execute($sql);
             if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
	    
	        $array[]=array("codigo"=>$fila["COD_EPL"],
			   "nombre"=>$fila["NOM_EPL"],
			   "apellido"=>$fila["APE_EPL"],
			   "cargo"=>$fila["NOM_CAR"],
			   "area"=>$fila["AREA"],
			   "cedula"=>$fila["CEDULA"],
                           "concepto"=>$fila["COD_CON"],
                           "nom_con"=>$fila["NOM_CON"],
                           "valor"=>$fila["VLR_NOV"],
                           "fecha"=>$fila["FECHA"],
                           "consecutivo"=>$fila["NUM_SEM"]);
	       }
	       }else{
		$array=null;
	       }
               return $array;
    }
    

    
}
?>