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
    
});