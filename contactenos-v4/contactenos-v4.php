<?php
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

$direccion_envio= 'vladimir.bello@talentsw.com'; 								
//la direccion a la que se enviara el email.

$url= '10.80.10.10/vacaciones/contactenos-v4'; 	
//la URL donde esta publicado el formulario. SIN la barra al final

$cantidad_archivos= 5; 														
//la cantidad máxima de archivos que se permitirá enviar.

//FIN CONFIGURACION
?>


<?PHP
//proceso del formulario
// si existe "enviar"...
if (isset ($_POST['enviar'])) {

// vamos a hacer uso de la clase phpmailer, 
require("class_mailer.php");

$mail = new mailer();

//recogemos las variables y configuramos PHPMailer
$mail->From     = $_POST['email'];
$mail->FromName = $_POST['nombre'];
$mail->AddAddress($direccion_envio); 
$mail->Subject = "Contacto desde el Formulario";
$mail->AddReplyTo($_POST['email'],$_POST['nombre']);
$mail->IsHTML(true);                              
$comentario=$_POST['comentario'];


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
$contenido .= '<h2>Contacto desde formulario</h2>';
$contenido .= '<p>Enviado el '.  date("d M Y").'</p>';
$contenido .= '<hr />';
$contenido .= '<p>Nombre: <strong>'.$nombre.'</strong></p>';
$contenido .= '<p>Email: <strong>'.$email.'</strong></p>';
$contenido .= '<p>Comentario: <strong>'.$comentario.'</strong></p>';
$contenido .= '<hr />';
$contenido .= '<p>Archivos Adjuntos: '.$achivos_adjuntos.'</p>';
$contenido .= '<hr />';
$contenido .= '</body></html>';

$mail->Body    = $contenido;
// si todos los campos fueron completados enviamos el mail

$mail->Send();

$flag='ok';
$mensaje='<div id="ok">Sus archivos han sido adjuntados con &eacute;xito<br /> Gracias por Contactarnos</div>';
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

	</head>
	<body>
	<div id="form">
		
<h2>REPORTE DE NOVEDADES EMPLEADOS MOVISTAR</h2>
<p>Si tienes alguna novedad por reportar, por favor tener en cuenta lo siguiente:</p>
<ol>
  <li>Para modificar cuenta bancaria de nómina: Adjuntar  certificado del banco y formato único diligenciado y firmado</li>
  <li>Para adicionar, modificar o suspender aporte a  pensiones voluntarias: Adicionar formato único diligenciado y firmado</li>
  <li>Para adicionar, modificar o suspender aporte AFC:  Si es cuenta nueva adjuntar certificado del banco y formato único diligenciado  y firmado, de lo contrario únicamente el formato único diligenciado y firmado</li>
  <li>Para reportar intereses de vivienda: Adjuntar  certificado del banco y formato único diligenciado y firmado</li>
  <li>Para reportar medicina prepagada: Adjuntar  certificado de la entidad y formato único diligenciado y firmado</li>
  <li>Para reportar dependientes: Adjuntar formato único  diligenciado y firmado teniendo en cuenta:
    <blockquote>
      <p>	a. Hijos  hasta 18 años, adjuntar registro civil de nacimiento<br />
        b. Hijos de  18 a 23 años, adjuntar registro civil de nacimiento y certificado de estudios  de institución de educación superior<br />
        c. Cónyuge o  compañero, padres y hermanos con dependencia económica del trabajador, debe  adjuntar certificación de contador público indicando la dependencia económica y  la no generación de ingresos<br />
        d.  Discapacidad física / mental de Cónyuge o compañero, padres, hermanos e hijos  mayores de 23 años, debe adjuntar certificado de medicina legar o entidad  competente para determinar la discapacidad </p>
    </blockquote>
    </li>
</ol>
<p>&nbsp;</p>

<h3>A  continuación descarga tu formulario único haciendo <a href="../php/download.php?file=../descargables/FormatoUnicoNovedadesdeNomina.xlsx" style="color: #770003">clic aquí</a>.				
</h3>

<?php echo $mensaje; /*mostramos el estado de envio del form */ ?>

<?php if($cantidad_archivos > 1) {$plural='s';} else {$plural='';} ?>

<?php if ($flag!='ok') { ?>
<form action="<?php echo $PHP_SELF;?>" method="post" enctype="multipart/form-data">
	<p><strong>Nombre*</strong><br />
	<input name="nombre" type="text" value=""  size="40"  <?php if (isset ($flag) && $_POST['nombre']=='') { echo 'class="error"';} else {echo 'class="campo"';} ?> /></p>
	
	<p><strong>Email*</strong><br />
	<input name="email" type="text"  value="" size="40"  <?php if (isset ($flag) && $_POST['email']=='') { echo 'class="error"';} else {echo 'class="campo"';} ?> /></p>


	<p><strong>Adjuntar Archivos</strong><br />
		Puede adjuntar hasta <?php echo $cantidad_archivos?> archivo<?php echo $plural?>.<br /><br />
	<input type="file" class="multi max-<?=$cantidad_archivos?>"  name="archivo[]" value="<?=$_FILES['archivos']?>"><br /><br /></p>
		
	<p><strong>Comentario*</strong><br />
	<textarea cols="60"  rows="10"<?php if (isset ($flag) && $_POST['comentario']=='') { echo 'class="com-error"';} else {echo 'class="com"';} ?> name="comentario"><?php echo $_POST['comentario'];?></textarea></p>
	<p><input class="boton" type="submit" name="enviar" value="enviar" /></p>
	</form>
<?php } ?>
	</div> <!-- end form-->

	</body>
</html>