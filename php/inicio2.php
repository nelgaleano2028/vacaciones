<?php
@session_start();

if (!isset($_SESSION['privi'])){
  
echo "<script>location.href='index.php'</script>";
}
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

<!-- ARCHIVOS CSS -->
<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" type="text/css" href="../css/general.css" />
<link rel="stylesheet" type="text/css" href="../js/chosen/chosen.css"  />
<link rel="stylesheet" type="text/css" href="../css/estilomio.css" />
<link rel="stylesheet" type="text/css" href="../css/mainCSS.css" />

<style type="text/css">
    @import "../css/datatable/demo_table.css";
    @import "../css/datatable/demo_page.css";
</style>


<!-- ARCHIVOS JAVASCRIPT -->

<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" src='../js/dataTables.fnGetFilteredNodes.js'></script>
<script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
<script type='text/javascript' src='../js/funciones.js'></script>

          
<script>
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
  
  indice = document.getElementById("anio").selectedIndex;
  
  $("#aparecer").slideUp('slow');

           $("#anio").change(function(){
              	indice = document.getElementById("anio").selectedIndex;
            //alert(indice);return false;
			  
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
	$(function() {
    if (window.PIE) {
        $('.rounded').each(function() {
            PIE.attach(this);
        });
    }
});

$(document).ready(function () {
    
	
    $(".boton").click(function (){
		
        $(".errorr").remove();
        if( $("#anio").val() == "" ){
           	    
	     $("#val").html("<span class='errorr'>Seleccione un año</span>");
            return false;
        }
		
		});
		





 $("#envio").click(function(){
		
		alert("A continuacion se hara envio de los certificados, solo tardara unos segundos.");
		
		var ano=$("#anio").val();
		
		if(ano!=""){
		
			
				
				
		$.ajax({
		    type:"POST",
		    url: "pdfadm2.php",
		    data:"anio="+anio+"&envio=correo",
		    success: function(datos){
			
			console.log(datos);
				//$("#res").html(datos);
				//notify("Se envi&oacute; satisfactoriamente",500,5000,"email","email");
				
			
		    }
		    
		});
		}
		
		});
});

</script>


</head>

<body>





<br>
<div id="principal">
	<form name="formulario"  id="pago" method="post"  action="pdfadm2.php" target="TargetFrame">
		<div id="titulo"><!--div titulo  -->  
			<span style="font-weight:bold; font-family:Arial; font-size:20px">Envio de Certificados de Ingresos y Retenciones </span>

<br><br>
    		<span style="font-weight:bold; font-family:Arial; font-size:13px">Año Certificado:</span>

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
  			<input type="hidden" value="enviar" id="envios" name="enviar"/>
<center>
<input type="submit" name="envio" id="envio" value="Enviar a Correo" class="boton"/>
</center>
  		
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
             
		 //$sql="select *, convert(varchar(20),fec_ret,111) as EndTime  from empleados_basic emp, cargos car, centrocosto2 cen where emp.cod_car=car.cod_car and emp.cod_cc2=cen.cod_cc2 and emp.estado = 'A'";
		 /*$sql="select emp.estado, emp.cod_epl as COD_EPL,CEDULA,NOM_EPL, APE_EPL,NOM_CAR, NOM_CC2,TO_CHAR(fec_ret,'DD-MON-YYYY ')as ENDTIME  from empleados_basic emp, cargos car, centrocosto2 cen where emp.cod_car=car.cod_car and emp.cod_cc2=cen.cod_cc2 and emp.estado = 'A'";*/
		 
		 /*$sql="select emp.estado, emp.cod_epl as COD_EPL,CEDULA,NOM_EPL, APE_EPL,NOM_CAR, NOM_CC2,TO_CHAR(fec_ret,'DD-MON-YYYY ')as ENDTIME  from empleados_basic emp, cargos car, centrocosto2 cen where emp.cod_car=car.cod_car and emp.cod_cc2=cen.cod_cc2";*/
		 
		//$sql="select FROM HIST_CERTRTEFTE
		
		
		 $sql="select distinct (H.COD_EPL), H.COD_EPL AS CODIGO, E.ESTADO, E.CEDULA,E.NOM_EPL, E.APE_EPL, NOM_CAR, NOM_CC2, G.email 
from HIST_CERTRTEFTE H, EMPLEADOS_BASIC E, cargos car, centrocosto2 cen, empleados_gral G
  WHERE  H.COD_EPL = E.COD_EPL and E.cod_car=car.cod_car and E.cod_cc2=cen.cod_cc2 AND E.cod_epl=G.cod_epl AND 
 E.ESTADO='A' and  EMAIL IS NOT NULL";
	         
	   
	         $rh = $conn->Execute($sql); 
	   			
	         while($row = $rh->FetchRow()){
	   
	   		      // if( $row["ENDTIME"]=='' ){
       			
          ?>
        				<tr class="gradeX">
          					<td><?php echo $row['CEDULA'] ?></td>
							<td><?php echo $row['ESTADO'] ?></td>
          					<td><?php echo utf8_encode($row['NOM_EPL']) ?></td>
          					<td><?php echo utf8_encode($row['APE_EPL']) ?></td>
          					<td><?php echo utf8_encode($row['NOM_CC2']) ?></td>
          					<td><?php echo utf8_encode($row['NOM_CAR']) ?></td>
                    		<td><center><input type="checkbox" name="vec[]" id="che" value='<?php echo $row['CODIGO'] ?>'/><center/></td>
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