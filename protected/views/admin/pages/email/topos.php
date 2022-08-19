<script type="text/javascript" src="/js/admin/texturas.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", 'textures_page_list_title_see') . $title_texture ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/texturas/<?php echo $title_texture?>/novo">
        <input type="button" class="bt_right" id="bt_top" value="<?php echo Yii::t("adminForm", 'button_common_new') ?>"/>
    </a>
    <p>&nbsp;</p>
    <div class="layoutAdmin_blocks">       
        <div id="buttons_support" class="layout_textures">
           <?php foreach($content as $values){ ?>
            <div class="container_texture_<?php echo $values["local"] ?>"  id="text_<?php echo $values["id"] ?>">
                <?php if($values["local"] == "overlay") { ?>
                <div class="fake_img_<?php echo $values["local"] ?>" title="<?php echo $values["nome"] ?>" >
                <img alt="" class="img_texture" src="/media/images/textures/<?php echo $title_texture ?>/<?php echo $values["url_textura"] ?>" width="700" height="280" title="<?php echo $values["nome"] ?>" />
                <?php } else { ?>
                <div style="background: url(/media/images/textures/<?php echo $title_texture ?>/<?php echo $values["url_textura"] ?>); " class="fake_img_<?php echo $values["local"] ?>" title="<?php echo $values["nome"] ?>" >
                <img alt="" class="img_texture" src="" width="<?php echo $width_fake ?>" height="<?php echo $height_fake ?>" title="<?php echo $values["nome"] ?>"  />
                <?php } ?>
                </div>
                <div class="container_edit_texture">
                    <div class="radio_content_texture">
                        <input type="radio" name="opcao" value="<?php echo $values["url_textura"] ?>" alt="<?php echo $values["tipo"] ?>" <?php if($item_choose == $values['url_textura']){echo "checked";} ?> class="<?php echo $values["bg_color"] ?>" data-tipo=""/>
                    </div>                    
                </div>
                <div class="right">
                    <input type="button" id="bt_edit" name="<?php echo $values["id"] ?>" alt="<?php echo $values["local"] ?>" class="left"/>
                    <input type="button" id="bt_delete" name="<?php echo $values["id"] ?>" alt="<?php echo $values["url_textura"] ?>" class="left"/>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="container_all_info_tips">    
    <div class="container_info_dicas">
        <div class="container_divider_info">
            <div class="divider_corner_left"></div>
            <div class="divider_corner_middle"></div>
            <div class="divider_corner_rigth"></div>
        </div>
        <div class="rows_dicas_bottom">
            <div class="label_text_dicas"><b>Dicas para uso das galerias:</b></div>                
            <div class="conf_container_text_tip">
                <p class="conf_text_tip">Copie e cole o ID ao lado dos nomes para ter acesso as galerias.</p>
                <p class="conf_text_tip">Não há necessidade de utilziar o nome da galeria apenas o ID.</p>                        
            </div>
            <div class="container_infotip_bottom">
            <?php $this->widget('application.widgets.infotip.InfoTipWidget', array('title' => $title_dica, 'dica' => $text_dica, 'link' => $link_dica)); ?>
            </div>
        </div>
    </div>        
</div>
<div class="buttons_right">
    <input type="button" class="bt_right" id="bt_define" value="<?php echo Yii::t("adminForm", 'button_common_define') ?>" />
    <input type="button" class="bt_right" id="bt_top" value="<?php echo Yii::t("adminForm", 'button_common_top') ?>"/>
</div>
<div class="clear height_support"></div>
<input id="local" value="<?php echo $title_texture?>" type="hidden"/>
<script type="text/javascript">initListenersTexturesList();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>