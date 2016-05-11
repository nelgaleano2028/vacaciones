<?php
session_start();
include_once("class_vacaciones.php");
$administrador=new vacaciones();
$administrador->set_encargado(@$_SESSION['cod_admin']);
$lista3=$administrador->solicitud_pendientes_epl_jefe();
set_time_limit (86400);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
    <head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:Auto Gestion Nomina:.</title>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
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


<link type="text/css" href="../css/estilo.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/scroll.css"  />		      		      

	

<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="../media/js/jquery.dataTables.js"></script>

<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.js"></script>
<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.min.js"></script>



 <script>
    function aceptar_solicitud(cod_con,cod_epl,fec_ini,fec_fin,cod_cc2,dias,cod_aus,consecutivo,encargado){
                $.ajax({
			type:"POST",
			url: "vacas_gral.php",
			data:"encargado="+encargado+"&cod_con="+cod_con+"&cod_epl="+cod_epl+"&fec_ini="+fec_ini+"&fec_fin="+fec_fin+"&cod_cc2="+cod_cc2+"&dias="+dias+"&cod_aus="+cod_aus+"&consecutivo="+consecutivo+"&accion=aprobar",
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

function rechazar_solicitud(consecutivo,encargado,cod_epl){
            var obse=$("#observacion"+consecutivo).val();
	    if($("#observacion"+consecutivo).val() == ""){
		  alert("Debe ingresar la razón por la cual rechaza esta solicitud.");
	    }else{
            $.ajax({
                type:"POST",
                url:"vacas_gral.php",
                data:"cod_epl="+cod_epl+"&encargado="+encargado+"&obse="+obse+"&consecutivo="+consecutivo+"&accion=rechazar",
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
			<h2>Solicitudes de Empleados por Aprobar o Rechazar</h2>   

                    <table cellpadding="0" cellspacing="0" border="0" class="display " id="admin" width="100%">
						     
			      <thead>
			        <tr class="odd">
				<th width="9%" scope="col">Codigo</th>
				<th width="9%" scope="col">Cedula</th>
				<th width="9%" scope="col">Nombres y Apellidos </th>	
				<th width="9%" scope="col">Area</th>
				<th width="9%" scope="col">Cargo</th>
                                    <th width="9%" scope="col">Fecha Inicial</th>
                                <th width="9%" scope="col">Fecha Final</th>
                                <th width="9%" scope="col">Valor</th>
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
			      <td><?php echo utf8_decode($lista3[$i]['area']); ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['cargo']); ?></td>
                              <td><?php echo $inicial=date("d-m-Y",strtotime($lista3[$i]['inicial']));?></td>
                              <td><?php echo $final=date("d-m-Y",strtotime($lista3[$i]['final'])); ?></td>
                              <td><?php echo $lista3[$i]['dias']; ?></td>
                               <td><span class="dele">
			      <a href="#"  onClick="aceptar_solicitud('<?php echo $lista3[$i]['concepto']; ?>','<?php echo $lista3[$i]['codigo']; ?>','<?php echo $inicial; ?>','<?php echo $final; ?>','<?php echo $lista3[$i]['cod_area']; ?>','<?php echo $lista3[$i]['dias']; ?>','<?php echo $lista3[$i]['ausencia']; ?>','<?php echo $lista3[$i]['consecutivo']; ?>','<?php echo $_SESSION['cod_admin']; ?>');" >
			      <img src="../imagenes/success.gif" title="Aprobar" alt="Aprobar" />
			      </a></span>
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
		   

 </center>
</body>
</html>