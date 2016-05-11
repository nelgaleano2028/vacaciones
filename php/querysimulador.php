<?php
include_once('../lib/adodb/adodb.inc.php');
//------------------------------antidoto
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');
@session_start();
@$ididen = $_SESSION['cod'];
$codiepl = $_SESSION['ced'];


   //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;


//--ACTUALIDAD

$query103 = "select a.num_cta as NUM_CTA, c.nom_ban AS NOM_BAN,a.tip_cta AS TIP_CTA
			from epl_consigna a, bancos c  
			where	a.cod_ban=c.cod_ban 
				and a.cod_epl = '$ididen' 
				and a.estado='A'";
$rs103 = $conn->Execute($query103);
	while($row103 = $rs103->fetchrow()){
if($row103["TIP_CTA"] == "1"){
				$tipo='Corriente';
			}else{
				$tipo='Ahorros';
			}
	  @$tablad.='<tr>
        <td>'.$row103["NOM_BAN"].'</td>
        <td>'.$row103["NUM_CTA"].'</td>
        <td>'.$tipo.'</td>
      </tr>';	  
	}

}
if(isset($rowc['CONTEO'])){
$conn = $configc;


//--ACTUALIDAD

$query103 = "select case when a.cod_ban =13 then substr (a.cod_suc,2,3)||a.num_cta
else a.num_cta end as NUM_CTA, c.nom_ban AS NOM_BAN,a.tip_cta AS TIP_CTA
from epl_consigna a, bancos c
where a.cod_ban=c.cod_ban
and a.cod_epl = '$ididen'
and a.estado='A'";
$rs103 = $conn->Execute($query103);
	while($row103 = $rs103->fetchrow()){
if($row103["TIP_CTA"] == "1"){
				$tipo='Corriente';
			}else{
				$tipo='Ahorros';
			}
	  @$tablad.='<tr>
        <td>'.$row103["NOM_BAN"].'</td>
        <td>'.$row103["NUM_CTA"].'</td>
        <td>'.$tipo.'</td>
      </tr>';	  
	}

}
if(isset($rowa['CONTEO'])){
$conn = $config;

//--ACTUALIDAD

$query103 = "select case when a.cod_ban =13 then substr (a.cod_suc,2,3)||a.num_cta
else a.num_cta end as NUM_CTA, c.nom_ban AS NOM_BAN,a.tip_cta AS TIP_CTA
from epl_consigna a, bancos c
where a.cod_ban=c.cod_ban
and a.cod_epl = '$ididen'
and a.estado='A'";
$rs103 = $conn->Execute($query103);
	while($row103 = $rs103->fetchrow()){
if($row103["TIP_CTA"] == "1"){
				$tipo='Corriente';
			}else{
				$tipo='Ahorros';
			}
	  @$tablad.='<tr>
        <td>'.$row103["NOM_BAN"].'</td>
        <td>'.$row103["NUM_CTA"].'</td>
        <td>'.$tipo.'</td>
      </tr>';	  
	}

}
if(isset($rowt['CONTEO'])){
$conn = $configt;

//--ACTUALIDAD

$query103 = "select case when a.cod_ban =13 then substr (a.cod_suc,2,3)||a.num_cta
else a.num_cta end as NUM_CTA, c.nom_ban AS NOM_BAN,a.tip_cta AS TIP_CTA
from epl_consigna a, bancos c
where a.cod_ban=c.cod_ban
and a.cod_epl = '$ididen'
and a.estado='A'";
$rs103 = $conn->Execute($query103);
	while($row103 = $rs103->fetchrow()){
if($row103["TIP_CTA"] == "1"){
				$tipo='Corriente';
			}else{
				$tipo='Ahorros';
			}
	  @$tablad.='<tr>
        <td>'.$row103["NOM_BAN"].'</td>
        <td>'.$row103["NUM_CTA"].'</td>
        <td>'.$tipo.'</td>
      </tr>';	  
	}

}

include_once('inicio.php');


@$salario = $_POST["salario"];
@$ingresosala = $_POST["ingresosala"];
@$auxilio = $_POST["auxilio"];
@$prima = $_POST["prima"];
@$auxiliotrans = $_POST["auxiliotrans"];
@$bigpass = $_POST["bigpass"];
@$bigpassrete = $_POST["bigpassrete"];
@$vivienda = $_POST["vivienda"];
@$prepag = $_POST["prepag"];
@$dependien = $_POST["dependien"];
@$pensionvol = $_POST["pensionvol"];
@$aporterent = $_POST["aporterent"];
@$otrasdeduc = $_POST["otrasdeduc"];
@$radio = $_POST["radio"];


//--  Salarios																				

