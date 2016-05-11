<html>
    <title>.:Instalaci&oacute;n Monitores:.</title>
<head>

	  <!--Estilos UI-->
	 <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
	 <link rel="stylesheet" type="text/css" href="../css/general.css" />
	 <link type="text/css" href="../js/chosen/chosen.css" rel="stylesheet" />
	 <!--Fin UI-->
	 
	 <!--Estilo de notificaciones-->
	 <link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
	 <!--Fin notificaciones-->
	 
	 <!--estilo para las validaciones-->
	 <link rel="stylesheet" href="../css/validacion.css" media="screen" />
	 <!--Fin validaciones-->

	  <!--JS Ui,Funciones-->
	  <script src="../js/jquery-1.7.1.min.js"></script>
	  <script type='text/javascript' src='../js/jquery-ui-1.8.17.custom.min.js'></script>
	  <script type='text/javascript' src='../js/funciones.js'></script>
	  <script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
	  <!--fin JS-->
	
	
	<script>
	
	  $(document).ready(function () {
	      
	  /*Valido los campos del formulario si estan null */
	  
	      $(".boton").click(function (){
		  $(".errorr").remove();
		  if( $(".campo1").val() == "" ){
		       $("#val").html("<span class='errorr'>Seleccione un Motor</span>");
		      return false;
		  }else if( $(".campo2").val() == "" ){
		      $("#base").html("<span class='errorr'>Ingresar Base de datos</span>");
		      return false;
		  }else if( $(".campo3").val() == ""){
		      $("#usu").html("<span class='errorr'>Ingresar Usuario</span>");
		      
		      return false;
		  }
		  else if( $(".campo5").val() == "" ){
		      $("#ser").html("<span class='errorr'>Ingrese Servidor</span>");
		      //$(".mensaje").focus().after("<span class='error'>Seleccione liquidacion</span>");
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
	      
	       $(".campo4").keypress(function(e) {
		    
		  code = e.keyCode ? e.keyCode : e.which ;
		  //boolean de estado para SHIFT
		  shif = e.shiftKey ? e.shiftKey: ( (code == 16) ? true : false ) ;
		  if(((code >= 65 && code <= 90) && !shif ) || ((code >= 97 && code <= 122 ) && shif))
		    {
		       $("#cont").html("<span class='errorr'>La tecla Bloq Mayus esta activa</span>");
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
		    
	  /*Fin de validacion del formulario*/	 
	</script>
	
	
	<style>
	  
	  body{
	    font-family: arial,sans-serif;
            font-size: 14px;
	  }
	  .formulario{
		    padding-top: 40px;
	  }
	  
	</style>
	
</head>
<body>
	  <div class="formulario" align="center" id="div_install_essentials" name="div_install_essentials">
	  <fieldset style="width:30%"><legend class="formulario_fieldset"><h3>Instalación - Paso 1 - Conexi&oacute;n con la Base de datos</h3></legend>
	  <div name="grp1" id="grp1">
	  <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
	  <table class="fondo_tabla_form" border="0" align="center" cellpadding="2" cellspacing="0" valign="top" width="100%">
		  <tbody>
		       <tr>
			  <td class="etiqueta" width="50%">Seleccione Motor:</td><td width="50%">
			  <select class="combo campo1" style="width: 100%" name="engine" id="engine" size="0">
			  <option value="">Seleccione...</option>
			  <option value="mysql">MySQL</option>
			  <option value="odbc_mssql">SQL SERVER</option>
			  <option value="oci8">ORACLE</option>
			  </select><span id="val"></span>
			  </td>
		        </tr>
		  <tr>
			  <td class="etiqueta" width="50%">Base de datos:</td><td width="50%"><table cellpadding="0" border="0" cellspacing="0"><tbody><tr><td><input class="caja campo2" type="text" name="db" id="db" value="" size="" maxlength=""><span id="base"></span></td></tr></tbody></table></td>
		  </tr>
		  
		  <tr>
			  <td class="etiqueta" width="50%">Usuario:</td><td width="50%"><table cellpadding="0" border="0" cellspacing="0"><tbody><tr><td><input class="caja campo3" type="text" name="user_db" id="user_db" value="" size="" maxlength=""><span id="usu"></span></td></tr></tbody></table></td>
		  </tr>
		  <tr>
			  <td class="etiqueta" width="50%">Contraseña:</td><td width="50%"><input class="caja campo4" type="password" name="passwd_db" id="passwd_db" value="" size="" maxlength="" ><span id="cont"></span></td>
		  </tr>
		  <tr>
			  <td class="etiqueta" width="50%">Servidor:</td><td width="50%"><table cellpadding="0" border="0" cellspacing="0"><tbody><tr><td><input class="caja campo5" type="text" name="host_db" id="host_db" value="" size="" maxlength=""><span id="ser"></span></td></tr></tbody></table></td>
		  </tr>
		  
		  <tr>
			  <td class="etiqueta" width="50%">Puerto:</td><td width="50%"><table cellpadding="0" border="0" cellspacing="0"><tbody><tr><td><input class="caja campo6" type="text" name="host_port" id="host_port" value="" size="" maxlength="5" onkeypress="return OnlyNum(event)"><span id="puerto"></span></td></tr></tbody></table></td>
		  </tr>
	  </tbody></table>
	  </div>
	  </fieldset>
	  
	  <table border="0" align="center" cellpadding="2" cellspacing="0" valign="top" width="97%" height="0%">
		  <tbody><tr>
			  <td width="100%" style="text-align:center" colspan="2"><button  value="Conectar" class="boton" type="submit" name="btn_install" id="btn_install"><img style="padding-right: 2px;" src="../imagenes/logo.png" width="30" border="0">Conectar</button>
	  </tbody></table>
	  
	  </form>
	  </div>
</body>
</html>
<?php

	  if($_POST){
	      if($_POST["engine"]=='odbc_mssql'){
	      
		   $dns='Driver={SQL Server};Server='.$_POST["host_db"].';Database='.$_POST["db"].';';
		   $conexion='Connect($dsn,$user,$pass)';
		}elseif($_POST["engine"]=='mysql'){
	      
		   $dns=$_POST["host_db"];
		   $conexion='Connect($dsn,$user,$pass,"'.$_POST["db"].'")';
		}elseif($_POST['engine']=="oci8"){
		    
		         
	                 $dns = '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST='.$_POST['host_db'].')(PORT='.$_POST['host_port'].'))(CONNECT_DATA=(SID='.$_POST['db'].')))';
                        $conexion='Connect($dsn,$user,$pass)';
                         
		}
		
	   $archivo = "../lib/connection.php"; //Archivo en el cual escribiremos
	   $datos = '<?php
	   include_once("adodb/adodb.inc.php");
	   
	   include_once("adodb/adodb-exceptions.inc.php");
           include_once("adodb/adodb-error.inc.php");
	   
	   $odbc="'.$_POST["engine"].'";
	   $user = "'.$_POST["user_db"].'";
	   $pass = "'.$_POST["passwd_db"].'";
	   
	   $is_connect = false;
	   
	   try{
	   $conn = ADONewConnection($odbc);
	   $dsn ="'.@$dns.'";
	   @$conn->'.@$conexion.';
	   $conn->SetFetchMode(ADODB_FETCH_ASSOC);
	   
	   if($conn->isConnected())$is_connect=true;
	   else $is_connect=false;
	   }catch (exception  $e) 
	   { 
	      die($e->getMessage());
	     
	   }
	   ?>'; // Contenido a escribir en el archivo $archivo
	   $fp = @fopen($archivo,'w+');// Abrimos el archivo en forma de escritura (a)
	   @fwrite($fp, $datos); // Colocamos los datos apuntando al archivo en gestor ($fp) con el contenido de $datos
	   @fclose($fp); //Cerramos el modo de escritura en archivo $archivo
	   
	   if(file_exists("../lib/connection.php")){
		    
	   include_once("../lib/connection.php");
	   
	   global $is_connect;
	   if($is_connect==true){
		    
		    echo "<script>alert('La conexion se realizo satisfactoriamente');</script>";
?>

<center><a href="datos.php">Ir</a></center>
<?php
	   }else{
		    echo "<script>alert('Error al conectar con el servidor verifique los datos ingresados');</script>";
		    
	        }
	    }
	  }
?>


