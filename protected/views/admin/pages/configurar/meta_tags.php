<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t('adminForm', 'setting_page_title') ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <fieldset class="adminFormContent">
        <ul>
            <h4 class="subtitle_admin"><?php echo Yii::t('adminForm', 'setting_title_metatags') ?></h4>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_metatags_title') ?></div>
                <div class="text">
                    <input id="titulo" class="form" value="<?php echo $content['titulo'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_metatags_description') ?></div>
                <div class="text">
                    <textarea id="descricao" class="form" rows="4" maxlength="160"><?php echo $content['descricao'] ?></textarea>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_metatags_list') ?></div>
                <div class="text">
                    <textarea rows="9" id="metatag" class="form"><?php echo $content['metatags'] ?></textarea>
                </div>
            </li>
            <li class="rows">
                <p>&nbsp;</p>
                <h4 class="subtitle_admin">Informações de Status do site</h4>
            </li>
            <li class="rows">
                <div class="form_data">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "event_page_label_data"); ?></div>
                    <div class="text relative" style="width: 400px; display: inline-block">
                        <div class="left">
                           <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array('name'=>'date_release','id'=>'date_release','options'=>array('showAnim'=>'fadeIn', "altFormat" => "dd/mm/yyyy", 'dateFormat' => 'dd/mm/yy'), 'value'=>  $content['site_release'], )); ?> 
                        </div>
                        <a href="#" class="tip_trigger" style="position: relative; float: left; top:0px; margin-left: 20px;"><img src="/media/images/icons/icon_help.png" class="left"/><p class="tip">Adicione a data que o site deve ir para o ar</p></a>
                    </div>
                </div>              
            </li>
            <li class="rows">
                <div class="label_text_Admin">Online</div>
                <div class="text">
                    <input type="checkbox" name="online" id="online" class="checkbox left"<?php if($content['status'] == '1') echo 'checked'  ?>>
                    <a href="#" class="tip_trigger" style="position: relative; float: left; top:-5px; margin-left: 20px;"><img src="/media/images/icons/icon_help.png" class="left"/><p class="tip">Se selecionado você aceita os termos de uso e condições PurplePier!</p></a>
                    <div style="margin-left: 15px; text-decoration: underline; display: inline-block;"><a href="https://www.purplepier.com.br/termos" target="_blank" class="link sF">Termo de uso</a></div>
                </div>                
            </li>
        </ul>
    </fieldset>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit_metatag" value="<?php echo Yii::t('adminForm', 'button_common_update') ?>"/>
    </div>
    <div class="clear height_support"></div>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>