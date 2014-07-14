<?php
//$retorno = $client->listaBoletos($aux_array);
?>
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
    echo "cnpj:" . $aux_array['cnpj'] . "<BR>";
    $retorno = $client->listaBoletos($aux_array['cnpj']);
    echo "retorno: <br>";
    var_dump($retorno);

    //tinha que ser um struct não um array, linha 348
    $xml = new SimpleXMLElement($retorno);
    echo "xml: <br>";
    var_dump($xml);
} catch (SoapFault $fault) {
    echo '<pre> MENSAGEM COMPLETA DO ERRO: </br>';
    print_r($fault);
    echo '</pre>';
}
?>