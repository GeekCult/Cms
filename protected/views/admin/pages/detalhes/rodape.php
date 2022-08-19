<script type="text/javascript" src="/js/lib/jscolor/jscolor.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "details_page_footer") ?></h1>
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
            <li class="rows"><h3>Superior Pricipal</h3></li>
            <li class="rows ">
                <p>&nbsp;</p>
                <div class="label_text_Admin">Menu - 1</div>
                <div class="float">
                    <input name="ft_txt_menu1" type="text" id="ft_txt_menu1" class="form color" value="<?php if($content['ft_txt_menu1'] != "") echo $content['ft_txt_menu1'] ?>" style="width: 125px;"/>
                </div>
               
            </li>
            <li class="rows ">
                <p>&nbsp;</p>
                <div class="label_text_Admin">Menu - 2</div>
                <div class="float">
                    <div class="styled-select2">
                        <select name="ft_txt_menu2" id="ft_txt_menu2">
                            <option value="branco" <?php if($content['ft_txt_menu2'] == "branco") echo "selected" ?>/>Branco</option>
                            <option value="preto" <?php if($content['ft_txt_menu2'] == "preto") echo "selected" ?>/>Preto</option>
                            <option value="cinza" <?php if($content['ft_txt_menu2'] == "cinza") echo "selected" ?>/>Cinza</option>
                            <option value="azul" <?php if($content['ft_txt_menu2'] == "azul") echo "selected" ?>/>Azul</option>
                            <option value="verde_escuro" <?php if($content['ft_txt_menu2'] == "verde_escuro") echo "selected" ?>/>Verde escuro</option>
                            <option value="verde_claro" <?php if($content['ft_txt_menu2'] == "verde_claro") echo "selected" ?>/>Verde claro</option>
                            <option value="laranja_preto" <?php if($content['ft_txt_menu2'] == "laranja_preto") echo "selected" ?>/>Onça</option>
                        </select>
                    </div>
                </div>               
            </li>
            <li class="rows mgT2"><h3>Geral</h3></li>
            <li class="rows ">
                <p>&nbsp;</p>
                <div class="label_text_Admin">Título</div>
                <div class="float">
                    <input name="ft_titulo_menu" type="text" id="ft_titulo_menu" class="form color" value="<?php if($content['ft_titulo_menu'] != "") echo $content['ft_titulo_menu'] ?>" style="width: 125px;"/>
                </div>               
            </li>
            <li class="rows ">
                <p>&nbsp;</p>
                <div class="label_text_Admin">Subtítulo</div>
                <div class="float">
                    <input name="ft_subtitulo_menu" type="text" id="ft_subtitulo_menu" class="form color" value="<?php if($content['ft_subtitulo_menu'] != "") echo $content['ft_subtitulo_menu'] ?>" style="width: 125px;"/>
                </div>               
            </li>
            <li class="rows ">
                <p>&nbsp;</p>
                <div class="label_text_Admin">Textos</div>
                <div class="float">
                    <input name="ft_txt_menu" type="text" id="ft_txt_menu" class="form color" value="<?php if($content['ft_txt_menu'] != "") echo $content['ft_txt_menu'] ?>" style="width: 125px;"/>
                </div>               
            </li>
            <li class="rows">
                <p>&nbsp;</p>
                <div id="support_background_banners">       
                    <div class="column_settings_banners_left">
                                                        

                        <div class="label_text_Admin">Menu superior</div>
                        <div class="container_slot" id="1">
                            <div class="base_slot_container" id="base_1">
                                <div class="base_bt_select" title="Selecionar novo cool" id="1"></div>
                                <div class="base_bt_remove" title="Limpar slot" id="1"></div>
                            </div>
                            <div class="slot_launcher slot_page" id="slot_page_1">
                                <div id="texture_id_1" class="ctnTextureDetail" style="background: url(/media/images/textures/rodape/<?php echo $content['ft_menu'] ?>)"></div>
                                <input type="hidden" id="ft_menu" value="<?php echo $content['ft_menu'] ?>" data-type="<?php echo $content['ft_menu_type'] ?>" data-color="<?php echo $content['ft_menu_color'] ?>"/>
                            </div>
                            <div class="title_slot" id="title_slot_1"></div>
                            <div class="id_slot" id="id_slot_1"></div>
                            <div class="bt_fotos_slot bt_textures iframe" id="1"></div>                    
                        </div>
                        <div class="container_info_view">
                            <div class="container_info">
                                <div class="icon_information"></div>
                                <div class="titulo_column_info">Infos</div>
                            </div>
                            <div class="texto_column_info">
                                <div class="title_info_view"><h3>Menu superior</h3></div>
                                <div class="topic info_text_line">Escolha uma capa para sua galeria.</div>
                                <div class="topic info_text_line">Se não houver capa seleciona a primeira imagem será utilizada com capa</div>
                            </div>
                        </div>
                    </div>  
                </div>
            </li>           
            <li class="rows">
                <div class="label_text_Admin_logos mgR">Menu2 - Espaçamento</div>             
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <input type="input" id="ft_menu2_espacamento" class="mini left" value="<?php echo $content['ft_menu2_espacamento'] ?>" class="mgR"/>
                        <span class="mgL text fS">Pode usar negativo se necessário</span>
                    </div>
                </div>
            </li>
            <li class="rows mgT2"><div class="divider_shadow"></div></li>
            <div class="clear"></div>
            <li class="rows mgT2"><h3>Linha termos</h3></li>
            <li class="rows ">
                <p>&nbsp;</p>
                <div class="label_text_Admin">Textos</div>
                <div class="float">
                    <input name="ft_txt_line2" type="text" id="ft_txt_line2" class="form color" value="<?php if($content['ft_txt_line2'] != "") echo $content['ft_txt_line2'] ?>" style="width: 125px;"/>
                </div>
                
            </li>
            
            <li class="rows">
                <p>&nbsp;</p>
                <div id="support_background_banners">       
                    <div class="column_settings_banners_left">
                                                        

                        <div class="label_text_Admin">Linha de Termos</div>
                        <div class="container_slot" id="2">
                            <div class="base_slot_container" id="base_2">
                                <div class="base_bt_select" title="Selecionar novo cool" id="2"></div>
                                <div class="base_bt_remove" title="Limpar slot" id="2"></div>
                            </div>
                            <div class="slot_launcher slot_page" id="slot_page_2">
                                <div id="texture_id_2" class="ctnTextureDetail" style="background: url(/media/images/textures/site/<?php echo $content['ft_line2'] ?>)"></div>
                                <input type="hidden" id="ft_line2" value="<?php echo $content['ft_line2'] ?>"/>
                            </div>
                            <div class="title_slot" id="title_slot_2"></div>
                            <div class="id_slot" id="id_slot_2"></div>
                            <div class="bt_fotos_slot bt_site iframe" id="2"></div>                    
                        </div>
                        <div class="container_info_view">
                            <div class="container_info">
                                <div class="icon_information"></div>
                                <div class="titulo_column_info">Infos</div>
                            </div>
                            <div class="texto_column_info">
                                <div class="title_info_view"><h3>Capa</h3></div>
                                <div class="topic info_text_line">Escolha uma capa para sua galeria.</div>
                                <div class="topic info_text_line">Se não houver capa seleciona a primeira imagem será utilizada com capa</div>
                            </div>
                        </div>
                    </div>  
                </div>
            </li>
             <li class="rows mgT2"><div class="divider_shadow"></div></li>
            <li class="rows mgT2"><h3>Facebook</h3></li>
            <li class="rows">
                <p>&nbsp;</p>
                <div id="support_background_banners">       
                    <div class="column_settings_banners_left">
                                                        

                        <div class="label_text_Admin">Facebook fundo</div>
                        <div class="container_slot" id="3">
                            <div class="base_slot_container" id="base_3">
                                <div class="base_bt_select" title="Selecionar novo cool" id="3"></div>
                                <div class="base_bt_remove" title="Limpar slot" id="3"></div>
                            </div>
                            <div class="slot_launcher slot_page" id="slot_page_2">
                                <div id="texture_id_3" class="ctnTextureDetail" style="background: url(/media/images/textures/site/<?php echo $content['ft_fb_bg'] ?>)"></div>
                                <input type="hidden" id="ft_fb_bg" value="<?php echo $content['ft_fb_bg'] ?>"/>
                            </div>
                            <div class="title_slot" id="title_slot_3"></div>
                            <div class="id_slot" id="id_slot_3"></div>
                            <div class="bt_fotos_slot bt_site iframe" id="3"></div>                    
                        </div>
                        <div class="container_info_view">
                            <div class="container_info">
                                <div class="icon_information"></div>
                                <div class="titulo_column_info">Infos</div>
                            </div>
                            <div class="texto_column_info">
                                <div class="title_info_view"><h3>Capa</h3></div>
                                <div class="topic info_text_line">Escolha uma capa para sua galeria.</div>
                                <div class="topic info_text_line">Se não houver capa seleciona a primeira imagem será utilizada com capa</div>
                            </div>
                        </div>
                    </div>  
                </div>
            </li>
             <li class="rows mgT2"><div class="divider_shadow"></div></li>
            <li class="rows mgT2"><h3>Barra Copyright</h3></li>
            <li class="rows">
               <div class="text">Copyright</div>             
                <div class="">
                    <div class="ctn_checkbox">
                        <textarea id="rodape_copyright"><?php echo $content['rodape_copyright'] ?></textarea>
                    </div>
                </div>
                <div class="clear"></div>
                <p>&nbsp;</p>
            </li>
            <li class="rows ">
                <p>&nbsp;</p>
                <div class="label_text_Admin">Textos</div>
                <div class="float">
                    <input name="ft_txt_line_company" type="text" id="ft_txt_line_company" class="form color" value="<?php if($content['ft_txt_line_company'] != "") echo $content['ft_txt_line_company'] ?>" style="width: 125px;"/>
                </div>
                
            </li>
            <li class="rows">
                <p>&nbsp;</p>
                <div id="support_background_banners">       
                    <div class="column_settings_banners_left">
                                                        

                        <div class="label_text_Admin">Linha de empresa</div>
                        <div class="container_slot" id="4">
                            <div class="base_slot_container" id="base_4">
                                <div class="base_bt_select" title="Selecionar novo cool" id="4"></div>
                                <div class="base_bt_remove" title="Limpar slot" id="4"></div>
                            </div>
                            <div class="slot_launcher slot_page" id="slot_page_4">
                                <div id="texture_id_4" class="ctnTextureDetail" style="background: url(/media/images/textures/site/<?php echo $content['ft_ln_company_bg'] ?>)"></div>
                                <input type="hidden" id="ft_ln_company_bg" value="<?php echo $content['ft_ln_company_bg'] ?>"/>
                            </div>
                            <div class="title_slot" id="title_slot_4"></div>
                            <div class="id_slot" id="id_slot_4"></div>
                            <div class="bt_fotos_slot bt_site iframe" id="4"></div>                    
                        </div>
                        <div class="container_info_view">
                            <div class="container_info">
                                <div class="icon_information"></div>
                                <div class="titulo_column_info">Infos</div>
                            </div>
                            <div class="texto_column_info">
                                <div class="title_info_view"><h3>Capa</h3></div>
                                <div class="topic info_text_line">Escolha uma capa para sua galeria.</div>
                                <div class="topic info_text_line">Se não houver capa seleciona a primeira imagem será utilizada com capa</div>
                            </div>
                        </div>
                    </div>  
                </div>
            </li>
        </ul>  
        <p>&nbsp</p>

        
        <div class="clear"></div>
      

        
        <p>&nbsp</p>

        
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_update_rodape" value="<?php echo Yii::t("adminForm", "button_common_define") ?>" />
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
    </div>
     <p>&nbsp;</p>
     <div class="clear height_support"></div>
     <input type="file" class="hide" id="file"/>
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

<script type="text/javascript">initExtremosListeners();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>