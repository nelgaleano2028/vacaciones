<?php
require_once 'class_hojast.php';
@session_start();



if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style>
html {
/*-ms-scrollbar-face-color: gray;
-ms-scrollbar-track-color: gray;*/
scrollbar-face-color:#e8e8e8; 

scrollbar-3dlight-color:white; 
scrollbar-darkshadow-color:white; 


scrollbar-track-color:#white; 
} 


::-webkit-scrollbar{ 
background:#fff; 
width:16px;
height: 16px;
overflow: visible;
} 
::-webkit-scrollbar-thumb { 
background-color: rgba(0, 0, 0, .2);
background-clip: padding-box;
border: solid transparent;
border-width: 1px 1px 1px 6px;
min-height: 28px;
padding: 100px 0 0;
box-shadow: inset 1px 1px 0 rgba(0, 0, 0, .1),inset 0 -1px 0 rgba(0, 0, 0, .07);
} 
::-webkit-scrollbar-thumb:hover { 
background-color:#a8a6a6; 
} 
::-webkit-scrollbar-button { 
height: 0; 
width: 0;

} 
::-webkit-scrollbar-track { 
background-clip: padding-box;
border: solid transparent;
border-width: 0 0 0 4px;
} 
::webkit-scrollbar-corner { 
background: transparent; 
} 



/*:-moz-system-metric(scrollbar-start-backward:rgba(0, 0, 0, 0.2);)*/

table#padre{ width:90%;}
table{ width:100%; }

   #testTable { 
           
            margin-left: auto;
            /**margin-left: 35%;*/
            margin-right: auto;
            
 
          }
          
          #tablePagination { 
            background-color: #DCDCDC; 
            
            padding: 0px 5px;
            padding-top: 2px;
            height: 25px
          }
          
          #tablePagination_paginater { 
            margin-left: auto; 
            margin-right: auto;
          }
          
          #tablePagination img { 
            padding: 0px 2px; 
          }
          
          #tablePagination_perPage { 
            float: left; 
          }
          
          #tablePagination_paginater { 
            float: right; 
          }
</style>


<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
<link rel="stylesheet" type="text/css" href="../css/plantilla_user.css" />



<link type="text/css" href="../css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" type="text/css" href="../css/general.css" />
<link rel="stylesheet" type="text/css" href="../js/chosen/chosen.css"  />
<link rel="stylesheet" type="text/css" href="../css/scroll.css"  />

 <link rel="stylesheet" href="../css/jquery.ui.all.css">



 

    
<style type="text/css">
    @import "../css/datatable/demo_table.css";
    @import "../css/datatable/demo_page.css";
</style>


<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="../js/jquery-ui-1.8.20.custom.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" src='../js/dataTables.fnGetFilteredNodes.js'></script>

<script type='text/javascript' src='../js/funciones.js'></script>

   <!-- MODAL-->
   	<script type='text/javascript' src="js/jquery-ui-1.8.17.custom.min.js"></script>
   	<script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
   	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.mouse.js"></script>
	<script src="js/jquery.ui.button.js"></script>
	<script src="js/jquery.ui.draggable.js"></script>
	<script src="js/jquery.ui.position.js"></script>
	<script src="js/jquery.ui.dialog.js"></script>
	
	 <!-- PAGINACION-->
	 <link rel="stylesheet" href="../js/__jquery.tablesorter/themes/blue/style.css" type="text/css"/>
	   <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.js" type="text/javascript"></script>
          <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.min.js" type="text/javascript"></script>
           <script src="../js/__jquery.tablesorter/jquery-latest.js" type="text/javascript"></script>
          <script src="../js/__jquery.tablesorter/jquery.tablesorter.js" type="text/javascript"></script>
          <!-- FIN PAGINACION-->
	 



          
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hoja de Vida</title>

<script type="text/javascript" charset="utf-8">
		
	  
		    
	  $(document).ready(function() {
    
	    
	   function modal_iframe(url,title,e){
        
            e.preventDefault();
            var $this = $(this);
            var horizontalPadding = 20;
            var verticalPadding = 5;
            
            $('<iframe id="site" src="'+url+'" />').dialog({
            
                title: ($this.attr('title')) ? $this.attr('title') : '<H3>'+title+'</H3>',
                autoOpen: true,
                width: 800,
		position: "top",
                height: 380,
                modal: true,
		draggable: false, 
		resizable: false,
                autoResize: true,
		hide:'drop',
		overlay: { backgroundColor: "white", opacity: 0.5 },
		open: function (event,ui) {
		                           
		                           $(this).css('width','97%'),
		                           $(this).css('height','358px')
					 
					   
					   },
		
	        buttons: {
		    
                "Cerrar": function() {
                         $( this ).dialog( "close" );
                                     }
				     
                     }
                
            })
	    
	    } 
   
	 $('#pagos').click( function(e) {
	
      	modal_iframe("forma.php","Forma de Pago",e);
		
	} );
	$('#liqs').click( function(e) {
	
      	modal_iframe("historia_liq.php","Historial Liquidaci&oacute;n",e);
		
	} );
	$('#cers').click( function(e) {
	
      	modal_iframe("configcertificado.php","Certificados",e);
		
	} );
	$('#aums').click( function(e) {
	
      	modal_iframe("aumento.php","Aumentos",e);
		
	} );
	$('#cess').click( function(e) {
	
      	modal_iframe("cesantias.php","Cesant&iacute;as Pagadas",e);
		
	} );
	
	$('#datos').click( function(e) {
	
      	modal_iframe("personal.php","Edicion de Datos",e);
		
	} );
	$('#fams').click( function(e) {
	
      	modal_iframe("familia.php","Familiares",e);
		
	} );
	$('#vacs').click( function(e) {
	
      	modal_iframe("vacas.php","Vacaciones",e);
		
	} );
	$('#enero').click( function(e) {
	
      	modal_iframe("enero.php","Enero",e);
		
	} );
	$('#febrero').click( function(e) {
	
      	modal_iframe("febrero.php","Febrero",e);
		
	} );
	$('#marzo').click( function(e) {
	
      	modal_iframe("marzo.php","Marzo",e);
		
	} );
	$('#abril').click( function(e) {
	
      	modal_iframe("abril.php","Abril",e);
		
	} );
	$('#mayo').click( function(e) {
	
      	modal_iframe("mayo.php","Mayo",e);
		
	} );
	$('#junio').click( function(e) {
	
      	modal_iframe("junio.php","Junio",e);
		
	} );
	$('#julio').click( function(e) {
	
      	modal_iframe("julio.php","Julio",e);
		
	} );
	$('#agosto').click( function(e) {
	
      	modal_iframe("agosto.php","Agosto",e);
		
	} );
	$('#septiembre').click( function(e) {
	
      	modal_iframe("septiembre.php","Septiembre",e);
		
	} );
	$('#octubre').click( function(e) {
	
      	modal_iframe("octubre.php","Octubre",e);
		
	} );
	$('#noviembre').click( function(e) {
	
      	modal_iframe("noviembre.php","Noviembre",e);
		
	} );
	$('#diciembre').click( function(e) {
	
      	modal_iframe("diciembre.php","Diciembre",e);
		
	} );
	$('#vivi').click( function(e) {
	
      	modal_iframe("credito_vivienda.php","Solicitud de Crédito de vivienda",e);
		
	} );
	
	 
});
		    
