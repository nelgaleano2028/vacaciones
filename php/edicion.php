<?php
session_start();

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
$codigo=$_SESSION['cod'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
    <head>
    
	<title>Vacaciones</title>
<!--[if lt IE 10]>
<script type="text/javascript" src="../PIE/PIE.js"></script>
<![endif]-->

<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
<![endif]-->

<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
	<style type="text/css" title="currentStyle">
	    	        @import "../extras/TableTools/media/css/TableTools.css";
                        @import "../extras/TableTools/media/css/TableTools_JUI.css";
			@import "../media/css/demo_page.css";
			@import "../media/css/demo_table_jui.css";
			@import "../media/css/jquery-ui-1.8.4.custom.css";
			
		</style>			      
<!--<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />	-->		      
 <link type="text/css" href="../js/chosen/chosen.css" rel="stylesheet" />
 <link rel="stylesheet" href="../css/jquery.ui.all.css">			      
<link type="text/css" href="../css/paginacion.css" rel="stylesheet" />
<link type="text/css" href="../css/estilo.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/mainCSS.css" media="screen" />


<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>
<script type='text/javascript' src='../js/funciones.js'></script>




	  
	  
	  <script type="text/javascript" charset="utf-8" src="../media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.js"></script>
                <script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.min.js"></script>
                 <script>
		     $(document).ready(function() {
                
		
		$('#admin').dataTable( {
	                 "bAutoWidth": false,
			 

   
			
		        "aaSorting": [[ 1, "desc" ]],
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
                                      }
		   });
         
			
            } );
			
          
     </script>
 



</head>

<body>

<?php

$qry1="select fec_ini as FEC_INI,fec_fin as FEC_FIN,dias as DIAS,cnsctvo as CNSCTVO from incapacidades_tmp where cod_epl='".$codigo."'";


$res= $conn->Execute($qry1); 



if($res){
			 
				while($row = $res->FetchRow()){

					$lista1[] =  array("fecha_ini"=>@$row["FEC_INI"],
											"fehca_fin"=>@$row["FEC_FIN"],
											"dias"=>@$row["DIAS"],
											"consecutivo"=>@$row["CNSCTVO"]
											
											);				
				}
			
					
		 	
			}else {
				$lista1 = NULL;
			}	
		
			$lista1;	
	


?>
<br><br><br>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="admin" class="tablesorter" width="100%">

  <thead>
	<tr class="odd">
    	<th width="20%" scope="col">D&iacute;as</th>
		<th width="20%" scope="col">Fecha Inicio</th>
	  	<th width="20%" scope="col">Fecha Fin</th>
		<th width="20%" scope="col" >Editar</th>
	  	
	</tr>	
	</thead>
  
	<tbody>
    <?php
    $conteo=0;
	
    
       
     $i=0;
     while($i<count(@$lista1)){
     
   
	 
	 
      ?>
 	
		<td style="text-align:center"><?php  echo $lista1[$i]["dias"]; ?></td>
		<td style="text-align:center"><?php echo $lista1[$i]["fecha_ini"]; ?></td>
		<td style="text-align:center"><?php  echo $lista1[$i]["fehca_fin"]; ?></td>
		  
        <td style="text-align:center"><a href="editar_incapacidades.php?numero=<?php  echo $lista1[$i]["consecutivo"]; ?>">Editar</a></td>
			</tr><?php $i++; }?>
 	
	</tbody>
</table>

<?php
if(@$_GET['293874'] == "75"){ 
?> 

     <script> 
	 $(window).load(function(){
	 	notify("Tu solicitud fue editada y enviada exitosamente",500,7000,"info","info");
			 	
	 });
      //alert("La solicitud fue enviada exitosamente");
	  
     </script>   
<?php
}
?>



</body>
</html>
