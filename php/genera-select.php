<?php

include_once("functions.class.php");

/*@method catalogos
 *Instanciamos esta clase cuyos
 *datos muestran los periodos 
 *de pago de los empleados 
*/
$catalogos=new Catalogos;

/*Comportamiento del Usuario:
 *Escoge en la opcion TIPO DE PAGO Mensual
 *Se muestra los meses del año¨.
 *
 *Escoge en la opcion TIPO DE PAGO Quincenal
 *Se muestra la 1ra y 2da quincena de cada Mes.
 *
 *Escoge en la opcion TIPO DE PAGO Semanal equivalente
 *Se muestra de la Semana 1 hasta la 52 correspondiente
 *a cada AÑO del PAGO de los empleados
*/


global $conn;

/*pago mensual de la empresa */
$sql="select descripcion as DESCRIPCION from parametros_nue where nom_var='param_mens_tipag'";
$rs=$conn->Execute($sql);
$fila=@$rs->FetchRow();
$mensual=$fila["DESCRIPCION"];
/*----------------------------------- */

/*pago quincenal de la empresa */
$sqlqui="select descripcion as DESCRIPCION from parametros_nue where nom_var ='param_quince_tip_pag'";
$rsqui=$conn->Execute($sqlqui);
$filaqui=@$rsqui->FetchRow();
$quincenal=$filaqui["DESCRIPCION"];
/*----------------------------------- */

/*pago semanal de la empresa */
$sqlsema="select descripcion as DESCRIPCION from parametros_nue where nom_var ='param_sema_tip_pag'";
$rssema=$conn->Execute($sqlsema);
$filasema=@$rssema->FetchRow();
$semanal=$filasema["DESCRIPCION"];
/*----------------------------------- */

if($_GET["id"]==$mensual){
$mes=$catalogos->combo_mes();
}elseif($_GET["id"]==$quincenal){
$mes=$catalogos->combo_mes_quin();
}
elseif($_GET["id"]==$semanal){
$mes=$catalogos->combo_mes_semanal();
}
echo json_encode($mes);//Estos datos se visualizan en el COMBO o SELECT Periodo
?>