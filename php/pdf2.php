<?php 
session_start();
require_once('../html2pdf/html2pdf.class.php');
require_once('../lib/configdb.php');
//require_once('../pjmail/pjmail.class.php');

/*
 *libreria para enviar correos electronicos 
 */
require_once("class_mailer.php");



global $conn,$odbc;
//$anio=$_POST['anio'];

//Query que retorna la informacion de la empresa

$qry1="SELECT emp.nom_emp as NOM_EMP,emp.dir_emp as DIR_EMP,emp.nit_emp as NIT_EMP,emp.digito_ver as DIGITO_VER,ciu.cod_ciu_iss as COD_CIU_ISS,ciu.cod_dpt as COD_DPT,ciu.nom_ciu as NOM_CIU,depa.nom_dpt as NOM_DPT,tel_1 as TEL_1 
FROM empresas emp,ciudades ciu,dpto_pais depa 
WHERE emp.cod_ciu=ciu.cod_ciu
		               	AND ciu.cod_dpt=depa.cod_dpt
						AND emp.cod_emp='1'";

$rh1 = $conn->Execute($qry1); 

$row1 = $rh1->FetchRow();

$nombre_empresa=utf8_encode($row1["NOM_EMP"]);
$nit_empresa=$row1["NIT_EMP"];
$nom_ciudad=$row1["NOM_CIU"];
$cod_departamento=$row1["COD_DPT"];
$cod_ciudad=$row1["COD_CIU_ISS"];
$digito=$row1["DIGITO_VER"];



/*Selecciona los datos del empleado correspondiente
$qry2="SELECT e.cedula ced, e.ape_epl ape,
				e.nom_epl nom
 FROM  historia_liq h,conceptos c,empleados_basic e,concep_fc cyr
 WHERE  h.cod_epl between '".@$_SESSION['ced']."' and '".@$_SESSION['ced']."' 
AND h.cod_epl  in (select cod_epl 
                   from acc_empleados
                   where usuario = 'GARAGON')
			       AND  h.cod_epl = e.cod_epl
			       AND h.cod_con = c.cod_con
		           AND  h.ano = '2010'
			        AND cyr.cod_con=h.cod_con
		           GROUP BY  e.cod_dep,e.ape_epl,e.nom_epl,e.cedula,cyr.fila,
                  h.cod_epl,cyr.prc,e.cod_dep,e.cod_emp,e.cod_cc,e.cod_cc2,e.ciu_tra";
				  
$rh2 = $conn->Execute($qry2); 

$row2 = $rh2->FetchRow();

$cedula=$row2["ced"];
$apellido=$row2["ape"];
$nombre=$row2["nom"];
*/


$qry3="SELECT e.cedula as CEDULA ,sum((case when c.DEV_DED='D' then -1 else 1 end)*h.VALOR) as VLR,sum((case when c.DEV_DED='D' then 1 else 0 end)*h.VALOR) AS VLR1,cyr.fila as FIL, e.ape_epl as APE,e.nom_epl as NOM, cyr.prc as PORC,e.cod_dep as COD_DEP, e.cod_emp as COD_EMP,e.cod_cc as COD_CC,e.cod_cc2 as COD_CC2,e.ciu_tra as CIU_TRA
 FROM  historia_liq h,conceptos c,empleados_basic e,concep_fc cyr
 WHERE  h.cod_epl between '".@$_SESSION['cod']."' and '".@$_SESSION['cod']."' 
AND  h.cod_epl = e.cod_epl
			       AND h.cod_con = c.cod_con
		           AND  h.ano = '2011'
			        AND cyr.cod_con=h.cod_con
		           GROUP BY  e.cod_dep,e.ape_epl,e.nom_epl,e.cedula,cyr.fila,
                  h.cod_epl,cyr.prc,e.cod_dep,e.cod_emp,e.cod_cc,e.cod_cc2,e.ciu_tra";
				  
$rh3 = $conn->Execute($qry3); 

$valor1=0;
$valor2=0;
$valor3=0;
$valor4=0;
$valor5=0;
$valor6=0;
$valor7=0;
$valor8=0;
$valor9=0;
$valorNe1=0;
$valorNe2=0;

