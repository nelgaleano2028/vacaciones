<?php
@session_start();

if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}


include_once("class_inicio.php");
$administrador=new inicio();
$administrador->set_codigo(@$_SESSION['cod']);
$lista3=$administrador->cuenta_nomina();
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

		     $(document).ready(function() {
                
		
		$('#admin').dataTable({
			
		        "aaSorting": [[ 5, "desc" ]],
			"bJQueryUI": true,
			"iDisplayLength": 5,
			
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
			<h2>Cuenta de N&oacute;mina</h2>   
<div style="width:80%">
                    <table cellpadding="0" cellspacing="0" border="0" class="display " id="admin" width="100%">
						     
			      <thead>
			        <tr class="odd">
				<th scope="col">Cuenta</th>
				<th scope="col">Banco</th>
				<th  scope="col" >Tipo</th>	
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
					
			      ?>
                  <td><?php echo $lista3[$i]['cuenta']; ?></td>
			      <td><?php echo $lista3[$i]['banco']; ?></td>
                  <td><?php echo $lista3[$i]['tipo']; ?></td>
			      
			      
			       </tr>
			      <?php
			      
			          }
			       
			       ?>
                 </tbody>
                 </table>
		   </div>

 </center>
</body>
</html>