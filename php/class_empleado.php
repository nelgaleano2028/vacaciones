<?php
require_once '../lib/connection.php';
class empleado{
    
    private $codigo=null;
    
    public function set_codigo($codigo){
        $this->codigo=$codigo;
    }
    private function get_codigo(){
        return $this->codigo;
    }
    
    public function datos_empleado(){
        global $conn;
        
        $respuesta = null;
        try{
            $sql="select a.cod_epl as COD_EPL,
                  a.nom_epl as NOM_EPL, a.ape_epl as APE_EPL,
                  a.cedula as CEDULA,a.sal_bas as SAL_BAS,
                  b.sexo as SEXO,b.email as EMAIL,
                  b.cod_jefe as COD_JEFE
                  from empleados_basic a,empleados_gral b 
                  where a.estado='A' and a.cod_epl=b.cod_epl and
                  a.cod_epl='".$this->codigo."'
                ";
            $rs=$conn->Execute($sql);
               //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
            if($rs){
                while($fila=@$rs->FetchRow()){
                 
                 $respuesta[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "salario"=>$fila["SAL_BAS"],
                                      "sexo"=>$fila["SEXO"],
                                      "email"=>$fila["EMAIL"],
                                      "jefe"=>$fila["COD_JEFE"]
                                      );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $respuesta=null;
              throw new Exception("No se encontraron datos");
              
            }
        }catch(Exception $e){
            $respuesta = "Error".$e;
        }
        return $respuesta;
    }
    public function empresa(){
        global $conn;
        
        $respuesta = null;
        try{
            $sql="SELECT emp.nom_emp AS NOM_EMP
            FROM empresas emp
            WHERE emp.cod_emp=1";
            $row=$conn->Execute($sql);
            $emp=$row->FetchRow();
            
            $respuesta=$emp["NOM_EMP"];
          
        }catch(Exception $e){
            $respuesta = "Error".$e;
        }
        return $respuesta;
        
    }
    /*
     *MODIFICACION DE PERFIL DE LOS EMPLEADOS
     *
     */
    
    
    /*HOJA DE VIDA EMPLEADOS*/
    
    
    public function validar_hoja_vida_tmp(){
           
          global $conn,$odbc;
        
        $validar=" select count(*) as CANTIDAD from tmp_empleados_gral where cod_epl='".$this->codigo."'";
        $resul=$conn->Execute($validar);
        $valor=$resul->FetchRow();
        
        return $valor["CANTIDAD"];
     }
    
    public function mostrar_hoja_vida(){
        global $conn;
        $array = array();
        $sql="select a.cod_epl as COD_EPL,a.fec_nac AS FEC_NAC,
             b.nom_ciu as CIUNAC ,b1.nom_ciu as CIUVIVE ,
             a.dir_epl as DIR_EPL,a.dir_epl2 AS DIR_EPL2,
             c.nom_bar AS NOM_BAR, a.tel_2 AS TEL_2,
             a.tel_1 as TEL_1,a.celular AS CELULAR,
             a.sexo AS SEXO,a.email AS EMAIL,
             d.nom_nie AS NOM_NIE,a.num_hjo AS NUM_HJO,
             e.est_civ AS EST_CIV, lib_mil AS LIB_MIL,
             clase_lib AS CLASE_LIB,gru_san AS GRU_SAN,
             a.ciu_nac AS CIU_NAC, a.cod_ciu AS COD_CIU, 
             a.cod_bar AS COD_BAR, a.cod_nie AS COD_NIE, a.cod_civ AS COD_CIV,a.lic_con as LIC_CON
             
             from empleados_gral a 
             left join ciudades b on a.ciu_nac = b.cod_ciu
             left join ciudades b1  on  a.cod_ciu = b1.cod_ciu
             left join barrios c  on a.cod_bar = c.cod_bar
             left join nivel_ed d  on a.cod_nie = d.cod_nie
             left join estado_civil e  on a.cod_civ = e.cod_civ
             where a.cod_epl = '".$this->codigo."'";
          $rs=$conn->Execute($sql);
             if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
	    
	        $array[]=array("codigo"=>$fila["COD_EPL"],
			   "fecha_naci"=>$fila["FEC_NAC"],
			   "nacimiento"=>$fila["CIUNAC"],
			   "vive"=>$fila["CIUVIVE"],
			   "dir"=>utf8_encode($fila["DIR_EPL"]),
			   "dir2"=>utf8_encode($fila["DIR_EPL2"]),
                           "barrio"=>$fila["NOM_BAR"],
                           "tel2"=>$fila["TEL_2"],
                           "tel1"=>$fila["TEL_1"],
                           "celular"=>$fila["CELULAR"],
                           "sexo"=>$fila["SEXO"],
                           "nom_nie"=>$fila["NOM_NIE"],
                           "num_hijo"=>$fila["NUM_HJO"],
                           "estado"=>$fila["EST_CIV"],
                           "libreta"=>$fila["LIB_MIL"],
                           "clase_lib"=>$fila["CLASE_LIB"],
                           "libreta"=>$fila["LIB_MIL"],
                           "grupo"=>$fila["GRU_SAN"],
                           "ciu_nac"=>$fila["CIU_NAC"],
                           "cod_ciu"=>$fila["COD_CIU"],
                           "cod_bar"=>$fila["COD_BAR"],
                           "cod_nie"=>$fila["COD_NIE"],
                           "cod_civ"=>$fila["COD_CIV"],
                           "lic_con"=>$fila["LIC_CON"],
                           "email"=>$fila["EMAIL"]);
	       }
	       }else{
		$array=null;
	       }
        return $array;
    }
    
    public function mostrar_hoja_vida_tmp(){
        global $conn;
        $array = array();
        $sql="select a.cod_epl as COD_EPL,a.fec_nac AS FEC_NAC,
             b.nom_ciu as CIUNAC ,b1.nom_ciu as CIUVIVE ,
             a.dir_epl as DIR_EPL,a.dir_epl2 AS DIR_EPL2,
             c.nom_bar AS NOM_BAR, a.tel_2 AS TEL_2,
             a.tel_1 as TEL_1,a.celular AS CELULAR,
             a.sexo AS SEXO,a.email AS EMAIL,
             d.nom_nie AS NOM_NIE,a.num_hjo AS NUM_HJO,
             e.est_civ AS EST_CIV, lib_mil AS LIB_MIL,
             clase_lib AS CLASE_LIB,gru_san AS GRU_SAN,
             a.ciu_nac AS CIU_NAC, a.cod_ciu AS COD_CIU, 
             a.cod_bar AS COD_BAR, a.cod_nie AS COD_NIE, a.cod_civ AS COD_CIV,a.lic_con as LIC_CON
             
             from tmp_empleados_gral a 
             left join ciudades b on a.ciu_nac = b.cod_ciu
             left join ciudades b1  on  a.cod_ciu = b1.cod_ciu
             left join barrios c  on a.cod_bar = c.cod_bar
             left join nivel_ed d  on a.cod_nie = d.cod_nie
             left join estado_civil e  on a.cod_civ = e.cod_civ
             where a.cod_epl = '".$this->codigo."'";
          $rs=$conn->Execute($sql);
             if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
	    
	        $array[]=array("codigo"=>$fila["COD_EPL"],
			   "fecha_naci"=>$fila["FEC_NAC"],
			   "nacimiento"=>$fila["CIUNAC"],
			   "vive"=>$fila["CIUVIVE"],
			   "dir"=>$fila["DIR_EPL"],
			   "dir2"=>$fila["DIR_EPL2"],
                           "barrio"=>$fila["NOM_BAR"],
                           "tel2"=>$fila["TEL_2"],
                           "tel1"=>$fila["TEL_1"],
                           "celular"=>$fila["CELULAR"],
                           "sexo"=>$fila["SEXO"],
                           "nom_nie"=>$fila["NOM_NIE"],
                           "num_hijo"=>$fila["NUM_HJO"],
                           "estado"=>$fila["EST_CIV"],
                           "libreta"=>$fila["LIB_MIL"],
                           "clase_lib"=>$fila["CLASE_LIB"],
                           "libreta"=>$fila["LIB_MIL"],
                           "grupo"=>$fila["GRU_SAN"],
                           "ciu_nac"=>$fila["CIU_NAC"],
                           "cod_ciu"=>$fila["COD_CIU"],
                           "cod_bar"=>$fila["COD_BAR"],
                           "cod_nie"=>$fila["COD_NIE"],
                           "cod_civ"=>$fila["COD_CIV"],
                           "lic_con"=>$fila["LIC_CON"],
                           "email"=>$fila["EMAIL"]);
	       }
	       }else{
		$array=null;
	       }
        return $array;
    }
    
    public function mostrar_hoja_vida_jefe($jefe){
        global $conn;
        $array = array();
        $sql="select emp.cod_epl as COD_EPL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,gral.email as EMAIL
            
            from empleados_basic emp, cargos car, centrocosto2 cen , empleados_gral gral,tmp_empleados_gral gral2
            
            where
            emp.cod_car=car.cod_car
            and emp.cod_epl=gral.cod_epl 
            and gral2.cod_epl=gral.cod_epl
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
            and gral.cod_jefe='$jefe'
             ";
          $rs=$conn->Execute($sql);
             if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
	    
	        $array[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "email"=>$fila["EMAIL"]);
	       }
	       }else{
		$array=null;
	       }
        return $array;
    }
    
    
    public function insert_hoja_vida($dir,$tel,$dir_epl2,$cod_bar,$tel_2,$celular,$email,$cod_nie,$num_hjo,$cod_civ,$lib_mil,$lic_con){
        global $conn;
        $respuesta = null;
        
        $sql="insert into tmp_empleados_gral
              (cod_epl,dir_epl,tel_1,dir_epl2,cod_bar,tel_2,celular,email,cod_nie,num_hjo,cod_civ,lib_mil,lic_con)
              values('".$this->codigo."','$dir','$tel','$dir_epl2','$cod_bar',
                     '$tel_2','$celular','$email','$cod_nie',
                     '$num_hjo','$cod_civ','$lib_mil','$lic_con')
              ";
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
    }
    
    public function editar_hoja_vida($dir,$tel,$dir_epl2,$cod_bar,$tel_2,$celular,$email,$cod_nie,$num_hjo,$cod_civ,$lib_mil,$lic_con){
        global $conn;
        $respuesta = null;
        
        $sql="UPDATE empleados_gral
              set 
                 dir_epl='$dir',
                 tel_1='$tel',
                 dir_epl2='$dir_epl2',
                 cod_bar='$cod_bar',
                 tel_2='$tel_2',
                 celular='$celular',
                 email='$email',
                 cod_nie='$cod_nie',
                 num_hjo='$num_hjo',
                 cod_civ='$cod_civ',
                 lib_mil='$lib_mil',
                 lic_con='$lic_con'
                 where cod_epl='".$this->codigo."'";
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        return $respuesta;
    }
    
    public function validar_hoja_vida(){
        global $conn,$odbc;
        
        $validar=" select count(*) as CANTIDAD from empleados_gral where cod_epl='".$this->codigo."'";
        $resul=$conn->Execute($validar);
        $valor=$resul->FetchRow();
        
        return $valor["CANTIDAD"];
    }
    
     public function editar_hoja_vida_temporal($dir,$tel,$dir_epl2,$cod_bar,$tel_2,$celular,$email,$cod_nie,$num_hjo,$cod_civ,$lib_mil,$lic_con){
        global $conn,$odbc;
        $respuesta = null;
            
        
        $sql="UPDATE tmp_empleados_gral
              set 
                 dir_epl='$dir',
                 tel_1='$tel',
                 dir_epl2='$dir_epl2',
                 cod_bar='$cod_bar',
                 tel_2='$tel_2',
                 celular='$celular',
                 email='$email',
                 cod_nie='$cod_nie',
                 num_hjo='$num_hjo',
                 cod_civ='$cod_civ',
                 lib_mil='$lib_mil',
                 lic_con='$lic_con'
                 where cod_epl='".$this->codigo."'";
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
    }
    /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
    
     /*DATOS DE FAMILIARES*/
     
     
       public function mostrar_familiar_jefe($jefe){
        global $conn;
        $array = array();
        $sql="select emp.cod_epl as COD_EPL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,gral.email as EMAIL,gral2.cedula as CEDULA2
            
            from empleados_basic emp, cargos car, centrocosto2 cen , empleados_gral gral,tmp_parientes gral2
            
            where
            emp.cod_car=car.cod_car
            and emp.cod_epl=gral.cod_epl 
            and gral2.cod_epl=gral.cod_epl
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
            and gral.cod_jefe='$jefe'
             ";
          $rs=$conn->Execute($sql);
             if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
	    
	        $array[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "email"=>$fila["EMAIL"],
                                      "cedula2"=>$fila["CEDULA2"]);
	       }
	       }else{
		$array=null;
	       }
        return $array;
    }
     
     public function validar_familiar($cedula){
           
          global $conn,$odbc;
        
        $validar="select count(*) as CANTIDAD from parientes where cod_epl='".$this->codigo."' and cedula='$cedula'";
        $resul=$conn->Execute($validar);
        $valor=$resul->FetchRow();
        
        return $valor["CANTIDAD"];
     }
     
     public function validar_familiar_tmp($cedula){
           
          global $conn,$odbc;
        
        $validar="select count(*) as CANTIDAD from tmp_parientes where cod_epl='".$this->codigo."' and cedula='$cedula'";
        $resul=$conn->Execute($validar);
        $valor=$resul->FetchRow();
        
        return $valor["CANTIDAD"];
     }
     
    public function mostrar_familiar_tmp($cedula){
        global $conn;
        $array = array();
        $sql="select a.cod_epl as COD_EPL,a.cedula as CEDULA,a.cod_par as COD_PAR,a.tipo_fam AS TIPO_FAM,a.nom_par AS NOM_PAR,
              a.ape_par as APE_PAR,a.tip_doc AS TIP_DOC,a.tip_pco AS TIP_PCO,b.nom_pco AS NOM_PCO,
              a.sexo AS SEXO,a.cod_civ AS COD_CIV,c.est_civ AS EST_CIV,
              a.fec_nac AS FEC_NAC,a.tip_ocup AS TIP_OCUP,a.estudia as ESTUDIA,a.tipo_vinculo as TIPO_VINCULO,
              a.cod_ciu AS COD_CIU,e.nom_ciu AS NOM_CIU,a.cod_nie AS COD_NIE,f.nom_nie AS NOM_NIE,a.discapacitado as DISCAPACITADO
              from tmp_parientes a 
             inner join  parentesco b ON a.tip_pco = b.tip_pco
             left join estado_civil c ON a.cod_civ = c.cod_civ 
             inner JOIN ciudades e ON a.cod_ciu = e.cod_ciu 
             LEFT JOIN nivel_ed f ON a.cod_nie = f.cod_nie
             where a.cod_epl = '".$this->codigo."' and a.cod_par='$cedula'";
          $rs=$conn->Execute($sql);
             if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
	    
	        $array[]=array("codigo"=>$fila["COD_EPL"],
                               "tipo_doc"=>$fila["TIP_DOC"],
                               "discapacitado"=>$fila["DISCAPACITADO"],
                               "tipo_fam"=>$fila["TIPO_FAM"],
                               "tipo_vinculo"=>$fila["TIPO_VINCULO"],
                               "ocupacion"=>$fila["TIP_OCUP"],
                            "cedula"=>$fila["CEDULA"],
                            "codigo"=>$fila["COD_EPL"],
			   "fecha_naci"=>$fila["FEC_NAC"],
                           "nombre"=>$fila["NOM_PAR"],
                           "apellido"=>$fila["APE_PAR"],
                           "parentesco"=>$fila["NOM_PCO"],
                           "estudia"=>$fila["ESTUDIA"],
			   "nacimiento"=>$fila["NOM_CIU"],
			   "vive"=>$fila["CIUVIVE"],
			   "dir"=>$fila["DIR_EPL"],
			   "dir2"=>$fila["DIR_EPL2"],
                           "barrio"=>$fila["NOM_BAR"],
                           "tel2"=>$fila["TEL_2"],
                           "tel1"=>$fila["TEL_1"],
                           "celular"=>$fila["CELULAR"],
                           "sexo"=>$fila["SEXO"],
                           "nom_nie"=>$fila["NOM_NIE"],
                           "num_hijo"=>$fila["NUM_HJO"],
                           "estado"=>$fila["EST_CIV"],
                           "tipo_pco"=>$fila["TIP_PCO"],
                           "clase_lib"=>$fila["CLASE_LIB"],
                           "libreta"=>$fila["LIB_MIL"],
                           "grupo"=>$fila["GRU_SAN"],
                           "ciu_nac"=>$fila["CIU_NAC"],
                           "cod_ciu"=>$fila["COD_CIU"],
                           "cod_bar"=>$fila["COD_BAR"],
                           "cod_nie"=>$fila["COD_NIE"],
                           "cod_civ"=>$fila["COD_CIV"],
                           "lic_con"=>$fila["LIC_CON"],
                           "email"=>$fila["EMAIL"]);
	       }
	       }else{
		$array=null;
	       }
        return $array;
     }
     
     
     
     public function mostrar_familiar(){
        global $conn;
        $array = array();
        $sql="select a.cedula as CEDULA,a.cod_par as COD_PAR,a.tipo_fam AS TIPO_FAM,a.nom_par AS NOM_PAR,
              a.ape_par as APE_PAR,a.tip_doc AS TIP_DOC,a.tip_pco AS TIP_PCO,b.nom_pco AS NOM_PCO,
              a.sexo AS SEXO,a.cod_civ AS COD_CIV,c.est_civ AS EST_CIV,
              a.fec_nac AS FEC_NAC,a.tip_ocup AS TIP_OCUP,a.estudia AS ESTUDIA,
              a.cod_ciu AS COD_CIU,e.nom_ciu AS NOM_CIU,a.cod_nie AS COD_NIE,f.nom_nie AS NOM_NIE
              from parientes a 
             inner join  parentesco b ON a.tip_pco = b.tip_pco
             left join estado_civil c ON a.cod_civ = c.cod_civ 
             left JOIN ciudades e ON a.cod_ciu = e.cod_ciu 
             LEFT JOIN nivel_ed f ON a.cod_nie = f.cod_nie
             where a.cod_epl = '".$this->codigo."'";
          $rs=$conn->Execute($sql);
             if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
	    
	        $array[]=array("cedula"=>$fila["CEDULA"],
                            "codigo"=>$fila["COD_EPL"],
			   "fecha_naci"=>$fila["FEC_NAC"],
                           "nombre"=>$fila["NOM_PAR"],
                           "apellido"=>$fila["APE_PAR"],
                           "parentesco"=>$fila["NOM_PCO"],
			   "nacimiento"=>$fila["CIUNAC"],
			   "vive"=>$fila["CIUVIVE"],
			   "dir"=>$fila["DIR_EPL"],
			   "dir2"=>$fila["DIR_EPL2"],
                           "estudia"=>$fila["ESTUDIA"],
                           "barrio"=>$fila["NOM_BAR"],
                           "tel2"=>$fila["TEL_2"],
                           "tel1"=>$fila["TEL_1"],
                           "celular"=>$fila["CELULAR"],
                           "sexo"=>$fila["SEXO"],
                           "nom_nie"=>$fila["NOM_NIE"],
                           "num_hijo"=>$fila["NUM_HJO"],
                           "estado"=>$fila["EST_CIV"],
                           "libreta"=>$fila["LIB_MIL"],
                           "clase_lib"=>$fila["CLASE_LIB"],
                           "libreta"=>$fila["LIB_MIL"],
                           "grupo"=>$fila["GRU_SAN"],
                           "ciu_nac"=>$fila["CIU_NAC"],
                           "cod_ciu"=>$fila["COD_CIU"],
                           "cod_bar"=>$fila["COD_BAR"],
                           "cod_nie"=>$fila["COD_NIE"],
                           "cod_civ"=>$fila["COD_CIV"],
                           "lic_con"=>$fila["LIC_CON"],
                           "email"=>$fila["EMAIL"]);
	       }
	       }else{
		$array=null;
	       }
        return $array;
     }
     
     public function mostrar_familiar_espe($cedula){
        global $conn;
        $array = array();
        $sql="select a.cedula as CEDULA,a.cod_par as COD_PAR,a.tipo_fam AS TIPO_FAM,a.nom_par AS NOM_PAR,
              a.ape_par as APE_PAR,a.tip_doc AS TIP_DOC,a.tip_pco AS TIP_PCO,b.nom_pco AS NOM_PCO,
              a.sexo AS SEXO,a.cod_civ AS COD_CIV,c.est_civ AS EST_CIV,a.tip_doc as TIPO_DOC,
              a.fec_nac AS FEC_NAC,a.tip_ocup AS TIP_OCUP,a.estudia as ESTUDIA,a.tipo_vinculo as TIPO_VINCULO,
              a.cod_ciu AS COD_CIU,e.nom_ciu AS NOM_CIU,a.cod_nie AS COD_NIE,f.nom_nie AS NOM_NIE,a.discapacitado as DISCAPACITADO
              from parientes a 
             inner join  parentesco b ON a.tip_pco = b.tip_pco
             left join estado_civil c ON a.cod_civ = c.cod_civ 
             left JOIN ciudades e ON a.cod_ciu = e.cod_ciu 
             LEFT JOIN nivel_ed f ON a.cod_nie = f.cod_nie
             where a.cod_epl = '".$this->codigo."' and cedula='$cedula'";
          $rs=$conn->Execute($sql);
             if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
	    
	        $array[]=array("discapacitado"=>$fila["DISCAPACITADO"],
                               "tipo_fam"=>$fila["TIPO_FAM"],
                               "tipo_vinculo"=>$fila["TIPO_VINCULO"],
                               "ocupacion"=>$fila["TIP_OCUP"],
                            "cedula"=>$fila["CEDULA"],
                            "codigo"=>$fila["COD_EPL"],
			   "fecha_naci"=>$fila["FEC_NAC"],
                           "nombre"=>$fila["NOM_PAR"],
                           "apellido"=>$fila["APE_PAR"],
                           "parentesco"=>$fila["NOM_PCO"],
                           "estudia"=>$fila["ESTUDIA"],
			   "nacimiento"=>$fila["CIUNAC"],
			   "vive"=>$fila["CIUVIVE"],
			   "dir"=>$fila["DIR_EPL"],
			   "dir2"=>$fila["DIR_EPL2"],
                           "barrio"=>$fila["NOM_BAR"],
                           "tel2"=>$fila["TEL_2"],
                           "tel1"=>$fila["TEL_1"],
                           "celular"=>$fila["CELULAR"],
                           "sexo"=>$fila["SEXO"],
                           "nom_nie"=>$fila["NOM_NIE"],
                           "num_hijo"=>$fila["NUM_HJO"],
                           "estado"=>$fila["EST_CIV"],
                           "libreta"=>$fila["LIB_MIL"],
                           "clase_lib"=>$fila["CLASE_LIB"],
                           "libreta"=>$fila["LIB_MIL"],
                           "grupo"=>$fila["GRU_SAN"],
                           "ciu_nac"=>$fila["CIU_NAC"],
                           "cod_ciu"=>$fila["COD_CIU"],
                           "ciudad"=>$fila["NOM_CIU"],
                           "cod_bar"=>$fila["COD_BAR"],
                           "cod_nie"=>$fila["COD_NIE"],
                           "cod_civ"=>$fila["COD_CIV"],
                           "lic_con"=>$fila["LIC_CON"],
                           "email"=>$fila["EMAIL"],
                           "tipo_doc"=>$fila["TIPO_DOC"]);
	       }
	       }else{
		$array=null;
	       }
        return $array;
     }
     
    public  function insertar_familiar_tmp($documento,$nombre,$apellido,$tipo,$parentesco,$genero,$estados,$fecha,$ocupacion,$estudia,$ciudad,$nivel,$vinculo,$discapacitado,$benauxilio){
        
        global $conn,$odbc;
        $respuesta = null;
        if($odbc == "odbc_mssql"){
        $sql="insert into tmp_parientes values('".$this->codigo."','".$documento."','$benauxilio','".$nombre."',
        '".$apellido."','".$tipo."','".$documento."',".$parentesco."','".$genero."','".$estados."',(CONVERT(CHAR(19), '$fecha 00:00:00 a.m.',113)),
        '".$ocupacion."','".$estudia."','$ciudad',NULL,'".$nivel."',NULL,NULL,NULL,NULL,NULL,
        '$vinculo',NULL,NULL,NULL,NULL,'".$discapacitado."',NULL,NULL,NULL,NULL,NULL,NULL,NULL)
              ";
        }elseif($odbc == "oci8"){
            $sql="insert into tmp_parientes values('".$this->codigo."','".$documento."','$benauxilio','".$nombre."','".$apellido."','".$tipo."','".$documento."',
              '".$parentesco."','".$genero."','".$estados."',(TO_DATE ('$fecha ', 'DD-MM-YY')),'".$ocupacion."','".$estudia."','$ciudad',NULL,'".$nivel."',NULL,NULL,NULL,NULL,NULL,
              '$vinculo',NULL,NULL,NULL,NULL,'".$discapacitado."',NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
        }
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
        
    }
    public function insertar_familiar($documento,$nombre,$apellido,$tipo,$parentesco,$genero,$estados,$fecha,$ocupacion,$estudia,$ciudad,$nivel,$vinculo,$discapacitado,$benauxilio){
        
        global $conn,$odbc;
        $respuesta = null;
        if($odbc == "odbc_mssql"){
        $sql="insert into parientes values('".$this->codigo."','".$documento."','$benauxilio','".$nombre."',
        '".$apellido."','".$tipo."','".$documento."',".$parentesco."','".$genero."','".$estados."',(CONVERT(CHAR(19), '$fecha 00:00:00 a.m.',113)),
        '".$ocupacion."','".$estudia."','$ciudad',NULL,'".$nivel."',NULL,NULL,NULL,NULL,NULL,
        '$vinculo',NULL,NULL,NULL,NULL,'".$discapacitado."',NULL,NULL,NULL,NULL,NULL,NULL,NULL)
              ";
        }elseif($odbc == "oci8"){
            $sql="insert into parientes values('".$this->codigo."','".$documento."','$benauxilio','".$nombre."','".$apellido."','".$tipo."','".$documento."',
              '".$parentesco."','".$genero."','".$estados."',(TO_DATE ('$fecha ', 'DD-MM-YY')),'".$ocupacion."','".$estudia."','$ciudad',NULL,'".$nivel."',NULL,NULL,NULL,NULL,NULL,
              '$vinculo',NULL,NULL,NULL,NULL,'".$discapacitado."',NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
        }
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
        
    }
    public function editar_familiar($documento,$nombre,$apellido,$tipo,$parentesco,$genero,$estados,$fecha,$ocupacion,$estudia,$ciudad,$nivel,$vinculo,$discapacitado,$benauxilio){
        
        global $conn,$odbc;
        $respuesta=null;
        if($odbc == "odbc_mssql"){
        $sql="UPDATE tmp_parientes
             SET cod_par='".$documento."',nom_par='$nombre',
             ape_par='$apellido',tip_doc='$tipo',
             cedula='$documento',tip_pco='$parentesco',
             sexo='$genero',cod_civ='$estados',tipo_vinculo='$vinculo',
             fec_nac=(CONVERT(CHAR(19), '$fecha 00:00:00 a.m.',113)),
             tip_ocup='$ocupacion',estudia='$estudia',tipo_fam='$benauxilio',
             cod_ciu='$ciudad',cod_nie='$nivel',discapacitado='$discapacitado'
             where cod_epl='".$this->codigo."' and cedula='$documento'
            ";
        }elseif($odbc == "oci8"){
             $sql="UPDATE tmp_parientes
             SET cod_par='".$documento."',nom_par='$nombre',
             ape_par='$apellido',tip_doc='$tipo',
             cedula='$documento',tip_pco='$parentesco',
             sexo='$genero',cod_civ='$estados',tipo_vinculo='$vinculo',
             fec_nac=(TO_DATE ('$fecha ', 'DD-MM-YY')),
             tip_ocup='$ocupacion',estudia='$estudia',tipo_fam='$benauxilio',
             cod_ciu='$ciudad',cod_nie='$nivel',discapacitado='$discapacitado'
             where cod_epl='".$this->codigo."' and cedula='$documento'
            ";
        }
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
            
    }
    
    public function editar_familiar_tmp($documento,$nombre,$apellido,$tipo,$parentesco,$genero,$estados,$fecha,$ocupacion,$estudia,$ciudad,$nivel,$vinculo,$discapacitado,$benauxilio){
        
        global $conn,$odbc;
        $respuesta=null;
        
        if($odbc == "odbc_mssql"){
        $sql="UPDATE tmp_parientes
             SET cod_par='".$documento."',nom_par='$nombre',
             ape_par='$apellido',tip_doc='$tipo',
             cedula='$documento',tip_pco='$parentesco',
             sexo='$genero',cod_civ='$estados',tipo_vinculo='$vinculo',
             fec_nac=(CONVERT(CHAR(19), '$fecha 00:00:00 a.m.',113)),
             tip_ocup='$ocupacion',estudia='$estudia',tipo_fam='$benauxilio',
             cod_ciu='$ciudad',cod_nie='$nivel',discapacitado='$discapacitado'
             where cod_epl='".$this->codigo."' and cedula='$documento'
            ";
        }elseif($odbc == "oci8"){
             $sql="UPDATE tmp_parientes
             SET cod_par='".$documento."',nom_par='$nombre',
             ape_par='$apellido',tip_doc='$tipo',
             cedula='$documento',tip_pco='$parentesco',
             sexo='$genero',cod_civ='$estados',tipo_vinculo='$vinculo',
             fec_nac=(TO_DATE ('$fecha ', 'DD-MM-YY')),
             tip_ocup='$ocupacion',estudia='$estudia',tipo_fam='$benauxilio',
             cod_ciu='$ciudad',cod_nie='$nivel',discapacitado='$discapacitado'
             where cod_epl='".$this->codigo."' and cedula='$documento'
            ";
        }
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
            
    }
    /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
    
    /*EDUCACION FORMAL*/
    
   public function mostrar_formal(){
        
        global $conn;
        $array = array();
        $sql="select a.cod_clp as COD_CLP,b.nom_est AS NOM_EST,a.cod_ttp AS COD_TTP,c.desc_ttp AS DESC_TTP,
              a.obt_tit AS OBT_TIT,a.fec_ini AS FEC_INI,a.fec_fin AS FEC_FIN,a.tiempo AS TIEMPO,
              a.cod_uni AS COD_UNI,d.cod_uni AS COD_UNI2,a.cod_enti AS COD_ENTI,
              e.nom_enti AS NOM_ENTI,a.cod_ciu AS COD_CIU,f.nom_ciu AS NOM_CIU,
              a.cod_pai AS COD_PAI,g.nom_pai AS NOM_PAI
              from cap_fictec a,estudios b,titulos c,unidades d, entid_cp e,
              ciudades f,paises g
              where a.cod_clp = b.cod_est
              and a.cod_ttp = c.cod_ttp
              and a.cod_uni = d.cod_uni
              and a.cod_ciu = f.cod_ciu
              and a.cod_pai = g.cod_pai
              and a.tip_est = 'F'
              and a.cod_enti = e.cod_enti
              and a.cod_epl='".$this->codigo."'
        ";
        $rs=$conn->Execute($sql);
        if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
                    $array[]=array("cod_clp"=>$fila["COD_CLP"],
                                   "nombre"=>$fila["NOM_EST"],
                                   "cod_ttp"=>$fila["COD_TTP"],
                                   "desc_ttp"=>$fila["DESC_TTP"],
                                   "obt_tit"=>$fila["OBT_TIT"],
                                   "inicial"=>$fila["FEC_INI"],
                                   "final"=>$fila["FEC_FIN"],
                                   "tiempo"=>$fila["TIEMPO"],
                                   "cod_uni"=>$fila["COD_UNI"],
                                   "cod_enti"=>$fila["COD_ENTI"],
                                   "nom_enti"=>$fila["NOM_ENTI"],
                                   "cod_ciu"=>$fila["COD_CIU"],
                                   "ciudad"=>$fila["NOM_CIU"],
                                   "cod_pai"=>$fila["COD_PAI"],
                                   "nom_pai"=>$fila["NOM_PAI"],
                                   );
                    
                }
        }else{
		$array=null;
	       }
        return $array;
    }
    
    public function mostrar_formal_espe($titulo,$estudio){
        
        global $conn;
        $array = array();
        $sql="select a.cod_epl,a.cod_clp as COD_CLP,b.nom_est AS NOM_EST,a.cod_ttp AS COD_TTP,c.desc_ttp AS DESC_TTP,
              a.obt_tit AS OBT_TIT,a.fec_ini AS FEC_INI,a.fec_fin AS FEC_FIN,a.tiempo AS TIEMPO,
              a.cod_uni AS COD_UNI,d.cod_uni AS COD_UNI2,a.cod_enti AS COD_ENTI,
              e.nom_enti AS NOM_ENTI,a.cod_ciu AS COD_CIU,f.nom_ciu AS NOM_CIU,
              a.cod_pai AS COD_PAI,g.nom_pai AS NOM_PAI,d.nom_uni as NOM_UNI
              from cap_fictec a,estudios b,titulos c,unidades d, entid_cp e,
              ciudades f,paises g
              where a.cod_clp = b.cod_est
              and a.cod_ttp = c.cod_ttp
              and a.cod_uni = d.cod_uni
              and a.cod_ciu = f.cod_ciu
              and a.cod_pai = g.cod_pai
              and a.tip_est = 'F'
              and a.cod_enti = e.cod_enti
              and a.cod_clp='$estudio' and a.cod_ttp='$titulo'
              and a.cod_epl='".$this->codigo."'
        ";
        $rs=$conn->Execute($sql);
        if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
                    $array[]=array("nom_uni"=>$fila["NOM_UNI"],
                                   "nombre"=>$fila["NOM_EST"],
                                   "cod_ttp"=>$fila["COD_TTP"],
                                   "desc_ttp"=>$fila["DESC_TTP"],
                                   "obt_tit"=>$fila["OBT_TIT"],
                                   "inicial"=>$fila["FEC_INI"],
                                   "final"=>$fila["FEC_FIN"],
                                   "tiempo"=>$fila["TIEMPO"],
                                   "cod_uni"=>$fila["COD_UNI"],
                                   "cod_enti"=>$fila["COD_ENTI"],
                                   "nom_enti"=>$fila["NOM_ENTI"],
                                   "cod_ciu"=>$fila["COD_CIU"],
                                   "ciudad"=>$fila["NOM_CIU"],
                                   "cod_pai"=>$fila["COD_PAI"],
                                   "nom_pai"=>$fila["NOM_PAI"]
                                   );
                    
                }
        }else{
		$array=null;
	       }
        return $array;
    }
    
    public function mostrar_formal_espe_jefe($titulo,$estudio){
        
        global $conn;
        $array = array();
        $sql="select a.cod_epl,a.cod_clp as COD_CLP,b.nom_est AS NOM_EST,a.cod_ttp AS COD_TTP,c.desc_ttp AS DESC_TTP,
              a.obt_tit AS OBT_TIT,a.fec_ini AS FEC_INI,a.fec_fin AS FEC_FIN,a.tiempo AS TIEMPO,
              a.cod_uni AS COD_UNI,d.cod_uni AS COD_UNI2,a.cod_enti AS COD_ENTI,
              e.nom_enti AS NOM_ENTI,a.cod_ciu AS COD_CIU,f.nom_ciu AS NOM_CIU,
              a.cod_pai AS COD_PAI,g.nom_pai AS NOM_PAI,d.nom_uni as NOM_UNI
              from tmp_cap_fictec a,estudios b,titulos c,unidades d, entid_cp e,
              ciudades f,paises g
              where a.cod_clp = b.cod_est
              and a.cod_ttp = c.cod_ttp
              and a.cod_uni = d.cod_uni
              and a.cod_ciu = f.cod_ciu
              and a.cod_pai = g.cod_pai
              and a.tip_est = 'F'
              and a.cod_enti = e.cod_enti
              and a.cod_clp='$estudio' and a.cod_ttp='$titulo'
              and a.cod_epl='".$this->codigo."'
        ";
        $rs=$conn->Execute($sql);
        if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
                    $array[]=array("estudio"=>$fila["COD_CLP"],
                                   "nom_uni"=>$fila["NOM_UNI"],
                                   "nombre"=>$fila["NOM_EST"],
                                   "cod_ttp"=>$fila["COD_TTP"],
                                   "desc_ttp"=>$fila["DESC_TTP"],
                                   "obt_tit"=>$fila["OBT_TIT"],
                                   "inicial"=>$fila["FEC_INI"],
                                   "final"=>$fila["FEC_FIN"],
                                   "tiempo"=>$fila["TIEMPO"],
                                   "cod_uni"=>$fila["COD_UNI"],
                                   "cod_enti"=>$fila["COD_ENTI"],
                                   "nom_enti"=>$fila["NOM_ENTI"],
                                   "cod_ciu"=>$fila["COD_CIU"],
                                   "ciudad"=>$fila["NOM_CIU"],
                                   "cod_pai"=>$fila["COD_PAI"],
                                   "nom_pai"=>$fila["NOM_PAI"]
                                   );
                    
                }
        }else{
		$array=null;
	       }
        return $array;
    }
    
    public function mostrar_formal_tmp(){
         global $conn;
        $sql="select a.cod_clp as COD_CLP,b.nom_est AS NOM_EST,a.cod_ttp AS COD_TTP,c.desc_ttp AS DESC_TTP,
              a.obt_tit AS OBT_TIT,a.fec_ini AS FEC_INI,a.fec_fin AS FEC_FIN,a.tiempo AS TIEMPO,
              a.cod_uni AS COD_UNI,d.cod_uni AS COD_UNI2,a.cod_enti AS COD_ENTI,
              e.nom_enti AS NOM_ENTI,a.cod_ciu AS COD_CIU,f.nom_ciu AS NOM_CIU,
              a.cod_pai AS COD_PAI,g.nom_pai AS NOM_PAI
              from tmp_cap_fictec a,estudios b,titulos c,unidades d, entid_cp e,
              ciudades f,paises g
              where a.cod_clp = b.cod_est
              and a.cod_ttp = c.cod_ttp
              and a.cod_uni = d.cod_uni
              and a.cod_ciu = f.cod_ciu
              and a.cod_pai = g.cod_pai
              and a.tip_est = 'F'
              and a.cod_enti = e.cod_enti
              ddddand a.cod_epl='".$this->codigo."'
        ";
         $rs=$conn->Execute($sql);
        if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
                    $array[]=array("cedula"=>$fila["CEDULA"],
                                   "nombre"=>$fila["NOM_EST"],
                                   "cod_ttp"=>$fila["COD_TTP"],
                                   "desc_ttp"=>$fila["DESC_TTP"],
                                   "obt_tit"=>$fila["OBT_TIT"],
                                   "inicial"=>$fila["FEC_INI"],
                                   "final"=>$fila["FEC_FIN"],
                                   "tiempo"=>$fila["TIEMPO"],
                                   "cod_uni"=>$fila["COD_UNI"],
                                   "cod_enti"=>$fila["COD_ENTI"],
                                   "nom_enti"=>$fila["NOM_ENTI"],
                                   "cod_ciu"=>$fila["COD_CIU"],
                                   "ciudad"=>$fila["NOM_CIU"],
                                   "cod_pai"=>$fila["COD_PAI"],
                                   "nom_pai"=>$fila["NOM_PAI"],
                                   );
                    
                }
        }else{
		$array=null;
	       }
        return $array;
    }
    
    public function mostrar_formal_jefe($jefe){
         global $conn;
        $sql=" select emp.cod_epl as COD_EPL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,gral.email as EMAIL,gral2.cod_clp as COD_CLP,gral2.cod_ttp as COD_TTP
            
            from empleados_basic emp, cargos car, centrocosto2 cen , empleados_gral gral,tmp_cap_fictec gral2
            
            where
            emp.cod_car=car.cod_car
            and emp.cod_epl=gral.cod_epl 
            and gral2.cod_epl=gral.cod_epl
            and emp.cod_cc2=cen.cod_cc2
            and gral2.tip_est='F'
            and gral.cod_jefe='$jefe'
        ";
         $rs=$conn->Execute($sql);
        if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
                    $array[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "email"=>$fila["EMAIL"],
                                      "cod_clp"=>$fila["COD_CLP"],
                                      "cod_ttp"=>$fila["COD_TTP"]);
                    
                }
        }else{
		$array=null;
	       }
        return $array;
    }
    
    public function insertar_formal_tmp($estudios,$titulo,$inicial,$final,$tiempo,$unidad,$entidad,$ciudad,$pais){
        
        global $conn,$odbc;
        $respuesta = null;
        
        
        if($odbc == "odbc_mssql"){
            
            if($final == ""){
            $fecha_final="NULL";
        }else{
            $fecha_final="(CONVERT(CHAR(19), '$final 00:00:00 a.m.',113))";
        }
        $sql="insert into tmp_cap_fictec
              values('".$this->codigo."','F','$estudios','$titulo',
              NULL,NULL,NULL,NULL,NULL,
              (CONVERT(CHAR(19), '$inicial 00:00:00 a.m.',113)),
              $fecha_final,
             '$tiempo','$unidad',
             '$entidad','$ciudad','$pais',NULL)
             ";
        }elseif($odbc == "oci8"){
                if($final == ""){
            $fecha_final="NULL";
        }else{
            $fecha_final="(TO_DATE ('$final ', 'DD-MM-YY'))";
        }
            $sql="insert into tmp_cap_fictec
              values('".$this->codigo."','F','$estudios','$titulo',
              NULL,NULL,NULL,NULL,NULL,
              (TO_DATE ('$inicial ', 'DD-MM-YY')),
              $fecha_final,
             '$tiempo','$unidad',
             '$entidad','$ciudad','$pais',NULL)
             ";
        }
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
    }
    
     public function insertar_formal($estudios,$titulo,$inicial,$final,$tiempo,$unidad,$entidad,$ciudad,$pais){
        
        global $conn,$odbc;
        $respuesta = null;
        if($odbc == "odbc_mssql"){
            
              if($final == ""){
            $fecha_final="NULL";
        }else{
            $fecha_final="(CONVERT(CHAR(19), '$final 00:00:00 a.m.',113))";
        }
        $sql="insert into cap_fictec
              values('".$this->codigo."','F','$estudios','$titulo',
              'Si',NULL,NULL,NULL,NULL,
              (CONVERT(CHAR(19), '$inicial 00:00:00 a.m.',113)),
              $fecha_final,
             '$tiempo','$unidad',
             '$entidad','$ciudad','$pais',NULL)
             ";
        }elseif($odbc == "oci8"){
            
                   if($final == ""){
            $fecha_final="NULL";
        }else{
            $fecha_final="(TO_DATE ('$final ', 'DD-MM-YY'))";
        }
            $sql="insert into cap_fictec
              values('".$this->codigo."','F','$estudios','$titulo',
              'Si',NULL,NULL,NULL,NULL,
              (TO_DATE ('$inicial ', 'DD-MM-YY')),
              $fecha_final,
             '$tiempo','$unidad',
             '$entidad','$ciudad','$pais',NULL)
             ";
        }
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
    }
    
    public function editar_formal_tmp($estudios,$titulo,$inicial,$final,$tiempo,$unidad,$entidad,$ciudad,$pais){
        
          global $conn,$odbc;
        $respuesta=null;
        
        if($odbc == "odbc_mssql"){
            
        if($final == ""){
            $fecha_final="";
        }else{
            $fecha_final="fec_fin = CONVERT(CHAR(19), '$final 00:00:00 a.m.',113),";
        }
        $sql="UPDATE tmp_cap_fictec
                SET cod_clp = '$estudios' ,
                cod_ttp = '$titulo',
                fec_ini = CONVERT(CHAR(19), '$inicial 00:00:00 a.m.',113),
                $fecha_final
                tiempo = '$tiempo' ,
                cod_uni = '$unidad' ,
                cod_enti= '$entidad' ,
                cod_ciu = '$ciudad' ,
                cod_pai = '$pais'
                WHERE 
                cod_epl = '".$this->codigo."' AND
                tip_est = 'F' AND
                cod_clp = '$estudios' AND
                cod_ttp = '$titulo'
            ";
        }elseif($odbc == "oci8"){
            
                       if($final == ""){
            $fecha_final="";
        }else{
            $fecha_final="fec_fin = TO_DATE ('$final', 'DD-MM-YY'),";
        }
             $sql="UPDATE tmp_cap_fictec
                SET cod_clp = '$estudios' ,
                cod_ttp = '$titulo',
                fec_ini = TO_DATE ('$inicial ', 'DD-MM-YY'),
                $fecha_final
                tiempo = '$tiempo' ,
                cod_uni = '$unidad' ,
                cod_enti= '$entidad' ,
                cod_ciu = '$ciudad' ,
                cod_pai = '$pais'
                WHERE 
                cod_epl = '".$this->codigo."' AND
                tip_est = 'F' AND
                cod_clp = '$estudios' AND
                cod_ttp = '$titulo'
            ";
        }
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
        
    }
    
    public function editar_formal($estudios,$titulo,$inicial,$final,$unidad,$tiempo,$entidad,$ciudad,$pais){
        
          global $conn,$odbc;
        $respuesta=null;
        
        if($odbc == "odbc_mssql"){
            
            if($final == ""){
            $fecha_final="";
        }else{
            $fecha_final="fec_fin =CONVERT(CHAR(19), '$final 00:00:00 a.m.',113),";
        }
        $sql="UPDATE cap_fictec
                SET cod_clp = '$estudios' ,
                cod_ttp = '$titulo',
                fec_ini = CONVERT(CHAR(19), '$inicial 00:00:00 a.m.',113),
                 $fecha_final
                cod_uni = '$unidad' ,
                tiempo='$tiempo',
                cod_enti= '$entidad' ,
                cod_ciu = '$ciudad' ,
                cod_pai = '$pais'
                WHERE 
                cod_epl = '".$this->codigo."' AND
                tip_est = 'F' AND
                cod_clp = '$estudios' AND
                cod_ttp = '$titulo'
            ";
        }elseif($odbc == "oci8"){
            
            if($final == ""){
            $fecha_final="";
        }else{
            $fecha_final="fec_fin = TO_DATE ('$final ', 'DD-MM-YY'),";
        }
             $sql="UPDATE cap_fictec
                SET cod_clp = '$estudios' ,
                cod_ttp = '$titulo',
                fec_ini = TO_DATE ('$inicial ', 'DD-MM-YY'),
                $fecha_final
                cod_uni = '$unidad' ,
                tiempo='$tiempo',
                cod_enti= '$entidad' ,
                cod_ciu = '$ciudad' ,
                cod_pai = '$pais'
                WHERE 
                cod_epl = '".$this->codigo."' AND
                tip_est = 'F' AND
                cod_clp = '$estudios' AND
                cod_ttp = '$titulo'
            ";
        }
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
        
    }
    
    public function validar_formal_tmp($estudio,$titulo){
           
          global $conn,$odbc;
        
        $validar="select count(*) AS CANTIDAD from tmp_cap_fictec where tip_Est='F' and cod_epl='".$this->codigo."' and cod_clp='$estudio' and cod_ttp='$titulo'";
        $resul=$conn->Execute($validar);
        $valor=$resul->FetchRow();
        
        return $valor["CANTIDAD"];
     }
     
      public function validar_formal($estudio,$titulo){
           
          global $conn,$odbc;
        
        $validar="select count(*) AS CANTIDAD from cap_fictec where tip_Est='F' and cod_epl='".$this->codigo."' and cod_clp='$estudio' and cod_ttp='$titulo'";
        $resul=$conn->Execute($validar);
        $valor=$resul->FetchRow();
        
        return $valor["CANTIDAD"];
     }
     /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
    
    /*EDUCACION NO FORMAL*/
    
    
    public function validar_edu_no_formal($cod_tca,$cod_prc,$cod_mdc,$cod_area){
           
          global $conn,$odbc;
        
        $validar="select count(*) as CANTIDAD from
                  cap_fictec where tip_est='N'
                  and cod_tca='$cod_tca'
                  and cod_prc='$cod_prc'
                  and cod_mdc='$cod_mdc'
                  and cod_area='$cod_area'
                  and cod_epl='".$this->codigo."'";
        $resul=$conn->Execute($validar);
        $valor=$resul->FetchRow();
        
        return $valor["CANTIDAD"];
    }
    
    public function validar_edu_formal_tmp($cod_tca,$cod_prc,$cod_mdc,$cod_area){
           
          global $conn,$odbc;
        
        $validar="select count(*) as CANTIDAD from
                  tmp_cap_fictec where tip_est='N'
                  and cod_tca='$cod_tca'
                  and cod_prc='$cod_prc'
                  and cod_mdc='$cod_mdc'
                  and cod_area='$cod_area'
                  and cod_epl='".$this->codigo."'";
        $resul=$conn->Execute($validar);
        $valor=$resul->FetchRow();
        
        return $valor["CANTIDAD"];
    }
    
    public function mostrar_no_formal(){
        global $conn,$odbc;
        
        
        if($odbc == "odbc_mssql"){
            $desc_prc = "desc_prg";
            }elseif($odbc == "oci8"){
                $desc_prc = "desc_prc";
            }
        
        $sql="select b.desc_tca as DESC_TCA,c.$desc_prc AS DESC_PRC,d.desc_area AS DESC_AREA,
                e.desc_mdc AS DESC_MDC,a.fec_ini AS FEC_INI,a.fec_fin AS FEC_FIN,
              a.tiempo AS TIEMPO,f.nom_uni AS NOM_UNI,h.nom_ciu AS NOM_CIU,i.nom_pai AS NOM_PAI,
               a.cod_tca AS COD_TCA, a.cod_prc AS COD_PRC, a.cod_area AS COD_AREA, cod_epl AS COD_EPL,a.cod_mdc as COD_MDC
            from cap_fictec a,tipo_capac b,progs_cap c,areas_co d,modal_curso e,
            unidades f,entid_cp g,ciudades h,paises i
            where a.cod_tca = b.cod_tca
            and a.cod_area = d.cod_area
            and a.cod_mdc = e.cod_mdc
            and a.cod_uni = f.cod_uni
            and a.cod_enti = g.cod_enti
            and a.cod_ciu = h.cod_ciu
            and a.cod_pai = i.cod_pai
            and a.tip_est = 'N'
            and a.cod_epl = '".$this->codigo."'
            ";
            $rs=$conn->Execute($sql);
        if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
                    $array[]=array("cod_mdc"=>$fila["COD_MDC"],
                                   "desc_tca"=>$fila["DESC_TCA"],
                                   "desc_prc"=>$fila["DESC_PRC"],
                                   "desc_area"=>$fila["DESC_AREA"],
                                   "desc_mdc"=>$fila["DESC_MDC"],
                                   "inicial"=>$fila["FEC_INI"],
                                   "final"=>$fila["FEC_FIN"],
                                   "tiempo"=>$fila["TIEMPO"],
                                   "nom_uni"=>$fila["NOM_UNI"],
                                   "nom_ciu"=>$fila["NOM_CIU"],
                                   "nom_pai"=>$fila["NOM_PAI"],
                                   "cod_tca"=>$fila["COD_TCA"],
                                   "cod_prc"=>$fila["COD_PRC"],
                                   "cod_area"=>$fila["COD_AREA"],
                                   "codigo"=>$fila["COD_EPL"]
                                   );
                    
                }
        }else{
		$array=null;
	       }
        return $array;
    }
    
     public function mostrar_no_formal_tmp(){
        global $conn,$odbc;
        if($odbc == "odbc_mssql"){
            $desc_prc="desc_prg";
            }elseif($odbc == "oci8"){
                $desc_prc="desc_prc";
            }
        
        $sql="select b.desc_tca as DESC_TCA,c.$desc_prc AS DESC_PRC,d.desc_area AS DESC_AREA,
                e.desc_mdc AS DESC_MDC,a.fec_ini AS FEC_INI,a.fec_fin AS FEC_FIN,
              a.tiempo AS TIEMPO,f.nom_uni AS NOM_UNI,h.nom_ciu AS NOM_CIU,i.nom_pai AS NOM_PAI,
               a.cod_tca AS COD_TCA, a.cod_prc AS COD_PRC, a.cod_area AS COD_AREA, cod_epl AS COD_EPL,a.cod_mdc as COD_MDC
            from tmp_cap_fictec a,tipo_capac b,progs_cap c,areas_co d,modal_curso e,
            unidades f,entid_cp g,ciudades h,paises i
            where a.cod_tca = b.cod_tca
            and a.cod_area = d.cod_area
            and a.cod_mdc = e.cod_mdc
            and a.cod_uni = f.cod_uni
            and a.cod_enti = g.cod_enti
            and a.cod_ciu = h.cod_ciu
            and a.cod_pai = i.cod_pai
            and a.tip_est = 'N'
            and a.cod_epl = '".$this->codigo."'
            ";
            $rs=$conn->Execute($sql);
        if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
                    $array[]=array("cod_mdc"=>$fila["COD_MDC"],
                                   "desc_tca"=>$fila["DESC_TCA"],
                                   "desc_prc"=>$fila["DESC_PRC"],
                                   "desc_area"=>$fila["DESC_AREA"],
                                   "desc_mdc"=>$fila["DESC_MDC"],
                                   "inicial"=>$fila["FEC_INI"],
                                   "final"=>$fila["FEC_FIN"],
                                   "tiempo"=>$fila["TIEMPO"],
                                   "nom_uni"=>$fila["NOM_UNI"],
                                   "nom_ciu"=>$fila["NOM_CIU"],
                                   "nom_pai"=>$fila["NOM_PAI"],
                                   "cod_tca"=>$fila["COD_TCA"],
                                   "cod_prc"=>$fila["COD_PRC"],
                                   "cod_area"=>$fila["COD_AREA"],
                                   "codigo"=>$fila["COD_EPL"]
                                   );
                    
                }
        }else{
		$array=null;
	       }
        return $array;
    }
    
     public function mostrar_no_formal_espe($cod_tca,$cod_prc,$cod_mdc,$cod_area){
        global $conn,$odbc;
        if($odbc == "odbc_mssql"){
            $desc_prc="desc_prg";
            }elseif($odbc == "oci8"){
                $desc_prc="desc_prc";
            }
        
        $sql="select b.desc_tca as DESC_TCA,c.$desc_prc AS DESC_PRC,d.desc_area AS DESC_AREA,
                e.desc_mdc AS DESC_MDC,a.fec_ini AS FEC_INI,a.fec_fin AS FEC_FIN,
              a.tiempo AS TIEMPO,f.nom_uni AS NOM_UNI,h.nom_ciu AS NOM_CIU,i.nom_pai AS NOM_PAI,g.nom_enti as NOM_ENTE,
               a.cod_tca AS COD_TCA, a.cod_prc AS COD_PRC, a.cod_area AS COD_AREA, cod_epl AS COD_EPL,a.cod_mdc as COD_MDC
            from cap_fictec a,tipo_capac b,progs_cap c,areas_co d,modal_curso e,
            unidades f,entid_cp g,ciudades h,paises i
            where a.cod_tca = b.cod_tca
            and a.cod_area = d.cod_area
            and a.cod_mdc = e.cod_mdc
            and a.cod_uni = f.cod_uni
            and a.cod_enti = g.cod_enti
            and a.cod_ciu = h.cod_ciu
            and a.cod_pai = i.cod_pai
            and a.tip_est = 'N'
            and a.cod_tca='$cod_tca'
            and a.cod_prc='$cod_prc'
            and a.cod_mdc='$cod_mdc'
            and a.cod_area='$cod_area'
            and a.cod_epl = '".$this->codigo."'
            ";
            $rs=$conn->Execute($sql);
        if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
                    $array[]=array("entidad"=>$fila["NOM_ENTE"],
                                   "cod_mdc"=>$fila["COD_MDC"],
                                   "desc_tca"=>$fila["DESC_TCA"],
                                   "desc_prc"=>$fila["DESC_PRC"],
                                   "desc_area"=>$fila["DESC_AREA"],
                                   "desc_mdc"=>$fila["DESC_MDC"],
                                   "inicial"=>$fila["FEC_INI"],
                                   "final"=>$fila["FEC_FIN"],
                                   "tiempo"=>$fila["TIEMPO"],
                                   "nom_uni"=>$fila["NOM_UNI"],
                                   "nom_ciu"=>$fila["NOM_CIU"],
                                   "nom_pai"=>$fila["NOM_PAI"],
                                   "cod_tca"=>$fila["COD_TCA"],
                                   "cod_prc"=>$fila["COD_PRC"],
                                   "cod_area"=>$fila["COD_AREA"],
                                   "codigo"=>$fila["COD_EPL"]
                                   );
                    
                }
        }else{
		$array=null;
	       }
        return $array;
    }
    
     public function mostrar_no_formal_espe_tmp($cod_tca,$cod_prc,$cod_mdc,$cod_area){
        global $conn,$odbc;
        if($odbc == "odbc_mssql"){
            $desc_prc="desc_prg";
            }elseif($odbc == "oci8"){
                $desc_prc="desc_prc";
            }
        
        $sql="select b.desc_tca as DESC_TCA,c.$desc_prc AS DESC_PRC,d.desc_area AS DESC_AREA,
                e.desc_mdc AS DESC_MDC,a.fec_ini AS FEC_INI,a.fec_fin AS FEC_FIN,
              a.tiempo AS TIEMPO,f.nom_uni AS NOM_UNI,h.nom_ciu AS NOM_CIU,i.nom_pai AS NOM_PAI,
               a.cod_tca AS COD_TCA, a.cod_prc AS COD_PRC,a.cod_mdc as COD_MDC,a.cod_uni as COD_UNI,
               a.cod_enti as COD_ENTI,a.cod_area AS COD_AREA, cod_epl AS COD_EPL,g.nom_enti as NOM_ENTE,
               a.cod_ciu as COD_CIU,a.cod_pai as COD_PAI
            from tmp_cap_fictec a,tipo_capac b,progs_cap c,areas_co d,modal_curso e,
            unidades f,entid_cp g,ciudades h,paises i
            where a.cod_tca = b.cod_tca
            and a.cod_area = d.cod_area
            and a.cod_mdc = e.cod_mdc
            and a.cod_uni = f.cod_uni
            and a.cod_enti = g.cod_enti
            and a.cod_ciu = h.cod_ciu
            and a.cod_pai = i.cod_pai
            and a.tip_est = 'N'
            and a.cod_tca='$cod_tca'
            and a.cod_prc='$cod_prc'
            and a.cod_mdc='$cod_mdc'
            and a.cod_area='$cod_area'
            and a.cod_epl = '".$this->codigo."'
            ";
            $rs=$conn->Execute($sql);
        if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
                    $array[]=array("cod_ciu"=>$fila["COD_CIU"],
                                   "cod_pai"=>$fila["COD_PAI"],
                                   "cod_enti"=>$fila["COD_ENTI"],
                                   "entidad"=>$fila["NOM_ENTE"],
                                   "desc_tca"=>$fila["DESC_TCA"],
                                   "desc_prc"=>$fila["DESC_PRC"],
                                   "desc_area"=>$fila["DESC_AREA"],
                                   "desc_mdc"=>$fila["DESC_MDC"],
                                   "inicial"=>$fila["FEC_INI"],
                                   "final"=>$fila["FEC_FIN"],
                                   "tiempo"=>$fila["TIEMPO"],
                                   "nom_uni"=>$fila["NOM_UNI"],
                                   "nom_ciu"=>$fila["NOM_CIU"],
                                   "nom_pai"=>$fila["NOM_PAI"],
                                   "cod_uni"=>$fila["COD_UNI"],
                                   "cod_tca"=>$fila["COD_TCA"],
                                   "cod_prc"=>$fila["COD_PRC"],
                                   "cod_mdc"=>$fila["COD_MDC"],
                                   "cod_area"=>$fila["COD_AREA"],
                                   "codigo"=>$fila["COD_EPL"]
                                   );
                    
                }
        }else{
		$array=null;
	       }
        return $array;
    }
    
    public function insertar_no_formal($evento,$curso,$area,$modalidad,$inicial,$final,$tiempo,$unidad,$entidad,$ciudad,$pais){
        
         global $conn,$odbc;
        $respuesta = null;
        if($odbc == "odbc_mssql"){
            
              if($final == ""){
            $fecha_final="NULL";
            
              }elseif($inicial == ""){
                $fecha_inicial="NULL";
        }else{
            $fecha_final="(CONVERT(CHAR(19), '$final 00:00:00 a.m.',113)),";
            $fecha_inicial="(CONVERT(CHAR(19), '$inicial 00:00:00 a.m.',113)),";
        }
        $sql="insert into cap_fictec
              values ('".$this->codigo."','N',NULL,NULL,NULL,'$evento',
                      '$curso','$area','$modalidad',
                      $fecha_inicial
                      $fecha_final
                      '$tiempo','$unidad',
                      '$entidad','$ciudad','$pais',NULL)";
             
        }elseif($odbc == "oci8"){
            
                   if($final == ""){
            $fecha_final="NULL";
            
                   }elseif($inicial == ""){
                $fecha_inicial="NULL";
        }else{
            $fecha_final="(TO_DATE ('$final ', 'DD-MM-YY')),";
            $fecha_inicial="(TO_DATE ('$inicial ', 'DD-MM-YY')),";
        }
            $sql="insert into cap_fictec
              values ('".$this->codigo."','N',NULL,NULL,NULL,'$evento',
                      '$curso','$area','$modalidad',
                      $fecha_inicial
                      $fecha_final
                      '$tiempo','$unidad',
                      '$entidad','$ciudad','$pais',NULL)
             ";
        }
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
    }
    
     public function insertar_no_formal_tmp($evento,$curso,$area,$modalidad,$inicial,$final,$tiempo,$unidad,$entidad,$ciudad,$pais){
        
         global $conn,$odbc;
        $respuesta = null;
        if($odbc == "odbc_mssql"){
            
          if($inicial == "" && $final == ""){
                $fecha_inicial="NULL,";
                $fecha_final="NULL,";
            
                   }elseif($inicial == ""){
                    
                   $fecha_inicial="NULL,";
                   
                   }elseif($final == ""){
                
                $fecha_final="NULL,";
        }else{
            $fecha_final="(CONVERT(CHAR(19), '$final 00:00:00 a.m.',113)),";
            $fecha_inicial="(CONVERT(CHAR(19), '$inicial 00:00:00 a.m.',113)),";
        }
        $sql="insert into tmp_cap_fictec
              values ('".$this->codigo."','N',NULL,NULL,NULL,'$evento',
                      '$curso','$area','$modalidad',
                      $fecha_inicial
                      $fecha_final
                      '$tiempo','$unidad',
                      '$entidad','$ciudad','$pais',NULL)";
             
        }elseif($odbc == "oci8"){
            
                   if($inicial == "" && $final == ""){
                $fecha_inicial="NULL,";
                $fecha_final="NULL,";
            
                   }elseif($inicial == ""){
                    
                   $fecha_inicial="NULL,";
                   
                   }elseif($final == ""){
                
                $fecha_final="NULL,";
        }else{
            $fecha_final="(TO_DATE ('$final', 'DD-MM-YY')),";
            $fecha_inicial="(TO_DATE ('$inicial', 'DD-MM-YY')),";
        }
            $sql="insert into tmp_cap_fictec
              values ('".$this->codigo."','N',NULL,NULL,NULL,'$evento',
                      '$curso','$area','$modalidad',
                      $fecha_inicial
                      $fecha_final
                      '$tiempo','$unidad',
                      '$entidad','$ciudad','$pais',NULL)
             ";
        }
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
    }
    
    public function editar_no_formal($evento,$curso,$area,$modalidad,$inicial,$final,$tiempo,$unidad,$entidad,$ciudad,$pais){
        
          global $conn,$odbc;
        $respuesta=null;
        
        if($odbc == "odbc_mssql"){
            
            if($final == ""){
            $fecha_final="";
            
            }elseif($inicial == ""){
                $fecha_inicial="";
            }elseif($inicial == "" || $final == ""){
                $fecha_inicial="";
                $fecha_final="";
        }else{
            $fecha_final="fec_fin =CONVERT(CHAR(19), '$final 00:00:00 a.m.',113),";
            $fecha_inicial="fec_fin =CONVERT(CHAR(19), '$inicial 00:00:00 a.m.',113),";
        }
        $sql="UPDATE cap_fictec
                SET tiempo = '$tiempo',
                cod_area = '$area',
                cod_mdc = '$modalidad',
                cod_uni = '$unidad',
                cod_enti= '$entidad',
                cod_ciu = '$ciudad',
                
                $fecha_inicial
                $fecha_final
                cod_pai = '$pais'
                WHERE cod_epl = '".$this->codigo."'
                AND tip_est = 'N'
                AND cod_tca = '$evento'
                AND cod_prc = '$curso'
            ";
        }elseif($odbc == "oci8"){
            
              if($final == ""){
            $fecha_final="";
            
            }elseif($inicial == ""){
                $fecha_inicial="";
            }elseif($inicial == "" || $final == ""){
                $fecha_inicial="";
                $fecha_final="";
        }else{
            $fecha_final="fec_fin = TO_DATE ('$final ', 'DD-MM-YY'),";
            $fecha_inicial="fec_fin = TO_DATE ('$inicial', 'DD-MM-YY'),";
        }
             $sql="UPDATE cap_fictec
                SET tiempo = '$tiempo',
                cod_area = '$area',
                cod_mdc = '$modalidad',
                cod_uni = '$unidad',
                cod_enti= '$entidad',
                cod_ciu = '$ciudad',
                
                $fecha_inicial
                $fecha_final
                cod_pai = '$pais'
                WHERE cod_epl = '".$this->codigo."' AND
                tip_est = 'N' AND
                cod_tca = '$evento' AND
                cod_prc = '$curso'
            ";
        }
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
        
    }
    public function editar_no_formal_tmp($evento,$curso,$area,$modalidad,$inicial,$final,$tiempo,$unidad,$entidad,$ciudad,$pais){
        
          global $conn,$odbc;
        $respuesta=null;
        
        if($odbc == "odbc_mssql"){
            
            if($final == ""){
            $fecha_final="";
            
            }elseif($inicial == ""){
                $fecha_inicial="";
        }else{
            $fecha_final="fec_fin =CONVERT(CHAR(19), '$final 00:00:00 a.m.',113),";
            $fecha_inicial="fec_ini =CONVERT(CHAR(19), '$inicial 00:00:00 a.m.',113),";
        }
        $sql="UPDATE tmp_cap_fictec
                SET tiempo = '$tiempo',
                cod_area = '$area',
                cod_mdc = '$modalidad',
                cod_uni = '$unidad' ,
                cod_enti= '$entidad',
                cod_ciu = '$ciudad',
                $fecha_inicial
                $fecha_final
                cod_pai = '$pais'
                WHERE cod_epl = '".$this->codigo."' AND
                tip_est = 'N' AND
                cod_tca = '$evento' AND
                cod_prc = '$curso'
            ";
        }elseif($odbc == "oci8"){
            
            if($final == ""){
            $fecha_final="";
            
            }elseif($inicial == ""){
                $fecha_inicial="";
        }else{
            $fecha_final="fec_fin = TO_DATE ('$final ', 'DD-MM-YY'),";
            $fecha_inicial="fec_ini = TO_DATE ('$inicial', 'DD-MM-YY'),";
        }
             $sql="UPDATE tmp_cap_fictec
                SET tiempo = '$tiempo',
                cod_area = '$area',
                cod_mdc = '$modalidad',
                cod_uni = '$unidad',
                cod_enti= '$entidad',
                cod_ciu = '$ciudad',
                $fecha_inicial
                $fecha_final
                cod_pai = '$pais'
                WHERE cod_epl = '".$this->codigo."' AND
                tip_est = 'N' AND
                cod_tca = '$evento' AND
                cod_prc = '$curso'
            ";
        }
        $rs=$conn->Execute($sql);
        if($rs){
            $respuesta = true;
        }else{
            $respuesta = false;
        }
        
        return $respuesta;
        
    }
    
    public function mostrar_no_formal_jefe($jefe){
         global $conn;
        $sql="select emp.cod_epl as COD_EPL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,gral.email as EMAIL,
            gral2.cod_tca as COD_TCA,gral2.cod_prc as COD_PRC,
            gral2.cod_mdc as COD_MDC,gral2.cod_area as COD_AREA
            
            from empleados_basic emp, cargos car, centrocosto2 cen , empleados_gral gral,tmp_cap_fictec gral2
            
            where
            emp.cod_car=car.cod_car
            and emp.cod_epl=gral.cod_epl 
            and gral2.cod_epl=gral.cod_epl
            and emp.cod_cc2=cen.cod_cc2
            and gral2.tip_est='N'
            and gral.cod_jefe='$jefe'
        ";
         $rs=$conn->Execute($sql);
        if($rs){//valido si $rs contiene datos
	        while($fila=@$rs->FetchRow()){
                    $array[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "email"=>$fila["EMAIL"],
                                      "cod_tca"=>$fila["COD_TCA"],
                                      "cod_prc"=>$fila["COD_PRC"],
                                      "cod_mdc"=>$fila["COD_MDC"],
                                      "cod_area"=>$fila["COD_AREA"]);
                    
                }
        }else{
		$array=null;
	       }
        return $array;
    }
    
    /*ELIMINAR SOLICITUDES DE EDITAR PERFIL*/
    
    public function eliminar_no_formal($evento,$curso,$modalidad,$area,$cod_epl){
        
        global $conn;
        $respuesta = null;
        
        $sql="DELETE FROM  tmp_cap_fictec
               where cod_epl='$cod_epl'
               and tip_est='N'
               and cod_tca='$evento'
               and cod_prc='$curso'
               and cod_area='$area'
               and cod_mdc='$modalidad' 
            ";
        
        $rs=$conn->Execute($sql);
        
        
        if($rs){
            
            $respuesta = true;
        }else{
            
            $respuesta = false;
        }
        
        return $respuesta;
        
    }
    
    public function eliminar_formal($titulo,$estudio,$cod_epl){
        
        global $conn;
        $respuesta = null;
        
        $sql="DELETE FROM  tmp_cap_fictec
               where cod_epl='$cod_epl'
               and tip_est='F'
               and cod_clp='$estudio'
               and cod_ttp='$titulo'
            ";
        
        $rs=$conn->Execute($sql);
        
        
        if($rs){
            
            $respuesta = true;
        }else{
            
            $respuesta = false;
        }
        
        return $respuesta;
        
    }
    public function eliminar_familiar($cedula,$cod_epl){
        
        global $conn;
        $respuesta = null;
        
        $sql="DELETE FROM  tmp_parientes
               where cod_epl='$cod_epl'
               and cedula='$cedula'
            ";
        
        $rs=$conn->Execute($sql);
        
        
        if($rs){
            
            $respuesta = true;
        }else{
            
            $respuesta = false;
        }
        
        return $respuesta;
        
    }
    
    public function eliminar_datos($cod_epl){
        
        global $conn;
        $respuesta = null;
        
        $sql="DELETE FROM  tmp_empleados_gral
               where cod_epl='$cod_epl'
            ";
        
        $rs=$conn->Execute($sql);
        
        
        if($rs){
            
            $respuesta = true;
        }else{
            
            $respuesta = false;
        }
        
        return $respuesta;
        
    }
    
}
?>