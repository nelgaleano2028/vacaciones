<?php 
session_start();
require_once('../html2pdf/html2pdf.class.php');
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');


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

//validacion bd 
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
$empresamail='FUNDACION';
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
$empresamail='CONFIDENCIAL';
}
if(isset($rowa['CONTEO'])){
$conn = $config;
$empresamail='TELMOVIL';
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
$empresamail='TGT';
}
//------------------------------FIN antidoto
//require_once('../pjmail/pjmail.class.php'); 

/*
 *libreria para enviar correos electronicos 
 */
require_once("class_mailer.php");


global $conn,$odbc;

$sql = "INSERT INTO CLICKS (TABLA, CLICK, FECHA) VALUES ('CERTIFICADO DE INGRESOS Y RETENCION','1',SYSDATE)";
$conn->Execute($sql);

$anio_formu=$_POST['anio'];


$qry1="SELECT H.CONSEC AS NUM_FOR_4, H.NIT_EMP AS NIT_5 , H.DIG_VER AS DV_6, H.NOM_EMP AS EMPRESA_11,
CASE WHEN E.TIPO_DOC = 'T' THEN '12' 
     WHEN E.TIPO_DOC ='E'  THEN '22' 
     ELSE '13' END AS TIPO_24, 
H.CEDULA AS CEDULA_25,
 H.APELLIDO AS APELLIDOS_26,H.NOMBRE AS NOMBRES_28, H.FEC_INI AS FECHA_INICIO_30, H.FEC_FIN AS FECHA_FIN_31, 
FEC_EXP AS FECHA_EXPEDICION_32, NOM_CIU AS LUGAR_EXPEDICION_33,SALARIOGR SALARIOS_37, CESANTIASGR CESANTIAS_38,
0 AS GASTOSREPRE_39, 0 AS PENSIONES_40, OTROSGR OTROS_ING_41, 
(SALARIOGR+ CESANTIASGR+OTROSGR) TOTAL_ING_42, H.APO_SAL AS APOR_SALUD_43, H.VSAPESO AS PENSION_SOLIDARIDAD_44,
H.VVOPAFC AS VOLUNTARIAS_45, H.VLRRTE AS RETENCION_46 
 from HIST_CERTRTEFTE H, EMPLEADOS_BASIC E 
 WHERE H.ANOCERTI = '".$anio_formu."'
 AND H.COD_EPL = '".@$_SESSION['cod']."'
 AND H.COD_EPL = E.COD_EPL"; 

 
 $rh1 = $conn->Execute($qry1); 

$row1 = $rh1->FetchRow();

$NUM_FOR_4=$row1["NUM_FOR_4"];
$NIT_5=$row1["NIT_5"];
$DV_6=$row1["DV_6"];
$EMPRESA_11=utf8_encode($row1["EMPRESA_11"]);
$TIPO_24=$row1["TIPO_24"];
$CEDULA_25=$row1["CEDULA_25"];

$SALARIOS_37=$row1["SALARIOS_37"];
$CESANTIAS_38=$row1["CESANTIAS_38"];


$FECHA_INICIO_30=$row1["FECHA_INICIO_30"];


$anio1=substr($FECHA_INICIO_30, 0, 4);

$mes1=substr($FECHA_INICIO_30, 5, 2);

$dia1=substr($FECHA_INICIO_30, 8, 2);


$FECHA_FIN_31=$row1["FECHA_FIN_31"];

$anio2=substr($FECHA_FIN_31, 0, 4);

$mes2=substr($FECHA_FIN_31, 5, 2);

$dia2=substr($FECHA_FIN_31, 8, 2);



$LUGAR_EXPEDICION_33=$row1["LUGAR_EXPEDICION_33"];
$GASTOSREPRE_39=$row1["GASTOSREPRE_39"];
$PENSIONES_40=$row1["PENSIONES_40"];
$OTROS_ING_41=$row1["OTROS_ING_41"];
$TOTAL_ING_42=$row1["TOTAL_ING_42"];
$APOR_SALUD_43=$row1["APOR_SALUD_43"];
$PENSION_SOLIDARIDAD_44=$row1["PENSION_SOLIDARIDAD_44"];
$VOLUNTARIAS_45=$row1["VOLUNTARIAS_45"];
$RETENCION_46=$row1["RETENCION_46"];


function cortar_caracter($cadena, $caracter = ' ') { 
  $cadena_cortada=''; // inicializamos 
  for ($i=0;$i<strlen($cadena);$i++) { 
    if ($caracter==$cadena{$i}) { 
      break;  // para salir del bucle 
    } 
    $cadena_cortada=$cadena_cortada.$cadena{$i}; 
  } 
  return $cadena_cortada; 
} 


$APELLIDOS_26=utf8_encode($row1["APELLIDOS_26"]);




@$pri_apellido=cortar_caracter($APELLIDOS_26,' ');  

@$seg_apellido=strstr($APELLIDOS_26, ' ');


$NOMBRES_28=utf8_encode($row1["NOMBRES_28"]);


