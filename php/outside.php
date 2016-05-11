<?php

session_start();
echo $nombre=$_GET["ou"]; 

if(isset($nombre)){

$_SESSION = array();

session_destroy();

header('Location: ../index.php');

}elseif(empty($nombre)){

$_SESSION = array();

session_destroy();

?>

<span class="Estilo1"><script> 
      alert("Por favor revise su usuario y clave")
	  window.location = "../index.php";
     </script></span>

<?php
}
echo '1';
?>