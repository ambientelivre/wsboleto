<?php
include_once '../lib/functions.php';
include_once '../lib/includes.php';

if($acao == '' && $acao != 'consultaBoleto' && $acao != 'linkBoleto'){
    
     $_SESSION['error'] = true;
     $_SESSION['error_msg'] = 'Usuário não autenticado';
     header ("location: " . __PROJECT_PATH__);
     exit();
    
}else{

    $consulta = $client->consultaBoleto($arr_lcto);
    
    if($consulta != null){

        $_SESSION['numerodocumento'] = $consulta->numerodocumento;
        $_SESSION['nossonumero'] = $consulta->nossonumero;
        $_SESSION['data'] = $consulta->data;
        $_SESSION['sacado'] = $consulta->sacado;
        $_SESSION['banco'] = $consulta->banco;
        $_SESSION['municipio'] = $consulta->municipio;
        $_SESSION['uf'] = $consulta->uf;
        $_SESSION['cep'] = $consulta->cep;
        $_SESSION['endereco'] = $consulta->endereco;

        $valor = insereVirgula($consulta->valor);

        $_SESSION['valor'] = $valor;
        $_SESSION['desconto'] = $consulta->desconto;
        $_SESSION['outrasdeducoes'] = $consulta->outrasdeducoes;
        $_SESSION['outrosacrescimos'] = acrescimos($consulta->outrosacrescimos);
        $_SESSION['multa'] = acrescimos($consulta->multa);
    //    $_SESSION['vencimento'] = $consulta->vencimento;
        if($acao_anterior == 'linkBoleto'){
            $_SESSION['vencimento'] = $consulta->data;
        }else{
            $_SESSION['vencimento'] = $vencimento;
        }
        
        $_SESSION['instrucoes'] = $consulta->instrucoes;
        
        
        if($consulta->banco == '001'){
            header ("location: " . __LIB_PATH__ . "/boleto_php/boleto_bb.php");

            exit();

        }else if($consulta->banco == '341'){
            header ("location: " . __LIB_PATH__ . "/boleto_php/boleto_itau.php");

            exit();

        }else if($consulta->banco == '399'){
            header ("location: " . __LIB_PATH__ . "/boleto_php/boleto_hsbc.php");

            exit();

        }

     } else {
         
        $_SESSION['erro'] = true;  
        $_SESSION['error_msg'] = 'Erro ao imprimir o boleto';
        header ("location: " . __PROJECT_PATH__);

        exit();

     }
    
}

?>