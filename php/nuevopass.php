<?php
@session_start();

if (!isset($_SESSION['ced'])){
  
  echo "<script>location.href='index.php'</script>";
}

   if(isset($_GET["mensaje"])){
    echo '<link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
          <script src="../js/jquery-1.7.1.min.js"></script>
          <script type="text/javascript" src="../js/funciones.js"></script>
          
          <script>
	  $(window).load(function (){
	  notify("Debe modificar su contraseña actual por seguridad de su cuenta.",500,8000,"warning","warning");
	  })
	  </script>';
    }
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    
    
    <link href="../css/demopass.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../css/scroll.css"  />
    <link href="../css/stylepass.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-1.7.1.min.js"></script>
    <script src="../js/pschecker.js" type="text/javascript"></script>
    
    

    <script type="text/javascript">
        $(document).ready(function () {
           
            //Demo code
            $('.password-container').pschecker({ onPasswordValidate: validatePassword, onPasswordMatch: matchPassword });

            var submitbutton = $('.submit-button');
            var errorBox = $('.error');
            errorBox.css('visibility', 'hidden');
            submitbutton.attr("disabled", "disabled");

            //this function will handle onPasswordValidate callback, which mererly checks the password against minimum length
            function validatePassword(isValid) {
                if (!isValid)
                    errorBox.css('visibility', 'visible');
                else
                    errorBox.css('visibility', 'hidden');
            }
            //this function will be called when both passwords match
            function matchPassword(isMatched) {
                if (isMatched) {
                    submitbutton.addClass('unlocked').removeClass('locked');
                    submitbutton.removeAttr("disabled", "disabled");
                }
                else {
                    submitbutton.attr("disabled", "disabled");
                    submitbutton.addClass('locked').removeClass('unlocked');
                }
            }
        });
    </script>
</head>
<body>
    
        <form action="cambiapass.php" method="post">
    <div class="wrapper">
        <div class="logo">
            <img src="../imagenes/logo.jpg" alt="logo" /></div>
        <p>
            
        </p>
        <div class="password-container">

        <p>
                <label>
                    Contraseña Actual:</label>
                <input name="passv" type="password" id="passv" />
            </p>
            <p>
                <label>
                    Nueva Contraseña:</label>
                <input name="passn" type="password" class="strong-password" id="passn" />
            </p>
            <p>
                <label>
                    Confirmar Contraseña:</label>
                <input name="pass" type="password" class="strong-password" id="pass" />
            </p>
            <p>
                <input class="submit-button locked" type="submit"  value="Enviar"/>
            </p>
            
            <div class="strength-indicator">
                <div class="meter">
                </div>
                <span id="result_box" lang="es" xml:lang="es">Las contraseñas seguras contienen 8-16 caracteres, no incluyen palabras comunes o nombres, y combinan mayúsculas, minúsculas, números y símbolos.</span></div>
                
        </div>
    </div>
    </form>
	</body>
</html>
<?php
if(empty($_GET['293875'])){
$_GET['293875'] = "";

}elseif($_GET['293875'] == "76"){ 
?> 
     <script> 
      alert("Se actualizó correctamente la contraseña");
      top.location.href="index.php";
     </script>  
<?php
}
if(empty($_GET['456789'])){
$_GET['456789'] = "";

}elseif($_GET['456789'] == "71"){ 
?>
     <script> 
      alert("La contraseña no es correcta");
     </script>  
<?php
}
?>