<?php

require("class_mailer.php");

?>
    <form action="" method="post" enctype="multipart/form-data">
    Destinatario <input type="text" name="destino"><br>
    Asunto <input type="text" name="asunto"><br>
    Adjunto <input type="file" name="archivo"><br>
    Mensaje <textarea name="mensaje"></textarea><br>
    <input type="submit" name="btsend" value="Enviar Email">
    <input type="hidden" name="action" value="send" />
    </form>

<?php

$mail = new mailer();

$direccion_envio= 'vladimir.bello@talentsw.com'; 	
$direccion_envio2= 'novedades.nominacolombia@talentsw.com'; 

//recogemos las variables y configuramos PHPMailer
$mail->From     = 'CentroDeServicioCompartidos@telefonica.com';
$mail->FromName = 'Jefatura de Nomina Centro de Servicios Compartidos';
$mail->AddAddress($direccion_envio); 
$mail->Subject = "Novedades autogestion nomina";
$mail->AddReplyTo($_POST['email'],$_POST['nombre']);
$mail->IsHTML(true);                              
$comentario=$_POST['comentario'];
$mail->AddCC($direccion_envio2);
//$mail->AddAttachment('archivos/class_mailer.txt', 'class_mailer.txt');


if ($_POST['action'] == "send") {
$varname = $_FILES['archivo']['name'];
var_dump($vartemp = $_FILES['archivo']['tmp_name']);
if ($varname != "") {
$mail->AddAttachment($vartemp, $varname);
}
$body = "<strong>Mensaje</strong><br><br>";
$body.= $_POST['mensaje']."<br>";
$body.= "Aca! cuerpo del mensaje......by: www.ramdeit.com";
$mail->Body = $body;
$mail->IsHTML(true);
$mail->Send();
} ?>