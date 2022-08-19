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
            <?php include Yii::app()->getBasePath() . '/views/admin/pages/materias/comum/content/item_blocks.php'; ?>
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
            <h1><?php echo $attributes['title'] ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/<?php echo $attributes['controller'] ?>/listar">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_list"); ?>"/> 
    </a>
    <a href="/admin/<?php echo $attributes['controller'] ?>/novo" id="bt_new">
        <div class="bt_rigth_small" title="adicionar novo">
            <?php echo Yii::t("adminForm", "button_common_add") ?>
        </div>
    </a>
    <p>&nbsp;</p>
    <div class="clear"></div>
    <div class="ctnAdvCenter" style="z-index:1">  
        <input type="button" id="bt_edit_component" class="bt_ear_up_big right" value="<?php echo Yii::t("adminForm", "common_components") ?>"/>
        <input type="button" id="bt_edit_content" class="bt_ear_up_big right" value="<?php echo Yii::t("adminForm", "common_content") ?>"/>            
        <div class="clear"></div>
    </div>
    <div class="divider_horizontal" style="padding:0px;"></div>

    <fieldset class="adminFormContent" id="slots_support">
        <ul>
            <?php if ($attributes['controller'] == "colunas" || $attributes['controller'] == "noticias" || $attributes['controller'] == "wiki") { ?>
            <li class="rows mgB">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "common_category") ?></div>
                <div class="combo_categorias_fotos">
                    <div class="styled-select">
                        <select name="categoria" id="categoria" size="1" >
                            <?php foreach ($categorias as $values) { ?>
                            <option value="<?php echo $values['id'] ?>" <?php if($values['id'] == $content['id_categoria'] ) echo "selected"; ?>><?php echo $values['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="text_add_categoria">
                    <a href="#" id="fancybox_category_launcher" class="iframe"><span class="badge3"><?php echo Yii::t("adminForm", "button_common_add_gallery"); ?></span></a>
                </div>
            </li>
            <?php } else {?>
            <input type="hidden" id="categoria" value="0" name="categoria"/>
            <?php } ?>
            <li class="rows mgT">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "materia_page_label_title"); ?></div>
                <div class="text">
                    <input id="title" type="text" class="form" size="" value="<?php echo $content['titulo'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "materia_page_label_subtitle"); ?></div>
                <div class="text">
                   <textarea cols="" rows="3" id="subtitulo"><?php echo $content['subtitulo'] ?></textarea>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "materia_page_label_materia"); ?></div>
                <div class="text">
                    <textarea cols="" rows="18" id="materia"><?php echo $content['materia'] ?></textarea>
                </div>
            </li>
            <li class="rows <?php if($attributes['controller'] != "novidades" && $attributes['controller'] != "dicas"){echo "no-display";}?>">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "common_link_special"); ?></div>
                <div class="text">
                    <input id="link_special" type="text" class="text_middle left mgR" value="<?php echo $content['link_special'] ?>"/>
                    <div class="example">Ex: /noticias/listar/123</div>
                </div>
            </li>
            <li class="rows <?php if($attributes['controller'] != "novidades" && $attributes['controller'] != "dicas"){echo "no-display";}?>">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "materia_page_label_data"); ?></div>
                <div class="text">
                    <input id="data_article" type="text" class="small" value="<?php echo $content['data_novidade'] ?>"/>
                    <div class="example">Ex: 12/05/2012</div>
                </div>
            </li>            
            <li class="rows <?php if($attributes['controller'] == "dicas"){echo "no-display";}?>">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "materia_page_label_keywords"); ?></div>
                <div class="text">
                    <textarea cols="" rows="4" id="keywords"><?php echo $content['keywords'] ?></textarea>
                </div>
            </li>
            <?php if ($attributes['controller'] == "colunas"){?>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "materia_page_label_colunista"); ?></div>
                <div class="text">
                    <div class="styled-select">
                        <select name="colunista" id="colunista" size="1">
                            <?php if(count($colunistas) > 0){ for ($i = 0 ; $i < count($colunistas); $i++) { ?>
                            <option value="<?php echo $colunistas[$i]['id'] ?>" <?php if($colunistas[$i]['id'] == $content['id_colunista'] ) echo "selected"; ?>><?php echo $colunistas[$i]['field1'] . " " . $colunistas[$i]['field2'] ?></option>
                            <?php }} ?>
                        </select>
                    </div>
                </div>
            </li>
            <?php } else { ?>
            <input type="hidden" id="colunista" value="" name="colunista"/>
            <?php }  ?>
            <li class="rows">
                <div class="container_message_errors"> 
                    <div class="message_errors">                   
                        <div id="cc-error-screen-content">                           
                            <ul class="content_error">Todos os campos devem ser preenchidos!</ul>
                        </div>                  
                    </div>
                </div>
            </li>
        </ul>   
        
        <ul id="redesociais_fields">
            <h4 class="subtitle_admin">Facebook - e outras redes sociais</h4>
            <li class="rows">
                <div class="label_text_Admin">Título</div>
                <div class="text">
                    <input id="rds_titulo" class="form" value="<?php echo $content['titulo_fb'] ?>" placeholder="Título"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Descrição</div>
                <div class="text">
                    <textarea id="rds_descricao" class="form" placeholder="Descrição do que será exibido no Facebook"><?php echo $content['descricao_fb'] ?></textarea>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Descrição</div>
                <div class="text">
                    <div class="container_slot" id="12">
                        <div class="base_slot_container" id="base_12">
                            <div class="base_bt_edit" title="Editar cool" id="<?php echo $content['foto_fb']; ?>"></div>
                            <div class="base_bt_select" title="Selecionar novo cool" id="<?php echo $content['foto_fb']; ?>"></div>
                            <div class="base_bt_remove" title="Limpar slot" id="12"></div>
                        </div>
                        <div class="slot_launcher slot_page" id="slot_page_12">
                            <img  id="slot_pict_id_12" src="" width="" height="" alt=""/>
                            <input type="hidden" id="submit_pict_id_12" name="image_background" value="<?php if($content['foto_fb'] != '') echo $content['foto_fb'] ?>"/>
                            <?php if(true == true){ ?>
                            <script type="text/javascript"><?php if($content['foto_fb'] != ''){ ?>applyPictureSize('<?php echo $content['foto_fb'] ?>', 12, 'image', true);<?php } ?></script>
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
        
        <ul id="detalhes_fields">
            <h4 class="subtitle_admin">Detalhes</h4>
            <li class="rows">
                <div class="label_text_Admin">Chamada</div>
                <div class="text">
                    <input type="text" class="form" id="chamada" value="<?php echo $content['chamada'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Destaque</div>
                <div class="text">
                    <div class="styled-select">
                        <select name="destaque" id="destaque">
                            <option value="1" <?php if($content['destaque'] == "1" || $content['destaque'] == '') echo 'selected' ?>>Simples</option>
                            <option value="2" <?php if($content['destaque'] == "2") echo 'selected' ?>>Destaque</option>  
                            <option value="3" <?php if($content['destaque'] == "3") echo 'selected' ?>>Super Destaque</option>
                        </select>
                    </div>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Tema</div>
                <div class="text">
                    <div class="styled-select">
                        <select name="cor" id="cor">
                            <option value="" <?php if($content['cor'] == "") echo 'selected' ?>>Branco</option>
                            <option value="red_dark_gradient" <?php if($content['cor'] == "red_dark_gradient") echo 'selected' ?>>Vermelho bordo</option>
                            <option value="blue_light_gradient" <?php if($content['cor'] == "blue_light_gradient") echo 'selected' ?>>Azul piscina</option>  
                            <option value="gray_dark_gradient" <?php if($content['cor'] == "gray_dark_gradient") echo 'selected' ?>>Cinza escuros</option> 
                            <option value="purple_gradient" <?php if($content['cor'] == "purple_gradient") echo 'selected' ?>>Roxo</option>
                            <option value="black_gradient" <?php if($content['cor'] == "black_gradient") echo 'selected' ?>>Preto</option>
                            <option value="green_gradient" <?php if($content['cor'] == "green_gradient") echo 'selected' ?>>Verde</option>
                            <option value="yellow_gradient" <?php if($content['cor'] == "yellow_gradient") echo 'selected' ?>>Amarelo</option>
                            <option value="mustard_gradient" <?php if($content['cor'] == "mustard_gradient") echo 'selected' ?>>Amarelo Mostarda</option>
                        </select>
                    </div>
                </div>
            </li> 
            <li class="rows">
                <div class="label_text_Admin">Modelo</div>
                <div class="text">
                    <div class="styled-select">
                        <select name="modelo" id="modelo">
                            <option value="" <?php if($content['modelo'] == "") echo 'selected' ?>>Comum</option>
                            <option value="facebook_md" <?php if($content['modelo'] == "facebook_md") echo 'selected' ?>>Facebook</option>
                            <option value="publicidade_md" <?php if($content['modelo'] == "publicidade") echo 'selected' ?>>Publicidade</option>  
                           
                        </select>
                    </div>
                </div>
            </li> 
            <li class="rows">
                <div class="label_text_Admin">Exibir</div>
                <div class="text">
                    <input type="checkbox" class="checkbox left" id="exibe" name="exibe" <?php if($content['exibe']) echo 'checked' ?>/>
                    <a href="#" class="tip_trigger" style="position: relative; float: left; top:-5px; margin: 0 10px;"><img src="/media/images/icons/icon_help.png" class="left"/><p class="tip tip_full">Exibir no e-commerce</p></a>
                </div>
            </li> 
        </ul>
        
        <ul>
            <li class="rows" style="margin-left: 140px">
                <div class="buttons_right">                   
                    <input type="button" class="bt_right" id="bt_detalhes" value="Detalhes"/> 
                    <input type="button" class="bt_right" id="bt_redes_sociais" value="Facebook"/>                  
                </div>

            </li>
        </ul>
 
        <div id="fancybox_gallery_launcher" class="iframe"></div>
        <div id="fancybox_images_launcher" class="iframe"></div>
        <div id="fancybox_banner_launcher" class="iframe"></div>
        <div id="fancybox_htmlbanners_launcher" class="iframe helper_tamanho_fake"></div>
        <div id="fancybox_textures_launcher" class="iframe"></div>
        <div id="fancybox_efeitos_launcher" class="iframe"></div>
        
        <h2><?php echo Yii::t("adminForm", "common_slot_graphic") ?></h2>        
        <ul id="slot_support">
                        
            <li class="cols">
                
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "common_picture") ?></div>
                
                <div class="container_slot" id="101">
                    <div class="base_slot_container" id="base_101">
                        <div class="base_bt_edit" title="Editar cool" id="<?php echo $slots['container_1']; ?>"></div>
                        <div class="base_bt_select" title="Selecionar novo cool" id="<?php echo $slots['container_1']; ?>"></div>
                        <div class="base_bt_remove" title="Limpar slot" id="<?php echo $i ?>"></div>
                    </div>
                    <div class="slot_launcher slot_page" id="slot_page_101">
                        <img  id="slot_pict_id_101" src="<?php if(isset($slots['container_image_1']['foto'])) echo "/media/user/images/thumbs_120/" . $slots['container_image_1']['foto'] ?>" width="" height="" alt=""/>
                        <div id="slot_banner_id_101" class="relative"></div>
                        <div class="canvas_stage101" id="stage"></div>
                    </div>
                    <div class="title_slot" id="title_slot_101"></div>
                    <div class="id_slot" id="id_slot_101"><?php echo $slots['container_1']; ?></div>
                    <div class="iframe bt_fotos_slot" id="101"></div>                    
                </div>
            </li>
           
            <li class="rows">
                <div class="label_text_Admin"></div>
                <p>&nbsp;</p>
            </li>
        </ul>
        <ul>
            <h2><?php echo Yii::t("adminForm", "common_submit_picture") ?></h2>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t("adminForm", "common_picture") ?></div>
                <div class="text">
                    <input type="button" class="bt_cadastrar_fotos_fancy iframe" id="bt_upload" value="" name="cool"/>
                </div>
            </li>
        </ul>
    </fieldset>
    
    <fieldset class="adminFormContent" id="ctnComponents" style="margin: 50px 0 0 -480px;">
        <ul>
            <li class="rows_margins height_auto">
                <div class="table_support" style="margin: 0px 0px 0px 10px">
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
                            <?php if($templates && count($templates) > 0){ $color = '0'; foreach($templates as $values){ ?> 
                            <tr id="item_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
                                <td width="1%"><img src='/media/images/icons/icon_mais.png'/></td>
                                <td width="10%"><?php if($values['titulo_componente'] != ''){echo $values['titulo_componente'];}else{echo $values['titulo'];}?></td>
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
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">        
        <?php if($attributes['action'] == "novo"){ ?>
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_submit"); ?>" />
        <?php } else { ?>
        <input type="button" class="bt_right" id="bt_update" value="<?php echo Yii::t("adminForm", "button_common_update"); ?>" />
        <?php } ?>       
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_clear"); ?>"/>        
    </div>
    <div class="clear heightSupport"></div>
    
    <div class="menu_shortcut">
        <ul>
            <?php if($attributes['action'] == "novo"){ ?>
            <li><input type="button" class="iSM icon_save bt_submit_shortcut" id="bt_submit"/></li>
            <?php } else { ?>
            <li><input type="button" class="iSM icon_save bt_update_shortcut" id="bt_update"/></li>
            <?php } ?>
            <li>
                <a href="/admin/<?php echo $attributes['controller'] ?>/listar">
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
    
    <input id="id_helper" type="hidden" value="<?php if(isset($template_info['id'])) echo $template_info['id'] ?>" data-info="ID do template"/>
    <input id="id_article_helper" type="hidden" value="<?php if(isset($content['id'])) echo $content['id'] ?>" data-info="ID da materia"/>
    <input id="helper_action" type="hidden" value="<?php echo $attributes['action'] ?>" data-js-action="editar"/>
    <input id="helper_id_controller" type="hidden" value="<?php echo $page_attributes ?>"/>
    <input id="helper_type_controller" type="hidden" value="<?php echo $attributes['controller'] ?>"/>
    <input id="helper_local" type="hidden" value="admin"/>
    <input id="helper_id_componente" type="hidden" value=""/>
    <input id="helper_id_row" type="hidden" value=""/>
    <input id="helper_id_slot" type="hidden" value="1"/>
</div>
<script type="text/javascript">setTimeout(function(){initSlotEditButton()},1000);</script>
<?php if($attributes['action'] == "editar"){?>
<script type="text/javascript">setTimeout(function(){setEditSlots(<?php echo json_encode($slots) ?>)},1000);</script>
<?php } ?>
<script type="text/javascript">//setTimeout(function(){setDateArticleFormat();}, 2000);</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>