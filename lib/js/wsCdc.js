$(function() {
    
    $(".novo_vencimento").each(function(){
        var c = $(this).attr('id');
        c = c.substring(16);
        var data = $('#dt_limite_' + c).val();

        $(this).datepicker({
            minDate : new Date(), 
            maxDate : data, 
            dateFormat: 'dd/mm/yy'
        });
        
        $(this).keydown(function(){
            $(this).val('');
        });
    });
    
    $('.gerar_boleto').click(function (){
       var nv_id = $(this).attr('id');
       nv_id = nv_id.substring(13);
       
       if($('#novo_vencimento_' + nv_id).val() != ''){
           $('#h_novo_vencimento_' + nv_id).val($('#novo_vencimento_' + nv_id).val());
           $('#form_boleto_' + nv_id).submit();
       }else{
           alert('Campo "Reagendamento" deve ser preenchido.');
           $('#novo_vencimento_' + nv_id).addClass('input_error');
       }
       
    });
       
//ESCONDE AS MENSAGENS DA TELA INICIAL
       $('#submit').hide();
       
       $('#p_cnpj').hide();
       
        $('.sonums').keypress(function(event) {
            var tecla = (window.event) ? event.keyCode : event.which;
            if ((tecla > 47 && tecla < 58)) return true;
            else {
                if (tecla != 8){
                    return false;
                } else {
                    return true;
                }
            }
        });
       
       $('#fechar').click(function (){
           $('#msg_error').slideUp();    
       });
       
       $('.info_esc').hide();
       
       $('.info_esc').each(function(){
           $(this).blur(function(){
               $(this).fadeOut();
           });
       });
       
       $('#cnpj').blur(function (){
           if($('#cnpj').val().length < 8){
               alert('Campo CNPJ deve ter no mínimo 8 dígitos');
           }else if($('#cnpj').val().length === 8){
               
           }else if($(this).val().length < 14 && $(this).val().length > 8){
               var str = $(this).val();
               var patt = /\b\d{2}[.]?\d{3}[.]?\d{3}\b/g; 
               var result = patt.exec(str); 
               
               if(str != result){
                   alert('Formato de CNPJ inválido.');
               }
               
           }else{
               ValidaCNPJ(this.value);
           };
       });
       
       
       $('#cnpj').focus(function(){
//           $(this).val('');
           $('#info_cnpj').fadeIn();
           $(this).blur(function (){
               $('#info_cnpj').fadeOut();
           });
       });
       
       $('#cnpj').blur(function(){
            var cnpj = $('#cnpj').val();
            var nf = $('#lancamento').val();
            $('#p_cnpj').fadeOut();
            
            if(cnpj != '' && nf != ''){
                $('#submit').fadeIn();
            }else{
                $('#submit').fadeOut();
            }
            
       });
       
       $('#lancamento').focus(function(){
           $('#info_nf').fadeIn();
           $(this).blur(function (){
               $('#info_nf').fadeOut();
           });
           
       });
       
       $('#captcha').focus(function(){
           $('#info_captcha').fadeIn();
           $(this).blur(function (){
               $('#info_captcha').fadeOut();
           });
       });
       
 
       
       $('#lancamento').blur(function(){
            var cnpj = $('#cnpj').val();
            var nf = $('#lancamento').val();
            
            if(nf == ''){
                alert('Campo NF deve ser preenchido.');
            }
       
            if(cnpj != '' && nf != ''){
                $('#submit').fadeIn();
            }else{
                $('#submit').fadeOut();
            }
            
       });
    
});