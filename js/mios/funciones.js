$(function(){	
  try{			
		$(".boton").button(); //clase para los botones
  }catch(err){return;}
});	
$(function(){
	try{
		$(".combo").chosen(); //clase para los combobox		
	}catch(err){return;}
});	

//CLASES PARA LOS CAMPOS FECHA
$(function(){
	/*$('.fecha_uno').datepicker({
		                dateFormat: 'yy-mm-dd',																 
						inline: true
	});*/
	
	$('.calendar_option').datepicker({
		                dateFormat: 'yy-mm-dd',						
						changeMonth: true,
						changeYear: true,										 
						inline: true
	});
	
	
});

//funcion para cargar un autocompletar simple en un campo de texto
function field_autocomplete(fieldID,val_url,val_type){
	
	$('#'+fieldID).autocomplete({//cargo el autompletar para el campo Nombre del Cliente
			source : function( request, response ) {
							$.ajax({
								type: "POST",
								url: val_url,
								dataType: "json",
								data: {
									type:val_type,
									term: request.term
								},
								success: function( data ) {
									response(data);
								}
							});
					   },
				width: 260,
				matchContains: true,
				selectFirst: false
			
	 });
	 
}
function llenar_combo(comboID,post,url){	
	
	  $.post(url, { type:post }, function(data){	
			$("#"+comboID).html(data);
			$("#"+comboID).trigger("liszt:updated");//actualizo la lista del combo tipo chosen plugin
		});			
	
}




//funcion que abre una ventana de dialogo sencilla usada para mostrar los mensajes relevantes en un modulo x
function open_msg_dialog(id_window,title,width){
	
	$("#"+id_window).show("fast");//muestro el mensaje
	$("#"+id_window).dialog({ modal: true, title: title,resizable: false,width:width+"px",
							  buttons: [ 
										 { text: "Aceptar",
											  click: function() { $(this).dialog("close"); }
										 }
									   ] //cierra buttons
							  });	//cierra dialog
}

//funcion que abre una venta de dialogo sencilla usada para mostrar un formulario de registro emergente
function open_form_dialog(id_window,title){
	
	$("#"+id_window).show("fast");//muestro el formulario
	$("#"+id_window).dialog({ modal: true, title: title,resizable: false,width:"600px"});	//cierra dialog
	
}

//funcion para obtener el valor seleccionado de un campo radiobutton
function Selected_radioValue(radioName){
	
	var radioField=document.getElementsByName(radioName);
	var optionSelected=0;
	for(i=0; i <radioField.length; i++){
   		 if(radioField[i].checked){
    		  optionSelected = radioField[i].value;		
			  return optionSelected;	  
  		 }
  	}
	return 0;
}

function chek(id,tipo,url){
    
    var cod=id;
    
    var codi=document.getElementById(cod).value;
    $.post(url,{codi:codi,tipo:tipo},
	   function(data){
	     alert(data);
	   }
	   );
    
  }


<!--FUNCION SOLO LETRAS-->
function validar(e) {
		tecla = (document.all) ? e.keyCode : e.which;
		if (tecla==8) return true;
		patron =/[A-Za-z\s]/;
		te = String.fromCharCode(tecla);
		return patron.test(te);
}

<!--FUNCION SOLO NUMEROS-->
function validarnum(e) {
		tecla = (document.all) ? e.keyCode : e.which;
		if (tecla==8) return true;
		patron = /[.0123456789]/;
		te = String.fromCharCode(tecla);
		return patron.test(te);
}

function filto_multi_select(id_com,id_tit,id_est,tipo,url){
  var compe=id_com;
  var titu=id_tit;
  var estu=id_est;
  
  var competencia=document.getElementById(compe).value;
  var titulo=document.getElementById(titu).value;
  var estudio=document.getElementById(estu).value;
  $.post(url,{competencia:competencia,titulo:titulo,estudio:estudio,tipo:tipo},
	 function(data){
	  
	  var ret=data.toEtring();
	  return ret;
	 }

);
  }
  
  
//funcion que trae los registros de la bd y los muestra en inputs
/*Tiene 4 parametros
    id_enviar=captura el valor para procesar
    url=donde se realiza dicho proceso
    tipo=seleccina el case de la url
    id_mos=objeto donde se van a mostrar los registros 
*/
 function cargar_datos(id_enviar,url,tipo,id_mos)
    {
     var id=id_enviar;
     var obtener = document.getElementById(id).value;
     $.post(url,{obtener:obtener,type:tipo},
	  
     function(data){
	 var ofe= id_mos;
	  var asp=data.toString();
	 var re= document.getElementById(ofe).value=asp;
	 
	
	 return  re;
	  
     
     }
    );
	
   }
   

function ponPrefijo(for2,for2_na,for1,for1_na){
    var file=document.for2.for2_na.value;
   var ruta=file.substring(file.lastIndexOf("\\")+ 1,file.length);
    opener.document.for1.for1_na.value = ruta;
    window.close()
}



/**
 * Notificaciones animadas con jQuery
 * @autor Juan Manuel Lopez
 * @fecha 06/mar/2012
**/



   //Función que crea las notificaciones
   /**parametros
    *msg = mensaje de la notificacion
    *speed = velocidad de animacion
    *fadeSpeed = velocidad cuando se cierra
    *type = tipo de notificacion (Normal,error,succes,warning,info)
    *css = indicamos el tipo del cierre para asi colocar la imagen del close correspondiente
   **/
   
   function notify(msg,speed,fadeSpeed,type,css){

       //Borra cualquier mensaje existente
       $('.notify').remove();

       //Si el temporizador para hacer desaparecer el mensaje está
       //activo, lo desactivamos.
       if (typeof fade != "undefined"){
           clearTimeout(fade);
       }
       
       //Creamos la notificación con la clase (type) y el texto (msg)
       $('body').append('<div id="cerrar" onclick="javascript:closeNotification();"  class="notify '+type+'" style="display:none;position:fixed;left:10"><p>'+msg+'</p><div id="close" onclick="javascript:closeNotification();" class="close '+css+'"></div></div>');

       //Calculamos la altura de la notificación.
       notifyHeight = $('.notify').outerHeight();

       //Creamos la animación en la notificación con la velocidad
       //que pasamos por el parametro speed
       $('.notify').css('top',-notifyHeight).animate({top:10,opacity:'toggle'},speed);

       //Creamos el temporizador para hacer desaparecer la notificación
       //con el tiempo almacenado en el parametro fadeSpeed
       fade = setTimeout(function(){

           $('.notify').animate({top:notifyHeight+10,opacity:'toggle'}, speed);

       }, fadeSpeed);

   }
//funcion cuando se da click para cerrar la notificacion
function closeNotification(duration){
    var divHeight = $('div#cerrar').height();
    setTimeout(function(){
        $('div#cerrar').animate({
            top: '-'+divHeight
        }); 
        // removing the notification from body
        setTimeout(function(){
            $('div#cerrar').remove();
        },400);
    }, parseInt(duration * 100));   
    

    
}
  