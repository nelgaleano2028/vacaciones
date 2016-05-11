<?php
@session_start();

//--------------------------------------------- BASE DE DATOS 1 ----------------------------------------

include_once('../lib/configdb.php');

$conn = $config;

//------------------------------FIN antidoto
require_once('../php/class_correoprogramado1.php');
require_once('../php/class_mailer.php');

global $conn;
$vacaciones=new vacaciones();

//Query para la generacion de la IP dinamica

	$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();
	$ipvariable=$row06["IP"];
	
//Query DATOS

$qry1="select au.cod_epl AS COD_EPL, eb.nom_epl AS NOM_EPL, eb.ape_epl AS APE_EPL, eg.email AS EMAIL, au.fec_ini AS FEC_INI, au.fec_fin AS FEC_FIN, au.estado AS ESTADO, au.dias AS DIAS, eg.cod_jefe AS JEFE
from ausencias_tmp au, empleados_basic eb, empleados_gral eg where au.estado='P' and eb.ESTADO='A' and au.cod_epl=eb.cod_epl and au.cod_epl=eg.cod_epl ";
$rh1 = $conn->Execute($qry1); 
while($row1 = $rh1->FetchRow()){
	
	$titulo1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>";
	
	$contenido1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>, <br><br>
	<p style='text-align: justify;'>
	Te informamos que actualmente presentas una solicitud de vacaciones de ".$row1["DIAS"]." dias pendiente de aprobación por tu jefe. <br><br>
	
	Fecha inicio ".$row1["FEC_INI"]." y fecha final ".$row1["FEC_FIN"].". <br><br>

	Recuerda que para disfrutar de tus vacaciones, es indispensable que cuentes con la aprobación de tu jefe en el Módulo Web Autogestión, a más tardar el día hábil anterior a la fecha de corte de novedades de nómina publicado en el mismo Módulo Web. <br><br>
	</p>
	<strong>Jefatura de Nómina</strong>
";
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'LEONARDO.WALLES@TELEFONICA.COM';
	$email = $row1["EMAIL"];
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Tu solicitud de vacaciones está pendiente de aprobación por parte de tu Jefe"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 
			}
			
//--------------------------------------------- BASE DE DATOS 2 ----------------------------------------

include_once('../lib/configdbf.php');

$conn = $configf;

//------------------------------FIN antidoto
require_once('../php/class_correoprogramado1.php');
require_once('../php/class_mailer.php');

global $conn;
$vacaciones=new vacaciones();

//Query para la generacion de la IP dinamica

	$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();
	$ipvariable=$row06["IP"];
	
//Query DATOS

$qry1="select au.cod_epl AS COD_EPL, eb.nom_epl AS NOM_EPL, eb.ape_epl AS APE_EPL, eg.email AS EMAIL, au.fec_ini AS FEC_INI, au.fec_fin AS FEC_FIN, au.estado AS ESTADO, au.dias AS DIAS, eg.cod_jefe AS JEFE
from ausencias_tmp au, empleados_basic eb, empleados_gral eg where au.estado='P' and eb.ESTADO='A' and au.cod_epl=eb.cod_epl and au.cod_epl=eg.cod_epl ";
$rh1 = $conn->Execute($qry1); 
while($row1 = $rh1->FetchRow()){
	
	$titulo1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>";
	
	$contenido1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>, <br><br>
	<p style='text-align: justify;'>
	Te informamos que actualmente presentas una solicitud de vacaciones de ".$row1["DIAS"]." dias pendiente de aprobación por tu jefe. <br><br>
	
	Fecha inicio ".$row1["FEC_INI"]." y fecha final ".$row1["FEC_FIN"].". <br><br>

	Recuerda que para disfrutar de tus vacaciones, es indispensable que cuentes con la aprobación de tu jefe en el Módulo Web Autogestión, a más tardar el día hábil anterior a la fecha de corte de novedades de nómina publicado en el mismo Módulo Web. <br><br>
	</p>
	<strong>Jefatura de Nómina</strong>
";
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'LEONARDO.WALLES@TELEFONICA.COM';
	$email = $row1["EMAIL"];
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Tu solicitud de vacaciones está pendiente de aprobación por parte de tu Jefe"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 
			}
			
