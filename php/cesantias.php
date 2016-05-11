<?php
session_start();
require_once 'class_hojast.php';
?>

<?php


$lista8=array();


//80032398 comprobantes de pago
//66980923 Prestamos y Cuotas
//52822413 Cesantias
//66830581 Familiares
//338641 Todos menos Cesantias ni Familiares
$codigo=$_SESSION['cod'];

$obj=new class_hoja($codigo);


$lista8=$obj->cesantias();



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
		
<script type="text/javascript">

(function(){
  var bsa = document.createElement('script');
     bsa.type = 'text/javascript';
     bsa.async = true;
     bsa.src = '//s3.buysellads.com/ac/bsa.js';
  (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);
})();

  
</script>

<br>
		
			<div id="demo1">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example1">
<thead>
          			<tr class="odd">
					<th>Fecha</th>
					<th>Valor</th>
					<!--<th>Proceso</th>-->
					<th>Tipo de Pago</th>
          				<th>Inter&eacute;s</th>
					<th>Fecha Pago Cesant&iacute;as</th>
					<th>Fecha Pago Inter&eacute;s</th>
					<th>Fondo</th>
					
                            
            			</tr>
        			</thead>
                	<tbody>
          
	  
	  <!-- A = Anticipo de Cesantías o F = Consignación al Fondo-->
	  
	  
	  
	 <?php
	    for($i=0; $i<count($lista8); $i++){
	 ?>
	 <tr>
	    <td><?php echo $lista8[$i]['fecha'] ?></td>
	    <td><?php echo number_format($lista8[$i]['valor'],2, ",", ".")  ?></td>
	    <!--<td><?php echo $lista8[$i]['proceso']?></td>-->
	        
	    
	    <td>
	    <?php
		
		if($lista8[$i]['tip_pag']=='A')
		    echo"Anticipo de Cesantias";
		else
		    echo"Consignacion al Fondo";
	    ?>
	    </td>
	        
	    
	    <td><?php echo number_format($lista8[$i]['interes'],0, ",", ".") ?></td>
	    <td><?php echo $lista8[$i]['fecha_pago'] ?></td>
	    <td><?php echo $lista8[$i]['fecha_pago_interes'] ?></td>
	    <!--<td><?php echo $lista8[$i]['pagar'] ?></td>-->
	    <td><?php echo $lista8[$i]['nombre'] ?></td>
	 </tr>	
	  <?php
	  }
	  ?>
    	 
          	
       </tbody>
</table>
			</div>
			
	<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-365466-5");
pageTracker._trackPageview();
} catch(err) {}
</script></body>
</html>