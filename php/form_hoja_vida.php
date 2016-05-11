<?php
include_once("class_empleado.php");

$empleado = new empleado();

$empleado->set_codigo($_GET["cod"]);//set de codigo del empleado se lo paso a la clase
$lista=$empleado->mostrar_hoja_vida_tmp();
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
			url: "ajax_respuesta_hoja_vida.php",
			data: $('#form_hoja').serialize(),
			    beforeSend: function(){
		      notify("Procesando....",500,80000,"info","info");
							
						},
			success: function(datos){
				//$("#formulario").html(datos);
				notify(datos,500,5000,"info","info");
				
				
                                
				//$("#fila-"+consecutivo).remove();
			}
		});
		return false;
            });
            
         $("#cancelar").click(function(event){
            $.ajax({
			type:"POST",
			url: "ajax_respuesta_hoja_vida.php",
			data: $('#form_hoja').serialize()+ "&" + "accion=cancelar",
			    beforeSend: function(){
		      notify("Procesando....",500,80000,"info","info");
							
						},
			success: function(datos){
				//$("#formulario").html(datos);
				notify(datos,500,5000,"info","info");
                                var url = $(this).attr('rel');
                                
				//$("#fila-"+consecutivo).remove();
			}
		});
		return false;
         });
            });
        </script>
	

<br /><br />
<form id="form_hoja" name="form_hoja">
<fieldset style="width: 480px; margin:0 auto 0 auto; border-radius: 5px;">
<legend> <h2>Datos modificados de Hoja de vida por el empleados</h2></legend> <br />
<div style="margin-left: 10px; line-height: 19px;">
<strong class="tam_str">Direccion: </strong><?php echo $lista[0]["dir"];?><input type="hidden" name="direccion" value="<?php echo $lista[0]["dir"];?>" /><br />
<strong class="tam_str">Barrio:</strong> <?php echo $lista[0]["barrio"];?><input type="hidden" name="barrio" value="<?php echo $lista[0]["cod_bar"];?>" /><br />
<strong class="tam_str">Direccion Alterna: </strong><?php echo $lista[0]["dir2"];?><input type="hidden" name="direccionalt" value="<?php echo $lista[0]["dir2"];?>" /><br />
<strong class="tam_str">Email: </strong><?php echo $lista[0]["email"];?><input type="hidden" name="email" value="<?php echo $lista[0]["email"];?>" /><br />
<strong class="tam_str">Numero de hijos:</strong> <?php echo $lista[0]["num_hijo"];?><input type="hidden" name="numerohijos" value="<?php echo $lista[0]["num_hijo"];?>" /><br />
<strong class="tam_str">Licencia de Conduccion: </strong><?php echo $lista[0]["lic_con"];?><input type="hidden" name="licencia" value="<?php echo $lista[0]["lic_con"];?>" /><br />
<strong class="tam_str">Telefono: </strong><?php echo $lista[0]["tel1"];?><input type="hidden" name="telefono" value="<?php echo $lista[0]["tel1"];?>" /><br />
<strong class="tam_str">Celular: </strong><?php echo $lista[0]["celular"];?><input type="hidden" name="celular" value="<?php echo $lista[0]["celular"];?>" /><br />
<strong class="tam_str">Telefono alterno: </strong><?php echo $lista[0]["tel2"];?><input type="hidden" name="telefonoalt" value="<?php echo $lista[0]["tel2"];?>" /><br />
<strong class="tam_str">Estado Civil: </strong><?php echo $lista[0]["estado"];?><input type="hidden" name="estadocivil" value="<?php echo $lista[0]["cod_civ"];?>" /><br />
<strong class="tam_str">Libreta Militar: </strong><?php echo $lista[0]["libreta"];?><input type="hidden" name="libreta" value="<?php echo $lista[0]["libreta"];?>" /><br />
<strong class="tam_str">Nivel de Estudio: </strong><?php echo $lista[0]["nom_nie"];?><input type="hidden" name="nivelest" value="<?php echo $lista[0]["cod_nie"];?>" /><br /><br />
<input type="hidden" name="empleado" value="<?php echo $lista[0]["codigo"];?>"/>
<input type="hidden" name="accion" value="aceptar"/>
</div>
<center>
<input type="button" id="aceptar" class="boton" name="aceptar" value="Aplicar Cambios"/>
<input type="button" class="boton" id="cancelar" name="cancelar" value="Rechazar Cambios"/>
</center>
</fieldset>
</form>