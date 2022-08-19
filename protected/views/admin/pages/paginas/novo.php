<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Editar página de conteúdo</h1>
        </div>
        <div class="bug_tracker"></div>
    </div> 
    <?php //if(Yii::app()->params['ramo'] == "educacao"){echo "editar_curso/".$id_user;}else{echo "listar";}?>
    <a href="/admin/<?php if($action == "novo_curso"){ echo "produtos/listar"; }else if($action == "editar_curso"){ echo "paginas/listar_curso/" . $id_curso;}else{echo "paginas/listar";} ?>" id="bt_list_page">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_list") ?>" />
    </a>
    <?php $query_allowed = $content['tipo'] != 'vazio' && $content['tipo'] != '' && $content['tipo'] != 'home' && $content['tipo'] != 'paginasavancadas' && $content['tipo'] != 'intro' && $content['tipo'] != 'contato' && $content['tipo'] != 'elearn' && $content['tipo'] != 'termos' && $content['tipo'] != 'redebeneficios' && $content['tipo'] != 'colunas' && $content['tipo'] != 'politica_privacidade' && $content['tipo'] != 'termos'  && $content['tipo'] != 'agenda'; ?>
    <?php $query_slots = $content['tipo'] == 'contato'; ?>
   
    <div class="bt_rigth_small" title="adicionar novo">        
        <a href="/admin/paginas/<?php if($action == "novo_curso"){echo "novo_curso";}else{echo "novo";}?>" id="bt_new">
            <?php echo Yii::t("adminForm", "button_common_add") ?>
        </a>
    </div>

    <fieldset class="adminFormContent">
        <h2>Textos</h2>
        <ul class="container_item_page">
           <?php if(Yii::app()->params['paginas_avancadas'] == 1){ ?>
            <li class="rows mgB">
                <div class="titleCombo">
                    <div class="label_text_Admin">Tipo:</div>
                    <div class="text">
                        <div class="styled-select2">
                            <select id="type_layout" size="1" name="type_layout">                                
                                <option value="0" selected>Comum</option>
                                <option value="1">Avançado</option> 
                                <option value="2">Mix</option>
                            </select>
                        </div>
                    </div>
                </div>
            <?php } ?>    
            </li>
            <li class="rows">
                <div class="titleCombo">
                    <div class="label_text_Admin">Nome:</div>
                    <div class="text">
                        <input id="name" type="text" class="form" size="30" value="<?php if($content['label'] != "Vazio")echo $content['label'] ?>"/>
                    </div>
                </div>
                <div class="titleIndex">
                    <div class="label_text_Admin">Index:</div>
                    <div class="text">
                        <input id="index" type="text" class="form" size="5" value="<?php echo $content['n_index'] ?>"/>
                    </div>
                </div> 
            </li>
            <?php if($action != "novo_curso"){ ?>
            <li class="rows" id="page_settings">
                <div class="label_text_Admin">Exibir:</div>
                <div class="menus_support">
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">menu 1</div>
                        <input type="checkbox" id="menu_principal" name="menu_principal" <?php if($content['menu_principal'] == 1) echo "checked" ?> class="check_select"/>
                    </div>
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">menu 2</div>
                        <input type="checkbox" id="menu_2" name="menu_2" <?php if($content['menu_2'] == 1) echo "checked" ?> class="check_select"/>
                    </div>
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">menu 3</div>
                        <input type="checkbox" id="menu_3" name="menu_3" <?php if($content['menu_3'] == 1) echo "checked" ?> class="check_select"/>
                    </div>  
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">banner principal</div>
                        <input type="checkbox" id="banner_exibe" <?php if($content['banner_exibe'] == 1) echo "checked" ?> class="check_select" name="banner_exibe"/>
                    </div>
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">dicas</div>
                        <input type="checkbox" id="dica_exibe" <?php if($content['dica_exibe'] == 1) echo "checked" ?> class="check_select" name="dica_exibe"/>
                    </div>
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">redes sociais</div>
                        <input type="checkbox" id="network_exibe" <?php if($content['network_exibe'] == 1) echo "checked" ?> class="check_select" name="network_exibe"/>
                    </div>
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">grupo</div>
                        <input type="checkbox" id="main_for_group" <?php if($content['main_for_group'] == 1) echo "checked" ?> class="check_select" name="main_for_group"/>
                    </div>
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">breadcrumb</div>
                        <input type="checkbox" id="breadcrumb_exibe" <?php if($content['breadcrumb_exibe'] == 1) echo "checked" ?> class="check_select" name="breadcrumb_exibe"/>
                    </div>
                </div>
                <div class="label_text_Admin">Link especial</div>
                <div class="menus_support">
                    <div class="text">
                        <input type="text" id="link_special" value="<?php echo $content['link_special'] ?>"/>
                    </div>
                </div>
                <div class="label_text_Admin">Titulo página</div>
                <div class="menus_support">
                    <div class="text">
                        <input type="text" id="titulo_pagina" value="<?php if(isset($content['titulo_pagina']))echo $content['titulo_pagina'] ?>"/>
                    </div>
                </div>
                <div class="label_text_Admin">Extra</div>
                <div class="menus_support">
                    <div class="text">
                        <input type="text" id="galeria_usuarios" value="<?php if(isset($attributes['galeria_usuarios']))echo $attributes['galeria_usuarios'] ?>"/>
                    </div>
                </div>
            </li>
            <?php } ?>
            <li class="rows">
                <div class="label_text_Admin">Frase:</div>
                <div class="text">
                    <input id="phrase" type="text" class="form" value="<?php echo $content['titulo'] ?>"/>
                </div>
            </li>
            
            <li class="rows_template">
                <div class="ctn_carousel_template">
                    <div class="bt_box_quarter_arrow_left"></div>
                    <div id="ctn_template_slider">
                        <?php if(isset($templates[0]['qtd'])){ $i = 0; foreach ($templates as $values){ $str = substr($values['thumb'], 0, strrpos($values['thumb'], '.')); ?>
                        <div class="container_templates_boundingbox <?php if($str == $content['layout']) echo 'active' ?>" id="tpl_img_<?php echo $values['id'] ?>"><?php if ($values['thumb'] != "") { ?>
                            <img src="/media/images/layout_pages/<?php echo $values['thumb'] ?>" alt="<?php echo $values['cool']." ".$values['thumb'] ?>" title="<?php echo $values['titulo'] ?>" id="img_<?php echo $values['id'] ?>"/>
                            <?php } else { ?>
                            <img src="/media/images/layout/missing/missing_200x90.jpg" alt="missing" title="<?php echo Yii::t("messageForm", "message_no_picture"); ?>"/>
                            <?php } ?>
                            <div class="clear"></div>                            
                        </div>
                        <?php $i++; }} ?>
                    </div>
                    <div class="bt_box_quarter_arrow_right"></div>
                    <script type="text/javascript">initListenerModuleNoticiasSlider("<?php if(isset($templates[0]['qtd'])) echo $templates[0]['qtd'] ?>");</script>
                </div>
                <div class="clear"></div>
                <input type="hidden" value="1" id="helper_qtd_news_slider"/>
                <input type="hidden" value="item_quarter" id="helper_item_layout_news"/>
            </li>
            
            <li class="rows" id="page_tips">
                <div class="label_text_Admin">Titulo Dica:</div>
                <div class="text">
                    <input id="dica_titulo" type="text" class="form" value="<?php echo $attributes['dica_titulo'] ?>"/>
                </div>
                <p>&nbsp;</p>
                <div class="label_text_Admin">SubTítulo dica:</div>
                <div class="text">
                    <input id="dica_subtitulo" type="text" class="form" value="<?php echo $attributes['dica_subtitulo'] ?>"/>
                </div>
                <p>&nbsp;</p>
                <div class="label_text_Admin">Texto dica:</div>
                <div class="text">
                    <textarea id="dica_texto" rows="8" cols="" class="form"><?php echo $attributes['dica_texto'] ?></textarea>
                </div>
            </li>
            <li class="rows" id="page_video">
                <div class="label_text_Admin">Video:</div>
                <div class="text">
                    <textarea id="video_1" rows="5" cols="" class="form"><?php echo $attributes['video_1'] ?></textarea>
                </div>
                <p>&nbsp;</p>
                <div class="label_text_Admin">Video:</div>
                <div class="text">
                    <textarea id="video_2" rows="5" cols="" class="form"><?php echo $attributes['video_2'] ?></textarea>
                </div>
                <p>&nbsp;</p>
                <div class="label_text_Admin">Video:</div>
                <div class="text">
                    <textarea id="video_3" rows="5" cols="" class="form"><?php echo $attributes['video_3'] ?></textarea>
                </div>
            </li>
            <li class="rows_margins">
                <div class="buttons_right">
                    <input type="button" class="bt_right" id="bt_show_templates" value="<?php echo Yii::t("adminForm", "button_common_show_templates") ?>"/>  
                    <input type="button" class="bt_right" id="bt_show_videos" value="<?php echo Yii::t("adminForm", "button_common_video") ?>"/>        
                    <input type="button" class="bt_right" id="bt_show_tips" value="<?php echo Yii::t("adminForm", "button_common_tips") ?>"/> 
                    <input type="button" class="bt_right" id="bt_show_settings" value="<?php echo Yii::t("adminForm", "common_menu_settings") ?>"/> 
                </div>
            </li>
        </ul>
        <!-- GENERAL -->
        <div class="<?php if($query_allowed) echo 'hide' ?>" >
            <ul class="container_item_page">
                <li class="rows">
                    <div class="label_text_Admin">Titulo 01:</div>
                    <div class="text">
                        <input id="titulo_01" type="text" class="form" value="<?php echo $content['titulo_01'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin">SubTítulo 01:</div>
                    <div class="text">
                        <input id="subtitulo_01" type="text" class="form" value="<?php echo $content['subtitulo_01'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin">Texto 01:</div>
                    <div class="text">
                        <textarea id="texto_01" rows="8" cols="" class="form"><?php echo $content['texto_01'] ?></textarea>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin">Link 01:</div>
                    <div class="titleComboLink">
                        <div class="text">
                            <input id="label_link_01" type="text" class="form" size="20" value="<?php echo $content['label_link_01'] ?>"/>
                        </div>
                    </div>
                    <div class="titleLinkCombo">
                        <div class="label_text_Link">digite:</div>
                        <div class="text">
                            <input id="link_01" type="text" class="form" size="5" value="<?php echo $content['link_01'] ?>"/>
                        </div>
                    </div>
                    <div class="label_text_Admin_Link">escolha</div>
                    <div class="text">
                        <select id="select_link_01" class="styled" size="1" name="select_link_01">
                            <option value="<?php if($content['link_01']  != ""){echo $content['link_01'];}else{ echo "/produtos/listar";} ?>"><?php if($content['link_01']  != ""){echo $content['link_01'];}else{ echo "Produtos";} ?></option>
                            <option value="/materias">Materias</option>
                            <option value="/contato">Contato</option>
                            <option value="/blog">Blog</option>
                            <option value="/orcamento">Orçamento</option>
                        </select>
                    </div>
                </li>
            </ul>
            <ul class="<?php echo $content['visibility2'] ?> container_item_page">
                <li class="rows">
                    <div class="label_text_Admin">Titulo 02:</div>
                    <div class="text">
                        <input id="titulo_02" type="text" class="form" value="<?php if(isset($content['titulo_02']))echo $content['titulo_02'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                        <div class="label_text_Admin">SubTítulo 02:</div>
                        <div class="text">
                            <input id="subtitulo_02" type="text" class="form" value="<?php echo $content['subtitulo_02'] ?>"/>
                        </div>
                    </li>
                <li class="rows">
                    <div class="label_text_Admin">Texto 02:</div>
                    <div class="text">
                        <textarea id="texto_02" rows="8" class="form"><?php echo $content['texto_02'] ?></textarea>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin">Link 02:</div>
                    <div class="titleComboLink">
                        <div class="text">
                            <input id="label_link_02" type="text" class="form" size="20" value="<?php echo $content['label_link_02'] ?>"/>
                        </div>
                    </div>
                    <div class="titleLinkCombo">
                        <div class="label_text_Link">digite:</div>
                        <div class="text">
                            <input id="link_02" type="text" class="form" size="5" value="<?php echo $content['link_02'] ?>"/>
                        </div>
                    </div>
                    <div class="label_text_Admin_Link">escolha</div>
                    <div class="text">
                        <select id="select_link_02" class="styled" size="1" name="select_link_02">
                            <option value="<?php if($content['link_02']  != ""){echo $content['link_02'];}else{ echo "/produtos/listar";} ?>"><?php if($content['link_02']  != ""){echo $content['link_02'];}else{ echo "Produtos";} ?></option>
                            <option value="/materias">Materias</option>
                            <option value="/contato">Contato</option>
                            <option value="/blog">Blog</option>
                            <option value="/orcamento">Orçamento</option>
                        </select>
                    </div>
                </li>
            </ul>
            <ul class="<?php echo $content['visibility3'] ?> container_item_page">
                <li class="rows">
                    <div class="label_text_Admin">Titulo 03:</div>
                    <div class="text">
                        <input id="titulo_03" type="text" class="form" value="<?php echo $content['titulo_03'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                        <div class="label_text_Admin">SubTítulo 03:</div>
                        <div class="text">
                            <input id="subtitulo_03" type="text" class="form" value="<?php echo $content['subtitulo_03'] ?>"/>
                        </div>
                    </li>
                <li class="rows">
                    <div class="label_text_Admin">Texto 03:</div>
                    <div class="text">
                        <textarea id="texto_03" rows="8" class="form"><?php echo $content['texto_03'] ?></textarea>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin">Link 03:</div>
                    <div class="titleComboLink">
                        <div class="text">
                            <input id="label_link_03" type="text" class="form" size="20" value="<?php echo $content['label_link_03'] ?>"/>
                        </div>
                    </div>
                    <div class="titleLinkCombo">
                        <div class="label_text_Link">digite:</div>
                        <div class="text">
                            <input id="link_03" type="text" class="form" size="5" value="<?php echo $content['link_03'] ?>"/>
                        </div>
                    </div>
                    <div class="label_text_Admin_Link">escolha</div>
                    <div class="text">
                        <select id="select_link_03" class="styled" size="1" name="select_link_03">
                            <option value="<?php if($content['link_03']  != ""){echo $content['link_03'];}else{ echo "/produtos/listar";} ?>"><?php if($content['link_03']  != ""){echo $content['link_03'];}else{ echo "Produtos";} ?></option>
                            <option value="/materias">Materias</option>
                            <option value="/contato">Contato</option>
                            <option value="/blog">Blog</option>
                            <option value="/orcamento">Orçamento</option>
                        </select>
                    </div>
                </li>
            </ul>
            <ul class="<?php echo $content['visibility4'] ?> container_item_page">
                <li class="rows">
                    <div class="label_text_Admin">Titulo 04:</div>
                    <div class="text">
                        <input id="titulo_04" type="text" class="form" value="<?php echo $content['titulo_04'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                        <div class="label_text_Admin">SubTítulo 04:</div>
                        <div class="text">
                            <input id="subtitulo_04" type="text" class="form" value="<?php echo $content['subtitulo_04'] ?>"/>
                        </div>
                    </li>
                <li class="rows">
                    <div class="label_text_Admin">Texto 04:</div>
                    <div class="text">
                        <textarea id="texto_04" rows="8" class="form"><?php echo $content['texto_04'] ?></textarea>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin">Link 04:</div>
                    <div class="titleComboLink">
                        <div class="text">
                            <input id="label_link_04" type="text" class="form" size="20" value="<?php echo $content['label_link_04'] ?>"/>
                        </div>
                    </div>
                    <div class="titleLinkCombo">
                        <div class="label_text_Link">digite:</div>
                        <div class="text">
                            <input id="link_04" type="text" class="form" size="5" value="<?php echo $content['link_04'] ?>"/>
                        </div>
                    </div>
                    <div class="label_text_Admin_Link">escolha</div>
                    <div class="text">
                        <select id="select_link_04" class="styled" size="1" name="select_link_04">
                            <option value="<?php if($content['link_04']  != ""){echo $content['link_04'];}else{ echo "/produtos/listar";} ?>"><?php if($content['link_04']  != ""){echo $content['link_04'];}else{ echo "Produtos";} ?></option>
                            <option value="/materias">Materias</option>
                            <option value="/contato">Contato</option>
                            <option value="/blog">Blog</option>
                            <option value="/orcamento">Orçamento</option>
                        </select>
                    </div>
                </li>
            </ul>
            <ul class="<?php echo $content['visibility5'] ?> container_item_page">
                <li class="rows">
                    <div class="label_text_Admin">Titulo 05:</div>
                    <div class="text">
                        <input id="titulo_05" type="text" class="form" value="<?php echo $content['titulo_05'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                        <div class="label_text_Admin">SubTítulo 05:</div>
                        <div class="text">
                            <input id="subtitulo_05" type="text" class="form" value="<?php echo $content['subtitulo_05'] ?>"/>
                        </div>
                    </li>
                <li class="rows">
                    <div class="label_text_Admin">Texto 05:</div>
                    <div class="text">
                        <textarea id="texto_05" rows="8" class="form" ><?php echo $content['texto_05'] ?></textarea>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin">Link 05:</div>
                    <div class="titleComboLink">
                        <div class="text">
                            <input id="label_link_05" type="text" class="form" size="20" value="<?php echo $content['label_link_05'] ?>"/>
                        </div>
                    </div>
                    <div class="titleLinkCombo">
                        <div class="label_text_Link">digite:</div>
                        <div class="text">
                            <input id="link_05" type="text" class="form" size="5" value="<?php echo $content['link_05'] ?>"/>
                        </div>
                    </div>
                    <div class="label_text_Admin_Link">escolha</div>
                    <div class="text">
                        <select id="select_link_05" class="styled" size="1" name="select_link_05">
                            <option value="<?php if($content['link_05']  != ""){echo $content['link_05'];}else{ echo "/produtos/listar";} ?>"><?php if($content['link_05']  != ""){echo $content['link_05'];}else{ echo "Produtos";} ?></option>
                            <option value="/materias">Materias</option>
                            <option value="/contato">Contato</option>
                            <option value="/blog">Blog</option>
                            <option value="/orcamento">Orçamento</option>
                        </select>
                    </div>
                </li>
            </ul>
            <ul class="<?php echo $content['visibility6'] ?> container_item_page">
                <li class="rows">
                    <div class="label_text_Admin">Titulo 06:</div>
                    <div class="text">
                        <input id="titulo_06" type="text" class="form" value="<?php echo $content['titulo_06'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin">SubTítulo 06:</div>
                    <div class="text">
                        <input id="subtitulo_06" type="text" class="form" value="<?php echo $content['subtitulo_06'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin">Texto 06:</div>
                    <div class="text">
                        <textarea id="texto_06" rows="8" class="form"><?php echo $content['texto_06'] ?></textarea>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin">Link 06:</div>
                    <div class="titleComboLink">
                        <div class="text">
                            <input id="label_link_06" type="text" class="form" size="20" value="<?php echo $content['label_link_06'] ?>"/>
                        </div>
                    </div>
                    <div class="titleLinkCombo">
                        <div class="label_text_Link">digite:</div>
                        <div class="text">
                            <input id="link_06" type="text" class="form" size="5" value="<?php echo $content['link_06'] ?>"/>
                        </div>
                    </div>
                    <div class="label_text_Admin_Link">escolha</div>
                    <div class="text">
                        <select id="select_link_06" class="styled" size="1" name="select_link_06">
                            <option value="<?php if($content['link_06']  != ""){echo $content['link_06'];}else{ echo "/produtos/listar";} ?>"><?php if($content['link_06']  != ""){echo $content['link_06'];}else{ echo "Produtos";} ?></option>
                            <option value="/materias">Materias</option>
                            <option value="/contato">Contato</option>
                            <option value="/blog">Blog</option>
                            <option value="/orcamento">Orçamento</option>
                        </select>
                    </div>
                </li>
            </ul>
        </div>
        <ul id="dublin_core">
            <h4 class="subtitle_admin">Google - Buscas organicas</h4>
            <li class="rows hide">
                <div class="label_text_Admin">Identificador</div>
                <div class="text">
                    <input id="dc_identificator" class="form" value="<?php echo $attributes['dc_identificator'] ?>" placeholder="URI"/>
                </div>
            </li>
            <li class="rows hide">
                <div class="label_text_Admin">Formato</div>
                <div class="text">
                    <input id="dc_format" class="form" value="<?php echo $attributes['dc_format'] ?>" placeholder="DCterms:IMT"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Idioma</div>
                <div class="text">
                    <input id="dc_language" class="form" value="<?php echo $attributes['dc_language'] ?>" placeholder="PT"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Criador</div>
                <div class="text">
                    <input id="dc_creator" class="form" value="<?php echo $attributes['dc_creator'] ?>" placeholder="Carlos Garcia"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Assunto</div>
                <div class="text">
                    <input id="dc_subject" class="form" value="<?php echo $attributes['dc_subject'] ?>" placeholder="Assunto da página"/>
                </div>
            </li>
           <li class="rows">
                <div class="label_text_Admin">Publicado por</div>
                <div class="text">
                    <input id="dc_publisher" class="form" value="<?php echo $attributes['dc_publisher'] ?>" placeholder="PurplePier ME"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Publicador e-mail</div>
                <div class="text">
                    <input id="dc_email" class="form" value="<?php echo $attributes['dc_email'] ?>" placeholder="contato@purplepier.com.br"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Contribuído por</div>
                <div class="text">
                    <input id="dc_contributor" class="form" value="<?php echo $attributes['dc_contributor'] ?>" placeholder="Paula Beatriz"/>
                </div>
            </li>
            <li class="rows hide">
                <div class="label_text_Admin">Data de criação</div>
                <div class="text">
                    <input id="dc_date" class="form" value="<?php echo $attributes['dc_date'] ?>" placeholder="2014-12-24"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Relacionado com</div>
                <div class="text">
                    <input id="dc_relation" class="form" value="<?php echo $attributes['dc_relation'] ?>" placeholder="artigo, capítulo do livro"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Recurso localizado em</div>
                <div class="text">
                    <input id="dc_coverage" class="form" value="<?php echo $attributes['dc_coverage'] ?>" placeholder="PurplePier ME, USP, Campinas"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Direitos Autorais</div>
                <div class="text">
                    <input id="dc_copyright" class="form" value="<?php echo $attributes['dc_copyright'] ?>" placeholder="Direitos Autorais 2014, Carlos Garcia, todos os direitos reservados"/>
                </div>
            </li>
        </ul>
        
        <ul id="redesociais_fields">
            <h4 class="subtitle_admin">Facebook - e outras redes sociais</h4>
            <li class="rows">
                <div class="label_text_Admin">Título</div>
                <div class="text">
                    <input id="rds_titulo" class="form" value="<?php echo $attributes['fb_titulo'] ?>" placeholder="Título"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Descrição</div>
                <div class="text">
                    <textarea id="rds_descricao" class="form" placeholder="Descrição do que será exibido no Facebook"><?php echo $attributes['fb_texto'] ?></textarea>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Descrição</div>
                <div class="text">
                    <div class="container_slot" id="12">
                        <div class="base_slot_container" id="base_12">
                            <div class="base_bt_edit" title="Editar cool" id="<?php //echo $slots['container_'.$i]; ?>"></div>
                            <div class="base_bt_select" title="Selecionar novo cool" id="<?php //echo $slots['container_'.$i]; ?>"></div>
                            <div class="base_bt_remove" title="Limpar slot" id="12"></div>
                        </div>
                        <div class="slot_launcher slot_page" id="slot_page_12">
                            <img  id="slot_pict_id_12" src="" width="" height="" alt=""/>
                            <input type="hidden" id="submit_pict_id_12" name="image_background" value="<?php if($attributes['fb_slot_1'] != '') echo $attributes['fb_slot_1'] ?>"/>
                            <?php if(true == true){ ?>
                            <script type="text/javascript"><?php if($attributes['fb_slot_1'] != ''){ ?>applyPictureSize('<?php echo $attributes['fb_slot_1'] ?>', 12, 'image', true);<?php } ?></script>
                            <?php } ?>
                            <div id="slot_banner_id_12" class="relative"></div>
                            <div class="canvas_stage12" id="stage"></div>
                        </div>
                        <div class="title_slot" id="title_slot_12"></div>
                        <div class="id_slot" id="id_slot_12"></div>
                        <div class="iframe bt_fotos_slot" id="12"></div>                    
                    </div>
                </div>
                <div class="clear"></div>
                <p>&nbsp;</p>
            </li>                   
        </ul>
        
        <ul>            
            <li class="rows <?php if($action == "novo_curso") echo "hide" ?>">
                <div class="label_text_Admin">Descrição:</div>
                <div class="text">
                    <textarea id="keywords" rows="4" class="form"><?php echo $content['keywords'] ?></textarea>
                </div>
            </li>
            <li class="rows">
                <div class="container_message_errors"> 
                    <div class="message_errors">                   
                        <div id="cc-error-screen-content">                           
                            <ul class="content_error">Todos os campos devem ser preenchidos!</ul>
                        </div>                  
                    </div>
                </div>
            </li>
            <div>
                <li class="rows_center">
                    <div class="buttons_right">
                        <input type="button" class="bt_right <?php if($query_allowed) echo 'hide' ?>" id="bt_add_field" value="<?php echo Yii::t("adminForm", "button_common_add_field") ?>"/>
                        <?php if($content['tipo'] != 'materias' && $content['tipo'] != 'eventos' && $content['tipo'] != 'blog'){ ?>
                        <input type="button" class="bt_right" id="bt_dublin_core" value="Google"/> 
                        <input type="button" class="bt_right" id="bt_redes_sociais" value="Facebook"/>
                        <?php } ?>
                    </div>
              
                </li>
            </div>
        </ul>
    </fieldset>
    <div class="clear"></div>
 
    <!-- MATERIAS -->
    <?php if($content['tipo'] == 'materias' || $content['tipo'] == 'colunas' || $content['tipo'] == 'blog'){ ?>
    <fieldset class="adminFormContent">
        <h2>Mais detalhes</h2>
        <ul class="container_item_page">
            <li class="rows">
                <div class="label_text_Admin">Qtd Links:</div>
                <div class="text">
                    <div class="styled-select-small">
                        <select name="materia_link_recomentados_qtd" id="materia_link_recomentados_qtd" class="font08">
                            <option value="4" <?php if($page_prop['mat_lk_rcn_qtd'] == 4) echo 'selected' ?>>4</option>
                            <option value="10" <?php if($page_prop['mat_lk_rcn_qtd'] == 10) echo 'selected' ?>>10</option>
                            <option value="20" <?php if($page_prop['mat_lk_rcn_qtd'] == 20) echo 'selected' ?>>20</option>
                            <option value="30" <?php if($page_prop['mat_lk_rcn_qtd'] == 30) echo 'selected' ?>>30</option>
                        </select>
                    </div>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Qtd Blocos:</div>
                <div class="text">
                    <div class="styled-select-small">
                        <select name="materia_link_recomentados_blocos" id="materia_link_recomentados_blocos" class="font08">
                            <option value="4" <?php if($page_prop['mat_lk_rcn_blc'] == 4) echo 'selected' ?>>4</option>
                            <option value="8" <?php if($page_prop['mat_lk_rcn_blc'] == 8) echo 'selected' ?>>8</option>
                            <option value="12" <?php if($page_prop['mat_lk_rcn_blc'] == 12) echo 'selected' ?>>12</option>
                            <option value="16" <?php if($page_prop['mat_lk_rcn_blc'] == 16) echo 'selected' ?>>16</option>
                        </select>
                    </div>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Exibir links por:</div>
                <div class="text">
                    <div class="styled-select2">
                        <select name="materia_link_recomentados_afinidade" id="materia_link_recomentados_afinidade" class="font08">
                            <option value="afinidade" <?php if($page_prop['mat_lk_rcn_afi'] == 'afinidade') echo 'selected' ?>>Afinidade</option>
                            <option value="todos" <?php if($page_prop['mat_lk_rcn_afi'] == 'todos') echo 'selected' ?>>Todos</option>
                        </select>
                    </div>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Qtd publicidade:</div>
                <div class="text">
                    <div class="styled-select2">
                        <select name="materia_link_recomentados_publicidade" id="materia_link_recomentados_publicidade" class="font08">
                            <option value="1" <?php if($page_prop['mat_lk_rcn_adv'] == 1) echo 'selected' ?>>1</option>
                            <option value="3" <?php if($page_prop['mat_lk_rcn_adv'] == 3) echo 'selected' ?>>3</option>
                            <option value="5" <?php if($page_prop['mat_lk_rcn_adv'] == 5) echo 'selected' ?>>5</option>
                            <option value="10" <?php if($page_prop['mat_lk_rcn_adv'] == 10) echo 'selected' ?>>10</option>
                        </select>
                    </div>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Tamanho imagens:</div>
                <div class="text mgR2">
                    <div class="styled-select2 left mgR">
                        <select name="mat_lk_rcn_img" id="mat_lk_rcn_img" class="font08">
                            <option value="" <?php if($page_prop['mat_lk_rcn_adv'] == '') echo 'selected' ?>>Padrão</option>
                            <option value="100" <?php if($page_prop['mat_lk_rcn_adv'] == 100) echo 'selected' ?>>100</option>
                            <option value="200" <?php if($page_prop['mat_lk_rcn_adv'] == 200) echo 'selected' ?>>200</option>
                            <option value="300" <?php if($page_prop['mat_lk_rcn_adv'] == 300) echo 'selected' ?>>300</option>
                            <option value="400" <?php if($page_prop['mat_lk_rcn_adv'] == 400) echo 'selected' ?>>400</option>
                            <option value="500" <?php if($page_prop['mat_lk_rcn_adv'] == 500) echo 'selected' ?>>500</option>
                            <option value="600" <?php if($page_prop['mat_lk_rcn_adv'] == 600) echo 'selected' ?>>600</option>
                        </select>
                    </div>                 
                </div>
                <span class="legend">Tamanho que será exibido as imagens</span>
            </li>
        </ul>
    </fieldset>
    <?php } ?>
    
    <!-- General -->
    <fieldset class="adminFormContent">
        <h2>Detalhes</h2>      
        <ul class="container_item_page">
            <li class="rows">
                <div class="label_text_Admin">Chamada inicial</div>
                <div class="text">
                    <input id="chamada_inicial" type="text" class="form" value="<?php echo $page_prop['gel_fr_initial'] ?>"/>
                </div>
            </li>
        </ul>
    </fieldset>
    
    <!-- GALERIA -->
    <?php if($content['tipo'] == 'galeria'){ ?>
    <fieldset class="adminFormContent">
        <h2>Mais detalhes</h2>
        <ul class="container_item_page">
            <li><h4>Detalhes</h4></li>
            <li class="rows">
                <div class="label_text_Admin">Frase detalhes:</div>
                <div class="text">
                    <input type="input" id="gal_frase_details" name="gal_frase_details" value="<?php echo $page_prop['gal_fr_dt'] ?>"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Subtítulo detalhes:</div>
                <div class="text">
                    <input type="input" id="gal_subfrase_details" name="gal_subfrase_details" value="<?php echo $page_prop['gal_subfr_dt'] ?>"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Exibe data:</div>
                <div class="checkbox">
                    <input type="checkbox" id="gal_date_exibe" name="gal_date_exibe" <?php if($page_prop['gal_date'] == 1) echo 'checked' ?>/>                    
                </div>
            </li>
        </ul>
    </fieldset>
    <?php } ?>
    
    <!-- EVENTOS -->
    <?php if($content['tipo'] == 'eventos'){ ?>
    <fieldset class="adminFormContent">
        <h2>Mais detalhes</h2>
        <ul class="container_item_page">
            <li><h4>Detalhes</h4></li>
            <li class="rows">
                <div class="label_text_Admin">Frase detalhes:</div>
                <div class="text">
                    <input type="input" id="evt_frase_details" name="evt_frase_details" value="<?php echo $page_prop['evt_fr_dt'] ?>"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Título profissionais:</div>
                <div class="text">
                    <input type="input" id="evt_frase_profissionais" name="evt_frase_profissionais" value="<?php echo $page_prop['evt_fr_prof'] ?>" class="medium"/>                    
                </div>
                <span class="legend_input">Título que é exibido para a galeria de profissionais: Palestrantes, Coordenadores, Professores, Monitores e etc...</span>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Tipo inscrição:</div>
                <div class="left" style="width:100px;">
                    <span class="fS left">Login</span>
                    <div class="checkbox" style="margin: -3px 0 0 0;">
                        <input type="radio" name="evt_form_type" <?php if($page_prop['evt_form_type'] == "login" || $page_prop['evt_form_type'] == '') echo 'checked' ?> value="login"/>                    
                    </div>
                </div>
                <div class="left">
                    <span class="fS left">Formulário</span>
                    <div class="checkbox" style="margin: -3px 0 0 0;">
                        <input type="radio" name="evt_form_type" <?php if($page_prop['evt_form_type'] == "formulario") echo 'checked' ?> value="formulario"/>                    
                    </div>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Exibe data:</div>
                <div class="checkbox left mgR2">
                    <input type="checkbox" id="evt_date_exibe" name="evt_date_exibe" <?php if($page_prop['evt_date'] == 1) echo 'checked' ?>/>                    
                </div>
                <span class="legend">Escolha se seu layout irá exibir a data dos eventos</span>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Utilizar calendário:</div>
                <div class="checkbox left mgR2">
                    <input type="checkbox" id="evt_calendario_exibe" name="evt_calendario_exibe" <?php if($page_prop['evt_calendario_exibe'] == 1) echo 'checked' ?>/>                    
                </div>
                <span class="legend">Se marcado será enviado um e-mail ao inscrito com os dados do evento como: Data, Hora, Local e etc</span>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Formulário aberto:</div>
                <div class="checkbox left mgR2">
                    <input type="checkbox" id="evt_formulario_open" name="evt_formulario_open" <?php if($page_prop['evt_formulario_open'] == 1) echo 'checked' ?>/>                    
                </div>
                <span class="legend">Escolha se seu formulário irá iniciar aberto ou fechado</span>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Tamanho imagens:</div>
                <div class="text mgR2">
                    <div class="styled-select2 left mgR">
                        <select name="evt_img_size" id="evt_img_size" class="font08">
                            <option value="" <?php if($page_prop['evt_img_size'] == '') echo 'selected' ?>>Padrão</option>
                            <option value="100" <?php if($page_prop['evt_img_size'] == 100) echo 'selected' ?>>100</option>
                            <option value="200" <?php if($page_prop['evt_img_size'] == 200) echo 'selected' ?>>200</option>
                            <option value="300" <?php if($page_prop['evt_img_size'] == 300) echo 'selected' ?>>300</option>
                            <option value="400" <?php if($page_prop['evt_img_size'] == 400) echo 'selected' ?>>400</option>
                            <option value="500" <?php if($page_prop['evt_img_size'] == 500) echo 'selected' ?>>500</option>
                            <option value="600" <?php if($page_prop['evt_img_size'] == 600) echo 'selected' ?>>600</option>
                        </select>
                    </div>                 
                </div>
                <span class="legend">Tamanho que será exibido as imagens</span>
            </li>
        </ul>
    </fieldset>
    <?php } ?>
    
    <!-- PRODUTOS -->
    <?php if($content['tipo'] == 'produtos' || $content['tipo'] == 'produtos_detalhes'){ ?>
    <fieldset class="adminFormContent">
        <h2>Mais detalhes</h2>
        <ul class="container_item_page">
            <li><h4>Detalhes</h4></li>
            <li class="rows">
                <div class="label_text_Admin">Qtd Itens detalhes:</div>
                <div class="text">
                    <input type="input" id="prod_qtd_vitrine" name="prod_qtd_vitrine" value="<?php echo $page_prop['prod_qtd_vitrine'] ?>" class="small"/>                    
                </div>
            </li>
        </ul>
    </fieldset>
    <?php } ?>
    
    <!-- SEJA FORNECEDOR -->
    <?php if($content['tipo'] == 'fornecedor'){ ?>
    <fieldset class="adminFormContent">
        <h2>Mais detalhes</h2>
        <ul class="container_item_page">
            <li><h4>Detalhes</h4></li>
            <li class="rows">
                <div class="label_text_Admin">Chamada insumos</div>
                <div class="text">
                    <input type="input" id="forn_phrase" name="forn_phrase" value="<?php echo $page_prop['forn_phrase'] ?>" class="form"/>                    
                </div>
            </li>
            <li><h4>Precisa-se</h4></li>
            <li class="rows">
                <div class="label_text_Admin">Produtos</div>
                <div class="text">
                    <div class="table_support" style="margin:0px">
                        <table border="0" ali gn="center" cellpadding="2" cellspacing="4" width="100%" id="table_estoque">
                            <thead>
                                <tr class="title_table">
                                    <td width="1%"  ></td>
                                   
                                    <td width="20%" ><?php echo Yii::t("adminForm", "common_product") ?></td>
                                    
                                    <td width="1%" align="center" colspan="1"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
                                </tr>
                            </thead>
                            <tbody class="container_items_store">

                            </tbody>
                            <tfoot>
                                <tr class="footer_table">
                                    <td width="1%"  ></td>
                                   
                                    <td width="20%" >
                                        <div class="container_payment_size"> 
                                            <div class="styled-select">
                                                <select id="tamanho" name="tamanho">
                                                    <option value="0">Escolha</option>
                                                    <?php foreach ($page_prop['insumos'] as $values) { ?>
                                                    <option value="<?php echo $values['id'] ?>"><?php echo $values['nome'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <!--
                                    <td width="20%" >
                                        <div class="styled-select2">
                                            <select id="colors" name="cor">
                                                <option value="0">Unidade</option>
                                                <option value="1">Unidade(s)</option>
                                                <option value="2">Caixa(s)</option>
                                                <option value="3">Litro(s)</option>
                                                <option value="4">Metro(s)</option>  
                                                <option value="5">Kilo(s)</option>
                                            </select>
                                        </div>
                                    </td> -->
                             
                                    <td width="1%" align="center" colspan="1">
                                        <input type="button" value="+" id="bt_add_attribute" class="botao"/>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <p>&nbsp;</p>
                        <table border="0" align="center" cellpadding="2" cellspacing="4" width="100%" id="table_estoque_edit">
                            <thead>
                                <tr class="title_table">
                                    <td width="1%"  ></td>
                                    
                                    <td width="20%" ><?php echo Yii::t("adminForm", "common_menu_size") ?></td>
                              
                                    <td width="10%" ><?php echo Yii::t("adminForm", "common_menu_acrescimo") ?></td>
                                    <td width="1%" align="center"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
                                </tr>
                            </thead>
                            <tbody class="container_items_store_edit">

                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" id="referencia" value="0"/>
                    <input type="hidden" id="value_plus" value="0"/>
                    <input type="hidden" id="qtd" value="0"/>
                    <input type="hidden" id="n_index" value="0"/>
                    <input type="hidden" id="id_produto" value="0"/>
                    <input type="hidden" id="id_categoria" value="0"/>
                    <script type="text/javascript">setTimeout(function(){setEstoqueProdutos('<?php echo json_encode($page_prop['content']) ?>');},1000);</script>
                </div>
            </li>
        </ul>
    </fieldset>
    <?php } ?>
    
    <!-- CONTATO -->
    <?php if($content['tipo'] == 'contato'){ ?>
    <fieldset class="adminFormContent">
        <h2>Mais detalhes</h2>
        <ul class="container_item_page">
            <li><h4>Detalhes de Endereço</h4></li>
            <li class="rows">
                <div class="label_text_Admin">Nome da empresa:</div>
                <div class="text">
                    <input type="input" id="ctt_company_name" name="ctt_company_name" value="<?php echo $page_prop['ctt_company_name'] ?>" class="giant"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Endereço:</div>
                <div class="text">
                    <input type="input" id="ctt_address" name="ctt_address" value="<?php echo $page_prop['ctt_address'] ?>" class="giant"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Telefone 1:</div>
                <div class="text">
                    <input type="input" id="ctt_tel_1" name="ctt_tel_1" value="<?php echo $page_prop['ctt_tel_1'] ?>" class="small"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Telefone 2:</div>
                <div class="text">
                    <input type="input" id="ctt_tel_2" name="ctt_tel_2" value="<?php echo $page_prop['ctt_tel_2'] ?>" class="small"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Fax:</div>
                <div class="text">
                    <input type="input" id="ctt_fax" name="ctt_fax" value="<?php echo $page_prop['ctt_fax'] ?>" class="small"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Celular:</div>
                <div class="text">
                    <input type="input" id="ctt_celular" name="ctt_celular" value="<?php echo $page_prop['ctt_celular'] ?>" class="small"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Cidade:</div>
                <div class="text">
                    <input type="input" id="ctt_cidade" name="ctt_cidade" value="<?php echo $page_prop['ctt_cidade'] ?>" class="giant"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Estado:</div>
                <div class="text">
                    <input type="input" id="ctt_estado" name="ctt_estado" value="<?php echo $page_prop['ctt_estado'] ?>" class="small"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Site:</div>
                <div class="text">
                    <input type="input" id="ctt_site" name="ctt_site" value="<?php echo $page_prop['ctt_site'] ?>" class="giant"/>                    
                </div>
            </li>
        </ul>
    </fieldset>
    <?php } ?>
    
    <!-- Depoimentos -->
    <?php if($content['tipo'] == 'depoimentos'){ ?>
    <fieldset class="adminFormContent">
        <h2>Mais detalhes</h2>
        <ul class="container_item_page">
            <li><h4>Detalhes</h4></li>
            <li class="rows">
                <div class="label_text_Admin">Título:</div>
                <div class="text">
                    <input type="input" id="titulo_depoimento" name="titulo_depoimento" value="<?php echo $page_prop['titulo_depoimento'] ?>" class="giant"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">SubTítulo:</div>
                <div class="text">
                    <input type="input" id="subtitulo_depoimento" name="subtitulo_depoimento" value="<?php echo $page_prop['subtitulo_depoimento'] ?>" class="giant"/>                    
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Dica:</div>
                <div class="text">
                    <textarea id="descricao_depoimento" name="descricao_depoimento"><?php echo $page_prop['descricao_depoimento'] ?></textarea>                    
                </div>
            </li>
        </ul>
    </fieldset>
    <?php } ?>
    
    <div>
        <fieldset class="adminFormContent" id="slots_support">
            <h2>Banner</h2>
            <ul id="slot_banner" style="width:900px">
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "page_paginas_label_5") ?></div>
                    <div class="container_banner_pages container_slot" id="0">
                        <div class="base_banner_container" id="base_0">
                            <div class="base_banner_bt_edit" title="Editar cool" id="<?php if(isset($slots['banner'])) echo $slots['banner']; ?>"></div>
                            <div class="base_banner_bt_select" title="Selecionar novo cool" id="<?php if(isset($slots['banner']))echo $slots['banner']; ?>"></div>
                            <div class="base_banner_bt_remove" title="Limpar slot" id="0"></div>
                        </div>

                        <div class="slot_page_0_top"></div>
                        <div class="slot_launcher slot_banner" id="slot_page_0">                        
                            <img  id="slot_pict_id_0" src="" width="" height="" alt=""/>
                            <div id="slot_banner_id_0"></div>
                            <div class="canvas_stage0" id="stage"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="slot_launcher bt_banner_slot" id="0"></div>
                        <div class="slot_page_0_bottom"></div>
                        <div class="title_slot" id="title_slot_0" id="<?php if(isset($slots['banner']) && $slots['banner'] != "") echo $slots['banner']; ?>"></div>
                        <div class="id_slot" id="id_slot_0"></div>
                        <div class="clear"></div>
                       <!-- <div class="slot_launcher zoom_slot" id="0"></div>-->
                    </div>
                </li>
            </ul>
            <div class="clear"></div>
            <div id="fancybox_gallery_launcher"class="iframe helper_tamanho_fake"></div>
            <div id="fancybox_banner_launcher" class="iframe helper_tamanho_fake"></div>
            <div id="fancybox_images_launcher" class="iframe helper_tamanho_fake"></div>
            <div id="fancybox_htmlbanners_launcher" class="iframe helper_tamanho_fake"></div>
        </fieldset>
    </div>
    <!-- GENERAL -->
    <div class="<?php if($query_allowed || $query_slots) echo 'hide' ?>">
        <fieldset class="adminFormContent" id="slots_support">
            <h2>Imagens</h2>
            
            <ul id="slot_support">
                <?php for ($i = 1; $i < 11; $i++){ ?>            
                <li class="cols">
                    <?php  if($i == 1 || $i == 6){?>
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "page_paginas_label_3") ?></div>
                    <?php } ?>
                    <div class="container_slot" id="<?php echo $i ?>">
                        <div class="base_slot_container" id="base_<?php echo $i ?>">
                            <div class="base_bt_edit" title="Editar cool" id="<?php if(isset($slots['container_'.$i])) echo $slots['container_'.$i]; ?>"></div>
                            <div class="base_bt_select" title="Selecionar novo cool" id="<?php if(isset($slots['container_'.$i])) echo $slots['container_'.$i]; ?>"></div>
                            <div class="base_bt_remove" title="Limpar slot" id="<?php echo $i ?>"></div>
                        </div>
                        <div class="slot_launcher slot_page" id="slot_page_<?php echo $i ?>">
                            <img  id="slot_pict_id_<?php echo $i ?>" src="" width="" height="" alt=""/>
                            <div id="slot_banner_id_<?php echo $i ?>" class="relative"></div>
                            <div class="canvas_stage<?php echo $i; ?>" id="stage"></div>
                        </div>
                        <div class="title_slot" id="title_slot_<?php echo $i ?>"></div>
                        <div class="id_slot" id="id_slot_<?php echo $i ?>"></div>
                        <div class="iframe bt_fotos_slot" id="<?php echo $i ?>"></div>                    
                    </div>
                </li>
                <?php } ?>
                <?php if($action != "novo_curso"){ ?>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "page_paginas_label_6") ?></div>
                    <div class="container_slot" id="11">
                        <div class="base_slot_container" id="base_11">
                            <div class="base_bt_edit" title="Editar cool" id="11"></div>
                            <div class="base_bt_select" title="Selecionar novo cool" id="11"></div>
                            <div class="base_bt_remove" title="Limpar slot" id="11"></div>
                        </div>
                        <div class="slot_launcher slot_page" id="slot_page_11">
                            <img id="slot_pict_id_11" src="<?php echo $content['icon']?>" width="" height="" alt="" name="icon"/>
                            <div id="slot_banner_id_11"></div>
                            <div class="canvas_stage11" id="stage"></div>
                        </div>
                        <div class="title_slot" id="title_slot_11"></div>
                        <div class="id_slot" id="id_slot_11"></div>
                        <div class="iframe bt_fotos_slot" id="11"></div>                    
                    </div>
                </li>
                <?php } ?>
                <li class="rows">
                    <div class="label_text_Admin"></div>
                    <p>&nbsp;</p>
                </li>
            </ul>
            <ul>
                <h2>Cadastrar imagem</h2>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "page_paginas_label_4") ?></div>
                    <div class="text">
                        <input type="button" class="bt_cadastrar_fotos_fancy iframe" id="bt_upload" value="" name="cool"/>
                    </div>
                </li>
            </ul>
        </fieldset>
    </div>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">        
        <?php if($action == "novo"){ ?>
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_submit") ?>" />
        <?php } else { ?>
         <input type="button" class="bt_right" id="bt_update" value="<?php echo Yii::t("adminForm", "button_common_update") ?>" />
        <?php } ?>
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_clear") ?>" />
    </div>
    <div class="clear height_support"></div>
   
    <div class="menu_shortcut">
        <ul>
            <?php if($action == "novo"){ ?>
            <li><input type="button" class="iSM icon_save" id="bt_submit"/></li>
            <?php } else { ?>
            <li><input type="button" class="iSM icon_save" id="bt_update"/></li>
            <?php }  ?>
            <li>
                <a href="/admin/<?php if($action == "novo_curso"){ echo "produtos/"; }else{ echo "paginas/";} ?>listar">
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
    <input id="id_page_helper" type="hidden" value="<?php echo $id_page ?>"/>
    <input id="id_user_helper" type="hidden" value="<?php echo $id_user ?>"/>
    <input id="action_helper" type="hidden" value="<?php echo $action ?>"/>
    <input id="helper_special_page" value="<?php echo $action ?>" type="hidden"/>
    <input id="helper_controller" type="hidden" value="<?php echo $content['controller'] ?>"/>
    <input id="helper_layout" type="hidden" value="<?php echo $content['layout'] ?>"/>
    <input id="helper_type_page" type="hidden" value="<?php if($content['tipo'] != 'vazio') echo $content['tipo']; ?>"/>
    <input type="hidden" id="helper_width" value="760"/>
    <input type="hidden" id="helper_height" value=""/>
    <input type="hidden" id="helper_font" value="5"/><?php // valor promorcional ao tamanho do slot tipo será divido 7 vezes ?>
    <input type="hidden" id="helper_resize" value="8"/>
    <input type="hidden" id="helper_id_slot" value=""/>
    <input type="hidden" id="helper_type_fotos" value="images"/>
    <input type="hidden" id="helper_miniSiteUser" value="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteUser'] ?>" data-url="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteUrl'] . "/media/user/images/thumbs_120/" ?>" data-remote="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteRemote'] ?>"/>
</div>
<script type="text/javascript">initSlotEditButton()</script>
<?php if($action == "editar" || $action == "editar_curso"){ ?>
<script type="text/javascript">setEditSlots(<?php echo json_encode($slots) ?>); setLastFieldText(<?php echo $content['num'] ?>);</script>
<?php } ?>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>