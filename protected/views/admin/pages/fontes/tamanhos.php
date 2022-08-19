<script type="text/javascript" src="/js/admin/fontes.js"></script>
<script type="text/javascript" src="/js/lib/jscolor/jscolor.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "fonts_page_edit_size") ?></h1>
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
            <li class="rows mgB">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_1") ?></div>
                <div style="margin-right: 30px; width: 30px; float: left;">
                    <input name="font_title_size" type="text" id="font_title_size" class="form" value="<?php echo $fonts['title_size'] ?>"/>
                </div>
                <div style="margin-right: 30px; width: 30px; float: left;">
                    <input name="font_text_line" type="text" id="font_text_line" class="form" value="<?php echo $fonts['text_line_height'] ?>"/>
                </div>
                <div class="styled-select2 float mgR2">
                    <select name="font_title_alignment" id="font_tiel_alignment">
                        <option value="left" <?php if($fonts['text_alignment'] == 'left') echo 'selected' ?>>Esquerda</option>
                        <option value="right" <?php if($fonts['text_alignment'] == 'right') echo 'selected' ?>>Direita</option>
                        <option value="justify" <?php if($fonts['text_alignment'] == 'justify') echo 'selected' ?>>Justificado</option>
                        <option value="center" <?php if($fonts['text_alignment'] == 'center') echo 'selected' ?>>Centralizado</option>
                    </select>
                </div>
                <div class="styled-select float">
                    <select name="font_title_font" id="font_title_font">
                        <option value="left" <?php if($fonts['text_alignment'] == 'left') echo 'selected' ?>>Esquerda</option>
                        <option value="right" <?php if($fonts['text_alignment'] == 'right') echo 'selected' ?>>Direita</option>
                        <option value="justify" <?php if($fonts['text_alignment'] == 'justify') echo 'selected' ?>>Justificado</option>
                        <option value="center" <?php if($fonts['text_alignment'] == 'center') echo 'selected' ?>>Centralizado</option>
                    </select>
                </div>
            </li>
            <li class="rows mgB">
                <div class="label_text_Admin">Subtítulo</div>
                <div style="margin-right: 30px; width: 30px; float: left;">
                    <input name="subtitle_size" type="text" id="subtitle_size" class="form" value="<?php echo $fonts['subtitle_size'] ?>"/>
                </div>
                <div style="margin-right: 30px; width: 30px; float: left;">
                    <input name="subtitle_line" type="text" id="subtitle_line" class="form" value="<?php echo $fonts['subtitle_line'] ?>"/>
                </div>
                <div class="styled-select2 float mgR2">
                    <select name="subtitle_alinhamento" id="subtitle_alinhamento">
                        <option value="left" <?php if($fonts['subtitle_alinhamento'] == 'left') echo 'selected' ?>>Esquerda</option>
                        <option value="right" <?php if($fonts['subtitle_alinhamento'] == 'right') echo 'selected' ?>>Direita</option>
                        <option value="justify" <?php if($fonts['subtitle_alinhamento'] == 'justify') echo 'selected' ?>>Justificado</option>
                        <option value="center" <?php if($fonts['subtitle_alinhamento'] == 'center') echo 'selected' ?>>Centralizado</option>
                    </select>
                </div>
                <div class="styled-select float">
                    <select name="subtitle_fonte" id="subtitle_fonte">
                        <option value="" <?php if($fonts['subtitle_fonte'] == '') echo 'selected' ?>>Normal</option>            
                        <option value="Arimo-Regular.ttf" <?php if($fonts['subtitle_fonte'] == 'Arimo-Regular.ttf') echo 'selected' ?>>Arimo</option>
                        <option value="Asap-Bold.ttf" <?php if($fonts['subtitle_fonte'] == 'Asap-Bold.ttf') echo 'selected' ?>>Asap Bold</option>
                        <option value="Asap-Regular.ttf" <?php if($fonts['subtitle_fonte'] == 'Asap-Regular.ttf') echo 'selected' ?>>Asap Regular</option>
                        <option value="BEBAS.TTF" <?php if($fonts['subtitle_fonte'] == 'BEBAS.TTF') echo 'selected' ?>>Bebas</option>
                        <option value="Lucida Grande.ttf" <?php if($fonts['subtitle_fonte'] == 'Lucida Grande.ttf') echo 'selected' ?>>Lucida</option>
                        <option value="Oleo.ttf" <?php if($fonts['subtitle_fonte'] == 'Oleo.ttf') echo 'selected' ?>>Oleo</option>
                    </select>
                </div>
            </li>
            <li class="rows mgB">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "fonts_page_label_2") ?></div>
                <div style="margin-right: 30px; width: 30px; float: left;">
                    <input name="font_text_size" type="text" id="font_text_size" class="form" value="<?php echo $fonts['text_size'] ?>"/>
                </div>
                <div style="margin-right: 30px; width: 30px; float: left;">
                    <input name="font_text_line" type="text" id="font_text_line" class="form" value="<?php echo $fonts['text_line_height'] ?>"/>
                </div>
                <div class="styled-select2 float mgR2">
                    <select name="font_text_alignment" id="font_text_alignment">
                        <option value="left" <?php if($fonts['text_alignment'] == 'left') echo 'selected' ?>>Esquerda</option>
                        <option value="right" <?php if($fonts['text_alignment'] == 'right') echo 'selected' ?>>Direita</option>
                        <option value="justify" <?php if($fonts['text_alignment'] == 'justify') echo 'selected' ?>>Justificado</option>
                        <option value="center" <?php if($fonts['text_alignment'] == 'center') echo 'selected' ?>>Centralizado</option>
                    </select>
                </div>
                <div class="styled-select float">
                    <select name="font_text_font" id="font_text_font">
                        <option value="left" <?php if($fonts['text_alignment'] == 'left') echo 'selected' ?>>Esquerda</option>
                        <option value="right" <?php if($fonts['text_alignment'] == 'right') echo 'selected' ?>>Direita</option>
                        <option value="justify" <?php if($fonts['text_alignment'] == 'justify') echo 'selected' ?>>Justificado</option>
                        <option value="center" <?php if($fonts['text_alignment'] == 'center') echo 'selected' ?>>Centralizado</option>
                    </select>
                </div>
            </li>
            <li class="rows mgB">
                <div class="label_text_Admin">Chamada</div>
                <div style="margin-right: 30px; width: 30px; float: left;">
                    <input name="chamada_size" type="text" id="chamada_size" class="form" value="<?php echo $fonts['chamada_size'] ?>"/>
                </div>
                <div style="margin-right: 30px; width: 30px; float: left;">
                    <input name="chamada_line" type="text" id="chamada_line" class="form" value="<?php echo $fonts['chamada_line'] ?>"/>
                </div>
                <div class="styled-select2 float mgR2">
                    <select name="chamada_alinhamento" id="chamada_alinhamento">
                        <option value="left" <?php if($fonts['chamada_alinhamento'] == 'left') echo 'selected' ?>>Esquerda</option>
                        <option value="right" <?php if($fonts['chamada_alinhamento'] == 'right') echo 'selected' ?>>Direita</option>
                        <option value="justify" <?php if($fonts['chamada_alinhamento'] == 'justify') echo 'selected' ?>>Justificado</option>
                        <option value="center" <?php if($fonts['chamada_alinhamento'] == 'center') echo 'selected' ?>>Centralizado</option>
                    </select>
                </div>
                <div class="styled-select float">
                    <select name="chamada_fonte" id="chamada_fonte">
                        <option value="" <?php if($fonts['chamada_fonte'] == '') echo 'selected' ?>>Normal</option>            
                        <option value="Arimo-Regular.ttf" <?php if($fonts['chamada_fonte'] == 'Arimo-Regular.ttf') echo 'selected' ?>>Arimo</option>
                        <option value="Asap-Bold.ttf" <?php if($fonts['chamada_fonte'] == 'Asap-Bold.ttf') echo 'selected' ?>>Asap Bold</option>
                        <option value="Asap-Regular.ttf" <?php if($fonts['chamada_fonte'] == 'Asap-Regular.ttf') echo 'selected' ?>>Asap Regular</option>
                        <option value="BEBAS.TTF" <?php if($fonts['chamada_fonte'] == 'BEBAS.TTF') echo 'selected' ?>>Bebas</option>
                        <option value="Lucida Grande.ttf" <?php if($fonts['chamada_fonte'] == 'Lucida Grande.ttf') echo 'selected' ?>>Lucida</option>
                        <option value="Oleo.ttf" <?php if($fonts['chamada_fonte'] == 'Oleo.ttf') echo 'selected' ?>>Oleo</option>
                    </select>
                </div>
            </li>
            
        </ul>
    </fieldset>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_update_size" value="<?php echo Yii::t("adminForm", "button_common_update") ?>" />
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
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>
