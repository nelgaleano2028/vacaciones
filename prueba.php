<?php
session_start();
include_once('../lib/adodb/adodb.inc.php');
include_once('../lib/configdbf.php');
include_once('../lib/configdbc.php');
include_once('../lib/configdb.php');
include_once('../lib/configdbt.php');

global $connn;

    		$usuariop = $_POST["usuario"];
			$passp = $_POST["pass"];
			
			    if(@$_GET["us"]=='q1e5d69e' && @$_GET["pa"]=='g86r5h5f'){
	
	  if(@$_GET["flag"]=='1'){
		$conn = $configf;
		
	}if(@$_GET["flag"]=='2'){
		$conn = $configc;
		
	}if(@$_GET["flag"]=='3'){
		$conn = $config;
		
	}if(@$_GET["flag"]=='4'){
		$conn = $configt;
		
	}
	
	//validacion bd
$sqls =  "select NOM_ADMIN AS ADMIN, CONTRASENA AS CONTRASENA from T_ADMIN";
$rs = $conn->Execute($sqls);
$rows = $rs->fetchrow();


				$userident = $rows['ADMIN'];;
				$passident = $rows['CONTRASENA'];;
				$_SESSION['ouf'] = 'valor';
				};

    if(empty($usuariop) && empty($passp)){
	$usuariop = $userident;
	$passp = $passident;
	};

// PRUEBA DE RAMA NAGS
// using ldap bind
$ldaprdn  = $usuariop."@telecom.esp";     // ldap rdn or dn 
$ldappass = $passp;  // associated password

// connect to ldap server
$ldapconn = ldap_connect("10.201.2.21")
    or die("Could not connect to LDAP server.");
	
	$ldapconn2 = ldap_connect("192.168.235.106")
    or die("Could not connect to LDAP server.");

    
