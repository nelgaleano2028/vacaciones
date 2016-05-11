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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrador</title>

<!-- ARCHIVOS CSS -->
<link type="text/css" href="../css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" type="text/css" href="../css/general.css" />
<link rel="stylesheet" type="text/css" href="../js/chosen/chosen.css"  />
<link rel="stylesheet" type="text/css" href="../css/estilomio.css" />
<link rel="stylesheet" type="text/css" href="../css/mainCSS.css" />
<link rel="stylesheet" type="text/css" href="../css/scroll.css"  />	

<style type="text/css">
    @import "../css/datatable/demo_table.css";
    @import "../css/datatable/demo_page.css";
</style>


<!-- ARCHIVOS JAVASCRIPT -->

<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" src='../js/dataTables.fnGetFilteredNodes.js'></script>
<script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
<script type='text/javascript' src='../js/funciones.js'></script>

          
<script>

$(function() {
    if (window.PIE) {
        $('.rounded').each(function() {
            PIE.attach(this);
        });
    }
});


$(document).ready(function() {
		$('#tabla-candidato-pt').dataTable({
          "bJQueryUI": true,
          "oLanguage":{
                              "sProcessing":   "Procesando...",
    "sLengthMenu":   "Mostrar _MENU_ registros",
    "sZeroRecords":  "No se encontraron resultados",
    "sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
    "sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
    "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
    "sInfoPostFix":  "",
    "sSearch":       "Buscar:",
    "sUrl":          "",
    "oPaginate": {
        "sFirst":    "Primero",
        "sPrevious": "Anterior",
        "sNext":     "Siguiente",
        "sLast":     "Último"
    }
                      }
     	});
});
</script>

<script type="text/javascript">
		function validar(){
			indice = document.getElementById("anio").selectedIndex;
			if( indice == null || indice == 0 ) {
  				alert("Seleccione un año correspondiente");
  				return false;
			}
		}



		$(document).ready(function() {
			$("#check").click(function(){
				var oTable = $('#tabla-candidato-pt').dataTable();
				var nFiltered = oTable.fnGetFilteredNodes();
						
				//alert(nFiltered.length +' nodes were returned' );
		      	if($("#check").is(":checked")){
					//$( "input:checkbox", nFiltered ).attr("disabled", true);
	       			$( "input:checkbox", nFiltered ).attr("checked", "checked");
        		}else{
        			$( "input:checkbox", nFiltered ).removeAttr("checked");
        		}
			});
		});
</script>

<script type="text/javascript">
  $(document).ready(function() {

           $("#anio").change(function(){
              	indice = document.getElementById("anio").selectedIndex;
              
              	if( indice != 0 ) {
                	$("#aparecer").slideDown('slow');
                }else{
              		if(indice == 0 ) {
                  		$("#aparecer").slideUp('slow');
                     }
                }
            });
  }); 
</script>


<script type="text/javascript">

$(document).ready(function() {


	
														var oTable= $('#tabla-candidato-pt').dataTable();
		                    							var sData = $('input:checked', oTable.fnGetNodes()).serialize();
														var envio=$("#envios").val();		

			                		/*$.ajax({
		    	                    		type:"POST",
		    	                    		url: "pdfadmin3.php",
		    	                    		data:sData+"&envio="+envio,
							   
		    	                    		success: function(datos){
											console.log(datos);
					               			//$("#res").html(datos);
						           			//notify(datos,500,50000,"email","email");
						           			}
								
				});*/
				
				
				
				
 	    $("#sefue").click(function(){
		
				var oTable = $('#tabla-candidato-pt').dataTable();
				var nFiltered = oTable.fnGetFilteredNodes();
			
			if($("input:checkbox", nFiltered).is(":checked")){
			 	
			 	$('#dialog1').dialog('open');
				
			}else{
			 	$('#dialog2').dialog('open');
				
			}
  });
  
});


</script>
</head>

<body>
<br>
<div id="principal">
	<form name="formulario" action="pdfadmin3.php" method="POST" id="formulario" method="post">
		<div id="titulo"><!--div titulo  -->  
			<span style="font-weight:bold; font-family:Arial; font-size:20px">Descarga uno por uno los Certificados de Ingresos y Retenciones </span>

