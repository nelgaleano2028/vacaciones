<?php
session_start();

include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

$nomadmin = $_SESSION['nom'];

//validacion bd f
$consultaf = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['NOM_ADMIN'])){
$conn = $configf;

$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();

$empresa_real = $row58['EMPRESA'];
}
if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;

$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();

$empresa_real = $row58['EMPRESA'];
}
if(isset($rowa['NOM_ADMIN'])){
$conn = $config;

$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();

$empresa_real = $row58['EMPRESA'];
}
if(isset($rowt['NOM_ADMIN'])){
$conn = $configt;

$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 3";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();

$empresa_real = $row58['EMPRESA'];
}
//require_once('../lib/configdb.php');
require_once('class_incapacidades.php');
require_once('class_mailer.php');

global $conn;


$vacaciones=new vacaciones();

$dias = $_POST["diasc"];
$fecha_ini1 = $_POST["fecha_ini"];
$fecha_fin1 = $_POST["fecha_fin"];
$codigo = $_POST["codigo"];
$estado = $_POST["estado"];
$numero = $_POST["numero"];

$fecha_ini=date("m/d/Y",strtotime($fecha_ini1)); 

$fecha_fin=date("m/d/Y",strtotime($fecha_fin1)); 




$qry2="update incapacidades_tmp set fec_ini= TO_DATE ('$fecha_ini', 'MM-DD-YY'), fec_fin=TO_DATE ('$fecha_fin', 'MM-DD-YY'),dias=$dias, fec_ini_r=TO_DATE ('$fecha_ini', 'MM-DD-YY'), fec_fin_r=TO_DATE ('$fecha_fin', 'MM-DD-YY') where CNSCTVO='".$numero."'";



 				  
$rh2 = $conn->Execute($qry2); 




$qry3="select a.cod_jefe as COD_JEFE, b.nom_epl as NOM_EPL, b.cedula as CEDULA, b.ape_epl as APE_EPL, a.email as EMAIL from empleados_gral a, empleados_basic b where a.cod_epl='".$codigo."' and a.cod_epl=b.cod_epl";

	
	
				  
$rh3 = $conn->Execute($qry3); 

$row3 = $rh3->FetchRow();



$cod_jefe=$row3["COD_JEFE"];
$cedula_epl=$row3["CEDULA"];
$nombre=$row3["NOM_EPL"];
$apellido=$row3["APE_EPL"];
$email_epl=$row3["EMAIL"];

//QUERY PARA DATOS JEFE
	   
	   
	      //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$cod_jefe' ";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$cod_jefe' ";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$cod_jefe' ";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$cod_jefe' ";
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

$query5 = "select b.NOM_EPL AS JEFE , b.APE_EPL AS APEJEFE, b.CEDULA AS CEDULA, a.COD_JEFE AS COD_JEFE, a.email as EMAIL from empleados_gral a, empleados_basic b WHERE a.COD_EPL = b.COD_EPL and a.COD_EPL = '$cod_jefe'";
$rs = $conn->Execute($query5);
$row5 = $rs->fetchrow();
		$email_jefe=$row5["EMAIL"];
		$nom_jefe=$row5["JEFE"];
		$ape_jefe=$row5["APEJEFE"];
		$ced_jefe=$row5["CEDULA"];
	
//var_dump($cod_jefe);die("OK1");



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
 

	
	$contenido1="<p align='justify'><br>".$nombre." ".$apellido.", de acuerdo con la solicitud de su jefe, las fechas de incapacidades fueron editadas exitosamente, su nueva fecha es desde el ".date("d/m/Y",strtotime($fecha_ini))." hasta ".date("d/m/Y",strtotime($fecha_fin)).", ".$dias." d&iacute;as h&aacute;biles.<br><br> 
