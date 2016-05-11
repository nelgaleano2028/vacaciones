<?php
include_once('../lib/adodb/adodb.inc.php');
include_once('../lib/configdb.php');

$email = $_POST["email"];
$pass = $_POST["pass"];


$sql="select a.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL, a.cedula AS CEDULA, b.email AS EMAIL
      from empleados_basic a, empleados_gral b 
      where a.estado = 'A' and a.cod_epl=b.cod_epl and b.cod_epl  in 
      (SELECT  b.cod_jefe FROM empleados_basic a, empleados_gral b where a.estado = 'A'  and b.cod_jefe in(select cod_epl from empleados_gral 
       where email='$email') group by b.cod_jefe)";

$rs_jefe=$conn->Execute($sql);

$row_jefe=$rs_jefe->fetchrow();

$contrasena_jefe=$row_jefe['CEDULA'];
$correo_jefe=$row_jefe['EMAIL'];

//QUERY PARA DATOS JEFE

$query5 = "select b.NOM_EPL AS JEFE , b.APE_EPL AS APEJEFE from empleados_gral a, empleados_basic b WHERE a.COD_JEFE = b.COD_EPL and a.email = '$email'";

$rs = $conn->Execute($query5);
$row5 = $rs->fetchrow();

$jefe = $row5['JEFE'];



$query = "select a.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL, a.cedula AS CEDULA, b.email AS EMAIL, c. NOM_CAR AS CARGO
from empleados_basic a, empleados_gral b, cargos c
where a.estado = 'A' and a.cod_epl = b.cod_epl and b.email = '$email' and a.cod_car = c.cod_car";

$rs = $conn->Execute($query);
$row3 = $rs->fetchrow();

$contrasenapass = $row3['CEDULA'];
$correopass = $row3['EMAIL'];
$cargo = $row3['CARGO'];
		

$query1 = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL 
FROM T_ADMIN WHERE NOM_ADMIN = '$email'";

$rs1 = $conn->Execute($query1);
$row1 = $rs1->fetchrow();

$correopass1 = $row1['NOM_ADMIN'];
$contrasenapass1 = $row1['CONTRASENA'];
$privilegio = $row1['PRIVILEGIO'];
$cod_admin=$row1['COD_EPL'];


$query2 = "SELECT C.COD_EPL, C.NOM_EPL, C.APE_EPL, C.CEDULA, B.EMAIL, A.PASS, A.USUARIO
FROM EMPLEADOS_BASIC C, T_NUEVO_PASS A, EMPLEADOS_GRAL B 
WHERE C.COD_EPL = B.COD_EPL AND A.USUARIO = B.EMAIL AND A.USUARIO = '$email'";

$rs2 = $conn->Execute($query2);
$row2 = $rs2->fetchrow();

$correopass2 = $row2['USUARIO'];
$contrasenapass2 = $row2['PASS'];
$pri = $row2['PRI'];


//evita la seguridad del IE hasta cierto punto... si deshabilitan las cookies totalmente llorelo!

header('P3P: CP="IDC DSP COR CURa DMa OUR IND PHY ONL COM STA"');



if (empty($email)){

header("Location:../index.php?33453=06");

}elseif ($correo_jefe == $email && $contrasena_jefe == $pass && empty($contrasenapass2)) {
	session_start();
	$_SESSION['cod'] = $row3['COD_EPL'];
        $_SESSION['cor'] = $row3['EMAIL'];
        $_SESSION['ced'] = $row3['CEDULA'];
        $_SESSION['nom'] = $row3['NOM_EPL'];
	$_SESSION['ape'] = $row3['APE_EPL'];
	$_SESSION['pri'] = '1';
	$_SESSION['privi'] = '1';
	$_SESSION['jef'] = $row5['JEFE'];
	$_SESSION['apejef'] = $row5['APEJEFE'];
	$_SESSION['crg'] = $row3['CARGO'];
header("Location:main_jefe.php");

}

elseif ($correopass == $email && $contrasenapass == $pass && empty($contrasenapass2)) {
	session_start();
	$_SESSION['cod'] = $row3['COD_EPL'];
        $_SESSION['cor'] = $row3['EMAIL'];
        $_SESSION['ced'] = $row3['CEDULA'];
        $_SESSION['nom'] = $row3['NOM_EPL'];
	$_SESSION['ape'] = $row3['APE_EPL'];
	$_SESSION['pri'] ='2';
	$_SESSION['jef'] = $row5['JEFE'];
	$_SESSION['apejef'] = $row5['APEJEFE'];	
		$_SESSION['crg'] = $row3['CARGO'];
header("Location:main.php");
}elseif ($correo_jefe == $email && $contrasena_jefe == $pass ) {

   
   session_start();

       $_SESSION['cod'] = $row_jefe['COD_EPL'];
       $_SESSION['cor'] = $row_jefe['EMAIL'];
       $_SESSION['ced'] = $row_jefe['CEDULA'];
       $_SESSION['nom'] = $row_jefe['NOM_EPL'];
       $_SESSION['ape'] = $row_jefe['APE_EPL'];
       $_SESSION['pri'] = '1';
	$_SESSION['privi'] = '1';
header("Location:main_jefe.php");
}
elseif ($correopass2 == $email && $contrasenapass2 == $pass && $pri=='2' ) {

		
		session_start();
	$_SESSION['cod'] = $row3['COD_EPL'];
        $_SESSION['cor'] = $row3['EMAIL'];
        $_SESSION['ced'] = $row3['CEDULA'];
        $_SESSION['nom'] = $row3['NOM_EPL'];
	$_SESSION['ape'] = $row3['APE_EPL'];
 	$_SESSION['pri'] ='2';
	$_SESSION['jef'] = $row5['JEFE'];
	$_SESSION['apejef'] = $row5['APEJEFE'];	
		$_SESSION['crg'] = $row3['CARGO'];
header("Location:main.php");
}
elseif ($correopass2 == $email && $contrasenapass2 == $pass && $pri=='1' ) {

		
		session_start();
	$_SESSION['cod'] = $row3['COD_EPL'];
        $_SESSION['cor'] = $row3['EMAIL'];
        $_SESSION['ced'] = $row3['CEDULA'];
        $_SESSION['nom'] = $row3['NOM_EPL'];
	$_SESSION['ape'] = $row3['APE_EPL'];
	  $_SESSION['pri'] = '1';
$_SESSION['privi'] = '1';
header("Location:main_jefe.php");
}
elseif ($correopass1 == $email && $contrasenapass1 == $pass) {
	session_start();
       $_SESSION['pas'] = $row1['CONTRASENA'];
       $_SESSION['nom'] = $row1['NOM_ADMIN'];
       $_SESSION['privi'] = $row1['PRIVILEGIO'];
       $_SESSION['cod_admin'] = $row1['COD_EPL'];

header("Location:main_admin.php");
}
else {
header("Location:../index.php?456778=03");
}

?>