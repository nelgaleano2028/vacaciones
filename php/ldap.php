<?php
session_start();

include_once('../lib/configdb.php');
global $conn;

// using ldap bind
$ldaprdn  = $_POST["email"]."@epsa.co";     // ldap rdn or dn
$ldappass = $_POST["pass"];  // associated password

// connect to ldap server
$ldapconn = ldap_connect("vulcano")
    or die("Could not connect to LDAP server.");

    
if ($ldapconn) {

       ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3); 
       ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0); 
    // binding to ldap server
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
    


    
    

    if($_POST["usuario"] != null || $_POST["pass"] != null){
        
          $query1 = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN 

WHERE NOM_ADMIN = '".$_POST["usuario"]."'";
     $rs1 = $conn->Execute($query1);
     $row1 = $rs1->fetchrow();
       		$correopass1 = $row1['NOM_ADMIN'];
		$contrasenapass1 = $row1['CONTRASENA'];
                $privilegio = $row1['PRIVILEGIO'];
		$cod_admin=$row1['COD_EPL'];
   
    // verify binding
    if ($ldapbind) {
    
        
   $buscar = "(&(samaccountname=".$_POST["usuario"].") (objectClass=user)(objectCategory=person) )"; 

   $sr = ldap_search($ldapconn, "dc=epsa, dc=co", $buscar);
   $info = ldap_get_entries($ldapconn, $sr);

   $email=$info[0]['mail'][0];

 
  
/*--JEFE--*/
$sql="select a.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL, a.cedula AS CEDULA, b.email AS EMAIL
      from empleados_basic a, empleados_gral b 
      where a.estado = 'A' and a.cod_epl=b.cod_epl and b.cod_epl  in 
      (SELECT  b.cod_jefe FROM empleados_basic a, empleados_gral b where a.estado = 'A'  and b.cod_jefe in(select cod_epl from 

empleados_gral 
       where email='$email') group by b.cod_jefe)";


$rs_jefe=$conn->Execute($sql);

$row_jefe=$rs_jefe->fetchrow();

$contrasena_jefe=$row_jefe['CEDULA'];
$correo_jefe=$row_jefe['EMAIL'];


/*--FIN JEFE--*/



/*---EMPLEADO--*/

$query = "select a.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL, a.cedula AS CEDULA, b.email AS EMAIL 
from empleados_basic a, empleados_gral b 
where a.estado = 'A' and a.cod_epl = b.cod_epl and b.email = '$email'";

$rs = $conn->Execute($query);
$row3 = $rs->fetchrow();

$contrasenapass = $row3['CEDULA'];
$correopass = $row3['EMAIL'];

/*--FIN EMPLEADO--*/

		if($email == $correo_jefe) {

   
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
elseif($email == $correopass) {

		
		session_start();
	$_SESSION['cod'] = $row3['COD_EPL'];
        $_SESSION['cor'] = $row3['EMAIL'];
        $_SESSION['ced'] = $row3['CEDULA'];
        $_SESSION['nom'] = $row3['NOM_EPL'];
	$_SESSION['ape'] = $row3['APE_EPL'];
 	$_SESSION['pri'] ='2';
header("Location:main.php");
}else{
	header("location: ../?error=1");
}
    
   
   
    }elseif($correopass1 == $_POST["usuario"] && $contrasenapass1 == $_POST["pass"]) {
	session_start();
       $_SESSION['pas'] = $row1['CONTRASENA'];
       $_SESSION['nom'] = $row1['NOM_ADMIN'];
       $_SESSION['privi'] = $row1['PRIVILEGIO'];
       $_SESSION['cod_admin'] = $row1['COD_EPL'];
        header("Location:main_admin.php");
    }else {
        header("location: ../?error=2");
        
    }
}


}



?>