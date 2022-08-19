<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/" . $preferences['topo_tipo'] . '.php'; $i = 0; ?>

<div class="pan container">
    <div id="step_1" class="row-fluid"> 
        <div id="ecommerce_support" class="mgR mgL">
            <h1><?php echo  Yii::t('siteStrings', 'title_page_close_order'); ?></h1>
            <div class="divider_horizontal"></div>
        
            <div class="mgB2 subtitulo"><b>Confira seus itens</b></div>
            <table class="table table-bordered">
                <thead>
                    <td width="10%" align="center">Image</td>
                    <td width="40%">Título</td>
                    <td width="10%" align="center">Quantidade</td>
                    <td width="5%" align="center">Remover</td>
                </thead>
            
            <?php if($content){ ?>             
                <?php foreach ($content as $values) { ?>                    
                <tr id="container_produto_<?php echo $values['id'] ?>">                
                    <td>   
                        <div class="center">
                            <a data-footer="<?php echo $values['product']['nome'] ?>" data-gallery="imagesizes" data-title="Produto" data-toggle="lightbox" href="/media/user/images/original/<?php echo $values['product']['image_0'] ?>" title="<?php echo $values['product']['nome'] ?>">
                                <img src="<?php if($values['product']['image_0'] != ""){echo "/media/user/images/thumbs_50/" .$values['product']['image_0'];}else{echo "/media/images/layout/missing/missing_50x50.jpg";} ?>" title="<?php echo $values['product']['nome'] ?>" id="slot_picture<?php echo $values['product']['id'] ?>"/>
                            </a>
                        </div>                                               
                    </td>
                    <td>                      
                        <strong><?php echo $values['nome'] ?></strong>
                        <p class="text_desc_fechamento"><a href="/produtos/<?php echo $values['product']['url'] ?>" target="_blank" class="link">Ver detalhes</a></div></p>                                                                        
                    </td>
                    <td align="center">
                        <input class="form-control field_qtd" value="<?php echo $values['amount'] ?>" id="amount_item_<?php echo $values['id'] ?>" data-id-estoque="<?php if(isset($values['id_variante'])) echo $values['id_variante'] ?>" data-id="<?php echo $values['id'] ?>" type="number"/>
                    </td>                                               
                    <td align="center">
                        <input type="button" value="Remover" id="item_<?php echo $values['id'] ?>" class="bt_remove_item_fechamento btn-second btn btn-auto"/>
                    </td>
                </tr>                   
                <?php } ?> 


                <?php } else { ?>
                <tr>
                    <td colspan="6"><p class="center bold"><?php echo Yii::t('siteStrings', 'shopping_cart_empty'); ?></p></td>
                </tr>
            <?php } ?> 
            </table>
            <div class='clear'></div>
            <div class="row-fluid">
                <div id="output_loja"></div>
            </div>
            <hr class="half"/>
            <div class='clear'></div>
            <div class="buttons_right_fechamento">
                <div class="right_resp">
                    <a href="/produtos"><div class="botao btn-second left mgR">continuar cotando</div></a>
                    <input type="button" class="botao btn-main" value="enviar" id="bt_goto_step_2"/>
                </div>
            </div>
            <input name="local" type="hidden" id="helper_local_area_restrita" value="<?php echo Yii::app()->controller->id ?>"/>
        </div>
    </div>
    
    <div id="step_2" class="row-fluid" style="display: none;">
        <h1><?php echo  Yii::t('siteStrings', 'title_page_close_order'); ?></h1>
        <div class="divider_horizontal"></div>

        <div class="mgB2 subtitulo"><b>Digite seus dados para concluir a cotação</b></div>
        <div class="row-fluid">
            <form id="formSobConsulta">
                <div class="form-group mg0">
                    <label for="name_sob_consulta">Nome</label>
                    <div class="input-group">
                        <input id="name_sob_consulta" type="text" class="span12" value="" placeholder="Nome para contato" name="nome"/>
                        <span class="input-group-addon">
                            <div class="pointer" title="Obrigatório">
                                <i class="fa fa-asterisk"></i>
                            </div>
                        </span>
                    </div>
                    <label class="legend sF red" for="name_sob_consulta">(*Campo obrigatório)</label>                    
                </div>
                <div class="form-group mg0">
                    <div class="form-row">
                        <div class="span8">
                            <label for="email_sob_consulta">E-mail</label>
                            <div class="input-group">
                                <input id="email_sob_consulta" type="email" class="span12" value="" name="email" placeholder="Seu e-mail"/>
                                <span class="input-group-addon">
                                    <div class="pointer" title="Obrigatório">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                </span>
                            </div>
                            <label class="legend sF red" for="email_sob_consulta">(*Campo obrigatório)</label> 
                            
                        </div>
                        <div class="span4">
                            <label for="telefone_sob_consulta">Telefone</label>
                            <div class="input-group">
                                <input id="telefone_sob_consulta" type="text" class="span12" value="" name="telefone" placeholder="Seu telefone"/>
                                <span class="input-group-addon">
                                    <div class="pointer" title="Obrigatório">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                </span>
                            </div>
                            <label class="legend sF red" for="telefone_sob_consulta">(*Campo obrigatório)</label>                            
                        </div>
                    </div>                    
                </div>
                <div class="form-group mg0">
                    <div class="form-row">
                        <div class="span8">
                            <label for="email_sob_consulta">Empresa</label>
                            <input id="empresa_sob_consulta" type="text" class="span12" value="" name="empresa" placeholder="Nome da Empresa"/>
                        </div>
                        <div class="span4">
                            <label for="email_sob_consulta">CNPJ</label>
                            <input id="cnpj_sob_consulta" type="text" class="span12" value="" name="cnpj" placeholder="CNPJ da Empresa"/>
                        </div>
                    </div>                    
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="span10">
                            <label for="cidade_sob_consulta">Cidade</label>
                            <div class="input-group">
                                <input id="cidade_sob_consulta" type="text" class="span12" value="" name="cidade" placeholder="Sua cidade"/>
                                <span class="input-group-addon">
                                    <div class="pointer" title="Obrigatório">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                </span>
                            </div>
                            <label class="legend sF red" for="cidade_sob_consulta">(*Campo obrigatório)</label>
                        </div>
                        <div class="span2">
                            <label for="email_sob_consulta">UF</label>
                            <select id="uf_sob_consulta" name="estado" class='span12'>
                                <option value="">Selecione</option>
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AP">AP</option>
                                <option value="AM">AM</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MG">MG</option>
                                <option value="MT">MG</option>
                                <option value="MS">MS</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PN">PN</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="RJ">RJ</option>
                                <option value="RS">RS</option>
                                <option value="SP">SP</option>
                            </select>
                        </div>
                    </div>                    
                </div>
                <div class="form-group">
                    <textarea rows="4" id="mensagem_sob_consulta" class="span12" placeholder="Escrever algo?" name="message"></textarea>
                </div>
            </form>
        </div>
        <div id="output_sob_consulta" class="row-fluid"></div>   
        <hr class="half"/>
        <div class='clear'></div>
        <div class="buttons_right_fechamento">
            <div class="right_resp">
                <div class="botao btn-second left mgR" id="bt_goto_step_1">voltar</div>
                <input type="button" class="botao btn-main" value="enviar" id="bt_enviar_consulta"/>
            </div>
        </div>
    </div>
    <div class="mgFooter"></div>
</div>

<input type="hidden" value="<?php echo $id_pedido ?>" id="helper_id_pedido"/>
<input type="hidden" value="<?php echo $id_usuario ?>" id="helper_id_usuario"/>
<input type="hidden" value="site" id="helper_local_logout"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>
<?php include Yii::app()->getBasePath() . '/views/site/modulos/modal/messages.php'; ?>