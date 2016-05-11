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


@$id = $_POST['combobox']; 
?>
	<script src="../js/1/jquery-1.9.1.js"></script>
	<script src="../js/1/jquery.ui.core.js"></script>
	<script src="../js/1/jquery.ui.widget.js"></script>
    <script src="../js/1/jquery.ui.button.js"></script>
    <script src="../js/1/jquery.ui.position.js"></script>
    <script src="../js/1/jquery.ui.menu.js"></script>
    <script src="../js/1/jquery.ui.autocomplete.js"></script>
    <script src="../js/1/jquery.ui.tooltip.js"></script>
    <link rel="stylesheet" href="../css/1/demos.css">
    <link rel="stylesheet" href="../css/1/jquery-ui.css">

<!--Script para el combobox-->
		<script>
	(function( $ ) {
		$.widget( "custom.combobox", {
			_create: function() {
				this.wrapper = $( "<span>" )
					.addClass( "custom-combobox" )
					.insertAfter( this.element );

				this.element.hide();
				this._createAutocomplete();
				this._createShowAllButton();
			},

			_createAutocomplete: function() {
				var selected = this.element.children( ":selected" ),
					value = selected.val() ? selected.text() : "";

				this.input = $( "<input>" )
					.appendTo( this.wrapper )
					.val( value )
					.attr( "title", "" )
					.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: $.proxy( this, "_source" )
					})
					.tooltip({
						tooltipClass: "ui-state-highlight"
					});

				this._on( this.input, {
					autocompleteselect: function( event, ui ) {
						ui.item.option.selected = true;
						this._trigger( "select", event, {
							item: ui.item.option
						});
					},

					autocompletechange: "_removeIfInvalid"
				});
			},

			_createShowAllButton: function() {
				var input = this.input,
					wasOpen = false;

				$( "<a>" )
					.attr( "tabIndex", -1 )
					.tooltip()
					.appendTo( this.wrapper )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "custom-combobox-toggle ui-corner-right" )
					.mousedown(function() {
						wasOpen = input.autocomplete( "widget" ).is( ":visible" );
					})
					.click(function() {
						input.focus();

						// Close if already visible
						if ( wasOpen ) {
							return;
						}

						// Pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
					});
			},

			_source: function( request, response ) {
				var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
				response( this.element.children( "option" ).map(function() {
					var text = $( this ).text();
					if ( this.value && ( !request.term || matcher.test(text) ) )
						return {
							label: text,
							value: text,
							option: this
						};
				}) );
			},

			_removeIfInvalid: function( event, ui ) {

				// Selected an item, nothing to do
				if ( ui.item ) {
					return;
				}

				// Search for a match (case-insensitive)
				var value = this.input.val(),
					valueLowerCase = value.toLowerCase(),
					valid = false;
				this.element.children( "option" ).each(function() {
					if ( $( this ).text().toLowerCase() === valueLowerCase ) {
						this.selected = valid = true;
						return false;
					}
				});

				// Found a match, nothing to do
				if ( valid ) {
					return;
				}

				// Remove invalid value
				this.input
					.val( "" )
					.attr( "title", value + " didn't match any item" )
					.tooltip( "open" );
				this.element.val( "" );
				this._delay(function() {
					this.input.tooltip( "close" ).attr( "title", "" );
				}, 2500 );
				this.input.data( "ui-autocomplete" ).term = "";
			},

			_destroy: function() {
				this.wrapper.remove();
				this.element.show();
			}
		});
	})( jQuery );

	$(function() {
		$( "#combobox" ).combobox();
		$( "#toggle" ).click(function() {
			$( "#combobox" ).toggle();
		});
	});
	</script>
    
<!--Script para el textarea-->
<script>
contenido_textarea = ""
num_caracteres_permitidos = 200

