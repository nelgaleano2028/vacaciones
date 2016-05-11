<?php
@session_start();

//--------------------------------------------- BASE DE DATOS 1 ----------------------------------------

include_once('../lib/configdb.php');

$conn = $config;

//------------------------------FIN antidoto
require_once('../php/class_correoprogramado2.php');
require_once('../php/class_mailer.php');

global $conn;
$vacaciones=new vacaciones();

//Query para la generacion de la IP dinamica

	$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();
	$ipvariable=$row06["IP"];
	
//Query DATOS

$qry1="select emp.cod_epl as COD_EPL,
            b.cod_jefe as JEFE,
            au.fec_solicitud AS SOLICITUD,
            emp.cedula as CEDULA, emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,
            cp.nom_epl as NOM_JEFE,
            cp.ape_epl as APE_JEFE,
            gp.email as EMAIL_JEFE,
            au.fec_ini as FEC_INI,au.fec_fin as FEC_FIN,au.dias as DIAS
            from empleados_basic emp, empleados_basic cp, empleados_gral gp, cargos car, centrocosto2 cen ,ausencias_tmp au, EMPLEADOS_GRAL b
            where
            au.cod_epl=emp.cod_epl 
            and emp.cod_car=car.cod_car
            and b.cod_jefe = cp.cod_epl
            and b.cod_jefe = gp.cod_epl
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
			and gp.email <> 'ariel.ponton@telefonica.com'
			and gp.email <> 'ALFONSO.PALACIO@telefonica.com'
            and b.cod_epl = emp.cod_epl 
            and au.estado ='P' and au.cod_aus=(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus')
            and au.cod_con=(select descripcion from parametros_nue where nom_var='param_vacas_cod_con') ORDER BY au.fec_solicitud DESC";
$rh1 = $conn->Execute($qry1); 
while($row1 = $rh1->FetchRow()){
	
	$titulo1="Apreciado/a,";
	
	$contenido1="Apreciado/a, <br><br>
<p style='text-align: justify;'>
Te informamos que actualmente presentas una solicitud de vacaciones pendiente de aprobación de ".$row1["NOM_EPL"]." ".$row1["APE_EPL"]." de ".$row1["DIAS"]." días. <br><br>

Fecha inicio ".$row1["FEC_INI"]." y fecha final ".$row1["FEC_FIN"].". <br><br>

Recuerda que como Líder de la cultura Movistar Colombia eres responsable de promover la programación de las vacaciones de tu equipo de trabajo, para que ellos disfruten del descanso en el momento oportuno. Por esta razón, te invitamos a ingresar <a href='https://".$ipvariable."/vacaciones/' style='color: #770003'>aquí</a> y autorizar las solicitudes pendientes. <br><br>
</p>
<strong>Jefatura de Nómina</strong>
";
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'LEONARDO.WALLES@TELEFONICA.COM';
	$email = $row1["EMAIL_JEFE"];
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Vacaciones pendientes por autorizar"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 
			}

			
//--------------------------------------------- BASE DE DATOS 2 ----------------------------------------

include_once('../lib/configdbf.php');

$conn = $configf;

//------------------------------FIN antidoto
require_once('../php/class_correoprogramado2.php');
require_once('../php/class_mailer.php');

global $conn;
$vacaciones=new vacaciones();

//Query para la generacion de la IP dinamica

	$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();
	$ipvariable=$row06["IP"];
	
//Query DATOS

$qry1="select emp.cod_epl as COD_EPL,
            b.cod_jefe as JEFE,
            au.fec_solicitud AS SOLICITUD,
            emp.cedula as CEDULA, emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,
            cp.nom_epl as NOM_JEFE,
            cp.ape_epl as APE_JEFE,
            gp.email as EMAIL_JEFE,
            au.fec_ini as FEC_INI,au.fec_fin as FEC_FIN,au.dias as DIAS
            from empleados_basic emp, empleados_basic cp, empleados_gral gp, cargos car, centrocosto2 cen ,ausencias_tmp au, EMPLEADOS_GRAL b
            where
            au.cod_epl=emp.cod_epl 
            and emp.cod_car=car.cod_car
            and b.cod_jefe = cp.cod_epl
            and b.cod_jefe = gp.cod_epl
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
			and gp.email <> 'ariel.ponton@telefonica.com'
			and gp.email <> 'ALFONSO.PALACIO@telefonica.com'
            and b.cod_epl = emp.cod_epl 
            and au.estado ='P' and au.cod_aus=(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus')
            and au.cod_con=(select descripcion from parametros_nue where nom_var='param_vacas_cod_con') ORDER BY au.fec_solicitud DESC";
$rh1 = $conn->Execute($qry1); 
while($row1 = $rh1->FetchRow()){
	
	$titulo1="Apreciado/a,";
	
	$contenido1="Apreciado/a, <br><br>
<p style='text-align: justify;'>
Te informamos que actualmente presentas una solicitud de vacaciones pendiente de aprobación de ".$row1["NOM_EPL"]." ".$row1["APE_EPL"]." de ".$row1["DIAS"]." días. <br><br>

Fecha inicio ".$row1["FEC_INI"]." y fecha final ".$row1["FEC_FIN"].". <br><br>

Recuerda que como Líder de la cultura Movistar Colombia eres responsable de promover la programación de las vacaciones de tu equipo de trabajo, para que ellos disfruten del descanso en el momento oportuno. Por esta razón, te invitamos a ingresar <a href='https://".$ipvariable."/vacaciones/' style='color: #770003'>aquí</a> y autorizar las solicitudes pendientes. <br><br>
</p>
<strong>Jefatura de Nómina</strong>
";
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'LEONARDO.WALLES@TELEFONICA.COM';
	$email = $row1["EMAIL_JEFE"];
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Vacaciones pendientes por autorizar"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 
			}
			
//--------------------------------------------- BASE DE DATOS 3 ----------------------------------------

include_once('../lib/configdbc.php');

$conn = $configc;

//------------------------------FIN antidoto
require_once('../php/class_correoprogramado2.php');
require_once('../php/class_mailer.php');

global $conn;
$vacaciones=new vacaciones();

//Query para la generacion de la IP dinamica

	$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();
	$ipvariable=$row06["IP"];
	
//Query DATOS

$qry1="select emp.cod_epl as COD_EPL,
            b.cod_jefe as JEFE,
            au.fec_solicitud AS SOLICITUD,
            emp.cedula as CEDULA, emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,
            cp.nom_epl as NOM_JEFE,
            cp.ape_epl as APE_JEFE,
            gp.email as EMAIL_JEFE,
            au.fec_ini as FEC_INI,au.fec_fin as FEC_FIN,au.dias as DIAS
            from empleados_basic emp, empleados_basic cp, empleados_gral gp, cargos car, centrocosto2 cen ,ausencias_tmp au, EMPLEADOS_GRAL b
            where
            au.cod_epl=emp.cod_epl 
            and emp.cod_car=car.cod_car
            and b.cod_jefe = cp.cod_epl
            and b.cod_jefe = gp.cod_epl
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
			and gp.email <> 'ariel.ponton@telefonica.com'
			and gp.email <> 'ALFONSO.PALACIO@telefonica.com'
            and b.cod_epl = emp.cod_epl 
            and au.estado ='P' and au.cod_aus=(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus')
            and au.cod_con=(select descripcion from parametros_nue where nom_var='param_vacas_cod_con') ORDER BY au.fec_solicitud DESC";
$rh1 = $conn->Execute($qry1); 
while($row1 = $rh1->FetchRow()){
	
	$titulo1="Apreciado/a,";
	
	$contenido1="Apreciado/a, <br><br>
<p style='text-align: justify;'>
Te informamos que actualmente presentas una solicitud de vacaciones pendiente de aprobación de ".$row1["NOM_EPL"]." ".$row1["APE_EPL"]." de ".$row1["DIAS"]." días. <br><br>

Fecha inicio ".$row1["FEC_INI"]." y fecha final ".$row1["FEC_FIN"].". <br><br>

Recuerda que como Líder de la cultura Movistar Colombia eres responsable de promover la programación de las vacaciones de tu equipo de trabajo, para que ellos disfruten del descanso en el momento oportuno. Por esta razón, te invitamos a ingresar <a href='https://".$ipvariable."/vacaciones/' style='color: #770003'>aquí</a> y autorizar las solicitudes pendientes. <br><br>
</p>
<strong>Jefatura de Nómina</strong>
";
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'LEONARDO.WALLES@TELEFONICA.COM';
	$email = $row1["EMAIL_JEFE"];
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Vacaciones pendientes por autorizar"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 
			}

//--------------------------------------------- BASE DE DATOS 4 ----------------------------------------

include_once('../lib/configdbt.php');

$conn = $configt;

//------------------------------FIN antidoto
require_once('../php/class_correoprogramado2.php');
require_once('../php/class_mailer.php');

global $conn;
$vacaciones=new vacaciones();

//Query para la generacion de la IP dinamica

	$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();
	$ipvariable=$row06["IP"];
	
//Query DATOS

$qry1="select emp.cod_epl as COD_EPL,
            b.cod_jefe as JEFE,
            au.fec_solicitud AS SOLICITUD,
            emp.cedula as CEDULA, emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,
            cp.nom_epl as NOM_JEFE,
            cp.ape_epl as APE_JEFE,
            gp.email as EMAIL_JEFE,
            au.fec_ini as FEC_INI,au.fec_fin as FEC_FIN,au.dias as DIAS
            from empleados_basic emp, empleados_basic cp, empleados_gral gp, cargos car, centrocosto2 cen ,ausencias_tmp au, EMPLEADOS_GRAL b
            where
            au.cod_epl=emp.cod_epl 
            and emp.cod_car=car.cod_car
            and b.cod_jefe = cp.cod_epl
            and b.cod_jefe = gp.cod_epl
            and emp.cod_cc2=cen.cod_cc2
            and emp.estado = 'A'
			and gp.email <> 'ariel.ponton@telefonica.com'
			and gp.email <> 'ALFONSO.PALACIO@telefonica.com'
            and b.cod_epl = emp.cod_epl 
            and au.estado ='P' and au.cod_aus=(select descripcion from parametros_nue where nom_var='param_vacas_cod_aus')
            and au.cod_con=(select descripcion from parametros_nue where nom_var='param_vacas_cod_con') ORDER BY au.fec_solicitud DESC";
$rh1 = $conn->Execute($qry1); 
while($row1 = $rh1->FetchRow()){
	
	$titulo1="Apreciado/a,";
	
	$contenido1="Apreciado/a, <br><br>
<p style='text-align: justify;'>
Te informamos que actualmente presentas una solicitud de vacaciones pendiente de aprobación de ".$row1["NOM_EPL"]." ".$row1["APE_EPL"]." de ".$row1["DIAS"]." días. <br><br>

Fecha inicio ".$row1["FEC_INI"]." y fecha final ".$row1["FEC_FIN"].". <br><br>

Recuerda que como Líder de la cultura Movistar Colombia eres responsable de promover la programación de las vacaciones de tu equipo de trabajo, para que ellos disfruten del descanso en el momento oportuno. Por esta razón, te invitamos a ingresar <a href='https://".$ipvariable."/vacaciones/' style='color: #770003'>aquí</a> y autorizar las solicitudes pendientes. <br><br>
</p>
<strong>Jefatura de Nómina</strong>
";
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'LEONARDO.WALLES@TELEFONICA.COM';
	$email = $row1["EMAIL_JEFE"];
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Vacaciones pendientes por autorizar"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 
			}

?>