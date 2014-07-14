<?php

$aux_array = array();

$aux_array['cnpj'] = $_POST['cnpj'];

//echo '<pre> $array_enviar[arg0] ==> ';
//print_r($array_enviar);
//echo '</pre>';

$url = "http://200.195.141.44:30002/boletos/ws.php?wsdl";

$options = array(
    'cache_wsdl' => WSDL_CACHE_NONE,
    'cache_ttl' => 86400,
    'trace' => true,
    'exceptions' => true,
    'connection_timeout' => 11
);

try {

    $client = new SoapClient($url, $options);
    
    $autenticar = $client->autenticar($aux_array);
    
    echo '<pre> AQUI VAI O RETORNO de AUTENTICAR ==> ';
    print_r($autenticar);
    echo '</pre>';
    
    
    $listarBoletos = $client->listarBoletos($aux_array);
    echo '<pre> AQUI VAI O RETORNO de listar boletos ==> ';
    print_r($listarBoletos);
    echo '</pre>';

} catch (SoapFault $fault) {
    echo '<pre> MENSAGEM COMPLETA DO ERRO: </br>';
    print_r($fault);
    echo '</pre>';
}

?>