
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Certificado de Igresos y Retenciones</title>

    	
	  <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
<!--  <link href="../css/azul/jquery-ui-1.8.12.custom.css" rel="stylesheet" type="text/css" />-->
 <link rel="stylesheet" type="text/css" href="../css/general.css" />
 <link type="text/css" href="../js/chosen/chosen.css" rel="stylesheet" />
 <link type="text/css" href="../css/monitores_cs.css" rel="stylesheet"/>
 <link rel="stylesheet" href="../css/jquery.ui.all.css">
 <link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
 <link rel="stylesheet" href="../css/validacion.css" media="screen" />
<link rel="stylesheet" href="../css/demos.css">

	
    
    
        <script src="../js/jquery-1.7.1.min.js"></script>
        
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

       
        <script type='text/javascript' src='../js/jquery-ui-1.8.17.custom.min.js'></script>
        <script type='text/javascript' src='../js/funciones.js'></script>
	<script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
	<script src="../js/jquery.ui.core.js"></script>
	<script src="../js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="../js/jquery.selectBox.js"></script>
      


<script type="text/javascript">
	$(function() {
    if (window.PIE) {
        $('.rounded').each(function() {
            PIE.attach(this);
        });
    }
});

$(document).ready(function () {
    
	
    $(".boton").click(function (){
		
        $(".errorr").remove();
        if( $("#anio").val() == "" ){
           	    
	     $("#val").html("<span class='errorr'>Seleccione un año</span>");
            return false;
        }
		
		});
		





 $("#envio").click(function(){
		
		alert("Tu certificado se envio correctamente");
		
		var ano=$("#anio").val();
		
		if(ano!=""){
		
			
				
				
		$.ajax({
		    type:"POST",
		    url: "pdf2_prueba.php",
		    data:"anio="+anio+"&envio=correo",
		    success: function(datos){
			
			console.log(datos);
				//$("#res").html(datos);
				//notify("Se envi&oacute; satisfactoriamente",500,5000,"email","email");
				
			
		    }
		    
		});
		}
		
		});
});

</script>
	<style type="text/css">
@import url("../css/plantilla_user.css");
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
    </style>
</head>

<body>


 <?php
            
		/*	 $sql="select distinct anocerti from hist_certrtefte";
	         
	   
	         $rh = $conn->Execute($sql); 
	   			
	         $row = $rh->FetchRow()
	   		$anios=$row['ANOCERTI'];
				*/   
          ?>



<form name="formulario"  id="pago" method="post" action="pdf2_prueba.php" target="TargetFrame">



<fieldset class="Estilo5"><legend><h2>Certificado de Ingresos y Retenciones</h2></legend>
<div id="capa_cer">
<strong class="tam_str">Año</strong><br /> <select name="anio" id="anio" class="combo" style="width:130px">
									<option value="">Seleccione</option>
                                    <option value="2012">2012</option>
					<option value="2013">2013</option>
					<option value="2014">2014</option>
					
							   </select><span id="val"></span><br /><br />


<input type="hidden" value="enviar" id="envios" name="enviar"/>
</div>
<center>
<input type="submit" name="ver" " value="Ver Certificado"  class="boton"/> &nbsp; &nbsp; &nbsp;
<input type="submit" name="envio" id="envio" value="Enviar a Correo" class="boton"/>
</center>

<br />
</fieldset>

</form>

<div id="res"></div>

<!-- Cambiar Imagen, Periodo de la Certificacion, Fecha de expedcion, Firma del retenedor -->


<table width="100%" height="160" border="0">
<tr>
<td height="50">
</td>
</tr>
<tr>
          <td class="piepag">Cualquier inconveniente que tengas, crea tu tiquete a la Mesa Centro de Servicios Compartidos haciendo <a href="http://intranet/MesasAyuda/Control.aspx?idSer=SERVICIOS DE NOMINA&idSSer=CERTIFICADOS&pt=FALLA GENERACION CERTIFICADO DE INGRESOS Y RETENCIONES&id=2" style="color: #770003">clic aquí</a> y adjunta el pantallazo con el error.</td>
        </tr>
</table>
</body>
</html>
