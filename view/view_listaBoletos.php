<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<script type="text/javascript" src="../lib/js/wsCdc.js"></script>

<meta charset="UTF-8">
<?php require_once '../lib/functions.php'; ?>
<?php require_once '../lib/includes.php'; ?>

<link rel="stylesheet" type="text/css" href="../style.css">

<?php session_start(); ?>

<div id="container">
    
    <div id="titulo" style="margin: 20px auto 0 auto; width: 550px;">
        <img src="<?php echo __LIB_PATH__?>/imagens/titulo_emissao_ss.png" style="margin: 0 auto;">
    </div>
    <?php foreach ($lista as $bl){
        
        $n_f = substr($bl->id,0,-2);
        
        if($n_f == $aux_array['lancamento']){
            $j++;
        }
        
    } ?>
    
    <?php
        if($j == 0){
            $_SESSION['error'] = true;
            $_SESSION['error_msg'] = 'Não há boletos para nota fiscal: ' . $aux_array['lancamento'];
            header ("location: " . __PROJECT_PATH__);
            exit();
        }
    ?>
    
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
                $i=0;
                foreach ($lista as $boletos){  ?>
            
                    <?php 
                    
                    $nf = substr($boletos->id,0,-2);
                    
                    if($nf == $aux_array['lancamento']){ $i++; ?>
                        <form id="form_boleto_<?php echo $i; ?>" target="blank" method="POST" action="<?php echo __CONTROL_PATH__ ?>/ctrl_boleto.php">
                            <tr>

                                <td style="width: 54px;">
                                    <?php echo $i; ?>

                                </td>

                                <td style="width: 154px;">
                                    <?php echo $boletos->id; ?>
                                    <input type="hidden" id="id" name="id" value="<?php echo $boletos->id; ?>">
                                    <input type="hidden" id="lancamento" name="lancamento" value="<?php echo $boletos->lancamento; ?>">

                                </td>

                                <td style="width: 160px;">
                                    <input type="hidden" id="valor" name="valor" value="<?php echo $boletos->valor; ?>">
                                    <?php echo insereVirgula($boletos->valor); ?>
                                </td>

                                <td style="width: 174px;">

                                    <p class="vencimento"><?php echo $boletos->vencimento; ?></p>
                                    <input type="hidden" id="vencimento_<?php echo $i;?>" class="vencimento" name="vencimento" value="<?php echo $boletos->vencimento; ?>">

                                </td>

                                <td style="width: 194px;">

                                    <?php

                                        $vencimento = CalcularVencimento($boletos->vencimento, 57);

                                        if($vencimento['vencido'] == true && $vencimento['limite_execedido'] != TRUE){ ?>

                                            <input type="hidden" id="dt_limite_<?php echo $i; ?>" class="dt_limite" value="<?php echo $vencimento['dt_limite']; ?>">
                                            <input type="hidden" id="limite_excedido" name="limite_excedido" value="<?php echo $vencimento['limite_execedido']; ?>">
                                            <input type="text" id="novo_vencimento_<?php echo $i; ?>" name="novo_vencimento" class="novo_vencimento" value="<?php echo date('d/m/Y'); ?>">

                                        <?php } else { ?>
                                                    
                                            <input type="text" disabled id="novo_vencimento_<?php echo $i; ?>" name="novo_vencimento" class="novo_vencimento" value="<?php echo date('d/m/Y'); ?>">
                                            <input type="hidden" id="novo_vencimento_<?php echo $i; ?>" name="novo_vencimento" class="novo_vencimento" value="<?php echo date('d/m/Y'); ?>">
                                            
                                                <?php } ?>
                                            <input type="hidden" id="hoje" class="hoje" name="hoje" value="<?php echo date('d/m/Y');?>">
                                </td>

                                <td style="width: 145px;">
                                    <?php

                                        if($vencimento['limite_execedido'] == TRUE){ ?>
                                            <img src="../lib/imagens/info_icone.png" width="10px" height="10px" align="center" class="info_icn" title="O boleto selecionado não está disponível. Favor entrar em contato com o departamento de cobrança, através do telefone (41) 2169-6515 ou pelo e-mail: cobranca@scansource.com.br">

                                        <?php }else{ ?>
                                            <div id="gerar_boleto_<?php echo $i; ?>" class="gerar_boleto">Gerar Boleto</div>
                                            </td>

                                        <?php } ?>

                                <input type="hidden" id="acao" name="acao" value="consultaBoleto">
                            </tr>
                        </form>
                    <?php } ?>

                <?php } ?>
                
            </table>
        </div>
        
    </div>
       
</div>

<div id="footer">
    <div id="logo_footer">
        <img src="<?php echo __LIB_PATH__?>/imagens/logo_ss_branco.jpg">
    </div>
</div>