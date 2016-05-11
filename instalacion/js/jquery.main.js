$(function(){
    //original field values
    var field_values = {
            //id        :  value
            'username'  : 'Usuario',
            'host'      : 'Host',
            'password'  : 'password',
            'cpassword' : 'password',
            'liq_quin'  : 'Liquidacion quincenal',
            'pag_quin'  : 'Tipo de Pago quincenal',
            'liq_men'  : 'Liquidacion mensual',
            'pag_men'  : 'Tipo de Pago mensual',
            'liq_sem'  : 'Liquidacion semanal',
            'pag_sem'  : 'Tipo de Pago semanal',
            'email'  : 'email address',
            'vac_con'  : 'Vaciones',
            'vac_aus'  : 'Ausencia'
    };


    //inputfocus
    $('input#username').inputfocus({ value: field_values['username'] });
    $('input#host').inputfocus({ value: field_values['host'] });
    $('input#password').inputfocus({ value: field_values['password'] });
    $('input#cpassword').inputfocus({ value: field_values['cpassword'] }); 
    $('input#liq_quin').inputfocus({ value: field_values['liq_quin'] });
    $('input#pag_quin').inputfocus({ value: field_values['pag_quin'] });
    $('input#liq_men').inputfocus({ value: field_values['liq_men'] });
    $('input#pag_men').inputfocus({ value: field_values['pag_men'] });
    $('input#host').inputfocus({ value: field_values['host'] });
    $('input#vac_con').inputfocus({ value: field_values['vac_con'] });
    $('input#vac_aus').inputfocus({ value: field_values['vac_aus'] }); 




    //reset progress bar
    $('#progress').css('width','0');
    $('#progress_text').html('0% Complete');

    //first_step
    $('form').submit(function(){ return false; });
    $('#submit_first').click(function(){
        //remove classes
        $('#first_step input').removeClass('error').removeClass('valid');

        //ckeck if inputs aren't empty
        var fields = $('#first_step input[type=text], #first_step input[type=password]');
        var error = 0;
        fields.each(function(){
            var value = $(this).val();
            if( value.length<4 || value==field_values[$(this).attr('id')] ) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });        
        
        if(!error) {
             
                //update progress bar
                $('#progress_text').html('17% Complete');
                $('#progress').css('width','113px');
                
                //slide steps
                $('#first_step').slideUp();
                $('#second_step').slideDown();     
                          
        } else return false;
    });


    $('#submit_second').click(function(){
        //remove classes
        $('#second_step input').removeClass('error').removeClass('valid');

        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
        var fields = $('#second_step input[type=text]');
        var error = 0;
        fields.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] || ( $(this).attr('id')=='email' && !emailPattern.test(value) ) ) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });

    
        if(!error) {
            
                if( $('#password').val() != $('#cpassword').val() ) {
                    $('#second_step input[type=password]').each(function(){
                        $(this).removeClass('valid').addClass('error');
                        $(this).effect("shake", { times:3 }, 50);
                    });
                    
                    return false;
            } 
                //update progress bar
                $('#progress_text').html('37% Complete');
                $('#progress').css('width','226px');
                
                //slide steps
                $('#second_step').slideUp();
                $('#third_step').slideDown();     
        } else return false;

    });
    
    $('#submit_third').click(function(){
         //update progress bar
                $('#progress_text').html('51% Complete');
                $('#progress').css('width','226px');
                
                //slide steps
                $('#third_step').slideUp();
                $('#fourth_step').slideDown();  
       
     
    });
    
      $('#submit_fourth').click(function(){
         //update progress bar
                $('#progress_text').html('68% Complete');
                $('#progress').css('width','226px');
                
                //slide steps
                $('#fourth_step').slideUp();
                $('#five_step').slideDown();  
       
     
    });
      
        $('#submit_five').click(function(){
         //update progress bar
                $('#progress_text').html('85% Complete');
                $('#progress').css('width','226px');
                
                //slide steps
                $('#five_step').slideUp();
                $('#six_step').slideDown();  
       
     
    });


    $('#submit_six').click(function(){
        //update progress bar
        $('#progress_text').html('100% Complete');
        $('#progress').css('width','339px');

        //prepare the fourth step
        var fields = new Array(
            $('#host').val(),
            $('#username').val(),
            $('#password').val(),
            $('#email').val(),
            $('#liq_quin').val(),
            $('#pag_quin').val(),
            $('#liq_men').val(),
            $('#pag_men').val(),
              $('#liq_sem').val(),
            $('#pag_sem').val(),
            $('#vac_con').val(),
            $('#vac_aus').val()
                                  
        );
        var tr = $('#seven_step tr');
        tr.each(function(){
            //alert( fields[$(this).index()] )
            $(this).children('td:nth-child(2)').html(fields[$(this).index()]);
        });
                
        //slide steps
        $('#six_step').slideUp();
        $('#seven_step').slideDown();            
    });


    $('#submit_seven').click(function(){
        //send information to server
        
        var host     = $('#host').val();
        var usuario  = $('#username').val();
        var pass     = $('#cpassword').val();
        var email    = $('#email').val();
        var liq_quin = $('#liq_quin').val();
        var pag_quin = $('#pag_quin').val();
        var liq_men  = $('#liq_men').val();
        var pag_men  = $('#pag_men').val();
        var liq_sem  = $('#liq_sem').val();
        var pag_sem  = $('#pag_sem').val();
        var vac_con  = $('#vac_con').val();
        var vac_aus  = $('#vac_aus').val();
        
        
       $.ajax({
		  url: "ajax_conceptos.php",
		  type : "POST",
		  data : "host="+host+"&usuario="+usuario+"&pass="+pass+"&email="+email+"&liq_quin="+liq_quin+"&pag_quin="+pag_quin+"&liq_men="+liq_men+"&pag_men="+pag_men+"&liq_sem="+liq_sem+"&pag_sem="+pag_sem+"&vac_con="+vac_con+"&vac_aus="+vac_aus,
                  
		  success: function(data){
			   
			   alert(data);
			   },
		});
       return false;
       
    });

});