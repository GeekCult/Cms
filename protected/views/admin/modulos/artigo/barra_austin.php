<script type="text/javascript" src="/js/lib/farbtastic.js"></script>
<link rel="stylesheet" href="/css/lib/farbtastic.css" type="text/css" media="screen" />
<h2><?php echo Yii::t("adminForm", "common_details") ?></h2>

<div id="menu_conta">
    <div class="menu_conta_container_buttons" style="right:0">
        <ul>
            <li id="link_conta_01" class="blc_tab" data-tab="0"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Geral</div><div class="tab_corner_disable_right"></div></li>
            <li id="link_conta_02" class="blc_tab" data-tab="1"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Conteúdo</div><div class="tab_corner_disable_right"></div></li>
            <li id="link_conta_02" class="blc_tab" data-tab="2"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Detalhes</div><div class="tab_corner_disable_right"></div></li>
        </ul>
    </div>
</div>
<div class="divider_horizontal"></div>
<div id="slot_support">
    <div id="blContainer_0">
        <fieldset>
            <ul>
                <h4 class="subtitle_admin">Geral</h4>
                <li class="rows">
                    <div class="label_text_Admin">Título exibição</div>
                    <div class="text">
                        <input id="titulo_componente" name="titulo_componente" class="normal" value="<?php echo $item['content']['titulo_componente'] ?>" placeholder="Nome para fácil identificação na listagem">
                    </div>
                    <div class="clear mgB"></div>
                </li>
                <li class="rows">
                    <div class="ctnBlcGeral">
                        <div class="label_text_Admin">Margin - cima</div>
                        <div class="text">
                            <input id="margin_top" name="margin_top" class="mini2" value="<?php echo $item['content']['margin_top'] ?>" placeholder="0" type="number">
                        </div>
                        <div class="clear mgB"></div>
                        <div class="label_text_Admin">Margin - baixo</div>
                        <div class="text">
                            <input id="margin_bottom" name="margin_bottom" class="mini2" value="<?php echo $item['content']['margin_bottom'] ?>" placeholder="0" type="number">
                        </div>
                        <div class="clear mgB"></div>
                        <div class="label_text_Admin">Padding cima</div>
                        <div class="text">
                            <input id="padding_top" name="padding_top" class="mini2" value="<?php echo $item['content']['padding_top'] ?>" placeholder="0" type="number">
                        </div>
                        <div class="clear mgB"></div>
                        <div class="label_text_Admin">Padding - baixo</div>
                        <div class="text">
                            <input id="padding_bottom" name="padding_bottom" class="mini2" value="<?php echo $item['content']['padding_bottom'] ?>" placeholder="0" type="number">
                        </div>
                        <div class="clear mgB"></div>
                        <div class="label_text_Admin">Background full</div>
                        <div class="text">
                            <input id="is_full" name="is_full" class="mini" <?php if($item['content']['is_full']) echo 'checked' ?> type="checkbox">
                        </div>
                        <div class="clear mgB"></div>
                        <div class="label_text_Admin">Encaixar</div>
                        <div class="text">
                            <input id="is_full" name="is_container" class="mini" <?php if($item['content']['is_container']) echo 'checked' ?> type="checkbox">
                        </div>
                    </div>



                    <div class="container_info_view">
                        <div class="container_info">
                            <div class="icon_information"></div>
                            <div class="titulo_column_info">Infos</div>
                        </div>
                        <div class="texto_column_info">
                            <div class="title_info_view"><h3>Dicas das informações gerais</h3></div>
                            <div class="topic info_text_line">Blocos - quantos blocos serão exibidos</div>
                            <div class="topic info_text_line">Adicione título de exibição para facilitar a identificação</div>
                            <div class="topic info_text_line">Padding é a margem interna do componente</div>
                        </div>
                    </div>
                </li>
                <li class="rows">
                    <div id="support_background_banners">       
                        <div class="column_settings_banners_left">
                            <div class="label_text_Admin">
                                <p class="bt_render_bg <?php if($item['content']['background_type'] == 1) echo 'active_p'; ?>" data-type="ctnSlotRenderTexture" data-type-id="1">Textura</p>
                                <div class="clear mgB"></div>
                                <p class="bt_render_bg <?php if($item['content']['background_type'] == 0) echo 'active_p'; ?>" data-type="ctnSlotRenderImage" data-type-id="0">Imagem</p>
                                <div class="clear mgB"></div>
                                <p class="bt_render_bg <?php if($item['content']['background_type'] == 2) echo 'active_p'; ?>" data-type="ctnSlotRenderColor" data-type-id="2">Cor</p>
                            </div>

                            <div id="ctnSlotRenderImage" class="ctnSlotRenderTyp left" style="<?php if($item['content']['background_type'] == 1 || $item['content']['background_type'] == 2) echo 'display:none'; ?>">
                                <div class="container_slot" id="1">
                                    <div class="base_slot_container" id="base_1">
                                        <div class="base_bt_select" title="Selecionar novo cool" id="1"></div>
                                        <div class="base_bt_remove" title="Limpar slot" id="1"></div>
                                    </div>
                                    <div class="slot_launcher slot_page" id="slot_page_1">
                                        <img id="slot_pict_id_1" src="" width="" height="" alt=""/>
                                        <input type="hidden" id="submit_pict_id_1" name="image_background" value="<?php if($item['content']['background_type'] == 0) echo $item['content']['background'] ?>"/>
                                        <script type="text/javascript"><?php if($item['content']['background_type'] == 0 && $item['content']['background'] != ''){ ?>applyPictureSize('<?php echo $item['content']['background'] ?>', 1, 'image', true);<?php } ?></script>
                                    </div>
                                    <div class="title_slot" id="title_slot_1"></div>
                                    <div class="id_slot" id="id_slot_1"><?php if($item['content']['background_type'] == 0) echo $item['content']['background'] ?></div>
                                    <div class="bt_fotos_slot bt_fotos iframe" id="1" data-type="image"></div>                    
                                </div>
                            </div>

                            <div id="ctnSlotRenderTexture" style="<?php if($item['content']['background_type'] == 0 || $item['content']['background_type'] == 2) echo 'display:none'; ?>" class="ctnSlotRenderTyp left">
                                <div class="container_slot" id="2">
                                    <div class="base_slot_container" id="base_2">
                                        <div class="base_bt_select" title="Selecionar novo cool" id="2"></div>
                                        <div class="base_bt_remove" title="Limpar slot" id="2"></div>
                                    </div>
                                    <div class="slot_launcher slot_page pdL0" id="slot_page_2">
                                        <div id="slot_texture_id_2" class="ctnTextureDetail" style="padding-left: 20px; background: url(/media/images/textures/site/<?php if($item['content']['background_type'] == 1) echo $item['content']['background'] ?>)"></div>
                                        <input type="hidden" id="submit_texture_id_2" name="texture_background" value="<?php if($item['content']['background_type'] == 1) echo $item['content']['background'] ?>"/>
                                    </div>
                                    <div class="title_slot" id="title_slot_2"></div>
                                    <div class="id_slot" id="id_slot_2"><?php if($item['content']['background_type'] == 1) echo $item['content']['background'] ?></div>
                                    <div class="bt_textures_slot iframe" id="2" data-type="site"></div>                    
                                </div>
                            </div>

                            <div id="ctnSlotRenderColor" style="<?php if($item['content']['background_type'] == 1 || $item['content']['background_type'] == 0) echo 'display:none'; ?>" class="ctnSlotRenderTyp left">
                                <div class="container_slot" id="3">
                                    <div class="base_slot_container" id="base_3">
                                        <div class="base_bt_select" title="Selecionar novo cool" id="3"></div>
                                        <div class="base_bt_remove" title="Limpar slot" id="3"></div>
                                    </div>
                                    <div class="slot_launcher slot_page pdL0" id="slot_page_3">
                                        <div id="slot_texture_id_3" class="ctnTextureDetail" style="padding-left: 20px; background: url(/media/images/textures/efeitos/<?php if($item['content']['background_type'] == 2) echo $item['content']['background'] ?>)"></div>
                                        <input type="hidden" id="submit_texture_id_3" name="color_background" value="<?php if($item['content']['background_type'] == 2) echo $item['content']['background'] ?>"/>
                                    </div>
                                    <div class="title_slot" id="title_slot_3"></div>
                                    <div class="id_slot" id="id_slot_3"><?php if($item['content']['background_type'] == 2) echo $item['content']['background'] ?></div>
                                    <div class="bt_efeitos_slot iframe" id="3" data-type="efeitos"></div>                    
                                </div>
                                <div class="clear"></div>
                                <div class="ctnColor">
                                    <span>Cor</span>
                                    <input name="cor_texture" type="text" id="cor_texture" class="color" value="<?php if($item['content']['background_color'] != "") echo $item['content']['background_color'] ?>" <?php if($item['content']['background_color'] != "") echo "style='background-color:". $item['content']['background_color'] . "'"?>/>
                                </div>
                            </div>

                            <div class="container_info_view" style="margin-left: 120px;">
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
                    <input type="hidden" name="type_background" id="type_background" value="<?php echo $item['content']['background_type'] ?>"/>
                </li>
            </ul>
        </fieldset>

    </div>

    <div id="blContainer_1">
        <ul> 
            <li class="rows">
                <div class="ctnRowProp">
                    <div class="txtProp">Título</div>
                    <div class="ctnAligment">
                        <span class="mgR left">Alinhamento</span>
                        <div class="styled-select left">
                            <select name="alinhamento_1" id="alinhamento_1">
                                <option value="left" <?php if($item['content']['alinhamento_1'] == "left") echo "selected" ?>>Esquerda</option>
                                <option value="center" <?php if($item['content']['alinhamento_1'] == "center") echo "selected" ?>>Centro</option>
                                <option value="right" <?php if($item['content']['alinhamento_1'] == "right") echo "selected" ?>>Direita</option>
                                <option value="justify" <?php if($item['content']['alinhamento_1'] == "justify") echo "selected" ?>>Justificado</option>
                            </select>
                        </div>
                    </div>
                    <div class="ctnColor">
                        <span>Cor</span>
                        <input name="cor_1" type="text" id="cor_1" class="color" value="<?php if($item['content']['cor_1'] != "") echo $item['content']['cor_1'] ?>" <?php if($item['content']['cor_1'] != "") echo "style='background-color:". $item['content']['cor_1'] . "'"?>/>
                    </div>
                </div>
                <div class="container_slot_checkbox">
                    <div class="text">
                        <input name="titulo_1" class="form fM" value="<?php if(isset($item['content']['titulo_1'])) echo $item['content']['titulo_1'] ?>" />
                        <span class="text fS"></span>
                    </div>
                </div>

            </li>
            <li class="rows">
                <div class="ctnRowProp">
                    <div class="txtProp">SubTítulo</div>
                    <div class="ctnAligment">
                        <span class="mgR left">Alinhamento</span>
                        <div class="styled-select left">
                            <select name="alinhamento_2" id="alinhamento_2">
                                <option value="left" <?php if($item['content']['alinhamento_2'] == "left") echo "selected" ?>>Esquerda</option>
                                <option value="center" <?php if($item['content']['alinhamento_2'] == "center") echo "selected" ?>>Centro</option>
                                <option value="right" <?php if($item['content']['alinhamento_2'] == "right") echo "selected" ?>>Direita</option>
                                <option value="justify" <?php if($item['content']['alinhamento_2'] == "justify") echo "selected" ?>>Justificado</option>
                            </select>
                        </div>
                    </div> 
                    <div class="ctnColor">
                        <span>Cor</span>
                        <input name="cor_2" type="text" id="cor_2" class="color" value="<?php if($item['content']['cor_2'] != "") echo $item['content']['cor_2'] ?>" <?php if($item['content']['cor_2'] != "") echo "style='background-color:". $item['content']['cor_2'] . "'"?>/>
                    </div>
                </div>
                <div class="container_slot_checkbox">
                    <div class="text">
                        <input name="subtitulo_1" class="form fM" value="<?php if(isset($item['content']['subtitulo_1'])) echo $item['content']['subtitulo_1'] ?>"/>
                        <span class="text fS"></span>
                    </div>
                </div>
                <div class="clear"></div>
            </li>
            <li class="rows">
                <div class="ctnRowProp">
                    <div class="txtProp">Texto</div>
                    <div class="ctnAligment">
                        <span class="mgR left">Alinhamento</span>
                        <div class="styled-select left">
                            <select name="alinhamento_3" id="alinhamento_3">
                                <option value="left" <?php if($item['content']['alinhamento_3'] == "left") echo "selected" ?>>Esquerda</option>
                                <option value="center" <?php if($item['content']['alinhamento_3'] == "center") echo "selected" ?>>Centro</option>
                                <option value="right" <?php if($item['content']['alinhamento_3'] == "right") echo "selected" ?>>Direita</option>
                                <option value="justify" <?php if($item['content']['alinhamento_3'] == "justify") echo "selected" ?>>Justificado</option>
                            </select>
                        </div>
                    </div>
                    <div class="ctnColor">
                        <span>Cor</span>
                        <input name="cor_3" type="text" id="cor_3" class="color" value="<?php if($item['content']['cor_3'] != "") echo $item['content']['cor_3'] ?>" <?php if($item['content']['cor_3'] != "") echo "style='background-color:". $item['content']['cor_3'] . "'"?>/>
                    </div> 
                </div>
                <div class="container_slot_checkbox">
                    <div class="ctn_checkbox">
                        <textarea name="texto_1" rows="6" class="fM"><?php if(isset($item['content']['texto_1'])) echo $item['content']['texto_1'] ?></textarea>
                        <span class="text fS"></span>
                    </div>
                </div>
            </li>
        
        </ul>
    </div>
    
    <div id="blContainer_2">
        <ul> 
            <li class="rows">
                <div class="ctnRowProp">
                    <div class="txtProp">Link</div>
                </div>
                <div class="container_slot_checkbox">
                    <div class="text">
                        <input name="link_1" class="form fM left mgR" value="<?php if(isset($item['content']['link_1'])) echo $item['content']['link_1'] ?>" style="width: 725px;"/>
                        <div class="styled-select">
                            <select name="link_target_1" id="link_target_1">
                                <option value="_self" <?php if(isset($item['content']['link_target_1'])  && ($item['content']['link_target_1'] == "_self" || $item['content']['link_target_1'] == "" ))  echo "selected" ?>>Abre na mesma aba</option>
                                <option value="_blank" <?php if(isset($item['content']['link_target_1']) && $item['content']['link_target_1'] == "_blank")   echo "selected" ?>>Abre nova aba</option>
                                <option value="_mailto" <?php if(isset($item['content']['link_target_1']) && $item['content']['link_target_1'] == "_mailto") echo "selected" ?>>Link de e-mail</option>
                            </select>
                        </div>                        
                    </div>
                </div>
            </li>
            <li class="rows">
                <div class="ctnRowProp">
                    <div class="txtProp">Layout</div>
                    <div class="ctnAligment">
                        <span class="mgR left">Posição da imagem</span>
                        <div class="styled-select left">
                            <select name="layout_1" id="layout_1">
                                <option value="up" <?php if($item['content']['layout_1'] == "up") echo "selected" ?>>Imagem em cima</option>
                                <option value="down" <?php if($item['content']['layout_1'] == "down") echo "selected" ?>>Imagem embaixo</option>
                            </select>
                        </div>
                    </div>

                </div>
            </li>
            <li class="rows">
                <div id="support_background_banners relative">       
                    <div class="column_settings_banners_left">
                        <div class="label_text_Admin">&nbsp;</div>
                        <div class="container_slot" id="4">
                            <div class="base_slot_container" id="base_4">
                                <div class="base_bt_select" title="Selecionar novo cool" id="4"></div>
                                <div class="base_bt_remove" title="Limpar slot" id="4"></div>
                            </div>
                            <div class="slot_launcher slot_page" id="slot_page_4">
                                <img id="slot_pict_id_4" src="" width="" height="" alt=""/>                        
                                <div id="slot_banner_id_4" class="relative"></div>
                                <div class="canvas_stage4" id="stage"></div>
                                <input type="hidden" value="<?php if(isset($item['content']['image_1'])) echo $item['content']['image_1'] ?>" id="submit_pict_id_4" name="image_1"/>
                            </div>
                            <div class="title_slot" id="title_slot_4"></div>
                            <div class="id_slot" id="id_slot_4"><?php if(isset($item['content']['image_1'])) echo $item['content']['image_1'] ?></div>
                            <div class="bt_fotos_slot bt_site" id="4" data-type="image"></div>                    
                        </div>
                        <div class="container_info_view" style="width: 500px">
                            <div class="container_info">
                                <div class="icon_information"></div>
                                <div class="titulo_column_info">Infos</div>
                            </div>
                            <div class="texto_column_info">
                                <div class="title_info_view"><h3>Image e textos</h3></div>
                                <div class="topic info_text_line">Selecione a imagem que deseja exibir no componente.</div>
                                <div class="topic info_text_line">Não ultrapasse a quantidade ideal de caracteres</div>
                                <div class="topic info_text_line">Caso necessite adicione um novo componente, o número é ilimitado</div>
                            </div>
                        </div>
                    </div>  
                </div>

            </li>
        </ul>
    </div>
    
</div>    

<div style="position: absolute; top: 110px; right: 90px; cursor: auto;" class="regular" id="dragger">
    <div id="bt_close_picker"></div>
    <div id="picker"></div>        
    <div class="form-item"></div>
</div>
<input type="hidden" id="color" name="color" value="#123456"/>
<script type="text/javascript">initSlotEditButton();$('#picker').farbtastic('#color');</script>
<?php if(isset($item['content']['image_1']) && $item['content']['image_1'] != ''){ ?>
<script type="text/javascript">applyPictureSize('<?php if(isset($item['content']['image_1'])) echo $item['content']['image_1'] ?>', 4, 'image', true);</script>
<?php } ?>