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
            <?php  include Yii::app()->getBasePath() . "/views/admin/common/special/colors.php"; ?>
            <div class="ctn_block_inline mgT">
                <span class="left mgR filtro_pos">Espessura</span>
                <div class="styled-select">
                    <select id="espessura">
                        <option value="1px">1px</option>
                        <option value="2px">2px</option>
                        <option value="3px">3px</option>
                        <option value="4px">4px</option>
                        <option value="5px">5px</option>
                        <option value="10px">10px</option>
                    </select>
                </div>
            </div>
            
            <p>&nbsp</p>
            <?php if($content){ foreach ($content as $values) { ?>
            <div class="contentLayouts" id="det_<?php echo $values["id"] ?>" >
                <div class="imageContent_<?php echo $values['local'] . ' content_'  . $values['local'] ?>" title="<?php echo $values['nome'] ?>">
                    <div class="<?php echo $values['classe'] ?> divider_site"></div>
                </div>
                <div class="item_cor_table2">
                    <div class="radioContent_<?php echo $values['local'] ?>"> 
                        <input type="radio" name="opcao" value="<?php echo $values['classe'] ?>" <?php if($item_choose == $values['classe']){echo "checked";} ?> alt="<?php if($values['url_image'] != ""){echo $values['url_image'];} ?>"/>
                        <span><?php echo $values['nome'] ?></span>
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
        <input type="button" class="bt_right" id="bt_update_divider" value="<?php echo Yii::t("adminForm", "button_common_define") ?>" />
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
    </div>
    <p>&nbsp;</p>
    <div class="clear height_support"></div>
</div>
<input type="hidden" value="#000000" id="helper_color"/>
<input type="hidden" value="1px" id="helper_espessura"/>
<input type="hidden" value="" id="helper_image"/>
<script type="text/javascript">initDividersListeners();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>