$query1 = "SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =1
";
$rs = $conn->Execute($query1);
$row1 = $rs->fetchrow();

@$valora = $row1['VALOR'];

//--  		Otros ingresos Salariales																

$query2 = "SELECT NVL (SUM(H.VALOR),0)AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =2
";
$rs = $conn->Execute($query2);
$row2 = $rs->fetchrow();

$valorb = $row2['VALOR'];

//-- (Incluye Auxilio Rodamiento, Movilidad, etc)														

$query3 = "SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =3
";
$rs = $conn->Execute($query3);
$row3 = $rs->fetchrow();

$valorc = $row3['VALOR'];

//-- Prima Legal													

$query4 = "SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =4
";
$rs = $conn->Execute($query4);
$row4 = $rs->fetchrow();

$valord = $row4['VALOR'];

//-- Auxilio Legal de Transporte												

$query5 = "SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =5
";
$rs = $conn->Execute($query5);
$row5 = $rs->fetchrow();

$valore = $row5['VALOR'];

//-- Big Pass												

$query6 = "SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =6
";
$rs = $conn->Execute($query6);
$row6 = $rs->fetchrow();

$valorf = $row6['VALOR'];

//-- Big Pass con Retención											

$query7 = "SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =7
";
$rs = $conn->Execute($query7);
$row7 = $rs->fetchrow();

$valorg = $row7['VALOR'];

//-- Vivienda										

$query8 = "SELECT NVL(MAX(c.vlr_men),0) AS VALOR, c.FECHA AS FECHA
    FROM   CERTIFICADOS c, EMPLEADOS_BASIC E, PERIODOS P
   WHERE  c.cod_epl='$ididen'
     AND c.cod_epl = e.cod_epl 
     AND e.tip_pago = p.tip_per
     and e.fec_ult_nom between p.fec_ini and p.fec_fin
     AND  c.fecha>=p.fec_ini
     AND  c.tipo='V'
	 group by  c.FECHA
";
$rs = $conn->Execute($query8);
$row8 = $rs->fetchrow();

$valorh = $row8['VALOR'];

if(isset($row8['FECHA'])){
@$fechah = date("d-m-Y",strtotime($row8['FECHA']));
}else{
	@$fechah = $row8['FECHA'];
}
//-- Prepagada / Salud									

$query9 = "SELECT NVL(MAX(c.vlr_men),0) AS VALOR, c.FECHA AS FECHA
    FROM   CERTIFICADOS c, EMPLEADOS_BASIC E, PERIODOS P
   WHERE  c.cod_epl='$ididen'
     AND c.cod_epl = e.cod_epl 
     AND e.tip_pago = p.tip_per
     and e.fec_ult_nom between p.fec_ini and p.fec_fin
     AND  c.fecha>=p.fec_ini
     AND  c.tipo='S'
	 group by  c.FECHA
";
$rs = $conn->Execute($query9);
$row9 = $rs->fetchrow();

$valori = $row9['VALOR'];

if(isset($row9['FECHA'])){
@$fechai = date("d-m-Y",strtotime($row9['FECHA']));
}else{
	@$fechai = $row9['FECHA'];
}

//-- Dependientes						

$query10 = "SELECT NVL(MAX(c.vlr_men),0) AS VALOR, c.FECHA AS FECHA
    FROM   CERTIFICADOS c, EMPLEADOS_BASIC E, PERIODOS P
   WHERE  c.cod_epl='$ididen'
     AND c.cod_epl = e.cod_epl 
     AND e.tip_pago = p.tip_per
     and e.fec_ult_nom between p.fec_ini and p.fec_fin
     AND  c.fecha>=p.fec_ini
     AND  c.tipo='D'
	 group by  c.FECHA
";
$rs = $conn->Execute($query10);
$row10 = $rs->fetchrow();

$valorj = $row10['VALOR'];

if(isset($row10['FECHA'])){
@$fechaj = date("d-m-Y",strtotime($row10['FECHA']));
}else{
	@$fechaj = $row10['FECHA'];
}

//-- Salud obligatoria (año anteriior)						

$query11 = "SELECT  NVL(sum(vlr_men),0)  AS  VALOR, c.FECHA AS FECHA               
                FROM   CERTIFICADOS C, EMPLEADOS_BASIC E, PERIODOS P
                 WHERE  C.cod_epl = '$ididen'
                 AND c.cod_epl = e.cod_epl 
                 AND e.tip_pago = p.tip_per
                 and e.fec_ult_nom between p.fec_ini and p.fec_fin                 
                AND  tipo   = 'E'
               AND  C.fecha  >= P.FEC_INI
			   group by  c.FECHA
