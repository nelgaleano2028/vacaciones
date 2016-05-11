<?php
session_start();



ob_start(); 
		
/*
 *Librerias para crear reportes en pdf (html)
 */
require_once('../tcpdf/config/lang/spa.php');
require_once('../tcpdf/tcpdf.php');

/*
 *libreria para enviar correos electronicos 

require_once('../pjmail/pjmail.class.php');
 */
/*
 *esta todo el negocio del comprobante
 */
include("class_comprobante.php");


		
//$qry0="select cod_epl as COD_EPL from empleados_basic";
//
//$rh0 = $conn->Execute($qry0); 
//
//$cod_cedulas=array();
//
//while($row = $rh0->FetchRow()){
//
//	$cod_cedulas[]=$row["COD_EPL"];
//}


$ano="2009";
$tipo="2";
$per="5";
$liqui="21";

$codigo='MOLC01';


	$lista3=array();
	    
	//Llamamos a la clase que contenedra los datos del comprobante
     
	 $com=new comprobante();
	 
	// $lista3=$com->departamento();
	
	
	//PDF
	     
    $pdf =  new TCPDF("P", "mm", "A4", true, "UTF-8", false);
    




//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);





// ---------------------------------------------------------

// set font
  $pdf->SetFont('helvetica', 'BI', 7);

