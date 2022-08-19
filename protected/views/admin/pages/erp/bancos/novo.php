<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Banco</h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/bancos/listar" id="bt_list">
        <input type="button" class="bt_right" value="<?php echo Yii::t('adminForm', 'button_common_list') ?>"/>
    </a>
    <form id="form_bancos">
        <fieldset class="adminFormContent">
            <ul>
                <li class="rows">
                    <p>&nbsp;</p>
                </li>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_title') ?></div>
                    <div class="text">
                        <input id="titulo" type="text" class="form" value="<?php if(isset($content['titulo'])) echo $content['titulo']; ?>" name="titulo"/>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_value') ?></div>
                    <div class="text">
                        <input id="valor" type="text" class="form" value="<?php if(isset($content['valor'])) echo $content['valor']; ?>" name="valor"/>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_due') ?></div>
                    <div class="text">
                        <?php if(!isset($content['data'])) $content['data'] = date('d/m/Y')   ?>
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array('name'=>'vencimento','id'=>'vencimento', 'language' => 'pt-BR', 'options'=>array('showAnim'=>'fade', "altFormat" => "dd/mm/yy", 'dateFormat' => 'dd/mm/yy'), 'value'=> $content['data'], )); ?>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_message') ?></div>
                    <div class="text">
                        <textarea id="descricao" name="descricao" rows="4" class="form"><?php if(isset($content['mensagem'])) echo $content['mensagem']; ?></textarea>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_agree_newsletter') ?></div>          
                    <input id="newsletter" type="checkbox" class="checkbox_email" value="" checked />        
                </li>
                <li class="rows">
                    <p>&nbsp;</p>
                </li>
                <li class="rows">
                    <div id="message_ctn"></div>
                </li>
            </ul>
            <input type="hidden" name="ignore_erp" value="1"/>
            <input type="hidden" name="tipo" value="1"/>
            <input type="hidden" name="action" value="<?php echo $action ?>"/>
            <input type="hidden" name="id" value="<?php if(isset($content['id'])) echo $content['id'] ?>"/>
        </fieldset>
    </form>
    <input id="helper_action" type="hidden" class="form" value="" data-js-action="new"/>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_save" value="<?php echo Yii::t('adminForm', 'button_common_submit') ?>"/>
    </div>
    <div class="clear height_support"></div>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>