</script>



    <script>
	/*paginacion id de la tabla*/
            $(document).ready(function() {
            $('#prestamos').tablePagination({});
	    
	    $('#embargos').tablePagination({});
	    $('#traslados').tablePagination({});
	    $('#cargos').tablePagination({});
	    $('#contratos').tablePagination({});
	    $('#seguros').tablePagination({});
			
			
            } );
			
            /*quita todo conflicto de jquery*/
              var $j = jQuery.noConflict();
			  
			  /*ordenamiento id de la tabla*/
         $j(document).ready(function(){
    
        $j("#prestamos").tablesorter();
	
	$j("#embargos").tablesorter();
	$j("#traslados").tablesorter();
	$j("#cargos").tablesorter();
	$j("#contratos").tablesorter();
	$j('#seguros').tablesorter();



	//$j("#compro_ultimo").tablesorter(); 
    } 
); 
        </script>

</head>

<body>


<?php
$lista1=array();
$lista2=array();
$lista3=array();
$lista4=array();
$lista5=array();
$lista6=array();
$lista7=array();
$lista8=array();
$lista9=array();
$lista10=array();
$lista11=array();
$lista12=array();
$lista13=array();
$lista14=array();
$lista15=array();

$lista16=array();

//80032398 comprobantes de pago
//66980923 Prestamos y Cuotas
//52822413 Cesantias
//66830581 Familiares
//338641 Todos menos Cesantias ni Familiares
//$codigo="66980923";
//$codigo=@$_SESSION['cod'];

$obj=new class_hoja(@$_SESSION['cod']);

$lista1=$obj->ultimos_comprobantes();
$lista2=$obj->prestamos();
$lista3=$obj->embargos();
$lista4=$obj->historia_liq();
$lista5=$obj->formas_pago();
$lista6=$obj->certificado();
$lista7=$obj->aumentos();
$lista8=$obj->cesantias();
$lista9=$obj->familiares();
$lista10=$obj->vacaciones();
$lista11=$obj->hist_centro_costo();
$lista12=$obj->historico_cargos();
$lista13=$obj->historico_contratos();
$lista14=$obj->nomina_empleado();
$lista15=$obj->ausencias_por_mes();

$lista16=$obj->seguridad_social();
//var_dump($lista15);die("");

$validar_nomina_epl=$obj->consul_nom_empleado();

?>



<table id="padre" border="0" style="border:1px solid #9CA5A9;">
	<tr valign="top">
    	<td style="border-left:none; border-bottom:none">
        	<table id="infoGeneral" border="0" style="border:0px" >
            	<tr>
                	<td colspan="7" style="border:0px"><h2>INFORMACI&Oacute;N GENERAL</h2></td>
                </tr>
                
                <tr>
                	
                            	
                                <td width="5%" style="border:0px" class="menuhv"><a id="fams">Familiares</a></td>
                                <td width="5%" style="border:0px" class="menuhv"><a id="vacs">Vacaciones</a></td>
                                <td width="5%" style="border:0px" class="menuhv"><a id="cers">Certificado Laboral</a></td>
				
                                
                                
                         
                </tr>
                <tr>
                		<td width="5%" style="border:0px" class="menuhv"><a id="cess">Cesant&iacute;as Pagadas</a></td>
				<td width="5%" style="border:0px" class="menuhv" ><a id="pagos" title="Formas de pago">Formas de Pago </a></td>
				<!--<td width="5%" style="border:0px" class="menuhv"><a id="vivi">Solicitud de cr&eacute;dito de vivienda</a></td>-->
				
                                
                </tr>
                    	
                <tr>
                	<td colspan="7" style="border:0px" > 
                   
                   
                   
                   
