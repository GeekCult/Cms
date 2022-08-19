<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t('adminForm', 'setting_page_title') ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <fieldset class="adminFormContent">
        <ul>
            <h4 class="subtitle_admin"><?php echo Yii::t('adminForm', 'setting_title_email_contact') ?></h4>
            <li class="rows">
                <div class="label_text_Admin_big"><?php echo Yii::t('adminForm', 'setting_email_contact_title') ?></div>
                <div class="text">
                    <input id="titulo" class="form" value="<?php echo $content['email_title'] ?>"/>
                </div>
                <div class="label_email_contato">
                <span>Título do email que o será usado para envio:</span>
                <p>Adicione um nome pequeno pois Gmail, Hotmail, Yahoo and mobiles são poucos caracteres exibidos</p>
                </div>
            </li>
            <li><p>&nbsp</p></li>
            <li class="rows">
                <div class="label_text_Admin_big"><?php echo Yii::t('adminForm', 'setting_email_contact_send') ?></div>
                <div class="text">
                    <input id="email_sender" class="form" value="<?php echo $content['email_sender'] ?>"/>
                </div>
                <div class="label_email_contato">
                <span>Apenas o e-mail que será usado para envio:</span>
                <p>Apenas um e-mail, você pode trocá-lo a qualquer momento.</p>
                </div>
            </li>
            <li><p>&nbsp</p></li>
            <li class="rows">
                <div class="label_text_Admin_big"><?php echo Yii::t('adminForm', 'setting_email_contact_receive') ?></div>
                <div class="text">
                    <input id="email" class="form" value="<?php echo $content['email_contato'] ?>"/>
                </div>
                <div class="label_email_contato">
                    <p>E-mails cadatrados aqui recebem todos os e-mails recebidos no site, como contato, tarefas,</br> cadastros de usuários, participantes em promoções e etc.</p>
                    <p>&nbsp</p>
                    <span>Separe os e-mais que receberão os contatos do site por virgula e espaço:</span>
                    <p>eu@purplepier.com.br, vc@purplepier.com.br, nos@tudo.com, tu@terra.com.br</p>
                </div>
            </li>
            <li><p>&nbsp</p></li>
            <li class="rows">
                <div class="label_text_Admin_big"><?php echo Yii::t('adminForm', 'setting_email_contact_receive_ceo') ?></div>
                <div class="text">
                    <input id="email_ceos" class="form" value="<?php echo $content['email_contato_ceos'] ?>"/>
                </div>
                <div class="label_email_contato">
                    <p>Ceos: São e-mail que devem receber apenas estatísticas e e-mails mais destinados a administração.</p>
                    <p>Atualmente recebe estatisticas mais amplas, evolução de clientes, e etc.</p>
                    <p>Utilize as mesmas configurações citadas acima.</p>
                </div>
            </li>
            <li><p>&nbsp</p></li>
            
            <li><h3>E-mail marketing - PierMail</h3></li>
            <li class="rows">
                <div class="label_text_Admin_big"><?php echo Yii::t('adminForm', 'setting_email_contact_emkt') ?></div>
                <div class="text">
                    <input id="email_emkt" class="form" value="<?php echo $content['email_marketing'] ?>"/>
                </div>
                <div class="label_email_contato">
                <span>Apenas o e-mail que será usado para envio do e-mail marketing:</span>
                <p>Esse e-mail não receberá respostas dos e-mail enviados, ex: no-reply@seudominio.com.br ou mkt@seudominio.com.br ...</p>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin_big">E-mail de teste</div>
                <div class="text">
                    <input id="email_emkt_teste" class="form" value="<?php echo $content['email_marketing_teste'] ?>"/>
                </div>
                <div class="label_email_contato">
                <span>Apenas o e-mail que será usado para recebimento do teste do e-mail marketing:</span>
                <p>Esse teste deve ser enviado antes do disparo final e serve de preview do e-mail para testar: links, imagens, layout e etc</p>
                </div>
            </li>
            
        </ul>
    </fieldset>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit_email_contato" value="<?php echo Yii::t('adminForm', 'button_common_update') ?>"/>
    </div>
    <div class="clear height_support"></div>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>