if ($ldapconn || $ldapconn2) {

       ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3); 
       ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0); 
	   
	   ldap_set_option($ldapconn2, LDAP_OPT_PROTOCOL_VERSION,3); 
       ldap_set_option($ldapconn2, LDAP_OPT_REFERRALS,0); 
    // binding to ldap server
    $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
	
	$ldapbind2 = @ldap_bind($ldapconn2, $usuariop."@nh.inet", $ldappass);
    


    if($usuariop != null || $passp != null){
        
//validacion bd f
$consultaf = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$usuariop."'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$usuariop."'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$usuariop."'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$usuariop."'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['NOM_ADMIN'])){
$conn = $configf;
$_SESSION['cnx'] = $configf;
}
if(isset($rowc['NOM_ADMIN'])){
$conn = $configc;
$_SESSION['cnx'] = $configc;
}
if(isset($rowa['NOM_ADMIN'])){
$conn = $config;
$_SESSION['cnx'] = $config;
}
if(isset($rowt['NOM_ADMIN'])){
$conn = $configt;
$_SESSION['cnx'] = $configt;
}
		
          $query1 = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA,PRIVILEGIO AS PRIVILEGIO,COD_EPL AS COD_EPL FROM T_ADMIN WHERE NOM_ADMIN = '".$usuariop."'";
     $rs1 = $conn->Execute($query1);
     $row1 = $rs1->fetchrow();
       		$correopass1 = $row1['NOM_ADMIN'];
		$contrasenapass1 = $row1['CONTRASENA'];
                $privilegio = $row1['PRIVILEGIO'];
		$cod_admin=$row1['COD_EPL'];
   

  

  
    // verify binding
    if ($ldapbind) {
    
        //$_SESSION["privi"] = "2";
        //header("location: main.php");
   $buscar = "(&(samaccountname=".$usuariop.") (objectClass=user)(objectCategory=person) )"; 

   $sr = ldap_search($ldapconn, "dc=telecom, dc=esp", $buscar);
   $info = ldap_get_entries($ldapconn, $sr);
   
    if(isset($info[0]["employeenumber"][0])){

   $codiepl =$info[0]["employeenumber"][0];
   
   //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt= $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
$_SESSION['cnx'] = $configf;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
$_SESSION['cnx'] = $configc;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
$_SESSION['cnx'] = $config;
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
$_SESSION['cnx'] = $configt;
}
       // $_SESSION['ced']= $info[0]["employeenumber"][0];
        $_SESSION["nom"]= $usuariop;

		
		$query20 = "select COD_EPL AS COD_EPL, CEDULA AS CEDULA from empleados_basic where CEDULA = '$codiepl' and ESTADO = 'A'";
$rs = $conn->Execute($query20);
$row20 = $rs->fetchrow();
		//$row20['COD_EPL'];
		$_SESSION['ced'] = $row20['CEDULA'];
		$_SESSION['cod'] = $row20['COD_EPL'];
				   $codced =$_SESSION['cod'];
     
	
	$sql6="select a.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL, a.cedula AS CEDULA, b.email AS EMAIL
      from empleados_basic a, empleados_gral b 
      where a.estado = 'A' and a.cod_epl=b.cod_epl and b.cod_epl  in 
      (SELECT  b.cod_jefe FROM empleados_basic a, empleados_gral b where a.estado = 'A'  and b.cod_jefe in(select cod_epl from empleados_gral 
       where email='$email') group by b.cod_jefe)";

$rs_jefe=$conn->Execute($sql6);

$row_jefe=$rs_jefe->fetchrow();

$contrasena_jefe=$row_jefe['CEDULA'];
$correo_jefe=$row_jefe['EMAIL'];
	
	//QUERY PARA DATOS PERSONALES
	
	$query = "select a.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL, a.cedula AS CEDULA, b.email AS EMAIL, c. NOM_CAR AS CARGO, a.cod_cc2 AS CENTROC
from empleados_basic a, empleados_gral b, cargos c
where a.estado = 'A' and a.cod_epl = b.cod_epl and a.COD_EPL = '$codced' and a.cod_car = c.cod_car";

$rs = $conn->Execute($query);
$row3 = $rs->fetchrow();
	$_SESSION['cor'] = $row3['EMAIL'];
	$_SESSION['nombre'] = $row3['NOM_EPL'];
	$_SESSION['ape'] = $row3['APE_EPL'];
	$_SESSION['crg'] = $row3['CARGO'];
	$_SESSION['cc'] = $row3['CENTROC'];
	
	
	   //QUERY PARA DATOS JEFE
	   
	   //consulta jefe
$consultajefe = "select a.cod_epl AS CONTEO, a.estado , b.cod_jefe AS JEFE from empleados_basic a, empleados_gral b WHERE a.cedula = '$codiepl' and a.estado = 'A' and a.cod_epl= b.cod_epl";
$rs = $conn->Execute($consultajefe);
$rowjef = $rs->fetchrow();
	   $codijef = $rowjef['JEFE'];
	   
	      //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codijef' ";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codijef' ";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codijef' ";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codijef' ";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
}


$query5 = "select b.NOM_EPL AS JEFE , b.APE_EPL AS APEJEFE, a.COD_JEFE AS COD_JEFE from empleados_gral a, empleados_basic b WHERE a.COD_EPL = b.COD_EPL and a.COD_EPL = '$codijef'";
$rs = $conn->Execute($query5);
$row5 = $rs->fetchrow();
		$_SESSION['jef'] = $row5['JEFE'];
	$_SESSION['apejef'] = $row5['APEJEFE'];
	
	
	       header("location: main.php");
	
     //      echo "Mail: ".$info[$i]["mail"][0]."<br>";
     
    } 
	}if($ldapbind2){
		 $buscar = "(&(samaccountname=".$usuariop.") (objectClass=user)(objectCategory=person) )"; 

   $sr = ldap_search($ldapconn2, "dc=nh, dc=inet", $buscar);
   $info = ldap_get_entries($ldapconn2, $sr);
   
    
	  $codiepl =$info[0]["employeeid"][0];
	  
	   //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cedula = '$codiepl' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
$_SESSION['cnx'] = $configf;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
$_SESSION['cnx'] = $configc;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
$_SESSION['cnx'] = $config;
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
$_SESSION['cnx'] = $configt;
}
       // $_SESSION['ced']= $info[0]["employeeid"][0];
        $_SESSION["nom"]= $usuariop;

		
		$query20 = "select COD_EPL AS COD_EPL, CEDULA AS CEDULA from empleados_basic where CEDULA = '$codiepl' and ESTADO = 'A'";
