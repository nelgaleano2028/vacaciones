<?php
session_start();

include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');


/*
 *libreria para enviar correos electronicos 
 */
require_once("class_mailer.php");

/*
 *esta todo el negocio del comprobante
 */
include("class_comprobante.php");


    //Llamos la clase contenedra de los datos del comprobante
	
	/*
 *Librerias para crear reportes en pdf (html)
 */
require_once('../tcpdf/config/lang/spa.php');
require_once('../tcpdf/tcpdf.php');

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
$empresamail='FUNDACION';
}
if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;
$empresamail='CONFIDENCIAL';
}
if(isset($rowa['NOM_ADMIN'])){
$conn = $config;
$empresamail='TELMOVIL';
}
if(isset($rowt['NOM_ADMIN'])){
$conn = $configt;
$empresamail='TGT';
}

if (!isset($_SESSION['nom'])){
  
  header("location: cerrar.php");
}elseif (!isset($_POST["ano"])) {
  header("location: main_admin.php");
}

 



     
	 
    
    //Envio los datos a la clase para generar la consulta
 
        
        if($_POST["ano"]==-1 ||  $_POST["per"]==-1 || $_POST["tipo"]==-1 || @$_POST['checkall']==''){
            echo "hola";
	    
        }else{
            
            //$anio=$_POST['anio'];

$cedulas=array();
$datos=array();


$cedulas=$_POST['checkall'];


for($j=0;$j<count($cedulas);$j++){






     $com=new comprobante();
	 
	 
     
     $pdf =  new TCPDF("P", "mm", "A4", true, "UTF-8", false);
 $email=$com->email_empleado($cedulas[$j]);
//$email='nelgaleano.2028@gmail.com';

	 
$com->set_ano($_POST["ano"]);
        $com->set_liq_ini($_POST["liqui"]);
        $com->set_per_ini($_POST["per"]);
        $com->set_tip_pag($_POST["tipo"]);
	$com->set_codigo($cedulas[$j]);
        
        
		$ra=0;
		$ra1=$com->get_ano();
		$ra2=$com->get_liq_ini();
		$ra3=$com->get_per_ini();
		$ra4=$com->get_tip_pag();
		$ra5=$com->get_cod_emp();
		$ra6=$com->get_codigo();
		
		
		
		//var_dump($ra);die("");
        $com->return_sql($ra6,$ra1,$ra2,$ra3,$ra4);
		$com->comprobante();
        $generar=$com->get_lista();
		$cudl=$com->datos(4);
		$codeno=$com->datos(1);
		
		//-- VALIDACION TIPO EMPLEADOS

$query156 = "select count(*) AS VALOR from epl_grupos where cod_gru in(3,5) and cod_epl = '$codeno'";
$rs156 = $conn->Execute($query156);
$row156 = $rs156->fetchrow();

if($row156["VALOR"]<=0){
@$modalidad='SALARIO';	 
 
}else {
@$modalidad= 'APOYO DE SOSTENIMIENTO';
 
}
$modalidad;	


//RETEFUENTE
$sql90="select COD_EPL AS COD_EPL, rte_fte as RETE from empleados_basic where COD_EPL = '$codeno'";	 
$rs = $conn->Execute($sql90); 
$row0 = $rs->FetchRow();
$retefu = $row0["RETE"];	
        
        $queryz = "select p.nom_emp as EMPRESA, p.nit_emp||'-'||p.digito_ver as NIT from empleados_basic e, empresas p
where e.cod_emp = p.cod_emp
and e.cedula = '".$cudl."' and e.estado ='A'";

$rsz = $conn->Execute($queryz);
$rowz = $rsz->fetchrow();
	$empresa = $rowz['EMPRESA'];
	//$empresa = $com->empresa($rowC['EMPRESA']);
	$nit = $rowz['NIT'];
	//$nit = $com->nit($rowC['NIT']);

if(isset($rowf['NOM_ADMIN'])){
$encab = '                            NIT '.$nit.'                                                                                        COMPROBANTE ELECTRONICO DE PAGO                                                                           CSC SERVICIOS ECONOMICOS                                                                                            JEFATURA DE NOMINA ';
}
if(isset($rowc['NOM_ADMIN'])){
$encab = '                            NIT '.$nit.'                                                                                        COMPROBANTE ELECTRONICO DE PAGO                                                                           CSC SERVICIOS ECONOMICOS                                                                                            JEFATURA DE NOMINA ';
}
if(isset($rowa['NOM_ADMIN'])){
$encab = '                            NIT '.$nit.'                                                                                        COMPROBANTE ELECTRONICO DE PAGO                                                                           CSC SERVICIOS ECONOMICOS                                                                                            JEFATURA DE NOMINA ';
}
if(isset($rowt['NOM_ADMIN'])){
$encab = '                                             NIT '.$nit.'                                                                                        COMPROBANTE ELECTRONICO DE PAGO                                                                          CSC SERVICIOS ECONOMICOS                                                                                             JEFATURA DE NOMINA ';
}

        if($generar==null){
            
            echo "<script>
            alert('No se encontraron datos');
            
            
            
            
            </script>";
          
            
        }else{
    
    
    // crear nuevo documento  PDF 

    
    /*@method SetHeaderData
     @param Primer parametro nombre de la imagen.ext la imagen debe esta en la carpeta ..\tcpdf\images\
     *@param dimensión de la imagen width
     *@param Titulo del encabezado
     *@param Subtitulo del encabezado
     */
    
      $pdf->SetHeaderData('telefonica.jpg', '40', utf8_encode($empresa),$encab);
    
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
    //set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
    //set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    //set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    //set some language-dependent strings
    $pdf->setLanguageArray($l);
    
    
    // ---------------------------------------------------------
    // set font
    
    
    // add a page
    $pdf->AddPage();
    
    //$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);
    
    $pdf->SetFont('helvetica', 'BI', 7);
    
    // -----------------------------------------------------------------------------
    
    if(isset($retefu)){ $porcet = '%'; }
	
	// Permite Re declarar la funcion.
	if (!function_exists('sanear_string')) { 
		// ... proceed to declare your function	
		function sanear_string($string){
			$string = str_replace(
				array('>', '<'),
				array('MAYOR A', 'MENOR A'),
				$string
			);
			return $string;
		}
	}
    
    $html=''.utf8_encode('Período Liquidado:').' '.$com->fecha_comprobante()
.'<br><br><br><center><table  border="1" align="center" bordercolor="#000000"   frame="box" rules="all" class="tabla">
    
   <tr>
    
        <td colspan="4"><div><table width="100%" border="0" align="center">
             <tr bgcolor="#F2F2F2">
              <td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>IDENTIFICACI&Oacute;N</strong></div></td>
              <td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>APELLIDOS</strong></div></td>
                <td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>NOMBRES</strong></div></td>
                <td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>'.$modalidad.'</strong></div></td>
            </tr>
               <tr>
              <td>'.utf8_encode($com->datos(4)).'</td>
              <td>'.utf8_encode($com->datos(3)).'</td>
                 <td>'.utf8_encode($com->datos(2)).'</td>
                 <td>$ '.number_format($com->datos(6),0,",",".").'</td>
             </tr>
            <tr bgcolor="#F2F2F2" style="border:1px solid black; ">
              <td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>CARGO</strong></div></td>
              <td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>&Aacute;REA</strong></div></td>
              <td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>CONTRATO</strong></div></td>
 <td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>PORCENTAJE RETENCI&Oacute;N</strong></div></td>
              </tr>
            <tr>
              <td>'.utf8_encode($com->datos(7)).'</td>
              <td>'.utf8_encode($com->area()).'</td>
                 <td>'.utf8_encode($com->datos(8)).'</td>
				 <td>'.$retefu.$porcet.'</td>
              </tr>
            
          </table>
        </div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#F2F2F2"><div align="center" class="Estilo2"><strong>DEVENGOS</strong></div></td>
        <td colspan="2" bgcolor="#F2F2F2"><div align="center" class="Estilo1">DEDUCCIONES</div></td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0" class="tabla">
          <tr>
            <td width="210" class="Estilo2">Concepto</td>
            <td width="60" class="Estilo2">valor</td>
            <td width="40" class="Estilo2">cantidad</td>	
          </tr>';
          
          $i=0;
          $sumar=0;
          while($i < count($generar)){
            if($generar[$i]["codcon1"]<> null && $generar[$i]["can1"] <> null && $generar[$i]["val1"]<> null){
          
          $html.='<tr>
            <td><div align="left">'.$generar[$i]["codcon1"].' &nbsp;&nbsp;'.sanear_string($generar[$i]["nomcon1"]).'</div></td>
            <td><div align="right">$ '.number_format($generar[$i]["val1"],0,",",".").'</div></td>
            <td><div align="right">'.$generar[$i]["can1"].'</div></td>			
          </tr>';
            }
          $i++;
          }
               $html.='
        </table></td>
        <td colspan="2"><table width="100%" border="0" class="tabla">
          <tr>
            <td width="210" class="Estilo2">Concepto</td>
            <td width="60" class="Estilo2">valor</td>
<td width="40" class="Estilo2">saldo</td>
          </tr>';
          
              $i=0;
              $sumar2=0;
          while($i < count($generar)){
            if($generar[$i]["codcon2"]<> null && $generar[$i]["nomcon2"] <> null && $generar[$i]["can2"]<> null && $generar[$i]["val2"]<> null){
           
     
          $html.='<tr>
            <td><div align="left">'.$generar[$i]["codcon2"].' &nbsp;&nbsp;'.utf8_encode($generar[$i]["nomcon2"]).'</div></td>
            <td><div align="right">$ '.number_format($generar[$i]["val2"],0,",",".").'</div></td>
            <td><div align="right">'.$generar[$i]["saldo"].'</div></td>
          </tr>';
      
            }
          $i++;
          }
          $html.='
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#F2F2F2"><div align="center" class="Estilo2"><strong>TOTAL DEVENGOS</strong></div></td>
        <td><div align="center" class="tabla">$ '.number_format($com->neto_pagar(1),0,",",".").'</div></td>
        <td class="Estilo2" bgcolor="#F2F2F2" ><div align="center"><strong>TOTAL DEDUCCIONES</strong></div></td>
        <td><div align="center" class="tabla">$ '.number_format($com->neto_pagar(2),0,",",".").'</div></td>
      </tr>
      <tr>
        <td class="Estilo2" bgcolor="#F2F2F2" ><div align="center"><strong>PAGO</strong></div></td>
        <td><div align="center" class="tabla">'.utf8_encode($com->datos(9)).' '.utf8_encode($com->datos(10)).' #'.utf8_encode($com->datos(11)).'</div></td>
        <td class="Estilo2" bgcolor="#F2F2F2"><div align="center"><strong>NETO A PAGAR</strong></div></td>
        <td><div align="center" class="tabla">$ '.number_format($com->neto_pagar(3),0,",",".").'</div></td>
      </tr>
      <tr>
        <td height="40" colspan="4">&nbsp;</td>
      </tr>
    </table>';
    
     $html;
    
    $pdf->writeHTML($html, true, false, false, false,'');
    
   
    if(isset($_POST["ver"])){
    
      $pdf->Output("Comprobante_pago_".$com->fecha_comprobante().".pdf", 'I');
     
    }else{
        

        

    
    //Se visualiza en el navegador
    $content_PDF=$pdf->Output('', 'S');
	
	
	/*
    ------------------------------ENVIO DE COMPROBANTE EMAIL------------------------------------------------------------------
    */
       $mail = new mailer();
       //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
       $mail->AddAddress($email); // Esta es la dirección a donde enviamos 
     
       $mail->IsHTML(true); // El correo se envía como HTML
       $mail->Subject = "Comprobante de Pago"; // Este es el titulo del email.
       $empleado=@$_SESSION['nom'].' '.@$_SESSION['ape'];
       $body = "Se le hace entrega de su respectivo Comprobante de Pago.<br><br><br>";
       $mail->Body = $body; // Mensaje a enviar
       $mail->AddStringAttachment($content_PDF,"comprobante_pago_".$com->fecha_comprobante().".pdf"); //me permite enviar archivos adjuntos sin necesidad de indicar ruta 
       $exito = $mail->Send(); // Envía el correo.
       $mail->ClearAddresses();
       $mail->ClearAttachments();
	   
	    ///SE INSERTA EL CONTROL DE ENVIO DE CORREOS
	   $sqlmail = "INSERT INTO t_admail (CEDULA, NOMBRES, APELLIDOS, FECHA_REG, NOVEDAD, COMENTARIO, EMPRESA) VALUES ('".$com->datos(4)."','".$com->datos(2)."','".$com->datos(3)."',SYSDATE,'Recibo de Pago','".$email."','".$empresamail."')";
$conn->Execute($sqlmail);
       //También podríamos agregar simples verificaciones para saber si se envió:
        //if($exito){
        //    echo 'true';
        //  }else{
        //    echo 'Hubo un inconveniente. Contacta a un administrador.';
        //  }
    /* ----------------------------------FIN DE ENVIO--------------------------------------------------------------------*/      
      


           }
        }
   }
   $si=implode('<br>&nbsp;&nbsp;&nbsp;-',$datos);

$datos2=explode("+",$si);

echo "Se enviaron: ".count($cedulas)." Correos.";
    
}

?>