<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['topo_tipo'] . '.php'; ?>
<div class="row-fluid">
        
    <div class="container pan">
        <div class="mgR mgL">
           
            <h1>Cadastro de usuário</h1> 
            <div class="divider_horizontal mgB2"></div>
            <div class="contentForm">               

                <div id="step_1">
                    <h4 class="mgB2 subtitulo">Inscreva-se para ter acesso aos nossos serviços</h4>
                    <?php if($session['pre_type'] == 0){ ?>
                    <div class="row-fluid">
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="right <?php if($session['pre_type'] == 1) echo "active"; ?>"><a href="/cadastrar/pj" class="bt_change_type" data-type="1">Pessoa Jurídica</a></li>
                            <li role="presentation" class="right <?php if($session['pre_type'] == 0) echo "active"; ?>"><a href="/cadastrar/pf" class="bt_change_type" data-type="0">Pessoa Física</a></li>
                        </ul>
                    </div>
                    <div class="row-fluid mgB">                
                        <div class="span4">
                            <input id="field1" value="" class="span12" placeholder="<?php echo $attribute['field1']; ?>" name="name"/>
                        </div>
                        <div class="span8">
                            <input id="field2" value="" class="span12" placeholder="<?php echo $attribute['field2']; ?>" name="lastname"/>
                        </div>
                    </div>                    
                    <div class="row-fluid mgB">
                        <div class="span8">
                            <input type="email" id="email_cadastro_rapido" value="<?php echo $session['pre_email'] ?>" class="span12" placeholder="<?php echo Yii::t("adminForm", "order_page_label_email"); ?>" name="email"/>
                        </div> 
                        <div class="span4">
                            <input type="text" id="documento" class="span12" value="" placeholder="<?php echo $attribute['documento']; ?>"/>
                            <input type="hidden" id="company" value=""/>
                        </div>
                    </div>
                    <div class="row-fluid mgB">                       
                        <div class="span4">
                           <input id="phone" value="" class="span12" placeholder="<?php echo Yii::t("adminForm", "order_page_label_phone"); ?>"/>
                        </div>
                        <div class="span4">
                            <input id="celphone" value="" class="span12" placeholder="<?php echo Yii::t("adminForm", "order_page_label_celphone"); ?>"/>
                        </div>
                    </div>
                    <div class="row-fluid mgB">                       
                        <div class="span3">
                            <input id="extra" value="" class="span12" placeholder="<?php echo $attribute['extra'] ?>"/>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div class="row-fluid">
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="right <?php if($session['pre_type'] == 1) echo "active"; ?>"><a href="/cadastrar/pj" class="bt_change_type" data-type="1">Pessoa Jurídica</a></li>
                            <li role="presentation" class="right <?php if($session['pre_type'] == 0) echo "active"; ?>"><a href="/cadastrar/pf" class="bt_change_type" data-type="0">Pessoa Física</a></li>
                        </ul>
                    </div>
                    <div class="row-fluid mgB">                
                        <div class="span12">
                            <input id="field1" value="" class="span12" placeholder="<?php echo $attribute['field1']; ?>" name="name"/>
                        </div>
                    </div>
                    <div class="row-fluid mgB">
                        <div class="span12">
                            <input id="field2" value="" class="span12" placeholder="<?php echo $attribute['field2']; ?>" name="lastname"/>
                        </div>
                    </div>                    
                    <div class="row-fluid mgB">
                        <div class="span8">
                            <input type="email" id="email_cadastro_rapido" value="<?php echo $session['pre_email'] ?>" class="span12" placeholder="<?php echo Yii::t("adminForm", "order_page_label_email"); ?>" name="email"/>
                        </div>  
                        <div class="span4">
                            <input type="text" id="documento" class="span12" value="" placeholder="<?php echo $attribute['documento']; ?>"/>
                            <input type="hidden" id="company" value=""/>
                        </div>
                    </div>
                    <div class="row-fluid mgB">                       
                        <div class="span4">
                           <input id="phone" value="" class="span12" placeholder="<?php echo Yii::t("adminForm", "order_page_label_phone"); ?>" name="telefone"/>
                        </div>
                        <div class="span4">
                            <input id="celphone" value="" class="span12" placeholder="<?php echo Yii::t("adminForm", "order_page_label_celphone"); ?>" name="celular"/>
                        </div>
                    </div>
                    <div class="row-fluid mgB">                       
                        <div class="span6">
                            <input id="extra" value="" class="spna12" placeholder="<?php echo $attribute['extra'] ?>"/>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <div class="row-fluid mgB">                             
                        <div id="message_error_1"></div>
                    </div>
                    <div class="divider_shadow"></div>
                    <div class="right_resp">
                         <input type='button' id='bt_goto_2' value='continuar'  class="botao btn-main" />
                    </div>
                    <div class="clear mgB2"></div>
                </div>
                
                <div id="step_2" style="display: none">
                    <div class="row-fluid">
                        <div class="mgR mgL">
                            <h3>Endereço</h3>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="mgR mgL">
                            <div class="span12">
                                <div class="span5">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <input id="cep" type="text" class="span6" value="" maxlength="9" tabindex="8" placeholder="CEP - ex:13088-300" name="cep"/>                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="mgR mgL">
                            <div class="span12">
                                <div class="row-fluid">
                                    <div class="span10">                        
                                        <input id="endereco" type="text" class="span12" value="" size="8" tabindex="9" placeholder="Endereço" name="endereco"/>                        
                                    </div>
                                    <div class="span2">                        
                                        <input id="numero" type="text" class="span12" value="" size="8" tabindex="10" placeholder="N." name="numero"/>                        
                                    </div>
                                </div>                   

                                <div class="row-fluid">
                                    <div class="span4">
                                        <input id="bairro" type="text" class="span12" value=""  tabindex="11" placeholder="Bairro" name="bairro"/>
                                    </div>
                                    <div class="span3">
                                        <input id="cidade" type="text" class="span12" value=""  tabindex="12" placeholder="Cidade" name="cidade"/>
                                    </div>
                                    <div class="span2">
                                        <div class="styled-select-uf mgL">
                                            <select id="estado" name="estado" tabindex="13">
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
                                                <option value="SP" selected>SP</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>                        
                    </div>
                    <div class="row-fluid">
                        <div class="mgR mgL">
                            <div class="row-fluid">
                                <div id="message_termos"></div>
                            </div>
                            <div class="divider_shadow"></div>
                            <div class="right_resp">
                                 <input type='button' id='bt_back_2' value='voltar'  class="botao mgR left btn-second" />
                                 <input type='button' id='bt_goto_3' value='continuar'  class="botao btn-main" />
                            </div>
                            <div class="clear mgB2"></div>
                        </div>
                    </div>                    
                </div>
                
                <div id="step_3" style="display: none">
                    <h4 class="mgB2 subtitulo">Passo 3 - Leia os termos e condições para cadastro</h4>
                    <div class="row-fluid">
                        <div class="pp_square mgB2">
                            <div class="textarea_giant_fat" style="max-height: 400px; overflow-y: auto; padding: 0 15px 15px 15px">                                    
                                <div class="area_termos_container">
                                <h3 class="titulo">Termos &amp; Condi&ccedil;&otilde;es</h3>
                                <?php if($termos['titulo'] != ""){ ?>
                                <p class="p-termo" read-only tabindex = "22"><?php echo $termos['titulo']; ?></p>
                                <?php } ?>
                                <?php if($termos['titulo_01'] != ""){ ?>
                                <p class="p-termo bold" read-only tabindex = "22"><?php echo $termos['titulo_01']; ?></p>
                                <?php } ?>
                                <?php if($termos['texto_01'] != ""){ ?>
                                <p class="p-termo" read-only tabindex = "22"><?php echo  nl2br($termos['texto_01']); ?></p>
                                <?php } ?>
                                <?php if($termos['titulo_02'] != ""){ ?>
                                <p class="p-termo bold" read-only tabindex = "22"><?php echo $termos['titulo_02']; ?></p>
                                <?php } ?>
                                <?php if($termos['texto_02'] != ""){ ?>
                                <p class="p-termo" read-only tabindex = "22"><?php echo  nl2br($termos['texto_02']); ?></p>
                                <?php } ?>
                                <?php if($termos['titulo_03'] != ""){ ?>
                                <p class="p-termo bold" read-only tabindex = "22"><?php echo $termos['titulo_03']; ?></p>
                                <?php } ?>
                                <?php if($termos['texto_03'] != ""){ ?>
                                <p class="p-termo" read-only tabindex = "22"><?php echo  nl2br($termos['texto_03']); ?></p>
                                <?php } ?>
                                <?php if($termos['titulo_04'] != ""){ ?>
                                <p class="p-termo bold" read-only tabindex = "22"><?php echo $termos['titulo_04']; ?></p>
                                <?php } ?>
                                <?php if($termos['texto_04'] != ""){ ?>
                                <p class="p-termo" read-only tabindex = "22"><?php echo  nl2br($termos['texto_04']); ?></p>
                                <?php } ?>
                                <?php if($termos['titulo_05'] != ""){ ?>
                                <p class="p-termo bold" read-only tabindex = "22"><?php echo $termos['titulo_05']; ?></p>
                                <?php } ?>
                                <?php if($termos['texto_05'] != ""){ ?>
                                <p class="p-termo" read-only tabindex = "22"><?php echo  nl2br($termos['texto_05']); ?></p>
                                <?php } ?>
                                <?php if($termos['titulo_06'] != ""){ ?>
                                <p class="p-termo bold" read-only tabindex = "22"><?php echo $termos['titulo_06']; ?></p>
                                <?php } ?>
                                <?php if($termos['texto_06'] != ""){ ?>
                                <p class="p-termo" read-only tabindex = "22"><?php echo  nl2br($termos['texto_06']); ?></p>
                                <?php } ?>
                                </div>
                                <p>&nbsp;</p>
                            </div> 
                        </div>
                        <div class="clear"></div>
                        <div class="termos_checkbox mgB">
                            <input name="formTermosAceito" id="formTermosAceito" type="checkbox" value="<?php //echo $formTermosAceito;?>" <?php // if($formTermosAceitoCHECKED) echo "checked"; ?> tabindex = "23" class="left mgR"/> 
                            <label for="formTermosAceito"><b>&nbsp;Li e ACEITO todos os termos e condi&ccedil;&otilde;es apresentados acima.</b></label>
                        </div>
                    </div> 
                    <div class="rows">
                        <div id="message_termos"></div>
                    </div>
                    <div class="divider_shadow"></div>
                    <div class="right_resp">
                         <input type='button' id='bt_back_2' value='voltar'  class="botao mgR left btn-second" />
                         <input type='button' id='bt_goto_4' value='continuar'  class="botao btn-main" />
                    </div>
                    <div class="clear mgB2"></div>
                </div>
                <div id="step_4" style="display: none">
                    <h4 class="title_step_curriculum subtitulo">Passo 4 - Digite uma senha para acessar a área-restrita</h4>
                    <p>&nbsp</p>
                    <div class="row-fluid ">
                        <div class="col-md-6 col-md-offset-3">               
                            <div class="span6 center">
                                <input id="password_form" name="password" value="" class="span12" type="password" placeholder="<?php echo Yii::t("adminForm", "order_page_label_password"); ?>"/>
                            </div>
                            <div class="span6 center">
                                <input id="password_repeat" name="password_repeat" value="" class="span12" type="password" placeholder="<?php echo Yii::t("adminForm", "order_page_label_repeat_password"); ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid mgB2">
                        <div class="center">
                            <div class="title_security">Seguran&ccedil;a</div>
                            <div><img src="/media/images/icons/security/security_password_none.png" id="formCredencialSeguranca" alt="Seguran&ccedil;a" /></div>
                        </div>
                    </div>
                    <div class="rows">
                        <div id="message_password"></div>
                    </div>
                    <div class="divider_shadow mgB2"></div>
                    <div class="right_resp">
                        <input type='button' id='bt_back_3' value='voltar'  class="botao btn-second mgR left" />
                        <input type='button' id='bt_goto_5' value='enviar'  class="botao btn-main" />
                    </div>
                    <div class="clear mgB2"></div>
                </div> 
                <div id="step_5" style="display: none">
                    <h4 class="subtitulo">Passo 5 - Concluído</h4>
                    <div><p>&nbsp;</p></div>
                    <div class="row-fluid">
                        <div class="container_margin_curriculum">
                            <h3 class="titulo">Seu cadastro foi concluído com sucesso!</h3>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="container_margin_curriculum">
                            <p>Agora você faz parte de nosso banco de dados.</p>
                        </div>
                    </div>
                    <div class="row-fluid">   
                        <div class="container_margin_curriculum">
                            <p>Foi enviado um e-mail a você com um link para você efetivar seu cadastro, assim você terá acesso a area-restrita.</p>
                            <p>Mantenha seus dados atualizados e visite sua area-restrita regularmente para ver se há mensagens para você.</p>
                        </div>
                    </div>
                    <div><p>&nbsp;</p></div>
                    <div class="divider_shadow"></div>
                    <div class='clear'></div>
                    <div class="right_resp">
                        <input type='button' id='bt_home' value='voltar'  class="botao btn-second bt_home" />
                    </div>
                    <div class="clear mgB2"></div>
                </div> 

            </div>
        </div>    
    </div>       
</div>
<input type="hidden" value="<?php echo Yii::app()->getController()->getId(); ?>" id="helper_local_logout"/>
<input type="hidden" value="<?php echo $session['pre_type']; ?>" id="helper_type_account"/>
<div class='clear'></div>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>