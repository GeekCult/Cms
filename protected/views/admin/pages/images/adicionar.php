<div class="header_purple_store">
    <div class="logo_pp_header"></div>
</div>
<div class="container_pan">
    <div class="titleContent_add">
        <div class="titleContent_listar"><?php echo  Yii::t("adminForm", "images_page_title_new") ?></div>
        <div class="container_property_fancy">
            <a class="bt_buy_stuff" href="#" title="comprar mais cools"></a>
            <a class="bt_back_stuff" href="/admin/images/<?php echo $type_images ?>/0/9" title="voltar"></a>
        </div>
    </div>
    <div class="divider-fancybox"></div>
    <div class="textLayout"><?php echo Yii::t("adminForm", "images_page_label_info") ?></div>
    <fieldset class="adminFormContentCool">
        <ul>
            <li class="rows">
                <div class="label_text_Admin">Álbum:</div>
                <div class="combo_categorias_fotos">
                    <div class="styled-select">
                        <select class="combo_cat" id="categoria" size="1" >
                            <option value="">Todas</option>
                            <?php foreach ($categorias as $values) { ?>
                            <option value="<?php echo $values['id'] ?>"><?php echo $values['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <img id="image_banner" type="hidden" name=""/>
                <div class="text_add_categoria">
                    <a href="/admin/categorias/adicionar/<?php echo $id_controller ?>"><span class="badge3"><?php echo Yii::t("adminForm", "button_common_add_gallery") ?></span></a>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "images_page_label_1") ?></div>
                <div class="text">
                    <input id="title" type="text" class="form" size="" value="<?php if($content['titulo'] != "vazio") echo $content['titulo'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "images_page_label_2") ?></div>
                <div class="text">
                    <textarea cols="" rows="4" id="description" class="form"><?php echo $content['descricao'] ?></textarea>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "images_page_label_4") ?></div>
                <div class="text">                    
                    <input type="checkbox" name="miniatura" class="select_miniaturas" checked />
                    <div class="label_text_Admin">gera miniaturas da imagem original</div>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "images_page_label_3") ?></div>
                <div class="text">
                    <div class="container_file_input" id="file"></div>
                    <input id="file_helper" type="hidden" class="form" value=""/>
                </div>
            </li>
        </ul>
    </fieldset>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_submit") ?>" />
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_clear") ?>"/>
    </div>
</div>
<input type="hidden" id="helper_id_image" value="" />
<script type="text/javascript">initImages2();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>