<?php
@session_start();
if (!isset($_SESSION['privi'])){
  
echo "<script>location.href='index.php'</script>";
}
require_once('../lib/configdb.php');

if(isset($_GET)){

    global $conn;

    $_GET["dia"]=(int)$_GET["dia"];

    if($_GET["dia"] < 10){$dia="0".$_GET["dia"];}else{$dia=$_GET["dia"];}
    if($_GET["mes"] < 10){$mes="0".$_GET["mes"];}else{$mes=$_GET["mes"];}

    $anio=date("Y");


    date_default_timezone_set("America/Bogota");

    $fecha_inicio=$dia."-".$mes."-".$anio;

    $fecha_inicial=strtotime($fecha_inicio);
    
    $sql3="SELECT COUNT(*) as CUANTOS FROM cierre_pagos where DIA='".$dia."' and MES='".$mes."' and ANO='".$anio."'";
    $res3=$conn->Execute($sql3);
    $row3=$res3->FetchRow();
    $cuantos=(int)$row3['CUANTOS'];
    
    if($cuantos >0){
    
       echo "Ya se genero el pago de nomina para este mes";

    }else{
    

        $sql="SELECT * FROM (SELECT fec_proceso as FEC_PROCESO FROM historia_liq WHERE fec_proceso is not null  ORDER BY fec_proceso DESC) WHERE rownum <=1";
    
        $res=$conn->Execute($sql);
        $row=$res->FetchRow();
    
    
        $fecha_proceso=strtotime($row["FEC_PROCESO"]);  //2013-03-21
        
        $fecha_proceso2=explode("-",$row["FEC_PROCESO"]);
    
    
        $cierre_nomina=$fecha_proceso2[2]."-".$fecha_proceso2[1]."-".$fecha_proceso2[0];
        
    
    
    
        if($fecha_inicial <= $fecha_proceso){
    
          echo "No se puede hacer cierre de Pago";
    
    
        }else{
    
             $sql2="SELECT COUNT(cod_pago)+1 as CONTAR FROM cierre_pagos";
             $res2=$conn->Execute($sql2);
             $row2=$res2->FetchRow();
             $cod_pago=(int)$row2['CONTAR'];
    
    
             $sql4="insert into cierre_pagos(cod_pago,ano,mes,dia,cierre_nomina) values(".$cod_pago.",'".$anio."','".$mes."','".$dia."','".$cierre_nomina."')";
    
    
             if($conn->Execute($sql4)){
                 
                 echo "Se ha generado cierre de Pago";
    
             }else{
             
                 echo "No Se ha generado cierre de Pago";
             }
    
    
        
        }
    
    
    }





}
?>