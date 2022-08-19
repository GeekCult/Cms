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
        <h3 class="black">Rodapé</h3>
    </div>
       
    <div class="ctnFullBanner" style="<?php if($content['image'] != ''){if($content['image_type'] == 0){echo "background: url(/media/user/images/original/". $content['image'] .") center center";}else{echo "background: url(/media/images/textures/site/". $content['image'] .") center center";}} ?>">
        <div class="ctnBannerRender s_html_topo">
            <?php $this->renderPartial("/site/common/footer/site/special/". $content["cool"], $content["cool2"]); ?> 
        </div>
    </div>
    <p>&nbsp;</p>
        
    <div id="buttons_support" class="layoutAdmin">
        <h3 class="black"><?php echo Yii::t("adminForm", "common_details") ?></h3>
        <div id="menu_conta">
            <div class="menu_conta_container_buttons" style="right:0">
                <ul>
                    <li id="link_conta_01" class="r_tab" data-tab="1"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Geral</div><div class="tab_corner_disable_right"></div></li>
                    
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
                        <div class="label_text_Admin hide">Chamada - título</div> 
                        <input type="input" class="input_big hide" name="chamada_titulo" value="<?php if(isset($content['cool2']['preferences']['rodape']['attr']['chamada_titulo'])) echo $content['cool2']['preferences']['rodape']['attr']['chamada_titulo'] ?>" class="mgR"/>
                        
                        <div class="clear mgB"></div>
                        <div class="label_text_Admin">Endereço</div>
                        <textarea id="chamada_texto" name="chamada_texto" rows="4" class="textarea_big"><?php if(isset($content['cool2']['preferences']['rodape']['attr']['chamada_texto'])) echo $content['cool2']['preferences']['rodape']['attr']['chamada_texto'] ?></textarea>
                        <div class="clear mgB"></div>
                    </li>
                   
                    <li class="rows">
                        <div class="label_text_Admin">Telefones</div> 
                        <textarea id="titulo1" name="titulo1" rows="4" class="textarea_big"><?php if(isset($content['cool2']['preferences']['rodape']['attr']['titulo_column_1'])) echo $content['cool2']['preferences']['rodape']['attr']['titulo_column_1'] ?></textarea>
                        
                        <div class="clear mgB0"></div>
                        <div class="label_text_Admin">Email</div>       
                        <div class="ctnTextarea">
                            <input type="input" id="texto1" class="input_big" name="texto1" value="<?php if(isset($content['cool2']['preferences']['rodape']['attr']['texto_column_1'])) echo $content['cool2']['preferences']['rodape']['attr']['texto_column_1'] ?>" class="mgR"/>
                        </div>
                        
                        <div class="clear mgB0 "></div>
                        <div class="label_text_Admin hide">Link</div> 
                        <input type="input" class="medium hide" name="link1" value="<?php if(isset($content['cool2']['preferences']['rodape']['attr']['link_column_1'])) echo $content['cool2']['preferences']['rodape']['attr']['link_column_1'] ?>" class="mgR"/>
                        <div class="clear mgB0"></div>
                    </li>
                    
                    <li class="rows hide">
                        <div class="label_text_Admin">Elementos - 1</div> 
                        <input type="checkbox" class="checkbox left mgR" name="container_layout_1" <?php if(isset($content['cool2']['preferences']['rodape']['attr']['container_layout_1']) && $content['cool2']['preferences']['rodape']['attr']['container_layout_1']) echo 'checked' ?>/>
                        <div class="legend mgL">Exibe os elementos da linha superior</div>
                        <div class="clear mgB"></div>
                        <div class="label_text_Admin">Elementos - 2</div> 
                        <input type="checkbox" class="checkbox left mgR" name="container_layout_2" <?php if(isset($content['cool2']['preferences']['rodape']['attr']['container_layout_2']) && $content['cool2']['preferences']['rodape']['attr']['container_layout_2']) echo 'checked' ?>/>
                        <div class="legend mgL">Exibe os elementos da linha superior</div>
                        
                    </li>
                    
                    <li class="rows">
                        <div class="label_text_Admin">Layout</div>
                        <div class="styled-select">
                            <select name="rodape_layout_pos" id="rodape_layout_pos">
                                <option value="tradicional" <?php if(isset($content['cool2']['preferences']['rodape']['attr']['rodape_layout_pos']) && $content['cool2']['preferences']['rodape']['attr']['rodape_layout_pos'] == 'tradicional') echo 'selected' ?>>Tradicional</option>
                                <option value="ciclone" <?php if(isset($content['cool2']['preferences']['rodape']['attr']['rodape_layout_pos']) && $content['cool2']['preferences']['rodape']['attr']['rodape_layout_pos'] == 'ciclone') echo 'selected' ?>>Ciclone</option>
                                <option value="granizo" <?php if(isset($content['cool2']['preferences']['rodape']['attr']['rodape_layout_pos']) && $content['cool2']['preferences']['rodape']['attr']['rodape_layout_pos'] == 'granizo') echo 'selected' ?>>Granizo</option>
                                <option value="tornado" <?php if(isset($content['cool2']['preferences']['rodape']['attr']['rodape_layout_pos']) && $content['cool2']['preferences']['rodape']['attr']['rodape_layout_pos'] == 'tornado') echo 'selected' ?>>Tornado</option>
                                <option value="vortex" <?php if(isset($content['cool2']['preferences']['rodape']['attr']['rodape_layout_pos']) && $content['cool2']['preferences']['rodape']['attr']['rodape_layout_pos'] == 'vortex') echo 'selected' ?>>Vortex</option>
                            </select>
                        </div>
                        
                    </li>
                    
                    <li class="rows">
                        <div id="fancybox_images_launcher" class="iframe helper_tamanho_fake"></div>
                        <div id="slot_support">       
                            <div class="column_settings_banners_left">
                                <div class="label_text_Admin">&nbsp;</div>
                                <div class="container_slot" id="1">
                                    <div class="base_slot_container" id="base_1">
                                        <div class="base_bt_select" title="Selecionar novo cool" id="1"></div>
                                        <div class="base_bt_remove" title="Limpar slot" id="1"></div>
                                    </div>
                                    <div class="slot_launcher slot_page" id="slot_page_1">
                                        <img id="slot_pict_id_1" src="" width="" height="" alt=""/>                        
                                        <div id="slot_banner_id_1" class="relative"></div>
                                        <div class="canvas_stage1" id="stage"></div>
                                        <input type="hidden" value="<?php if(isset($content['cool2']['preferences']['rodape']['attr']['ft_image_1'])) echo $content['cool2']['preferences']['rodape']['attr']['ft_image_1'] ?>" id="submit_pict_id_1" name="image_1"/>
                                    </div>
                                    <div class="title_slot" id="title_slot_1"></div>
                                    <div class="id_slot" id="id_slot_1"><?php if(isset($content['cool2']['preferences']['rodape']['attr']['ft_image_1'])) echo $content['cool2']['preferences']['rodape']['attr']['ft_image_1'] ?></div>
                                    <div class="bt_fotos_slot bt_site" id="1" data-type="image"></div>                    
                                </div>
                                <div class="container_info_view" style="width: 500px">
                                    <div class="container_info">
                                        <div class="icon_information"></div>
                                        <div class="titulo_column_info">Infos</div>
                                    </div>
                                    <div class="texto_column_info">
                                        <div class="title_info_view"><h3>Image e textos</h3></div>
                                        <div class="topic info_text_line">Selecione a imagem que deseja exibir no rodapé.</div>
                                        <div class="topic info_text_line">A imagems deve ser superior a 720px de largura</div>
                                        <div class="topic info_text_line">Uma imagem ideal é de 1170x100</div>
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

<?php if(isset($content['cool2']['preferences']['rodape']['attr']['ft_image_1']) && $content['cool2']['preferences']['rodape']['attr']['ft_image_1'] != ''){ ?>
<script type="text/javascript">applyPictureSize('<?php echo $content['cool2']['preferences']['rodape']['attr']['ft_image_1'] ?>', 1, 'image', true);</script>
<?php } ?>

<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>