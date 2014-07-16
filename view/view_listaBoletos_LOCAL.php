<?php session_start(); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<script type="text/javascript" src="../lib/js/wsCdc.js"></script>

<meta charset="UTF-8">

<?php require_once '../lib/functions.php'; ?>

<link rel="stylesheet" type="text/css" href="../style.css">



<div id="container"> 
    
        <div id="titulo" style="margin: 20px auto 0 auto; width: 550px;">
            <img src="http://www.ambientelivre.com.br/ws_cdc/lib/imagens/titulo_emissao_ss.png" style="margin: 0 auto;">
        </div>

    
    
    <div id="bg_result">
        <div id="h_result">

            <h1>Boletos de: <?php echo $razao_social;?></h1>
            <h2>Total de boletos: <?php echo $j;?></h2>
            <div class="m_result" style="width: 4.9%; ">Nº</div>
            <div class="m_result" style="width: 18.4%;">NF-PARCELA</div>
            <div class="m_result" style="width: 18.3%;">Valor</div>
            <div class="m_result" style="width: 19.3%;">Vencimento</div>
            <div class="m_result" style="width: 21.3%;">Reagendamento</div>
            <div class="m_result" style="width: 16.2%;">Ação</div>


        </div>

        <div id="basehome_result">

        <table border='0'>

            <th  width="5.19%"></th>
            <th width="18.8%"></th>
            <th width="18.5%"></th> 
            <th width="19.6%"></th>
            <th width="21.8%"></th>
            <th width="16.4%"></th>

            <?php

    $lista = array(
                    array('lancamento' => '4471004','id' => '339022-A', 'vencimento' => '31/06/2014', 'valor' => '100', 'banco' => 'bb'),
                    array('lancamento' => '4471005','id' => '339023-B', 'vencimento' => '31/05/2014', 'valor' => '100', 'banco' => 'itau'),
                    array('lancamento' => '4471006','id' => '339024-C', 'vencimento' => '30/04/2015', 'valor' => '10', 'banco' => 'itau'),
                    array('lancamento' => '4471007','id' => '339022-D', 'vencimento' => '30/04/2014', 'valor' => '1,00', 'banco' => 'hsbc')
             );

    
                $raiz = substr($lista[0]['id'],0,-2);
                
            $i=0;
                foreach ($lista as $boletos){  ?>
                
                <?php if($boletos['id'] == 339022){ $i++; ?>
                    <form id="form_boleto_<?php echo $i; ?>" target="blank" method="POST" action="../control/ctrl_boleto.php">
                        <tr>

                            <td>
                                <?php echo $i; ?>
                            </td>

                            <td>
                                <?php echo $boletos['id']; ?>
                                <input type="hidden" id="id" name="id" value="<?php echo $boletos['id']; ?>">
                            </td>

                            <td>
                                <input type="hidden" id="valor" name="valor" value="<?php echo $boletos['valor']; ?>">
                                <?php echo insereVirgula($boletos['valor']); ?>
                            </td>

                            <td>             
                                <p class="vencimento"><?php echo $boletos['vencimento']?></p>
                                <input type="hidden" id="vencimento_<?php echo $i;?>" class="vencimento" name="vencimento" value="<?php echo $boletos['vencimento']; ?>">

                            </td>

                            <td>

                                <?php
                                    $vencimento = CalcularVencimento($boletos['vencimento'], 57);                            
                                    if($vencimento['vencido'] == true && $vencimento['limite_execedido'] != TRUE){ ?>

                                <input type="hidden" id="dt_limite_<?php echo $i; ?>" class="dt_limite" value="<?php echo $vencimento['dt_limite']; ?>">
                                    <input type="text" id="novo_vencimento_<?php echo $i; ?>" name="novo_vencimento" class="novo_vencimento" value="<?php echo $boletos['vencimento']?>">
                                    <input type="hidden" id="h_novo_vencimento_<?php echo $i; ?>" class="h_novo_vencimento" value="">

                                    <?php } else{ ?>
                                        <img src="../lib/imagens/erro-no-calendario.png" title="Reagendadmento Indisponivél" >
                                           <?php } ?>
                                <input type="hidden" id="hoje" class="hoje" name="hoje" value="<?php echo date('d/m/Y');?>">
                            </td>

                            <td>
                                <?php

                                    if($vencimento['limite_execedido'] == TRUE){ ?>
                                        <img src="../lib/imagens/info_icone.png" width="10px" height="10px" align="center" class="info_icn" title="LOREM IPSUM">

                                    <?php }else{ ?>
                                        <div id="gerar_boleto_<?php echo $i; ?>" class="gerar_boleto">Gerar Boleto</div>
                                        </td>

                                    <?php } ?>

                            <input type="hidden" id="acao" name="acao" value="consultaBoleto">
                        </tr>
                    </form>
                   <?php } ?>
                    <!--<form id="form_boleto_<?php echo $i; ?>" method="POST" action="http://www.ambientelivre.com.br/ws_cdc/control/ctrl_boleto.php">-->

                <?php } ?>
        </table>

        </div>
    </div>
    
</div>

<div id="footer">
    <div id="logo_footer">
        <img src="http://www.ambientelivre.com.br/ws_cdc/lib/imagens/logo_ss_branco.jpg">
    </div>
</div>