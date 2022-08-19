<script type="text/javascript" src="/js/admin/detalhes.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "details_page_title_new") . $title ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/detalhes/<?php echo $title ?>/listar">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_list") ?>"/>
    </a>
    <form action="">
        <fieldset class="adminFormContent">
            <ul>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "details_page_label_1") ?></div>
                    <div class="text_middle">
                        <input id="title" type="text" class="form" size="" value="<?php if($content['nome'] != "vazio") echo $content['nome'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "details_page_label_3") ?></div>
                    <div class="styled-select">
                       <select id="local">
                            <option value="icons" <?php if($title == 'icons') echo "selected" ?>>Icons</option>
                            <option value="flags" <?php if($title == 'flags') echo "selected" ?>>Flags</option>
                            <option value="dividers" <?php if($title == 'dividers') echo "selected" ?>>Dividers</option>
                        </select>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin">Nome da classe</div>
                    <div class="text_middle">
                        <input id="classe" type="text" class="form" value="<?php if($content['classe'] != "vazio") echo $content['classe'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "details_page_label_2") ?></div>
                    <div class="text_float_file">
                        <div class="container_file_input" id="file"></div>
                        <input id="file_helper" type="hidden" class="form" value=""/>
                    </div>                   
                </li>
            </ul>
        </fieldset>
        <div class="clear"></div>
        <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
        <div class="buttons_right">
            <input type="button" class="bt_right" id="bt_submit" name="<?php echo $title ?>" value="<?php echo Yii::t("adminForm", "button_common_submit") ?>" />
            <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_clear") ?>"/>
        </div>
        <div class="clear height_support"></div>
        <input type="hidden" id="helper_type" value="<?php echo $title ?>"/>
    </form>
</div>
<div class="menu_shortcut">
    <ul>
        <li><input type="button" class="iSM icon_save"/></li>
        <li>
            <a href="/admin/detalhes/<?php echo $title ?>/listar">
                <input type="button" class="iSM icon_list"/>
            </a>
        </li>
        <li>
            <a href="/admin/howto/tags" class="fancy-how-to-tags" title="dicas de HTML">
                <input type="button" class="iSM icon_tag"/>
            </a>
        </li>
    </ul>
</div>
<input type="hidden" id="helper_action" data-js-action="novo"/>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>