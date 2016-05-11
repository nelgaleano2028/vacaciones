<?php
@session_start();


if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}
//require_once('../lib/configdb.php');
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');


$codiepl = $_SESSION['ced'];

   //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
}
//------------------------------FIN antidoto



//global $conn;

$codigo=$_SESSION['cod'];
$estado='P';
$hoy = date("m/d/Y");

/*
$qry1="select * from parametros_nue where NOM_VAR='param_vacas_cod_con'";

$rh1 = $conn->Execute($qry1);
$row1 = $rh1->FetchRow();

@$cod_con=@$row1["DESCRIPCION"];*/

@$cod_con='1017';




/*$qry2="select * from parametros_nue where NOM_VAR='param_vacas_cod_aus'";

$rh2 = $conn->Execute($qry2);
$row2 = $rh2->FetchRow();

@$cod_aus=@$row2["DESCRIPCION"];*/

@$cod_aus='1';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="X-UA-Compatible" content="IE=9" />

<style>
body{
	font-size: 12px;
	font-family:Arial, Helvetica, sans-serif;
	 }

	table#padre{ width:60%;}
	
	table{ width:60%; }

   	#testTable { 
           
            margin-left: auto;
            
            margin-right: auto;
            
 
          }
          
         #tablePagination { 
            
	   background-color: #DCDCDC;             
            padding: 0px 5px;
            padding-top: 2px;
            height: 25px;
	    width: 58%;
	    margin: auto;
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
<style type="text/css">
@import url("../css/plantilla_user.css");
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
    </style>

<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
<link rel="stylesheet" type="text/css" href="../css/plantilla_user.css" />

<link href="../css/tcal.css" rel="stylesheet" type="text/css" />

 <script type="text/javascript" src="../js/tcal.js"></script> 

<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>


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
   <!-- FIN MODAL-->
	
   <!-- PAGINACION-->
	 <link rel="stylesheet" href="../js/__jquery.tablesorter/themes/blue/style.css" type="text/css"/>
	 <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.js" type="text/javascript"></script>
         <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.min.js" type="text/javascript"></script>
         <script src="../js/__jquery.tablesorter/jquery-latest.js" type="text/javascript"></script>
         <script src="../js/__jquery.tablesorter/jquery.tablesorter.js" type="text/javascript"></script>
   <!-- FIN PAGINACION-->
   
<script>
	/*paginacion id de la tabla*/
            $(document).ready(function() {
         
		  $('#vacaciones').tablePagination({});
			
			
            } );
			
            /*quita todo conflicto de jquery*/
              var $j = jQuery.noConflict();
			  
			  /*ordenamiento id de la tabla*/
         $j(document).ready(function(){
    
     
	  $('#vacaciones').tablePagination({});



	//$j("#compro_ultimo").tablesorter(); 
    } 
); 


        </script>


