<div class="container_pan">
    <div class="titleContent">
        <div class="support-logo"><h1><?php echo  Yii::t("adminForm", "images_page_title_new") ?></h1></div>
        <div class="logo-flickr-disable" title="desativado"></div>
        <div class="bug_tracker iframe"></div>
    </div>
    <div class="clear"></div> 
    <a href="/admin/images/listar">
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo  Yii::t("adminForm", "button_common_list") ?>"/>        
    </a> 
    <div class="textLayout"><?php echo  Yii::t("adminForm", "images_page_label_info") ?></div>
    <fieldset class="adminFormContent">
        <ul>
            <li class="rows">
                <div class="label_text_Admin"><?php echo  Yii::t("adminForm", "title_common_album") ?></div>
                <div class="combo_categorias_fotos">
                    <select class="styled" id="categoria" size="1" >
                        <option value="0"><?php echo  Yii::t("adminForm", "title_common_no_one") ?></option>
                        <?php if($categorias){ foreach ($categorias as $values) { ?>
                        <option value="<?php echo $values['id'] ?>" <?php if((isset($content['id_categoria']) && $content['id_categoria']) == $values['id'])echo "selected"; ?>><?php echo $values['nome'] ?></option>
                        <?php }} ?>
                    </select>
                </div>
                <div class="text_add_categoria">
                    <a href="#" id="fancybox_category_launcher" class="iframe"><span class="badge3"><?php echo  Yii::t("adminForm", "button_common_add_category") ?></span></a>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo  Yii::t("adminForm", "images_page_label_1") ?></div>
                <div class="text">
                    <input id="title" type="text" class="form" size="" value="<?php if(isset($content['titulo']) && $content['titulo'] != "vazio") echo $content['titulo'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo  Yii::t("adminForm", "images_page_label_2") ?></div>
                <div class="text">
                    <textarea cols="" rows="5" id="description" class="form"><?php if(isset($content['descricao'])) echo $content['descricao'] ?></textarea>
                </div>
            </li>
            <?php if($type == "editar"){?>
            <li class="rows">
                <div class="label_text_Admin"><?php echo  Yii::t("adminForm", "images_page_label_2") ?></div>
                <div class="text">
                    <img src="/media/user/images/thumbs_120/<?php if(isset($content['foto'])) echo $content['foto'] ?>"/>
                </div>
            </li>
            <?php } ?>
            <li class="rows">
                <div class="container_message_errors"> 
                    <div class="message_errors">                   
                        <div id="cc-error-screen-content">                           
                            <ul class="content_error">Você deve selecionar um arquivo de foto para cadastrar uma imagem!</ul>
                        </div>                  
                    </div>
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
                <div class="label_text_Admin"><?php echo  Yii::t("adminForm", "images_page_label_3") ?></div>
                <div class="container_uploadify">
                    <div class="container_file_input" id="file"></div>
                    <input id="file_helper" type="hidden" class="form" value="<?php if(isset($content['foto'])) echo $content['foto'] ?>"/>
                </div>
            </li>
        </ul>
    </fieldset>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">        
        <?php if($type == "novo"){ ?>
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo  Yii::t("adminForm", "button_common_submit") ?>" />
        <?php }else{ ?>
        <input type="button" class="bt_right" id="bt_update" value="<?php echo  Yii::t("adminForm", "button_common_update") ?>" />
        <?php } ?>        
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo  Yii::t("adminForm", "button_common_clear") ?>"/>
    </div>
    <div class="clear height_support"></div>
    <input id="helper_id_controller" type="hidden" value="<?php echo $id_controller ?>"/>
    <input id="helper_id_image" type="hidden" value="<?php echo $id_image ?>"/>
    <input id="file" type="hidden" value="novo"/>
</div>
<script type="text/javascript">initImages2();updatePanMain();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>