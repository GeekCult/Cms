<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "fonts_page_edit_colors") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <fieldset class="adminFormContent">
         <div class="form-group">
            <label for="title">&nbsp;</label>
            <textarea name="" id="css" class="form-control" rows="20"><?php echo $css ?></textarea>
        </div>
        <div class="form-group">
            <div class="form-inline">
                <div class="full-line-group">
                    <input type="checkbox" id="css_define" name="css_define" <?php if($css_define) echo 'checked' ?> class="m-l-20"/>
                    <label for="css_define">Aplicar CSS no site</label>
                </div>                                
            </div>
        </div>  
        <input type="hidden" id="helper_action" data-js-action="css_editor"/>
    </fieldset>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_update" value="<?php echo Yii::t("adminForm", "button_common_update") ?>" />
    </div>   
    <div class="clear height_support"></div>
</div>
<div class="menu_shortcut">
    <ul>
        <li><input type="button" class="iSM icon_save"/></li>
        <li>
            <a href="/admin/howto/tags" class="fancy-how-to-tags" title="dicas de HTML">
                <input type="button" class="iSM icon_tag"/>
            </a>
        </li>
    </ul>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>

