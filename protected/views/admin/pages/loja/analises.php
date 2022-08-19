<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Análises da loja</h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>    
    <a href="/admin/beneficios/novo">
        <input class="bt_right" type="button" value="<?php echo Yii::t("adminForm", "button_common_new") ?>"/>
    </a>
    <div class="clear"></div>
    <div class="comboboxSelector_double">        
        <label class="filtro_pos"><?php echo Yii::t("adminForm", "title_common_filter") ?></label>
        <div class="styled-select-small left mgR0">
            <?php include Yii::app()->getBasePath() . "/views/admin/common/filter/year.php"; ?>
        </div>
        <div class="styled-select2 left mgR0">
            <?php  include Yii::app()->getBasePath() . "/views/admin/common/filter/month.php"; ?>
        </div>     
    </div> 

    <div class="clear"></div>
    <div class="ctnAdvCenter">
        <a href="/admin/loja/analises">
            <input type="button" id="bt_choose_template" class="bt_ear_up_big right" value="<?php echo Yii::t("adminForm", "button_common_steps") ?>"/>
        </a>
        <a href="/admin/loja/estatisticas">
            <input type="button" id="bt_edit_template" class="bt_ear_up_big right" value="<?php echo Yii::t("adminForm", "button_common_statistics") ?>"/>
        </a>
        <div class="clear"></div>
    </div>
    <div class="divider_horizontal" style="padding:0px;"></div>
    <p>&nbsp;</p><p>&nbsp;</p>
    <div class="estatisticas_support">
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Iniciando pagamento</b> - <span class="purple"><?php echo count($step_1) ?></span> interesse(s) de compra / Meta <span class="gray"><?php echo $milestone['loja_step_1'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_step_1 ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_step_1 < 1){echo '0; display: none;';} else{if($porcentagem_step_1 < 100){echo $porcentagem_step_1;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php if(count($step_1) > 0){echo $porcentagem_step_1;}else{echo '0';} ?>%</div>
            <div class="values"><?php echo count($step_1) ?> / <?php echo $milestone['loja_step_1'] ?></div>
            <div class="clear"></div>
        </div>
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Identificação</b> - <span class="purple"><?php echo count($step_2) ?></span> identicação(s) de usuário / Meta <span class="gray"><?php echo $milestone['loja_step_2'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_step_2 ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_step_2 < 1){echo '0; display: none;';} else{if($porcentagem_step_2 < 100){echo $porcentagem_step_2;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php if(count($step_2) > 0){echo $porcentagem_step_2;}else{echo '0';} ?>%</div>
            <div class="values"><?php echo count($step_2) ?> / <?php echo $milestone['loja_step_2'] ?></div>
            <div class="clear"></div>
        </div>       
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Novo cadastro de usuário</b> - <span class="purple"><?php echo count($step_3) ?></span> cadastro(s) de usuário / Meta <span class="gray"><?php echo $milestone['loja_step_3'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_step_3 ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_step_3 < 1){echo '0; display: none;';} else{if($porcentagem_step_3 < 100){echo $porcentagem_step_3;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php if(count($step_3) > 0){echo $porcentagem_step_3;}else{echo '0';} ?>%</div>
            <div class="values"><?php echo count($step_3) ?> / <?php echo $milestone['loja_step_3'] ?></div>
            <div class="clear"></div>
        </div>
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Cadastro de usuário efetivado</b> - <span class="purple"><?php echo count($step_3b) ?></span> cadastro(s) de usuário efetivados / Meta <span class="gray"><?php echo $milestone['loja_step_3b'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_step_3b ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_step_3b < 1){echo '0; display: none;';} else{if($porcentagem_step_3b < 100){echo $porcentagem_step_3b;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php if(count($step_3b) > 0){echo $porcentagem_step_3b;}else{echo '0';} ?>%</div>
            <div class="values"><?php echo count($step_3b) ?> / <?php echo $milestone['loja_step_3b'] ?></div>
            <div class="clear"></div>
        </div>
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Informar endereço</b> - <span class="purple"><?php echo count($step_3a) ?></span> informe(s) de endereço / Meta <span class="gray"><?php echo $milestone['loja_step_3a'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_step_3a ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_step_3a < 1){echo '0; display: none;';} else{if($porcentagem_step_3a < 100){echo $porcentagem_step_3a;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php if(count($step_3a) > 0){echo $porcentagem_step_3a;}else{echo '0';} ?>%</div>
            <div class="values"><?php echo count($step_3a) ?> / <?php echo $milestone['loja_step_3a'] ?></div>
            <div class="clear"></div>
        </div>
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Cadastrar / Atualizar endereço</b> - <span class="purple"><?php echo count($step_3c) ?></span> interação(s) de endereço / Meta <span class="gray"><?php echo $milestone['loja_step_3c'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_step_3c ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_step_3c < 1){echo '0; display: none;';} else{if($porcentagem_step_3c < 100){echo $porcentagem_step_3c;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php if(count($step_3c) > 0){echo $porcentagem_step_3c;}else{echo '0';} ?>%</div>
            <div class="values"><?php echo count($step_3c) ?> / <?php echo $milestone['loja_step_3c'] ?></div>
            <div class="clear"></div>
        </div>
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Escolha de embalagens</b> - <span class="purple"><?php echo count($step_4) ?></span> escolha(s) de embalagem / Meta <span class="gray"><?php echo $milestone['loja_step_4'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_step_4 ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_step_4 < 1){echo '0; display: none;';} else{if($porcentagem_step_4 < 100){echo $porcentagem_step_4;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php if(count($step_4) > 0){echo $porcentagem_step_4;}else{echo '0';} ?>%</div>
            <div class="values"><?php echo count($step_4) ?> / <?php echo $milestone['loja_step_4'] ?></div>
            <div class="clear"></div>
        </div>
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Forma de envio</b> - <span class="purple"><?php echo count($step_5) ?></span> escolha(s) da forma envio / Meta <span class="gray"><?php echo $milestone['loja_step_5'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_step_5 ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_step_5 < 1){echo '0; display: none;';} else{if($porcentagem_step_5 < 100){echo $porcentagem_step_5;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php if(count($step_5) > 0){echo $porcentagem_step_5;}else{echo '0';} ?>%</div>
            <div class="values"><?php echo count($step_5) ?> / <?php echo $milestone['loja_step_5'] ?></div>
            <div class="clear"></div>
        </div>
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Forma de pagamento</b> - <span class="purple"><?php echo count($step_6) ?></span> escolha(s) da forma pagamento / Meta <span class="gray"><?php echo $milestone['loja_step_6'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_step_6 ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_step_6 < 1){echo '0; display: none;';} else{if($porcentagem_step_6 < 100){echo $porcentagem_step_6;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php if(count($step_6) > 0){echo $porcentagem_step_6;}else{echo '0';} ?>%</div>
            <div class="values"><?php echo count($step_6) ?> / <?php echo $milestone['loja_step_6'] ?></div>
            <div class="clear"></div>
        </div>
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Vendas efetivadas</b> - <span class="purple"><?php echo count($step_7) ?></span> venda(s) efetivadas / Meta <span class="gray"><?php echo $milestone['loja_step_7'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_step_7 ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_step_7 < 1){echo '0; display: none;';} else{if($porcentagem_step_7 < 100){echo $porcentagem_step_7;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php if(count($step_7) > 0){echo $porcentagem_step_7;}else{echo '0';} ?>%</div>
            <div class="values"><?php echo count($step_7) ?> / <?php echo $milestone['loja_step_7'] ?></div>
            <div class="clear"></div>
        </div>
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Erros Pagamento</b> - <span class="purple"><?php echo count($step_7_error) ?></span> erros / Meta <span class="gray">0</span></div> 
            <div class="barSupport" style="width: <?php echo $size_step_7_error ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_step_7_error < 1){echo '0; display: none;';} else{if($porcentagem_step_7_error < 100){echo $porcentagem_step_7_error;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php if(count($step_7_error) > 0){echo $porcentagem_step_7_error;}else{echo '0';} ?>%</div>
            <div class="values"><?php echo count($step_7_error) ?> / <?php echo $milestone['loja_step_7_error'] ?></div>
            <div class="clear"></div>
        </div>
        
    </div>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="clear"></div>
 
    <div class="buttons_right">
        <input class="bt_right" type="button" value="<?php echo Yii::t("adminForm", "button_common_top") ?>" id="bt_top"/>
    </div>
    <div class="clear height_support"></div>
    <input type="hidden" id="helper_page_name" value="ecommerce"/>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?><div class="container_pan">
   