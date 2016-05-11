<?php
include_once("class_empleado.php");

$empleado = new empleado();

$empleado->set_codigo($_GET["cod"]);//set de codigo del empleado se lo paso a la clase
$lista=$empleado->mostrar_familiar_tmp($_GET["ced"]);
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
			url: "ajax_respuesta_familia.php",
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
			url: "ajax_respuesta_familia.php",
			data: $('#form_hoja').serialize()+ "&" + "accion=cancelar",
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
            });
        </script>
	

<br /><br />
<form id="form_hoja" name="form_hoja">
<fieldset style="width: 480px; margin:0 auto 0 auto; border-radius: 5px;">
<legend> <h2>Datos Familiares Modificados por el empleado</h2></legend> <br />
<div style="margin-left: 10px; line-height: 19px;">
<strong class="tam_str">C&eacute;dula: </strong><?php echo $lista[0]["cedula"];?><input type="hidden" name="nudocumento" value="<?php echo $lista[0]["cedula"];?>" /><br />
<strong class="tam_str">Nombre:</strong> <?php echo $lista[0]["nombre"];?><input type="hidden" name="nombre" value="<?php echo $lista[0]["nombre"];?>" /><br />
<strong class="tam_str">Tipo de Documento: </strong><?php echo $lista[0]["tipo_doc"];?><input type="hidden" name="tidocumento" value="<?php echo $lista[0]["tipo_doc"];?>" /><br />

<strong class="tam_str">Apellido: </strong><?php echo $lista[0]["apellido"];?><input type="hidden" name="apellidos" value="<?php echo $lista[0]["apellido"];?>" /><br />
<strong class="tam_str">Parentesco:</strong> <?php echo $lista[0]["parentesco"];?><input type="hidden" name="parentesco" value="<?php echo $lista[0]["tipo_pco"];?>" /><br />
<strong class="tam_str">Sexo: </strong><?php if($lista[0]["sexo"] == "M"){ echo "Masculino";}elseif($lista[0]["sexo"] == "F"){echo "Femenino";}?><input type="hidden" name="sexo" value="<?php echo $lista[0]["sexo"];?>" /><br />
<strong class="tam_str">Lugar de Nacimiento: </strong><?php echo $lista[0]["nacimiento"];?><input type="hidden" name="lugarnaci" value="<?php echo $lista[0]["cod_ciu"];?>" /><br />
<strong class="tam_str">Fecha de Nacimiento: </strong><?php if($lista[0]["fecha_naci"] != ""){ echo date("d/m/Y", strtotime($lista[0]["fecha_naci"]));}?><input type="hidden" name="fechanaci" value="<?php echo $lista[0]["fecha_naci"];?>" /><br />
<strong class="tam_str">Estado Civil: </strong><?php echo $lista[0]["estado"];?><input type="hidden" name="estcivil" value="<?php echo $lista[0]["cod_civ"];?>" /><br />
<strong class="tam_str">ocupacion: </strong><?php echo $lista[0]["ocupacion"];?><input type="hidden" name="ocupacion" value="<?php echo $lista[0]["ocupacion"];?>" /><br />
<strong class="tam_str">Nivel Educativo: </strong><?php echo $lista[0]["nom_nie"];?><input type="hidden" name="nived" value="<?php echo $lista[0]["cod_nie"];?>" /><br />
<strong class="tam_str">Tipo de Vinculo: </strong><?php if($lista[0]["tipo_vinculo"]== "D"){ echo "Dependiente";}elseif($lista[0]["tipo_vinculo"]== "B"){ echo "Beneficiario";}else{ echo "Ambos";}?><input type="hidden" name="tipovinculo" value="<?php echo $lista[0]["tipo_vinculo"];?>" /><br />
<strong class="tam_str">Beneficiario Auxilio: </strong><?php if($lista[0]["tipo_fam"]=="S"){ echo "Si";}else{ echo "No";}?><input type="hidden" name="benauxilio" value="<?php echo $lista[0]["tipo_fam"];?>" /><br />
<strong class="tam_str">Discapacitado: </strong><?php if($lista[0]["discapacitado"]=="S"){ echo "Si";}else{ echo "No";}?><input type="hidden" name="discapacitado" value="<?php echo $lista[0]["discapacitado"];?>" /><br />
<strong class="tam_str">Estudia Actualmente?: </strong><?php if($lista[0]["estudia"] == "S"){ echo "Si";}elseif($lista[0]["estudia"] == "N"){ echo "No";}?><input type="hidden" name="radio" value="<?php echo $lista[0]["estudia"];?>" /><br /><br />
<input type="hidden" name="empleado" value="<?php echo $_GET["cod"];?>"/>
<input type="hidden" name="accion" value="aceptar"/>
</div>
<center>
<input type="button" id="aceptar" class="boton" name="aceptar" value="Aplicar Cambios"/>
<input type="button" class="boton" id="cancelar" name="cancelar" value="Rechazar Cambios"/>
</center>
</fieldset>
</form>