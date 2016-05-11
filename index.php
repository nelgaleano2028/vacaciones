<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>.:Auto Gestion Nomina:.</title>
<link rel="stylesheet" type="text/css" href="../css/mainCSS.css" />
<link rel="stylesheet" type="text/css" href="../css/validacion.css" />

<script type="text/javascript" src="./js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="./js/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="./js/funciones.js"></script>
<style type="text/css">
@import url("css/stylo1.css");
body {
		/* Color alternativo para versiones que no soporten degradados */
	  background-color:#00496d;
	
	  /* Safari 4+ y Chrome 1+ */
	  background-image:-webkit-gradient(linear, left top, left bottom, color-stop(0, #000000), color-stop(1, #00496d));
	
	  /* Safari 5.1+ y Chrome 10+ */
	  background-image:-webkit-linear-gradient(#000000, #00496d);
	
	  /* Firefox 3.6+ */
	  background-image:-moz-linear-gradient(top, #000000, #00496d);
	
	  /* Opera 11.10+ */
	  background-image:-o-linear-gradient(top, #000000, #00496d);
	
	  /* Internet Explorer 5.5+ */
	  filter:progid:DXImageTransform.Microsoft.gradient(startColorStr='#000000', EndColorStr='#00496d');
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-repeat: no-repeat;
}
.fenosa {
	color: #900;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 30px;
}
.gas {
	color: #FFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 30px;
}
.pass {
	color: #999;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 17px;
	font-weight: bold;
}
#ingreso {
	background-image: url(imagenes/boton.png);
	height: 40px;
	width: 40px;
	background-repeat: no-repeat;
	background-position: center center;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-bottom: none;
	background-color: transparent;
}
.fondoimagen {
	background-image: url(imagenes/index.png);
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-repeat: no-repeat;
}

.content-warning{
	background-color: rgba(0,0,0,0.3);
	font-family: Arial, Helvetica, sans-serif;
	color:#E0E0E0;
	padding: 10px;
	font-size: 12px;
	border-radius: 4px;
	margin-top: 20px;		
}

.content-warning .title{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;	
	margin-top: 0;
	margin-bottom: 0;
	color: #FFFFFF;
}


.content-warning p{
	margin-top: 3px;
	margin-bottom: 0;
}

.content-warning div{
	display: table-cell;
	vertical-align: top; 

}

.content-warning img{	
	width:46px; 
	height:45px;	
	vertical-align: middle; 	 
}

</style>

<script type="text/javascript">

      $(document).ready(function () {
	  /* SEGUNDA PRUEBA RAMA NAGS*/    
	  /*Valido los campos del formulario si estan null */
	  
	      $(".boton").click(function (){
		  $(".errorr").remove();
		  if( $("#usuario").val() == "" ){
		       $("#val").html("<span class='errorr'>Ingresar Usuario.</span>");
		      return false;
		  }else if( $("#clave").val() == "" ){
		      $("#base").html("<span class='errorr'>Ingresar Clave.</span>");
		      return false;
		  }
	      });
	      $("#usuario").keyup(function(){
		  if( $(this).val() != "" ){
		      $(".errorr").fadeOut();
		      return false;
		  }
	      });
	      $("#email").keyup(function(){
		  if( $(this).val() != "" && emailreg.test($(this).val())){
		      $(".errorr").fadeOut();
		      return false;
		  }
	      });
	      
	       $("#clave").keypress(function(e) {
		    
		  code = e.keyCode ? e.keyCode : e.which ;
		  //boolean de estado para SHIFT
		  shif = e.shiftKey ? e.shiftKey: ( (code == 16) ? true : false ) ;
		  if(((code >= 65 && code <= 90) && !shif ) || ((code >= 97 && code <= 122 ) && shif))
		    {
		       $("#base").html("<span class='errorr'>La tecla Bloq Mayus esta activa</span>");
                       
		    }else {
		      $(".errorr").fadeOut();
	            }
	      });
	  });
	  
	  $(function(){	
	    try{			
			  $(".boton").button(); //clase para los botones
	    }catch(err){return;}
	  });	
	  $(function(){
		  try{
			  $(".combo").chosen(); //clase para los combobox		
		  }catch(err){return;}
	  });	
    
$(document).ready(function() {
    
    
// Create two variable with the names of the months and days in an array
var monthNames = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]; 
var dayNames= ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"]

// Create a newDate() object
var newDate = new Date();
// Extract the current date from Date object
newDate.setDate(newDate.getDate());
// Output the day, date, month and year   
$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

setInterval( function() {
	// Create a newDate() object and extract the seconds of the current time on the visitor's
	var seconds = new Date().getSeconds();
	// Add a leading zero to seconds value
	$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
	},1000);
	
setInterval( function() {
	// Create a newDate() object and extract the minutes of the current time on the visitor's
	var minutes = new Date().getMinutes();
	// Add a leading zero to the minutes value
	$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);
	
setInterval( function() {
	// Create a newDate() object and extract the hours of the current time on the visitor's
	var hours = new Date().getHours();
	// Add a leading zero to the hours value
	$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);

    
 
});
</script>

</head>

<body style="overflow-x: hidden;">
    
    <?php
    if(isset($_GET["error"]) == 1){
        
        echo '<script>
             notify("El usuario que has indicado no pertenece a ninguna cuenta.",500,5000,"error","error");
             
               </script>';
    }
    
    ?>
<table width="100%" border="0" class="fondoimagen">
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="80%" height="150">&nbsp;</td>
        <td width="30%">
        
        <div class="clock"> 
        <div id="Date"></div>
          <ul>
          <li> <img src="imagenes/clock.png" width="25" height="24" /></li>
          <li id="hours"></li>
          <li id="point">:</li>
          <li id="min"></li>
          <li id="point">:</li>
          <li id="sec"></li>
    	  </ul>
        </div></td>
      </tr>
      <tr>
        <td width="80%" height="388"><table width="100%" border="0" style="margin-left: 500px">
            <form id="logueo" name="logueo" method="post" action="php/prueba.php" >
          <tr>
            <td><span class="gas">Telefónica Colombia</span><span class="fenosa"></span></td>
            </tr>
          <tr>
            <td><span class="pass">Escribe tu usuario de red </br>(colocar usuario de red sin dominio NH/TELECOM)</span></td>
            </tr>
          <tr>
            <td>
              <label for="pass"></label>
              <input name="usuario" type="text" id="usuario" size="25" /><span id="val"></span>
            </td>
            </tr>
            <tr>
            <td><span class="pass">Escribe tu contraseña de red</span></td>
            </tr>
            <tr>
            <td>
              <label for="pass"></label>
              <input name="pass" type="password" id="clave" size="25" /><span id="base"></span>
            </td>
            </tr>
            <tr>
            <td><label style="margin-left:25px">
              <input style="cursor: pointer;" name="ingreso" type="submit" class="#ingreso boton" id="ingreso" value="      " />
              <span class="pass">Ingresar</span> </label></td>
            </tr>
             </form>
        </table>
		
		<table width="51%" style="margin-left: 500px">
             <tr>
	            <td >
		            <div class="content-warning" >
		            	<div style="vertical-align:middle; padding-right: 8px;"> <img src="imagenes/caution.png"/> </div>
			         	<div> <p class="title"><STRONG>¡Atención! </STRONG></p>
			         		  <p> Para acceder correctamente a la herramienta de Autogestión de Nómina, por favor utilizar 
			         		  	  Internet Explorer versión 10 o superior u otro navegador. <br>Gracias.</p> 
			            </div>
					</div>
				</td>			
			</tr>
		</table>
		
		</td>
        <td width="30%">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" colspan="2">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>