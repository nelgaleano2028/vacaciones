<?php
@session_start();



$codiepl = $_SESSION['cod'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
   
        <title>
            
        </title>
        
       
	<style type="text/css" title="currentStyle">
	    	      

	    	        @import "../extras/TableTools/media/css/TableTools.css";
                        @import "../extras/TableTools/media/css/TableTools_JUI.css";
			@import "../media/css/demo_page.css";
			@import "../media/css/demo_table_jui.css";
			@import "../media/css/jquery-ui-1.8.4.custom.css";


			
	</style>


<link type="text/css" href="../css/estilo.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/scroll.css"  />		      		      

	

<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="../media/js/jquery.dataTables.js"></script>

<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.js"></script>
<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.min.js"></script>
<script type="text/javascript" src='../js/dataTables.fnGetFilteredNodes.js'></script>
<script>$(document).ready(function(){
	$("#bAutorizar").click(function(){
		
		var oTable = $('#admin').dataTable();
		var aData;
		var i=0;
		var id;
		$(oTable.fnGetFilteredNodes()).each(function(){
			 aData = oTable.fnGetData(i);
			 id = aData[0];
			 //alert(id);//return false;
			if($("#"+id).is(':checked')) {
			aceptar_solicitud($("#concep"+id).val(),aData[1],$("#inicial"+id).val(),$("#final"+id).val(),$("#cod_area"+id).val(),aData[7],$("#ausen"+id).val(),id,$("#cod_admin"+id).val());		
						
			/*var Q = $("#inicial"+id).val();
			alert(Q);
			var T = $("#final"+id).val();
			alert(T);
			var W = $("#ausen"+id).val();
			alert(W);
			var A = $("#cod_admin"+id).val();
			alert(A);*/
			}
			i =i+1;
						
		});
	
 });
});

</script>
 

 <script>
 
 
function aceptar_solicitud(cod_con,cod_epl,fec_ini,fec_fin,cod_cc2,dias,cod_aus,consecutivo,encargado){
                $.ajax({
			type:"POST",
			url: "horas_gralepl.php",
			data:"encargado="+encargado+"&cod_con="+cod_con+"&cod_epl="+cod_epl+"&fec_ini="+fec_ini+"&fec_fin="+fec_fin+"&cod_cc2="+cod_cc2+"&dias="+dias+"&cod_aus="+cod_aus+"&consecutivo="+consecutivo+"&accion=aprobar",
			    beforeSend: function(){
		      //notify("Enviando....",500,80000,"info","info");
							
						},
			success: function(datos){
				//$("#formulario").html(datos);
				//notify(datos,500,5000,"email","email");
                       alert(datos);         
				$("#fila-"+consecutivo).remove();
			}
		});
		return false;
            }
            
         function rechazar_solicitud(consecutivo,encargado,cod_epl){
            var obse=$("#observacion"+consecutivo).val();
	    if(obse == ""){
		  alert("Debe ingresar la razón por la cual rechaza esta solicitud.");
	    }else{
            $.ajax({
                type:"POST",
                url:"horas_gralepl.php",
                data:"cod_epl="+cod_epl+"&encargado="+encargado+"&obse="+obse+"&consecutivo="+consecutivo+"&accion=rechazar",
		    beforeSend: function(){
		     // notify("Enviando....",500,80000,"info","info");
							
						},
                success: function(datos){
				//$("#formulario").html(datos);
                              //  notify(datos,500,5000,"email","email");
							  alert(datos);
				$("#fila-"+consecutivo).remove();
			}
            });
	    }
            return false;
         }

    

/*paginacion id de la tabla*/
            
                
		     $(document).ready(function() {
                
		
		$('#admin').dataTable({
			"bAutoWidth": false,
			"sScrollX": "100%",
		        "sScrollXInner": "100%",
		        "bScrollCollapse": true,
		        "aaSorting": [[ 5, "desc" ]],
			"bJQueryUI": true,
			"iDisplayLength": 5,
			"sDom": '<"H"TfrlP>t<"F"ip><"clear">',
		        "oTableTools": {
								"sSwfPath": "../extras/TableTools/media/swf/copy_csv_xls_pdf.swf",
				                       		"aButtons": [
								{"sExtends": "xls","sButtonText": "Guardar a Excel","sFileName": "solicitudes_turnosdetrabajo.xls","bFooter": false,"mColumns":[0,1,2,3,4,5,6,7,8]},
								{"sExtends": "pdf","sButtonText": "Guardar a PDF","sTitle": "Solicitudes de turnos de trabajo por empleado","sFileName": "solicitudes_turnosdetrabajo.pdf","sPdfOrientation": "landscape","mColumns":[0,1,2,3,4,5,6,7,8]},
 
							    ]
							},
		       "oLanguage": {
								"oPaginate": {
										"sPrevious": "Anterior", 
										"sNext": "Siguiente", 
										"sLast": "Ultima", 
										"sFirst": "Primera" 
										},"sLengthMenu": 'Mostrar <select>'+ 
										'<option value="5">5</option>'+ 
										'<option value="10">10</option>'+ 
										'<option value="25">25</option>'+ 
										'<option value="50">50</option>'+ 
										'<option value="100">100</option>'+ 
										'<option value="-1">Todos</option>'+ 
										'</select> registros', 

								"sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)", 
								"sInfoFiltered": " - filtrados de _MAX_ registros", 
								"sInfoEmpty": "No hay resultados de busqueda", 
								"sZeroRecords": "No hay registros a mostrar", 
								"sProcessing": "Espere, por favor...", 
								"sSearch": "Filtrar:"
								}
		   });
         
			
            } );
			
          
     </script>
    </head>
 <body>
 <br><br>

 <center>
			<h2>Solicitudes de Empleados por Aprobar o Rechazar</h2>   
<p style="text-align:left">Si tiene problemas para exportar la tabla verifique que tiene instalado el reproductor de adobe flash player, de lo contrario descargue <a href="http://get.adobe.com/es/flashplayer/">aqui</a>, si persiste con el inconveniente por favor abrir la pagina WEB con Google Chrome. </p>
                    <table cellpadding="0" cellspacing="0" border="0" class="display " id="admin" width="100%">
						     
			      <thead>
			        <tr class="odd">
					<th scope="col">Consec</th>
				<th scope="col" >Codigo</th>
				<th scope="col" >Cedula</th>
				<th  scope="col" >Nombres y Apellidos </th>	
				<th  scope="col" >Area</th>
				<th  scope="col">Cargo</th>
                                    <th  scope="col">Fecha Registrada</th>
                                 <th  scope="col">Horas Registradas</th>
								 <th  scope="col">Fecha Solicitud</th>
                               <th  scope="col">Concepto</th>
                                   <th  scope="col">Aceptar</th>
                                <th scope="col">Rechazar</th>
                                 <th  scope="col">Comentario Rechazo</th>
			        </tr>
			      </thead>
                    <tbody>
			      <?php
				  include_once('../lib/configdbf.php');
				
				    //validacion bd f
$consultaf = "select cod_epl AS CONTEO  from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();
				
if(isset($rowf['CONTEO'])){
$conn = $configf;
}	
				  include_once("class_horasextrasepl.php");
$administrador=new vacaciones();
$lista3=$administrador->solicitud_pendientes_epl_gral();
				  
			     
			             for($i=0; $i<count($lista3); $i++){
						       
					if($i % 2){
                                                   echo "<tr id='fila-".$lista3[$i]['consecutivo']."' class='odd'>";
					}else{
						   echo "<tr id='fila-".$lista3[$i]['consecutivo']."'>";
			                     }
					
			      ?>
				  <td><?php echo $lista3[$i]['consecutivo']; ?></td>
                              <td ><?php echo $lista3[$i]['codigo']; ?></td>
			      <td ><?php echo $lista3[$i]['cedula']; ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['nombre'])." ".utf8_decode($lista3[$i]['apellido']); ?></td>
			      <td ><?php echo utf8_decode($lista3[$i]['area']); ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['cargo']); ?></td>
                              <td><?php echo $inicial=date("d-m-Y",strtotime($lista3[$i]['inicial']));?></td>
                              <td><?php echo $lista3[$i]['dias']; ?></td>
							   <td><?php echo $lista3[$i]['solicitud']; ?></td>
							   <td><?php IF($lista3[$i]["concepto"] == '1005'){ echo 'Recargo nocturno ordinario'; }ELSEIF($lista3[$i]["concepto"] == '1006'){ echo 'Horas extras diurnas'; }ELSEIF($lista3[$i]["concepto"] == '1007'){ echo 'Horas extras nocturnas'; }ELSEIF($lista3[$i]["concepto"] == '1008'){ echo 'Horas extras festiva diurna'; }ELSEIF($lista3[$i]["concepto"] == '1009'){ echo 'Horas extras festiva nocturna'; }ELSEIF($lista3[$i]["concepto"] == '1118'){ echo 'Recargo nocturno dominical'; }ELSEIF($lista3[$i]["concepto"] == '1119'){ echo 'Recargo diurno dominical'; }?></td>
                             
                               <td><!--<span class="dele">
			      <a href="#"  onClick="aceptar_solicitud('<?php echo $lista3[$i]['concepto']; ?>','<?php echo $lista3[$i]['codigo']; ?>','<?php echo $inicial; ?>','<?php echo $final; ?>','<?php echo $lista3[$i]['cod_area']; ?>','<?php echo $lista3[$i]['dias']; ?>','<?php echo $lista3[$i]['ausencia']; ?>','<?php echo $lista3[$i]['consecutivo']; ?>','<?php echo $_SESSION['cod_admin']; ?>');" >
			      <img src="../imagenes/success.gif" title="Aprobar" alt="Aprobar" />
			      </a></span>-->
				  <input type="checkbox" id=<?php echo $lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['consecutivo']; ?>>
				  <input type="hidden" id=<?php echo "concep".$lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['concepto']; ?>>
				  <input type="hidden" id=<?php echo "cod_area".$lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['cod_area']; ?>>
				  <input type="hidden" id=<?php echo "ausen".$lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['ausencia']; ?>>
				  <input type="hidden" id=<?php echo "cod_admin".$lista3[$i]['consecutivo']; ?> value=<?php echo $_SESSION['cod_admin']; ?>>
				  <input type="hidden" id=<?php echo "inicial".$lista3[$i]['consecutivo']; ?> value=<?php echo $inicial; ?>>
				  <input type="hidden" id=<?php echo "final".$lista3[$i]['consecutivo']; ?> value=<?php echo $final; ?>>
			      
				  
				  
			      </td>
                                <td><span class="dele">
			      <a href="#" onClick="rechazar_solicitud('<?php echo $lista3[$i]['consecutivo']; ?>','<?php echo $_SESSION['cod_admin']; ?>','<?php echo $lista3[$i]['codigo']; ?>');" >
			      <img src="../imagenes/delete1.png" title="Rechazar" alt="Rechazar" />
			      </a></span>
			      </td>
			      <td>
                              <input id="observacion<?php echo $lista3[$i]['consecutivo']; ?>" type="text" />
                              </td>
			      
			       </tr>
			      <?php
			      
			          }
					  
					    include_once('../lib/configdb.php');
			       //validacion bd 