";
$rs = $conn->Execute($query11);
$row11 = $rs->fetchrow();

$valork = $row11['VALOR'];

if(isset($row11['FECHA'])){
@$fechak = date("d-m-Y",strtotime($row11['FECHA']));
}else{
	@$fechak = $row11['FECHA'];
}

//-- Pensión Voluntaria						

$query12 = "SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =8
";
$rs = $conn->Execute($query12);
$row12 = $rs->fetchrow();

$valorn = $row12['VALOR'];

//-- Aporte AFC, Renta Pensión, Seguro de Vida con Beneficio

$query13 = "SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =9
";
$rs = $conn->Execute($query13);
$row13 = $rs->fetchrow();

$valorl = $row13['VALOR'];

//-- Salud

$query14 = "SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =10
";
$rs = $conn->Execute($query14);
$row14 = $rs->fetchrow();

$valoro = $row14['VALOR'];

//-- Pensión

$query15 = "
SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =11
";
$rs = $conn->Execute($query15);
$row15 = $rs->fetchrow();

$valorp = $row15['VALOR'];

//-- Solidaridad

$query16 = "
SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =12
";
$rs = $conn->Execute($query16);
$row16 = $rs->fetchrow();

$valorq = $row16['VALOR'];

//-- Retención Salario Procedimiento 1 / 2

$query17 = "
SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =13
";
$rs = $conn->Execute($query17);
$row17 = $rs->fetchrow();

$valorr = $row17['VALOR'];

//-- Retención Salario Pagos Minimos

$query18 = "
SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =14
";
$rs = $conn->Execute($query18);
$row18 = $rs->fetchrow();

$valors = $row18['VALOR'];

//-- Retención Salario Pagos Minimos

$query19 = "
SELECT NVL (SUM(H.VALOR),0) AS VALOR
FROM HISTORIA_LIQ H, CONCEP_CAL C, EMPLEADOS_BASIC E, PERIODOS P
WHERE H.COD_EPL ='$ididen' 
AND H.COD_CON = C.COD_CON
AND H.COD_EPL = E.COD_EPL
AND H.ANO = P.ANO
AND H.COD_PER = P.COD_PER
AND E.TIP_PAGO = P.TIP_PER
AND E.FEC_ULT_NOM BETWEEN P.FEC_INI AND P.FEC_FIN
AND C.FILA =15
";
$rs = $conn->Execute($query19);
$row19 = $rs->fetchrow();

$valort = $row19['VALOR'];

//-- Declarante de Renta
//Si el resultado es mayor a cero entonces declarante renta = SI de lo contrario declarante renta = NO

$query60 = "SELECT COUNT(*) AS NUMERO
               FROM EPL_GRUPOS
               WHERE COD_EPL = '$ididen'
               AND COD_GRU =100";
$rs = $conn->Execute($query60);
$row60 = $rs->fetchrow();
$declarenta = $row60['NUMERO'];
if($declarenta == 0){
	$declarenta = 'No';
	}else{
		$declarenta = 'Si';
		}

//-- Procedimiento de Retención en la Fuente

$query61 = "select case when rte_fte >=0 then '2'
               else '1' end AS RESULTADO
               from empleados_basic
               where COD_EPL = '$ididen'";
$rs = $conn->Execute($query61);
$row61 = $rs->fetchrow();
$procedireten = $row61['RESULTADO'];

//-- Tipo de Salario

$query62 = "select case when COD_GRU = 2 then 'INTEGRAL'
               else 'BÁSICO' end AS RESULTADO
               from EPL_GRUPOS
               where COD_EPL = '$ididen'
               AND COD_GRU IN (1,2)";
$rs = $conn->Execute($query62);
$row62 = $rs->fetchrow();
$tiposalario = $row62['RESULTADO'];

//-- Porcentaje de Retención

$query63 = "select rte_fte AS RETE
from empleados_basic
where COD_EPL = '$ididen'";
$rs = $conn->Execute($query63);
$row63 = $rs->fetchrow();
$porcenrete = $row63['RETE'];

//-- Grupo de aplicación pensin obligatoria

$query64 = "SELECT COUNT(*) AS CONTEO
FROM EPL_FONDOS F, EMPLEADOS_BASIC E
WHERE E.COD_EPL = '$ididen'
AND  E.COD_EPL = F.COD_EPL
AND F.COD_CON =2002
AND F.FEC_RET IS NULL
AND F.FEC_TRAS IS NULL";
$rs = $conn->Execute($query64);
$row64 = $rs->fetchrow();

if($row64['CONTEO'] > 0){
	$grupaplica = 2;
	}else{
		$grupaplica = 1;
		}


//-- Fecha ingreso

