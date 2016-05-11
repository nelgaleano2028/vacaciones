<?php
session_start();

if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}

include_once("class_hojast.php");
$hoja= new class_hoja(@$_SESSION["cod"]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
    <head>
    
	<title>Aportes Voluntarios</title>

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
            /*@function llenar_combo nos llena un select con los datos de la bd
            *@param id del select
            *@param indico que datos voy a traer (#)
            *@param url donde se realiza dicho negocio
            */
                $(function(){
		
		llenar_combo("tipo","5","ajax_catalogos.php");
		llenar_combo("ano","3","ajax_catalogos.php");
		
                
                })

	     $(document).ready(function(){
	         
                $("#mes").change(function(event){
                    var id = $("#mes").find(':selected').val();
		    var per=$("#per").find(':selected').val();
		    var per=$("#per").find(':selected').val();
		    var per=$("#per").find(':selected').val();
                   
		    alert(id);
		    
                });
		
		
		
		
         
	     });
	      $(document).ready(function(){
	     
	
	     /*@function evento click
          *envio los datos del formulario por post
          *(pdf.php) y el me duevuelve un true (Se envio correo)
	      */
	     $("#enviar").click(function(event){
		
		var ano=$("#ano").attr("value");
		var per=$("#per").attr("value");
		var tipo=$("#tipo").attr("value");
		var liqui=$("#liqui").attr("value");
		
		$.ajax({
		    type:"POST",
		    url: "pdf.php",
		    data:"ano="+ano+"&per="+per+"&tipo="+tipo+"&liqui="+liqui,
		       beforeSend: function(){
		      notify("Enviando....",500,80000,"info","info");
							$("#enviar").css("display", "none");
						},
		    success: function(msg){
			
			if(msg=="true"){
			    
			    notify("Se envi&oacute; satisfactoriamente",500,5000,"email","email");
			}else{
			    
			}
		    },
		    complete: function(){
		      
		      
							$("#enviar").css("display", "inline");
							
						}
		    
		    
		});
		});
	     
	
	     
	        });
	    
	     
   
        </script>
  <script>
$(document).ready(function () {
    
/*Valido los campos del formulario si estan null */

    $(".boton").click(function (){
        $(".errorr").remove();
        if( $(".campo1").val() == "-1" ){
           	    
	     $("#val").html("<span class='errorr'>Seleccione un año</span>");
            return false;
        }else if( $(".campo2").val() == "-1" ){
            $("#periodoss").html("<span class='errorr'>Ingrese periodo </span>");
            return false;
        }else if( $(".campo3").val() == "-1"){
	    $("#tipos").html("<span class='errorr'>Seleccione un Tipo</span>");
            
            return false;
        }
    });
    $(".nombre, .asunto, .mensaje").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorr").fadeOut();
            return false;
        }
    });
    $(".email").keyup(function(){
        if( $(this).val() != "" && emailreg.test($(this).val())){
            $(".errorr").fadeOut();
            return false;
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
  </script>

    </head>
    <body>
	    <!--Vista -->
	    <form method="post" action="pdf.php" id="pago" target="TargetFrame">
	    <fieldset class="Estilo5">
	    	<legend>
	    		<h2>Editar Aportes Voluntarios</h2>
	    	</legend>
	    <!--Capa de los campos -->
	    <div id="capa">
	    <span class="Estilo5">
	      <label><strong class="tam_str">A&ntilde;o</strong></label>
	    </span><br>
	    <select id="ano" name="ano" class="combo campo1" style="width:140px;"></select><span id="val"></span>
	    
	    <br><br>
	    <label><strong class="tam_str">Tipo de pago</strong></label><br>
	    <select id="tipo" name="tipo" class="combo campo3" style="width:140px;"></select><span id="tipos"></span><br><br>
	    <div id="capa_per" style="display: none" >  
	    <label><strong class="tam_str">Periodo</strong></label><br>
	    <select name="per" id="per"  ></select><span id="periodoss"></span><br><br>
	    </div>
	   
	    </div>
	    <!--Capa de los campos -->
	     
		
	<center>
		
	    <input type="submit" name="ver" id="ver" value="Ver Comprobante" class="boton"/>
		<input type="button" id="enviar" name="enviar" value="Enviar a Correo" class="boton"/>
		
	</center><br>

	</fieldset>
	</form>
        
	<div id="resultado"></div>

  <!--Fin vista-->
        
</body>
</html>