En ".$empresa_real." vivimos la mejor experiencia de construir el mejor lugar para trabajar en Colombia.
<br>&nbsp;<br>
Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. Si tienes alguna duda u observaci&oacute;n crea tu llamada a la Mesa Centro de Servicios Compartidos haciendo <a href='http://intranet/MesasAyuda/Control.aspx?idSer=SERVICIOS DE NOMINA&idSSer=VACACIONES&pt=NOVEDADES VACACIONES&id=2' style='color: #770003'>clic aqu&iacute;</a>.
<br><br> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, agregar el dominio @telefonica.com en la lista de remitentes seguros para que puedas ver la imagen. 
<br>&nbsp;<br>
Muchas Gracias por utilizar este servicio.<br>&nbsp;<br></p>";
	
	//$portal1="www.chec.com.co/";
	
	//$youtube1="www.youtube.com/checLATE";
	
	//$facebook1="www.facebook.com/chec.late";
	
	//$twitter1="twitter.com/chec_late";
	
	//$titulo1="Vive la experiencia de programar y disfrutar tus Vacaciones";
	
	//$imagen="";


	//echo $vacaciones->mensaje_solicitud($contenido,$portal,$youtube,$facebook,$twitter,$titulo);

 	
	

	$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	
	
	
	$contenido2="<p align='justify'><br>De acuerdo con su solicitud se le han modificado las fechas de incapacidades a ".$nombre." ".$apellido.", su nueva fecha es desde el ".date("d/m/Y",strtotime($fecha_ini))." hasta ".date("d/m/Y",strtotime($fecha_fin)).", ".$dias." d&iacute;as h&aacute;biles.<br>&nbsp;<br>
	En ".$empresa_real." vivimos la mejor experiencia de construir el mejor lugar para trabajar en Colombia.
	<br><br> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, agregar el dominio @telefonica.com en la lista de remitentes seguros para que puedas ver la imagen. <br>&nbsp;<br>

Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. Si tienes alguna duda u observaci&oacute;n crea tu llamada a la Mesa Centro de Servicios Compartidos haciendo <a href='http://intranet/MesasAyuda/Control.aspx?idSer=SERVICIOS DE NOMINA&idSSer=VACACIONES&pt=NOVEDADES VACACIONES&id=2' style='color: #770003'>clic aqu&iacute;</a>.
<br>&nbsp;<br>
Muchas Gracias por utilizar este servicio.<br>&nbsp;<br></p>";
	
	//$portal2="www.chec.com.co/";
	
	//$youtube2="www.youtube.com/checLATE";
	
	//$facebook2="www.facebook.com/chec.late";
	
	//$twitter2="twitter.com/chec_late";
	
	$titulo2="Incapacidades Programadas";
	
	
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
         //Estas dos líneas, cumplirían la funci&oacute;n de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
       $mail->AddAddress($email); // Esta es la direcci&oacute;n a donde enviamos $email(jefe o en tal caso nomina)
       
         
         $mail->IsHTML(true); // El correo se envía como HTML
         $mail->Subject = "Incapacidades Programadas"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		   $mail->Body = $content2; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 
		  ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$ced_jefe."','".$nom_jefe."','".$ape_jefe."',SYSDATE,'Incapacidades','".$email."','".$empresamail."')";
$conn->Execute($sqlmail);
		 
		 if($exito1){
		 	
			
		  //-----EMAIL-------
         //Estas dos líneas, cumplirían la funci&oacute;n de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
        $mail->AddAddress($email_epl); // Esta es la direcci&oacute;n a donde enviamos $email_epl
       
         
         $mail->Subject = "Confirmacion de Incapacidades Programadas"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $mail->Send(); // Envía el correo.
	 
	 ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$cedula_epl."','".$nombre."','".$apellido."',SYSDATE,'Incapacidades','".$email_epl."','".$empresamail."')";
$conn->Execute($sqlmail);
	 
		  }
	
	//header("Location:edicion.php?293874=75");
	
?>
<script>
window.location='vacaciones_gral_edith.php';
</script>