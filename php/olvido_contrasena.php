<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Envio de Contrase&ntilde;a</title>

	<script src="../development-bundle/jquery-1.6.2.js"></script>
	<script src="../development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../development-bundle/ui/jquery.ui.button.js"></script>
    <script src="../js/jquery.validate.js"></script>
    
    <!--FUNCION VALIDACIONES-->
        <script>
         $(document).ready(function() {
              $("#form1").validate({
                	rules: {
				email : {required: true,email: true}
                },
                	messages: {
				email : "Correo incorrecto"
                }
              });
            });
        </script>
        
    <!--FUNCION BOTONES-->
    
<script>
	$(function() {
		$( "input:submit, a, button", ".demo" ).button();
		$( "a", ".demo" ).click(function() { return false; });
	});
	</script>

<link href="../development-bundle/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css">
<link href="../development-bundle/demos/demos.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo2 {
	font-size: 12px;
	color: #666;
}
.Estilo3 {color: #0066FF}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo5 {font-size: 14px}
-->
    </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<form id="form1" name="form1" method="post" action="envia_olvido_contrasena.php">
  <table width="500" border="0" align="left" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" class="Estilo1 Estilo3 Estilo5">No recuerdo mi cuenta</td>
    </tr>
    <tr>
      <td height="42" colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td height="63" colspan="3"><span class="Estilo1">*Por favor regalanos tu correo electronico y te enviaremos automaticamente el usuario y la contrase&ntilde;a a tu buzon de entrada. Si no la encuentras ahi, revisa el correo no deseado o Spam.</span></td>
    </tr>
    <tr>
      <td width="244" height="62"><span class="Estilo1">Escribe tu direccion de correo electronico.</span>
      <label></label></td>
      <td width="206"><input name="email" type="text" class="Estilo2" id="email" onfocus="if(this.value == 'Direcci&oacute;n de correo electr&oacute;nico') this.value='';" onblur="if(this.value == '') this.value='Direcci&oacute;n de correo electr&oacute;nico';" value="Direcci&oacute;n de correo electr&oacute;nico" size="35"/></td>
      <td width="50"><img src="../imagenes/EMAILito.png" width="50" height="44" /></td>
    </tr>
    <tr>
      <td height="43" colspan="2">&nbsp;</td>
      <td height="43">&nbsp;</td>
    </tr>
    <tr>
      <td height="62" colspan="3"><label>
        <div align="right" class="demo">
          <input type="submit" name="button" id="button" value="Enviar" />
        </div>
      </label></td>
    </tr>
  </table>
</form>
</body>
</html>