$query65 = "select fec_ing AS FECHA from empleados_basic where cod_epl ='$ididen'";
$rs = $conn->Execute($query65);
$row65 = $rs->fetchrow();
$fechaingres = $row65['FECHA'];

//-- Fecha Vencimiento

$query66 = "select VTO_CTO AS FECHA from empleados_basic where cod_epl ='$ididen'";
$rs = $conn->Execute($query66);
$row66 = $rs->fetchrow();
if(isset($row66['FECHA'])){
$fechavencimi = date("d-m-Y",strtotime($row66['FECHA']));
}else{
	$fechavencimi = $row66['FECHA'];
}

//-- Tipo Contrato

$query67 = "select c.nom_cto AS DATO from empleados_basic e, contratos c where e.cod_epl ='$ididen'
and e.cod_cto = c.cod_cto";
$rs = $conn->Execute($query67);
$row67 = $rs->fetchrow();
$tipocontrato = $row67['DATO'];

//-- Validaciones 1

//if ((($salario+$ingresosala) * 0.60)-(($auxilio+$bigpassrete) * 0.40) > 0){ 
if ((($auxilio+$bigpassrete) * 0.60)-(($salario+$ingresosala) * 0.40) > 0){ 
        $IBC_1 = ($salario+$ingresosala+$auxilio+$bigpassrete)*0.60;
}else{
        $IBC_1 = $salario+$ingresosala;
}

if ($radio == 2){
          $IBC_2 = $IBC_1 * 0.70;
}else{
         $IBC_2 = $IBC_1;
}

$query20 = "select tope_iss AS TOPE_ISS from parametros";
$rs = $conn->Execute($query20);
$row20 = $rs->fetchrow();

$tope_iss = $row20['TOPE_ISS'];

if ($IBC_2 >= $tope_iss) {
          $IBC_FINAL = $tope_iss;
}else{
       $IBC_FINAL = $IBC_2;
}

$valoroa = $IBC_FINAL * 0.04;

//-- Validaciones 2


//Aquí se debe tener en cuenta el valor resultado de la celda C30

//Se utilizara el IBC_FINAL del cálculo de la Salud

if ($grupaplica = 2){

       $valorpa = $IBC_FINAL *0.04;
}else{
     $valorpa = 0;
}
//La pension debe redondear al 100 mas cercano


//-- Validaciones 3


//Se halla el porcentaje a aplicar 

$query21 = "select  vlr_max AS PORCENTAJE
from controles_concep c, parametros p
where c.cod_con = p.cod_sol
and '$IBC_FINAL' between c.ran_inf*p.sal_min and c.ran_sup*p.sal_min";
$rs = $conn->Execute($query21);
$row21 = $rs->fetchrow();
$porcentajes = $row21['PORCENTAJE'];

if (empty ($porcentajes)){
$porcentajes =0;
}
if ($grupaplica = 2){ 
   $valorqa = $IBC_FINAL * $porcentajes/100;
}else{
   $valorqa = 0;
}

//La solidaridad se redondea al 100 mas cercano

// Validacion 3

//Se debe almacenar el valor de la UVT en una variable

$query22 = "select valor as UVT from parametros_nue where nom_var ='t_rtefte_uvt'";
$rs = $conn->Execute($query22);
$row22 = $rs->fetchrow();
$uvt = $row22['UVT'];

//Debemos validar y almacenar el año en cual se esta calculando la retencion del empleado

$query23 = "select p.ano AS ANO
from empleados_basic e, periodos p
where e.tip_pago = p.tip_per
and e.fec_ult_nom between p.fec_ini and p.fec_fin
and COD_EPL = '$ididen'";
$rs = $conn->Execute($query23);
$row23 = $rs->fetchrow();
$ano = $row23['ANO'];

if(empty($ano)){
$ano =  date('Y');
}


//CALCULO DE LA RETENCION POR PROCEDIMIENTO UNO O DOS
if ($procedireten == 2){
    $INGRESO_1 = $salario+$ingresosala+$auxilio+$prima+$bigpassrete;
}
else{
	$INGRESO_1 = $salario+$ingresosala+$auxilio+$bigpassrete;
}
//$INGRESO_1 = $salario+$ingresosala+$auxilio+$prima+$bigpassrete;
//echo '</br> INGRESO_1 '.$INGRESO_1 .'</br>';
//El valor de la celda H26 Se calcula de la siguiente forma:
//echo '</br> $valorpa '.$valorpa .'</br>';
// '</br> $valorqa '.$valorqa .'</br>';
$valorma = ($INGRESO_1*0.30) -$valorpa-$valorqa;
//echo '</br> $valorma  '.$valorma  .'</br>';
$VOLUNTARIOS = $pensionvol+$aporterent;

