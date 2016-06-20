<?php
@session_start();

//--------------------------------------------- BASE DE DATOS 2 ----------------------------------------
include_once('../lib/configdbf.php');

$configf;
$empresaf='FUNDACION';
//------------------------------FIN antidoto
require_once('../php/class_correoprogramado2.php');
require_once('../php/class_mailer.php');

global $conn;
$vacaciones=new vacaciones();

$titulo1="<strong>Apreciado/a,</strong>";

			$contenido1.="<strong>Apreciado/a,</strong><BR><BR>
	<p style='text-align: justify;'>
	A continuación, te presentamos la relación de días de vacaciones pendientes por programar de los integrantes de tu equipo de trabajo. <BR><BR>
	</p>
	<p style='text-align: justify;'>
	Ten en cuenta, que cuando un empleado/a tiene más de un periodo de vacaciones pendiente por disfrutar, impacta negativamente no sólo en la productividad, sino en los resultados económicos del negocio. <BR><BR>
	</p>
	<table border='1' align='center' style='width:100%; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;
	' >
		<tr style='text-align: center;'>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Cédula
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Nombre Colaborador/a
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Fecha de ingreso
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Días pendientes por disfrutar
	</td>
	</tr>
	</table>
	"; 			
	
//Query DATOS

$qry1="select cod_jefe AS CODIGO_JEFE, usu_red as EMAIL_JEFE from jefes where cod_jefe in (
select  j.cod_jefe
from  empleados_gral g, empleados_basic e, jefes j, vacaciones_pendientes v
where e.cod_epl =g.cod_epl
and g.cod_jefe = j.cod_jefe
and e.cod_epl = v.cod_epl
and e.estado ='A'
and usu_red <> 'ariel.ponton@telefonica.com'
and usu_red <> 'ALFONSO.PALACIO@telefonica.com'
group by e.cedula, e.nom_epl, e.ape_epl, j.usu_red, e.fec_ing, e.cod_epl,j.cod_jefe
having sum (dias)>15
)
order by cod_jefe
";
$conn = $configf;
$rh = $conn->Execute($qry1); 
	while($row = $rh->FetchRow()){
		
		$cont ++;
		
		if($cont > 1){
			
			$contenido1.="<strong>Apreciado/a,</strong><BR><BR>
	<p style='text-align: justify;'>
	A continuación, te presentamos la relación de días de vacaciones pendientes por programar de los integrantes de tu equipo de trabajo. <BR><BR>
	</p>
	<p style='text-align: justify;'>
	Ten en cuenta, que cuando un empleado/a tiene más de un periodo de vacaciones pendiente por disfrutar, impacta negativamente no sólo en la productividad, sino en los resultados económicos del negocio. <BR><BR>
	</p>
	<table border='1' align='center' style='width:100%; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;
	' >
		<tr style='text-align: center;'>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Cédula
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Nombre Colaborador/a
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Fecha de ingreso
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Días pendientes por disfrutar
	</td>	
	</tr>
	</table>
	"; 			
	}				
		$codigojefe1=$row["CODIGO_JEFE"];		

		$qry2="select e.cedula AS COD_EPL, e.nom_epl||' '||e.ape_epl AS NOMBRES,  e.fec_ing AS FEC_ING,sum (dias) PENDIENTES
		from  empleados_gral g, empleados_basic e, jefes j, vacaciones_pendientes v
		where e.cod_epl =g.cod_epl
		and g.cod_jefe = j.cod_jefe
		and j.cod_jefe = '$codigojefe1'
		and e.estado ='A'
		and e.cod_epl = v.cod_epl
		group by e.cedula, e.nom_epl, e.ape_epl, j.usu_red, e.fec_ing, e.cod_epl
		having sum (dias)>15
		order by e.nom_epl
		";
	$conn = $configf;
	$rh2 = $conn->Execute($qry2);
	$i=0;
	
	while($row2 = $rh2->FetchRow()){
	$contenido1.="<table border='1' align='center' style='width:100%; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;
	' >
		<tr style='text-align: center;'>
	<td style= width:20%;>
	".$row2["COD_EPL"]."
	</td>
	<td style= width:20%;>
	".$row2["NOMBRES"]."
	</td>
	<td style= width:20%;>
	".$row2["FEC_ING"]."
	</td>
	<td style= width:20%;>
	".$row2["PENDIENTES"]."
	</td>
		</tr>
		</table>
		";
		
		$lista[] = array("CODIGO"=>@$row2["COD_EPL"]);
		$contenido20.=$lista[$i]["CODIGO"];
		$i++;
	}
	  // if(@$lista==null){
		// echo "<tr>
		// <td colspan='5'>No hay datos a Mostrar</tr>";
    // }else{		
		// $i=0;
		// while($i<count($lista)){
		
			$contenido1.="<span style='color:#FFFFFF'> $contenido20 - $empresaf - $codigojefe1 <BR></span>";
			$contenido1.="</br></br> <strong>Jefatura de Nómina</strong>";
			// $i++;
		// }
	// }
	//$lista[]=null;
	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	//$email = 'nags_dcm2028@hotmail.com';
	//$email = 'diego.gomezpinto@telefonica.com';
	//$email = 'tyt.correoprueba@gmail.com';
	$email = $row["EMAIL_JEFE"];
	
		$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Vacaciones pendientes por disfrutar de tu personal a cargo"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();

		 $contenido1 = "";
		 $contenido20 = "";
		 $lista = "";
	}

