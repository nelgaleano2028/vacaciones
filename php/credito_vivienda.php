<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
   <title>Documento sin t&iacute;tulo</title>
         
          <link rel="stylesheet" type="text/css" href="../css/estilo_gral.css" />
	  <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
          <link rel="stylesheet" href="../css/validacion.css" media="screen" />
          <link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
          <script src="../js/jquery-1.7.1.min.js"></script>
          <script type='text/javascript' src='../js/jquery-ui-1.8.17.custom.min.js'></script>
          <script type='text/javascript' src='../js/funciones.js'></script>
          
          <style>
            textarea{
                
                overflow: auto;
                resize: none;
                moz-resize:  none;  
                -webkit-resize: none;  
                outline: none;
                color: #666;
                
                -moz-border-radius: 8px;
                -webkit-border-radius: 8px;
                margin: 5px 0px 10px 0px;
                padding: 10px;
                height: 75px;
                width: 350px;
                border: #999 1px solid;
                font-family: Arial, Helvetica, sans-serif;
            }
            .input{
                height: 16px;
                -webkit-border-radius: 3px;
                border: #999 1px solid;
                color: #666;
            }
            label{
                font-weight: bold;
            }
          
            
          </style>
          <script>
            /*Valido los campos del formulario si estan null */
            $(document).ready(function () {
                $(".boton").click(function (){
                    $(".errorr").remove();
                if( $("#esp").val() == ""){
                        $("#tipos").html("<span class='errorr'>Ingrese la Especificaci&oacute;n del Cr&eacute;dito</span>");
                        
                        return false;
                    }
                });
                
                $("#val, #periodoss, #esp").keyup(function(){
		  if( $(this).val() != "" ){
		      $(".errorr").fadeOut();
		      return false;
		  }
		});
                
                
	          $('form').submit(function() {
	          $.ajax({
                          url: $(this).attr('action'),
                          type:'POST',
                          data:$(this).serialize(),
                          beforeSend: function(){
                            notify("Enviando...",500,80000,"info","info");
                            $("#enviar").css("display", "none");
                            $("textarea").val(null);
                            },success : function(data){
                                notify(data,500,5000,"email","email");
                                
                            }, complete: function(){
                                $("#enviar").css("display", "inline");
							
			    }
                        });
                  
                   return false;
	       });  
            });
			 
		$(function(){	
	          try{			
		      $(".boton").button(); //clase para los botones
	          }catch(err){return;}
	        });
          </script>
	
	
  </head>
  <body>
  <br />
  <br />


<form action="correo_credito_vivi.php" method="post">
   <fieldset style="width: 460px; margin:0 auto 0 auto; border-radius: 5px;">
     <legend><h2 >Solicitud de Cr&eacute;dito de Vivienda</h2></legend> <br>
       
       
       <p style="padding-top:6px"><label>Especificaci&oacute;n del Cr&eacute;dito: </label><br><textarea name="esp" id="esp" cols="25" rows="5"></textarea><span id="tipos"></span></p>
      <center>
       <input type="submit" id="enviar" name="enviar" class="boton" value="Enviar"/>
     </center>
    </fieldset>
</form>
</body>
</html>
