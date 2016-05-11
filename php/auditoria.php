<?php
@session_start();

include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
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

if(isset($rowf['NOM_ADMIN'])){
$conn = $configf;
}
if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;
}
if(isset($rowa['NOM_ADMIN'])){
$conn = $config;
}




/*
require_once('../html2pdf/html2pdf.class.php');
require_once('../lib/configdb.php');
*/

//global $conn;

$value=$_GET['value'];
$codigo=$_GET['cod_epl'];



$cnsctivo=$_GET['cns'];
$cantidad2=$cnsctivo;





$qry1="SELECT  NOM_EPL, APL_EPL, COD_EPL, FECHA, VALUE, NOM_CERTIFICADO, DESTINO, CADENA, 
CEDULA, FECHA_LAB, CADENA9, CADENA8, CARGO, DIAACTUAL, NOMBRE_MES, ANOACTUAL, CADENA7, LETRASNUM, SUELDO, 
CADENA6, CADENA4, CADENA11, CADENA10, FECHA_RET, ESTADO, EMPRESA, NIT
FROM log_certificados
where cnsctivo='".$cnsctivo."' and cod_epl='".$codigo."'";

//var_dump($qry1);die();

//var_dump($qry1);die();
$rh1 = $conn->Execute($qry1);
$row1 = $rh1->FetchRow();

$nombre=utf8_encode($row1["NOM_EPL"]);
$apellido=utf8_encode($row1["APL_EPL"]);
$codigo=$row1["COD_EPL"];
$fecha_generacion=$row1["FECHA"];
//$value=$row1["VALUE"];
$nom_certificado=utf8_encode($row1["NOM_CERTIFICADO"]);

$destino=utf8_encode($row1["DESTINO"]);
$cadena=$row1["CADENA"];
$cedula=$row1["CEDULA"];
$fecha=$row1["FECHA_LAB"];
$cadena9=$row1["CADENA9"];
$cadena8=$row1["CADENA8"];
$cargo=utf8_encode($row1["CARGO"]);
$diaactual=$row1["DIAACTUAL"];
$nombre_mes=$row1["NOMBRE_MES"];
$anoactual=$row1["ANOACTUAL"];
$cadena7=$row1["CADENA7"];
$letrasnum=$row1["LETRASNUM"];
$cadena8=$row1["CADENA8"];
$sueldo=$row1["SUELDO"];
$cadena6=$row1["CADENA6"];
$cadena4=$row1["CADENA4"];

$cadena11=$row1["CADENA11"];
$cadena10=$row1["CADENA10"];
$fecha_retiro=$row1["FECHA_RET"];
$estado=$row1["ESTADO"];
$empresa_real=$row1["EMPRESA"];
$nit_real=$row1["NIT"];

//var_dump($estado);die("");
//var_dump($qry1);die();


$cadena4="<span style='font-size:13px; line-height: 20px;'>$cadena4</span>";
$cadena6="<span style='font-size:13px; line-height: 20px;'>$cadena6</span>";
$cadena7="<span style='font-size:13px; line-height: 20px;'>$cadena7</span>";
$cadena11="<span style='font-size:13px; line-height: 20px;'>$cadena11</span>"; 

//opcion2 sin salario

