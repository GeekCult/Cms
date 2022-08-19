<?php include Yii::app()->getBasePath() . '/views/site/common/header/site/' . $preferences['topo_tipo'] . '.php'; ?>
<div class="row-fluid">
    
    <?php if(Yii::app()->params['ramo'] == 'software') include Yii::app()->getBasePath() . '/views/site/common/menu/menu_software.php'; ?>
    <div class="pan <?php if(Yii::app()->params['ramo'] == 'software'){echo 'container-fluid';}else{echo 'container';} ?>">
        <div class="<?php if(Yii::app()->params['ramo'] == 'software') echo "content_software" ?>">

            <?php include Yii::app()->getBasePath() . '/views/site/common/menu/conta/common/menu_conta_html5.php'; ?>
            <div class="mgL mgR">
                <h1>Nova senha de acesso</h1>
                <div class="clear"></div>
                <div class="divider_horizontal"></div>

                <p>&nbsp</p>

                <div class="row-fluid">
                    <h2>Alteração da senha da conta</h2>
                    <p>Digite abaixo uma nova senha para acessar sua conta!</p>

                    <p>&nbsp</p>
                    <div class="row-fluid">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="span6">
                                <input name="formCredencialSenha" id="formCredencialSenha" value="" class="span12" type="password" placeholder="<?php echo Yii::t("adminForm", "order_page_label_password"); ?>"/>
                            </div>
                            <div class="span6">
                                <input name="formCredencialConfirma" id="formCredencialConfirma" value="" class="span12" type="password" placeholder="<?php echo Yii::t("adminForm", "order_page_label_repeat_password"); ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                         <div class="center">
                            <div class="title_security">Seguran&ccedil;a</div>
                            <div><img src="/media/images/icons/security/security_password_none.png" id="formCredencialSeguranca" alt="Seguran&ccedil;a" /></div>
                        </div>
                    </div>
                    <div class="rows-fluid">
                        <div class="container_message_errors errors_3"> 
                            <div class="message_errors_3">                   
                                <div id="cc-error-screen-content">                           
                                    <ul class="content_error" id="message_password">&nbsp;Todos os campos devem ser preenchidos!</ul>
                                </div>                  
                            </div>
                        </div>
                    </div>
                    <div class="divider_shadow"></div>
                    <div class="right_resp">
                        <input type='button' id='bt_change_password' value='salvar'  class="botao btn-main"/>
                    </div>            
                </div>


                <div class='clear'></div>
                <p>&nbsp;</p><p>&nbsp;</p>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="conta" id="helper_local_logout"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/site/' . $preferences['rodape_tipo'] . '.php'; ?>