if($VOLUNTARIOS > $valorma)  {
     $VOLUNTARIOS = $valorma;
}else{
     $VOLUNTARIOS = $pensionvol+$aporterent;
}
//SE CALCULA LA BASE INICIAL

$BASE_1= $INGRESO_1 - $valorpa - $valorqa - $VOLUNTARIOS;
//echo '</br> BASE_1_1 '.$BASE_1 .'</br>';
//SE CALCULA LA BASE INICIAL

//$BASE_1= $INGRESO_1 -$valorpa-$valorqa-$valorma;

//VALIDACIONES CERTIFICADO DEPENDIENTES

            $Dependientes =  $dependien;
            $Tope_Dependientes_1 = $INGRESO_1 *0.10;
            $Tope_Dependientes_2 = 32 * $uvt;

//El valor final del certificado de dependientes 
//se debe guardar en una variable la cual voy a llamar CER_DEPE y el valor es el menor de los tres anteriores, 
//este valor se tiene en cuenta mas adelante en el calculo de la retencion.
if (($Dependientes <=$Tope_Dependientes_1) AND ($Dependientes <=$Tope_Dependientes_2)){
	$CER_DEPE = $Dependientes;
} 
else if (($Tope_Dependientes_1 <=$Dependientes ) AND ($Tope_Dependientes_1<=$Tope_Dependientes_2)){
	$CER_DEPE = $Tope_Dependientes_1;
}
else if (($Tope_Dependientes_2 <=$Dependientes )AND($Tope_Dependientes_2<=$Tope_Dependientes_1)){
	$CER_DEPE = $Tope_Dependientes_2;
}
else {
	$CER_DEPE =0;
}
//VALIDACION CERTIFICADO PREPAGADA / SALUD
       
           $Prepagada= $prepag;
           $Tope_Prepagada = 16 * $uvt;  

//Crear una variable para almacenar el valor final del certificado de prepagada CER_PREP
           if ($Prepagada >= $Tope_Prepagada){
                    $CER_PREP= $Tope_Prepagada;
		   }else{
                    $CER_PREP = $Prepagada;
		   }
//echo '</br> variable $vivienda '.$vivienda .'</br>';
//VALIDACION CERTIFICADO DE VIVIENDA
            $Vivienda = $vivienda;
            $query24 = "select valor as TOPE_VIVIENDA from parametros_nue where nom_var ='t_tope_rte_fte_viv'";
			 $rs = $conn->Execute($query24);
			$row24 = $rs->fetchrow();
			$TOPE_VIVIENDA = $row24['TOPE_VIVIENDA'];
//echo '</br> variable $vivienda '.$vivienda .'</br>';
//Crear una variable para almacenar el valor final del certificado de vivienda CER_VIV
           if ($Vivienda >= $TOPE_VIVIENDA) {
                    $CER_VIV= $TOPE_VIVIENDA;
		   }else{
                    $CER_VIV = $Vivienda;
		   }

//Aqui continuamos con el calculo de la retención
/*echo '</br> variable BASE_1 '.$BASE_1 .'</br>';
echo 'variable CER_DEPE '.$CER_DEPE .'</br>';
echo 'variable CER_PREP '.$CER_PREP .'</br>';
echo 'variable CER_VIV '.$CER_VIV .'</br>';
echo 'variable valork '.$valork .'</br>';*/
$BASE_2 = $BASE_1- ($CER_DEPE+$CER_PREP+$CER_VIV+$valork);
//echo 'variable BASE_2 '.$BASE_2.'</br>';
$query25 = "select valor as TOPE_EXCENTO from parametros_nue where nom_var ='t_tope_ded_rte_fte'";
			$rs = $conn->Execute($query25);
			$row25 = $rs->fetchrow();
			$TOPE_EXCENTO = $row25['TOPE_EXCENTO'];
			
