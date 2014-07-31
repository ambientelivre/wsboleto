<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
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
// | Desenvolvimento Boleto Ita�: Glauber Portella                        |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

//INICIA SESSÃO
session_start();

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 56;
$taxa_boleto = 2.50;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = $_SESSION['valor']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = $_SESSION['nossonumero'];  // Nosso numero - REGRA: M�ximo de 8 caracteres!
$dadosboleto["numero_documento"] = $_SESSION['numerodocumento']; // Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $_SESSION['vencimento']; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $_SESSION['valor']; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $_SESSION['sacado'];
$dadosboleto["endereco1"] = $_SESSION['endereco'];
//$dadosboleto["endereco2"] = $_REQUEST['endereco_2_cliente'];
$dadosboleto["endereco2"] = $_SESSION['municipio'] . " - ".  $_SESSION['uf'] . " - CEP: ". $_SESSION['cep'];

// INFORMACOES PARA O CLIENTE
//$dadosboleto["demonstrativo1"] = "Pagamento de Compra na Loja Nonononono";
//$dadosboleto["demonstrativo2"] = "Mensalidade referente a nonon nonooon nononon<br>Taxa banc�ria - R$ ".number_format($taxa_boleto, 2, ',', '');
//$dadosboleto["demonstrativo3"] = "BoletoPhp - http://www.boletophp.com.br";
//$dadosboleto["instrucoes1"] = $_SESSION['instrucoes'];
$dadosboleto["instrucoes1"] = 'BOLETO ORIGINAL: ';

$nnrd = substr($_SESSION['nossonumero'],3);
$nn3d = substr($_SESSION['nossonumero'], 0,3);
$nn = $nn3d . '/' . $nnrd;

$dadosboleto["instrucoes2"] = $nn . ". VCTO " . $_SESSION['vencimento'] . " NO VALOR DE R$..." . $_SESSION['valor'] . "</br> Pagamento pode ser realizado até: " . $_SESSION['vencimento'];
$dadosboleto["instrucoes3"] = "Em caso de dúvida contatar: cobranca@scansource.com.br - Telefone cobrança (41)2169-6500";
$dadosboleto["instrucoes4"] = "Protestar após 10 dias vencido</br>Juros por dia de atraso: R$" . $_SESSION['outrosacrescimos'] . "</br>Multa de: R$" . $_SESSION['multa'];


// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
//$dadosboleto["quantidade"] = "";
//$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "N";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DMI";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - ITA�
$dadosboleto["agencia"] = "3722"; // Num da agencia, sem digito
$dadosboleto["conta"] = "18098";	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "5"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITA�
//$dadosboleto["carteira"] = "175";  // C�digo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157
$dadosboleto["carteira"] = "109";  // C�digo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

// SEUS DADOS
//$dadosboleto["identificacao"] = "BoletoPhp - Codigo Aberto de Sistema de Boletos";
$dadosboleto["cpf_cnpj"] = $_SESSION['cnpj_empresa'];
$dadosboleto["endereco"] = "Coloque o endereco da sua empresa aqui";
$dadosboleto["cidade_uf"] = "Cidade / Estado";
$dadosboleto["cedente"] = "CDC BRASIL DISTRIBUIDORA DE TECNOLOGIA ESPECIAIS LTDA.";

// N�O ALTERAR!
include("include/funcoes_itau.php"); 
include("include/layout_itau.php");
?>
