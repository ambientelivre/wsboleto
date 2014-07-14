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

// +--------------------------------------------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>              		             				|
// | Desenvolvimento Boleto Banco do Brasil: Daniel William Schultz / Leandro Maniezo / Rog�rio Dias Pereira|
// +--------------------------------------------------------------------------------------------------------+


// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//


//INICIA SESSÃO
session_start();

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 2.95;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = $_SESSION['valor']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = $_SESSION['nossonumero'];
$dadosboleto["numero_documento"] = $_SESSION['numerodocumento'];	// Num do pedido ou do documento
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
//$dadosboleto["demonstrativo2"] = "Mensalidade referente a nonon nonooon nononon<br>Taxa banc&aacute;ria - R$ ".number_format($taxa_boleto, 2, ',', '');
//$dadosboleto["demonstrativo3"] = "BoletoPhp - http://www.boletophp.com.br";

// INSTRU��ES PARA O CAIXA
$dadosboleto["instrucoes1"] = "- " . $_SESSION['instrucoes'];
$dadosboleto["instrucoes2"] = "- Pagamento pode ser realizado at&eacute; " . $_SESSION['vencimento'];
$dadosboleto["instrucoes3"] = "- Em caso de dúvidas entre em contato conosco: cobranca@scansource.com.br";
$dadosboleto["instrucoes4"] = "&nbsp; TELEFONE COBRANCA ( 41 ) 2169-6500 PROTESTAR AP&Oacute;S 10 DIAS VENCIDO";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
//$dadosboleto["quantidade"] = "10";
//$dadosboleto["valor_unitario"] = "10";
//$dadosboleto["aceite"] = "N";		
//$dadosboleto["especie"] = "R$";
//$dadosboleto["especie_doc"] = "DM";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - BANCO DO BRASIL
$dadosboleto["agencia"] = "34061"; // Num da agencia, sem digito
$dadosboleto["conta"] = "00050784"; 	// Num da conta, sem digito

// DADOS PERSONALIZADOS - BANCO DO BRASIL
$dadosboleto["convenio"] = "2162274";  // Num do conv�nio - REGRA: 6 ou 7 ou 8 d�gitos
//$dadosboleto["contrato"] = "999999"; // Num do seu contrato
$dadosboleto["carteira"] = "17";
$dadosboleto["variacao_carteira"] = "043";  // Varia��o da Carteira, com tra�o (opcional)

// TIPO DO BOLETO
$dadosboleto["formatacao_convenio"] = "7"; // REGRA: 8 p/ Conv�nio c/ 8 d�gitos, 7 p/ Conv�nio c/ 7 d�gitos, ou 6 se Conv�nio c/ 6 d�gitos
$dadosboleto["formatacao_nosso_numero"] = "2"; // REGRA: Usado apenas p/ Conv�nio c/ 6 d�gitos: informe 1 se for NossoN�mero de at� 5 d�gitos ou 2 para op��o de at� 17 d�gitos

/*
#################################################
DESENVOLVIDO PARA CARTEIRA 18

- Carteira 18 com Convenio de 8 digitos
  Nosso n�mero: pode ser at� 9 d�gitos

- Carteira 18 com Convenio de 7 digitos
  Nosso n�mero: pode ser at� 10 d�gitos

- Carteira 18 com Convenio de 6 digitos
  Nosso n�mero:
  de 1 a 99999 para op��o de at� 5 d�gitos
  de 1 a 99999999999999999 para op��o de at� 17 d�gitos

#################################################
*/


// SEUS DADOS
//$dadosboleto["identificacao"] = "BoletoPhp - Código Aberto de Sistema de Boletos";
$dadosboleto["cpf_cnpj"] = "CNPJ da CDC";
$dadosboleto["endereco"] = "Coloque o endereço da sua empresa aqui";
$dadosboleto["cidade_uf"] = "Cidade / Estado";
$dadosboleto["cedente"] = "Scan Source CDC Brasil";

// N�O ALTERAR!
include("include/funcoes_bb.php"); 
include("include/layout_bb.php");
?>
