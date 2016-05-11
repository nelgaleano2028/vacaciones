<?php
require_once '../lib/connection.php';

class perfil_admin{
    
    private $sql=null;
    private $usuario=null;
    private $pass=null;
     private $cod_epl=null;
    private $lista=null;
   
    
    /*Metodos set*/
    
    /*
     *@method set_usuario indicamos el nuevo usuario
     */
    public function set_usuario($usuario){
        $this->usuario=$usuario;
    }
    /*
     *@method set_pass indicamos la nueva contraseña
     */
     public function set_pass($pass){
        $this->pass=$pass;
    }
      /*
     *@method set_cod_epl indicamos el codigo del empleado
     */
     public function set_cod_epl($cod_epl){
        $this->cod_epl=$cod_epl;
    }
    /*Metodos get*/
    
    /*
     *@method get_usuario retorna el usuario
    */
      private function get_usuario(){
         return $this->usuario;
    }
     /*
     *@method get_pass retorna la contraseña
    */
     private function get_pass($pass){
         return $this->pass;
    }
        /*
     *@method get_cod_epl retorna el cod_epl
    */
     private function get_cod_epl(){
         return $this->cod_epl;
    }
    
    private function comprobar_nombre_usuario_expresiones_regulares($nombre_usuario){ 
      if (!ereg("^[a-zA-Z0-9\-_]{3,20}$", $nombre_usuario)) { 
      
      return false; 
      }else{ 
      
      return $nombre_usuario; 
      }
       
    } 
    
    public function new_admin(){
        try{
            global $conn;
            $usuarios=$this->comprobar_nombre_usuario_expresiones_regulares($this->usuario);
            
            if($usuarios == false){
                
                $res=false;
            }else{
            
                   
            $existe="Select nom_admin as NOM_ADMIN from t_admin where nom_admin='".$this->usuario."'";
            $ver=$conn->Execute($existe);
               $fila=@$ver->FetchRow();
               
             if($fila["NOM_ADMIN"] == $this->usuario){
                $res="El usuario ya existe.";
            }elseif($fila["NOM_ADMIN"] != $this->usuario){
            $this->sql="insert into t_admin values('".$this->usuario."','".$this->pass."','1','".$this->cod_epl."')";
            $rs=$conn->Execute($this->sql);
            if($rs){
                $res = true;
            }
            else{
                $res = false;
            }
            }
            }
        }catch(exception $e){
            
            echo "Error: ".$e;
        }
        return $res;
    }
    
      function mostrar_admins(){
	
              try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
            $sql="select emp.cod_epl as COD_EPL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,t_admin.nom_admin as NOM_ADMIN
            
            from empleados_basic emp, cargos car, centrocosto2 cen ,t_admin
            
            where
            
            t_admin.cod_epl=emp.cod_epl and
            emp.cod_car=car.cod_car
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
            and
            t_admin.privilegio='1' order by nom_admin";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("usuario"=>utf8_encode($fila["NOM_ADMIN"]),
                                      "codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      
                                      
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
    
    function eliminar($id){
		try{
                       //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
         $sql="DELETE FROM t_admin WHERE nom_admin ='".$id."'";
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
         if($rs){
            $res=true;
         }else{
            $res=false;
         }
			
		}catch(Exception $e){
                    
                }
                return $res;
	}
        

}


?>
    
