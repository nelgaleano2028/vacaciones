<?php

session_start();

$_SESSION = array();

session_destroy();

?>

<span class="Estilo1"><script> 
      alert("La sesion ha cerrado correctamente")
	  window.location = "../index.php";
     </script></span>