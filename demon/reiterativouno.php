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
	
//INICIO: ACA VA EL QUERY, SOLO SE DEBE CAMBIAR EL CONTENIDO DENTRO DE LAS COMILLAS, $qry1 ES LA VARIABLE QUE CONTIENE LA CONSULTA

$qry1="SELECT v.cod_epl,  e.nom_epl AS NOM_EPL, e.ape_epl AS APE_EPL, g.email as EMAIL, SUM(TO_NUMBER (v.DIAS)) as DIAS_PENDIENTES
FROM VACACIONES_PENDIENTES v, empleados_gral g, empleados_basic e
where e.cod_epl = g.cod_epl 
and v.cod_epl =g.cod_epl
group by v.cod_epl,g.email,  e.nom_epl ,  e.ape_epl
having SUM(TO_NUMBER (DIAS))>15
order by v.cod_epl";
	
//FIN	
	
$rh1 = $conn->Execute($qry1); 
while($row1 = $rh1->FetchRow()){
	
	$titulo1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>";
	
	$contenido1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>, <br><br>
<p style='text-align: justify;'>
Para Movistar Colombia es muy importante tu bienestar. Es por esto, que te invitamos a reunirte con tu Jefe y programar tus días de vacaciones para que disfrutes de unos merecidos días de descanso junto a tus seres queridos. <br><br>

Al corte del mes anterior, cuentas con ".$row1["DIAS_PENDIENTES"]." (días) acumulados. <br><br>

Para programar tus vacaciones haz clic <a href='https://".$ipvariable."/vacaciones/' style='color: #770003'>aquí</a>. <br><br>
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
         $mail->Subject = "Tienes un periodo o más de vacaciones pendiente por disfrutar"; // Este es el titulo del email.
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
	
//INICIO: ACA VA EL QUERY, SOLO SE DEBE CAMBIAR EL CONTENIDO DENTRO DE LAS COMILLAS, $qry1 ES LA VARIABLE QUE CONTIENE LA CONSULTA

$qry1="SELECT v.cod_epl,  e.nom_epl AS NOM_EPL, e.ape_epl AS APE_EPL, g.email as EMAIL, SUM(TO_NUMBER (v.DIAS)) as DIAS_PENDIENTES
FROM VACACIONES_PENDIENTES v, empleados_gral g, empleados_basic e
where e.cod_epl = g.cod_epl 
and v.cod_epl =g.cod_epl
group by v.cod_epl,g.email,  e.nom_epl ,  e.ape_epl
having SUM(TO_NUMBER (DIAS))>15
order by v.cod_epl";
	
	//FIN
	
$rh1 = $conn->Execute($qry1); 
while($row1 = $rh1->FetchRow()){
	
	$titulo1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>";
	
	$contenido1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>, <br><br>
<p style='text-align: justify;'>
Para Movistar Colombia es muy importante tu bienestar. Es por esto, que te invitamos a reunirte con tu Jefe y programar tus días de vacaciones para que disfrutes de unos merecidos días de descanso junto a tus seres queridos. <br><br>

Al corte del mes anterior, cuentas con ".$row1["DIAS_PENDIENTES"]." (días) acumulados. <br><br>

Para programar tus vacaciones haz clic <a href='https://".$ipvariable."/vacaciones/' style='color: #770003'>aquí</a>. <br><br>
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
         $mail->Subject = "Tienes un periodo o más de vacaciones pendiente por disfrutar"; // Este es el titulo del email.
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
	
//INICIO: ACA VA EL QUERY, SOLO SE DEBE CAMBIAR EL CONTENIDO DENTRO DE LAS COMILLAS, $qry1 ES LA VARIABLE QUE CONTIENE LA CONSULTA

$qry1="SELECT v.cod_epl,  e.nom_epl AS NOM_EPL, e.ape_epl AS APE_EPL, g.email as EMAIL, SUM(TO_NUMBER (v.DIAS)) as DIAS_PENDIENTES
FROM VACACIONES_PENDIENTES v, empleados_gral g, empleados_basic e
where e.cod_epl = g.cod_epl 
and v.cod_epl =g.cod_epl
group by v.cod_epl,g.email,  e.nom_epl ,  e.ape_epl
having SUM(TO_NUMBER (DIAS))>15
order by v.cod_epl";
	
	//FIN
	
$rh1 = $conn->Execute($qry1); 
while($row1 = $rh1->FetchRow()){
	
	$titulo1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>";
	
	$contenido1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>, <br><br>
<p style='text-align: justify;'>
Para Movistar Colombia es muy importante tu bienestar. Es por esto, que te invitamos a reunirte con tu Jefe y programar tus días de vacaciones para que disfrutes de unos merecidos días de descanso junto a tus seres queridos. <br><br>

Al corte del mes anterior, cuentas con ".$row1["DIAS_PENDIENTES"]." (días) acumulados. <br><br>

Para programar tus vacaciones haz clic <a href='https://".$ipvariable."/vacaciones/' style='color: #770003'>aquí</a>. <br><br>
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
         $mail->Subject = "Tienes un periodo o más de vacaciones pendiente por disfrutar"; // Este es el titulo del email.
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
	
//INICIO: ACA VA EL QUERY, SOLO SE DEBE CAMBIAR EL CONTENIDO DENTRO DE LAS COMILLAS, $qry1 ES LA VARIABLE QUE CONTIENE LA CONSULTA

$qry1="SELECT v.cod_epl,  e.nom_epl AS NOM_EPL, e.ape_epl AS APE_EPL, g.email as EMAIL, SUM(TO_NUMBER (v.DIAS)) as DIAS_PENDIENTES
FROM VACACIONES_PENDIENTES v, empleados_gral g, empleados_basic e
where e.cod_epl = g.cod_epl 
and v.cod_epl =g.cod_epl
group by v.cod_epl,g.email,  e.nom_epl ,  e.ape_epl
having SUM(TO_NUMBER (DIAS))>15
order by v.cod_epl";
	
	//FIN
	
$rh1 = $conn->Execute($qry1); 
while($row1 = $rh1->FetchRow()){
	
	$titulo1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>";
	
	$contenido1="Apreciado/a <strong>".$row1["NOM_EPL"]." ".$row1["APE_EPL"]."</strong>, <br><br>
<p style='text-align: justify;'>
Para Movistar Colombia es muy importante tu bienestar. Es por esto, que te invitamos a reunirte con tu Jefe y programar tus días de vacaciones para que disfrutes de unos merecidos días de descanso junto a tus seres queridos. <br><br>

Al corte del mes anterior, cuentas con ".$row1["DIAS_PENDIENTES"]." (días) acumulados. <br><br>

Para programar tus vacaciones haz clic <a href='https://".$ipvariable."/vacaciones/' style='color: #770003'>aquí</a>. <br><br>
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
         $mail->Subject = "Tienes un periodo o más de vacaciones pendiente por disfrutar"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 
			}
			
?>