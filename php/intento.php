<?php
		
	

	$usuariop = 'Marlon.garcia';
	$passp = 'Quindio851031';
	


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
   echo $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
	
	echo $ldapbind2 = @ldap_bind($ldapconn2, $usuariop."@nh.inet", $ldappass);

  
    // verify binding
    if ($ldapbind) {
    
        //$_SESSION["privi"] = "2";
        //header("location: main.php");
   $buscar = "(&(samaccountname=".$usuariop.") (objectClass=user)(objectCategory=person) )"; 

   $sr = ldap_search($ldapconn, "dc=telecom, dc=esp", $buscar);
   $info = ldap_get_entries($ldapconn, $sr);
   
    
if(isset($info[0]["employeenumber"][0])){
echo '2';

  echo $codiepl =$info[0]["employeenumber"][0];
   }
	}if($ldapbind2){
		 $buscar = "(&(samaccountname=".$usuariop.") (objectClass=user)(objectCategory=person) )"; 

   $sr = ldap_search($ldapconn2, "dc=nh, dc=inet", $buscar);
   $info = ldap_get_entries($ldapconn2, $sr);
   echo '3';
    
	  echo $codiepl =$info[0]["employeeid"][0];
	  }



}



?>