if ($BASE_2*0.25 >= $TOPE_EXCENTO){
          $BASE_EXC = $TOPE_EXCENTO;
}else{
        $BASE_EXC =  $BASE_2*0.25;
}
/*echo '</br> variable $TOPE_EXCENTO '.$TOPE_EXCENTO .'</br>';
echo 'variable BASE_EXC '.$BASE_EXC .'</br>';*/
$BASE_GRAV = $BASE_2- $BASE_EXC;
/*echo 'variable $BASE_GRAV  '.$BASE_GRAV  .'</br>';
echo 'variable $uvt  '.$uvt  .'</br>';*/
//Aqui calculamos el valor de la retención para procedimiento 1 ó 2
//echo $procedireten;
if ($procedireten == 2){
    $RETENCION = $BASE_GRAV * ($porcenrete/100);
}else{
    //Aqui calculamos la retención por procedimiento 1 (Ojo que aqui llamamos a la variable AÑO del inicio)

 // echo $BASE_GRAV .' - ';
 // echo $uvt;
  //echo $ano;
        $query26 = "SELECT ROUND (NVL( ((((($BASE_GRAV/$uvt)-ran_inf)*(por_rte/100))+vlr_rte)*$uvt) ,0), 0)  AS RETENCION
         FROM   RTE_FTE 
         WHERE  ($BASE_GRAV/$uvt)>ran_inf AND ($BASE_GRAV/$uvt)<=ran_sup
         AND  ano = $ano";
		 	$rs = $conn->Execute($query26);
			$row26 = $rs->fetchrow();
			$row26['RETENCION'];
			if(empty ($row26['RETENCION'])){
				$retencionround = 0;
				$RETENCION =$retencionround;
				
			}else{
				$retencionround = $row26['RETENCION'];
				$RETENCION =$retencionround;
				//echo 'cualquier cosa 2';
			}
}
			
//CALCULO DE LA RETENCION POR PAGOS MINIMOS

//Necesitamos las siguientes variables ya calculadas
//INGRESO_1 ok
//SALUD  (H31) ok
//PENSION (H32) ok
//SOLIDARIDAD (H33) ok

$BASE_PM = $INGRESO_1-$valoroa-$valorpa-$valorqa;

//Se Halla porcentaje de UVT's maximo a deducir

  $query27 = "SELECT valor AS POR_UVT
  FROM   PARAMETROS_NUE
  WHERE  nom_var='t_rtefte_por_pagmin'";
  $rs = $conn->Execute($query27);
			$row27 = $rs->fetchrow();
			$POR_UVT = $row27['POR_UVT'];

//Se Halla el valor excedente de UVT's maximo a deducir

  $query28 = "SELECT valor AS VALOR_EXC
   FROM   PARAMETROS_NUE
  WHERE  nom_var='t_rtefte_vlr_pagmin'";
   $rs = $conn->Execute($query28);
			$row28 = $rs->fetchrow();
			$VALOR_EXC = $row28['VALOR_EXC'];

//Se debe hallar el limite maximo de la tabla de minimos

$query29 = "SELECT MAX(ran_inf) AS LIM_MAX
       FROM   PAGOMIN_RF
      WHERE  ano = $ano";
			$rs = $conn->Execute($query29);
			$row29 = $rs->fetchrow();
			$LIM_MAX = $row29['LIM_MAX'];
			
			
			//$LIM_MAX = '1136.9201';
/*echo '</br> variable $POR_UVT '.$POR_UVT .'</br>';
echo 'variable $BASE_PM'.$BASE_PM .'</br>';
echo 'variable $VALOR_EXC'.$VALOR_EXC .'</br>';
echo 'variable $LIM_MAX'.$LIM_MAX .'</br>';*/
if ($BASE_PM/$uvt >= $LIM_MAX){
    
     $RETENCION_PM = (($POR_UVT/100)*($BASE_PM/$uvt))- $VALOR_EXC;
     $RETENCION_PM = $RETENCION_PM*$uvt;
	// echo '</br> variable $RETENCION_PM1 '.$RETENCION_PM .'</br>';
}else{
           $query30 = "SELECT round ((POR_RTE * $uvt),0) AS RETENCION_PM
            FROM PAGOMIN_RF
            WHERE ANO = $ano
            AND  $BASE_PM/$uvt  between RAN_INF AND RAN_SUP";
			$rs = $conn->Execute($query30);
			$row30 = $rs->fetchrow();
			$RETENCION_PM = $row30['RETENCION_PM'];
			 //echo '</br> variable $RETENCION_PM2 '.$RETENCION_PM .'</br>';
			//$RETENCION_PM = 0;
}

//El resultado final de las celdas H34 y H35 se define de la siguiente manera

if ($declarenta == 'Si'){
 //echo '</br> DECLARANTE SI '.'</br>';
                 if ($RETENCION > $RETENCION_PM){
                          $valorra = $RETENCION;
                          $valorsa = 0;
				 }else{
                         $valorra = 0;
                         $valorsa = $RETENCION_PM;
				 }
}else{
	//echo '</br> DECLARANTE NO '.'</br>';
    $valorra = $RETENCION;
    $valorsa =0;
	/*echo '</br> retencion'.$valorra.'</br>';
	echo '</br> retencion_pm'.$valorsa.'</br>';*/
}

//-- Netos

$netoa = $valora+$valorb+$valorc+$valord+$valore-$valorn-$valorl-$valoro-$valorp-$valorq-$valorr-$valors-$valort;

