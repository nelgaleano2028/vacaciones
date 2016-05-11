<?php
session_start();

include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');
require_once('../html2pdf/html2pdf.class.php');

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
$flag="profunda"; 

cartalaboral($flag);

//dentro de esta condicion se llama la conexion a la base de datos de profunda 

}
if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;

//dentro de esta condicion se llama la conexion a la base de datos de confidencial 'vip' 


$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";

$rsemp = $conn->Execute($query_emp);
$row58 = $rsemp->fetchrow();

$empresa_real = $row58['EMPRESA'];
$nit_real = $row58['NIT'];

$flag='VIP';

cartalaboral($flag, $empresa_real, $nit_real);

}
if(isset($rowa['NOM_ADMIN'])){
$conn = $config;

//dentro de esta condicion se llama la conexion a la base de datos de telmovil o telori o 'marisol' 


$query_emp = "select nom_emp as EMPRESA, nit_emp||'-'||digito_ver as NIT 
from empresas where cod_emp = 2";



$rsemp = $conn->Execute($query_emp);
$row59 = $rsemp->fetchrow();

$empresa_real = $row59['EMPRESA'];
$nit_real = $row59['NIT'];

$flag='Marisol';

cartalaboral($flag, $empresa_real, $nit_real);


}



//Codigo Steven





