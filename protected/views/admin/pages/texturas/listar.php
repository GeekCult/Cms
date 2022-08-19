<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", 'textures_page_list_title_see') . $title_texture ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <?php if(Yii::app()->params['local'] == 1 || Yii::app()->params['purple'] == 1){ ?>
    <a href="/admin/texturas/<?php echo $title_texture ?>/novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", 'button_common_acervo') ?>"/>
    </a>
    <?php } ?>
    <a href="/admin/texturas/<?php echo $title_texture?>/adicionar">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", 'button_common_new') ?>"/>
    </a>
    <input type="button" class="bt_right bt_define" value="<?php echo Yii::t("adminForm", 'button_common_define') ?>" />
    <div class="clear"></div>
    <div class="layoutAdmin_blocks">        
        <div id="buttons_support" class="layout_textures"> 
            
            <?php if($title_texture == 'botao'){ ?>
            <div id="menu_conta" class="mgT2 mgB2">
                <div class="menu_conta_container_buttons" style="right:0">
                    <ul>
                        <li id="link_conta_01" class="blc_tab" data-tab="0"><a href="/admin/texturas/botao/listar"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Comum</div><div class="tab_corner_disable_right"></div></a></li>
                        <li id="link_conta_02" class="blc_tab" data-tab="1"><a href="/admin/texturas/botao_especial/escolher"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Especial</div><div class="tab_corner_disable_right"></div></a></li>
                    </ul>
                </div>
            </div>
            <div class="divider_horizontal"></div>
            <?php } ?>
            <div class="container_texture_empty">
                <div class="title_empty_texture">
                    <input type="button" id="bt_device_desktop" class="icon_desktop_square" title="Escolher Desktop" alt="desktop"/>
                    <input type="button" id="bt_device_tablet" class="icon_tablet_square" title="Escolher Tablet" alt="tablet"/>
                    <input type="button" id="bt_device_mobile" class="icon_mobile_square" title="Escolher Mobile" alt="mobile"/>
                </div>
                <div class="container_combo_empty_radio">
                    <div class="label_title_empty_texture">Sem textura</div>
                    <div class="radio_empty_texture">
                        <input type="radio" name="opcao" value="empty.png" alt="0" class="transparent" <?php if($item_choose == ""){echo "checked";} ?> data-tipo=""/>
                    </div>
                    <img src="/media/images/layout/textures_empty.png"/>
                </div>            
            </div>
            
            <?php if($content_user){foreach($content_user as $values_user){ ?>
            <div class="container_texture_<?php echo $values_user["local"] ?>"  id="text_<?php echo $values_user["id"] ?>">
                <?php if($values_user["local"] == "overlay" || $values_user["local"] == "wallpaper") { ?>
                <div class="fake_img_<?php echo $values_user["local"] ?>" title="<?php echo $values_user["titulo"] ?>" >
                <img alt="" class="img_texture" src="/media/user/images/original/<?php echo $values_user["foto"] ?>" width="960" height="280" title="<?php echo $values_user["titulo"] ?>" />
                <?php } else { ?>
                <div class="container_images_textures">
                    <div style="background: url(/media/user/images/original/<?php echo $values_user["foto"] ?>); " class="fake_img_<?php echo $values_user["local"] ?>" title="<?php echo $values_user["titulo"] ?>" >
                    <img alt="" class="img_texture" src="" width="<?php echo $width_fake ?>" height="<?php echo $height_fake ?>" title="<?php echo $values_user["titulo"] ?>"  />
                    </div>
            
                <?php } ?>
                   
                </div>
                <div class="container_edit_texture">
                    <div class="radio_content_texture">
                        <input type="radio" name="opcao" value="<?php echo $values_user["foto"] ?>" alt="<?php echo $values_user["type_repeat"] ?>" <?php if($item_choose == $values_user['foto']){echo "checked";} ?> class="<?php echo $values_user["cor"] ?>" data-tipo="user"/>
                    </div>
                    <div class="edit_texture">
                        <input type="button" id="bt_edit_user" name="<?php echo $values_user["id"] ?>" alt="<?php echo $values_user["local"] ?>" class="left bt_edit"/>
                        <input type="button" id="bt_delete" name="<?php echo $values_user["id"] ?>" alt="<?php echo $values_user["foto"] ?>" class="left"/>
                    </div>
                </div>
                <?php if($values_user["local"] == "botao"){?>
                <div class="clear"></div>
                <?php } ?>
                
            </div>
            <?php }} ?>
                
            <?php if($content_user){ ?><div class="clear divider_shadow"></div><?php } ?>
            <div class="clear"></div>
            
            <?php if($content){foreach($content as $values){ ?>
            <div class="container_texture_<?php echo $values["local"] ?>"  id="text_<?php echo $values["id"] ?>">
                <?php if($values["local"] == "overlay" || $values["local"] == "wallpaper") { ?>
                <div class="fake_img_<?php echo $values["local"] ?>" title="<?php echo $values["nome"] ?>" >
                <img alt="" class="img_texture" src="/media/images/textures/<?php echo $title_texture ?>/<?php echo $values["url_textura"] ?>" width="960" height="280" title="<?php echo $values["nome"] ?>" />
                <?php } else { ?>
                <div class="container_images_textures">
                    <div style="background: url(/media/images/textures/<?php echo $title_texture ?>/<?php echo $values["url_textura"] ?>); " class="fake_img_<?php echo $values["local"] ?>" title="<?php echo $values["nome"] ?>" >
                    <img alt="" class="img_texture" src="" width="<?php echo $width_fake ?>" height="<?php echo $height_fake ?>" title="<?php echo $values["nome"] ?>"  />
                    </div>
            
                <?php } ?>
                </div>
                <div class="container_edit_texture">
                    <div class="radio_content_texture">
                        <input type="radio" name="opcao" value="<?php echo $values["url_textura"] ?>" alt="<?php echo $values["tipo"] ?>" <?php if($item_choose == $values['url_textura']){echo "checked";} ?> class="<?php echo $values["bg_color"] ?>" data-tipo=""/>
                    </div>
                    <div class="edit_texture">
                        <input type="button" id="bt_edit" name="<?php echo $values["id"] ?>" alt="<?php echo $values["local"] ?>" class="left"/>
                        <input type="button" id="bt_delete" name="<?php echo $values["id"] ?>" alt="<?php echo $values["url_textura"] ?>" class="left"/>
                    </div>
                </div>
                <?php if($values["local"] == "botao"){?>
                <div class="clear"></div>
                <?php } ?>
            </div>
            <?php }}else{ ?>
                <div class="bold">Não há registros desta requisição</div>
            <?php } ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
        <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
        <div class="buttons_right">
            <input type="button" id="bt_define" class="bt_right" value="<?php echo Yii::t("adminForm", 'button_common_define') ?>" />
            <input type="button" class="bt_right" id="bt_top" value="<?php echo Yii::t("adminForm", 'button_common_top') ?>"/>
        </div>
        <div class="clear height_support"></div>
    </div>
</div>
<div class="clear"></div>

<div class="menu_shortcut">
    <ul>
        <li><input type="button" class="iSM icon_save"/></li>
        <li>
            <a href="/admin/howto/tags" class="fancy-how-to-tags" title="dicas de HTML">
                <input type="button" class="iSM icon_tag"/>
            </a>
        </li>
    </ul>
</div>
<input id="local" value="<?php echo $title_texture?>" type="hidden"/>
<input type="hidden" id="helper_action" data-js-action="listar"/>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>