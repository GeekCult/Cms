<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Editar Breadcrumb</h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>

    <div id="buttons_support" class="layoutAdmin">
        <div class="container_texture_empty">
            <div class="title_empty_texture">
                <input type="button" id="bt_device_desktop" class="icon_desktop_square" title="Escolher Desktop" alt="desktop"/>
                <input type="button" id="bt_device_tablet" class="icon_tablet_square" title="Escolher Tablet" alt="tablet"/>
                <input type="button" id="bt_device_mobile" class="icon_mobile_square" title="Escolher Mobile" alt="mobile"/>
            </div>                        
        </div>
        <h2><?php echo Yii::t("adminForm", "common_details") ?></h2>        
        <ul id="slot_support">            
            <li class="rows">
                <div class="label_text_Admin_logos mgR">Margem superior</div>             
                <div class="container_slot_checkbox mgB">
                    <div class="ctn_checkbox">
                        <input type="input" id="margin_top" class="mini left" value="<?php echo $content['breadcrumb_top'] ?>" class="mgR"/>
                        <span class="mgL text fS">Deixe vazio se desejar utilizar padrão</span>
                    </div>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin_logos mgR">Margem inferior</div>             
                <div class="container_slot_checkbox mgB">
                    <div class="ctn_checkbox">
                        <input type="input" id="margin_bottom" class="mini left" value="<?php echo $content['breadcrumb_bottom'] ?>" class="mgR"/>
                        <span class="mgL text fS">Deixe vazio se desejar utilizar padrão</span>
                    </div>
                </div>
            </li>
            <li class="rows">                
                <div class="label_text_Admin_logos mgR">Lado do breadcrumb</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <div class="styled-select">
                            <select name="breadcrumb_lado" id="breadcrumb_lado">
                                <option value="left" <?php if($content['breadcrumb_lado'] == 'left') echo 'selected' ?>>Esquerda</option>
                                <option value="right" <?php if($content['breadcrumb_lado'] == 'right') echo 'selected' ?>>Direita</option>
                            </select>
                        </div>                       
                        
                    </div>
                </div>
                <p>&nbsp;</p>
            </li>
            <div class="divider_horizontal mgB mgT2"></div>
            <li class="rows mgT2">
              <div style="width: 10px;">
                    <div id="fancybox_images_launcher" class="iframe helper_tamanho_fake"></div>
                    <div id="fancybox_textures_launcher" class="iframe"></div>
                    <div id="fancybox_icones_launcher" class="iframe"></div>
                    <div id="fancybox_efeitos_launcher" class="iframe"></div>
                </div>
                <div id="support_background_banners">       
                    <div class="column_settings_banners_left">
                        <div class="label_text_Admin">
                            <p class="bt_render_bg <?php if($content['breadcrumb_background_type'] == 1) echo 'active_p'; ?>" data-type="ctnSlotRenderTexture" data-type-id="1">Textura</p>
                            <div class="clear mgB"></div>
                            <p class="bt_render_bg <?php if($content['breadcrumb_background_type'] == 0) echo 'active_p'; ?>" data-type="ctnSlotRenderImage" data-type-id="0">Imagem</p>
                            <div class="clear mgB"></div>
                            <p class="bt_render_bg <?php if($content['breadcrumb_background_type'] == 2) echo 'active_p'; ?>" data-type="ctnSlotRenderColor" data-type-id="2">Cor</p>
                        </div>

                        <div id="ctnSlotRenderImage" class="ctnSlotRenderTyp left" style="<?php if($content['breadcrumb_background_type'] == 1 || $content['breadcrumb_background_type'] == 2) echo 'display:none'; ?>">
                            <div class="container_slot" id="1">
                                <div class="base_slot_container" id="base_1">
                                    <div class="base_bt_select" title="Selecionar novo cool" id="1"></div>
                                    <div class="base_bt_remove" title="Limpar slot" id="1"></div>
                                </div>
                                <div class="slot_launcher slot_page" id="slot_page_1">
                                    <img id="slot_pict_id_1" src="" width="" height="" alt=""/>
                                    <input type="hidden" id="submit_pict_id_1" name="image_background" value="<?php if($content['breadcrumb_background_type'] == 0) echo $content['breadcrumb_background'] ?>"/>
                                    <script type="text/javascript"><?php if($content['breadcrumb_background_type'] == 0 && $content['breadcrumb_background'] != ''){ ?>applyPictureSize('<?php echo $content['barra_social_background'] ?>', 1, 'image', true);<?php } ?></script>
                                </div>
                                <div class="title_slot" id="title_slot_1"></div>
                                <div class="id_slot" id="id_slot_1"><?php if($content['breadcrumb_background_type'] == 0) echo $content['breadcrumb_background'] ?></div>
                                <div class="bt_fotos_slot bt_fotos iframe" id="1" data-type="image"></div>                    
                            </div>
                        </div>

                        <div id="ctnSlotRenderTexture" style="<?php if($content['breadcrumb_background_type'] == 0 || $content['breadcrumb_background_type'] == 2) echo 'display:none'; ?>" class="ctnSlotRenderTyp left">
                            <div class="container_slot" id="2">
                                <div class="base_slot_container" id="base_2">
                                    <div class="base_bt_select" title="Selecionar novo cool" id="2"></div>
                                    <div class="base_bt_remove" title="Limpar slot" id="2"></div>
                                </div>
                                <div class="slot_launcher slot_page pdL0" id="slot_page_2">
                                    <div id="slot_texture_id_2" class="ctnTextureDetail" style="padding-left: 20px; background: url(/media/images/textures/site/<?php if($content['breadcrumb_background_type'] == 1) echo $content['breadcrumb_background'] ?>)"></div>
                                    <input type="hidden" id="submit_texture_id_2" name="texture_background" value="<?php if($content['breadcrumb_background_type'] == 1) echo $content['breadcrumb_background'] ?>"/>
                                </div>
                                <div class="title_slot" id="title_slot_2"></div>
                                <div class="id_slot" id="id_slot_2"><?php if($content['breadcrumb_background_type'] == 1) echo $content['breadcrumb_background'] ?></div>
                                <div class="bt_textures_slot iframe" id="2" data-type="site"></div>                    
                            </div>
                        </div>

                        <div id="ctnSlotRenderColor" style="<?php if($content['breadcrumb_background_type'] == 1 || $content['breadcrumb_background_type'] == 0) echo 'display:none'; ?>" class="ctnSlotRenderTyp left">
                            <div class="container_slot" id="3">
                                <div class="base_slot_container" id="base_3">
                                    <div class="base_bt_select" title="Selecionar novo cool" id="3"></div>
                                    <div class="base_bt_remove" title="Limpar slot" id="3"></div>
                                </div>
                                <div class="slot_launcher slot_page pdL0" id="slot_page_3">
                                    <div id="slot_texture_id_3" class="ctnTextureDetail" style="padding-left: 20px; background: url(/media/images/textures/efeitos/<?php if($content['breadcrumb_background_type'] == 2) echo $content['breadcrumb_background'] ?>)"></div>
                                    <input type="hidden" id="submit_texture_id_3" name="color_background" value="<?php if($content['breadcrumb_background_type'] == 2) echo $content['breadcrumb_background'] ?>"/>
                                </div>
                                <div class="title_slot" id="title_slot_3"></div>
                                <div class="id_slot" id="id_slot_3"><?php if($content['breadcrumb_background_type'] == 2) echo $content['breadcrumb_background'] ?></div>
                                <div class="bt_efeitos_slot iframe" id="3" data-type="efeitos"></div>                    
                            </div>
                            <div class="clear"></div>
                            <div class="ctnColor">
                                <span>Cor</span>
                                <input name="cor_texture" type="text" id="cor_texture" class="color" value="<?php if($content['breadcrumb_background_color'] != "") echo $content['breadcrumb_background_color'] ?>" <?php if($content['breadcrumb_background_color'] != "") echo "style='background-color:". $content['breadcrumb_background_color'] . "'"?>/>
                            </div>
                        </div>

                        <div class="container_info_view" style="margin-left: 120px;">
                            <div class="container_info">
                                <div class="icon_information"></div>
                                <div class="titulo_column_info">Infos</div>
                            </div>
                            <div class="texto_column_info">
                                <div class="title_info_view"><h3>Fundo do Breadcrumb</h3></div>
                                <div class="topic info_text_line">Essa imagem preenche todo breadcrumb e dependendo do layout do site é 100%</div>
                                <div class="topic info_text_line">Você também pode escolher entre uma textura ou uma imagem</div>
                                <div class="topic info_text_line">Para utiliziar uma imagem sua basta trocar o tipo: textura ou imagem</div>
                            </div>
                        </div>
                    </div> 
                </div>
                <input type="hidden" name="type_background" id="type_background" value="<?php if($content['breadcrumb_background_type'] != ''){echo $content['breadcrumb_background_type'];}else{echo '0';} ?>"/>
            </li>
           
        
           
        </ul>   
        <p>&nbsp</p>
        
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_update" value="<?php echo Yii::t("adminForm", "button_common_define") ?>" />
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
    </div>
    <p>&nbsp;</p>
    <div class="clear height_support"></div>
    <input type="file" class="hide" id="file"/>
</div>

<script type="text/javascript">initBarraSocialListeners();initSlotEditButton();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>