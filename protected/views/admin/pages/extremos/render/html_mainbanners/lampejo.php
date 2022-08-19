<script type="text/javascript" src="/js/lib/jscolor/jscolor.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "details_page_banner") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/<?php echo $content['tipo'] ?>/listar" id="link_list_htmlcool">
        <input class="bt_right" type="button" value="<?php echo Yii::t("adminForm", "button_common_list") ?>"/>
    </a>
    <a href="/admin/html_renderpartial/ver/<?php echo $content["id"]  ?>" target="_blank">
        <input class="bt_right" type="button" value="<?php echo Yii::t("adminForm", "button_common_see") ?>"/>
    </a>
    <div id="buttons_support" class="layoutAdmin">
        <div class="container_texture_empty">
            <div class="title_empty_texture">
                <input type="button" id="bt_device_desktop" class="icon_desktop_square" title="Escolher Desktop" alt="desktop"/>
                <input type="button" id="bt_device_tablet" class="icon_tablet_square" title="Escolher Tablet" alt="tablet"/>
                <input type="button" id="bt_device_mobile" class="icon_mobile_square" title="Escolher Mobile" alt="mobile"/>
            </div>                        
        </div>
        <h2 class="black">Banner</h2>
    </div>
       
    <div class="ctnFullBanner" style="<?php if($content['image'] != ''){if($content['image_type'] == 0){echo "background: url(/media/user/images/original/". $content['image'] .") center center";}else{echo "background: url(/media/images/textures/site/". $content['image'] .") center center";}} ?>">
        <div class="ctnBannerRender row-fluid">
            <?php $this->renderPartial("/site/common/".$type_size. $content["cool"], $content["cool2"]); ?> 
        </div>
    </div>
    <p>&nbsp;</p>
    <input type="hidden" id="helper_miniSiteUser" value="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteUser'] ?>" data-url="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteUrl'] . "/media/user/images/thumbs_120/" ?>" data-remote="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteRemote'] ?>"/>
    <div id="buttons_support" class="layoutAdmin">
        <h2 class="black"><?php echo Yii::t("adminForm", "common_details") ?></h2>
        <div id="menu_conta">
            <div class="menu_conta_container_buttons" style="right:0">
                <ul>
                    <li id="link_conta_01" class="r_tab" data-tab="1"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Geral</div><div class="tab_corner_disable_right"></div></li>
                    <li id="link_conta_02" class="r_tab" data-tab="2"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Detalhes</div><div class="tab_corner_disable_right"></div></li>
                </ul>
            </div>
        </div>
        <div class="divider_horizontal"></div>
        <form id="form_banner_render">
            <div id="holdTab_1" class="ctnTbsRender">
                <ul id="slot_support">            
                    <li class="rows">
                        <h3>Geral</h3>
                    </li>

                    <li class="rows">
                        <div id="support_background_banners">       
                            <div class="column_settings_banners_left">
                                <div class="label_text_Admin">
                                    <p class="bt_render_bg <?php if($content['image_type'] == 1) echo 'active_p'; ?>" data-type="ctnSlotRenderTexture" data-type-id="1">Textura</p>
                                    <div class="clear mgB"></div>
                                    <p class="bt_render_bg <?php if($content['image_type'] == 0) echo 'active_p'; ?>" data-type="ctnSlotRenderImage" data-type-id="0">Imagem</p>
                                </div>
                                
                                <div id="ctnSlotRenderImage" class="ctnSlotRenderTyp left" style="<?php if($content['image_type'] == 1) echo 'display:none'; ?>">
                                    <div class="container_slot" id="1">
                                        <div class="base_slot_container" id="base_1">
                                            <div class="base_bt_select" title="Selecionar novo cool" id="1"></div>
                                            <div class="base_bt_remove" title="Limpar slot" id="1"></div>
                                        </div>
                                        <div class="slot_launcher slot_page" id="slot_page_1">
                                            <img id="slot_pict_id_1" src="" width="" height="" alt=""/>
                                            <input type="hidden" id="submit_pict_id_1" name="image_background" value="<?php if($content['image_type'] == 0) echo $content['image'] ?>"/>
                                            <script type="text/javascript"><?php if($content['image_type'] == 0 && $content['image'] != ''){ ?>applyPictureSize('<?php echo $content['image'] ?>', 1, 'image', true);<?php } ?></script>
                                        </div>
                                        <div class="title_slot" id="title_slot_1"></div>
                                        <div class="id_slot" id="id_slot_1"><?php if($content['image_type'] == 0) echo $content['image'] ?></div>
                                        <div class="bt_fotos_slot bt_fotos iframe" id="1"></div>                    
                                    </div>
                                </div>
                                
                                <div id="ctnSlotRenderTexture" style="<?php if($content['image_type'] == 0) echo 'display:none'; ?>" class="ctnSlotRenderTyp left">
                                    <div class="container_slot" id="2">
                                        <div class="base_slot_container" id="base_2">
                                            <div class="base_bt_select" title="Selecionar novo cool" id="2"></div>
                                            <div class="base_bt_remove" title="Limpar slot" id="2"></div>
                                        </div>
                                        <div class="slot_launcher slot_page pdL0" id="slot_page_2">
                                            <div id="slot_texture_id_2" class="ctnTextureDetail" style="background: url(/media/images/textures/site/<?php if($content['image_type'] == 1) echo $content['image'] ?>)"></div>
                                            <input type="hidden" id="submit_texture_id_2" name="texture_background" value="<?php if($content['image_type'] == 1) echo $content['image'] ?>"/>
                                        </div>
                                        <div class="title_slot" id="title_slot_2"></div>
                                        <div class="id_slot" id="id_slot_2"><?php if($content['image_type'] == 1) echo $content['image'] ?></div>
                                        <div class="bt_fotos_slot bt_site iframe" id="2"></div>                    
                                    </div>
                                </div>
                                
                                <div class="container_info_view">
                                    <div class="container_info">
                                        <div class="icon_information"></div>
                                        <div class="titulo_column_info">Infos</div>
                                    </div>
                                    <div class="texto_column_info">
                                        <div class="title_info_view"><h3>Fundo do Banner</h3></div>
                                        <div class="topic info_text_line">Essa imagem preenche o banner todo e dependendo do layout do site é 100%</div>
                                        <div class="topic info_text_line">Você também pode escolher entre uma textura ou uma imagem</div>
                                        <div class="topic info_text_line">Para utiliziar uma imagem sua basta trocar o tipo: textura ou imagem</div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <input type="hidden" name="type_background" id="type_background" value="<?php echo $content['image_type'] ?>"/>
                    </li>
                </ul>
            </div>
            <div id="holdTab_2" class="ctnTbsRender" style="display:none">
                <ul id="slot_support">            
                    <li class="rows">
                        <h3>Imagem</h3>
                    </li>
      
                    <li class="rows">
                        <div class="ctnLink left">
                            <div class="label_text_Admin">Link</div> 
                            <input type="input" class="input_normal" name="link1" value="<?php if(isset($content['cool2']['image1'])) echo $content['cool2']['image1']['link'] ?>" class="mgR"/>
                        </div>
                        <div class="ctnLink">
                            <div class="label_text_Admin">Abrir</div>
                            <div class="styled-select">
                                <select name="link1_modo" id="link1_modo">
                                    <option value="1" <?php if(isset($content['cool2']['image1']['variante']) && $content['cool2']['image1']['variante'] == 1) echo 'selected' ?>>na mesma aba</option>
                                    <option value="2" <?php if(isset($content['cool2']['image1']['variante']) && $content['cool2']['image1']['variante'] == 2) echo 'selected' ?>>em outra aba</option>                                  
                                </select>
                            </div>                            
                        </div>
                        <div class="clear mgB2"></div>
                        <div class="divider_horizontal"></div>
                    </li>
      
                    <li class="rows">
                        <div id="support_background_banners">       
                            <div class="column_settings_banners_left" id="slot_support">
                                <div class="label_text_Admin">Image</div>
                                <div class="container_slot" id="4">
                                    <div class="base_slot_container" id="base_4">
                                        <div class="base_bt_select" title="Selecionar novo cool" id="4"></div>
                                        <div class="base_bt_remove" title="Limpar slot" id="4"></div>
                                    </div>
                                    <div class="slot_launcher slot_page" id="slot_page_4">
                                        <img id="slot_pict_id_4" src="" width="" height="" alt="<?php if(isset($content['cool2']['image1'])) echo $content['cool2']['image1']['src'] ?>"/>
                                        <input type="hidden" id="submit_pict_id_4" name="image1" value="<?php if(isset($content['cool2']['image1'])) echo $content['cool2']['image1']['src'] ?>"/>
                                        <?php if(isset($content['cool2']['image1']) && $content['cool2']['image1'] != ''){ ?> 
                                        <script type="text/javascript">applyPictureSize('<?php if(isset($content['cool2']['image1'])) echo $content['cool2']['image1']['src'] ?>', 4, 'image', true);</script>
                                        <?php } ?>
                                    </div>
                                    <div class="title_slot" id="title_slot_4"></div>
                                    <div class="id_slot" id="id_slot_4"><?php if(isset($content['cool2']['image1'])) echo $content['cool2']['image1']['src'] ?></div>
                                    <div class="bt_fotos_slot bt_fotos iframe" id="4"></div>                    
                                </div>
                                <div class="container_info_view">
                                    <div class="container_info">
                                        <div class="icon_information"></div>
                                        <div class="titulo_column_info">Infos</div>
                                    </div>
                                    <div class="texto_column_info">
                                        <div class="title_info_view"><h3>Image</h3></div>
                                        <div class="topic info_text_line">Tamanho ideal da imagem 1170x400px</div>
                                        <div class="topic info_text_line">Escolha uma imagem do seu acervo de images</div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </li>
                  
                </ul> 
            </div>
        </form>
        <p>&nbsp</p>
        
        <div class="clear"></div>
        <p>&nbsp</p>

        
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_update_render" value="<?php echo Yii::t("adminForm", "button_common_define") ?>" />
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
    </div>
    <div class="clear height_support"></div>
    <input type="file" class="hide" id="file"/>
    <input type="hidden" id="helper_id_banner" value="<?php echo $content['id'] ?>"/>
    
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

<script type="text/javascript">initRenderListeners(); initSlotEditButton();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>