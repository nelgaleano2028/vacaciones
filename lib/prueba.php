<?php


$valornumlet = '123123asdasda';

//compruebo que los caracteres sean los permitidos
  
   $letras = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";



			  //FUNCION PHP PARA VALIDAR SOLO NUMEROS
			  if(is_numeric($valornumlet)){
				  
				  echo 'solo numeros';
				  
			  }
			  //FUNCION PHP PARA VALIDAR SOLO LETRAS JOJO
			  if(ctype_alpha($valornumlet)){
				  
					echo 'solo letras';
					
			  }
			  
			 




?>