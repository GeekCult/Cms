<script language="javascript" type="text/javascript" src="/js/site/special/purple/purplestore.js"></script>
<div class="header_purple_store">
    <div class="logo_pp_header"></div>
</div>
<div class="">
    <h1 class="left">PurpleStore</h1>
    <div class="ctnAdvCenter" style="display: inline-block;  display: inline-block; float: right; margin-top: 35px; ">       
        <a href="/admin/purplestore/listar/bloco_pagina">
            <input type="button" id="bt_edit_template" class="bt_ear_up_big right users_tab" value="Componentes páginas" data-tab="0"/>
        </a>
        <a href="/admin/purplestore/listar/componente_site">
            <input type="button" id="bt_choose_template" class="bt_ear_up_big right users_tab" value="Componentes site" data-tab="1"/>
        </a>
        <a href="/admin/purplestore/listar/templates">
            <input type="button" id="bt_choose_template" class="bt_ear_up_big right users_tab" value="Templates" data-tab="2"/>
        </a>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="divider_horizontal" style="padding:0px; margin-bottom: 30px;"></div>
    <div class="clear" id="images_support">
        <div id="Searchresult">
        <?php if($content){ foreach ($content as $values) { ?>
            <?php if($values['thumb'] != ""){ ?>
            <div class="containerStorePurpleFancy" id="img_container_<?php echo $values['id'] ?>">
                <div class='containerCompoenntes'>                                      
                    <img src="http://www.purplepier.com.br/media/images/<?php echo $attributes['path'] ?>/<?php echo $values['thumb'] ?>" width='260' alt="" title="<?php echo $values['titulo'] ?>" id="<?php echo $values['thumb'] ?>"/>
                    <div class="left">
                        <?php if($attributes['path'] != 'layout_aplicativo'){ ?>
                        <input type="button" class="bt_buy_item_pp botao" alt="comprar" title="<?php echo $values['titulo'] ?>" id="<?php echo $values['thumb'] ?>" name="<?php echo $values['id'] ?>" value="comprar"/>
                        <?php }else{ ?>
                        <input type="button" class="bt_buy_item_pp botao" alt="instalar" title="<?php echo $values['titulo'] ?>" id="<?php echo $values['thumb'] ?>" name="<?php echo $values['id'] ?>" value="instalar"/>
                        <?php } ?>
                    </div>
                    <div class="right">
                        <div class="valor"><?php echo $values['valor_string'] ?></div>
                    </div>
                </div>
            </div>
        <?php } }?>           
        </div>
        <?php }else{ ?>
        <div class="result-message">
            <span><?php echo Yii::t("messageStrings", "message_no_records_found") ?></span>
        </div>
        <?php } ?>
    </div>
</div>
<input type="hidden" id="helper_records" value="<?php //echo $content['records'] ?>"/>
<?php /*
<?php if($init) { ?>
<script type="text/javascript">initPagination();</script>
<?php } ?>

*/?>
<script type="text/javascript">

    $(".bt_buy_item_pp").live('click', function(){
        buyPPItem(this.name, "banner");
    });
    
</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>