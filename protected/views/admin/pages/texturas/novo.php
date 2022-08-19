<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", 'textures_page_title_new') . $title_texture ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/texturas/<?php echo $title_texture ?>/listar">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", 'button_common_list') ?>"/>
    </a>
   <form action="">
        <fieldset class="adminFormContent">
            <h4 class="subtitle_admin">Criar e editar as texturas</h4>
            <ul>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", 'textures_page_label_1') ?></div>
                    <div class="text_middle">
                        <input id="title" type="text" class="form" value="<?php if($content['nome'] != "vazio") echo $content['nome'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", 'textures_page_label_3') ?></div>
                    <div class="text_small">
                        <input id="color" type="text" class="form" value="<?php echo $content['bg_color'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", 'textures_page_label_4') ?></div>
                    <div class="styled-select">
                        <select id="id_tipo" size="1">
                            <option <?php if($content['tipo'] == "" || $content['tipo'] == "1"){?> selected <?php }?> value="1">Repete</option>
                            <option <?php if($content['tipo'] == "2"){?> selected <?php }?> value="2">Não repete</option>
                            <option <?php if($content['tipo'] == "3"){?> selected <?php }?> value="3">Repete-X</option>
                            <option <?php if($content['tipo'] == "4"){?> selected <?php }?> value="4">Repete-Y</option>
                            <option <?php if($content['tipo'] == "5"){?> selected <?php }?> value="5">Fixo</option>
                        </select>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", 'textures_page_label_2') ?></div>
                    <div class="text_float_file">
                        <div class="container_file_input" id="file"></div>
                    </div>
                    <div class="text_helper_file">
                        <input id="file_helper" type="text" class="form" value="<?php echo $content['url_textura'] ?>"/>
                    </div>
                </li>
                <li class="rows_error">
                    <div class="container_message_errors"> 
                        <div class="message_errors">                   
                            <div id="cc-error-screen-content">                           
                                <ul class="content_error">Todos os campos devem ser preenchidos!</ul>
                            </div>                  
                        </div>
                    </div>
                </li>
                <input value="<?php  echo $local ?>" id="local" type="hidden"/>
            </ul>
        </fieldset>
        <div class="clear"></div>
        <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
        <div class="buttons_right">
            <?php if($action == "novo"){ ?>
            <input type="button" class="bt_right" id="bt_submit" name="<?php echo $title_texture?>" value="<?php echo Yii::t("adminForm", 'button_common_submit') ?>" alt=""/>
            <?php } else { ?>
            <input type="button" class="bt_right" id="bt_update" name="<?php echo $title_texture?>" value="<?php echo Yii::t("adminForm", "button_common_update"); ?>" alt="<?php echo $content['id'] ?>"/>
            <?php } ?>       
            <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", 'button_common_clear') ?>"/>
        </div>
        <div class="clear height_support"></div>
    </form>
</div>
<div class="menu_shortcut">
    <ul>
        <li><input type="button" class="iSM icon_save"/></li>
        <li>
            <a href="/admin/texturas/<?php echo $title_texture ?>/listar">
                <input type="button" class="iSM icon_list"/>
            </a>
        </li>
        <li>
            <a href="/admin/howto/tags" class="fancy-how-to-tags" title="dicas de HTML">
                <input type="button" class="iSM icon_tag"/>
            </a>
        </li>
    </ul>
</div>
<input type="hidden" id="helper_action" data-type="<?php echo $is_user ?>" data-js-action="criar"/>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>