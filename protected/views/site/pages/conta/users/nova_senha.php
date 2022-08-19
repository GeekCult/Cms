<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['topo_tipo'] . '.php'; ?>
<div class="mainPan">
    <div class="wrap">
        <?php if (Yii::app()->controller->id == "admin") { include Yii::app()->getBasePath() . "/views/admin/common/header/titles_admin/title_admin_produtos.php";  } ?>
        <div class="pan container">            
            <div class="container_pan">
                <?php if (Yii::app()->controller->id != "admin") { ?>
                <?php include Yii::app()->getBasePath() . '/views/site/common/menu/conta/' . Yii::app()->params['ramo'] . '/menu_conta.php'; ?>
                <?php } ?>
                <?php if (Yii::app()->controller->id != "admin") { ?><h1>Nova senha de acesso</h1><?php } ?>
                <div class="clear"></div>
                <div class="divider_horizontal"></div>
                <div class="button_conta_right">
                    <a href="javascript:history.go(-1)">
                        <div class="bt_conta_ear_down">voltar</div>
                    </a>                    
                </div>
                <p>&nbsp</p>
                <div class="cc-main-content">
                    <div class="container_verificacao_cadastro">
                        <h2>Alteração da senha da conta</h2>
                        <p>Digite abaixo uma nova senha para acessar sua conta!</p>
                        <ul class="container_password">
                            <p>&nbsp</p>
                            <li class="rows">                
                                <div class="container_orders_left_password">
                                    <div class="label_text_Curriculum"><?php echo Yii::t("adminForm", "order_page_label_password"); ?></div>
                                    <div class="text">
                                       <input name="formCredencialSenha" id="formCredencialSenha" value="" class="input_small" type="password"/>
                                    </div>
                                </div>
                                <div class="container_orders_right_password">
                                    <div class="label_text_Curriculum"><?php echo Yii::t("adminForm", "order_page_label_repeat_password"); ?></div>
                                    <div class="text">
                                       <input name="formCredencialConfirma" id="formCredencialConfirma" value="" class="input_small" type="password"/>
                                    </div>
                                </div>
                                 <div class="security_level">
                                    <div class="title_security">Seguran&ccedil;a</div>
                                    <div><img src="/media/images/icons/security/security_password_none.png" id="formCredencialSeguranca" alt="Seguran&ccedil;a" /></div>
                                </div>
                            </li>
                            <li class="rows">
                                <div class="container_message_errors errors_3"> 
                                    <div class="message_errors_3">                   
                                        <div id="cc-error-screen-content">                           
                                            <ul class="content_error" id="message_password">&nbsp;Todos os campos devem ser preenchidos!</ul>
                                        </div>                  
                                    </div>
                                </div>
                            </li>
                            <div class="divider_shadow"></div>
                            <div class="buttons_right_site buttons_senha_password">
                                 <div class="form_buttons_support">
                                    <div class="bt_common">
                                        <input type='button' id='bt_change_password' value='salvar'  class="botao"/>
                                    </div>
                                 </div>
                            </div>
                        </ul> 
                    </div>
                </div>
            </div>
            <div class='clear'></div>
            <p>&nbsp;</p><p>&nbsp;</p>
        </div>
    </div>
</div>
<input type="hidden" value="conta" id="helper_local_logout"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>