<?php
session_start();



if (isset($_SESSION['ced'])){
		@$_SESSION['cod'];
		@$_SESSION['cor'];        
        	@$_SESSION['nom'];
		@$_SESSION['ape'];



}elseIF($_SESSION['ouf']=='valor'){
header ("Location:outside.php?ou=1");

}elseIF($_SESSION['out']=='sinvalor'){
header ("Location:outside.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"> 
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>.:Auto Gestion Nomina:.</title>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<link rel="stylesheet" href="../css/google-buttons.css" type="text/css"  media="screen" />

<script src="../js/jquery-1.7.1.min.js"></script>
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


.dropdown-menu{
padding:5px;
position:absolute;
width:150px;
padding:0px 0;
border: 1px solid #ccc;
border: 1px soli rgba(0, 0, 0, 0.2);




}
.dropdown-menu a{
color:black;
}

ul{
list-style:none;
padding:0;



}
.submenu{

position:absolute;
top:30px;
left:185px;
display:none;

padding:0px 0;
border: 1px solid #ccc;
border: 1px soli rgba(0, 0, 0, 0.2);





}

.dropdown-menu li:hover ul{

display:block;
background:gray;
pointer:cursor;



}

.submenu > li> a{
background:white;

list-style:none;
width:310px;
color:black;



}


</style>



   
    <script src="../js/bootstrap-dropdown.js"></script>



</head>
<body class="barramenu content_1 content">
  <table width="100%" border="0" height="auto">
    <tr>
      <td height="auto" valign="top"><table width="100%" border="0" height="auto">
        <tr>
          <td width="100%" height="145" colspan="4" class="monitores"><a href="cerrarpesta.php?modulo=he" class="linkba" style="color: black;">.: Volver al perfil empleado :.</a></td>
        </tr>
        <tr>

          <td width="25%" height="48" class="hv"><a href="he_solicitudes_epl_jefe.php" target="mainFrame">Historial Solicitudes por Empleado</a></td>

          <td width="25%" height="48" class="comprobantes"><a href="he_epl_jefe_rechazados.php" target="mainFrame">Historial Solicitudes Rechazadas</a></td>


	  <td width="25%" height="48" class="vacaciones"><a href="horasextras_gral.php" target="mainFrame">Solicitudes Pendientes por Aprobar o Rechazar</a></td>
 </tr>
        <tr>
          <td id='content' height="550" colspan="4">
        <div class="overview"> <iframe src="horasextras_gral.php"  name="mainFrame" width="100%" height="620px"  scrolling="auto" frameborder="0" id="mainFrame"></iframe></td>
        </tr>
        
      </table></td>
    </tr>
  </table>
</body>
</html>

