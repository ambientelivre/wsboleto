<?php

$aux_array = array();

$aux_array['lancamento'] = 4471005;

$url = "http://200.195.141.44:30002/boletos/ws.php?wsdl";

$options = array(
    'cache_wsdl'    => WSDL_CACHE_NONE, 
    'cache_ttl'     => 86400, 
    'trace'         => true,
    'exceptions'    => true,
    'connection_timeout' => 11
);

try{
    
$client = new SoapClient($url, $options);

$retorno = $client->consultaBoleto($aux_array);

echo '<pre> Deu Certo!! ==> ';
print_r($retorno);
echo '</pre> <==';

}  catch (SoapFault $fault){
    echo '<pre> Nao Deu Certo!!';
    print_r($fault);
    echo '</pre>';
    
}

?>