//--------------------------------------------- BASE DE DATOS 3 ----------------------------------------

include_once('../lib/configdbc.php');

$conn = $configc;

//------------------------------FIN antidoto
require_once('../php/class_correoprogramado1.php');
require_once('../php/class_mailer.php');

global $conn;
$vacaciones=new vacaciones();

//Query para la generacion de la IP dinamica

	$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();
	$ipvariable=$row06["IP"];
	
//Query DATOS

$qry1="select au.cod_epl AS COD_EPL, eb.nom_epl AS NOM_EPL, eb.ape_epl AS APE_EPL, eg.email AS EMAIL, au.fec_ini AS FEC_INI, au.fec_fin AS FEC_FIN, au.estado AS ESTADO, au.dias AS DIAS, eg.cod_jefe AS JEFE
from ausencias_tmp au, empleados_basic eb, empleados_gral eg where au.estado='P' and eb.ESTADO='A' and au.cod_epl=eb.cod_epl and au.cod_epl=eg.cod_epl ";
$rh1 = $conn->Execute($qry1); 
while($row1 = $rh1->FetchRow()){
	
	$titulo1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>";
	
	$contenido1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>, <br><br>
	<p style='text-align: justify;'>
	Te informamos que actualmente presentas una solicitud de vacaciones de ".$row1["DIAS"]." dias pendiente de aprobación por tu jefe. <br><br>
	
	Fecha inicio ".$row1["FEC_INI"]." y fecha final ".$row1["FEC_FIN"].". <br><br>

	Recuerda que para disfrutar de tus vacaciones, es indispensable que cuentes con la aprobación de tu jefe en el Módulo Web Autogestión, a más tardar el día hábil anterior a la fecha de corte de novedades de nómina publicado en el mismo Módulo Web. <br><br>
	</p>
	<strong>Jefatura de Nómina</strong>
";
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'LEONARDO.WALLES@TELEFONICA.COM';
	$email = $row1["EMAIL"];
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Tu solicitud de vacaciones está pendiente de aprobación por parte de tu Jefe"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 
			}
			
//--------------------------------------------- BASE DE DATOS 4 ----------------------------------------

include_once('../lib/configdbt.php');

$conn = $configt;

//------------------------------FIN antidoto
require_once('../php/class_correoprogramado1.php');
require_once('../php/class_mailer.php');

global $conn;
$vacaciones=new vacaciones();

//Query para la generacion de la IP dinamica

	$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();
	$ipvariable=$row06["IP"];
	
//Query DATOS

$qry1="select au.cod_epl AS COD_EPL, eb.nom_epl AS NOM_EPL, eb.ape_epl AS APE_EPL, eg.email AS EMAIL, au.fec_ini AS FEC_INI, au.fec_fin AS FEC_FIN, au.estado AS ESTADO, au.dias AS DIAS, eg.cod_jefe AS JEFE
from ausencias_tmp au, empleados_basic eb, empleados_gral eg where au.estado='P' and eb.ESTADO='A' and au.cod_epl=eb.cod_epl and au.cod_epl=eg.cod_epl";
$rh1 = $conn->Execute($qry1); 
while($row1 = $rh1->FetchRow()){
	
	$titulo1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>";
	
	$contenido1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>, <br><br>
	<p style='text-align: justify;'>
	Te informamos que actualmente presentas una solicitud de vacaciones de ".$row1["DIAS"]." dias pendiente de aprobación por tu jefe. <br><br>
	
	Fecha inicio ".$row1["FEC_INI"]." y fecha final ".$row1["FEC_FIN"].". <br><br>

	Recuerda que para disfrutar de tus vacaciones, es indispensable que cuentes con la aprobación de tu jefe en el Módulo Web Autogestión, a más tardar el día hábil anterior a la fecha de corte de novedades de nómina publicado en el mismo Módulo Web. <br><br>
	</p>
	<strong>Jefatura de Nómina</strong>
";
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'LEONARDO.WALLES@TELEFONICA.COM';
	$email = $row1["EMAIL"];
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Tu solicitud de vacaciones está pendiente de aprobación por parte de tu Jefe"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 
			}

?>