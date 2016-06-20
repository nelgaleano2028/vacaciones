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

/*
Contactenos V4 - 26/06/2011 
este formulario utiliza la clase PHPMailer para el envio y proceso.
Es solo un ejemplo de una posible implementacion de PHPMailer
La clase se puede descargar desde http://phpmailer.sourceforge.net/
Junto con mas ejemplos y documentacion.

Para preguntas y soporte sobre este formulario se pueden utilizar los comentarios.
También se pueden hacer consultas via Twitter: @alfonsocatron
*/

/*
NOTA: 
este archivo debe estar acompañado de una carpeta
con el nombre "archivos" en donde se copiaran los
archivos. Esta carpeta debe tener chmod 777. 
*/
//CONFIGURACION 

$direccion_envio= 'nags_dcm2028@hotmail.com'; 								
//la direccion a la que se enviara el email.

$url= 'http://www.talentsw.com/contactenos'; 	
//la URL donde esta publicado el formulario. SIN la barra al final

$cantidad_archivos= 10; 														
//la cantidad máxima de archivos que se permitirá enviar.

//FIN CONFIGURACION
?>


<?PHP
//proceso del formulario
// si existe "enviar"...
if (isset ($_POST['enviar'])) {

// vamos a hacer uso de la clase phpmailer, 
// require("inc/class.phpmailer.php");
// require("inc/class.smtp.php");
require_once('class_correoprogramado1.php');
require_once('class_mailer.php');

$mail = new PHPMailer();

//$mail->Mailer = "smtp";

//recogemos las variables y configuramos PHPMailer
//$mail->Host       = "mail.talentsw.com"; // SMTP server
//$mail->Host       = "protea.websitewelcome.com"; // SMTP server
$mail->Host       = "smtp.gmail.com"; // SMTP server
$mail->Port       = 465;                    // set the SMTP port
$mail->IsSMTP();
$mail->SMTPSecure = "ssl";
$mail->SMTPAuth = true;
$mail->Username = 'nomina@talentsw.com';
$mail->Password = 'tytcali2013';
//$mail->Username = 'talentsw';
//$mail->Password = 'Dg?*&{=+vOp^';

//recogemos las variables y configuramos PHPMailer
$mail->From     = 'nelgaleano.2028@gmail.com';
$mail->FromName = 'Jefatura de Nomina Centro de Servicios Compartidos';
$mail->AddAddress($direccion_envio); 
$mail->Subject = "Novedades autogestion nomina";
$mail->AddReplyTo($_POST['email'],$_POST['nombre']);
$mail->IsHTML(true);                              
$comentario=$_POST['comentario'];
$mail->AddCC($_POST["email"]);


//comprobamos si se adjuntaron archivos, los cargamos en el servidor y los pasamos como adjuntos del email
if (isset($_FILES['archivo']['tmp_name'])) {
	$achivos_adjuntos='';					
	$i=0;
	do  {
		if($_FILES['archivo']['tmp_name'][$i] !="") 
			{ 
			$aleatorio = rand(); 
			$nuevonombre = $aleatorio.'-'.$_FILES['archivo']['name'][$i];
			copy($_FILES['archivo']['tmp_name'][$i],'archivos/'.$nuevonombre);
			$achivos_adjuntos .= '<br /><a href="'.$url.'/archivos/'.$nuevonombre.'">'.$nuevonombre.'</a></strong>';
			$mail->AddAttachment($_FILES['archivo']['tmp_name'][$i], $nuevonombre);
			}	
			$i++;
		} while ($i < $cantidad_archivos);

}

//comprobamos si todos los campos fueron completados
if ($_POST['email']!='' && $_POST['nombre']!='' && $_POST['comentario']!='' && $error_archivo=='') {

$email=$_POST['email'];
$nombre=$_POST['nombre'];
$comentario=$_POST['comentario'];

//armamos el html
$contenido = '<html><body>';
$contenido .= '<p>Buen d&iacute;a, se ha enviado las novedades reportadas por la pagina de Autogesti&oacute;n de n&oacute;mina, al mail novedades.nominacolombia@telefonica.com, con los archivos adjuntos:</p>';
$contenido .= '<p>Enviado el '.  date("d M Y").'</p>';
$contenido .= '<hr />';
$contenido .= '<p>Nombre: <strong>'.$nombre.'</strong></p>';
$contenido .= '<p>Email: <strong>'.$email.'</strong></p>';
$contenido .= '<p>Comentario: <strong>'.$comentario.'</strong></p>';
$contenido .= '<hr />';
$contenido .= '<p>Este mensaje es informativo por favor no dar respuesta a esta cuenta de correo. Si tienes alguna duda u observacion crea tu llamada a la Mesa Centro de Servicios Comprendidos haciendo <a href="http://intranet/MesasAyuda/Servicio.aspx?idSer=SERVICIOS DE NOMINA&amp;idSSer=NOMINA&amp;id=2">clic aqui</a>.</p>';
$contenido .= '<hr />';
$contenido .= '</body></html>';

$mail->Body    = $contenido;
// si todos los campos fueron completados enviamos el mail

$mail->Send();

$flag='ok';
$mensaje='<div id="ok">Sus archivos han sido adjuntados con &eacute;xito, y enviados al correo '.$_POST["email"].'.<br /> Gracias por Contactarnos</div>';

$sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) 
VALUES ('".$_SESSION['ced']."','".$_SESSION['nombre']."','".$_SESSION['ape']."',SYSDATE,'Novedades','novedades.nominacolombia@telefonica.com','".$empresamail."')";
$conn->Execute($sqlmail);

} else {
	
//si no todos los campos fueron completados se frena el envio y avisamos al usuario	
$flag='err';
$mensaje='<div id="error">- Los Campos Marcados Con * Son Requeridos. '.$error_archivo.'</div>';

}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title></title>
		<link href="css/contactenos.css" rel="stylesheet" type="text/css" />		
		<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
		<script src="js/jquery.form.js" type="text/javascript" language="javascript"></script>
		<script src="js/jquery.MultiFile.pack.js" type="text/javascript" language="javascript"></script>
		
