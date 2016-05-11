<?php
        include_once("class_vacaciones.php");
        include_once("class_mailer.php");
        
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
        if(isset($_POST['submit'])){
            if(!empty($_POST['check_list'])){
			foreach($_POST['check_list'] as $selected){
			$porciones = explode(",", $selected);
$sql="update ausencias_tmp set estado='C', cod_encardo='', RESPUESTA_POR = '',  OBSERVACION = '' where cnsctvo='".$porciones[1]."' and cod_epl ='".$porciones[0]."'";
$rs=$conn->Execute($sql);
			
			
			$consecutivo=$porciones[1];
        $encargado='';
        $cod_epl=$porciones[0];  //codigo del empleado
        $administrador->set_consecutivo($consecutivo);
        $administrador->set_encargado($encargado);
        $administrador->set_cod_epl($cod_epl);
        $email=$administrador->email_empleado();
		
		$empleados=$administrador->vacaciones_email();
			
         $area=$porciones[2];
         $ausencia=$porciones[3];
         $concepto=$porciones[4];
         $inicial=$porciones[6];
         $final=$porciones[7];
         $dias=$porciones[5];
         /*
         $administrador->set_area($area);
         $administrador->set_cod_ausencia($ausencia);
         $administrador->set_concepto($concepto);
         $administrador->set_dias($dias);
         $administrador->set_final($final);
         $administrador->set_inicial($inicial);
        // $validar=$administrador->aceptar_vacaciones();
         */
         //Query para la generacion de la IP dinamica

	$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	  
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();

	$ipvariable=$row06["IP"];
	

	 $sql="--SQL PARA RESPONDER SOLICITUD VIA EMAIL--
                     select au.cod_epl AS COD_EPL, epl.nom_epl as NOM_EPL,epl.ape_epl AS APE_EPL, epl.cedula as CEDULA,
                     au.fec_ini AS FEC_INI,au.fec_fin AS FEC_FIN,
                     au.dias AS DIAS,au.observacion AS OBSERVACIONES,au.cnsctvo as CONSECUTIVO
                     from empleados_basic epl, ausencias_tmp au  
                     where epl.cod_epl=au.cod_epl and au.COD_EPL = '".$porciones[0]."' and au.cnsctvo='".$porciones[1]."'";
                $rs=$conn->Execute($sql);
                $fila=$rs->FetchRow();
                   
	
	
                 $asuntonue = 'Vacaciones Teléfonica - '.$fila["NOM_EPL"].' '.$fila["APE_EPL"].' - Aceptado por Adminitrador';
                   $contenido='
                   <span style="font-size: 14px; ">Se&ntilde;or(a) '.$fila["NOM_EPL"].' '.$fila["APE_EPL"].' lleg&oacute; el momento para que vivas la mejor experiencia y disfrutes de tus merecidas vacaciones,&nbsp;El
                   '.date("d/m/Y",strtotime($inicial)).' inicia tu periodo de descanso hasta el
                   '.date("d/m/Y",strtotime($final)).', recuerda que tu reintegro es el siguiente d&iacute;a h&aacute;bil
                   a la fecha de finalizaci&oacute;n aqu&iacute; mencionada.</span></p>
                    <p style="text-align: left; ">
                    <br>
                     <span style="font-size:14px;">Las responsabilidades que tienes a tu cargo deben ser delegadas en alguien de tu equipo para no afectar el efectivo desarrollo de la operaci&oacute;n.</span></p>
                    <p style="text-align: left; ">
					En telefónica vivimos la mejor experiencia para construir el mejor lugar para trabajar en Colombia.

Para ver tus solicitudes ingresa <a href="https://'.@$ipvariable.'/vacaciones/php/main.php?valor=1">aquí</a>.
                    <br>
                      <span style="font-size:14px;">COLOMBIA TELECOMUNICACIONES SA ESP sigue construyendo el mejor lugar para trabajar enmarcando en una cultura que nos ilusiona y apasiona.</span></p>
                   <p style="text-align: left; ">
                    <br>
                    <span style="font-size:14px;">Gracias por hacer parte de COLOMBIA TELECOMUNICACIONES SA ESP y disfruta de tus vacaciones.<br><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. Si tienes alguna duda u observacion crea tu llamada a la Mesa Centro de Servicios Compartidos haciendo <a href="http://intranet/MesasAyuda/Control.aspx?idSer=SERVICIOS DE NOMINA&idSSer=VACACIONES&pt=NOVEDADES VACACIONES&id=2" style="color: #770003">clic aquí</a>. <br><br><strong> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. </strong><br>&nbsp;<br></span></p>
                   <p>&nbsp;
                   </p>
                  ';
				  
				      //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
		 //$email ='nelgaleano.2028@gmail.com'; // Esta es la dirección a donde enviamos $email
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email
         
         
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = $asuntonue; // Este es el titulo del email.
           //-----FIN EMAIL-----
         @$content= $administrador->mensaje_solicitud($contenido,$titulo);
         $mail->Body = $content; // Mensaje a enviar
         $exito = $mail->Send(); // Envía el correo.
				  
				  ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$fila["CEDULA"]."','".$fila["NOM_EPL"]."','".$fila["APE_EPL"]."',SYSDATE,'Vacaciones','".$email."','".$empresamail."')";
$conn->Execute($sqlmail);
				  
				  ?> ...Por favor espere mientras se envian los correos
				
	<script type="text/javascript">
window.location="vacaciones_gral_edith.php?enviado='ok'";
</script>';
<?php
				  
                }                
}
}
        elseif($_POST["accion"] == "rechazar"){/*Cuando se rechaza las vacaciones*/
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
                 <span style="font-size: 14px; ">Se&ntilde;or(a) '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' tu solicitud de vacaciones que tenias programadas del  '.date("d/m/Y",strtotime($empleados[$i]["inicial"])).' al '.date("d/m/Y",strtotime($empleados[$i]["final"])).', '.@$dias.' días hábiles, ha sido rechazada, ponte en contacto con tu lider para conocer el procedimiento a seguir.  Comentario de rechazo: '.$administrador->observacion_rechazo().'.</span>
                 <br>
                 <p style="text-align: left; ">
				 En telefónica vivimos la mejor experiencia para construir el mejor lugar para trabajar en Colombia.

Para ver tus solicitudes ingresa <a href="https://'.@$ipvariable.'/vacaciones/php/main.php?valor=1">aquí</a>.
                 <br>
                 <span style="font-size:14px;"> <br><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. Si tienes alguna duda u observacion crea tu llamada a la Mesa Centro de Servicios Compartidos haciendo <a href="http://intranet/MesasAyuda/Control.aspx?idSer=SERVICIOS DE NOMINA&idSSer=VACACIONES&pt=NOVEDADES VACACIONES&id=2" style="color: #770003">clic aquí</a>.<br><br><strong> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. </strong><br>&nbsp;<br></span></p>
                 <p style="text-align: left; ">
                 <br>
				 
                 </p>
                 <p>&nbsp;
                 </p>
                 <p>&nbsp;
                 </p>';
                }
            
        }else{/*False error al insertar los datos*/
             echo "Error al rechazar esta solicitud.";
        }
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email
         
         
         
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = $asuntonue; // Este es el titulo del email.
           //-----FIN EMAIL-----
         @$content= $administrador->mensaje_solicitud($contenido,$titulo);
         $mail->Body = $content; // Mensaje a enviar
         $exito = $mail->Send(); // Envía el correo.
		 
		 ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$empleados[$i]["CEDULA"]."','".$empleados[$i]["nombre"]."','".$empleados[$i]["apellido"]."',SYSDATE,'Vacaciones','".$email."','".$empresamail."')";
$conn->Execute($sqlmail);
		 
        }          
    ?>