function cartalaboral($flag, $empresa_real, $nit_real){ 

global $conn;


if($_POST["cedula"]==null){
?> <script> alert("Ingresa una Cedula");
					close();</script> <?php 

}

if($_POST["destino"]==null){
?> <script> alert("Ingresa a quien va dirigido");
					close();</script> <?php 

}

if($_POST["cedula"]){

	$sql="select COD_EPL  from empleados_basic where cedula='".$_POST["cedula"]."' and estado='I' ORDER BY INI_CTO DESC";
		
	$res=$conn->Execute($sql);

	$row23 = $res->fetchrow();
			
	$cedula=$row23["COD_EPL"];

 	if(!$cedula){
		 
		?> <script> alert("Cedula Incorrecta");
					close();</script> <?php 
					
		exit;					
	}
				
}

$codigo=$_POST["cedula"];

if($flag=="profunda"){


$query_emp = "select p.nom_emp as EMPRESA,p.nit_emp||'-'||p.digito_ver as NIT
from empleados_basic e, empresas p
where e.cod_emp = p.cod_emp
and e.cod_epl ='".$codigo."'";


$rsemp = $conn->Execute($query_emp);
$row57 = $rsemp->fetchrow();

$empresa_real = $row57['EMPRESA'];
$nit_real = $row57['NIT'];
}


$destino=$_POST["destino"];

//Contador
$querycontador = "select count(*)+1 as CANTIDAD from log_certificados";
$rs = $conn->Execute($querycontador);
$row100 = $rs->fetchrow();
$cantidad1 = $row100['CANTIDAD'];

$cantidad2='000'.$cantidad1;


if($rowsq['VALOR']=='01/02/2015'){
	?>
<script type="text/javascript">
window.location="admin_generacion_retirados2.php";
</script>
<?php	
}

//Funcion convertir numeros a leras
function numtoletras($xcifra)
{ 
$xarray = array(0 => "Cero",
1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE", 
"DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE", 
"VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA", 
100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
);

$xcifra = trim($xcifra);
$xlength = strlen($xcifra);
$xpos_punto = strpos($xcifra, ".");
$xaux_int = $xcifra;
$xdecimales = "00";
if (!($xpos_punto === false))
   {
   if ($xpos_punto == 0)
      {
      $xcifra = "0".$xcifra;
      $xpos_punto = strpos($xcifra, ".");
      }
   $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
   $xdecimales = substr($xcifra."00", $xpos_punto + 1, 2); // obtengo los valores decimales
   }

$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
$xcadena = "";
for($xz = 0; $xz < 3; $xz++)
   {
   $xaux = substr($XAUX, $xz * 6, 6);
   $xi = 0; $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
   $xexit = true; // bandera para controlar el ciclo del While 
   while ($xexit)
      {
      if ($xi == $xlimite) // si ya llegó al límite máximo de enteros
         {
         break; // termina el ciclo
         }
   
      $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
      $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
      for ($xy = 1; $xy < 4; $xy++) // ciclo para revisar centenas, decenas y unidades, en ese orden
         {
         switch ($xy) 
            {
            case 1: // checa las centenas
               if (substr($xaux, 0, 3) < 100) // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                  {
                  }
               else
                  {
                  @$xseek = $xarray[substr($xaux, 0, 3)]; // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                  if ($xseek)
                     {
                     $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                     if (substr($xaux, 0, 3) == 100) 
                        $xcadena = " ".$xcadena."CIEN".$xsub;
                     else
                        $xcadena = " ".$xcadena." ".$xseek." ".$xsub;
                     $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                     }
                  else // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                     {
                     $xseek = $xarray[substr($xaux, 0, 1) * 100]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                     $xcadena = " ".$xcadena." ".$xseek;
                     } // ENDIF ($xseek)
                  } // ENDIF (substr($xaux, 0, 3) < 100)
               break;
            case 2: // checa las decenas (con la misma lógica que las centenas)
               if (substr($xaux, 1, 2) < 10)
                  {
                  }
               else
                  {
                  @$xseek = $xarray[substr($xaux, 1, 2)];
                  if ($xseek)
                     {
                     $xsub = subfijo($xaux);
                     if (substr($xaux, 1, 2) == 20)
                        $xcadena = " ".$xcadena."VEINTE ".$xsub;
                     else
                        $xcadena = " ".$xcadena." ".$xseek." ".$xsub;
                     $xy = 3;
                     }
                  else
                     {
                     $xseek = $xarray[substr($xaux, 1, 1) * 10];
                     if (substr($xaux, 1, 1) * 10 == 20)
                        $xcadena = " ".$xcadena." ".$xseek;
                     else  
                        $xcadena = " ".$xcadena." ".$xseek." Y";
                     } // ENDIF ($xseek)
                  } // ENDIF (substr($xaux, 1, 2) < 10)
               break;
            case 3: // checa las unidades
               if (substr($xaux, 2, 1) < 1) // si la unidad es cero, ya no hace nada
                  {
                  }
               else
                  {
                  $xseek = $xarray[substr($xaux, 2, 1)]; // obtengo directamente el valor de la unidad (del uno al nueve)
                  $xsub = subfijo($xaux);
                  $xcadena = " ".$xcadena." ".$xseek." ".$xsub;
                  } // ENDIF (substr($xaux, 2, 1) < 1)
               break;
            } // END SWITCH
         } // END FOR
         $xi = $xi + 3;
      } // ENDDO

      if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
         $xcadena.= "DE";
         
      if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
         $xcadena.= "DE";
      
      // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
      if (trim($xaux) != "")
         {
         switch ($xz)
            {
            case 0:
               if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                  $xcadena.= "UN BILLON";
               else
                  $xcadena.= " BILLONES";
               break;
            case 1:
               if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                  $xcadena.= "UN MILLON";
               else
                  $xcadena.= "MILLONES";
               break;
            case 2:
               if ($xcifra < 1 )
                  {
                  $xcadena = "CERO PESOS";
                  }
               if ($xcifra >= 1 && $xcifra < 2)
                  {
                  $xcadena = "UN PESO";
                  }
               if ($xcifra >= 2)
                  {
                  $xcadena.= "PESOS M/CTE"; // 
                  }
               break;
            } // endswitch ($xz)
         } // ENDIF (trim($xaux) != "")
      // ------------------      en este caso, para México se usa esta leyenda     ----------------
      $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
      $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles 
      $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
      $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles 
      $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
      $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
      $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
   } // ENDFOR ($xz)
   return trim($xcadena);
} // END FUNCTION



//Función que regresa un subfijo para la cifra
function subfijo($xx)
   { 
   $xx = trim($xx);
   $xstrlen = strlen($xx);
   if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
      $xsub = "";
   // 
   if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
      $xsub = "MIL";
   //
   return $xsub;
   } // END FUNCTION



//INICIO LOGICA DE CERTIFICADOS


$qra="select COD_EPL AS COD_EPL from empleados_basic where cedula= '".$codigo."' and estado='I' ORDER BY INI_CTO DESC";


$rha = $conn->Execute($qra);
$rowz = $rha->FetchRow();

$codigoemple=utf8_encode($rowz["COD_EPL"]);


//Query que retorna la informacion de la empresa

