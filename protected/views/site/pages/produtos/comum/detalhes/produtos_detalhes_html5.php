<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['topo_tipo'] . '.php'; ?>
<div class="row-fluid " data-template='produtos_detalhes_html5'> 
    
    <?php if(Yii::app()->params['pier_cotacoes']){ include Yii::app()->getBasePath() . '/views/site/pages/produtos/general/barra_austin.php'; } ?>
    
    <div class="container pan">
        <div class="pan_shadow">
            <div class="mgL mgR">
                <?php if($text['breadcrumb_exibe']){ ?>
                <div class="row-fluid">
                    <ul class="breadcrumb">
                    <?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/breadcrumb.php"; ?>
                    </ul>
                </div>
                <?php } ?>
                
                
                <div class="row-fluid">
                    <h2 class="titulo">Detalhes do produto</h2>
                    <hr class="half" />
                    
                    <div class="container_item_produto hProduct" id="container_produto_<?php echo $content['id'] ?>">
                        <div class="span6">                                
                            <div class="destino">
                                <h3 class="titulo"><?php echo $content['nome'] ?></h3>
                                <?php if($content['cidade'] != "nenhuma"){ ?>
                                <span><?php echo $content['cidade'] ?></span>
                                <?php } ?>
                            </div>                            
                            <?php if($content['referencia'] != "" || $content['referencia'] != '0'){ ?>
                            <div class="tipo">
                                <div class="data_saida">
                                    <span class="align_right"><b>Ref.: </b></span>
                                    <span><?php echo $content['referencia'] ?></span>
                                </div>
                            </div>
                            <p>&nbsp</p>
                            <?php } ?>
                            
                            <?php if($content['marca'] != ""){ ?>
                            <div class="tipo">
                                <div class="data_saida">
                                    <span class="align_right"><b>Marca: </b></span>
                                    <span><?php echo $content['marca'] ?></span>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if($content['preco_real'] != "" && $content['preco_real'] > 0 && $content['preco_real'] != Yii::t("siteStrings", "label_free")){ ?>
                            <div class="container_valor">
                                <span class="align_right">&nbsp;</span>
                                <?php if($content['parcelas'] > 1){ ?>
                                <div class="parcelado">
                                    <span><?php echo $content['parcelas'] ?> x</span>
                                    <span class="valor"><?php echo $content['valores']['parcel'] ?></span>
                                </div>
                                <div class="total">
                                    <span class="valor"><?php echo $content['preco_real_string'] ?></span>
                                </div>
                                <?php }else{ ?>
                                <div class="total">
                                    <h2 class="mr0"><?php echo $content['preco_real_string'] ?></h2>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>

                            <?php if(isset($content['descricao_resumo']) && $content['descricao_resumo'] != ''){ ?>
                            <p>&nbsp</p>
                            <div class="descricao">
                                <h4 class="subtitulo">Resumo do produto</h4>
                                <p class="align_left"><?php echo nl2br($content['descricao_resumo']) ?></p>
                                <p>&nbsp;</p>
                            </div>
                            <?php } ?>
                            <hr class="half2"/>
                            <div class="row-fluid">
                                <p class="pull-right"><i class="fa fa-comments mgR0"></i><span class="badge"><?php echo $content['nr_comentarios'] ?></span></p>
                                <p <?php if($content['reputation'] == 10){ echo "class='hide'";} ?>>                                                
                                    <span class="fa <?php if($content['reputation'] >= 1){ echo "fa-star";}else{echo "fa-star-o";} ?>"></span>
                                    <span class="fa <?php if($content['reputation'] >= 2){ echo "fa-star";}else{echo "fa-star-o";} ?>"></span>
                                    <span class="fa <?php if($content['reputation'] >= 3){ echo "fa-star";}else{echo "fa-star-o";} ?>"></span>
                                    <span class="fa <?php if($content['reputation'] >= 4){ echo "fa-star";}else{echo "fa-star-o";} ?>"></span>
                                    <span class="fa <?php if($content['reputation'] >= 5){ echo "fa-star";}else{echo "fa-star-o";} ?>"></span>
                                </p>
                            </div>
                         
                            <div class="container_comment mgB2">
                                <div class="clear">
                                    <div class="clear mgT">
                                        <?php if(!isset(Yii::app()->request->cookies["RvPdr_" . $content['id']]->value) || (Yii::app()->request->cookies["RvPdr_" . $content['id']]->value == 0)){ ?>
                                        <p>&nbsp;</p>
                                        <div id="bt_review_<?php echo $content['id'] ?>" class="mgR left">
                                            <input type="button" class="bt_like" alt="produtos" id="<?php echo $content['id'] ?>"/>
                                            <input type="button" class="bt_unlike" alt="produtos" id="<?php echo $content['id'] ?>"/>
                                        </div>                                        
                                        <?php } ?>                                       
                                        <div class="container_people_reviews mgR">
                                            <?php $class = ""; if($like['likes'] == ""){ $class = "hide"; }?>
                                            <span id="phrase_like<?php echo $content['id'] ?>" class="likes_bt <?php echo $class ?>"><?php echo $like['likes'] ?></span>               
                                            <?php $class = ""; if($like['unlikes'] == ""){ $class = "hide"; }?>
                                            <span id="phrase_unlike<?php echo $content['id'] ?>" class="likes_bt <?php echo $class ?>"><?php echo $like['unlikes'] ?></span>                
                                        </div>
                                    </div>                                
                                </div>                           
                            </div>

                            <div class="divider_shadow"></div>
                            <div class="clear"></div>
                            <div class="left">
                                <input class="botao btn-main left btn-lg" type="button" value="indicar amigo" id="<?php echo $content['id'] ?>" data-toggle="modal" data-target="#indique_modal"/>
                            </div>
                            <?php if($content['sob_consulta']){ if(Yii::app()->params['pier_cotacoes']){ ?>
                            <div class="right">
                                <button class="botao btn-main left btn-lg bt_consultar" type="button" data-toggle="modal" data-target="#sob_consulta" data-item="<?php echo $content['nome'] ?>" data-id="<?php echo $content['id'] ?>" data-valor="<?php echo $content['preco_real'] ?>" title="Cotar"><i class="fa fa-plus mgR"></i>cotar</button>
                            </div>
                            <?php }} ?>
                            
                            <div class="clear"></div>
                            <?php if(Yii::app()->params['produto_orcamento_exibir']){ ?>
                            <div class="row-fluid">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <h2>Solicite um orçamento agora</h2>
                                <a href="/orcamento">
                                    <input class="botao btn-main left" type="button" value="pedir" />
                                </a>                        
                            </div>
                            <?php } ?>
                            <p>&nbsp;</p>
                            
                            <?php if($text['network_exibe']){ include Yii::app()->getBasePath() . '/views/site/common/share/redes_sociais.php'; echo "<div class='mgFooter'></div>";} ?>
                            
    
                        </div>
                        <div class="span6">
                            <div>
                                <div class="pp_square center bg_transparent_40 padding_10" id="main_picture_detail">
                                    <img src="<?php echo "/media/user/images/original/{$content['image_0']}" ?>" title="<?php echo $content['nome'] ?>" id="slot_picture0" width="500"/>
                                </div>
                            </div>

                            <div class="row-fluid">
                                <div class="span12">
                                    <?php if($content['image_1'] != ""){ ?>
                                    <div class="thumbnails mgT2">
                                        <?php for($i = 1; $i < 6; $i++){ ?>
                                        <?php if($content['image_' . $i] != ""){ ?>
                                        <div class="span3 pp_square center">
                                            <img src="<?php echo "/media/user/images/original/{$content['image_' . $i]}" ?>" id="slot_picture<?php echo $i ?>" rel="<?php if($content['image_' . $i] != "") echo $content['image_' . $i] ?>" alt="<?php echo $content['image_' . $i] ?>" class="thumbnail_foto_produto_html5"/>
                                        </div>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php if($content['image_1'] != ""){ ?>
                                        <div class="span3 pp_square center">
                                                <img src="<?php echo "/media/user/images/original/{$content['image_0']}" ?>" id="slot_picture7" rel="<?php if($content['image_0'] != "") echo $content['image_0'] ?>" alt="<?php echo $content['image_0'] ?>" class="thumbnail_foto_produto_html5"/>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>                        
                                </div>
                            </div>
                            <div class='clear'></div>
                            <?php if(isset($content['tags']) && $content['tags']){ ?>
                            <div class="ctnTags">
                                <h5 class="titulo">Tags</h5>
                                <?php foreach($content['tags'] as $values){ ?>
                                <div class="tag texto"><a href="/tag/<?php echo HelperUtils::stringUtils(trim($values), 'url') ?>?source=produtos"><?php echo $values ?></div>
                                <?php } ?>
                                <div class="clear"></div>
                            </div>
                            <?php } ?>
                            <div class="divider_shadow"></div>
                            <div class="bt_back_produtos mgT">
                                <a href="/produtos">
                                    <input class="botao btn-second" type="button" value="voltar"/>
                                </a>
                            </div>
                        </div>

                        <div class="clear"></div>
                        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                            <li class="active"><a href="#descricao" data-toggle="tab">Descrição</a></li>
                            <li><a href="#videos" data-toggle="tab">Vídeos</a></li>
                            <li><a href="#comentarios" data-toggle="tab">Comentários</a></li>
                        </ul>
                        <div id="my-tab-content" class="tab-content">
                            <div class="tab-pane active" id="descricao">
                                <div class="span12">
                                    <h3 class="titulo">Descrição do produto</h3>
                                    <p class="align_left lead"><?php echo nl2br($content['descricao']) ?></p>
                                    <p>&nbsp;</p>

                                    <div class="divider_shadow"></div>
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="videos">
                                <div class="span12">
                                    <h3 class="titulo"><b>Videos</b></h3>
                                    <p class="align_left"><?php if(isset($content['video1']['big'])) echo $content['video1']['big'] ?></p>
                                    <p>&nbsp;</p>
                                    <div class="divider_shadow"></div>
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="comentarios">
                                <div class="span12">
                                    <h3>Comentários</h3>                            

                                    <div class="container_comment">
                                        <div class="comment_divider"></div>
                                        <?php if($comentarios && count($comentarios) > 0){foreach($comentarios as $values){ ?>
                                        <div class="container_item_comment" id="item_comment_reply_<?php echo $values['id'] ?>">
                                            <div class="row-fluid">
                                                <div class="span6">
                                                    <div class="comment_title" id="helper_comment<?php echo $values['id'] ?>"><strong><?php echo $values['nome'] ?></strong></div>
                                                </div>
                                                <div class="span6">
                                                    <div class="comment_time_past_main right"><?php echo $values['date_comment'] ?></div>
                                                </div>
                                            </div>

                                            <div class="comment_comentario">
                                                <p class="paragraph_comment"><?php echo nl2br($values['comentario'])?></p>
                                                <div class="clear"></div>
                                                <?php if(count($values['replies']) > 0) { ?>
                                                <?php include Yii::app()->getBasePath() . "/views/site/components/comentarios/content/items.php"; ?>
                                                <?php }?> 
                                                <div class="divider_comments"></div>
                                                <div class="container_commnet_reply" id="reply<?php echo $values['id'] ?>">
                                                    <input type="hidden" value="<?php echo $values['nome'] ?>" class="comment_name<?php echo $values['id'] ?>"/>
                                                    <input type="text" value="" class="comment_email<?php echo $values['id'] ?> span12" placeholder="Nome"/>
                                                    <textarea rows="4" class="comment_message<?php echo $values['id'] ?> span12" cols="4" wrap="on" placeholder="Comentário"></textarea>
                                                    <div class="label_comentarios">&nbsp;</div>
                                                    <input type="button" value="enviar" class="submit_reply botao btn-main" id="<?php echo $values['id'] ?>"/>
                                                    <hr class="half" />
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span6">
                                                        <div class="container_people_reviews">
                                                            <?php $class = ""; if($values['likes'] == ""){ $class = "no_display"; }?>
                                                            <span id="phrase_like<?php echo $values['id'] ?>" class="likes_bt <?php echo $class ?>"><?php echo $values['likes'] ?></span>               
                                                            <?php $class = ""; if($values['unlikes'] == ""){ $class = "no_display"; }?>
                                                            <span id="phrase_unlike<?php echo $values['id'] ?>" class="likes_bt <?php echo $class ?>"><?php echo $values['unlikes'] ?></span>                
                                                        </div>
                                                    </div>
                                                    <div class="span6">
                                                        <div class="container_buttons_reviews">
                                                            <div id="bt_review_<?php echo $values['id'] ?>" class="container_buttons_review mgR <?php echo $values['review_status'] ?>">
                                                            <input value="" type="button"  class="bt_like" id="<?php echo $values['id'] ?>" title="gostei!" alt="review"/>
                                                            <input value="" type="button" class="bt_unlike" id="<?php echo $values['id'] ?>" title="não gostei!" alt="review"/>
                                                            </div>
                                                            <input value="responder" type="button" class="bt_reply botao btn-main" id="<?php echo $values['id'] ?>" title="responder"/>
                                                        </div> 
                                                    </div>
                                                </div>

                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="divider_shadow"></div>
                                        <?php }}else { ?>
                                        <strong>Seja o primeiro a comentar</strong>
                                        <?php } ?>
                                    </div>                            

                                    <h3>Envie seu comentário</h3>
                                    <div class="container_comment_total">
                                        <input type="text" class="span12 comment_name" placeholder="Nome" />
                                        <input type="email" class="span12 comment_email" placeholder="Email" name="email"/>
                                        <textarea class="span12 comment_message" placeholder="Mensagem" rows="2"></textarea>
                                        <input type="checkbox" class="comment_email left mgR" placeholder="Email" name="no_email" checked/>
                                        <label for="no-email" class="mgL legend">Não divulgar e-mail</label>
                                        <hr class="half"></hr>
                                        
                                        <div class="row-fluid">
                                            <div id="output_contact"></div>
                                        </div>
                                        <div class="right">
                                            <input type="hidden" value="produto" id="helper_tipo"/>
                                            <input type="hidden" value="produto_reply" id="helper_tipo_reply"/>
                                            <input type="button" class="botao btn-second left mgR" id="clear_comment" value="limpar"/>
                                            <input type="button" class="botao btn-main" id="submit_comment" value="enviar"/>
                                        </div>
                                    </div>
                                    
                                    <div class="clear"></div>
                                    <p>&nbsp;</p>
                                    <div class="divider_shadow"></div>
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='clear'></div>
                </div>
                               
            </div>
        </div>        
    </div>
</div>
<div class="row-fluid">    
    <div class="container pan">
        <div class="mgL mgR">
            <div class="ctnVitrineDefinitions">
                <?php if(count($vitrine) > 0){ ?> <div class="mgL"><h2>Outros produtos que você possa gostar</h2></div><?php } ?>
                <?php include Yii::app()->getBasePath() . '/views/site/modulos/vitrine/vitrine_simple_html5.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php if($text['network_exibe']){ include Yii::app()->getBasePath() . '/views/site/common/share/redes_sociais.php'; } ?>


<input type="hidden" id="helper_action" data-js-action="details" data-titulo-indicacao="<?php echo $content['nome'] ?>" data-texto-indicacao="<?php if(isset($content['descricao_resumo']))echo $content['descricao_resumo'] ?>"/>
<input type="hidden" id="helper" data-js-action="details"/>
<input type="hidden" id="helper_tipo" value="produto"/>
<input type="hidden" id="id_general" value="<?php echo $content['id'] ?>"/>

<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>
<?php include Yii::app()->getBasePath() . '/views/site/modulos/indique_amigo/modal_indique_amigo.php'; ?>