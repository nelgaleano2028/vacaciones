<?php
@session_start();


if (!isset($_SESSION['privi'])){
  
echo "<script>location.href='index.php'</script>";
}
require_once('../lib/configdb.php');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/validacion.css" media="screen" />
<title>Pagos</title>
<style>



 			#principal{
				margin: 0 auto;
				width: 600px;
				
			}
			fieldset{
					margin-top:10%;
					width: 300px;
					border-radius: 0.6em;
					z-index: 50;
					margin-left:10%;
			}
			
			form{
					
					padding: 15px;
			}
				
			.boton{
					margin-top: 15px;
					margin-left: 30%;
					width: 100px;
					height: 30px;
					text-align: center;
					background: #4c4e5a;
					color:#FFF !important;
					cursor:pointer;
					
			}
			
			input[type='text'], .combo, #fin{
					text-align: left;
					padding: .2em;
					width:150px;
					/*margin-top: 8px;*/
			}

			.alinear{
					margin: .4em 0;
			}
			
			.alinear label{
				width: 25%;
				float: left;
			}
			label{
			font-weight:bold;
			font-family:Arial, Helvetica, sans-serif;
			font-size:13px;
			}

		 </style>
<script src="../js/jquery-1.7.1.min.js"></script>
<script>
$(document).ready(function(){
$(".boton").click(function(){
  
  
  $(".errorr").remove();
  
  $(".mes").keypress(function(){
    
           $(".errorr").remove();

    })
    
  $(".dia").keypress(function(){

           $(".errorr").remove();

    })
  
  if($(".mes").val()==0){

     $("#val").html("<span class='errorr'>Ingrese el Mes</span>");
     return false;
  }else if($(".dia").val()==0){
  
           $("#val2").html("<span class='errorr'>Ingrese el dia</span>");
           return false;
  
  }else{
    
    
      $.ajax({
                url:"verificar_pago.php",
                type:"GET",
                data:$("#form").serialize(),
                beforeSend:function(){
                  
                  alert("Procesando...");
                  
                  $(".esconder").fadeOut("slow");

                  },
                success:function(data){

                  alert(data);
                  $(".esconder").fadeIn("slow");

                }

         });
         
         return false;
  
  
  
  
  }

  });

});
</script>
</head>

<body>
<br>
<div id="principal">

<fieldset><legend><h2>Cierre Pagos a&ntilde;o <?php echo date("Y");?></h2></legend>

<form action=""  id="form">

<div class="alinear">
    <label>Mes:</label>
    <input  type="text" name="mes" class="mes" value=""/><span id="val"></span>
    <span id="val4"></span>
</div>
<div class="alinear">
    <label>D&iacute;as:</label>
    <input  type="text" name="dia" class="dia" value=""/><span id="val2"></span>
    <span id="val4"></span>
</div>

<div class="esconder">
<input type="submit" class="boton" name="guardar" value="Enivar">
 </div>
</form>
</fieldset>


</body>
</html>