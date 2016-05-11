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
	Te informamos que actualmente presentas una solicitud de vacaciones de ".$row1["DIAS"]." dias pendiente de aprobaci�n por tu jefe. <br><br>
	
	Fecha inicio ".$row1["FEC_INI"]." y fecha final ".$row1["FEC_FIN"].". <br><br>

	Recuerda que para disfrutar de tus vacaciones, es indispensable que cuentes con la aprobaci�n de tu jefe en el M�dulo Web Autogesti�n, a m�s tardar el d�a h�bil anterior a la fecha de corte de novedades de n�mina publicado en el mismo M�dulo Web. <br><br>
	</p>
	<strong>Jefatura de N�mina</strong>
";
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'LEONARDO.WALLES@TELEFONICA.COM';
	$email = $row1["EMAIL"];
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos l�neas, cumplir�an la funci�n de encabezado (En mail() usado de esta forma: �From: Nombre <correo@dominio.com>�) de //correo.
         $mail->AddAddress($email); // Esta es la direcci�n a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se env�a como HTML
         $mail->Subject = "Tu solicitud de vacaciones est� pendiente de aprobaci�n por parte de tu Jefe"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Env�a el correo.
		 
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
	Te informamos que actualmente presentas una solicitud de vacaciones de ".$row1["DIAS"]." dias pendiente de aprobaci�n por tu jefe. <br><br>
	
	Fecha inicio ".$row1["FEC_INI"]." y fecha final ".$row1["FEC_FIN"].". <br><br>

	Recuerda que para disfrutar de tus vacaciones, es indispensable que cuentes con la aprobaci�n de tu jefe en el M�dulo Web Autogesti�n, a m�s tardar el d�a h�bil anterior a la fecha de corte de novedades de n�mina publicado en el mismo M�dulo Web. <br><br>
	</p>
	<strong>Jefatura de N�mina</strong>
";
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'LEONARDO.WALLES@TELEFONICA.COM';
	$email = $row1["EMAIL"];
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos l�neas, cumplir�an la funci�n de encabezado (En mail() usado de esta forma: �From: Nombre <correo@dominio.com>�) de //correo.
         $mail->AddAddress($email); // Esta es la direcci�n a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se env�a como HTML
         $mail->Subject = "Tu solicitud de vacaciones est� pendiente de aprobaci�n por parte de tu Jefe"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Env�a el correo.
		 
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
	Te informamos que actualmente presentas una solicitud de vacaciones de ".$row1["DIAS"]." dias pendiente de aprobaci�n por tu jefe. <br><br>
	
	Fecha inicio ".$row1["FEC_INI"]." y fecha final ".$row1["FEC_FIN"].". <br><br>

	Recuerda que para disfrutar de tus vacaciones, es indispensable que cuentes con la aprobaci�n de tu jefe en el M�dulo Web Autogesti�n, a m�s tardar el d�a h�bil anterior a la fecha de corte de novedades de n�mina publicado en el mismo M�dulo Web. <br><br>
	</p>
	<strong>Jefatura de N�mina</strong>
";
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'LEONARDO.WALLES@TELEFONICA.COM';
	$email = $row1["EMAIL"];
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos l�neas, cumplir�an la funci�n de encabezado (En mail() usado de esta forma: �From: Nombre <correo@dominio.com>�) de //correo.
         $mail->AddAddress($email); // Esta es la direcci�n a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se env�a como HTML
         $mail->Subject = "Tu solicitud de vacaciones est� pendiente de aprobaci�n por parte de tu Jefe"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Env�a el correo.
		 
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
	Te informamos que actualmente presentas una solicitud de vacaciones de ".$row1["DIAS"]." dias pendiente de aprobaci�n por tu jefe. <br><br>
	
	Fecha inicio ".$row1["FEC_INI"]." y fecha final ".$row1["FEC_FIN"].". <br><br>

	Recuerda que para disfrutar de tus vacaciones, es indispensable que cuentes con la aprobaci�n de tu jefe en el M�dulo Web Autogesti�n, a m�s tardar el d�a h�bil anterior a la fecha de corte de novedades de n�mina publicado en el mismo M�dulo Web. <br><br>
	</p>
	<strong>Jefatura de N�mina</strong>
";
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'LEONARDO.WALLES@TELEFONICA.COM';
	$email = $row1["EMAIL"];
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos l�neas, cumplir�an la funci�n de encabezado (En mail() usado de esta forma: �From: Nombre <correo@dominio.com>�) de //correo.
         $mail->AddAddress($email); // Esta es la direcci�n a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se env�a como HTML
         $mail->Subject = "Tu solicitud de vacaciones est� pendiente de aprobaci�n por parte de tu Jefe"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Env�a el correo.
		 
		 $mail->ClearAddresses();
		 
			}

?>