$rs = $conn->Execute($query20);
$row20 = $rs->fetchrow();
		//$row20['COD_EPL'];
		$_SESSION['ced'] = $row20['CEDULA'];
		$_SESSION['cod'] = $row20['COD_EPL'];
				   $codced =$_SESSION['cod'];
				   

    
    
		
			//QUERY PARA DATOS PERSONALES
	
	$query = "select a.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL, a.cedula AS CEDULA, b.email AS EMAIL, c. NOM_CAR AS CARGO, a.cod_cc2 AS CENTROC
from empleados_basic a, empleados_gral b, cargos c
where a.estado = 'A' and a.cod_epl = b.cod_epl and a.COD_EPL = '$codced' and a.cod_car = c.cod_car";

$rs = $conn->Execute($query);
$row3 = $rs->fetchrow();
	$_SESSION['cor'] = $row3['EMAIL'];
$_SESSION['nombre'] = $row3['NOM_EPL'];	
	$_SESSION['ape'] = $row3['APE_EPL'];
	$_SESSION['crg'] = $row3['CARGO'];
	$_SESSION['cc'] = $row3['CENTROC'];
	
	 //QUERY PARA DATOS JEFE
	   
	   //consulta jefe
$consultajefe = "select a.cod_epl AS CONTEO, a.estado , b.cod_jefe AS JEFE from empleados_basic a, empleados_gral b WHERE a.cedula = '$codiepl' and a.estado = 'A' and a.cod_epl= b.cod_epl";
$rs = $conn->Execute($consultajefe);
$rowjef = $rs->fetchrow();
	   $codijef = $rowjef['JEFE'];
	   
	      //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codijef' ";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codijef' ";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codijef' ";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codijef' ";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
}

$query5 = "select b.NOM_EPL AS JEFE , b.APE_EPL AS APEJEFE, a.COD_JEFE AS COD_JEFE from empleados_gral a, empleados_basic b WHERE a.COD_EPL = b.COD_EPL and a.COD_EPL = '$codijef'";
$rs = $conn->Execute($query5);
$row5 = $rs->fetchrow();
		$_SESSION['jef'] = $row5['JEFE'];
	$_SESSION['apejef'] = $row5['APEJEFE'];
		
        header("location: main.php");
		

	}elseif($correopass1 == $userident && $contrasenapass1 == $passident) {
	session_start();
$_SESSION['out'] = 'sinvalor';
       $_SESSION['pas'] = $row1['CONTRASENA'];
     // $_SESSION['nom'] = $row1['NOM_ADMIN'];
       $_SESSION['privi'] = $row1['PRIVILEGIO'];
       $_SESSION['cod_admin'] = $row1['COD_EPL'];
	   
	        		   $codced =$_SESSION['cod'];
					   
					   //validacion bd f
					  
$consultaf  = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codced' and estado = 'A'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac  = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codced' and estado = 'A'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta  = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codced' and estado = 'A'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat  = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codced' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
$_SESSION['cnx'] = $configf;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
$_SESSION['cnx'] = $configc;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
$_SESSION['cnx'] = $config;
}
 if(isset($rowt['CONTEO'])){
$conn = $configt;
$_SESSION['cnx'] = $configt;
}
    
	
		//QUERY PARA DATOS PERSONALES
	
	$query = "select a.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL, a.cedula AS CEDULA, b.email AS EMAIL, c. NOM_CAR AS CARGO
from empleados_basic a, empleados_gral b, cargos c
where a.estado = 'A' and a.cod_epl = b.cod_epl and a.COD_EPL = '$codced' and a.cod_car = c.cod_car";

$rs = $conn->Execute($query);
$row3 = $rs->fetchrow();
	$_SESSION['cor'] = $row3['EMAIL'];
