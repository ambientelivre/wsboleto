
<script src="lib/js/jquery-1.5.1.min.js"></script>

<script>
    $(document).ready(function (){
        $('#imprimir').click(function (){
           $(this).hide(); 
        });
        
   
        setInterval(function(){
            $('#imprimir').fadeIn();
        }, 5000);
    });
    
    
</script>

<input type="button" id="imprimir" value="Imprimir" onclick="javascript:window.print()">


<?php require_once 'lib/functions.php'; ?>
<?php

$cnpj = '00085004000110';
$id = '339022-A';
$u = '7cd86ecb09aa48c6e620b340f6a74545';

    $r = substr($cnpj, 0, 3);
    
    $key = $r.$id;

    $md5 = md5($key);

//    echo $md5;
    
//$t = validaDv($cnpj, $id);

//if($u == $t){
//    echo 'E igual';
//}else{
//    echo 'Nao e igual';
//}


    $arrCadastro = array();
    
    $arrCadastro['nome'] = $_REQUEST['nome'];
    $arrCadastro['sobrenome'] = $_REQUEST['sobrenome'];
    $arrCadastro['endereco'] = $_REQUEST['endereco'];
    $arrCadastro['telefone'] = $_REQUEST['telefone'];
            
    
    $arrCadastro = iconv('ISO-8859-2','UTF-8', $arrCadastro);
    
//   $jsonArrCadastro = json_encode($arrCadastro);
//   $decodedJsonArrCadastro = json_decode($jsonArrCadastro);
    
echo '<pre> Json Decodificado ==> ';
//print_r($decodedJsonArrCadastro);
print_r($arrCadastro);
echo '</pre>';

?>
