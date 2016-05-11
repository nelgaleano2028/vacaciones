<?php
@session_start();


if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}
require_once('../lib/configdb.php');



global $conn;
$codigo=$_SESSION['cod'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Conceptos</title>


<script src="../js/jquery-1.7.1.min.js"></script>

<script type='text/javascript' src='../js/jquery-ui-1.8.17.custom.min.js'></script>
<script type='text/javascript' src='../js/funciones.js'></script>

   <script type='text/javascript' src='../js/funciones.js'></script>
	<script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
	<script src="../js/jquery.ui.core.js"></script>
	<script src="../js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="../js/jquery.selectBox.js"></script>


<link rel="stylesheet" type="text/css" href="../css/plantilla_user.css" />
<link href="../css/tcal.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/validacion.css" media="screen" />



<link type="text/css" href="../css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" type="text/css" href="../css/general.css" />
<link rel="stylesheet" type="text/css" href="../js/chosen/chosen.css"  />
 <link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/scroll.css"  />
 <link rel="stylesheet" href="../css/jquery.ui.all.css">
  
  <style>
    body{
      font: 12px arial,sans-serif;
    }
  </style>

<!--FUNCION SOLO NUMEROS-->
        <script type="text/javascript">
	  

  
  var nav4 = window.Event ? true : false;

function acceptNum2(evt)	//Sólo números y SÓLO 1 punto decimal
{	
	// Punto = 46
	var key = nav4 ? evt.which : evt.keyCode;
	cadena=document.getElementById("uta").value;
	if(cadena.indexOf('.')==-1)
	{return (key <= 13 || (key >= 48 && key <= 57) || key == 46);}
	else
	{return (key <= 13 || (key >= 48 && key <= 57));}
	
}
		</script>

<script>
$(function(){
	llenar_combo("conceptos","6","ajax_catalogos.php");
})


</script>
<script>
$(document).ready(function () {
    
/*Valido los campos del formulario si estan null */


    $(".campo2").focus(function (){
      
	$("#periodoss").html("<span class='errorr'>Ingrese la cantidad o el valor de la novedad.</span>");
	
      });
    $(".campo2").keypress(function (){
      
	$("#periodoss").html("");
	
      });



    $(".boton").click(function (){
      
	  
        $(".errorr").remove();
        if( $(".campo1").val() == "-1" ){
           	    
	     $("#val").html("<span class='errorr'>Seleccione una Novedad</span>");
            return false;
        }else if( $(".campo2").val() == "" ){
            $("#periodoss").html("<span class='errorr'>Ingrese la cantidad o el valor de la novedad.</span>");
            return false;
        }
});
}) ; 
</script>

</head>

<body>

<br />

<br />

<fieldset style="width: 800px; margin:0 auto 0 auto; border-radius: 5px;">
	<legend><h2>Seleccione la Novedad a Realizar</h2></legend>

<br />


<form method="post" name="solicitud" action="envio_nov.php" id="formulario">


<div align="left" style="margin-left:200px">
	
    <p><label><strong class="tam_str">Novedad:&nbsp;&nbsp;</strong></label> 
	
    <select  id="conceptos" name="conceptos" class="combo campo1" style="width:300px;"> </select><span id="val"></span>
 
    
            
              <br />
               <br />
                <br />
             
            
   <label><strong class="tam_str">Ingrese su Valor:&nbsp;&nbsp;</strong>
   </label><input type="text" name="valor" id="valor" class="campo2" style="background-color:white"  onkeypress="return validarnum(event)"/><span id="periodoss"></span>
      
</div>  
             
 <br />
 <br />
<center> 
<p><input type="submit" class="boton" id="btn" value="Enviar Solicitud" /></p>
</center>

</form>
</fieldset>

<br />

</body>
</html>