<?php
@session_start();

//------------------------------antidoto
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}

//global $conn;

$codigo=$_SESSION['cod'];
$estado='P';
$hoy = date("m/d/Y");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

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
			
			var cod_aus= $("#cod_aus").val();
			var codigo_epl = $("#cod_epl").val();
			var nom_aus= $("#cod_aus option:selected").html();
			
		

		
		if(fecha_ini==""){
			$("#validacion").html("<p style='color:red; font-weight:bold'>El Campo DESDE se encuentra Vacio</p>");
		
		}else{
			
		
		$.ajax({
		  	url: "fecha_incapacidades.php",
		  	type : "POST",
			cache:false,
		  	data : "dias="+dias+"&fecha_ini="+fecha_ini+"&cod_aus="+cod_aus+"&cod_epl="+codigo_epl+"&nom_aus="+nom_aus,
		    	success: function(data){
					
					console.log(data); 
			   
				 if(data=="1"){
				   alert("No puedes iniciar la incapacidad en este dia, debes iniciar en dia habil");
				   document.getElementById("fecha_fin").value="";
			  	 }else
				if(data=="2"){
				   alert("Debes elegir una fecha igual o menor a la actual");
				   document.getElementById("fecha_fin").value="";
			  	 }else
				if(data=="4"){
				   alert("Su fecha de solicitud se encuentra dentro de un rango solicitado anteriormente. Por favor verifique");
				   document.getElementById("fecha_fin").value="";
			  	 }else
				if(data=="5"){
				   alert("La cantidad de dias solicitados excede sus dias disponibles");
				   document.getElementById("fecha_fin").value="";
			  	 }else
				if(data=="10"){
				   alert("La Licencia de Paternidad solo admite dias entre 1 hasta 8.");
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

<br><br>
<center>



<br />

<p>
<center>
<h2>REPORTE DE INCAPACIDADES</h2></center><br>

<br />
<form method="post" name="formulario" action="envio_incapacidades.php" id="formulario" onSubmit="return validar();">
<fieldset style="width: 800px; margin:0 auto 0 auto; border-radius: 5px;">

<label><strong class="tam_str">Colaborador:</strong></label> 
<select id="cod_epl" name="cod_epl" class="combo" style="width:180px;">

<?php

$codiepl = $_SESSION['cod'];

   //validacion bd f
$consultaf = "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;

//QUERY PARA EMPLEADOS DEL JEFE

$qry3="select b.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL  from empleados_gral b, empleados_basic a WHERE a.estado = 'A' and b.cod_epl = a.cod_epl and COD_JEFE = '$codigo'";
			  
$rh03 = $conn->Execute($qry3); 
while($row03 = $rh03->FetchRow()){
$COD_EMPLEADO=$row03["COD_EPL"];
$NOM_EMPLEADO=$row03["NOM_EPL"];
$APE_EMPLEADO=$row03["APE_EPL"];?>
				<option value="<?php echo $COD_EMPLEADO; ?>"><?php echo $NOM_EMPLEADO." ".$APE_EMPLEADO; ?></option>
                <?php } 
}
if(isset($rowc['CONTEO'])){
$conn = $configc;

//QUERY PARA EMPLEADOS DEL JEFE

$qry3="select b.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL  from empleados_gral b, empleados_basic a WHERE a.estado = 'A' and b.cod_epl = a.cod_epl and COD_JEFE = '$codigo'";
			  
$rh03 = $conn->Execute($qry3); 
while($row03 = $rh03->FetchRow()){
$COD_EMPLEADO=$row03["COD_EPL"];
$NOM_EMPLEADO=$row03["NOM_EPL"];
$APE_EMPLEADO=$row03["APE_EPL"];?>
				<option value="<?php echo $COD_EMPLEADO; ?>"><?php echo $NOM_EMPLEADO." ".$APE_EMPLEADO; ?></option>
                <?php } 
}
if(isset($rowa['CONTEO'])){
$conn = $config;

//QUERY PARA EMPLEADOS DEL JEFE

$qry3="select b.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL  from empleados_gral b, empleados_basic a WHERE a.estado = 'A' and b.cod_epl = a.cod_epl and COD_JEFE = '$codigo'";
			  
$rh03 = $conn->Execute($qry3); 
while($row03 = $rh03->FetchRow()){
$COD_EMPLEADO=$row03["COD_EPL"];
$NOM_EMPLEADO=$row03["NOM_EPL"];
$APE_EMPLEADO=$row03["APE_EPL"];?>
				<option value="<?php echo $COD_EMPLEADO; ?>"><?php echo $NOM_EMPLEADO." ".$APE_EMPLEADO; ?></option>
                <?php } 
}
if(isset($rowt['CONTEO'])){
$conn = $configt;

//QUERY PARA EMPLEADOS DEL JEFE

$qry3="select b.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL  from empleados_gral b, empleados_basic a WHERE a.estado = 'A' and b.cod_epl = a.cod_epl and COD_JEFE = '$codigo'";
			  
$rh03 = $conn->Execute($qry3); 
while($row03 = $rh03->FetchRow()){
$COD_EMPLEADO=$row03["COD_EPL"];
$NOM_EMPLEADO=$row03["NOM_EPL"];
$APE_EMPLEADO=$row03["APE_EPL"];?>
				<option value="<?php echo $COD_EMPLEADO; ?>"><?php echo $NOM_EMPLEADO." ".$APE_EMPLEADO; ?></option>
                <?php } 
}
//------------------------------FIN antidoto

              ?> 
              </select>	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			  
			 
<label><strong class="tam_str">Tipo de incapacidad:</strong></label> <select id="cod_aus" name="cod_aus" class="combo" style="width:180px;">
				<option value="2">Enfermedad General</option>
				<option value="F">Licencia de Maternidad</option>
				<option value="M">Licencia de Paternidad</option>
				<option value="4">Enfermedad/Accidente Laboral</option>
                </select>
<br />
</fieldset>
<br />

<fieldset style="width: 800px; margin:0 auto 0 auto; border-radius: 5px;">

<br />
  


<p>
  <label><strong class="tam_str">D&iacute;as de incapacidad:</strong></label> <input name="dias" type="text" id="dias" size="3" maxlength="3">
               
                 &nbsp;&nbsp;&nbsp;
              
      <label><strong class="tam_str">Desde:</strong></label><input type="text" class="tcal" name="fecha_ini" id="fecha_ini" readonly="readonly" onFocus="javascript:fecha_fin.value=''" style="background-color: white;"/>&nbsp;&nbsp;&nbsp;
	    <label><strong class="tam_str">Hasta: </strong></label><input type="text" name="fecha_fin" id="fecha_fin" readonly="readonly" style="background-color: white;"/> <a  id="calcular" style="color:blue; border:1px  solid #000; background-color:#CCC; cursor:pointer; padding: 1px">CALCULO</a> </p>
            
 <input type="hidden" name="estado" value="<?php echo $estado ?>" />
 
 <input type="hidden" name="cod_cc2" value="<?php echo $cod_cc2 ?>" />
 

<br />

<div id="validacion"></div>
<br />


<!--<input id="editar" class="boton" type="button" title="Edicion" value="Editar Solicitud"/></p>-->
</fieldset>
<p><input type="submit" class="boton" id="btn" value="Reportar" /></p>
</form>


<br />


 <table width="100%" height="30" border="0">
<tr>
<td height="30">
</td>
</tr>
<tr>
          <td class="piepag">Cualquier inconveniente que tengas, crea tu tiquete a la Mesa Centro de Servicios Compartidos haciendo <a href="http://clienteinterno:9000/MesasAyuda/Categorias/113/Subcategorias/729/Productos/5119/Problemas" style="color: #770003">clic aquí</a> y adjunta el pantallazo con el error.</td>
        </tr>
</table>
</body>

</html>
<?php
if(@$_GET['293875'] == "77"){ 
?> 
     <script> 

      alert("No se pudo enviar la solicitud, la incapacidad no es coherente con el genero del empleado");
	  
     </script>  
<?php
}
?> 