//--------------------------------------------- BASE DE DATOS 3 ----------------------------------------

include_once('../lib/configdbc.php');

$configc;
$empresac='TELCONFI';
//------------------------------FIN antidoto
require_once('../php/class_correoprogramado2.php');
require_once('../php/class_mailer.php');

global $conn;
$vacaciones=new vacaciones(); 
	
$titulo1="<strong>Apreciado/a,</strong>";	

//Query DATOS

$qry1="select cod_jefe AS CODIGO_JEFE, usu_red as EMAIL_JEFE from jefes where cod_jefe in (
select  j.cod_jefe
from  empleados_gral g, empleados_basic e, jefes j, vacaciones_pendientes v
where e.cod_epl =g.cod_epl
and g.cod_jefe = j.cod_jefe
and e.cod_epl = v.cod_epl
and e.estado ='A'
and usu_red <> 'ariel.ponton@telefonica.com'
and usu_red <> 'ALFONSO.PALACIO@telefonica.com'
group by e.cedula, e.nom_epl, e.ape_epl, j.usu_red, e.fec_ing, e.cod_epl,j.cod_jefe
having sum (dias)>15
)
order by cod_jefe
";
$conn = $configc;
$rh = $conn->Execute($qry1); 
	while($row = $rh->FetchRow()){
		
		$cont ++;
		
		if($cont > 1){
		
			$contenido1.="<strong>Apreciado/a,</strong><BR><BR>
	<p style='text-align: justify;'>
	A continuación, te presentamos la relación de días de vacaciones pendientes por programar de los integrantes de tu equipo de trabajo. <BR><BR>
	</p>
	<p style='text-align: justify;'>
	Ten en cuenta, que cuando un empleado/a tiene más de un periodo de vacaciones pendiente por disfrutar, impacta negativamente no sólo en la productividad, sino en los resultados económicos del negocio. <BR><BR>
	</p>
	<table border='1' align='center' style='width:100%; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;
	' >
		<tr style='text-align: center;'>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Cédula
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Nombre Colaborador/a
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Fecha de ingreso
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Días pendientes por disfrutar
	</td>
	</tr>
	</table>
	"; 			
	}				
		$codigojefe1=$row["CODIGO_JEFE"];		

		$qry2="select e.cedula AS COD_EPL, e.nom_epl||' '||e.ape_epl AS NOMBRES,  e.fec_ing AS FEC_ING,sum (dias) PENDIENTES
		from  empleados_gral g, empleados_basic e, jefes j, vacaciones_pendientes v
		where e.cod_epl =g.cod_epl
		and g.cod_jefe = j.cod_jefe
		and j.cod_jefe = '$codigojefe1'
		and e.estado ='A'
		and e.cod_epl = v.cod_epl
		group by e.cedula, e.nom_epl, e.ape_epl, j.usu_red, e.fec_ing, e.cod_epl
		having sum (dias)>15
		order by e.nom_epl
		";
	
	$conn = $configc;
	$rh2 = $conn->Execute($qry2);
	$i=0;
	while($row2 = $rh2->FetchRow()){
		$contenido1.="<table border='1' align='center' style='width:100%; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;
		' >
			<tr style='text-align: center;'>
		<td style= width:20%;>
		".$row2["COD_EPL"]."
		</td>
		<td style= width:20%;>
		".$row2["NOMBRES"]."
		</td>
		<td style= width:20%;>
		".$row2["FEC_ING"]."
		</td>
		<td style= width:20%;>
		".$row2["PENDIENTES"]."
		</td>
		</tr>
		</table>
		";
		$lista[] = array("CODIGO"=>@$row2["COD_EPL"]);
		$contenido20.=$lista[$i]["CODIGO"];
		$i++;
	}
	
	
	$contenido1.="<span style='color:#FFFFFF'> $contenido20 - $empresac - $codigojefe1 <BR></span>";
	$contenido1.="</br></br> <strong>Jefatura de Nómina</strong>";

	@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	
	//$email = 'nelgaleano.2028@gmail.com';
	//$email = 'diego.gomezpinto@telefonica.com';
	$email = $row["EMAIL_JEFE"];
	//$email = 'tyt.correoprueba@gmail.com';
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Vacaciones pendientes por disfrutar de tu personal a cargo"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();

		 $contenido1 = "";
		 $contenido20 = "";
		 $lista = "";
}

