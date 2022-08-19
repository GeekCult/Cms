<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "brand_page_title_new") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <div class="clear"></div>
    <fieldset class="adminFormStore" id="slots_support">
        <div id="fancybox_gallery_launcher" class="iframe"></div>
        <div id="fancybox_images_launcher" class="iframe"></div>
        <div id="fancybox_banner_launcher" class="iframe"></div>
        <div id="fancybox_htmlbanners_launcher" class="iframe helper_tamanho_fake"></div>
        <h2><?php echo Yii::t("adminForm", "common_slot_graphic") ?></h2>        
        <ul id="slot_support">
            <input type="hidden" id="helper_miniSiteUser" value="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteUser'] ?>" data-url="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteUrl'] . "/media/user/images/thumbs_120/" ?>" data-remote="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteRemote'] ?>"/>
            <li class="rows">              
                <div class="label_text_Admin_logos"><?php echo Yii::t("adminForm", "common_brand_main") ?></div>             
                <div class="container_slot" id="7">
                    <div class="base_slot_container" id="base_7">
                        <div class="base_bt_select" title="Selecionar novo cool" id="7"></div>
                        <div class="base_bt_remove" title="Limpar slot" id="7"></div>
                    </div>
                    <div class="slot_launcher slot_page" id="slot_page_7">
                        <img id="slot_pict_id_7" src="" width="" height="" alt=""/>
                    </div>
                    <div class="title_slot" id="title_slot_7"></div>
                    <div class="id_slot" id="id_slot_7"></div>
                    <div class="iframe bt_fotos_slot" id="7"></div>                    
                </div>
                <div class="container_info_view">
                    <div class="container_info">
                        <div class="icon_information"></div>
                        <div class="titulo_column_info">Infos</div>
                    </div>
                    <div class="texto_column_info">
                        <div class="title_info_view"><h3>Logo principal do site</h3></div>
                        <div class="topic info_text_line">Logo que será exibido em todos os topos</div>
                        <div class="topic info_text_line">Largura máxima 250px, altura máxima 80px </div>
                    </div>
                </div>
                <div class="clear"></div>
            </li>
            <li class="rows">              
                <div class="label_text_Admin_logos"><?php echo Yii::t("adminForm", "common_brand_social_networks") ?></div>             
                <div class="container_slot" id="1">
                    <div class="base_slot_container" id="base_1">
                        <div class="base_bt_select" title="Selecionar novo cool" id="1"></div>
                        <div class="base_bt_remove" title="Limpar slot" id="1"></div>
                    </div>
                    <div class="slot_launcher slot_page" id="slot_page_1">
                        <img id="slot_pict_id_1" src="" width="" height="" alt=""/>
                    </div>
                    <div class="title_slot" id="title_slot_1"></div>
                    <div class="id_slot" id="id_slot_1"></div>
                    <div class="iframe bt_fotos_slot" id="1"></div>                    
                </div>
                <div class="container_info_view">
                    <div class="container_info">
                        <div class="icon_information"></div>
                        <div class="titulo_column_info">Infos</div>
                    </div>
                    <div class="texto_column_info">
                        <div class="title_info_view"><h3>E-mail marketing</h3></div>
                        <div class="topic info_text_line">Escolha uma imagem para ser inserida no e-mail marketing.</div>
                        <div class="topic info_text_line">Largura máxima 560px, altura ilimitada </div>
                    </div>
                </div>
                <div class="clear"></div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"></div>
                <p>&nbsp;</p>
            </li>
            <li class="rows">              
                <div class="label_text_Admin_logos"><?php echo Yii::t("adminForm", "common_brand_email") ?></div>             
                <div class="container_slot" id="2">
                    <div class="base_slot_container" id="base_2">
                        <div class="base_bt_select" title="Selecionar novo cool" id="2"></div>
                        <div class="base_bt_remove" title="Limpar slot" id="2"></div>
                    </div>
                    <div class="slot_launcher slot_page" id="slot_page_2">
                        <img  id="slot_pict_id_2" src="" width="" height="" alt=""/>
                    </div>
                    <div class="title_slot" id="title_slot_2"></div>
                    <div class="id_slot" id="id_slot_2"></div>
                    <div class="iframe bt_fotos_slot" id="2"></div>                    
                </div>
                <div class="container_info_view">
                    <div class="container_info">
                        <div class="icon_information"></div>
                        <div class="titulo_column_info"><?php echo Yii::t("admin/logoStrings", "label_info"); ?></div>
                    </div>
                    <div class="texto_column_info">
                        <div class="title_info_view"><h3><?php echo Yii::t("admin/logoStrings", "logo_email_title"); ?></h3></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "logo_email_text_1"); ?></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "logo_email_text_2"); ?></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "logo_email_text_3"); ?></div>
                    </div>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"></div>
                <p>&nbsp;</p>
            </li>
            
            <li class="rows">              
                <div class="label_text_Admin_logos"><?php echo Yii::t("adminForm", "common_brand_print") ?></div>             
                <div class="container_slot" id="8">
                    <div class="base_slot_container" id="base_8">
                        <div class="base_bt_select" title="Selecionar novo cool" id="8"></div>
                        <div class="base_bt_remove" title="Limpar slot" id="8"></div>
                    </div>
                    <div class="slot_launcher slot_page" id="slot_page_8">
                        <img id="slot_pict_id_8" src="" width="" height="" alt=""/>
                    </div>
                    <div class="title_slot" id="title_slot_8"></div>
                    <div class="id_slot" id="id_slot_8"></div>
                    <div class="iframe bt_fotos_slot" id="8"></div>                    
                </div>
                <div class="container_info_view">
                    <div class="container_info">
                        <div class="icon_information"></div>
                        <div class="titulo_column_info">Infos</div>
                    </div>
                    <div class="texto_column_info">
                        <div class="title_info_view"><h3>Logo para impressão</h3></div>
                        <div class="topic info_text_line">Logo exibido quando há impressões de páginas ou conteúdo</div>
                        <div class="topic info_text_line">Quanto menos cores melhor para esse logo</div>
                        <div class="topic info_text_line">Tamanho ideal 240 x 80</div>
                    </div>
                </div>
                <div class="clear"></div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"></div>
                <p>&nbsp;</p>
            </li>
            
            <li class="rows">              
                <div class="label_text_Admin_logos"><?php echo Yii::t("admin/logoStrings", "title_mobile_app") ?></div>             
                <div class="container_slot" id="6">
                    <div class="base_slot_container" id="base_6">
                        <div class="base_bt_select" title="Selecionar novo cool" id="6"></div>
                        <div class="base_bt_remove" title="Limpar slot" id="6"></div>
                    </div>
                    <div class="slot_launcher slot_page" id="slot_page_6">
                        <img  id="slot_pict_id_6" src="" width="" height="" alt=""/>
                    </div>
                    <div class="title_slot" id="title_slot_6"></div>
                    <div class="id_slot" id="id_slot_6"></div>
                    <div class="iframe bt_fotos_slot" id="6"></div>                    
                </div>
                <div class="container_info_view">
                    <div class="container_info">
                        <div class="icon_information"></div>
                        <div class="titulo_column_info"><?php echo Yii::t("admin/logoStrings", "label_info"); ?></div>
                    </div>
                    <div class="texto_column_info">
                        <div class="title_info_view"><h3><?php echo Yii::t("admin/logoStrings", "logo_mobile_title"); ?></h3></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "logo_mobile_text_1"); ?></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "logo_mobile_text_2"); ?></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "logo_mobile_text_3"); ?></div>
                    </div>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"></div>
                <p>&nbsp;</p>
            </li>
            <li class="rows">              
                <div class="label_text_Admin_logos"><?php echo Yii::t("adminForm", "logos_tablet_logo") ?></div>             
                <div class="container_slot" id="3">
                    <div class="base_slot_container" id="base_3">
                        <div class="base_bt_select" title="Selecionar novo cool" id="3"></div>
                        <div class="base_bt_remove" title="Limpar slot" id="3"></div>
                    </div>
                    <div class="slot_launcher slot_page" id="slot_page_3">
                        <img  id="slot_pict_id_3" src="" width="" height="" alt=""/>
                    </div>
                    <div class="title_slot" id="title_slot_3"></div>
                    <div class="id_slot" id="id_slot_3"></div>
                    <div class="iframe bt_fotos_slot" id="3"></div>                    
                </div>
                <div class="container_info_view">
                    <div class="container_info">
                        <div class="icon_information"></div>
                        <div class="titulo_column_info"><?php echo Yii::t("admin/logoStrings", "label_info"); ?></div>
                    </div>
                    <div class="texto_column_info">
                        <div class="title_info_view"><h3><?php echo Yii::t("admin/logoStrings", "logo_tablet_main_title"); ?></h3></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "logo_tablet_main_text_1"); ?></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "logo_tablet_main_text_2"); ?></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "logo_tablet_main_text_3"); ?></div>
                    </div>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"></div>
                <p>&nbsp;</p>
            </li>
            <li class="rows">              
                <div class="label_text_Admin_logos"><?php echo Yii::t("admin/logoStrings", "logo_tablet") ?></div>             
                <div class="container_slot" id="4">
                    <div class="base_slot_container" id="base_4">
                        <div class="base_bt_select" title="Selecionar novo cool" id="4"></div>
                        <div class="base_bt_remove" title="Limpar slot" id="4"></div>
                    </div>
                    <div class="slot_launcher slot_page" id="slot_page_4">
                        <img  id="slot_pict_id_4" src="" width="" height="" alt=""/>
                    </div>
                    <div class="title_slot" id="title_slot_4"></div>
                    <div class="id_slot" id="id_slot_4"></div>
                    <div class="iframe bt_fotos_slot" id="4"></div>                    
                </div>
                <div class="container_info_view">
                    <div class="container_info">
                        <div class="icon_information"></div>
                        <div class="titulo_column_info"><?php echo Yii::t("admin/logoStrings", "label_info"); ?></div>
                    </div>
                    <div class="texto_column_info">
                        <div class="title_info_view"><h3><?php echo Yii::t("admin/logoStrings", "logo_tablet_title"); ?></h3></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "logo_tablet_text_1"); ?></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "logo_tablet_text_2"); ?></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "logo_tablet_text_3"); ?></div>
                    </div>
                </div>
                <div class="clear"></div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"></div>
                <p>&nbsp;</p>
            </li>
            <li class="rows">              
                <div class="label_text_Admin_logos"><?php echo Yii::t("adminForm", "logos_tablet_icon_app") ?></div>             
                <div class="container_slot" id="5">
                    <div class="base_slot_container" id="base_5">
                        <div class="base_bt_select" title="Selecionar novo cool" id="5"></div>
                        <div class="base_bt_remove" title="Limpar slot" id="5"></div>
                    </div>
                    <div class="slot_launcher slot_page" id="slot_page_5">
                        <img  id="slot_pict_id_5" src="" width="" height="" alt=""/>
                    </div>
                    <div class="title_slot" id="title_slot_5"></div>
                    <div class="id_slot" id="id_slot_5"></div>
                    <div class="iframe bt_fotos_slot" id="5"></div>                    
                </div>
                <div class="container_info_view">
                    <div class="container_info">
                        <div class="icon_information"></div>
                        <div class="titulo_column_info"><?php echo Yii::t("admin/logoStrings", "label_info"); ?></div>
                    </div>
                    <div class="texto_column_info">
                        <div class="title_info_view"><h3><?php echo Yii::t("admin/logoStrings", "icon_app_title"); ?></h3></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "icon_app_text_1"); ?></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "icon_app_text_2"); ?></div>
                        <div class="topic info_text_line"><?php echo Yii::t("admin/logoStrings", "icon_app_text_3"); ?></div>
                    </div>
                </div>
                <div class="clear"></div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"></div>
                <p>&nbsp;</p>
            </li>
        </ul>
        <ul>            
            <li class="rows">
                <p>&nbsp;</p>
                <h2><?php echo Yii::t("adminForm", "common_submit_picture") ?></h2>
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "common_picture") ?></div>
                <div class="text">
                    <input type="button" class="bt_cadastrar_fotos_fancy iframe" id="bt_upload" value="" name="cool"/>
                </div>
            </li>
        </ul>
    </fieldset>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">        
        <input type="button" class="bt_right" id="bt_update" value="<?php echo Yii::t("adminForm", "button_common_update"); ?>" />     
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_clear"); ?>"/>        
    </div>
    <div class="clear height_support"></div>
    <input id="id_page_helper" type="hidden" value="0"/>
    <input id="id_helper" type="hidden" value="<?php //echo $attributes['id_page'] ?>"/>
    <input id="helper_id_controller" type="hidden" value="50"/>
    <input id="helper_type_controller" type="hidden" value="logos"/>
    
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

<script type="text/javascript">initSlotEditButton();</script>
<script type="text/javascript">setEditSlots(<?php echo json_encode($logos) ?>);</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>