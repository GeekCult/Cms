<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Definições de categoria do portfólio</h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/portfolio/categorias_listar">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_list") ?>" />
    </a>
    <a href="/admin/portfolio/categorias_novo">
        <input type="button" class="bt_rigth_small" value="<?php echo Yii::t("adminForm", "button_common_add") ?>" />
    </a>
     <div class="clear"></div>
     <fieldset class="adminFormContent" id="slots_support">
        <div id="fancybox_gallery_launcher" class="iframe"></div>
        <div id="fancybox_images_launcher" class="iframe"></div>
        <div id="fancybox_banner_launcher" class="iframe"></div>
        <div id="fancybox_htmlbanners_launcher" class="iframe helper_tamanho_fake"></div>
        <p>&nbsp;</p>
        <ul class="container_item_page">
            <li class="rows">
                <div class="titleCombo">
                    <div class="label_text_Admin">Nome:</div>
                    <div class="text">
                        <input id="name" type="text" class="form" size="30" value="<?php echo $content['categoria_label'] ?>"/>
                    </div>
                </div>
                <div class="titleIndex">
                    <div class="label_text_Admin">Index:</div>
                    <div class="text">
                        <input id="index" type="text" class="form" size="5" value="<?php echo $content['n_index'] ?>"/>
                    </div>
                </div> 
            </li>
            <li class="rows hide">
                 <div class="label_text_Admin">Exibir:</div>
                <div class="menus_support">
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">menu 1</div>
                        <input type="checkbox" id="menu_principal" <?php if($content['menu_1'] == 1) echo "checked" ?> class="check_select"/>
                    </div>
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">menu 2</div>
                        <input type="checkbox" id="menu_2" <?php if($content['menu_2'] == 1) echo "checked" ?> class="check_select"/>
                    </div>
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">menu 3</div>
                        <input type="checkbox" id="menu_3" <?php if($content['menu_3'] == 1) echo "checked" ?> class="check_select"/>
                    </div> 
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">exibir ecommerce</div>
                        <input type="checkbox" id="exibe" <?php if($content['exibe'] == 1) echo "checked" ?> class="check_select" name="exibe"/>
                    </div> 
                </div>
            </li>
            <li class="rows mgT2">
                <div class="label_text_Admin">Descrição:</div>
                <div class="text">
                    <textarea id="description" type="text" class="form" rows="7"><?php echo $content['descricao'] ?></textarea>
                </div>
            </li>
        </ul>
        <ul id="slot_support">           
            <li class="cols">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "page_paginas_label_3") ?></div>
                <div class="container_slot" id="1">
                    <div class="base_slot_container" id="base_1">
                        <div class="base_bt_edit" title="Editar cool" id="<?php //echo $slots['container_'.$i]; ?>"></div>
                        <div class="base_bt_select" title="Selecionar novo cool" id="<?php //echo $slots['container_'.$i]; ?>"></div>
                        <div class="base_bt_remove" title="Limpar slot" id="1"></div>
                    </div>
                    <div class="slot_launcher slot_page" id="slot_page_1">
                        <img  id="slot_pict_id_1" src="" width="" height="" alt=""/>
                        <div id="slot_banner_id_1"></div>
                        <div class="canvas_stage1" id="stage"></div>
                    </div>
                    <div class="title_slot" id="title_slot_1"></div>
                    <div class="id_slot" id="id_slot_1"></div>
                    <div class="iframe bt_fotos_slot" id="1"></div>                    
                </div>
            </li>
        </ul>
    </fieldset>
    
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_save_settings_ecommerce" value="<?php echo Yii::t("adminForm", "button_common_save") ?>" />
    </div>
    <div class="clear height_support"></div>
    <input type="hidden" id="id_categoria" value="<?php echo $content['id_categoria'] ?>"/>
    <input id="id_page_helper" type="hidden" value="0"/>
    <input id="id_helper" type="hidden" value="<?php //echo $attributes['id_page'] ?>"/>
    <input id="helper_id_controller" type="hidden" value="50"/>
    <input id="helper_type_controller" type="hidden" value="logos"/>
    <input id="helper_id_slot" type="hidden" value="1"/>'
</div>

<script type="text/javascript">initSlotEditButton();initCategoriasSettings();</script>
<script type="text/javascript">setEditSlots('<?php echo json_encode($content['container_1']) ?>');</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>