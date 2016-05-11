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
  
