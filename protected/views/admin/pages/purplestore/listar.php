<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "purplestore") . ' - ' . $attributes['chamada'] ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
  
    <div class="clear"></div>
    <div class="ctnAdvCenter">       
        <a href="/admin/purplestore/listar/bloco_pagina">
            <input type="button" class="bt_ear_up_big right users_tab" value="Componentes páginas"/>
        </a>
        <a href="/admin/purplestore/listar/email_content">
            <input type="button" class="bt_ear_up_big right users_tab" value="Componentes e-mail"/>
        </a>
        <a href="/admin/purplestore/listar/componente_site">
            <input type="button" class="bt_ear_up_big right users_tab" value="Componentes site"/>
        </a>
        
        <div class="clear"></div>
    </div>
    <div class="divider_horizontal" style="padding:0px; margin-bottom: 30px;"></div>
    <div id="ItemManager">
        <div class='containerComponentes'>
            
        <?php if($attributes['path'] == 'layout_aplicativo'){ ?>
            <div>
                <div class="left mgR2">                    
                    <i class="icon_info"></i>                    
                </div>
                <div class="inline_block mgTN">
                    <h4>Informações</h4>
                    <p>Alguns aplicativos só podem ser adicionados a nova plataforma PurplePier, que é responsiva.</p>
                    <p>Caso sua plataforma não seja responsiva faça o pedido da Plataforma responsiva, basta clicar no aplicativo</p>
                </div> 
                <div class="divider_shadow mgT"></div>
            </div>
            
        <?php } ?>
            
        <?php if($content && count($content) > 0){ foreach ($content as $values) { ?>           
            <div class="containerStorePurple" id="img_container_<?php echo $values['id'] ?>"> 
                <?php if($values['lancamento']){ ?><div class='badge_novo'></div><?php } ?>
                <img src="https://www.purplepier.com.br/media/images/<?php echo $attributes['path'] ?>/<?php echo $values['thumb'] ?>" alt="" title="<?php echo $values['titulo'] ?>" id="<?php echo $values['thumb'] ?>"/>
                <div class="ctnLegendAdv">
                    <h4 id="mainBlockTitulo"><?php echo $values['titulo'] ?></h4>
                    <p id="mainBlockTexto"><?php echo nl2br($values['descricao']) ?></p>
                </div>
                <div class="mgT">
                    <div class="left">
                        <?php if($attributes['path'] != 'layout_aplicativo'){ ?>
                        <input type="button" class="bt_buy_item_pp botao left" alt="" title="<?php echo $values['titulo'] ?>" id="<?php echo $values['id'] ?>" name="<?php echo $attributes['type'] ?>" value="comprar" />
                        <?php }else{ ?>
                        <input type="button" class="bt_buy_item_pp botao left" alt="" title="<?php echo $values['titulo'] ?>" id="<?php echo $values['id'] ?>" name="<?php echo $attributes['type'] ?>" value="instalar"/>
                        <?php } ?>
                        
                        <?php if(Yii::app()->params['purple'] == 1){ ?>
                        <a href="/admin/purplestore/editar/<?php echo $values['id'] ?>">
                            <input type="button" class="bt_edit left" alt="" title="<?php echo $values['titulo'] ?>" style="margin: 10px 0 0 15px"/>
                        </a>
                        <input type="button" class="bt_delete left" alt="" title="<?php echo $values['titulo'] ?>" style="margin: 10px 0 0 5px"/>
                        <?php } ?>
                    </div>
                    <div class="right">
                        <?php if($values['promocao'] != '' && $values['promocao'] != 0){ ?>
                        <div class="valor cross left"><?php echo $values['valor_string'] ?></div>
                        <div class="valor"><?php echo $values['promocao_string'] ?></div>                        
                        <?php }else{ ?>
                        <div class="valor"><?php echo $values['valor_string'] ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="clear mgB"></div>
            <div class="divider_shadow"></div>
            
        <?php } ?> 
            <div class="bold right">Total - <?php echo count($content) ?> item(s)</div>
        </div>
        <?php }else{ ?>
        <div class="result-message">
            <span><?php echo Yii::t("messageStrings", "message_no_records_found") ?></span>
        </div>
        <?php } ?>
        
    </div>
    <input type="hidden" id="helper_action" data-js-action="listar"/>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_top") ?>" />
    </div>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>