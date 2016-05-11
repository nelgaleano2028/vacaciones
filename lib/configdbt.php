<?php
	   include_once("adodb/adodb.inc.php");
	   
	   include_once("adodb/adodb-exceptions.inc.php");
           include_once("adodb/adodb-error.inc.php");
	   
	   $odbc="oci8";
	   $user = "WEBTALENTOS";
	   $pass = "Temporal01";
	   
	   $is_connect = false;
	   
	   try{
	   $conn = ADONewConnection($odbc);
	   $dsn ="(DESCRIPTION=
    (ADDRESS=
      (PROTOCOL=TCP)
      (HOST=10.81.160.169)
      (PORT=1521)
    )
    (CONNECT_DATA=
      (SID=TGT)
    )
  )";
	   @$conn->Connect($dsn,$user,$pass);
	   $conn->SetFetchMode(ADODB_FETCH_ASSOC);
	   
	   if($conn->isConnected())$is_connect=true;
	   else $is_connect=false;
	   }catch (exception  $e) 
	   { 
	      die($e->getMessage());
	     
	   }
	   $configt = $conn;
	   ?>