<table id="compro_ultimo" width="100%" >
<caption style="font-weight:bold; text-align: left"><h3>&Uacute;LTIMOS 5 COMPROBANTES DE PAGO</h3></caption>
  <thead>
	<tr class="odd">
		<th width="20%" scope="col">N&uacute;mero</th>
	  	<th width="25%" scope="col">Liquidaci&oacute;n</th>
		<th width="18%" scope="col">Per&iacute;odo</th>	
	  	<th width="18%" scope="col">Año</th>
	  	<th width="29%" scope="col">Fecha</th>
	</tr>	
	</thead>
  
	<tbody>
    <?php
     
     if($lista1==NULL){
	echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</td></tr>";
     }else{
     $i=0;
     while($i<count($lista1)){
     
     if($i % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
      ?>
	  
	  <form method="post" id="pago" name="pago" action="pdf.php"  target="TargetFrame">
    
    	<?php  $obj->set_num_comp($lista1[$i]["numero"]);?>
       
		<td><a href="#" onclick="javascript:document.forms[<?php echo $i; ?>].submit();"><?php echo $lista1[$i]["numero"]; ?></a></td>
		<td><?php echo $lista1[$i]["liquidacion"]; ?></td>
		<td><?php  echo $lista1[$i]["periodo"];?></td>
		<td><?php  echo $lista1[$i]["ano"]; ?></td>
		<td><?php echo $lista1[$i]["fecha"]; ?></td>

		 <!--Ini Para ver 5 reportes de compr-->

            
             <input type="hidden" id="ano" name="ano" value='<?php echo $lista1[$i]["ano"];?>' />
             <input type="hidden" id="per" name="per" value='<?php echo $lista1[$i]["periodo"];?>' />
             <input type="hidden" id="liqui" name="liqui"  value='<?php echo $lista1[$i]["cod_liq"];?>' />
             <input type="hidden" id="tipo" name="tipo" value='<?php echo $lista1[$i]["tipo"];?>' />
             <input type="hidden" id="ver" name="ver" value=""/>
        </form>
	</tr>	<?php $i++; }}?>
 	
	</tbody>
</table>
                   
                                      
                    </td>
                </tr>
                
                
                <tr>
                	<td colspan="7" >
                  
                    
                    
<table width="100%" id="traslados" class="tablesorter">
<caption style="font-weight:bold; text-align: left"><h3>TRASLADOS DE &Aacute;REA</h3></caption>

  <thead>
	<tr class="odd">
		<th width="33%" scope="col">Fecha</th>
	  	<th width="33%" scope="col">Anterior</th>
		<th width="34%" scope="col">Actual</th>	
	  	<!--th width="33%" scope="col">Observacion</th>
	  	<th width="22%" scope="col">Usuario</th>-->
	</tr>	
	</thead>
  
	<tbody>
    <?php
        
     if($lista11==NULL){
		echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</tr>";
     }else{
     $i=0;
     while($i<count($lista11)){
     
     if($i % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
      ?>
 	
		<td><?php echo $lista11[$i]["fecha"]; ?></td>
		<td><?php echo $lista11[$i]["anterior"]; ?></td>
		<td style="text-align:center"><?php  echo $lista11[$i]["actual"];?></td>
		<!--<td style="text-align:center"><?php  echo $lista11[$i]["observacion"]; ?></td>
		<td><?php echo $lista11[$i]["usuario"]; ?></td>-->
	</tr>	<?php $i++; } }?>
 	
	</tbody>
</table>
                   
                    </td>
                </tr>
                
                <tr>
                	<td colspan="7" style="border:0px" ><!-- TABLA CARGOS -->
                    
               
<table width="100%" id="cargos" class="tablesorter">
<caption style="font-weight:bold; text-align: left"><h3>HIST&OacuteRICO DE CARGOS</h3></caption>
  <thead>
	<tr class="odd">
		<th width="33%" scope="col">Fecha</th>
	  	<th width="33%" scope="col">Anterior</th>
		<th width="34%" scope="col">Actual</th>	
	  	<!--<th width="33%" scope="col" >Observacion</th>
	  	<th width="22%" scope="col">Usuario</th>-->
	</tr>	
	</thead>
  
	<tbody>
    <?php
    
     if($lista12==null){
	echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</tr>";
     }else{
       
     $i=0;
     while($i<count($lista12)){
     
     if($i % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
      ?>
 	
		<td><?php echo $lista12[$i]["fecha"]; ?></td>
		<td style="text-align:center"><?php echo $lista12[$i]["anterior"]; ?></td>
		<td style="text-align:center"><?php  echo $lista12[$i]["actual"];?></td>
		<!--<td style="text-align:center"><?php  echo $lista12[$i]["observacion"]; ?></td>
		<td><?php echo $lista12[$i]["usuario"]; ?></td>-->
	</tr>	<?php $i++; }}?>
 	
	</tbody>
</table>
                
                                      
                    </td>
                </tr>
                
                
                <tr>
                	<td colspan="7" style="border:0px" >  <!-- TABLA CONTRATOS -->
                    
                     
<table width="100%" id="contratos" class="tablesorter">
<caption style="font-weight:bold; text-align: left"><h3>HIST&Oacute;RICO DE CONTRATOS</h3></caption>
  <thead>
	<tr class="odd">
		<th width="33%" scope="col">Fecha</th>
	  	<th width="33%" scope="col">Anterior</th>
		<th width="34%" scope="col">Actual</th>	
	  	<!--<th width="33%" scope="col">Observacion</th>
	  	<th width="22%" scope="col">Usuario</th>-->
	</tr>	
	</thead>
  
	<tbody>
    <?php
    
     if($lista13==null){
	echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</tr>";
     }else{
     $i=0;
     while($i<count($lista13)){
     
     if($i % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
      ?>
 	
		<td><?php echo $lista13[$i]["fecha"];?></td>
		<td style="text-align:center"><?php echo $lista13[$i]["anterior"]; ?></td>
		<td style="text-align:center"><?php  echo $lista13[$i]["actual"];?></td>
		<!--<td style="text-align:center"><?php  echo $lista13[$i]["observacion"]; ?></td>
		<td><?php echo $lista13[$i]["usuario"]; ?></td>-->
	</tr>	<?php $i++; }}?>
 	
	</tbody>
	
</table>
                    
                    
        
                  </td>
                </tr>  


                 <tr>
                	<td colspan="7" style="border:0px" >  <!-- TABLA SEGUROS -->
                    
                     
<table width="100%" id="seguros" class="tablesorter">
<caption style="font-weight:bold; text-align: left"><h3>ENTIDADES DE SEGURIDAD SOCIAL</h3></caption>
  <thead>
	<tr class="odd">
		<th width="25%" scope="col">C&oacute;digo</th>
	  	<th width="25%" scope="col">Nombre de Fondo</th>
		<th width="20%" scope="col">Fecha de Ingreso</th>	
	  	<th width="33%" scope="col">fecha de Retiro</th>
	  	<th width="22%" scope="col">Fecha de Traslado</th>
	</tr>	
	</thead>
  
	<tbody>
    <?php
    
     if($lista16==null){
	echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</tr>";
     }else{
     $i=0;
     while($i<count($lista16)){
     
     if($i % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
      ?>
 	
		<td><?php echo $lista16[$i]["codigo"];?></td>
		<td style="text-align:center"><?php echo $lista16[$i]["nombre"]; ?></td>
		<td style="text-align:center"><?php if($lista16[$i]["fecha_ing"]!=null) echo date('d-m-Y', strtotime($lista16[$i]["fecha_ing"]));?></td>
		<td style="text-align:center"><?php if($lista16[$i]["fecha_reti"]!=null) echo $lista16[$i]["fecha_reti"]; ?></td>
		<td><?php if($lista16[$i]["fecha_tras"]!=null)echo date('d-m-Y', strtotime($lista16[$i]["fecha_tras"])); ?></td>
	</tr>	<?php $i++; }}?>
 	
	</tbody>
	
</table>
                    
                    
        
                  </td>
                </tr>               
            </table>
        </td>
        
        <td style="border-left:1px solid #9CA5A9; border-bottom:none">
        	<table id="infoFinanciera" border="0" style="border:0px" >    
            	<tr>
                	<td style="border:0px" ><h2>INFORMACI&Oacute;N FINANCIERA</h2></td>
                </tr>
                
                <tr>
                	<td style="border:0px" >
			<div id="testTable">
				
                        <table width="100%" id="prestamos" class="tablesorter">
                        <caption style="font-weight:bold; text-align: left"><h3>PR&Eacute;STAMOS</h3></caption>
                          <thead>
                            <tr class="odd">
                                <th width="25%" scope="col">N&uacute;mero</th>
                                <th width="25%" scope="col">Fecha</th>
                                <th width="20%" scope="col">Valor</th>	
                                <th width="25%" scope="col">Saldo</th>
                                <th width="30%" scope="col">Estado</th>
                            </tr>	
                           </thead>
                          
                            <tbody>
                        <?php
                            
                            $var="odd";
                            
                            if($lista2==NULL){
                        ?>
                            <tr>
                                <td colspan="5">No hay Datos a Mostrar</td>
                            </tr>
                        <?php	
                            }else{
                            
                             for($i=0; $i<count($lista2); $i++){
                             
                                if($i % 2){
                             
                                    echo "<tr class='odd'>";
                                }else{
                                    echo "<tr>";
                                }
                        ?>
                            
                                <td><?php echo $lista2[$i]['numero']  ?></td>
                                <td class="si"><?php echo $lista2[$i]['fecha_rad']  ?></td>
                                <td class="si"><?php echo number_format($lista2[$i]['valor'], 2, ",", ".")  ?></td>
                                <td class="si"><?php echo number_format($lista2[$i]['saldo'], 2, ",", ".")  ?></td>
				
				
                                <td class="si">
				    <?php
					    if($lista2[$i]['estado']=='C')
						echo"Cancelado";
					    else
						echo"Pendiente";
				
				
				
				
				    ?>
				</td>
                                
				
                            </tr>	
                            <?php 
                            }
                            
                            }
                            
                            ?>
                              
                            </tbody>
			    
                        </table>
                       
			
			</div>	
				
                    </td>
                </tr>
				
                <tr>
                	<td style="border:0px" >	
                    </td>
                </tr>
				
                <tr>
                	<td style="border:0px" >
                    	<div>
                        <table id="embargos" width="100%" class="tablesorter">
                          <caption style="font-weight:bold; text-align: left"><h3>EMBARGOS</h3></caption>
                          <thead>
                            <tr class="odd">
                                <th width="25%" scope="col">N&uacute;mero</th>
                                <th width="25%" scope="col">Fecha Final</th>
                                <th width="30%" scope="col">Valor</th>	
                                <th width="30%" scope="col">Saldo</th>
                             </tr>	
                           </thead>
                          
                            <tbody>
                        <?php
                            $var="odd";
                            
                            if($lista3==NULL){
                        ?>
                                <tr>
                                    <td colspan="5">No hay Datos a Mostrar</td>
                                </tr>
                        <?php	
                            }else{	
                            
                                for($i=0; $i<count($lista3); $i++){
                             
                                    if($i % 2){
                             
                                            echo "<tr class='odd'>";
                                    }else{
                                            echo "<tr>";
                                    }
                        ?>
                            
                                <td ><?php echo $lista3[$i]['numero'] ?></td>
                                <td><?php echo $lista3[$i]['fecha_fin'] ?></td>
                                <td><?php echo  number_format($lista3[$i]['valor'], 2, ",", ".") ?></td>
                                <td><?php echo  @$lista3[$i]['saldo'];?></td>
                                
                            </tr>	
                            <?php
                             }
                             }
                             ?>
                               
                            </tbody>
                        </table>
						</div>
                    </td>
                </tr>
            </table>
            
            <table id="infoEstadisticas" border="0" style="border:0px" >  
            	<tr >
                	<td style="border:0px" ><h2>INFORMACI&Oacute;N ESTAD&Iacute;STICA</h2></td>
                </tr>
                <tr>
                	<td style="border:0px" ><!-- TABLA NOMINA POR MES -->


                		<?php  if($validar_nomina_epl=="MENSUAL"){
                			include("nomina_mensual.php");
                		}elseif ($validar_nomina_epl=="QUINCENAL") {
                			include("nomina_quincenal.php");
                		}elseif ($validar_nomina_epl=="SEMANAL") {
                			include("nomina_semanal.php");
                		}?>
                   
                                      
                    </td>
                </tr>
                <tr>
                	<td style="border:0px" > <!-- TABLA AUSENCIAS POR MES -->

                    	<table width="100%">
                    	<caption style="font-weight:bold; text-align: left"><h3>AUSENCIAS POR MES AÑO ACTUAL</h3></caption>

                        
                          <thead>
                            <tr class="odd">
                                <th width="50%" scope="col">MES</th>
                                <th width="50%" scope="col">D&Iacute;AS</th>
                                
                            </tr>	
                           </thead>
					
   
			
                           <?php $anio=date("Y"); ?>

                            <tbody>
                            <tr >
                                <td><a id="enero" style="color: #D42945">Enero</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){  if(@$lista15[$j]['fecha']=='01-01-'.$anio or @$lista15[$j]['fecha']=='02-01-'.$anio or @$lista15[$j]['fecha']=='03-01-'.$anio or @$lista15[$j]['fecha']=='04-01-'.$anio or @$lista15[$j]['fecha']=='05-01-'.$anio or @$lista15[$j]['fecha']=='06-01-'.$anio or @$lista15[$j]['fecha']=='07-01-'.$anio or @$lista15[$j]['fecha']=='08-01-'.$anio or @$lista15[$j]['fecha']=='09-01-'.$anio or @$lista15[$j]['fecha']=='10-01-'.$anio or @$lista15[$j]['fecha']=='11-01-'.$anio or @$lista15[$j]['fecha']=='12-01-'.$anio or @$lista15[$j]['fecha']=='13-01-'.$anio or @$lista15[$j]['fecha']=='14-01-'.$anio or @$lista15[$j]['fecha']=='15-01-'.$anio or @$lista15[$j]['fecha']=='16-01-'.$anio or @$lista15[$j]['fecha']=='17-01-'.$anio or @$lista15[$j]['fecha']=='18-01-'.$anio or @$lista15[$j]['fecha']=='19-01-'.$anio or @$lista15[$j]['fecha']=='20-01-'.$anio or @$lista15[$j]['fecha']=='21-01-'.$anio or @$lista15[$j]['fecha']=='22-01-'.$anio or @$lista15[$j]['fecha']=='23-01-'.$anio or @$lista15[$j]['fecha']=='24-01-'.$anio or @$lista15[$j]['fecha']=='25-01-'.$anio or @$lista15[$j]['fecha']=='26-01-'.$anio or @$lista15[$j]['fecha']=='27-01-'.$anio or @$lista15[$j]['fecha']=='28-01-'.$anio or @$lista15[$j]['fecha']=='29-01-'.$anio or @$lista15[$j]['fecha']=='30-01-'.$anio or @$lista15[$j]['fecha']=='31-01-'.$anio ){  @$a=@$a+$lista15[$j]['dias']; }}if(@$a==NULL){echo "0"; }else{echo @$a;} ?></td>
                            </tr>
                            <tr class='odd'>
                                <td><a id="febrero" style="color: #D42945">Febrero</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){   if(@$lista15[$j]['fecha']=='01-02-'.$anio or @$lista15[$j]['fecha']=='02-02-'.$anio or @$lista15[$j]['fecha']=='03-02-'.$anio or @$lista15[$j]['fecha']=='04-02-'.$anio or @$lista15[$j]['fecha']=='05-02-'.$anio or @$lista15[$j]['fecha']=='06-02-'.$anio or @$lista15[$j]['fecha']=='07-02-'.$anio or @$lista15[$j]['fecha']=='08-02-'.$anio or @$lista15[$j]['fecha']=='09-02-'.$anio or @$lista15[$j]['fecha']=='10-02-'.$anio or @$lista15[$j]['fecha']=='11-02-'.$anio or @$lista15[$j]['fecha']=='12-02-'.$anio or @$lista15[$j]['fecha']=='13-02-'.$anio or @$lista15[$j]['fecha']=='14-02-'.$anio or @$lista15[$j]['fecha']=='15-02-'.$anio or @$lista15[$j]['fecha']=='16-02-'.$anio or @$lista15[$j]['fecha']=='17-02-'.$anio or @$lista15[$j]['fecha']=='18-02-'.$anio or @$lista15[$j]['fecha']=='19-02-'.$anio or @$lista15[$j]['fecha']=='20-02-'.$anio or @$lista15[$j]['fecha']=='21-02-'.$anio or @$lista15[$j]['fecha']=='22-02-'.$anio or @$lista15[$j]['fecha']=='23-02-'.$anio or @$lista15[$j]['fecha']=='24-02-'.$anio or @$lista15[$j]['fecha']=='25-02-'.$anio or @$lista15[$j]['fecha']=='26-02-'.$anio or @$lista15[$j]['fecha']=='27-02-'.$anio or @$lista15[$j]['fecha']=='28-02-'.$anio or @$lista15[$j]['fecha']=='29-02-'.$anio or @$lista15[$j]['fecha']=='30-02-'.$anio or @$lista15[$j]['fecha']=='31-02-'.$anio ){ @$b=@$b+$lista15[$j]['dias']; }}if(@$b==NULL){echo "0"; }else{echo @$b;} ?></td>
                            </tr>
                            <tr>
                                <td><a id="marzo" style="color: #D42945">Marzo</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='01-03-'.$anio or @$lista15[$j]['fecha']=='02-03-'.$anio or @$lista15[$j]['fecha']=='03-03-'.$anio or @$lista15[$j]['fecha']=='04-03-'.$anio or @$lista15[$j]['fecha']=='05-03-'.$anio or @$lista15[$j]['fecha']=='06-03-'.$anio or @$lista15[$j]['fecha']=='07-03-'.$anio or @$lista15[$j]['fecha']=='08-03-'.$anio or @$lista15[$j]['fecha']=='09-03-'.$anio or @$lista15[$j]['fecha']=='10-03-'.$anio or @$lista15[$j]['fecha']=='11-03-'.$anio or @$lista15[$j]['fecha']=='12-03-'.$anio or @$lista15[$j]['fecha']=='13-03-'.$anio or @$lista15[$j]['fecha']=='14-03-'.$anio or @$lista15[$j]['fecha']=='15-03-'.$anio or @$lista15[$j]['fecha']=='16-03-'.$anio or @$lista15[$j]['fecha']=='17-03-'.$anio or @$lista15[$j]['fecha']=='18-03-'.$anio or @$lista15[$j]['fecha']=='19-03-'.$anio or @$lista15[$j]['fecha']=='20-03-'.$anio or @$lista15[$j]['fecha']=='21-03-'.$anio or @$lista15[$j]['fecha']=='22-03-'.$anio or @$lista15[$j]['fecha']=='23-03-'.$anio or @$lista15[$j]['fecha']=='24-03-'.$anio or @$lista15[$j]['fecha']=='25-03-'.$anio or @$lista15[$j]['fecha']=='26-03-'.$anio or @$lista15[$j]['fecha']=='27-03-'.$anio or @$lista15[$j]['fecha']=='28-03-'.$anio or @$lista15[$j]['fecha']=='29-03-'.$anio or @$lista15[$j]['fecha']=='30-03-'.$anio or @$lista15[$j]['fecha']=='31-03-'.$anio ){ @$c=@$c+$lista15[$j]['dias']; }}if(@$c==NULL){echo "0"; }else{echo @$c;} ?></td>
                            </tr>
                            <tr class='odd'>
                                <td><a id="abril" style="color: #D42945">Abril</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='01-04-'.$anio or @$lista15[$j]['fecha']=='02-04-'.$anio or @$lista15[$j]['fecha']=='03-04-'.$anio or @$lista15[$j]['fecha']=='04-04-'.$anio or @$lista15[$j]['fecha']=='05-04-'.$anio or @$lista15[$j]['fecha']=='06-04-'.$anio or @$lista15[$j]['fecha']=='07-04-'.$anio or @$lista15[$j]['fecha']=='08-04-'.$anio or @$lista15[$j]['fecha']=='09-04-'.$anio or @$lista15[$j]['fecha']=='10-04-'.$anio or @$lista15[$j]['fecha']=='11-04-'.$anio or @$lista15[$j]['fecha']=='12-04-'.$anio or @$lista15[$j]['fecha']=='13-04-'.$anio or @$lista15[$j]['fecha']=='14-04-'.$anio or @$lista15[$j]['fecha']=='15-04-'.$anio or @$lista15[$j]['fecha']=='16-04-'.$anio or @$lista15[$j]['fecha']=='17-04-'.$anio or @$lista15[$j]['fecha']=='18-04-'.$anio or @$lista15[$j]['fecha']=='19-04-'.$anio or @$lista15[$j]['fecha']=='20-04-'.$anio or @$lista15[$j]['fecha']=='21-04-'.$anio or @$lista15[$j]['fecha']=='22-04-'.$anio or @$lista15[$j]['fecha']=='23-04-'.$anio or @$lista15[$j]['fecha']=='24-04-'.$anio or @$lista15[$j]['fecha']=='25-04-'.$anio or @$lista15[$j]['fecha']=='26-04-'.$anio or @$lista15[$j]['fecha']=='27-04-'.$anio or @$lista15[$j]['fecha']=='28-04-'.$anio or @$lista15[$j]['fecha']=='29-04-'.$anio or @$lista15[$j]['fecha']=='30-04-'.$anio or @$lista15[$j]['fecha']=='31-04-'.$anio ){ @$d=@$d+$lista15[$j]['dias']; }}if(@$d==NULL){echo "0"; }else{echo @$d;} ?></td>
                            </tr>
                            <tr>
                                <td><a id="mayo" style="color: #D42945">Mayo</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='01-05-'.$anio or @$lista15[$j]['fecha']=='02-05-'.$anio or @$lista15[$j]['fecha']=='03-05-'.$anio or @$lista15[$j]['fecha']=='04-05-'.$anio or @$lista15[$j]['fecha']=='05-05-'.$anio or @$lista15[$j]['fecha']=='06-05-'.$anio or @$lista15[$j]['fecha']=='07-05-'.$anio or @$lista15[$j]['fecha']=='08-05-'.$anio or @$lista15[$j]['fecha']=='09-05-'.$anio or @$lista15[$j]['fecha']=='10-05-'.$anio or @$lista15[$j]['fecha']=='11-05-'.$anio or @$lista15[$j]['fecha']=='12-05-'.$anio or @$lista15[$j]['fecha']=='13-05-'.$anio or @$lista15[$j]['fecha']=='14-05-'.$anio or @$lista15[$j]['fecha']=='15-05-'.$anio or @$lista15[$j]['fecha']=='16-05-'.$anio or @$lista15[$j]['fecha']=='17-05-'.$anio or @$lista15[$j]['fecha']=='18-05-'.$anio or @$lista15[$j]['fecha']=='19-05-'.$anio or @$lista15[$j]['fecha']=='20-05-'.$anio or @$lista15[$j]['fecha']=='21-05-'.$anio or @$lista15[$j]['fecha']=='22-05-'.$anio or @$lista15[$j]['fecha']=='23-05-'.$anio or @$lista15[$j]['fecha']=='24-05-'.$anio or @$lista15[$j]['fecha']=='25-05-'.$anio or @$lista15[$j]['fecha']=='26-05-'.$anio or @$lista15[$j]['fecha']=='27-05-'.$anio or @$lista15[$j]['fecha']=='28-05-'.$anio or @$lista15[$j]['fecha']=='29-05-'.$anio or @$lista15[$j]['fecha']=='30-05-'.$anio or @$lista15[$j]['fecha']=='31-05-'.$anio ){ @$e=@$e+$lista15[$j]['dias']; }}if(@$e==NULL){echo "0"; }else{echo @$e;} ?></td>
                            </tr>
                            <tr class='odd'>
                                <td><a id="junio" style="color: #D42945">Junio</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='01-06-'.$anio or @$lista15[$j]['fecha']=='02-06-'.$anio or @$lista15[$j]['fecha']=='03-06-'.$anio or @$lista15[$j]['fecha']=='04-06-'.$anio or @$lista15[$j]['fecha']=='05-06-'.$anio or @$lista15[$j]['fecha']=='06-06-'.$anio or @$lista15[$j]['fecha']=='07-06-'.$anio or @$lista15[$j]['fecha']=='08-06-'.$anio or @$lista15[$j]['fecha']=='09-06-'.$anio or @$lista15[$j]['fecha']=='10-06-'.$anio or @$lista15[$j]['fecha']=='11-06-'.$anio or @$lista15[$j]['fecha']=='12-06-'.$anio or @$lista15[$j]['fecha']=='13-06-'.$anio or @$lista15[$j]['fecha']=='14-06-'.$anio or @$lista15[$j]['fecha']=='15-06-'.$anio or @$lista15[$j]['fecha']=='16-06-'.$anio or @$lista15[$j]['fecha']=='17-06-'.$anio or @$lista15[$j]['fecha']=='18-06-'.$anio or @$lista15[$j]['fecha']=='19-06-'.$anio or @$lista15[$j]['fecha']=='20-06-'.$anio or @$lista15[$j]['fecha']=='21-06-'.$anio or @$lista15[$j]['fecha']=='22-06-'.$anio or @$lista15[$j]['fecha']=='23-06-'.$anio or @$lista15[$j]['fecha']=='24-06-'.$anio or @$lista15[$j]['fecha']=='25-06-'.$anio or @$lista15[$j]['fecha']=='26-06-'.$anio or @$lista15[$j]['fecha']=='27-06-'.$anio or @$lista15[$j]['fecha']=='28-06-'.$anio or @$lista15[$j]['fecha']=='29-06-'.$anio or @$lista15[$j]['fecha']=='30-06-'.$anio or @$lista15[$j]['fecha']=='31-06-'.$anio ){ @$f=@$f+$lista15[$j]['dias']; }}if(@$f==NULL){echo "0"; }else{echo @$f;} ?></td>
                            </tr>
                            <tr>
                                <td><a id="julio" style="color: #D42945">Julio</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='01-07-'.$anio or @$lista15[$j]['fecha']=='02-07-'.$anio or @$lista15[$j]['fecha']=='03-07-'.$anio or @$lista15[$j]['fecha']=='04-07-'.$anio or @$lista15[$j]['fecha']=='05-07-'.$anio or @$lista15[$j]['fecha']=='06-07-'.$anio or @$lista15[$j]['fecha']=='07-07-'.$anio or @$lista15[$j]['fecha']=='08-07-'.$anio or @$lista15[$j]['fecha']=='09-07-'.$anio or @$lista15[$j]['fecha']=='10-07-'.$anio or @$lista15[$j]['fecha']=='11-07-'.$anio or @$lista15[$j]['fecha']=='12-07-'.$anio or @$lista15[$j]['fecha']=='13-07-'.$anio or @$lista15[$j]['fecha']=='14-07-'.$anio or @$lista15[$j]['fecha']=='15-07-'.$anio or @$lista15[$j]['fecha']=='16-07-'.$anio or @$lista15[$j]['fecha']=='17-07-'.$anio or @$lista15[$j]['fecha']=='18-07-'.$anio or @$lista15[$j]['fecha']=='19-07-'.$anio or @$lista15[$j]['fecha']=='20-07-'.$anio or @$lista15[$j]['fecha']=='21-07-'.$anio or @$lista15[$j]['fecha']=='22-07-'.$anio or @$lista15[$j]['fecha']=='23-07-'.$anio or @$lista15[$j]['fecha']=='24-07-'.$anio or @$lista15[$j]['fecha']=='25-07-'.$anio or @$lista15[$j]['fecha']=='26-07-'.$anio or @$lista15[$j]['fecha']=='27-07-'.$anio or @$lista15[$j]['fecha']=='28-07-'.$anio or @$lista15[$j]['fecha']=='29-07-'.$anio or @$lista15[$j]['fecha']=='30-07-'.$anio or @$lista15[$j]['fecha']=='31-07-'.$anio ){ @$g=@$g+$lista15[$j]['dias']; }}if(@$g==NULL){echo "0"; }else{echo @$g;} ?></td>
                            </tr>
                            <tr class='odd'>
                                <td><a id="agosto" style="color: #D42945">Agosto</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='01-08-'.$anio or @$lista15[$j]['fecha']=='02-08-'.$anio or @$lista15[$j]['fecha']=='03-08-'.$anio or @$lista15[$j]['fecha']=='04-08-'.$anio or @$lista15[$j]['fecha']=='05-08-'.$anio or @$lista15[$j]['fecha']=='06-08-'.$anio or @$lista15[$j]['fecha']=='07-08-'.$anio or @$lista15[$j]['fecha']=='08-08-'.$anio or @$lista15[$j]['fecha']=='09-08-'.$anio or @$lista15[$j]['fecha']=='10-08-'.$anio or @$lista15[$j]['fecha']=='11-08-'.$anio or @$lista15[$j]['fecha']=='12-08-'.$anio or @$lista15[$j]['fecha']=='13-08-'.$anio or @$lista15[$j]['fecha']=='14-08-'.$anio or @$lista15[$j]['fecha']=='15-08-'.$anio or @$lista15[$j]['fecha']=='16-08-'.$anio or @$lista15[$j]['fecha']=='17-08-'.$anio or @$lista15[$j]['fecha']=='18-08-'.$anio or @$lista15[$j]['fecha']=='19-08-'.$anio or @$lista15[$j]['fecha']=='20-08-'.$anio or @$lista15[$j]['fecha']=='21-08-'.$anio or @$lista15[$j]['fecha']=='22-08-'.$anio or @$lista15[$j]['fecha']=='23-08-'.$anio or @$lista15[$j]['fecha']=='24-08-'.$anio or @$lista15[$j]['fecha']=='25-08-'.$anio or @$lista15[$j]['fecha']=='26-08-'.$anio or @$lista15[$j]['fecha']=='27-08-'.$anio or @$lista15[$j]['fecha']=='28-08-'.$anio or @$lista15[$j]['fecha']=='29-08-'.$anio or @$lista15[$j]['fecha']=='30-08-'.$anio or @$lista15[$j]['fecha']=='31-08-'.$anio ){ @$h=@$h+$lista15[$j]['dias']; }}if(@$h==NULL){echo "0"; }else{echo @$h;} ?></td>
                            </tr>
                            <tr>
                                <td><a id="septiembre" style="color: #D42945">Septiembre</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='01-09-'.$anio or @$lista15[$j]['fecha']=='02-09-'.$anio or @$lista15[$j]['fecha']=='03-09-'.$anio or @$lista15[$j]['fecha']=='04-09-'.$anio or @$lista15[$j]['fecha']=='05-09-'.$anio or @$lista15[$j]['fecha']=='06-09-'.$anio or @$lista15[$j]['fecha']=='07-09-'.$anio or @$lista15[$j]['fecha']=='08-09-'.$anio or @$lista15[$j]['fecha']=='09-09-'.$anio or @$lista15[$j]['fecha']=='10-09-'.$anio or @$lista15[$j]['fecha']=='11-09-'.$anio or @$lista15[$j]['fecha']=='12-09-'.$anio or @$lista15[$j]['fecha']=='13-09-'.$anio or @$lista15[$j]['fecha']=='14-09-'.$anio or @$lista15[$j]['fecha']=='15-09-'.$anio or @$lista15[$j]['fecha']=='16-09-'.$anio or @$lista15[$j]['fecha']=='17-09-'.$anio or @$lista15[$j]['fecha']=='18-09-'.$anio or @$lista15[$j]['fecha']=='19-09-'.$anio or @$lista15[$j]['fecha']=='20-09-'.$anio or @$lista15[$j]['fecha']=='21-09-'.$anio or @$lista15[$j]['fecha']=='22-09-'.$anio or @$lista15[$j]['fecha']=='23-09-'.$anio or @$lista15[$j]['fecha']=='24-09-'.$anio or @$lista15[$j]['fecha']=='25-09-'.$anio or @$lista15[$j]['fecha']=='26-09-'.$anio or @$lista15[$j]['fecha']=='27-09-'.$anio or @$lista15[$j]['fecha']=='28-09-'.$anio or @$lista15[$j]['fecha']=='29-09-'.$anio or @$lista15[$j]['fecha']=='30-09-'.$anio or @$lista15[$j]['fecha']=='31-09-'.$anio ){ @$k=@$k+$lista15[$j]['dias']; }}if(@$k==NULL){echo "0"; }else{echo @$k;} ?></td>
                            </tr>
                            <tr class='odd'>
                                <td><a id="octubre" style="color: #D42945">Octubre</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='01-10-'.$anio or @$lista15[$j]['fecha']=='02-10-'.$anio or @$lista15[$j]['fecha']=='03-10-'.$anio or @$lista15[$j]['fecha']=='04-10-'.$anio or @$lista15[$j]['fecha']=='05-10-'.$anio or @$lista15[$j]['fecha']=='06-10-'.$anio or @$lista15[$j]['fecha']=='07-10-'.$anio or @$lista15[$j]['fecha']=='08-10-'.$anio or @$lista15[$j]['fecha']=='09-10-'.$anio or @$lista15[$j]['fecha']=='10-10-'.$anio or @$lista15[$j]['fecha']=='11-10-'.$anio or @$lista15[$j]['fecha']=='12-10-'.$anio or @$lista15[$j]['fecha']=='13-10-'.$anio or @$lista15[$j]['fecha']=='14-10-'.$anio or @$lista15[$j]['fecha']=='15-10-'.$anio or @$lista15[$j]['fecha']=='16-10-'.$anio or @$lista15[$j]['fecha']=='17-10-'.$anio or @$lista15[$j]['fecha']=='18-10-'.$anio or @$lista15[$j]['fecha']=='19-10-'.$anio or @$lista15[$j]['fecha']=='20-10-'.$anio or @$lista15[$j]['fecha']=='21-10-'.$anio or @$lista15[$j]['fecha']=='22-10-'.$anio or @$lista15[$j]['fecha']=='23-10-'.$anio or @$lista15[$j]['fecha']=='24-10-'.$anio or @$lista15[$j]['fecha']=='25-10-'.$anio or @$lista15[$j]['fecha']=='26-10-'.$anio or @$lista15[$j]['fecha']=='27-10-'.$anio or @$lista15[$j]['fecha']=='28-10-'.$anio or @$lista15[$j]['fecha']=='29-10-'.$anio or @$lista15[$j]['fecha']=='30-10-'.$anio or @$lista15[$j]['fecha']=='31-10-'.$anio ){ @$m=@$m+$lista15[$j]['dias']; }}if(@$m==NULL){echo "0"; }else{echo @$m;} ?></td>
                            </tr>
                            <tr>
                                <td><a id="noviembre" style="color: #D42945">Noviembre</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='01-11-'.$anio or @$lista15[$j]['fecha']=='02-11-'.$anio or @$lista15[$j]['fecha']=='03-11-'.$anio or @$lista15[$j]['fecha']=='04-11-'.$anio or @$lista15[$j]['fecha']=='05-11-'.$anio or @$lista15[$j]['fecha']=='06-11-'.$anio or @$lista15[$j]['fecha']=='07-11-'.$anio or @$lista15[$j]['fecha']=='08-11-'.$anio or @$lista15[$j]['fecha']=='09-11-'.$anio or @$lista15[$j]['fecha']=='10-11-'.$anio or @$lista15[$j]['fecha']=='11-11-'.$anio or @$lista15[$j]['fecha']=='12-11-'.$anio or @$lista15[$j]['fecha']=='13-11-'.$anio or @$lista15[$j]['fecha']=='14-11-'.$anio or @$lista15[$j]['fecha']=='15-11-'.$anio or @$lista15[$j]['fecha']=='16-11-'.$anio or @$lista15[$j]['fecha']=='17-11-'.$anio or @$lista15[$j]['fecha']=='18-11-'.$anio or @$lista15[$j]['fecha']=='19-11-'.$anio or @$lista15[$j]['fecha']=='20-11-'.$anio or @$lista15[$j]['fecha']=='21-11-'.$anio or @$lista15[$j]['fecha']=='22-11-'.$anio or @$lista15[$j]['fecha']=='23-11-'.$anio or @$lista15[$j]['fecha']=='24-11-'.$anio or @$lista15[$j]['fecha']=='25-11-'.$anio or @$lista15[$j]['fecha']=='26-11-'.$anio or @$lista15[$j]['fecha']=='27-11-'.$anio or @$lista15[$j]['fecha']=='28-11-'.$anio or @$lista15[$j]['fecha']=='29-11-'.$anio or @$lista15[$j]['fecha']=='30-11-'.$anio or @$lista15[$j]['fecha']=='31-11-'.$anio ){ @$n=@$n+$lista15[$j]['dias'];}}if(@$n==NULL){echo "0"; }else{ echo @$n;} ?></td>
                            </tr>
                            <tr class='odd'>
                                <td><a id="diciembre" style="color: #D42945">Diciembre</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='01-12-'.$anio or @$lista15[$j]['fecha']=='02-12-'.$anio or @$lista15[$j]['fecha']=='03-12-'.$anio or @$lista15[$j]['fecha']=='04-12-'.$anio or @$lista15[$j]['fecha']=='05-12-'.$anio or @$lista15[$j]['fecha']=='06-12-'.$anio or @$lista15[$j]['fecha']=='07-12-'.$anio or @$lista15[$j]['fecha']=='08-12-'.$anio or @$lista15[$j]['fecha']=='09-12-'.$anio or @$lista15[$j]['fecha']=='10-12-'.$anio or @$lista15[$j]['fecha']=='11-12-'.$anio or @$lista15[$j]['fecha']=='12-12-'.$anio or @$lista15[$j]['fecha']=='13-12-'.$anio or @$lista15[$j]['fecha']=='14-12-'.$anio or @$lista15[$j]['fecha']=='15-12-'.$anio or @$lista15[$j]['fecha']=='16-12-'.$anio or @$lista15[$j]['fecha']=='17-12-'.$anio or @$lista15[$j]['fecha']=='18-12-'.$anio or @$lista15[$j]['fecha']=='19-12-'.$anio or @$lista15[$j]['fecha']=='20-12-'.$anio or @$lista15[$j]['fecha']=='21-12-'.$anio or @$lista15[$j]['fecha']=='22-12-'.$anio or @$lista15[$j]['fecha']=='23-12-'.$anio or @$lista15[$j]['fecha']=='24-12-'.$anio or @$lista15[$j]['fecha']=='25-12-'.$anio or @$lista15[$j]['fecha']=='26-12-'.$anio or @$lista15[$j]['fecha']=='27-12-'.$anio or @$lista15[$j]['fecha']=='28-12-'.$anio or @$lista15[$j]['fecha']=='29-12-'.$anio or @$lista15[$j]['fecha']=='30-12-'.$anio or @$lista15[$j]['fecha']=='31-12-'.$anio ){ @$p=@$p+$lista15[$j]['dias']; }}if(@$p==NULL){echo "0"; }else{echo @$p;} ?></td>
                            </tr>
                                                    
                            </tbody>
                        </table>
                                     
                   </td>
                </tr>
            </table>
        </td>
	</tr>
</table>

</body>
</html>
