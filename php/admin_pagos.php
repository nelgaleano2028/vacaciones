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

if(!isset($_SESSION['privi'])){
  
  header("location: index.php");

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
    <head>
        <title>Comprobante de Pago Administrador</title>
  
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
<!--  <link href="../css/azul/jquery-ui-1.8.12.custom.css" rel="stylesheet" type="text/css" />-->
 <link rel="stylesheet" type="text/css" href="../css/general.css" />
 <link type="text/css" href="../js/chosen/chosen.css" rel="stylesheet" />
 <link type="text/css" href="../css/monitores_cs.css" rel="stylesheet"/>
 <link rel="stylesheet" href="../css/jquery.ui.all.css">
 <link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
 <link rel="stylesheet" href="../css/validacion.css" media="screen" />
 <link rel="stylesheet" type="text/css" href="../css/scroll.css"  />
<link rel="stylesheet" href="../css/demos.css"> 

     <style type="text/css">
    @import "../css/datatable/demo_table.css";
    @import "../css/datatable/demo_page.css";
          </style>
  
           
         <!-- ARCHIVOS JAVASCRIPT -->
         <script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
         <script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>
         <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
         <script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
         <script type='text/javascript' src='../js/funciones.js'></script>
         
	 <script src="../js/dataTables.fnGetFilteredNodes.js"></script>


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
	  
	 
   <!-- MODAL-->
   
   
        <script src="../js/jquery.ui.core.js"></script>
	<script src="../js/jquery.ui.widget.js"></script>
	<script src="../js/jquery.ui.mouse.js"></script>
	<script src="../js/jquery.ui.button.js"></script>
	<script src="../js/jquery.ui.draggable.js"></script>
	<script src="../js/jquery.ui.position.js"></script>
	<script src="../js/jquery.ui.dialog.js"></script>
	 




     <script type="text/javascript" charset="utf-8">
     
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
     
		 
		 
		 
		 $(document).ready(function() {
			 
			 
			 
			 $( "#dialog-confirm" ).dialog({
				 autoOpen: false,
				 resizable: false,
				 height:210,
				 width:300,
				 modal: true,
				 buttons: {
					 "Aceptar": function() {
						 
						 
						 var oTable = $('#tabla-candidato-pt').dataTable();
						 var sData = $('input:checked', oTable.fnGetNodes()).serialize();
						 
						 
						 
						 var ano=$("#res_ano").attr("value");
						 var per=$("#periodo").attr("value");
						 var tipo=$("#res_tipo").attr("value");
						 var liqui=$("#res_liq").attr("value");
						 
						 $.ajax({
							 type:"POST",
							 url: "pdf_empleados.php",
							 data:sData+"&ano="+ano+"&per="+per+"&tipo="+tipo+"&liqui="+liqui,
							 beforeSend: function(){
								 notify("Enviando....",500,80000,"info","info");
								 $("#hola").css("display", "none");
							 },
							 success: function(msg){
								 
								 if(msg=='hola'){
									 notify("Por lo menos debe seleccionar un empleado",500,50000,"info","info");
									 }else{
									 
									 notify(msg,500,50000,"email","email");
								 }	
							 },
							 complete: function(){
								 
								 
								 $("#hola").css("display", "inline");
								 
							 }
							 
						 });
						 
						 
						 $( this ).dialog( "close" );
					 },
					 Cancel: function() {
						 $( this ).dialog( "close" );
					 }
				 }
			 });
			 
			 
			 $('#hola').click( function() {
				 
				 
				 $( "#dialog-confirm" ).dialog( "open" );
			 } );
			 
			 
		 } );
		 
		 /*@function llenar_combo nos llena un select con los datos de la bd
			 *@param id del select
			 *@param indico que datos voy a traer (#)
			 *@param url donde se realiza dicho negocio
		  */
		 $(function(){
			 
			 llenar_combo("tipo","5","ajax_catalogos.php");
			 llenar_combo("anio","3","ajax_catalogos.php");
			 
			 
		 })
		 
		 $(document).ready(function(){
			 
			 
			 
			 $("#per").load('genera-select.php?id=3');
			 
			 
		 });
		 
		 
		 /*Jquery que me selecciona y deselecciona los check*/
		 $(document).ready(function() {
			 $("#checkall").click(function(){
				 var oTable = $('#tabla-candidato-pt').dataTable();
				 var nNodes = oTable.fnGetFilteredNodes( );
				 if($("#checkall").is(":checked")){
					 $( "input:checkbox", nNodes ).attr("readonly","readonly");
					 $( "input:checkbox", nNodes ).attr("checked", true);
					 }else{                      
					 $( "input:checkbox", nNodes ).removeAttr("checked");    
				 }
				 
			 });
			 
			 
			 
		 } );
		 
		 
		 
		 
	 </script>
        
		<script type="text/javascript">
            
			
			
			
			
			$(document).ready(function(){
                $("#tipo").change(function(event){
					if($("#tipo").find(':selected').val()!=-1){
						var id = $("#tipo").find(':selected').val();
						$("#per").load('genera-select.php?id='+id);
						
						/*CSS DEL SELECT*/
						$("#capa_per").css("display","inline");
						$("#per").css("border-color","#AAA");
						$("#per").css("overflow","hidden");
						$("#per").css("white-space","nowrap");
						$("#per").css("position","relative");
						$("#per").css("color","#444");
						//$("#per").css("background-color","#F9F9F9");
						$("#per option").css("font-family","Georgica");
						$("#per").css("border-style","solid");
						$("#per").css("border-width","1");
						//$("#per").css("background-color","#CC33CC");
						$("#per").css(" border-radius","4px");
						$("#per").css("-moz-border-radius","4px");
						$("#per").css("-webkit-border-radius","4px");
						/*FIN DEL CSS*/
						}else{
						
						$("#capa_per").css("display","none");
						$("#per").val('');
					}
					//$("#id_org").load('referencias_laborales.php?id='+id);
					
                });
            });
			
			
        </script>
		
		
		
		<script>
			//////////////////////////////VALIDACION DE CAMPOS///////////////////////////////// 
			$(document).ready(function () {
				
				/*Valido los campos del formulario si estan null */
				
				$("#enviar").click(function (){
					$(".errorr").remove();
					if( $(".campo1").val() == "-1" ){
						
						$("#val").html("<span class='errorr'>Seleccione un año</span>");
						return false;
						}else if( $(".campo2").val() == "-1" ){
						$("#periodoss").html("<span class='errorr'>Ingrese periodo </span>");
						return false;
						}else if( $(".campo3").val() == "-1"){
						$("#tipos").html("<span class='errorr'>Seleccione un Tipo</span>");
						
						return false;
						}else if( $(".campo4").val() == "-1"){
						$("#liquidacion").html("<span class='errorr'>Seleccione una Liquidación</span>");
						
						return false;
					}
				});
				$(".nombre, .asunto, .mensaje").keyup(function(){
					if( $(this).val() != "" ){
						$(".errorr").fadeOut();
						return false;
					}
				});
				$(".email").keyup(function(){
					if( $(this).val() != "" && emailreg.test($(this).val())){
						$(".errorr").fadeOut();
						return false;
					}
				});
			});
			
			
			
			$(function(){ 
				try{      
					$(".boton").button(); //clase para los botones
				}catch(err){return;}
			}); 
			$(function(){
				try{
					$(".combo").chosen(); //clase para los combobox   
				}catch(err){return;}
			});
			
			//////////////////////////////////////////////////////////////////////////
			
			
			
			/////////////////////SELECCION DE CHECK/////////////////
			
			var oTable;
			
			$(document).ready(function() {
				$('#check').submit( function() {
					var sData = $('input', oTable.fnGetNodes()).serialize();
					alert( "The following data would have been submitted to the server: \n\n"+sData );
					return false;
				} );
				
				oTable = $('#content-table').dataTable();
			} );
			///////////////////////////////////////////////////////
		</script>
		
    </head>
    <body>
		<!--Vista -->
		<div id="pago">
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>" id="pago">
				<fieldset class="Estilo5">
					<legend>
						<h2>Comprobante de Pago</h2>
					</legend>
					<!--Capa de los campos -->
					<div id="capa">
						<span class="Estilo5">
							<label>
								<strong class="tam_str">A&ntilde;o</strong>
							</label>
						</span><br>
						<select id="ano" name="ano" class="combo campo1" style="width:140px;">
							<option value="">Seleccione</option>
							<?php  					///	 FECHA DINAMICA	///
								$año=2012;
								while($año <=date("Y")) {
								echo '<option value="'.$año.'">'.$año.'</option>';
								$año=$año+1;
							}
							?>
						</select><span id="val"></span>
						
						<div style="visibility:hidden;">
							<label><strong class="tam_str">Tipo de pago</strong></label>
							
							<select id="tipo" name="tipo" class="combo campo3" style="width:140px;">
							</select>
						<span id="tipos"></span></div>
						<div id="capa_per" >  
							<label><strong class="tam_str">Periodo</strong></label><br>
							<select name="per" id="per" class="campo2" ></select><span id="periodoss"></span><br><br>
							</div><p><br>
							<!-- </div>-->
							<input type="hidden" name="liqui" id="liqui" value="14"/>
						</p>
						
					</div>
					<!--Capa de los campos -->
					
					
					<center>
						
						<input type="submit" id="enviar" name="enviar" value="Consultar" class="boton"/>
						
					</center><br>
					
				</fieldset>
			</form>
		</div>
		
		<br><br><br>
		<center>
			<?php
				include("class_comprobante.php");
				if($_POST){
					
					$com=new comprobante();
					
					
					$com->set_ano(strtoupper($_POST["ano"]));
					$com->set_liq_ini(strtoupper($_POST["liqui"]));
					$com->set_per_ini(strtoupper($_POST["per"]));
					$com->set_tip_pag(strtoupper($_POST["tipo"]));
					
					$generar=@$com->consulta_de_empl();
					
					if($generar==null){
						
						echo '
						
						
						<script>
						$(document).ready(function(){
						
						$(window).load(function(){
						
						notify("No se encontraron empleados por el momento",500,8000,"error","error");
						return false;
						
						});    });
						</script>';
						
						}else{
						
						
						
						$i=0;
						
						$reporte='
						<form id="form">
						<div class="content-table" align="center">
						
						
						<table id="tabla-candidato-pt" class="display">
						<thead>
						<tr>
						<th width="40">Cedula</th>
						<th width="40">Nombre</th>               
						<th width="40">Apellido</th>
						<th width="40">Area</th>               
						<th width="40">Cargo</th>
						
						
						<th width="50"><center><input id="checkall" type="checkbox" class="select-all" name="checkall" ></center></th>
						</tr>
						</thead> 
						<tbody>';
						
						
						while($i<count($generar)){ 
							$reporte.= '<tr class="gradeX">
							<td>'.$generar[$i]["cedula"].'</td>
							<td>'.$generar[$i]["nombre"].'</td>
							
							<td>'.$generar[$i]["apellido"].'</td>
							<td>'.$generar[$i]["area"].'</td>
							
							<td>'.$generar[$i]["cargo"].'</td>
							
							<td align="center">
							<input  type="checkbox" name="checkall[]" value="'.$generar[$i]["codigo"].'"/>        
							</td>
							
							</tr>';
							
						$i++; }
						$reporte.='
						</tbody>        
						</table>
						
						</div> 
						<br><br>
						<input type="button" id="hola" name="" value="Enviar a Correo" class="boton"/></br></br>
						
						</center>
						
						</form>';
						
						echo $reporte;
					?>
					<input type="hidden" id="periodo" value="<?php echo $_POST["per"]; ?>"/>
					<input type="hidden" id="res_ano" value="<?php echo $_POST["ano"]; ?>"/>
					<input type="hidden" id="res_tipo" value="<?php echo $_POST["tipo"]; ?>"/>
					<input type="hidden" id="res_liq" value="<?php echo $_POST["liqui"]; ?>"/>
					
					
					
					<?php
						
						
					}
				}
			?>
			<div id="dialog-confirm" style="display: none" title='<h4>¿Seguro que quieres hacer el envi&oacute;?</h4>'><p style="font: 12px;">Se enviar&aacute;n los comprobantes a los empleados seleccionados.</p></div>
			
		</body>
	</html>
	