<script language="JavaScript"> 
var statSend = false; 
function validar() {  // Funcion para evitar que se presione click varias veces luego de enviar los archivos.
    if (!statSend) {
        statSend = true;
        return true;
    } else {
        alert("Espere por favor....");
        return false;
    }
}
</script> 
	</head>
	<body>
	<div name="form" id="form" >
		
<h2>REPORTE DE NOVEDADES EMPLEADOS TELEFONICA</h2>
<p>Si tienes alguna novedad por reportar, por favor tener en cuenta lo siguiente:</p>
<ol>
  <li>Reporte Paz y Salvos libranzas: Adjuntar certificado del banco del crédito y formato único diligenciado y firmado</li> 	
  <li>Para modificar cuenta bancaria de nómina: Adjuntar  certificado del banco y formato único diligenciado y firmado</li>
  <li>Para adicionar, modificar o suspender aporte a  pensiones voluntarias: Adjuntar formato único diligenciado y firmado</li>
  <li>Para adicionar, modificar o suspender aporte AFC:  Si es cuenta nueva adjuntar certificado del banco y formato único diligenciado  y firmado, de lo contrario únicamente el formato único diligenciado y firmado</li>
  <li>Para reportar intereses de vivienda: Adjuntar  certificado del banco y formato único diligenciado y firmado</li>
  <li>Para reportar medicina prepagada: Adjuntar  certificado de la entidad y formato único diligenciado y firmado</li>
  <li>Para reportar dependientes: Adjuntar formato único  diligenciado y firmado teniendo en cuenta:
    <blockquote>
      <p>	a. Hijos  hasta 18 años, adjuntar registro civil de nacimiento<br />
        b. Hijos de  18 a 23 años, adjuntar registro civil de nacimiento y certificado de estudios  de institución de educación superior<br />
        c. Cónyuge o  compañero, padres y hermanos con dependencia económica del trabajador, debe  adjuntar certificación de contador público indicando la dependencia económica y  la no generación de ingresos<br />
        d.  Discapacidad física / mental de Cónyuge o compañero, padres, hermanos e hijos  mayores de 23 años, debe adjuntar certificado de medicina legar o entidad  competente para determinar la discapacidad </p>
<p>&nbsp;</p>

<h3>A  continuación descarga tu formulario único haciendo <a href="download.php?file=./descargables/FormatoUnicoNovedadesdeNomina.xls" style="color: #770003">clic aquí</a>.				
</h3>

<?php echo $mensaje; /*mostramos el estado de envio del form */ ?>

<?php if($cantidad_archivos > 1) {$plural='s';} else {$plural='';} ?>

<?php if ($flag!='ok') { ?>
<form name="formulario" action="<?php echo $PHP_SELF;?>" method="post" onSubmit="return validar();" enctype="multipart/form-data">
	<p><strong>Escribe tu nombre*</strong> (este campo es obligatorio)<br />
	<input name="nombre" type="text"  size="40" <?php if (isset ($flag) && $_POST['nombre']=='') { echo 'class="error"';} else {echo 'class="campo"';} ?> /></p>
	
	<p><strong>Escribe tu email corporativo*</strong> (este campo es obligatorio)<br />
	<input name="email" type="text" size="40"  <?php if (isset ($flag) && $_POST['email']=='') { echo 'class="error"';} else {echo 'class="campo"';} ?> /></p>


	<p><strong>Adjuntar Archivos</strong><br />
		Puede adjuntar hasta <?php echo $cantidad_archivos?> archivo<?php echo $plural?>.<br /><br />
	<input type="file" class="multi max-<? $cantidad_archivos;?>"  name="archivo[]" value="<? $_FILES['archivos'];?>"><br /><br /></p>
		
	<p><strong>Comentario*</strong> (este campo es obligatorio)<br />
	<textarea cols="60"  rows="10"<?php if (isset ($flag) && $_POST['comentario']=='') { echo 'class="com-error"';} else {echo 'class="com"';} ?> name="comentario"><?php echo $_POST['comentario'];?></textarea></p>
	<p><input  class="boton" id="boton" type="submit" name="enviar" value="enviar" /></p>
	<p>Verifique por favor su email antes de dar click en enviar.</p>
	</form>
<?php } ?>
	</div> <!-- end form-->

	</body>
</html>