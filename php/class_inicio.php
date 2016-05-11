<?php
require_once '../lib/configdb.php';
class inicio{
	private $codigo= null;
	private $array=null;
	
	function set_codigo($codigo){
		$this->codigo=$codigo;
	}
	
	private function get_codigo(){
		return $this->codigo;
	}
	
	function afilicaciones(){
		global $conn,$odbc;
		
		
			$sql="select c.nom_con AS NOM_CON,b.nombre AS NOMBRE, a.fec_ing AS FECHA_VINCULACION
			from epl_fondos a,fondos b, conceptos c
			where a.cod_fon=b.cod_fon and 
				a.cod_con=c.cod_con and 
				a.cod_epl='".$this->codigo."' order by a.fec_ing desc";
		
		
		$this->array=array();
		$rs=$conn->Execute($sql);
		
		while($fila=@$rs->FetchRow()){
			
			if($fila["FECHA_VINCULACION"] == null){
				$fecha="";	
			}else{
				$fecha=date("d-m-Y",strtotime($fila["FECHA_VINCULACION"]));
			}
			
			$this->array[]=array("concepto"=>$fila["NOM_CON"],
								 "banco"=>$fila["NOMBRE"],
								 "fecha"=>$fecha);
		}
		
		return $this->array;
		
		
	}
	
	function aportes_voluntarios(){
		global $conn;
		$sql="select con.nom_con as CONCEPTO,fon.nombre AS NOMBRE,a.por_adi AS VALOR
				from epl_fondos a,conceptos con, fondos fon
				where a.cod_con=con.cod_con and a.cod_fon=fon.cod_fon 
				and a.cod_con in('2038','2043')
				and a.cod_epl='".$this->codigo."'";
				
		$this->array=array();
		$rs=$conn->Execute($sql);
		while($fila=$rs->FetchRow()){
			$this->array[]=array("concepto"=>$fila["CONCEPTO"],
								 "nombre"=>$fila["NOMBRE"],
								 "valor"=>$fila["VALOR"]);
		}
		return $this->array;
	}
	
	function deducciones(){
		
		global $conn;
		$sql="select tipo as TIPO,valor as VALOR,fecha as FECHA
				from certificados 
				where cod_epl='".$this->codigo."' and  tipo in ('V','S','O') order by fecha desc";
		
		$this->array=array();
		$rs=$conn->Execute($sql);
		while($fila=$rs->FetchRow()){
			
			if($fila["TIPO"] == "V"){
				$tipo="Por Interes de Vivienda";
			}elseif($fila["TIPO"] == "S"){
				$tipo="Por Salud Prepagada";
			}else{
				$tipo="Dependientes";
			}
			$this->array[]=array("tipo"=>$tipo,
								 "valor"=>$fila["VALOR"],
								 "fehca"=>$fila["FECHA"]);
		}
		return $this->array;
	}
	
	function cuenta_nomina(){
		global $conn;
		$sql="select a.num_cta as NUM_CTA, c.nom_ban AS NOM_BAN,a.tip_cta AS TIP_CTA
			from epl_consigna a, bancos c  
			where	a.cod_ban=c.cod_ban 
				and a.cod_epl = '".$this->codigo."' 
				and a.estado='A'";
		
		$this->array=array();
		$rs=$conn->Execute($sql);
		while($fila=$rs->FetchRow()){
			if($fila["TIP_CTA"] == "1"){
				$tipo='Corriente';
			}else{
				$tipo='Ahorros';
			}
			$this->array[]=array("cuenta"=>$fila["NUM_CTA"],
								 "banco"=>$fila["NOM_BAN"],
								 "tipo"=>$tipo);
		}
		return $this->array;
	}
	
	
	function cronograma_nomina(){
          
          global $conn;
          $sql="SELECT * from cierre_pagos";
	  $rs=$conn->Execute($sql);
	  
	  	while($fila=$rs->FetchRow()){
                  
                        date_default_timezone_set("America/Bogota");

		        $dia=strtotime($fila['DIA']."-".$fila['MES']."-".$fila['ANO']);
			$fecha_cierre=$fila['CIERRE_NOMINA'];
			$fecha_cierre=explode("-",$fecha_cierre);
			$nomina_dia_cierre=$this->dias(strtotime($fila['CIERRE_NOMINA']));

                        $nomina_dia=$fecha_cierre[0];
			$nomina_mes=$this->mes(strtotime($fila['CIERRE_NOMINA']));
			$this->array[]=array(
                             'mes'=>$fila['MES'],
                             'dia_cierre'=>$nomina_dia_cierre,
                             'cierre'=>$nomina_dia,
                             'dia'=>$this->dias($dia),
                             'pago'=>$fila['DIA'],

                        );
		}
		return $this->array;
	  



        
        
        }
        
        public function dias($dia){


            $comprobar=date('w',$dia);


            switch($comprobar):
            
            case 0:
                 $return='Domingo';
                 break;
            case 1:
                  $return='Lunes';
                break;
            case 2:
                  $return='Martes';
                break;
            case 3:
                 $return='Miercoles';
               break;
            case 4:
                 $return='Jueves';
                break;
            case 5:
                 $return='Viernes';
               break;
            case 6:
                  $return='Sabado';
             break;
            endswitch;
            
            return $return;

        }
        
        public function mes($mes){
          
          $mes=date('n',$mes);
          
          switch($mes):

            case 1:
                  $return='Enero';
                break;
            case 2:
                  $return='Febrero';
                break;
            case 3:
                 $return='Marzo';
               break;
            case 4:
                 $return='Abril';
                break;
            case 5:
                 $return='Mayo';
               break;
            case 6:
                  $return='Junio';
                 break;
           case 7:
                  $return='Julio';
                break;
           case 8:
                  $return='Agosto';
                break;
          case 9:
                  $return='Septiembre';
                break;
          case 10:
                  $return='Octubre';
               break;
          case 11:
                  $return='Noviembre';
               break;
          case 12:
                  $return='Diciembre';
              break;
         endswitch;

             return $return;
          



        }
}
?>