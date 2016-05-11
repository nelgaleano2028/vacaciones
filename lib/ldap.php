<?php

include_once("adodb/adodb.inc.php");
	   
	   include_once("adodb/adodb-exceptions.inc.php");
           include_once("adodb/adodb-error.inc.php");
 
/* Make sure to set this BEFORE calling Connect() */
$LDAP_CONNECT_OPTIONS = Array(
         Array ("OPTION_NAME"=>LDAP_OPT_DEREF, "OPTION_VALUE"=>2),
         Array ("OPTION_NAME"=>LDAP_OPT_SIZELIMIT,"OPTION_VALUE"=>100),
         Array ("OPTION_NAME"=>LDAP_OPT_TIMELIMIT,"OPTION_VALUE"=>30),
         Array ("OPTION_NAME"=>LDAP_OPT_PROTOCOL_VERSION,"OPTION_VALUE"=>3),
         Array ("OPTION_NAME"=>LDAP_OPT_ERROR_NUMBER,"OPTION_VALUE"=>13),
         Array ("OPTION_NAME"=>LDAP_OPT_REFERRALS,"OPTION_VALUE"=>FALSE),
         Array ("OPTION_NAME"=>LDAP_OPT_RESTART,"OPTION_VALUE"=>FALSE)
);
$host = 'movistar-807fb8.movistarprueba.com';//ldap.baylor.edu
//$ldapbase = 'ou=People,o=Baylor University,c=US';
 
$ldap = NewADOConnection( 'ldap' );
$ldap->Connect( $host, $user_name='steven.morales', $password='TyTcali201');
 
echo "<pre>";
 
print_r( $ldap->ServerInfo() );
$ldap->SetFetchMode(ADODB_FETCH_ASSOC);
$userName = 'eldridge';
$filter="(|(CN=$userName*)(sn=$userName*)(givenname=$userName*)(uid=$userName*))";
 
$rs = $ldap->Execute( $filter );
if ($rs)
         while ($arr = $rs->FetchRow()) {
              print_r($arr);       
         }
 
$rs = $ldap->Execute( $filter );
if ($rs) 
         while (!$rs->EOF) {
                 print_r($rs->fields);     
                 $rs->MoveNext();
         } 
         
print_r( $ldap->GetArray( $filter ) );
print_r( $ldap->GetRow( $filter ) );
 
$ldap->Close();
echo "</pre>";

?>