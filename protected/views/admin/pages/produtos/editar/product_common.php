
<div class="mainPan">
    <div class="wrap">
        <?php //NÃO REMOVER ESTA LINHA ABAIXO,FAZ PARTE DA EXIBIÇÃO DESTE NO ADMIN ?>
        <?php if (Yii::app()->controller->id == "admin") { include Yii::app()->getBasePath() . "/views/admin/common/header/titles_admin/title_admin_produtos.php";  } ?>
        <div class="ctnCenterAdmin">
            <p>&nbsp;</p>
            <div id="menu_conta" class="container_menu_right mgT2">
                <ul>
                    <li id="link_conta_01">
                        <a id="bt_description_main" >
                            <div class="tab_corner_disable_left"></div>
                            <div class="tab_corner_disable_middle">
                                <div class="bt_support">Descrição</div>
                            </div>
                            <div class="tab_corner_disable_right"></div>
                        </a>
                    </li>
                    <li id="link_conta_02"><div class="tab_corner_disable_left"></div>
                        <a id="bt_images_product">
                            <div class="tab_corner_disable_middle">                                            
                                <div  class="bt_support">Imagens</div>
                            </div>
                            <div class="tab_corner_disable_right"></div>
                        </a>
                    </li>
                    <?php if($action == "editar"){ ?>
                    <li id="link_conta_02" class="hide"><div class="tab_corner_disable_left"></div>
                        <a id="bt_images_product" href="/admin/loja/estoque_cadastrar/<?php echo $id_produto ?>">
                            <div class="tab_corner_disable_middle">                                            
                                <div  class="bt_support">Estoque</div>
                            </div>
                            <div class="tab_corner_disable_right"></div>
                        </a>
                    </li>
                    <?php } ?>                    
                    <li id="link_conta_02"><div class="tab_corner_disable_left"></div>
                        <a id="bt_videos_product">
                            <div class="tab_corner_disable_middle">                                            
                                <div  class="bt_support">Video</div>
                            </div>
                            <div class="tab_corner_disable_right"></div>
                        </a>
                    </li>
                    <li id="link_conta_02"><div class="tab_corner_disable_left"></div>
                        <a id="bt_transportation">
                            <div class="tab_corner_disable_middle">                                            
                                <div class="bt_support">Outras Informações</div>                                            
                            </div>
                            <div class="tab_corner_disable_right"></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
 
        <div class="divider_horizontal"></div>
        
        <div class="pan" id="panMain">  
            <div class="container_pan">
                <div id="cc-main-content">
                
                <div id="cc-profile">
                    
                    <div id="cc-profile-content-internal">                       
                        <div id="cc-main-content-form" class="form-produto-pos">
                            
                            <form id="cadastro-produto">
                                <div id="support_description">
                                    <div class="container_form1">                                    
                                        <div class="cc-main-content-fullway">
                                    
                                            <?php if (Yii::app()->controller->action->id != "criar") { ?>
                                            <input type="hidden" name="id_produto" id="id_produto" value="<?php echo $id_produto ?>"/>
                                            <?php } ?>                                        
                                            <div class="clear"></div>
                                            <div class="cc-main-content-fullway">
                                                <div id="palavras-chave">
                                                    <div class="label-categoria">Ref.:</div>
                                                    <div><input name="referencia" id="referencia" class="input_small" type="text" value="<?php echo $referencia ?>"/></div>
                                                </div>
                                            </div>
                                            <?php if(Yii::app()->params['produtos_index']){ ?> 
                                            <div class="cc-main-content-fullway">
                                                <div id="palavras-chave">
                                                    <div class="label-categoria">Índice</div>
                                                    <div><input name="n_index" id="n_index" class="input_small" type="text" value="<?php echo $n_index ?>"/></div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="cc-main-content-fullway">
                                                <div id="palavras-chave">
                                                    <div class="label-categoria">Nome</div>
                                                    <div><input name="nome" id="nome" class="input_giant" type="text" value="<?php echo $formPoolNome ?>"/></div>
                                                </div>
                                            </div>
                                            <div class="cc-main-content-fullway hide">
                                                <div id="estado">
                                                    <div class="label-categoria">Estado</div>
                                                    <div class="row-estado">
                                                        <label><input type="radio" name="estado" value="0" id="estado" <?php if (isset($formPoolEstadoCHECKED) && $formPoolEstado == "0") echo "checked"; ?>/> &nbsp;Novo</label>
                                                        <span> &nbsp; &nbsp;</span>
                                                        <label><input type="radio" name="estado" value="1" id="estado" <?php if (isset($formPoolEstadoCHECKED) && $formPoolEstado == "1")echo "checked"; ?>/> &nbsp;Usado</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cc-main-content-fullway">
                                                <div id="palavras-chave">
                                                    <div class="label-categoria">Marca</div>
                                                    <div><input name="p_marca" id="marca" class="input_giant" type="text" value="<?php echo $formPoolMarca; ?>"/></div>
                                                </div>
                                            </div>
                                            <div class="cc-main-content-fullway">
                                                <div id="palavras-chave">
                                                    <div class="label-categoria">Palavras-chave</div>
                                                    <div><input name="palavra_chave" id="palavra_chave" class="input_giant" type="text" value="<?php echo $formPoolPalavraChave ?>"/></div>
                                                </div>
                                            </div>
                                            <div class="cc-main-content-fullway">
                                                <div id="launcher-category" class="container_categoria_product">
                                                    <div class="label-categoria">Categoria</div>
                                                    <div class="styled-select">
                                                        <select id="categoria" name="categoria" class="left">
                                                            <option>Escolha uma categoria</option>
                                                            <?php foreach ($categorias as $values) { ?>                                                            
                                                            <option value="<?php echo $values['id_categoria'] ?>" <?php if($formPoolCategoria == $values['id_categoria']){echo " selected";}?>><?php echo $values['categoria_label'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="loader_combo_subcategorias" class="container_subcategoria_product"></div>
                                                <input id="reloadSubCategoria" type="hidden" value="<?php echo $formPoolCategoria ?>"/>
                                                <div id="loader_combo_subitem" class="container_subcategoria_product"></div>
                                                <input id="reloadSubItem" type="hidden" value="<?php echo $formPoolSubItem ?>"/> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container_form2">
                                        <div class="cc-main-content-fullway">                                       
                                            <div class="container_valor">
                                                <div class="label-categoria">Valor - R$</div>
                                                <div class="container_detalhes">
                                                    <div class="container_price">
                                                        <input name="valor_real" id="valor_real" class="input_mini left" type="text" value="<?php echo $formPoolValorReal; ?>"/> 
                                                        <div class="label_after">centavos com ponto</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cc-main-content-fullway hide">
                                            <div class="label-categoria">Parcelamento</div>
                                            <div class="container_icons_payment">
                                                <input id="1x" type="button" class="icon_payment_1x <?php if($parcelas == 1) echo 'active'; ?>" title="1x" alt="1"/>
                                                <input id="2x" type="button" class="icon_payment_2x <?php if($parcelas == 2) echo 'active'; ?>" title="2x" alt="2"/>
                                                <input id="3x" type="button" class="icon_payment_3x <?php if($parcelas == 3) echo 'active'; ?>" title="3x" alt="3"/>
                                                <input id="4x" type="button" class="icon_payment_4x <?php if($parcelas == 4) echo 'active'; ?>" title="4x" alt="4"/>
                                                <input id="5x" type="button" class="icon_payment_5x <?php if($parcelas == 5) echo 'active'; ?>" title="5x" alt="5"/>
                                                <input id="6x" type="button" class="icon_payment_6x <?php if($parcelas == 6) echo 'active'; ?>" title="6x" alt="6"/>
                                                <input id="7x" type="button" class="icon_payment_7x <?php if($parcelas == 7) echo 'active'; ?>" title="7x" alt="7"/>
                                                <input id="8x" type="button" class="icon_payment_8x <?php if($parcelas == 8) echo 'active'; ?>" title="8x" alt="8"/>
                                                <input id="9x" type="button" class="icon_payment_9x <?php if($parcelas == 9) echo 'active'; ?>" title="9x" alt="9"/>
                                                <input id="10x" type="button" class="icon_payment_10x <?php if($parcelas == 10) echo 'active'; ?>" title="10x" alt="10"/>
                                                <input id="11x" type="button" class="icon_payment_11x <?php if($parcelas == 11) echo 'active'; ?>" title="11x" alt="11"/>
                                                <input id="12x" type="button" class="icon_payment_12x <?php if($parcelas == 12) echo 'active'; ?>" title="12x" alt="12"/>
                                                <input id="13x" type="button" class="icon_payment_13x <?php if($parcelas == 13) echo 'active'; ?>" title="13x" alt="13"/>
                                                <input id="14x" type="button" class="icon_payment_14x <?php if($parcelas == 14) echo 'active'; ?>" title="14x" alt="14"/>
                                                <input id="15x" type="button" class="icon_payment_15x <?php if($parcelas == 15) echo 'active'; ?>" title="15x" alt="15"/>
                                                <input id="16x" type="button" class="icon_payment_16x <?php if($parcelas == 16) echo 'active'; ?>" title="16x" alt="16"/>
                                                <input id="17x" type="button" class="icon_payment_17x <?php if($parcelas == 17) echo 'active'; ?>" title="17x" alt="17"/>
                                                <input id="18x" type="button" class="icon_payment_18x <?php if($parcelas == 18) echo 'active'; ?>" title="18x" alt="18"/>
                                                <input id="parcelas" type="hidden" name="parcelas" value="<?php echo $parcelas; ?>"/>
                                            </div>
                                        </div>
                                        <p>&nbsp;</p>
                                        <div class="cc-main-content-fullway hide">
                                            <div class="label-categoria">Tipo</div>
                                            <div class="styled-select">
                                                <select id="tipo" name="tipo">
                                                    <option value="produto">Produto</option>
                                                    <option value="modulo">Módulo</option>
                                                    <option value="image">Imagem</option>
                                                    <option value="cool">Cool</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="cc-main-content-halfway">
                                            <table border="0" cellspacing="4" cellpadding="0">
                                                <tr class="hide">
                                                    <th scope="row">Valor Sugerido - R$</th>
                                                    <td><input name="fvalor" id="valor" class="input_mini" type="text" value="<?php echo $formPoolValor; ?>"/> centavos com vírgula </td>
                                                </tr>
                                                <tr class="hide">
                                                    <th scope="row">Data in&iacute;cio</th>
                                                    <td>
                                                        <input name="data_inicio" id="data_inicio" class="input_small" type="text" maxlength="10" value="<?php echo $formPoolDataInicio; ?>"/>
                                                        <label for="data_inicio"><img src="/media/images/icons/forms_calendar2.png" width="30" height="30" align="absbottom" alt="Calend&aacute;rio" for="formPoolDataInicio"/></label>
                                                    </td>
                                                </tr>
                                                <tr class="hide">
                                                    <th scope="row">Peso total</th>
                                                    <td><input name="peso" id="peso" class="input_mini" type="text" value="<?php echo $formPoolPeso; ?>"/> kg</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="cc-main-content-halfway">
                                            <div class="helper-margin">
                                                <h3>&nbsp;</h3>
                                                <table border="0" cellspacing="4" cellpadding="0">                                           
                                                    <tr class="hide">
                                                        <th scope="row">Data t&eacute;rmino</th>
                                                        <td>
                                                            <input name="data_termino" id="data_termino" class="input-date" type="text" maxlength="10" value="<?php echo $formPoolDataTermino; ?>"/>
                                                            <label for="data_termino"><img src="/media/images/icons/forms_calendar2.png" width="30" height="30" align="absbottom" alt="Calend&aacute;rio" /></label>
                                                        </td>
                                                    </tr>
                                                    <tr class="hide">
                                                        <th scope="row">Quantidade m&iacute;nima</th>
                                                        <td><input name="min" id="min" class="input_mini" type="text" value="<?php echo $formPoolNrMin; ?>"/> necessária </td>
                                                    </tr>
                                                    <tr class="hide">
                                                        <th scope="row">Quantidade m&aacute;xima</th>
                                                        <td><input name="max" id="max" class="input_mini" type="text" value="<?php echo $formPoolNrMax; ?>"/> disponível</td>
                                                    </tr>
                                                    <tr class="hide">
                                                        <th scope="row">Quantidade permitida</th>
                                                        <td><input name="max_person" id="max_person" class="input_mini" type="text" value="<?php echo $formPoolNrMaxPerson; ?>"/> por pessoa</td>
                                                    </tr>
                                                    <tr class="hide">
                                                        <th scope="row">Prazo entrega</th>
                                                        <td><input name="prazo_entrega" id="prazo_entrega" class="input_mini" type="text" value="<?php echo $formPoolPrazoEntrega; ?>"/> dias</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div> 
                                        <p>&nbsp;</p>
                                        <div class="cc-main-content-fullway">
                                            <div id="editor-html">
                                                <div class="label-categoria">Chamada</div>
                                                <textarea rows="2" cols="" name="descricao_resumo" class="textarea_giant_thin" id="descricao_resumo"><?php echo $descricao_resumo; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="cc-main-content-fullway">
                                            <div id="editor-html">
                                                <div class="label-categoria">Descrição</div>
                                                <textarea rows="5" cols="" name="descricao" class="textarea_giant" rows="5"id="descricao"><?php echo $formDescricao; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="cc-main-content-fullway">
                                            <div class="label-categoria">Qualidade</div>
                                            <div class="styled-select">
                                                <select id="reputacao" name="reputacao">                                                    
                                                    <option value="0" <?php if($reputation == 0) echo 'selected' ?>>0 Estrela</option>
                                                    <option value="1" <?php if($reputation == 1) echo 'selected' ?>>1 Estrela</option>
                                                    <option value="2" <?php if($reputation == 2) echo 'selected' ?>>2 Estrelas</option>
                                                    <option value="3" <?php if($reputation == 3) echo 'selected' ?>>3 Estrelas</option>
                                                    <option value="4" <?php if($reputation == 4) echo 'selected' ?>>4 Estrelas</option>
                                                    <option value="5" <?php if($reputation == 5) echo 'selected' ?>>5 Estrelas</option>
                                                    <option value="10" <?php if($reputation == 10) echo 'selected' ?>>Não mostrar</option>
                                                </select>
                                            </div>
                                        </div>
                                        <p>&nbsp;</p>
                                    </div>
                                    <div class="container_form_regioes hide">
                                        <div class="cc-main-content-fullway">
                                            <div id="cc-intro-content-pool">
                                                <div class="buttons-carousel">
                                                    <div id="cc-button-left"></div>
                                                    <div id="cc-button-right"></div>
                                                </div>
                                                <div id="cc-intro-aba" class="intro-helper-pool-margin">
                                                    <div id="bt-estado"></div>
                                                    <div id="bt-regiao"></div>
                                                </div>
                                                <div id="cc-intro-states-pool">
                                                    <div id="cc-intro-container-content">
                                                        <div id="cc-intro-states-container-pool">
                                                            <div id="cc-intro-states-locked"></div>
                                                            <?php $i = 0; ?>
                                                            <?php foreach ($states as $values) { ?>
                                                            <?php if ($i == 0) { ?>
                                                            <ul>
                                                            <?php } ?>
                                                                <li>
                                                                    <a id="st_<?php echo $values['id'] ?>" title="<?php echo $values['uf'] ?>" class="bt-link-state"><?php echo $values['uf'] ?></a>
                                                                </li>
                                                            <?php if ($i == 2 || $values['uf'] == end($states)) { ?>
                                                                </ul>
                                                            <?php $i = 0;
                                                            } else {
                                                                $i++;
                                                            } ?>
                                                            <?php } ?>
                                                            <div id="cc-intro-all-regions"><input class="cc-intro-checkbox-all" type="checkbox" id="check-all-regions"/>Entrego em qualquer lugar do Brasil</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="cc-intro-cities-pool">
                                                    <div id="cc-intro-container-content-pool">
                                                    <?php foreach ($states as $values) { ?>
                                                            <div id="<?php echo $values['uf'] ?>"></div>
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                                <input type="hidden" size="20" id="regiao" name="regiao" value="<?php if ($formPoolRegiao != "") echo $formPoolRegiao ?>"/>
                                                    <input type="hidden" size="20" id="local_regiao" value="pools"/>
                                                    <?php if ($formPoolRegiao == "0,") { ?><script type="text/javascript">setAllRegions();</script><?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                                                  
                                </div>
                                <div id="support_images">
                                    <div id="fancybox_images_launcher" class="iframe helper_tamanho_fake"></div>
                                    <div class="container_form_pictures">
                                        <div class="cc-main-content-fullway">
                                            <h3>Imagens do produto</h3>
                                            <div class="gallery">                                   
                                                <br/>                             
                                                <div id="slot_support">
                                                <?php for ($i = 1; $i <= 6; $i++) {?>
                                                    <div class="container_slot" id="<?php echo $i ?>">
                                                        <div class="base_slot_container" id="base_<?php echo $i ?>">
                                                            <div class="base_bt_select" title="Selecionar novo cool" id="<?php echo $i ?>"></div>
                                                            <div class="base_bt_remove" title="Limpar slot" id="<?php echo $i ?>"></div>
                                                        </div>
                                                        <div class="slot_launcher slot_page" id="slot_page_<?php echo $i ?>">
                                                            <img id="slot_pict_id_<?php echo $i ?>" src="" width="" height="" alt=""/>
                                                            <input type="hidden" id="submit_pict_id_<?php echo $i ?>" name="picture_<?php echo $i ?>" value="<?php $varName = "formSlotPicture$i"; if($$varName != ''){echo $$varName;} ?>"/>
                                                        </div>
                                                        <div class="title_slot" id="title_slot_<?php echo $i ?>"></div>
                                                        <div class="id_slot" id="id_slot_<?php echo $i ?>"><?php $varName = "formSlotPicture$i"; if($$varName != ''){echo $$varName;} ?></div>
                                                        <div class="iframe bt_fotos_slot" id="<?php echo $i ?>"></div>                    
                                                    </div>
                                                <?php }?>
                                                </div>
                                                <div class="clear"></div>
                                                <p>&nbsp;</p>
                                                <div class="info_qtd_images">Máximo de 6 imagens de até 1024x1024 e 1Mb cada.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="support_transportation">                                    
                                    <div class="cc-main-content-fullway">
                                       
                                        <h3>Informações de exibição</h3>
                                        <table border="0" cellspacing="4" cellpadding="0"  id="cc-contact-form" width="100%">
                                            <tr class="hide">
                                                <th scope="row">E-commerce</th>
                                                <td>
                                                    <label>
                                                        <input name="ecommerce_exibe" type="checkbox" value="1" <?php if (isset($ecommerce_exibe)) if($ecommerce_exibe == '1') echo "checked"; ?>/> &nbsp;Exibir no e-commerce
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr class="row_table_highlight">
                                                <th scope="row">Produtos</th>
                                                <td>
                                                    <input name="produtos_exibe" id="produtos_exibe" type="checkbox" value="1" <?php if (isset($produtos_exibe) && $produtos_exibe) echo "checked"; ?>/> &nbsp;Exibir em produtos
                                                </td>
                                            </tr>
                                            <tr class="row_table_highlight">
                                                <th scope="row">Lançamento</th>
                                                <td>
                                                    <label>
                                                        <input name="lancamento" id="lancamento" type="checkbox" value="1" <?php if (isset($lancamento)) if($lancamento == '1') echo "checked"; ?>/> &nbsp;Marcar como lançamento
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr class="row_table_highlight">
                                                <th scope="row">Vitrine</th>
                                                <td>
                                                    <label>
                                                        <input name="vitrine" id="vitrine" type="checkbox" value="1" <?php if (isset($vitrine)) if ($vitrine == '1') echo "checked"; ?>/> &nbsp;Exibir na vitrine
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr class="row_table_highlight">
                                                <th scope="row">Sob Consulta</th>
                                                <td>
                                                    <label>
                                                        <input name="sob_consulta" id="sob_consulta" type="checkbox" value="1" <?php if (isset($sob_consulta)) if ($sob_consulta == '1') echo "checked"; ?> class="left"/> 
                                                        <a href="#" class="tip_trigger" style="position: relative; float: left; top:0px; margin: 0 10px;"><img src="/media/images/icons/icon_help.png" class="left"/><p class="tip tip_full">Botão comprar vira Sob Consulta e abre contato</p></a>
                                                        <span>&nbsp;</span>
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Ordem Serviço</th>
                                                <td>
                                                    <label>
                                                        <input name="ordem_servico" id="ordem_servico" type="checkbox" value="1" <?php if (isset($ordem_servico)) if ($ordem_servico == '1') echo "checked"; ?>/> &nbsp;Utilizar para criar ordem de serviço
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr class="hide">
                                                <th scope="row">Promoção</th>
                                                <td>
                                                    <div>
                                                        <input type="text" class="input_mini left" id="promocao" value="<?php  echo $promocao ?>"/>
                                                        <div class="legend_desc">&nbsp;Coloque aqui o valor pelo qual será vendido na promoção</div>
                                                    </div>
                                                </td>
                                            </tr> 
                                            <tr class="row_table_highlight">
                                                <th scope="row">Exibe no menu</th>
                                                <td>                                                    
                                                    <div class="styled-select left">
                                                        <select id="id_categoria_menu" name="id_categoria_menu" class="left">
                                                            <option>Escolha uma categoria</option>
                                                            <?php foreach ($categorias_paginas as $values) { ?>                                                            
                                                            <option value="<?php echo $values['id'] ?>" <?php if($id_categoria_menu == $values['id']){echo " selected";}?>><?php echo $values['nome'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="legend_desc">&nbsp;Escolha a que grupo ele será adicionado</div>                                                    
                                                </td>
                                            </tr> 
                                        </table>
                                        <div class="clear"></div>
                                        <div class="hide">
                                            <p>&nbsp;</p><p>&nbsp;</p>                                 
                                            <div class="divider_horizontal"></div>
                                            <p>&nbsp;</p><p>&nbsp;</p>
                                            <h3>Informações de embrulho, embalagens e pacote</h3>
                                            <div class="container_valor">
                                                <div class="container_dimensions">
                                                    <div class="label-categoria">Peso</div>
                                                    <div class="container_detalhes">
                                                        <div class="">
                                                            <input name="peso" id="peso" class="input_mini left" type="text" onKeyPress="return priceonly(this, event)" value="<?php echo $peso; ?>"/> 
                                                            <div class="left">kg</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container_dimensions">
                                                    <div class="label-categoria">Largura</div>
                                                    <div class="container_detalhes">
                                                        <div class="">
                                                            <input name="largura" id="largura" class="input_mini left" type="text" onKeyPress="return priceonly(this, event)" value="<?php echo $largura; ?>"/> 
                                                            <div class="left">cm</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container_dimensions">
                                                    <div class="label-categoria">Altura</div>
                                                    <div class="container_detalhes">
                                                        <div class="">
                                                            <input name="altura" id="altura" class="input_mini left" type="text" onKeyPress="return priceonly(this, event)" value="<?php echo $altura; ?>"/> 
                                                            <div class="left">cm</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container_dimensions">
                                                    <div class="label-categoria">Comprimento</div>
                                                    <div class="container_detalhes">
                                                        <div class="">
                                                            <input name="comprimento" id="comprimento" class="input_mini left" type="text" onKeyPress="return priceonly(this, event)" value="<?php echo $comprimento; ?>"/> 
                                                            <div class="left">cm</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container_dimensions">
                                                    <div class="label-categoria">Diametro</div>
                                                    <div class="container_detalhes">
                                                        <div class="">
                                                            <input name="diametro" id="diametro" class="input_mini left" type="text"  value="<?php echo $diametro; ?>"/> 
                                                            <div class="left">cm</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <table border="0" cellspacing="4" cellpadding="0"  id="cc-contact-form" width="100%">
                                                <tr>
                                                    <th scope="row">Presente</th>
                                                    <td>
                                                        <div>
                                                            <input id="check_embrulho" type="checkbox" value="1" <?php if ($embrulho != '') echo "checked"; ?> class="check_box_desc left"/> 
                                                            <input name="embrulho" id="embrulho" class="input_mini left" type="text" onKeyPress="return priceonly(this, event)" value="<?php echo $embrulho; ?>"/>
                                                            <div class="legend_desc">&nbsp;Preencha com valor do embrulho para presente</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="hide">
                                        <p>&nbsp;</p><p>&nbsp;</p>                                 
                                        <div class="divider_horizontal"></div>
                                        <p>&nbsp;</p><p>&nbsp;</p>
                                        <h3>Informações de transporte</h3>
                                        <table border="0" cellspacing="4" cellpadding="0"  id="cc-contact-form" width="100%">
                                            <tr>
                                                <th scope="row">Transporte</th>
                                                <td>
                                                    <div>
                                                        <input name="check_transporte" type="checkbox" value="1" <?php if ($transporte != '') echo "checked"; ?> class="check_box_desc left"/> 
                                                        <input type="text" class="input_mini left" id="transporte" name="transporte" value="<?php echo $transporte ?>"/>
                                                        <div class="legend_desc">&nbsp;Exibir opção de frete com valor fixo: motoboy, caminhão e etc</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Retirar no local</th>
                                                <td>
                                                    <label>
                                                        <input name="retirar_local" id="retirar_local" type="checkbox" value="1" <?php if (isset($retirar_local)) if( $retirar_local == '1') echo "checked"; ?>/> &nbsp;Exibir opção retirar no local
                                                    </label>
                                                </td>
                                            </tr>
                                        </table>
                                        <input id="check_frete_gratis" type="checkbox" class="check_box_desc left hide" name="frete_gratis"/>
                                    </div>
                                </div>
                                <div id="support_videos" style="display: none">
                                    
                                    <div class="cc-main-content-fullway">
                                        <h3>Vídeo do produto</h3>               
                                        <div class="clear"></div>
                                        <div id="editor-html">
                                        <div class="label-categoria">Vídeo</div>
                                        <div><textarea name="video1" id="video1" class="textarea_giant"><?php echo $video1 ?></textarea></div>
                                        </div>
                                      
                                    </div>
                                 
                                </div>
                                <input id="action" type="hidden" value="<?php echo $action ?>"/>
                                <input id="action_helper" type="hidden" value="editar"/>
                                <input id="helper_id_controller" type="hidden" value="<?php echo $id_controller ?>"/>
                                <div class="clear"></div>
                                <p>&nbsp;</p>
                                
                            </form>
                        </div>
                    </div>
                </div>               
                <div class='clear'></div>
            </div>
        </div>
        
    </div>
    <div class='clear'></div>
    
    <?php include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">        
        <input type="button" class="bt_right" id="form-botao-continuar" value="<?php if($action == 'novo'){ echo Yii::t("adminForm", "button_common_submit");}else{ echo Yii::t("adminForm", "button_common_update");} ?>"/>
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_clear") ?>"/>       
    </div>  
    <div class="clear height_support"></div>
    
    <div class="menu_shortcut">
        <ul>
            <li><input type="button" class="iSM icon_save"/></li>
            <li>
                <a href="/admin/produtos/listar">
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
    
    <input name="id_user" id="id_user" type="hidden" value="0"/>
    <input type="hidden" id="helper_action" data-tipo="2"/>
    
</div>


<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>
<script type="text/javascript">setTimeout(function(){updateDates("<?php echo $formPoolDataInicio; ?>", "<?php echo $formPoolDataTermino; ?>");},1000);</script>



<script type="text/javascript">initSlotEditButton()</script>
<?php if($action == "editar"){ ?>
<?php for ($i = 1; $i <= 6; $i++) { ?>
<?php $varName = "formSlotPicture$i"; if($$varName != ''){ ?>
<script type="text/javascript">applyPictureSize('<?php echo $$varName ?>', '<?php echo $i ?>', 'image', true);</script>
<?php } ?>
<?php } ?>
<?php } ?>