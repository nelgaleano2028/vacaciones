<?php
session_start();

if(isset($_SESSION['pri'])=='2'){
	header('location:../php/main.php');
	
	}elseif($_SESSION['pri']=='1'){
		
		header('location:../php/main_jefe.php');	
	
		}else if(isset($_SESSION['privi'])){
			
			header('location:../php/main_admin.php');
       
       		}else{

			header('location:../');
		}
?>