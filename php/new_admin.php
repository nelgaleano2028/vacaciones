<?php session_start();

if (!isset($_SESSION['privi'])){
  
  header("location: index.php");
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
    <!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
    <!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
    <!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
    <!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    
		     <!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->
		    
		     <!--[if lt IE 10]>
    <script type="text/javascript" src="../PIE/PIE.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="../js/html5shiv.js"></script>
    <![endif]-->
	
	    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	    <head>
<style>




   #testTable { 
           
            margin-left: auto;
            /**margin-left: 35%;*/
            margin-right: auto;
            
 
          }
          
          #tablePagination { 
            background-color: #DCDCDC; 
            font: 12px Arial, Helvetica, sans-serif;
            padding: 0px 5px;
            padding-top: 2px;
            height: 25px
          }
          
          #tablePagination_paginater { 
            margin-left: auto; 
            margin-right: auto;
          }
          
          #tablePagination img { 
            padding: 0px 2px; 
          }
          
          #tablePagination_perPage { 
            float: left; 
          }
          
          #tablePagination_paginater { 
            float: right; 
          }
</style>

    <link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../css/style3.css" />
    <link rel="stylesheet" type="text/css" href="../css/animate-custom.css" />
    <link rel="stylesheet" href="../css/validacion.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/estilo.css" />




<link type="text/css" href="../css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" type="text/css" href="../css/general.css" />
<link rel="stylesheet" type="text/css" href="../js/chosen/chosen.css"  />

 <link rel="stylesheet" href="../css/jquery.ui.all.css">
 

    



<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="../js/jquery-ui-1.8.20.custom.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" src='../js/dataTables.fnGetFilteredNodes.js'></script>