$qry1="SELECT emp.FAX, emp.NOM_EMP,emp.DIR_EMP,emp.NIT_EMP,emp.DIGITO_VER,ciu.COD_CIU_ISS,ciu.COD_DPT,ciu.NOM_CIU,depa.NOM_DPT,TEL_1 
FROM empresas emp,ciudades ciu,dpto_pais depa 
WHERE emp.cod_ciu=ciu.cod_ciu AND ciu.cod_dpt=depa.cod_dpt AND emp.cod_emp in(select cod_emp from empleados_basic where cod_epl='".$codigoemple."')";


$rh1 = $conn->Execute($qry1);
$row1 = $rh1->FetchRow();

$nombre_empresa=utf8_encode($row1["NOM_EMP"]);
$nit_empresa=$row1["NIT_EMP"];
$nom_ciudad=$row1["NOM_CIU"];
$cod_departamento=$row1["COD_DPT"];
$direccion=$row1["DIR_EMP"];
$fax=$row1["FAX"];
$telefono=$row1["TEL_1"];




//Datos del Empleado

$qry2="select c.SEXO, a.COD_CTG, NOM_EPL,APE_EPL,CEDULA,SAL_BAS,NOM_CAR,TO_CHAR(INI_CTO,'DD-MM-YYYY')as INI_CTO, TO_CHAR(FEC_RET,'DD-MM-YYYY')as FEC_RET, a.TIPO_DOC from empleados_basic a, cargos b, empleados_gral c where a.cod_car=b.cod_car and a.cod_epl=c.cod_epl and a.cod_epl='".$codigoemple."'";


$rh2 = $conn->Execute($qry2); 
$row2 = $rh2->FetchRow();


$nombre=utf8_encode($row2["NOM_EPL"]);
$apellido=utf8_encode($row2["APE_EPL"]);
$cedula=''.$row2["CEDULA"].'';
$fecha=''.$row2["INI_CTO"].''; //FEC_ING 
$fecha_retiro=''.$row2["FEC_RET"].'';
$sueldo=$row2["SAL_BAS"];
$cargo=''.utf8_encode($row2["NOM_CAR"]).'';
$sexo=$row2["SEXO"];
$categoria=$row2["COD_CTG"];

$letrasnum=''.numtoletras($sueldo).'';


$tipo_doc=$row2["TIPO_DOC"];

if($tipo_doc=='C'){
	$cadena10='c&eacute;dula de ciudadan&iacute;a';
}else if($tipo_doc=='E'){
	$cadena10='c&eacute;dula de extranjer&iacute;a';
}else if($tipo_doc=='T'){
	$cadena10='tarjeta  de identidad';
}


//FIRMA DEL CERTIFICADO LABORAL

$qry3="select * from certi_parfir c, empleados_basic e where e.cod_epl=c.cod_epl";

				  
$rh3 = $conn->Execute($qry3); 

$row3 = $rh3->FetchRow();

$codifo_firma=$row3["COD_EPL"];
$nombrefirma=$row3["NOM_EPL"];
$apellidofirma=$row3["APE_EPL"];
$cargofirma=$row3["DESC_CARGO"];



$qryold="select e.cod_epl, e.cod_cto, c.NOM_CTO from contratos c, empleados_basic e where e.cod_cto=c.cod_cto and cod_epl='".$codigoemple."'";

$rhold = $conn->Execute($qryold); 

$rowold = $rhold->FetchRow();

$contrato=$rowold["NOM_CTO"];

$diaactual=date ("d");
$mesactual=date ("n");
$anoactual=date ("Y");

