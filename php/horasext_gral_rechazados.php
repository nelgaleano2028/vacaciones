<?php
@session_start();

if (!isset($_SESSION['privi'])){
  
  header("location: index.php");
}
include_once("class_horasextras.php");
$administrador=new vacaciones();
$lista3=$administrador->solicitud_epl_gral_rechazada();
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
/*paginacion id de la tabla*/
            
                
		     $(document).ready(function() {
                
		
		$('#rechazados').dataTable({
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
								{"sExtends": "xls","sButtonText": "Guardar a Excel","sFileName": "turnosdetrabajo_rechazadas_admin.xls","bFooter": false,"mColumns":[0,1,2,3,4,5,6,7,8,9,10,11,12]},
								{"sExtends": "pdf","sButtonText": "Guardar a PDF","sTitle": "Solicitudes de turnos de trabajo rechazadas por empleado","sFileName": "turnosdetrabajo_rechazadas_admin.pdf","sPdfOrientation": "landscape","mColumns":[0,1,2,3,4,5,6,7,8,9,10,11,12]},
 
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
    <body>
 <br><br>
 <center>
			<h2>Solicitudes de Empleados con Horas Extras Rechazadas</h2>      
 <div>
		<p style="text-align:left">Si tiene problemas para exportar la tabla verifique que tiene instalado el reproductor de adobe flash player, de lo contrario descargue <a href="http://get.adobe.com/es/flashplayer/">aqui</a>, si persiste con el inconveniente por favor abrir la pagina WEB con Google Chrome. </p>
		<table cellpadding="0" cellspacing="0" border="0" class="display " id="rechazados" width="100%">
                    
			     
			      <thead>
			        <tr class="odd">
					<th width="14%" scope="col">Consec</th>
				<th width="14%" scope="col">Codigo</th>
				<th width="14%" scope="col">Cedula</th>
				<th width="14%" scope="col">Nombres y Apellidos </th>	
				<th width="14%" scope="col">Area</th>
				<th width="16%" scope="col">Cargo</th>
                                <th width="16%" scope="col">Estado</th>
                                    <th width="14%" scope="col">Fecha Inicial</th>
                                <th width="5%" scope="col">Fecha Final</th>
								<th width="5%" scope="col">Fecha Solicitud</th>
                                <th width="5%" scope="col">Horas Registradas</th>
								 <th width="5%" scope="col">Rechazado por</th>
								 <th width="5%" scope="col">Observacion</th>
                                
			        </tr>
			      </thead>
                    <tbody>
			      <?php
			    
			             for($i=0; $i<count($lista3); $i++){
						       
					if($i % 2){
                                                   echo "<tr class='odd'>";
					}else{
						   echo "<tr>";
			                     }
					
			      ?><td ><?php echo $lista3[$i]['consecutivo']; ?></td>
                              <td ><?php echo $lista3[$i]['codigo']; ?></td>
			      <td ><?php echo $lista3[$i]['cedula']; ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['nombre'])." ".utf8_decode($lista3[$i]['apellido']); ?></td>
			      <td ><?php echo utf8_decode($lista3[$i]['area']); ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['cargo']); ?></td>
                              <td><?php if($lista3[$i]['estado'] == "R"){ echo "Rechazada";} ?></td>
                              <td><?php echo date("d-m-Y",strtotime($lista3[$i]['inicial']))
; ?></td>
                              <td><?php echo date("d-m-Y",strtotime($lista3[$i]['final']))
; ?></td>
							  <td><?php echo date("d-m-Y",strtotime($lista3[$i]['fechasol'])); ?></td>
                              <td><?php echo $lista3[$i]['dias']; ?></td>
                              <td><?php echo $lista3[$i]['respuesta']; ?></td>
                              <td><?php echo $lista3[$i]['razon']; ?></td>
			      
			       </tr>
			      <?php
			      
			          }
			       
			       ?>
                 </tbody>
                 </table>
				 
		    </div>
 </fieldset> 
 </center>
    </body>
</html>