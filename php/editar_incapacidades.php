<?php
session_start();

include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

$nomadmin = $_SESSION['nom'];

//validacion bd f
$consultaf = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['NOM_ADMIN'])){
$conn = $configf;
}
if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;
}
if(isset($rowa['NOM_ADMIN'])){
$conn = $config;
}
if(isset($rowt['NOM_ADMIN'])){
$conn = $configt;
}

$codigo=$_GET['codigo'];
$diastomados=$_GET['diast'];
$estado='P';
$hoy = date("m/d/Y");

/*
$qry1="select * from parametros_nue where NOM_VAR='param_vacas_cod_con'";

$rh1 = $conn->Execute($qry1);
$row1 = $rh1->FetchRow();

@$cod_con=@$row1["DESCRIPCION"];*/

@$cod_con='1017';


/*$qry2="select * from parametros_nue where NOM_VAR='param_vacas_cod_aus'";

$rh2 = $conn->Execute($qry2);
$row2 = $rh2->FetchRow();

@$cod_aus=@$row2["DESCRIPCION"];*/

@$cod_aus='1';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>


<style>
body{
	font-size: 12px;
	font-family:Arial, Helvetica, sans-serif;
	 }

	table#padre{ width:60%;}
	
	table{ width:60%; }

   	#testTable { 
           
            margin-left: auto;
            
            margin-right: auto;
            
 
          }
          
         #tablePagination { 
            
	   background-color: #DCDCDC;             
            padding: 0px 5px;
            padding-top: 2px;
            height: 25px;
	    width: 58%;
	    margin: auto;
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
<style type="text/css">
@import url("../css/plantilla_user.css");
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
    </style>

<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
<link rel="stylesheet" type="text/css" href="../css/plantilla_user.css" />

<link href="../css/tcal.css" rel="stylesheet" type="text/css" />

 <script type="text/javascript" src="../js/tcal.js"></script> 

<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>


   <!-- MODAL-->
   	<script type='text/javascript' src="js/jquery-ui-1.8.17.custom.min.js"></script>
   	<script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
   	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.mouse.js"></script>
	<script src="js/jquery.ui.button.js"></script>
	<script src="js/jquery.ui.draggable.js"></script>
	<script src="js/jquery.ui.position.js"></script>
	<script src="js/jquery.ui.dialog.js"></script>
   <!-- FIN MODAL-->
	
   <!-- PAGINACION-->
	 <link rel="stylesheet" href="../js/__jquery.tablesorter/themes/blue/style.css" type="text/css"/>
	 <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.js" type="text/javascript"></script>
         <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.min.js" type="text/javascript"></script>
         <script src="../js/__jquery.tablesorter/jquery-latest.js" type="text/javascript"></script>
         <script src="../js/__jquery.tablesorter/jquery.tablesorter.js" type="text/javascript"></script>
   <!-- FIN PAGINACION-->


<script>
	/*paginacion id de la tabla*/
            $(document).ready(function() {
         
		  $('#vacaciones').tablePagination({});
			
			
            } );
			
            /*quita todo conflicto de jquery*/
              var $j = jQuery.noConflict();
			  
			  /*ordenamiento id de la tabla*/
         $j(document).ready(function(){
    
     
	  $('#vacaciones').tablePagination({});



	//$j("#compro_ultimo").tablesorter(); 
    } 
); 


        </script>


