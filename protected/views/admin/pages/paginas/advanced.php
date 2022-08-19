<div class="ctnBlockTemplates">
    <div class="ctnAdvTotal">
        <div class="titleAdv"><h2>Blocos de conteúdo</h2></div>
        <div class="bt_close_black right" style="margin: 10px 20px 0 0"></div>
        <div class="clear"></div>
        <div class="ctnAdvCenter">
         
            <input type="button" id="bt_edit_template" class="bt_ear_up_big right" value="<?php echo Yii::t("adminForm", "button_common_edit") ?>"/>
            <input type="button" id="bt_choose_template" class="bt_ear_up_big right" value="<?php echo Yii::t("adminForm", "button_common_templates") ?>"/>
         
            <div class="clear"></div>
        </div>
        <div class="divider_horizontal" style="padding:0px;"></div>
        
        <div id="ctnChooseTemplate" class="ctnAdvCenter">
            <?php include Yii::app()->getBasePath() . '/views/admin/pages/paginas/content/item_blocks.php'; ?>
        </div>
        
        <div id="ctnEditTemplate" style="display: none;">
            <div class="ctnAdvCenter" style="min-height: 600px;">
                <form id="form_content">
                    <div id="ctnEditView"></div>
                </form>
            </div>
            <div class="buttons_right">        
                <input type="button" class="bt_right" id="bt_save_advanced" value="<?php echo Yii::t("adminForm", "button_common_save") ?>" />
                <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_clear") ?>" />
            </div>  
            <div class="clear height_support"></div> 
        </div>
        
    </div>
    <div class="clear"></div> 
