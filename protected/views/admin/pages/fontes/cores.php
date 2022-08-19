<script type="text/javascript" src="/js/admin/fontes.js"></script>
<script type="text/javascript" src="/js/lib/jscolor/jscolor.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "fonts_page_edit_colors") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <fieldset class="adminFormContent">
        <div class="container_texture_empty">
                <div class="title_empty_texture">
                    <input type="button" id="bt_device_desktop" class="icon_desktop_square" title="Escolher Desktop" alt="desktop"/>
                    <input type="button" id="bt_device_tablet" class="icon_tablet_square" title="Escolher Tablet" alt="tablet"/>
                    <input type="button" id="bt_device_mobile" class="icon_mobile_square" title="Escolher Mobile" alt="mobile"/>
                </div>
                <div class="container_combo_empty_radio">
                    
                </div>            
            </div>
        <ul id="buttons_color_fonts">
            <li class="rows ">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_1") ?></div>
                <div class="float">
                    <input name="font_title_example" type="text" id="font_title_color" class="form color" value="<?php if($content['titulo_cor'] != "vazio") echo $content['titulo_cor'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_title_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_2") ?></div>
                <div class="float">
                    <input name="font_text_example" type="text" id="font_text_color" class="form color" value="<?php if($content['texto_cor'] != "vazio") echo $content['texto_cor'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_text_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_7") ?></div>
                <div class="float">
                    <input name="font_subtitulo_example" type="text" id="font_subtitulo_color" class="form color" value="<?php if($content['subtitulo_cor'] != "vazio") echo $content['subtitulo_cor'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_subtitulo_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
             <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_3") ?></div>
                <div class="float">
                    <input name="font_link_example" type="text" id="font_link_color" class="form color" value="<?php if($content['link_cor'] != "vazio") echo $content['link_cor'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_link_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_4") ?></div>
                <div class="float">
                    <input name="font_link_over_example" type="text" id="font_link_over_color" class="form color" value="<?php if($content['link_cor_hover'] != "vazio") echo $content['link_cor_hover'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_link_over_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
            <li class="rows ">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_5") ?></div>
                <div class="float">
                    <input name="font_menu_example" type="text" id="font_menu_color" class="form color" value="<?php if($content['menu_cor'] != "vazio") echo $content['menu_cor'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_menu_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_6") ?></div>
                <div class="float">
                    <input name="font_menu_over_example" type="text" id="font_menu_over_color" class="form color" value="<?php if($content['menu_cor_hover'] != "vazio") echo $content['menu_cor_hover'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_menu_over_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_8") ?></div>
                <div class="float">
                    <input name="font_button_example" type="text" id="font_button_color" class="form color" value="<?php if($content['botao_cor'] != "vazio") echo $content['botao_cor'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_button_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_9") ?></div>
                <div class="float">
                    <input name="font_button_over_example" type="text" id="font_button_over_color" class="form color" value="<?php if($content['botao_cor_hover'] != "vazio") echo $content['botao_cor_hover'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_button_over_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_10") ?></div>
                <div class="float">
                    <input name="font_input_text_example" type="text" id="font_input_text_color" class="form color" value="<?php if($content['input_text_cor'] != "vazio") echo $content['input_text_cor'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_input_text_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Cor chamada</div>
                <div class="float">
                    <input name="font_input_chamada_example" type="text" id="font_input_chamada_color" class="form color" value="<?php if($fonts['chamada_cor'] != "vazio") echo $fonts['chamada_cor'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_input_text_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
            <li><p>&nbsp</p></li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_11") ?></div>
                <div class="float">
                    <input name="font_title_popup_example" type="text" id="font_input_title_popup_color" class="form color" value="<?php if($fonts['title_popup'] != "vazio") echo $fonts['title_popup'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_title_popup_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_12") ?></div>
                <div class="float">
                    <input name="font_text_popup_example" type="text" id="font_input_text_popup_color" class="form color" value="<?php if($fonts['text_popup'] != "vazio") echo $fonts['text_popup'] ?>"/>
                </div>
                <span class="floatRight font_default" id="font_text_popup_example"><?php echo Yii::t("adminForm", "common_test") ?></span>
            </li>
        </ul>
    </fieldset>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_update" value="<?php echo Yii::t("adminForm", "button_common_update") ?>" />
    </div>   
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
<script type="text/javascript">initSetColorFont();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>
