<?php
@session_start();
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');


$codiepl = $_POST["codigo"];;

   //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd tgt
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
}
//------------------------------FIN antidoto
require_once('class_horasextrasepl.php');
require_once('class_mailer.php');

global $conn;

$vacaciones=new vacaciones();

var_dump($_POST['fecha_ini']);
die('1');
while (sizeof($_POST['fecha_ini'])-1>=$i){
 
 
 $i++;	
}
$fec_emision_valida = date("Y/m/d",strtotime($_POST["fecha_ini"]));
$hoydos = date("Y/m/d");

if ($fec_emision_valida > $hoydos){
   header("Location:horasext.php?293875=81");
}

$sq5="select FEC_INI AS FEC_INI from horasextras_tmp where FEC_INI=to_date('".$_POST["fecha_ini"]."','DD-MM-YY') and cod_epl='$codiepl' and cod_con = '".$_POST["cod_con"]."'";
$rs5 = $conn->Execute($sq5);
$rows5= $rs5->fetchrow();

$sq="select FEC_FER AS FEC_FER from feriados where FEC_FER=to_date('".$_POST["fecha_ini"]."','DD-MM-YY')";
$rs1 = $conn->Execute($sq);
$rows1 = $rs1->fetchrow();

IF (isset($rows5['FEC_INI'])){
   header("Location:horasext.php?293875=80");
}

IF (empty($rows1['FEC_FER'])){
	IF($_POST["cod_con"]=='1119'OR$_POST["cod_con"]=='1118'OR$_POST["cod_con"]=='1009'OR$_POST["cod_con"]=='1008'){
	header("Location:horasext.php?293875=79");
	}
}

$fec_emisionfds= $_POST["fecha_ini"];
$fds = strtotime($fec_emisionfds);
if(date('l',$fds) != 'Sunday'){
	IF($_POST["cod_con"]=='1119'OR$_POST["cod_con"]=='1118'OR$_POST["cod_con"]=='1009'OR$_POST["cod_con"]=='1008'){
  header("Location:horasext.php?293875=78");
	}
}
	
	date_default_timezone_set('Europe/Madrid');
setlocale(LC_TIME, 'spanish');



if($_POST){
$dias = $_POST["dias[]"];
$fecha_ini = $_POST["fecha_ini[]"];
//$fecha_fin = $_POST["fecha_fin"];
$codigo = $_POST["codigo"];
$estado = $_POST["estado"];


$cod_con = $_POST["cod_con[]"];
$cod_aus = $_POST["cod_aus"];
$cod_cc2 = $_POST["cod_cc2"];


$qry2="select cen.cod_cc2  from empleados_basic emp, cargos car, centrocosto2 cen where emp.cod_car=car.cod_car and emp.cod_cc2=cen.cod_cc2 and cod_epl='".$codigo."'";
$rh0 = $conn->Execute($qry2); 
$row0 = $rh0->FetchRow();
$cod_cc2=$row0["COD_CC2"];


$qry1="select  count(*)+1 as CONSECUTIVO  from horasextras_tmp";
$rh1 = $conn->Execute($qry1);
$row1 = $rh1->FetchRow();

@$consecutivo=$row1["CONSECUTIVO"];


$qry2="insert into horasextras_tmp (cod_epl, fec_ini, fec_fin, estado, dias, fec_ini_r, fec_fin_r, cnsctvo, cod_con, cod_aus, cod_cc2, fec_solicitud)values('".$codigo."', TO_DATE ('$fecha_ini', 'DD-MM-YY'), TO_DATE ('$fecha_ini', 'DD-MM-YY'), '".$estado."', $dias, TO_DATE('$fecha_ini', 'DD-MM-YY'), TO_DATE ('$fecha_ini', 'DD-MM-YY'), $consecutivo, $cod_con, $cod_aus, '".$cod_cc2."', SYSDATE)";
 
//$rh2 = $conn->Execute($qry2);





$qry3="select a.cod_jefe as COD_JEFE, b.nom_epl as NOM_EPL, b.ape_epl as APE_EPL, a.email as EMAIL from empleados_gral a, empleados_basic b where a.cod_epl='".$codigo."' and a.cod_epl=b.cod_epl";

	
	
				  
$rh3 = $conn->Execute($qry3); 

$row3 = $rh3->FetchRow();



$cod_jefe=$row3["COD_JEFE"];
$nombre=$row3["NOM_EPL"];
$apellido=$row3["APE_EPL"];
$email_epl=$row3["EMAIL"];


//var_dump($cod_jefe);die("OK1");

if($cod_jefe!=NULL){

 //validacion bd f
$consultaf = "select email as EMAIL from empleados_gral where cod_epl='".$cod_jefe."'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select email as EMAIL from empleados_gral where cod_epl='".$cod_jefe."'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select email as EMAIL from empleados_gral where cod_epl='".$cod_jefe."'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select email as EMAIL from empleados_gral where cod_epl='".$cod_jefe."'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['EMAIL'])){
$conn = $configf;
$email_jefe=$rowf["EMAIL"];
}
if(isset($rowc['EMAIL'])){
$conn = $configc;
$email_jefe=$rowc["EMAIL"];
}
if(isset($rowa['EMAIL'])){
$conn = $config;
$email_jefe=$rowa["EMAIL"];
}
if(isset($rowt['EMAIL'])){
$conn = $configt;
$email_jefe=$rowt["EMAIL"];
}
//------------------------------FIN antidoto


}


