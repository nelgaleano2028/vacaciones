<?php
session_start();
include_once("class_novedades.php");
$administrador= new novedades();
$administrador->set_codigo_jefe(@$_SESSION['cod_admin']);

$lista3=$administrador->mostrar_novedades_jefe();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
    <head>
   
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



 <script>
    
       function aceptar_solicitud(cod_epl,consecutivo){
                $.ajax({
			type:"POST",
			url: "ajax_novedades_jefe.php",
			data:"cod_epl="+cod_epl+"&consecutivo="+consecutivo+"&accion=aprobar",
			    beforeSend: function(){
		      notify("Enviando....",500,80000,"info","info");
							
						},
			success: function(datos){
				//$("#formulario").html(datos);
				notify(datos,500,5000,"email","email");
                                
				$("#fila-"+consecutivo).remove();
			}
		});
		return false;
            }
            
         function rechazar_solicitud(consecutivo,cod_epl){
            
	   var obse=$("#observacion"+consecutivo).val();
	    if($("#observacion"+consecutivo).val() == ""){
		  alert("Debe ingresar la razón por la cual rechaza esta solicitud.");
	    }else{
            $.ajax({
                type:"POST",
                url:"ajax_novedades_jefe.php",
                data:"cod_epl="+cod_epl+"&consecutivo="+consecutivo+"&obse="+obse+"&accion=rechazar",
                  beforeSend: function(){
		      notify("Enviando....",500,80000,"info","info");
							
						},
                success: function(datos){
				//$("#formulario").html(datos);
                                notify(datos,500,5000,"email","email");
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
		        "sScrollXInner": "148%",
		        "bScrollCollapse": true,
		        "aaSorting": [[ 5, "desc" ]],
			"bJQueryUI": true,
			"iDisplayLength": 5,
			"sDom": '<"H"TfrlP>t<"F"ip><"clear">',
		        "oTableTools": {
								"sSwfPath": "../extras/TableTools/media/swf/copy_csv_xls_pdf.swf",
				                       		"aButtons": [
								{"sExtends": "xls","sButtonText": "Guardar a Excel","sFileName": "solicitudes_novedades.xls","bFooter": false,"mColumns":[0,1,2,3,4,5,6,7]},
								{"sExtends": "pdf","sButtonText": "Guardar a PDF","sTitle": "Solicitudes de Novedades de empleados","sFileName": "solicitudes_novedades.pdf","sPdfOrientation": "landscape","mColumns":[0,1,2,3,4,5,6,7]},
 
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
								"sSearch": "Buscar:"
								}
		   });
         
			
            } );
			
          
     </script>
    </head>
 <body id="content">
 <br><br>

 <center>
			<h2>Novedades de Empleados por Aprobar o Rechazar</h2>   

                    <table cellpadding="0" cellspacing="0" border="0" class="display " id="admin" width="100%">
						     
			      <thead>
			        <tr class="odd">
				<th width="9%" scope="col">Codigo</th>
				<th width="9%" scope="col">Cedula</th>
				<th width="9%" scope="col">Nombres y Apellidos </th>	
				<th width="9%" scope="col">Area</th>
				<th width="9%" scope="col">Cargo</th>
                
                <th width="9%" scope="col">Codigo Concepto</th>
                <th width="9%" scope="col">Nombre Concepto</th>
                <th width="9%" scope="col">Valor / Cantidad</th>
		<th width="9%" scope="col">Fecha</th>
                <th width="5%" scope="col">Aceptar</th>
                <th width="5%" scope="col">Cancelar</th>
		<th width="9%" scope="col">Comentario Rechazo</th>
                
			        </tr>
			      </thead>
                    <tbody>
			      <?php
			   
			             for($i=0; $i<count($lista3); $i++){
						       
					if($i % 2){
                                                   echo "<tr id='fila-".$lista3[$i]['consecutivo']."' class='odd'>";
					}else{
						   echo "<tr id='fila-".$lista3[$i]['consecutivo']."'>";
			                     }
					
			      ?>
                              	<td><?php echo $lista3[$i]['codigo']; ?></td>
			      	<td><?php echo $lista3[$i]['cedula']; ?></td>
			      	<td><?php echo utf8_decode($lista3[$i]['nombre'])." ".utf8_decode($lista3[$i]['apellido']); ?></td>
			      	<td><?php echo $lista3[$i]['area']; ?></td>
			      	<td><?php echo utf8_decode($lista3[$i]['cargo']); ?></td>
                              	
                                <td><?php echo utf8_decode($lista3[$i]['concepto']); ?></td>
                                <td><?php echo utf8_decode($lista3[$i]['nom_con']); ?></td>
                                <td><?php echo utf8_decode($lista3[$i]['valor']); ?></td>
				<td><?php echo $inicial=date("d-m-Y",strtotime($lista3[$i]['fecha']));?></td>
                                

                               	<td><span class="dele">
                                
			      <a href="#"  onClick="aceptar_solicitud('<?php echo $lista3[$i]['codigo']; ?>','<?php echo $lista3[$i]['consecutivo']; ?>');" >
			      <img src="../imagenes/success.gif" title="Aprobar" alt="Aprobar" />
			      </a></span>
			      </td>
                                <td><span class="dele">
			      <a href="#" onClick="rechazar_solicitud('<?php echo $lista3[$i]['consecutivo']; ?>','<?php echo $lista3[$i]['codigo']; ?>');" >
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
                 
                 <br />
                 <br />
                 <br />
                 
                 
                 <div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; background-color:#E5E5E5; width:600px; text-align:center; padding-bottom:7px; padding-top:7px; -moz-box-shadow: 5px 5px rgba(0,0,0,0.3); -webkit-box-shadow: 5px 5px rgba(0, 0, 0, 0.3); box-shadow: 5px 5px rgba(0, 0, 0, 0.3)";>NOTA: Tener presente las fechas de cierre de liquidacion de nomina.</div>
                 
                 
		   

 </center>
</body>
</html>