//--------------------------------------------- BASE DE DATOS 4 ----------------------------------------

include_once('../lib/configdbt.php');

$configt;
$empresat='TGT';
//------------------------------FIN antidoto
require_once('../php/class_correoprogramado2.php');
require_once('../php/class_mailer.php');

global $conn;
$vacaciones=new vacaciones();

$titulo1="<strong>Apreciado/a,</strong>";	

//Query DATOS

$qry1="select cod_jefe AS CODIGO_JEFE, usu_red as EMAIL_JEFE from jefes where cod_jefe in (
select  j.cod_jefe
from  empleados_gral g, empleados_basic e, jefes j, vacaciones_pendientes v
where e.cod_epl =g.cod_epl
and g.cod_jefe = j.cod_jefe
and e.cod_epl = v.cod_epl
and e.estado ='A'
and usu_red <> 'ariel.ponton@telefonica.com'
and usu_red <> 'ALFONSO.PALACIO@telefonica.com'
group by e.cedula, e.nom_epl, e.ape_epl, j.usu_red, e.fec_ing, e.cod_epl,j.cod_jefe
having sum (dias)>15
)
order by cod_jefe
";
$conn = $configt;
$rh = $conn->Execute($qry1); 
	while($row = $rh->FetchRow()){
		
		$cont ++;
		
		if($cont > 1){
			$contenido1.="<strong>Apreciado/a,</strong><BR><BR>
	<p style='text-align: justify;'>
	A continuación, te presentamos la relación de días de vacaciones pendientes por programar de los integrantes de tu equipo de trabajo. <BR><BR>
	</p>
	<p style='text-align: justify;'>
	Ten en cuenta, que cuando un empleado/a tiene más de un periodo de vacaciones pendiente por disfrutar, impacta negativamente no sólo en la productividad, sino en los resultados económicos del negocio. <BR><BR>
	</p>
	<table border='1' align='center' style='width:100%; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;
	' >
		<tr style='text-align: center;'>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Cédula
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Nombre Colaborador/a
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Fecha de ingreso
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Días pendientes por disfrutar
	</td>
	</tr>
	</table>
	"; 			
	}				
		$codigojefe1=$row["CODIGO_JEFE"];		

		$qry2="select e.cedula AS COD_EPL, e.nom_epl||' '||e.ape_epl AS NOMBRES,  e.fec_ing AS FEC_ING,sum (dias) PENDIENTES
		from  empleados_gral g, empleados_basic e, jefes j, vacaciones_pendientes v
		where e.cod_epl =g.cod_epl
		and g.cod_jefe = j.cod_jefe
		and j.cod_jefe = '$codigojefe1'
		and e.estado ='A'
		and e.cod_epl = v.cod_epl
		group by e.cedula, e.nom_epl, e.ape_epl, j.usu_red, e.fec_ing, e.cod_epl
		having sum (dias)>15
		order by e.nom_epl
		";
	
	$conn = $configt;
	$rh2 = $conn->Execute($qry2);
	$i=0;
while($row2 = $rh2->FetchRow()){
	$contenido1.="<table border='1' align='center' style='width:100%; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;
	' >
		<tr style='text-align: center;'>
	<td style= width:20%;>
	".$row2["COD_EPL"]."
	</td>
	<td style= width:20%;>
	".$row2["NOMBRES"]."
	</td>
	<td style= width:20%;>
	".$row2["FEC_ING"]."
	</td>
	<td style= width:20%;>
	".$row2["PENDIENTES"]."
	</td>
		</tr>
		</table>
		";
	$lista[] = array("CODIGO"=>@$row2["COD_EPL"]);
		$contenido20.=$lista[$i]["CODIGO"];
		$i++;
	}
	
		$contenido1.="<span style='color:#FFFFFF'> $contenido20 - $empresat - $codigojefe1 <BR></span>";
		$contenido1.="</br></br> <strong>Jefatura de Nómina</strong>";

		@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
		//$email = 'nelgaleano.2028@gmail.com';
		//$email = 'diego.gomezpinto@telefonica.com';
		$email = $row["EMAIL_JEFE"];
		//$email = 'tyt.correoprueba@gmail.com';
	
		$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Vacaciones pendientes por disfrutar de tu personal a cargo"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();

		 $contenido1 = "";
		 $contenido20 = "";
		 $lista = "";
	
}