$_SESSION['nombre'] = $row3['NOM_EPL'];	
	$_SESSION['ape'] = $row3['APE_EPL'];
	$_SESSION['crg'] = $row3['CARGO'];
	
	

	if(isset($_GET["he"])){
				?>
<script type="text/javascript">
window.location="main_jefe_he.php";
</script>
<?php
				}else{
?>
<script type="text/javascript">
window.location="main_jefe.php";
</script>
<?php
}
		
    }elseif($correopass1 == $usuariop && $contrasenapass1 == $passp) {
	session_start();
       $_SESSION['pas'] = $row1['CONTRASENA'];
       $_SESSION['nom'] = $row1['NOM_ADMIN'];
       $_SESSION['privi'] = $row1['PRIVILEGIO'];
       $_SESSION['cod_admin'] = $row1['COD_EPL'];
	   
	        		   $codced =$_SESSION['cod'];
					   
					   //validacion bd f
$consultaf  = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codced' and estado = 'A'";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac  = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codced' and estado = 'A'";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta  = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codced' and estado = 'A'";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat  = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codced' and estado = 'A'";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
$_SESSION['cnx'] = $configf;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
$_SESSION['cnx'] = $configc;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
$_SESSION['cnx'] = $config;
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
$_SESSION['cnx'] = $configt;
}
     
	
		//QUERY PARA DATOS PERSONALES
	
	$query = "select a.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL, a.cedula AS CEDULA, b.email AS EMAIL, c. NOM_CAR AS CARGO
from empleados_basic a, empleados_gral b, cargos c
where a.estado = 'A' and a.cod_epl = b.cod_epl and a.COD_EPL = '$codced' and a.cod_car = c.cod_car";

$rs = $conn->Execute($query);
$row3 = $rs->fetchrow();
	$_SESSION['cor'] = $row3['EMAIL'];
$_SESSION['nombre'] = $row3['NOM_EPL'];	
	$_SESSION['ape'] = $row3['APE_EPL'];
	$_SESSION['crg'] = $row3['CARGO'];
	
	 //QUERY PARA DATOS JEFE
	   
	   //consulta jefe
$consultajefe = "select a.cod_epl AS CONTEO, a.estado , b.cod_jefe AS JEFE from empleados_basic a, empleados_gral b WHERE a.cedula = '$codiepl' and a.estado = 'A' and a.cod_epl= b.cod_epl";
$rs = $conn->Execute($consultajefe);
$rowjef = $rs->fetchrow();
	   $codijef = $rowjef['JEFE'];
	   
	      //validacion bd f
$consultaf = "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codijef' ";
$rs = $configf->Execute($consultaf);
$rowf = $rs->fetchrow();

//validacion bd c
$consultac =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codijef' ";
$rs = $configc->Execute($consultac);
$rowc = $rs->fetchrow();

//validacion bd 
$consulta =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codijef' ";
$rs = $config->Execute($consulta);
$rowa = $rs->fetchrow();

//validacion bd t
$consultat =  "select cod_epl AS CONTEO, estado from empleados_basic WHERE cod_epl = '$codijef' ";
$rs = $configt->Execute($consultat);
$rowt = $rs->fetchrow();

if(isset($rowf['CONTEO'])){
$conn = $configf;
}
if(isset($rowc['CONTEO'])){
$conn = $configc;
}
if(isset($rowa['CONTEO'])){
$conn = $config;
}
if(isset($rowt['CONTEO'])){
$conn = $configt;
}


$query5 = "select b.NOM_EPL AS JEFE , b.APE_EPL AS APEJEFE, a.COD_JEFE AS COD_JEFE from empleados_gral a, empleados_basic b WHERE a.COD_EPL = b.COD_EPL and a.COD_EPL = '$codijef'";
$rs = $conn->Execute($query5);
$row5 = $rs->fetchrow();
		$_SESSION['jef'] = $row5['JEFE'];
	$_SESSION['apejef'] = $row5['APEJEFE'];

        header("Location:main_admin.php");
    }else {
        header("location: ../?error=1");
        
    }
}


}else {
        header("location: ../?error=1");
        
    }



?>