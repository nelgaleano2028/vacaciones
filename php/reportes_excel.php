<?php
session_start();
set_time_limit (200000);
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

$nomadmin = $_SESSION['nom'];

//validacion bd f
$consultaf = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$nomadmin."'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['NOM_ADMIN'])){
$conn = $configf;
}
if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;
}
if(isset($rowa['NOM_ADMIN'])){
$conn = $config;
}
if(isset($rowt['NOM_ADMIN'])){
$conn = $configt;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
    <head>
    
	<title></title>

	<style type="text/css" title="currentStyle">
	    	@import "../extras/TableTools/media/css/TableTools.css";
            @import "../extras/TableTools/media/css/TableTools_JUI.css";
			@import "../media/css/demo_page.css";
			@import "../media/css/demo_table_jui.css";
			@import "../media/css/jquery-ui-1.8.4.custom.css";
	#content center h2 {
	font-weight: bold;
}
    </style>	

		      
<link type="text/css" href="../js/mios/datatable_js/chosen/chosen.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/mios/datatable_css/jquery.ui.all.css">			      
<link type="text/css" href="../css/mios/datatable_css/paginacion.css" rel="stylesheet" />
<link type="text/css" href="../css/mios/datatable_css/estilo.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/mios/datatable_css/mainCSS.css" media="screen" />
<link rel="stylesheet" type="text/datatable_css/css" href="../css/mios/scroll.css"  />


<script type="text/javascript" src="../js/mios/datatable_js/jquery-1.7.2.min.js"></script>
<script type='text/javascript' src="../js/mios/datatable_js/jquery-ui-1.8.17.custom.min.js"></script>
<script type='text/javascript' src='../js/mios/datatable_js/funciones.js'></script>



		
		<script type="text/javascript" charset="utf-8" src="../media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.js"></script>
        <script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.min.js"></script>
 
 <script>

 /*paginacion id de la tabla*/
            
                
		     $(document).ready(function() {
                
		
		$('#admin').dataTable( {
			    
			"bAutoWidth": false,
			
		        "bScrollCollapse": true,
		        "aaSorting": [[ 5, "desc" ]],
			"bJQueryUI": true,
			"iDisplayLength": 5,
			
		        "oLanguage": {
				   
                                       "oPaginate": { 
                                                      "sPrevious": "Anterior", 
                                                      "sNext": "Siguiente", 
                                                      "sLast": "Ultima", 
                                                      "sFirst": "Primera" 
                                                    }, 
                                       "sLengthMenu": 'Mostrar <select>'+ 
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
                                       "sSearch": "Buscar:", 
                                      },
			
			
							
							
									  
									  
		   });
         
			
            } );
			
          
     </script>
    </head>
 <body id="content">
 <br><br>

 <?php
/* $query1 = "select * from log_certificados";
$rs1 = $conn->Execute($query1);

$row1 = $rs1->FetchRow();

$codigo=$row1['COD_EPL'];
$value=$row1['VALUE'];
$destino=$row1['DESTINO'];
$cns=$row1['CNSCTIVO'];*/
 
 
 
$query = "select * from log_certificados";
$rs = $conn->Execute($query);


//var_dump($destino);die("");

 
 ?>
 
 <center>
			<h2>Registros de Certificados Laborales Generados</h2>   

                    <table cellpadding="0" cellspacing="0" border="0" class="display " id="admin" width="100%">
						     
			      <thead>
			        <tr class="odd">
						<th width="6%" scope="col">Consecutivo</th>						
						<th  scope="col">Nombres y Apellidos</th>
						<th width="6%" scope="col">Codigo</th>
						<th  scope="col">Fecha de Generacion</th>
						<th  scope="col">Cedula</th>
						<th  scope="col">Nombre del Certificado</th>
						<th  scope="col">Ver</th>
						
				    </tr>
			      </thead>
                    <tbody>
			      <?php
			   
			              while($row = $rs->FetchRow()){
				     
			      ?>
				  <tr>
					<td><?php echo $row['CNSCTIVO'];  ?></td>
					<td><?php echo "".$row['NOM_EPL']." ".$row['APL_EPL']; ?></td>
					<td><?php echo $row['COD_EPL'];  ?></td>
					<td><?php echo $row['FECHA']; ?></td>
					<td><?php echo $row['CEDULA']; ?></td>
					<td><?php echo $row['NOM_CERTIFICADO']; ?></td>
                    <?php 
$codigo=$row['COD_EPL'];
$value=$row['VALUE'];
$destino=$row['DESTINO'];
$cns=$row['CNSCTIVO']; ?>
                    
					<td><a href="auditoria.php?cod_epl=<?php echo $codigo; ?>&value=<?php echo $value; ?>&destino=<?php echo $destino; ?>&cns=<?php echo $cns; ?>" target="_blank">Ver</a></td>
					
                  </tr>
			      <?php
			      }
			      ?>
					</tbody>
                 </table>
		   

 </center>
</body>
</html>