<script type="text/javascript" src="/js/admin/categorias.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "category_page_title_new") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/produtos/categorias_listar" id="bt_list">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_list") ?>"/>
    </a>
    <fieldset class="adminFormContent">
        <ul>
            <li class="rows">
               <p></p>
               <div id="fancybox_loja_launcher" class="iframe"></div>
            </li>
            <li class="rows">                    
                <div class="label_text_loja"><?php echo Yii::t("adminForm", "store_categories_page_label") ?></div>
                <div class="text">
                    <div class="combo_categorias_fotos styled-select">
                        <select name="categoria" id="categoria" size="1" >
                            <?php if(count($categorias) > 0){ foreach ($categorias as $values) { ?>
                            <option value="<?php echo $values['id_categoria'] ?>" <?php if($values['id_categoria'] == $content['id_page']) echo " selected "; ?>><?php echo $values['categoria_label'] ?></option>
                            <?php }}else{ ?>
                            <option value="">Adicione uma categoria</option>  
                            <?php } ?>
                        </select>
                    </div>
                    <div class="text_add_categoria">
                        <a id="add_category_store"><span class="badge3"><?php echo Yii::t("adminForm", "button_common_add_category") ?></span></a>
                    </div>
                </div>
            </li>
            <li class="rows">
               <p></p>
               <div id="fancybox_subloja_launcher" class="iframe"></div>
            </li>
            <li class="rows">                    
                <div class="label_text_loja"><?php echo Yii::t("adminForm", "store_subcategories_label") ?></div>
                <div class="text">
                    <div class="combo_categorias_fotos styled-select" id="loader_combo_subcategorias">
                        <select name="subcategoria" id="subcategoria" size="1">
                            <?php if(count($subcategorias) > 0){ foreach ($subcategorias as $values) { ?>
                            <option value="<?php echo $values['id_subcategoria'] ?>" <?php if($values['id_subcategoria'] == $content['id_page']) echo " selected "; ?>><?php echo $values['subcategoria_label'] ?></option>
                            <?php }}else{ ?>
                            <option value="">Adicione subcategoria</option>  
                            <?php } ?>
                        </select>
                    </div>
                    <div class="text_add_categoria">
                        <a id="add_subcategory_store"><span class="badge3"><?php echo Yii::t("adminForm", "button_common_add_subcategory") ?></span></a>
                    </div>
                </div>
            </li>
            <li class="rows">
               <p></p>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "store_item_subcategory_label") ?></div>
                <div class="text half">
                    <input id="label_item_subcategoria" type="text" class="form" value="<?php //echo $content['categoria_label'] ?>"/>
                </div>
            </li>
            <li class="rows">
               <p></p>
            </li>
        </ul>
    </fieldset>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">            
        <input type="button" class="bt_right" id="bt_submit_categoria_store" value="<?php if($action == "novo"){echo Yii::t("adminForm", "button_common_submit");}else{echo Yii::t("adminForm", "button_common_update");} ?>"/>
    </div>
    <div class="clear"></div>
    <p>&nbsp;</p>
</div>
<input type="hidden" value="<?php echo $action ?>" id="helper_action"/>
<input type="hidden" value="<?php echo $id_album ?>" id="helper_id_categoria"/>
<input type="hidden" value="<?php echo $id_subcategoria ?>" id="helper_id_subcategoria"/>
<input type="hidden" value="1" id="helper_admin_versao"/>

<script type="text/javascript">initLojaCategoriasListeners();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>