$netob = $salario+$ingresosala+$auxilio+$prima+$auxiliotrans-$pensionvol-$aporterent-$valoroa-$valorpa-$valorqa-$valorra-$valorsa-$otrasdeduc;

$valorm = (($valora+$valorb+$valorc+$valorg)*30/100)-$valorp-$valorq;
if ($procedireten == 2){
    $valorma =(($salario+$ingresosala+$auxilio+$prima+$bigpassrete)*0.30)-$valorpa-$valorqa;
}
else{
	$valorma =(($salario+$ingresosala+$auxilio+$bigpassrete)*0.30)-$valorpa-$valorqa;
}
-//$valorma =(($salario+$ingresosala+$auxilio+$bigpassrete)*0.30)-$valorpa-$valorqa;
/*
	 */
///////////////////// QUERYS PARA EL MAIN... ///////////////////////////

//--AFILIACIONES - SEGURIDAD SOCIAL BASICO
$query260 = "SELECT C.NOM_COM as NOMBRE FROM empleados_gral E,  compensacion C
WHERE E.COD_EPL ='$ididen'
AND C.COD_COM = E.COMFENA";
$rs260 = $conn->Execute($query260);	
$row260 = $rs260->fetchrow();
$caja = "Caja de compensación";

@$tablaW.='<tr>
			<td>'.mb_convert_case($caja, MB_CASE_TITLE, "UTF-8").'</td>
			<td>'.mb_convert_case($row260["NOMBRE"], MB_CASE_TITLE, "UTF-8").'</td>
		</tr>'; 		//---QUERY PARA LA CAJA DE COMPENSACION---//
		
$query100 = "SELECT C.NOM_CON AS CONCEPTO, F.NOMBRE AS NOMBRE,E.FEC_ING AS FECHA FROM EPL_FONDOS E, CONCEPTOS C, FONDOS F
WHERE E.COD_EPL ='$ididen'
AND E.COD_CON = C.COD_CON
AND E.COD_FON = F.COD_FON
AND E.COD_CON IN (2001, 2002,2004, 1020)
AND E.FEC_RET IS NULL
AND E.FEC_TRAS IS NULL";
$rs100 = $conn->Execute($query100);
	while($row100 = $rs100->fetchrow()){

	  @$tablaa.='<tr>
        <td>'.mb_convert_case($row100["CONCEPTO"], MB_CASE_TITLE, "UTF-8").'</td>
        <td>'.mb_convert_case($row100["NOMBRE"], MB_CASE_TITLE, "UTF-8").'</td>
        <td>'.date("d-m-Y",strtotime($row100["FECHA"])).'</td>
      </tr>';	  
	}
	
	//--AFILIACIONES - SEGURIDAD SOCIAL INTEGRALES

$query160 = "SELECT C.NOM_CON AS CONCEPTO, F.NOMBRE AS NOMBRE,E.FEC_ING AS FECHA FROM EPL_FONDOS E, CONCEPTOS C, FONDOS F
WHERE E.COD_EPL ='$ididen'
AND E.COD_CON = C.COD_CON
AND E.COD_FON = F.COD_FON
AND E.COD_CON IN (2001, 2002,2004)
AND E.FEC_RET IS NULL
AND E.FEC_TRAS IS NULL";
$rs160 = $conn->Execute($query160);
	while($row160 = $rs160->fetchrow()){

	  @$tablaz.='<tr>
        <td>'.mb_convert_case($row160["CONCEPTO"], MB_CASE_TITLE, "UTF-8").'</td>
        <td>'.mb_convert_case($row160["NOMBRE"], MB_CASE_TITLE, "UTF-8").'</td>
        <td>'.date("d-m-Y",strtotime($row160["FECHA"])).'</td>
      </tr>';	  
	}
	
	//--APORTES VOLUNTARIOS

$query101 = "SELECT C.NOM_CON AS CONCEPTO, F.NOMBRE AS NOMBRE, E.POR_ADI AS VALOR FROM EPL_FONDOS E, CONCEPTOS C, FONDOS F
WHERE E.COD_EPL ='$ididen'
AND E.COD_CON = C.COD_CON
AND E.COD_FON = F.COD_FON
AND E.COD_CON IN (2025,2038,2039, 2044, 2052, 2054)
AND E.POR_ADI >0
AND E.FEC_RET IS NULL
AND E.FEC_TRAS IS NULL";
$rs101 = $conn->Execute($query101);
	while($row101 = $rs101->fetchrow()){

	  @$tablab.='<tr>
        <td class="titulosb">'.mb_convert_case($row101["CONCEPTO"], MB_CASE_TITLE, "UTF-8").'</td>
        <td class="titulosb">'.mb_convert_case($row101["NOMBRE"], MB_CASE_TITLE, "UTF-8").'</td>
        <td class="titulosb">$ '.number_format($row101["VALOR"]).'</td>
      </tr>';	  
	}
	
	//--DEDUCIBLES