@$pri_nombre=cortar_caracter($NOMBRES_28,' ');  

@$seg_nombre=strstr($NOMBRES_28, ' ');






$FECHA_EXPEDICION_32=$row1["FECHA_EXPEDICION_32"];



$anio=substr($FECHA_EXPEDICION_32, 0, 4);

$mes=substr($FECHA_EXPEDICION_32, 5, 2);

$dia=substr($FECHA_EXPEDICION_32, 8, 2);





$qry6="select * from certificado_rtefte where ano='".$anio_formu."'";

				  
$rh6 = $conn->Execute($qry6); 

$row6 = $rh6->FetchRow();


$nombreRet=$row6["NOM_EPL_FIR"];
$cedulaRet=$row6["COD_EPL_FIR"];
$ciudadRet=$row6["CIU_EXP_FIR"];



$segunda_linea=strtolower($row6["PATRIMONIO_ANO"]);
$cuarta_linea=strtolower($row6["INGRESO_ANO"]);
$quinta_linea=strtolower($row6["TARJETACRED_ANO"]);
$sexta_linea=strtolower($row6["CONSUMOS_ANO"]);
$septima_linea=strtolower($row6["CONSIGNACIONES_ANO"]);

if($anio_formu=='2012'){

$cabezote ='<page backleft="10mm" backtop="9mm" backright="10mm" backbottom="10mm"  
backimg="../imagenes/certificado2012.jpg" backimgx="center" backimgy="top" backimgw="100%" footer="page"> ';

$piedpage= '<div style="position:absolute; top:838px; left:122px; font-size:8px; background-color:white; font-weight:bold; color:gray;">'.$anio_formu.'</div>

<div style="position:absolute; top:571px; left:110px; font-size:9px; background-color:white; font-weight: bold; color:gray;">'.$anio_formu.'&nbsp;</div>

<div style="position:absolute; top:724px; left:145px; font-size:9px; background-color:green; font-weight:bold; color:white;">'.$anio_formu.'</div>

<div style="position:absolute; top:861px; left:136px; font-size:7px; background-color:white; font-weight:bold; color:gray; height:10px">'.$segunda_linea.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="position:absolute; top:854px; left:294px; font-size:7px; color:gray; font-weight:bold; height:10px"></div>


<div style="position:absolute; top:883px; left:162px; font-size:7px; background-color:white; font-weight:bold; color:gray;">'.$cuarta_linea.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>


<div style="position:absolute; top:894px; left:230px; font-size:7px; background-color:white; font-weight:bold; color:gray;">'.$quinta_linea.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>


<div style="position:absolute; top:906px; left:226px; font-size:7px; background-color:white; font-weight:bold; color:gray;">'.$sexta_linea.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>


<div style="position:absolute; top:917px; left:345px; font-size:7px; background-color:white; font-weight:bold; color:gray;">'.$septima_linea.'&nbsp;&nbsp;&nbsp;&nbsp;</div>


<div style="position:absolute; top:927px; left:388px; font-size:8px; background-color:white; font-weight:bold; color:gray;">'.$anio_formu.'</div> ';

}

if($anio_formu=='2013'){
$cabezote ='<page backleft="10mm" backtop="10mm" backright="10mm" backbottom="10mm"  
backimg="../imagenes/certificado2013.jpg" backimgx="center" backimgy="top" backimgw="100%" footer="page"> ';
}
if($anio_formu=='2014'){
$cabezote ='<page backleft="10mm" backtop="10mm" backright="10mm" backbottom="10mm"  
backimg="../imagenes/certificado2014.jpg" backimgx="center" backimgy="top" backimgw="100%" footer="page"> ';
}
if($anio_formu=='2015'){
$cabezote ='<page backleft="10mm" backtop="10mm" backright="10mm" backbottom="10mm"  
backimg="../imagenes/certificado2015.jpg" backimgx="center" backimgy="top" backimgw="100%" footer="page"> ';
}
if($anio_formu=='2016'){
$cabezote ='<page backleft="10mm" backtop="10mm" backright="10mm" backbottom="10mm"  
backimg="../imagenes/certificado2016.jpg" backimgx="center" backimgy="top" backimgw="100%" footer="page"> ';
}
if($anio_formu=='2017'){
$cabezote ='<page backleft="10mm" backtop="10mm" backright="10mm" backbottom="10mm"  
backimg="../imagenes/certificado2017.jpg" backimgx="center" backimgy="top" backimgw="100%" footer="page"> ';
}


$content = '


'.$cabezote.'



 
<div style="position:absolute; top:26px; left:400px; font-size:12px"><p>'.$NUM_FOR_4.'</p></div>  
 
 
<div style="position:absolute; top:100px; font-size:13px">'.$EMPRESA_11.'</div>  
 