<br><br>
    		<span style="font-weight:bold; font-family:Arial; font-size:13px">A&ntilde;o Certificado:</span>

    		<select name="anio" id="anio"  style="width:100px;">
      			<option value="">Seleccione</option>
      			<?php 		///  MODIFICACION PARA FECHA DINAMICA  ///
				include_once('../lib/configdbf.php');
				include_once('../lib/configdbc.php');
				include_once('../lib/configdb.php');
				include_once('../lib/configdbt.php');
				
				$query = "SELECT DISTINCT ANOCERTI FROM HIST_CERTRTEFTE WHERE ANOCERTI>2012 ORDER BY ANOCERTI DESC";
				$rs = $conn->Execute($query);			
				$row0 = $rs->fetchrow();
				$añoCer = $row0["ANOCERTI"];

				for($i=2012; $i<$añoCer+1; $i++){ 
				?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php } ?>
    		</select>
  
 		</div><!--cierre div titulo  -->
  		
        <br>
  		<br>
  
  		<div id="aparecer"><!--div aparecer  -->
  			<div id="centrado"><!--div centrado -->
  				<input type="hidden" value="envio" id="envios" />
				
				<input type="submit" value="Descargar">
  				<!--<button type="button" value="Descargar" name="descarga" id="sefue"  class="boton" style="width:100px">Descargar</button>
     		    <!--<div id="res"></div>-->
				
				
  			</div><!--cierre div centrado -->
  		
        	<br>
    
    		<div class="content-table"><!--div tabla -->
      			<table id="tabla-candidato-pt"  class="display">
        			<thead>
          				<tr>
            				<th>Cedula</th>
							<th>Estado</th>
            				<th>Nombre</th>
            				<th>Apellido</th>
            				<th>Area</th>
            				<th>Cargo</th>
            				<th><center><input type="checkbox" name="check"  id="check" /><center/></th>
          				</tr>
        			</thead>
                	<tbody>
          
		  <?php
             
		 
		 $sql="select DISTINCT (H.COD_EPL), E.ESTADO, E.CEDULA,E.NOM_EPL, E.APE_EPL,NOM_CAR, NOM_CC2, G.email from HIST_CERTRTEFTE H, EMPLEADOS_BASIC E, cargos car, centrocosto2 cen, empleados_gral G
  WHERE  H.COD_EPL = E.COD_EPL and E.cod_car=car.cod_car and E.cod_cc2=cen.cod_cc2 AND E.cod_epl=G.cod_epl";
		 
		//VAR_DUMP($sql);die();
	         
	   
	         $rh = $conn->Execute($sql); 
	   			
	         while($row = $rh->FetchRow()){
	   
	   		   //  if($row["ESTADO"]=='I' OR $row["EMAIL"]==NULL ){
       			
          ?>
        				<tr class="gradeX">
          					<td><?php echo $row['CEDULA'] ?></td>
							<td><?php echo $row['ESTADO'] ?></td>
          					<td><?php echo utf8_encode($row['NOM_EPL']) ?></td>
          					<td><?php echo utf8_encode($row['APE_EPL']) ?></td>
          					<td><?php echo utf8_encode($row['NOM_CC2']) ?></td>
          					<td><?php echo utf8_encode($row['NOM_CAR']) ?></td>
                    		<td><center><input type="checkbox" name="vec[]" id="che" value='<?php echo $row['COD_EPL'] ?>'/><center/></td>
        				</tr>
          	<?php
		  		
			        //}//Cierre if
			  }//Cierre While
			?>
        			</tbody>
    			</table>

 			</div><!--cierre div tabla  -->

		</div><!--cierre div aparecer  -->
	</form>
</div><!--cierre div principal-->


		<div id="dialog1" title="Aviso" style="display:none">
			<p style="font-weight:900">Esta seguro que desea enviar estos correos?</p>
		</div>
        <div id="dialog2" title="Aviso" style="display:none">
			<p style="font-weight:900">No hay datos a Enviar</p>
		</div>

</body>
</html>