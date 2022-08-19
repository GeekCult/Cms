<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['design_site'] . '.php'; ?>
<div class="mainPan">
    <div class="wrap">
        <?php //NÃO REMOVER ESTA LINHA ABAIXO,FAZ PARTE DA EXIBIÇÃO DESTE NO ADMIN ?>
        <?php if (Yii::app()->controller->id == "admin") { include Yii::app()->getBasePath() . "/views/admin/common/header/titles_admin/title_admin_users.php";  } ?>
        <div class="pan" id="panMain">
            <div class="container_pan">
                <?php $session = MethodUtils::getSessionData() ?>
                <?php if (Yii::app()->controller->id != "admin" && $session['pre_email'] == "") { ?>
                <?php include Yii::app()->getBasePath() . '/views/site/common/menu/conta/' . Yii::app()->params['ramo'] . '/menu_conta.php'; ?>
                
                <h1>Cadastro de pessoa física</h1>
                
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
                            <ul class="content_error"><?php foreach ($ERROR_MSG as $key => $value) {if (strpos($key, 'error_text') == 0) echo "<li>$value</li>";} ?></ul>
                            <p>&nbsp</p>
                            <div class="bold">Por favor verifique as informa&ccedil;&otilde;es e tente novamente.</div>
                        </div>                        
                        <div id="cc-error-screen-bottom"></div>
                    </div>
                    <?php } ?>                        
                        <form name="cadastro-fisica" id="cadastro-fisica" action="<?php echo $FORM_SUBMIT_TO;?>" method="POST">
                            <div class="container_form_user">
                                <div class="cc-main-content-threeway">
                                    <h3 class="titulo margin_bottom_20">Informa&ccedil;&otilde;es pessoais</h3>
                                    <table border="0" cellspacing="4" cellpadding="0">
                                        <tr>
                                            <th scope="row">Nome *</th>
                                            <td><input name="formCadastroNome" id="formCadastroNome" class="input_normal" type="text" value="<?php echo $formCadastroNome;?>"/></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sobrenome *</th>
                                            <td><input name="formCadastroSobrenome" id="formCadastroSobrenome" class="input_normal" type="text" value="<?php echo $formCadastroSobrenome;?>"/></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">E-mail *</th>
                                            <?php if(Yii::app()->controller->id != "admin" && $loginCadastradoEmail != "" && $session['atendimento'] != '1'){?>
                                            <td><span class=""><b><?php echo $loginCadastradoEmail; ?><input name="loginCadastradoEmail" type="hidden" class="input_small" value="<?php echo $loginCadastradoEmail; ?>"></b></span></td>
                                            <?php } else{?>
                                            <td><input name="loginCadastradoEmail" type="text" class="input_normal" value="<?php echo $loginCadastradoEmail; ?>"/></td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <th scope="row">CPF *</th>
                                            <?php if(Yii::app()->controller->id != "admin" && $loginCadastradoTipoNumero != ""){?>
                                            <td><span class=""><b><?php echo $loginCadastradoTipoNumero; ?><input name="loginCadastradoTipoNumero" id="loginCadastradoTipoNumero" class="input_small" type="hidden" value="<?php echo $loginCadastradoTipoNumero; ?>"></b></span></td>
                                            <?php } else{?>
                                            <td><input name="loginCadastradoTipoNumero" type="text" class="input_small" value="<?php echo $loginCadastradoTipoNumero; ?>"/></td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <th scope="row">RG *</th>
                                            <?php if(Yii::app()->controller->id != "admin" && $action == "editar" && $formCadastroRg != ""){?>
                                            <td><span class=""><b><?php echo $formCadastroRg; ?><input name="formCadastroRg" id="form-cadastroRg" class="input_small" type="hidden" value="<?php echo $formCadastroRg; ?>"></b></span></td>
                                            <?php } else{?>
                                            <td><input name="formCadastroRg" id="form-cadastroRg" class="input_small" type="text" value="<?php echo $formCadastroRg;?>"/></td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <th scope="row">Data Nascimento *</th>
                                            <td>
                                                <input name="formCadastroNascimento" id="formCadastroNascimento" class="formCadastroNascimento input_small" type="text" value="<?php echo $formCadastroNascimento ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sexo *</th>
                                            <td>
                                                <label><input type="radio" name="formCadastroSexo" value="Masculino" id="formCadastroSexoMasculino" <?php if(isset($formCadastroSexoCHECKED) && $formCadastroSexoCHECKED == "Masculino"){echo "checked";} else{echo "checked";}?>/> &nbsp;Masculino</label>
                                                <span> &nbsp; &nbsp;</span>
                                                <label><input type="radio" name="formCadastroSexo" value="Feminino" id="formCadastroSexoFeminino" <?php if(isset($formCadastroSexoCHECKED) && $formCadastroSexoCHECKED == "Feminino") echo "checked";?>/> &nbsp;Feminino</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Estado civil</th>
                                            <td>
                                                <div class="styled-select">
                                                    <select id="estado_civil" name="estado_civil">
                                                        <option value=""  <?php if($estado_civil == '' || $estado_civil == 0) echo 'selected'?>>Selecione</option>
                                                        <option value="1" <?php if($estado_civil == 1) echo 'selected'?>>Casado(a)</option>
                                                        <option value="2" <?php if($estado_civil == 2) echo 'selected'?>>Solteiro(a)</option>
                                                        <option value="3" <?php if($estado_civil == 3) echo 'selected'?>>Divorciado(a)</option>
                                                        <option value="4" <?php if($estado_civil == 4) echo 'selected'?>>Viúvo(a)</option>
                                                        <option value="5" <?php if($estado_civil == 5) echo 'selected'?>>União estável</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="cc-main-content-oneway">
                                    <h3 class="titulo margin_bottom_20">Credenciais para acesso</h3>
                                    <table border="0" cellspacing="4" cellpadding="0">
                                        <tr>
                                            <th scope="row">Senha *</th>
                                            <?php if(Yii::app()->controller->id != "admin" && $action == "editar" && $formCredencialSenha != ""){?>
                                            <td><span class=""><b><?php echo $formCredencialSenha; ?><input name="formCredencialSenha" id="formCredencialSenha" class="input" type="hidden" value="<?php echo $formCredencialSenha; ?>"/></b></span></td>
                                            <?php } else{?>
                                            <td><input name="formCredencialSenha" id="formCredencialSenha" class="input_small" type="password" value=""/></td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <th scope="row">Confirma&ccedil;&atilde;o *</th>
                                            <?php if(Yii::app()->controller->id != "admin" && $action == "editar" && $formCredencialConfirma != ""){?>
                                            <td><span class=""><b><?php echo $formCredencialConfirma; ?><input name="formCredencialConfirma" id="formCredencialConfirma" class="input" type="hidden" value="<?php echo $formCredencialConfirma; ?>"></b></span></td>
                                            <?php } else{?>
                                            <td><input name="formCredencialConfirma" id="formCredencialConfirma" class="input_small" type="password" value=""/></td>
                                            <?php } ?>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Seguran&ccedil;a</th>
                                            <td><img src="/media/images/icons/security/security_password_none.png" id="formCredencialSeguranca" alt="Seguran&ccedil;a" /></td>
                                        </tr>
                                    </table>
                                    <h3 class="titulo margin_bottom_20">Informa&ccedil;&otilde;es para contato</h3>
                                    <table border="0" cellspacing="4" cellpadding="0">
                                        <tr>
                                            <th scope="row">Tel. fixo *</th>
                                            <td><div style="width: 290px;"><input name="formInfoTelddd" id="formInfoTelddd" class="input_mini" type="text" maxlength="2" value="<?php echo $formInfoTelddd;?>"/> &nbsp;
                                                    <input name="formInfoTel" id="formInfoTel" class="input_small0" type="text" maxlength=8 value="<?php echo $formInfoTel;?>"/></div></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tel. m&oacute;vel</th>
                                            <td>
                                                <div style="width: 290px;">
                                                    <input name="formInfoCelddd" id="formInfoCelddd" class="input_mini" type="text" maxlength="2" value="<?php echo $formInfoCelddd;?>"/> &nbsp;
                                                    <input name="formInfoCel" id="formInfoCel" class="input_small0" type="text" maxlength=9 value="<?php echo $formInfoCel;?>"/>
                                                    <?php if(Yii::app()->params['operadoras'] == '1' && isset($operadoraCel)){ ?>
                                                    <div class="cel_operadoras">
                                                        <input id="op_type_0" type="button" class="logo_mini_claro cel_op" rel="0" style="display: <?php if($operadoraCel == 0){echo 'block';}else{echo 'none';} ?>" />
                                                        <input id="op_type_1" type="button" class="logo_mini_vivo cel_op" rel="1" style="display: <?php if($operadoraCel == 1){echo 'block';}else{echo 'none';} ?>"/>
                                                        <input id="op_type_2" type="button" class="logo_mini_tim cel_op" rel="2" style="display: <?php if($operadoraCel == 2){echo 'block';}else{echo 'none';} ?>"/>
                                                        <input id="op_type_3" type="button" class="logo_mini_oi cel_op" rel="3" style="display: <?php if($operadoraCel == 3){echo 'block';}else{echo 'none';} ?>"/>
                                                        <input id="op_type_4" type="button" class="logo_mini_nextel cel_op" rel="4" style="display: <?php if($operadoraCel == 4){echo 'block';}else{echo 'none';} ?>"/>
                                                        <input id="cel_operator" type="hidden" value="<?php echo $operadoraCel ?>"/>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="container_form_user">
                                <div class="cc-main-content-fullway">
                                    <h3 class="titulo">Profissão e ramo de atuação</h3>
                                    <table>
                                        <tr>
                                            <th scope="row">&nbsp;</th>
                                            <td>
                                                <label for="" class="left bold mgR">Profissão</label>
                                                <div style="width: 210px; float: left; margin-right: 20px;" >
                                                    <div class="styled-select left">
                                                        <?php echo CHtml::dropDownList('profissao', $profissao, CHtml::encodeArray(CHtml::listData(Profissoes::model()->findAll(), 'id', 'descricao')), array('prompt' => 'Escolha uma profissão'));?> 
                                                    </div>
                                                </div>
                                                <div style="width: 350px; float: left" >
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
                                            </td>
                                            <th scope="row"><div class="container-info-tip"></div></th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="container_form_user">
                                <div class="cc-main-content-halfway">
                                    <h3 class="titulo">Endere&ccedil;o principal</h3>
                                    <table border="0" cellspacing="4" cellpadding="0">
                                        <tr>
                                            <th scope="row"><div class="cep_legend">CEP *</div></th>
                                            <td>
                                                <div class="cep_container">
                                                    <input name="formEnderecoCep" id="cep" class="input_small" maxlength="9" type="text" value="<?php echo $formEnderecoCep;?>"/>
                                                </div>
                                                <div class="legend_cep_ex titulo">ex: 13270-456</div>
                                            </td>                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Endere&ccedil;o *</th>
                                            <td><input name="formEnderecoEndereco" id="formEnderecoEndereco" class="input_small" type="text" value="<?php echo $formEnderecoEndereco;?>"/>, <input name="formEnderecoNumero" id="formEnderecoNumero" class="input_mini" type="text" value="<?php echo $formEnderecoNumero;?>"/></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Bairro *</th>
                                            <td><input name="formEnderecoBairro" id="formEnderecoBairro" class="input_small" type="text" value="<?php echo $formEnderecoBairro;?>"/></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Complemento</th>
                                            <td><input name="formEnderecoComplemento" id="formEnderecoComplemento" class="input_small" type="text" value="<?php echo $formEnderecoComplemento;?>"/></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Cidade *</th>
                                            <td><input name="formEnderecoCidade" id="formEnderecoCidade" class="input_small" type="text" value="<?php echo $formEnderecoCidade;?>"/></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Estado *</th>
                                            <td>
                                                <div class="styled-select">
                                                <?php echo CHtml::dropDownList('formEnderecoEstado', $formEnderecoEstado, CHtml::encodeArray(CHtml::listData(State::model()->findAll(), 'id', 'name')), array('prompt' => 'Escolha um Estado abaixo'));?>
                                                </div>
                                            </td>                                            
                                        </tr>
                                    </table>
                                </div>
                                <div class="cc-main-content-halfway">
                                    <h3 class="titulo">Termos &amp; Condi&ccedil;&otilde;es</h3>
                                    <div class="area_termos_container">
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
                                    <label><input name="formTermosAceito" id="formTermosAceito" type="checkbox" value="<?php echo $formTermosAceito;?>" <?php if($formTermosAceitoCHECKED) echo "checked"; ?> tabindex = "23"/> &nbsp;Li e ACEITO todos os termos e condi&ccedil;&otilde;es apresentados acima.</label>
                                    <p>&nbsp;</p>
                                </div> 
                                <div class="clear"></div>
                            </div>
                            <div class="container_form_user no-display">
                                <div class="cc-main-content-fullway">
                                    <h3 class="titulo">Código de afiliação</h3>
                                    <table>
                                        <tr>
                                            <th scope="row">Cód.:</th>
                                            <td><input name="formCodAfiliacao" id="formCodAfiliacao" class="input-long" type="text" value="<?php echo $formCodAfiliacao;?>" tabindex = "13"/></td>
                                            <th scope="row"><div class="container-info-tip"></div><div class="container-info-subtitle">Digite seu código de afiliação!</div></th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="container_form_user">
                                <div class="avatar_container_avatar">
                                    <h3 class="titulo">Avatar</h3>
                                    <div class="avatar_background_color">                                    
                                        <div class="avatar_container_free">
                                            <div class="avatar_container_free_icons">
                                                <div id="container_avatars_purplepier">
                                                    <?php foreach($avatar as $values) { ?>
                                                    <div class="avatar_slot_picture">
                                                        <img src="/media/images/avatar/<?php echo $values['cool_p'] ?>" width="40" height="40" id="av_<?php echo $values['id'] ?>" alt="purplepier" class="bg_image_avatar"/>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>                            
                                            <div class="avatar_divider"></div>
                                            <div class="container_tabs_avatar">
                                                <input type="button" class="tab_avatar" value="geral" id="bt_avatar_geral"/>
                                                <?php if(Yii::app()->params['avatar_special'] == '1'){ ?>
                                                <input type="button" class="tab_avatar" value="comuns" id="bt_avatar_free"/>
                                                <input type="button" class="tab_avatar" value="especiais" id="bt_avatar_special"/>
                                                <?php } ?>
                                                <input type="button" class="tab_avatar" value="suas" id="bt_avatar_user"/>
                                            </div>
                                            
                                        </div>
                                        <div class="avatar_picture_container">
                                            <img id="avatar_picture" src="<?php echo $formAvatar ?>"/>
                                        </div>
                                        <div class="avatar_button_select_picture">
                                                <div class="container_file_input" id="file"></div>
                                                <input id="file_helper" type="hidden" value=""/>
                                            </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="container_form_user">
                                <?php include Yii::app()->getBasePath() . "/views/site/pages/conta/users/atributos/tipo_clientes.php"; ?>
                            </div>
                            <div class="container_form_user">
                                <div class="frase_container">
                                    <h3 class="titulo">Frase</h3>
                                    <div class="background-color frase">
                                        <input name="formFrase" id="formFrase" class="input_giant frase_position" type="text" value="<?php echo $formFrase;?>"/>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if(Yii::app()->params['user_keywords'] == 1){ ?>
                            <div class="container_form_user">
                                <div class="frase_container">
                                    <h3 class="titulo">Palavras-chave</h3>
                                    <div class="background-color frase">
                                        <input name="keywords" id="keywords" class="input_giant frase_position" type="text" value="<?php echo $keywords;?>"/>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            
                            
                            <div class="container_form_user">
                                <div class="cc-main-content-fullway">
                                     <h3 class="titulo">Redes Sociais</h3>
                                     <div class="background-color">
                                        <table border="0" cellspacing="4" cellpadding="0">
                                            <tr>
                                                <th class="rowtwitter">Twitter</th>
                                                <td>@<input name="formInfoTwitter" id="formInfoTwitter" class="input_small" type="text" value="<?php echo $formInfoTwitter;?>" tabindex = "24" /></td>
                                                <th class="rowfacebook">Facebook</th>
                                                <td>facebook.com/<input name="formInfoFacebook" id="formInfoFacebook" class="input_small" type="text" value="<?php echo $formInfoFacebook;?>" tabindex = "25"/></td>
                                            </tr>
                                        </table>
                                     </div>
                                </div>
                            </div>
                            <div class="cc-main-content-fullway">
                                <span scope="row"><b>Newsletter</b></span>
                                <input name="formInfoNewsletter" id="formInfoNewsletter" type="checkbox" value="<?php echo $formInfoNewsletter;?>" <?php if($formInfoNewsletterCHECKED) echo "checked"; ?> tabindex = "26"/> &nbsp;Desejo receber informa&ccedil;&otilde;es e novidades por e-mail
                            </div>
                            <p>&nbsp;</p>
                            <div class="divider_horizontal"></div>
                            <p>&nbsp;</p>                            
                            <input name="token_cc_conta" type="hidden" value="<?php echo $token_cc_conta; ?>"/>
                            <div class="buttons_right_site">
                                 <div class="form_buttons_noone">
                                    <div class="bt_common">
                                        <input type='reset' id='bt_clear' value='limpar'  class="botao" />
                                    </div>
                                    <div class="bt_common">
                                        <input type='submit' id='bt_submit' value='salvar'  class="botao" />
                                    </div>
                                 </div>
                            </div>
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
                <div class='clear'></div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="conta" id="helper_local_logout"/>
<input type="hidden" value="pf" id="helper_user_type"/>
<?php //NÃO REMOVER ESTA LINHA ABAIXO,FAZ PARTE DA EXIBIÇÃO DESTE NO ADMIN ?>
<?php if (Yii::app()->controller->id == "admin") { include Yii::app()->getBasePath() . "/views/admin/common/footer/buttons_admin/buttons_users.php";  ?><script type="text/javascript"></script><?php } ?>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['design_site'] . '.php'; ?>
