<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0095)http://calculadoras.elempleo.com/calculadoras/colombia/Calculadora_empresas_col_portafolio.aspx -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/Stylesheet.css" rel="stylesheet" type="text/css">
  
<title>
	Calculadora Salarial Empresas
</title></head>
<body>







 
<div class="paso">
<div class="tabla_calculadora"> 
<div class="top">Calculadora Salarial</div>
<div class="referencia2">Información general</div>
<div class="referencia3"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tbody><tr>
<td width="82%" height="16" class="textoazul">Salario mínimo legal vigente
</td>
<td width="18%" class="textoazul">$589,500</td>
</tr>
<tr>
<td height="20" class="textoazul">Salario mínimo integral vigente</td>
<td class="textoazul">$7,663,500</td>
</tr>
<tr>
<td class="textoazul">Subsidio de transporte</td>
<td class="textoazul">$70,500</td>
</tr>
<tr>
<td class="textoazul">Unidad de Valor Tributario (UVT)</td>
<td class="textoazul">$26.841</td>
</tr>

</tbody></table>
</div>
<div class="contenedor">
    
<div>

</div>



<div>


</div>
    <div>
    </div>
    

   
	
    <form name="form1" method="post"  id="form1">
    <table id="tblSalaryCol" border="0">
		<tbody><tr id="trTitleSalary">
			<td id="tcTitleSalary" class="lateral" align="center" colspan="2"><span id="lblTitleSalary">Datos de Ingreso</span></td>
		</tr><tr id="trTypeSalaryCol">
			<td id="tcTitleTypeCol"><span id="lblTitleTypeCol" class=" textot2">Tipo de salario</span></td><td id="tcValueTypeCol"><select name="ddlValueTypeCol" id="ddlValueTypeCol">
				<option value="0">Seleccione</option>
                <option value="1">Básico</option>
				<option value="2">Integral</option>

			</select></td>
		</tr><tr id="trSalaryCol">
			<td id="tcSalaryCol" class="tcSalaryCol1"><span id="lblSalaryCol" class="textot3a">Salario bruto o comisiones</span></td><td id="tcValueSalaryCol"><input name="txtValueSalaryCol" type="text" maxlength="25" id="txtValueSalaryCol" ><span id="RegularExpressionValidator1" style="color:Red;visibility:hidden;">*</span><span id="RequiredFieldValidator6" style="color:Red;visibility:hidden;">*</span></td>
		</tr><tr id="trUntaxedCol">
			<td id="tcUntaxedCol" class="tcUntawedCol"><span id="lblUntaxedCol" class="textot3a">Otros Ingresos Laborales</span></td><td id="tcValueUntaxedCol"><input name="txtValueUntaxedCol" type="text" maxlength="25" id="txtValueUntaxedCol"><span id="RegularExpressionValidator2" style="color:Red;visibility:hidden;">*</span></td>
		</tr><tr id="trOtherCol">
			<td id="tcOtherCol" class="tcOtherCol1"><span id="lblOtherCol" class="textot3a">Aporte Fondo de P. V.</span></td><td id="tcValueOtherCol"><input name="txtValueOtherCol" type="text" maxlength="25" id="txtValueOtherCol"><span id="RegularExpressionValidator3" style="color:Red;visibility:hidden;">*</span></td>
		</tr>
        <tr id="trOtherProvisionsCol">
			<td id="tcOtherProvisionsCol"><span id="lblOtherProvisionsCol" class="textot2">Deducción de retención</span></td><td id="tcValueOtherProvisionsCol"></td>
		</tr>
        
        <tr id="trOtherProvisionsCol">
			<td id="tcOtherProvisionsCol"><span id="lblOtherProvisionsCol" class="textot3a">Pagos por salud</span></td><td id="tcValueOtherProvisionsCol"><input name="txtValueOtherProvisionsCol" type="text" maxlength="25" id="txtValueOtherProvisionsCol"><span id="RegularExpressionValidator4" style="color:Red;visibility:hidden;">*</span></td>
		</tr>
        
        <tr id="trOtherProvisionsCol">
			<td id="tcOtherProvisionsCol"><span id="lblOtherProvisionsCol" class="textot3a">Intereses de vivienda</span></td><td id="tcValueOtherProvisionsCol"><input name="vivienda" type="text" maxlength="25" id="vivienda"><span id="RegularExpressionValidator4" style="color:Red;visibility:hidden;">*</span></td>
		</tr>
         
         
        
        <tr id="trCalculeCol">
			<td id="spaceCalculeCol"></td><td id="tcCalculeCol"><input type="button" name="btnCalculeCol" value="Calcular"  id="btnCalculeCol" style="cursor: pointer;"></td>
		</tr>
        
        </tbody>
        </table>
      </form>
      
      
        <table id="datos" style="display:none">
        <tbody>
        <tr id="trTitleMiddleColEmp">
			<td id="tcTitleMiddleColEmp" class="lateral2" align="center" colspan="2"><span id="lblTitleMiddleColEmp">Datos Calculados</span></td>
		</tr><tr id="trTransportCol">
			<td id="tcTransportCol"><span id="lblTransportCol" class="textot">Subsidio de transporte</span></td><td id="tcValueTransportCol" class="textor"><span id="lblValueTransportCol"></span></td>
		</tr><tr id="trSalaryTotalCol">
			<td id="tcSalaryTotalCol"><span id="lblSalaryTotalCol" class="textot">Total ingresos laborales</span></td><td id="tcValueSalaryTotalCol" class="textor"><span id="lblValueSalaryTotalCol"></span></td>
		</tr><tr id="trHealthCol">
			<td id="tcHealthCol"><span id="lblHealthCol" class="textot">Fondo de solidaridad</span></td><td id="tcValueHealthCol" class=" textor"><span id="lblValueHealthCol"></span></td>
		</tr><tr id="trContributionsARP">
			<td id="tcContributionsARP"><span id="lblContributionsARP" class="textot">Retención en la fuente</span></td><td id="tcValueContributionsARP" class="textor"><span id="lblValueContributionsARP"></span></td>
		</tr><tr id="trInputPensionCol">
			<td id="tcInputPensionCol"><span id="lblInputPensionCol" class="textot">Aportes a pensiones</span></td><td id="tcValueInputPensionCol" class="textor"><span id="lblValueInputPensionCol"></span></td>
		</tr>
        <tr id="trInputPensionCol">
			<td id="tcInputPensionCol"><span id="aporte_fvpm" class="textot">Aporte FVP Máximo Exento</span></td><td id="tcValueInputPensionCol" class="textor"><span id="aporte_fvp"></span></td>
		</tr>
        <tr id="trFamilyCompensationCol">
			<td id="tcFamilyCompensationCol"><span id="lblFamilyCompensationCol" class="textot">Aportes a salud obligatoria</span></td><td id="tcValueFamilyCompensationCol" class="textor"><span id="lblValueFamilyCompensationCol"></span></td>
		</tr>
        
        <tr id="trFamilyCompensationCol">
			<td id="tcFamilyCompensationCol"><span id="lblFamilyCompensationCol" class="textot">Aportes FPV – AFC</span></td><td id="tcValueFamilyCompensationCol" class="textor"><span id="aporte_fpv"></span></td>
		</tr>
        <tr id="trVacationCol">
			<td id="tcVacationCol"><span id="lblVacationCol" class="textot">Pago por salud</span></td><td id="tcValueVacationCol" class="textor"><span id="lblValueVacationCol"></span></td>
		</tr><tr id="trBonusServices">
			<td id="tcBonusServices"><span id="lblBonusServices" class="textot">Compensación neta mensual</span></td><td id="tcValueBonusServices" class="textor"><span id="lblValueBonusServices"></span></td>
		</tr>
	</tbody></table>
        
</div>
    

    <div class="introast">* Diligencie los datos obligatorios</div>
  
  </div>
  </div>
 
<script src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/calculadora.js"></script>
  

</body>
  
</html>