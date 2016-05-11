<?php
        include_once("class_horasextrasepl.php");
        include_once("class_mailer.php");
		
include_once('../lib/configdbt.php');
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');



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

if(isset($rowt['CONTEO'])){
$conn = $configt;

$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 3";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();
$empresamail='TGT';
$empresa_real = $row58['EMPRESA'];
}
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
         
         $qry="select COD_JEFE AS COD_JEFE from empleados_gral where cod_epl = '$cod_epl'";
         $rowj=$conn->Execute($qry);
         $not=$rowj->FetchRow();
         $cod_jefe=$not['COD_JEFE'];
         
         if($validar == true){/*True se insertaron los datos*/
           
                for($i=0;$i<count($empleados); $i++){
                 $asuntonue = 'Horas extras Teléfonica - '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' - Aceptado por Jefe';
                   $contenido='
                   <span style="font-size: 14px; ">Se&ntilde;or(a) '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' tus '.$dias.' Horas Extras del dia '.date("d/m/Y",strtotime($empleados[$i]["inicial"])).' han sido aprobadas por tu lider.</span></p>
                    
                    <p style="text-align: left; ">
                    <br>
                      <span style="font-size:14px;">'.$empresa_real.' sigue construyendo el mejor lugar para trabajar enmarcando en una cultura que nos ilusiona y apasiona.</span></p>
                   <p style="text-align: left; ">
                    <br>
                    <span style="font-size:14px;"><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. <br><br> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. <br>&nbsp;<br></span></p>
                   <p>&nbsp;
                   </p>
                   ';
				   
				   ////////////// Mensaje para el gerente
				   
				  
				   
				   //////////////////////// Consulta para el correo del gerente
				   
							 //validacion bd f
							$consultaf = "select COD_JEFE AS COD_GERENTE from empleados_gral where cod_epl='".$cod_jefe."'";
							$rs = $configf->Execute($consultaf);
							$rowf = $rs->fetchrow();

							//validacion bd c
							$consultac =  "select COD_JEFE AS COD_GERENTE from empleados_gral where cod_epl='".$cod_jefe."'";
							$rs = $configc->Execute($consultac);
							$rowc = $rs->fetchrow();

							//validacion bd 
							$consulta =  "select COD_JEFE AS COD_GERENTE from empleados_gral where cod_epl='".$cod_jefe."'";
							$rs = $config->Execute($consulta);
							$rowa = $rs->fetchrow();

							//validacion bd 
							$consultat =  "select COD_JEFE AS COD_GERENTE from empleados_gral where cod_epl='".$cod_jefe."'";
							$rs = $configt->Execute($consultat);
							$rowt = $rs->fetchrow();

							if(isset($rowf['COD_GERENTE'])){
							$conn = $configf;
							$COD_GERENTE=$rowf["COD_GERENTE"];
							}
							if(isset($rowc['COD_GERENTE'])){
							$conn = $configc;
							$COD_GERENTE=$rowc["COD_GERENTE"];
							}
							if(isset($rowa['COD_GERENTE'])){
							$conn = $config;
							$COD_GERENTE=$rowa["COD_GERENTE"];
							}
							if(isset($rowt['COD_GERENTE'])){
							$conn = $configt;
							$COD_GERENTE=$rowt["COD_GERENTE"];
							}
							
							$consultager =  "select USU_RED as USU_RED from jefes WHERE COD_JEFE = '$COD_GERENTE'";
							$rs = $conn->Execute($consultager);
							$rowger = $rs->fetchrow();
							$correogerente=$rowger["USU_RED"];
							
							//Query para la generacion de la IP dinamica

								$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
								  
								$rh06 = $conn->Execute($qry06); 
								$row06 = $rh06->FetchRow();

								$ipvariable=$row06["IP"];							
							
							 $contenidoger='<br>Se solicita el pago de horas extras para el empleado '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].', Para ver las solicitudes de tus colaboradores ingresa <a href="https://'.$ipvariable.'/vacaciones/php/prueba.php?us=q1e5d69e&pa=g86r5h5f" style="color: #770003">aquí</a><br><br> Muchas Gracias por utilizar este servicio. <br><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo.<br><br><strong> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. </strong><br>&nbsp;<br>';
                }
                
                 echo "has aceptado esta solicitud correctamente.";
         
           }else{/*False error al insertar los datos*/
            echo "Error al aceptar esta solicitud.";
           }
        }elseif($_POST["accion"] == "rechazar"){/*Cuando se rechaza las vacaciones*/
		 @$dias=$_POST["dias"];
		$asuntonue = 'Horas extras Teléfonica - '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' - Rechazado por Líder';
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
                 <span style="font-size: 14px; ">Se&ntilde;or(a) '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' tu solicitud de '.@$dias.' horas extras registradas del dia '.date("d/m/Y",strtotime($empleados[$i]["inicial"])).',  ha sido rechazada, ponte en contacto con tu lider para conocer el procedimiento a seguir.  Observacion de rechazo: '.$administrador->observacion_rechazo().'.</span>
                 
                 <p style="text-align: left; ">
                    <br>
                      <span style="font-size:14px;">'.$empresa_real.' sigue construyendo el mejor lugar para trabajar enmarcando en una cultura que nos ilusiona y apasiona.</span></p>
                   <p style="text-align: left; ">
                    <br>
                    <span style="font-size:14px;"><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. <br><br> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. <br>&nbsp;<br></span></p>
                   <p>&nbsp;
                   </p>';
				   
				   ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$empleados[$i]["cedula"]."','".$empleados[$i]["nombre"]."','".$empleados[$i]["apellido"]."',SYSDATE,'Vacaciones','".$email."','".$empresamail."')";
$conn->Execute($sqlmail);
                }
				
				$envicorreo='si';
            
        }else{/*False error al insertar los datos*/
             echo "Error al rechazar esta solicitud.";
        }
        }
		
		if(isset($envicorreo)){
           //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email
         
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = $asuntonue; // Este es el titulo del email.
           
         $content= $administrador->mensaje_solicitud($contenido,$titulo);
         $mail->Body = $content; // Mensaje a enviar
         $exito = $mail->Send(); // Envía el correo.
		 
		 
		 }
		 //-----FIN EMAIL EMPLEADO-----
		  /*
		  //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($correogerente); // Esta es la dirección a donde enviamos $email
         
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = $asuntonue; // Este es el titulo del email.
         $contentger= $administrador->mensaje_solicitud($contenidoger,$titulo);
         $mail->Body = $contentger; // Mensaje a enviar
         $exito = $mail->Send(); // Envía el correo.
		 //-----FIN EMAIL GERENTE-----
*/
    ?>