<?php
session_start();
/*             librerias
 -----------------------------------------------------
 */    
/*
 *libreria para enviar correos electronicos. 
 */
    require_once("class_mailer.php");
/*
 *libreria De diseño de correos. 
 */    
    require_once('../php/class_vacaciones.php');
/*
 *libreria para Conectarme a la base de datos.
 */    
    require_once('../lib/configdb.php');
    
    global $conn;
/*
 -----------------------------------------------------
 */

 
/*
 *Sentecia SQL que trae la informacion del solicitante del credito de vivienda.
 */
    $sql="Select b.cod_epl as COD_EPL,b.nom_epl AS NOM_EPL,
          b.ape_epl AS APE_EPL,b.cedula AS CEDULA,a.sexo AS SEXO,b.sal_bas as SAL_BAS
          From empleados_gral a,empleados_basic b
          where a.cod_epl=b.cod_epl and b.cod_epl='".$_SESSION['cod']."'";
    $rs=$conn->Execute($sql);
    
/*
 *Sentecia SQL que trae la informacion de la empresa.
 */    
    
    $empresa="SELECT emp.nom_emp AS NOM_EMP,emp.email AS EMAIL
          FROM empresas emp
          WHERE emp.cod_emp=1";
    $row=$conn->Execute($empresa);
    $emp=$row->FetchRow();
/*
 Diseño del correo electronico
 */        
    $vacaciones = new vacaciones();
 	
    $titulo="Solicitud de Cr&eacute;dito de Vivienda";
    $portal='';
    $youtube='';
    $facebook='';
    $twitter='';
/*
 Se verifica el Sexo del emplead@
 */    
    while($fila=$rs->FetchRow()){
	
	if($fila["SEXO"]== "F"){
	    $sexo='La empleada';
	}elseif($fila["SEXO"]== "M"){
	    $sexo='El empleado';
	}
/*
 Contenido del Correo electronico HTML.
 */    
     $contenido='
        <span style="font-size: 14px; ">'.$sexo.' '.$fila["NOM_EPL"].' '.$fila["APE_EPL"].' con c&oacute;digo '.trim($fila["COD_EPL"]).', cedula de ciudadan&iacute;a '.$fila["CEDULA"].' y con un salario de $'.number_format($fila["SAL_BAS"],0,",",".").' ha realizado una solicitud de cr&eacute;dito de vivienda  con la siguiente descripci&oacute;n:<br><br>
            '.trim($_POST["esp"]).'.</span></p>
        <p style="text-align: left; ">
                <br>
                <span style="font-size:14px;">'.utf8_encode($emp["NOM_EMP"]).' sigue construyendo el mejor lugar para trabajar enmarcando en una cultura que nos ilusiona y apasiona.</span></p>
        <p style="text-align: left; ">
        
        <p>&nbsp;
        </p>';
    }


/*
 Metodo el cual genera el diseño del correo
 @param $contenido contenido del correo
 Url de la empresa 
 @param $portal
 @param $youtube
 @param $facebook
 @param $twitter
 
 @param $titulo  titulo del mensaje
 @param url de imagen de banner.
 */    
    $content= $vacaciones->mensaje_solicitud($contenido,$portal,$youtube,$facebook,$twitter,$titulo,"http://www.pilardelahoradada.org/www/img/areas/vivienda/banner_vivienda.jpg");


 /*
    ------------------------------ENVIO DE COMPROBANTE EMAIL------------------------------------------------------------------
    */
       $mail = new mailer();
       //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
       $mail->AddAddress("juan.lopez@talentsw.com"); // Esta es la dirección a donde enviamosjuan.urrego@chec.com.co.
       $mail->IsHTML(true); // El correo se envía como HTML
       $asunto= "SOLICITUD DE CRÉDITO DE VIVIENDA";
       $mail->Subject = $asunto; // Este es el titulo del email.
       $body = "El empleado(a) steven morales con código 1234 y cedula de ciudadanía 3122456 a realizado una solicitud de crédito de vivienda  con la siguiente descripción:
                
                ";
       $mail->Body = $content; // Mensaje a enviar
       $exito = $mail->Send(); // Envía el correo.
       //También podríamos agregar simples verificaciones para saber si se envió:
        if($exito){
           echo 'El correo fue enviado correctamente.';
        }else{
           echo 'Hubo un inconveniente. Contacta a un administrador.';
        }
    /* ----------------------------------FIN DE ENVIO--------------------------------------------------------------------*/      



?>