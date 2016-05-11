<?php
@session_start();



$codiepl = $_GET['cod'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="X-UA-Compatible" content="IE=9" />

<style>
body{
	font-size: 12px;
	font-family:Arial, Helvetica, sans-serif;
	 }

	table#padre{ width:80%;}
	
	table{ width:80%; }

   	#testTable { 
           
            margin-left: auto;
            
            margin-right: auto;
            
 
          }
          
         #tablePagination { 
            
	   background-color: #DCDCDC;             
            padding: 0px 5px;
            padding-top: 2px;
            height: 25px;
	    width: 80%;
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
$(function() {
$( ".datepicker" ).datepicker();
});
</script>

    




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




//}

</script>
<script>
$(document).ready(function() {
	//ACA le asigno el evento click a cada boton de la clase bt_plus y llamo a la funcion addField
	
	var d = new Date(); 
	var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();

	//$ ( ".datepicker" ) (.datepicker "opción" , "MaxDate" , strDate );
	
	
		$(".bt_plus").each(function (el){
			
			$(this).bind("click",addField);
			$('.obser').innerHTML="";
		 });
		 		 
		 $(".datepicker").change(function (){
			var id = $(this).attr('id');
			cambiaObservacion(id);			
		 });
		 
		 var dia_ini = "<?php echo $dia_ini; ?>";		 
		 var mes_ini = "<?php echo $mes_ini; ?>";		 
		 var ano_ini = "<?php echo $ano_ini; ?>";		 
		 
		 
		$( ".datepicker" ).datepicker( 'option', { minDate: new Date(ano_ini, mes_ini - 1, dia_ini) , maxDate: +0 });		 
		 
		 $( "#btn" ).click(function( ) {
			 			 
			 var fecha=document.getElementsByName("fecha_ini");
			 var fecha_arr = [];
			 for (var i = 0; i < fecha.length; ++i) {
			 	fecha_arr[i] = fecha[i].value;
			 }
			 var hora=document.getElementsByName("horas");
			 var hora_arr = [];
			 for (var i = 0; i < hora.length; ++i) {
			 	hora_arr[i] = hora[i].value;
			 }
			
			 var cod_con=document.getElementsByName("cod_con");
			 var cod_con_arr = [];
			 for (var i = 0; i < cod_con.length; ++i) {
			 	cod_con_arr[i] = cod_con[i].value;
			 }
			 
			 $.ajax({
				url: "envio_horasextras.php",
				type: "POST",
				data: "validar=Si&fecha_arr="+fecha_arr+"&hora_arr="+hora_arr+"&cod_con_arr="+cod_con_arr+"&codigo="+<?php echo $codigo ?>+"&estado=P&cod_aus="+<?php echo $cod_aus ?>,
				success:function(data) {
					var datos = data.split(",");
					agregarObservacion(datos);
					
				},
				error: function (xhr, ajaxOptions, thrownError) {
				}
				});
		});
})
	
	function validar(){
		
		var jefe = "<?php echo $cod_jefe; ?>";		

	/*if(document.formulario.fecha_ini.value=="" || document.formulario.fecha_fin.value==""){
		
		alert("Existen Campos Vacios");
		return false;

	}else{*/
		confirmado = confirm("¿Esta seguro que desea grabar la información y enviarle a tu jefe "+jefe+"?"); 
		if (confirmado) {
			insertarHorasExtras();
			return true;
		}else {
			// si pulsamos en cancelar
			return false;
			//alert('Verifica de nuevo tus datos'); 
		}  
		
	}

	function agregarObservacion(datos){
		var inserta = true;
		for (var i = 0; i < datos.length; ++i) {
						var res = datos[i];
						document.getElementsByName('observacion')[i].innerHTML=res;
						if (res.trim() != "OK"){
							inserta = false;
						}
		}	
		
		if (inserta === true){
			var r = validar();
		}else{
			alert("Corregir los campos mencionados");
		}
		
	}
	
	function insertarHorasExtras(){
		 var fecha=document.getElementsByName("fecha_ini");
		 var fecha_arr = [];
		 for (var i = 0; i < fecha.length; ++i) {
			fecha_arr[i] = fecha[i].value;
		 }
		 var hora=document.getElementsByName("horas");
		 var hora_arr = [];
		 for (var i = 0; i < hora.length; ++i) {
			hora_arr[i] = hora[i].value;
		 }		
		 var cod_con=document.getElementsByName("cod_con");
		 var cod_con_arr = [];
		 for (var i = 0; i < cod_con.length; ++i) {
			cod_con_arr[i] = cod_con[i].value;
		 }
		 
		 $.ajax({
			url: "envio_horasextras.php",
			type: "POST",
			data: "validar=Insertar&fecha_arr="+fecha_arr+"&hora_arr="+hora_arr+"&cod_con_arr="+cod_con_arr+"&codigo="+<?php echo $codigo ?>+"&estado=P&cod_aus="+<?php echo $cod_aus ?>,
			success:function(data) {							
				alert("La solicitud fue enviada exitosamente");
				location.reload();
			},
			error: function (xhr, ajaxOptions, thrownError) {				
			}
			});
	}
	
	function cambiaObservacion(id){	
		var clickID = parseInt(id.replace('fecha_ini',''));
		var id_dina = $('#observacion'+clickID).html("");
	}
	
	function addField(){
		// ID del elemento div quitandole la palabra "div_" de delante. Pasi asi poder aumentar el número. Esta parte no es necesaria pero yo la utilizaba ya que cada campo de mi formulario tenia un autosuggest , así que dejo como seria por si a alguien le hace falta.
		 
		var clickID = parseInt($(this).parent('div').attr('id').replace('hora_ext_',''));
		 
		// Genero el nuevo numero id
		var newID = (clickID+1);
		 
		// Creo un clon del elemento div que contiene los campos de texto
		$newClone = $('#hora_ext_'+clickID).clone(true);
		 
		//Le asigno el nuevo numero id
		$newClone.attr("id",'hora_ext_'+newID);
		 
		//Asigno nuevo id al primer campo input dentro del div y le borro cualquier valor que tenga asi no copia lo ultimo que hayas escrito.(igual que antes no es necesario tener un id)
		$newClone.children("input").eq(0).attr("id",'dias'+newID).val('');
		 
		//Borro el valor del segundo campo input(este caso es el campo de cantidad)
		$newClone.children("input").eq(1).datepicker('destroy');
		$newClone.children("input").eq(1).removeAttr("id");
		
		//Borro el valor del segundo campo input(este caso es el campo de cantidad)
		$newClone.children("select").eq(0).attr("id",'cod_con'+newID);
		 
		//Asigno nuevo id al boton
		$newClone.children("input").eq(2).attr("id",newID);
		$newClone.children("label").eq(3).attr("id","observacion"+newID).val('').html("");
		 
		//Inserto el div clonado y modificado despues del div original
		$newClone.insertAfter($('#hora_ext_'+clickID));
		$newClone.children("input").eq(1).attr("id",'fecha_ini'+newID).val('').datepicker();
		
		var dia_ini = "<?php echo $dia_ini; ?>";		 
		 var mes_ini = "<?php echo $mes_ini; ?>";		 
		 var ano_ini = "<?php echo $ano_ini; ?>";		
		$newClone.children("input").eq(1).datepicker( 'option', { minDate: new Date(ano_ini, mes_ini - 1, dia_ini),maxDate: +0 });
				
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
</head>


<body>

<br><br>
<center>
<h2>HISTORIAL DE HORAS EXTRAS</h2></center><br>

<table width="100%" id="vacaciones" class="tablesorter">

  <thead>
		<tr class="odd">
   		 <th width="5%" scope="col">Consecutivo</th>
   	    <th width="15%" scope="col">Fecha Solicitud</th>
		<th width="15%" scope="col">Fecha Horas extras</th>
	  	<th width="30%" scope="col">Concepto</th>	  	
	  	<th width="35%" scope="col">Estado</th>	  	
	</tr>	
	</thead>
  
	<tbody>
   <?php
				  include_once('../lib/configdbf.php');
				
				    //validacion bd f
$consultaf = "select cod_epl AS CONTEO  from empleados_gral WHERE cod_epl = '$codiepl' ";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();
				
if(isset($rowf['CONTEO'])){
$conn = $configf;
}	
					include_once("class_horasextrasgere.php");
					$administrador=new vacaciones();
					$lista3=$administrador->solicitud_pendientes_detalle();

for($i=0; $i<count($lista3); $i++){
	 
      ?>
		<td style="text-align:center"><?php echo $lista3[$i]["consecutivo"]; ?></td>
		<td style="text-align:center"><?php echo $lista3[$i]["fechasol"]; ?></td>
		<td style="text-align:center"><?php echo $lista3[$i]["fecha_ini"]; ?></td>
		<td style="text-align:center"><?php IF($lista3[$i]["concept"] == '1005'){ echo 'Recargo nocturno ordinario'; }ELSEIF($lista3[$i]["concept"] == '1006'){ echo 'Horas extras diurnas'; }ELSEIF($lista3[$i]["concept"] == '1007'){ echo 'Horas extras nocturnas'; }ELSEIF($lista3[$i]["concept"] == '1008'){ echo 'Horas extras festiva diurna'; }ELSEIF($lista3[$i]["concept"] == '1009'){ echo 'Horas extras festiva nocturna'; }ELSEIF($lista3[$i]["concept"] == '1118'){ echo 'Recargo nocturno dominical'; }ELSEIF($lista3[$i]["concept"] == '1119'){ echo 'Recargo diurno dominical'; }?></td>                    
		<td style="text-align:center"><?php IF($lista3[$i]["estado"] == 'P'){ echo 'Pendiente por aprobar jefe'; }ELSEIF($lista3[$i]["estado"] == 'R'){ echo 'Rechazado'; }ELSEIF($lista3[$i]["estado"] == 'L'){ echo 'Pendiente por aprobar gerente'; }ELSEIF($lista3[$i]["estado"] == 'C'){ echo 'Aprobado por gerente'; }?></td>
</tr><?php }

include_once('../lib/configdb.php');
				
				    //validacion bd f
$consultaf = "select cod_epl AS CONTEO  from empleados_gral WHERE cod_epl = '$codiepl' ";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();
				
if(isset($rowf['CONTEO'])){
$conn = $configf;
}	
					include_once("class_horasextrasgere.php");
					$administrador=new vacaciones();
					$lista3=$administrador->solicitud_pendientes_detalle();

for($i=0; $i<count($lista3); $i++){
	 
      ?>
		<td style="text-align:center"><?php echo $lista3[$i]["consecutivo"]; ?></td>
		<td style="text-align:center"><?php echo $lista3[$i]["fechasol"]; ?></td>
		<td style="text-align:center"><?php echo $lista3[$i]["fecha_ini"]; ?></td>
		<td style="text-align:center"><?php IF($lista3[$i]["concept"] == '1005'){ echo 'Recargo nocturno ordinario'; }ELSEIF($lista3[$i]["concept"] == '1006'){ echo 'Horas extras diurnas'; }ELSEIF($lista3[$i]["concept"] == '1007'){ echo 'Horas extras nocturnas'; }ELSEIF($lista3[$i]["concept"] == '1008'){ echo 'Horas extras festiva diurna'; }ELSEIF($lista3[$i]["concept"] == '1009'){ echo 'Horas extras festiva nocturna'; }ELSEIF($lista3[$i]["concept"] == '1118'){ echo 'Recargo nocturno dominical'; }ELSEIF($lista3[$i]["concept"] == '1119'){ echo 'Recargo diurno dominical'; }?></td>                    
		<td style="text-align:center"><?php IF($lista3[$i]["estado"] == 'P'){ echo 'Pendiente por aprobar jefe'; }ELSEIF($lista3[$i]["estado"] == 'R'){ echo 'Rechazado'; }ELSEIF($lista3[$i]["estado"] == 'L'){ echo 'Pendiente por aprobar gerente'; }ELSEIF($lista3[$i]["estado"] == 'C'){ echo 'Aprobado por gerente'; }?></td>
</tr><?php }

include_once('../lib/configdbt.php');
				
				    //validacion bd f
$consultaf = "select cod_epl AS CONTEO  from empleados_gral WHERE cod_epl = '$codiepl' ";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();
				
if(isset($rowf['CONTEO'])){
$conn = $configf;
}	
					include_once("class_horasextrasgere.php");
					$administrador=new vacaciones();
					$lista3=$administrador->solicitud_pendientes_detalle();

for($i=0; $i<count($lista3); $i++){
 
      ?>
		<td style="text-align:center"><?php echo $lista3[$i]["consecutivo"]; ?></td>
		<td style="text-align:center"><?php echo $lista3[$i]["fechasol"]; ?></td>
		<td style="text-align:center"><?php echo $lista3[$i]["fecha_ini"]; ?></td>
		<td style="text-align:center"><?php IF($lista3[$i]["concept"] == '1005'){ echo 'Recargo nocturno ordinario'; }ELSEIF($lista3[$i]["concept"] == '1006'){ echo 'Horas extras diurnas'; }ELSEIF($lista3[$i]["concept"] == '1007'){ echo 'Horas extras nocturnas'; }ELSEIF($lista3[$i]["concept"] == '1008'){ echo 'Horas extras festiva diurna'; }ELSEIF($lista3[$i]["concept"] == '1009'){ echo 'Horas extras festiva nocturna'; }ELSEIF($lista3[$i]["concept"] == '1118'){ echo 'Recargo nocturno dominical'; }ELSEIF($lista3[$i]["concept"] == '1119'){ echo 'Recargo diurno dominical'; }?></td>                    
		<td style="text-align:center"><?php IF($lista3[$i]["estado"] == 'P'){ echo 'Pendiente por aprobar jefe'; }ELSEIF($lista3[$i]["estado"] == 'R'){ echo 'Rechazado'; }ELSEIF($lista3[$i]["estado"] == 'L'){ echo 'Pendiente por aprobar gerente'; }ELSEIF($lista3[$i]["estado"] == 'C'){ echo 'Aprobado por gerente'; }?></td>
</tr><?php }

include_once('../lib/configdbc.php');
				
				    //validacion bd f
$consultaf = "select cod_epl AS CONTEO  from empleados_gral WHERE cod_epl = '$codiepl' ";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();
				
if(isset($rowf['CONTEO'])){
$conn = $configf;
}	
					include_once("class_horasextrasgere.php");
					$administrador=new vacaciones();
					$lista3=$administrador->solicitud_pendientes_detalle();

for($i=0; $i<count($lista3); $i++){

	 
      ?>
		<td style="text-align:center"><?php echo $lista3[$i]["consecutivo"]; ?></td>
		<td style="text-align:center"><?php echo $lista3[$i]["fechasol"]; ?></td>
		<td style="text-align:center"><?php echo $lista3[$i]["fecha_ini"]; ?></td>
		<td style="text-align:center"><?php IF($lista3[$i]["concept"] == '1005'){ echo 'Recargo nocturno ordinario'; }ELSEIF($lista3[$i]["concept"] == '1006'){ echo 'Horas extras diurnas'; }ELSEIF($lista3[$i]["concept"] == '1007'){ echo 'Horas extras nocturnas'; }ELSEIF($lista3[$i]["concept"] == '1008'){ echo 'Horas extras festiva diurna'; }ELSEIF($lista3[$i]["concept"] == '1009'){ echo 'Horas extras festiva nocturna'; }ELSEIF($lista3[$i]["concept"] == '1118'){ echo 'Recargo nocturno dominical'; }ELSEIF($lista3[$i]["concept"] == '1119'){ echo 'Recargo diurno dominical'; }?></td>                    
		<td style="text-align:center"><?php IF($lista3[$i]["estado"] == 'P'){ echo 'Pendiente por aprobar jefe'; }ELSEIF($lista3[$i]["estado"] == 'R'){ echo 'Rechazado'; }ELSEIF($lista3[$i]["estado"] == 'L'){ echo 'Pendiente por aprobar gerente'; }ELSEIF($lista3[$i]["estado"] == 'C'){ echo 'Aprobado por gerente'; }?></td>
</tr><?php }

?>

 	
	</tbody>
</table>

<br><br>

</body>

</html>

