<script type="text/javascript" src="/js/lib/jscolor/jscolor.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", 'menu_page_title_edit') ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/texturas/<?php //echo $title_texture?>/novo">
        <input type="button" class="bt_right" id="bt_top" value="<?php echo Yii::t("adminForm", 'button_common_new') ?>"/>
    </a>
    <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
    <div id="buttons_support">
       
        <div class="clear"></div>
    </div>
    
    <div class="ctn_menu">
        <label>Exibir menu</label>
        <input type="checkbox" name="menu_exibe" id="menu_exibe" <?php if($content['menu_exibe']) echo 'checked' ?>/>
    </div>
    <div class="ctn_menu">
        <label>Menu 100%</label>
        <input type="checkbox" name="menu_total" id="menu_total" <?php if($content['menu_total'] == 'true') echo 'checked' ?>/>
    </div>
    
    <div class="ctn_menu">
        <label class="left">Alinhar botões</label>
        <div class="styled-select">
        <select id="align_buttons">
            <option value="left" <?php if($content['menu_align'] == 'left') echo 'selected' ?>>Esquerda</option>            
            <option value="right" <?php if($content['menu_align'] == 'right') echo 'selected' ?>>Direita</option>
            <option value="center" <?php if($content['menu_align'] == 'center') echo 'selected' ?>>Centralizado</option>
            <option value="center_right" <?php if($content['menu_align'] == 'center_right') echo 'selected' ?>>Centralizado a Direita</option>
            <option value="center_left" <?php if($content['menu_align'] == 'center_left') echo 'selected' ?>>Centralizado a Esquerda</option>
            <option value="" <?php if($content['menu_align'] == '') echo 'selected' ?>>Manual</option>
        </select>
        </div>
    </div>
    
    <div class="ctn_menu">
        <label>Altura</label>
        <input type="text" name="menu_altura" id="menu_altura" value="<?php echo $content['menu_altura'] ?>" style="width: 40px;"/>
        <span>px</span>
    </div>
    
    <div class="ctn_menu">
        <label>Espaçamento entre botões</label>
        <input type="text" name="menu_space" id="menu_space" value="<?php echo $content['menu_space'] ?>" style="width: 40px;"/>
        <span>px</span>
    </div>
          
    <div class="ctn_menu">
        <label>Sombra do texto</label>
        <input type="checkbox" name="menu_sombra_texto" id="menu_sombra_texto" <?php if($content['menu_sombra_texto'] == 'true') echo 'checked' ?>/>
    </div>
    
    <div class="ctn_menu">
        <label>Cor do divider</label>
        <input type="text" name="menu_cor_divider" id="menu_cor_divider" class="color" value="<?php echo $content['menu_cor_divider'] ?>" style="width: 60px;"/>
    </div>
    
    <div class="ctn_menu">
        <label>Dividers</label>
        <input type="checkbox" name="menu_dividers" id="menu_dividers" <?php if($content['menu_dividers'] == 'true') echo 'checked' ?>/>
    </div>
    
    <div class="ctn_menu">
        <label>Cor do Background</label>
        <input type="text" name="menu_cor_background" id="menu_cor_background" class="color" value="<?php echo $content['menu_background_color'] ?>" style="width: 60px;"/>
        <div class="clear"></div>
        <label>Exibir background color</label>
        <input type="checkbox" name="menu_cor_background_none"  <?php if($content['menu_background_exibe']) echo "checked"; ?> style="width: 20px;"/>
         <div class="clear"></div>
        <label>Textura background 100%</label>
        <input type="checkbox" name="textura_background_full"  <?php if($content['textura_background_full']) echo "checked"; ?> style="width: 20px;"/>
    </div>
    
    <div class="ctn_menu">
        <label>Cor do Ativo</label>
        <input type="text" name="menu_cor_active" id="menu_cor_active" class="color" value="<?php echo $content['menu_background_active'] ?>" style="width: 60px;"/>
        <div class="clear"></div>
        <label>Exibir active color</label>
        <input type="checkbox" name="menu_cor_active_none" <?php if($content['menu_active_exibe']) echo "checked"; ?> style="width: 20px;"/>
    </div>
    
    
    <div class="ctn_menu">
        <label>Margin esquerda</label>
        <input type="text" name="margin_menu_pos_x" id="margin_menu_pos_x" value="<?php echo $content['margin_menu_pos_x'] ?>" style="width: 60px;"/>
    </div>
    
    <div class="ctn_menu">
        <label>Margin baixo</label>
        <input type="text" name="menu_margin_baixo" id="menu_margin_baixo" value="<?php echo $content['menu_margin_baixo'] ?>" style="width: 60px;"/>
        <span>px</span>
    </div>
    
    <div class="ctn_menu">
        <label class="left">Fonte</label>
        <div class="styled-select">
        <select id="menu_fonte">
            <option value="" <?php if($content['menu_fonte'] == '') echo 'selected' ?>>Normal</option>            
            <option value="Arimo-Regular.ttf" <?php if($content['menu_fonte'] == 'Arimo-Regular.ttf') echo 'selected' ?>>Arimo</option>
            <option value="Asap-Bold.ttf" <?php if($content['menu_fonte'] == 'Asap-Bold.ttf') echo 'selected' ?>>Asap Bold</option>
            <option value="Asap-Regular.ttf" <?php if($content['menu_fonte'] == 'Asap-Regular.ttf') echo 'selected' ?>>Asap Regular</option>
            <option value="BEBAS.TTF" <?php if($content['menu_fonte'] == 'BEBAS.TTF') echo 'selected' ?>>Bebas</option>
            <option value="Lucida Grande.ttf" <?php if($content['menu_fonte'] == 'Lucida Grande.ttf') echo 'selected' ?>>Lucida</option>
            <option value="Oleo.ttf" <?php if($content['menu_fonte'] == 'Oleo.ttf') echo 'selected' ?>>Oleo</option>
        </select>
        </div>
    </div>
    
</div>
<div class="clear"></div>
<div class="container_all_info_tips">    
    <div class="container_info_dicas">
        <div class="clear"></div>
        <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    </div>        
</div>
<div class="buttons_right">
    <input type="button" class="bt_right" id="bt_define" value="<?php echo Yii::t("adminForm", 'button_common_define') ?>" />
    <input type="button" class="bt_right" id="bt_top" value="<?php echo Yii::t("adminForm", 'button_common_top') ?>"/>
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

<div class="clear heightSupport"></div>
<input id="helper_action" value="editar" type="hidden" data-js-action="editar"/>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>