<?php
        session_start();
		
        include_once("class_novedades.php");
		
        include_once("class_empleado.php");
		include_once("class_vacaciones.php");
        include_once("class_mailer.php");
        
		
        $empleado=new empleado();
        $administrador=new novedades();
		$correo=new vacaciones();
        $mail= new mailer();
		
	       
        
		//Variables para generar el reporte de vacaciones
        $titulo='Solicitud Novedades';
        $portal='';
        $youtube='';
        $facebook='';
        $twitter='';
			
        
        $consecutivo=$_POST["consecutivo"];
        $cod_epl=$_POST["cod_epl"];  //codigo del empleado
		$observacion=$_POST["obse"];
		$empleado->set_codigo($cod_epl);
		$empleados=$empleado->datos_empleado();
		
        
		$administrador->set_num_sem($consecutivo);
        $administrador->set_codigo_jefe($_SESSION['cod_admin']);
        $administrador->set_cod_epl($cod_epl);
        
        
        /*Cuando se aprueban las vacaciones*/
        if($_POST["accion"] == "aprobar"){
           
         $validar=$administrador->responder_solicitud_jefe("aprobar");
         
         if($validar == true){/*True se insertaron los datos*/
		 	         
             echo "Mensaje enviado de la aceptacion de la solicitud.";
            }else{/*False error al insertar los datos*/
            echo "Error al aceptar esta solicitud.";
            }
        }elseif($_POST["accion"] == "rechazar"){/*Cuando se rechaza las vacaciones*/           
            $validar=$administrador->responder_solicitud_jefe("rechazar");
            if($validar == true){/*True se insertaron los datos*/
			
				for($i=0;$i<count($empleados); $i++){
                             
                  if($empleados["sexo"] == "M"){
                       $contenido='
                  					<span style="font-size: 14px; ">Se&ntilde;or ';
                  }else{
                       $contenido='
                  					<span style="font-size: 14px; ">Se&ntilde;ora ';
                  }
                  
                  $contenido.=$empleados[$i]["nombre"].' '.$empleados[$i]["apellido"].' Su novedad ha sido Rechazada.</span></p>
				  
				  <p>Por motivo de:'.$observacion.'</p>
                  
                   				<p style="text-align: left; ">
                    			<span style="font-size:14px;">'.utf8_encode($empleado->empresa()).' sigue construyendo el mejor lugar para trabajar enmarcando en una 	cultura que nos ilusiona y apasiona.</span></p>
                  				<p style="text-align: left; ">
                   				<br>';
              }
				
              echo "Mensaje enviado de rechazado de la solicitud.";
            }else{/*False error al insertar los datos*/
             echo "Error al rechazar esta solicitud.";
            }
			 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($empleados[$i]["email"]); // Esta es la dirección a donde enviamos $email
         
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Novedades"; // Este es el titulo del email.
           //-----FIN EMAIL-----
         $content= $correo->mensaje_solicitud($contenido,$portal,$youtube,$facebook,$twitter,$titulo," http://www.nomina.supersitio.net/files/img_banner/banner_33321.jpg");
         $mail->Body = $content; // Mensaje a enviar
         $exito = $mail->Send(); // Envía el correo.
        }
		
         

    ?>