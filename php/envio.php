<?php
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');
@session_start();

$codiepl = $_SESSION['ced'];

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

//validacion bd t
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowt['CONTEO'])){
$conn = $configt;
$empresamail='TGT';
}
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

//------------------------------FIN antidoto
require_once('class_vacaciones.php');
require_once('class_mailer.php');

global $conn;

$sql = "INSERT INTO CLICKS (TABLA, CLICK, FECHA) VALUES ('VACACIONES','1',SYSDATE)";
$conn->Execute($sql);

$vacaciones=new vacaciones();

$query154 = "select fec_cie AS CIERRE, fec_pag AS PAGO from  cierre_novpag c, 
(select 
   case when (case when  to_date(sysdate, 'YY-MM-DD') > c.fec_cie 
                then c.cod_per+1         
                 else c.cod_per end ) >12 then 1 
        else 
             (case when  to_date(sysdate, 'YY-MM-DD') > c.fec_cie 
                then c.cod_per+1         
                else c.cod_per end )
     end cod_per,
     
   case when (case when  to_date(sysdate, 'YY-MM-DD') > fec_cie 
              then c.cod_per+1  
              else c.cod_per end) >12 
        then c.ano+1 
        else c.ano end ano
from cierre_novpag c, periodos p
where to_date(sysdate, 'YY-MM-DD') between p.fec_ini and p.fec_fin
and c.ano =p.ano
and c.cod_per = p.cod_per
and p.tip_per = 3 ) b
where c.cod_per = b.cod_per 
and c.ano = b.ano";
$rs154 = $conn->Execute($query154);
$row154 = $rs154->fetchrow();

	  
$row154["CIERRE"];	
$row154["PAGO"];		  
	
	date_default_timezone_set('Europe/Madrid');
setlocale(LC_TIME, 'spanish');
$fecha = strftime(" %A, %d de %B de %Y",strtotime($row154["CIERRE"]));


if($_POST){
$dias = $_POST["dias"];
$fecha_ini = $_POST["fecha_ini"];
$fecha_fin = $_POST["fecha_fin"];
$codigo = $_POST["codigo"];
$estado = $_POST["estado"];


$cod_con = $_POST["cod_con"];
$cod_aus = $_POST["cod_aus"];
$cod_cc2 = $_POST["cod_cc2"];

$qry1="select  count(*)+1 as CONSECUTIVO  from ausencias_tmp";
$rh1 = $conn->Execute($qry1);
$row1 = $rh1->FetchRow();

@$consecutivo=$row1["CONSECUTIVO"];
//var_dump($consecutivo);die("");




$qry2="insert into ausencias_tmp (cod_epl, fec_ini, fec_fin, estado, dias, fec_ini_r, fec_fin_r, cnsctvo, cod_con, cod_aus, cod_cc2, fec_solicitud)values('".$codigo."', TO_DATE ('$fecha_ini', 'DD-MM-YY'), TO_DATE ('$fecha_fin', 'DD-MM-YY'), '".$estado."', $dias, TO_DATE('$fecha_ini', 'DD-MM-YY'), TO_DATE ('$fecha_fin', 'DD-MM-YY'), $consecutivo, $cod_con, $cod_aus, '".$cod_cc2."', SYSDATE)";


$rh2 = $conn->Execute($qry2);





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

//validacion bd 
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


	$contenido1="<br>".$nombre." ".$apellido.", la solicitud de vacaciones comprendidas entre el ".date("d-m-Y",strtotime($fecha_ini))." hasta ".date("d-m-Y",strtotime($fecha_fin))." para un total de ".$dias." dias hábiles, ha sido enviada a tu Lider para su aprobación, La aprobación de tu lider debe realizarse antes del cierre de novedades de nómina, ".$fecha.".<br><br> Muchas Gracias por utilizar este servicio.<br><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. Si tienes alguna duda u observacion crea tu llamada a la Mesa Centro de Servicios Compartidos haciendo <a href='http://intranet/MesasAyuda/Control.aspx?idSer=SERVICIOS DE NOMINA&idSSer=VACACIONES&pt=NOVEDADES VACACIONES&id=2' style='color: #770003'>clic aquí</a>.<br><br><strong> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. </strong><br>&nbsp;<br>";
	
	
	$titulo1="Vive la experiencia de programar y disfrutar tus Vacaciones";
	
	//$imagen="";


	//echo $vacaciones->mensaje_solicitud($contenido,$portal,$youtube,$facebook,$twitter,$titulo);

 	
	

	$content1=$vacaciones->mensaje_solicitud($contenido1,$titulo1);
	
	
	
	
	$contenido2="<br>Se solicitan las vacaciones para el empleado ".$nombre." ".$apellido.", comprendidas entre el ".$fecha_ini." hasta ".$fecha_fin." para un total de ".$dias." dias hábiles. Es importante contar con tu aprobación antes del cierre de novedades de nómina, ".$fecha.".<br><br> Para ver las solicitudes de tus colaboradores ingresa <a href='https://".$ipvariable."/vacaciones/php/prueba.php?us=q1e5d69e&pa=g86r5h5f' style='color: #770003'>aquí</a> <br><br> Muchas Gracias por utilizar este servicio. <br><br>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. Si tienes alguna duda u observacion crea tu llamada a la Mesa Centro de Servicios Compartidos haciendo <a href='http://intranet/MesasAyuda/Control.aspx?idSer=SERVICIOS DE NOMINA&idSSer=VACACIONES&pt=NOVEDADES VACACIONES&id=2' style='color: #770003'>clic aquí</a>.<br><br><strong> Ten en cuenta de habilitar en el mensaje de advertencia que te aparece en la parte superior del mail, “agregar el dominio @telefonica.com en la lista de remitentes seguros” para que puedas ver la imagen. </strong><br>&nbsp;<br>";
	
	
	
	$titulo2="Vive la experiencia de programar y disfrutar tus Vacaciones";
	
	
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
         $mail->Subject = "Vacaciones Telefonica - ".$nombre." ".$apellido." - Solicitud Inicial"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		   $mail->Body = $content2; // Mensaje a enviar
         $exito1 = $mail->Send(); // Envía el correo.
		 
		 $mail->ClearAddresses();
		 
		 ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$rowjef["CEDULA"]."','".$rowjef["NOM_EPL"]."','".$rowjef["APE_EPL"]."',SYSDATE,'Vacaciones','".$email."','".$empresamailjef."')";
$conn->Execute($sqlmail);
		 
		 if($exito1){
		 	
			
		  //-----EMAIL-------
         //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
        $mail->AddAddress($email_epl); // Esta es la dirección a donde enviamos $email_epl
		
         
         
         $mail->Subject = "Vacaciones Telefonica - ".$nombre." ".$apellido." - Solicitud Inicial"; // Este es el titulo del email.
           //-----FIN EMAIL-----
		   
		 $mail->Body = $content1; // Mensaje a enviar
         $mail->Send(); // Envía el correo.
		 
		 ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$_SESSION['ced']."','".$_SESSION['nombre']."','".$_SESSION['ape']."',SYSDATE,'Vacaciones','".$email_epl."','".$empresamail."')";
$conn->Execute($sqlmail);
		 
	 // adjunta files/imagen.jpg
	//	$mail->AddEmbeddedImage('', '');
		//$mail->AddAttachment('imagen.jpg', 'imagen.jpg'); 
		  }
		
	

	
header("Location:vacaciones.php?293875=76");
}else{ header("Location:vacaciones.php");   
}
?>