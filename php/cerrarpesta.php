<?php
session_start();

$modulo=$_GET['modulo'];

if($modulo=='he'){
?>
<body>
<span><script> 
      alert("Ha salido del modulo de trabajos por turnos")
	  window.close();
     </script></span>
	 </body> 
<?php
}elseif($modulo=='vac'){
?>
<body>
<span><script> 
      alert("Ha salido del modulo de vacaciones")
	  window.close();
     </script></span>
	 </body> 
<?php
}
?>