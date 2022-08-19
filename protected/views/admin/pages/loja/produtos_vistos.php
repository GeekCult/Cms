<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Produtos mais visualizados</h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>    
    <p>&nbsp;</p>
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
    <p>&nbsp;</p><p>&nbsp;</p>
    <div class="estatisticas_support">
        <?php if($content){foreach($content as $values){ ?>
        <div class="itemEstatistica">
            <div class="sFontSmall"><b><?php echo $values['nome'] ?></b> - <span class="purple"><?php echo $values['views'] ?></span> visualização(s) / Meta <span class="gray"><?php echo $milestone['views'] ?></span></div> 
            <div class="barSupport" style="width: 99%;">
                <div class="progressMilestone left">
                    <div class="progressbar purple" style="width: <?php $porcentagem_vendas = ($values['views'] / $milestone['views'] * 100); if($porcentagem_vendas < 1){echo '0; display: none;';} else{if($porcentagem_vendas < 100){echo $porcentagem_vendas;}else{echo '99.3';}}?>%;"></div>
                </div>
            </div>
            <div class="porcentagem left"><?php echo $porcentagem_vendas ?>%</div>
            <div class="values"><?php echo $values['views'] ?> / <?php echo $milestone['views'] ?></div>
            <div class="clear"></div>
        </div>
        <?php }}else{ ?>
        <div class="itemEstatistica">
            <p class='center bold'>Não há estatíticas nesse período</p>
            <div class="clear"></div>
        </div>
        <?php } ?>
        
        
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
   