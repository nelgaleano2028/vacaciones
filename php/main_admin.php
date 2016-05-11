<?php
session_start();
if (isset($_SESSION['nom'])){
		@$_SESSION['pas'];
        @$_SESSION['nom'];

}elseIF($_SESSION['ouf']=='valor'){
header ("Location:outside.php?ou=1");

}elseIF($_SESSION['out']=='sinvalor'){
header ("Location:outside.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
    <head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:Auto Gestion Nomina:.</title>
<meta http-equiv="X-UA-Compatible" content="IE=10" />
<!--[if lt IE 10]>
<script type="text/javascript" src="../PIE/PIE.js"></script>
<![endif]-->

<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
<![endif]-->

<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->				
<style type="text/css">
@import url("../css/plantilla_user.css");

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
a:link {
	text-decoration: none;
	color: #FFF;
}
a:linkba {
	text-decoration: none;
	color: #333
}
a:visited {
	text-decoration: none;
	color: #FFF;
}
a:hover {
	text-decoration: none;
	color: #FFF;
}
a:active {
	text-decoration: none;
	color: #FFF;
}
a {
	font-weight: bold;
}
</style>
<link rel="stylesheet" href="../css/google-buttons.css" type="text/css"  media="screen" />
    <script src="../js/jquery-1.7.1.min.js"></script>
    <script src="../js/bootstrap-dropdown.js"></script>
	
	<script>
	function ver_tiempo_passw(){
		<?php

			include_once('../lib/configdbf.php');
			include_once('../lib/configdbc.php');
			include_once('../lib/configdb.php');
			include_once('../lib/configdbt.php');

			$nomadmin = $_SESSION['nom'];

			set_time_limit (86400);

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
			}
			if(isset($rowc['NOM_ADMIN'])){
			$conn = $configc;
			}
			if(isset($rowa['NOM_ADMIN'])){
			$conn = $config;
			}
			if(isset($rowt['NOM_ADMIN'])){
			$conn = $configt;
			}		
			
			$query = "select * from hist_passw 
							  where usuario = 'WEB'||UPPER('$nomadmin') and fecha >= sysdate-(select valor from parametros_nue where nom_var='t_diasclave')";	
			 
				 $rs = $conn->Execute($query);
				 
			 if($rs->RecordCount() <= 0){				   
					?>alert("Su contraseña ha expirado por favor cambiela"); <?php
			}

		?>
		
		
	}
	</script>
    
</head>
<body class="barramenu" onload="ver_tiempo_passw()">
  <table width="100%" border="0" height="auto">
    <tr>
      <td height="auto" valign="top">
      	<table width="100%" border="0" height="auto">
        	<tr>
          		<td width="100%" height="145" colspan="10" class="monitores"><strong><?PHP echo @$_SESSION['nom'];?> ||<?PHP if ($_SESSION['nom']=='superadmin'){echo ' TELMOVIL ';}elseif ($_SESSION['nom']=='superadmin2'){echo ' CONFIDENCIAL ';}elseif ($_SESSION['nom']=='superadmin3'){echo ' FUNDACION ';}elseif ($_SESSION['nom']=='superadmin4'){echo ' TGT ';}?>||</strong><a href="nuevopass_admin.php" target="mainFrame" class="linkba" style="color: black;"> Modificar contraseña </a>||</strong> <a href="cerrar.php" class="linkba" style="color: black;">Cerrar sesi&oacute;n</a></td>
     </tr>
     <tr>
       <td width="110" height="48" class="certificados">
	   <div class="g-button-group">
  			<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">Certificado de Ingresos<span class="caret"></span>
  			</a>
			<ul class="dropdown-menu">
				<li><a href="inicio2.php" target="mainFrame"><i class="icon-ok"></i> Email masivo</a></li>
				<li><a href="inicio3.php" target="mainFrame"><i class="icon-remove"></i>Descarga</a></li>
			</ul>
		</div>	
	   
	   
	   </td>
	   
	  <!-- <td width="200" height="48" class="certificados"><a href="inicio2.php" target="mainFrame">Certificados de Ingresos</a></td>-->
       
       <td width="200" height="48" class="novedades"><a href="adminfeed.php" target="mainFrame">Publicar notas</a></td>
	
       <td width="295" height="48" class="comprobantes"><a href="admin_pagos.php" target="mainFrame">Consultar comprobantes de Pago</a></td>
       
	  <td width="210" height="48" class="vacaciones">
		<div class="g-button-group">
  			<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
    			Vacaciones <span class="caret"></span>
  			</a>
  		<ul class="dropdown-menu">
		<?php if(isset($_SESSION['privi'])){
		if($_SESSION['privi']=='2'){
				
		     echo '<li><a href="solicitudes_epl.php" target="mainFrame"><i class="icon-ok"></i>Historial Solicitudes Por Empleado</a></li>
		     <li><a href="epl_gral_rechazados.php" target="mainFrame"><i class="icon-remove"></i>Historial de Solicitudes Rechazadas</a></li>
		     <li><a href="solicitud_vigente_epl.php" target="mainFrame"><i class="icon-plane"></i>Solicitudes de Empleados con vacaciones vigentes</a></li>
                       <li class="divider"></li>
		     <li><a href="vacaciones_gral_edith.php" target="mainFrame"><i class="icon-calendar"></i>Aprobar,Editar o Rechazar Solicitudes</a></li>';
		}else{
		     echo '<li><a href="solicitudes_epl_jefe.php" target="mainFrame"><i class="icon-ok"></i> Historial Solicitudes Por Empleado</a></li>
		     <li><a href="epl_jefe_rechazados.php" target="mainFrame"><i class="icon-remove"></i>Historial de Solicitudes Rechazadas</a></li>
		     <li><a href="solicitud_vigente_epl_jefe.php" target="mainFrame"><i class="icon-plane"></i>Solicitudes de Empleados con vacaciones vigentes</a></li>
		     <li class="divider"></li>
		     <li><a href="vacaciones_area.php" target="mainFrame"><i class="icon-calendar"></i>Solicitudes Pendientes por Aprobar o Rechazar</a></li>';
      }}?>
			
      
    
  </ul>
		
</div>
  <td width="210" height="48" class="vacaciones">
<div class="g-button-group">
  			<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
    			Trabajo por Turnos <span class="caret"></span>
  			</a>
  		<ul class="dropdown-menu">
		<?php if(isset($_SESSION['privi'])){
		if($_SESSION['privi']=='2'){
				
		     echo '<li><a href="horasextsol_epl.php" target="mainFrame"><i class="icon-ok"></i>Historial Solicitudes Por Empleado</a></li>
		     <li><a href="horasext_gral_rechazados.php" target="mainFrame"><i class="icon-remove"></i>Historial de Solicitudes Rechazadas</a></li>
		   
                       <li class="divider"></li>
		     <li><a href="horasext_gral_edith.php" target="mainFrame"><i class="icon-calendar"></i>Aprobar o Rechazar Solicitudes</a></li>';
		}else{
		     echo '<li><a href="horasextsol_epl.php" target="mainFrame"><i class="icon-ok"></i> Historial Solicitudes Por Empleado</a></li>
		     <li><a href="horasext_gral_rechazados.php" target="mainFrame"><i class="icon-remove"></i>Historial de Solicitudes Rechazadas</a></li>
		     
		     <li class="divider"></li>
		     <li><a href="horasext_gral_edith.php" target="mainFrame"><i class="icon-calendar"></i>Solicitudes Pendientes por Aprobar o Rechazar</a></li>';
      }}?>
			
      
    
  </ul>
		
</div>
</td>
	  <td width="210" height="48" class="vacaciones">
<div class="g-button-group">
  			<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
    			Incapacidades <span class="caret"></span>
  			</a>
  		<ul class="dropdown-menu">
		<?php if(isset($_SESSION['privi'])){
		if($_SESSION['privi']=='2'){
				
		     echo '<li><a href="admin_incapacidades.php" target="mainFrame"><i class="icon-ok"></i> Historial Reportes por Jefe</a></li>
		     <li><a href="solicitudes_incapacidadesepl.php" target="mainFrame"><i class="icon-remove"></i>Historial de Reportes</a></li>
		     <li><a href="solicitud_vigenteincapal.php" target="mainFrame"><i class="icon-plane"></i>Incapacidades Vigentes en el Mes</a></li>
                       <li class="divider"></li>
		     <li><a href="incapacidades_gral_edith.php" target="mainFrame"><i class="icon-calendar"></i>Editar o Cerrar Registro de Ausencias Abierto</a></li>';
		}else{
		     echo '<li><a href="solicitudes_epl.php" target="mainFrame"><i class="icon-ok"></i> Historial Reportes por Jefe</a></li>
		     <li><a href="solicitudes_incapacidadesepl.php" target="mainFrame"><i class="icon-remove"></i>Historial de Reportes</a></li>
		     <li><a href="solicitud_vigenteincapal.php" target="mainFrame"><i class="icon-plane"></i>Incapacidades Vigentes en el Mes</a></li>
                       <li class="divider"></li>
		     <li><a href="incapacidades_gral_edith.php" target="mainFrame"><i class="icon-calendar"></i>Editar o Cerrar Registro de Ausencias Abierto</a></li>';
      }}?>
			
      
    
  </ul>
		
</div>
			</td>	   
		<?php if(isset($_SESSION['privi'])){
		if($_SESSION['privi']!='2'){?>
			
			<td width="210" height="48" class="editar">
		<div class="g-button-group">
  			<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
    			Editar perfil empleados <span class="caret"></span>
  			</a>
  		<ul class="dropdown-menu">	
		    <?php echo '<li><a href="editar_familiares.php" target="mainFrame"><i class="icon-user icon-black"></i> Familiar</a></li>
		     <li><a href="editar_educacion_formal.php" target="mainFrame"><i class="icon-book"></i>Educacion Formal</a></li>
		     <li><a href="editar_educacion_noformal.php" target="mainFrame"><i class="icon-pencil"></i>Educacion No Formal</a></li>
		     <li class="divider"></li>
		     <li><a href="jefe_hoja_vida.php" target="mainFrame"><i class="icon-file"></i>Hoja de vida</a></li>';
		}}?>
  </ul>	
</div>
</td>
	<td width="200" height="48" class="comprobantes"><a href="admin_certificados.php" target="mainFrame">Certificados Laborales</a></td>
	<td width="280" height="48" class="editar">
		<div class="g-button-group">
  			<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">
    			Reportes Excel <span class="caret"></span>
  			</a>
  		<ul class="dropdown-menu">	
		    <?php echo '<li><a href="capac_endu.php" target="mainFrame"><i class="icon-pencil"></i>Capacidad Endeudamiento</a></li>
		     <li class="divider"></li>
		     <li><a href="reportemail.php" target="mainFrame"><i class="icon-file"></i>Registros Email</a></li>';?>
  </ul>	
</div>		
	</td>
	<td width="210" height="48" class="novedades"><a href="clickeos.php" target="mainFrame">Reporte Click</a></td>	
	 <td width="200" height="48" class="comprobantes"><a href="reportes_excel.php" target="mainFrame">Auditoria</a></td>
	 
	</tr>
        <tr>
          <td height="435" colspan="10"><iframe src="inicio2.php" name="mainFrame" width="100%" height="435px" align="top" scrolling="auto" frameborder="0" id="mainFrame"></iframe></td>
        </tr>
        <tr>
          <td height="auto" colspan="10" class="piepag">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
</body>
</html>
