<?php
        include_once("class_vacacionesepl.php");
        include_once("class_mailer.php");
		
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');


$codiepl = $_POST["cod_epl"];


   //validacion bd f
$consultaf = "select cod_epl AS CONTEO, cedula as CEDULA, nom_epl as NOMBRE, ape_epl as APELLIDO, estado from empleados_basic WHERE cod_epl = '$codiepl' and estado = 'A'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, cedula as CEDULA, nom_epl as NOMBRE, ape_epl as APELLIDO, estado from empleados_basic WHERE cod_epl = '$codiepl' and estado = 'A'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, cedula as CEDULA, nom_epl as NOMBRE, ape_epl as APELLIDO, estado from empleados_basic WHERE cod_epl = '$codiepl' and estado = 'A'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd 
$consultat =  "select cod_epl AS CONTEO, cedula as CEDULA, nom_epl as NOMBRE, ape_epl as APELLIDO, estado from empleados_basic WHERE cod_epl = '$codiepl' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
$empresamail='FUNDACION';
$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();

$empresa_real = $row58['EMPRESA'];
        $cedula=$rowf["CEDULA"];  
        $nom_emp=$rowf["NOMBRE"];  
        $ape_emp=$rowf["APELLIDO"]; 
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
$empresamail='CONFIDENCIAL';
$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();

$empresa_real = $row58['EMPRESA'];
		$cedula=$rowc["CEDULA"];  
        $nom_emp=$rowc["NOMBRE"];  
        $ape_emp=$rowc["APELLIDO"]; 
}
if(isset($rowa['CONTEO'])){
$conn = $config;
$empresamail='TELMOVIL';
$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();

$empresa_real = $row58['EMPRESA'];
		$cedula=$rowa["CEDULA"];  
        $nom_emp=$rowa["NOMBRE"];  
        $ape_emp=$rowa["APELLIDO"]; 
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
$empresamail='TGT';
$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 3";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();

$empresa_real = $row58['EMPRESA'];
		$cedula=$rowt["CEDULA"];  
        $nom_emp=$rowt["NOMBRE"];  
        $ape_emp=$rowt["APELLIDO"]; 
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
        $titulo='Vive la experiencia de programar y disfrutar tus vacaciones';
        
        
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
         
         
         
         if($validar == true){/*True se insertaron los datos*/
           
                for($i=0;$i<count($empleados); $i++){
                 $asuntonue = 'Vacaciones Teléfonica - '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' - Aceptado por Líder';
                   $contenido='
                   <span style="font-size: 14px; ">Se&ntilde;or(a) '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' tus vacaciones han sido aprobadas e inician a partir del '.date("d/m/Y",strtotime($empleados[$i]["inicial"])).' hasta el '.date("d/m/Y",strtotime($empleados[$i]["final"])).', en donde disfrutar&aacute;s de '.$dias.' d&iacute;as h&aacute;biles a tu solicitud. Recuerda que tu fecha de reintegro es el siguiente d&iacute;a h&aacute;bil despues de finalizado el periodo aqu&iacute; mencionado.</span></p>
                    
                    <p style="text-align: left; ">
                    <br>
                      <span style="font-size:14px;">'.$empresa_real.' sigue construyendo el mejor lugar para trabajar enmarcando en una cultura que nos ilusiona y apasiona.</span></p>
                   <p style="text-align: left; ">
                    <br>
                    <span style="font-size:14px;">Gracias por hacer parte de '.$empresa_real.' y disfruta de tus vacaciones.<br><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. Si tienes alguna duda u observacion crea tu llamada a la Mesa Centro de Servicios Compartidos haciendo <a href="http://intranet/MesasAyuda/Control.aspx?idSer=SERVICIOS DE NOMINA&idSSer=VACACIONES&pt=NOVEDADES VACACIONES&id=2" style="color: #770003">clic aquí</a>. <br><br> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. <br>&nbsp;<br></span></p>
                   <p>&nbsp;
                   </p>
                   <p>Para ver tus solicitudes ingresa <a href="https://'.$ipvariable.'/vacaciones/php/main.php?valor=1">aquí</a>.
                   </p>';
                }
                
                 echo "Se acepto esta solicitud correctamente.";
         
           }else{/*False error al insertar los datos*/
            echo "Error al aceptar esta solicitud.";
           }
        }elseif($_POST["accion"] == "rechazar"){/*Cuando se rechaza las vacaciones*/
		 @$dias=$_POST["dias"];
		$asuntonue = 'Vacaciones Teléfonica - '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' - Rechazado por Líder';
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
                 <span style="font-size: 14px; ">Se&ntilde;or(a) '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' tu solicitud de vacaciones que tenias programadas del  '.date("d/m/Y",strtotime($empleados[$i]["inicial"])).' al '.date("d/m/Y",strtotime($empleados[$i]["final"])).', '.@$dias.' días hábiles,  ha sido rechazada, ponte en contacto con tu lider para conocer el procedimiento a seguir.  Comentario de rechazo: '.$administrador->observacion_rechazo().'.</span>
                 
                 <p style="text-align: left; ">
				                  <br>
				 En '.$empresa_real.' vivimos la mejor experiencia para construir el mejor lugar para trabajar en Colombia.

Para ver tus solicitudes ingresa <a href="https://'.$ipvariable.'/vacaciones/php/main.php?valor=1">aquí</a>.
                 </p>
                 <br>
                 <span style="font-size:14px;"> <br><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. Si tienes alguna duda u observacion crea tu llamada a la Mesa Centro de Servicios Compartidos haciendo <a href="http://intranet/MesasAyuda/Control.aspx?idSer=SERVICIOS DE NOMINA&idSSer=VACACIONES&pt=NOVEDADES VACACIONES&id=2" style="color: #770003">clic aquí</a>.<br><br> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. <br>&nbsp;<br></span></p>
                 <p style="text-align: left; ">

                 <p>&nbsp;
                 </p>
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
           //-----FIN EMAIL-----
         $content= $administrador->mensaje_solicitud($contenido,$titulo);
         $mail->Body = $content; // Mensaje a enviar
         $exito = $mail->Send(); // Envía el correo.

		 ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$cedula."','".$nom_emp."','".$ape_emp."',SYSDATE,'Vacaciones','".$email."','".$empresamail."')";
$conn->Execute($sqlmail);
		 
    ?>