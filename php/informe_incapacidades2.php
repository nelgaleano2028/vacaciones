<?php
@session_start();

//------------------------------antidoto
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

$codigo=$_SESSION['cod'];
$codiepl = $_SESSION['ced'];

  


if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="X-UA-Compatible" content="IE=9" />

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
function modal_iframe(url,title,a,b,e){
        
            e.preventDefault();
            var $this = $(this);
            var horizontalPadding = 20;
            var verticalPadding = 5;
            
            $('<iframe id="site" src="'+url+'" />').dialog({
            
                title: ($this.attr('title')) ? $this.attr('title') : '<H3>'+title+'</H3>',
                autoOpen: true,
                width: 800,
		dialogClass:'my-extra-class',
		
		position: "top",
                height: 380,
                modal: true,
		draggable: a, 
		resizable: b,
                autoResize: true,
		
		hide:'drop',
		overlay: { backgroundColor: "white", opacity: 0.5 },
		open: function (event,ui) {
		                           
		                           $(this).css('width','97%'),
		                           $(this).css('height','358px')
					   $('.ui-dialog-titlebar-close').css('visibility','hidden');
					   
					 
					   
					   },
	        buttons: {
                "Cerrar": function() {
                         $( this ).dialog( "close" );
			 
			 location.reload(true);
                                     }  
                        }
                })
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
								{"sExtends": "xls","sButtonText": "Guardar a Excel","sFileName": "solicitudes_empleado.xls","bFooter": false,"mColumns":[0,1,2,3,4,5]},
								{"sExtends": "pdf","sButtonText": "Guardar a PDF","sTitle": "Solicitudes por empleado","sFileName": "solicitudes_empleado.pdf","sPdfOrientation": "landscape","mColumns":[0,1,2,3,4,5]},
 
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
<center>
<div id="capa" class="capa">
<h2>
INCAPACIDADES PENDIENTE POR RADICAR POR EL COLABORADOR
</h2>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="admin" width="100%">
<thead>
	<tr>
<th scope="col" >
CEDULA
</th>
<th scope="col" >
NOMBRE COMPLETO
</th>
<th scope="col" >
DIAS
</th>
<th scope="col" >
FECHA INICIO
</th>
<th scope="col" >
FECHA FIN
</th>
<th scope="col" >
FECHA DE REGISTRO
</th>
	</tr>
	</thead>
	<tbody>
	<?php
 //validacion bd f
$consultaf = "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO from empleados_gral WHERE cod_jefe = '$codiepl' ";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
//-----------------------------INCAPACIDADES PENDIENTE POR RADICAR POR EL COLABORADOR 

	$qry5="select c.cedula AS CEDULA, c.nom_epl AS NOMBRE, c.ape_epl AS APELLIDO, a.dias AS DIAS, a.fec_ini AS FECHAINI, a.fec_fin AS FECHAFIN, a.fec_solicitud AS FECHASOL from incapacidades_tmp a, empleados_gral b, empleados_basic c
where a.cod_epl = b.cod_epl
and a.estado = 'P'
and a.cod_epl = c.cod_epl
and b.cod_jefe = '$codigo'";
	  
	$rh5 = $conn->Execute($qry5); 
	

	while($row5 = $rh5->FetchRow()){
		
$valor1=$row5["CEDULA"];
$valor2=$row5["NOMBRE"];
$valor21=$row5["APELLIDO"];
$valor3=$row5["DIAS"];
$valor4=$row5["FECHAINI"];
$valor5=$row5["FECHAFIN"];
$valor6=$row5["FECHASOL"]; //TODOOO?

   echo' <tr>
<td>
'.$valor1.'
</td>
<td>
'.$valor2.' '.$valor21.'
</td>
<td>
'.$valor3.'
</td>
<td>
'.$valor4.'
</td>
<td>
'.$valor5.'
</td>
<td>
'.$valor6.'
</td>
	</tr> ';
	}
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
//-----------------------------INCAPACIDADES PENDIENTE POR RADICAR POR EL COLABORADOR 

	$qry5="select c.cedula AS CEDULA, c.nom_epl AS NOMBRE, c.ape_epl AS APELLIDO, a.dias AS DIAS, a.fec_ini AS FECHAINI, a.fec_fin AS FECHAFIN, a.fec_solicitud AS FECHASOL from incapacidades_tmp a, empleados_gral b, empleados_basic c
where a.cod_epl = b.cod_epl
and a.estado = 'P'
and a.cod_epl = c.cod_epl
and b.cod_jefe = '$codigo'";
	  
	$rh5 = $conn->Execute($qry5); 
	

	while($row5 = $rh5->FetchRow()){
		
$valor1=$row5["CEDULA"];
$valor2=$row5["NOMBRE"];
$valor21=$row5["APELLIDO"];
$valor3=$row5["DIAS"];
$valor4=$row5["FECHAINI"];
$valor5=$row5["FECHAFIN"];
$valor6=$row5["FECHASOL"]; //TODOOO?

   echo' <tr>
<td>
'.$valor1.'
</td>
<td>
'.$valor2.' '.$valor21.'
</td>
<td>
'.$valor3.'
</td>
<td>
'.$valor4.'
</td>
<td>
'.$valor5.'
</td>
<td>
'.$valor6.'
</td>
	</tr> ';
	}
}
if(isset($rowa['CONTEO'])){
$conn = $config;
//-----------------------------INCAPACIDADES PENDIENTE POR RADICAR POR EL COLABORADOR 

	$qry5="select c.cedula AS CEDULA, c.nom_epl AS NOMBRE, c.ape_epl AS APELLIDO, a.dias AS DIAS, a.fec_ini AS FECHAINI, a.fec_fin AS FECHAFIN, a.fec_solicitud AS FECHASOL from incapacidades_tmp a, empleados_gral b, empleados_basic c
where a.cod_epl = b.cod_epl
and a.estado = 'P'
and a.cod_epl = c.cod_epl
and b.cod_jefe = '$codigo'";
	  
	$rh5 = $conn->Execute($qry5); 
	

	while($row5 = $rh5->FetchRow()){
		
$valor1=$row5["CEDULA"];
$valor2=$row5["NOMBRE"];
$valor21=$row5["APELLIDO"];
$valor3=$row5["DIAS"];
$valor4=$row5["FECHAINI"];
$valor5=$row5["FECHAFIN"];
$valor6=$row5["FECHASOL"]; //TODOOO?

   echo' <tr>
<td>
'.$valor1.'
</td>
<td>
'.$valor2.' '.$valor21.'
</td>
<td>
'.$valor3.'
</td>
<td>
'.$valor4.'
</td>
<td>
'.$valor5.'
</td>
<td>
'.$valor6.'
</td>
	</tr> ';
	}
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
//-----------------------------INCAPACIDADES PENDIENTE POR RADICAR POR EL COLABORADOR 

	$qry5="select c.cedula AS CEDULA, c.nom_epl AS NOMBRE, c.ape_epl AS APELLIDO, a.dias AS DIAS, a.fec_ini AS FECHAINI, a.fec_fin AS FECHAFIN, a.fec_solicitud AS FECHASOL from incapacidades_tmp a, empleados_gral b, empleados_basic c
where a.cod_epl = b.cod_epl
and a.estado = 'P'
and a.cod_epl = c.cod_epl
and b.cod_jefe = '$codigo'";
	  
	$rh5 = $conn->Execute($qry5); 
	

	while($row5 = $rh5->FetchRow()){
		
$valor1=$row5["CEDULA"];
$valor2=$row5["NOMBRE"];
$valor21=$row5["APELLIDO"];
$valor3=$row5["DIAS"];
$valor4=$row5["FECHAINI"];
$valor5=$row5["FECHAFIN"];
$valor6=$row5["FECHASOL"]; //TODOOO?

   echo' <tr>
<td>
'.$valor1.'
</td>
<td>
'.$valor2.' '.$valor21.'
</td>
<td>
'.$valor3.'
</td>
<td>
'.$valor4.'
</td>
<td>
'.$valor5.'
</td>
<td>
'.$valor6.'
</td>
	</tr> ';
	}
}
//------------------------------FIN antidoto

?>
	</tbody>
</table>
</div>
</center>

</body>