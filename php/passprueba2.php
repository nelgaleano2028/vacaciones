
<?php
$message = array();             

function changePassword($user,$oldPassword,$newPassword,$newPasswordCnf){
  global $message;

$server = "192.168.0.60";
$dn = "dc=movistarprueba, dc=com";
 $usuario=$user;
$user = $user . "@movistarprueba.com";


$message[] = "User: " .$user;
$message[] = "Pass: " . $oldPassword;
$message[] = "nPass: " .$newPassword;

$ldapconn = ldap_connect("192.168.0.60")
    or die("Could not connect to LDAP server.");

    
if ($ldapconn) {

       ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3); 
       ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0); 
    // binding to ldap server
    $ldapbind = @ldap_bind($ldapconn, $user, $oldPassword);
    

   
    // verify binding
    if ($ldapbind) {
    
        //$_SESSION["privi"] = "2";
        //header("location: main.php");
   $buscar = "(&(samaccountname=".$usuario.") (objectClass=user)(objectCategory=person) )"; 

   $sr = ldap_search($ldapconn, "dc=movistarprueba, dc=com", $buscar);
   $info = ldap_get_entries($ldapconn, $sr);
   
   //
   //$_SESSION['cod'] =$info[0]["mail"][0];
   //     $_SESSION['ced']= $info[0]["mail"][0];
   //     $_SESSION["nom"]= $_POST["usuario"];
   //     header("location: main.php");
 
    }elseif($ldapbind == false) {
     $message[] = "Error E104 - Current password is wrong.";
        return false;
    }else {}
     if ($newPassword != $newPasswordCnf ) {
    $message[] = "Error E101 - New passwords do not match! ";
    return false;
  }
  if (strlen($newPassword) < 8 ) {
    $message[] = "Error E102 - Your new password is too short! ";
    return false;
  }
  if (!preg_match("/[0-9]/",$newPassword)) {
    $message[] = "Error E103 - Your password must contain at least one digit. ";
    return false;
  }
  if (!preg_match("/[a-zA-Z]/",$newPassword)) {
    $message[] = "Error E103 - Your password must contain at least one letter. ";
    return false;
  }


  /* change the password finally */
  $entry = array();
  $entry["userPassword"] = "{SHA}" . base64_encode( pack( "H*", sha1( $newPassword ) ) );
  
  if (ldap_modify($ldapconn,$usuario,$entry) === false){
    $message[] = "E200 - Your password cannot be change, please contact the administrator.";
  }
  else { 
    $message[] = " Your password has been changed. "; 
    //mail($records[0]["mail"][0],"Password change notice : ".$user,"Your password has just been changed."); 
    } 




}







 
}  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 <title>Ændring af password</title>
 <style type="text/css">
 body { font-family: Verdana,Arial,Courier New; font-size: 0.7em;  }
 input:focus { background-color: #eee; border-color: red; }
 th { text-align: right; padding: 0.8em; }
 #container { text-align: center; width: 500px; margin: 5% auto; } 
 ul { text-align: left; list-style-type: square; } 
 .msg { margin: 0 auto; text-align: center; color: navy;  border-top: 1px solid red;  border-bottom: 1px solid red;  } 
 </style>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div id="container">
<h2> Ændring af password </h2>
<ul>
</ul>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" name="passwordChange" method="post">
  <table style="width: 400px; margin: 0 auto;">
    <tr><th>MA nr:</th><td><input name="username" type="text" size="20" autocomplete="off" /></td></tr>
    <tr><th>Gammelt password:</th><td><input name="oldPassword" size="20" type="password" /></td></tr>
    <tr><th>Nyt password:</th><td><input name="newPassword1" size="20" type="password" /></td></tr>
    <tr><th>Nyt password (Bekræft):</th><td><input name="newPassword2" size="20" type="password" /></td></tr>
    <tr><td colspan="2" style="text-align: center;" >
        <input name="submitted" type="submit" value="OK"/></td></tr>
  </table>
</form>
<div class="msg">
<?php 
if (isset($_POST["submitted"])) {
  changePassword($_POST['username'],$_POST['oldPassword'],$_POST['newPassword1'],$_POST['newPassword2']);
  foreach ( $message as $one ) { echo "<p>$one</p>"; }
} 
?>
</div>
</div>
</body></html>