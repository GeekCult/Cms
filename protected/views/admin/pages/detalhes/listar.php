<script type="text/javascript" src="/js/admin/detalhes.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "details_page_list_title_see") . $title ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/detalhes/<?php echo $title ?>/novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new") ?>"/>
    </a>
    <div id="buttons_support" class="layoutAdmin">
        <div class="container_texture_empty">
                <div class="title_empty_texture">
                    <input type="button" id="bt_device_desktop" class="icon_desktop_square" title="Escolher Desktop" alt="desktop"/>
                    <input type="button" id="bt_device_tablet" class="icon_tablet_square" title="Escolher Tablet" alt="tablet"/>
                    <input type="button" id="bt_device_mobile" class="icon_mobile_square" title="Escolher Mobile" alt="mobile"/>
                </div>
                <div class="container_combo_empty_radio">
                    <div class="label_title_empty_texture">Sem textura</div>
                    <div class="radio_empty_texture">
                        <input type="radio" name="opcao" value="empty.png" alt="0" class="transparent" <?php if($item_choose == ""){echo "checked";} ?>/>
                    </div>
                    <img src="/media/images/layout/textures_empty.png"/>
                </div>            
            </div>
            <?php if($content){ foreach ($content as $values) { ?>
            <div class="contentLayouts" id="det_<?php echo $values["id"] ?>" >
                <div class="imageContent_<?php echo $values['local'] . ' content_'  . $values['local'] ?>" title="<?php echo $values['nome'] ?>">
                    <?php if( $values['local'] == "logos") {?>
                    <img alt="" src="/media/user/images/logos/<?php echo $values['url_image'] ?>"/>
                    <?php }else { ?>
                    <img alt="" src="/media/images/detalhes/<?php echo $values['local'] ?>/<?php echo $values['url_image'] ?>"/>
                    <?php }?>
                </div>
                <div class="item_cor_table">
                    <div class="radioContent_<?php echo $values['local'] ?>"> 
                        <?php if($values['local'] != "container" && $values['local'] != "pagination") {?>
                        <input type="radio" name="opcao" value="<?php echo $values['url_image'] ?>" <?php if($item_choose == $values['url_image']){echo "checked";} ?>/>
                        <?php } else{ ?>
                        <input type="radio" name="opcao" value="<?php echo $values['classe'] ?>" <?php if($item_choose == $values['classe']){echo "checked";} ?>/>
                        <?php } ?>
                        <span><?php echo $values['nome'] ?></span>
                    </div>
                    <div class="excluir_<?php echo $values['local'] ?>">
                        <div class='imageExcluir'>
                            <input type="button" id="bt_edit" name="<?php echo $values["id"] ?>" alt="<?php echo $values["local"] ?>" class="left"/>
                            <input type="button" id="bt_delete" name="<?php echo $values["id"] ?>" class="left"/>
                        </div>
                    </div>
                </div>
            </div>
            <?php }}else{ ?>
            <div>
                <div>Não há item para esta categoria</div>
            </div>
            <?php } ?>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_define" value="<?php echo Yii::t("adminForm", "button_common_define") ?>" />
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
    </div>
    <p>&nbsp;</p>
    <div class="clear height_support"></div>
</div>
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
<input type="hidden" id="helper_action" data-js-action="listar"/>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>