<script type='text/javascript' src='../js/funciones.js'></script>

   
	
	 <!-- PAGINACION-->
	 <link rel="stylesheet" href="../js/__jquery.tablesorter/themes/blue/style.css" type="text/css"/>
	   <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.js" type="text/javascript"></script>
          <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.min.js" type="text/javascript"></script>
           <script src="../js/__jquery.tablesorter/jquery-latest.js" type="text/javascript"></script>
          <script src="../js/__jquery.tablesorter/jquery.tablesorter.js" type="text/javascript"></script>
          <!-- FIN PAGINACION-->
          
	            
		    
		     

		     <script type="text/javascript">
		
			    
			    $(function() {
	if (window.PIE) {
	    $('.rounded').each(function() {
		PIE.attach(this);
	    });
	}
    });
     </script>                     
     <script>
	

	
    $(document).ready(function () {
	
 
    
$("#lista").click(function(){
		$("#formulario").show("shake");
		$("#tabla").hide();
		$.ajax({
			type: "GET",
			url: 'eliminar_admin.php',
			success: function(datos){
				$("#formulario").html(datos);
			}
		});
		return false;
	});


	
	
	
    /*Valido los campos del formulario si estan null */
    
	
	 $(".boton").click(function (){    
	    $(".errorr").remove();
	    if( $(".cod_epl").val() == "" ){
		$(".cod_epl").before("<span class='errorr'>Ingresa Codigo del Empleado.</span>");
		return false;
	    }else if( $(".nombre").val() == "" ){
			
		 $(".uname").after("<span class='errorr'>Ingresa Nombre de usuario</span>");
		return false;
	    }else if( $(".pass").val() == "" ){
		$(".pass").before("<span class='errorr'>Ingresa Contraseña</span>");
		return false;
	    }else if( $(".conf_pass").val() == ""){
		$(".conf_pass").before("<span class='errorr'>Confirma la contraseña</span>");
		
		return false;
	    }else if($(".conf_pass").val() != $(".pass").val()){
		$(".conf_pass").before("<span class='errorr'>Las contraseñas no coinciden</span>");
		}else if($(".nombre").val() != "" && $(".pass").val() != "" && $(".conf_pass").val() != ""){
		
		var usuario=$("#usuario").attr("value");
		var pass=$("#passwordsignup").attr("value");
		var cod_epl=$("#cod_epl").attr("value");
		    
		    
		    
		    $.ajax({
			type:"POST",
			url: "crear_admin.php",
			data:"cod_epl="+cod_epl+"&usuario="+usuario+"&pass="+pass,
			success: function(msg){
			     
				if(msg == false){
				notify("Error al ingresar los datos.",500,5000,"error","error");
				}else if(msg == true){
				
				    notify("Se envi&oacute; satisfactoriamente.",500,5000,"succes","succes");
				    
				    $('#registro').each (function(){
  this.reset();
});
				    $('#result').html(" ");
				}else{
				    notify(msg,500,5000,"warning","warning");
				}
			}
			
		    });
	    }
	});
	$(".nombre, .pass, .conf_pass, .cod_epl").keyup(function(){
	    if( $(this).val() != "" ){
		$(".errorr").fadeOut();
		return false;
	    }
	});
	//$(".conf_pass").keyup(function(){
	//    if( $(this).val() !=  $(".pass").val()){
	//	$(".conf_pass").before("<span class='errorr'>Las contraseñas no coinciden</span>");
	//	return false;
	//    }
	//});
	$('.pass').keyup(function(){
		

$('#result').html(checkStrength($('.pass').val()))

		
	});
	$(".email").keyup(function(){
	    if( $(this).val() != "" && emailreg.test($(this).val())){
		$(".errorr").fadeOut();
		return false;
	    }
	});
	
	function checkStrength(password){
    
	//initial strength
    var strength = 0
	
    //if the password length is less than 6, return message.
    if (password.length < 6) { 
		$('#result').removeClass()
		$('#result').addClass('short')
		return 'Muy Débil' 
	}
    
    //length is ok, lets continue.
	
	//if length is 8 characters or more, increase strength value
	if (password.length > 7) strength += 1
	
	//if password contains both lower and uppercase characters, increase strength value
	if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
	
	//if it has numbers and characters, increase strength value
	if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
	
	//if it has one special character, increase strength value
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
	
	//if it has two special characters, increase strength value
    if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
	
	//now we have calculated strength value, we can return messages
	
	//if value is less than 2
	if (strength < 2 ) {
		$('#result').removeClass()
		$('#result').addClass('weak')
		return 'Débil'			
	} else if (strength == 2 ) {
		$('#result').removeClass()
		$('#result').addClass('good')
		return 'Bueno'		
	} else {
		$('#result').removeClass()
		$('#result').addClass('strong')
		return 'Fuerte'
	}
}
	
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
     
     
     <script>
		/*paginacion id de la tabla*/
            $(document).ready(function() {
           // $('#embargos').tablePagination({});

            } )
			
            /*quita todo conflicto de jquery*/
              var $j = jQuery.noConflict();
			  
			  /*ordenamiento id de la tabla*/
         $j(document).ready(function(){
    
        $j("#adminn").tablesorter();
    }); 
     </script>
     
	</head>
	<body style="
	overflow-y: hidden;">
	    <div class="container">
		<div id="formulario" style="display:none;">
		</div>
		     <div id="tabla">
		<section>
		    </br></br>
		    
		    
                   
		   
		    <div id="container_demo" >             
			<div id="wrapper">
			    <div id="login" class="animate form">
				<form id="registro" action="" autocomplete="on"> 
				    <h1> Reg&iacute;strate </h1>
				    <div><label class="" data-icon="u">Codigo del Empleado:</label><input id="cod_epl" type='text' placeholder="1425356" class='cod_epl' value=''></div>
				    <div><label class="uname" data-icon="u">Usuario:</label><input id="usuario" type='text' placeholder="mysuperusername690" class='nombre' value=''></div>
				   
				    <div><label class="youpasswd" data-icon="p">Contraseña: <span id="result"></span></label><input id="passwordsignup" name="passwordsignup" class="pass"  type="password" placeholder="eg. X8df!90EO"/></div>
				   <div><label  class="youpasswd" data-icon="p">Por favor confirme la contraseña:</label><input id="passwordsignup_confirm" class="conf_pass" name="passwordsignup_confirm" type="password" placeholder="eg. X8df!90EO"/></div>
				    <p class="signin button"> 
									    <input id="enviar" class="boton" type="button" value="Registrar"/> 
								    </p>
				    <p class="change_link">  
									    <a id='lista' href="" class="to_register"> Lista de Administradores </a>
								    </p>
				</form>
			    </div>
			</div>
		    </div>
	
		</section>
		</div>
	    </div>
	</body>
    </html>