$query102 = "SELECT case when c.tipo ='V' then 'Vivienda'
when c.tipo ='S' then 'Salud Prepagada'
when c.tipo ='D' then 'Dependientes'
when c.tipo ='E' then 'Salud Obligatoria' end TIPO,
NVL(MAX(c.vlr_men),0) VALOR, c.FECHA VIGENCIA 
FROM CERTIFICADOS c, EMPLEADOS_BASIC E, PERIODOS P
WHERE c.cod_epl='$ididen'
AND c.cod_epl = e.cod_epl
AND e.tip_pago = p.tip_per
and e.fec_ult_nom between p.fec_ini and p.fec_fin
AND c.fecha>=p.fec_ini
AND c.tipo in ('V', 'S','E', 'D')
group by c.TIPO, c.VALOR, c.FECHA";
$rs102 = $conn->Execute($query102);
	while($row102 = $rs102->fetchrow()){

	  @$tablac.='<tr>
        <td>'.mb_convert_case($row102["TIPO"], MB_CASE_TITLE, "UTF-8").'</td>
        <td>'.number_format($row102["VALOR"]).'</td>
        <td>'.date("d-m-Y",strtotime($row102["VIGENCIA"])).'</td>
      </tr>';	  
	}
	
	
	
	//--Vacaciones Disponibles
	
$qry5="SELECT FEC_INI_PER AS FEC_INI_PERIODO, FEC_FIN_PER AS FEC_FIN_PERIODO, DIAS AS DIAS_PENDIENTE , 'PENDIENTE' AS PENDIENTE 
FROM VACACIONES_PENDIENTES WHERE COD_EPL ='$ididen'
ORDER BY FEC_INI_PER
";

$res5= $conn->Execute($qry5); 

if($res5){
	
	while($row5 = $res5->FetchRow()){

			$sumatotaldias += $row5["DIAS_PENDIENTE"];
	}
};
$sumatotaldias;


//CRONO

$query154 = "
select fec_cie AS CIERRE, fec_pag AS PAGO from  cierre_novpag c, 
(select 
   case when (case when  to_date(sysdate, 'YY-MM-DD') > p.fec_fin 
                then c.cod_per+1         
                 else c.cod_per end ) >12 then 1 
        else 
             (case when  to_date(sysdate, 'YY-MM-DD') > p.fec_fin 
                then c.cod_per+1         
                else c.cod_per end )
     end cod_per,
     
   case when (case when  to_date(sysdate, 'YY-MM-DD') > p.fec_fin  
              then c.cod_per+1  
              else c.cod_per end) >12 
        then c.ano+1 
        else c.ano end ano
from cierre_novpag c, periodos p
where to_date(sysdate, 'YY-MM-DD') between p.fec_ini and p.fec_fin
and c.ano =p.ano
and c.cod_per = p.cod_per
and p.tip_per = 3 ) b
where c.cod_per = b.cod_per 
and c.ano = b.ano";
$rs154 = $conn->Execute($query154);
$row154 = $rs154->fetchrow();

	  
$row154["CIERRE"];	
$row154["PAGO"];		  
	
	date_default_timezone_set('Europe/Madrid');
setlocale(LC_TIME, 'spanish');
$fecha = strftime(" %A, %d de %B de %Y",strtotime($row154["CIERRE"]));

//-- VALIDACION TIPO EMPLEADOS

$query156 = "select count(e.cod_epl) AS VALOR from empleados_basic e, epl_grupos g
where e.cod_epl = g.cod_epl and g.cod_gru in(3,5)
and e.estado ='A'
and e.cod_epl = '$ididen'";

$rs156 = $conn->Execute($query156);
	$row156 = $rs156->fetchrow();

if($row156["VALOR"]==0){
	 @$empleadovalida='ok';	 
	 $_SESSION['count'] = $row156["VALOR"]; 
}else {
	@$empleadovalida= 'aprendiz';
	$_SESSION['count'] = $row156["VALOR"]; 
}


//-- Cuota máxima disponible de descuento

$query157 = "select VALOREND AS VALOREND from cap_endeudamiento where cod_epl = '$ididen' order by ano desc, mes desc";

$rs157 = $conn->Execute($query157);
	$row157 = $rs157->fetchrow();
	 @$VALOREND= $row157["VALOREND"]; 

?>