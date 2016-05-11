<?php
$salida="";
$id_pais=$_POST["elegido"];

$meses = array();
   $meses[1] = "Enero";
   $meses[2] = "Febrero";
   $meses[3] = "Marzo";
   $meses[4] = "Abril";
   $meses[5] = "Mayo";
   $meses[6] = "Junio";
   $meses[7] = "Julio";
   $meses[8] = "Agosto";
   $meses[9] = "Septiembre";
   $meses[10] = "Octubre";
   $meses[11] = "Noviembre";
   $meses[12] = "Diciembre";



if($id_pais=='01'){
echo $salida ='    	<option value="01">Enero</option>
							<option value="02">Febrero</option>
							<option value="03">Marzo</option>
							<option value="04">Abril</option>
							<option value="05">Mayo</option>
							<option value="06">Junio</option>
							<option value="07">Julio</option>
							<option value="08">Agosto</option>
							<option value="09">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>';	
							
}elseif($id_pais=='02'){
   
   for($mes=1; $mes<=date("m"); $mes++){
      if (date("m") == $mes){
         echo $salida = "<option value='".$mes."' selected>".$meses[$mes]."</option>";
      }
      else {
         echo $salida = "<option value='".$mes."'>".$meses[$mes]."</option>";
      }
   }

}
						?>