$consulta =  "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

if(isset($rowa['CONTEO'])){
$conn = $config;
}
				  include_once("class_horasextrasepl.php");
$administrador=new vacaciones();
$lista3=$administrador->solicitud_pendientes_epl_gral();
				  
			     
			             for($i=0; $i<count($lista3); $i++){
						       
					if($i % 2){
                                                   echo "<tr id='fila-".$lista3[$i]['consecutivo']."' class='odd'>";
					}else{
						   echo "<tr id='fila-".$lista3[$i]['consecutivo']."'>";
			                     }
					
			      ?>
				  <td><?php echo $lista3[$i]['consecutivo']; ?></td>
                              <td ><?php echo $lista3[$i]['codigo']; ?></td>
			      <td ><?php echo $lista3[$i]['cedula']; ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['nombre'])." ".utf8_decode($lista3[$i]['apellido']); ?></td>
			      <td ><?php echo utf8_decode($lista3[$i]['area']); ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['cargo']); ?></td>
                              <td><?php echo $inicial=date("d-m-Y",strtotime($lista3[$i]['inicial']));?></td>
                             <td><?php echo $lista3[$i]['dias']; ?></td>
							   <td><?php echo $lista3[$i]['solicitud']; ?></td>
                             <td><?php IF($lista3[$i]["concepto"] == '1005'){ echo 'Recargo nocturno ordinario'; }ELSEIF($lista3[$i]["concepto"] == '1006'){ echo 'Horas extras diurnas'; }ELSEIF($lista3[$i]["concepto"] == '1007'){ echo 'Horas extras nocturnas'; }ELSEIF($lista3[$i]["concepto"] == '1008'){ echo 'Horas extras festiva diurna'; }ELSEIF($lista3[$i]["concepto"] == '1009'){ echo 'Horas extras festiva nocturna'; }ELSEIF($lista3[$i]["concepto"] == '1118'){ echo 'Recargo nocturno dominical'; }ELSEIF($lista3[$i]["concepto"] == '1119'){ echo 'Recargo diurno dominical'; }?></td>
                               <td><!--<span class="dele">
			      <a href="#"  onClick="aceptar_solicitud('<?php echo $lista3[$i]['concepto']; ?>','<?php echo $lista3[$i]['codigo']; ?>','<?php echo $inicial; ?>','<?php echo $final; ?>','<?php echo $lista3[$i]['cod_area']; ?>','<?php echo $lista3[$i]['dias']; ?>','<?php echo $lista3[$i]['ausencia']; ?>','<?php echo $lista3[$i]['consecutivo']; ?>','<?php echo $_SESSION['cod_admin']; ?>');" >
			      <img src="../imagenes/success.gif" title="Aprobar" alt="Aprobar" />
			      </a></span>-->
				  <input type="checkbox" id=<?php echo $lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['consecutivo']; ?>>
				  <input type="hidden" id=<?php echo "concep".$lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['concepto']; ?>>
				  <input type="hidden" id=<?php echo "cod_area".$lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['cod_area']; ?>>
				  <input type="hidden" id=<?php echo "ausen".$lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['ausencia']; ?>>
				  <input type="hidden" id=<?php echo "cod_admin".$lista3[$i]['consecutivo']; ?> value=<?php echo $_SESSION['cod_admin']; ?>>
				  <input type="hidden" id=<?php echo "inicial".$lista3[$i]['consecutivo']; ?> value=<?php echo $inicial; ?>>
				  <input type="hidden" id=<?php echo "final".$lista3[$i]['consecutivo']; ?> value=<?php echo $final; ?>>
			      </td>
                                <td><span class="dele">
			      <a href="#" onClick="rechazar_solicitud('<?php echo $lista3[$i]['consecutivo']; ?>','<?php echo $_SESSION['cod_admin']; ?>','<?php echo $lista3[$i]['codigo']; ?>');" >
			      <img src="../imagenes/delete1.png" title="Rechazar" alt="Rechazar" />
			      </a></span>
			      </td>
			      <td>
                              <input id="observacion<?php echo $lista3[$i]['consecutivo']; ?>" type="text" />
                              </td>
			      
			       </tr>
			      <?php
			      
			          }
					   include_once('../lib/configdbt.php');
			       //validacion bd 
