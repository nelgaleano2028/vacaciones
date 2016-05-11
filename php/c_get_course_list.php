<?php
include_once('../lib/adodb/adodb.inc.php');
include_once('../lib/configdb.php');


$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select DISTINCT nom_ciu from ciudades where nom_ciu LIKE '%$q%'";
$rsd = $conn->Execute($sql); 
while($rs = $rsd->fetchrow()){
	$cname = $rs['nom_ciu'];
	echo "$cname\n";
}
?>