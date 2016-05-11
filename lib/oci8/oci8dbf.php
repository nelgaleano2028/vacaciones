<?php
		$odbc="oci8";
	    $user = "WEBTALENTOS";
	    $pass = "Temporal01";

		
		$db="(DESCRIPTION=
    (ADDRESS=
      (PROTOCOL=TCP)
      (HOST=10.80.6.233)
      (PORT=1521)
    )
    (CONNECT_DATA=
      (SERVER=dedicated)
      (SID=FUNDACIO)
    )
  )
  ";
  
  $conn = oci_connect($user,$pass,$db);
  
  if(!$conn){
	  
	  die ('no se conecto');
  }
		   $configf = $conn;	
?>