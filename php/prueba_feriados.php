<?php
include_once('../lib/adodb/adodb.inc.php');
include_once('../lib/configdb.php');
global $conn;

$sql="select * from feriados ";
$rs1 = $conn->Execute($sq);



echo "<table border='1'>";

while($reg= $rs1->FetchRow())
{
	echo "<tr>";
	foreach($reg as $key => $value){ 
		
			echo '<td>'.$value.'</td>';
		
	}
	echo "</tr>";
}

echo "</table>";
?>