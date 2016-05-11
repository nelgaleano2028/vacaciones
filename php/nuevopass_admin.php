<?php
@session_start();


if (!isset($_SESSION['privi'])){
  
echo "<script>location.href='index.php'</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    
   <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <link href="../css/demopass.css" rel="stylesheet" type="text/css" />

    <link href="../css/stylepass.css" rel="stylesheet" type="text/css" />
   
    
    
    <link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
    <link rel="stylesheet" href="../css/validacion.css" media="screen" />
    <link type="text/css" href="../css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
    <link rel="stylesheet" type="text/css" href="../css/general.css" />
    <link rel="stylesheet" type="text/css" href="../js/chosen/chosen.css"  />
    <link rel="stylesheet" href="../css/jquery.ui.all.css">
    <link rel="stylesheet" type="text/css" href="../css/scroll.css"  />
 
<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/pschecker.js" type="text/javascript"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>
<script type='text/javascript' src='../js/funciones.js'></script>
<script type="text/javascript">
function isNumber(e) {
k = (document.all) ? e.keyCode : e.which;
if (k==8 || k==0) return true;
patron =/\w/;
n = String.fromCharCode(k);
return patron.test(n);
}
</script>
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
        <form action="cambiapass_admin.php" method="post">
    <div class="wrapper">
        <div class="logo">
            <img src="../imagenes/logo.jpg" alt="logo" /></div>
        <br>
        <div class="password-container">

        <p>
                <label>
                    Contrase&ntilde;a Actual:</label>
                <input name="passv" type="password" id="passv" />
            </p>
            <p>
                <label>
                    Nueva Contrase&ntilde;a:</label>
                <input name="passn" type="password" class="strong-password" id="passn" onkeypress="return isNumber(event);"/>
            </p>
            <p>
                <label>
                    Confirmar Contrase&ntilde;a:</label>
                <input name="pass" type="password" class="strong-password" id="pass" onkeypress="return isNumber(event);"/>
            </p>
            <p>
                <input class="submit-button locked boton" type="submit"  value="Enviar"/>
            </p>
            
            <div class="strength-indicator">
                <div class="meter">
                </div>
                
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
	 $(window).load(function() {
	mensaje("Mensaje","300","Se actualizó correctamente la contraseña");
	 });
      //alert("Se actualizó correctamente la contraseña");
     </script>  
<?php
}
if(empty($_GET['456789'])){
$_GET['456789'] = "";

}elseif($_GET['456789'] == "71"){ 
?>
     <script>
	$(window).load(function() {
	mensaje("Mensaje","300","La contraseña actual no es correcta");
	 });
      //alert("La contraseña actual no es correcta");
     </script>  
<?php
}
if($_GET['23451'] == "80"){ 
?>
     <script>
	$(window).load(function() {
	mensaje("Mensaje","300","La contraseña actual no es correcta, por favor ingrese almenos una letra");
	 });      
     </script>  
<?php
}elseif($_GET['23451'] == "81"){ 
?>
     <script>
	$(window).load(function() {
	mensaje("Mensaje","300","La contraseña actual no es correcta, por favor ingrese almenos un numero");
	 });     
     </script>  
<?php
}elseif($_GET['23451'] == "82"){ 
?>
     <script>
	$(window).load(function() {
	mensaje("Mensaje","300","La contraseña debe tener minimo 6 caracteres");
	 });     
     </script>  
<?php
}
if($_GET['456789'] == "61"){ 
?>
     <script>
	$(window).load(function() {
	mensaje("Mensaje","300","La contraseña nueva ya existe");
	 });
     </script>  
<?php
}
if($_GET['456789'] == "62"){ 
?>
     <script>
	 var period_clave = "<?php echo $_GET['1234']; ?>";
	 $(window).load(function() {
	mensaje("Mensaje","300","La contraseña nueva ya fue usada en menos de "+period_clave+" meses");
	 });
     </script>  
<?php
}
?>