<script type="text/javascript" charset="utf-8">
		
	 $(document).ready(function() {
				  
	  	$("#calcular").click(function (){
			
			var dias = $("#dias").val();
			var fecha_ini = $("#fecha_ini").val();
			


		
		if(fecha_ini==""){
			$("#validacion").html("<p style='color:red; font-weight:bold'>El Campo DESDE se encuentra Vacio</p>");
		
		}else{
			
		
		$.ajax({
		  	url: "fecha_incapacidades.php",
		  	type : "POST",
			cache:false,
		  	data : "dias="+dias+"&fecha_ini="+fecha_ini,
		    	success: function(data){
			   
				 if(data=="1"){
				   alert("No puedes iniciar las vacaciones en este dia, debes iniciar en dia habil");
				   document.getElementById("fecha_fin").value="";
			  	 }else
				if(data=="2"){
				   alert("Debes elegir una fecha mayor a la actual");
				   document.getElementById("fecha_fin").value="";
			  	 }else
				if(data=="4"){
				   alert("Su fecha de solicitud se encuentra dentro de un rango solicitado anteriormente. Por favor verifique");
				   document.getElementById("fecha_fin").value="";
			  	 }else
				if(data=="5"){
				   alert("La cantidad de dias solicitados excede sus dias disponibles");
				   document.getElementById("fecha_fin").value="";
			  	 }else{
				   
			  	document.getElementById("fecha_fin").value=data;
			   	}
			   }	
		  
			}); 					

			}
	 	});	   
    
	    
	   function modal_iframe(url,title,e){
        
            e.preventDefault();
            var $this = $(this);
            var horizontalPadding = 20;
            var verticalPadding = 5;
            
            $('<iframe id="site" src="'+url+'" />').dialog({
            
                title: ($this.attr('title')) ? $this.attr('title') : '<H3>'+title+'</H3>',
                autoOpen: true,
                width: 800,
                height: 380,
                modal: true,
		resizable: false,
                autoResize: true,
		hide:'drop',
		overlay: { backgroundColor: "white", opacity: 0.5 },
		open: function (event,ui) {
		                           
		                           $(this).css('width','97%'),
		                           $(this).css('height','358px')
					 
					   
					   },
		
	        buttons: {
		    
                "Cerrar": function() {
                         $( this ).dialog( "close" );
                                     }
				     
                     }
                
            })
	    
	    } 
   
	 $('#editar').click( function(e) {
	
      	modal_iframe("edicion.php","Editar Solicitudes",e);
		
	} );
	
});



function validar(){

if(document.formulario.fecha_ini.value=="" || document.formulario.fecha_fin.value==""){
	
	alert("Existen Campos Vacios");
	return false;

}else{
	confirmado = confirm("¿está seguro de las fechas seleccionadas?"); 
	if (confirmado) {
// si pulsamos en aceptar
	return true;
	}else {
// si pulsamos en cancelar
return false;
alert('Verifica de nuevo tus datos'); 
}  
	
}

}

</script>
</head>

<body>
<?php


$qry1="select  *  from incapacidades_tmp where CNSCTVO='".$_GET['numero']."' and cod_epl='".$codigo."'";
$rh1 = $conn->Execute($qry1);
$row1 = $rh1->FetchRow();

@$fecha_ini1=@$row1["FEC_INI"];
@$fecha_fin1=@$row1["FEC_FIN"];
@$dias=@$row1["DIAS"];

//var_dump($fecha_fin);die("");

@$fecha_ini=date("m/d/Y",strtotime($fecha_ini1)); 

@$fecha_fin=date("m/d/Y",strtotime($fecha_fin1)); 


?>


<br></br>


<fieldset style="width: 800px; margin:0 auto 0 auto; border-radius: 5px;"><legend><h2 >Seleccione el per&iacute;odo</h2></legend>

<br />

<form method="post" name="solicitud" action="actualizar.php" id="solicitud" onSubmit="return validar();">

<p><label><strong class="tam_str">D&iacute;as a Tomar:</strong></label> <select id="dias" name="dias" class="combo" style="width:80px;" disabled="disabled">
				<option value="<?php echo $diastomados; ?>"><?php echo $diastomados; ?></option>
               
               
              </select>    &nbsp;&nbsp;&nbsp;
              
            <label><strong class="tam_str">Desde:</strong></label><input type="text" class="tcal" name="fecha_ini" id="fecha_ini" style="background-color: white;" value="<?php echo $fecha_ini; ?>"/>&nbsp;&nbsp;&nbsp;
	    <label><strong class="tam_str">Hasta: </strong></label><input type="text" name="fecha_fin" id="fecha_fin" readonly="readonly" style="background-color: white;"/> <a  id="calcular" style="color:blue; border:1px  solid #000; background-color:#CCC; cursor:pointer; padding: 1px">CALCULO</a> </p>
            
<input type="hidden" name="codigo"  size="15" value="<?php echo @$codigo ?>" />
 <input type="hidden" name="estado" value="<?php echo @$estado ?>" />
  <input type="hidden" name="numero" value="<?php echo @$_GET['numero'] ?>" />
  <input type="hidden" name="diasc" value="<?php echo $dias ?>" />
 

<br />

<div id="validacion"></div>
<br />

<p><input type="submit" class="boton" id="btn" value="Enviar Solicitud" /></p>
<!--<input id="editar" class="boton" type="button" title="Edicion" value="Editar Solicitud"/></p>-->

</form>
</fieldset>

<br />

</body>
</html>