</div>
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
    <?php if($action != "novo"){ ?>
    <div class="bt_rigth_small" title="adicionar novo">        
        <a href="/admin/paginas/<?php if($action == "novo_curso"){echo "novo_curso";}else{echo "novo";}?>" id="bt_new">
            <?php echo Yii::t("adminForm", "button_common_add") ?>
        </a>
    </div>
    <?php } ?>

    <fieldset class="adminFormContent">
        <div id="fancybox_images_launcher" class="iframe helper_tamanho_fake"></div>
        <div id="fancybox_textures_launcher" class="iframe"></div>
        <div id="fancybox_icones_launcher" class="iframe"></div>
        <div id="fancybox_efeitos_launcher" class="iframe"></div>
        <h2>Textos</h2>
        <ul class="container_item_page">
            <li class="rows mgB">
                <div class="titleCombo">
                    <div class="label_text_Admin">Tipo:</div>
                    <div class="text">
                        <div class="styled-select2">
                            <select id="type_layout" size="1" name="type_layout">                                
                                <option value="0">Comum</option>
                                <option value="1" selected>Avançado</option>  
                                <option value="2">Mix</option>
                            </select>
                        </div>
                    </div>
                </div>
                
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
                        <input type="checkbox" id="menu_3" name="menu_3"<?php if($content['menu_3'] == 1) echo "checked" ?> class="check_select"/>
                    </div>  
                    <div class="menu_checkbox">
                        <div class="menu_checkbox_label">banner principal</div>
                        <input type="checkbox" id="banner_exibe" name="banner_exibe"  <?php if($content['banner_exibe'] == 1) echo "checked" ?> class="check_select" name="banner_exibe"/>
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
            </li>
            <?php } ?>
            <li class="rows">
                <div class="label_text_Admin">Frase:</div>
                <div class="text">
                    <input id="phrase" type="text" class="form" value="<?php echo $content['titulo'] ?>"/>
                </div>
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
            <li class="rows_margins">
                <div class="buttons_right">
                    <input type="button" class="bt_right" id="bt_show_tips" value="<?php echo Yii::t("adminForm", "button_common_tips") ?>"/>
                    <input type="button" class="bt_right" id="bt_show_settings" value="<?php echo Yii::t("adminForm", "common_menu_settings") ?>"/>
                </div>
            </li>
            
            <!-- GENERAL -->
            <div class="hide">
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
            
            <li class="rows <?php if($action == "novo_curso") echo "hide" ?>">
                <div class="label_text_Admin">Descricao:</div>
                <div class="text">
                    <textarea id="keywords" rows="4" class="form"><?php echo $content['keywords'] ?></textarea>
                </div>
            </li>
            <div class="mgB2">
                <li class="rows_center mgT2">
                    <div class="buttons_right"> 
                        <input type="button" class="bt_right" id="bt_dublin_core" value="Google"/>
                        <input type="button" class="bt_right" id="bt_redes_sociais" value="Facebook"/>
                    </div>
                </li>
            </div>
            <p>&nbsp;</p>
            <li class="rows">
                <div class="container_message_errors"> 
                    <div class="message_errors">                   
                        <div id="cc-error-screen-content">                           
                            <ul class="content_error">Todos os campos devem ser preenchidos!</ul>
                        </div>                  
                    </div>
                </div>
            </li>
            <li class="rows_margins height_auto width_auto">
                <div class="table_support" style="margin: 0px 0px 0px -10px; width: 750px">
                    <table border="0" align="center" cellpadding="2" cellspacing="4" width="100%" id="table_blocks">
                        <thead>
                            <tr class="title_table">
                                <td></td>
                                <td>Template</td>
                                <td>Tipo</td>
                                <td align="center">Índice</td>
                                <td align="center">Exibe</td>
                                <td align="center" colspan="3">Editar</td>
                            </tr>
                        </thead>
                        <tbody id="template_block">
                            <?php if($templates){ $color = '0'; foreach($templates as $values){ ?> 
                            <tr id="item_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
                                <td width="1%"><img src='/media/images/icons/icon_mais.png'/></td>
                                <td width="10%"><div class="truncate"><?php if($values['titulo_componente'] != ''){echo $values['titulo_componente'];}else{echo $values['titulo'];}?></div></td>
                                <td width="10%"><?php echo $values['tipo'] ?></td>
                                <td width="2%" align="center"><input type="text" value="<?php echo $values['n_index'] ?>" class="txt_center mini v_indice" data-id_item="<?php echo $values['id'] ?>"/></td>
                                <td width="2%" align="center"><input id="<?php echo $values['id'] ?>" type="checkbox" class='bt_exibe_row' <?php if($values['exibe']) echo 'checked' ?> name="exibe_row_<?php echo $values['id'] ?>" value="true"/></td>
                                <td width="1%" align="center">
                                    <input id="<?php echo $values['id'] ?>" class="bt_ver" type="button" title="visualizar item">
                                </td>
                                <td width="1%" align="center">
                                    <input id="<?php echo $values['id'] ?>" class="bt_edit" type="button" title="editar item" data-id_componente="<?php echo $values['id_componente'] ?>">
                                </td>
                                <td width="1%" align="center">
                                    <input id="<?php echo $values['id'] ?>" class="bt_delete" type="button" title="excluir item">
                                </td>
                            </tr>
                            <?php if($color == "1"){$color = "0"; }else{$color = "1";};}} ?>
                        </tbody>
                    </table>
                    
                </div>
                <div class="clear"></div>
            </li>
            <li class="rows_margins">
                
                <div class="buttons_right txt_center">
                    <p>&nbsp;</p>
                    <input type="button" class="botao" id="bt_add_block" value="adicionar"/>  
                    
                </div>
            </li>
        </ul>
    </fieldset>
    
    <div class="hide">
        <fieldset class="adminFormContent" id="slots_support">
            <h2>Slot Graphics</h2>
            <ul id="slot_banner">
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "page_paginas_label_5") ?></div>
                    <div class="container_banner_pages container_slot" id="0">
                        <div class="base_banner_container" id="base_0">
                            <div class="base_banner_bt_edit" title="Editar cool" id="<?php if(isset($slots['banner'])) echo $slots['banner']; ?>"></div>
                            <div class="base_banner_bt_select" title="Selecionar novo cool" id="<?php if(isset($slots['banner'])) echo $slots['banner']; ?>"></div>
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
                        <div class="title_slot" id="title_slot_0" id="<?php if(isset($slots['banner']) && $slots['banner']!= "")echo $slots['banner']; ?>"></div>
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
    <p>&nbsp;</p>
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
    <input id="helper_id_user" type="hidden" value="<?php echo "0" ?>"/>
    <input id="helper_id_componente" type="hidden" value=""/>
    <input id="helper_id_row" type="hidden" value="0"/>
    <input id="helper_action" type="hidden" value="<?php echo $action ?>"/>
    <input id="helper_special_page" value="<?php echo $action ?>" type="hidden"/>
    <input id="helper_controller" type="hidden" value="<?php echo $content['controller'] ?>"/>
    <input id="helper_type_color_use" type="hidden" value="advanced"/>
    <input id="helper_layout" type="hidden" value="<?php echo $content['layout'] ?>"/>
    <input id="helper_type_page" type="hidden" value="<?php if($content['tipo'] != 'vazio') echo $content['tipo']; ?>"/>
    <input type="hidden" id="helper_miniSiteUser" value="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteUser'] ?>" data-url="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteUrl'] . "/media/user/images/thumbs_120/" ?>" data-remote="<?php if(isset($miniSiteUser)) echo $miniSiteUser['miniSiteRemote'] ?>"/>
</div>

<script type="text/javascript">initSlotEditButton()</script>
<?php if($action == "editar" || $action == "new_page"){ ?>
<script type="text/javascript">setEditSlots(<?php if(isset($slots)) echo json_encode($slots) ?>); setLastFieldText(<?php if(isset($content['num'])) echo $content['num'] ?>);</script>
<?php } ?>

<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>