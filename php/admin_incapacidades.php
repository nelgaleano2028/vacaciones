<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
<head>

<!--FUNCION SOLO NUMEROS-->
        <script type="text/javascript">
		function validarnum(e) {
		tecla = (document.all) ? e.keyCode : e.which;
		if (tecla==8 || e.keyCode==9) return true;
		patron = /\d/;
		te = String.fromCharCode(tecla);
		return patron.test(te);
		}
		</script>
		<SCRIPT language="JavaScript" type="text/javascript">
function contador (campo, cuentacampo, limite) {
if (campo.value.length > limite) campo.value = campo.value.substring(0, limite);
else cuentacampo.value = limite - campo.value.length;
}
</script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
          <link rel="stylesheet" type="text/css" href="../css/estilo_gral.css" />
	  <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
          <script src="../js/jquery-1.7.1.min.js"></script>
          <script type='text/javascript' src='../js/jquery-ui-1.8.17.custom.min.js'></script>
          <script type='text/javascript' src='../js/funciones.js'></script>
	  
	  
	  <!--[if lt IE 10]>
<script type="text/javascript" src="../PIE/PIE.js"></script>
<![endif]-->

<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
<![endif]-->

<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
	
	      <script type="text/javascript">
            
			
			$(function() {
    if (window.PIE) {
        $('.rounded').each(function() {
            PIE.attach(this);
        });
    }
});
	      </script>
</head>

<body>

<table border="0" width="100%">
	<tr>
		<td align="center">
			<span style="font-size:18px; font-weight:bold;">ACTIVOS</span>
		</td>
	</tr>		
<table>

<br />
<br />

<form action="solicitudes_incapacipendiente.php" method="post">
<fieldset style="width: 460px; margin:0 auto 0 auto; border-radius: 5px;"><legend><h2 >Ingresa el numero de cedula del Jefe a consultar</h2></legend>
<br />
<br />

<span style="font-weight:bold">Ingrese la Cedula: <input type="text" id="codinca" name="codinca" /></span><br /><br />
<br /><br />
<center>
<INPUT id="boton" class="boton" TYPE="submit" NAME="ok" VALUE="Generar">
</center>
</fieldset>
</form>


</body>
</html>

