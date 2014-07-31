<?php

require_once '../lib/functions.php';
require_once '../lib/includes.php';

if($acao == '' && $acao != 'listaBoletos'){
    
     $_SESSION['error'] = true;
     $_SESSION['error_msg'] = 'Não localizado boleto.</br>Entre em contato conosco: cobranca@scansource.com.br Telefone cobrança (41) 2169-6500';
     header ("location: " . __PROJECT_PATH__);
     exit();
    
}else if($acao_anterior == 'linkBoleto'){
    $lista = $client->listaBoletos($aux_array);
        
        foreach ($lista as $bl){
                
        if($bl->id == $aux_array['id']){
            $arr_lcto = array();
            
            $arr_lcto['lancamento'] =  $bl->lancamento;
            $arr_lcto['id'] = $bl->id;
            $arr_lcto['datavencimento'] = $bl->vencimento;
            $arr_lcto['valor'] = $bl->valor;
            
            $dt_excedido = CalcularVencimento($bl->vencimento, 57);
            
            if($dt_excedido['limite_execedido'] == TRUE){
                $_SESSION['error'] = true;
                $_SESSION['error_msg'] = 'Boleto Indisponível';
                header ("location: " . __PROJECT_PATH__);
                exit();
            }
            
            $acao = 'consultaBoleto';
            
            include 'ctrl_boleto.php';
            exit();
            
        }
        
    } 
    
}else{
    $lista = $client->listaBoletos($aux_array);

    if($lista != null){
        include '../view/view_listaBoletos.php';
        exit();

    }else{    
        $_SESSION['error'] = true;
        $_SESSION['error_msg'] = 'Cliente' . ' não possui boletos para Nota Fiscal.' . $aux_array['lancamento'];
        header ("location: " . __PROJECT_PATH__);

        exit();
    
 }
}



?>