//var_dump($email_jefe);die("OK2");

if($cod_jefe==NULL){
	
	$qry5="select cod_epl as COD_EPL from t_admin where privilegio='2'";
  
	$rh5 = $conn->Execute($qry5); 

	$row5 = $rh5->FetchRow();

	$cod_nomina=$row5["COD_EPL"];
	
	
	$qry6="select email as EMAIL from empleados_gral where cod_epl='".$cod_nomina."'";
	  
	$rh6 = $conn->Execute($qry6); 

	$row6 = $rh6->FetchRow();

	$email_nomina=$row6["EMAIL"];
	
	//var_dump($email_nomina);die("OK4");

}

//Query para la generacion de la IP dinamica

	$qry06="select DES_VAR as IP from parametros_nue where NOM_VAR='parametro_ip'";
	  
	$rh06 = $conn->Execute($qry06); 
	$row06 = $rh06->FetchRow();

	$ipvariable=$row06["IP"];


	$contenido1="<br>".$nombre." ".$apellido.", la solicitud de ".$dias." horas extras del dia ".date("d-m-Y",strtotime($fecha_ini)).", ha sido enviada a tu Lider para su aprobación.<br><br> Muchas Gracias por utilizar este servicio.<br><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo.<br><br><strong> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. </strong><br>&nbsp;<br>";
	
	
	$titulo1="REPORTE DE HORAS EXTRAS";
	
	//$imagen="";


	//echo $vacaciones->mensaje_solicitud($contenido,$portal,$youtube,$facebook,$twitter,$titulo);

 	
	
//OJO
	$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	
	
	
	$contenido2="<br>Se solicita el pago de ".$dias." horas extras para el empleado ".$nombre." ".$apellido.", registradas para el dia ".$fecha_ini.". , el empleado adjunta un informe a este correo.<br><br> Muchas Gracias por utilizar este servicio. <br><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo.<br><br><strong> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. </strong><br>&nbsp;<br>";
	
	
	
	$titulo2="REPORTE DE HORAS EXTRAS";
	
	//OJO
	$content2=$vacaciones->mensaje_solicitud($contenido2,$titulo2);
	//$content="Es bien";
	
	
	
	
	if($email_jefe==NULL){
	
		$email=$email_nomina;
	}else{
		$email=$email_jefe;
		}
	
	//var_dump($email);die("");
	
	
	
	$mail= new mailer();
	
	$varname = $_FILES['archivo']['name'];
	$vartemp = $_FILES['archivo']['tmp_name'];
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
        //$mail->AddAddress('vladimir.bello@talentsw.com'); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
		$mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         
			   $mail->AddAttachment($vartemp,$varname);
		   
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "REPORTE DE HORAS EXTRAS"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		  
		   $mail->Body = $content2; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 
		 if($exito1){
		 	
			
		  //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
        //$mail->AddAddress('vladimir.bello@talentsw.com'); // Esta es la dirección a donde enviamos $email_epl
       $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
         $mail->Subject = "REPORTE DE HORAS EXTRAS"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $mail->Send(); // Envía el correo.
	 // adjunta files/imagen.jpg
	//	$mail->AddEmbeddedImage('', '');
		//$mail->AddAttachment('imagen.jpg', 'imagen.jpg'); 
		  }
		
	

	
header("Location:horasext.php?293875=76");
}else{ header("Location:horasext.php");   
}
?>