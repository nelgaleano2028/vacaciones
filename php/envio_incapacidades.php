<?php
@session_start();
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

$codiepl = $_POST["cod_epl"];;

   //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codiepl' and estado = 'A'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codiepl' and estado = 'A'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codiepl' and estado = 'A'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codiepl' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
$empresamail='FUNDACION';
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
$empresamail='CONFIDENCIAL';
}
if(isset($rowa['CONTEO'])){
$conn = $config;
$empresamail='TELMOVIL';
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
$empresamail='TGT';
}
//------------------------------FIN antidoto
require_once('class_incapacidades.php');
require_once('class_mailer.php');

global $conn;
/*
$sql = "INSERT INTO CLICKS (TABLA, CLICK, FECHA) VALUES ('VACACIONES','1',SYSDATE)";
$conn->Execute($sql);
*/
$vacaciones=new vacaciones();

$query154 = "select sexo as SEXO from empleados_gral where cod_epl='".$codiepl."'";
$rs154 = $conn->Execute($query154);
$row154 = $rs154->fetchrow();

$row154["SEXO"];
	
	date_default_timezone_set('Europe/Madrid');
setlocale(LC_TIME, 'spanish');


if($_POST["cod_aus"]=='F' && $row154["SEXO"] == 'M'){
header("Location:incapacidades.php?293875=77");   
}
if($_POST["cod_aus"]=='M' && $row154["SEXO"] == 'F'){
header("Location:incapacidades.php?293875=77");   
}

if($_POST["cod_aus"]=='M' && $row154["SEXO"] == 'M'){
	$cod_aus='3';
}elseif($_POST["cod_aus"]=='F' && $row154["SEXO"] == 'F'){
	$cod_aus='3';
}else{
	$cod_aus = $_POST["cod_aus"];
}

$dias = $_POST["dias"];
$fecha_ini = $_POST["fecha_ini"];
$fecha_fin = $_POST["fecha_fin"];
$codigo = $_POST["cod_epl"];
$estado = $_POST["estado"];

$cod_con=$_POST["cod_con"];
//$cod_cc2 = $_POST["cod_cc2"];

$qry2="select cen.cod_cc2  from empleados_basic emp, cargos car, centrocosto2 cen where emp.cod_car=car.cod_car and emp.cod_cc2=cen.cod_cc2 and cod_epl='".$codigo."'";
$rh0 = $conn->Execute($qry2); 
$row0 = $rh0->FetchRow();
$cod_cc2=$row0["COD_CC2"];


$qry1="select  count(*)+1 as CONSECUTIVO  from incapacidades_tmp";
$rh1 = $conn->Execute($qry1);
$row1 = $rh1->FetchRow();

$consecutivo=$row1["CONSECUTIVO"];
//var_dump($consecutivo);die("");

/*
var_dump($codigo);
var_dump('------------------');
var_dump($cod_aus);
*/


$qry2="insert into incapacidades_tmp (cod_epl, fec_ini, fec_fin, estado, dias, fec_ini_r, fec_fin_r, cnsctvo, cod_con, cod_aus, cod_cc2, fec_solicitud)values('".$codigo."', TO_DATE ('$fecha_ini', 'DD-MM-YY'), TO_DATE ('$fecha_fin', 'DD-MM-YY'), '".$estado."', $dias, TO_DATE('$fecha_ini', 'DD-MM-YY'), TO_DATE ('$fecha_fin', 'DD-MM-YY'), $consecutivo,'00', $cod_aus, '".$cod_cc2."', SYSDATE)";
 
$rh2 = $conn->Execute($qry2);

$qry3="select a.cod_jefe as COD_JEFE, b.cedula as CEDULA, b.nom_epl as NOM_EPL, b.ape_epl as APE_EPL, a.email as EMAIL from empleados_gral a, empleados_basic b where a.cod_epl='".$codigo."' and a.cod_epl=b.cod_epl";

$rh3 = $conn->Execute($qry3);

$row3 = $rh3->FetchRow();

$cod_jefe=$row3["COD_JEFE"];
$nombre=$row3["NOM_EPL"];
$apellido=$row3["APE_EPL"];
$email_epl=$row3["EMAIL"];
$cedula_epl=$row3["CEDULA"];

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
$empresamailjef='FUNDACION';
}
if(isset($rowc['EMAIL'])){
$conn = $configc;
$email_jefe=$rowc["EMAIL"];
$empresamailjef='CONFIDENCIAL';
}
if(isset($rowa['EMAIL'])){
$conn = $config;
$email_jefe=$rowa["EMAIL"];
$empresamailjef='TELMOVIL';
}
if(isset($rowt['EMAIL'])){
$conn = $configt;
$email_jefe=$rowt["EMAIL"];
$empresamailjef='TGT';
}
//------------------------------FIN antidoto

