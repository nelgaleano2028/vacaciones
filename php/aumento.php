<?php
session_start();
require_once 'class_hojast.php';
?>

<?php

$lista1=array();
$lista2=array();
$lista3=array();
$lista4=array();
$lista5=array();
$lista6=array();
$lista7=array();
$lista8=array();
$lista9=array();
$lista10=array();
$lista11=array();
$lista12=array();
$lista13=array();

//80032398 comprobantes de pago
//66980923 Prestamos y Cuotas
//52822413 Cesantias
//66830581 Familiares
//338641 Todos menos Cesantias ni Familiares
$codigo=$_SESSION['cod'];

$obj=new class_hoja($codigo);

$lista1=$obj->ultimos_comprobantes();
$lista2=$obj->prestamos();
$lista3=$obj->embargos();
$lista4=$obj->historia_liq();
$lista5=$obj->formas_pago();
$lista6=$obj->certificado();
$lista7=$obj->aumentos();
$lista8=$obj->cesantias();
$lista9=$obj->familiares();
$lista10=$obj->vacaciones();
$lista11=$obj->hist_centro_costo();
$lista12=$obj->historico_cargos();
$lista13=$obj->historico_contratos()


?>


<html>
    <head>
        <title>
            
        </title>
        
        <style type="text/css" title="currentStyle">
		 	@import "../css/datatable/demo_table.css";
    		@import "../css/datatable/demo_page.css";
			
			
			@import "../extras/TableTools/media/css/TableTools.css";
                        @import "../extras/TableTools/media/css/TableTools_JUI.css";
                        
		</style>
	
	
	    <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
<!--  <link href="../css/azul/jquery-ui-1.8.12.custom.css" rel="stylesheet" type="text/css" />-->
 <link rel="stylesheet" type="text/css" href="../css/general.css" />
 <link type="text/css" href="../js/chosen/chosen.css" rel="stylesheet" />

 <link rel="stylesheet" href="../css/jquery.ui.all.css">

<script src="js/messi.js"></script>
        
        <script type="text/javascript" charset="utf-8" src="../media/js/jquery.js"></script>
		<script type="text/javascript" charset="utf-8" src="../media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.js"></script>
                <script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.min.js"></script>
		<!--<script type="text/javascript" charset="utf-8" src="media/js/jquery.dataTables.min.js"></script>-->
		
			 
   <!-- MODAL-->
   <script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>
   <script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
        <script src="../js/jquery.ui.core.js"></script>
	<script src="../js/jquery.ui.widget.js"></script>
	<script src="../js/jquery.ui.mouse.js"></script>
	<script src="../js/jquery.ui.button.js"></script>
	<script src="../js/jquery.ui.draggable.js"></script>
	<script src="../js/jquery.ui.position.js"></script>
	<script src="../js/jquery.ui.dialog.js"></script>
		
		<script type="text/javascript" charset="utf-8">
		    
		    
		    $(document).ready(function() {
    
 
			    
			    
			    
			    $(this).load('Sample.htm');
			$('#example1').dataTable( {
                                             		
            
                                "bJQueryUI": true,
                                "sDom": '<"H"TfrlP>t<"F"ip><"clear">',
								"oTableTools": {
		                        				"sSwfPath": "../extras/TableTools/media/swf/copy_csv_xls_pdf.swf",
												"aButtons": [
																{
																	"sExtends": "xls",
																	"sButtonText": "Guardar a Excel"
																},
																{
																	"sExtends": "pdf",
																	"sButtonText": "Guardar a PDF"
																},
 
															 ],
												},
									 "oLanguage": { 
"oPaginate": { 
"sPrevious": "Anterior", 
"sNext": "Siguiente", 
"sLast": "Ultima", 
"sFirst": "Primera" 
}, 

"sLengthMenu": 'Mostrar <select>'+ 
'<option value="10">10</option>'+ 
'<option value="20">20</option>'+ 
'<option value="30">30</option>'+ 
'<option value="40">40</option>'+ 
'<option value="50">50</option>'+ 
'<option value="-1">Todos</option>'+ 
'</select> registros', 

"sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)", 

"sInfoFiltered": " - filtrados de _MAX_ registros", 

"sInfoEmpty": "No hay resultados de busqueda", 

"sZeroRecords": "No hay registros a mostrar", 

"sProcessing": "Espere, por favor...", 

"sSearch": "Buscar:", 

} 
			
				} );
	
		
		
		
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
          				<tr>
            				<th>Valor Anterior</th>
            				<th>Valor Actual</th>
            				<th>Dias</th>
            				<th>Porcentaje</th>
                            <th>Valor</th>
                            
            			</tr>
        			</thead>
                	<tbody>
          
	 <?php
	   for($i=0; $i<count($lista7); $i++){
	 ?>
	 <tr class="gradeX">
     	<td><?php echo number_format($lista7[$i]['anterior'], 2, ",", ".") ?></td>
		<td><?php echo number_format($lista7[$i]['actual'], 2, ",", ".") ?></td>
		<td><?php echo number_format($lista7[$i]['dias'], 0, ",", ".") ?></td>
		<td><?php echo number_format($lista7[$i]['porcentaje'], 2, ",", ".")."%" ?></td>
        <td><?php echo number_format($lista7[$i]['valor'], 2, ",", ".") ?></td>
		
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