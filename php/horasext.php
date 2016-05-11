<?php
@session_start();


if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}
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

if(isset($rowt['CONTEO'])){
$conn = $configt;
}
if(isset($rowf['CONTEO'])){
$conn = $configf;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
}

//------------------------------FIN antidoto

//global $conn;

$codigo=$_SESSION['cod'];
$estado='P';
$hoy = date("m/d/Y", strtotime('-1 month'));
//var_dump($hoy); DIE;
$qry3="select INITCAP(nom_epl||' ' ||ape_epl) as NOM_JEFE from empleados_basic where cod_epl in (select a.cod_jefe  from empleados_gral a, empleados_basic b where a.cod_epl='".$codigo."' and a.cod_epl=b.cod_epl)";
		
	$rh3 = $conn->Execute($qry3); 

	$row3 = $rh3->FetchRow();

	$cod_jefe=$row3["NOM_JEFE"];
	$sale =0;
	
	
	
for ($i = 1; ; $i++) {
	if ($sale == 1) {
        break;
    }
	$dia_ini = $i;
	$mes_ini=substr($hoy, 0, 2);
	//$mes_ini = $mes_ini -1;
	
	$ano_ini=substr($hoy, 6, 4);
	
	If ($dia_ini <10){
		$fecha_ini2 = '0'.$i.'-'.$mes_ini.'-'.$ano_ini;
	}else{	
		$fecha_ini2 = $i.'-'.$mes_ini.'-'.$ano_ini;
	}
	//var_dump($fecha_ini2); DIE;
	
	$fecha_ini = strtotime($fecha_ini2);
	if( date('l',$fecha_ini) == 'Saturday' || date('l',$fecha_ini) == 'Sunday' )
	{
		$sale = 0;		
	}else{
		$sq="select to_char(fec_fer,'DD-MM-YYYY') FEC_FER from feriados where FEC_FER=to_date('".$fecha_ini2."','DD-MM-YYYY')";
		
		$rs1 = $conn->Execute($sq);
		$rows1 = $rs1->fetchrow();
		$fecha_validar = $rows1['FEC_FER'];
		
		if ($fecha_validar == $fecha_ini2){
			$sale = 0;	
		}else{
			$sale = 1;	
		}

	}
	

}

@$cod_aus='1';