function valida_longitud(){
num_caracteres = document.forms[0].texto.value.length

if (num_caracteres > num_caracteres_permitidos){
document.forms[0].texto.value = contenido_textarea
}else{
contenido_textarea = document.forms[0].texto.value
}

if (num_caracteres >= num_caracteres_permitidos){
document.forms[0].caracteres.style.color="#ff0000";
}else{
document.forms[0].caracteres.style.color="#000000";
}

cuenta()
}
function cuenta(){
document.forms[0].caracteres.value=document.forms[0].texto.value.length
}
</script>


<style type="text/css">
body { 
text-align:center; 
}
.cuerpodiv {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	background-color: #CCC;
	margin:0 auto;
	width:500px;
	height:500px;
	text-align:left;
}
.cuerpodiv {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	background-color: #CCC;
	margin:0 auto;
	width:500px;
	height:350px;
	text-align:left;
}
.custom-combobox {
		position: relative;
		display: inline-block;
	}
	.custom-combobox-toggle {
		position: absolute;
		top: 0;
		bottom: 0;
		margin-left: -1px;
		padding: 0;
		/* support: IE7 */
		*height: 1.7em;
		*top: 0.1em;
	}
	.custom-combobox-input {
		margin: 0;
		padding: 0.3em;
	}
</style>
<?php
				$query6 = "SELECT ID, TITULO, CONTENIDO, FECHA, ESTADO FROM FEEDNEWS WHERE ID = '$id'";
				$rs = $conn->Execute($query6);
				$row6 = $rs->fetchrow();
    			$dato = $row6['CONTENIDO'];
				$titu = $row6['TITULO'];
				$id = $row6['ID'];
				?>
<body>
<div class="cuerpodiv">
<form name="entrante" action="accionesfeed.php" method="post" id="entrante" >
<h2>Noticias:</h2>
<div>
<p align="center">
  <input name="titulo" type="text" id="titulo" placeholder="Escribe el titulo aqui" size="79" value="<?php echo @$titu; ?>"> 
  </p>
  <input name="identificador" type="hidden" value="<?php echo @$id; ?>"/>
<p>
  <textarea cols="59" rows="5" name="texto" onKeyDown="valida_longitud()" onKeyUp="valida_longitud()" placeholder="Maximo 200 caracteres"><?php echo @$dato;?></textarea>
</p>
<p align="right">Escribe maximo 200 caracteres:
  <input name="caracteres" type="text" disabled="disabled" size=2 readonly style="background-color:transparent"></p>
<div align="center">
<input name="actualizar" type="submit" value="Actualizar" id="Actualizar"
onclick="if ((document.entrante.identificador.value=='')) {
			alert('Si desea actualizar un informe, debe seleccionarlo en la parte inferior.');						
			return false
			}"> <!-- EL USUARIO DEBE SELECCIONAR UN REGISTRO PARA ACTUALIZARLO -->
<input name="guardar" type="submit" value="Guardar Nuevo" id="Guardar Nuevo"
onclick="if ((document.entrante.titulo.value==''||document.caracteres.titulo.value=='')) {
			alert('Por favor ingrese un registro nuevo.');			
			return false
			}"> <!-- EL USUARIO NO PUEDE GUARDAR SINO HA INGRESADO DATOS EN LOS CAMPOS -->
</div>
</div>
</form>
</br>
<form name="id" action="#" method="post" id="id">
<div  style="background-color: #999">
	<p style="color: #FFF; font-weight: bold;">SELECCIONE EL FORMATO QUE DESEA EDITAR: </p><input name="editar" type="submit" value="Editar" id="editar">
	<select id="combobox" name="combobox">
	  <option value="">Seleccione...</option>
		<?php
		$sql = "SELECT ID, TITULO, CONTENIDO, FECHA, ESTADO FROM FEEDNEWS ORDER BY ID DESC";
		$rs = $conn->Execute($sql);
		while($row = $rs->fetchrow()){
			echo '<option value="'.$row["ID"].'">'.$row["TITULO"].'</option>';
		}
		?>
	</select>
</div>
</form>
</div>
</body>