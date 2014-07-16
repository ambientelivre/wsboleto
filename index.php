<?php 

session_start();

include 'lib/includes.php'; 

?>

<head>
    <meta charset="UTF-8">
</head>

<link rel="stylesheet" type="text/css" href="style.css">

<script type="text/javascript" src="lib/js/jquery-1.5.1.min.js"></script>

<script type="text/javascript" src="http://www.geradorcnpj.com/jquery.maskedinput-1.1.4.pack.js"></script>

<script type="text/javascript" src="lib/js/wsCdc.js"></script>

<script type="text/javascript">
    
    
   $(document).ready(function(){
       
        $('.sonums').keypress(function(event) {
            var tecla = (window.event) ? event.keyCode : event.which;
            if ((tecla > 47 && tecla < 58)) return true;
            else {
                if (tecla != 8) return false;
                else return true;
            }
        });
       
       $("#cnpj").mask("99.999.999/9999-99");
       
       $('#submit').hide();
       
       $('#p_cnpj').hide();
       
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
               
           }else{
               ValidaCNPJ(this.value);
           };
       });
       
       
       $('#cnpj').focus(function(){
           $(this).val('');
           $('#info_cnpj').fadeIn();
           $(this).blur(function (){
               $('#info_cnpj').fadeOut();
           });
       });
       
       $('#cnpj').blur(function(){
            var cnpj = $('#cnpj').val();
            var nf = $('#lancamento').val();
       
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
</script>

<!--<script type="text/javascript" src="lib/js/valida_CPF_CNPJ.js"></script>-->

<div id="container">
    
    <?php
        if($_SESSION['error'] == true){ unset($_SESSION['error']); ?>

            <div id="msg_error" class="msg_error">
                <p class="error_msg"><?php echo $_SESSION['error_msg'];?></p>
                <div id="fechar">
                    <span>Fechar</span>
                </div>
            </div>

    <?php 
            unset($_SESSION['error_msg']);
        } ?>
</div>

<div id="container">
    
    <?php
        echo '<pre> server URL ==> ';
        print_r(__VIEW_PATH__);
        echo '</pre>';
    ?>
    
    <div id="titulo" style="margin: 20px auto 0 auto; width: 550px;">
        <img src="lib/imagens/titulo_emissao_ss.png" style="margin: 0 auto;">
    </div>

    <div id="Descretivo">
        
        <h1>Prezado Cliente</h1>
        
        <p>Você pode emitir a 2ª via do boleto para pagamento, informando seu CNPJ ou Raiz do CNPJ, número da nota fiscal e o texto de validação. Serão listadas as parcelas em aberto.</p>
        <p>É possível emitir o boleto para pagamento no vencimento ou escolher uma nova data. Escolhendo uma nova data os valores serão atualizados.</p>

    </div>
    
</div>


    <div id="basehome" >
        <div id="h_form">
            <form method="POST" action="control/ctrl_boleto.php">
                    
                <table border="0" class="tbi" style="margin: 0 auto;">

                        <th colspan="2"><p>Buscar Boleto</p></th>
                        <tr>
                            <td align="right" style="color: #EC4B4B;">CNPJ:&nbsp;</td>
                            <td><input type="text" name="cnpj" id="cnpj" value="" size="10" maxlength="18"></td>
                            <td><div id="info_cnpj" class="info_esc">&nbsp;Nº do CNPJ com 8 ou 14 dígitos</div></td>
                        </tr>
                        
                        <tr>
                            <td align="right" style="color: #EC4B4B;">NF:&nbsp;</td>    
                            <td><input type="text" class="sonums" autocomplete="off" name="lancamento" id="lancamento" value="" size="10" maxlength="6"></td>
                            <td><div id="info_nf" class="info_esc">&nbsp;Nº da Nota Fiscal</div></td>
                        </tr>

                        <tr>
                            <td><img src="captcha.php" />:&nbsp;</td>
                            <td><input id="captcha" name="captcha" autocomplete="off" size="10" maxlength="5" type="text"></td>
                            <td><div id="info_captcha" class="info_esc">&nbsp;Digitar os Nº da imagem ao lado</div></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="acao" id="acao" value="captcha">
                                <input id="submit" type="submit" value="Buscar" style="margin: 0 0 0 67px;">
                            </td>
                        </tr>

                    </table>                    
            </form> 
        </div>
    </div>

<div id="footer">
    <div id="logo_footer">
        <img src="lib/imagens/logo_ss_branco.jpg">
    </div>
</div>