if($mes_ini+1 == '02'){
$dia_ini_fin = $dia_ini-3;
//var_dump($mes_ini); DIE;
}else{
$dia_ini_fin = $dia_ini;
}

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

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script >
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
			$("#validacion").html("<p style='color:red; font-weight:bold'>El Campo DESDE se encuentra vacio</p>");
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
		 
		 $(".bt_min").each(function (el){			
			
			if ($(this) ="bt1"){
				
			}else{
				$(this).bind("click",delRow);
			}
		 });
		 		 
		 $(".datepicker").change(function (){
			var id = $(this).attr('id');
			cambiaObservacion(id);			
		 });
		 
		 var dia_ini = "<?php echo $dia_ini_fin; ?>";		 
		 var mes_ini = "<?php echo $mes_ini; ?>";		 
		 var ano_ini = "<?php echo $ano_ini; ?>";		 
		 
		 
		$( ".datepicker" ).datepicker( 'option', { minDate: new Date(ano_ini, mes_ini - 2, dia_ini) , maxDate: +0 });		 
		 
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
				data: "validar=Si&fecha_arr="+fecha_arr+"&hora_arr="+hora_arr+"&cod_con_arr="+cod_con_arr+"&codigo="+<?php echo $codiepl ?>+"&estado=P&cod_aus="+<?php echo $cod_aus ?>,
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
		confirmado = confirm("Esta seguro que desea reportar la solicitud y enviarla a tu jefe "+jefe+"?"); 
		
		if (confirmado) {
		document.formulario.btn.disabled = true; //Evita que el usuario lo ejecute mientras se envia la solicitud.
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
						//alert('HOLA1');
						var prueba = document.getElementById("observacion"+(i+1));
						prueba.innerHTML=$.trim(res);
						//alert('HOLA2');
						if ($.trim(res) != "OK"){
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
			data: "validar=Insertar&fecha_arr="+fecha_arr+"&hora_arr="+hora_arr+"&cod_con_arr="+cod_con_arr+"&codigo="+<?php echo $codiepl ?>+"&estado=P&cod_aus="+<?php echo $cod_aus ?>,
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
		 $("#bt"+clickID).remove();	
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
		
		var dia_ini = "<?php echo $dia_ini_fin; ?>";		 
		 var mes_ini = "<?php echo $mes_ini; ?>";		 
		 var ano_ini = "<?php echo $ano_ini; ?>";		
		$newClone.children("input").eq(1).datepicker( 'option', { minDate: new Date(ano_ini, mes_ini - 2, dia_ini),maxDate: +0 });
				
		//Cambio el signo "+" por el signo "-" y le quito el evento addfield
		$("#"+clickID).val('-').unbind("click",addField);
		 
		//Ahora le asigno el evento delRow para que borre la fial en caso de hacer click
		$("#"+clickID).bind("click",delRow);		
		
		$( "<input id='bt"+newID+"' class='bt_min' hidden type='button' value='-'/>" ).insertBefore( "#"+newID );
		 
		$("#bt"+newID).bind("click",delRow2);					
	 
	}		 
			 
	function delRow() {
	// Funcion que destruye el elemento actual una vez echo el click
	$(this).parent('div').remove();
	}
	function delRow2() {
	// Funcion que destruye el elemento actual una vez echo el click
	
	var clickID = parseInt($(this).parent('div').attr('id').replace('hora_ext_',''))-1;
	if (clickID>1){
		$( "<input id='bt"+clickID+"' class='bt_min' hidden type='button' value='-'/>" ).insertBefore( "#"+clickID );
		$("#bt"+clickID).bind("click",delRow2);
	}
	
	//Cambio el signo "+" por el signo "-" y le quito el evento addfield
		$("#"+clickID).val('+').unbind("click",delRow);
		 
		//Ahora le asigno el evento delRow para que borre la fial en caso de hacer click
		$("#"+clickID).bind("click",addField);		
	
	$(this).parent('div').remove();
	}
</script>
</head>


<body>
<?php

$qry1="select * from horasextras_tmp where cod_epl='".$codigo."'";

$res= $conn->Execute($qry1); 

if($res){
	
	while($row = $res->FetchRow()){

		$lista1[] =  array("fecha_ini"=>date("d-m-Y",strtotime($row["FEC_INI"])),
							   "concept"=>@$row["COD_CON"],
							   "estado"=>@$row["ESTADO"],
								"fechasol"=>@$row["FEC_SOLICITUD"],
								"horas"=>@$row["DIAS"],
								"consecutivo"=>@$row["CNSCTVO"]
				   );				
	}
}else {
	$lista1 = NULL;
      }	
		 
?>
<br><br>
<center>
<h2>HISTORIAL DE HORAS EXTRAS</h2></center><br>
<table width="70%" id="vacaciones" class="tablesorter">

  <thead>
		<tr class="odd">
   		 <th width="10%" scope="col">Consecutivo</th>
   	    <th width="20%" scope="col">Fecha Solicitud</th>
		<th width="20%" scope="col">Fecha Horas extras</th>
		<th width="10%" scope="col">Horas</th>	
	  	<th width="25%" scope="col">Concepto</th>	  	  	
	  	<th width="20%" scope="col">Estado</th>	  	
	</tr>	
	</thead>
  
	<tbody>
    <?php
    $conteo=0;
	
     if(@$lista1==null){
	echo "<tr>
	  <td colspan='4'>No hay datos a Mostrar</tr>";
     }else{
       
     $i=0;
     while($i<count(@$lista1)){
     
     if(@$i % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
	 
	 
      ?>
		<td style="text-align:center"><?php echo $lista1[$i]["consecutivo"]; ?></td>
		<td style="text-align:center"><?php echo $lista1[$i]["fechasol"]; ?></td>
		<td style="text-align:center"><?php echo $lista1[$i]["fecha_ini"]; ?></td>
		<td style="text-align:center"><?php echo $lista1[$i]["horas"]; ?></td>
		<td style="text-align:center"><?php IF($lista1[$i]["concept"] == '1005'){ echo 'Recargo nocturno ordinario'; }ELSEIF($lista1[$i]["concept"] == '1006'){ echo 'Horas extras diurnas'; }ELSEIF($lista1[$i]["concept"] == '1007'){ echo 'Horas extras nocturnas'; }ELSEIF($lista1[$i]["concept"] == '1008'){ echo 'Horas extras festiva diurna'; }ELSEIF($lista1[$i]["concept"] == '1009'){ echo 'Horas extras festiva nocturna'; }ELSEIF($lista1[$i]["concept"] == '1118'){ echo 'Recargo nocturno dominical/festivo'; }ELSEIF($lista1[$i]["concept"] == '1119'){ echo 'Recargo diurno dominical/festivo'; }?></td>                    
		<td style="text-align:center"><?php IF($lista1[$i]["estado"] == 'P'){ echo 'Pendiente por aprobar jefe'; }ELSEIF($lista1[$i]["estado"] == 'R'){ echo 'Rechazado'; }ELSEIF($lista1[$i]["estado"] == 'L'){ echo 'Pendiente por aprobar gerente'; }ELSEIF($lista1[$i]["estado"] == 'C'){ echo 'Aprobado por gerente'; }?></td>
			</tr><?php $i++; }}?>
 	
	</tbody>
</table>

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
<form method="post" name="formulario"  id="formulario" onSubmit='false' enctype="multipart/form-data">


<fieldset style="width: 800px; margin:0 auto 0 auto; border-radius: 5px;">

<br />

<div id="hora_ext_1">
<p>	 	     </p>
  <label><strong class="tam_str">HORAS:</strong></label> <input name="horas" type="text" id="dias1" size="2" maxlength="2">
               
                 &nbsp;&nbsp;&nbsp;
              
      <label><strong class="tam_str">EL DIA:</strong></label>
	  
	  <input type="text" class="datepicker" name="fecha_ini" id="fecha_ini1" readonly="readonly" 
	  style="background-color: white;"/>&nbsp;&nbsp;&nbsp;
	  	  
	  <label><strong class="tam_str">Concepto:</strong></label> <select id="cod_con1" name="cod_con" class="combo" style="width:215px;">
				<option value="1005">Recargo nocturno ordinario - 1005</option>
				<option value="1006">Horas extras diurnas - 1006</option>
				<option value="1007">Horas extras nocturnas - 1007</option>
				<option value="1008">Horas extras festiva diurna - 1008</option>
				<option value="1009">Horas extras festiva nocturna - 1009</option>
				<option value="1118">Recargo nocturno dominical/festivo - 1118</option>
				<option value="1119">Recargo diurno dominical/festivo - 1119</option>
                </select>
		
		 <!--<input id="bt1" class="bt_min" hidden type="button" value="-" /> !-->
		 <input id="1" class="bt_plus" type="button" value="+" />
		 <div id="1"></div>
		 
		<label name ="observacion" id="observacion1" class ="obser"></label>
		 </div>
            
 <input type="hidden" name="codigo" value="<?php echo $codigo ?>" />
 <input type="hidden" name="estado" value="<?php echo $estado ?>" />
 

 <input type="hidden" name="cod_aus" value="<?php echo $cod_aus ?>" />
 <input type="hidden" name="cod_cc2" value="<?php echo $cod_cc2 ?>" />
 

<br />

<div id="validacion"></div>
<br />


<!--<input id="editar" class="boton" type="button" title="Edicion" value="Editar Solicitud"/></p>-->
</fieldset>
<p><input type="button" class="boton" id="btn" value="Reportar"></p>
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
		location.reload();
	  /*alert(<?php $_GET['tabla']?>);
	  console.log(<?php $_GET['tabla']?>);*/
	  
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
          <td class="piepag">Cualquier inconveniente que tengas, crea tu tiquete a la Mesa Centro de Servicios Compartidos haciendo <a href="http://clienteinterno:9000/MesasAyuda/Categorias/113/Subcategorias/729/Productos/5119/Problemas" style="color: #770003">clic aqu&iacute;</a> y adjunta el pantallazo con el error.</td>
        </tr>
</table>
</body>
</html>