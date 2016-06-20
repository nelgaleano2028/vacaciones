<?php
@session_start();
if (!isset($_SESSION['privi'])){
          
 header("location: index.php");
}

include_once("class_incapacidades.php");
$administrador=new vacaciones();
$lista3=$administrador->solicitud_pendientes_epl_gral_edith();
set_time_limit (86400);
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
function aceptar_solicitud(cod_con,cod_epl,fec_ini,fec_fin,cod_cc2,dias,cod_aus,consecutivo,encargado){
                $.ajax({
			type:"POST",
			url: "incapacidad_gral.php",
			data:"encargado="+encargado+"&cod_con="+cod_con+"&cod_epl="+cod_epl+"&fec_ini="+fec_ini+"&fec_fin="+fec_fin+"&cod_cc2="+cod_cc2+"&dias="+dias+"&cod_aus="+cod_aus+"&consecutivo="+consecutivo+"&accion=aprobar",
			    beforeSend: function(){
		      //notify("Enviando....",500,80000,"info","info");
							
						},
			success: function(datos){
				//$("#formulario").html(datos);
				//notify(datos,500,5000,"email","email");
                       alert(datos);         
				$("#fila-"+consecutivo).remove();
			}
		});
		return false;
            }
            
         function rechazar_solicitud(consecutivo,encargado,cod_epl){
            var obse=$("#observacion"+consecutivo).val();
	    if(obse == ""){
		  alert("Debe ingresar la razón por la cual rechaza esta solicitud.");
	    }else{
            $.ajax({
                type:"POST",
                url:"incapacidad_gral.php",
                data:"cod_epl="+cod_epl+"&encargado="+encargado+"&obse="+obse+"&consecutivo="+consecutivo+"&accion=rechazar",
		    beforeSend: function(){
		     // notify("Enviando....",500,80000,"info","info");
							
						},
                success: function(datos){
				//$("#formulario").html(datos);
                              //  notify(datos,500,5000,"email","email");
							  alert(datos);
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
		        "sScrollXInner": "100%",
		        "bScrollCollapse": true,
		        "aaSorting": [[ 5, "desc" ]],
			"bJQueryUI": true,
			"iDisplayLength": 5,
			"sDom": '<"H"TfrlP>t<"F"ip><"clear">',
		        "oTableTools": {
								"sSwfPath": "../extras/TableTools/media/swf/copy_csv_xls_pdf.swf",
				                       		"aButtons": [
								{"sExtends": "xls","sButtonText": "Guardar a Excel","sFileName": "solicitudes_incapacidades.xls","bFooter": false,"mColumns":[0,1,2,3,4,5,6,7,8,9,10,11,12]},
								{"sExtends": "pdf","sButtonText": "Guardar a PDF","sTitle": "Solicitudes de vacaciones por empleado","sFileName": "solicitudes_incapacidades.pdf","sPdfOrientation": "landscape","mColumns":[0,1,2,3,4,5,6,7,8,9,10,11,12]},
 
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
			<h2>Editar o Cerrar Solicitudes</h2>
 <div id="capa2" class="capa2">			
 <p style="text-align:left">Si tiene problemas para exportar la tabla verifique que tiene instalado el reproductor de adobe flash player, de lo contrario descargue <a href="http://get.adobe.com/es/flashplayer/">aqui</a>, si persiste con el inconveniente por favor abrir la pagina WEB con Google Chrome. </p>
                    <table cellpadding="0" cellspacing="0" border="0" class="display " id="admin" width="100%">
						    
			      <thead width="100%">
			        <tr class="odd">
					
				<th scope="col" >Consec</th>
			    <th scope="col">Cedula</th>
		        <th scope="col">Nombres y Apellidos </th>	
		        <th scope="col">Tipo Incapacidad</th>	
				<th scope="col">Dias</th>
				<th  scope="col">Fecha Inicial</th>
				<th  scope="col">Fecha Final</th>
				<th  scope="col">Fecha Solicitud</th>
				<th  scope="col">Jefe</th>
				<th  scope="col">Ciudad</th>
		        <th  scope="col">Cargo</th>
				<th  scope="col">Area</th>
		        <th  scope="col">Direccion</th>
                			
                 <th  scope="col">Editar</th>
                 <th  scope="col">Cerrar</th>
                 <th  scope="col">Comentario Cierre</th>
				 
			        </tr>
			      </thead>
                    <tbody width="100%">
			      <?php
			     
			             for($i=0; $i<count($lista3); $i++){
						       
					if($i % 2){
                                                   echo "<tr id='fila-".$lista3[$i]['CONSECUTIVO']."' class='odd'>";
					}else{
						   echo "<tr id='fila-".$lista3[$i]['CONSECUTIVO']."'>";
			                     }
					
			      ?>
						   <td ><?php echo $lista3[$i]['CONSECUTIVO']; ?></td>
					       <td ><?php echo $lista3[$i]['cedula']; ?></td>
					       <td><?php echo utf8_decode($lista3[$i]['nombre'])." ".utf8_decode($lista3[$i]['apellido']); ?></td>
						   <td ><?php echo $lista3[$i]['NOM_AUS']; ?></td>
						   <td><?php echo $lista3[$i]['dias']; ?></td>
						   <td><?php echo date("d-m-Y",strtotime($lista3[$i]['inicial'])); ?></td>
                           <td><?php echo date("d-m-Y",strtotime($lista3[$i]['final'])); ?></td>
						   <td><?php echo date("d-m-Y",strtotime($lista3[$i]['solicitud'])); ?></td>
						   <td><?php echo utf8_decode($lista3[$i]['NOMJEFE'])." ".utf8_decode($lista3[$i]['APEJEFE']); ?></td>
						   <td><?php echo utf8_decode($lista3[$i]['CIUDAD']); ?></td>
						   <td><?php echo utf8_decode($lista3[$i]['cargo']); ?></td>
						   <td><?php echo utf8_decode($lista3[$i]['area']); ?></td>
						   <td><?php echo utf8_decode($lista3[$i]['DIRECCION']); ?></td>
                  <td><span class="dele">
							<a href="editar_incapacidades.php?numero=<?php echo $lista3[$i]["CONSECUTIVO"]; ?>&codigo=<?php echo $lista3[$i]["codigo"]; ?>&diast=<?php echo $lista3[$i]["dias"]; ?>"> 
							<img src="../imagenes/tips.png" title="Editar" alt="Editar" width="16" height="16"/>
							</a></span>
							</td>
                  <td><span class="dele">
							<a href="#" onClick="rechazar_solicitud('<?php echo $lista3[$i]['CONSECUTIVO']; ?>','<?php echo $_SESSION['cod_admin']; ?>','<?php echo $lista3[$i]['codigo']; ?>');" > 
							<img src="../imagenes/delete1.png" title="Cerrar" alt="Cerrar" /> 
							</a></span>
							</td>
			      <td><input id="observacion<?php echo $lista3[$i]['CONSECUTIVO']; ?>" type="text" />
                              </td>
			      
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