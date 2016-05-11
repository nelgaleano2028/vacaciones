<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
@session_start();

if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}

include_once("class_hojast.php");
$hoja= new class_hoja(@$_SESSION["cod"]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
   
	<title>Comprobante de Pago</title>

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
		llenar_combo("anio","3","ajax_catalogos.php");
		
                
                })
		
		$(document).ready(function(){
		    
            /*    $("#tipo").change(function(event){
		    if($("#tipo").find(':selected').val()!=-1){
                    var id = $("#tipo").find(':selected').val();*/
		  
                    $("#per").load('genera-select.php?id=3');
		    
		    /*CSS DEL SELECT*/
		   /* $("#capa_per").css("display","inline");
		    $("#per").css("border-color","#AAA");
		    $("#per").css("overflow","hidden");
		    $("#per").css("white-space","nowrap");
		    $("#per").css("position","relative");
		    $("#per").css("color","#444");
		    //$("#per").css("background-color","#F9F9F9");
		    $("#per option").css("font-family","Georgica");
		    $("#per").css("border-style","solid");
		     $("#per").css("border-width","1");
		     //$("#per").css("background-color","#CC33CC");
		     $("#per").css(" border-radius","4px");
		     $("#per").css("-moz-border-radius","4px");
		     $("#per").css("-webkit-border-radius","4px");
		     /*FIN DEL CSS*/

                     /*AGREGO UNA CLASE .campo2 para el dis�o de la validacion*/
		   /* $("#per").addClass("campo2");
		  
		    
		}else{
		     /*Oculto la capa contenedora del select*/
		   /*  $("#capa_per").css("display","none");
		     /*El select lo == a null*/
		    // $("#per").val('');
		//}
		    
		    
               // });*/
            });
	     
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
           	    
	     $("#val").html("<span class='errorr'>Seleccione un a�o</span>");
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
	    <!--Vista -->
	    <form method="post" action="pdf.php" id="pago" target="TargetFrame">
	    <fieldset class="Estilo5">
	    	<legend>
	    		<h2>Comprobante de Pago</h2>
	    	</legend>
	    <!--Capa de los campos -->
	    <div id="capa">
	      <p><span class="Estilo5">
	        <label><strong class="tam_str">A&ntilde;o</strong></label>
          </span><br>
	        <select id="ano" name="ano" class="combo campo1" style="width:140px;">
			<option value="">Seleccione</option>
 			  	<?php	// SE CAMBIA ESTA OPCION COMO FECHA DINAMICA.
					$año=2013;
					while($año <=date("Y")) {
					echo '<option value="'.$año.'">'.$año.'</option>';
					$año=$año+1;
				}
				?>
            </select>
	        <span id="val"></span><br><br>
	        <!-- <div id="capa_per" style="display: none" >  -->
	        <label><strong class="tam_str">Periodo</strong></label>
	        <br>
	        <select name="per" id="per"  >
            </select>
	        <span id="periodoss"></span><br>
	      </p>
	      <div style="visibility:hidden;">
	        <label><strong class="tam_str">Tipo de pago</strong></label>
	        <br />
	        <select id="tipo" name="tipo" class="combo campo3" style="width:140px;">
            </select>
	        <span id="tipos"></span></div>
	      <p><br>
	        <!-- </div>-->
	        <input type="hidden" name="liqui" id="liqui" value="14"/>
          </p>
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
        <table width="100%" height="165" border="0">
<tr>
<td height="50">
</td>
</tr>
<tr>
          <td class="piepag">Cualquier inconveniente que tengas, crea tu tiquete a la Mesa Centro de Servicios Compartidos haciendo <a href="http://clienteinterno:9000/MesasAyuda/Categorias/113/Subcategorias/729/Productos/5119/Problemas" style="color: #770003">clic aqu&iacute;</a> y adjunta el pantallazo con el error.</td>
        </tr>
</table>
</body>
</html>