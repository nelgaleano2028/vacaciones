<?php
session_start();
include_once("class_empleado.php");
$empleado= new empleado();

$empleado->set_codigo(@$_SESSION["cod"]);//set de codigo del empleado se lo paso a la clase

$lista2 = $empleado->mostrar_formal();
?>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
body,td,th {
	font-size: 12px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.left {
	font-style: italic;
}
th{
	text-align: center;
}

h2 {
	color:#678197;
	font-weight:bold;
	font:Arial, Helvetica, sans-serif;
}
p {
	text-align:center;
	}	
a:link {
	color:#0465e3;
	text-decoration:none;

	}	
a:visited {
	color:#d42945;
	border-bottom:none;
	text-decoration:none;
	}		
a:hover,
a:focus {
	
	text-decoration: none;
    cursor: pointer;
	
	
	}
table a,
table a:link,
table a:visited {
	border:none;
	}							
	
img {
	border:0;
	margin-top:.5em;
	}	
table {
	
	border-top:1px solid #e5eff8;
	border-right:1px solid #e5eff8;
	margin:1em auto;
		
	}
caption {
	color: #9ba9b4;
	font-size:.94em;
		letter-spacing:.1em;
		margin:1em 0 0 0;
		padding:0;
		caption-side:top;
		text-align:center;
	}	
tr.odd td	{
	background:#f7fbff
	}
tr.odd .column1	{
	background:#f4f9fe;
	}	
.column1	{
	background:#f9fcfe;
	}
td {
	color:#678197;
	border-bottom:1px solid #e5eff8;
	border-left:1px solid #e5eff8;
	padding:.em 1em;
	
	font:12px Arial, Helvetica, sans-serif;
	}				
th {
	font-weight:normal;
	/*color: #678197;*/
	color: blue;
	text-align:left;
	border-bottom: 1px solid #e5eff8;
	border-left:1px solid #e5eff8;
	padding:.3em 1em;
	
	}							
thead th {
	background:#f4f9fe;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
	color:#66a3d3
	}	
tfoot th {
	
	background:#f4f9fe;
	}	
tfoot th strong {
	font:bold 1.2em "Century Gothic","Trebuchet MS",Arial,Helvetica,sans-serif;
	margin:.5em .5em .5em 0;
	color:#66a3d3;
		}		
tfoot th em {
	color:#f03b58;
	font-weight: bold;
	font-size: 1.1em;
	font-style: normal;
	}


</style>

	<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>


<script type="text/javascript" src="../js/jquery-ui-1.8.20.custom.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" src='../js/dataTables.fnGetFilteredNodes.js'></script>

<script type='text/javascript' src='../js/funciones.js'></script>

<script>
	$(document).ready(function() {
    
	    
	   function modal_iframe(url,title,a,b,e){
        
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
		draggable: a, 
		resizable: b,
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
	});
	
	
	
</script>
	<table width="100%" id="prestamos" class="tablesorter">
		<caption style="font-weight:bold; text-align: left">
			<h3>Listado de Estudios Formales</h3>
		</caption>
		<thead>
			<tr class="odd">
				<th width="25%" scope="col">Estudio</th>
				<th width="25%" scope="col">T&iacute;tulo</th>
				<th width="20%" scope="col">Fecha Inicial</th>	
				<th width="25%" scope="col">Fecha Final</th>
				<th width="30%" scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php
			 $var="odd";
			if($lista2==NULL){
			?>
		<tr>
			<td colspan="5" style="text-align: center;">No hay Datos a Mostrar</td>
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
			
			<td class="si" style="text-align: center;"><?php echo $lista2[$i]['nombre'];  ?></td>
			<td class="si" style="text-align: center;"><?php echo $lista2[$i]['desc_ttp'];  ?></td>
			<td class="si" style="text-align: center;"><?php echo $lista2[$i]['inicial'];  ?></td>
			<td style="text-align: center;"><?php echo $lista2[$i]['final'];?></td>
			<td class="si" style="text-align: center;"><a href="#" id="editar" onclick="modal_iframe('editar_formal.php?est=<?php echo $lista2[$i]["cod_clp"];?>&tit=<?php echo $lista2[$i]["cod_ttp"];?>','Editar Estudios Formales',false,false,event);">Ver</a>
			</td>
			</tr>	
			<?php 
			        }
			}
			?>
		</tbody>
        </table><br><br>