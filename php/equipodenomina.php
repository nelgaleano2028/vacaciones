<?php
@session_start();


if (!isset($_SESSION['ced'])){
  
  header("location: index.php");
}
require_once('../lib/configdb.php');



global $conn;

$codigo=$_SESSION['cod'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
.contenido {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
}
.contenido {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
body,td,th {
	color: #666;
	font-size: 13px;
}
.contenido span strong em {
	font-size: 13px;
}
</style>
	<style type="text/css">
@import url("../css/plantilla_user.css");
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
    a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
    .asa {
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif; font-size:12px; line-height: 20px; text-align: center;
}
.justifyText {
	text-align:justify; font-size:12px; line-height: 20px; font-family: Arial, Helvetica, sans-serif;
	}
    </style>





<body>
<table width="70%" border="0" align="center">
  <tr>
    <td><p class="asa">JEFATURA DE NOMINA - GERENCIA DE SERVICIOS ECONOMICOS</p>
      <p CLASS="justifyText"><br />
      La <strong>Dirección de Operaciones Comerciales</strong> a través del Centro de  Servicios Compartidos, te presenta la Jefatura de Nómina.</p>

      <table width="100%" border="0">
        
        <tr>
          <td><p CLASS="justifyText">Leonardo Walles Valencia, Jefe De Nómina<br />
Marisol Ducuara Aragon, Amparo Cerquera Caldas, Jose William Leiton   Hernandez, Hector Frandey Lopez Castillo, Profesionales de Nómina<br />
Diana Cristina Gonzalez Hernandez, Laura Andrea Correa Cardona, Davindson Andres Fontalvo Romero, Analistas De Nómina<br />
Yeny Mayoly Vargas Rodriguez  - Aprendiz Sena, Maria Paula Avila Perez - Estudiante en Practica</p></td>
        </tr>
      </table>
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%"></td>
        </tr>
      </table>
      <p CLASS="justifyText"><strong>¿Cuál es el objetivo de la Jefatura de Nómina?</strong><br />
     Garantizar que en el proceso de liquidación de nómina se cumplan las normas legales de tipo 

laboral y las fechas de pago acordadas para los empleados y terceros. Además, asegurar que la 

información requerida por las entidades (internas y externas) de control, sea veraz, esté 

debidamente soportada y sea entregada de manera oportuna. Por último, y no menos importante, 

queremos generar servicios de autogestión para dar respuesta a los empleados en los temas 

relacionados con la nómina.</p>
<p CLASS="justifyText"><strong>¿Cuáles son los  retos para este año? </strong> <br />
 La revisión de la estructura de los procesos críticos de Nómina e identificar cuáles son susceptibles

de mejora y sistematización; así, podremos crear marcadores de gestión, que nos permitan 

continuar garantizando la oportunidad, confiabilidad y calidad en los servicios que se han venido 

prestando al Grupo Telefónica. Nuestro compromiso es asegurar la información y los recursos 

necesarios que nos permitan superar las expectativas de nuestros clientes internos y externos.</p>
<p CLASS="justifyText"><strong>¿Por  qué es tan importante la Jefatura de Nómina en nuestra compañía? </strong><br />
La Jefatura de Nómina hace parte de la Gerencia de Servicios Económicos del Centro de Servicios 

Compartidos. Es un área de apoyo de la compañía por lo tanto se enfocan en brindar excelentes 

niveles de servicio, como también en aportar de forma ágil en todos los procesos que requieren de 

nuestro apoyo, como:</p>
<p CLASS="justifyText">• Contratación de colaboradores directos, jóvenes profesionales, aprendices SENA y practicantes universitarios.<br />
• Aplicación de modificaciones contractuales.<br />
• Tramite y liquidación de las novedades de pago y/o descuentos propios o  terceros de los colaboradores.<br />
• Liquidación de vacaciones.<br />
• Pagos asociados a la liquidación de comisiones, horas extras y recargos.<br />
• Administración de la seguridad social.<br />
• Gestión de pago nómina de terceros (libranzas) y temporales.<br />
• Gestión del plan de acciones de los empleados.<br />
• Asesoría a empleados sobre sus beneficios tributarios, ahorros voluntarios,  devengos y descuentos de nómina.<br />
• Autorización para retiro de Cesantías<br />
• Trámite y pago de la nómina de nuestros empleados de Movistar, Fundación Telefónica Colombia y Telefónica Global Technology Sucursal Colombia.</p></td>
  </tr>
</table>

<table width="100%"  border="0">
<tr>
          <td class="piepag">&nbsp;</td>
  </tr>
</table>
</body>

</html>