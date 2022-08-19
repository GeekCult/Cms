<script type="text/javascript" src="/js/lib/farbtastic.js"></script>
<link rel="stylesheet" href="/css/lib/farbtastic.css" type="text/css" media="screen" />
<h2><?php echo Yii::t("adminForm", "common_details") ?></h2>

<div id="menu_conta">
    <div class="menu_conta_container_buttons" style="right:0">
        <ul>
            <li id="link_conta_01" class="blc_tab" data-tab="0"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Geral</div><div class="tab_corner_disable_right"></div></li>
            <li id="link_conta_02" class="blc_tab" data-tab="1"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Conteúdo</div><div class="tab_corner_disable_right"></div></li>
            <li id="link_conta_02" class="blc_tab" data-tab="2"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Detalhes</div><div class="tab_corner_disable_right"></div></li>
            <li id="link_conta_02" class="blc_tab" data-tab="3"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle">Mais Detalhes</div><div class="tab_corner_disable_right"></div></li>
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
                        <div class="label_text_Admin">Tipo</div>
                        <div class="text">
                            <div class="styled-select2">
                                <select name="tipo_uso" id="tipo_uso">
                                    <option value="produtos" <?php if($item['content']['tipo_uso'] == 'produtos' || $item['content']['tipo_uso'] == "") echo "selected" ?>>Produtos</option>
                                    <option value="loja" <?php if($item['content']['tipo_uso'] == 'loja') echo "selected" ?>>Loja</option>
                                    <option value="auto" <?php if($item['content']['tipo_uso'] == 'auto') echo "selected" ?>>Veículos</option>
                                </select>
                            </div> 
                        </div>
                        <div class="clear mgB"></div>
                        <div class="label_text_Admin">Quantidade items</div>
                        <div class="text">
                            <input id="qtd_items" name="qtd_items" class="mini2" value="<?php if($item['content']['qtd_items'] != ''){echo $item['content']['qtd_items'];}else{echo '4';} ?>" type="number">
                        </div>
                        <div class="clear mgB"></div>
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
                        <div class="label_text_Admin">Padding - cima</div>
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
                    </div>



                    <div class="container_info_view">
                        <div class="container_info">
                            <div class="icon_information"></div>
                            <div class="titulo_column_info">Infos</div>
                        </div>
                        <div class="texto_column_info">
                            <div class="title_info_view"><h3>Dicas das informações gerais</h3></div>
                            <div class="topic info_text_line">Tipo - se o link direciona para produtos detalhes ou loja detalhes</div>
                            <div class="topic info_text_line">Qtd items - quantos blocos serão exibidos, de 1 a 4 não pode ser outro valor</div>
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
            <li class="rows">
                <div class="ctnRowProp">
                    <div class="txtProp">Label botão</div>
                    <div class="ctnAligment">
                        <span class="mgR left"></span>

                    </div> 

                </div>
                <div class="container_slot_checkbox">
                    <div class="text">
                        <input name="botao_label" class="form fM" value="<?php if(isset($item['content']['botao_label'])) echo $item['content']['botao_label'] ?>"/>
                        <span class="text fS"></span>
                    </div>
                </div>
                <div class="clear"></div>
            </li>

        </ul>
    </div>
    <div id="blContainer_2">
        <ul> 
            <li class="rows">
                <div id="support_background_banners relative">       
                    <div class="column_settings_banners_left">
                        <div class="label_text_Admin">&nbsp;</div>
                        <div class="container_slot" id="3">
                            <div class="ctnColor mgB" style="width: 230px">
                                <span style="width: 150px">Título exibir</span>
                                <input name="titulo_exibe" type="checkbox" id="titulo_exibe" <?php if($item['content']['titulo_exibe'] == 1 || $item['content']['titulo_exibe'] == "") echo "checked" ?> style="width: 15px; height: 15px;"/>
                            </div>
                            <div class="clear"></div>
                            <div class="ctnColor mgB" style="width: 230px">
                                <span style="width: 150px">Título item</span>
                                <input name="cor_titulo_item" type="text" id="cor_titulo_item" class="color" value="<?php if($item['content']['cor_titulo_item'] != "") echo $item['content']['cor_titulo_item'] ?>" <?php if($item['content']['cor_titulo_item'] != "") echo "style='background-color:". $item['content']['cor_titulo_item'] . "'"?>/>
                            </div> 
                            <div class="clear"></div>
                            <div class="ctnColor mgB" style="width: 230px">
                                <span style="width: 150px">Descrição item</span>
                                <input name="cor_descricao_item" type="text" id="cor_descricao_item" class="color" value="<?php if($item['content']['cor_descricao_item'] != "") echo $item['content']['cor_descricao_item'] ?>" <?php if($item['content']['cor_descricao_item'] != "") echo "style='background-color:". $item['content']['cor_descricao_item'] . "'"?>/>
                            </div>
                            <div class="clear"></div>
                            <div class="ctnColor" style="width: 230px">
                                <span style="width: 150px">Botão cor - 1</span>
                                <input name="cor_botao" type="text" id="cor_botao" class="color" value="<?php if($item['content']['cor_botao'] != "") echo $item['content']['cor_botao'] ?>" <?php if($item['content']['cor_botao'] != "") echo "style='background-color:". $item['content']['cor_botao'] . "'"?>/>
                            </div>
                            <div class="clear"></div>
                            <div class="ctnColor mgB" style="width: 230px">
                                <span style="width: 150px">Botão cor - 2</span>
                                <input name="cor_botao2" type="text" id="cor_botao2" class="color" value="<?php if($item['content']['cor_botao2'] != "") echo $item['content']['cor_botao2'] ?>" <?php if($item['content']['cor_botao2'] != "") echo "style='background-color:". $item['content']['cor_botao2'] . "'"?>/>
                            </div>
                            <div class="clear"></div>
                            <div class="ctnColor mgB" style="width: 230px">
                                <span style="width: 150px">Botão cor label</span>
                                <input name="cor_botao_label" type="text" id="cor_botao_label" class="color" value="<?php if($item['content']['cor_botao_label'] != "") echo $item['content']['cor_botao_label'] ?>" <?php if($item['content']['cor_botao_label'] != "") echo "style='background-color:". $item['content']['cor_botao_label'] . "'"?>/>
                            </div>
                            <div class="clear"></div>

                            <div class="ctnColor mgB" style="width: 230px">
                                <span style="width: 150px">Botão exibir</span>
                                <input name="botao_exibe" type="checkbox" id="botao_exibe" <?php if($item['content']['botao_exibe'] == 1 || $item['content']['botao_exibe'] == "") echo "checked" ?> style="width: 15px; height: 15px;"/>
                            </div>
                            <div class="clear"></div>
                            <div class="ctnColor mgB" style="width: 230px">
                                <span style="width: 150px">Botão avançar</span>
                                <input name="cor_avancar" type="text" id="cor_avancar" class="color" value="<?php if($item['content']['cor_avancar'] != "") echo $item['content']['cor_avancar'] ?>" <?php if($item['content']['cor_avancar'] != "") echo "style='background-color:". $item['content']['cor_avancar'] . "'"?>/>
                            </div>
                            <div class="clear"></div>
                            <div class="ctnColor mgB" style="width: 230px">
                                <span style="width: 150px">Paginação</span>
                                <input name="cor_paginacao" type="text" id="cor_paginacao" class="color" value="<?php if($item['content']['cor_paginacao'] != "") echo $item['content']['cor_paginacao'] ?>" <?php if($item['content']['cor_paginacao'] != "") echo "style='background-color:". $item['content']['cor_paginacao'] . "'"?>/>
                            </div>
                            <div class="clear"></div>
                            <div class="ctnColor mgB" style="width: 230px">
                                <span style="width: 150px">Paginação - Ativo</span>
                                <input name="cor_paginacao_ativo" type="text" id="cor_paginacao_ativo" class="color" value="<?php if($item['content']['cor_paginacao_ativo'] != "") echo $item['content']['cor_paginacao_ativo'] ?>" <?php if($item['content']['cor_paginacao_ativo'] != "") echo "style='background-color:". $item['content']['cor_paginacao_ativo'] . "'"?>/>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="container_info_view" style="width: 380px">
                            <div class="container_info">
                                <div class="icon_information"></div>
                                <div class="titulo_column_info">Infos</div>
                            </div>
                            <div class="texto_column_info">
                                <div class="title_info_view"><h3>Cor dos conteudos dos items</h3></div>
                                <div class="topic info_text_line">Troque a cor utilizando a paleta de cores</div>
                                <div class="topic info_text_line">Se deseja utilizar botão deixe ativo o checkbox "Botão exibe</div>
                                <div class="topic info_text_line">Os botões usam degrade, portanto precisam de duas cores</div>
                            </div>
                        </div>
                    </div>  
                </div>



            </li>
        </ul>
    </div>

    <div id="blContainer_3">
        <ul> 
            <li class="rows">
                <div class="ctnRowProp">
                    <div class="txtProp">Layout</div>                    
                </div>
                <div class="form-group">                        
                    <select name="layout_1" id="layout_1" class="form-control">
                        <option value="common" <?php if($item['content']['layout_1'] == "common" || $item['content']['layout_1'] == "") echo "selected" ?>>Tradicional</option>
                        <option value="lumi_light" <?php if($item['content']['layout_1'] == "lumi_light") echo "selected" ?>>Lumi Light</option>
                        <option value="mustang" <?php if($item['content']['layout_1'] == "mustang") echo "selected" ?>>Mustang - Ecommerce</option>
                        <option value="easy" <?php if($item['content']['layout_1'] == "easy") echo "selected" ?>>Clear</option>
                    </select>                       
                </div>
            </li>
            <li class="rows">
                <div id="support_background_banners">       
                    <div class="column_settings_banners_left">
                        <div class="label_text_Admin">
                            <p class="bt_image1_bg <?php if($item['content']['image_type_1'] == 1) echo 'active_p'; ?>" data-type="ctnSlotImage1Texture" data-type-id="1">Textura</p>
                            <div class="clear mgB"></div>
                            <p class="bt_image1_bg <?php if($item['content']['image_type_1'] == 0) echo 'active_p'; ?>" data-type="ctnSlotImage1Picture" data-type-id="0">Imagem</p>
                            <div class="clear mgB"></div>
                            <p class="bt_image1_bg <?php if($item['content']['image_type_1'] == 2) echo 'active_p'; ?>" data-type="ctnSlotImage1Color" data-type-id="2">Cor</p>
                        </div>

                        <div id="ctnSlotImage1Picture" class="ctnSlotRenderTyp left" style="<?php if($item['content']['image_type_1'] == 1 || $item['content']['image_type_1'] == 2) echo 'display:none'; ?>">
                            <div class="container_slot" id="4">
                                <div class="base_slot_container" id="base_4">
                                    <div class="base_bt_select" title="Selecionar novo cool" id="4"></div>
                                    <div class="base_bt_remove" title="Limpar slot" id="4"></div>
                                </div>
                                <div class="slot_launcher slot_page" id="slot_page_4">
                                    <img id="slot_pict_id_4" src="" width="" height="" alt=""/>
                                    <input type="hidden" id="submit_pict_id_4" name="image_1_background" value="<?php if($item['content']['image_type_1'] == 0) echo $item['content']['image_1'] ?>"/>
                                    <script type="text/javascript"><?php if($item['content']['image_type_1'] == 0 && $item['content']['image_1'] != ''){ ?>applyPictureSize('<?php echo $item['content']['image_1'] ?>', 4, 'image', true);<?php } ?></script>
                                </div>
                                <div class="title_slot" id="title_slot_4"></div>
                                <div class="id_slot" id="id_slot_4"><?php if($item['content']['image_type_1'] == 0) echo $item['content']['image_1'] ?></div>
                                <div class="bt_fotos_slot bt_fotos iframe" id="4" data-type="image"></div>                    
                            </div>
                        </div>

                        <div id="ctnSlotImage1Texture" style="<?php if($item['content']['image_type_1'] == 0 || $item['content']['image_type_1'] == 2) echo 'display:none'; ?>" class="ctnslotImgBl left">
                            <div class="container_slot" id="5">
                                <div class="base_slot_container" id="base_5">
                                    <div class="base_bt_select" title="Selecionar novo cool" id="5"></div>
                                    <div class="base_bt_remove" title="Limpar slot" id="5"></div>
                                </div>
                                <div class="slot_launcher slot_page pdL0" id="slot_page_5">
                                    <div id="slot_texture_id_5" class="ctnTextureDetail" style="padding-left: 20px; background: url(/media/images/textures/site/<?php if($item['content']['image_type_1'] == 1) echo $item['content']['image_1'] ?>)"></div>
                                    <input type="hidden" id="submit_texture_id_5" name="image_1_texture" value="<?php if($item['content']['image_type_1'] == 1) echo $item['content']['image_1'] ?>"/>
                                </div>
                                <div class="title_slot" id="title_slot_5"></div>
                                <div class="id_slot" id="id_slot_5"><?php if($item['content']['image_type_1'] == 1) echo $item['content']['image_1'] ?></div>
                                <div class="bt_textures_slot iframe" id="5" data-type="site"></div>                    
                            </div>
                        </div>

                        <div id="ctnSlotImage1Color" style="<?php if($item['content']['image_type_1'] == 1 || $item['content']['image_type_1'] == 0) echo 'display:none'; ?>" class="ctnslotImgBl left">
                            <div class="container_slot" id="6">
                                <div class="base_slot_container" id="base_6">
                                    <div class="base_bt_select" title="Selecionar novo cool" id="6"></div>
                                    <div class="base_bt_remove" title="Limpar slot" id="6"></div>
                                </div>
                                <div class="slot_launcher slot_page pdL0" id="slot_page_6">
                                    <div id="slot_texture_id_6" class="ctnTextureDetail" style="padding-left: 20px; background: url(/media/images/textures/efeitos/<?php if($item['content']['image_type_1'] == 2) echo $item['content']['image_1'] ?>)"></div>
                                    <input type="hidden" id="submit_texture_id_6" name="image_1_effect" value="<?php if($item['content']['image_type_1'] == 2) echo $item['content']['image_1'] ?>"/>
                                </div>
                                <div class="title_slot" id="title_slot_6"></div>
                                <div class="id_slot" id="id_slot_6"><?php if($item['content']['image_type_1'] == 2) echo $item['content']['image_color_1'] ?></div>
                                <div class="bt_efeitos_slot iframe" id="6" data-type="efeitos"></div>                    
                            </div>
                            <div class="clear"></div>
                            <div class="ctnColor">
                                <span>Cor</span>
                                <input name="image_1_color" type="text" id="image_1_color" class="color" value="<?php if($item['content']['image_color_1'] != "") echo $item['content']['image_color_1'] ?>" <?php if($item['content']['image_color_1'] != "") echo "style='background-color:". $item['content']['image_color_1'] . "'"?>/>
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
                <input type="hidden" name="type_image_1" id="type_image_1" value="<?php echo $item['content']['image_type_1'] ?>"/>
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