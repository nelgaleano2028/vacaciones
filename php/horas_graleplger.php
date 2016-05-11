<?php
        include_once("class_horasextrasgere.php");
        include_once("class_mailer.php");
		
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');


$codiepl = $_POST["cod_epl"];


   //validacion bd f
$consultaf =  "select cod_epl AS CONTEO from EMPLEADOS_BASIC WHERE estado ='A' and cod_epl = '$codiepl'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO from EMPLEADOS_BASIC WHERE estado ='A' and cod_epl = '$codiepl'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO from EMPLEADOS_BASIC WHERE estado ='A' and cod_epl = '$codiepl'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd 
$consultat =  "select cod_epl AS CONTEO from EMPLEADOS_BASIC WHERE estado ='A' and cod_epl = '$codiepl'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;

$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();
$empresamail='FUNDACION';
$empresa_real = $row58['EMPRESA'];
}
if(isset($rowc['CONTEO'])){
$conn = $configc;

$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();
$empresamail='CONFIDENCIAL';
$empresa_real = $row58['EMPRESA'];
}
if(isset($rowa['CONTEO'])){
$conn = $config;

$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();
$empresamail='TELMOVIL';
$empresa_real = $row58['EMPRESA'];
}
if(isset($rowt['CONTEO'])){
$conn = $configt;

$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 3";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();
$empresamail='TGT';
$empresa_real = $row58['EMPRESA'];
}
//------------------------------FIN antidoto


//Query para la generacion de la IP dinamica

	$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	  
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();

	$ipvariable=$row06["IP"];


        $administrador=new vacaciones();
        $mail= new mailer();
        
        
        
        $consecutivo=$_POST["consecutivo"];
        $encargado=$_POST["encargado"];
        $cod_epl=$_POST["cod_epl"];  //codigo del empleado
        $administrador->set_consecutivo($consecutivo);
        $administrador->set_encargado($encargado);
        $administrador->set_cod_epl($cod_epl);
        $email=$administrador->email_empleado();
        
      
        
        //Variables para generar el reporte de vacaciones
        $titulo='Informacion importante de tus horas extras';
        
        
        $empleados=$administrador->vacaciones_email();
        $empresa="SELECT emp.nom_emp AS NOM_EMP,emp.email AS EMAIL
          FROM empresas emp
          WHERE emp.cod_emp=1";
         $row=$conn->Execute($empresa);
         $emp=$row->FetchRow();
        
        
        
        /*Cuando se aprueban las vacaciones*/
        if($_POST["accion"] == "aprobar"){
            
         $area=$_POST["cod_cc2"];
         $ausencia=$_POST["cod_aus"];
         $concepto=$_POST["cod_con"];
         $inicial=$_POST["fec_ini"];
         $final=$_POST["fec_fin"];
         $dias=$_POST["dias"];
         
         $administrador->set_area($area);
         $administrador->set_cod_ausencia($ausencia);
         $administrador->set_concepto($concepto);
         $administrador->set_dias($dias);
         $administrador->set_final($final);
         $administrador->set_inicial($inicial);
         $validar=$administrador->aceptar_vacaciones();
         
         $qry="select a.cod_jefe as COD_JEFE, b.cedula as CEDULA, b.nom_epl as NOM_EPL, b.ape_epl as APE_EPL, a.email as EMAIL from empleados_gral a, empleados_basic b where a.cod_epl= '$cod_epl' and a.cod_epl=b.cod_epl";	
         $rowj=$conn->Execute($qry);
         $not=$rowj->FetchRow();
         $cod_jefe=$not['COD_JEFE'];
		 
$nombre=$not["NOM_EPL"];
$apellido=$not["APE_EPL"];
$email_epl=$not["EMAIL"];
$cedula_epl=$not["CEDULA"];
         
         if($validar == true){/*True se insertaron los datos*/
           
                for($i=0;$i<count($empleados); $i++){
                 $asuntonue = 'Horas extras Teléfonica - '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' - Aceptado por Gerente';
                   $contenido='
                   <span style="font-size: 14px; ">Se&ntilde;or(a) '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' tus Horas Extras han sido aprobadas por Gerencia.</span></p>
                    
                    <p style="text-align: left; ">
                    <br>
                      <span style="font-size:14px;">'.$empresa_real.' sigue construyendo el mejor lugar para trabajar enmarcando en una cultura que nos ilusiona y apasiona.</span></p>
                   <p style="text-align: left; ">
                    <br>
                    <span style="font-size:14px;"><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. <br><br> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. <br>&nbsp;<br></span></p>
                   <p>&nbsp;
                   </p>
                   ';
				   
				   
                }
                
                 echo "Se acepto esta solicitud correctamente.";
         
           }else{/*False error al insertar los datos*/
            echo "Error al aceptar esta solicitud.";
           }
        }elseif($_POST["accion"] == "rechazar"){/*Cuando se rechaza las vacaciones*/
		 @$dias=$_POST["dias"];
		$asuntonue = 'Horas extras Teléfonica - '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' - Rechazado por Gerente';
                $consecutivo=$_POST["consecutivo"];
            $administrador->set_consecutivo($consecutivo);
            $observacion=utf8_decode($_POST["obse"]);
             $administrador->set_observacion($observacion);
            $validar=$administrador->cambia_estado_cance();
            if($validar == true){/*True se insertaron los datos*/
            echo "Ha rechazado esta solicitud.";
			
            $qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	  
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();

	$ipvariable=$row06["IP"];
            
            for($i=0;$i<count($empleados); $i++){
             $contenido='
                 <span style="font-size: 14px; ">Se&ntilde;or(a) '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' tu solicitud de horas extras registradas, han sido rechazadas por Gerencia, ponte en contacto con tu Jefe para conocer el procedimiento a seguir. Observacion de rechazo: '.$observacion.'.</span>
                 
                 <p style="text-align: left; ">
                    <br>
                      <span style="font-size:14px;">'.$empresa_real.' sigue construyendo el mejor lugar para trabajar enmarcando en una cultura que nos ilusiona y apasiona.</span></p>
                   <p style="text-align: left; ">
                    <br>
                    <span style="font-size:14px;"><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. <br><br> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. <br>&nbsp;<br></span></p>
                   <p>&nbsp;
                   </p>';
                }
            
        }else{/*False error al insertar los datos*/
             echo "Error al rechazar esta solicitud.";
        }
        }
		
           //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email
         
        
         
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = $asuntonue; // Este es el titulo del email.
           
         $content= $administrador->mensaje_solicitud($contenido,$titulo);
         $mail->Body = $content; // Mensaje a enviar
         $exito = $mail->Send(); // Envía el correo.
		 //-----FIN EMAIL EMPLEADO-----
		 
		 ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$cedula_epl."','".$nombre."','".$apellido."',SYSDATE,'Trabajo por turnos','".$email."','".$empresamail."')";
$conn->Execute($sqlmail);

    ?>