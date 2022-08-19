<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t('adminForm', 'setting_page_title') ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <fieldset class="adminFormContent">
        <ul>
            <h4 class="subtitle_admin"><?php echo Yii::t('adminForm', 'setting_title_google_analitics') ?></h4>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_googleanalitics_list') ?></div>
                <div class="text">
                    <input id="google_analytics" class="form" value="<?php echo $content['google_analytics'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Id da view</div>
                <div class="text">
                    <input id="google_analytics_view" class="form" value="<?php echo $content['google_analytics_view'] ?>" placeholder="82705661"/>
                </div>
            </li>
        </ul>
    </fieldset>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit_google_analytics" value="<?php echo Yii::t('adminForm', 'button_common_update') ?>"/>
    </div>
    <div class="clear height_support"></div>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>