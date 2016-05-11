<?php
@session_start();


if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}
//require_once('../lib/configdb.php');
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');


$codiepl = $_SESSION['ced'];

   //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
}
//------------------------------FIN antidoto



//global $conn;

$codigo=$_SESSION['cod'];
$estado='P';
$hoy = date("m/d/Y");



@$cod_aus='1';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="X-UA-Compatible" content="IE=9" />


<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
<link rel="stylesheet" type="text/css" href="../css/plantilla_user.css" />




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
		  	url: "fecha_horasextras.php",
		  	type : "POST",
			cache:false,
		  	data : "dias="+dias+"&fecha_ini="+fecha_ini+"&cod_aus="+cod_aus+"&cod_epl="+codigo_epl+"&nom_aus="+nom_aus,
		    	success: function(data){
					
					console.log(data); 
			   
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

var value_input = $("input[name*='fecha_ini[]']").val();
alert(value_input);
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
<script>
$(document).ready(function() {
	//ACA le asigno el evento click a cada boton de la clase bt_plus y llamo a la funcion addField
		$(".bt_plus").each(function (el){
			
			$(this).bind("click",addfield);
									 });
							})
 
 function multiplicarInputs(){
      
    var div='';
	var clickID = parseInt($(this).parent('div').attr('id').replace('hora_ext_',''));
 		alert('HO');
// Genero el nuevo numero id
var newID = (clickID+1);
	//div+="<input type='text' class='tcal' name='fecha_ini_"+newID+"' id='fecha_ini"+newID+"' readonly='readonly'  style='background-color: white;'/>";
	document.write('<?php echo '<input type="text" class="tcal" name="fecha_ini_1" id="fecha_ini1" readonly="readonly" style="background-color: white;"/>';?>');
		//alert(div);
      //document.getElementById("hora_ext_"+clickID).innerHTML=div;
}
 
function addField(){
// ID del elemento div quitandole la palabra "div_" de delante. Pasi asi poder aumentar el número. Esta parte no es necesaria pero yo la utilizaba ya que cada campo de mi formulario tenia un autosuggest , así que dejo como seria por si a alguien le hace falta.
 
var clickID = parseInt($(this).parent('div').attr('id').replace('hora_ext_',''));
 
// Genero el nuevo numero id
var newID = (clickID+1);
 
// Creo un clon del elemento div que contiene los campos de texto
$newClone = $('#hora_ext_'+clickID).clone(true);
//newClone = jQuery.extend(true, {}, $('#hora_ext_'+clickID));
 
//Le asigno el nuevo numero id
$newClone.attr("id",'hora_ext_'+newID);
 
//Asigno nuevo id al primer campo input dentro del div y le borro cualquier valor que tenga asi no copia lo ultimo que hayas escrito.(igual que antes no es necesario tener un id)
$newClone.children("input").eq(0).attr("id",'dias'+newID).val('');
 
/*//Borro el valor del segundo campo input(este caso es el campo de cantidad)
$newClone.children("input").eq(1).attr("id",'fecha_ini'+newID).val('');
$newClone.children("input").eq(1).attr("name",'fecha_ini'+newID).val('');
$newClone.children("input").eq(1).attr("class",'tcal').val('');
*/
//Borro el valor del segundo campo input(este caso es el campo de cantidad)
$newClone.children("select").eq(0).attr("id",'cod_con'+newID).val('');
 
//Asigno nuevo id al boton
$newClone.children("input").eq(2).attr("id",newID)
 
//Inserto el div clonado y modificado despues del div original
$newClone.insertAfter($('#hora_ext_'+clickID));
 
//Cambio el signo "+" por el signo "-" y le quito el evento addfield
$("#"+clickID).val('-').unbind("click",addField);
 
//Ahora le asigno el evento delRow para que borre la fial en caso de hacer click
$("#"+clickID).bind("click",delRow);					
 
}
 
 
function delRow() {
// Funcion que destruye el elemento actual una vez echo el click
$(this).parent('div').remove();
 
}
</script>

<link rel="stylesheet" href="../development-bundle/themes/base/jquery.ui.all.css">
<script src="../development-bundle/jquery-1.6.2.js"></script>
	<script src="../development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../development-bundle/ui/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="../development-bundle/demos/demos.css">


	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	</script>
</head>


<body>

<br><br>
<center>



<br />

<p>


<?php


//QUERY PARA EMPLEADOS DEL JEFE

$qry3="select b.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL  from empleados_gral b, empleados_basic a WHERE a.estado = 'A' and b.cod_epl = a.cod_epl and COD_JEFE = '$codigo'";
			  
$rh03 = $conn->Execute($qry3); 

//QUERY PARA CONCEPTOS

$qry4="select cod_con as COD_CON, nom_con as NOM_CON from CONCEPTOS WHERE CAUSA_INC = 'S'";
			  
$rh04 = $conn->Execute($qry4); 

?>

<center>
<h2>HORAS EXTRAS</h2></center><br>

<br />
<form method="post" name="formulario" action="envio_horasextras.php" id="formulario" onSubmit="return validar();" enctype="multipart/form-data">


<fieldset style="width: 800px; margin:0 auto 0 auto; border-radius: 5px;">

<br />


<p>	 	     </p>
  <div class="demo">

<p>Date: <input type="text" id="datepicker"></p>

</div><!-- End demo -->
              
      <label><strong class="tam_str">EL DIA:</strong></label>
	  
	  <input type="text" class="tcal" name="fecha_ini_1" id="fecha_ini1" readonly="readonly" 
	  style="background-color: white;"/>&nbsp;&nbsp;&nbsp;
	  	  
	  <label><strong class="tam_str">Concepto:</strong></label> <select id="cod_con1" name="cod_con[]" class="combo" style="width:80px;">
				<option value="1005">Recargo nocturno ordinario - 1005</option>
				<option value="1006">Horas extras diurnas - 1006</option>
				<option value="1007">Horas extras nocturnas - 1007</option>
				<option value="1008">Horas extras festiva diurna - 1008</option>
				<option value="1009">Horas extras festiva nocturna - 1009</option>
				<option value="1118">Recargo nocturno dominical - 1118</option>
				<option value="1119">Recargo diurno dominical - 1119</option>
                </select>

		 <input id="1" class="bt_plus" type="button" value="+" />
	
	
            
 <input type="hidden" name="codigo" value="<?php echo $codigo ?>" />
 <input type="hidden" name="estado" value="<?php echo $estado ?>" />
 

 <input type="hidden" name="cod_aus" value="<?php echo $cod_aus ?>" />
 <input type="hidden" name="cod_cc2" value="<?php echo $cod_cc2 ?>" />
 

<br />

<div id="validacion"></div>
<br />


<!--<input id="editar" class="boton" type="button" title="Edicion" value="Editar Solicitud"/></p>-->
</fieldset>
<p><input type="submit" class="boton" id="btn" value="Reportar" /></p>
</form>

<?php
if(@$_GET['293875'] == "81"){ 
?> 
     <script> 

      alert("No se pudo enviar la solicitud, debes seleccionar un dia anterior al actual");
	  
     </script>  
<?php
}
if(@$_GET['293875'] == "78"){ 
?> 
     <script> 

      alert("No se pudo enviar la solicitud, el concepto no pertenece al dia reportado");
	  
     </script>  
<?php
}
if(@$_GET['293875'] == "79"){ 
?> 
     <script> 

      alert("No se pudo enviar la solicitud, el concepto no pertenece al dia reportado");
	  
     </script>  
<?php
}
if(@$_GET['293875'] == "80"){ 
?> 
     <script> 

      alert("No se pudo enviar la solicitud, el concepto y dia ya fueron reportados anteriormente");
	  
     </script>  
<?php
}
if(@$_GET['293875'] == "76"){ 
?> 
     <script> 
	/* $(window).load(function(){
	 	notify("La solicitud fue enviada exitosamente",500,5000,"email","email");
	 });*/
      alert("La solicitud fue enviada exitosamente");
	  
     </script>  
<?php
}
?>
<br />


 <table width="100%" height="30" border="0">
<tr>
<td height="30">
</td>
</tr>
<tr>
          <td class="piepag">Cualquier inconveniente que tengas, crea tu tiquete a la Mesa Centro de Servicios Compartidos haciendo <a href="http://clienteinterno:9000/MesasAyuda/Categorias/113/Subcategorias/701/Productos/5030/Problemas" style="color: #770003">clic aquí</a> y adjunta el pantallazo con el error.</td>
        </tr>
</table>
</body>

</html>