<div style="position:absolute; top:52px; left:117px; font-size:13px"><p>'.$NIT_5.'</p></div>  
<div style="position:absolute; top:52px; left:192px; font-size:13px"><p>'.$DV_6.'</p></div> 
<div style="position:absolute; top:121px; left:18px; font-size:13px"><p>'.$TIPO_24.'</p></div>
<div style="position:absolute; top:114px; left:66px; font-size:13px"><p>'.$CEDULA_25.'</p></div>


<div style="position:absolute; top:114px; left:255px; font-size:13px"><p>'.@$pri_apellido.'</p></div>
<div style="position:absolute; top:114px; left:370px; font-size:13px"><p>'.@$seg_apellido.'</p></div>

<div style="position:absolute; top:114px; left:490px; font-size:13px"><p>'.@$pri_nombre.'</p></div>
<div style="position:absolute; top:114px; left:600px; font-size:13px"><p>'.@$seg_nombre.'</p></div>


 
<div style="position:absolute; top:149px; left:400px; font-size:13px"><p>'.$LUGAR_EXPEDICION_33.'</p></div>
<div style="position:absolute; top:149px; left:626px; font-size:13px"><p>11</p></div>
<div style="position:absolute; top:149px; left:660px; font-size:13px"><p>0 0 1</p></div>
<div style="position:absolute; top:165px; left:530px; font-size:13px"><p>1</p></div>


<div style="position:absolute; top:208px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($SALARIOS_37, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:224px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($CESANTIAS_38, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:240px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($GASTOSREPRE_39, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:256px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($PENSIONES_40, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:270px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($OTROS_ING_41, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:318px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($APOR_SALUD_43, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:332px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($PENSION_SOLIDARIDAD_44, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:348px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($VOLUNTARIAS_45, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:363px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($RETENCION_46, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:285px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($TOTAL_ING_42, 0, ",", ".").'</td></tr></table></div>

<div style="position:absolute; top:149px; left:282px; font-size:13px"><p>'.$anio.'</p></div>
<div style="position:absolute; top:149px; left:325px; font-size:13px"><p>'.$mes.'</p></div>
<div style="position:absolute; top:149px; left:350px; font-size:13px"><p>'.$dia.'</p></div>

<div style="position:absolute; top:149px; left:165px; font-size:13px"><p>'.@$anio2.'</p></div>
<div style="position:absolute; top:149px; left:207px; font-size:13px"><p>'.@$mes2.'</p></div>
<div style="position:absolute; top:149px; left:234px; font-size:13px"><p>'.@$dia2.'</p></div>

<div style="position:absolute; top:149px; left:20px; font-size:13px"><p>'.@$anio1.'</p></div>
<div style="position:absolute; top:149px; left:64px; font-size:13px"><p>'.@$mes1.'</p></div>
<div style="position:absolute; top:149px; left:90px; font-size:13px"><p>'.@$dia1.'</p></div>



<div style="position:absolute; top:380px; left:40px; font-size:13px"><p>SE OMITE LA FIRMA DEL CERTIFICADO DE ACUERDO AL ART. 10 DEL DECRETO 836 DE 1991</p></div>

<div style="position:absolute; top:396px; left:40px; font-size:13px"><p>'.$nombreRet.'</p></div>






'.@$piedpage.'





<page_footer></page_footer>  
</page>  ';

    
	if(isset($_POST['envio'])){
		$html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->WriteHTML($content);
	$content_PDF=$html2pdf->Output('',true);
	

	
    /*
    ------------------------------ENVIO DE COMPROBANTE EMAIL------------------------------------------------------------------
    */
       $mail = new mailer();
       //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
       $mail->AddAddress(@$_SESSION['cor']); // Esta es la dirección a donde enviamos @$_SESSION['cor']
       $mail->IsHTML(true); // El correo se envía como HTML
       $mail->Subject = "Certificado"; // Este es el titulo del email.
       $empleado=@$_SESSION['nom'].' '.@$_SESSION['ape'];
       $body = "Señor(a) ".$empleado." le enviamos su Certificado de Ingresos.<br><br><br>";
       $mail->Body = $body; // Mensaje a enviar
       $mail->AddStringAttachment($content_PDF,"certificado.pdf"); //me permite enviar archivos adjuntos sin necesidad de indicar ruta 
       $exito = $mail->Send(); // Envía el correo.
	   
	   ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$_SESSION['ced']."','".$_SESSION['nombre']."','".$_SESSION['ape']."',SYSDATE,'Recibo de Pago','".$_SESSION['cor']."','".$empresamail."')";
$conn->Execute($sqlmail);
	   
       //También podríamos agregar simples verificaciones para saber si se envió:
        if($exito){
            echo '<script>window.close();</script>';
          }else{
            echo '<script>alert("Hubo un inconveniente. Contacta a un administrador."); window.close();</script>';
          }
    /* ----------------------------------FIN DE ENVIO--------------------------------------------------------------------*/      

	}elseif(isset($_POST['ver'])){
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->WriteHTML($content);
	$html2pdf->Output('Certificado.pdf', 'I');
}
	
	

	
	
 	
 	
	
	
	
		
	
	
?>