$consultat =  "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowt['CONTEO'])){
$conn = $configt;
}
				  include_once("class_horasextrasepl.php");
$administrador=new vacaciones();
$lista3=$administrador->solicitud_pendientes_epl_gral();
				  
			     
			             for($i=0; $i<count($lista3); $i++){
						       
					if($i % 2){
                                                   echo "<tr id='fila-".$lista3[$i]['consecutivo']."' class='odd'>";
					}else{
						   echo "<tr id='fila-".$lista3[$i]['consecutivo']."'>";
			                     }
					
			      ?>
				  <td><?php echo $lista3[$i]['consecutivo']; ?></td>
                              <td ><?php echo $lista3[$i]['codigo']; ?></td>
			      <td ><?php echo $lista3[$i]['cedula']; ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['nombre'])." ".utf8_decode($lista3[$i]['apellido']); ?></td>
			      <td ><?php echo utf8_decode($lista3[$i]['area']); ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['cargo']); ?></td>
                              <td><?php echo $inicial=date("d-m-Y",strtotime($lista3[$i]['inicial']));?></td>
                                <td><?php echo $lista3[$i]['dias']; ?></td>
							   <td><?php echo $lista3[$i]['solicitud']; ?></td>
                            <td><?php IF($lista3[$i]["concepto"] == '1005'){ echo 'Recargo nocturno ordinario'; }ELSEIF($lista3[$i]["concepto"] == '1006'){ echo 'Horas extras diurnas'; }ELSEIF($lista3[$i]["concepto"] == '1007'){ echo 'Horas extras nocturnas'; }ELSEIF($lista3[$i]["concepto"] == '1008'){ echo 'Horas extras festiva diurna'; }ELSEIF($lista3[$i]["concepto"] == '1009'){ echo 'Horas extras festiva nocturna'; }ELSEIF($lista3[$i]["concepto"] == '1118'){ echo 'Recargo nocturno dominical'; }ELSEIF($lista3[$i]["concepto"] == '1119'){ echo 'Recargo diurno dominical'; }?></td>
                               <td><!--<span class="dele">
			      <a href="#"  onClick="aceptar_solicitud('<?php echo $lista3[$i]['concepto']; ?>','<?php echo $lista3[$i]['codigo']; ?>','<?php echo $inicial; ?>','<?php echo $final; ?>','<?php echo $lista3[$i]['cod_area']; ?>','<?php echo $lista3[$i]['dias']; ?>','<?php echo $lista3[$i]['ausencia']; ?>','<?php echo $lista3[$i]['consecutivo']; ?>','<?php echo $_SESSION['cod_admin']; ?>');" >
			      <img src="../imagenes/success.gif" title="Aprobar" alt="Aprobar" />
			      </a></span>-->
				  <input type="checkbox" id=<?php echo $lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['consecutivo']; ?>>
				  <input type="hidden" id=<?php echo "concep".$lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['concepto']; ?>>
				  <input type="hidden" id=<?php echo "cod_area".$lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['cod_area']; ?>>
				  <input type="hidden" id=<?php echo "ausen".$lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['ausencia']; ?>>
				  <input type="hidden" id=<?php echo "cod_admin".$lista3[$i]['consecutivo']; ?> value=<?php echo $_SESSION['cod_admin']; ?>>
				  <input type="hidden" id=<?php echo "inicial".$lista3[$i]['consecutivo']; ?> value=<?php echo $inicial; ?>>
				  <input type="hidden" id=<?php echo "final".$lista3[$i]['consecutivo']; ?> value=<?php echo $final; ?>>
			      </td>
                                <td><span class="dele">
			      <a href="#" onClick="rechazar_solicitud('<?php echo $lista3[$i]['consecutivo']; ?>','<?php echo $_SESSION['cod_admin']; ?>','<?php echo $lista3[$i]['codigo']; ?>');" >
			      <img src="../imagenes/delete1.png" title="Rechazar" alt="Rechazar" />
			      </a></span>
			      </td>
			      <td>
                              <input id="observacion<?php echo $lista3[$i]['consecutivo']; ?>" type="text" />
                              </td>
			      
			       </tr>
			      <?php
			      
			          }
					   include_once('../lib/configdbc.php');
			    
