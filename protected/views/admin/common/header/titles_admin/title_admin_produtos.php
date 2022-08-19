<div class="titleContent">
    <div class="titlePageAdmin">
        <h1><?php echo Yii::t('adminForm', 'title_'.Yii::app()->params['ramo']. '_new') ?></h1>
    </div>
    <div class="bug_tracker iframe"></div>
</div>
<a href="/admin/produtos/listar">
    <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_list") ?>" />
</a>
<div class="bt_rigth_small" title="adicionar novo">
    <a href="/admin/produtos/novo" id="bt_new"><?php echo Yii::t("adminForm", "button_common_add") ?></a>
</div>