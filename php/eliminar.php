<?php
require('class_admin.php');

$cliente_id=$_GET['id'];
$objCliente=new perfil_admin();
if( $objCliente->eliminar($cliente_id) == true){
	echo "Registro eliminado correctamente";
}else{
	echo "Ocurrio un error";
}
?>