//-------------------------------------------- BASE DE DATOS 1 ----------------------------------------

include_once('../lib/configdb.php');

$config;
$empresag='TELMOVIL';
//------------------------------FIN antidoto
require_once('../php/class_correoprogramado2.php');
require_once('../php/class_mailer.php');

global $conn;
$vacaciones=new vacaciones();

$titulo1="<strong>Apreciado/a,</strong>";	
	
//Query DATOS

$qry1="select cod_jefe AS CODIGO_JEFE, usu_red as EMAIL_JEFE from jefes where cod_jefe in (
select  j.cod_jefe
from  empleados_gral g, empleados_basic e, jefes j, vacaciones_pendientes v
where e.cod_epl =g.cod_epl
and g.cod_jefe = j.cod_jefe
and e.cod_epl = v.cod_epl
and e.estado ='A'
and usu_red <> 'ariel.ponton@telefonica.com'
and usu_red <> 'ALFONSO.PALACIO@telefonica.com'
group by e.cedula, e.nom_epl, e.ape_epl, j.usu_red, e.fec_ing, e.cod_epl,j.cod_jefe
having sum (dias)>15
)
order by cod_jefe
";
$conn = $config;
$rh = $conn->Execute($qry1); 
	while($row = $rh->FetchRow()){
		
		$cont ++;
		
		if($cont > 1){
			
			$contenido1.="<strong>Apreciado/a,</strong><BR><BR>
	<p style='text-align: justify;'>
	A continuación, te presentamos la relación de días de vacaciones pendientes por programar de los integrantes de tu equipo de trabajo. <BR><BR>
	</p>
	<p style='text-align: justify;'>
	Ten en cuenta, que cuando un empleado/a tiene más de un periodo de vacaciones pendiente por disfrutar, impacta negativamente no sólo en la productividad, sino en los resultados económicos del negocio. <BR><BR>
	</p>
	<table border='1' align='center' style='width:100%; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;
	' >
		<tr style='text-align: center;'>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Cédula
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Nombre Colaborador/a
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Fecha de ingreso
	</td>
	<td bgcolor='#ADD8E6' style='font-weight: bold; width:20%;'>
	Días pendientes por disfrutar
	</td>
	</tr>
	</table>
	"; 			
	}				
		$codigojefe1=$row["CODIGO_JEFE"];		

		$qry2="select e.cedula AS COD_EPL, e.nom_epl||' '||e.ape_epl AS NOMBRES,  e.fec_ing AS FEC_ING,sum (dias) PENDIENTES
		from  empleados_gral g, empleados_basic e, jefes j, vacaciones_pendientes v
		where e.cod_epl =g.cod_epl
		and g.cod_jefe = j.cod_jefe
		and j.cod_jefe = '$codigojefe1'
		and e.estado ='A'
		and e.cod_epl = v.cod_epl
		group by e.cedula, e.nom_epl, e.ape_epl, j.usu_red, e.fec_ing, e.cod_epl
		having sum (dias)>15
		order by e.nom_epl
		";
	$conn = $config;
	$rh2 = $conn->Execute($qry2);
	$i=0;
	while($row2 = $rh2->FetchRow()){
	$contenido1.="<table border='1' align='center' style='width:100%; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;
	' >
		<tr style='text-align: center;'>
	<td style= width:20%;>
	".$row2["COD_EPL"]."
	</td>
	<td style= width:20%;>
	".$row2["NOMBRES"]."
	</td>
	<td style= width:20%;>
	".$row2["FEC_ING"]."
	</td>
	<td style= width:20%;>
	".$row2["PENDIENTES"]."
	</td>
		</tr>
		</table>
		";
	$lista[] = array("CODIGO"=>@$row2["COD_EPL"]);
		$contenido20.=$lista[$i]["CODIGO"];
		$i++;
	}
	
		$contenido1.="<span style='color:#FFFFFF'> $contenido20 - $empresag - $codigojefe1 <BR></span>";
		$contenido1.="</br></br> <strong>Jefatura de Nómina</strong>";

		@$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
		//$email = 'nelgaleano.2028@gmail.com';
		//$email = 'diego.gomezpinto@telefonica.com';
		$email = $row["EMAIL_JEFE"];
		//$email = 'tyt.correoprueba@gmail.com';
	
	$mail= new mailer();
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Vacaciones pendientes por disfrutar de tu personal a cargo"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();

		 $contenido1 = "";
		 $contenido20 = "";
		 $lista = "";
}

?>