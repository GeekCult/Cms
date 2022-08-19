<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t('adminForm', 'email_page_title_send')  ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/email/listar" id="bt_list">
        <input type="button" class="bt_right" value="<?php echo Yii::t('adminForm', 'button_common_list') ?>"/>
    </a>
    <a href="/admin/email/templates" id="bt_list">
        <input type="button" class="bt_right" value="<?php echo Yii::t('adminForm', 'button_common_templates') ?>"/>
    </a>
    <fieldset class="adminFormContent">
        <ul>
            <li class="rows">
                <p>&nbsp;</p>
            </li>
            
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_name') ?></div>
                <div class="text">
                    <input id="nome" type="text" class="form" value="<?php if(isset($content['nome'])) echo $content['nome'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_email') ?></div>
                <div class="text">
                    <input id="email" type="text" class="form" value="<?php if(isset($content['email'])) echo $content['email'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_ramo') ?></div>
                <?php include Yii::app()->getBasePath() . "/views/site/pages/conta/users/atributos/ramo_atuacao_new.php"; ?>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_method_contact') ?></div>
                <div class="styled-select">
                    <select name="abordagem" id="abordagem" class="sF3 no-capitalize">
                        <option value="0">Selecione abordagem</option>
                        <option value="1">Inscrição no site</option>
                        <option value="2">Visita pessoal ou representante</option>
                        <option value="3">Eventos/Palestras/Workshops</option>
                        <option value="4">Lista Telefônica/Guias</option>
                        <option value="5">Busca na Internet</option>
                        <option value="6">Revistas/Outdoors/Tv/Rádio</option>
                        <option value="7">Contato telefônico</option>
                    </select>
                </div>
            </li>            
            <li class="rows hide">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'email_label_save_title_email') ?></div>
                <div class="text">
                    <input id="titulo" type="text" class="form" value="<?php if(isset($content['titulo'])) echo $content['titulo'] ?>"/>
                </div>
            </li>
            <li class="rows hide">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_message') ?></div>
                <div class="text">
                    <textarea id="mensagem" rows="10" class="form"><?php if(isset($content['mensagem'])) echo $content['mensagem'] ?></textarea>
                </div>
            </li>
            <li class="rows hide">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_link') ?></div>
                <div class="text">
                    <input id="link" type="text" class="form" value="<?php if(isset($content['link'])) echo $content['link'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_template') ?></div>
                <div class="styled-select">
                    <select name="template" id="template" class="sF3 no-capitalize">
                        <?php foreach($templates as $values){ ?>
                        <option value="<?php echo $values['id'] ?>"><?php echo $values['titulo'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </li>
            <li class="rows hide">
                <div id="fancybox_gallery_launcher" class="iframe"></div>
                <div id="fancybox_images_launcher" class="iframe"></div>
                <div id="fancybox_banner_launcher" class="iframe"></div>
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "common_image") ?></div> 
                <div id="slot_support">
                    <div class="container_slot" id="1">
                        <div class="base_slot_container" id="base_1">
                            <div class="base_bt_select" title="Selecionar novo cool" id="1"></div>
                            <div class="base_bt_remove" title="Limpar slot" id="1"></div>
                        </div>
                        <div class="slot_launcher slot_page" id="slot_page_1">
                            <img  id="slot_pict_id_1" src="" width="" height="" alt=""/>
                        </div>
                        <div class="title_slot" id="title_slot_1"></div>
                        <div class="id_slot" id="id_slot_1"></div>
                        <div class="iframe bt_fotos_slot" id="1"></div>                    
                    </div>
                    <div class="container_info_view">
                        <div class="container_info">
                            <div class="icon_information"></div>
                            <div class="titulo_column_info"><?php echo Yii::t("dicasStrings", "infotip_title_enviar_email_mkt"); ?></div>
                        </div>
                        <div class="texto_column_info">
                            <div class="title_info_view"><h3><?php echo Yii::t("dicasStrings",  "infotip_subtitle_enviar_email_mkt"); ?></h3></div>
                            <div class="topic info_text_line"><?php echo Yii::t("dicasStrings", "infotip_desc1_enviar_email_mkt"); ?></div>
                            <div class="topic info_text_line"><?php echo Yii::t("dicasStrings", "infotip_desc1_enviar_email_mkt"); ?></div>
                            <div class="topic info_text_line"><?php echo Yii::t("dicasStrings", "infotip_desc3_enviar_email_mkt"); ?></div>
                        </div>
                    </div>
                </div>
                <?php if(isset($content['container_1'])) if($content['container_1'] != ""){?>
                <script type="text/javascript">setTimeout(function(){applyPictureSize('<?php if(isset($content['container_1'])) echo $content['container_1']?>', 1, "image")},1000);</script>
                <?php } ?>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Prospecção</div>          
                <input id="insert_prospect" name="insert_prospect" type="checkbox" class="checkbox_email" value="true" checked/>
                <span class="text_after">Abre uma prospecção de cliente</span>
            </li>
            <li class="rows hide">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'email_label_save') ?></div>          
                <input id="template" name="template" type="checkbox" class="checkbox_email" value="true" <?php if(isset($content['tipo']) && $content['tipo'] == "template"){echo "";}else{ echo "checked";} ?> />
                <span class="text_after"><?php echo Yii::t('adminForm', 'email_label_save_after_send') ?></span>
            </li>
            <li class="rows hide">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'email_label_order') ?></div>          
                <input id="chamado" name="chamado" type="checkbox" class="checkbox_email" value="" />
                <span class="text_after"><?php echo Yii::t('adminForm', 'email_label_order_after_send') ?></span>
            </li>
            <li class="rows container_chamado_email hide">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_title') ?></div>
                <div class="text_middle left">
                    <input id="titulo_chamado" type="text" class="form" value=""/>
                </div>
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_email') ?></div>
                <div class="text_half">
                    <div class="styled-select">
                        <select id="prioridade" class="select_task_orders">
                            <option value="nehuma">nenhuma</option>
                            <option value="baixa">baixa</option>
                            <option value="media">media</option>
                            <option value="alta">alta</option>
                        </select>
                    </div>
                </div>
            </li>
            <li class="rows container_chamado_email">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_description') ?></div>
                <div class="text">
                    <textarea id="descricao_chamado" rows="10" class="form"></textarea>
                </div>
            </li>
            <li class="rows hide">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'email_label_newsletter') ?></div>          
                <input id="newsletter" name="newsletter" type="checkbox" class="checkbox_email" value="" checked/>
                <span class="text_after"><?php echo Yii::t('adminForm', 'email_save_newsletter_after_send') ?></span>
            </li>
            <li class="rows hide">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'email_label_newsletter_default') ?></div>          
                <input id="default" name="default" type="checkbox" class="checkbox_email" value="" <?php if(isset($content['padrao']) && $content['padrao'] != ""){echo "checked";}else{ echo "";} ?>/>
                <span class="text_after"><?php echo Yii::t('adminForm', 'email_newsletter_default_explanation') ?></span>
            </li>
            <li class="rows">
                <p>&nbsp;</p>
            </li>
        </ul>
    </fieldset>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <input id="tipo" type="hidden" class="form" value=""/>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_send" value="<?php echo Yii::t('adminForm', 'button_common_send') ?>"/>
    </div>
    <div class="clear height_support"></div>
    <input id="id_page_helper" type="hidden" value="0"/>
    <input id="id_template_helper" type="hidden" value="<?php if(isset($content['id'])) echo $content['id'] ?>"/>
    <input id="helper_type_controller" type="hidden" value="newsletter"/>
    <script type="text/javascript">setTimeout(function(){initSlotEditButton();},1000);</script>
    <script type="text/javascript">setTimeout(function(){<?php if(isset($container_1)){ ?>setEditSlots(<?php echo json_encode($container_1) ?>); <?php } ?>},1000);</script>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>