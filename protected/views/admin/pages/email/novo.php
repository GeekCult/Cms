<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t('adminForm', 'email_page_title_new')  ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/email/listar" id="bt_list">
        <input type="button" class="bt_right" value="<?php echo Yii::t('adminForm', 'button_common_list') ?>"/>
    </a>
    <fieldset class="adminFormContent">
        <ul>
            <li class="rows">
                <p>&nbsp;</p>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_name') ?></div>
                <div class="text">
                    <input id="nome" type="text" class="form" value="<?php if(isset($content['nome'])) echo $content['nome']; ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_email') ?></div>
                <div class="text">
                    <input id="email" type="text" class="form" value="<?php if(isset($content['email'])) echo $content['email']; ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_phone') ?></div>
                <div class="text">
                    <input id="telefone" type="text" class="form" value="<?php if(isset($content['telefone'])) echo $content['telefone']; ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_message') ?></div>
                <div class="text">
                    <textarea id="mensagem" rows="4" class="form"><?php if(isset($content['mensagem'])) echo $content['mensagem']; ?></textarea>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_agree_newsletter') ?></div>          
                <input id="newsletter" type="checkbox" class="checkbox_email" value="" checked />        
            </li>
            <li class="rows">
                <p>&nbsp;</p>
            </li>
        </ul>
    </fieldset>
    <input id="tipo" type="hidden" class="form" value=""/>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t('adminForm', 'button_common_submit') ?>"/>
    </div>
    <div class="clear height_support"></div>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>