// Start First Page Group
$pdf->startPageGroup();
        
    //Envio los datos a la clase para generar la consulta
    
    $html = ob_get_clean();
   
   for($j=0;$j<50;$j++){
        set_time_limit(0);
        if($ano==-1 || $liqui==-1 || $per==-1 || $tipo==-1){
            
			echo "false";
			
        }else{			

			
		

		
        	$com->set_ano($ano);
        	$com->set_liq_ini($liqui);
        	$com->set_per_ini($per);
        	$com->set_tip_pag($tipo);
        	$com->set_codigo($codigo);
        
                
			$ra=0;
			$ra1=$com->get_ano();
			$ra2=$com->get_liq_ini();
			$ra3=$com->get_per_ini();
			$ra4=$com->get_tip_pag();
			
			$ra5=$com->get_cod_emp();
			
        	$ra6=$com->get_codigo();
               
		
        	$com->return_sql($ra6,$ra1,$ra2,$ra3,$ra4);
			$com->comprobante();
        	$generar=$com->get_lista();
        
        
        	if($generar==null){
            
               echo "<script>
            		alert('No se encontraron datos');
            		window.close(); 
                    </script>";
          
            }else{
    
    
    			// crear nuevo documento  PDF 
    
   
    			/*@method SetHeaderData
     			@param Primer parametro nombre de la imagen.ext la imagen debe esta en la carpeta ..\tcpdf\images\
     			*@param dimensión de la imagen width
     			*@param Titulo del encabezado
     			*@param Subtitulo del encabezado
     			*/
	 
    			/*
    			$pdf->SetHeaderData('logo1.jpg', '40', utf8_encode($com->empresa(1)), utf8_encode($lista3[0]["nombredpt"]).'   '.
				utf8_encode($com->empresa(2)).'
				Comprobante No. '.
				$com->datos(12).'  Fecha '.$com->fecha_comprobante());
    
    			// set header and footer fonts
    			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
				// set default monospaced font
    			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    			*/
	
    			//set margins
    			//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  
    
    			//set auto page breaks
    			//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    
			// set header and footer fonts



    
    // add second page
$pdf->AddPage();
    
    			// -----------------------------------------------------------------------------
    

    
    $html='
     
    	<center>
    
    
		<table width="80%"  border="0">
  			<tr>
    			<td width="180" rowspan="5" align="center"><img width="150" height="120" src=""></td>
    			<td width="472" style="font-size:14;"><br>'.utf8_encode($com->empresa(1)).'<br></td>
  			</tr>
  			<tr>
    			<td><br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RUC:</strong> '.utf8_encode($com->empresa(3)).' <br></td>
  			</tr>
  			<tr>
    			<td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DIRECCION: Calle Los Tulipanes No 147 Of. 405<br></td>
  			</tr>
			<tr>
    			<td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COMPROBANTE No: '.$com->datos(12).'<br></td>
  			</tr>
			<tr>
    			<td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PERIODO LIQUIDADO: '.$com->fecha_comprobante().'<br></td>
  			</tr>
			
			
		</table>
		
		
		
		
		
		
    	
		<table  border="1" align="left" bordercolor="#000000"  width="100%"  frame="box" rules="all" class="tabla">
		
    		<tr>
				<td colspan="4">
					
						<table width="100%" border="1" align="center">
             				<tr bgcolor="#F2F2F2">
              					<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>IDENTIFICACION</strong></div></td>
              					<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>APELLIDOS</strong></div></td>
                				<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>NOMBRES</strong></div></td>
                				<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>SUELDO BASICO</strong></div></td>
            				</tr>
               				<tr>
              					<td>'.utf8_encode($com->datos(4)).'</td>
              					<td>'.utf8_encode($com->datos(3)).'</td>
                 				<td>'.utf8_encode($com->datos(2)).'</td>
                 				<td>$ '.number_format($com->datos(6),2,",",".").'</td>
            				</tr>
            				<tr bgcolor="#F2F2F2">
              					<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>CARGO</strong></div></td>
              					<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>INGRESO</strong></div></td>
                				<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>RETIRO</strong></div></td>
								<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>TIPO DE PENSION</strong></div></td>
              				</tr>
            				<tr>
              					<td>'.utf8_encode($com->datos(7)).'</td>
              					<td>'.utf8_encode($com->area()).'</td>
                 				<td>'.utf8_encode($com->datos(8)).'</td>
								<td>'.utf8_encode($com->datos(2)).'</td>
              				</tr>
            			</table>
        			
				</td>
			</tr>
	        <tr>
         		<td colspan="4">
					<div>
						<table width="100%" border="1" align="center">
             				<tr bgcolor="#F2F2F2">
              					<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>TIPO DE PERSONAL</strong></div></td>
              					<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>DIAS TRABAJADOS</strong></div></td>
                				<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>HORAS TRABAJADAS</strong></div></td>
                				<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>HORAS EXTRAS</strong></div></td>
            				</tr>
            				<tr>
              					<td>'.utf8_encode($com->datos(4)).'</td>
              					<td>'.utf8_encode($com->datos(3)).'</td>
                				<td>'.utf8_encode($com->datos(2)).'</td>
                				<td>$ '.number_format($com->datos(6),2,",",".").'</td>
            				</tr>
            				<tr bgcolor="#F2F2F2" style="border:1px solid black; ">
              					<td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>SAL_VAC</strong></div></td>
              					<td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>RET_VAC</strong></div></td>
                				<td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>DIAS VACACIONES</strong></div></td>
								<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>MONEDA</strong></div></td>
              				</tr>
            				<tr>
                				<td>'.utf8_encode($com->datos(7)).'</td>
                				<td>'.utf8_encode($com->area()).'</td>
                				<td>'.utf8_encode($com->datos(8)).'</td>
								<td>'.utf8_encode($com->datos(2)).'</td>
              				</tr>
            
          				</table>
        			</div>		
				</td>
      		</tr>
			
</table>
			
			
			
			
            
            
			<table  border="1" align="left" bordercolor="#000000"   frame="box" rules="all" class="tabla">
	       	<tr>
        		<td  bgcolor="#F2F2F2"><div align="center" class="Estilo2"><strong>DEVENGOS</strong></div></td>
        		<td  bgcolor="#F2F2F2"><div align="center" class="Estilo1">DEDUCCIONES</div></td>
				<td  bgcolor="#F2F2F2"><div align="center" class="Estilo1">APORTES EMPLEADOR</div></td>
      		</tr>
	       	<tr>
        		<td>
					<table width="50%" border="0"  class="tabla">
          				<tr>
            				<td width="130%" class="Estilo2">&nbsp;&nbsp;Concepto</td>
            				<td width="70%" class="Estilo2"><div align="right">Valor&nbsp;&nbsp;</div></td>
      	 				</tr>';
          
          $i=0;
          $sumar=0;
          while($i < count($generar)){
            if($generar[$i]["codcon1"]<> null && $generar[$i]["can1"] <> null && $generar[$i]["val1"]<> null){
          
          $html.='<tr>
            <td><div align="left">&nbsp;'.$generar[$i]["nomcon1"].'</div></td>
            
            <td><div align="right">$ '.number_format($generar[$i]["val1"],0,",",".").'&nbsp;&nbsp;</div></td>
          </tr>';
            }
          $i++;
	        }
			
			
                $html.='
        			</table>
				</td>
        		
				<td>
					<table width="50%" border="0" class="tabla">
          				<tr>
            				<td width="130%" class="Estilo2">&nbsp;&nbsp;Concepto</td>
            			
            				<td width="70%" class="Estilo2"><div align="right">Valor&nbsp;&nbsp;</div></td>
          				</tr>';
          
              $i=0;
              $sumar2=0;
          while($i < count($generar)){
            if($generar[$i]["codcon2"]<> null && $generar[$i]["nomcon2"] <> null && $generar[$i]["can2"]<> null && $generar[$i]["val2"]<> null){
           //$sumar2+=$generar[$i]["val2"];
     
          $html.='<tr>
            <td width="130%"><div align="left">&nbsp;'.$generar[$i]["nomcon2"].'</div></td>
            
            <td width="70%"><div align="right">$ '.number_format($generar[$i]["val2"],0,",",".").'&nbsp;&nbsp;</div></td>
          </tr>';
      
            }
          $i++;
	        }
			
			$html.='
        			</table>
				</td>
        		
				<td>
					<table width="50%" border="0" class="tabla">
          				<tr>
            				<td width="130%" class="Estilo2">&nbsp;&nbsp;Concepto</td>
            				<td width="70%" class="Estilo2"><div align="rigth">Valor&nbsp;&nbsp;</div></td>
          				</tr>';
          
            
          $html.='<tr>

            <td><div align="left">&nbsp;</div></td>
            
            <td><div align="right">$ &nbsp;&nbsp;</div></td>
          </tr>';
      
          
					
			
          $html.='
        			</table>
				</td>
      		</tr>
            
            
      		<tr>
        		<td bgcolor="#F2F2F2">
                	<table width="100%" border="1" class="tabla">
          				<tr>
            				<td width="120" class="Estilo2">TOTAL DEVENGOS</td>
            				<td width="120" class="Estilo2"><div align="center" class="tabla">$ '.number_format($com->neto_pagar(1),2,",",".").'</div></td>
            			
          				</tr>
                	</table>
                </td>
                <td bgcolor="#F2F2F2">
                	<table width="100%" border="0" class="tabla">
          				<tr>
            				<td width="120" class="Estilo2">TOTAL DEDUCCIONES</td>
            				<td width="120" class="Estilo2"><div align="center" class="tabla">$ '.number_format($com->neto_pagar(2),2,",",".").'</div></td>
            			
          				</tr>
                	</table>
                </td>
                <td bgcolor="#F2F2F2">
                	<table width="100%" border="0" class="tabla">
          				<tr>
            				<td width="120" class="Estilo2">TOTAL EMPLEADOR</td>
            				<td width="120" class="Estilo2"><div align="center" class="tabla">$ </div></td>
            			
          				</tr>
                	</table>
                </td>
      		</tr>
            
            </table>
            
           
            
			
			
			
			
            
			<table  border="1" align="center" bordercolor="#000000"   frame="box" rules="all" class="tabla">
      		
			<tr>
        		<td  class="Estilo2" bgcolor="#F2F2F2" ><div align="center"><strong>PAGO</strong></div></td>
        		<td><div align="center" class="tabla">&nbsp;&nbsp;&nbsp;&nbsp;'.utf8_encode($com->datos(9)).' '.utf8_encode($com->datos(10)).' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$com->datos(11).'</div></td>
				<td  class="Estilo2" bgcolor="#F2F2F2"><div align="center"><strong>NETO A PAGAR</strong></div></td>
				<td ><div align="center" class="tabla">$ '.number_format($com->neto_pagar(3),2,",",".").'</div></td>
			</tr>
			
        	    
	  	  
	  		<tr>
        		<td height="40" colspan="4">
				<br><br><br>
		_____________________ &nbsp;&nbsp;&nbsp;&nbsp;    _______________________<br>
		EMPLEADOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;                  TRABAJADOR 
		
				</td>
      		</tr>
    	</table>
	

	
	
	<br><br><br>
	
	
	
	
    
	
		<table width="80%"  border="0">
  			<tr>
    			<td width="180" rowspan="5" align="center"><img width="150" height="120" src=""></td>
    			<td width="472" style="font-size:14;"><br>'.utf8_encode($com->empresa(1)).'<br></td>
  			</tr>
  			<tr>
    			<td><br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RUC:</strong> '.utf8_encode($com->empresa(3)).' <br></td>
  			</tr>
  			<tr>
    			<td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DIRECCION: Calle Los Tulipanes No 147 Of. 405<br></td>
  			</tr>
			<tr>
    			<td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COMPROBANTE No: '.$com->datos(12).'<br></td>
  			</tr>
			<tr>
    			<td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PERIODO LIQUIDADO: '.$com->fecha_comprobante().'<br></td>
  			</tr>
			
			
		</table>
		
		
		
		
		
		
    	
		<table  border="1" align="left" bordercolor="#000000"  width="100%"  frame="box" rules="all" class="tabla">
		
    		<tr>
				<td colspan="4">
					<div>
						<table width="100%" border="0" align="center">
             				<tr bgcolor="#F2F2F2">
              					<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>IDENTIFICACION</strong></div></td>
              					<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>APELLIDOS</strong></div></td>
                				<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>NOMBRES</strong></div></td>
                				<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>SUELDO BASICO</strong></div></td>
            				</tr>
               				<tr>
              					<td>'.utf8_encode($com->datos(4)).'</td>
              					<td>'.utf8_encode($com->datos(3)).'</td>
                 				<td>'.utf8_encode($com->datos(2)).'</td>
                 				<td>$ '.number_format($com->datos(6),2,",",".").'</td>
            				</tr>
            				<tr bgcolor="#F2F2F2" style="border:1px solid black; ">
              					<td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>CARGO</strong></div></td>
              					<td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>INGRESO</strong></div></td>
                				<td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>TIPO DE PENSION</strong></div></td>
								<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>SUELDO BASICO</strong></div></td>
              				</tr>
            				<tr>
              					<td>'.utf8_encode($com->datos(7)).'</td>
              					<td>'.utf8_encode($com->area()).'</td>
                 				<td>'.utf8_encode($com->datos(8)).'</td>
								<td>'.utf8_encode($com->datos(2)).'</td>
              				</tr>
            			</table>
        			</div>
				</td>
			</tr>
	        <tr>
         		<td colspan="4">
					<div>
						<table width="100%" border="0" align="center">
             				<tr bgcolor="#F2F2F2">
              					<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>TIPO DE PERSONAL</strong></div></td>
              					<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>DIAS TRABAJADOS</strong></div></td>
                				<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>HORAS TRABAJADAS</strong></div></td>
                				<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>DIAS VACACIONES</strong></div></td>
            				</tr>
            				<tr>
              					<td>'.utf8_encode($com->datos(4)).'</td>
              					<td>'.utf8_encode($com->datos(3)).'</td>
                				<td>'.utf8_encode($com->datos(2)).'</td>
                				<td>$ '.number_format($com->datos(6),2,",",".").'</td>
            				</tr>
            				<tr bgcolor="#F2F2F2" style="border:1px solid black; ">
              					<td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>SAL_VAC</strong></div></td>
              					<td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>RET_VAC</strong></div></td>
                				<td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>MONEDA</strong></div></td>
								<td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>DIAS VACACIONES</strong></div></td>
              				</tr>
            				<tr>
                				<td>'.utf8_encode($com->datos(7)).'</td>
                				<td>'.utf8_encode($com->area()).'</td>
                				<td>'.utf8_encode($com->datos(8)).'</td>
								<td>'.utf8_encode($com->datos(2)).'</td>
              				</tr>
            
          				</table>
        			</div>		
				</td>
      		</tr>
			
</table>
			
			
			
			
            
            
			<table  border="1" align="left" bordercolor="#000000"   frame="box" rules="all" class="tabla">
	       	<tr>
        		<td  bgcolor="#F2F2F2"><div align="center" class="Estilo2"><strong>DEVENGOS</strong></div></td>
        		<td  bgcolor="#F2F2F2"><div align="center" class="Estilo1">DEDUCCIONES</div></td>
				<td  bgcolor="#F2F2F2"><div align="center" class="Estilo1">APORTES EMPLEADOR</div></td>
      		</tr>
	       	<tr>
        		<td>
					<table width="50%" border="0"  class="tabla">
          				<tr>
            				<td width="130%" class="Estilo2">Concepto</td>
            				<td width="70%" class="Estilo2"><div align="right">Valor</div></td>
      	 				</tr>';
          
          $i=0;
          $sumar=0;
          while($i < count($generar)){
            if($generar[$i]["codcon1"]<> null && $generar[$i]["can1"] <> null && $generar[$i]["val1"]<> null){
          
          $html.='<tr>
            <td><div align="left">&nbsp;'.$generar[$i]["nomcon1"].'</div></td>
            
            <td><div align="right">$ '.number_format($generar[$i]["val1"],0,",",".").'&nbsp;&nbsp;</div></td>
          </tr>';
            }
          $i++;
	        }
			
			
                $html.='
        			</table>
				</td>
        		
				<td>
					<table width="50%" border="0" class="tabla">
          				<tr>
            				<td width="130%" class="Estilo2">&nbsp;&nbsp;Concepto</td>
            			
            				<td width="70%" class="Estilo2"><div align="right">Valor&nbsp;&nbsp;</div></td>
          				</tr>';
          
              $i=0;
              $sumar2=0;
          while($i < count($generar)){
            if($generar[$i]["codcon2"]<> null && $generar[$i]["nomcon2"] <> null && $generar[$i]["can2"]<> null && $generar[$i]["val2"]<> null){
           //$sumar2+=$generar[$i]["val2"];
     
          $html.='<tr>
            <td width="130%"><div align="left">&nbsp;'.$generar[$i]["nomcon2"].'</div></td>
            
            <td width="70%"><div align="right">$ '.number_format($generar[$i]["val2"],0,",",".").'&nbsp;&nbsp;</div></td>
          </tr>';
      
            }
          $i++;
	        }
			
			$html.='
        			</table>
				</td>
        		
				<td>
					<table width="50%" border="0" class="tabla">
          				<tr>
            				<td width="130%" class="Estilo2">Concepto</td>
            				<td width="70%" class="Estilo2"><div align="rigth">Valor</div></td>
          				</tr>';
          
              $i=0;
              $sumar2=0;
          while($i < count($generar)){
            if($generar[$i]["codcon2"]<> null && $generar[$i]["nomcon2"] <> null && $generar[$i]["can2"]<> null && $generar[$i]["val2"]<> null){
           //$sumar2+=$generar[$i]["val2"];
     
          $html.='<tr>

            <td><div align="left">&nbsp;'.$generar[$i]["nomcon2"].'</div></td>
            
            <td><div align="right">$ '.number_format($generar[$i]["val2"],0,",",".").'&nbsp;&nbsp;</div></td>
          </tr>';
      
            }
          $i++;
	        }
					
			
          $html.='
        			</table>
				</td>
      		</tr>
            
            
      		<tr>
        		<td bgcolor="#F2F2F2">
                	<table width="100%" border="1" class="tabla">
          				<tr>
            				<td width="120" class="Estilo2">TOTAL DEVENGOS</td>
            				<td width="120" class="Estilo2"><div align="center" class="tabla">$ '.number_format($com->neto_pagar(1),2,",",".").'</div></td>
            			
          				</tr>
                	</table>
                </td>
                <td bgcolor="#F2F2F2">
                	<table width="100%" border="0" class="tabla">
          				<tr>
            				<td width="120" class="Estilo2">TOTAL DEDUCCIONES</td>
            				<td width="120" class="Estilo2"><div align="center" class="tabla">$ '.number_format($com->neto_pagar(2),2,",",".").'</div></td>
            			
          				</tr>
                	</table>
                </td>
                <td bgcolor="#F2F2F2">
                	<table width="100%" border="0" class="tabla">
          				<tr>
            				<td width="120" class="Estilo2">TOTAL EMPLEADOR</td>
            				<td width="120" class="Estilo2"><div align="center" class="tabla">$ '.number_format($com->neto_pagar(1),2,",",".").'</div></td>
            			
          				</tr>
                	</table>
                </td>
      		</tr>
            
            </table>
            
           
            
			
			
			
			
            
			<table  border="1" align="center" bordercolor="#000000"   frame="box" rules="all" class="tabla">
      		
			<tr>
        		<td  class="Estilo2" bgcolor="#F2F2F2" ><div align="center"><strong>PAGO</strong></div></td>
        		<td><div align="center" class="tabla">&nbsp;&nbsp;&nbsp;&nbsp;'.utf8_encode($com->datos(9)).' '.utf8_encode($com->datos(10)).' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$com->datos(11).'</div></td>
				<td  class="Estilo2" bgcolor="#F2F2F2"><div align="center"><strong>NETO A PAGAR</strong></div></td>
				<td ><div align="center" class="tabla">$ '.number_format($com->neto_pagar(3),2,",",".").'</div></td>
			</tr>
			
        	    
	  	  
	  		<tr>
        		<td height="40" colspan="4">
				<br><br><br>
		_____________________ &nbsp;&nbsp;&nbsp;&nbsp;    _______________________<br>
		EMPLEADOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;                  TRABAJADOR 
		
				</td>
      		</tr>
    	</table>
	 
	 
    
    </center>
    ';
    
// print a block of text using Write()
//$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$pdf->writeHTML($html, true, false, true, false, '');




    
	
	
	/*
	else{
        
   
    //Se visualiza en el navegador
    $content_PDF=$pdf->Output('', 'S');
    
    $mail = new PJmail(); 
 	$mail->setAllFrom('juanmagenio.lopez@gmail.com', "Nombre del la persona que envía"); 
 	$mail->addrecipient(@$_SESSION['cor']); 
	$mail->addsubject("Comprobante de Pago"); 
	$empleado=@$_SESSION['nom'].' '.@$_SESSION['ape'];
 	$mail->text = "Señor / Señora ".$empleado." le enviamos su comprobante de pago.";
 	$mail->addbinattachement("comprobante_pago_".$com->fecha_comprobante().".pdf", $content_PDF); 
        $mail->sendmail();
      
      echo "true";
           
        
        

   

    }*/
	
	
        }
		
		
		
		
    }//cierre ELSE
	
	}//cierre for
	//Close and output PDF document
$pdf->Output('example_023.pdf', 'FD');
    
    //}cierre POST
?>