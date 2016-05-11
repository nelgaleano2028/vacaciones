<?php
session_start();
require_once 'class_hojast.php';
?>

<?php


$lista9=array();


//80032398 comprobantes de pago
//66980923 Prestamos y Cuotas
//52822413 Cesantias
//66830581 Familiares
//338641 Todos menos Cesantias ni Familiares
$codigo=$_SESSION['cod'];

$obj=new class_hoja($codigo);


$lista9=$obj->familiares();



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





	
		
		<script type="text/javascript">
		    
		    
		    $(document).ready(function() {
    
 
			    
			    
			    
			  
			$('#example1').dataTable({"bJQueryUI": true,
						"iDisplayLength": 5,
						"sDom": '<"H"TfrlP>t<"F"ip><"clear">',
						"oTableTools": {
								"sSwfPath": "../extras/TableTools/media/swf/copy_csv_xls_pdf.swf",
								
						"aButtons": [
								{"sExtends": "xls","sButtonText": "Guardar a Excel"},
								{"sExtends": "pdf","sButtonText": "Guardar a PDF"},
 
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
	
		
		
		
				    $('#hola').click( function() {
	

		$( "#demo1" ).dialog( "open" );
	} );
		    });
		    

		    
		</script>
    </head>


    	<body id="dt_example">
		


<br>
		
			<div id="demo1">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example1">
<thead>
          				<tr class="odd">
            				<th>C&eacute;dula</th>
            				<th>Nombres</th>
            				<th>Apellido</th>
            				<th>Ocupaci&oacute;n</th>
                            <th>Fecha Nacimiento</th>
            			</tr>
        			</thead>
                	<tbody>
          
	 <?php
	    for($i=0; $i<count($lista9); $i++){
	 ?>
	 <tr>
     	<td><?php echo $lista9[$i]['cedula'] ?></td>
		<td><?php echo $lista9[$i]['nombre'] ?></td>
		<td><?php echo $lista9[$i]['apellido'] ?></td>
		<td><?php echo $lista9[$i]['ocupacion'] ?></td>
		<td><?php echo $lista9[$i]['fecha_nac'] ?></td>
	 </tr>	
	  <?php
	  }
	  ?>
    	 
          	
        			</tbody>
</table>
			</div>
			
</body>
</html>