if(@$value=="opcion2" and $estado=='A'){
	$content = '<page  backleft="12mm" backright="12mm">

                <table border="0" style="font-family:helvetica;">
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
								<td rowspan="7"><img src="../imagenes/telefonica.jpg"></td>
                        		<td align="right" style="font-size :7px;">'.$empresa_real.'</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">NIT. '.$nit_real.'</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">Transv. 60 (Av. Suba) No. 114 A-55</td>
                    		</tr>
                    		<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">Bogot&aacute; D.C. - Colombia</td>
                    		</tr>
                   		 	<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">Tel. 7050000 EXT. 71313-76729-78588</td>
							</tr>
							<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">78590-76297-78583-72157</td>
							</tr>
							<tr>
								<td colspan="2" align="right" style="font-size :7px;">www.telefonica.co</td>
							</tr>
							<tr>
								<td colspan="2" align="right" style="font-size :7px;">Consecutivo: <span>'.$cantidad2.'</span></td>
							</tr>';
					
					
                   $content.= '<tr>
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
                    </tr>';
					
                  $content.= ' <tr>
                         <td colspan="2" align="justify"><span style="font-size:13px; line-height: 20px;">El suscrito Gerente de Servicios Econ&oacute;micos certifica que '.$cadena.' con '.$cadena10.' No '.$cedula.', labora para la compa&ntilde;&iacute;a, desde el '.$fecha.' '.@$cadena9.', con un contrato de '.$cadena8.', en el cargo de '.$cargo.'.</span></td>	 </tr>				
			                               
                  <tr>
                        <td colspan="2"><br></td>
                    </tr>';
					
					
                   $content.= '<tr>
					<td colspan="2"><span style="font-size:13px; line-height: 20px;">La presente certificaci&oacute;n se expide a solicitud del interesado a los <span style="font-weight: bold">'.$diaactual.'</span> dias del mes de <span style="font-weight: bold">'.$nombre_mes.'</span> de <span style="font-weight: bold">'.$anoactual.'</span>  para ser presentado
				   a <span style="font-weight: bold">'.$destino.'</span>. </span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>                  
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>                  
                    
                    <tr>
                        <td colspan="2" style="font-size :14px;>Cordialmente,</td>
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
                        <td  colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>';
					
                     $content.= '<tr>
                        <td colspan="2" align="left"><img src="../imagenes/firma.jpg"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><span style="font-weight:bold; font-size :14px;">GLORIA LUCIA</span> <span  style="font-weight:bold; font-size :14px;">SEGURA VASQUEZ</span><br> <span style="font-size :14px;">Gerente de Servicios Econ&oacute;micos</span></td>
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
			


}else  if(@$value=="opcion3" and $estado=='A'){
		$content = '<page  backleft="12mm" backright="12mm">

                <table border="0" style="font-family:helvetica;">
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
                        <td  colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
						<td rowspan="7"><img src="../imagenes/telefonica.jpg"></td>
                        <td align="right" style="font-size :7px;">'.$empresa_real.'</td>
                    </tr>
                    <tr>
                        <td  colspan="2" align="right" style="font-size :7px;"> NIT. '.$nit_real.'</td>
                    </tr>
                    <tr>
                        <td  colspan="2" align="right" style="font-size :7px;">Transv. 60 (Av. Suba) No. 114 A-55</td>
                    </tr>
                    <tr>
                        <td  colspan="2" align="right" style="font-size :7px;">Bogot&aacute; D.C. - Colombia</td>
                    </tr>
                    <tr>
                        <td  colspan="2" align="right" style="font-size :7px;">Tel. 7050000 EXT. 71313-76729-78588</td>
                    </tr>
					<tr>
                        <td colspan="2" align="right" style="font-size :7px;">78590-76297-78583-72157</td>
					</tr>
                    <tr>
                        <td  colspan="2" align="right" style="font-size :7px;">www.telefonica.co</td>
                    </tr>
					<tr>
                        <td  colspan="2" align="right" style="font-size :7px;">Consecutivo: <span>'.$cantidad2.'</span></td>
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
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td  colspan="2" align="center"><span style="font-size:14px;  font-weight:bold">Centro de Servicios Compartidos</span><br>&nbsp;</td>
                    </tr>
                    <tr>
                        <td  colspan="2" align="center"><span style="font-size:15px;  font-weight:bold">CERTIFICACI&Oacute;N</span><br>&nbsp;</td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                         <td  colspan="2" align="justify"><span style="font-size:13px; line-height: 20px;">El suscrito Gerente de Servicios Econ&oacute;micos certifica que '.$cadena.' con '.$cadena10.' No '.$cedula.', labora para la compa&ntilde;&iacute;a, desde el '.$fecha.' '.@$cadena9.', con un contrato de '.$cadena8.', en el cargo de '.$cargo.' con '.$cadena7.' de '.$letrasnum.' ($<span style="font-weight: bold">'.number_format($sueldo, 0, ",", ".").'</span>). </span> '.$cadena6.'</td>
                    </tr>';
					
					if($cadena11!=NULL){
					$content .= '<tr>
                        		<td  colspan="2"><br></td>
                    		</tr>
					 		<tr>
                        		<td  colspan="2">'.@$cadena11.'</td>
                    		</tr>';
							
					}
					
					if($cadena4!=NULL){
					$content .= '<tr>
                        		<td  colspan="2"><br></td>
                    		</tr>
					 		<tr>
                        		<td  colspan="2">'.@$cadena4.'</td>
                    		</tr>';
							
					}
				
			
					                                                   
                    $content.= '<tr>
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><span style="font-size:13px; line-height: 20px;">La presente certificaci&oacute;n se expide a solicitud del interesado a los <span style="font-weight: bold">'.$diaactual.'</span> dias del mes de <span style="font-weight: bold">'.$nombre_mes.'</span> de <span style="font-weight: bold">'.$anoactual.'</span>  para ser presentado a <span style="font-weight: bold">'.$destino.'</span>. </span></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><br></td>
                    </tr>                  
                    <tr>
                        <td  colspan="2"></td>
                    </tr>                   
                    
                    <tr>
                        <td  colspan="2" style="font-size :14px;">Cordialmente,</td>
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
                        <td  colspan="2"><br></td>
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
                        <td  colspan="2"><br></td>
                    </tr>
					<tr>
                        <td  colspan="2"><br></td>
                    </tr> 
                     <tr>
                        <td  colspan="2" align="left"><img src="../imagenes/firma.jpg"></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><span style="font-weight:bold; font-size :14px;">GLORIA LUCIA</span> <span style="font-weight:bold; font-size :14px;">SEGURA VASQUEZ</span><br> <span style="font-size :14px;">Gerente de Servicios Econ&oacute;micos</span></td>
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
                        <td  colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><br></td>
                    </tr>
                   		
		</table>	
			
	    <page_footer></page_footer> </page>';
	
}else  if(@$value=="opcion2" and $estado=='I'){
			
			$content = '<page  backleft="12mm" backright="12mm">

                <table border="0" style="font-family:helvetica;">
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
                        		<td colspan="2" align="right" style="font-size :7px;">Tel. 7050000 EXT. 71313-76729-78588</td>
							</tr>
							<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">78590-76297-78583-72157</td>
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
                         <td colspan="2" ><span style="font-size:13px; line-height: 20px;">El suscrito Gerente de Servicios Econ&oacute;micos certifica que '.$cadena.' con '.$cadena10.' No '.$cedula.', labor&oacute; para la compa&ntilde;&iacute;a, desde el '.$fecha.' hasta el '.$fecha_retiro.', con un contrato de '.$cadena8.', en el cargo de '.$cargo.'.</span></td></tr>'; 
					
			                                
                  $content .= '<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><span style="font-size:13px; line-height: 20px;">La presente certificaci&oacute;n se expide a solicitud del interesado a los <span style="font-weight: bold">'.$diaactual.'</span> dias del mes de <span style="font-weight: bold">'.$nombre_mes.'</span> de <span style="font-weight: bold">'.$anoactual.'</span>  para ser presentado a <span style="font-weight: bold">'.$destino.'</span>. </span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>                  
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>                   
                    
                    <tr>
                        <td colspan="2" style="font-size :14px;>Cordialmente,</td>
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
                        <td colspan="2"><br></td>
                    </tr>
                     <tr>
                        <td colspan="2" align="left"><img src="../imagenes/firma.jpg"></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><span style="font-weight:bold; font-size :14px;">GLORIA LUCIA</span> <span style="font-weight:bold; font-size :14px;">SEGURA VASQUEZ</span><br> <span style="font-size :14px;">Gerente de Servicios Econ&oacute;micos</span></td>
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
   
	
}else  if(@$value=="opcion3" and $estado=='I'){

				$content = '<page  backleft="12mm" backright="12mm">

                <table border="0" style="font-family:helvetica; ">
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
                        		<td colspan="2" align="right" style="font-size :7px;">Tel. 7050000 EXT. 71313-76729-78588</td>
							</tr>
							<tr>
                        		<td colspan="2" align="right" style="font-size :7px;">78590-76297-78583-72157</td>
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
                         <td colspan="2"><span style="font-size:13px; line-height: 20px;">El suscrito Gerente de Servicios Econ&oacute;micos certifica que '.$cadena.' con '.$cadena10.' No '.$cedula.', estuvo vinculado(a) para la compa&ntilde;&iacute;a, desde el '.$fecha.' hasta el '.$fecha_retiro.', con un contrato de '.$cadena8.', en el cargo de '.$cargo.' con '.$cadena7.' de '.$letrasnum.' ($<span style="font-weight: bold">'.number_format($sueldo, 0, ",", ".").'</span>)  </span>'.$cadena6.'</td>
                    </tr>';
					
					if($cadena11!=NULL){
					$content .= '<tr>
                        		<td  colspan="2"><br></td>
                    		</tr>
					 		<tr>
                        		<td  colspan="2">'.@$cadena11.'</td>
                    		</tr>';
							
					}		
			
					
					
					                                                   
                     $content.= '<tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><span style="font-size:13px; line-height: 20px;">La presente certificaci&oacute;n se expide a solicitud del interesado a los <span style="font-weight: bold">'.$diaactual.'</span> dias del mes de <span style="font-weight: bold">'.$nombre_mes.'</span> de <span style="font-weight: bold">'.$anoactual.'</span>  para ser presentado a <span style="font-weight: bold">'.$destino.'</span> </span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>                  
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>                   
                    
                    <tr>
                        <td  colspan="2" style="font-size :14px;">Cordialmente,</td>
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
                        <td colspan="2"><br></td>
                    </tr>
                     <tr>
                        <td colspan="2" align="left"><img src="../imagenes/firma.jpg"></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><span style="font-weight:bold; font-size :14px;">GLORIA LUCIA</span> <span style="font-weight:bold; font-size :14px;">SEGURA VASQUEZ</span><br> <span style="font-size :14px;">Gerente de Servicios Econ&oacute;micos</span></td>
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
   
	
}	
	
	
	
	
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->WriteHTML($content);
	$html2pdf->Output('Certificado_Laboral.pdf', 'I');

	
	
	
?>