while($row3 = $rh3->FetchRow()){


		if($row3['FIL']==1){
			$valor1=$row3['VLR'];
		
	}

		if($row3['FIL']==2){
			$valor2=$row3['VLR'];
		
}	

		if($row3['FIL']==3){
			$valor3=$row3['VLR'];
		
		}
		

		if($row3['FIL']==4){
			$valor4=$row3['VLR'];
		
}	

		if($row3['FIL']==5){
			$valor5=$row3['VLR'];
		
}	

		if($row3['FIL']==6){
			$valorNe1=$row3['VLR'];
			$valor6=$valorNe1;
}	

		if($row3['FIL']==7){
			$valorNe2=$row3['VLR'];
			$valor7=$valorNe2;
}	

		if($row3['FIL']==8){
			$valorNe3=$row3['VLR'];
			$valor8=$valorNe3;
		
}
		if($row3['FIL']==9){
			$valorNe4=$row3['VLR'];
			$valor9=$valorNe4;
		
}

}

$sumatoria=$valor1+$valor2+$valor3+$valor4+$valor5;

$fecha_actual=date("Y  m  d");

//$qrynew="select convert(varchar(20),fecha_cert,102) as fecha_cert from certificado_rtefte where ano='2011'";

/*
$qrynew="select TO_CHAR(fecha_cert,'DD-MON-YYYY ')as FECHA_CERT from certificado_rtefte where ano='2011'";

		  
$rhnew = $conn->Execute($qrynew); 

$rownew = $rhnew->FetchRow();

$fecha_actual=$rownew["FECHA_CERT"];
*/


if($odbc=="odbc_mssql"){

$qry4="select cedula as CEDULA, ape_epl as APE_EPL,nom_epl as NOM_EPL, convert(varchar(20),ini_cto,102) as STARTTIME, convert(varchar(20),fec_ret,102) as ENDTIME  from empleados_basic where COD_EPL='".@$_SESSION['cod']."'";
}elseif($odbc=="oci8"){
$qry4="select cedula as CEDULA, ape_epl as APE_EPL,nom_epl as NOM_EPL, TO_CHAR(ini_cto,'YYYY MM DD ')as STARTTIME, TO_CHAR(fec_ret,'YYYY MM DD')as ENDTIME from empleados_basic where COD_EPL='".@$_SESSION['cod']."'";
}				  
$rh4 = $conn->Execute($qry4); 

$row4 = $rh4->FetchRow();

$fecha_ini=$row4["STARTTIME"];

$fecha_fin=$row4["ENDTIME"];


$cedula=$row4["CEDULA"];
$apellido=$row4["APE_EPL"];
$nombre=$row4["NOM_EPL"];




if($fecha_ini<"2011.01.01"){

	$fecha1="2011 &nbsp; 01 &nbsp; 01";
}else{
	$fecha1=$fecha_ini;
}


if($fecha_fin<"2011.12.31" || $fecha_fin=="NULL" || $fecha_fin=="null" ){
    
    
	$fecha2="2011 &nbsp; 12 &nbsp; 31";
    
}else{
	$fecha2=$fecha_fin;
 
}


$qry5="select tipo_doc as TIPO_DOC from empleados_basic where COD_EPL='".@$_SESSION['cod']."'";

		  
$rh5 = $conn->Execute($qry5); 

$row5 = $rh5->FetchRow();

$tipo=$row5["TIPO_DOC"];

switch($tipo){

case "C":
	$doc="13";
	break;
case "R":
	$doc="11";
	break;
case "T":
	$doc="12";
	break;
case "E":
	$doc="22";
	break;
case "N":
	$doc="31";
	break;
}

$qry6="select nom_epl_fir as NOM_EPL_FIR,cod_epl_fir as COD_EPL_FIR, ciu_exp_fir as CIU_EXP_FIR from certificado_rtefte where ano='2011'";

				  
$rh6 = $conn->Execute($qry6); 

$row6 = $rh6->FetchRow();

$nombreRet=$row6["NOM_EPL_FIR"];
$cedulaRet=$row6["COD_EPL_FIR"];
$ciudadRet=$row6["CIU_EXP_FIR"];




//Contador
$qry7="select count(*) as CANTIDAD from empleados_basic";

$random_number = rand(0,99); 
 
 				  
$rh7 = $conn->Execute($qry7); 

$row7 = $rh7->FetchRow();

