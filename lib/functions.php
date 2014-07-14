<?php

function insereVirgula($valor){
    
    $tamanho = strlen($valor);
    
    $valor = str_replace(',','',$valor);
    $valor = str_replace('.','',$valor);
    
    $valor = substr_replace($valor, ',', -2, 0);
    
//    echo $tamanho;
    
    if($tamanho >= 7 && $tamanho <= 9){
        $valor = substr_replace($valor, '.', -6, 0);
    }else if($tamanho >= 9){
        $valor = substr_replace($valor, '.', -9, 0);
    }
    return $valor;

}

function acrescimos($valor){
    
    $tamanho = strlen($valor);
    
    if($tamanho == 2){
        $valor = substr_replace($valor, '0,', -2, 0);
    } else if($tamanho == 1){
        $valor = substr_replace($valor, '0,0', -1, 0);
    } else if($tamanho >= 3){
        $valor = substr_replace($valor, ',', -2, 0);    
    }
    
    return $valor;
}

function CalcularVencimento($data,$dias){
    $novadata = explode("/",$data);
    $dia = $novadata[0];
    $mes = $novadata[1];
    $ano = $novadata[2];
    //PARA DESCOBRIR QUAL DATA SERÁ DAQUI A 5 DIAS
    //echo date('d/m/Y',mktime(0,0,0,$mes,$dia+5,$ano));
    //PARA DESCOBRIR QUAL SERÁ O DIA AMANHÃ
    //echo date('d/m/Y',mktime(0,0,0,$mes,$dia+1,$ano));
    //PARA MÊS QUE VEM
    //echo date('d/m/Y',mktime(0,0,0,$mes + 1,$dia,$ano));
    //PARA ANO QUE VEM
    //echo date('d/m/Y',mktime(0,0,0,$mes,$dia,$ano + 1));
    if ($dias==0){        
        return date('d/m/Y',mktime(0,0,0,$mes,$dia,$ano));

    } else {
        
        $hoje = date('d/m/Y');

        $vencimento = $novadata[2] . $novadata[1] . $novadata[0];

        $hoje = explode("/",$hoje);
        $hoje = $hoje[2] . $hoje[1] . $hoje[0];
        
         if($vencimento < $hoje){
             
             $vencido = true;
             $dt_limite = date('d/m/Y',mktime(0,0,0,$mes,$dia+$dias,$ano));
             
         }
         
         
         if($dt_limite != null){
             $n_dt_limite = explode("/",$dt_limite);
             
             $execao = $n_dt_limite[2] . $n_dt_limite[1] . $n_dt_limite[0];
             
             if( $hoje > $execao ){
                 $arr_vencimento['limite_execedido'] = true;
             }

         }
         
         $arr_vencimento['vencido'] = $vencido;
         $arr_vencimento['dt_limite'] = $dt_limite;
        
        
         return $arr_vencimento;

    }
}


function inverterData($data){
    $novadata = explode("/",$data);
    $dia = $novadata[0];
    $mes = $novadata[1];
    $ano = $novadata[2];
    
    $vencimento = $novadata[2] . ' - ' . $novadata[1] . ' - ' . $novadata[0];
    
    return $vencimento;
    
}

function validaDv($cnpj, $id){

        $r = substr($cnpj, 0, 3);

        $key = $r.$id;

        $md5 = md5($key);

    return $md5;
}

?>
