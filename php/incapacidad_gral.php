<?php
        include_once("class_incapacidades.php");
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
		// $email = 'nags_dcm2028@hotmail.com';
        //$email = 'dfgomezpi@gmail.com';
        
      
        
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
         
         //Query para la generacion de la IP dinamica

	$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	  
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();

	$ipvariable=$row06["IP"];
         
         if($validar == true){/*True se insertaron los datos*/
           
                for($i=0;$i<count($empleados); $i++){
                 $asuntonue = 'Incapacidades Teléfonica - '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' - Aceptado por Líder';
                   $contenido='
                   <span style="font-size: 14px; ">Se&ntilde;or(a) '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' lleg&oacute; el momento para que vivas la mejor experiencia y disfrutes de tus merecidas vacaciones,&nbsp;El
                   '.date("d/m/Y",strtotime($empleados[$i]["inicial"])).' inicia tu periodo de descanso hasta el
                   '.date("d/m/Y",strtotime($empleados[$i]["final"])).', recuerda que tu reintegro es el siguiente d&iacute;a h&aacute;bil
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
                }
                
                 echo "Se acepto esta solicitud correctamente.";
         
           }else{/*False error al insertar los datos*/
            echo "Error al aceptar esta solicitud.";
           }
        }elseif($_POST["accion"] == "rechazar"){/*Cuando se rechaza las vacaciones*/
		$asuntonue = 'Incapacidades Teléfonica - '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' - Cerrado por Líder';
                $consecutivo=$_POST["consecutivo"];
            $administrador->set_consecutivo($consecutivo);
            $observacion=utf8_decode($_POST["obse"]);
             $administrador->set_observacion($observacion);
            $validar=$administrador->cambia_estado_cance();
            if($validar == true){/*True se insertaron los datos*/
            echo "Ha cerrado esta solicitud.";
            
			$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	  
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();

	$ipvariable=$row06["IP"];
            
            for($i=0;$i<count($empleados); $i++){
             $contenido='
                 <span style="font-size: 14px; ">Se&ntilde;or(a) '.$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' se registró tu incapacidad del  '.date("d/m/Y",strtotime($empleados[$i]["inicial"])).' al '.date("d/m/Y",strtotime($empleados[$i]["final"])).'. comentario del cierre: '.$administrador->observacion_rechazo().'.</span>
                 <br>
                 <p style="text-align: left; ">
				 Colombia Telecomunicaciones reconoce inicialmente el 100% del valor de la incapacidad, es compromiso de todos recuperar los valores a cargo de la EPS.
				
				 <br>
                 <span style="font-size:14px;"> <br><br>Te invitamos a conocer la política de ausentismo de la compañía, haciendo <a href="http://intranettelefonica/org/rrhhco/syso/Documents/POLITICA%20DE%20AUSENTISMO%202014%20(2)%20(2).pdf" style="color: #770003">clic aquí</a>.<br><br><strong>Jefatura de Nomina. </strong><br><strong>Servicios Económicos. </strong>&nbsp;</span></p>
                 <p style="text-align: left; ">
                 <br>
				 
                 </p>
                 <p>&nbsp;
                 </p>
                 <p>&nbsp;
                 </p>';
				 ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$empleados[$i]["cedula"]."','".$empleados[$i]["nombre"]."','".$empleados[$i]["apellido"]."',SYSDATE,'Incapacidades','".$email."','".$empresamail."')";
$conn->Execute($sqlmail);
                }
            
			
			
        }else{/*False error al insertar los datos*/
             echo "Error al cerrar esta solicitud.";
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

    ?>