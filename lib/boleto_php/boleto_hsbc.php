<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers&atilde;o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est&aacute; dispon&iacute;vel sob a Licen&ccedil;a GPL dispon&iacute;vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa				        |
// | 														                                   			  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto HSBC: Bruno Leonardo M. F. Gon�alves          |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//



//INICIA SESSÃO
session_start();
    
// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 2;
$taxa_boleto = 2.50;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = $_SESSION['valor'];// Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["numero_documento"] = $_SESSION['numerodocumento'];	// N�mero do documento - REGRA: M�ximo de 13 digitos
$dadosboleto["data_vencimento"] = $_SESSION['vencimento']; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $_SESSION['valor']; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $_SESSION['sacado'];
$dadosboleto["endereco1"] = $_SESSION['endereco'];
$dadosboleto["endereco2"] = $_SESSION['municipio'] . " - ".  $_SESSION['uf'] . " - CEP: ". $_SESSION['cep'];

// INFORMACOES PARA O CLIENTE
//$dadosboleto["demonstrativo1"] = "Pagamento de Compra na Loja Nonononono";
//$dadosboleto["demonstrativo2"] = "Mensalidade referente a nonon nonooon nononon<br>Taxa banc�ria - R$ ".number_format($taxa_boleto, 2, ',', '');
//$dadosboleto["demonstrativo3"] = "BoletoPhp - http://www.boletophp.com.br";
$dadosboleto["instrucoes1"] = $_SESSION['instrucoes'];
$dadosboleto["instrucoes2"] = "- Pagamento pode ser realizado até " . $_SESSION['vencimento'];
$dadosboleto["instrucoes3"] = "- Em caso de dúvidas entre em contato conosco: cobranca@scansource.com.br";
$dadosboleto["instrucoes4"] = "&nbsp; TELEFONE COBRANCA ( 41 ) 2169-6500 PROTESTAR AP&Oacute;S 10 DIAS VENCIDO";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
//$dadosboleto["quantidade"] = "";
//$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "98";		
$dadosboleto["especie"] = "R$";
//$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS PERSONALIZADOS - HSBC
$dadosboleto["codigo_cedente"] = "31706"; // C�digo do Cedente (Somente 7 digitos)
$dadosboleto["carteira"] = "00";  // C�digo da Carteira

// SEUS DADOS
//$dadosboleto["identificacao"] = "BoletoPhp - C�digo Aberto de Sistema de Boletos";
$dadosboleto["cpf_cnpj"] = "CNPJ DA CDC";
$dadosboleto["endereco"] = "Coloque o endereço da sua empresa aqui";
$dadosboleto["cidade_uf"] = "Cidade / Estado";
$dadosboleto["cedente"] = "Scan Source CDC Brasil";

// N�O ALTERAR!
include("include/funcoes_hsbc.php"); 
include("include/layout_hsbc.php");
?>
