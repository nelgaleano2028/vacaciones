<?php
@session_start();

if (!isset($_SESSION['privi'])){
  
  header("location: index.php");
}

include_once("class_incapacidades.php");

class vacacionesas{
public function solicitud_incap(){
        
              try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
		 $codinca = $_POST['codinca'];
		 
            $sql="select emp.cod_epl as COD_EPL,
au.CNSCTVO as CONSECUTIVO,
au.fec_solicitud AS FECHASOL,
            emp.cedula as CEDULA,emp.nom_epl as NOM_EPL,
            emp.ape_epl as APE_EPL,car.nom_car as NOM_CAR,
            cen.nom_cc2  as AREA,au.estado as ESTADO,au.fec_ini as FEC_INI,au.fec_fin AS FEC_FIN,dias AS DIAS, emp.estado AS EMPESTADO, tip.nom_tip_aus AS NOM_AUS, emp2.nom_epl AS NOMJEFE,
            emp2.ape_epl AS APEJEFE, ciu.nom_ciu AS CIUDAD, dir_epl as DIRECCION
            from empleados_basic emp, cargos car, centrocosto2 cen ,incapacidades_tmp au, tipo_ausentismo tip, empleados_gral egr, empleados_basic emp2, ciudades ciu
            where
            emp.ciu_tra = ciu.cod_ciu and
            emp.cod_epl = egr.cod_epl and  
            egr.cod_jefe = emp2.cod_epl and
            AU.COD_AUS = TIP.COD_AUS and
            au.cod_epl=emp.cod_epl and
            emp.cod_car=car.cod_car
            and emp.cod_cc2=cen.cod_cc2
            and egr.COD_JEFE='$codinca'
            order by fec_ini desc";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("codigo"=>$fila["COD_EPL"],
                                      "cedula"=>$fila["CEDULA"],
                                      "nombre"=>utf8_encode($fila["NOM_EPL"]),
                                      "apellido"=>utf8_encode($fila["APE_EPL"]),
                                      "cargo"=>utf8_encode($fila["NOM_CAR"]),
                                      "area"=>utf8_encode($fila["AREA"]),
                                      "inicial"=>$fila["FEC_INI"],
                                      "final"=>$fila["FEC_FIN"],
                                      "dias"=>$fila["DIAS"],
									  "solicitud"=>$fila["FECHASOL"],
									  "CONSECUTIVO"=>$fila["CONSECUTIVO"],
                                      "estado"=>$fila["ESTADO"],
                                      "NOM_AUS"=>$fila["NOM_AUS"],
                                      "NOMJEFE"=>$fila["NOMJEFE"],
                                      "APEJEFE"=>$fila["APEJEFE"],
                                      "CIUDAD"=>$fila["CIUDAD"],
                                      "DIRECCION"=>$fila["DIRECCION"],
									   "empestado"=>$fila["EMPESTADO"]
                                      
                                      
                                      );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista=null;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista;
    }
}

$administrador=new vacacionesas();
$lista3=$administrador->solicitud_incap();
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
								{"sExtends": "xls","sButtonText": "Guardar a Excel","sFileName": "solicitudes_empleado.xls","bFooter": false,"mColumns":[0,1,2,3,4,5,6,7,8,9,10,11,12,13]},
								{"sExtends": "pdf","sButtonText": "Guardar a PDF","sTitle": "Solicitudes por empleado","sFileName": "solicitudes_empleado.pdf","sPdfOrientation": "landscape","mColumns":[0,1,2,3,4,5,6,7,8,9,10,11,12,13]},
 
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
		<h2>Historial Reportes por Jefe</h2>   	   
 <div id="capa" class="capa">
                  <p style="text-align:left">Si tiene problemas para exportar la tabla verifique que tiene instalado el reproductor de adobe flash player, de lo contrario descargue <a href="http://get.adobe.com/es/flashplayer/">aqui</a>, si persiste con el inconveniente por favor abrir la pagina WEB con Google Chrome. </p>
		  <table cellpadding="0" cellspacing="0" border="0" class="display" id="admin" width="100%">
	<thead>
		<tr>
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
                <th  scope="col">Estado</th>
                        
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
			      
						   
                             <td><?php if($lista3[$i]['estado'] == "R"){ echo "Cerrado";}elseif($lista3[$i]['estado'] == "P"){ echo "Abierto";}  ?></td>
							  
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

