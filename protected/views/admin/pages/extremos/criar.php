<script type="text/javascript" src="/js/lib/farbtastic.js"></script>
<link rel="stylesheet" href="/css/lib/farbtastic.css" type="text/css" media="screen" />
<script type="text/javascript" src="/js/lib/keyboardlistener.js"></script>
<script type="text/javascript" src="/js/admin/bannerMaker_support.js"></script>
<script type="text/javascript" src="/js/lib/snapshot/snapLib.js"></script>

<script type="text/javascript" src="/js/lib/snapshot/snapshot.js"></script>
<a name="anchorTarget" id="anchorTarget"></a>
<div class="container_pan">
    <div class="titleContent">
        <div class="support-logo"><h1><?php echo Yii::t("adminForm", "banners_page_title_new") ?></h1></div>
        <div class="tab_banners<?php if($local == "topos") echo "_focused"?>" id="topos">
            <span>Topos</span>
        </div>
        <div class="tab_banners<?php if($local == "rodapes") echo "_focused"?>" id="rodapes">
            <span>Rodapes</span>
        </div>
        <div class="tab_banners<?php if($local == "banner" || $local == "htmlbanners" || $local == "htmlspark" || $local == "hmltblocks" || $local == "htmlcorona" || $local == "htmlmini"  ) echo "_focused"?>" id="banner">
            <span>Banners</span>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="#" id="link_list_htmlcool">
        <input class="bt_right" type="button" value="<?php echo Yii::t("adminForm", "button_common_list") ?>"/>
    </a>
    <div class="bt_rigth_small" title="adicionar novo">
        <a href="/admin/<?php echo $local ?>/novo" id="bt_new"><?php echo Yii::t("adminForm", "button_common_add") ?></a>
    </div>
    <div class="clear"></div>
    <div class="container_devices_options left">
        <div class="picture_container_page"></div>
        <div class="title_devices">Você está editando <span class="title_device_name"><?php echo $session['device']?></span></div>
        <div class="title_empty_texture">
            <input type="button" id="bt_device_desktop" class="icon_desktop_square" title="Escolher Desktop" alt="desktop"/>
            <input type="button" id="bt_device_tablet" class="icon_tablet_square" title="Escolher Tablet" alt="tablet"/>
            <input type="button" id="bt_device_mobile" class="icon_mobile_square" title="Escolher Mobile" alt="mobile"/>
        </div>
    </div>
    <div class="sizeBannerSelector">
        <div class="label_text_banner"><?php echo Yii::t("adminForm", "common_size") ?></div>
        <div class="label_text_banner"><a href="#" class="bt_link_size" id="200">200px</a></div>
        <div class="label_text_banner"><a href="#" class="bt_link_size" id="250">250px</a></div>
        <div class="label_text_banner"><a href="#" class="bt_link_size" id="300">300px</a></div>
        <div class="label_text_banner"><a href="#" class="bt_link_size" id="450">450px</a></div>
        <div class="label_text_banner"><a href="#" class="bt_link_size" id="720">720px</a></div>
        <div class="label_text_banner"><a href="#" class="bt_link_size" id="980">980px</a></div>
        <div class="label_text_banner"><a href="#" class="bt_link_size" id="1000">Banner Principal</a></div>
        <div class="clear"></div>        
    </div>
    <div style="position: absolute; top: 300px; left: 300px; cursor: auto;" class="regular" id="dragger">
        <div id="bt_close_picker"></div>
        <div class="drag_point" onmousedown="clickser(event, 'dragger')" onmouseover="this.style.cursor='move';" onmouseup="unclicks();"></div>
        <div id="picker"></div>        
        <div class="form-item"></div>
    </div>
    <input type="hidden" id="color" name="color" value="#123456"/>
    <div class="clear"></div>
    <div class="menu_buttons_group">
        <div class="buttons_base_groups">
            <div class="bt_base_edit">
                <input class="no-background" type="button" id="bt_no_background" value="" title="Remover background"/>
                <input class="rule" type="button" id="bt_rule" value="" title="Régua"/>
                <input class="size_down" type="button" id="bt_decrease_size_banner" value="" title="Diminuir altura do banner"/>
                <input class="size_up" type="button" id="bt_increase_size_banner" value="" title="Almentar altura do banner"/>
            </div>
        </div>
        <div class="buttons_font_groups">
            <div class="bt_base_edit">
                <input class="font_size" type="button" id="bt_font_size" value="" title="Tamanho da fonte"/>
                <input class="font_type" type="button" id="bt_font_type" value="" title="Fontes"/>
                <input class="font_color" type="button" id="bt_font_color" value="" title="Cor da fonte"/>
            </div>            
            <div class="font_size_support_base">
                <input type ="button" class="icon_font_size_6"  id="f_6"/>
                <input type ="button" class="icon_font_size_8"  id="f_8"/>
                <input type ="button" class="icon_font_size_9"  id="f_9"/>
                <input type ="button" class="icon_font_size_10" id="f_10"/>
                <input type ="button" class="icon_font_size_11" id="f_11"/>
                <input type ="button" class="icon_font_size_12" id="f_12"/>
                <input type ="button" class="icon_font_size_13" id="f_13"/>
                <input type ="button" class="icon_font_size_16" id="f_16"/>
                <input type ="button" class="icon_font_size_18" id="f_18"/>
                <input type ="button" class="icon_font_size_20" id="f_20"/>
                <input type ="button" class="icon_font_size_24" id="f_24"/>
                <input type ="button" class="icon_font_size_28" id="f_28"/>    
            </div>
            <div class="font_size_support_over"></div>
            <div class="font_type_support_base">
                <input type ="button" class="font_type_lobster" id="Lobster"/>
                <input type ="button" class="font_type_cooper" id="Cooper"/>
                <input type ="button" class="font_type_bank" id="Bank"/>
                <input type ="button" class="font_type_burrito" id="Burrito"/>
                <input type ="button" class="font_type_army" id="Army"/>
                <input type ="button" class="font_type_rage_italic" id="Rage"/>
                <input type ="button" class="font_type_din" id="Din"/>
                <input type ="button" class="font_type_impact" id="Impact"/>
                <input type ="button" class="font_type_verdana" id="Verdana"/>
            </div>
            <div class="font_type_support_over"></div>
        </div>
        <div class="buttons_base_menu">
            <div class="bt_base_edit left">
                <input class="menu_properties" type="button" id="bt_menu_properties" value="" title="Menu propriedades"/>
            </div>
            <div class="bt_base_edit left">
                <input class="locker" type="button" id="bt_locker_stage" value="" title="Evita a tela andar mas bloquea os textos"/>
            </div>
            <div class="bt_base_edit left">
                <input class="directional" type="button" id="bt_show_directional" value="" title="Direcional"/>
            </div>
        </div>
        <div class="buttons_banner_groups">
            <div class="bt_banner_edit">
                <input class="horror" type="button" id="bt_edit_cat_horror" value="" title="Horror"/>
            </div>
            <div class="bt_banner_edit">
                <input class="cool-stuff" type="button" id="bt_edit_cat_cool" value="" title="Coisas bacanas!"/>
            </div>
        </div>
    </div>
    <div class="container_menu_properties">
        <div class="container_tab_menu_properties">
            <div class="tab_menu_properties_button" id="menu_property_settings">Settings</div>
            <div class="tab_menu_properties_button" id="menu_property_items">Items</div>
            <div class="tab_menu_properties_button_small" id="bt_menu_close">X</div>
        </div>
        <div class="container_cool_properties">
            <div class="title_attributes_panel">Attr.: Images</div>
            <div class="container_group_currentCool" id="attr_f_type">
                <div class="label_currentPropertie">Tipo:</div>
                <input id="cool_type_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="link_currentCoolApply" value="" class="bt_currentPropertie" title="Aplicar atributo"/>
            </div>
            <div class="container_group_currentCool" id="attr_f_type">
                <div class="label_currentPropertie">Nome:</div>
                <input id="cool_name_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="link_currentCoolApply" value="" class="bt_currentPropertie" title="Aplicar atributo"/>
            </div>
            <div class="container_group_currentCool" id="attr_f_src">
                <div class="label_currentPropertie">Recurso:</div>
                <input id="resource_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="link_currentCoolApply" value="" class="bt_currentPropertie" title="Aplicar atributo"/>
            </div>
            <div class="container_group_currentCool" id="attr_f_text">
                <div class="label_currentPropertie">Texto:</div>
                <textarea id="text_currentCool" class="text_currentPropertie"></textarea>
                <input type="button" id="bt_text_currentCool" value="" class="bt_currentPropertie" title="Aplicar atributo"/> 
            </div>
            <div class="container_group_currentCool" id="attr_f_px">
                <div class="label_currentPropertie">Pos X:</div>
                <input id="pos_x_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="bt_pos_x_currentCool" value="" class="bt_currentPropertie" title="Aplicar atributo"/>
            </div>
            <div class="container_group_currentCool" id="attr_f_py">
                <div class="label_currentPropertie">Pos Y:</div>
                <input id="pos_y_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="bt_pos_y_currentCool" value="" class="bt_currentPropertie" title="Aplicar atributo"/>
            </div>
            <div class="container_group_currentCool" id="attr_f_width">
                <div class="label_currentPropertie">Largura:</div>
                <input id="width_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="bt_width_currentCool" value="" class="bt_currentPropertie" title="Aplicar atributo"/>
            </div>
            <div class="container_group_currentCool" id="attr_f_height">
                <div class="label_currentPropertie">Altura:</div>
                <input id="height_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="bt_height_currentCool" value="" class="bt_currentPropertie" title="Aplicar atributo"/>
            </div>
            <div class="container_group_currentCool" id="attr_f_size">
                <div class="label_currentPropertie">Tamanho:</div>
                <input id="font_size_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="link_currentCoolApply" value="" class="bt_currentPropertie" title="Aplicar atributo"/>
            </div>
            <div class="container_group_currentCool" id="attr_f_font">
                <div class="label_currentPropertie">Fonte:</div>
                <input id="font_type_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="link_currentCoolApply" value="" class="bt_currentPropertie" title="Aplicar atributo"/>
            </div>            
            <div class="container_group_currentCool" id="attr_f_color">
                <div class="label_currentPropertie" >Cor:</div>
                <input id="color_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="link_currentCoolApply" value="" class="bt_currentPropertie" title="Aplicar atributo"/>
            </div>
            <div class="container_group_currentCool" id="attr_f_thumb">
                <div class="label_currentPropertie" >Thumb:</div>
                <input id="thumb_size_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="link_currentCoolApply" value="" class="bt_currentPropertie" title="Aplicar atributo"/>
            </div>
            <div class="container_group_currentCool" id="attr_f_link">
                <div class="label_currentPropertie" >Link:</div>
                <input id="link_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="bt_link_currentCool" value="" class="bt_currentPropertie" title="Aplicar atributo"/> 
            </div>
            <div class="container_group_currentCool" id="attr_f_z_index">
                <div class="label_currentPropertie" >Z-Index:</div>
                <input id="zindex_currentCool" value="" type="text" class="text_currentPropertie"/>
                <input type="button" id="bt_link_currentCool" value="" class="bt_currentPropertie" title="Aplicar atributo"/> 
            </div>
        </div>
        <div class="footer_attributes_panel"></div>
        <div id="menu_properties_items"></div>
    </div>
    <div id="bannerMakerBackground">
        <div class="canvas_stage" id="stage"></div>
        <?php if($action == "editar" || $action == "template") { ?><script type="text/javascript">addBannerHTML('<?php echo json_encode($content["cool2"]) ?>', "")</script><?php } ?>
    </div>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/special/colors.php"; ?>
    <div id="buttons_support">
        <div class="buttons_banner_edit">
            <div class="bt_banner_edit">
                <input class="rotate-left" type="button" id="bt_edit_rotate_left" value="" title="Rotacionar esquerda"/>
            </div>
            <div class="bt_banner_edit">
                <input class="rotate-right" type="button" id="bt_edit_rotate_right" value="" title="Rotacionar direita"/>
            </div>
            <div class="bt_banner_edit">
                <div class="buttons_quarter_up">
                    <input class="bt_quarter_up_left" id="bt_edit_move_left" title="Mover para esquerda" type="button"/>
                    <input class="bt_quarter_up_right" id="bt_edit_move_down" title="Mover para cima" type="button"/>
                </div>
                <div class="buttons_quarter_down">
                    <input class="bt_quarter_down_left" id="bt_edit_move_right" title="Mover para direita" type="button"/>
                    <input class="bt_quarter_down_right" id="bt_edit_move_up" title="Mover para baixo" type="button">
                </div>
            </div>
            <div class="bt_banner_edit">
                <input class="depth_up" type="button" id="bt_edit_depth_up" value="" title="Subir uma posição"/>
            </div>
            <div class="bt_banner_edit">
                <input class="depth_down" type="button" id="bt_edit_depth_down" value="" title="Descer uma posição"/>
            </div>
            <div class="bt_banner_edit">
                <div class="buttons_quarter_up">
                    <input class="bt_quarter_up_left" id="bt_edit_width_down" title="Diminuir largura" type="button"/>
                    <input class="bt_quarter_up_right" id="bt_edit_height_up" title="Aumentar altura" type="button"/>
                </div>
                <div class="buttons_quarter_down">
                    <input class="bt_quarter_down_left" id="bt_edit_width_up" title="Aumentar largura" type="button" />
                    <input class="bt_quarter_down_right" id="bt_edit_height_down" title="Diminuir altura" type="button" />
                </div>
            </div>
            <div class="bt_banner_edit">
                <input class="mirror_h" type="button" id="bt_edit_mirror_h" value="" title="Espelhar horizontal"/>
            </div>
            <div class="bt_banner_edit">
                <input class="mirror_v" type="button" id="bt_edit_mirror_v" value="" title="Espelhar vertical"/>
            </div>
            <div class="bt_banner_edit">
                <input class="color" type="button" id="bt_edit_color" value="" title="Pinte"/>
            </div>
            <div class="bt_banner_edit">
                <input class="text" type="button" id="bt_edit_text" value="" title="Adicionar texto"/>
            </div>
            <div class="bt_banner_edit">
                <input class="paragraph" type="button" id="bt_edit_paragraph" value="" title="Adicionar parágrafo"/>
            </div>
            <div class="bt_banner_edit">
                <input class="trash" type="button" id="bt_edit_trash" value="" title="Remover"/>
            </div>
        </div>  
        <div id="buttons_banner_support">
            <div class="buttons_banner">
                <div class="bt_banner">
                    <input class="noform iframe" type="button" id="bt_cool_4" name="backgrounds" value="Backgrounds"/>
                </div>
                <div class="bt_banner">
                    <input class="noform iframe" type="button" id="bt_cool_3" name="components" value="Componentes"/>
                </div>                
                <div class="bt_banner">
                    <input class="noform iframe" type="button" id="bt_cool_2" name="modelos" value="Modelos"/>
                </div>    
                <div class="bt_banner bt_spacing_bmk">
                    <input class="noform iframe" type="button" id="bt_cool_5" name="loja" value="Loja"/>
                </div>
                <div class="bt_banner">
                    <input class="noform iframe" type="button" id="bt_cool_1" name="cool" value="Cool"/>
                </div>
                <div class="bt_banner">
                    <input class="iframe noform" type="button" id="bt_cool_0" name="fotos" value="Fotos"/>
                </div>
            </div>
            <div class="direcional_container"></div>                
            <div class="banner_maker_statusbar">
                <div><input type="text" value="" id="text_status_banner_maker"/></div>
            </div>
            <div class="buttons_banner">                
                <input class="bt_right bt_help_extremos" type="button" id="bt_cool_5" name="salvar" value="Salvar"/>
                <input class="bt_right bt_help_extremos" type="button" id="bt_cool_6" name="salvar_novo" value="Salvar novo"/>
                <input class="bt_normal bt_help_extremos" type="button" id="bt_cool_7" name="salvar_modelo" value="Salvar modelo"/>                
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
<div class="clear"></div>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
<div class="clear"></div>
<input id="helper_id_html_cool" value="<?php echo $id ?>" type="hidden"/>
<input id="helper_id_html_action" value="<?php echo $action ?>" type="hidden"/>
<input id="helper_local" value="<?php echo $local ?>" type="hidden"/>
<input id="helper_largura" value="<?php echo $largura_banner ?>" type="hidden"/>
<input id="helper_mini_site" type="hidden" value="" data-url="<?php if(isset($minisite_url)) echo $minisite_url ?>"/>
<input type="hidden" id="helper_font" value="1"/>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>
<script type="text/javascript">setImagePlace("<?php echo $content["largura"] ?>");</script>
<script type="text/javascript">setSizeBanner('<?php echo $content["altura"]?>', "<?php echo $content["largura"] ?>", "");</script>
