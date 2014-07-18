<?php

if($acao == '' && $acao != 'autenticar' && $acao != 'captcha'){
    
     $_SESSION['error'] = true;
     $_SESSION['error_msg'] = 'CNPJ não autenticado';
     header ("location: " . __PROJECT_PATH__);

     exit();
    
}else{
    
  $razao_social = $client->autenticar($aux_array);
  
  if($razao_social != null){
      if($acao == 'linkBoleto'){
          $acao_anterior = 'linkBoleto';
      }
     
     $acao = 'listaBoletos';
        
     include 'ctrl_boleto.php';
     exit();

  }else{      
     $_SESSION['error'] = true;
     $_SESSION['error_msg'] = 'CNPJ não autenticado';
     header ("location: " . __PROJECT_PATH__);
     exit();
  }
    
}

 
?>