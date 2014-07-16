<?php 

session_start();

include_once '../lib/functions.php';
//include_once '../lib/includes.php';
include_once '../configuration.php';

// Tratamento do CNPJ, tirando caracteres especiais
$cnpj = str_replace('.', '', $_REQUEST['cnpj']);
$cnpj = str_replace('/', '', $cnpj);
$cnpj = str_replace('-', '', $cnpj);
        
$aux_array['cnpj'] = $cnpj;

$aux_array['lancamento'] = $_REQUEST['lancamento'];
$aux_array['id'] = $_REQUEST['id'];
$aux_array['dv'] = $_REQUEST['dv'];

if(strlen($cnpj) > 8){
    $raiz = substr($cnpj,0,-6);
    $aux_array['raiz'] = $raiz;
        
}else{
    $aux_array['raiz'] = $cnpj;
}

if ($acao == '') {
    $acao = $_REQUEST['acao'];
}


// Url para o server do WS
$url = $CONFIG_URL;

// Parametros de conexão
$options = array(
    'cache_wsdl' => WSDL_CACHE_NONE,
    'cache_ttl' => 86400,
    'trace' => true,
    'exceptions' => true,
    'connection_timeout' => 11
);


// Escolha da ação.
if($acao == 'captcha'){
    if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]){
        try {
            $client = new SoapClient($url, $options);
            require_once 'ctrl_autenticar.php';
            exit();

        } catch (SoapFault $fault) {
            
            $_SESSION['error'] = true;
            $_SESSION['error_msg'] = 'Conex&atilde;o n&atilde;o realizada';
            header ("location: " . __PROJECT_PATH__);
            exit();

        }
        
    } else {
        
        $_SESSION['error'] = true;
        $_SESSION['error_msg'] = 'Campo CAPTCHA inv&aacute;lido';
        
        header ("location: " . __PROJECT_PATH__);
        
    }
    
}else if ($acao == 'autenticar') {
    
    try {
        $client = new SoapClient($url, $options);
        require_once 'ctrl_autenticar.php';
        exit();
        
    } catch (SoapFault $fault) {
        $_SESSION['error'] = true;
        $_SESSION['error_msg'] = 'Não foi possivél autenticar';
        header ("location: " . __PROJECT_PATH__);
        exit();
        
    }

} else if ($acao == 'listaBoletos') {
    require_once 'ctrl_listaBoletos.php';
    exit();
    
} else if ($acao == 'consultaBoleto') {
    
    try {
        $client = new SoapClient($url, $options);
        
        if(!isset($arr_lcto)){
            
            $arr_lcto = array();
            $arr_lcto['lancamento'] = $_REQUEST['lancamento'];
            $arr_lcto['datavencimento'] = $_REQUEST['novo_vencimento'];
            $id = $_REQUEST['id'];
            $valor = $_REQUEST['valor'];
            $vencimento = $_REQUEST['novo_vencimento'];         
        }
        
        require_once 'ctrl_consultaBoleto.php';
        
    } catch (SoapFault $fault) {
        $_SESSION['error'] = true;
        $_SESSION['error_msg'] = 'Não foi possivel consultar o boleto';
        header ("location: " . __PROJECT_PATH__);
        exit();
        
    }
    
    } else if ($acao == 'linkBoleto'){
        
        if($aux_array['dv'] == $dv_ok = validaDv($aux_array['cnpj'], $aux_array['id'])){
            try {
                $client = new SoapClient($url, $options);
                require_once 'ctrl_autenticar.php';
                exit();

            } catch (SoapFault $fault) {
                $_SESSION['error'] = true;
                $_SESSION['error_msg'] = 'Não foi possivél autenticar';
                header ("location: " . __PROJECT_PATH__);
                exit();

            }            
        }else{
                $_SESSION['error'] = true;
                $_SESSION['error_msg'] = 'Código Verificador Inválido.';
                header ("location: " . __PROJECT_PATH__);
                exit();
        }
        

    
} else if ($acao == 'erro'){
    $_SESSION['error'] = true;
    header ("location: " . __PROJECT_PATH__);
    
} else if ($acao == 'sair'){
    session_unset();  
    header ("location: " . __PROJECT_PATH__);
    exit();
    
}elseif($acao == ''){
    header ("location: " . __PROJECT_PATH__);
    exit();
    
}else{
    $_SESSION['error'] = true;
    $_SESSION['error_msg'] = 'Ação não definida';
    header ("location: " . __PROJECT_PATH__);
    exit();
    
}

?>