//validacion bd c
$consultac =  "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

if(isset($rowc['CONTEO'])){
$conn = $configc;
}
				  include_once("class_horasextrasepl.php");
$administrador=new vacaciones();
$lista3=$administrador->solicitud_pendientes_epl_gral();
				  
			     
			             for($i=0; $i<count($lista3); $i++){
						       
					if($i % 2){
                                                   echo "<tr id='fila-".$lista3[$i]['consecutivo']."' class='odd'>";
					}else{
						   echo "<tr id='fila-".$lista3[$i]['consecutivo']."'>";
			                     }
					
			     ?>
				  <td><?php echo $lista3[$i]['consecutivo']; ?></td>
                              <td ><?php echo $lista3[$i]['codigo']; ?></td>
			      <td ><?php echo $lista3[$i]['cedula']; ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['nombre'])." ".utf8_decode($lista3[$i]['apellido']); ?></td>
			      <td ><?php echo utf8_decode($lista3[$i]['area']); ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['cargo']); ?></td>
                              <td><?php echo $inicial=date("d-m-Y",strtotime($lista3[$i]['inicial']));?></td>
                              <td><?php echo $lista3[$i]['dias']; ?></td>
							   <td><?php echo $lista3[$i]['solicitud']; ?></td>
                             <td><?php IF($lista3[$i]["concepto"] == '1005'){ echo 'Recargo nocturno ordinario'; }ELSEIF($lista3[$i]["concepto"] == '1006'){ echo 'Horas extras diurnas'; }ELSEIF($lista3[$i]["concepto"] == '1007'){ echo 'Horas extras nocturnas'; }ELSEIF($lista3[$i]["concepto"] == '1008'){ echo 'Horas extras festiva diurna'; }ELSEIF($lista3[$i]["concepto"] == '1009'){ echo 'Horas extras festiva nocturna'; }ELSEIF($lista3[$i]["concepto"] == '1118'){ echo 'Recargo nocturno dominical'; }ELSEIF($lista3[$i]["concepto"] == '1119'){ echo 'Recargo diurno dominical'; }?></td>
                               <td><!--<span class="dele">
			      <a href="#"  onClick="aceptar_solicitud('<?php echo $lista3[$i]['concepto']; ?>','<?php echo $lista3[$i]['codigo']; ?>','<?php echo $inicial; ?>','<?php echo $final; ?>','<?php echo $lista3[$i]['cod_area']; ?>','<?php echo $lista3[$i]['dias']; ?>','<?php echo $lista3[$i]['ausencia']; ?>','<?php echo $lista3[$i]['consecutivo']; ?>','<?php echo $_SESSION['cod_admin']; ?>');" >
			      <img src="../imagenes/success.gif" title="Aprobar" alt="Aprobar" />
			      </a></span>-->
				  <input type="checkbox" id=<?php echo $lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['consecutivo']; ?>>
				  <input type="hidden" id=<?php echo "concep".$lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['concepto']; ?>>
				  <input type="hidden" id=<?php echo "cod_area".$lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['cod_area']; ?>>
				  <input type="hidden" id=<?php echo "ausen".$lista3[$i]['consecutivo']; ?> value=<?php echo $lista3[$i]['ausencia']; ?>>
				  <input type="hidden" id=<?php echo "cod_admin".$lista3[$i]['consecutivo']; ?> value=<?php echo $_SESSION['cod_admin']; ?>>
				  <input type="hidden" id=<?php echo "inicial".$lista3[$i]['consecutivo']; ?> value=<?php echo $inicial; ?>>
				  <input type="hidden" id=<?php echo "final".$lista3[$i]['consecutivo']; ?> value=<?php echo $final; ?>>
			      </td>
                                <td><span class="dele">
			      <a href="#" onClick="rechazar_solicitud('<?php echo $lista3[$i]['consecutivo']; ?>','<?php echo $_SESSION['cod_admin']; ?>','<?php echo $lista3[$i]['codigo']; ?>');" >
			      <img src="../imagenes/delete1.png" title="Rechazar" alt="Rechazar" />
			      </a></span>
			      </td>
			      <td>
                              <input id="observacion<?php echo $lista3[$i]['consecutivo']; ?>" type="text" />
                              </td>
			      
			       </tr>
			      <?php
			      
			          }
					
			       ?>
                 </tbody>
                 </table>
				 
		 <button type="button" id="bAutorizar">Autorizar</button>

 </center>
</body>
</html>