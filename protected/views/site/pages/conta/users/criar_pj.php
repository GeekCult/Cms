<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['design_site'] . '.php'; ?>
<div class="mainPan">
    <div class="wrap">
        <?php $session = MethodUtils::getSessionData(); ?>
        <?php //NÃO REMOVER ESTA LINHA ABAIXO,FAZ PARTE DA EXIBIÇÃO DESTE NO ADMIN ?>
        <?php if (Yii::app()->controller->id == "admin") { include Yii::app()->getBasePath() . "/views/admin/common/header/titles_admin/title_admin_users.php";  } ?>
        <div class="pan" id="panMain">
            <div class="container_pan">
                <?php if (Yii::app()->controller->id != "admin" && $session['pre_email'] == "") { ?>
                <?php include Yii::app()->getBasePath() . '/views/site/common/menu/conta/' . Yii::app()->params['ramo'] . '/menu_conta.php'; ?>
                <div class="titlePageAdmin">
                <h1>Cadastro de pessoa jurídica</h1>
                </div>
                <?php } ?>
                <div class="contentCadastra">
                    <div class="clear"></div>
                    <div id="cc-main-content">
                        <div id="cc-main-content-form">
                        <?php  if($ERROR) {  ?>
                        <div id="cc-error-screen">
                            <div id="cc-error-screen-top"></div>
                            <div id="cc-error-screen-content">
                                <h2>Erro de valida&ccedil;&atilde;o do formul&aacute;rio</h2>
                                <div class="bold">Foram encontrados erros ao enviar o formul&aacute;rio.</div>
                                <p>&nbsp</p>
                                <ul class="content_error"><?php  foreach ($ERROR_MSG as $key => $value) {if (strpos($key, 'error_text') == 0) echo "<li>$value</li>"; } ?></ul>
                                <p>&nbsp</p>
                                <div class="bold">Por favor verifique as informa&ccedil;&otilde;es e tente novamente.</div>
                            </div>
                            <div id="cc-error-screen-bottom"></div>
                        </div>
                        <?php } ?>
                            <form name="cadastro-juridica" id="cadastro-juridica" action="<?php echo $FORM_SUBMIT_TO;?>" method="POST">
                                <div class="container_form_user">
                                    <div class="cc-main-content-threeway">
                                        <h3 class="titulo margin_bottom_20">Informa&ccedil;&otilde;es da empresa</h3>
                                        <table border="0" cellspacing="4" cellpadding="0">
                                            <tr>
                                                <th scope="row">Nome Fantasia *</th>
                                                <td><input name="formCadastroFantasia" id="formCadastroFantasia" class="input_normal" type="text" value="<?php echo $formCadastroFantasia;?>" tabindex = "2"/></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Raz&atilde;o Social *</th>
                                                <td><input name="formCadastroRazao" id="formCadastroRazao" class="input_normal" type="text" value="<?php echo $formCadastroRazao;?>" tabindex = "3"/></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-mail *</th>
                                                <?php if(Yii::app()->controller->id != "admin" && $loginCadastradoEmail != "" && $session['atendimento'] != 1){?>
                                                <td><span><b><?php echo $loginCadastradoEmail; ?><input name="loginCadastradoEmail" type="hidden" tabindex="4" class="input_small" value="<?php echo $loginCadastradoEmail; ?>"></b></span></td>
                                                <?php } else{?>
                                                <td><input name="loginCadastradoEmail" type="text" class="input_normal" value="<?php echo $loginCadastradoEmail; ?>"/></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <th scope="row">CNPJ *</th>
                                                <?php if(Yii::app()->controller->id != "admin" && $loginCadastradoTipoNumero != ""){?>
                                                <td><span><b><?php echo $loginCadastradoTipoNumero; ?><input name="loginCadastradoTipoNumero" type="hidden" value="<?php echo $loginCadastradoTipoNumero; ?>" tabindex="5" class="input"></b></span></td>
                                                <?php } else{?>
                                                <td><input name="loginCadastradoTipoNumero" type="text" class="input_small" value="<?php echo $loginCadastradoTipoNumero; ?>"/></td>
                                                <?php } ?>

                                            </tr>
                                            <tr>
                                                <th scope="row">Insc. Estadual *</th>
                                                <?php if(Yii::app()->controller->id != "admin" && $action == "editar" && $formCadastroInscricao != ""){?>
                                                <td><span><b><?php echo $formCadastroInscricao; ?><input name="formCadastroInscricao" id="formCadastroInscricao" type="hidden" value="<?php echo $formCadastroInscricao; ?>" tabindex="6" class="input"></b></span></td>
                                                <?php } else{?>
                                                <td><input name="formCadastroInscricao" id="formCadastroInscricao" class="input_small" type="text" value="<?php echo $formCadastroInscricao?>" tabindex="6"/></td>
                                                <?php } ?>

                                            </tr>
                                            <tr>
                                                <th scope="row">Respons&aacute;vel *</th>
                                                <td><input name="formCadastroResponsavel" id="formCadastroResponsavel" class="input_small" type="text" value="<?php echo $formCadastroResponsavel;?>" tabindex="7"/></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="cc-main-content-oneway">
                                        <h3 class="titulo  margin_bottom_20">Credenciais para acesso</h3>
                                        <table border="0" cellspacing="4" cellpadding="0">
                                            <tr>
                                                <th scope="row">Senha *</th>
                                                <?php if(Yii::app()->controller->id != "admin" && $action == "editar" && $formCredencialSenha != ""){?>
                                                <td><span><b><?php echo $formCredencialSenha; ?><input name="formCredencialSenha" id="formCredencialSenha" type="hidden" value="<?php echo $formCredencialSenha; ?>" tabindex="15" class="input"></b></span></td>
                                                <?php } else{?>
                                                <td><input name="formCredencialSenha" id="formCredencialSenha" class="input" type="password" value="" tabindex="15"/></td>
                                                <?php } ?>                                                
                                            </tr>
                                            <tr>
                                                <th scope="row">Confirma&ccedil;&atilde;o *</th>
                                                <?php if(Yii::app()->controller->id != "admin" && $action == "editar" && $formCredencialConfirma != ""){?>
                                                <td><span><b><?php echo $formCredencialConfirma; ?><input name="formCredencialConfirma" id="formCredencialConfirma" type="hidden" value="<?php echo $formCredencialConfirma; ?>" tabindex="16" class="input"></b></span></td>
                                                <?php } else{?>
                                                <td><input name="formCredencialConfirma" id="formCredencialConfirma" class="input" type="password" value="" tabindex="16"/></td>
                                                <?php } ?>                                                
                                            </tr>
                                            <tr>
                                                <th scope="row">Seguran&ccedil;a</th>
                                                <td><img src="/media/images/icons/security/security_password_none.png" id="formCredencialSeguranca" alt="Seguran&ccedil;a"/></td>
                                            </tr>
                                        </table>
                                        <h3 class="titulo  margin_bottom_20">Informa&ccedil;&otilde;es para contato</h3>
                                        <div class="helper-margin-user">
                                        <table border="0" cellspacing="4" cellpadding="0">
                                            <tr>
                                                <th scope="row">Tel. fixo *</th>
                                                <td><div style="width: 290px;">
                                                        <input name="formInfoTelddd" id="formInfoTelddd" class="input_mini left" type="text" maxlength="2" onKeyPress="return numbersonly(this, event)" value="<?php echo $formInfoTelddd;?>" tabindex="18"/> &nbsp;
                                                        <input name="formInfoTel" id="formInfoTel" class="input_small0" type="text" maxlength="8" onKeyPress="return numbersonly(this, event)" value="<?php echo $formInfoTel;?>" tabindex="19"/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tel. celular</th>
                                                <td>
                                                    <div style="width: 290px;">
                                                        <input name="formInfoFaxddd" id="formInfoFaxddd" class="input_mini left" type="text" maxlength="2" onKeyPress="return numbersonly(this, event)" value="<?php echo $formInfoCelddd;?>" tabindex="20"/> &nbsp;
                                                        <input name="formInfoFax" id="formInfoFax" class="input_small0" type="text" maxlength="8" onKeyPress="return numbersonly(this, event)" value="<?php echo $formInfoCel;?>" tabindex="21"/>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="container_form_user">
                                    <h3>Ramo de atuação</h3>
                                    <?php include Yii::app()->getBasePath() . "/views/site/pages/conta/users/atributos/ramo_atuacao.php"; ?>
                                </div>
                                <div class="container_form_user">
                                    <div class="cc-main-content-halfway">
                                        <h3 class="titulo">Endere&ccedil;o principal</h3>
                                        <table border="0" cellspacing="4" cellpadding="0">
                                            <tr>
                                                 <th scope="row"><div class="cep_legend">CEP *</div></th>
                                                <td>
                                                    <div class="cep_container">
                                                        <input name="formEnderecoCep" id="cep" class="input_small" type="text" maxlength="9" onKeyPress="return numbersonly(this, event)" value="<?php echo $formEnderecoCep;?>" tabindex = "9"/>
                                                    </div>
                                                    <div class="legend_cep_ex titulo">ex: 13270-456</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Endere&ccedil;o *</th>
                                                <td><input name="formEnderecoEndereco" id="formEnderecoEndereco" class="input_small" type="text" value="<?php echo $formEnderecoEndereco;?>" tabindex = "10"/>, <input name="formEnderecoNumero" id="formEnderecoNumero" class="input_mini" type="text" size=5 maxlength=5 onKeyPress="return numbersonly(this, event)" value="<?php echo $formEnderecoNumero;?>" tabindex = "11"/></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bairro</th>
                                                <td><input name="formEnderecoBairro" id="formEnderecoBairro" class="input_small" type="text" value="<?php echo $formEnderecoBairro;?>" tabindex = "12"/></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Complemento</th>
                                                <td><input name="formEnderecoComplemento" id="formEnderecoComplemento" class="input_small" type="text" value="<?php echo $formEnderecoComplemento;?>" tabindex = "12"/></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Cidade *</th>
                                                <td><input name="formEnderecoCidade" id="formEnderecoCidade" class="input_small" type="text" value="<?php echo $formEnderecoCidade;?>" tabindex = "13"/></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Estado *</th>
                                                <td tabindex = "14">
                                                    <div class="styled-select">
                                                    <?php echo CHtml::dropDownList('formEnderecoEstado', $formEnderecoEstado, CHtml::encodeArray(CHtml::listData(State::model()->findAll(), 'id', 'name')));?>
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
                                                <th scope="row"><div class="container-info-tip"></div><div class="container-info-subtitle">Coloque seu código de afiliação aqui!</div></th>
                                            </tr>
                                        </table>
                                    </div>
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
                                                <div class="unit_picture">
                                                    <img id="avatar_picture" src="<?php echo $formAvatar ?>"/>
                                                </div>
                                            </div>
                                            <div class="avatar_button_select_picture">
                                                    <div class="container_file_input" id="file"></div>
                                                    <input id="file_helper" type="hidden" value=""/>
                                                </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
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
                                         <div class="background-color frase">
                                            <table border="0" cellspacing="4" cellpadding="0">
                                                <tr class="tipo_cliente">
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
                                <div class="cc-main-content-fullway">
                                    <div class="paypal-container no-display">
                                        <p>Utilizamos o sistema de pagamento on-line PayPal. Para sua maior comodidade e segurança faça agora também seu cadastro
                                            no PayPal. Acesse <a href="http://www.paypal.com.br/br/cgi-bin/webscr?cmd=_home&locale.x=pt_BR" target="_blank" tabindex = "27">aqui</a> a página do PayPal e clique no botão Cadastre-se para se cadastrar.</p>
                                        <br/>
                                        <a href="http://www.paypal.com.br/br/cgi-bin/webscr?cmd=_home&locale.x=pt_BR" target="_blank" tabindex = "27">
                                            <img alt="Paypal" title="Crie sua conto no Paypal" src="http://<?php echo $_SERVER['SERVER_NAME'];?>/media/images/logos/logo_paypal.png"/>
                                        </a>
                                    </div>
                                </div>
                                <div class="buttons_right_site">
                                     <div class="form_buttons_noone">
                                        <div class="bt_common">
                                            <input type='reset' id='bt_clear' value='limpar'  class="botao"/>
                                        </div>
                                        <div class="bt_common">
                                            <input type='submit' id='bt_submit' value='salvar'  class="botao"/>
                                        </div>
                                     </div>
                                </div>
                                <input name="user_id" type="hidden" value="<?php echo $user_id; ?>"/>
                                <input name="pool_id" type="hidden" value="<?php echo $pool_id; ?>"/>
                                <input name="action" type="hidden" value="pj"/>
                                <input name="event" type="hidden" value="salvar"/>
                                <input name="formAvatar" type="hidden" id="formAvatar" value="<?php echo $formAvatar; ?>"/>
                            </form>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                </div>
                <div class='clear'></div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="conta" id="helper_local_logout"/>
<input type="hidden" value="pj" id="helper_user_type"/>
<?php //NÃO REMOVER ESTA LINHA ABAIXO,FAZ PARTE DA EXIBIÇÃO DESTE NO ADMIN ?>
<?php if (Yii::app()->controller->id == "admin") { include Yii::app()->getBasePath() . "/views/admin/common/footer/buttons_admin/buttons_users.php";  ?><script type="text/javascript"></script><?php } ?>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['design_site'] . '.php'; ?>