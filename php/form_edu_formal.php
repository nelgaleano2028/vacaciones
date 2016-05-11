<?php
include_once("class_empleado.php");

$empleado = new empleado();

$empleado->set_codigo($_GET["cod"]);//set de codigo del empleado se lo paso a la clase
$lista=$empleado->mostrar_formal_espe_jefe($_GET["tit"],$_GET["est"]);
?>
<style>
	 body{
		  font-size: 12px;
		  font-family:Arial, Helvetica, sans-serif;
	 }
</style>
  <link rel="stylesheet" type="text/css" href="../css/estilo.css" />
<link rel="stylesheet" type="text/css" href="../css/plantilla_user.css" />
<link href="../css/tcal.css" rel="stylesheet" type="text/css" />



<link type="text/css" href="../css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" type="text/css" href="../css/general.css" />
<link rel="stylesheet" type="text/css" href="../js/chosen/chosen.css"  />
 <link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/scroll.css"  />
 <link rel="stylesheet" href="../css/jquery.ui.all.css">
 

 

  <script src="../js/jquery-1.7.1.min.js"></script>
<script type='text/javascript' src='../js/jquery-ui-1.8.17.custom.min.js'></script>
        <script type='text/javascript' src='../js/funciones.js'></script>
	<script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
	<script src="../js/jquery.ui.core.js"></script>
	<script src="../js/jquery.ui.widget.js"></script>
        
        <script>
            
            $(document).ready(function(){ 
             
             $("#aceptar").click(function(event){
                $.ajax({
			type:"POST",
			url: "ajax_respuesta_formal.php",
			data: $('#form_hoja').serialize(),
			    beforeSend: function(){
		      notify("Procesando....",500,80000,"info","info");
							
						},
			success: function(datos){
				//$("#formulario").html(datos);
				//notify(datos,500,5000,"email","email");
				notify(datos,500,5000,"info","info");
                                
				//$("#fila-"+consecutivo).remove();
			}
		});
		return false;
            });
            
         $("#cancelar").click(function(event){
           
            $.ajax({
                type:"POST",
                url:"ajax_respuesta_formal.php",
                data: $('#form_hoja').serialize()+ "&" + "accion=cancelar",
                  beforeSend: function(){
		      notify("Procesando....",500,80000,"info","info");
							
						},
                success: function(datos){
				//$("#formulario").html(datos);
                                notify(datos,500,5000,"info","info");
				
			}
            });
	    
            return false;
         });
            });
        </script>
	

<br /><br />
<form id="form_hoja" name="form_hoja">
<fieldset style="width: 480px; margin:0 auto 0 auto; border-radius: 5px;">
<legend> <h2>Datos Familiares Modificados por el empleado</h2></legend> <br />
<div style="margin-left: 10px; line-height: 19px;">
<strong class="tam_str">Estudio: </strong><?php echo $lista[0]["nombre"];?><input type="hidden" name="estudios" value="<?php echo $lista[0]["estudio"];?>" /><br />
<strong class="tam_str">T&iacute;tulo:</strong> <?php echo $lista[0]["desc_ttp"];?><input type="hidden" name="titulo" value="<?php echo $lista[0]["cod_ttp"];?>" /><br />
<strong class="tam_str">Fecha Inicio: </strong><?php if($lista[0]["inicial"] != ""){echo date("d/m/Y", strtotime($lista[0]["inicial"]));}?><input type="hidden" name="fechaini" value="<?php echo $lista[0]["inicial"];?>" /><br />
<strong class="tam_str">Fecha Fin : </strong><?php if($lista[0]["final"]!= ""){echo date("d/m/Y", strtotime($lista[0]["final"]));}?><input type="hidden" name="fechafin" value="<?php echo $lista[0]["final"];?>" /><br />
<strong class="tam_str">Ciudad:</strong> <?php echo $lista[0]["ciudad"];?><input type="hidden" name="ciudad" value="<?php echo $lista[0]["cod_ciu"];?>" /><br />
<strong class="tam_str">Pa&iacute;s: </strong><?php echo $lista[0]["nom_pai"];?><input type="hidden" name="pais" value="<?php echo $lista[0]["cod_pai"];?>" /><br />
<strong class="tam_str">Entidad: </strong><?php echo $lista[0]["nom_enti"];?><input type="hidden" name="entidad" value="<?php echo $lista[0]["cod_enti"];?>" /><br />
<strong class="tam_str">Tiempo Unidad: </strong><?php echo $lista[0]["nom_uni"];?><input type="hidden" name="tiempouni" value="<?php echo $lista[0]["cod_uni"];?>" /><br />
<strong class="tam_str">Tiempo : </strong><?php echo $lista[0]["tiempo"];?><input type="hidden" name="tiempo" value="<?php echo $lista[0]["tiempo"];?>" /><br /><br />
<input type="hidden" name="empleado" value="<?php echo $_GET["cod"];?>"/>
<input type="hidden" name="accion" value="aceptar"/>
</div>
<center>
<input type="button" id="aceptar" class="boton" name="aceptar" value="Aplicar Cambios"/>
<input type="button" class="boton" id="cancelar" name="cancelar" value="Rechazar Cambios"/>
</center>
</fieldset>
</form>