$meses = array("Enero", "Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


$nombre_mes = $meses[$mesactual-1];


//OJO TEXTO MASCULINO O FEMENINO
if($sexo=="F"){

   $cadena="".$nombre." ".$apellido.""; 
//var_dump($cadena);die("wee");
}else{

   $cadena="".$nombre." ".$apellido."";
}

$qra="select COD_EPL AS COD_EPL from empleados_basic where cedula= '".$codigo."' and estado='I' ORDER BY INI_CTO DESC";


$rha = $conn->Execute($qra);
$rowz = $rha->FetchRow();

$codigoemple=utf8_encode($rowz["COD_EPL"]);

//Query para comisiones

$qrycomision="SELECT ROUND ((SUM(H.VALOR)/X.CANTIDAD), 0) AS CANTIDADES
FROM  EMPLEADOS_BASIC E, PERIODOS P,HISTORIA_LIQ H,
(SELECT E.COD_EPL,COUNT(*) AS CANTIDAD 
FROM  EMPLEADOS_BASIC E, PERIODOS P
WHERE E.COD_EPL ='".$codigoemple."'
AND E.TIP_PAGO =P.TIP_PER
AND E.COD_EMP =P.COD_EMP
AND P.FEC_INI <=E.FEC_ULT_NOM
AND DIF_FECHAS(P.FEC_INI,E.FEC_ULT_NOM,'".$codigoemple."' ,0, P.FEC_INI )/30 BETWEEN 0 AND 6
AND P.FEC_FIN >=E.FEC_ING
GROUP BY COD_EPL) X
WHERE H.COD_EPL = E.COD_EPL 
AND H.COD_EPL = X.COD_EPL
AND E.TIP_PAGO =P.TIP_PER
AND E.COD_EMP =P.COD_EMP
AND P.FEC_INI <=E.FEC_ULT_NOM
AND H.ANO = P.ANO(+)
AND H.COD_PER = P.COD_PER(+) 
AND H.COD_CON IN (1012,1086,1087,1088,1089)
AND DIF_FECHAS(P.FEC_INI,E.FEC_ULT_NOM,'".$codigoemple."' ,0, P.FEC_INI )/30 BETWEEN 0 AND 6
AND P.FEC_FIN >=E.FEC_ING
GROUP BY X.CANTIDAD";


$rhcomisiones = $conn->Execute($qrycomision);
 
$rowcomisiones = $rhcomisiones->FetchRow();

$cantidadcomision=$rowcomisiones["CANTIDADES"];


			if($cantidadcomision){ 	
					
					$letrasnum5=numtoletras($cantidadcomision);
					
					$cadena4='Adicionalmente recibe un promedio mensual de '.$letrasnum5.' ($'.number_format($cantidadcomision, 0, ",", ".").') por concepto de comisiones. '; 			
			}


//Integral  
$qry30="select * from epl_grupos where cod_gru='2' and cod_epl='".$codigoemple."'";

				  
$rh30 = $conn->Execute($qry30); 

$row30 = $rh30->FetchRow();

$integral=$row30["COD_GRU"];

//Aprendices
$qry31="select * from epl_grupos where cod_epl='".$codigoemple."' and  (cod_gru='3' or cod_gru='5')";

				  
$rh31 = $conn->Execute($qry31); 

$row31 = $rh31->FetchRow();

$aprendices=$row31["COD_GRU"];

//var_dump($aprendices);die("");

if($integral){
	
	$cadena6=' bajo la modalidad de SALARIO INTEGRAL.'; 
	$cadena7=' una asignaci&oacute;n salarial mensual';
	$cadena8='trabajo a t&eacute;rmino '.$contrato.'';

}else{
		if($aprendices){					
			
			$cadena7=' asignaci&oacute;n mensual ';
			$cadena8=''.$contrato.'';
			$cadena6=', bajo la modalidad de APOYO DE SOSTENIMIENTO.';
			
		}else{
			
			$cadena6='Bajo la modalidad de SALARIO B&Aacute;SICO.';
			$cadena7=' una asignaci&oacute;n salarial mensual';
			$cadena8='trabajo a t&eacute;rmino '.$contrato.'';
		
		}

	}

	
	$qra="select COD_EPL AS COD_EPL from empleados_basic where cedula= '".$codigo."' and estado='I' ORDER BY INI_CTO DESC";


$rha = $conn->Execute($qra);
$rowz = $rha->FetchRow();

$codigoemple=utf8_encode($rowz["COD_EPL"]);
	
$qry32="select TO_CHAR(VTO_CTO,'DD-MM-YYYY') as VTO_CTO from empleados_basic where estado='A' and cod_epl='".$codigoemple."'";
				  
$rh32 = $conn->Execute($qry32); 

$row32 = $rh32->FetchRow();

$fecha_venc=$row32["VTO_CTO"];

if($fecha_venc){

	$cadena9='hasta el '.$fecha_venc.'';

}

//BIG PASS

$qry33="select VALOR from epl_con_fijos where cod_epl='".$codigoemple."' and cod_con='1004'";

$rh33 = $conn->Execute($qry33); 

$row33 = $rh33->FetchRow();

$valor_big=$row33["VALOR"];

if($valor_big){

$letrasnum20=numtoletras($valor_big);

$cadena11='Adicionalmente recibio cheques de BIG PASS por valor de '.$letrasnum20.' ($'.number_format($valor_big, 0, ",", ".").'). Este concepto no constitu&iacute;a salario en los t&eacute;rminos del art&iacute;culo 15 de la ley 50 de 1990.';
}




if(@$_POST["certificado"]=="opcion4"){
	$content = '<page  backleft="12mm" backright="12mm">

	<STYLE type="text/css">

.justifyText{text-align:justify; font-size:12px; line-height: 20px;}

</STYLE>
	
                <table border="0" style="font-family:helvetica;">
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>

					
                   
                    		<tr>
								<td rowspan="7"><img src="../imagenes/telefonica.jpg"></td>
                        		<td align="right" style="font-size :7px;">'.$empresa_real.'</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;"> NIT. '.$nit_real.'</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">Transv. 60 (Av. Suba) No. 114 A-55</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">Bogot&aacute; D.C. - Colombia</td>
                    		</tr>
                   		 	<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">L&iacute;nea &Uacute;nica Nacional 018000361645</td>
							</tr>
							<tr>
								<td colspan="2" align="right" style="font-size :7px;">www.telefonica.co</td>
							</tr>
							<tr>
								<td colspan="2" align="right" style="font-size :7px;">Consecutivo: <span>'.$cantidad2.'</span></td>
							</tr>
					
					
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><span style="font-size:14px; font-weight:bold">Centro de Servicios Compartidos</span><br>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><span style="font-size:15px; font-weight:bold">CERTIFICACI&Oacute;N</span><br>&nbsp;</td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
                     <tr>
                         <td colspan="2" ><p CLASS="justifyText">El suscrito Gerente Centro de Servicios Compartidos certifica que '.$cadena.' con '.$cadena10.' No '.$cedula.', estuvo  vinculado(a) para la compa&ntilde;&iacute;a,  desde el '.$fecha.' hasta el '.$fecha_retiro.', con un contrato de '.$cadena8.', en el cargo de '.$cargo.' con '.$cadena7.' de '.$letrasnum.' ($<span>'.number_format($sueldo, 0, ",", ".").'</span>) '.$cadena6.' </p></td>
                    </tr>';
					
					if($cadena11!=NULL){
					$content .= '<tr>
                        		<td  colspan="2"><br></td>
                    		</tr>
					 		<tr>
                        		<td  colspan="2" CLASS="justifyText">'.@$cadena11.'</td>
                    		</tr>';
							
					}
					
					
					                                                   
                     $content.= '<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p CLASS="justifyText">La presente certificaci&oacute;n se expide a solicitud del interesado a los <span style="">'.$diaactual.'</span> dias del mes de <span style="">'.$nombre_mes.'</span> de <span style="">'.$anoactual.'</span> para ser presentado a '.$destino.'</p></td>
                    </tr>
                    	<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><p CLASS="justifyText">Para confirmar este certificado, comun&iacute;quese con la l&iacute;nea &uacute;nica nacional 018000361645.</p></td>
                    </tr>                  
                   <tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td  colspan="2" style="font-size :12px;">Cordialmente,</td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
                     <tr>
                        <td colspan="2" align="left"></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><span style="font-weight:bold; font-size :14px;">BORIS HERNANDO</span> <span style="font-weight:bold; font-size :14px;">CHIVATA CUARTAS</span><br> <span style="font-size :14px;">Gerente Centro de Servicios Compartidos</span></td>
                    </tr>
                   
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                   		
		</table>	
			
	    <page_footer></page_footer> </page>';
		
$opcion="opcion3";

$nom_certificado="Certificado con salario";

$estado='I';

$sql15="insert into log_certificados (CNSCTIVO, NOM_EPL, APL_EPL, COD_EPL, FECHA, VALUE, NOM_CERTIFICADO, DESTINO, CADENA, CEDULA, FECHA_LAB, CADENA9, CADENA8, CARGO, DIAACTUAL, NOMBRE_MES, ANOACTUAL, CADENA7, LETRASNUM, SUELDO, CADENA6, CADENA11, CADENA10, FECHA_RET, ESTADO, EMPRESA, NIT) values('".$cantidad2."','".$nombre."','".$apellido."','".$codigo."',SYSDATE, '".$opcion."', '".$nom_certificado."','".$destino."','".$cadena."','".$cedula."','".$fecha."','".$cadena9."','".$cadena8."','".$cargo."','".$diaactual."','".$nombre_mes."','".$anoactual."','".strip_tags($cadena7)."','".$letrasnum."','".$sueldo."','".strip_tags($cadena6)."','".strip_tags($cadena11)."','".$cadena10."','".$fecha_retiro."', '".$estado."', '".$empresa_real."', '".$nit_real."')";
	
$conn->Execute($sql15);

}
else{   if(@$_POST["certificado"]=="opcion2"){
			
			$content = '<page  backleft="12mm" backright="12mm">

			<STYLE type="text/css">

.justifyText{text-align:justify; font-size:12px; line-height: 20px;}

</STYLE>
			
                <table border="0" style="font-family:helvetica;">
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>

					
					
                    
                    		<tr>
								<td rowspan="7"><img src="../imagenes/telefonica.jpg"></td>
                        		<td align="right" style="font-size :7px;">'.$empresa_real.'</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;"> NIT. '.$nit_real.'</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">Transv. 60 (Av. Suba) No. 114 A-55</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">Bogot&aacute; D.C. - Colombia</td>
                    		</tr>
                   		 	<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">L&iacute;nea &Uacute;nica Nacional 018000361645</td>
							</tr>
							<tr>
								<td colspan="2" align="right" style="font-size :7px;">www.telefonica.co</td>
							</tr>
							<tr>
								<td colspan="2" align="right" style="font-size :7px;">Consecutivo: <span>'.$cantidad2.'</span></td>
							</tr>
					
					
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><span style="font-size:14px; font-weight:bold">Centro de Servicios Compartidos</span><br>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><span style="font-size:15px; font-weight:bold">CERTIFICACI&Oacute;N</span><br>&nbsp;</td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                         <td colspan="2" ><p CLASS="justifyText">El suscrito Gerente Centro de Servicios Compartidos certifica que '.$cadena.' con '.$cadena10.' No '.$cedula.', estuvo  vinculado(a) para la compa&ntilde;&iacute;a, desde el '.$fecha.' hasta el '.$fecha_retiro.', con un contrato de '.$cadena8.', en el cargo de '.$cargo.'.</p></td></tr>'; 
					
			                                
                  $content .= '<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p CLASS="justifyText">La presente certificaci&oacute;n se expide a solicitud del interesado a los <span style="">'.$diaactual.'</span> dias del mes de <span style="">'.$nombre_mes.'</span> de <span style="">'.$anoactual.'</span> para ser presentado a '.$destino.'</p></td>
                    </tr>
                    	<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><p CLASS="justifyText">Para confirmar este certificado, comun&iacute;quese con la l&iacute;nea &uacute;nica nacional 018000361645.</p></td>
                    </tr>                  
                    <tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size :12px;>Cordialmente,</td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
                     <tr>
                        <td colspan="2" align="left"><img src="../imagenes/firma.jpg"></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><span style="font-weight:bold; font-size :14px;">BORIS HERNANDO</span> <span style="font-weight:bold; font-size :14px;">CHIVATA CUARTAS</span><br> <span style="font-size :14px;">Gerente Centro de Servicios Compartidos</span></td>
                    </tr>
                   
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                   		
		</table>	
			
	    <page_footer></page_footer> </page>';
		
$opcion="opcion2";

$nom_certificado="Certificado sin salario";

$estado='I';

$sql15="insert into log_certificados (CNSCTIVO, NOM_EPL, APL_EPL, COD_EPL, FECHA, VALUE, NOM_CERTIFICADO, DESTINO, CADENA, CEDULA, FECHA_LAB, CADENA9, CADENA8, CARGO, DIAACTUAL, NOMBRE_MES, ANOACTUAL, CADENA10, FECHA_RET, ESTADO, EMPRESA, NIT) values('".$cantidad2."','".$nombre."','".$apellido."','".$codigo."',SYSDATE, '".$opcion."', '".$nom_certificado."','".$destino."','".$cadena."','".$cedula."','".$fecha."','".$cadena9."','".$cadena8."','".$cargo."','".$diaactual."','".$nombre_mes."','".$anoactual."','".$cadena10."','".$fecha_retiro."', '".$estado."', '".$empresa_real."', '".$nit_real."')";
	
$conn->Execute($sql15);

}
else{  if(@$_POST["certificado"]=="opcion1"){
			
			$parrafo= '<p style="text-align:justify; width:300px; font-size:12px; line-height: 20px;">El suscrito Gerente Centro de Servicios Compartidos certifica que '.$cadena.' con '.$cadena10.' No '.$cedula.', estuvo  vinculado(a) para la compa&ntilde;&iacute;a, desde el '.$fecha.' hasta el '.$fecha_retiro.', con un contrato de '.$cadena8.', en el cargo de '.$cargo.'.</p>';
			
			
			$content = '<page  backleft="12mm" backright="12mm">

			<STYLE type="text/css">

.justifyText{text-align:justify; font-size:12px; line-height: 20px;}

</STYLE>
			
                <table border="0" width="10px" style="font-family:helvetica;">
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>

					
					
                   
                    		<tr>
								<td rowspan="7"><img src="../imagenes/telefonica.jpg"></td>
                        		<td align="right" style="font-size :7px;">'.$empresa_real.'</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;"> NIT. '.$nit_real.'</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">Transv. 60 (Av. Suba) No. 114 A-55</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">Bogot&aacute; D.C. - Colombia</td>
                    		</tr>
                   		 	<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">L&iacute;nea &Uacute;nica Nacional 018000361645</td>
							</tr>
							<tr>
								<td colspan="2" align="right" style="font-size :7px;">www.telefonica.co</td>
							</tr>
							<tr>
								<td colspan="2" align="right" style="font-size :7px;">Consecutivo: <span>'.$cantidad2.'</span></td>
							</tr>
					
					
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><span style="font-size:14px; font-weight:bold">Centro de Servicios Compartidos</span><br>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><span style="font-size:15px; font-weight:bold">CERTIFICACI&Oacute;N</span><br>&nbsp;</td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                         <td colspan="2">
						   '.$parrafo.'						    
						  </td>
				     </tr>'; 
					
			                                
                  $content .= '<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p CLASS="justifyText">La presente certificaci&oacute;n se expide a solicitud del interesado a los <span style="">'.$diaactual.'</span> dias del mes de <span style="">'.$nombre_mes.'</span> de <span style="">'.$anoactual.'</span> para ser presentado a '.$destino.'</p></td>
                    </tr>
                    	<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><p CLASS="justifyText">Para confirmar este certificado, comun&iacute;quese con la l&iacute;nea &uacute;nica nacional 018000361645.</p></td>
                    </tr>                  
                    <tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr> 
                    <tr>
                        <td colspan="2" style="font-size :12px;>Cordialmente,</td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
                     <tr>
                        <td colspan="2" align="left"></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><span style="font-weight:bold; font-size :14px;">BORIS HERNANDO</span> <span style="font-weight:bold; font-size :14px;">CHIVATA CUARTAS</span><br> <span style="font-size :14px;">Gerente Centro de Servicios Compartidos</span></td>
                    </tr>
                   
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                   		
		</table>	
			</page>
	   
			';
$opcion="opcion2";

$nom_certificado="Certificado sin salario";

$estado='I';



$sql15="insert into log_certificados (CNSCTIVO, NOM_EPL, APL_EPL, COD_EPL, FECHA, VALUE, NOM_CERTIFICADO, DESTINO, CADENA, CEDULA, FECHA_LAB, CADENA9, CADENA8, CARGO, DIAACTUAL, NOMBRE_MES, ANOACTUAL, CADENA10, FECHA_RET, ESTADO, EMPRESA, NIT) values('".$cantidad2."','".$nombre."','".$apellido."','".$codigo."',SYSDATE, '".$opcion."', '".$nom_certificado."','".$destino."','".$cadena."','".$cedula."','".$fecha."','".$cadena9."','".$cadena8."','".$cargo."','".$diaactual."','".$nombre_mes."','".$anoactual."','".$cadena10."','".$fecha_retiro."', '".$estado."', '".$empresa_real."', '".$nit_real."')";

$conn->Execute($sql15);

//var_dump($content);die("bn2");

}
else{ if(@$_POST["certificado"]=="opcion3"){
		$content = '<page  backleft="12mm" backright="12mm">
		
		<STYLE type="text/css">

.justifyText{text-align:justify; font-size:12px; line-height: 20px;}

</STYLE>

                <table border="0" style="font-family:helvetica; ">
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>

					
					
                    
                    		<tr>
								<td rowspan="7"><img src="../imagenes/telefonica.jpg"></td>
                        		<td align="right" style="font-size :7px;">'.$empresa_real.'</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;"> NIT. '.$nit_real.'</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">Transv. 60 (Av. Suba) No. 114 A-55</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">Bogot&aacute; D.C. - Colombia</td>
                    		</tr>
                   		 	<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">L&iacute;nea &Uacute;nica Nacional 018000361645</td>
							</tr>
							<tr>
								<td colspan="2" align="right" style="font-size :7px;">www.telefonica.co</td>
							</tr>
							<tr>
								<td colspan="2" align="right" style="font-size :7px;">Consecutivo: <span>'.$cantidad2.'</span></td>
							</tr>
					
					
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><span style="font-size:14px; font-weight:bold">Centro de Servicios Compartidos</span><br>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><span style="font-size:15px; font-weight:bold">CERTIFICACI&Oacute;N</span><br>&nbsp;</td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                         <td colspan="2"><p CLASS="justifyText">El suscrito Gerente Centro de Servicios Compartidos certifica que '.$cadena.' con '.$cadena10.' No '.$cedula.', estuvo vinculado(a) para la compa&ntilde;&iacute;a, desde el '.$fecha.' hasta el '.$fecha_retiro.', con un contrato de '.$cadena8.', en el cargo de '.$cargo.' con '.$cadena7.' de '.$letrasnum.' ($<span style="">'.number_format($sueldo, 0, ",", ".").'</span>) '.$cadena6.'</p></td>
                    </tr>';
					
					if($cadena11!=NULL){
					$content .= '<tr>
                        		<td  colspan="2"><br></td>
                    		</tr>
					 		<tr>
                        		<td  colspan="2" CLASS="justifyText">'.@$cadena11.'</td>
                    		</tr>';
							
					}
					
			
					
					
					                                                   
                     $content.= '<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p CLASS="justifyText">La presente certificaci&oacute;n se expide a solicitud del interesado a los <span style="">'.$diaactual.'</span> dias del mes de <span style="">'.$nombre_mes.'</span> de <span style="">'.$anoactual.'</span> para ser presentado a '.$destino.'</p></td>
                    </tr>
                    	<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><p CLASS="justifyText">Para confirmar este certificado, comun&iacute;quese con la l&iacute;nea &uacute;nica nacional 018000361645.</p></td>
                    </tr>                  
                    <tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr> 
                    <tr>
                        <td  colspan="2" style="font-size :12px;">Cordialmente,</td>
                    </tr>

                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
					<tr>
                        <td colspan="2"><br></td>
                    </tr>
                     <tr>
                        <td colspan="2" align="left"><img src="../imagenes/firma.jpg"></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><span style="font-weight:bold; font-size :14px;">BORIS HERNANDO</span> <span style="font-weight:bold; font-size :14px;">CHIVATA CUARTAS</span><br> <span style="font-size :14px;">Gerente Centro de Servicios Compartidos</span></td>
                    </tr>
                   
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                   		
		</table>	
			
	    <page_footer></page_footer> </page>';


$opcion="opcion3";

$nom_certificado="Certificado con salario";

$estado='I';

$sql15="insert into log_certificados (CNSCTIVO, NOM_EPL, APL_EPL, COD_EPL, FECHA, VALUE, NOM_CERTIFICADO, DESTINO, CADENA, CEDULA, FECHA_LAB, CADENA9, CADENA8, CARGO, DIAACTUAL, NOMBRE_MES, ANOACTUAL, CADENA7, LETRASNUM, SUELDO, CADENA6, CADENA11, CADENA10, FECHA_RET, ESTADO, EMPRESA, NIT) values('".$cantidad2."','".$nombre."','".$apellido."','".$codigo."',SYSDATE, '".$opcion."', '".$nom_certificado."','".$destino."','".$cadena."','".$cedula."','".$fecha."','".$cadena9."','".$cadena8."','".$cargo."','".$diaactual."','".$nombre_mes."','".$anoactual."','".strip_tags($cadena7)."','".$letrasnum."','".$sueldo."','".strip_tags($cadena6)."','".strip_tags($cadena11)."','".$cadena10."','".$fecha_retiro."', '".$estado."', '".$empresa_real."', '".$nit_real."')";
	
$conn->Execute($sql15);
	
}else{
?>
    <script language='javascript'>
      alert("Ingrese una Opcion Valida");
     close();
    </script>
<?php
}//else ingrese opcion valida
}//primer else
}
}//else de esta condicion grande




	 //ob_clean();
     //var_dump($content);die("bn4");
	 
	 $content2="esto es otra pruebar";
	
	$html2pdf = new HTML2PDF('P','A4','en');
	ob_clean();
	
    $html2pdf->WriteHTML($content);
	
	$html2pdf->Output('Certificado_Laboral.pdf', 'I');
	
	
    
	
	
		
	
	}
	
?>
