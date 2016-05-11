<?php include_once("class_admin.php");
$administrador=new perfil_admin();
$lista3=$administrador->mostrar_admins();
			      ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
    <!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
    <!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
    <!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
    <!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

		     <!--[if IE]>
		     <head>
			      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->
		    
		     <!--[if lt IE 10]>
    <script type="text/javascript" src="../PIE/PIE.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="../js/html5shiv.js"></script>
    <![endif]-->      

 <script>
/*paginacion id de la tabla*/
            $(document).ready(function() {
            $('#admin').tablePagination({});
			
			
            } );
			
            /*quita todo conflicto de jquery*/
//              var $j = jQuery.noConflict();
//			  
//			  /*ordenamiento id de la tabla*/
//         $j(document).ready(function(){
//    
//        $j("#admin").tablesorter();
//    }
    //); 
     </script>
 </head>
    <body>
 <br><br><br>
 <center>
			   
 <div id="capa" class="">
                    <table id="admin" class="tablesorter">
			     
			      <thead>
			        <tr class="odd">
				<th width="14%" scope="col">Codigo</th>
				<th width="14%" scope="col">Cedula</th>
				<th width="14%" scope="col">Nombres y Apellidos </th>	
			        <th width="14%" scope="col">Usuario</th>
				<th width="14%" scope="col">Area</th>
				<th width="16%" scope="col">Cargo</th>
                                <th width="5%" scope="col">Eliminar</th>
			        </tr>
			      </thead>
                    <tbody>
			      <?php
			       $var="odd";
			       if($lista3==NULL){
			      ?>
			      <tr>
				  <td colspan="7">No hay Datos a Mostrar</td>
			      </tr>
			      <?php
			       }else{
			             for($i=0; $i<count($lista3); $i++){
						       
					if($i % 2){
                                                   echo "<tr id='fila-".$lista3[$i]['usuario']."' class='odd'>";
					}else{
						   echo "<tr id='fila-".$lista3[$i]['usuario']."'>";
			                     }
					
			      ?>
                              <td><?php echo $lista3[$i]['codigo']; ?></td>
			      <td><?php echo $lista3[$i]['cedula']; ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['nombre'])." ".utf8_decode($lista3[$i]['apellido']); ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['usuario']); ?></td>
			      <td><?php echo $lista3[$i]['area']; ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['cargo']); ?></td>
			      <td><span class="dele">
			      <a onClick="EliminarDato('<?php echo $lista3[$i]['usuario']; ?>');" >
			      <img src="../imagenes/delete1.png" title="Eliminar" alt="Eliminar" />
			      </a></span>
			      </td>
			      
			       </tr>
			      <?php
			      
			          }
			       }
			       ?>
                 </tbody>
                 </table>
		    </div>
 </fieldset> 
 </center>
 </body>
</html>