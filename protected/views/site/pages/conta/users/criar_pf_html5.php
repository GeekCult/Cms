<?php include Yii::app()->getBasePath() . '/views/site/common/header/site/' . $preferences['topo_tipo'] . '.php'; ?>
<div class="mainPan">
    <div class="wrap">
        <?php if(Yii::app()->params['ramo'] == 'software') include Yii::app()->getBasePath() . '/views/site/common/menu/menu_software.php'; ?>
        <div class="pan <?php if(Yii::app()->params['ramo'] == 'software'){echo 'container-fluid';}else{echo 'container';} ?>">
            <div class="<?php if(Yii::app()->params['ramo'] == 'software') echo "content_software" ?>" style="margin-bottom: 190px; position: relative; display: inline-block">
                <div class="mgL mgR">
                    
                
                    <?php $session = MethodUtils::getSessionData() ?>
                    <?php if (Yii::app()->controller->id != "admin" && $session['pre_email'] == "") { ?>
                    <?php include Yii::app()->getBasePath() . '/views/site/common/menu/conta/common/menu_conta_html5.php'; ?>

                    <h1>Pessoa Física</h1>

                    <?php } ?>                                
                    <div class="contentCadastra">
                    <div class="clear"></div>
                    <div id="cc-main-content">
                        <div id="cc-main-content-form">
                        <?php if($ERROR) { ?>                 
                        <div id="cc-error-screen">
                            <div id="cc-error-screen-top"></div>
                            <div id="cc-error-screen-content">
                                <h2>Erro de valida&ccedil;&atilde;o do formul&aacute;rio</h2>
                                <div class="bold">Foram encontrados erros ao enviar o formul&aacute;rio.</div>
                                <p>&nbsp</p>
                                <?php foreach ($ERROR_MSG as $key => $value) {if (strpos($key, 'error_text') == 0) echo "<div class='bg-danger mgB0'>$value</div>";} ?>
                                <p>&nbsp</p>
                                <div class="bold">Por favor verifique as informa&ccedil;&otilde;es e tente novamente.</div>
                            </div>                        
                            <div id="cc-error-screen-bottom"></div>
                        </div>
                        <?php } ?>                        
                            <form name="cadastro-fisica" id="cadastro-fisica" action="<?php echo $FORM_SUBMIT_TO;?>" method="POST">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <h3 class="titulo margin_bottom_20">Informa&ccedil;&otilde;es pessoais</h3>
                                        <div class="row-fluid">                                           
                                            <input name="formCadastroNome" id="formCadastroNome" class="span12" type="text" value="<?php echo $formCadastroNome;?>" placeholder="Nome"/>
                                        </div>
                                        <div class="row-fluid">                                
                                            <input name="formCadastroSobrenome" id="formCadastroSobrenome" class="span12" type="text" value="<?php echo $formCadastroSobrenome;?>" placeholder="Sobrenome"/>
                                        </div>

                                        <div class="row-fluid">
                                            <?php if(Yii::app()->controller->id != "admin" && $loginCadastradoEmail != "" && $session['atendimento'] != '1'){?>
                                            <input name="loginCadastradoEmail" type="hidden" class="span12" value="<?php echo $loginCadastradoEmail; ?>" readonly="true" placeholder="E-mail"/>
                                            <?php } else{?>
                                            <input name="loginCadastradoEmail" type="text" class="span12" value="<?php echo $loginCadastradoEmail; ?>" placeholder="E-mail"/>
                                            <?php } ?>
                                        </div>

                                        <div class="row-fluid">

                                            <?php if(Yii::app()->controller->id != "admin" && $loginCadastradoTipoNumero != ""){?>
                                            <input name="loginCadastradoTipoNumero" id="loginCadastradoTipoNumero" class="span6" type="hidden" value="<?php echo $loginCadastradoTipoNumero; ?>" readonly="true" placeholder="CPF"/>
                                            <?php } else{?>
                                            <input name="loginCadastradoTipoNumero" type="text" class="span6" value="<?php echo $loginCadastradoTipoNumero; ?>" placeholder="CPF"/>
                                            <?php } ?>

                                            <?php if(Yii::app()->controller->id != "admin" && $action == "editar" && $formCadastroRg != ""){?>
                                            <input name="formCadastroRg" id="form-cadastroRg" class="span6" type="hidden" value="<?php echo $formCadastroRg; ?>" placeholder="RG" readonly="true"/>
                                            <?php } else{?>
                                            <input name="formCadastroRg" id="form-cadastroRg" class="span6" type="text" value="<?php echo $formCadastroRg;?>" placeholder="RG"/>
                                            <?php } ?>
                                        </div>

                                        <div class="row-fluid">
                                            <input name="formCadastroNascimento" id="formCadastroNascimento" class="span6" type="text" value="<?php echo $formCadastroNascimento ?>" placeholder="Data de Nascimento"/>
                                        </div>

                                        <div class="row-fluid"> 
                                            <div class="span6">
                                                <label><input type="radio" name="formCadastroSexo" value="Masculino" id="formCadastroSexoMasculino" <?php if(isset($formCadastroSexoCHECKED) && $formCadastroSexoCHECKED == "Masculino"){echo "checked";} else{echo "checked";}?>/> &nbsp;Masculino</label>
                                            </div>
                                            <div class="span6">
                                                <label><input type="radio" name="formCadastroSexo" value="Feminino" id="formCadastroSexoFeminino" <?php if(isset($formCadastroSexoCHECKED) && $formCadastroSexoCHECKED == "Feminino") echo "checked";?>/> &nbsp;Feminino</label>
                                            </div>                                        
                                        </div>

                                        <div class="row-fluid"> 
                                            <select id="estado_civil" name="estado_civil">
                                                <option value=""  <?php if($estado_civil == '' || $estado_civil == 0) echo 'selected'?>>Selecione Estado Civil</option>
                                                <option value="1" <?php if($estado_civil == 1) echo 'selected'?>>Casado(a)</option>
                                                <option value="2" <?php if($estado_civil == 2) echo 'selected'?>>Solteiro(a)</option>
                                                <option value="3" <?php if($estado_civil == 3) echo 'selected'?>>Divorciado(a)</option>
                                                <option value="4" <?php if($estado_civil == 4) echo 'selected'?>>Viúvo(a)</option>
                                                <option value="5" <?php if($estado_civil == 5) echo 'selected'?>>União estável</option>
                                            </select>                                      
                                        </div>                                   
                                    </div>

                                    <div class="span6">
                                        <h3 class="titulo  margin_bottom_20">Credenciais para acesso</h3>                                    
                                        <div class="row-fluid">
                                            <?php if(Yii::app()->controller->id != "admin" && $action == "editar" && $formCredencialSenha != ""){?>
                                            <input name="formCredencialSenha" id="formCredencialSenha" type="text" value="<?php echo $formCredencialSenha; ?>" tabindex="15" class="input" placeholder="Senha" readonly="true"/>
                                            <?php } else{?>
                                            <input name="formCredencialSenha" id="formCredencialSenha" class="input" type="password" value="" tabindex="15" placeholder="Senha"/>
                                            <?php } ?>                                                
                                        </div>
                                        <div class="row-fluid">                                           
                                            <?php if(Yii::app()->controller->id != "admin" && $action == "editar" && $formCredencialConfirma != ""){?>
                                            <input name="formCredencialConfirma" id="formCredencialConfirma" type="text" value="<?php echo $formCredencialConfirma; ?>" tabindex="16" class="input" placeholder="Confirma&ccedil;&atilde;o" readonly="true"/>
                                            <?php } else{?>
                                            <input name="formCredencialConfirma" id="formCredencialConfirma" class="input" type="password" value="" tabindex="16" placeholder="Confirma&ccedil;&atilde;o *"/>
                                            <?php } ?>                                                
                                        </div>
                                        <div class="row-fluid">
                                            <img src="/media/images/icons/security/security_password_none.png" id="formCredencialSeguranca" alt="Seguran&ccedil;a"/>
                                        </div>
                                    </div>
                                </div>

                                <hr class="half" />

                                <div class="row-fluid">
                                    <h3 class="titulo margin_bottom_20">Informa&ccedil;&otilde;es para contato</h3>
                                    <div class="row-fluid">
                                        <div class="span6">                                    
                                            <input name="formInfoTelddd" id="formInfoTelddd" class="span2" type="text" maxlength="2" value="<?php echo $formInfoTelddd;?>" placeholder="DDD"/>
                                            <input name="formInfoTel" id="formInfoTel" class="span5" type="text" maxlength=8 value="<?php echo $formInfoTel;?>" placeholder="Telefone"/>
                                        </div>
                                        <div class="span6">                                        
                                            <input name="formInfoCelddd" id="formInfoCelddd" class="span2" type="text" maxlength="2" value="<?php echo $formInfoCelddd;?>" placeholder="DDD"/>
                                            <input name="formInfoCel" id="formInfoCel" class="span5 relative" type="text" maxlength=9 value="<?php echo $formInfoCel;?>" placeholder="Celular"/>
                                            <?php if(Yii::app()->params['operadoras'] == '1' && isset($operadoraCel)){ ?>
                                            <div class="cel_operadoras" style="float:right">
                                                <input id="op_type_0" type="button" class="logo_mini_claro cel_op" rel="0" style="display: <?php if($operadoraCel == 0){echo 'block';}else{echo 'none';} ?>" />
                                                <input id="op_type_1" type="button" class="logo_mini_vivo cel_op" rel="1" style="display: <?php if($operadoraCel == 1){echo 'block';}else{echo 'none';} ?>"/>
                                                <input id="op_type_2" type="button" class="logo_mini_tim cel_op" rel="2" style="display: <?php if($operadoraCel == 2){echo 'block';}else{echo 'none';} ?>"/>
                                                <input id="op_type_3" type="button" class="logo_mini_oi cel_op" rel="3" style="display: <?php if($operadoraCel == 3){echo 'block';}else{echo 'none';} ?>"/>
                                                <input id="op_type_4" type="button" class="logo_mini_nextel cel_op" rel="4" style="display: <?php if($operadoraCel == 4){echo 'block';}else{echo 'none';} ?>"/>
                                                <input id="cel_operator" type="hidden" value="<?php echo $operadoraCel ?>"/>
                                            </div>
                                            <?php } ?>                                        
                                        </div>
                                    </div>
                                </div>

                                <hr class="half" />

                                <div class="row-fluid">                                
                                    <h3 class="titulo">Profissão e ramo de atuação</h3>
                                    <div class="row-fluid">    
                                        <div class="span6">
                                            <label for="" class="left bold mgR">Profissão</label>
                                            <div class="styled-select left">
                                                <?php echo CHtml::dropDownList('profissao', $profissao, CHtml::encodeArray(CHtml::listData(Profissoes::model()->findAll(), 'id', 'descricao')), array('prompt' => 'Escolha uma profissão'));?> 
                                            </div>
                                        </div>
                                        <div class="span6">
                                            <label for="" class="left bold mgR">Ramo de atuação</label>
                                            <div class="styled-select select_tipo_cliente">
                                                <select id="ramo_atuacao" name="formIdRamoAtuacao">
                                                    <option value="">Ramo de Atuação</option>
                                                    <?php foreach($ramo_atuacao as $values){ ?>
                                                    <option value="<?php echo $values['id'] ?>" <?php if(isset($formIdRamoAtuacao)) {if($formIdRamoAtuacao == $values['id']) echo "selected";}else{ if(isset($content['ramo_atividade']) && $content['ramo_atividade'] == $values['id']) echo "selected";} ?>><?php echo $values['label'] ?></option>
                                                    <?php } ?>                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                 
                                </div>

                                <hr class="half" />

                                <div class="row-fluid">
                                    <div class="span6">
                                        <h3 class="titulo">Endere&ccedil;o principal</h3>
                                        <div class="row-fluid">
                                            <input name="formEnderecoCep" id="cep" class="span6" type="text" maxlength="9" value="<?php echo $formEnderecoCep;?>" tabindex = "9" placeholder="CEP - ex: 13270-456"/>
                                        </div>
                                        <div class="row-fluid">                                            
                                            <input name="formEnderecoEndereco" id="formEnderecoEndereco" class="span10" type="text" value="<?php echo $formEnderecoEndereco;?>" tabindex = "10" placeholder="Endere&ccedil;o"/>
                                            <input name="formEnderecoNumero" id="formEnderecoNumero" class="span2" type="text" size=5 maxlength=5 value="<?php echo $formEnderecoNumero;?>" tabindex = "11" placeholder="Nr."/>
                                        </div>
                                        <div class="row-fluid">                                            
                                            <input name="formEnderecoBairro" id="formEnderecoBairro" class="span6" type="text" value="<?php echo $formEnderecoBairro;?>" tabindex = "12" placeholder="Bairro"/>
                                            <input name="formEnderecoComplemento" id="formEnderecoComplemento" class="span6" type="text" value="<?php echo $formEnderecoComplemento;?>" tabindex = "12" placeholder="Complemento"/></td>
                                        </div>
                                        <div class="row-fluid">                                            
                                            <input name="formEnderecoCidade" id="formEnderecoCidade" class="span8" type="text" value="<?php echo $formEnderecoCidade;?>" tabindex = "13" placeholder="Cidade"/>
                                            <?php echo CHtml::dropDownList('formEnderecoEstado', $formEnderecoEstado, CHtml::encodeArray(CHtml::listData(State::model()->findAll(), 'id', 'name')));?>
                                        </div>
                                    </div>
                                    <div class="span6">

                                        <h3 class="titulo">Termos &amp; Condi&ccedil;&otilde;es</h3>
                                        <div class="pp_square mgB2">
                                        <div class="textarea_giant_fat" style="max-height: 170px; overflow-y: auto; padding: 0 15px 15px 15px">
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

                                        </div>
                                        <label><input name="formTermosAceito" id="formTermosAceito" type="checkbox" value="<?php echo $formTermosAceito;?>" <?php if($formTermosAceitoCHECKED) echo "checked"; ?> tabindex = "23"/> &nbsp;Li e ACEITO todos os termos e condi&ccedil;&otilde;es apresentados acima.</label>
                                        <p>&nbsp;</p>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="container_form_user hide">                               
                                    <h3 class="titulo">Código de afiliação</h3>
                                    <div>                                    
                                        <input name="formCodAfiliacao" id="formCodAfiliacao" class="input-long" type="text" value="<?php echo $formCodAfiliacao;?>" tabindex = "13"/>
                                        <div class="container-info-tip"></div><div class="container-info-subtitle">Digite seu código de afiliação!</div>
                                    </div>                             
                                </div>


                                <hr class="half" />

                                <div class="row-fluid pp_square">
                                    <div class="row-fluid">
                                        <h3 class="titulo">Avatar</h3>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span8">
                                            <div class="avatar_container_free_icons pp_square mgB2">
                                                <div id="container_avatars_purplepier">
                                                    <?php foreach($avatar as $values) { ?>
                                                    <div class="avatar_slot_picture">
                                                        <img src="/media/images/avatar/<?php echo $values['cool_p'] ?>" width="40" height="40" id="av_<?php echo $values['id'] ?>" alt="purplepier" class="bg_image_avatar"/>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>                            

                                            <div class="container_tabs_avatar">
                                                <input type="button" class="tab_avatar" value="geral" id="bt_avatar_geral"/>
                                                <?php if(Yii::app()->params['avatar_special'] == '1'){ ?>
                                                <input type="button" class="tab_avatar" value="comuns" id="bt_avatar_free"/>
                                                <input type="button" class="tab_avatar" value="especiais" id="bt_avatar_special"/>
                                                <?php } ?>
                                                <input type="button" class="tab_avatar" value="suas" id="bt_avatar_user"/>
                                            </div>
                                        </div> 
                                        <div class="span4">
                                            <div class="pp_square center mgB2">
                                                <div class="unit_picture">
                                                    <img id="avatar_picture" src="<?php echo $formAvatar ?>"/>
                                                </div>                                            
                                            </div>  
                                            <div class="container_file_input" id="file"></div>
                                            <input id="file_helper" type="hidden" value=""/>
                                        </div>
                                    </div>
                                </div>

                                <div class="container_form_user hide">
                                    <?php include Yii::app()->getBasePath() . "/views/site/pages/conta/users/atributos/tipo_clientes.php"; ?>
                                </div>
                                <div class="row-fluid">
                                    <div class="row-fluid">
                                        <h3 class="titulo">Frase</h3>
                                        <input name="formFrase" id="formFrase" class="span12" type="text" value="<?php echo $formFrase;?>"/>                                    
                                    </div>
                                </div>

                                <?php if(Yii::app()->params['user_keywords'] == 1){ ?>
                                <div class="row-fluid">
                                    <div class="row-fluid">
                                        <h3 class="titulo">Palavras-chave</h3>
                                        <input name="keywords" id="keywords" class="span12" type="text" value="<?php echo $keywords;?>" placeholder="Palavras-chave"/>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="row-fluid">                                
                                     <h3 class="titulo">Redes Sociais</h3>
                                     <div class="row-fluid">
                                        <input name="formInfoTwitter" id="formInfoTwitter" class="spna6" type="text" value="<?php echo $formInfoTwitter;?>" tabindex = "24" placeholder="Twitter"/>
                                        <input name="formInfoFacebook" id="formInfoFacebook" class="span6" type="text" value="<?php echo $formInfoFacebook;?>" tabindex = "25" placeholder="Facebook"/>
                                     </div>                               
                                </div>
                                <div class="row-fluid">
                                    <span scope="row"><b>Newsletter</b></span>
                                    <input name="formInfoNewsletter" id="formInfoNewsletter" type="checkbox" value="<?php echo $formInfoNewsletter;?>" <?php if($formInfoNewsletterCHECKED) echo "checked"; ?> tabindex = "26"/> &nbsp;Desejo receber informa&ccedil;&otilde;es e novidades por e-mail
                                </div>


                                <p>&nbsp;</p>
                                <div class="divider_horizontal"></div>
                                <p>&nbsp;</p>                            
                                <input name="token_cc_conta" type="hidden" value="<?php echo $token_cc_conta; ?>"/>
                                <div class="clear">
                                <div class="right_resp">                                
                                    <input type='reset' id='bt_clear' value='limpar'  class="botao btn-second" />
                                    <input type='submit' id='bt_submit' value='salvar'  class="botao btn-main" />                                   
                                </div>
                                </div>
                                <div class="clear mgB2"></div>
                                <div class="mgFooter"></div>
                                <input name="user_id" type="hidden" value="<?php echo $user_id; ?>"/>
                                <input name="pool_id" type="hidden" value="<?php echo $pool_id; ?>"/>
                                <input name="action" type="hidden" value="pf"/>                           
                                <input name="event" type="hidden" value="salvar"/>
                                <input name="formAvatar" type="hidden" id="formAvatar" value="<?php echo $formAvatar; ?>"/>
                                <input type="hidden" value="<?php echo Yii::app()->getController()->getId(); ?>" id="helper_local_logout"/>
                                </form>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
            <div class='clear'></div>
            <div class="mgFooter clear"></div>
        </div>
    </div>
</div>
<input type="hidden" value="conta" id="helper_local_logout"/>
<input type="hidden" value="pf" id="helper_user_type"/>
<?php //NÃO REMOVER ESTA LINHA ABAIXO,FAZ PARTE DA EXIBIÇÃO DESTE NO ADMIN ?>
<?php if (Yii::app()->controller->id == "admin") { include Yii::app()->getBasePath() . "/views/admin/common/footer/buttons_admin/buttons_users.php";  ?><script type="text/javascript"></script><?php } ?>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/site/' . $preferences['rodape_tipo'] . '.php'; ?>
