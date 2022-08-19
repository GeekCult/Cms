
<div class="clear"></div>
<div class="footerPanAdmin">    
    <div class="footer_background_admin">
        <div class="logo_admin_footer hide"></div>
        <div class="pool-info-share">
            <div class="pool-info-share hide" id="buttons-share-support">
                <ul id="buttons_share">
                    <li>
                        <input type="button" alt="<?php  ?>" id="cc-mail-icon" class="cc-mail-icon" name="<?php  ?>" title="Mail"/>
                    </li>
                    <li>
                        <input type="button" alt="<?php  ?>" id="cc-facebook-icon" class="cc-facebook-icon" name="<?php  ?>" title="Facebook"/>
                    </li>
                    <li>
                        <input type="button" alt="<?php  ?>" id="cc-twitter-icon" class="cc-twitter-icon" name="<?php  ?>" title="Twitter"/>
                    </li>
                    <li>
                        <input type="button" alt="<?php  ?>" id="cc-orkut-icon" class="cc-orkut-icon" name="<?php ?>" title="Orkut"/>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="icon_terms hide">
        <input type="button" class="bt_refresh" title="Limpar cache de informações"/>
        <input type="button" class="bt_terms" value="Termos e condições"/>
    </div>
    
    <div class="ft_tab">
        <?php if(isset($this->all['canal']['qtd_all']) && $this->all['canal']['qtd_all'] > 0){ ?><div id="bbMain" class="bubble" title="Você tem avisos não lidos, clique aqui!"><p><?php echo $this->all['canal']['qtd_all'] ?></p></div><?php } ?>
    </div>
    <div class="features_tab">        
        <div class="ctn_tab">
            <div class="ft_tab_close"></div>
            <div class="ctnAdvCenter" style="margin-top: -16px">  
                <div class="ctnBt">
                    <input type="button" id="bt_tab_chamados" class="bt_ear_up_big right users_tab" value="Chamados"/>
                    <?php if(isset($this->all['canal']['qtd_chamados']) &&  $this->all['canal']['qtd_chamados'] > 0){ ?><div id="bubC_6" class="bubble"><p id="cnC_6"><?php echo $this->all['canal']['qtd_chamados'] ?></p></div><?php } ?>
                </div>
                <input type="button" id="bt_tab_terms" class="bt_ear_up_big right users_tab" value="Termos e Condições"/>
                <div class="ctnBt">
                    <input type="button" id="bt_tab_atualizacao" class="bt_ear_up_big right users_tab" value="Atualizações"/>
                    <?php if(isset($this->all['canal']['qtd_atualizacao']) && $this->all['canal']['qtd_atualizacao'] > 0){ ?><div id="bubC_3" class="bubble"><p id="cnC_3"><?php echo $this->all['canal']['qtd_atualizacao'] ?></p></div><?php } ?>
                </div>
                <div class="ctnBt">
                    <input type="button" id="bt_tab_mensagem" class="bt_ear_up_big right users_tab" value="Mensagens"/>
                    <?php if(isset($this->all['canal']['qtd_message']) && $this->all['canal']['qtd_message'] > 0){ ?><div id="bubC_1" class="bubble"><p id="cnC_1"><?php echo $this->all['canal']['qtd_message'] ?></p></div><?php } ?>
                </div>
                <div class="ctnBt">
                    <input type="button" id="bt_tab_novidade" class="bt_ear_up_big right users_tab active" value="Novidades"/>
                    <?php if(isset($this->all['canal']['qtd_novidade']) && $this->all['canal']['qtd_novidade'] > 0){ ?><div id="bubC_2" class="bubble"><p id="cnC_2"><?php echo $this->all['canal']['qtd_novidade'] ?></p></div><?php } ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="ctn_tab_inner">                
                <div id="tbTipo_2"> 
                    <?php if(isset($this->all['canal']['qtd_novidade']) && $this->all['canal']['qtd_novidade'] > 0){ ?>
                    <div id="tbCTipo_2">
                        <div class="title_canal"><?php echo $this->all['canal']['novidade']['titulo']; ?></div>
                        <div class="bt_close_black right bt_close_canal" style="margin: 10px 20px 0 0" data-type="2" data-id="<?php echo $this->all['canal']['novidade']['id'] ?>"></div>
                        <div class="clear divider_horizontal"></div>
                        <div class="ctnNewsAll">
                            <?php if($this->all['canal']['novidade']['link'] != ""){ ?><a href="<?php echo $this->all['canal']['novidade']['link'] ?>" target="_blank"><?php } ?>
                            <div class="center">
                               <img id="image_canal" src="https://www.purplepier.com.br/media/user/images/original/<?php echo $this->all['canal']['novidade']['container_1'] ?>" alt="" /> 
                            </div>  
                            <?php if($this->all['canal']['novidade']['link'] != ""){ ?></a><?php } ?>
                            <div class="clear"></div>
                            <div class="desc_canal"><p><?php if(isset($this->all['canal']['novidade']['descricao'])) echo nl2br($this->all['canal']['novidade']['descricao']); ?></p></div>
                        </div>
                        <?php if($this->all['canal']['novidade']['link'] != ""){ ?><a href="<?php echo $this->all['canal']['novidade']['link'] ?>" class="link_canal link" target="_blank">Saiba mais</a><?php } ?>
                        <div class="bt_thumbs_up bt_close_canal" style="margin: 10px 20px 0 0" data-type="2" data-id="<?php echo $this->all['canal']['novidade']['id'] ?>" title="Ok, vi essa notícia"></div>
                    </div>
                    <?php }else{ ?>
                    <div class="title_canal_message">Estamos preparando mais novidades para você, aguarde!</div>
                    <?php } ?>
                </div>
                
                <div id="tbTipo_1"> 
                    <?php if(isset($this->all['canal']['qtd_message']) && $this->all['canal']['qtd_message'] > 0){ ?>
                    <div id="tbCTipo_1">
                        <div class="title_canal"><?php echo $this->all['canal']['message']['titulo']; ?></div>
                        <div class="bt_close_black right bt_close_canal" style="margin: 10px 20px 0 0" data-type="1" data-id="<?php echo $this->all['canal']['message']['id'] ?>"></div>
                        <div class="clear divider_horizontal"></div>
                        <div class="ctnNewsAll">
                            <?php if($this->all['canal']['message']['container_1'] != ""){ ?>
                            <?php if($this->all['canal']['message']['link'] != ""){ ?><a href="<?php echo $this->all['canal']['message']['link'] ?>" target="_blank"><?php } ?>
                                <div class="center">
                                   <img id="image_canal" src="https://www.purplepier.com.br/media/user/images/original/<?php echo $this->all['canal']['message']['container_1'] ?>" alt="" /> 
                                </div>                                
                            <?php if($this->all['canal']['message']['link'] != ""){ ?></a><?php } ?>
                            <?php } ?>
                            <div class="clear"></div>
                            <div class="desc_canal_2"><p><?php if(isset($this->all['canal']['message']['descricao'])) echo nl2br($this->all['canal']['message']['descricao']); ?></p></div>
                            <?php if($this->all['canal']['message']['link'] != ''){ ?><a href="<?php echo $this->all['canal']['message']['link'] ?>" class="link_canal link" target="_blank">Saiba mais</a><?php } ?>
                        </div>
                        <div class="bt_thumbs_up bt_close_canal" style="margin: 10px 0px 0 0" data-type="1" data-id="<?php echo $this->all['canal']['message']['id'] ?>" title="Ok, vi essa mensagem"></div>
                    </div>
                    <?php }else{ ?>
                    <div class="title_canal_message">Não há nenhuma mensagem neste momento</div>
                    <?php } ?>
                </div>
                
                <div id="tbTipo_3"> 
                    <?php if(isset($this->all['canal']['qtd_atualizacao']) && $this->all['canal']['qtd_atualizacao'] > 0){ ?>
                    <div class="title_canal"><?php echo $this->all['canal']['atualizacao']['titulo']; ?></div>
                    <div class="bt_close_black right bt_close_canal" style="margin: 10px 20px 0 0" data-type="3" data-id="<?php echo $this->all['canal']['atualizacao']['id'] ?>"></div>
                    <div class="clear divider_horizontal"></div>
                    <div class="ctnNewsAll">                        
                        <div class="clear"></div>
                        <div class="desc_canal"><p><?php if(isset($this->all['canal']['atualizacao']['descricao'])) echo nl2br($this->all['canal']['atualizacao']['descricao']); ?></p></div>
                        <div class="bt_thumbs_up bt_close_canal" style="margin: 10px 0px 0 0" data-type="3" data-id="<?php echo $this->all['canal']['atualizacao']['id'] ?>" title="Ok, vi essa atualização"></div>
                    </div>
                    <?php }else{ ?>
                    <div class="title_canal_message">Não houve nenhuma atualização recentemente</div>
                    <?php } ?>
                </div>
                
                <div id="tbTipo_4"> 
                    <div class="title_canal">Termos e condições de uso do PurplePier</div>
                    <textarea rows="15">
                    <?php require_once Yii::app()->basePath . '/views/admin/common/special/termos.php'; ?>
                    </textarea> 
                    <a href="https://www.purplepier.com.br/termos" target="_blank"></a>
                </div>
                
                <div id="tbTipo_6"> 
                    <?php if(isset($this->all['canal']['qtd_chamados']) && $this->all['canal']['qtd_chamados'] > 0){ ?>
                    <div class="title_canal"><?php echo $this->all['canal']['atualizacao']['titulo']; ?></div>
                    <div class="bt_close_black right bt_close_canal" style="margin: 10px 20px 0 0" data-type="6" data-id="<?php echo $this->all['canal']['atualizacao']['id'] ?>"></div>
                    <div class="clear divider_horizontal"></div>
                    <div class="ctnNewsAll">                        
                        <div class="clear"></div>
                        <div class="desc_canal"><p><?php if(isset($this->all['canal']['atualizacao']['descricao'])) echo nl2br($this->all['canal']['atualizacao']['descricao']); ?></p></div>
                        <div class="bt_thumbs_up bt_close_canal" style="margin: 10px 20px 0 0" data-type="6" data-id="<?php echo $this->all['canal']['atualizacao']['id'] ?>" title="Ok, vi essa atualizacao"></div>
                    </div>
                    <?php }else{ ?>
                    <form id="form_chamados" class="relative">
                        <h4>Abrir um chamado</h4>
                        <input type="text" placeholder="O que você precisa?" id="titulo_servico" class="input_giant mgB"/>
                        <textarea id="descricao_servico" id="" cols="30" rows="4" placeholder="Descrição do que você precisa" class="textarea_giant"></textarea>
                        <div class="clear mgB"></div>
                        <div id='message_error_canal_footer'></div>
                        <div class="text">
                            <input type="button" class="botao_footer" value="enviar" id="bt_pier_chamados"/>
                        </div>

                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
