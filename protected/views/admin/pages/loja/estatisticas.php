<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Estatísticas da loja</h1>
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
            <div class="sFontSmall"><b>Vendas realizadas</b> - <span class="purple"><?php echo $vendas ?></span> venda(s) / Meta <span class="gray"><?php echo $milestone['vendas'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_vendas ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_vendas < 1){echo '0; display: none;';} else{if($porcentagem_vendas < 100){echo $porcentagem_vendas;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php echo $porcentagem_vendas ?>%</div>
            <div class="values"><?php echo $vendas ?> / <?php echo $milestone['vendas'] ?></div>
            <div class="clear"></div>
        </div>
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Produtos vendidos</b> - <span class="purple"><?php echo $produtos_vendidos ?></span> produtos vendidos(s) / Meta <span class="gray"><?php echo $milestone['produtos_vendidos'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_produtos_vendidos ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_produtos_vendidos < 1){echo '0; display: none;';} else{if($porcentagem_produtos_vendidos < 100){echo $porcentagem_produtos_vendidos;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php echo $porcentagem_produtos_vendidos ?>%</div>
            <div class="values"><?php echo $produtos_vendidos ?> / <?php echo $milestone['produtos_vendidos'] ?></div>
            <div class="clear"></div>
        </div>
        
        <div class="itemEstatistica">
            <div class="sFontSmall"><b>Items adicionado no carrinho</b> - <span class="purple"><?php echo count($produtos_carrinho) ?></span> produtos adicionado(s) carrinho / Meta <span class="gray"><?php echo $milestone['produtos_carrinho'] ?></span></div> 
            <div class="barSupport" style="width: <?php echo $size_produtos_carrinho ?>%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php if($porcentagem_produtos_carrinho < 1){echo '0; display: none;';} else{if($porcentagem_produtos_carrinho < 100){echo $porcentagem_produtos_carrinho;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php echo $porcentagem_produtos_carrinho ?>%</div>
            <div class="values"><?php echo count($produtos_carrinho) ?> / <?php echo $milestone['produtos_carrinho'] ?></div>
            <div class="clear"></div>
        </div>
        
        
    </div>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="clear"></div>
 
    <div class="buttons_right">
        <input class="bt_right" type="button" value="<?php echo Yii::t("adminForm", "button_common_top") ?>" id="bt_top"/>
    </div>
    <input type="hidden" id="helper_page_name" value="ecommerce"/>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?><div class="container_pan">
   