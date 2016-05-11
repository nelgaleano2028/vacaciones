<?php
session_start();

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

$codigo = $_SESSION['nom'];;


@$passn = $_POST["passn"];
@$pass = $_POST["pass"];
@$actual = $_POST["passv"];



$query1 = "SELECT  nom_admin as NOM_ADMIN, contrasena as CONTRASENA FROM t_admin WHERE nom_admin ='$codigo'";
$rs1 = $conn->Execute($query1);
$row1 = $rs1->fetchrow();
$password_nuevo = $row1['CONTRASENA'];
$usuario_nuevo = $row1['NOM_ADMIN'];

$query1 = "select valor as VALOR from parametros_nue where nom_var='t_period_clave'";
$rs1 = $conn->Execute($query1);
$row1 = $rs1->fetchrow();
$period_clave = $row1['VALOR'];

$tam = strlen($_POST["pass"]);

if(empty($actual)){
header("Location:nuevopass_admin.php?456789=71");

} 
if( $tam < 6 ){
	
	header("Location:nuevopass_admin.php?23451=82");
}else if(is_numeric($_POST["pass"])){
				  
				 header("Location:nuevopass_admin.php?23451=80");
				  
			  }elseif(ctype_alpha($_POST["pass"])){
				  
					header("Location:nuevopass_admin.php?23451=81");
					
			  }elseif($password_nuevo==$_POST["pass"]){
				  
					header("Location:nuevopass_admin.php?456789=61");
					
			  }elseif (isset($password_nuevo) && $password_nuevo == $actual){
				  
				  //valida que la contraseña no este en el historico
				  //die($codigo);
				 $query = "select * from hist_passw 
							  where fecha between ADD_MONTHS(sysdate,-($period_clave)) AND SYSDATE 
							  and usuario = 'WEB'||UPPER('$codigo') and password = '$pass' ";
							  
				 $rs = $conn->Execute($query);
				   if($rs->RecordCount() > 0){
					   
						header("Location:nuevopass_admin.php?456789=62&1234=".$period_clave);
					}else{

						$query = "UPDATE t_admin SET contrasena='$pass' WHERE nom_admin='$codigo'";
						$rs = $conn->Execute($query);
						
						$query = "insert into hist_passw (password,usuario,fecha) values('$pass','WEB'||UPPER('$codigo'),sysdate)";
						//die($query);
						$rs = $conn->Execute($query);

						header("Location:nuevopass_admin.php?293875=76");

					}

}else{
header("Location:nuevopass_admin.php?456789=71");

}

?>