<script type="text/javascript" charset="utf-8">
		
	 $(document).ready(function() {
				  
	  	$("#calcular").click(function (){
			
			var dias = $("#dias").val();
			var fecha_ini = $("#fecha_ini").val();
			


		
		if(fecha_ini==""){
			$("#validacion").html("<p style='color:red; font-weight:bold'>El Campo DESDE se encuentra Vacio</p>");
		
		}else{
			
		
		$.ajax({
		  	url: "fecha_prueba.php",
		  	type : "POST",
			cache:false,
		  	data : "dias="+dias+"&fecha_ini="+fecha_ini,
		    	success: function(data){
			   
				 if(data=="1"){
				   alert("No puedes iniciar las vacaciones en este dia, debes iniciar en dia habil");
				   document.getElementById("fecha_fin").value="";
			  	 }else
				if(data=="2"){
				   alert("Debes elegir una fecha mayor a la actual");
				   document.getElementById("fecha_fin").value="";
			  	 }else
				if(data=="4"){
				   alert("Su fecha de solicitud se encuentra dentro de un rango solicitado anteriormente. Por favor verifique");
				   document.getElementById("fecha_fin").value="";
			  	 }else
				if(data=="5"){
				   alert("La cantidad de dias solicitados excede sus dias disponibles");
				   document.getElementById("fecha_fin").value="";
			  	 }else{
				   
			  	document.getElementById("fecha_fin").value=data;
			   	}
			   }	
		  
			}); 					

			}
	 	});	  
    
	    
	   function modal_iframe(url,title,e){
        
            e.preventDefault();
            var $this = $(this);
            var horizontalPadding = 20;
            var verticalPadding = 5;
            
            $('<iframe id="site" src="'+url+'" />').dialog({
            
                title: ($this.attr('title')) ? $this.attr('title') : '<H3>'+title+'</H3>',
                autoOpen: true,
                width: 800,
                height: 380,
                modal: true,
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
   
	 $('#editar').click( function(e) {
	
      	modal_iframe("edicion.php","Editar Solicitudes",e);
		
	} );
	
});

function validar(){



if(document.formulario.fecha_ini.value=="" || document.formulario.fecha_fin.value==""){	
	alert("Existen Campos Vacios");
	return false;

}else{
	confirmado = confirm("¿Esta solicitud será enviada a tu líder <?php echo @$_SESSION['jef']?> <?php echo @$_SESSION['apejef'];?>, (si tu líder no coincide coloca un ticket en el portal de servicios compartidos según link indicado en la parte inferior), está seguro de las fechas seleccionadas?"); 
	if (confirmado) {
// si pulsamos en aceptar
document.formulario.btn.disabled=true;//Evita que el usuario lo ejecute mientras se envia la solicitud.
	return true;
	}else {
// si pulsamos en cancelar
return false;
alert('Verifica de nuevo tus datos'); 
}  

	
}

}

</script>
</head>


<body>
<?php

$qry1="select * from ausencias_tmp where cod_con='".$cod_con."' and cod_aus='".$cod_aus."' and estado in ('P','R','C') and cod_epl='".$codigo."'";

$res= $conn->Execute($qry1); 

if($res){
	
	while($row = $res->FetchRow()){

		$lista1[] =  array("fecha_ini"=>date("d-m-Y",strtotime($row["FEC_INI"])),
		                   "fehca_fin"=>date("d-m-Y",strtotime($row["FEC_FIN"])),
				   "dias"=>@$row["DIAS"],
				   "estado"=>@$row["ESTADO"],
				    "consecutivo"=>@$row["CNSCTVO"],
					"fecha_solicitud"=>date("d-m-Y",strtotime($row["FEC_SOLICITUD"]))
				   );				
	}
}else {
	$lista1 = NULL;
      }	
		
			
$qry5="SELECT FEC_INI_PER AS FEC_INI_PERIODO, FEC_FIN_PER AS FEC_FIN_PERIODO, DIAS AS DIAS_PENDIENTE , 'PENDIENTE' AS PENDIENTE 
FROM VACACIONES_PENDIENTES WHERE COD_EPL ='$codigo'
ORDER BY FEC_INI_PER";

$res5= $conn->Execute($qry5); 

if($res5){
	
	while($row5 = $res5->FetchRow()){

			$sumatotaldias += $row5["DIAS_PENDIENTE"];
			
		 $lista5[] =  array("FEC_INI_PERIODO"=>date("d-m-Y",strtotime($row5["FEC_INI_PERIODO"])),
		                   "FEC_FIN_PERIODO"=>date("d-m-Y",strtotime($row5["FEC_FIN_PERIODO"])),
				   "DIAS_PENDIENTE"=>@$row5["DIAS_PENDIENTE"],
				   "'PENDIENTE'"=>@$row5["'PENDIENTE'"]
				   );				
	}
}else {
	$lista5 = NULL;
      }

//////////////////////////////////////////////QUERY PARA VALOR A RESTAR EN DIAS DISPONIBLES

$qry21="SELECT SUM(DIAS) AS VALORDEF FROM AUSENCIAS_TMP WHERE COD_EPL ='$codigo' AND FEC_INI
> (SELECT MAX(FEC_FIN_PER) FROM VACACIONES_PENDIENTES WHERE COD_EPL ='$codigo')
AND ESTADO IN ( 'C')";

			  
$rh21 = $conn->Execute($qry21); 

$row21 = $rh21->FetchRow();


$VALORDEF=$row21["VALORDEF"];

$sumarestavalor = $sumatotaldias-$VALORDEF;	  
	  
?>
<br><br>
<center>
<h2>HISTORIAL DE SOLICITUDES DE VACACIONES</h2></center><br>
<table width="70%" id="vacaciones" class="tablesorter">

  <thead>
		<tr class="odd">
   		 <th width="2%" scope="col">Consecutivo</th>
   	    <th width="20%" scope="col">Fecha Solicitud</th>
		<th width="20%" scope="col">Fecha Inicio</th>
	  	<th width="20%" scope="col">Fecha Fin</th>
		<th width="2%" scope="col">D&iacute;as Hábiles</th>	
	  	<th width="30%" scope="col">Estado</th>
	  	
	</tr>	
	</thead>
  
	<tbody>
    <?php
    $conteo=0;
	
     if(@$lista1==null){
	echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</tr>";
     }else{
       
     $i=0;
     while($i<count(@$lista1)){
     
     if(@$i % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
	 
	 
      ?>
 	<td style="text-align:center"><?php echo $lista1[$i]["consecutivo"]; ?></td>
		<td style="text-align:center"><?php echo $lista1[$i]["fecha_solicitud"]; ?></td>
		<td style="text-align:center"><?php echo $lista1[$i]["fecha_ini"]; ?></td>
		<td style="text-align:center"><?php  echo $lista1[$i]["fehca_fin"]; ?></td>
		<td style="text-align:center"><?php  echo $lista1[$i]["dias"]; $conteo=$conteo+$lista1[$i]["dias"];?></td>
        <td style="text-align:center"><?php   IF($lista1[$i]["estado"] == 'P'){ echo 'Pendiente por aprobar jefe'; }ELSEIF($lista1[$i]["estado"] == 'R'){ echo 'Rechazado por jefe'; }ELSEIF($lista1[$i]["estado"] == 'C'){ echo 'Aprobado por jefe'; }?></td>
                    
			</tr><?php $i++; }}?>
 	
	</tbody>
</table>



<?php


$qry2="select cen.cod_cc2  from empleados_basic emp, cargos car, centrocosto2 cen where emp.cod_car=car.cod_car and emp.cod_cc2=cen.cod_cc2 and cod_epl='".$codigo."'";

			  
$rh0 = $conn->Execute($qry2); 

$row0 = $rh0->FetchRow();


$cod_cc2=$row0["COD_CC2"];


?>




<br />

<p>
   <!-- <label><strong class="tam_str">Cantidad de dias solicitados para Disfrutar: <?php echo $conteo; ?></strong></label></p> -->


<center>
<h2>VACACIONES EMPLEADO </h2></center><br>
<table width="60%" id="vacaciones" class="tablesorter">

  <thead>
	<tr class="odd">
		<th width="25%" scope="col">Fecha Inicio</th>
	  	<th width="25%" scope="col">Fecha Fin</th>
		<th width="25%" scope="col">D&iacute;as Hábiles</th>	
	  	<th width="25%" scope="col">Estado</th>
	  	
	</tr>	
	</thead>
  
	<tbody>
    <?php
    $conteo5=0;
	
     if(@$lista5==null){
	echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</tr>";
     }else{
       
     $i5=0;
     while($i5<count(@$lista5)){
     
     if(@$i5 % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
	 
	 
      ?>
		<td style="text-align:center"><?php echo $lista5[$i5]["FEC_INI_PERIODO"]; ?></td>
		<td style="text-align:center"><?php  echo $lista5[$i5]["FEC_FIN_PERIODO"]; ?></td>
		<td style="text-align:center"><?php  echo $lista5[$i5]["DIAS_PENDIENTE"]; $conteo5=$conteo5+$lista5[$i5]["dias"];?></td>
        <td style="text-align:center">Pendiente</td>
                    
			</tr><?php $i5++; }}?>
 	
	</tbody>
</table>



<?php


$qry2="select cen.cod_cc2  from empleados_basic emp, cargos car, centrocosto2 cen where emp.cod_car=car.cod_car and emp.cod_cc2=cen.cod_cc2 and cod_epl='".$codigo."'";

			  
$rh0 = $conn->Execute($qry2); 

$row0 = $rh0->FetchRow();


$cod_cc2=$row0["COD_CC2"];

?>




<br />

<p>
  <label><strong class="tam_str">Dias pendientes por disfrutar: <?php echo $sumatotaldias; ?></strong></label></p>


<fieldset style="width: 800px; margin:0 auto 0 auto; border-radius: 5px;"><legend><h2 >PROGRAME EL PERIODO A DISFRUTAR</h2></legend>

<br />
  
<form method="post" name="formulario" action="envio.php" id="formulario" onSubmit="return validar();">

<p><label><strong class="tam_str">D&iacute;as a Tomar:</strong></label> <select id="dias" name="dias" class="combo" onclick="fecha_fin.value=''"; style="width:80px;"><?php for($i=1; $i<$sumatotaldias+1; $i++){ ?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
               
              </select>    &nbsp;&nbsp;&nbsp;
              
            <label><strong class="tam_str">Desde:</strong></label><input type="text" class="tcal" name="fecha_ini" id="fecha_ini" readonly="readonly" onFocus="javascript:fecha_fin.value=''" style="background-color: white;"/>&nbsp;&nbsp;&nbsp;
	    <label><strong class="tam_str">Hasta: </strong></label><input type="text" name="fecha_fin" id="fecha_fin" readonly="readonly" style="background-color: white;"/> <a  id="calcular" style="color:blue; border:1px  solid #000; background-color:#CCC; cursor:pointer; padding: 1px">CALCULO</a> </p>
            
 <input type="hidden" name="codigo" value="<?php echo $codigo ?>" />
 <input type="hidden" name="estado" value="<?php echo $estado ?>" />
 
 <input type="hidden" name="cod_con" value="<?php echo $cod_con ?>" />
 <input type="hidden" name="cod_aus" value="<?php echo $cod_aus ?>" />
 <input type="hidden" name="cod_cc2" value="<?php echo $cod_cc2 ?>" />
 

<br />

<div id="validacion"></div>
<br />

<p><input type="submit" class="boton" id="btn" value="Enviar Solicitud" /></p>
<!--<input id="editar" class="boton" type="button" title="Edicion" value="Editar Solicitud"/></p>-->

</form>
</fieldset>

<br />



<?php
if(@$_GET['293875'] == "76"){ 
?> 
     <script> 
      alert("La solicitud fue enviada exitosamente");
     </script>  
<?php
}
?>

 <table width="100%" height="30" border="0">
<tr>
<td height="30">
</td>
</tr>
<tr>
          <td class="piepag">Cualquier inconveniente que tengas, crea tu tiquete a la Mesa Centro de Servicios Compartidos haciendo <a href="http://clienteinterno:9000/MesasAyuda/Categorias/113/Subcategorias/729/Productos/5122/Problemas/26165" style="color: #770003">clic aquí</a> y adjunta el pantallazo con el error.</td>
        </tr>
</table>
</body>
</html>