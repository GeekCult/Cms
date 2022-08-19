<script type="text/javascript" src="/js/lib/keyboardlistener.js"></script>
<div id="container_result_preloader">
    <div class="bg_result_preloader">
        <div class="text_result_preloader"><?php echo Yii::t("messageStrings", "message_loading");?></div>
        <div class="bg_result_preloader_bar" id="preloader_loaderbar"></div>
    </div>
</div>
<div id="container_result_message">
    <div class="bg_result_message">
        <div class="bt_close_message" id="bt_close_message"></div>
        <div id="resultAlertMessage"></div>
    </div>
</div>
<div id="container_result_message_cancel">
    <div class="bg_result_message">
        <div id="resultAlertMessageCancel"><?php echo Yii::t("messageStrings", "message_make_sure_remove");?></div>
        <div class="container_buttons_message_cancel">
            <input type="button" value="cancelar" class="bt_default_cancel_admin" id="bt_alertdim_cancel"/>
            <input type="button" value="sim" class="bt_default_cancel_admin" id="bt_alertdim_yes"/>
        </div>
    </div>    
</div>
<div id="container_login">
    <div class="bg_result_login"> 
        <div id="container_password_common">
            <form action="/admin" id="formLoginAdmin">
                <ul class="container_form">
                    <li class="login_user">
                        <label>User</label>
                        <input class="field_text input_small" value="" type="text" id="user" name="email"/>
                    </li>
                    <li class="login_password">
                        <label>Senha</label>
                        <input class="field_text input_small" value="" type="password" id="password"/>
                    </li>
                </ul>
            </form>
            <div class="container_legend_conected">
                <div class="check_conected"><input type="checkbox" id="permitir" value="true"/></div>
                <div class="label_conected">Permanecer conectado</div>
            </div>
            <div class="buttons_right_dim">
                <span id="login_result_message" class="login_result_message">Usuário ou senha incorreta</span>
                <div class="container_button_login">
                    <a href="#" id="forgotten_password">Esqueci minha senha</a>
                    <input class="button_login_logar" value="" type="button" title="logar" id="bt_logar"/>
                </div>
            </div>
        </div>
        <div id="container_password_forgot_password">
            <ul class="container_form">
                <h3 class="title_forgotten">Esqueceu sua senha?</h3>
                <p>&nbsp;</p>
                <li class="login_user">
                    <label>E-mail</label>
                    <input class="field_text" value="" type="text" id="email_senha_new" name="email"/>
                </li>
                <li id="container_esqueci_senha_success">
                    <div>Senha enviada com sucesso!</div>
                </li>
            </ul>            
            <div class="buttons_right_dim">
                <span id="container_esqueci_senha_error" class="login_result_message">Usuário ou senha incorreta</span>
                
                <div class="container_button_login">
                    <input class="button_login_esqueci_senha" value="" type="button" title="esqueci minha senha" id="bt_forgotten"/>
                </div>
            </div>
        </div>
    </div>
</div>