<?php
require_once "functions.class.php";

$type = intval($_POST["type"]);
$ctl = new Catalogos();
$res = NULL;
switch($type){

   case 1:
     $res=$ctl->prueba();
     break;
   case 2:
     $res=$ctl->meses();
     break;
   case 3:
      $res=$ctl->ano();
      break;
   case 4:
      $res=$ctl->ano_epleados();
      break;
   case 5:
      $res=$ctl->chec_tipopago();
      break;
   case 6:
      $res=$ctl->catalogo_conceptos();
      break;
   case 7:
      $res=$ctl->catalogo_nivel_educativo();
      break;
   case 8:
      $res=$ctl->catalogo_estado_civil();
      break;
   case 9:
      $res=$ctl->catalogo_parentesco();
      break;
   case 10:
      $res=$ctl->catalogo_ciudad();
      break;
   case 11:
      $res=$ctl->catalogo_barrios();
      break;
   case 12:
      $res=$ctl->catalogo_estudios();
      break;
   case 13:
      $res=$ctl->catalogo_titulos();
       break;
   case 14:
      $res=$ctl->catalogo_paises();
       break;
   case 15:
      $res=$ctl->catalogo_entidades();
       break;
   case 16:
      $res=$ctl->catalogo_areas();
       break;
   case 17:
      $res=$ctl->catalogo_curso();
       break;
   case 18:
      $res=$ctl->catalogo_unidades();
      break;
   case 19:
      $res=$ctl->catalogo_tipo_documento();
      break;
   case 20:
      $res=$ctl->catalogo_programacion_capa();
      break;
   case 21:
      $res=$ctl->catalogo_capacitacion();
      break;
   
 
}
echo json_encode($res);

?>