$cantidad=$row7["CANTIDAD"];
 
$id=$cantidad + $random_number;


//'.$id.' contador en el primer div

$content = '
<page backleft="10mm" backtop="10mm" backright="10mm" backbottom="10mm"  
backimg="../imagenes/certificado2.jpg" backimgx="center" backimgy="top" backimgw="100%" footer="page"> 
 
<div style="position:absolute; top:26px; left:400px; font-size:12px"><p></p></div>  
 
 
<div style="position:absolute; top:103px; font-size:8px">'.$nombre_empresa.'</div>  
 
<div style="position:absolute; top:52px; left:117px; font-size:13px"><p>'.$nit_empresa.'</p></div>  
<div style="position:absolute; top:52px; left:192px; font-size:13px"><p>'.$digito.'</p></div> 
<div style="position:absolute; top:121px; left:18px; font-size:11px"><p>'.@$doc.'</p></div>
<div style="position:absolute; top:116px; left:66px; font-size:11px"><p>'.$cedula.'</p></div>

<div style="position:absolute; top:114px; left:287px; font-size:11px"><p>'.$apellido.'</p></div>
<div style="position:absolute; top:114px; left:545px; font-size:11px"><p>'.$nombre.'</p></div>
 
<div style="position:absolute; top:149px; left:400px; font-size:13px"><p>'.$nom_ciudad.'</p></div>
<div style="position:absolute; top:149px; left:626px; font-size:13px"><p>'.$cod_departamento.'</p></div>
<div style="position:absolute; top:149px; left:677px; font-size:13px"><p>'.$cod_ciudad.'</p></div>


<div style="position:absolute; top:200px; left:600px; font-size:11px"><p>'.number_format($valor1, 2, ",", ".").'</p></div>
<div style="position:absolute; top:216px; left:600px; font-size:11px"><p>'.number_format($valor2, 2, ",", ".").'</p></div>
<div style="position:absolute; top:230px; left:600px; font-size:11px"><p>'.number_format($valor3, 2, ",", ".").'</p></div>
<div style="position:absolute; top:246px; left:600px; font-size:11px"><p>'.number_format($valor4, 2, ",", ".").'</p></div>
<div style="position:absolute; top:263px; left:600px; font-size:11px"><p>'.number_format($valor5, 2, ",", ".").'</p></div>
<div style="position:absolute; top:310px; left:600px; font-size:11px"><p>'.number_format($valor6, 2, ",", ".").'</p></div>
<div style="position:absolute; top:325px; left:600px; font-size:11px"><p>'.number_format($valor7, 2, ",", ".").'</p></div>
<div style="position:absolute; top:340px; left:600px; font-size:11px"><p>'.number_format($valor8, 2, ",", ".").'</p></div>
<div style="position:absolute; top:355px; left:600px; font-size:11px"><p>'.number_format($valor9, 2, ",", ".").'</p></div>
<div style="position:absolute; top:277px; left:600px; font-size:11px"><p>'.number_format($sumatoria, 2, ",", ".").'</p></div>

<div style="position:absolute; top:149px; left:288px; font-size:13px"><p>'.$fecha_actual.'</p></div>
<div style="position:absolute; top:149px; left:29px; font-size:13px"><p>'.$fecha1.'</p></div>
<div style="position:absolute; top:149px; left:170px; font-size:13px"><p>'.$fecha2.'</p></div>

<div style="position:absolute; top:380px; left:60px; font-size:13px"><p>'.$nombreRet.'</p></div>
<div style="position:absolute; top:396px; left:60px; font-size:13px"><p>'.$cedulaRet.'</p></div>
<div style="position:absolute; top:396px; left:135px; font-size:13px"><p>'.$ciudadRet.'</p></div>

<page_footer></page_footer>  
</page>  ';

    
	if(isset($_POST['ver'])){
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->WriteHTML($content);
	$html2pdf->Output('Certificado.pdf', 'I');
}else{
	if($_POST['envio']){
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
       //También podríamos agregar simples verificaciones para saber si se envió:
        if($exito){
            echo 'true';
          }else{
            echo 'Hubo un inconveniente. Contacta a un administrador.';
          }
    /* ----------------------------------FIN DE ENVIO--------------------------------------------------------------------*/      

	
	}
}
	
?>