//datos jefe
$qrydatosjefe = "select CEDULA AS CEDULA, NOM_EPL AS NOM_EPL, APE_EPL AS APE_EPL from empleados_basic where cod_epl='".$cod_jefe."'";
$rs = $conn->Execute($qrydatosjefe);
$rowjef = $rs->fetchrow();
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


	$contenido1="<br> Apreciad@ ".$nombre." ".$apellido."<br><br> Apreciado colaborador fue reportada ausencia por incapacidad por ".$dias." dias a partir del ".$fecha_ini.". <br><br> Por favor recuerda que, debes radicar tu incapacidad / Licencia de Maternidad / Licencia de Paternidad en la Mesa de Servicios al colaborador, por el empleado, generalista o Asesor de Salud en el Trabajo para las regionales en un máximo de 5 dias hábiles a partir de la fecha de inicio de la incapacidad. <br><br> Colombia Telecomunicaciones reconoce inicialmente el 100% del valor de la incapacidad, es compromiso de todos recuperar los valores a cargo de la EPS. <br><br> Te invitamos a conocer la política de ausentismo de la compañia, en el siguiente link:  http://intranettelefonica/org/rrhhco/syso/Documents/POLITICA%20DE%20AUSENTISMO%202014%20(2)%20(2).pdf <br><br><br> Jefatura de Nómina <br> Servicios Económicos";
	
	
	$titulo1="REPORTE DE AUSENCIA POR INCAPACIDAD";
	
	//$imagen="";

	//echo $vacaciones->mensaje_solicitud($contenido,$portal,$youtube,$facebook,$twitter,$titulo);

//OJO
	$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	$contenido2="<br> Apreciad@ ".$nombre." ".$apellido."<br><br> Apreciado colaborador fue reportada ausencia por incapacidad por ".$dias." dias a partir del ".$fecha_ini.". <br><br> Por favor recuerda que, debes radicar tu incapacidad / Licencia de Maternidad / Licencia de Paternidad en la Mesa de Servicios al colaborador, por el empleado, generalista o Asesor de Salud en el Trabajo para las regionales en un máximo de 5 dias hábiles a partir de la fecha de inicio de la incapacidad. <br><br> Colombia Telecomunicaciones reconoce inicialmente el 100% del valor de la incapacidad, es compromiso de todos recuperar los valores a cargo de la EPS. <br><br> Te invitamos a conocer la política de ausentismo de la compañia, en el siguiente link:  http://intranettelefonica/org/rrhhco/syso/Documents/POLITICA%20DE%20AUSENTISMO%202014%20(2)%20(2).pdf <br><br><br> Jefatura de Nómina <br> Servicios Económicos";
	
	$titulo2="REPORTE DE AUSENCIA POR INCAPACIDAD";
	
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
	
		 //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
         $mail->AddAddress($email); // Esta es la dirección a donde enviamos $email(jefe o en tal caso nomina)
		 
         
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "REPORTE DE AUSENCIA POR INCAPACIDAD"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		   $mail->Body = $content2; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 		
	   ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$rowjef["CEDULA"]."','".$rowjef["NOM_EPL"]."','".$rowjef["APE_EPL"]."',SYSDATE,'Incapacidades','".$email."','".$empresamailjef."')";
$conn->Execute($sqlmail);
		 
		 if($exito1){
		 	
		  //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
        $mail->AddAddress($email_epl); // Esta es la dirección a donde enviamos $email_epl
        
         
         $mail->Subject = "REPORTE DE AUSENCIA POR INCAPACIDAD"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $mail->Send(); // Envía el correo.
		 
		 ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$cedula_epl."','".$nombre."','".$apellido."',SYSDATE,'Incapacidades','".$email_epl."','".$empresamail."')";
$conn->Execute($sqlmail);
	 // adjunta files/imagen.jpg
	//	$mail->AddEmbeddedImage('', '');
		//$mail->AddAttachment('imagen.jpg', 'imagen.jpg'); 
		  }
	
header("Location:incapacidades.php?293875=76");

?>